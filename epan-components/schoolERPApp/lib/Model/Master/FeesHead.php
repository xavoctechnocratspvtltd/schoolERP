<?php
namespace schoolERPApp;
class Model_Master_FeesHead extends \Model_Table{
	public $table='schoolERPApp_feeshead';
	function init(){
		parent::init();

		$this->addField('name')->Caption('fees Name');
		$this->hasMany('schoolERPApp/Master_Fees','feeshead_id');
		$this->hasMany('schoolERPApp/Master_Hostel','feeshead_id');
		$this->addHook('beforeSave',$this);
		$this->addHook('beforeDelete',$this);
        $this->add('dynamic_model/Controller_AutoCreator');
		

		}

      function beforeSave(){
		$feeshead=$this->add('schoolERPApp/Model_Master_FeesHead');
		if($this->loaded()){
			$feeshead->addCondition('id','<>',$this->id);
		}
		$feeshead->addCondition('name',$this['name']);
		$feeshead->tryLoadAny();
		if($feeshead->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
    function beforeDelete(){
		if($this->ref('schoolERPApp/Master_Fees')->count()->getOne()>0){
		 throw $this->exception('Please Delete Fees content');
		
		if($this->ref('schoolERPApp/Master_Hostel')->count()->getOne()>0)
		 throw $this->exception('Please Delete Hostel content');
	}
}
}