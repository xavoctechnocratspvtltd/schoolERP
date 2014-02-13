<?php
namespace schoolERPApp;
class Model_School_Student extends \Model_Table{
	public $table='schoolERPApp_student';
	function init(){
		parent::init();
		$this->hasOne('schoolERPApp/School_Class','schoolERPApp_class_id')->Caption('Class Name');
        $this->addField('name');
        $this->hasMany('schoolERPApp/School_Assignment','schoolERPApp_student_id');
        $this->hasMany('schoolERPApp/School_Assignmarks','schoolERPApp_student_id');
        $this->hasMany('schoolERPApp/School_Attendence','schoolERPApp_student_id');
        $this->hasMany('schoolERPApp/School_Movement','schoolERPApp_student_id');
		$this->add('dynamic_model/Controller_AutoCreator');
		$this->addHook('beforeDelete',$this);
		 $this->addHook('beforeSave',$this);
	}
	function beforeDelete(){
	if($this->ref('schoolERPApp/School_Assignment')->count()->getOne()>0)
	$this->api->js()->univ()->errorMessage('Please Delete Assignment');

	if($this->ref('schoolERPApp/School_Assignmarks')->count()->getOne()>0)
	$this->api->js()->univ()->errorMessage('Please Delete Assignmarks');
			
     if($this->ref('schoolERPApp/School_Attendence')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Attendence');

	if($this->ref('schoolERPApp/School_Movement')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Movement');
			
			
			

	 }
	function beforeSave(){
		$class=$this->add('schoolERP/Model_School_Student');
		if($class->load()){
		$class->addCondition('id','<>',$this->id);
		}
		$class->addCondition('name',$this['name']);
		$class->tryLoadAny();
		if($class->load()){
		throw $this->exception('It is Already Exist');
		}
	}
}



		
		
		


	
