<?php

class page_branch_configuration extends page_branch_base {
	function init(){
		parent::init();
		$current_branch = $this->api->auth->model->ref('branch_id');
		$current_branch->getElement('name')->display(array('form'=>'Readonly'));
		$current_branch->getElement('points')->display(array('form'=>'Readonly'));
		$current_branch->getElement('created_at')->system(true);

		$this->add('H1')->setHTML('Your Branch <small>Since '.$current_branch['created_at'].'</small>');

		$tabs = $this->add('Tabs');
		$branch_info_tab = $tabs->addTab('Branch Info');

		$branch_info_form = $branch_info_tab->add('Form');
		$branch_info_form->setModel($current_branch);
		$branch_info_form->addField('Readonly','used_points')->set($current_branch['epans_count']);

		$branch_info_form->addSubmit('Update');
		if($branch_info_form->isSubmitted()){
			$branch_info_form->update();
			$branch_info_form->js()->univ()->successMessage('Information Updated')->execute();
		}

	}
}