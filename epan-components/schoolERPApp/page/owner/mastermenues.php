<?php
class page_schoolERPApp_page_owner_mastermenues extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	
	$this->add('View')->setHTML('<h3><center>Master Entry</center><h3>')->setStyle('color','blue');

	$tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_master_session','Session');
	$tab->addTabURL('schoolERPApp_page_owner_master_schoolar','Schoolar');
	$tab->addTabURL('schoolERPApp_page_owner_master_class','Class');
	$tab->addTabURL('schoolERPApp_page_owner_master_subject','Subject');
	$tab->addTabURL('schoolERPApp_page_owner_master_hostel','Hostel');
	$tab->addTabURL('schoolERPApp_page_owner_master_category','Category');
	$tab->addTabURL('schoolERPApp_page_owner_master_category','CategoryType');
	$tab->addTabURL('schoolERPApp_page_owner_master_feeshead','FeesHead');
	$tab->addTabURL('schoolERPApp_page_owner_master_fees','Fees');
	$tab->addTabURL('schoolERPApp_page_owner_master_item','Item');
	$tab->addTabURL('schoolERPApp_page_owner_master_party','Party');
	
	}
}