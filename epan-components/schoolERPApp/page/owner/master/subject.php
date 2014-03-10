<?php
class page_schoolERPApp_page_owner_master_subject extends page_componentBase_page_owner_main{
	function init(){
		parent::init();


	$sub=$this->add('schoolERPApp/Model_Master_Subject');
	$class=$sub->join('schoolERPApp_class','schoolERPApp_class_id');
	$crud=$this->add('CRUD');//,array('allow_del'=>false,'allow_edit'=>false,'allow_add'=>false));
	$crud->setModel($sub);//,array('class_name','name','code'));
	
		
	}
}