<?php
class page_schoolERPApp_page_owner_student extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
$student=$this->add('schoolERPApp/Model_School_Student');
// $class=$student->join('schoolERPApp_class','schoolERPApp_class_id');
// $class->addField('section_name','section');
// $this->add('H3')->setHTML('<center>Student Admission Detail</center>');
$grid=$this->add('CRUD');//array('allow_add'=>true,'allow_edit'=>true,'allow_del'=>true));
$grid->setModel($student);

	// $form->update();
		

}
}