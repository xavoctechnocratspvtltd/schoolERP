<?php

class page_owner_epanpages extends page_base_owner {
	
	function page_index(){
		if($_GET['live_edit']){
			$page = $this->add('Model_EpanPage')->load($_GET['live_edit']);
			if($this->api->getConfig('sef_url') AND false){
				$this->js()->_selector('window')->univ()->location("http://".$page->ref('epan_id')->get('name').".epan.in/".$page['name'])->execute();
			}else{
				$this->api->redirect($this->api->url('index',array('epan'=>$this->api->current_website['name'],'subpage'=>$page['name'])));
			}
			exit;
		}

		$this->add( 'H1' )->setHTML( strtoupper($this->api->current_website['name']) . " :: Pages <small>Pages and snapshots for your current website / application </small>" );

		$crud = $this->add('CRUD');
		
		if($f=$crud->form){
			$duplicate_field = $f->addField('dropdown','duplicate_content_from');
			$duplicate_field->setFieldHint('Leave Title, Keywords and Description empty to be copied too..');
			$other_pages_list = $this->add('Model_EpanPage')->addCondition('epan_id',$this->api->current_website->id);
			$duplicate_field->setModel($other_pages_list);
			$duplicate_field->setEmptyText('Empty Page, No Duplicate');
		}

		$crud->setModel($this->api->current_website->ref('EpanPage'),array('name','menu_caption','title','description','keywords'));

		if($f=$crud->form){
			if($f->model->loaded()){
				// Editing Form
				if($f['name']==$this->api->getConfig('default_page')){
					$f->getElement('name')->setAttr('disabled','disabled');
				}
			}
			if($f->isSubmitted()){
				if($f['duplicate_content_from'] != ''){
					$duplicate_from = $this->add('Model_EpanPage')->load($f['duplicate_content_from']);
					$crud->model['content'] = $duplicate_from['content'];
					$crud->model['body_attributes'] = $duplicate_from['body_attributes'];
					if($crud->model['title']=='') $crud->model['title'] = $duplicate_from['title'];
					if($crud->model['description']=='') $crud->model['description'] = $duplicate_from['description'];
					if($crud->model['keywords']=='') $crud->model['keywords'] = $duplicate_from['keywords'];
					$crud->model->save();
				}
			}
		}

		if($g=$crud->grid){

			$g->addMethod('format_disableHomeDelete',function($grid,$field){
				if($grid->model['name']==$grid->api->getConfig('default_page')){
					$grid->current_row_html[$field]='';
				}
			});

			$g->addFormatter('delete','disableHomeDelete');
			$g->addColumn('Button','live_edit');
			$g->addColumn('Expander','snapshots');
			$g->addClass('pages_grid');
			$g->js('reload_me')->reload();
		}

	}

	function page_snapshots(){
		$this->api->stickyGET('epan_page_id');
		$page = $this->add('Model_EpanPage')->load($_GET['epan_page_id']);

		$crud = $this->add('CRUD',array('allow_add'=>false));
		$crud->setModel($page->ref('EpanPageSnapshots'),array('name','created_on','updated_on','title','keywords','description','is_public'));

		if($grid=$crud->grid){
			$grid->addColumn('Confirm','copy','Copy To Live');
		}

		if($_GET['copy']){

			if($this->api->current_website['name'] == 'demo')
				$this->api->js()->univ()->errorMessage('Not Available in demo')->execute();

			$versions = $this->add('Model_EpanPageSnapshots');
			// $versions->addCondition('epan_page_id',$_GET['epan_page_id']);
			$versions->load($_GET['copy']);
			
			$page['title'] = $versions['title']; 
			$page['description'] = $versions['description']; 
			$page['keywords'] = $versions['keywords']; 
			$page['content'] = $versions['content']; 
			$page['body_attributes'] = $versions['body_attributes']; 
			$page->save();
			$grid->js(null,$grid->js()->univ()->successMessage('Selected Version is Copied to main Data'))->_selector('.pages_grid')->trigger('reload_me')->execute();
		}

	}

}