<?php

namespace visitorCounterApp;

class Model_Visits extends \Model_Table {
	var $table= "visitorCounterApp_visits";
	function init(){
		parent::init();

		$this->hasOne('Epan','epan_id');
		$this->addField('name')->type('datetime')->caption("Visit On");
		$this->addField('IP');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}