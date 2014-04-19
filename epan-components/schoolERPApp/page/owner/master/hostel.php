<?php
class page_schoolERPApp_page_owner_master_hostel extends page_componentBase_page_owner_main{
	function page_index(){
		// parent::init();

	$crud=$this->add('CRUD');
	$crud->setModel('schoolERPApp/Master_Hostel');
	
	if($crud->grid){

	$crud->grid->addColumn('expander','addroom');
	}
		
	}
	function page_addroom(){
		$this->api->stickyGET('schoolERPApp_hostel_id');
		$room=$this->add('schoolERPApp/Model_Hostel_Room');
		$room->addCondition('hostel_id',$_GET['schoolERPApp_hostel_id']);
		$crud=$this->add('CRUD');
		$crud->setModel($room);
	}
}