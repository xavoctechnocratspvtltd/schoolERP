<?php
class page_schoolERPApp_page_owner_mastertreatment extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_hostel_treatment','Student Treatment');
	$tab->addTabURL('schoolERPApp_page_owner_master_diseases','Diseases');
	$tab->addTabURL('schoolERPApp_page_owner_master_class','Class');
	$tab->addTabURL('schoolERPApp_page_owner_student','Student');

}
}