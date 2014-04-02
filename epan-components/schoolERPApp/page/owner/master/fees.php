<?php
class page_schoolERPApp_page_owner_master_fees extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	// $crud=$this->add('CRUD')->setModel('schoolERPApp/Master_Fees');
		
	$col=$this->add('Columns');
    $col1=$col->addColumn(6);
    $fees=$this->add('schoolERPApp/Model_Master_Fees');
    // $fees_field=$fees->join('schoolERPApp_class','class_id');
    // $fees_field->addField('class_name','name');
    $crud=$this->add('CRUD');
    $crud->setModel($fees);


}
}