<?php
class View_Alerts extends CompleteLister{
	function init(){
		parent::init();
		$total_alerts=$this->api->current_website->ref('Alerts')->count()->getOne();
			$new_alerts=$this->api->current_website->ref('Alerts')->addCondition('is_read',false)->count()->getOne();
			$this->template->trySet('total_alerts',$total_alerts);
			$this->template->trySet('new_alerts',$new_alerts);
			$b=$this->add('Button',null,'viewAll')->setHTML('View All');
			// if($b->isClicked())
	}		

	function defaultTemplate(){
		return array('owner/alerts');
	}
}