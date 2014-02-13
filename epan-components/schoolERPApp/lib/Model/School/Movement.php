<?php
namespace schoolERPApp;
class Model_School_Movement extends \Model_Table{
	public $table='schoolERPApp/movement';
	function init(){
		parent::init();
		
        $this->hasOne('schoolERPApp/School_Class','schoolERPApp/class_id');
        $this->hasOne('schoolERPApp/School_Student','schoolERPApp/student_id');
		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);
		$this->add('dynamic_model/Controller_AutoCreator');
	}
	
			

	}
	function beforeSave(){
		$class=$this->add('schoolERPApp/Model_School_Movement');
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
