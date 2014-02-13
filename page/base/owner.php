<?php
class page_base_owner extends Page {
	public $page_heading;
	public $page_subheading;
	function init(){
		parent::init();

		$user_model = $this->add('Model_Users')
						->addCondition('type','<>','FrontEndUser')
						->addCondition('is_active',true)
						;
		$this->api->auth->setModel($user_model,'username','password');
		$this->api->auth->check();
		$this->api->current_website = $this->api->auth->model->ref('epan_id');
		$this->api->current_page = $this->api->current_website->ref('EpanPage');
		$this->api->memorize('website_requested',$this->api->current_website['name']);
		$this->api->load_plugins();
		if(!$this->api->isAjaxOutput()){
			$menu = $this->api->add('View_Menu',null,'menu',array('owner/menu'));
		}
	}
}