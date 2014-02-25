<?php
namespace schoolERPApp;
class Model_Hostel_HostelStudent extends Model_School_Student{
	function init(){
		parent::init();

		$this->addCondition('is_hostel',true);
	}
}
