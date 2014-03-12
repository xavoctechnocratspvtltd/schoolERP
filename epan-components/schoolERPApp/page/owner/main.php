<?php

class page_schoolERPApp_page_owner_main extends page_componentBase_page_owner_main{
function init(){
	parent::init();
	// $menu=$this->add('Menu',null);
    $tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_master','Master');
    $tab->addTabURL('schoolERPApp_page_owner_masterschool','School');
    $tab->addTabURL('schoolERPApp_page_owner_masterfees','Fees');
    $tab->addTabURL('schoolERPApp_page_owner_masteritem','item');
    $tab->addTabURL('schoolERPApp_page_owner_masterhostel','Hostel');
    $tab->addTabURL('schoolERPApp_page_owner_masterstaff','Staff');
    $tab->addTabURL('schoolERPApp_page_owner_mastertreatment','Treatment');
}
}
