<?php

namespace simpleImageGallaryApp;

class Model_Config extends \Model_Table {
	var $table= "simpleImageGallaryApp_config";
	function init(){
		parent::init();

		$this->hasOne('simpleImageGallaryApp/Gallaries','gallary_id');
		$this->addField('layout_mode')->enum(array('masonry','fitRows','cellsByRow','vertical','masonryHorizontal','fitColumns','cellsByColumn','horizontal'));
		// $this->addField('use_thumbnails')
		// 		->type('boolean')
		// 		->defaultValue(false)
		// 		->hint('Use thumbnail images instead original Images');
		$this->addField('max_width')->hint('100%')->defaultValue('30%');
		$this->addField('show_tag_selector_to_user')->type('boolean')->defaultValue(true);
		$this->addField('show_title')->type('boolean')->defaultValue(true);
		$this->addField('show_description')->type('boolean')->defaultValue(true);
		$this->addField('use_lightbox')->type('boolean')->defaultValue(true);
		$this->addField('lightbox_theme')->enum(array('pp_default','light_rounded','dark_rounded','light_square','dark_square','facebook'))->defaultValue('pp_default');
		$this->addField('show_title_in_lightbox_only')->type('boolean')->defaultValue(true);

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}