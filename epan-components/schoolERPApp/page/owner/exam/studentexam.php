<?php
class page_schoolERPApp_page_owner_exam_studentexams extends page_componentBase_page_owner_main{
	function page_index(){
		// parent::init();


	$exam=$this->add('schoolERPApp/Model_Exam_Exames');

	$crud=$this->add('CRUD');
	$crud->setModel($exam);
    
	
	}
}
		
	