<?php
namespace schoolERPApp;
class Model_Master_Section extends \Model_Table{
	public $table='schoolERPApp_section';
	function init(){
		parent::init();

		$this->hasOne('schoolERPApp/Master_Class','schoolERPApp_class_id')->caption('Class Name');
		$this->addField('section')->caption('Section Name');
		
		
			
		

	    $this->add('dynamic_model/Controller_AutoCreator');

	}
}

	