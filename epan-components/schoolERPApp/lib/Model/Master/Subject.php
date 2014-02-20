<?php
namespace schoolERPApp;
class Model_Master_Subject extends \Model_Table{
	public $table='schoolERPApp_subject';
	function init(){
		parent::init();
	
	$this->hasOne('schoolERPApp/Master_Session','schoolERPApp_session_id')->caption('Session name');
	$this->hasOne('schoolERPApp/Master_Class','schoolERPApp_class_id')->caption('class name');
	$this->addField('name')->caption('Subject Name');
	$this->addField('code');
		
	$this->addHook('beforeDelete',$this);
	$this->addHook('beforeSave',$this);
		
	$this->hasMany('schoolERPApp/Master_CategoryType','schoolERPApp_subject_id');

    $this->add('dynamic_model/Controller_AutoCreator');
	}

	   function beforeSave(){
		$subject=$this->add('schoolERPApp/Model_Master_Subject');
		if($this->loaded()){
		$subject->addCondition('id','<>',$this->id);
		}
		$subject->addCondition('name',$this['name']);
		$subject->tryLoadAny();
		if($subject->loaded()){
			throw $this->exception('It is Already Exist');
		}
	}
        function beforeDelete(){
		if($this->ref('schoolERPApp/Master_CategoryType')->count()->getOne()>0)
		 throw $this->exception('Please Delete categoryType content');

	}
}
		
