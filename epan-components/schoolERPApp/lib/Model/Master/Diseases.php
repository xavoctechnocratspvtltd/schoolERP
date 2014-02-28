<?php
namespace schoolERPApp;
class Model_Master_Diseases extends \Model_Table{
	public $table='schoolERPApp_diseases';
	function init(){
		parent::init();

		$this->addField('name')->caption('Diseases Name');
		
		$this->hasOne('schoolERPApp/School_Student','schoolERPApp_student_id');
		
		
		$this->hasMany('schoolERPApp/Hostel_Treatment','schoolERPApp_diseases_id');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
	
}