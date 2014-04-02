<?php
class page_schoolERPApp_page_owner_hostel_hostelstudent extends page_componentBase_page_owner_main{
	function page_index(){
	
		
	 $col=$this->add('H3')->setAttr('align','center')->set('Hosteler Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    
    $class=$this->add('schoolERPApp/Model_Master_Class');
    $form=$co1->add('Form');
    $class_field=$form->addField('dropdown','class')->setEmptyText('----');
    
 	  

    $form->addSubmit('GetList');
    $hostel=$this->add('schoolERPApp/Model_Hostel_Hostelstudent');
    $crud=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
    $crud->setModel($hostel,array('name','Father_name','Mother_name','birth_date','current_address','ph_number','parmanent_address','city','hostel'));


    if($_GET['class_id'])
    	$hostel->addCondition('class_id',$_GET['class_id']);

    $class_field->setModel($class);
 if($crud->grid){
    $crud->grid->addQuickSearch(array('name'));
 }
    if($form->isSubmitted()){
    $crud->grid->js()->reload(array('class_id'=>$form->get('class')))->execute();
         }  

 if($crud->grid){

    $crud->grid->addColumn('expander','garudian');
 }
    
   }
    function page_garudian(){
      $this->api->stickyGET('schoolERPApp_student_id');
      $garudian=$this->add('schoolERPApp/Model_Hostel_Gaurdian');
      $garudian->addCondition('student_id',$_GET['schoolERPApp_student_id']);
      $grid=$this->add('CRUD',array('allow_add'=>true,'allow_edit'=>true,'allow_del'=>true));
      $grid->setModel($garudian,array('name','name1','name2','address','contact_num'));

    }
}    
        


