<?php
namespace schoolERPApp;
class Model_Master_Fees extends \Model_Table{
	public $table='schoolERPApp_fees';
	function init(){
		parent::init();
		$this->addField('name');
		
		$this->hasOne('schoolERPApp/Master_FeesHead','schoolERPApp_feeshead_id');
		$this->hasOne('schoolERPApp/Master_Session','schoolERPApp_session_id');
		$this->hasOne('schoolERPApp/Master_Hostel','schoolERPApp_hostel_id');
		
		$this->addHook('beforeSave',$this);		
		
		$this->hasMany('schoolERPApp/Master_Hostel','schoolERPApp_fees_id');

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

