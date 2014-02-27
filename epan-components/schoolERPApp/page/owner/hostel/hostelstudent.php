<?php
class page_schoolERPApp_page_owner_hostel_hostelstudent extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	// $grid=$this->add('Grid')->setModel('schoolERPApp/Hostel_Hostelstudent');
		



		$this->api->stickyGET('filter');
		$this->api->stickyGET('class');
		$form=$this->add('Form');
		$form->addField('dropdown','class')->setEmptyText('----')->setAttr('class','english')->setModel('schoolERPApp/Master_Class');
		$form->addSubmit('Get List');
		
		$grid=$this->add('Grid');
		$h=$this->add('schoolERPApp/Model_Hostel_Hostelstudent');
		// if($_GET['filter']){
		// 	$h->addCondition('class_id',$_GET['class']);
		// }else{
		// 	$h->addCondition('class_id',-1);
		// }
		$h->join('','');

		$h->_dsql()->del('order')->order('name','asc');
		$grid->setModel($h,array('name','Father_name'));
		$grid->addClass('reloadable');
		$grid->js('reloadme',$grid->js()->reload());


		$grid->addPaginator();

		if($form->isSubmitted()){
			$grid->js()->reload(array(
									"class"=>$form->get('class'),
									"filter"=>-1
								))->execute();
		}
	}

	
	}
