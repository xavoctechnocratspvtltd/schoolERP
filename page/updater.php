<?php

class page_updater extends Page {
	function page_a(){
		// parent::init();

		$this->query("UPDATE epan_page SET content=REPLACE(content,'/epans/','epans/')");
		// TODO : Marketplace plugin_hooked not required now
		// TODO : replace in content /epan-addons/ with /epan-components
		// ie 
			// 1. social share script urlCURL
		// 
	}

	function page_b(){
		$user=$this->add('Model_User');
		$epans=$this->add('Model_Epan');
		foreach ($epans as $junk) {
			$user['name']=$epans['name'];
			$user['username']=$epans['username'];
			$user['password']=$epans['password'];
			$user['created_at']=$epans['created_at'];
			$user['type']='SuperUser';
			$user['is_active']=true;
			$user->saveAndUnload();
		}


	}

	function query($q){
		$this->api->db->dsql($this->api->db->dsql()->expr($q))->execute();
	}
}