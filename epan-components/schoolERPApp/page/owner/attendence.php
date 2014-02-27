<?php
class page_schoolERPApp_page_owner_attendence extends page_componentBase_page_owner_main{
	function init(){
		parent::init();

    $this->add('CRUD')->setModel('schoolERPApp/School_Attendence');
		
// 	$col=$this->add('H3')->setAttr('align','center')->set('Attendence Detail');
//     $col=$this->add('Columns');
//     $co1=$col->addColumn(6);
    
//     $form=$co1->add('Form');
//     $class=$form->addField('dropdown','class')->setEmptyText('----');
//     $col=$this->add('schoolERPApp/Model_Master_Class');
//     $month=$form->addField('dropdown','month')->setEmptyText('----');
//     $month->setValueList(array('1'=>'January','2'=>'Feb',));

//     $att=$form->addField('line','Total_attendence');
//     $form->addField('checkbox','change_total_attendance');
//     $form->addSubmit('Go');
 	

//     $grid=$this->add('Grid');

//         $b=$this->add('schoolERPApp/Model_School_Attendence');
//         if($_GET['attendence_id']){
//           $b->load($_GET['attendence_id']);
//         }

//         if($_GET['delete']){
//           $b->load($_GET['delete'])->delete();
//           $grid->js()->reload()->execute();
//         }
//         if($_GET['edit']){
//           $form->js()->reload(array('attendence_id'=>$_GET['edit']))->execute();
//         }
//     $grid->setModel($col);
//     $class->setModel($col);
//     $grid->addColumn('Button','edit');
//     $grid->addColumn('Confirm','delete');
//          if($form->isSubmitted()){
//         $atten=$this->add('schoolERPApp/Model_School_Attendence');
//         //$atten->addCondition('class_id',$form->get('class'));
//         $atten->addCondition('month',$form->get('month'));
//           $form->go();
//           $form->js(null,$grid->js()->reload())->reload()->execute();
//          }  
        
}
}   