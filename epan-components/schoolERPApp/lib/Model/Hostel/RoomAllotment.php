<?php
namespace schoolERPApp;
class Model_Hostel_RoomAllotment extends \Model_Table{
	public $table='schoolERPApp_roomallotment';
	function init(){
		parent::init();

		$this->hasOne('schoolERPApp/Master_Hostel','hostel_id')->caption('Hostel Name');
		// $this->hasOne('schoolERPApp/Hostel_Room','schoolERPApp_room_id')->caption('Room num');
       
		// $this->hasOne('Student','student_id');
		$this->add('dynamic_model/Controller_AutoCreator');

		// $this->addHook('beforeSave',$this);
		// $this->addHook('beforeDelete',$this);
	// }
	// function beforeSave(){

	// 	$tmp=$this->add('schoolERPApp/Model_Hostel_RoomAllotment');

	// 	// $tmp->addCondition('student_id',$this['student_id']);

	// 	$tmp->tryLoadAny();

	// 	if($tmp->loaded()){
	// 		throw $this->exception("This student has allready a Room Alloted");
	// 		// ->setField('room_no');
	// 	}

	// 	$st=$this->ref('schoolERPApp_student_id');
	// 	$st['isalloted']=true;
	// 	$st->save();
	// }

	// function beforeDelete(){
	// 	$st=$this->ref('student_id');
	// 	$st['isalloted']=false;
	// 	$st->save();
	}
}
		

	  