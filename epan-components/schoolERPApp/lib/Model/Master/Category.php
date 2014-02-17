<?php
namespace schoolERPApp;
class Model_Master_Category extends \Model_Table{
	public $table='schoolERPApp_category';
	function init(){
		parent::init();

		$this->addField('name');
		
		$this->addHook('beforeDelete',$this);			
		$this->addHook('beforeSave',$this);			
		
		$this->hasMany('schoolERPApp/Master_CategoryType','schoolERPApp_category_id');

	    $this->add('dynamic_model/Controller_AutoCreator');

	}

	function beforeSave(){
		$category=$this->add('schoolERPApp/Master_Category');
		if($this->loaded()){
		$category->addCondition('id','<>',$this->id);
		}
		$category->addCondition('name',$this['name']);
		$category->tryLoadAny();
		if($category->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}

	function beforeDelete(){
	if($this->ref('schoolERPApp/Master_CategoryType')->count()->getOne()>0)
		throw $this->exception('please Delete CategoryType content');
}

}