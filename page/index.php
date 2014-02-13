<?php

class page_index extends Page {
	function init(){
		parent::init();

		if($this->api->auth->isLoggedIn() AND $this->api->auth->model->ref('epan_id')->get('name')==$this->api->website_requested AND ($this->api->auth->model['type'] == 'SuperUser' OR $this->api->auth->model['type'] == 'BackEndUser')){
			$this->api->edit_mode=true;			
			$this->api->add('editingToolbar/View_FrontToolBar');
		}
	}
	function setModel($page_model){
		$this->api->template->trySet('page_title',$page_model['title']);
		$this->api->template->trySet('keywords',$page_model['keywords']);
		$this->api->template->trySet('description',$page_model['description']);
		$this->api->template->trySet('style',$page_model['body_attributes']);

		try{
			$this->api->exec_plugins('content-fetched',$page_model);
			$this->template->setHTML('Content',$page_model['content']);
		}catch(Exception_StopInit $e){

		}
		parent::setModel($page_model);
	}

	function recursiveRender(){
		$this->setModel($this->api->current_page);
		parent::recursiveRender();
	}

	function render(){

		$this->api->template->appendHTML('js_include','<script src="templates/js/jquery.sharrre.js"></script>'."\n");

		if($this->api->getConfig('css_mode')=='less'){
			$this->api->template->appendHTML('js_include','<link type="text/css" href="templates/default/css/epan.less" rel="stylesheet/less" />'."\n");
			$this->api->template->appendHTML('js_include','<script src="templates/default/js/less.min.js"></script>'."\n");
		}else{
			$this->api->template->appendHTML('js_include','<link type="text/css" href="templates/default/css/epan.css" rel="stylesheet" />'."\n");
		}

		if($this->api->edit_mode){
			/**
			 * Main Live Editor JavaScript File handling All Editor based working
			 */
			$this->js()->_load('epan_live_edit');

			// Add Div to stop being accessed before fully loaded
			// $this->api->template->appendHTML('Content','<div id="overlay-dark"><H3 id="overlay-dark-message">Wait, Loading ...</h3> </div>');
			$this->api->template->appendHTML('js_include','<link type="text/css" href="templates/default/css/epan_live.css" rel="stylesheet" />'."\n");
			$this->api->template->appendHTML('js_include','<link type="text/css" href="templates/js/jquery.jscrollpane.css" rel="stylesheet" />'."\n");
			$this->api->template->appendHTML('js_include','<script src="templates/js/jquery.jscrollpane.min.js"></script>'."\n");

			// SHORTCUTS
			$this->api->template->appendHTML('js_include','<script src="templates/js/shortcut.js"></script>'."\n");

			// POPLINE EDITING
			$this->api->template->appendHTML('js_include','<link type="text/css" href="templates/js/popline/css/normalize.css" rel="stylesheet" />'."\n");
			$this->api->template->appendHTML('js_include','<link type="text/css" href="templates/js/popline/font-awesome/css/font-awesome.min.css" rel="stylesheet" />'."\n");
			$this->api->template->appendHTML('js_include','<link type="text/css" href="templates/js/popline/themes/default.css" rel="stylesheet" />'."\n");
			$this->api->template->appendHTML('js_include','<script src="templates/js/popline/build/jquery.popline.min.js"></script>'."\n");

			// Google font selector
			$this->api->template->appendHTML('js_include','<link type="text/css" href="templates/js/fontselect.css" rel="stylesheet" />'."\n");
			$this->api->template->appendHTML('js_include','<script src="templates/js/jquery.fontselect.js"></script>'."\n");			

			$this->api->template->appendHTML('js_include',
				'
					<link rel="stylesheet" href="elfinder/css/common.css"      type="text/css">
					<link rel="stylesheet" href="elfinder/css/dialog.css"      type="text/css">
					<link rel="stylesheet" href="elfinder/css/toolbar.css"     type="text/css">
					<link rel="stylesheet" href="elfinder/css/navbar.css"      type="text/css">
					<link rel="stylesheet" href="elfinder/css/statusbar.css"   type="text/css">
					<link rel="stylesheet" href="elfinder/css/contextmenu.css" type="text/css">
					<link rel="stylesheet" href="elfinder/css/cwd.css"         type="text/css">
					<link rel="stylesheet" href="elfinder/css/quicklook.css"   type="text/css">
					<link rel="stylesheet" href="elfinder/css/commands.css"    type="text/css">

					<link rel="stylesheet" href="elfinder/css/fonts.css"       type="text/css">
					<link rel="stylesheet" href="elfinder/css/theme.css"       type="text/css">

					<!-- elfinder core -->
					<script src="elfinder/js/elFinder.js"></script>
					<script src="elfinder/js/elFinder.version.js"></script>
					<script src="elfinder/js/jquery.elfinder.js"></script>
					<script src="elfinder/js/elFinder.resources.js"></script>
					<script src="elfinder/js/elFinder.options.js"></script>
					<script src="elfinder/js/elFinder.history.js"></script>
					<script src="elfinder/js/elFinder.command.js"></script>

					<!-- elfinder ui -->
					<script src="elfinder/js/ui/overlay.js"></script>
					<script src="elfinder/js/ui/workzone.js"></script>
					<script src="elfinder/js/ui/navbar.js"></script>
					<script src="elfinder/js/ui/dialog.js"></script>
					<script src="elfinder/js/ui/tree.js"></script>
					<script src="elfinder/js/ui/cwd.js"></script>
					<script src="elfinder/js/ui/toolbar.js"></script>
					<script src="elfinder/js/ui/button.js"></script>
					<script src="elfinder/js/ui/uploadButton.js"></script>
					<script src="elfinder/js/ui/viewbutton.js"></script>
					<script src="elfinder/js/ui/searchbutton.js"></script>
					<script src="elfinder/js/ui/sortbutton.js"></script>
					<script src="elfinder/js/ui/panel.js"></script>
					<script src="elfinder/js/ui/contextmenu.js"></script>
					<script src="elfinder/js/ui/path.js"></script>
					<script src="elfinder/js/ui/stat.js"></script>
					<script src="elfinder/js/ui/places.js"></script>

					<!-- elfinder commands -->
					<script src="elfinder/js/commands/back.js"></script>
					<script src="elfinder/js/commands/forward.js"></script>
					<script src="elfinder/js/commands/reload.js"></script>
					<script src="elfinder/js/commands/up.js"></script>
					<script src="elfinder/js/commands/home.js"></script>
					<script src="elfinder/js/commands/copy.js"></script>
					<script src="elfinder/js/commands/cut.js"></script>
					<script src="elfinder/js/commands/paste.js"></script>
					<script src="elfinder/js/commands/open.js"></script>
					<script src="elfinder/js/commands/rm.js"></script>
					<script src="elfinder/js/commands/info.js"></script>
					<script src="elfinder/js/commands/duplicate.js"></script>
					<script src="elfinder/js/commands/rename.js"></script>
					<script src="elfinder/js/commands/help.js"></script>
					<script src="elfinder/js/commands/getfile.js"></script>
					<script src="elfinder/js/commands/mkdir.js"></script>
					<script src="elfinder/js/commands/mkfile.js"></script>
					<script src="elfinder/js/commands/upload.js"></script>
					<script src="elfinder/js/commands/download.js"></script>
					<script src="elfinder/js/commands/edit.js"></script>
					<script src="elfinder/js/commands/quicklook.js"></script>
					<script src="elfinder/js/commands/quicklook.plugins.js"></script>
					<script src="elfinder/js/commands/extract.js"></script>
					<script src="elfinder/js/commands/archive.js"></script>
					<script src="elfinder/js/commands/search.js"></script>
					<script src="elfinder/js/commands/view.js"></script>
					<script src="elfinder/js/commands/resize.js"></script>
					<script src="elfinder/js/commands/sort.js"></script>	
					<script src="elfinder/js/commands/netmount.js"></script>

					<script src="elfinder/js/jquery.dialogelfinder.js"></script>

					<!-- elfinder 1.x connector API support -->
					<script src="elfinder/js/proxy/elFinderSupportVer1.js"></script>
					'
				."\n");
		}

		$user_css = '/epans/'.$this->api->current_website['name'].'/mystyles.css';
		if(file_exists(getcwd().$user_css)){
			$this->api->template->appendHTML('js_include','<link type="text/css" href="'.$user_css.'" rel="stylesheet" />'."\n");
		}

		parent::render();
	
	}
}