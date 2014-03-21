<?php
namespace schoolERPApp;
class Model_Master_Fees extends \Model_Table{
	public $table='schoolERPApp_fees';
	function init(){
		parent::init();
		
		$this->hasOne('schoolERPApp/Master_FeesHead','feeshead_id')->caption('FeesHead Name');
		// $this->hasOne('schoolERPApp/Master_Session','session_id');
		$this->addField('ishostelfees')->type('boolean');
		$this->addField('schooleramount');
		
		// $this->addHook('beforeSave',$this);		
		$this->hasMany('schoolERPApp/Master_Hostel','fees_id');
		$this->add('dynamic_model/Controller_AutoCreator');
		
		
	}
	


	
}

