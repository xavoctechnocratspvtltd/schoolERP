<?php

namespace systemcontentmanipulationPlugins;


class Plugins_RunServerSideComponent extends \componentBase\Plugin {
	public $namespace = 'systemcontentmanipulationPlugins';

	function init(){
		parent::init();
		$this->addHook('content-fetched',array($this,'runServerSideComponent'));
	}

	function runServerSideComponent($obj,$page){
		include_once (getcwd().'/lib/phpQuery/phpQuery/phpQuery.php');
		$doc = \phpQuery::newDocument($page['content']);
		
		$server = $doc['[data-is-serverside-component=true]'];
		foreach($doc['[data-is-serverside-component=true]'] as $ssc){

			$namespace =  pq($ssc)->attr('data-responsible-namespace');
			$view =  pq($ssc)->attr('data-responsible-view');
			$temp_view = $this->add("$namespace/$view",array('options'=>pq($ssc)->attr('data-options')));
			$html = $temp_view->getHTML();
			pq($ssc)->html("")->append($html);

		}
		$page['content'] = $doc->htmlOuter();
	}

	function getDefaultParams($new_epan){}
}
