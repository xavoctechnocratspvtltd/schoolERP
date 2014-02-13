<?php

class page_branch_logout extends page_branch_base {
	function init(){
		parent::init();
		$this->api->auth->logout();
		$this->api->redirect('/');
	}
}