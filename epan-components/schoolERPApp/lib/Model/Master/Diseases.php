<?php
namespace schoolERPApp;
class Model_Master_Diseases extends \Model_Table{
	public $table='schoolERPApp_diseases';
	function init(){
		parent::init();

		$this->hasOne('schoolERPApp/School_Student','student_id');
		$this->addField('name')->caption('Diseases Name');
		$this->hasMany('schoolERPApp/Hostel_Treatment','diseases_id');
		$this->add('dynamic_model/Controller_AutoCreator');
		
		
		

	}
	
}