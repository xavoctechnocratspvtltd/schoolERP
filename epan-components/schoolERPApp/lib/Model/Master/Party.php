<?php
namespace schoolERPApp;
class Model_Master_Party extends \Model_Table{
	public $table='schoolERPApp/party';
	function init(){
		parent::init();
		$this->hasMany('schoolERPApp/Item','schoolERPApp/party_id');
		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);

	}
	function beforeDelete(){
		if($this->ref('schoolERPApp/Item')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Item');
			

	}
	function beforeSave(){
		$party=$this->add('schoolERPApp/Model_Master_Party');
		if($party->loaded()){
		$party->addCondition('id','<>',$this->id);
		}
		$party->addCondition('name',$this['name']);
		$party->tryLoadAny();
		if($party->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}
