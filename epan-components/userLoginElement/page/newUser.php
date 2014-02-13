<?php

class page_userLoginelement_page_newUser extends Page {
	function init(){
		parent::init();
		$msg ='New User Registration';
		if($this->api->current_website['user_activation']=='self_activated'){
			$msg .= "<small>Activation email will be send to your email account</small>";
		}
		$this->add('H1')->setHTML($msg);
		
		$user = $this->add('Model_Users');
		$user->addCondition('epan_id',$this->api->current_website->id);
		$user->addCondition('created_at',date('Y-m-d H:i:s'));
		$user->addCondition('type','FrontEndUser');
		if($this->api->current_website['default_activated'] == 'default_activated'){
			$user->addCondition('is_active',true);
		}else{
			$user->addCondition('is_active',false);
		}

		$form = $this->add('Form');
		$form->setModel($user,array('name','email','username','password'));
		$form->addField('password','re_password');

	}
}