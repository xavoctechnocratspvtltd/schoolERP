<?php

class Controller_EpanCMSApp extends AbstractController {

	function frontEnd() {}

	/**
	 * This function sets website_requested and page_requested
	 * properties in api from HTTP_REFERRER from subdomain
	 */
	function setWebsiteFromReferrer() {}

	function addAliasesPage(){}

	function ownerComponentRepository(){}

	function emailSettings(&$email){}
	
	function cmsMarketPlaceView(){}

	function epanModel(){
		$this->owner->addField('grace_period_end_date')->type('date')->defaultValue(date('Y-m-d',strtotime('+3 day',strtotime(date('Y-m-d')))));
		$this->owner->addField('last_paid_on')->type('date')->defaultValue(null);
		$this->owner->addField('pay_to_company')->defaultValue('400');

	}



}