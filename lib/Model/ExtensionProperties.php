<?php

class Model_ExtensionProperties extends Model_Table {
	var $table= "epan_extension_properties";
	function init(){
		parent::init();

		$this->hasOne('Module','epan_module_id');
		$this->hasOne('ModuleProperties','properties_id');

		$this->addField('name')->mandatory(true);
		$this->addField('mute')->type('boolean')->defaultValue(false);
		$this->addField('value')->display(array('form'=>'text','grid'=>'shorttext'));
		
		$this->addHook('beforeDelete',$this);

	}

	function beforeDelete(){
		if($this->ref('properties_id')->get('mandatory') AND !$this->recall('force_delete',false)){
			$this->api->js()->univ()->errorMessage("This is mandatory Field and cannot be delete")->execute();
		}
	}

	function getValue($key,$defaultValue=false){
		$pr = $this->add('Model_Properties');
		$pr->addCondition('epan_module_id',$this['epan_module_id']);
		$pr->addCondition('name',$key);

		$pr->tryLoadAny();
		if($pr->loaded())
			return $pr['value'];
		else
			return $defaultValue;

	}
}