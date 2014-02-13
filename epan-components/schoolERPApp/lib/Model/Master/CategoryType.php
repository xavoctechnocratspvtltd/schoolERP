<?php
namespace schoolERPApp;
class Model_Master_CategoryType extends \Model_Table{
	public $table='schoolERPApp/categorytype';
	function init(){
		parent::init();
		
		$this->hasOne('schoolERPApp/Subject','schoolERPApp/subject_id');
		$this->hasMany('schoolERPApp/Category','schoolERPApp/categorytype_id');
		$this->hasMany('schoolERPApp/Item','schoolERPApp/categorytype_id');
		$this->addHook('beforeSave',$this);

	}

	function beforeDelete(){
	if($this->ref('schoolERPApp/Item')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Item');

	if($this->ref('schoolERPApp/Category')->count()->getOne()>0)
		$this->api->js()->univ()->errorMessage('Please Delete Category');
			
			

	}
	
	function beforeSave(){
		$categorytype=$this->add('schoolERPApp/Model_Master_CategoryType');
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