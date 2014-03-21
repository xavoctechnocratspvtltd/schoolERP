<?php
namespace schoolERPApp;
class Model_Master_Class extends \Model_Table{
	public $table='schoolERPApp_class';
	function init(){
		parent::init();


    $this->hasOne('schoolERPApp/Master_Session','session_id')->caption('Session id');
	$this->addField('name')->caption('class Name');
	$this->hasMany('schoolERPApp/Master_Subject','class_id');
	$this->hasMany('schoolERPApp/School_Student','class_id');
	$this->hasMany('schoolERPApp/School_Attendence','class_id');
	$this->hasMany('schoolERPApp/Master_Section','class_id');
 
    $this->add('dynamic_model/Controller_AutoCreator');

    // $this->addExpression('No_of_Subject')->set(function($m,$q){
    // 	return $m->refSQL('schoolERPApp/Master_Subject')->count();
    // });

    $this->addExpression('No_of_Student')->set(function($m,$q){
    	return $m->refSQL('schoolERPApp/School_Student')->count();
    });

}
}
