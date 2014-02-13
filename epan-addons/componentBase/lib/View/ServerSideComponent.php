<?php

namespace componentBase;


class View_ServerSideComponent extends View_Component {
	public $responsible_namespace = null;
	public $responsible_view = null;

	function init(){
		parent::init();

		if($this->responsible_namespace == null)
			throw $this->exception('Define class variable "responsible_namespace"');

		if($this->responsible_view == null )
			throw $this->exception('Define class variable "responsible_view"');

		$this->setAttr('data-responsible-namespace',$this->responsible_namespace);
		$this->setAttr('data-responsible-view',$this->responsible_view);
		$this->setAttr('data-is-serverside-component','true');


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

		return array('view/componentBase-serversidecomponent');
	}
}