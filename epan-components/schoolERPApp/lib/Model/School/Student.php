<?php
namespace schoolERPApp;
class Model_School_Student extends \Model_Table{
	public $table='schoolERPApp_student';
	function init(){
		parent::init();
		
	$this->hasOne('schoolERPApp/Hostel_Gaurdian','schoolERPApp_gaurdian_id')->Caption('Class Name');
	$this->addField('name');
	$this->addField('gender')->enum(array('Male','Female'))->display(array('form'=>'Radio'));
	$this->addField('dob')->type('date');
	$this->addField('age')->type('numeric');
	$this->addField('Father name');
	$this->addField('Mother name');
	$this->addField('current address')->type('text');
	$this->addField('ph_number')->type('numeric');
	$this->addField('parmanent address')->type('text');
	$this->addField('phone_number')->type('numeric');
	$this->addField('category')->enum(array('gen','obc','stc','sc','st'));
	$this->addField('is_hostel')->type('boolean');
	$this->addField('guardian name');
	$this->addField('admission date')->type('date');
	$this->addField('Religion');
	$this->addField('last_school_name');
	$this->addField('last_class')->type('numeric');




 

	$this->hasMany('schoolERPApp/School_Movement','schoolERPApp_student_id');		
	$this->hasMany('schoolERPApp/School_Attendence','schoolERPApp_student_id');		
	$this->hasMany('schoolERPApp/Hostel_RoomAllotment','schoolERPApp_student_id');		
	
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