<?php

class page_system_allepans extends page_system_base {
	function init(){
		parent::init();

		$this->api->stickyGET('epan_branch_epans_crud_grid_paginator_skip');
		$this->add('H1')->setHtml('Epans<small>Epans From All Branches</small>');

		if($_GET['view']){
			$epan = $this->add('Model_Epan')->load($_GET['view']);
			$this->js()->univ()->frameURL($epan['name'],$this->api->url('epan',array('epan'=>$epan['name'])),array('width'=>'100%','height'=>$this->js()->_selectorWindow()->height()))->execute();
		}

		$epan_crud = $this->add('CRUD');
		$model = $this->add('Model_Epan');
			// ->addCondition('branch_id',$this->api->auth->model['branch_id']);
		
		// $model->getElement('staff')->system(true);
		// $model->getElement('branch')->system(true);
		$model->getElement('fund_alloted')->system(true);
		$model->getElement('company_name')->system(true);
		$model->getElement('last_email_sent')->system(true);
		
		$epan_crud->setModel($model);

		$aliases_crud = $epan_crud->addRef('Aliases');

		if($grid=$epan_crud->grid){
			$grid->js(true)->_load('footable')->_selector('#'.$grid->name.' table')->footable();
			$this->api->jquery->addStyleSheet('footable.core');
			$grid->columns['category']['thparam']='data-hide="all"';
			$grid->columns['password']['thparam']='data-hide="all"';
			$grid->columns['contact_person_name']['thparam']='data-hide="all"';
			$grid->columns['is_approved']['thparam']='data-hide="all"';
			$grid->columns['city']['thparam']='data-hide="all"';
			$grid->columns['address']['thparam']='data-hide="all"';
			$grid->columns['state']['thparam']='data-hide="all"';
			$grid->columns['country']['thparam']='data-hide="all"';
			$grid->columns['email_id']['thparam']='data-hide="all"';
			$grid->columns['website']['thparam']='data-hide="all"';
			$grid->columns['keywords']['thparam']='data-hide="all"';
			$grid->columns['description']['thparam']='data-hide="all"';
			$grid->columns['allowed_aliases']['thparam']='data-hide="all"';

			$grid->addPaginator(20);
			$grid->addQuickSearch(array('name'));

			$grid->addColumn('Button','view');
			$grid->addOrder()->move('view','first')->now();
		}
	}
}