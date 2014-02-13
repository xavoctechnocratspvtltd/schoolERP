<?php

class page_simpleImageGallaryApp_page_owner_main extends page_componentBase_page_owner_main {
	function page_index(){
		// parent::init();

		$my_gallaries = $this->add('simpleImageGallaryApp/Model_Gallaries');
		$my_gallaries->addCondition('epan_id',$this->api->auth->model->id);


		$gallary_crud = $this->add('CRUD');
		$gallary_crud->setModel($my_gallaries);

		$gallary_crud->addRef('simpleImageGallaryApp/Images',array('label'=>'Images'));
		if($g=$gallary_crud->grid){
			$g->controller->importField('id');
			$g->addColumn('Expander','config');
			$g->addOrder()->move('id','first')->now();
		}
	}


	function page_config(){
		$this->api->stickyGET('simpleImageGallaryApp_gallaries_id');
		$galary_m = $this->add('simpleImageGallaryApp/Model_Gallaries')
			->addCondition("id",$_GET['simpleImageGallaryApp_gallaries_id']);
		$galary_m->tryLoadAny();
		if(!$galary_m->loaded()){
			$galary_m->save();
		} 
		$form = $this->add('Form');
		$form->setModel($galary_m->ref('simpleImageGallaryApp/Config')->tryLoadAny());
		$form->addSubmit('Update');

		if($form->isSubmitted()){
			$form->update();
			$form->js()->univ()->successMessage("Config Updated")->execute();
		}
	}
}