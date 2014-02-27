<?php
namespace schoolERPApp;
class Model_School_Attendence extends \Model_Table{
	public $table='schoolERPApp_attendence';
	function init(){
		parent::init();
		
		
	$this->hasOne('schoolERPApp/Master_Class','schoolERPApp_class_id')->Caption('Class Name');
	// $this->hasOne('schoolERPApp/School_Student','schoolERPApp_student_id')->Caption('Student Name');
	$this->addField('Month')->enum(array('jan','Feb','march','April','May','june','july','August','sep','oct','nov','dec'));	
		
	$this->add('dynamic_model/Controller_AutoCreator');
	
	

	}
	
}