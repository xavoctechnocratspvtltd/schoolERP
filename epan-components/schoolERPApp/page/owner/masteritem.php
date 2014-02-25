<?php
class page_schoolERPApp_page_owner_masteritem extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_master_category','Category');
	$tab->addTabURL('schoolERPApp_page_owner_master_categorytype','CategoryType');
	$tab->addTabURL('schoolERPApp_page_owner_master_party','Party');
	$tab->addTabURL('schoolERPApp_page_owner_master_class','Class');
	}
}