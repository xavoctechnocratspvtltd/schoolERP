<?php
namespace schoolERPApp;
class Model_Hostel_Hostelstudent extends Model_School_Student{
	function init(){
		parent::init();

		$this->addCondition('is_hosteler',true);
		$this->hasMany('schoolERPApp/Hostel_RoomAllotment','hostel_id');
		$this->hasMany('schoolERPApp/Hostel_Gaurdian','student_id');
		$this->hasMany('schoolERPApp/Hostel_Diseases','student_id');
	

	
}
}


