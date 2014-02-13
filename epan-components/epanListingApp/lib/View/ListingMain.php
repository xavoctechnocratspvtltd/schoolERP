<?php

namespace epanListingApp;

class View_ListingMain extends \View{
	
	function init(){
		parent::init();

		$epan_model = $this->add('Model_Epan');

		if($_GET['category_id']){
			$epan_model->addCondition('category_id',$_GET['category_id']);
			$this->api->stickyGET('category_id');
			$v=$this->add('View')->setHTML('Business Listing for <strong>'. $epan_model->tryLoadAny()->ref('category_id')->get('name') . '</strong>');
			$v->addClass('alert alert-info');
		}

		if($_GET['tags']){
			$this->api->stickyGET('tags');
			$epan_model->addCondition('keywords','like','%'.urldecode($_GET['tags']).'%');
			$v=$this->add('View')->setHTML('Business Listing for <strong>'. urldecode($_GET['tags']) . '</strong>');
			$v->addClass('alert alert-info');	
		}

		$grid = $this->add('epanListingApp/View_Lister_Epan');
		$grid->setModel($epan_model);
		$grid->add('Paginator')->ipp(10);
	}
}