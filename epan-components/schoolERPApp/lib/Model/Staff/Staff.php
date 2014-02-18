<?php
namespace schoolERPApp;
class Model_Staff_Staff extends \Model_Table{
	public $table='schoolERPApp_staff';
	function init(){
		parent::init();
		
		
	
	$this->addField('name')->Caption('Attendence');
	//$this->hasOne('schoolERPApp/Master_Hostel','schoolERPApp_hostel_id')->Caption('Student Name');		
	//$this->hasMany('schoolERPApp/School_Attendence','schoolERPApp_student_id')->Caption('Attendence Name');		
	
	// $this->addHook('beforeDelete',$this);
	$this->hasMany('schoolERPApp/Staff_Work','schoolERPApp_staff_id');
	$this->addHook('beforeSave',$this);
		
	$this->add('dynamic_model/Controller_AutoCreator');
	
	

	}
	function beforeSave(){
	$staff=$this->add('schoolERPApp/Model_Staff_Staff');
	if($this->loaded()){
	$staff->addCondition('id','<>',$this->id);
	}
	$staff->addCondition('name',$this['name']);
		$staff->tryLoadAny();
		if($staff->loaded()){
		throw $this->exception('It is Already Exist');
		}
}
}