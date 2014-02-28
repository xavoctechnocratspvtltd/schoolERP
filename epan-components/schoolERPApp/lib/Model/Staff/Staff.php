<?php
namespace schoolERPApp;
class Model_Staff_Staff extends \Model_Table{
	public $table='schoolERPApp_staff';
	function init(){
		parent::init();
		
		
	
	$this->addField('name')->Caption('Staff name');
	$this->addField('designation');
	$this->addField('date')->Caption('Date of joining')->type('date')->defaultValue(date('Y-m-d'));


	$this->addField('gender')->enum(array('Male','Female'))->display(array('form'=>'Radio'));
	$this->addField('dob')->type('date');
	$this->addField('age')->type('number');
	$this->addField('father name')->Caption('Father name');
	$this->addField('mother name')->Caption('Mother name');
	$this->addField('current address')->type('text');
	$this->addField('ph_number')->type('number');
	$this->addField('parmanent address')->type('text');
	$this->addField('phone_number')->type('number')->Caption('Mobile no');
	$this->addField('category')->enum(array('gen','obc','stc','sc','st'));
	$this->addField('is_hostel')->type('boolean');
	$this->addField('guardian name');
	$this->addField('admission date')->type('date');
	$this->addField('religion')->enum(array('Hindu','Muslim','Sikh','Isai'));
	$this->addField('account_no')->caption('Account no');
	$this->addField('pan_no')->caption('Pan card no');
	$this->addField('insurance_no')->caption('Insurance no');
	$this->addField('remark');
	$this->addField('is_marital status')->type('boolean');
	






	
	$this->hasMany('schoolERPApp/Staff_Work','schoolERPApp_staff_id');
	$this->addHook('beforeSave',$this);
		
	$this->add('dynamic_model/Controller_AutoCreator');
	
	

	}
	function beforeSave(){
	$staff=$this->add('schoolERPApp/Model_Staff_Staff');
	if($this->loaded()){
	$staff->addCondition('id','<>',$this->id);
	}
	$staff->addCondition('name',$this['name']);
		$staff->tryLoadAny();
		if($staff->loaded()){
		throw $this->exception('It is Already Exist');
		}
}
}