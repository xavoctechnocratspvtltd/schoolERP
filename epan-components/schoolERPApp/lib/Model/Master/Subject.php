<?php
namespace schoolERPApp;
class Model_Master_Subject extends \Model_Table{
	public $table='schoolERPApp/subject';
	function init(){
		parent::init();
		$this->hasOne('schoolERPApp/Session','schoolERPApp/session_id');
		$this->hasOne('schoolERPApp/class','schoolERPApp/class_id');
		$this->hasMany('schoolERPApp/CategoryType','schoolERPApp/subject_id');

		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);

	}

	function beforeDelete(){
		if($this->ref('schoolERPApp/CategoryType')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete CategoryType');
			

	}
	function beforeSave(){
		$subject=$this->add('schoolERPApp/Model_Master_Subject');
		if($subject->loaded()){
		$subject->addCondition('id','<>',$this->id);
		}
		$subject->addCondition('name',$this['name']);
		$subject->tryLoadAny();
		if($subject->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}
