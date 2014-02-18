<?php
namespace schoolERPApp;
class Model_School_Student extends \Model_Table{
	public $table='schoolERPApp_student';
	function init(){
		parent::init();
		
		
	$this->hasOne('schoolERPApp/Hostel_Gaurdian','schoolERPApp_gaurdian_id')->Caption('Class Name');
	$this->addField('name')->Caption('Attendence');
	$this->hasMany('schoolERPApp/School_Movement','schoolERPApp_student_id');		
	
	$this->hasMany('schoolERPApp/School_Attendence','schoolERPApp_student_id');		
	
	$this->addHook('beforeDelete',$this);
	// $this->addHook('beforeSave',$this);
		
	$this->add('dynamic_model/Controller_AutoCreator');
	
	

	}
	function beforeDelete(){
	if($this->ref('schoolERPApp/School_Movement')->count()->getOne()>0)
		throw $this->exception('please Delete movement content');
	if($this->ref('schoolERPApp/School_Attendence')->count()->getOne()>0)
		throw $this->exception('please Delete attendence content');

	 	}
}
