<?php
class page_schoolERPApp_page_owner_hostel_hostelstudent extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	// $grid=$this->add('Grid')->setModel('schoolERPApp/Hostel_Hostelstudent');
		



	
	$col=$this->add('H3')->setAttr('align','center')->set('Hostler Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    $form=$co1->add('Form');
    $class=$this->add('schoolERPApp/Model_Master_Class');
    $class_field=$form->addField('dropdown','class')->setEmptyText('----');

    $form->addSubmit('GetList');
 	$hostel=$this->add ('schoolERPApp/Model_Hostel_Hostelstudent');
    $grid=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
    $grid->setModel($hostel,array('name','Father_name'));

    // $student=$this->add('schoolERPApp/Model_School_Student');
    // $class1=$student->join('schoolERPApp_class','schoolERPApp_class_id');
    // $class1->addField('section_name','section');
    $grid->js()->reload();


    if($_GET['class_id'])
    $hostel->addCondition('schoolERPApp_class_id',$_GET['class_id']);
    
    $class_field->setModel($class);
    if($form->isSubmitted()){
    $grid->js()->reload(array('class_id'=>$form->get('class')))->execute();
         }  
}
}

