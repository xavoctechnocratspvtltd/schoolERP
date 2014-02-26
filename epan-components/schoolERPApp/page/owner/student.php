<?php
class page_schoolERPApp_page_owner_student extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
$this->add('H3')->setHTML('<center>Student Admission Form</center>');
$crud=$this->add('CRUD');
$crud->setModel('schoolERPApp/School_Student');

	// $form->update();
		

}
}