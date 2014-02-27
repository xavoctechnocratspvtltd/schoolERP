<?php
class page_schoolERPApp_page_owner_attendence extends page_componentBase_page_owner_main{
	function init(){
		parent::init();

    // $this->add('CRUD')->setModel('schoolERPApp/School_Attendence');
		
	$col=$this->add('H3')->setAttr('align','center')->set('Attendence Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    
    $form=$co1->add('Form');
    $class_field=$form->addField('dropdown','class')->setEmptyText('----');
    $class=$this->add('schoolERPApp/Model_Master_Class');
    $month=$form->addField('dropdown','month')->setEmptyText('----');
    $month->setValueList(array('1'=>'January','2'=>'Feb',));

    $att=$form->addField('line','Total_attendence');
    $form->addField('checkbox','change_total_attendance');
    $form->addSubmit('Go');
 	  

    $grid=$this->add('Grid');
    $student=$this->add('schoolERPApp/Model_School_Student');
    // $student->_dsql()->del('order');//->order('name','asc');
    $grid->setModel($student,array('name','gender'));
    // $grid->addClass('reloadable');
    $grid->js()->reload();
    // $grid->js('reloadme',$grid->js()->reload());


    if($_GET['class_id'])
    	$student->addCondition('schoolERPApp_class_id',$_GET['class_id']);

        $b=$this->add('schoolERPApp/Model_School_Attendence');
        if($_GET['attendence_id']){
          $b->load($_GET['attendence_id']);
        }

        if($_GET['delete']){
          $b->load($_GET['delete'])->delete();
          $grid->js()->reload()->execute();
        }
        if($_GET['edit']){
          $form->js()->reload(array('attendence_id'=>$_GET['edit']))->execute();
        }
    $grid->setModel($student);
    $class_field->setModel($class);
    $grid->addColumn('Button','edit');
    $grid->addColumn('Confirm','delete');
    if($form->isSubmitted()){
    $grid->js()->reload(array('class_id'=>$form->get('class')))->execute();
         }  
}
}   