<?php

namespace epanListingApp;

class View_Lister_Epan extends \CompleteLister{
	function formatRow(){
		$aliases = $this->add('Model_Aliases')->addCondition('epan_id',$this->model->id);

		$btn = "<div class='btn btn-warning pull-right'>";
		foreach($aliases as $junk){	
			$btn .= "<a href='http://".$junk['name'].".epan.in' target='_blank'>".$junk['name'].".epan.in</a><br/>";
		}
		$btn .= "</div>";
		$this->current_row_html['aliases']=$btn;
	}
	function defaultTemplate(){
		$l=$this->api->locate('addons','epanListingApp', 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons','epanListingApp'),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);

		return array('view/epanlists');
	}
}