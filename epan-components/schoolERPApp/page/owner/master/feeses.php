<?php
class page_schoolERPApp_page_owner_master_feeses extends page_componentBase_page_owner_main{
	function init(){
		parent::init();

        $fees=$this->add('schoolERPApp/Model_School_Feeses');
	$crud=$this->add('CRUD');
    $crud->setModel($fees,array('class','name','Father_name','Mother_name','phone_number','is_fees'));
		

}
}