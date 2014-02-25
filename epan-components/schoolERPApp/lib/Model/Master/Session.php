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
		

	$this->add('dynamic_model/Controller_AutoCreator');

	}


}
