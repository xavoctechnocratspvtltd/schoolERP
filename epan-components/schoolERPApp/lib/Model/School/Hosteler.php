<?php
namespace schoolERPApp;
class Model_Master_IssueableItem extends Model_school_Sudent{
	
	function init(){
		parent::init();


		$this->addCondition('is_hosteler',true);

}
}