<?php

class Model_InstalledComponents extends Model_Table {
	var $table= "epan_installed_components";
	function init(){
		parent::init();

		$this->hasOne('Epan','epan_id');
		$this->hasOne('MarketPlace','component_id');
		$this->addField('params')->system(true);
		$this->addField('enabled')->type('boolean')->defaultValue(true);
		$this->addField('installed_on')->type('date')->defaultValue(date('Y-m-d H:i:s'))->system(true);

		$marketplace_j = $this->leftJoin('epan_components_marketplace','component_id');
		$marketplace_j->addField('namespace');
		$marketplace_j->addField('type');
		$marketplace_j->addField('name');
		$marketplace_j->addField('is_final');
		$marketplace_j->addField('allowed_children');
		$marketplace_j->addField('specific_to');
		$marketplace_j->addField('is_system');
		$marketplace_j->addField('description');
		$marketplace_j->addField('plugin_hooked');
		$marketplace_j->addField('default_enabled');
		$marketplace_j->addField('has_toolbar_tools');
		$marketplace_j->addField('has_owner_modules');
		$marketplace_j->addField('has_plugins');
		$marketplace_j->addField('has_live_edit_app_page');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}