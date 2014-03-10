<?php
class page_schoolERPApp_page_owner_masterhostel extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_master_hostel','Hostel Info');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_hostelstudent','Hostel Student');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_roomallotment','Room Allotment');
	$tab->addTabURL('schoolERPApp_page_owner_movement','Hostel Movement');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_gaurdian','Hostel Gaurdian');
	}
}