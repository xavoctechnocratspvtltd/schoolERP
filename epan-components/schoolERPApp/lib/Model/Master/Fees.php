<?php
namespace schoolERPApp;
class Model_Master_Fees extends \Model_Table{
	public $table='schoolERPApp_fees';
	function init(){
		parent::init();
		
		$this->hasOne('schoolERPApp/Master_FeesHead','feeshead_id')->caption('FeesHead Name');
		$this->hasOne('schoolERPApp/Master_Class','class_id')->caption('class Name');
		// $this->addField('ishostelfees')->type('boolean')->caption('');
		// $this->addField('schooleramount');
		$this->addField('name')->type('int')->caption('Fees');
		$this->addField('yearly_fees')->type('int');
		$this->hasMany('schoolERPApp/Master_Hostel','fees_id');
		$this->add('dynamic_model/Controller_AutoCreator');
		// $this->addExpression('studentFess')->set('name+name');
		
	}
	


	
}

