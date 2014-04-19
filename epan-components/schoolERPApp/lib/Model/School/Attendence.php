<?php
namespace schoolERPApp;
class Model_School_Attendence extends \Model_Table{
	public $table='schoolERPApp_attendence';
	function init(){
		parent::init();
		
		
	$this->hasOne('schoolERPApp/School_Student','student_id')->Caption('Student Name');
	$this->addField('student_month')->enum(array('1'=>'Jan',
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
            							))->caption('Month');
		$this->addField('total_attendance');
		// $this->addField('present');
		$this->addField('absent');

		$this->addExpression('present')->set('total_attendance-absent');
		$this->add('dynamic_model/Controller_AutoCreator');
	
		$this->addHook('beforeSave',$this);
	}

	function beforeSave(){
		if($this['present'] > $this['total_attendance'])
			$this->owner->js()->univ()->errorMessage("Present can not be greater then Total Attendance")->execute();
	}
}





	
	
