<?php

namespace componentBase;

class View_CssOptions extends \View{
	function init(){
		parent::init();
	}

	function render(){
		$this->api->jquery->addStaticStyleSheet('pick-a-color-1.1.8.min');
		$this->js()
			->_load('tinycolor-0.9.15.min')
			->_load('pick-a-color-1.1.8.min')
			;
		$this->js(true)->_selector('.epan-color-picker')->pickAColor();
		parent::render();
	}

	function defaultTemplate(){
		$l=$this->api->locate('addons',__NAMESPACE__, 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons',__NAMESPACE__),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);

		return array('view/default/cssoptions');
	}
}