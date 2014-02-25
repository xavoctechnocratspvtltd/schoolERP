<?php
class page_schoolERPApp_page_owner_masterstaff extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_staff_staff','Staff');
	$tab->addTabURL('schoolERPApp_page_owner_staff_work','Work');
	$tab->addTabURL('schoolERPApp_page_owner_attendence','Attendence');
	$tab->addTabURL('schoolERPApp_page_owner_master_class','Class');
	$tab->addTabURL('schoolERPApp_page_owner_master_subject','Subject');
	//yaha par teacher ki selery ka page add karna he..or uska field me b kam karna baki he..
	}
}