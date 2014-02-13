<?php

class page_menubarModule_page_getmenus extends page_base_editorAjax {
	function init(){
		parent::init();

		$menus = "";

		foreach ($this->api->current_epan->ref('EpanPage')->addCondition('menu_caption','<>',"") as $pages) {
			if($this->api->getConfig('sef')){
				$menus .= '<li><a href="/'.$pages['name'].'">'.$pages['menu_caption'].'</a></li>';
			}else{
				$menus .= '<li><a href="?page=epan&epan='.$this->api->current_epan['name']. '&subpage=' .$pages['name'].'">'.$pages['menu_caption'].'</a></li>';
			}
		}

		echo $menus;
		exit;

	}
}