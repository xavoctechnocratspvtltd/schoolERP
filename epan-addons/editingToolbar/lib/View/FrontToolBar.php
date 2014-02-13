<?php

namespace editingToolbar;
/**
 * This is frontend tool bar class render it self as well as tools
 */

class View_FrontToolBar extends \View{
	function init(){
		parent::init();
		
		// Get All Elements 
		$market_place = $this->add('Model_MarketPlace')->addCondition('type','element');
		foreach ($market_place->getRows() as $cmp) {
			foreach (new \DirectoryIterator(getcwd().DIRECTORY_SEPERATOR.'epan-components'.DIRECTORY_SEPERATOR.$cmp['namespace'].DIRECTORY_SEPERATOR.'lib'.DIRECTORY_SEPERATOR.'View'.DIRECTORY_SEPERATOR.'Tools') as $fileInfo) {
				if($fileInfo->isDot()) continue;
				$this->add($cmp['namespace'].'/View_Tools_'.trim($fileInfo->getFilename(),'.php'),null,'tools');
			}
		}

		// Get All INSTALLED Modules and Applications
		$installed_components  = $this->api->current_website->ref('InstalledComponents');
		// TODO DELETE FOLLOWING LINE
		// $componenet_j = $installed_components->join('epan_components_marketplace','component_id');
		$installed_components->addCondition('has_toolbar_tools',true);

		foreach ($installed_components as $junk) {
			// TODO DELETE FOLLOWING LINE
			// $cmp = $installed_components->ref('component_id');
			foreach (new \DirectoryIterator(getcwd().DIRECTORY_SEPERATOR.'epan-components'.DIRECTORY_SEPERATOR.$installed_components['namespace'].DIRECTORY_SEPERATOR.'lib'.DIRECTORY_SEPERATOR.'View'.DIRECTORY_SEPERATOR.'Tools') as $fileInfo) {
			    if($fileInfo->isDot()) continue;
			    // echo $fileInfo->getFilename() . "<br>\n";
				$this->add($installed_components['namespace'].'/View_Tools_'.trim($fileInfo->getFilename(),'.php'),null,'tools');
			}
		}

		$this->add('componentBase/View_CssOptions',null,'common_css_options')->js(true)->hide();
		// $this->template->trySet('current_epan_id',$this->api->current_epan->id);
		// $this->template->trySet('current_epan_page_id',$this->api->current_page->id);
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
		return array('view/editingToolbar-toolbar');
	}
} 