<?php
class page_schoolERPApp_page_owner_master_category extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$crud=$this->add('CRUD');
	$crud->setModel('schoolERPApp/Master_Category');
		
	}
}