<?php

namespace epanListingApp;

class View_MarketPlaceMain extends \View{
	
	function init(){
		parent::init();

		$mpl=$this->add('epanListingApp/View_Lister_MarketPlaceList');
		$mpl->setModel('MarketPlace');
	}
}