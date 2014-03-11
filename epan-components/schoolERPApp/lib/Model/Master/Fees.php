<?php
namespace schoolERPApp;
class Model_Master_Fees extends \Model_Table{
	public $table='schoolERPApp_fees';
	function init(){
		parent::init();
		
		$this->hasOne('schoolERPApp/Master_FeesHead','feeshead_id')->caption('FeesHead Name');
		$this->hasOne('schoolERPApp/Master_Session','session_id');
		$this->addField('name');
		$this->addHook('beforeSave',$this);		
		$this->hasMany('schoolERPApp/Master_Hostel','fees_id');
		$this->add('dynamic_model/Controller_AutoCreator');
		
		


	}
	function beforeSave(){
		$fees=$this->add('schoolERPApp/Model_Master_Fees');
		if($this->loaded()){
		$fees->addCondition('id','<>',$this->id);
		}
		$fees->addCondition('name',$this['name']);
		$fees->tryLoadAny();
		if($fees->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
function beforeDelete(){
	if($this->ref('schoolERPApp/Model_Master_Hostel')->count()->getOne()>0)
		throw $this->exception('please Delete Hostel content ');
	
}
}

