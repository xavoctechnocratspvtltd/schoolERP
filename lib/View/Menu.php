<?php
class View_Menu extends View{
	function init(){
		parent::init();

		$msg=$this->add("Model_Messages");
		$msg->addCondition('epan_id',$this->api->current_website->id);
		$msg->addCondition('is_read',false);
		$msg->tryLoadAny()->_dsql()->limit(3)->order('id','desc');

		$alt=$this->add("Model_Alerts");
		$alt->addCondition('epan_id',$this->api->current_website->id);
		$alt->addCondition('is_read',false);
		$alt->tryLoadAny()->_dsql()->limit(3)->order('id','desc');

		$this->add('View_Message',null,'message')->setModel($msg);
		$this->add('View_Alerts',null,'alert')->setModel($alt);

		$total_messages=$this->api->current_website->ref('Messages')->count()->getOne();
		$this->template->trySet('total_messages',$total_messages);
		
	}

	function defaultTemplate(){
		return array('owner/menu');
	}
}