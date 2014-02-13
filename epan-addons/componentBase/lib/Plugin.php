<?php

namespace componentBase;

abstract class Plugin extends \View{
	public $namespace = null;

	function init(){
		parent::init();

		if($this->namespace === null)
			throw $this->exception('You must define "namespace" public variable in your plugin');

		$this_plugin = $this->add('Model_MarketPlace')->addCondition('namespace',$this->namespace)->tryLoadAny();
		
		if(!$this_plugin->loaded())
			throw $this->exception('Cannot load Plugin')->addMoreInfo('Plugin',$this->namespace);

		if(!$this_plugin['is_system']){
			//TODO And user has not enabled this plugin then do not perform hook or brak hook
		}

	}

	abstract function getDefaultParams($new_epan);
}