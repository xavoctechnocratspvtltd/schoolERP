<?php

class page_schoolERPApp_page_owner_main extends page_componentBase_page_owner_main{
function init(){
	parent::init();
	// $menu=$this->add('Menu',null);
    $tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_mastermenues','Master');
    $tab->addTabURL('schoolERPApp_page_owner_schoolmenues','School');
    $tab->addTabURL('schoolERPApp_page_owner_hostelmenues','Hostel');
    $tab->addTabURL('schoolERPApp_page_owner_staffmenues','Staff');
}
}
