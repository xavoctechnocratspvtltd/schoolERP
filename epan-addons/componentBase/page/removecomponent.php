<?php
class page_componentBase_page_removecomponent extends Page {
	function remove(){
		$this->api->stickyGET('component_id');
		$v=$this->add('View_Error')->set('Are You Sure ?');
		$btn=$this->add('Button')->set('Confirm');

		// Controller EPAN to check if system or not
		// If not from system pages show error in controller to 

		if($btn->isClicked()){			
			$installed=$this->api->current_website
					->ref('InstalledComponents')
					->addCondition('component_id',$_GET['component_id'])
					->tryLoadAny();

			if($installed->loaded()){
				$this->js()->univ()->errorMessage('Uninstall this component first')->execute();
			}	
			$marketplace=$this->add('Model_MarketPlace');
			$marketplace->load($_GET['component_id']);
			
			// Remove from MarketPlace Row
			$marketplace->delete();

			// Run UnInstall.sql if exists
			if(file_exists($file = getcwd().DS.'epan-components'.DS.$marketplace['namespace'].DS.'uninstall.sql')){
				$sql = file_get_contents($file);
				$this->api->db->dsql($this->api->db->dsql()->expr($sql))->execute();
			}
			 
			//and remove Folder
			destroy_dir(dirname($file));

			$this->js()->univ()->successMessage('Done')->execute();
		}

	}
}