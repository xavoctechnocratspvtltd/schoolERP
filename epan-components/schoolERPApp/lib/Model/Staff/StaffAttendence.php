<?php

namespace schoolERPApp;
class Model_Staff_StaffAttendence extends Model_Staff_Staff {
	function init(){
		parent::init();

		$this->addCondition('is_active',true);

		
	}

}