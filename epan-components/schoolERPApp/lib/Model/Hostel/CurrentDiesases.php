<?php
namespace schoolERPApp;
class Model_Hostel_CurrenyDiesases extends Model_Hostel_Diesases{
	function init(){
		parent::init();

		$this->addCondition('is_active',true);
	

	
}
}


