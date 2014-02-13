<?php

class page_visitorCounterApp_page_owner_main extends page_componentBase_page_owner_main{
	function init(){
		parent::init();

		$config_m= $this->add('visitorCounterApp/Model_Config');
		$config_m->addCondition('epan_id',$this->api->auth->model->id);
		$config_m->tryLoadAny();

		if(!$config_m->loaded()){
			// Using here first time so create a row
			$config_m->save();
		}

		$this->add('H1')->setHTML('Visitor Counter Config<small>Manage your config here</small>');
		$form= $this->add('Form');
		$form->setModel($config_m);
		$form->addSubmit('Update');
		
		if($form->isSubmitted()){
			$form->update();
			$form->js()->univ()->successMessage("Configuration Updated")->execute();
		}
	}
}