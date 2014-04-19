<?php

namespace companyERP;

class View_Stock extends \View{
	function init(){
		parent::init();
		
         $menu=$this->add('companyERP/View_MyMenu');
         $menu->addMenuItem('companyERP_page_owner_adminstock','ItemGroup');
         $menu->addMenuItem('companyERP_page_owner_brands','Brands');
         $menu->addMenuItem('companyERP_page_owner_item','Items');


         $this->js(true)->hide();
	}
}