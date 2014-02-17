<?php
namespace schoolERPApp;
class Model_Master_Schoolar extends \Model_Table{
	public $table='schoolERPApp_schoolar';
	function init(){
		parent::init();

	 $this->hasOne('schoolERPApp/Master_Session','schoolERPApp_session_id')->caption('Session');
	$this->addField('name');
	
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