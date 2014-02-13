<?php

class page_branch_base extends Page {
	function init(){
		parent::init();

		$this->api->auth->setModel('Staff','username','password');
		$this->api->auth->check();

		

		$menu = $this->api->add('View',null,'menu',array('branch/menu'));
		$menu->template->trySet($_GET['page'],'active');
	}
}