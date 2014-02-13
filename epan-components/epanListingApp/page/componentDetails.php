<?php

class page_epanListingApp_page_componentDetails extends Page {
	function init(){
		parent::init();
		$this->api->stickyGET('component_market_place_id');
		$component = $this->add('Model_MarketPlace');
		$component->load($_GET['component_market_place_id']);

		if(file_exists('epan-addons/'.$component['namespace'].'/templates/view/'.$component['namespace'].'-about.html')){
			$l=$this->api->locate('addons',$component['namespace'], 'location');
				$this->api->pathfinder->addLocation(
					$this->api->locate('addons',$component['namespace']),
					array(
				  		'template'=>'templates',
				  		'css'=>'templates/css'
						)
					)->setParent($l);

			$this->add('View',null,null,array('view/'.$component['namespace'].'-about'));
		}else{
			$this->add('View')->set($component['description']);
		}


	}
}