<?php

class Controller_AjaxRequest extends AbstractController{
	function init() {
		parent::init();
		if ( $this->api->getConfig( 'sef_url' ) ) {
			$this->initSEF();
		}else {
			$this->initNONSEF();
		}

	}

	function initSEF() {
		$ref= $_SERVER['HTTP_REFERER'];
		$host = $_SERVER['HTTP_HOST'];

		// $ref= "http://xavoc.somilands.com/?page=epan&epan=xavoc&subpage=home";// <= referer
		// $ref= "xavoc.somilands.com/home";
		// $host = "www.somilands.com";// <=host


		$host = trim( $host, 'www.' );
		$ref=str_replace( "http://", "", $ref );
		$ref=str_replace( "www.", "", $ref );

		// since site is accessed like "epan.in/page-name" so prepend default site first web.domain.com/page-name
		$ref = $this->api->getConfig( 'default_site' ).".".$ref;

		// Match xavoc(1).epan(2).in(3)/home(4)
		preg_match_all( '/(.*)\.(.*)\.(.*)\/(.*)/', $ref, $parts );


		/*echo strpos($ref,$this->api->getConfig('epan_site')) . "<br/>";
		echo $ref;
		print_r($parts);
		*/

		// MULTISITE TODO DELETE COMMENT
		// $this->api->website_requested = $parts[1][0];
		// if ( $this->api->website_requested =='' ) $this->api->website_requested = $this->api->getConfig( 'default_epan' );


		$this->api->page_requested = $parts[4][0];

		if ( $this->api->page_requested =='' ) $this->api->page_requested=$this->api->getConfig( 'default_page' );

		if ( strpos( $this->api->page_requested, '?page=' ) !==false ) {
			preg_match_all( '/(.*)subpage=(.*)/', $ref, $parts );
			$this->api->page_requested = $parts[2][0];
		}
		// echo $this->epan . '<br/>'. $this->page;

	}
	function initNONSEF() {
		$ref= $_SERVER['HTTP_REFERER'];
		$host = $_SERVER['HTTP_HOST'];

		$request_from = str_replace( 'http://'.$host.'/', '', $ref );
		$request_array = explode( "/", $request_from );

		preg_match_all( "/(.*)".$this->api->getConfig('url_page_parameter')."=(.*)/", $ref, $request_array );

		// echo $ref;
		// print_r($request_array);
		// $this->api->website_requested = $request_array[2][0];

		$this->api->page_requested = ( isset( $request_array[2][0] )?$request_array[2][0]:$this->api->getConfig('default_page') );

	}

}