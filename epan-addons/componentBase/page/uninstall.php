<?php

class page_componentBase_page_uninstall extends Page {
	
	public $component_marketplace_id;
	public $installed_component_id;

	function init(){
		parent::init();

		$this_class  = get_class($this);
		preg_match("/page_(.*)_page_(.*)/", $this_class,$namespace);

		$marketplace = $this->add('Model_MarketPlace');
		$marketplace->addCondition('namespace',$namespace[1]);
		$marketplace->tryLoadAny();

		$this->component_marketplace_id = $marketplace->id;

		$component_installed = $this->add('Model_InstalledComponents');
		$component_installed->addCondition('epan_id',$this->api->auth->model->id);
		$component_installed->addCondition('component_id',$this->component_marketplace_id);
		$component_installed->tryLoadAny();

		if(!$component_installed->loaded()){
			throw $this->exception('Component is not Installed')->addMoreInfo('Component',$namespace[1]);
		}

		$this->installed_component_id = $component_installed->id;

		if($this->api->current_website['name'] == 'demo'){
			$this->add('View_Error')->set('You Cannot Un-install any component from demo epan !!!');
			throw $this->exception('','StopInit');
		}

		$component_installed->delete();
		$this->js(true,$this->js()->univ()->successMessage($component_installed['name'].' Application UnInstalled'))->univ()->redirect($this->api->url('owner_installedcomponents'));
	}
}