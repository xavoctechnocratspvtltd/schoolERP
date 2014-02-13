<?php

class Model_Staff extends Model_Table {
	var $table= "staff";
	function init(){
		parent::init();

		$this->hasOne('Branch','branch_id');
		$this->addField('name');
		$this->addField('username');
		$this->addField('password');
		$this->addField('access_level')->setValueList(array('100'=>'Company','80'=>'Branch Admin', '50'=>'Senior Staff', 30=>'Editor'));
		$this->hasMany('Epan','staff_id');
	}
}