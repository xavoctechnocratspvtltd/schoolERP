<?php
class page_schoolERPApp_page_owner_master_feedeposit extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$this->add('CRUD')->setModel('schoolERPApp/School_FeesDeposit');

		
	}
}
