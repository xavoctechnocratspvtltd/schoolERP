<?php
namespace schoolERPApp;
class Model_Staff_Work extends \Model_Table{
	public $table='schoolERPApp_work';
	function init(){
		parent::init();
		
	$this->hasOne('schoolERPApp/Staff_Staff','schoolERPApp_staff_id');
	$this->addField('name')->caption('Work Name');
	// $this->addHook('beforeDelete',$this);
	
	$this->add('dynamic_model/Controller_AutoCreator');
	
	

	}
	function beforeSave(){
	$work=$this->add('schoolERPApp/Model_Staff_Work');
	if($this->loaded()){
	$work->addCondition('id','<>',$this->id);
	}
	$work->addCondition('name',$this['name']);
		$work->tryLoadAny();
		if($work->loaded()){
		throw $this->exception('It is Already Exist');
		}
}
}