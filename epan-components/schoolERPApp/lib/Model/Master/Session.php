<?php
namespace schoolERPApp;
class Model_Master_Session extends \Model_Table{
	public $table='schoolERPApp_session';
	function init(){
		parent::init();

	$this->addField('Session')->Caption('Session Name');
	$this->addField('is_current')->type('boolean')->Caption('Is Current Session');
	$this->addField('date')->type('date')->Caption('Session start Date');
	$this->addField('end_date')->type('date')->Caption('Session End Date');

	$this->hasMany('schoolERPApp/Master_Class','schoolERPApp_session_id');
	$this->hasMany('schoolERPApp/Master_Schoolar','schoolERPApp_session_id');
	$this->hasMany('schoolERPApp/Hostel_RoomAllotement','schoolERPApp_session_id');
		
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
