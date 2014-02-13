<?php
class View_Message extends CompleteLister{
	function init(){
		parent::init();

			$total_messages=$this->api->current_website->ref('Messages')->count()->getOne();
			$new_messages=$this->api->current_website->ref('Messages')->addCondition('is_read',false)->count()->getOne();
			$this->template->trySet('total_messages',$total_messages);
			$this->template->trySet('new_messages',$new_messages);
			$b=$this->add('Button',null,'viewInbox')->setHTML('View Inbox');
	}

	function defaultTemplate(){
		return array('owner/message');
	}
}