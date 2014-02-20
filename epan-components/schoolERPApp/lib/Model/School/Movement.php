<?php
namespace schoolERPApp;
class Model_School_Movement extends \Model_Table{
	public $table='schoolERPApp_movement';
	function init(){
		parent::init();
		
		
	$this->hasOne('schoolERPApp/School_Student','schoolERPApp_student_id')->Caption('student Name');
	$this->hasOne('schoolERPApp/Hostel_Gaurdian','schoolERPApp_gaurdian_id')->Caption('Gaurgian Name');
	$this->hasOne('schoolERPApp/Master_Session','schoolERPApp_session_id')->Caption('Session Name');
	$this->addField('purpose');
	$this->addField('remark');
	$this->addField('date')->type('datetime')->defaultValue(date('Y-m-d H:i:s'))->Caption('Departure Time');
	
	$this->addHook('beforeSave',$this);
		
	$this->add('dynamic_model/Controller_AutoCreator');
	
	

	}
	function beforeSave(){
		$attendence=$this->add('schoolERPApp/Model_School_Movement');
		if($this->loaded()){
		$attendence->addCondition('id','<>',$this->id);
		}
		$attendence->addCondition('name',$this['name']);
		$attendence->tryLoadAny();
		if($attendence->loaded()){
		throw $this->exception('It is Already Exist');
		}
}
}