<?php

class page_system_logout extends page_system_base {
	function init(){
		parent::init();
		$this->api->auth->logout();
		$this->api->redirect('/');
	}
}