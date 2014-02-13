<?php
namespace schoolERPApp;
class Model_Master_Hostel extends \Model_Table{
	public $table='schoolERPApp/hostel';
	function init(){
		parent::init();
		$this->hasMany('schoolERPApp/Item','schoolERPApp/hostel_id');
		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);


	}
	function beforeDelete(){
		if($this->ref('schoolERPApp/Item')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Item');
			

	}
	function beforeSave(){
		$hostel=$this->add('schoolERPApp/Model_Master_Hostel');
		if($hostel->loaded()){
		$hostel->addCondition('id','<>',$this->id);
		}
		$hostel->addCondition('name',$this['name']);
		$hostel->tryLoadAny();
		if($hostel->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}
