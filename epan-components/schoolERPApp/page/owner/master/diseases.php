<?php
class page_schoolERPApp_page_owner_master_diseases extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$crud=$this->add('CRUD')->setModel('schoolERPApp/Master_Diseases');
		
	}
}