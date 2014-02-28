<?php    
class page_schoolERPApp_page_owner_attendence extends page_componentBase_page_owner_main{
	function init(){
		parent::init();


    // $this->add('CRUD')->setModel('schoolERPApp/School_Attendence');
		
	$col=$this->add('H3')->setAttr('align','center')->set('Attendence Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    
    $class=$this->add('schoolERPApp/Model_Master_Class');
    $form=$co1->add('Form');
    $class_field=$form->addField('dropdown','class')->setEmptyText('----');
    $month=$form->addField('dropdown','month')->setEmptyText('----');
    $month->setValueList(array('1'=>'January','2'=>'Feb',
                                                '3'=>'march',
                                                '4'=>'april',
                                                '5'=>'may',
                                                '6'=>'june',
                                                '7'=>'july',
                                                 '8'=>'aug',
                                                 '9'=>'sep',
                                                 '10'=>'oct',
                                                 '11'=>'nov',
                                                 '12'=>'dec',


     ));



    $att=$form->addField('line','Total_attendence');
    $form->addField('checkbox','change_total_attendance');
    $form->addSubmit('Go');
 	  

    $student=$this->add('schoolERPApp/Model_School_Student');
   $class1=$student->join('schoolERPApp_class','schoolERPApp_class_id');
   $class1->addField('section_name','section');
    $grid=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
   $grid->setModel($student,array('name','section_name'));


    if($_GET['class_id'])
    	$student->addCondition('schoolERPApp_class_id',$_GET['class_id']);
        


    $class_field->setModel($class);
    if($form->isSubmitted()){
    $grid->js()->reload(array('class_id'=>$form->get('class')))->execute();
         }  
 


}
 }  