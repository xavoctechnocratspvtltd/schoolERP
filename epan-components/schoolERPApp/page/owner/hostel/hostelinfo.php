<?php
class page_schoolERPApp_page_owner_hostel_hostelinfo extends page_componentBase_page_owner_main{
	function page_index(){
	
		
	$col=$this->add('H3')->setAttr('align','center')->set('Hosteler Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    
    $hostel=$this->add('schoolERPApp/Model_Master_Hostel');
    $form=$co1->add('Form');
    $hostel_field=$form->addField('dropdown','hostel')->setEmptyText('----');
    
 	  

    $form->addSubmit('GetList');
    $student=$this->add('schoolERPApp/Model_Hostel_Hostelstudent');
    $crud=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
    $crud->setModel($student,array('name','class','Father_name','ph_number','current_address','city'));


    if($_GET['hostel_id'])
    	$student->addCondition('hostel_id',$_GET['hostel_id']);

    $hostel_field->setModel($hostel);
    if($crud->grid){
    $crud->grid->addQuickSearch(array('name'));
 }
    if($form->isSubmitted()){
    $crud->grid->js()->reload(array('hostel_id'=>$form->get('hostel')))->execute();
         }  

    if($crud->grid){

    $crud->grid->addColumn('expander','diseases');
 }
    
   }
    function page_diseases(){
      $this->api->stickyGET('schoolERPApp_student_id');
      $diseases=$this->add('schoolERPApp/Model_Hostel_Diseases');
      // $diseases->load($_GET['schoolERPApp_student_id']);
      $diseases->addCondition('student_id',$_GET['schoolERPApp_student_id']);
      $crud=$this->add('CRUD',array('allow_add'=>true,'allow_edit'=>true,'allow_del'=>true));
      $crud->setModel($diseases,array('name','treatment','start_date','end_name','is_active'));
     if($_GET['deactive']){
    if($crud->grid)
    $diseases->load($_GET['deactive']);
    $diseases['is_active']=!$diseases['is_active'];
    $diseases->save();
    $crud->grid->js()->reload()->execute();
        }
    if($crud->grid){
    $crud->grid->addColumn('button','deactive');
    }
   

    
    }
}
