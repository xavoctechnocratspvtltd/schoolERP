<?php
class page_schoolERPApp_page_owner_masterfees extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_master_fees','Fees');
	$tab->addTabURL('schoolERPApp_page_owner_master_feeshead','Fees Head');
	$tab->addTabURL('schoolERPApp_page_owner_master_class','Class');
	$tab->addTabURL('schoolERPApp_page_owner_student ','Student');
	$tab->addTabURL('schoolERPApp_page_owner_master_subject','Subject');	
	}
}