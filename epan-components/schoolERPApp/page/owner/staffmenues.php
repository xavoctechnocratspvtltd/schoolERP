<?php

class page_schoolERPApp_page_owner_staffmenues extends page_componentBase_page_owner_main{
function init(){
	parent::init();

    $tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_staff_staff','Staff Info');
    $tab->addTabURL('schoolERPApp_page_owner_staff_staffattendence','Staff Movement');
}
}
