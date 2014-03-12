<?php
namespace schoolERPApp;
class Model_Master_Hostel extends \Model_Table{
	public $table='schoolERPApp_hostel';
	function init(){
		parent::init();


		//$this->hasOne('schoolERPApp/Master_FeesHead','schoolERPApp_feeshead_id')->caption('Feeshead name');
		$this->addField('name')->caption('Hostel Name');
		$this->addField('block_name');
		$this->addField('block_cap')->caption('Student capacity');
		$this->addField('alloted');
		$this->addField('vacent');

		$this->hasMany('schoolERPApp_Hostel_Room','hostel_id');

		$this->addExpression('Rooms')->set(function ($m,$q){
			return $m->refSQL('schoolERPApp/Hostel_Room')->count();
		});

		$this->addExpression('capacity')->set(function ($m,$q){
			return $m->refSQL('schoolERPApp/Hostel_Room')->sum('capacity');
		});

		$this->addExpression('alloted')->set(function ($m,$q){
			return $m->refSQL('schoolERPApp/Hostel_Room')->sum('alloted');
		});

		// $this->addExpression('alloted')->set(function ($m,$q){
		// 	$x= $m->refSQL('HostelRoom')->sum('');
		// 	echo $x;
		// 	return $x;
		// });
		// $this->_dsql()->del('order')->order('Rooms','asc');
		  $this->addExpression("vacant")->set('building_name');//->display('diff');
		  $this->addHook('beforeSave',$this);
		  $this->addHook('beforeDelete',$this);

	}

	function beforeSave(){
		
		$this->add('Controller_Unique',array('unique_fields'=>
                            array(
                               'name'=>$this['name'],
                                )
                            )
                    );

	}

	function beforeDelete(){

		$h=$this->add('schoolERPApp/Model_Hostel_Room');
		$h->addCondition('hostel_id',$this->id);

		$h->tryLoadAny();

		if($h->loaded())
			throw $this->exception("This Building has Room,cannot Delete ");
	}
}


		