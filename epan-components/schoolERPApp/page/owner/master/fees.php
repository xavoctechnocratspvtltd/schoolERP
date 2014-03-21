<?php
class page_schoolERPApp_page_owner_master_fees extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	// $crud=$this->add('CRUD')->setModel('schoolERPApp/Master_Fees');
		
	$col=$this->add('Columns');
    $col1=$col->addColumn(6);
    $class=$this->add('schoolERPApp/Model_Master_Fees');
    // $class_field=$class->join('schoolERPApp_session','session_id');
    // $class_field->addField('session_name','Session')->type('readonly');
    $crud=$this->add('CRUD');
    $crud->setModel($class);

 //    if($crud->grid){
 //    $crud->grid->addColumn('expander','class');
    
	// }

	// function page_class(){
 //    $this->api->stickyGET('fees_id');
 //    $student=$this->add('schoolERPApp/Model_Master_Class');
 //    $student->addCondition('fees_id',$_GET['schoolERPApp_fees_id']);
 //      // $grid=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
 //    $crud=$this->add('CRUD');
 //    $crud->setModel($student);
 //      // $grid->setModel($student,array('name','gender','Father_name','phone_number'));

 //    }
}
}