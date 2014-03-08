<?php
namespace schoolERPApp;
class Model_Master_Party extends \Model_Table{
	public $table='schoolERPApp_party';
	function init(){
		parent::init();


		$this->hasOne('schoolERPApp/Master_Category','category_id')->caption('Category Name');
		// $this->addField('e_name');
		$this->addField('item_name');
		$this->addField('contact_no');
		$this->addField('Address');
		$this->hasMany('schoolERPApp/Master_Item','party_id');
		// $this->addHook('beforeSave',$this);
		
		$this->add('dynamic_model/Controller_AutoCreator');

	
	
	}

	}

	

