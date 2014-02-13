<?php
class Model_Messages extends Model_Table{
	public $table="messages";
	function init(){
		parent::init();
		$this->hasOne('Epan','epan_id');
		$this->addField('name')->caption('Title');
		$this->addField('message')->type('text');
		$this->addField('created_at')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));
		$this->addField('is_read')->type('boolean');
		$this->addField('sender_signature');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}