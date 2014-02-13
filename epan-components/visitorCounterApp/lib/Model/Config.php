<?php

namespace visitorCounterApp;

class Model_Config extends \Model_Table {
	var $table= "visitorCounterApp_config";
	function init(){
		parent::init();

		$this->hasOne('Epan','epan_id');

		$this->addField('theme')->enum(array('car','default','digital','minimal','plaza','slot-machine','train-station'));
		$this->addField('font_size')->defaultValue('12px')->hint('12px/0.7em');
		$this->addField('start_number')->defaultValue('2345')->hint('Initial Counting Start [For Total Visits]');
		$this->addField('show_total')->type('boolean')->defaultValue(true);
		$this->addField('show_yearly')->type('boolean')->defaultValue(false);
		$this->addField('show_monthly')->type('boolean')->defaultValue(false);
		$this->addField('show_daily')->type('boolean')->defaultValue(false);

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}