<?php
namespace schoolERPApp;
class Model_Hostel_RoomAllotment extends \Model_Table{
	public $table='schoolERPApp_roomallotment';
	function init(){
		parent::init();

		$this->hasOne('schoolERPApp/Master_Hostel','schoolERPApp_hostel_id')->caption('Hostel Name');
		// $this->hasOne('schoolERPApp/Master_Session','schoolERPApp_session_id')->caption('Session');
		// $this->hasOne('schoolERPApp/School_Student','schoolERPApp_student_id')->caption('Student Name');
        $this->addField('block_name');
        $this->addField('room');
        $this->addField('student');
		//$this->addHook('beforeSave',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	   }
 //   function beforeSave(){
	// 	$roomallotment=$this->add('schoolERPApp/Model_Hostel_RoomAllotment');
	// 	if($this->loaded()){
	// 	$roomallotment->addCondition('id','<>',$this->id);
	// 	}
	// 	$roomallotment->addCondition('name',$this['name']);
	// 	$roomallotment->tryLoadAny();
	// 	if($roomallotment->loaded()){
	// 		throw $this->exception('It is Already Exist');
	// 	}
	// }

}