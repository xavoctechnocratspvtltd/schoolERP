<?php
namespace componentList;
class View_MarketPlaceComponents extends \CompleteLister {
	public $from_system=false;	
	function formatRow(){
		$type = $this->current_row['type'] = strtoupper(substr($this->model['type'], 0,1));
		switch ($type) {
			case 'M':
				$panel_type='success';
				$icon = 'gear';
				break;
			case 'P':
				$panel_type='warning';
				$icon = 'angle-double-right';
				break;
			case 'A':
				$panel_type='danger';
				$icon = 'gears';
				break;
		}
		$this->current_row['panel_type'] = $panel_type;

		$check_installed = $this->add('Model_InstalledComponents')
								->addCondition('epan_id',$this->api->auth->model->id)
								->addCondition('component_id',$this->model->id)
								->setOrder('component_id')
								->tryLoadAny();
		
		if($check_installed->loaded()){
			$this->current_row['icon']='check-circle';
		}else{
			$this->current_row['icon']=$icon;
		}

		$this->current_row['info_btn'] = $this->js()->univ()->frameURL($this->model['name'],$this->api->url('owner_installcomponent',array('component_id'=>$this->model->id)));
		$this->current_row['remove_btn'] = $this->js()->univ()->frameURL("Remove From Repository " . $this->model['name'],$this->api->url($this->model['namespace'].'_page_removecomponent',array('component_id'=>$this->model->id)));

		if(!$this->from_system)
			$this->add('Controller_EpanCMSApp')->cmsMarketPlaceView();
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
		return array('view/marketplace/components');
	}
}