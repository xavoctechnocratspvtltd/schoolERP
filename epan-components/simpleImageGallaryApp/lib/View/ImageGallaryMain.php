<?php

namespace simpleImageGallaryApp;

class View_ImageGallaryMain extends \View{
	public $config;
	function init(){
		parent::init();
		$gallary = $this->add('simpleImageGallaryApp/Model_Gallaries');
		$gallary->addCondition('epan_id',$this->api->current_epan->id);

		// TODO as per selected from option
		if(isset($this->options)){
			$gallary->tryLoad($this->options);
		}else{
			$gallary->tryLoadAny();
		}

		if(!$gallary->loaded()) return;

		$this->config = $config = $gallary->ref('simpleImageGallaryApp/Config')->tryLoadAny();
		if(!$config->loaded()) $config->save();


		$tags_collection = array();
		foreach ($img = $gallary->ref('simpleImageGallaryApp/Images') as $junk) {
			$item_container=$this->add('View');

			$image_container = $item_container;
			if($config['use_lightbox']){
				$a= $item_container->add('View')->setElement('a')
					->setAttr('href',$img['image'])
					->setAttr('rel','prettyPhoto['.$this->short_name.']')
					->setAttr('title',$img['description'])
					;
				$image_container = $a;
			}
			
			$img_view= $image_container->add('View')
				->setElement('img')
				->setAttr('alt',$img['name']);
				if($config['use_thumbnails']){
					$img_view->setAttr('src',$img->ref('image_id')->ref('thumb_file_id')->get('url'));
				}else{
					$img_view->setAttr('src',$img['image']);
				}
				// ->setAttr('width',"50%")
				// ->setAttr('height',"50%")
				$item_container->addClass('item');
				$item_container->setStyle('max-width',$config['max_width']);
				$img_view->addClass('img-thumbnail');

			if($config['show_title'] AND !$config['show_title_in_lightbox_only']){
				$item_container->add('View')->set($img['name'])->addClass('simpleimagegallaryapp-item-title');
			}

			foreach (explode(",",$img['tags']) as $t) {
				$item_container->addClass($t);
				if(!in_array(trim($t), $tags_collection))
					$tags_collection[] = trim($t);
			}
		}
		
		if($config['show_tag_selector_to_user']){
			foreach ($tags_collection as $t) {
				$this->template->appendHTML('filter_button','<button data-filter=".'.$t.'"  class="btn btn-default">'.$t.'</button>');
			}
		}else{
			$this->template->tryDel('show_tag_selector_to_user');
		}
		


	}

	function defaultTemplate(){
		$l=$this->api->locate('addons',__NAMESPACE__, 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons',__NAMESPACE__),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css',
		  		'js'=>'templates/js'
				)
			)->setParent($l);

		return array('view/simpleImageGallaryApp-gallaryview');
	}

	function render(){

		$this->api->jquery->addStaticInclude('jquery.prettyPhoto');
		$this->api->jquery->addStaticStylesheet('prettyPhoto');
		$this->js(true)->_load('isotope.pkgd')->isotope(array('layoutModel'=>$this->config['layout_mode'],'cellsByRow'=>array('columnWidth'=>110,'rowHeight'=>110)));
		$this->js(true)->_load('myPrettyPhoto')->univ()
			->myPrettyPhoto("a[rel^='prettyPhoto']",$this->config['lightbox_theme']);

		parent::render();
	}

}