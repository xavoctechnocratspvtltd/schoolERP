<?php
class Model_Alerts extends Model_Table{
	public $table="alerts";
	function init(){
		parent::init();
		$this->hasOne('Epan','epan_id');
		$this->addField('name')->caption('Title');
		$this->addField('created_at')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
		$this->addField('is_read')->type('boolean');
		$this->addField('type')->enum(array('default','primary','success','info','warning','Danger'));
		$this->addField('sender_signature');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}