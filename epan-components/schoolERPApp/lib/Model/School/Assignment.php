<?php
namespace schoolERPApp;
class Model_School_Assignment extends \Model_Table{
	public $table='schoolERPApp_assignment';
	function init(){
		parent::init();

        $this->hasOne('schoolERPApp/School_Student','schoolERPApp_student_id');
        $this->hasOne('schoolERPApp/School_Class','schoolERPApp_class_id');
        $this->addField('name');
        $this->hasMany('schoolERPApp/School_Assignmarks','schoolERPApp_assignment_id');
		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);
		$this->add('dynamic_model/Controller_AutoCreator');
	}
	function beforeDelete(){
		if($this->ref('schoolERPApp/School_Assignmarks')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please delete AssignMarks');
			

	}
	function beforeSave(){
		$class=$this->add('schoolERPApp/Model_School_Assignment');
		if($class->loaded()){
		$class->addCondition('id','<>',$this->id);
		}
		$class->addCondition('name',$this['name']);
		$class->tryLoadAny();
		if($class->loaded()){
		throw $this->exception('It is Already Exist');
		}
	}
}
