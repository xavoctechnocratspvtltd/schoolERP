<?php

namespace visitorCounterApp;


class View_VisitorCounterMain extends \View{
	public $config;
	function init(){
		parent::init();
		$config_m=$this->add('visitorCounterApp/Model_Config');
		$config_m->addCondition('epan_id',$this->api->current_epan->id);
		$config_m->tryLoadAny();

		$this->config = $config_m;
		if(!$config_m['show_total'])
			$this->template->tryDel('total_visit_visible');
		else{
			$total_visit = $this->add('visitorCounterApp/Model_Visits');
			$total_visit->addCondition('epan_id',$this->api->current_epan->id);
			$total_visit_count = $total_visit->count()->getOne() + $config_m['start_number'];
			$this->template->trySet('total_visit',$total_visit_count);
		}
		if(!$config_m['show_yearly'])
			$this->template->tryDel('yearly_visits_visible');
		else{
			$yealry_visit = $this->add('visitorCounterApp/Model_Visits');
			$yealry_visit->addExpression('yy')->set('YEAR(name)');
			$yealry_visit->addCondition('epan_id',$this->api->current_epan->id);
			$yealry_visit->addCondition('yy',date('Y'));
			$yealry_visit_count = $yealry_visit->count()->getOne();
			$this->template->trySet('yealry_visit',$yealry_visit_count);
		}
		if(!$config_m['show_monthly'])
			$this->template->tryDel('monthly_visits_visible');
		else{
			$monthly_visit = $this->add('visitorCounterApp/Model_Visits');
			$monthly_visit->addExpression('ym')->set('DATE_FORMAT(name,"%Y%m")');
			$monthly_visit->addCondition('epan_id',$this->api->current_epan->id);
			$monthly_visit->addCondition('ym',date('Ym'));
			$monthly_visit_count = $monthly_visit->count()->getOne() ;
			$this->template->trySet('monthly_visit',$monthly_visit_count);
		}

		if(!$config_m['show_daily'])
			$this->template->tryDel('daily_visits_visible');
		else{
			$daily_visit = $this->add('visitorCounterApp/Model_Visits');
			$daily_visit->addCondition('epan_id',$this->api->current_epan->id);
			$daily_visit->addCondition('name','like',date('Y-m-d').' %');
			$daily_visit_count = $daily_visit->count()->getOne();
			$this->template->trySet('daily_visit',$daily_visit_count);
		}

		$this->template->trySet('class','odometer');
		$this->setStyle('font-size',$config_m['font_size']?:'20px');
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

		return array('view/visitorCounterApp-default');
	}

	function render(){
		$this->api->jquery->addStaticStyleSheet('themes/odometer-theme-'.$this->config['theme']);
		$this->api->jquery->addStaticInclude('odometer');
		// $this->js(true)->_load('odometer');
		parent::render();
	}
}