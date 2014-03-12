<?php
namespace schoolERPApp;
class Model_Master_Subject extends \Model_Table{
	public $table='schoolERPApp_subject';
	function init(){
		parent::init();
	
	$this->hasOne('schoolERPApp/Master_Class','class_id')->caption('class name');
	$this->addField('name')->caption('Subject Name');
	$this->addField('code');
		
	// $this->addHook('beforeDelete',$this);
	// $this->addHook('beforeSave',$this);
		
	$this->hasMany('schoolERPApp/Master_CategoryType','subject_id');

    $this->add('dynamic_model/Controller_AutoCreator');
	

	   
	}
}
		
