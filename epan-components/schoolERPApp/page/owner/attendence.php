<?php
class page_schoolERPApp_page_owner_attendence extends page_componentBase_page_owner_main{
	function init(){
		parent::init();

    // $this->add('CRUD')->setModel('schoolERPApp/School_Attendence');
		
	$col=$this->add('H3')->setAttr('align','center')->set('Attendence Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    
    $form=$co1->add('Form');
    $class=$this->add('schoolERPApp/Model_Master_Class');

    
    $class_field=$form->addField('dropdown','class')->setEmptyText('----');
    $month=$form->addField('dropdown','month')->setEmptyText('----');
    $month->setValueList(array('1'=>'Jan',
                            '2'=>'Feb',
                            '3'=>'March',
                            '4'=>'April',
                            '5'=>'May',
                            '6'=>'Jun',
                            '7'=>'July',
                            '8'=>'Augest',
                            '9'=>'Sep',
                            '10'=>'Oct',
                            '11'=>'Nov',
                            '12'=>'Dec'
                                        ));
    

    $att=$form->addField('line','Total_attendence');
    $form->addField('checkbox','change_total_attendance');
    $form->addSubmit('Go');
 	  

    $student=$this->add('schoolERPApp/Model_School_Student');
    $class1=$student->join('schoolERPApp_class','schoolERPApp_class_id');
    $class1->addField('section_name','section');
    $grid=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
    $grid->setModel($student,array('name','section_name','Father_name'));
    $grid->js()->reload();


    if($_GET['class_id'])
    $student->addCondition('schoolERPApp_class_id',$_GET['class_id']);
    
    $class_field->setModel($class);
    if($form->isSubmitted()){
    $grid->js()->reload(array('class_id'=>$form->get('class')))->execute();
         }  
}
}
