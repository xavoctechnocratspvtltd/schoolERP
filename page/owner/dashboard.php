<?php

class page_owner_dashboard extends page_base_owner {
	function init() {
		parent::init();
		$this->add( 'H1' )->setHTML( strtoupper($this->api->current_website['name']) . " Dashboard <small>One shot view for your Website/Application</small>" );
	}
}