<?php
namespace schoolERPApp;
class Model_Master_Class extends \Model_Table{
	public $table='schoolERPApp_class';
	function init(){
		parent::init();


    $this->hasOne('schoolERPApp/Master_Session','schoolERPApp_session_id')->caption('Session id');
	$this->addField('name')->caption('class Name');
	$this->addField('section')->caption('Section Name');
    
    
    $this->addHook('beforeDelete',$this);
	
	$this->hasMany('schoolERPApp/Master_Subject','schoolERPApp_class_id');
	$this->hasMany('schoolERPApp/School_Student','schoolERPApp_class_id');
	$this->hasMany('schoolERPApp/School_Attendence','schoolERPApp_class_id');
	$this->hasMany('schoolERPApp/Master_Section','schoolERPApp_class_id');
 
    $this->add('dynamic_model/Controller_AutoCreator');

}

	
	function beforeDelete(){
	if($this->ref('schoolERPApp/Master_Subject')->count()->getOne()>0)
	throw $this->exception('please Delete subject content ');

	 if($this->ref('schoolERPApp/School_Student')->count()->getOne()>0)
	 throw $this->exception('please Delete Student content ');


	if($this->ref('schoolERPApp/School_Attendence')->count()->getOne()>0)
	throw $this->exception('please Delete Attendence content ');
	}
}



