<?php
namespace schoolERPApp;
class Model_School_Attendence extends \Model_Table{
	public $table='schoolERPApp_attendence';
	function init(){
		parent::init();
		
		
	$this->hasOne('schoolERPApp/Master_Class','class_id')->Caption('Class Name');

	$this->hasOne('schoolERPApp/School_Student','student_id')->Caption('Student Name');
	$this->addField('is_attendence')->Caption('Attendence')->type('boolean');
	
	$this->add('dynamic_model/Controller_AutoCreator');
	

	}
	$this->addExpression('');

	function beforeSave(){
		if($this['present'] > $this['total_attendance'])
			$this->owner->js()->univ()->errorMessage("Present can not be greater then Total Attendance")->execute();
	}
}
	
