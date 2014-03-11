<?php
class page_schoolERPApp_page_owner_hostel_roomallotment extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
<<<<<<< HEAD
	$class=$this->add('schoolERPApp/Model_Master_Class');
	 $form=$this->add('Form');
	 $class_field=$form->addField('dropdown','class');	
	 $class_field->setModel($class);
	$crud=$this->add('CRUD')->setModel('schoolERPApp/Hostel_RoomAllotment');
	

=======
		
	$class=$this->add('schoolERPApp/Model_Master_Class');
	$form=$this->add('Form');
	$class_field=$form->addField('dropdown','class');
	$class_field->setModel($class);
	$crud=$this->add('CRUD')->setModel('schoolERPApp/Hostel_RoomAllotment');
>>>>>>> e67b422b3339cf59704400e5498c7cd32e74afc6
	}
}