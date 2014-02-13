<?php

class page_componentBase_page_install extends Page {
	
	public $component_marketplace_id;

	function install(){


		$this_class  = get_class($this);
		preg_match("/page_(.*)_page_(.*)/", $this_class,$namespace);

		$marketplace = $this->add('Model_MarketPlace');
		$marketplace->addCondition('namespace',$namespace[1]);
		$marketplace->tryLoadAny();

		$this->component_marketplace_id = $marketplace->id;

		$this_component = $this->add('Model_InstalledComponents');
		$this_component->addCondition('epan_id',$this->api->auth->model->id);
		$this_component->addCondition('component_id',$this->component_marketplace_id);

		$this_component->tryLoadAny();
		if($this_component->loaded()){
			$this->add('View_Error')->set('Component is already installed');
			return;
		}

		$this_component->save();
		$this->js(true,$this->js()->univ()->successMessage($this_component['name'].' Application Installed'))->univ()->redirect($this->api->url('owner_installedcomponents'));


	}
}