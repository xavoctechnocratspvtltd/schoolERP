<?php

class Model_Branch extends Model_Table {
	var $table= "branch";
	function init(){
		parent::init();

		$this->addField('name')->mandatory();
		$this->addField('owner_name')->mandatory();
		$this->addField('mobile_number')->mandatory();
		$this->addField('address')->type('text')->mandatory();
		$this->addField('points')->type('number')->mandatory();
		$this->addField('email_id')->mandatory();
		$this->addField('created_at')->type('date')->defaultValue(date('Y-m-d H:i:s'));


		$this->addExpression('epans_count')->set(function($m,$q){
			return $m->refSQL('Epan')->count();
		});

		$this->hasMany('Staff','branch_id');
		$this->hasMany('Epan','branch_id');
		$this->hasMany('EpanAdds','branch_id');

		$this->addHook('afterInsert',$this); // Create default Admin for this branch
		$this->addHook('beforeDelete',$this); // Check For Existing Clients

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeDelete(){
		if($this['epans_count'] > 0 OR $this->ref('Staff')->count()->getOne() ){
			throw $this->exception('Branch contains Epans Or Staff and cannot be deleted');
		}
	}

	function afterInsert($m,$new_id){
		$s=$this->add('Model_Staff');
		$s['name']=$this['name'].  " Admin";
		$s['username'] = "admin".$new_id;
		$s['password'] = rand(100000,999999);
		$s['access_level'] = 80;
		$s['branch_id'] = $new_id;
		$s->save();
	}
}