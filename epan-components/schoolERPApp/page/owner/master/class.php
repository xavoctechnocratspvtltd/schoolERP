<?php
class page_schoolERPApp_page_owner_master_class extends page_componentBase_page_owner_main{
  function page_index(){

    $col=$this->add('Columns');
    $col1=$col->addColumn(6);
    // $this->api->stickyGET('class_id');
    // $form=$col1->add('Form');
    $class=$this->add('schoolERPApp/Model_Master_Class');
    // $form->setModel($class);
    $crud=$this->add('CRUD');
    $crud->setModel($class);
    

    // $grid->addColumn('Button','edit');
    // $grid->addColumn('expander','student');
    // $grid->addColumn('confirm','delete');


  //   if($_GET['class_id']){
  //     $class->load($_GET['class_id']);
  //       }

  //   if($_GET['delete']){
  //     $class->load($_GET['delete'])->delete();
  //     $grid->js()->reload()->execute();

  //       }

        
  //   if ($_GET['edit']) {
  //   $form->js()->reload(array('class_id'=>$_GET['edit']))->execute();
  //       }




  //   $form->addSubmit('SAve');
  //   if($form->isSubmitted()){
  //     $form->update();
  //     $form->js(null,$grid->js()->reload())->reload()->execute();
  //   }

  // }
    // function page_student(){
    //   $this->api->stickyGET('class_id');
    //   $student=$this->add('schoolERPApp/Model_School_Student');
    //   $student->addCondition('schoolERPApp_class_id',$_GET['class_id']);
    //   $grid=$this->add('Grid');
    //   $grid->setModel($student);

    }
}    
  

    