<?php
namespace schoolERPApp;
class Model_Master_Item extends \Model_Table{
	public $table='schoolERPApp_item';
	function init(){
		parent::init();


		$this->hasOne('schoolERPApp/Master_Party','schoolERPApp_party_id')->caption('Party Name');
		$this->hasOne('schoolERPApp/Master_CategoryType','schoolERPApp_categorytype_id')->caption('CategoryType Name');
		$this->addField('name')->caption('Item Name');
		$this->addField('date')->type('date')->caption('Last Purchase Date');
		$this->addField('stock')->type('number');
		
		//$this->addField('is_issueableitem');
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

	