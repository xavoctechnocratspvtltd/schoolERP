<?php
namespace schoolERPApp;
class Model_Staff_Staff extends \Model_Table{
	public $table='schoolERPApp_staff';
	function init(){
		parent::init();
		
		
	
	$this->addField('name')->Caption('Staff name');
	$this->addField('designation');
	$this->addField('date')->Caption('Date of joining')->type('date')->defaultValue(date('Y-m-d'));


	$this->addField('gender')->enum(array('Male','Female'))->display(array('form'=>'Radio'));
	$this->addField('dob')->type('date');
	$this->addField('age')->type('number');
	$this->addField('father_name')->Caption('Father name');
	$this->addField('mother_name')->Caption('Mother name');
	$this->addField('current_address')->type('text');
	$this->addField('ph_number')->type('number');
	$this->addField('parmanent_address')->type('text');
	$this->addField('phone_number')->type('number')->Caption('Mobile no');
	$this->addField('category')->enum(array('gen','obc','stc','sc','st'));
	// $this->hasOne('schoolERPApp/Master_Hostel','hostel_id');
	$this->addField('is_active')->type('boolean');
	// $this->addField('guardian name');
	$this->addField('admission_date')->type('date');
	$this->addField('religion')->enum(array('Hindu','Muslim','Sikh','Isai'));
	$this->addField('account_no')->caption('Account no');
	$this->addField('pan_no')->caption('Pan card no');
	$this->addField('insurance_no')->caption('Insurance no');
	$this->addField('remark');
	$this->addField('is_marital_status')->type('boolean');
	

	$this->hasMany('schoolERPApp/Staff_Work','staff_id');
	$this->hasMany('schoolERPApp/Staff_StaffAttendence','staff_id');
	$this->addHook('beforeSave',$this);
		
	$this->add('dynamic_model/Controller_AutoCreator');
	

	}
	function beforeSave(){
	$staff=$this->add('schoolERPApp/Model_Staff_Staff');
	if($this->loaded()){
	$staff->addCondition('id','<>',$this->id);
	}
	$staff->addCondition('name',$this['name']);
		$staff->tryLoadAny();
		if($staff->loaded()){
		throw $this->exception('It is Already Exist');
		}

	

    // $fs=$this->leftJoin('filestore_file','image')
    //                     ->leftJoin('filestore_image.original_file_id')
    //                     ->leftJoin('filestore_file','thumb_file_id');
                
	}
}





	