<?php
namespace schoolERPApp;
class Model_Master_Class extends \Model_Table{
	public $table='schoolERPApp_class';
	function init(){
		parent::init();


    $this->hasOne('schoolERPApp/Master_Session','session_id')->caption('Session id');
	$this->addField('name')->caption('class Name');
	$this->addField('no_std')->caption('No of Student ');
	$this->addField('no_sub')->caption('No of Subject');
    
    
	
	$this->hasMany('schoolERPApp/Master_Subject','class_id');
	$this->hasMany('schoolERPApp/School_Student','class_id');
	$this->hasMany('schoolERPApp/School_Attendence','class_id');
	$this->hasMany('schoolERPApp/Master_Section','class_id');
 
    $this->add('dynamic_model/Controller_AutoCreator');

}

}