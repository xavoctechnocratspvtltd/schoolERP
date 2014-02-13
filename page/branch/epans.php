<?php

class page_branch_epans extends page_branch_base {
	function init(){
		parent::init();

		$this->api->stickyGET('epan_branch_epans_crud_grid_paginator_skip');
		$this->add('H1')->setHtml('Epans<small>Epans of your branch</small>');

		if($_GET['view']){
			$epan = $this->add('Model_Epan')->load($_GET['view']);
			$this->js()->univ()->frameURL($epan['name'],$this->api->url('epan',array('epan'=>$epan['name'])),array('width'=>'100%','height'=>$this->js()->_selectorWindow()->height()))->execute();
		}

		$epan_crud = $this->add('CRUD');
		$model = $this->add('Model_Epan')
						->addCondition('branch_id',$this->api->auth->model['branch_id'])
						->addCondition('staff_id',$this->api->auth->model->id);
		// $model->getElement('staff')->system(true);
		$model->getElement('branch')->system(true);
		$model->getElement('fund_alloted')->system(true);
		$model->getElement('company_name')->system(true);
		$model->getElement('last_email_sent')->system(true);
		$model->getElement('email_host')->system(true);
		$model->getElement('email_port')->system(true);
		$model->getElement('email_username')->system(true);
		$model->getElement('email_password')->system(true);
		$model->getElement('email_reply_to')->system(true);
		$model->getElement('email_reply_to_name')->system(true);
		$model->getElement('email_from')->system(true);
		$model->getElement('email_from_name')->system(true);
		$model->getElement('parked_domain')->system(true);
		$model->getElement('allowed_aliases')->system(true);
		$model->getElement('is_frontent_regiatrstion_allowed')->system(true);
		$model->getElement('user_activation')->system(true);
		if($model->hasElement('pay_to_company')){
		$model->getElement('pay_to_company')->display(array('form'=>'Readonly'));
		$model->getElement('grace_period_end_date')->display(array('form'=>'Readonly'));
		$model->getElement('last_paid_on')->display(array('form'=>'Readonly'));
			
		}

		$epan_crud->setModel($model);

		$aliases_crud = $epan_crud->addRef('Aliases');

		if($grid=$epan_crud->grid){
			$grid->controller->importField('created_at');

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
			$grid->columns['created_at']['thparam']='data-hide="all"';


			$grid->addMethod('format_aliases',function($grid,$field){
				$other_alaises = $grid->model->ref('Aliases')->addCondition('name','<>',$grid->model['name'])->tryLoadAny();
				$grid->current_row_html[$field] = $grid->current_row[$field]. "<br/><small>".$other_alaises['name']."</small>";
			});

			$grid->addMethod('format_contactperson',function($grid,$field){
				$grid->current_row_html[$field] = $grid->current_row[$field]. "<br/><small>".$grid->model['contact_person_name']."</small>";
			});

			$grid->addMethod('format_lastemail',function($grid,$field){
				$grid->current_row_html[$field] = $grid->current_row_html[$field]. "<br/><small>".$grid->model['last_email_sent']."</small>";
			});

			$grid->addFormatter('name','aliases');
			$grid->addFormatter('mobile_no','contactperson');

			$grid->addColumn('Button','view');
			$grid->addColumn('Button,lastemail','email');
			$grid->addOrder()->move('view','first')->now();
			if($_GET['email']){
				$epan=$this->add('Model_Epan');
				$epan->load($_GET['email']);
				$epan->sendEmail();
				$this->api->js()->univ()->successMessage('Email Sent')->execute();
			}

			$grid->addPaginator(20);
			$grid->addQuickSearch(array('name','contact_person_name','mobile_no','address','email_id'));

		}
	}
}