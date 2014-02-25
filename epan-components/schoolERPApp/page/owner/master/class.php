<?php
class page_schoolERPApp_page_owner_master_class extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	// $crud=$this->add('CRUD')->setModel('schoolERPApp/Master_Class');

	$class=$this->add('schoolERPApp/Model_Master_Class');
	$session=$class->join('schoolERPApp_session','schoolERPApp_session_id');
	$session->addField('session');
	$grid=$this->add('CRUD');
	$grid->setModel($class);
		
	}
}