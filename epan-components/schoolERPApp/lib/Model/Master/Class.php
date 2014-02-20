<?php
namespace schoolERPApp;
class Model_Master_Class extends \Model_Table{
	public $table='schoolERPApp_class';
	function init(){
		parent::init();

    $this->hasOne('schoolERPApp/Master_Session','schoolERPApp_session_id')->caption('Session Name');
	$this->addField('name')->caption('class Name');
	$this->addField('Section')->caption('Section Name');
    
    $this->addHook('beforeSave',$this);
    $this->addHook('beforeDelete',$this);
	
	$this->hasMany('schoolERPApp/Master_Subject','schoolERPApp_class_id');
	$this->hasMany('schoolERPApp/School_Student','schoolERPApp_class_id');
	$this->hasMany('schoolERPApp/School_Attendence','schoolERPApp_class_id');
	$this->hasMany('schoolERPApp/Master_Section','schoolERPApp_class_id');
 
    $this->add('dynamic_model/Controller_AutoCreator');

}

function beforeSave(){
		$class=$this->add('schoolERPApp/Model_Master_Class');
		if($this->loaded()){
		$class->addCondition('id','<>',$this->id);
		}
		$class->addCondition('name',$this['name']);
		$class->tryLoadAny();
		if($class->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
	function beforeDelete(){
	if($this->ref('schoolERPApp/Master_Subject')->count()->getOne()>0)
	throw $this->exception('please Delete subject content ');

	// if($this->ref('schoolERPApp/School_Student')->count()->getOne()>0)
	// throw $this->exception('please Delete Student content ');


	if($this->ref('schoolERPApp/School_Attendence')->count()->getOne()>0)
	throw $this->exception('please Delete Attendence content ');
	}
}