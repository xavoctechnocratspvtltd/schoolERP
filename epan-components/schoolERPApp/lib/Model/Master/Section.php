<?php
namespace schoolERPApp;
class Model_Master_Section extends \Model_Table{
	public $table='schoolERPApp_section';
	function init(){
		parent::init();

		$this->hasOne('schoolERPApp/Master_Class','schoolERPApp_section_id')->caption('Section Name');
		$this->addField('name');

		
			
		

	    $this->add('dynamic_model/Controller_AutoCreator');

	}
}

	