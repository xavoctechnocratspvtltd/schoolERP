<?php
class page_schoolERPApp_page_owner_hostel_hostelstudent extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	
		
	$col=$this->add('H3')->setAttr('align','center')->set('Hosteler Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    
    $class=$this->add('schoolERPApp/Model_Master_Class');
    $form=$co1->add('Form');
    $class_field=$form->addField('dropdown','class')->setEmptyText('----');
    
 	  

    $form->addSubmit('GetList');
    $hostel=$this->add('schoolERPApp/Model_Hostel_Hostelstudent');
    $grid=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
    $grid->setModel($hostel,array('name','Father_name','Mother_name','birth_date','current_address','ph_number','parmanent_address','phone_number','guardian_name','guardian_address'));


    if($_GET['class_id'])
    	$hostel->addCondition('schoolERPApp_class_id',$_GET['class_id']);
        


    $class_field->setModel($class);
    if($form->isSubmitted()){
    $grid->js()->reload(array('class_id'=>$form->get('class')))->execute();
         }  
 }
}
