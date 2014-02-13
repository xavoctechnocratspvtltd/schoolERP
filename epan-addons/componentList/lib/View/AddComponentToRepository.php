<?php


namespace componentList;

class View_AddComponentToRepository extends \View{
	function init() {
		parent::init();

		if ( $_POST['addcomponenttorepository_form_submitted'] ) {
			// echo "<pre>";
			// print_r($_FILES);
			// echo "</pre>";
			// If not uplaoded sucessfully add error
			if ( $_FILES["component_file"]["error"] > 0 ) {
				$this->add( 'View_Error' )->set( "Error: " . $_FILES["component_file"]["error"] );
			}
			else {
				// only zip files allowed to upload
				if ( $_FILES['component_file']['type'] !='"application/x-zip"' ) {
					$this->add( 'View_Error' )->set( 'Component should be uploaded zipped only' );
				}else {
					// Search for config.xml file in uploaded zip
					$zip = new \zip();
					$config_file = $zip->readFile( $_FILES['component_file']['tmp_name'], 'config.xml' );
					$config_file_data = $config_file['config.xml']['Data'];
					// if not found set error
					if ( ( $msg=$this->isValidConfig( $config_file_data ) ) !== true ) {
						$this->add( 'View_Error' )->set( $msg );
						return true;
					}
					// read config.xml and search for epan-system variables
					$xml = simplexml_load_string( $config_file_data );
					$json = json_encode( $xml );
					$config_array = json_decode( $json, TRUE );
					// set error if not found -- not proper xml
					if ( $config_array['namespace'] == "" ) {
						$this->add( 'View_Error' )->set( 'namespace not defined' );
						return;
					}
					// check entry in marketplace if this namespace is already used
					$existing_namespace = $this->add( 'Model_MarketPlace' );
					$existing_namespace->tryLoadBy( 'namespace', $config_array['namespace'] );
					if ( $existing_namespace->loaded() ) {
						$this->add( 'View_Error' )->set( 'This namespace is already used and application is installed.' );
						return;
					}
					// add entry to marketplace table (Model)

					$marketplace=$this->add( 'Model_MarketPlace' );
					$marketplace['name']=$config_array['name'];
					$marketplace['namespace']=$config_array['namespace'];
					$marketplace['type']=$config_array['type'];
					$marketplace['is_system']=( strtolower( $config_array['is_system'] )=='no' )?false:true;
					$marketplace['description']=$config_array['description'];
					$marketplace['plugin_hooked']=$config_array['plugin_hooked'];
					$marketplace['default_enabled']=( strtolower( $config_array['default_enabled'] )=='no' )?false:true;
					$marketplace['has_toolbar_tools']=( strtolower( $config_array['has_toolbar_tools'] )=='no' )?false:true;
					$marketplace['has_owner_modules']=( strtolower( $config_array['has_owner_modules'] )=='no' )?false:true;
					$marketplace['has_plugins']=( strtolower( $config_array['has_plugins'] )=='no' )?false:true;
					$marketplace['has_live_edit_app_page']=( strtolower( $config_array['has_live_edit_app_page'] )=='no' )?false:true;
					$marketplace->save();


					// extract uploaded zip file to epan-components
					if ( !$zip->extractZip( $_FILES['component_file']['tmp_name'], getcwd().DIRECTORY_SEPERATOR. 'epan-components'.DIRECTORY_SEPERATOR. $config_array['namespace'] ) ) {
						return "Couldn't Extract";
					}

					// TODO Execute install.sql file IF EXISTS
				}
			}
		}
	}

	function isValidConfig( $config_file_data ) {
		if ( $config_file_data=="" ) return "config.xml file not found";

		return true;
	}

	function defaultTemplate() {
		$l=$this->api->locate( 'addons', __NAMESPACE__, 'location' );
		$this->api->pathfinder->addLocation(
			$this->api->locate( 'addons', __NAMESPACE__ ),
			array(
				'template'=>'templates',
				'css'=>'templates/css'
			)
		)->setParent( $l );
		return array( 'view/addnewcomponentotrepository' );
	}
}
