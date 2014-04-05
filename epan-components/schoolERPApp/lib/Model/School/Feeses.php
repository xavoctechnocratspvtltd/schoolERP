<?php
namespace schoolERPApp;
class Model_School_Feeses extends Model_School_Student{
	function init(){
		parent::init();

		$this->addCondition('is_fees',true);
	

	
}
}


