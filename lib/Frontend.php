<?php

class Frontend extends ApiFrontend{
	/**
	 * stores currrent website model object
	 *
	 * @var Model_Epan
	 */
	public $current_website=null;
	/**
	 * Stores current page about to render
	 *
	 * @var Model_EpanPage
	 */
	public $current_page=null;
	/**
	 * Stores Website requested from GET[config['website_request_variable']]
	 *
	 * @var String
	 */
	public $website_requested=null;
	/**
	 * Stores Page requested from GET[config['page_request_variable']]
	 *
	 * @var String
	 */
	public $page_requested=null;
	/**
	 * Handels CMS mode,
	 * If set to true all editing features will be enabled in frontend side
	 *
	 * @var boolean
	 */
	public $edit_mode=false;

	/**
	 * $epan_plugins contains all plugins associated with this website/epan
	 * loaded in frontend
	 *
	 * @var array
	 */
	public $website_plugins=array();

	function init() {
		parent::init();

		// A lot of the functionality in Agile Toolkit requires jUI
			$this->add( 'jUI' );

			$this->js()
			->_load( 'atk4_univ' )
			->_load( 'ui.atk4_notify' )
			;

		if ( !$this->getConfig( 'installed' ) ) {
			// Not installed and installation required
			// TODO : check security issues
			$this->page = 'install';
		}else {
			// already installed connect to provided settings and go on
			$this->dbConnect();



			$this->requires( 'atk', '4.2.0' );


			$this->addLocation( 'templates', array( 'css'=>'default/css' ) );

			$this->addLocation( '.', array(
					'addons'=>array( 'epan-addons', 'epan-components', 'xavoc-addons' ) )
			);

			// This will add Epan Market Place Location
			$this->addLocation( 'epan-addons', array(
					'page'=>array( "." ),
				) );
			// This will add Epan Market Place Location
			$this->addLocation( 'epan-components', array(
					'page'=>array( "." ),
				) );
			// This will add some resources from atk4-addons, which would be located
			// in atk4-addons subdirectory.
			$this->addLocation( 'atk4-addons', array(
					'php'=>array(
						'mvc',
						'misc/lib',
					)
				) )
			->setParent( $this->pathfinder->base_location );

			/**
			 * TODO: wrap in a IF(page does not contains owner_ / branch_ / system_ )
			 * only then you need to get all this, as you are looking front of a website
			 * -----------------------------------------------------------------------
			 * Get the request from browser query string and set various Api variables like
			 * current_website, current_page, website_requested and page_requested
			 * Once set that can be accessed all CMS vise like
			 * $this->api->current_website
			 */
			if ( true /*page does not contain owner_ / branch_ or system_ */ ) {
				$site_parameter= $this->getConfig( 'url_site_parameter' );
				$page_parameter= $this->getConfig( 'url_page_parameter' );

				$this->stickyGET( $site_parameter );
				$this->stickyGET( $page_parameter );

				$this->website_requested = $this->getConfig( 'default_site' );
				/**
				 * $this->page_requested finds and gets the requested page
				 * Always required in both multi site mode and single site mode
				 *
				 * @var String
				 */
				$this->page_requested=trim( $_GET[$page_parameter], '/' )
					?  trim( $_GET[$page_parameter], '/' )
					: $this->getConfig( 'default_page' );

				if ( $this->isAjaxOutput() or $_GET['cut_page'] ) {
					// set page_requested to referrer page not the page requested by
					// ajax request
					$this->add( 'Controller_AjaxRequest' );

				}


				$this->current_website = $this->add( 'Model_Epan' )->tryLoadBy( 'name', $this->website_requested );
				if ( $this->current_website->loaded() ) {
					$this->current_page = $this->current_website->ref( 'EpanPage' )
					->addCondition( 'name', $this->page_requested )
					->tryLoadAny();
				}else {
					$this->exec_plugins( 'error404', $this->website_requested );
				}

				// MULTISITE CONTROLER
				$this->add( 'Controller_EpanCMSApp' )->frontEnd();
				if ( $this->current_website->loaded() )
					$this->exec_plugins( 'website-loaded', $this->api->current_website );
				if ( $this->current_page->loaded() )
					$this->exec_plugins( 'website-page-loaded', $this->api->page_requested );

				$this->load_plugins();
			}

			$auth=$this->add( 'BasicAuth' );
			$auth->setModel( 'Users', 'username', 'password' );
		}
	}

	function load_plugins() {

		$this->website_plugins=array();

		$plugins = $this->add( 'Model_InstalledComponents' )
		->addCondition( 'epan_id', $this->api->current_website->id )
		->addCondition( 'has_plugins', true );
		$marketplace_j = $plugins->join( 'epan_components_marketplace', 'component_id' );

		foreach ( $plugins->getRows() as $plg ) {
			foreach ( new \DirectoryIterator( getcwd().DIRECTORY_SEPERATOR.'epan-components'.DIRECTORY_SEPERATOR.$plg['namespace'].DIRECTORY_SEPERATOR.'lib'.DIRECTORY_SEPERATOR.'Plugins' ) as $fileInfo ) {
				if ( $fileInfo->isDot() ) continue;
				if ( !in_array( $plg_url=$plg['namespace'].'/Plugins_'.str_replace( ".php", "", $fileInfo->getFilename() ), $this->website_plugins ) ) {
					$p = $this->add( $plg['namespace'].'/Plugins_'.str_replace( ".php", "", $fileInfo->getFilename() ) );
					$this->website_plugins[] = $p;
				}
			}
		}
	}


	function exec_plugins( $event_hook, &$param ) {
		if ( !is_array( $param ) )
			$param_array = array( &$param );
		else
			$param_array = $param;

		// if(empty($this->website_plugins))
		//  throw $this->exception("Plugins Not loaded");

		foreach ( $this->website_plugins as $p ) {
			// echo $event_hook. "<br/>";
			$p->hook( $event_hook, $param_array );
		}
		return;


		echo "Event: ". $event_hook . "<br/>";
		foreach ( $param_array as $prm ) {
			if ( $prm instanceof AbstractObject )
				echo $prm['name']. "<br/>";
			else
				echo $prm . "<br/>";
		}
	}

	function defaultTemplate() {
		if ( strpos( str_replace( "/", "_", $_GET['page'] ), 'owner_' )!==false ) {
			return array( 'owner' );
		}
		if ( strpos( str_replace( "/", "_", $_GET['page'] ), 'branch_' )!==false ) {
			return array( 'branch' );
		}
		// if ( strpos( str_replace( "/", "_", $_GET['page'] ), 'system_' )!==false ) {
		// 	return array( 'system' );
		// }
		return array( 'shared' );
	}

}
