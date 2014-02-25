<?php
namespace schoolERPApp;
class Model_Master_IssueableItem extends Model_Item{
	public $table='schoolERPApp_issueableitem';
	function init(){
		parent::init();


		$this->addCondition('is_issueableitem',true);
		$this->add('dynamic_model/Controller_AutoCreator');

}
}