<?php
namespace schoolERPApp;
class Model_Master_FeesHead extends \Model_Table{
	public $table='schoolERPApp_feeshead';
	function init(){
		parent::init();

		$this->addField('name')->Caption('fees_Name');
		$this->hasMany('schoolERPApp/Master_Fees','feeshead_id');
		// $this->hasMany('schoolERPApp/Master_Hostel','feeshead_id');
        $this->add('dynamic_model/Controller_AutoCreator');
		$this->addHook('beforeDelete',$this);

		
	}
	function beforeDelete(){
		if($this->ref('schoolERPApp/Master_Fees')->count()->getOne()>0)
		throw $this->exception("Fees Head Can't Delete, It Conatains Fees");    	
    }
}