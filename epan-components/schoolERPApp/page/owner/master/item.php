<?php
class page_schoolERPApp_page_owner_master_item extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	
	$item=$this->add('schoolERPApp/Model_Master_Item');		
	$crud=$this->add('CRUD');
	$crud->setModel($item);


	if($_GET['deactive']){
    if($crud->grid)
    $item->load($_GET['deactive']);
    $item['is_issueableitem']=!$item['is_issueableitem'];
    $item->save();
    $crud->grid->js()->reload()->execute();
    }

    if($crud->grid){
    $crud->grid->addColumn('button','deactive');
    }
		
	}
}