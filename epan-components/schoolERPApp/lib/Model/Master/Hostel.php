<?php
namespace schoolERPApp;
class Model_Master_Hostel extends \Model_Table{
	public $table='schoolERPApp_hostel';
	function init(){
		parent::init();


		//$this->hasOne('schoolERPApp/Master_FeesHead','schoolERPApp_feeshead_id')->caption('Feeshead name');
		$this->addField('name')->caption('Hostel Name');
		$this->addField('block_name');
		

 

		$this->addExpression('Rooms')->set(function ($m,$q){
			return $m->refSQL('schoolERPApp/Hostel_Room')->count();
		});

		$this->addExpression('Capacity')->set(function ($m,$q){
			return $m->refSQL('schoolERPApp/Hostel_Room')->count();
		});

		$this->addExpression('Alloted')->set(function ($m,$q){
			return $m->refSQL('schoolERPApp/Hostel_Room')->count();
		});

         $this->addExpression('Vecent')->set(function ($m,$q){
			return $m->refSQL('schoolERPApp/Hostel_Room')->count();
		});


		$this->hasMany('schoolERPApp/Hostel_Room','hostel_id');
		$this->hasMany('schoolERPApp/Hostel_RoomAllotment','hostel_id');
		$this->add('dynamic_model/Controller_AutoCreator');
        
	
	}

}


		