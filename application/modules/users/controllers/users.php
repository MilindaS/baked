<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_users');
		$this->load->module('common');
		$this->load->module('user');
		$this->load->module('auth');
		$this->auth->isAuthenticated();
	}
	function index(){
		$this->home();
	}


	public function getUsers($sort){
		echo json_encode($this->mdl_users->getUsers($sort));
	}
	
	function home(){	
		$css_array = array('dropzone.css','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css','bootstrap-datetimepicker.min.css');
		$js_array = array('../vendor/typeahead.js/dist/typeahead.bundle.min.js','dropzone.js','moment.min.js','bootstrap-datetimepicker.min.js','validator.min.js');
		$this->common->header($css_array,$js_array);
		// $data['reports'] = $this->mdl_users->getReports();
		$data['users'] = $this->user->getUsers();
		$this->load->view('home',$data);
		$this->common->footer();
	}

	function getNextRefNo(){
		$max_row = $this->mdl_users->getNextRefNo();
		echo json_encode($max_row[0]['MRF']+1);
	}

	

	

	public function checkNDA(){
		$post_id = $this->mdl_users->checkNDA($this->input->get('compName'));
		if($post_id){
			http_response_code(400);
		}else{
			http_response_code(200);
		}
	}

	public function addUser(){
		if($this->input->post('idE')){
			$data = array(
			'id'=>$this->input->post('idE'),
			'fullname'=>$this->input->post('fullnameE'),
			'company'=>$this->input->post('companyE'),
			'phone'=>$this->input->post('phoneE'),
			'address'=>$this->input->post('addressE'),
			'email'=>$this->input->post('emailE'),
			'username'=>$this->input->post('usernameE'),
			'tpassword'=>$this->input->post('tpasswordE'),
			'type'=>$this->input->post('typeE')
			);
		}else{
			$data = array(
			'id'=>null,
			'fullname'=>$this->input->post('fullname'),
			'company'=>$this->input->post('company'),
			'phone'=>$this->input->post('phone'),
			'address'=>$this->input->post('address'),
			'email'=>$this->input->post('email'),
			'username'=>$this->input->post('username'),
			'tpassword'=>$this->input->post('tpassword'),
			'type'=>$this->input->post('type')
			);
		}
		
		$post_id = $this->mdl_users->addUser($data);
		$action = $this->common->getUserActions(1);
		$this->common->logRec($action[0]['action_name'],$post_id);
		echo 1;
	}

	public function checkValidRefNo(){
		$post_id = $this->mdl_users->checkValidRefNo($this->input->get('refNo'));
		if($post_id){
			http_response_code(400);
		}else{
			http_response_code(200);
		}
	}

	public function uploadFile(){
		// log_message('error','--1--'.json_encode($this->input->post()));
		$ds = DIRECTORY_SEPARATOR;  //1
		$storeFolder = 'public'.$ds.'uploads';   //2
		if (!empty($_FILES)) {
		    $tempFile = $_FILES['file']['tmp_name'];          //3
		    $targetPath = FCPATH . $storeFolder . $ds;  //4
		    $post_file_name = str_replace('%','_',$_FILES['file']['name']);
		    $targetFile =  $targetPath. $post_file_name;  //5
		    move_uploaded_file($tempFile,$targetFile); //6
		    $data['prevPath'] = base_url().'public'.$ds.'uploads'.$ds. $post_file_name;
		    $data['filePath'] = $targetFile;
		    $data['id'] = $this->input->post('record_id');
		    $result = $this->mdl_users->saveUpld($data);
		    $action = $this->common->getUserActions(3);
			$this->common->logRec($action[0]['action_name'],$data['id']);
			redirect(BASEURL.'reports/home', 'refresh');
		}else {
			$result  = array();
 
		    $files = scandir($storeFolder);                 //1
		    if ( false!==$files ) {
		        foreach ( $files as $file ) {
		            if ( '.'!=$file && '..'!=$file) {       //2
		                $obj['name'] = $file;
		                $obj['size'] = filesize($storeFolder.$ds.$file);
		                $result[] = $obj;
		            }
		        }
		    }
		     
		    header('Content-type: text/json');              //3
		    header('Content-type: application/json');
		    echo json_encode($result);
		}
	}

	public function uploadFileR(){
		// log_message('error','--0--'.$this->input->post('record_id'));
		$ds = DIRECTORY_SEPARATOR;  //1
		$storeFolder = 'public'.$ds.'uploads'.$ds.'requests';   //2
		if (!empty($_FILES)) {
		    $tempFile = $_FILES['file']['tmp_name'];          //3
		    $targetPath = FCPATH . $storeFolder . $ds;  //4
		    $post_file_name = str_replace('%','_',$_FILES['file']['name']);
		    $targetFile =  $targetPath. $post_file_name;  //5
		    move_uploaded_file($tempFile,$targetFile); //6
		    $data['prevPath'] = base_url().'public'.$ds.'uploads'.$ds.'requests'.$ds.$post_file_name;
		    $data['filePath'] = $targetFile;
		    $data['id'] = $this->input->post('record_id_r');
		    $result = $this->mdl_users->saveUpldR($data);
		    $action = $this->common->getUserActions(3);
			$this->common->logRec($action[0]['action_name'],$data['id']);
			redirect(BASEURL.'reports/home', 'refresh');
		}else {
			$result  = array();
 
		    $files = scandir($storeFolder);                 //1
		    if ( false!==$files ) {
		        foreach ( $files as $file ) {
		            if ( '.'!=$file && '..'!=$file) {       //2
		                $obj['name'] = $file;
		                $obj['size'] = filesize($storeFolder.$ds.$file);
		                $result[] = $obj;
		            }
		        }
		    }
		     
		    header('Content-type: text/json');              //3
		    header('Content-type: application/json');
		    echo json_encode($result);
		}
	}

	public function loadFiles(){
		$result = $this->mdl_users->loadFiles($this->input->post('id'));
		echo json_encode($result);
	}

	public function loadFilesR(){
		$result = $this->mdl_users->loadFilesR($this->input->post('id'));
		echo json_encode($result);
	}
	
	public function loadRecord(){
		$id = $this->input->post('id');
		$result = $this->mdl_users->loadRecord($id);
		echo json_encode($result[0]);
	}

	public function deleteFile(){
		$ds = DIRECTORY_SEPARATOR;  //1
		$storeFolder = 'public'.$ds.'uploads'; 
		$file = $this->input->post('soft_file_path');
		// log_message('error',$file);
		// exit();
		unlink($file);
		$this->mdl_users->deleteFile($this->input->post('id'));
		$return  = 	array('type'=>true,
						'msg'=>'<i class="ion-android-warning"></i>&nbsp;&nbsp;File Removed !');
		echo json_encode($return);
	}

	public function deleteFileR(){
		$ds = DIRECTORY_SEPARATOR;  //1
		$storeFolder = 'public'.$ds.'uploads'.$ds.'requests';   //2
		$file = $this->input->post('soft_file_path');
		// log_message('error',$file);
		// exit();
		unlink($file);
		$this->mdl_users->deleteFileR($this->input->post('id'));
		$return  = 	array('type'=>true,
						'msg'=>'<i class="ion-android-warning"></i>&nbsp;&nbsp;File Removed !');
		echo json_encode($return);
	}
	

	public function restoreReport(){
		$data = array('id'=>$this->input->post('restore_record_id'));
		$this->mdl_users->restoreReport($data);
		$action = $this->common->getUserActions(6);
		$this->common->logRec($action[0]['action_name'],$this->input->post('restore_record_id'));
	}

	public function deleteReportPermanant(){
		$data = array('id'=>$this->input->post('delete_record_id'));
		$this->mdl_users->deleteReportPermanant($data);
		$action = $this->common->getUserActions(5);
		$this->common->logRec($action[0]['action_name'],$this->input->post('delete_record_id'));
	}

	public function deleteUser(){
		$data = array('id'=>$this->input->post('delete_record_id'));
		$this->mdl_users->deleteUser($data);
		$action = $this->common->getUserActions(4);
		$this->common->logRec($action[0]['action_name'],$this->input->post('delete_record_id'));
	}


}
