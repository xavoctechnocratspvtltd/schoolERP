<?php

namespace companyERP;

class View_Supplier extends \View{
	function init(){
		parent::init();
		
         $menu=$this->add('companyERP/View_MyMenu');
         $menu->addMenuItem('companyERP_page_owner_suppliertype','SupplierType');

         $menu->addMenuItem('companyERP_page_owner_supplier'
            ,'Supplier');

         $menu->addMenuItem('companyERP_page_owner_contact','Contact');


         

         $this->js(true)->hide();
	}
}