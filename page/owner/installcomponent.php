<?php

class page_owner_installcomponent extends page_base_owner {

	function page_index(){
		$this->api->stickyGET('component_id');

		$component = $this->add('Model_MarketPlace')->load($_GET['component_id']);
		$this->setModel($component);
		
		if(is_file($path = getcwd().'/epan-components/'.$component['namespace'].'/templates/view/'.$component['namespace'].'-about.html')){
			$l=$this->api->locate('addons',$component['namespace'], 'location');
			$this->api->pathfinder->addLocation(
			$this->api->locate('addons',$component['namespace']),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);

			$about_component = $this->add('View',null,null,array('view/'.$component['namespace'].'-about'));
		}

		if( $this->add('Model_InstalledComponents')
			->addCondition('epan_id',$this->api->auth->model->id)
			->addCondition('component_id',$component->id)
			->tryLoadAny()
			->loaded())
		{
			// Component is installed
			$this->add('View')->set('Component Already Installed')->addClass('alert')->addClass('alert-success');
		}else{
			// Component is not installed
			$this->add('Button')->set('Install')->js('click')->univ()->frameURL('Install ???',$this->api->url($component['namespace'].'_page_install'));
		}

	}

	function defaultTemplate(){
		return array('owner/installcomponent');
	}
}