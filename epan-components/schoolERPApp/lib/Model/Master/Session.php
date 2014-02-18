<?php
namespace schoolERPApp;
class Model_Master_Session extends \Model_Table{
	public $table='schoolERPApp_session';
	function init(){
		parent::init();

	$this->addField('name');
	$this->hasMany('schoolERPApp/Master_Class','schoolERPApp_session_id');
	$this->hasMany('schoolERPApp/Master_Schoolar','schoolERPApp_session_id');
		
	$this->addHook('beforeDelete',$this);
	$this->addHook('beforeSave',$this);

	$this->add('dynamic_model/Controller_AutoCreator');

	}


	function beforeSave(){
		$session=$this->add('schoolERPApp/Model_Master_Session');
		if($this->loaded()){
			$session->addCondition('id','<>',$this->id);
		}
		$session->addCondition('name',$this['name']);
		$session->tryLoadAny();
		if($session->loaded()){
			throw $this->exception('It is Already Exist');
		}	
	}
    function beforeDelete(){
	if($this->ref('schoolERPApp/Master_Schoolar')->count()->getOne()>0)
	throw $this->exception('Please Delete Schoolar content');
	
	if($this->ref('schoolERPApp/Master_Class')->count()->getOne()>0)
	throw $this->exception('Please Delete Subject content');
	}
}
