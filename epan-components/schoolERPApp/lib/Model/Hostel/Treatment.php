<?php
namespace schoolERPApp;
class Model_Hostel_Treatment extends \Model_Table{
	public $table='schoolERPApp_treatment';
	function init(){
		parent::init();

		$this->hasOne('schoolERPApp/Master_Diseases','schoolERPApp_diseases_id');
		$this->addField('name');
	    $this->addHook('beforeSave',$this);

	    $this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeSave(){
		$treatment=$this->add('schoolERPApp/Model_Hostel_Treatment');
		if($treatment->loaded()){
		$treatment->addCondition('id','<>',$this->id);
		}
		$treatment->addCondition('name',$this['name']);
		$treatment->tryLoadAny();
		if($treatment->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}


