<?php    
class page_schoolERPApp_page_owner_attendence extends page_componentBase_page_owner_main{
	function page_index(){

    $c=$this->add('schoolERPApp/Model_Master_Class');
    $s=$this->add('schoolERPApp/Model_School_Student');
    $sc=$this->add('schoolERPApp/Model_School_Student');
    // ,null,null,array('form_horizontal')
    
    $col=$this->add('H3')->setAttr('align','center')->set('Exams Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    
    $form=$co1->add('Form');
    $field_class=$form->addField('dropdown','class')->setEmptyText('----');
    $field_class->setModel($c);

    if($_GET['class_id']){
      $s->addCondition('class_id',$_GET['class_id']);
    }

    $field_student=$form->addField('dropdown','student')->setEmptyText('----');
    // $s->setOrder('fname','asc');
    $field_student->setModel($s);

    $field_class->js('change',$form->js()->atk4_form('reloadField','student',array($this->api->url(),'class_id'=>$field_class->js()->val())));
    $form->addSubmit('GetList');

    $grid=$this->add('Grid');


    if($_GET['filter']){
      if($_GET['class']) $sc->addCondition('class_id',$_GET['class']);
      if($_GET['student']) $sc->addCondition('id',$_GET['student']);
    }else{
      $sc->addCondition('class_id',-1);
    }
    $grid->setModel($sc,array('name','gender','class','Father_name'));
    // $grid->addColumn('Expander','deposit','Fee Deposit');
    // $grid->addFormatter('father_name','hindi');

    if($form->isSubmitted()){
      $grid->js()->reload(array("class"=>$form->get('class'),
                    "student"=>$form->get('student'),
                    "filter"=>1))->execute();

    }

     $grid->addColumn('expander','attendence');
 }

    
   
    function page_attendence(){
      $this->api->stickyGET('schoolERPApp_student_id');
      $marks=$this->add('schoolERPApp/Model_School_Attendence');
      $marks->addCondition('student_id',$_GET['schoolERPApp_student_id']);
      $grid=$this->add('CRUD',array('allow_add'=>true,'allow_edit'=>true,'allow_del'=>true));
      $grid->setModel($marks);

    }
}

