	<?php
namespace schoolERPApp;
class Model_Currentsession extends Model_Session{
	function init(){
		parent::init();
		$this->addCondition('is_current',true);
		
		
	}
}