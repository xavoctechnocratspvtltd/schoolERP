<?php
class page_schoolERPApp_page_owner_hostel_gaurdian extends page_componentBase_page_owner_main{
	function page_index(){
		
    $gaurdian=$this->add('schoolERPApp/Model_Hostel_Gaurdian');
    $crud=$this->add('CRUD');
    $crud->setModel($gaurdian);
    }
}
