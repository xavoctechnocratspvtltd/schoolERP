<?php
namespace schoolERPApp;
class Model_Master_Subject extends \Model_Table{
	public $table='schoolERPApp_subject';
	function init(){
		parent::init();
	
	$this->hasOne('schoolERPApp/Master_Session','schoolERPApp_session_id');
	$this->hasOne('schoolERPApp/Master_Class','schoolERPApp_class_id')->caption('class name');
	$this->addField('name')->caption('Subject Name');
	$this->addField('code');
		
	$this->addHook('beforeDelete',$this);
		
	$this->hasMany('schoolERPApp/Master_CategoryType','schoolERPApp_subject_id');

    $this->add('dynamic_model/Controller_AutoCreator');
	}

	 
	
        function beforeDelete(){
		if($this->ref('schoolERPApp/Master_CategoryType')->count()->getOne()>0)
		 throw $this->exception('Please Delete categoryType content');

	}
}
		
