<?php

namespace visitorCounterApp;

class View_VisitorCounter extends \componentBase\View_ServerSideComponent {
	public $responsible_namespace = __NAMESPACE__;
	public $responsible_view = 'View_VisitorCounterMain';
	public $namespace=__NAMESPACE__;
	// public $self_rendered=false;
	public $is_sortable = false;
	public $items_allowed =null;
	public $items_cancelled=null;
	public $component_type;
	public $is_resizable=false;
}