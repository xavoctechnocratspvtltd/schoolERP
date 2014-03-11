<?php

class page_schoolERPApp_page_owner_main extends page_componentBase_page_owner_main{
function init(){
	parent::init();

	$menu=$this->add('schoolERPApp/View_MyMenu');
	$menu->addMenuItem('schoolERPApp_page_owner_mastermenues','Master');
	$menu->addMenuItem('schoolERPApp_page_owner_schoolmenues','School');
	$menu->addMenuItem('schoolERPApp_page_owner_hostelmenues','Hostel');
	$menu->addMenuItem('schoolERPApp_page_owner_staffmenues','Staff');
         
	
}
}