<?php

namespace epanListingApp;

class View_CategoryMain extends \View{
	
	function init(){
		parent::init();

		$categories = $this->add('Model_EpanCategory');

		$categories->addExpression('epans_count')->set(function($m,$q){
			return $m->refSQL('Epan')->count();
		});

		$categories->addCondition('epans_count','>',0);

		foreach ($categories as $cat) {
			$v=$this->add('View');
			$v->setElement('a')->setAttr('href',$this->api->url(null,array('category_id'=>$cat['id'])))->set($cat['name']);
			if($this_cat = $_GET['category_id'] AND $this_cat == $cat['id'] ){
				$v->addClass('btn btn-primary');
			}else{
				$v->addClass('btn btn-default');
			}
		}

	}
}