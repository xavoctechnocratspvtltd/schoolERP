<?php
class Model_Users extends Model_Table {
	var $table= "users";
	function init(){
		parent::init();
		$this->hasOne('Epan','epan_id')->mandatory(true);
		$this->addField('name');
		$this->addField('email');
		$this->addField('username');
		$this->addField('password')->type('password');
		$this->addField('created_at')->type('date')->defaultValue(date('Y-m-d'));
		// $this->addField('is_systemuser')->type('boolean')->defaultValue(false);
		// $this->addField('is_frontenduser')->type('boolean')->defaultValue(false);
		// $this->addField('is_backenduser')->type('boolean')->defaultValue(false);
		$this->addField('type')->enum(array('SuperUser','FrontEndUser','BackEndUser'))->defaultValue('FrontEndUser');
		$this->addField('is_active')->type('boolean')->defaultValue(false);
		$this->addField('activation_code');
		$this->addField('last_login_date')->type('date');

		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);
		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeSave(){
		// Check username for THIS EPAN
		$old_user = $this->add('Model_Users');
		$old_user->addCondition('username',$this['username']);
		
		if(isset($this->api->current_website))
			$old_user->addCondition('epan_id',$this->api->current_website->id);
		if($this->loaded()){
			$old_user->addCondition('id','<>',$this->id);
		}
		$old_user->tryLoadAny();
		if($old_user->loaded()){
			// throw $this->exception("This username is allready taken, Chose Another");
			$this->api->js()->univ()->errorMessage('This username is allready taken, Chose Another')->execute();
		}
	}

	function beforeDelete(){
		if($this['username'] == $this->ref('epan_id')->get('name'))
			throw $this->exception("You Can't delete it, it is default username");
			
	}

}