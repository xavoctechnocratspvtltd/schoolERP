<?php

namespace simpleImageGallaryApp;

class Model_Gallaries extends \Model_Table {
	var $table= "simpleImageGallaryApp_gallaries";
	function init(){
		parent::init();

		$this->hasOne('Epan','epan_id')->defaultValue($this->api->auth->model->id);
		$this->addField('name')->mandatory();
		$this->hasMany('simpleImageGallaryApp/Images','gallary_id');
		$this->hasMany('simpleImageGallaryApp/Config','gallary_id');

		$this->addHook('afterInsert',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function afterInsert($obj,$new_id){
			$config_obj = $this->add('simpleImageGallaryApp/Model_Config');
			$config_obj['gallary_id'] = $new_id;
			$config_obj->save();
	}
}