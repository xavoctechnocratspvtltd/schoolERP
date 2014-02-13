<?php

class Model_EpanAdds extends Model_Table {
	var $table= "epan_adds";
	function init(){
		parent::init();

		$this->hasOne('Branch','branch_id');
		$this->hasOne('EpanCategory','category_id');
		$this->addField('name');
		$this->addField('last_displayed_at')->type('datetime')->defaultValue(date('Y-m-d'));
		$this->addField('created_at')->type('date')->defaultValue(date('Y-m-d'));
		$this->addField('valid_till')->type('date')->defaultValue(date('Y-m-d',strtotime('+30 days',strtotime(date('Y-m-d')))));
		$this->add("filestore/Field_Image","add_image_id")->type('image');
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}