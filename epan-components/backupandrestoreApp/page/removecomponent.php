<?php
class page_backupandrestoreApp_page_removecomponent extends page_componentBase_page_removecomponent {
	function init(){
		parent::init();
		$this->remove();
	}
}