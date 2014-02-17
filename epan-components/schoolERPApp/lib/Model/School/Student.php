<?php
namespace schoolERPApp;
class Model_School_Student extends \Model_Table{
	public $table='schoolERPApp_student';
	function init(){
		parent::init();
		
		
	// $this->hasOne('schoolERPApp/Master_Class','schoolERPApp_class_id')->Caption('Class Name');
	$this->addField('name')->Caption('Attendence');
	$this->hasMany('schoolERPApp/School_Movement','schoolERPApp_student_id')->Caption('Student Name');		
	$this->hasMany('schoolERPApp/School_Attendence','schoolERPApp_student_id')->Caption('Attendence Name');		
	
	// $this->addHook('beforeDelete',$this);
	$this->addHook('beforeSave',$this);
		
	$this->add('dynamic_model/Controller_AutoCreator');
	
	

	}
	function beforeSave(){
	$student=$this->add('schoolERPApp/Model_School_Student');
	if($this->loaded()){
	$student->addCondition('id','<>',$this->id);
	}
	$student->addCondition('name',$this['name']);
		$student->tryLoadAny();
		if($student->loaded()){
		throw $this->exception('It is Already Exist');
		}
}
}