<?php
namespace schoolERPApp;
class Model_Master_Item extends \Model_Table{
	public $table='schoolERPApp_item';
	function init(){
		parent::init();


		$this->hasOne('schoolERPApp/Master_Party','schoolERPApp_party_id')->caption('Party Name');
		$this->hasOne('schoolERPApp/Master_CategoryType','schoolERPApp_categorytype_id')->caption('CategoryType Name');
		$this->hasOne('schoolERPApp/Master_Hostel','schoolERPApp_hostel_id')->caption('Hostel Name');
		$this->addField('name');
		
		$this->addHook('beforeSave',$this);
		
		$this->add('dynamic_model/Controller_AutoCreator');


	}
	function beforeSave(){
		$item=$this->add('schoolERPApp/Model_Master_Item');
		if($this->loaded()){
		$item->addCondition('id','<>',$this->id);
		}
		$item->addCondition('name',$this['name']);
		$item->tryLoadAny();
		if($item->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}

	