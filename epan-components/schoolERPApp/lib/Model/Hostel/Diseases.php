<?php
namespace schoolERPApp;
class Model_Hostel_Diseases extends \Model_Table{
	public $table='schoolERPApp_diseases';
	function init(){
		parent::init();
		$this->hasOne('schoolERPApp/Hostel_Hostelstudent','student_id');
		$this->addField('name')->caption('Diseases Name');
		$this->addField('treatment')->caption('Treatment Name');
	    $this->addField('start_date')->type('date');
	    $this->addField('end_name')->type('date');
	    $this->addField('is_active')->type('boolean');


	    $this->add('dynamic_model/Controller_AutoCreator');

	}
}


