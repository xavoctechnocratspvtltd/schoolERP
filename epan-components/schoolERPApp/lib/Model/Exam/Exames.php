<?php
namespace schoolERPApp;
class Model_Exam_Exames extends \Model_Table{
	public $table='schoolERPApp_exams';
	function init(){
		parent::init();
		
		
	$this->hasOne('schoolERPApp/Master_Class','class_id')->Caption('Class Name');
	
	$this->addField('name')->caption('Exam name');

	$this->add('dynamic_model/Controller_AutoCreator');
	}
}
