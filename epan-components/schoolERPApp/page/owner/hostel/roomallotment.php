<?php
class page_schoolERPApp_page_owner_hostel_roomallotment extends page_componentBase_page_owner_main{
	function init(){
		parent::init();

		
	$class=$this->add('schoolERPApp/Model_Master_Class');
	$form=$this->add('Form');
	$class_field=$form->addField('dropdown','class');
	$class_field->setModel($class);
	$crud=$this->add('CRUD')->setModel('schoolERPApp/Hostel_RoomAllotment');
	}
}