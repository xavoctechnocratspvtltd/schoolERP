<?php
namespace schoolERPApp;
class Model_Master_CategoryType extends \Model_Table{
	public $table='schoolERPApp_categorytype';
	function init(){
		parent::init();
		
		
		$this->hasOne('schoolERPApp/Master_Category','schoolERPApp_category_id');
		$this->addField('name');
		$this->hasMany('schoolERPApp/Master_Item','schoolERPApp_categorytype_id');
		$this->hasMany('schoolERPApp/Master_Party','schoolERPApp_categorytype_id');
		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);
	    $this->add('dynamic_model/Controller_AutoCreator');  
	}

	function beforeDelete(){
	if($this->ref('schoolERPApp/Master_Item')->count()->getOne()>0)
		throw $this->exception('please Delete Item content ');

	if($this->ref('schoolERPApp/Master_Party')->count()->getOne()>0)
		throw $this->exception('please delete Party content');
			

	}
	
	function beforeSave(){
		$categorytype=$this->add('schoolERPApp/Model_Master_CategoryType');
		if($this->loaded()){
		$categorytype->addCondition('id','<>',$this->id);
		}
		$categorytype->addCondition('name',$this['name']);
		$categorytype->tryLoadAny();
		if($categorytype->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}