<?php
class page_schoolERPApp_page_owner_master_class extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	// $crud=$this->add('CRUD');
	// $crud->setModel('schoolERPApp/Master_Class');

	// $class=$this->add('schoolERPApp/Model_Master_Class');
	// $session=$class->join('schoolERPApp_session','schoolERPApp_session_id');
	// $session->addField('session');
	// $grid=$this->add('CRUD');
	// $grid->setModel($class);


    $col=$this->add('H3')->setAttr('align','center')->
        set('Class Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    $f=$co1->add('Form');
    //$f=$this->api->add('HtmlElement',null,'logo')->setElement('img')->setAttr('src','books.jpg')->setAttr('width','150px');
    //$this->add('Tabs');
   $co=$this->add('schoolERPApp/Model_Master_Class');
   $session=$co->join('schoolERPApp_session','schoolERPApp_session_id');
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
    $f->addSubmit('update');
    
    $grid->setModel($co);
    $grid->addColumn('Button','edit');
    $grid->addColumn('Confirm','delete');
         if($f->isSubmitted()){
          $f->update();
          $f->js(null,$grid->js()->reload())->reload()->execute();
         }  
        

   }
   }   
  
