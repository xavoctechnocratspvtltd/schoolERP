<?php

class page_socialshareModule_page_install extends page_componentBase_page_install {
	
	function init(){
		parent::init();	
		$this_component = $this->add('Model_InstalledComponents');
		$this_component->addCondition('epan_id',$this->api->auth->model->id);
		$this_component->addCondition('component_id',$this->component_marketplace_id);

		$this_component->tryLoadAny();
		if($this_component->loaded()){
			$this->add('View_Error')->set('Component is already installed');
			return;
		}

		$this_component->save();
		$this->js(true,$this->js()->univ()->successMessage('Social Share Module Installed'))->univ()->redirect($this->api->url('owner_installedcomponents'));

	}
}