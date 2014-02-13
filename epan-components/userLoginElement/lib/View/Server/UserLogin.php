<?php

namespace userLoginElement;

class View_Server_UserLogin extends \View{
	function init(){
		parent::init();
		if($this->api->auth->isLoggedIn()){
			$this->renderLogoutView();
		}else{
			$this->renderLoginView();
		}
	}

	function renderLogoutView(){
		$this->add('View')->set("Welcome ". $this->api->auth->model['name'] . ",");
		$btn = $this->add('Button')->set('Logout');
		if($btn->isClicked()){
			$this->api->auth->logout();
			$this->api->redirect(null);
		}
	}

	function renderLoginView(){
		$form= $this->add('Form');
		$form->addField('line','username');
		$form->addField('password','password');
		$form->addSubmit('Login');
		if($this->api->current_website['is_frontent_regiatrstion_allowed']){
			$v=$form->add('View')->setElement('a')->setAttr('href','#')->set('Register');
			$v->js('click',$form->js()->univ()->frameURL('New User Registration',$this->api->url('userLoginElement_page_newUser')));
		}

		if($form->isSubmitted()){
			$user = $this->add('Model_Users');
			$user->addCondition('epan_id',$this->api->current_website->id);
			$user->addCondition('username',$form['username']);
			$user->addCondition('password',$form['password']);

			$user->tryLoadAny();
			if(!$user->loaded()){
				$form->displayError('password','Wrong Credentials');
			}else{
				$this->api->auth->login($user);
			}
			$form->js()->univ()->redirect($this->api->url(null))->execute();
		}
	}

}