<?php

class page_owner_applicationrepository extends page_base_owner {
	public $add_component_btn;
	function init(){
		parent::init();

		$this->add('H1')->setHtml('Epan Components Repository <small>Search and install from components available </small>');

		$this->add_component_btn = $this->add('componentList/View_AddComponentToRepository');
		//TODO keep the line below in single CMS
		 $this->add('Controller_EpanCMSApp')->ownerComponentRepository();

		$form= $this->add('Form');
		$form->addClass('stacked');
		$search_field = $form->addField('line','search_components','')->setAttr('placeholder','Search / Filter Component');
		
		$market_place = $this->add('Model_MarketPlace');

		$market_place->addCondition('type','<>','element');
		$market_place->addCondition('is_system',false);

		if($_GET['search']){
			$market_place->addCondition('name','like','%'.$_GET['search'].'%');
		}

		$mp = $this->add('componentList/View_MarketPlaceComponents');
		$mp->setModel($market_place);
		$mp->add('Paginator')->ipp(15);

		if($form->isSubmitted()){
			$mp->js()->reload(array(
					'search'=>$form['search_components']
				))->execute();
		}

	}
}