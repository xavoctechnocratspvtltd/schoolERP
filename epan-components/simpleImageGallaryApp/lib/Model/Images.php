<?php

namespace simpleImageGallaryApp;

class Model_Images extends \Model_Table {
	var $table= "simpleImageGallary_images";
	function init(){
		parent::init();

		$this->hasOne('simpleImageGallaryApp/Gallaries','gallary_id');
		$this->addField('image')->display(array('form'=>'ElImage'));
		// $this->add("filestore/Field_Image","image_id")->type('image');
		$this->addField('name')->caption('Title'); // used as title of image
		$this->addField('description')->type('text');
		$this->addField('tags');

		$this->addHook('beforeDelete',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeDelete(){
		// $this->ref('image_id')->tryDelete();
	}
}