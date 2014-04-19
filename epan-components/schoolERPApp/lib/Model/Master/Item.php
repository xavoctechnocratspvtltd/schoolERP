<?php
namespace schoolERPApp;
class Model_Master_Item extends \Model_Table{
	public $table='schoolERPApp_item';
	function init(){
		parent::init();


		$this->hasOne('schoolERPApp/Master_Category','category_id')->caption('Category Name');
		$this->hasOne('schoolERPApp/Master_CategoryType','categorytype_id')->caption('CategoryType Name');
		$this->addField('name')->caption('Item Name');
		$this->addField('date')->type('date')->caption('Last Purchase Date');
		$this->addField('qty')->type('number');
		$this->addField('rate')->type('number');
		
		$this->addExpression('Amount')->set('qty*rate');
		$this->addField('is_issueableitem')->type('boolean')->caption('Issueable Item');
		//$this->hasMany('schoolERPApp/Master_IssueableItem','schoolERPApp_item_id')->caption('Hostel Name');
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

	