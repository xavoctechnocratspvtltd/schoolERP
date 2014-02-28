<?php
class page_schoolERPApp_page_owner_master_class extends page_componentBase_page_owner_main{
	function init(){
		parent::init();

	

    $col=$this->add('H3')->setAttr('align','center')->
        set('Class Detail');
    
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    $this->api->stickyGET('class_id');
    $f=$co1->add('Form');


  $class=$this->add('schoolERPApp/Model_Master_Class');
   $session=$class->join('schoolERPApp_session','schoolERPApp_session_id');
   $session->addField('session');
    $grid=$this->add('Grid');
        
   $b=$this->add('schoolERPApp/Model_Master_Class');
        if($_GET['class_id']){
          $b->load($_GET['class_id']);
        }

        if($_GET['delete']){
          $b->load($_GET['delete'])->delete();
          $grid->js()->reload()->execute();
        }
        if($_GET['edit']){
          $f->js()->reload(array('class_id'=>$_GET['edit']))->execute();
        }
    $f->setModel($b);
    
    $grid->setModel($class);
    $grid->addColumn('Button','edit');
    $grid->addColumn('Confirm','delete');
    $f->addSubmit('update');
         if($f->isSubmitted()){
          $f->update();
          $f->js(null,$grid->js()->reload())->reload()->execute();
         }  
        

   }
   }   
  
