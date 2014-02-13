<?php

class page_install extends Page {
	function init(){
		parent::init();
		$this->add('View')->setHTML('<h1>Epan CMS :: Installer</h1>')->addClass('jumbotron text-center');
		$this->api->template->trySet('page_title','Epan :: Installer');
		if($this->api->getConfig('installed')){
			$this->step4();
			return;
		}
		
		$this->api->stickyGET('step');
		
		$step =isset($_GET['step'])? $_GET['step']:1;


		call_user_method("step$step", $this);
	}

	function step1(){

		$form = $this->add('Form');
		$form->setFormClass('stacked atk-row');
		$form->addField('line','database_host')->validateNotNull();
		$form->addField('line','database_username')->validateNotNull();
		$form->addField('password','database_password');
		$form->addField('line','database_name')->validateNotNull();
		
		$form->addField('line','owner_name')->setAttr("placeholder",'Admin Name')->validateNotNull();
		$form->addField('line','owner_username')->validateNotNull();
		$form->addField('password','owner_password')->validateNotNull();
		$form->addField('password','re_password')->validateNotNull();
		$form->addSubmit('Validate: Go Next');
		$form->add('Order')
                ->move($form->add('View_Info')->set('Database Settings'),'first')
                ->move($form->addSeparator('span6'),'first')
                ->move($form->addSeparator('span5'),'before','owner_name')
                ->move($form->add('View_Info')->set('Admin Settings'),'before','owner_name')
                ->now();

		if($form->isSubmitted()){
			if($form['owner_password']!=$form['re_password'])
				$form->displayError('re_password','password must match');
			$db_config="mysql://".$form['database_username'].":".$form['database_password']."@".$form['database_host']."/".$form['database_name'];
			try{
				$this->api->dbConnect($db_config);
			}catch(Exception $e){
				$form->js()->univ()->errorMessage($e->getMessage())->execute();
			}

			//count database tables 
			$q="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '" . $form['database_name'] . "'";
			$tables_count=$this->api->db->dsql($this->api->db->dsql()->expr($q))->getOne();
			//if count is >0 
			//throw exception it is allready used
			if($tables_count)
				$form->js()->univ()->errorMessage('Database allready contains tables, Cannot proceed')->execute();
			//
			//install sql file
			//TODO USE Fopen instead file get content
			$sql = file_get_contents('install.sql');
			$this->api->db->dsql($this->api->db->dsql()->expr($sql))->execute();

			//replace values in config-default file
			//mark installed = true;
			//
			
			$config=file_get_contents('config-default.php');
			$config=str_replace('{database_username}',$form['database_username'],$config);
			$config=str_replace('{database_password}',$form['database_password'],$config);
			$config=str_replace('{host}',$form['database_host'],$config);
			$config=str_replace('{database}',$form['database_name'],$config);
			file_put_contents('config-default.php',$config);

			//create owner user 
			$epan=$this->add('Model_Epan')->tryLoadAny();

			$user=$this->add('Model_Users');
			$user['epan_id']=$epan->id;
			$user['name']=$form['owner_name'];
			$user['username']=$form['owner_username'];
			$user['password']=$form['owner_password'];
			$user['type']='SuperUser';
			$user['is_active']=true;
			$user->save();

			$form->js(null,$form->js()->univ()->redirect($this->api->url(null,array('step'=>2))))->univ()->successMessage("Installed Successfully")->execute();
		}

	}

	function step2(){
		// Ask outgoing Email Settings :: skippable
		$this->api->dbConnect();
		$web = $this->add("Model_Epan")->tryLoadAny();
		$email_form = $this->add('Form');
		$email_form->setFormClass('stacked atk-row');
		$email_form->setModel($web,array('email_host','email_port','email_username','email_password','email_reply_to','email_reply_to_name','email_from','email_from_name'));
		$email_form->addSubmit('Update');

		$email_form->getElement('email_host')->setAttr('placeholder','i.e. ssl://mail.domain.com');
		$email_form->getElement('email_port')->setAttr('placeholder','465');
		$email_form->getElement('email_username')->setAttr('placeholder','your email id');
		$email_form->getElement('email_password')->setAttr('placeholder','your email password');
		$email_form->getElement('email_reply_to')->setAttr('placeholder','i.e. info@domain.com');
		$email_form->getElement('email_reply_to_name')->setAttr('placeholder','Your Name');
		$email_form->getElement('email_from')->setAttr('placeholder','Your email id');
		$email_form->getElement('email_from_name')->setAttr('placeholder','Your Name');

		$email_form->add('Order')
                ->move($email_form->add('View_Info')->set('Email Basic Settings'),'first')
                ->move($email_form->addSeparator('span6'),'first')
                ->move($email_form->addSeparator('span5'),'before','email_reply_to')
                ->move($email_form->add('View_Info')->set('Email Sender Details'),'before','email_reply_to')
                ->now();
		$skip_button=$email_form->addSubmit('Skip');

		if($skip_button->isClicked())
			$email_form->js(null,$email_form->js()->univ()->redirect($this->api->url(null,array('step'=>3))))->execute();
		
		if($email_form->isSubmitted()){
			$email_form->update();
			$email_form->js(null,$email_form->js()->univ()->redirect($this->api->url(null,array('step'=>3))))->execute();
		}


	}

	function step3(){
		// Ask Epan general Settings here :: skippable
		$this->api->dbConnect();
		$web=$this->add('Model_Epan')->tryLoadAny();
		$this->add('View_Info')->set('Company Basic Detils');
		$epan_info_form = $this->add('Form');
		$epan_info_form->setFormClass('stacked atk-row');
		$epan_info_form->setModel($web,array('category_id','company_name','contact_person_name','mobile_no','email_id','address','city','state','country','keywords','description'));
		$epan_info_form->addSubmit('Update');
		$epan_info_form->add('Order')
                ->move($epan_info_form->addSeparator('span6'),'first')
                ->move($epan_info_form->addSeparator('span5'),'before','city')
                ->move($epan_info_form->addSeparator('span5'),'before','city')
                ->now();
		if($epan_info_form->isSubmitted()){
			$epan_info_form->update();		
			$config=file_get_contents('config-default.php');
			$config=str_replace('$config[\'installed\']=false;','$config[\'installed\']=true;',$config);
			file_put_contents('config-default.php',$config);
			$epan_info_form->js(null,$epan_info_form->js()->univ()->redirect($this->api->url(null,array('step'=>4))))->univ()->successMessage("Installed Successfully")->execute();
		}
	}

	function step4(){
		$this->add('View')->set('Epan CMS is installed sucessfully')->addClass('text-center alert alert-success');
		$outer_div=$this->add('View');
		$outer_div->addClass('container well');
		$outer_div->setStyle('width','30%');

		$inner_div = $outer_div->add('View');

		$site_btn=$inner_div->add('Button')->set('View Site')->addClass('btn btn-primary btn-block');
		$admin_btn=$inner_div->add('Button')->set('Go To Admin Panel')->addClass('btn btn-primary btn-block');
		
		$site_btn->js('click',$this->js()->univ()->redirect($this->api->url('index')));
		$admin_btn->js('click',$this->js()->univ()->redirect($this->api->url('index',array('page'=>'owner_dashboard'))));
	}

	function render(){
		$this->api->template->appendHTML('js_include','<link type="text/css" href="templates/default/css/epan.css" rel="stylesheet" />'."\n");
		parent::render();
	}
}