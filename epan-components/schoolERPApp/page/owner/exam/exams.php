<?php
class page_schoolERPApp_page_owner_exam_exams extends page_componentBase_page_owner_main{
  function page_index(){
  

    
    $exams=$this->add('schoolERPApp/Model_Exam_Exams');
    $crud=$this->add('CRUD');
    $crud->setModel($exams); 
    
    
    
    }
}    
        


