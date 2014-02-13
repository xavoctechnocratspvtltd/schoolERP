<?php

class page_backupandrestoreApp_page_owner_main extends page_componentBase_page_owner_main {
	function init(){
		parent::init();

		$l=$this->api->locate('addons','backupandrestoreApp', 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons','backupandrestoreApp'),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);

		$cols = $this->add('Columns');
		$left = $cols->addColumn(6);
		$right = $cols->addColumn(6);
		
		$left->add('H3')->set('Backup');
		$backup_form = $left->add('Form');
		$backup_form->addField('checkbox','basic_backup','Backup Epan, Pages and Images in Folder')->set(true)->setAttr('disabled','disabled');
		$backup_form->addField('checkbox','backup_snapshots')->set(true);
		$backup_form->addField('checkbox','backup_applications_and_settings')->set(true);
		$backup_form->addSubmit('Backup');

		if($backup_form->isSubmitted()){
			$this->api->redirect($this->api->url(null,array(
				'backup'=>1,
				'backup_snapshots'=>$backup_form['backup_snapshots']?:0,
				'backup_applications_and_settings'=>$backup_form['backup_applications_and_settings']?:0
				)));
		}

		$fileDir = getcwd().'/epans/'.$this->api->auth->model['name'].'/';
		if(file_exists($fileDir.'backup.zip')){
			$left->add('View')->setElement('a')->setAttr('href','/epans/'.$this->api->auth->model['name'].'/backup.zip')->set('Download Last Backup');
		}

		$right->add('H3')->set('Restore');
		$form = $right->add('View',null,null,array('view/backupandrestoreApp-restoreform'));

		if($_GET['backup']){
			$this->backup($_GET['backup_snapshots'],$_GET['backup_applications_and_settings']);
		}

		if($_POST['restore_form_submitted']){
			if ($_FILES["backup_file"]["error"] > 0)
			  {
				  $right->add('View_Error')->set("Error: " . $_FILES["backup_file"]["error"]);
			  }
			else
			  {
		  		if(($msg = $this->verifyRestoreFile()) !== true){
		  			$right->add('View_Error')->set($msg);
		  			return;
		  		}
			  	if(!$_POST['keep_existing']){
			  		$right->add('View_Error')->set('Existing Content Deleted');
			  		if(is_dir($fileDir))
				  		destroy_dir($fileDir);
			  // 		if(!mkdir($fileDir,0777)){
					// 	$this->api->js()->univ()->errorMessage("Could not create folder ".$new_dir_path)->execute();
					// }
			  	}
				// move_uploaded_file($_FILES["backup_file"]["tmp_name"],$fileDir.'restore.zip');
				$this->restore();
			  }
		}

	}

	function backup($include_snapshots,$include_apps){
		// Get Epan Details
		$epan = $this->add('Model_Epan');
		$epan->addCondition('id',$this->api->auth->model->id);

		$data=array();
		foreach ($epan as $epan_array) {
			$data['epan']=$epan_array;
		}
		$epan->tryLoadAny();

		// GET ALIASES
		foreach($aliases = $epan->ref("Aliases") as $junk){
			$data['aliases'][] = $junk['name'];
		}


		$page_no=0;
		// Get Pages
		foreach ($page_model = $epan->ref('EpanPage') as $page) {
			$data['pages'][$page_no] = $page;
			// Get Snapshots
			if($include_snapshots){				
				foreach ($page_model->ref('EpanPageSnapshots') as $snap) {
					$data['pages'][$page_no]['snapshots'][] = $snap;
				}
			}
			$page_no++;
		}

		// Get Installed App
		// GET Installed Apps Parameters
		if($include_apps){
			foreach ($epan->ref('InstalledComponents') as $apps) {
				$data['apps'][] = $apps;
			}
		}



		$fileDir = getcwd().'/epans/'.$this->api->auth->model['name'].'/';
		if(file_exists($fileDir.'backup.zip'))
			unlink($fileDir.'backup.zip');

		if(file_exists($fileDir.'backup.epan'))
			unlink($fileDir.'backup.epan');

		file_put_contents($fileDir.'backup.epan',serialize($data));

		include_once("zip.php");
		$zip = new zip();

		$zip->makeZip($fileDir,$fileDir.'/backup.zip');
		
	}

	function restore(){

		$tmp_file = $_FILES['backup_file']['tmp_name'];

		$fileDir = getcwd().'/epans/'.$this->api->auth->model['name'].'/';
		$zipVar = new ZipArchive;
        
        $res = $zipVar->open($tmp_file); 
        if ($res === TRUE) 
        {                           
             if(!$zipVar->extractTo($fileDir.'..')){
	        	throw $this->exception('Could not Extract Zip file uploaded');
             }
             $zipVar->close();                        
        }else{
        	throw $this->exception('Could not open Zip file uploaded');
        	
        }

		$backup_file = $fileDir.'backup.epan';
		$data = unserialize(file_get_contents($backup_file));

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";

		if($data['epan']['allowed_aliases']=='') $data['epan']['allowed_aliases'] = count($data['aliases']);

		if(!isset($data['epan'])){
			$this->add('View_Error')->set('Data Looks Corrupted');
			return;
		}

		$existing_epan = $this->add('Model_Epan');
		$existing_epan->load($this->api->auth->model->id);


		foreach ($page = $existing_epan->ref('EpanPage') as $junk) {
			$page->delete();
		}

		// Delete all aliases as well
		foreach ($aliases = $existing_epan->ref('Aliases') as $junk) {
			$aliases->memorize('force_delete',true);
			$aliases->delete();
		}

		foreach ($data['epan'] as $field => $value) {
			if(substr($field,-2) == 'id' OR $field=='name') continue;
			if($field == 'password' AND $_POST['keep_password']) continue;
			$existing_epan[$field] = $value;
		}
		$existing_epan->save();

		foreach ($data['pages'] as $page_data) {
			// Save Page Data
			$new_page = $existing_epan->ref('EpanPage');
			foreach ($page_data as $field => $value) {
				if(substr($field,-2) == 'id') continue;
				$new_page[$field] = $value;
			}
			$new_page->save();
			if(isset($page_data['snapshots'])){
				foreach ($page_data['snapshots'] as $snap_data) {
					// Save Snapshot Details Here
					$new_snapshot = $new_page->ref('EpanPageSnapshots');
					foreach ($snap_data as $field => $value) {
						if(substr($field,-2) == 'id') continue;
						$new_snapshot[$field]=$value;
					}
					$new_snapshot->save();
				}
			}
		}

		// Restore Aliases
		// default alias as per epan name
		if(!isset($data['aliases'])){
			$default_aliases = $existing_epan->ref('Aliases');
			$default_aliases['name'] = $existing_epan['name'];
			$default_aliases->save();
		}

		//Restore Other Aliases From Backup File
		if(isset($data['aliases'])){
			foreach ($data['aliases'] as $new_alias) {
				$new_alias_m = $existing_epan->ref('Aliases');
				$new_alias_m['name']=$new_alias;
				$new_alias_m->save();
			}
		}


		// Restore Application Installed data

		$keep_apps =array();
		if(isset($data['apps'])){
			foreach ($data['apps'] as $ap) {
				$check_installed = $this->add('Model_InstalledComponents');
				$check_installed->addCondition('epan_id',$this->api->auth->model->id);			
				$check_installed->addCondition('component_id',$ap['component_id']);
				$check_installed->tryLoadAny();
				if(!$check_installed->loaded()){
					$check_installed->saveAndUnload();
				}
				$keep_apps[] = $check_installed->id;
			}			
		} 

	}

	function verifyRestoreFile(){
		//TODO: /tml is linux specific path.. get system's temp path for compatibility
		if(!is_file($tmp_file = $_FILES['backup_file']['tmp_name'])){
			return "File Not Found";
		}

		if(is_dir('/tmp/'.$this->api->auth->model['name']))
			destroy_dir('/tmp/'.$this->api->auth->model['name']);

		$zip = new zip();
		if(!$zip->extractZip($tmp_file,'/tmp')){
			return "Couldn't Extract";
		}
		
		if(!is_file('/tmp/'.$this->api->auth->model['name'].'/backup.epan')){
			return "backup.epan file not found, This  might not be your own backup";
		}

		$backup_file = '/tmp/'.$this->api->auth->model['name'].'/backup.epan';
		$data = unserialize(file_get_contents($backup_file));


		return true;

	}
}