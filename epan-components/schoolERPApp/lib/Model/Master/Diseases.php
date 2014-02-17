<?php
namespace schoolERPApp;
class Model_Master_Diseases extends \Model_Table{
	public $table='schoolERPApp_diseases';
	function init(){
		parent::init();

		$this->addField('name');
		
		$this->hasOne('schoolERPApp/School_Student','schoolERPApp_student_id');
		
	//$this->addHook('beforeDelete',$this);
		
		$this->hasMany('schoolERPApp/Master_CategoryType','schoolERPApp_diseases_id');
		$this->hasMany('schoolERPApp/Hostel_Treatment','schoolERPApp_diseases_id');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
	
// 	}
// 	function beforeDelete(){
// 	if($this->ref('schoolERPApp/Model_Master_CategoryType')->count()->getOne()>0)
// 		throw $this->exception('please Delete categorytype content ');

// 	if($this->ref('schoolERPApp/Model_Master_Treatment')->count()->getOne()>0)
// 		throw $this->exception('please Delete treatment content ');
// }

}