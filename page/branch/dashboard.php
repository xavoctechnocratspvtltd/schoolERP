<?php


class page_branch_dashboard extends page_branch_base {
	function init(){
		parent::init();

	}

	function defaultTemplate(){
		if($this->api->auth->isLoggedIn())
			return array('branch/dashboard');
		else
			return parent::defaultTemplate();
	}
}