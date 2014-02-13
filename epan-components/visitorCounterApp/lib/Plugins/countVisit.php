<?php

namespace visitorCounterApp;

class Plugins_countVisit extends \componentBase\Plugin{
	public $namespace = 'visitorCounterApp';

	function init(){
		parent::init();
		$this->addHook('epan-hit',array($this,'countVisit'));
	}

	function countVisit($obj,&$epan){
		if(!$this->api->recall('visitcounted',false)){
			$m= $this->add('visitorCounterApp/Model_Visits');
			$m['epan_id'] = $epan->id;
			$m['name']=date('Y-m-d H:i:s');
			$m['IP'] = $this->get_client_ip();
			$m->save();
			$this->api->memorize('visitcounted',true);
		}
		
	}

	function getDefaultParams($new_epan){}

	function get_client_ip() {
	     $ipaddress = '';
	     if ($_SERVER['HTTP_CLIENT_IP'])
	         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	     else if($_SERVER['HTTP_X_FORWARDED_FOR'])
	         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	     else if($_SERVER['HTTP_X_FORWARDED'])
	         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	     else if($_SERVER['HTTP_FORWARDED_FOR'])
	         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	     else if($_SERVER['HTTP_FORWARDED'])
	         $ipaddress = $_SERVER['HTTP_FORWARDED'];
	     else if($_SERVER['REMOTE_ADDR'])
	         $ipaddress = $_SERVER['REMOTE_ADDR'];
	     else
	         $ipaddress = 'UNKNOWN';

	     return $ipaddress; 
	}
}