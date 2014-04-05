<?php
namespace schoolERPApp;
class Model_School_Student extends \Model_Table{
	public $table='schoolERPApp_student';
	function init(){
		parent::init();
		
	$this->hasOne('schoolERPApp/Master_Class','class_id')->Caption('Class Name');
	// $this->hasOne('schoolERPApp/Master_Session','session_id')->Caption('Class Name');
	$this->addField('name');
	$this->addField('gender')->enum(array('Male','Female'))->display(array('form'=>'Radio'));
	$this->addField('birth_date')->type('date');
	$this->addField('Father_name');
	$this->addField('Mother_name');
	$this->addField('current_address')->type('text');
	$this->addField('ph_number')->type('number')->caption('phone number');
	$this->addField('parmanent_address')->type('text');
	$this->addField('city')->type('text');

	$this->addField('phone_number')->type('number')->caption('Mobile number');
	$this->addField('category')->enum(array('gen','obc','stc','sc','st'));
	
	
	$this->addField('admission_date')->type('date');
	$this->addField('Religion');
	$this->hasOne('schoolERPApp/Master_Hostel','hostel_id');
	$this->addField('is_hosteler')->type('boolean');
	
	$this->addField('admission_fees')->type('int');
	
	$this->addField('is_fees')->type('boolean')->caption('Student Fees');


	$this->addField('last_class')->type('number');
	$this->hasMany('schoolERPApp/School_Movement','student_id');		
	$this->hasMany('schoolERPApp/School_Attendence','student_id');		
	$this->addExpression('age')->set('date_format(from_days(datediff(now(),birth_date)), "%Y")');
	$this->addHook('beforeDelete',$this);


		
	$this->add('dynamic_model/Controller_AutoCreator');
	}
	function beforeDelete(){
	if($this->ref('schoolERPApp/School_Movement')->count()->getOne()>0)
 		throw $this->exception('please Delete movement content');

 if($this->ref('schoolERPApp/School_Attendence')->count()->getOne()>0)
		throw $this->exception('please Delete attendence content');
	
	
	 	}

}
