<?php
class page_schoolERPApp_page_owner_masterschool extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_attendence','Attendence');
	// $tab->addTabURL('schoolERPApp_page_owner_master_schoolar','Schoolar');
	}
}