<?php
namespace schoolERPApp;
class Model_School_Class extends \Model_Table{
	public $table='schoolERPApp_class';
	function init(){
		parent::init();
		
        $this->addField('name');
        $this->hasMany('schoolERPApp/School_Assignment','schoolERPApp_class_id'); 
        $this->hasMany('schoolERPApp/School_Attendence','schoolERPApp_class_id'); 
        $this->hasMany('schoolERPApp/School_Student','schoolERPApp_class_id'); 
        $this->hasMany('schoolERPApp/School_Movement','schoolERPApp_class_id'); 
		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);
		$this->add('dynamic_model/Controller_AutoCreator');
	}
	function beforeDelete(){
	if($this->ref('schoolERPApp/School_Assignment')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Assignment');
	if($this->ref('schoolERPApp/School_Attendence')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Attendence');
	if($this->ref('schoolERPApp/School_Student')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Student');
	if($this->ref('schoolERPApp/School_Movement')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Movement');
							

	}
	function beforeSave(){
		$class=$this->add('schoolERPApp/Model_School_Class');
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

