<?php

namespace systemcontentmanipulationPlugins;

class Plugins_RemoveContentEditable extends \componentBase\Plugin{
	public $namespace = 'systemcontentmanipulationPlugins';

	function init(){
		parent::init();
		$this->addHook('content-fetched',array($this,'outputFetched'));
	}

	function outputFetched($obj,&$page){
		if(!$this->api->edit_mode){
			$page['content'] = str_replace('contenteditable="true"', 'contenteditable="false"', $page['content']);	
		}		
	}

	function getDefaultParams($new_epan){}
}