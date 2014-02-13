<?php

class page_save extends Page {

	function init() {
		parent::init();		
		
		if ( $_POST['length'] != strlen( $_POST['body_html'] ) ) {
			$this->js()->univ()->successMessage( 'Length send ' . $_POST['length'] . " AND Length calculated again is " . strlen( $_POST['body_html'] ) )->execute();
		}

		if ( $_POST['crc32'] != sprintf("%u",crc32( $_POST['body_html'] ) )) {
			$this->js()->univ()->successMessage( 'CRC send ' . $_POST['crc32'] . " AND CRC calculated again is " . sprintf("%u",crc32( $_POST['body_html'] )) )->execute();
		}

		try{

			$content = $_POST['body_html'];
			include_once getcwd().'/lib/phpQuery/phpQuery/phpQuery.php';
			$doc = \phpQuery::newDocument( $content );

			$server = $doc['[data-is-serverside-component=true]'];
			foreach ( $doc['[data-is-serverside-component=true]'] as $ssc ) {
				pq( $ssc )->html( "" )->append( $html );

			}

			$content = $doc->htmlOuter();

			$this->api->current_page['content'] = urldecode( trim( $content ) );
			$this->api->current_page['body_attributes'] = urldecode( $_POST['body_attributes'] );


			$this->api->exec_plugins( 'epan-page-before-save', $this->api->current_page );
			$this->api->current_page->save();
			$this->api->exec_plugins( 'epan-page-after-save', $this->api->current_page );

			if ( $_POST['take_snapshot']=='Y' ) {
				// $this->api->exec_plugins('epan-page-before-snapshot',$this->api->current_page);
				$new_version = $this->api->current_page->ref( 'EpanPageSnapshots' );
				$new_version['title']=$this->api->current_page['title'];
				$new_version['keywords']=$this->api->current_page['keywords'];
				$new_version['description']=$this->api->current_page['description'];
				$new_version['body_attributes']=$this->api->current_page['body_attributes'];
				$new_version['content']=$this->api->current_page['content'];
				$new_version->save();
				// $this->api->exec_plugins('epan-page-after-snapshot',$this->api->current_page);
			}
		}
		catch( Exception_StopInit $e ) {

		}
		catch( Exception $e ) {
			$this->js()->univ()->errorMessage( 'Error... Could not save your page ' . $e->getMEssage() )->excute();
			exit;
		}

		echo "saved";
		exit;
	}

}
