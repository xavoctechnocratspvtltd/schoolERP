<?php

class page_session_createnew extends Page {
	function init(){
		parent::init();

$session = $this->add('Model_Sessions_Current')->tryLoadAny();
				$old_Session = $session->id;
				// ====== Mandatory
				// new entry in session master
				$new_session_obj = $this->add('Model_Master_Session');
				$new_session = $new_session_obj->create($form->get('name'), $form->get('date'), $form->get('date'));
				$new_session_obj->load($new_session);
				$new_session_obj->markCurrent();
			}
		}
				