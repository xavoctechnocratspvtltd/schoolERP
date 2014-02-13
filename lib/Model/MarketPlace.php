<?php

class Model_MarketPlace extends Model_Table {
	var $table= "epan_components_marketplace";
	
	function init(){
		parent::init();
		
		$this->addField('namespace')->mandatory();
		$this->addField('type')->enum(array('element','module','application','plugin'));
		$this->addField('name');
		$this->addField('is_final')->type('boolean')->defaultValue(false);
		$this->addField('rate')->type('number');
		$this->addField('allowed_children')->hint('comma separated ids of allowed children, mark final for none, and \'all\' for all');
		$this->addField('specific_to')->hint('comma separated ids of specified parent ids only, leave blank for none, and \'body\' for root only');

		$this->addField('is_system')->type('boolean')->defaultValue(false);
		$this->addField('description')->type('text')->display(array('grid'=>'text'));
		$this->addField('plugin_hooked')->type('text');
		$this->addField('default_enabled')->type('boolean')->defaultValue(true);
		$this->addField('has_toolbar_tools')->type('boolean')->defaultValue(false);
		$this->addField('has_owner_modules')->type('boolean')->defaultValue(false);
		$this->addField('has_plugins')->type('boolean')->defaultValue(false);
		$this->addField('has_live_edit_app_page')->type('boolean')->defaultValue(false);

		$this->add('dynamic_model/Controller_AutoCreator');

	}
}