<?php
class page_schoolERPApp_page_owner_class extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
		$crud=$this->add('CRUD')->setModel('schoolERPApp/School_Class');
		
	}
}