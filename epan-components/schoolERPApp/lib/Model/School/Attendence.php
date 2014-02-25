<?php
namespace schoolERPApp;
class Model_School_Attendence extends \Model_Table{
	public $table='schoolERPApp_attendence';
	function init(){
		parent::init();
		
		
	$this->hasOne('schoolERPApp/Master_Class','schoolERPApp_class_id')->Caption('Class Name');
	$this->hasOne('schoolERPApp/School_Student','schoolERPApp_student_id')->Caption('Student Name');
	$this->addField('name')->Caption('Attendence');
		
	// $this->addHook('beforeDelete',$this);
	$this->addHook('beforeSave',$this);
		
	$this->add('dynamic_model/Controller_AutoCreator');
	
	

	}
	function beforeSave(){
		$attendence=$this->add('schoolERPApp/Model_School_Attendence');
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