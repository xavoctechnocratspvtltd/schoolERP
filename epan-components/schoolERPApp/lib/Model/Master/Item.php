<?php
namespace schoolERPApp;
class Model_Master_Item extends \Model_Table{
	public $table='schoolERPApp/item';
	function init(){
		parent::init();
		$this->hasOne('schoolERPApp/Party','schoolERPApp/party_id');
		$this->hasOne('schoolERPApp/CategoryType','schoolERPApp/categorytype_id');
		$this->hasOne('schoolERPApp/Hostel','schoolERPApp/hostel_id');
		$this->hasOne('schoolERPApp/Session','schoolERPApp/session_id');
		$this->addHook('beforeSave',$this);


	}
	function beforeSave(){
		$categorytype=$this->add('schoolERPApp/Model_Master_Item');
		if($categorytype->loaded()){
		$categorytype->addCondition('id','<>',$this->id);
		}
		$categorytype->addCondition('name',$this['name']);
		$categorytype->tryLoadAny();
		if($categorytype->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}

	}