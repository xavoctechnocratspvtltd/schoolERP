<?php
namespace schoolERPApp;
class Model_Master_Schoolar extends \Model_Table{
	public $table='schoolERPApp_schoolar';
	function init(){
		parent::init();

	 $this->hasOne('schoolERPApp/Master_Session','session_id');
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
	$this->addField('last_school_name');
	$this->addField('last_class');

	
     $this->addHook('beforeSave',$this);
     $this->add('dynamic_model/Controller_AutoCreator');

}



	function beforeSave(){
		$schoolar=$this->add('schoolERPApp/Model_Master_Schoolar');
		if($this->loaded()){
		$schoolar->addCondition('id','<>',$this->id);
		}
		$schoolar->addCondition('name',$this['name']);
		$schoolar->tryLoadAny();
		if($schoolar->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
}