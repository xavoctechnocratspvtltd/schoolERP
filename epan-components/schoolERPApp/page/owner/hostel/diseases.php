<?php
class page_schoolERPApp_page_owner_hostel_diseases extends page_componentBase_page_owner_main{
	function page_index(){
		// parent::init();

	$diseases=$this->add('schoolERPApp/Model_Hostel_CurrentDiesases');

	$crud=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
	 $crud->setModel($diseases);
    
	
	}
}
		
	