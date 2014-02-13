<?php
namespace schoolERPApp;
class Model_Master_FeesHead extends \Model_Table{
	public $table='schoolERPApp/feeshead';
	function init(){
		parent::init();
		$this->hasMany('schoolERPApp/Fees','schoolERPApp/feeshead_id');
		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);

	}


	function beforeDelete(){
		if($this->ref('schoolERPApp/Fees')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Fees');
			

	}
	function beforeSave(){
		$feeshead=$this->add('schoolERPApp/Model_Master_FeesHead');
		if($feeshead->loaded()){
		$feeshead->addCondition('id','<>',$this->id);
		}
		$feeshead->addCondition('name',$this['name']);
		$feeshead->tryLoadAny();
		if($feeshead->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}
