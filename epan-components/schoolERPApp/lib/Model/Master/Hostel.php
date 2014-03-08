<?php
namespace schoolERPApp;
class Model_Master_Hostel extends \Model_Table{
	public $table='schoolERPApp_hostel';
	function init(){
		parent::init();


		// $this->addField('name','bu/**/ilding_name')->mandatory('Name is must');
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


	// 	$this->addField('name')->caption('Hostel Name');
	// 	$this->addField('block_name')->caption('Block Name');
	// 	$this->addField('block_cap')->caption('Block Capacity');

	// 	// $this->addField('alloted')->caption('Alloted');
	// 	// $this->addField('vacent')->caption('Vacent');

	// 	$this->addExpression('Alloted')->set(function($m,$q){
	// 	return $m->refSQL('schoolERPApp/Hostel_RoomAllotment')->count();
	// 	});
		
		
	// 	$this->addHook('beforeDelete',$this);
	// 	$this->addHook('beforeSave',$this);
		
	// 	$this->hasMany('schoolERPApp/Master_Fees','schoolERPApp_hostel_id');
	// 	$this->hasMany('schoolERPApp/Hostel_Room','schoolERPApp_hostel_id');
	// 	$this->hasMany('schoolERPApp/Hostel_RoomAllotment','schoolERPApp_hostel_id');
	// 	$this->hasMany('schoolERPApp/Staff_Staff','schoolERPApp_hostel_id');

	// 	$this->add('dynamic_model/Controller_AutoCreator');

 //     }
	   
	//  function beforeSave(){
	// 	$hostel=$this->add('schoolERPApp/Model_Master_Hostel');
	// 	if($this->loaded()){
	// 	$hostel->addCondition('id','<>',$this->id);
	// 	}
	// 	$hostel->addCondition('name',$this['name']);
	// 	$hostel->tryLoadAny();
	// 	if($hostel->loaded()){
	// 	throw $this->exception('It is Already Exist');
	// 	}
	// }
 //     function beforeDelete(){
	// 	if($this->ref('schoolERPApp/Master_Item')->count()->getOne()>0)
	// 	 throw $this->exception('Please Delete Item content');


	// 	if($this->ref('schoolERPApp/Master_Fees')->count()->getOne()>0)
	// 	 throw $this->exception('Please Delete Fees content');
		
		
	// 	if($this->ref('schoolERPApp/Hostel_RoomAllotment')->count()->getOne()>0)
	// 	 throw $this->exception('Please Delete Roomallotment content');
	// }
// }
		