<?php
class page_schoolERPApp_page_owner_hostelmenues extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$tab=$this->add('Tabs');
	// $tab->addTabURL('schoolERPApp_page_owner_hostel_gaurdian','Gaurdian');
	$tab->addTabURL('schoolERPApp_page_owner_master_hostel','Hostel');

	// $tab->addTabURL('schoolERPApp_page_owner_hostel_room','room');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_roomallotment','Room Allotment');
	// $tab->addTabURL('schoolERPApp_page_owner_hostel_diseases','DiseasesRecord');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_hostelstudent','Hostel Students');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_hostelinfo','Hostel Info');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_hostelstudentmovement','H Student Movement');
	}
}