<?php    
class page_schoolERPApp_page_owner_attendence extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	

	$col=$this->add('H3')->setAttr('align','center')->
        set('Attendence Detail');
    
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    
    $f=$co1->add('Form');
    $grid=$this->add('Grid');
   
   $co=$this->add('schoolERPApp/Model_School_Attendence');
   
   

        $b=$this->add('schoolERPApp/Model_School_Attendence');
        if($_GET['attendence_id']){
          $b->load($_GET['attendence_id']);
        }

        if($_GET['delete']){
          $b->load($_GET['delete'])->delete();
          $grid->js()->reload()->execute();
        }
        if($_GET['edit']){
          $f->js()->reload(array('attendence_id'=>$_GET['edit']))->execute();
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