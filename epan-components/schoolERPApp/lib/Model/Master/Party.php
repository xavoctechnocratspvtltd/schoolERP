<?php
namespace schoolERPApp;
class Model_Master_Party extends \Model_Table{
	public $table='schoolERPApp_party';
	function init(){
		parent::init();


		$this->hasOne('schoolERPApp/Master_CategoryType','schoolERPApp_categorytype_id')->caption('CategoryType Name');
		$this->addField('name');
		$this->hasMany('schoolERPApp/Master_Item','schoolERPApp/party_id');
		
		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);
		
		$this->add('dynamic_model/Controller_AutoCreator');

	}
	

	function beforeSave(){
		$party=$this->add('schoolERPApp/Model_Master_Party');
		if($this->loaded()){
		$party->addCondition('id','<>',$this->id);
		}
		$party->addCondition('name',$this['name']);
		$party->tryLoadAny();
		if($party->loaded()){
		throw $this->exception('It is Already Exist');
		}
	}
	function beforeDelete(){

	if($this->ref('schoolERPApp/Master_Item')->count()->getOne()>0)
	throw $this->exception('Please Delete Item content');
	}

	

}