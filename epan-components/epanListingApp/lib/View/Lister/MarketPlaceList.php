<?php

namespace epanListingApp;

class View_Lister_MarketPlaceList extends \CompleteLister{

	function formatRow(){
		$this->current_row['component_id']=$this->model->id;
		parent::formatRow();
	}

	function defaultTemplate(){
		$l=$this->api->locate('addons','epanListingApp', 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons','epanListingApp'),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);

		return array('view/marketplacelist');
	}
}