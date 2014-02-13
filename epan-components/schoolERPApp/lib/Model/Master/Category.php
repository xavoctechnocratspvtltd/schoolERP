<?php
namespace schoolERPApp;
class Model_Master_Category extends \Model_Table{
	public $table='schoolERPApp/category';
	function init(){
		parent::init();
		$this->hasOne('schoolERPApp/CategoryType','schoolERPApp/categorytype_id');
		$this->addHook('beforeSave',$this);			

	}

	function beforeSave(){
		$category=$this->add('schoolERPApp/Model_Master_Category');
		if($category->loaded()){
		$category->addCondition('id','<>',$this->id);
		}
		$category->addCondition('name',$this['name']);
		$category->tryLoadAny();
		if($category->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}
