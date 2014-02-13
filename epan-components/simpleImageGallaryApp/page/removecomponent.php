<?php
class page_simpleImageGallery_page_removecomponent extends page_componentBase_page_removecomponent {
	function init(){
		parent::init();

		$this->remove();
	}
}