<?php

class Model_EpanCategory extends Model_Table {
	var $table= "epan_categories";
	function init(){
		parent::init();

		$this->hasOne('EpanCategory','parent_category_id');
		$this->addField('name');
		$this->addField('description');
		$this->hasMany('Epan','category_id');
		$this->hasMany('EpanAdds','category_id');
		$this->hasMany('EpanCategory','parent_category_id');

		// $this->add('dynamic_model/Controller_AutoCreator');

	}
}