<?php

class page_schoolERPApp_page_owner_main extends page_componentBase_page_owner_main{
function init(){
	parent::init();

	$menu=$this->add('schoolERPApp/View_MenuLayout');
	$menu->addMenuItem('schoolERPApp_page_owner_masterschool','School');
	$menu->addMenuItem('schoolERPApp_page_owner_masterfees','Fees');
	$menu->addMenuItem('schoolERPApp_page_owner_masteritem','item');
	$menu->addMenuItem('schoolERPApp_page_owner_masterhostel','Hostel');
	$menu->addMenuItem('schoolERPApp_page_owner_masterstaff','Staff');
	$menu->addMenuItem('schoolERPApp_page_owner_mastertreatment','Treatment');
        
	
}
}