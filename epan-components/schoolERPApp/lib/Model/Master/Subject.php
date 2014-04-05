<?php
namespace schoolERPApp;
class Model_Master_Subject extends \Model_Table{
	public $table='schoolERPApp_subject';
	function init(){
		parent::init();
	
	$this->hasOne('schoolERPApp/Master_Class','class_id')->caption('class name');
	// $this->hasOne('schoolERPApp/Master_Session','session_id')->caption('class name');
	$this->addField('name')->caption('Subject Name');
	$this->addField('code');
	$this->addField('is_active')->type('boolean');		
    // $this->hasMany('schoolERPApp/Model_SubjectClass','subject_id');
    // $this->hasMany('schoolERPApp/Model_SubjectClasses','subject_id');
       
    // $this->addHook('beforeSave',$this);
	// $this->addHook('beforeDelete',$this);		
    $this->add('dynamic_model/Controller_AutoCreator');
	}

 //    function beforeDelete(){
 //    $s=$this->add('schoolERPApp/Model_SubjectClasses');
 //    $s->addCondition('subject_id',$this->id);
 //    if($s->count()->getOne())
 //    throw $this->exception("This Subject has Associated classes in Any of Session, Cannot delete");
	// }
	 
    // function beforeSave(){
    //     $this->add('Controller_Unique',array('unique_fields'=>array('name'=>$this['name'])));

    // }
	
}
	