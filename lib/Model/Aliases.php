<?php

class Model_Aliases extends Model_Table {
	var $table= "epan_aliases";
	function init(){
		parent::init();

		$this->hasOne('Epan','epan_id');
		$this->addField('name')->caption('Alias(es) for your Epan');

		$this->addHook('beforeSave',$this);
		$this->addHook('beforeDelete',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeSave(){

		if(!$this->loaded() AND $this->ref('epan_id')->ref('Aliases')->count() >= $this->ref('epan_id')->get('allowed_aliases')){
			throw $this->exception('You have consumed your aliases, Kindly purchase more aliases from company first','ValidityCheck')
			->setField('name')
			->addMoreInfo('Alias',$this['name']);
		}

		$old_aliases = $this->add('Model_Aliases');
		$old_aliases->addCondition('name',$this['name']);
		if($this->loaded()){
			$old_aliases->addCondition('id','<>',$this->id);
		}

		$old_aliases->tryLoadAny();
		if($old_aliases->loaded())
			throw $this->exception('This Alias name is already in use, try another','ValidityCheck')
						->setField('name')
						->addMoreInfo('Alias',$this['name']);
	}

	function beforeDelete(){
		if(!$this->recall('force_delete') AND $this['name'] == $this->ref('epan_id')->get('name'))
			$this->api->js()->univ()->errorMessage('Can not delete Default Alias ... ')->execute();
			// throw $this->exception('You must have to keep at least one alias for your epan.');
			
	}
}