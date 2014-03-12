<?php

namespace companyERP;

class View_Customer extends \View{
	function init(){
		parent::init();
		
         $menu=$this->add('companyERP/View_MyMenu');
         $menu->addMenuItem('companyERP_page_owner_customer','Customer');

         $menu->addMenuItem('companyERP_page_owner_customergroup'
            ,'Customer Group');

         $menu->addMenuItem('companyERP_page_owner_salesperson','Sales Person');

         $menu->addMenuItem('companyERP_page_owner_contact','Contact');

         

         $this->js(true)->hide();
	}
}