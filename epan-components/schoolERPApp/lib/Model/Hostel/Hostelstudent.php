<?php
namespace schoolERPApp;
class Model_Hostel_HostelStudent extends Model_School_Student{
	function init(){
		parent::init();

		$this->addCondition('is_hosteler',true);
		$this->hasMany('schoolERPApp/Hostel_RoomAllotment','schoolERPApp_hostel_id');
	
}
}