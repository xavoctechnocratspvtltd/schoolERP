<?php

class page_owner_installedcomponents extends page_base_owner {
	function init(){
		parent::init();

		$this->add('H1')->setHTML('Installed Components <small>Your installed components</small>');

		$form= $this->add('Form');
		$form->addClass('stacked');
		$search_field = $form->addField('line','search_components','')->setAttr('placeholder','Search / Filter Your Installed Component');
		
		$installed_components = $this->add('Model_InstalledComponents');
		
		$installed_components->addCondition('epan_id',$this->api->auth->model->id);
		$installed_components->addCondition('type','<>','element');
		$installed_components->addCondition('is_system',false);

		if($_GET['search']){
			$installed_components->addCondition('name','like','%'.$_GET['search'].'%');
		}

		$mp = $this->add('componentList/View_InstalledComponents');
		$mp->setModel($installed_components);

		if($form->isSubmitted()){
			$mp->js()->reload(array(
					'search'=>$form['search_components']
				))->execute();
		}

	}
}