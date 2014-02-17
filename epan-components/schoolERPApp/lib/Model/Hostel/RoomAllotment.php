<?php
namespace schoolERPApp;
class Model_Hostel_RoomAllotment extends \Model_Table{
	public $table='schoolERPApp_roomallotment';
	function init(){
		parent::init();

		$this->hasOne('schoolERPApp/Master_Hostel','schoolERPApp_hostel_id')->caption('Hostel Name');
        $this->addField('name');
		$this->addHook('beforeSave',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	   }
   function beforeSave(){
		$roomallotment=$this->add('schoolERPApp/Model_Hostel_RoomAllotment');
		if($this->loaded()){
		$roomallotment->addCondition('id','<>',$this->id);
		}
		$roomallotment->addCondition('name',$this['name']);
		$roomallotment->tryLoadAny();
		if($roomallotment->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}

}