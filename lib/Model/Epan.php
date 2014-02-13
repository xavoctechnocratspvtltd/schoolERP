<?php

class Model_Epan extends Model_Table {
	var $table= "epan";
	function init(){
		parent::init();

		$this->hasOne('Staff','staff_id');
		$this->hasOne('Branch','branch_id');
		$this->hasOne('EpanCategory','category_id')->mandatory('Please Select A Category');
		
		// Name is Default Alias for this epan
		$this->addField('name')->caption('Epan Name')->hint('Any unique name for your epan like your_epan_name.epan.in')->mandatory('Epan alias is must');
		// $this->addField('alias2')->caption('Alias 2')->hint('Any unique name for your epan like your_epan_name.epan.in')->mandatory('Epan alias is must');
		$this->addField('password')->mandatory('Password is must to proceed')->type('password');
		$this->addField('fund_alloted');
		$this->addField('company_name');
		$this->addField('contact_person_name');
		$this->addField('mobile_no');
		$this->addField('address')->type('text');
		$this->addField('city');
		$this->addField('state');
		$this->addField('country');
		$this->addField('email_id');
		$this->addField('website');
		$this->addField('is_active')->type('boolean');
		$this->addField('is_approved')->type('boolean')->defaultValue(false);
		$this->addField('created_at')->defaultValue(date('Y-m-d H:i:s'))->sortable(true)->system(true);
		$this->addField('keywords')->caption('Keywords')->type('text')->mandatory('');//->system(true);
		$this->addField('description')->type('text');//->system(true);
		$this->addField('last_email_sent')->type('datetime')->defaultValue(date('Y-m-d H:i:s'));

		// Email Settings
		$this->addField('email_host');
		$this->addField('email_port');
		$this->addField('email_username');
		$this->addField('email_password')->type('password');
		$this->addField('email_reply_to');
		$this->addField('email_reply_to_name');
		$this->addField('email_from');
		$this->addField('email_from_name');

		$this->addField('parked_domain')->hint('Specify your domain in yourdomainname.com format');

		$this->addField('allowed_aliases')->type('int')->defaultValue(2);
		
		$this->hasMany('Users','epan_id');
		
		// User options
		$this->addField('is_frontent_regiatrstion_allowed')->type('boolean')->defaultValue(true);
		$this->addField('user_activation')->enum(array('self_activated','admin_activated',"default_activated"))->defaultValue('self_activated')->mandatory(true);


		$this->hasMany('Aliases','epan_id'); 


		$this->hasMany('EpanPage','epan_id');
		$this->hasMany('InstalledComponents','epan_id');
		$this->hasMany('Messages','epan_id');
		$this->hasMany('Alerts','epan_id');

		$this->addHook('afterInsert',$this); // Add Default Page n Add Default Alaises

		$this->addHook('beforeSave',$this);
		$this->addHook('beforeInsert',$this);

		$this->addHook('beforeDelete',$this);

		$this->setOrder('created_at','desc');
		$this->add('Controller_EpanCMSApp')->epanModel();
		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeDelete(){
		
		// throw new Exception($new_dir_name, 1);
		
		if($this->ref('Aliases')->count()->getOne() > 1)
			$this->api->js()->univ()->errorMessage('Delete Non Default Aliases first')->execute();

		$new_dir_name=getcwd(). "/epans/".$this['name'];
		if(is_dir($new_dir_name)){
			// throw new Exception("yap it is ", 1);
			if(!destroy_dir($new_dir_name))
				throw $this->exception('Couldn\'t delete forlder at '. $new_dir_name. ', exiting process ...');
		}

		foreach($a=$this->ref('Aliases') as $junk){
			$a->memorize('force_delete',true);
			$a->delete();
		}
		// Delete All users 
		$this->ref('Users')->deleteAll();
	}


	function beforeSave(){

		if(!preg_match('/^[a-z0-9\-]+$/', $this['name']))
			throw $this->exception('URL can only contain lowercase alphabets, numbers and - ' . $this['name'],'ValidityCheck')->setField('name');

		if(strlen($this['name'])>60)
			throw $this->exception('Max URL length: 60 Characters only, while it is '.strlen($this['name']));
		//on epan create upadate username and password in user table also
		


		// Check existig alias name
		$existing_aliases = $this->add('Model_Aliases');
		$existing_aliases->addCondition('name',$this['name']);

		if($this->loaded()){
			$existing_aliases->addCondition('epan_id','<>',$this->id);
		}

		$existing_aliases->tryLoadAny();
		
		if($existing_aliases->loaded()){
			throw $this->exception('This Epan Name is already taken,try another alias','ValidityCheck')->setField('name')->addMoreInfo('alias',$this['name']);
		}

		if($this->loaded() and $this->dirty['name']){
			// Epan Renamed 

			$epan=$this->add('Model_Epan');
			$epan->load($this->id);
			$old_dir_name=getcwd(). "/epans/".$epan['name'];
			
			if(!is_dir($old_dir_name)){
				throw $this->exception('Couldn\'t get old directory ' . $old_dir_name);
			}

			$new_dir_name=getcwd(). "/epans/".$this['name'];
			rename($old_dir_name, $new_dir_name);
			$base_alias = $epan->ref('Aliases')->addCondition('name',$epan['name'])->tryLoadAny();
			if(!$base_alias->loaded()){
				throw $this->exception('Waht.. base alias not found');
			}else{
				$base_alias['name']=$this['name'];
				$base_alias->saveAndUnload();
			}

			// Replace image urls also
			foreach($epanpage=$this->ref('EpanPage') as $junk){
			
				$epanpage['content']=str_replace("/epans/".$epan['name']."/", "/epans/".$this['name']."/", $epanpage['content']);
				$epanpage['body_attributes']=str_replace("/epans/".$epan['name']."/", "/epans/".$this['name']."/", $epanpage['body_attributes']);
				$epanpage->save();
			
				foreach ($epansnapshots=$epanpage->ref('EpanPageSnapshots') as $junk) {
					$epansnapshots['content']=str_replace("/epan/".$epan['name']."/", "/epan/".$this['name']."/", $epansnapshots['content']);
					$epansnapshots['body_attributes']=str_replace("/epan/".$epan['name']."/", "/epan/".$this['name']."/", $epansnapshots['body_attributes']);
					$epansnapshots->save();
				}
			}

			// Change default username and password also
			$old_epan_entry = $this->add('Model_Epan')->load($this->id);
			$user=$this->add('Model_Users');
			$user->addCondition('username',$old_epan_entry['name']);
			$user->tryLoadAny();
			$user['username']=$this['name'];
			$user['password']=$this['password'];
			$user->saveAndUnload();

		}

		// Set all Pages keywords and description as per this one and title to this->keywords
		if($this->loaded()){
			foreach($ep =$this->ref('EpanPage') as $junk){
				$ep['title'] = $this['keywords'];
				$ep['description'] = $this['description'];
				$ep['keywords'] = $this['keywords'];
				$ep->save();
			}
		}
	}

	function afterInsert($obj,$new_id){
		// Add Default Page
		$epan_page = $this->add('Model_EpanPage');
		$epan_page['name']='home';
		$epan_page['epan_id'] = $new_id;

		$epan_page['title'] = $obj['keywords'];
		$epan_page['description'] = $obj['description'];
		$epan_page['keywords'] = $obj['keywords'];
		
		$epan_page->save();

		// Add Default Alias as per name given to this Epan
		$default_alias = $this->add('Model_Aliases');
		$default_alias['epan_id'] = $new_id;
		$default_alias['name'] = $obj['name'];
		$default_alias->save();
		//Add default users
			
		$user=$this->add('Model_Users');
		$user->addCondition('epan_id',$new_id);
		$user['username']=$this['username'];
		$user['password']=$this['password'];


		// Default Components Auto Installation
		$default_component= $this->add('Model_MarketPlace');
		$default_component->addCondition('type','<>','element')->addCondition('default_enabled',true);

		foreach ($default_component as $def_comp) {
			$ep=$this->add('Model_InstalledComponents');
			$ep['epan_id']=$new_id;
			$ep['component_id'] = $def_comp['id'];
			$ep['enabled']=true;
			$ep['params'] = "";//$this->add($default_component['namespace'].'/'.$default_component['name'])->getDefaultParams($obj);
			$ep->save();
		}
		
		// TODO call-plugin AfterNewEPANCreated
		// $this->sendDetailsEmail();
	}

	function beforeInsert(){
		// $new_dir_path = $this->api->getConfig('epan_path'). "/".$this['name'];
		$new_dir_path=getcwd(). "/epans/".$this['name'];
		if(!file_exists($new_dir_path)) {
			if(!mkdir($new_dir_path,0777)){
				$this->api->js()->univ()->errorMessage("Could not create folder ".$new_dir_path)->execute();
			}
		}else{
			throw $this->exception('This folder already exists')->addMoreInfo('path',$new_dir_path);
		}

		if(@$this->api->auth){
			$this['branch_id'] = $this->api->auth->model['branch_id'];
			$this['staff_id'] = $this->api->auth->model->id;
			if($this->ref('branch_id')->get('points') <= $this->api->auth->model->ref('branch_id')->get('epans_count')){
				$this->api->js()->univ()->errorMessage("You do not have more points to create Epan.")->execute();
			}
		}else{
			$this['branch_id']=1;
			$this['staff_id']=1;
		}
	}

	function sendEmail(){
		
		$tm=$this->add( 'TMail_Transport_PHPMailer' );
		$msg=$this->add( 'SMLite' );
		$msg->loadTemplate( 'mail/epan-credentials-email' );

		$msg->trySet('epan',$this['name']);
		$msg->trySetHTML('username',$this['name']);
		$msg->trySetHTML('password',$this['password']);

		$aliases = "<br/>";
		foreach ($al = $this->ref('Aliases') as $junk) {
			$aliases .= "http://".$junk['name'].".epan.in <br/>";
		}
		$msg->trySetHTML('aliases',$aliases);


		$email_body=$msg->render();

		$subject ="Your Epan Credentials";

		try{
			$tm->send( $this['email_id'], "info@epan.in", $subject, $email_body ,false,null);
		}catch( phpmailerException $e ) {
			// throw $e;
			$this->api->js()->univ()->errorMessage( $e->errorMessage() . " --- " . $this['email_id']  )->execute();
		}catch( Exception $e ) {
			throw $e;
		}	

		$this['last_email_sent'] = date('Y-m-d H:i:s');
		$this->save();	
	}
}




// GLOBAL FUNCTION OUT OF CLASS

if(!function_exists('destroy_dir')){

function destroy_dir($dir) { 
    if (!is_dir($dir) || is_link($dir)) return unlink($dir); 
        foreach (scandir($dir) as $file) { 
            if ($file == '.' || $file == '..') continue; 
            if (!destroy_dir($dir . DIRECTORY_SEPARATOR . $file)) { 
                chmod($dir . DIRECTORY_SEPARATOR . $file, 0777); 
                if (!destroy_dir($dir . DIRECTORY_SEPARATOR . $file)) return false; 
            }; 
        } 
        return rmdir($dir); 
    } 
}