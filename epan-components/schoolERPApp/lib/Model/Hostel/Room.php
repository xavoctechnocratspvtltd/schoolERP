<?php
namespace schoolERPApp;
class Model_Hostel_Room extends \Model_Table{
	public $table="schoolERPApp_room";
	function init(){
		parent::init();

		$this->hasOne('schoolERPApp_Master_Hostel','hostel_id');
		$this->addField('room_no');
		$this->addField('capacity');
		$this->hasMany('schoolERPApp/Hostel_RoomAllotment','room_id');
	 	$this->add('dynamic_model/Controller_AutoCreator');

 

		$this->addExpression('vacant')->set('id');//->display('diff');
		$this->addExpression('alloted')->set(function ($m,$q){
			return $m->refSQL('schoolERPApp/Hostel_RoomAllotement')->count();
		});

		$this->addExpression('name')->set('room_no');

		// $this->addCondition('session_id',$this->add('Model_Sessions_Current')->tryLoadAny()->get('id'));
		// $this->_dsql()->order('room_no','asc');
		
		$this->addHook('beforeSave',$this);
	}
	function beforeSave(){
		if($this['capacity']< $this['alloted']) throw $this->exception("Capcity can  not be less then Alloted");
	}

	
}