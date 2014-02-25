<?php
class page_schoolERPApp_page_owner_student extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
$this->add('H3')->setHTML('<center>Student Admission Form</center>');
$col=$this->add('Columns');
$col1=$col->addColumn(6);
$form=$col1->add('Form');
$form->setModel('schoolERPApp/School_Student');
$form->addSubmit('SAVE');
if($form->isSubmitted()){
	$form->js()->reload()->execute();
}
}
}