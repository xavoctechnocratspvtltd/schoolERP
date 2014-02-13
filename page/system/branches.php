<?php

class page_system_branches extends page_system_base {
	
	function init(){
		parent::init();

		$this->add('H1')->set('Your Branches');

		$branches_crud = $this->add('CRUD');
		$branches_crud->setModel('Branch'); 

	}
}