
<?php
class page_schoolERPApp_page_owner_master_session extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
	// $crud=$this->add('CRUD')->setModel('schoolERPApp/Master_Session');
	$grid=$this->add('Grid');
		if($_GET['mark_current']){
			$m=$this->add('schoolERPApp/Model_Master_Session');
			$m->load($_GET['mark_current']);
			if(!$m['is_current']) {	
				$m->markCurrent();
				$grid->js(null,$grid->js()->reload())->univ()->successMessage("Session Changed")->execute();
			}
			else
				$grid->js()->univ()->errorMessage("This is Already Current Session")->execute();
			$grid->js()->reload()->execute();
		}

		$grid->setModel('schoolERPApp/Master_Session',array('name','is_current','date','end_date'));
		
		$grid->addColumn('Button','mark_current');

		$btn=$grid->addButton('Create New Session');
		if($btn->isClicked()){
			$this->js()->univ()->frameURL('New Session Create',$this->api->url('schoolERPApp/page_owner_session_createnew'))->execute();
		}

		
	}
}