<?php
class page_schoolERPApp_page_owner_exam_exams extends page_componentBase_page_owner_main{
	function page_index(){
		// parent::init();


	$col=$this->add('H3')->setAttr('align','center')->set('Hosteler Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    
    $class=$this->add('schoolERPApp/Model_Master_Class');
    $form=$co1->add('Form');
    $class_field=$form->addField('dropdown','class')->setEmptyText('----');
    
 	  

    $form->addSubmit('GetList');
    $student=$this->add('schoolERPApp/Model_School_Student');
    $crud=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
    $crud->setModel($student,array('name','class','Father_name','ph_number','current_address','city'));
    $crud->setModel($class);


    if($crud->grid){
    $crud->grid->addColumn('expander','exam');
    // $sub=$this->add('Model_Subject');
    }
   }
    function page_exam(){
      $this->api->stickyGET('class_id');
      $student=$this->add('schoolERPApp/Model_Exam_Exames');
      $student->addCondition('class_id',$_GET['schoolERPApp_class_id']);
      $grid=$this->add('CRUD',array('allow_add'=>true,'allow_edit'=>true,'allow_del'=>true));
      $grid->setModel($student);
 	
	}
}
		
	