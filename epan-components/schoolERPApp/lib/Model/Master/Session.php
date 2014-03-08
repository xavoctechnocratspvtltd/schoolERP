<?php
namespace schoolERPApp;
class Model_Master_Session extends \Model_Table{
	public $table='schoolERPApp_session';
	function init(){
		parent::init();

	$this->addField('Session');
	$this->addField('is_current')->type('boolean')->Caption('Is Current Session');
	$this->addField('date')->type('date')->defaultValue(date('Y-m-d'))->Caption('Session start Date');
	$this->addField('end_date')->type('date')->Caption('Session End Date');

	$this->hasMany('schoolERPApp/Master_Class','session_id');
	$this->hasMany('schoolERPApp/Master_Schoolar','session_id');
	$this->hasMany('schoolERPApp/Hostel_RoomAllotement','session_id');
		
	$this->addHook('beforeDelete',$this);

	$this->add('dynamic_model/Controller_AutoCreator');
	}


	
    function beforeDelete(){
	if($this->ref('schoolERPApp/Master_Schoolar')->count()->getOne()>0){
	throw $this->exception('Please Delete Schoolar content');
		}
	
	if($this->ref('schoolERPApp/Master_Class')->count()->getOne()>0){
	throw $this->exception('Please Delete Subject content');
		}
	}
}
