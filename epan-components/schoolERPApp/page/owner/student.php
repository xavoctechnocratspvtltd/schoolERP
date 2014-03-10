<?php
class page_schoolERPApp_page_owner_student extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
$student=$this->add('schoolERPApp/Model_School_Student');
$class=$student->join('schoolERPApp_class','schoolERPApp_class_id');
$this->add('H3')->setHTML('<center>Student Admission Detail</center>');
$crud=$this->add('CRUD',array('allow_add'=>true,'allow_edit'=>true,'allow_del'=>true));
$crud->setModel($student);
if($crud->grid)
{
$crud->grid->addQuickSearch(array('name'));
}


	
		

}
}