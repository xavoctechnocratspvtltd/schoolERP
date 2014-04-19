<?php
class page_schoolERPApp_page_owner_schoolmenues extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	$tab=$this->add('Tabs');
	$tab->addTabURL('schoolERPApp_page_owner_student','Student');
	$tab->addTabURL('schoolERPApp_page_owner_attendence','Attendence');
	// $tab->addTabURL('schoolERPApp_page_owner_master_feedeposit','Fees_Deposit');
	// $tab->addTabURL('schoolERPApp_page_owner_master_feeses','Student_Fees');

}
}