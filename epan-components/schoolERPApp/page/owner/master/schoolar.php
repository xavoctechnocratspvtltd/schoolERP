<?php
class page_schoolERPApp_page_owner_master_schoolar extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$schoolar=$this->add('schoolERPApp/Model_Master	_Schoolar');
// $class=$schoolar->join('schoolERPApp_class','schoolERPApp_class_id');
$this->add('H3')->setHTML('<center>Schoolar</center>');
//$crud=$this->add('CRUD',array('allow_add'=>true,'allow_edit'=>true,'allow_del'=>true));
//$crud->setModel($schoolar);
if($crud->grid)
{
$crud->grid->addQuickSearch(array('name'));
}


	
		

}
}
