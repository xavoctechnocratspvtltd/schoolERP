<?php

namespace companyERP;

class View_MyMenu extends \Menu_Basic{
	function init(){
		parent::init();
		
	}

	function addMenuItem($page,$label=null,$panel_type='danger',$icon='gears'){
        if(!$label){
            $label=ucwords(str_replace('_',' ',$page));
        }
        $id=$this->name.'_i'.count($this->items);
        $label=$this->api->_($label);
        $js_page=null;
        if($page instanceof jQuery_Chain){
            $js_page="#";
            $this->js('click',$page)->_selector('#'.$id);
            $page=$id;
        }
        $this->items[]=array(
            'id'=>$id,
            'page'=>$page,
            'href'=>$js_page?:$this->api->url($page),
            'label'=>$label,
            'panel_type'=>$panel_type,
            'icon'=>$icon,
            $this->class_tag=>$this->isCurrent($page)?$this->current_menu_class:$this->inactive_menu_class,
        );
        return $this;
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
		return array('view/mymenu');
	}
}