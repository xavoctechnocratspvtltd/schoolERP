<?php

namespace companyERP;

class View_HR extends \View{
	function init(){
		parent::init();
		
         $menu=$this->add('companyERP/View_MyMenu');
         $menu->addMenuItem('companyERP_page_owner_hrgroup','HR Group');
         $menu->addMenuItem('companyERP_page_owner_holidaylist','holidaylist');
         $menu->addMenuItem('companyERP_page_owner_leaveapplication','leave application');

         $this->js(true)->hide();
	}
}