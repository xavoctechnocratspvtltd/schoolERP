<?php
namespace schoolERPApp;
class Model_Master_Class extends \Model_Table{
	public $table='schoolERPApp_class';
	function init(){
		parent::init();


    $this->hasOne('schoolERPApp/Master_Session','schoolERPApp_session_id')->caption('Session id');
	$this->addField('name')->caption('class Name');
	$this->addField('section')->caption('Section Name');
    
    
	
	$this->hasMany('schoolERPApp/Master_Subject','schoolERPApp_class_id');
	$this->hasMany('schoolERPApp/School_Student','schoolERPApp_class_id');
	$this->hasMany('schoolERPApp/School_Attendence','schoolERPApp_class_id');
	$this->hasMany('schoolERPApp/Master_Section','schoolERPApp_class_id');
 
    $this->add('dynamic_model/Controller_AutoCreator');

}

}