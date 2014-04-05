<?php    
class page_schoolERPApp_page_owner_session_createnew extends page_componentBase_page_owner_main{
	function init(){
		parent::init();


		$form=$this->add('Form');
		$class=$this->add('schoolERPApp/Model_Master_Class');
		$i=1;

		$form->addField('line','name');
		$form->addField('DatePicker','start_date');
		$form->addField('DatePicker','end_date');


		foreach ($class as $junk) {
			$field_from_class=$form->addField('dropdown','from_class_'.$i)->setEmptyText('---')->validateNotNull()->addClass('hindi');
			$field_from_class->setModel($class);
			$field_to_class=$form->addField('dropdown','to_class_'.$i)->setEmptyText('---')->addClass('hindi');
			$field_to_class->setModel($class);
			$i++;
		}

		$form->addSubmit('Proceed');

		if($form->isSubmitted()){
			try{



				$this->api->db->beginTransaction();


				// throw $this->exception("Not Implemented Yet");
				
				$to_promote=array(
					'Model_SubjectClassMapAll',
					'Model_ExamClassMapAll',
					'Model_FeeClassMapping',
					'Model_ExamClassSubjectMapAll'
					);

				$session = $this->add('schoolERPApp/Model_Model_Currentsession')->tryLoadAny();
				$old_Session = $session->id;
				// ====== Mandatory
				// new entry in session master
				$new_session_obj = $this->add('schoolERPApp/Model_Master_Session');
				$new_session = $new_session_obj->create($form->get('name'), $form->get('start_date'), $form->get('end_date'));
				$new_session_obj->load($new_session);
				$new_session_obj->markCurrent();
				// prmote each class student to new class

				$student = $this->add('schoolERPAApp/Model_School_Student');
				$classes=$this->add('schoolERPApp/Model_Master_Class');
				$i=1;
				foreach($classes as $c){
					$from_class = $form->get('from_class_'.$i);
					$to_class = $form->get('to_class_'.$i);
					if($to_class != null) $student->promote($old_Session, $new_session, $from_class, $to_class);
					$i++;
				}


				// ====== Help to operator
				// foreach($to_promote  as $obj){
				// 	$this->add($obj)->promote($old_Session, $new_session);
				// }
					// subject class map 
				// copy exammap with new session id by looking previouse exammap_id

				// copy exam subject map with new exam map id based on previouse exammap id(complax)
				// copy fees class mapping
				// copy fee applicable
				
				// save new sessions id in current(previouse) sessions next_session_id 


				$this->api->db->commit();
				$this->js()->univ()->successMessage("Done")->execute();
				// $this->js()->univ()->closeDialog()->successMessage("Done")->execute();
			 }catch(Exception $e){
				$this->api->db->rollback();
				$this->js()->univ()->errorMessage($e->getMessage())->execute();
				// $this->js()->univ()->closeDialog()->errorMessage($e->getMessage())->execute();
			}
		}
	}
}