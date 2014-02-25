<?php
class page_schoolERPApp_page_owner_masterhostel extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_gaurdian','Hostel Gaurdian');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_roomallotment','Room Allotment');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_hostel','Hostel');
	$tab->addTabURL('schoolERPApp_page_owner_movement','Hostel Movement');
	}
}