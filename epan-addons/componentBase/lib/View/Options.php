<?php

namespace componentBase;


class View_Options extends \View{
	public $namespace=null;
	public $component_type=null;

	function init(){
		parent::init();
		
		// PREPEND to Common Oprions Div ... 
		$this->js(true)->hide()->prependTo('#common-options-div');

		$this->template->trySet('namespace',$this->namespace);
		$this->template->trySet('component_type',$this->component_type);

	}

	function defaultTemplate(){
		$l=$this->api->locate('addons',$this->namespace, 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons',$this->namespace),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);
		return array('view/'.$this->namespace.'-'.strtolower($this->component_type).'-options');
	}
}