<?php
class page_schoolERPApp_page_owner_student extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
$student=$this->add('schoolERPApp/Model_School_Student');
$grid=$this->add('CRUD');
$grid->setModel($student);

	
		

	}
}