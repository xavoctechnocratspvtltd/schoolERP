<?php    
class page_schoolERPApp_page_owner_attendence extends page_componentBase_page_owner_main{
	function init(){
		parent::init();


		
	$col=$this->add('H3')->setAttr('align','center')->set('Attendence Detail');
    $col=$this->add('Columns');
    $co1=$col->addColumn(6);
    
    $class=$this->add('schoolERPApp/Model_Master_Class');
    $form=$co1->add('Form');
    $class_field=$form->addField('dropdown','class')->setEmptyText('----');
      
    $student=$this->add('schoolERPApp/Model_School_Student');
    $crud=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
    $crud->setModel($student,array('name'));
    $form->addSubmit('Go');
    
    if($_GET['class_id'])
        $student->addCondition('class_id',$_GET['class_id']);
        
    $class_field->setModel($class);


    if($crud->grid){

    $crud->grid->addQuickSearch(array('name'));

        }
    
    if($form->isSubmitted()){
        // $form->update();
    $crud->grid->js()->reload(array('class_id'=>$form->$_GET['class_id']))->execute();
          // $f->js(null,$grid->js()->reload())->reload()->execute();

         }  



         
    }
}






       

       