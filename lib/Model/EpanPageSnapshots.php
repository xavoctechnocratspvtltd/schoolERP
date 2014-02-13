<?php

class Model_EpanPageSnapshots extends Model_Table {
	var $table= "epan_page_snapshots";

	function init(){
		parent::init();
		$this->hasOne('EpanPage','epan_page_id');

		$this->addField('name')->caption('Snap Name')->hint('Snap Name is a unique Identification for your page version like A,B or Red_Layout etc...');

		$this->addField('created_on')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
		$this->addField('updated_on')->type('datetime');
		$this->addField('title');
		$this->addField('keywords')->type('text');
		$this->addField('description')->type('text');
		$this->addField('body_attributes')->type('text');
		$this->addField('content')->type('text');

		$this->addHook('beforeSave',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeSave(){

		$this['updated_on']=date('Y-m-d H:i:s');
		if(trim($this['name'])==''){
			$start = chr(1+ ord($this->ref('epan_page_id')->ref('EpanPageSnapshots')->_dsql()->del('field')->field('max(name)')->getOne()));
			if(ord($start)<65) $start ='A';
			$this['name']=$start;
		}
	}
}