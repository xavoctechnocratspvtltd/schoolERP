<?php
namespace schoolERPApp;
class Model_Master_Session extends \Model_Table{
	public $table='schoolERPApp/session';
	function init(){
		parent::init();
		$this->hasOne('schoolERPApp/class','schoolERPApp/class_id');
		$this->hasMany('schoolERPApp/Item','schoolERPApp/session_id');
		$this->hasMany('schoolERPApp/Subject','schoolERPApp/session_id');
		$this->hasMany('schoolERPApp/Fees','schoolERPApp/session_id');
		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);

}

	function beforeDelete(){
		if($this->ref('schoolERPApp/Item')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Item');

	if($this->ref('schoolERPApp/Subject')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Subject');
			
			if($this->ref('schoolERPApp/Fees')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Fees');
			
			

	}
	function beforeSave(){
		$session=$this->add('schoolERPApp/Model_Master_Session');
		if($session->loaded()){
		$session->addCondition('id','<>',$this->id);
		}
		$session->addCondition('name',$this['name']);
		$session->tryLoadAny();
		if($session->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}
