<?php
class page_schoolERPApp_page_owner_hostel_room extends page_componentBase_page_owner_main{
	function page_index(){

	$crud=$this->add('CRUD');
	$crud->setModel('schoolERPApp/Hostel_Room');
	

	}
}