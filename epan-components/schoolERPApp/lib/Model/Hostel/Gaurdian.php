<?php
namespace schoolERPApp;

class Model_Hostel_Gaurdian extends \Model_Table{
	public $table='schoolERPApp_gaurdian';
	function init(){
		parent::init();
		// schoolERPApp_hostel
		$this->hasOne('schoolERPApp/Master_Hostel','hostel_id');
		$this->hasOne('schoolERPApp/Hostel_Hostelstudent','student_id');
        // $this->addField('std_name')->caption('Hosteler Name');
        $this->addField('name')->caption('Gaurdian Name');
        $this->addField('address')->type('text')->caption('Full Address');
        $this->addField('contact_num')->type('number')->caption('Contact Number');
		$this->hasMany('schoolERPApp/School_Student','gaurdian_id');
		$this->addHook('beforeSave',$this);
		$this->addHook('beforeDelete',$this);
		

         $this->add('dynamic_model/Controller_AutoCreator');
}

		function beforeSave(){
		$gaurdian=$this->add('schoolERPApp/Model_Hostel_Gaurdian');
		if($this->loaded()){
		$gaurdian->addCondition('id','<>',$this->id);
		}
		$gaurdian->addCondition('name',$this['name']);
		$gaurdian->tryLoadAny();
		if($gaurdian->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}

}





