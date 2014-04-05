<?php
class page_schoolERPApp_page_owner_staff_hostelstaff extends page_componentBase_page_owner_main{
	
	function init(){
		parent::init();

	$this->add('H1')->setHtml('<center>Staff Movment</center>');
	$staff=$this->add('schoolERPApp/Model_Staff_Staff');
	$crud=$this->add('CRUD',array('allow_add'=>false,
		'allow_edit'=>false,'allow_del'=>false));
	$crud->setModel($staff,array('name','designation','ph_number','current_address','is_active'));

	if($_GET['deactive']){

    if($crud->grid)
    $staff->load($_GET['deactive']);
    $staff['is_active']=!$staff['is_active'];
    $staff->save();
    $crud->grid->js()->reload()->execute();
        }
    if($crud->grid){
    $crud->grid->addColumn('button','deactive');
    }
   
		
	}
}