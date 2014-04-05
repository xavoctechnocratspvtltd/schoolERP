<?php
namespace schoolERPApp;
class Model_School_FeesDeposit extends \Model_Table{
	public $table='schoolERPApp_feedeposit';
	function init(){
		parent::init();
		
	$this->addField('name');
	$this->add('dynamic_model/Controller_AutoCreator');
		


	}
}

	
	
