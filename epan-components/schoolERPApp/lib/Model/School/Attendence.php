<?php
namespace schoolERPApp;
class Model_School_Attendence extends \Model_Table{
	public $table='schoolERPApp_attendence';
	function init(){
		parent::init();
		
		
	$this->hasOne('schoolERPApp/Master_Class','class_id')->Caption('Class Name');

	$this->hasOne('schoolERPApp/School_Student','student_id')->Caption('Student Name');
	$this->addField('is_attendence')->Caption('Attendence')->type('boolean');
	$this->addField('month')->setValueList(array('1'=>'Jan',
            							'2'=>'Feb',
            							'3'=>'March',
            							'4'=>'April',
            							'5'=>'May',
            							'6'=>'Jun',
            							'7'=>'July',
            							'8'=>'Augest',
            							'9'=>'Sep',
            							'10'=>'Oct',
            							'11'=>'Nov',
            							'12'=>'Dec'
            							));
		$this->addField('total_attendance');
		$this->addField('present');
	$this->add('dynamic_model/Controller_AutoCreator');
	$this->addExpression("roll_no")->set(function($m,$q){
			return $m->refSQL('student_id')->fieldQuery('roll_no');
		});

	}

	function beforeSave(){
		if($this['present'] > $this['total_attendance'])
			$this->owner->js()->univ()->errorMessage("Present can not be greater then Total Attendance")->execute();
	}
}
	
