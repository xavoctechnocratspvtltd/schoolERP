<?php
class page_system_base extends Page {
	function init(){
		parent::init();

		$staff = $this->add('Model_Staff');
		$staff_branch_j = $staff->join('branch','branch_id');
		$staff_branch_j->addField('branch_name','name');
		$staff->addCondition('branch_name','Default');

		$this->api->auth->setModel( $staff ,'username','password');
		$this->api->auth->check();

		$this->add('H1')->setHTML('Welcome to Epan System <small>'.$this->api->auth->model['name'].'</small>');

		$menu=$this->add('Menu');
		$menu->addMenuItem('system_dashboard','Dashboard');
		$menu->addMenuItem('system_branches','Branches');
		$menu->addMenuItem('system_allepans','All Epans');
		$menu->addMenuItem('system_applicationrepository','MarketPlace');
		$menu->addMenuItem('system_logout','Logout');
	}

	function render(){
		$this->api->jquery->addStaticStyleSheet('epan');
		$this->api->jquery->addStaticStyleSheet('../admintemplate/font-awesome/css/font-awesome.min');
		parent::render();
	}
}