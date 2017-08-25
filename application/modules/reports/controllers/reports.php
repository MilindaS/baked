<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_reports');
		$this->load->module('common');
		$this->load->module('user');
		$this->load->module('auth');
		$this->auth->isAuthenticated();
	}
	function index(){
		$this->home();
	}

	
	function home(){	
		$css_array = array('dropzone.css','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css','bootstrap-datetimepicker.min.css');
		$js_array = array('../vendor/typeahead.js/dist/typeahead.bundle.min.js','dropzone.js','moment.min.js','bootstrap-datetimepicker.min.js','validator.min.js');
		$this->common->header($css_array,$js_array);
		// $data['reports'] = $this->mdl_reports->getReports();
		$data['users'] = $this->user->getUsers();
		$this->load->view('home',$data);
		$this->common->footer();
	}


	function reports_mon(){	
		$css_array = array('mcalendar.css','bootstrap.vertical-tabs.min.css','fullcalendar.css');
		$js_array = array('moment.min.js','fullcalendar.js');
		$this->common->header($css_array,$js_array);
		// $data['reports'] = $this->mdl_reports->getReports();
		$data['users'] = $this->user->getUsers();
		$this->load->view('reports_mon',$data);
		$this->common->footer();
	}

	function getMonthlyReportsByName(){
		echo json_encode($this->mdl_reports->getMonthlyReportsByName($this->input->post('report_name')));
	}

	function getReports($sort){
		echo json_encode($this->mdl_reports->getReports($sort));
	}

	function getMonthlyReportNames(){
		return $this->mdl_reports->getMonthlyReportNames();
	}

	function getMonthlyReports(){
		return $this->mdl_reports->getMonthlyReports();
	}

	function getWeeklyReports(){
		return $this->mdl_reports->getWeeklyReports();
	}
	public function deleted(){
		$this->auth->isAuthorized();
		$css_array = array('dropzone.css','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css','bootstrap-datetimepicker.min.css');
		$js_array = array('../vendor/typeahead.js/dist/typeahead.bundle.min.js','dropzone.js','../vendor/datatables/media/js/jquery.dataTables.min.js','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js','moment.min.js','bootstrap-datetimepicker.min.js','validator.min.js');
		$this->common->header($css_array,$js_array);
		$data['dreports'] = $this->mdl_reports->getDeletedReports();
		$this->load->view('dreports',$data);
		$this->common->footer();
	}

	public function checkNDA(){
		$post_id = $this->mdl_reports->checkNDA($this->input->get('compName'));
		if($post_id){
			http_response_code(400);
		}else{
			http_response_code(200);
		}
	}

	public function addReport(){
		if($this->input->post('reportType')==0){
			$data = array(
				'reportType'=>$this->input->post('reportType'),
				'refNo'=>$this->input->post('refNo'),
				'recvDate'=>$this->input->post('recvDate'),
				'compName'=>$this->input->post('compName'),
				'reportName'=>$this->input->post('reportName'),
				'contactName'=>$this->input->post('contactName'),
				'priority'=>$this->input->post('priority'),
				'entityType'=>$this->input->post('entityType'),
				'reportUnderTaken'=>$this->input->post('reportUnderTaken'),
				'contactNo'=>$this->input->post('contactNo')
				);
		}elseif($this->input->post('reportType')==1){
			$data = array(
				'reportType'=>$this->input->post('reportType'),
				'refNo'=>$this->input->post('refNo'),
				'repMonName'=>$this->input->post('repMonName'),
				'compName'=>$this->input->post('compName'),
				'contactName'=>$this->input->post('contactName'),
				'effMonth'=>$this->input->post('effMonth'),
				'priority'=>$this->input->post('priority'),
				'reportUnderTaken'=>$this->input->post('reportUnderTaken'),
				'contactName'=>$this->input->post('contactName'),
				'contactNo'=>$this->input->post('contactNo')
				);
		}elseif($this->input->post('reportType')==2){
			$data = array(
				'reportType'=>$this->input->post('reportType'),
				'refNo'=>$this->input->post('refNo'),
				'repMonName'=>$this->input->post('repMonName'),
				'contactName'=>$this->input->post('contactName'),
				'compName'=>$this->input->post('compName'),
				'fromDate'=>$this->input->post('fromDate'),
				'toDate'=>$this->input->post('toDate'),
				'priority'=>$this->input->post('priority'),
				'reportUnderTaken'=>$this->input->post('reportUnderTaken'),
				'contactName'=>$this->input->post('contactName'),
				'contactNo'=>$this->input->post('contactNo')
				);
		}
		


		$post_id = $this->mdl_reports->addReport($data);
		$action = $this->common->getUserActions(1);
		$this->common->logRec($action[0]['action_name'],$post_id);
		echo 1;
	}

	public function checkValidRefNo(){
		$post_id = $this->mdl_reports->checkValidRefNo($this->input->get('refNo'));
		if($post_id){
			http_response_code(400);
		}else{
			http_response_code(200);
		}
	}

	

	function searchMonthlyRepName(){
		$result = $this->mdl_reports->searchMonthlyRepName($this->input->post('monRepName'),$this->input->post('reportTypeX'));
		echo json_encode($result);
	}

	function searchConsignee(){
		$result = $this->mdl_reports->searchConsignee($this->input->post('compNameE'));
		echo json_encode($result);
	}

	function searchConsigneeNameOrTin(){
		$result = $this->mdl_reports->searchConsigneeNameOrTin($this->input->post('compNameE'));
		echo json_encode($result);
	}

	function searchConsigneeTin(){
		$result = $this->mdl_reports->searchConsigneeTin($this->input->post('compNameE'));
		echo json_encode($result);
	}

	// public function editReport(){
 //                $data = array(
 //                                        'refId'=>$this->input->post('refIdE'),
 //                                        'refNo'=>$this->input->post('refNoE'),
 //                                        'recvDate'=>$this->input->post('recvDateE'),
 //                                        'compName'=>$this->input->post('compNameE'),
 //                                        'reportName'=>$this->input->post('reportNameE'),
 //                                        'contactName'=>$this->input->post('contactNameE'),
 //                                        'contactNo'=>$this->input->post('contactNoE'),
 //                                        'reptCost'=>$this->input->post('reptCost'),
 //                                        'entityType'=>$this->input->post('entityType'),
 //                                        'priorityE'=>$this->input->post('priorityE'),
 //                                        'remarks'=>$this->input->post('remarks'),
 //                                        'reportUnderTaken'=>$this->input->post('reportUnderTakenE'),
 //                                        'repStatus'=>$this->input->post('repStatus')
 //                                        );
 //                $this->mdl_reports->editReport($data);

 //                $action = $this->common->getUserActions(2);
 //                $this->common->logRec($action[0]['action_name'],$this->input->post('refIdE'));
 //                echo 1;
 //        }

	public function updateReportToCusdecFormat(){
		$this->mdl_reports->updateReportToCusdecFormat($this->input->post());
	}

	public function editReport(){
		if($this->input->post('reportTypeE')==0){
			$data = array(
				'refId'=>$this->input->post('refIdE'),
				'reportType'=>$this->input->post('reportTypeE'),
				'entityType'=>$this->input->post('entityType'),
				'refNo'=>$this->input->post('refNoE'),
				'recvDate'=>$this->input->post('recvDateE'),
				'compName'=>$this->input->post('compNameE'),
				'reportName'=>$this->input->post('reportNameE'),
				'contactName'=>$this->input->post('contactNameE'),
				// 'priority'=>$this->input->post('priority'),
				'reportUnderTaken'=>$this->input->post('reportUnderTakenE'),
				'contactNo'=>$this->input->post('contactNoE'),
				'reptCost'=>$this->input->post('reptCost'),
				'priority'=>$this->input->post('priorityE'),
				'remarks'=>$this->input->post('remarks'),
				'reportUnderTaken'=>$this->input->post('reportUnderTakenE'),
				'repStatus'=>$this->input->post('repStatus'),
				'reciptNo'=>$this->input->post('reciptNo')
				);
		}elseif($this->input->post('reportTypeE')==1){
			$data = array(
				'refId'=>$this->input->post('refIdE'),
				'reportType'=>$this->input->post('reportTypeE'),
				'refNo'=>$this->input->post('refNoE'),
				'repMonName'=>$this->input->post('repMonNameE'),
				'compName'=>$this->input->post('compNameE'),
				'effMonth'=>$this->input->post('effMonthE'),
				// 'priority'=>$this->input->post('priority'),
				'reportUnderTaken'=>$this->input->post('reportUnderTakenE'),
				'contactName'=>$this->input->post('contactNameE'),
				'contactNo'=>$this->input->post('contactNoE'),
				'reptCost'=>$this->input->post('reptCost'),
				'priority'=>$this->input->post('priorityE'),
				'remarks'=>$this->input->post('remarks'),
				'reportUnderTaken'=>$this->input->post('reportUnderTakenE'),
				'repStatus'=>$this->input->post('repStatus')
				);
		}elseif($this->input->post('reportTypeE')==2){
			$data = array(
				'refId'=>$this->input->post('refIdE'),
				'reportType'=>$this->input->post('reportTypeE'),
				'refNo'=>$this->input->post('refNoE'),
				'repMonName'=>$this->input->post('repMonNameE'),
				'compName'=>$this->input->post('compNameE'),
				'fromDate'=>$this->input->post('fromDateE'),
				'toDate'=>$this->input->post('toDateE'),
				'reportUnderTaken'=>$this->input->post('reportUnderTakenE'),
				'contactName'=>$this->input->post('contactNameE'),
				'contactNo'=>$this->input->post('contactNoE'),
				'reptCost'=>$this->input->post('reptCost'),
				'priority'=>$this->input->post('priorityE'),
				'remarks'=>$this->input->post('remarks'),
				'reportUnderTaken'=>$this->input->post('reportUnderTakenE'),
				'repStatus'=>$this->input->post('repStatus')
				);
		}
		$this->mdl_reports->editReport($data);

		$action = $this->common->getUserActions(2);
		$this->common->logRec($action[0]['action_name'],$this->input->post('refIdE'));
		echo 1;
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
		    $result = $this->mdl_reports->saveUpld($data);
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
		    $result = $this->mdl_reports->saveUpldR($data);
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
		$result = $this->mdl_reports->loadFiles($this->input->post('id'));
		echo json_encode($result);
	}

	public function loadFilesR(){
		$result = $this->mdl_reports->loadFilesR($this->input->post('id'));
		echo json_encode($result);
	}
	
	public function loadRecord(){
		$id = $this->input->post('id');
		$result = $this->mdl_reports->loadRecord($id);
		echo json_encode($result[0]);
	}

	public function deleteFile(){
		$ds = DIRECTORY_SEPARATOR;  //1
		$storeFolder = 'public'.$ds.'uploads'; 
		$file = $this->input->post('soft_file_path');
		// log_message('error',$file);
		// exit();
		unlink($file);
		$this->mdl_reports->deleteFile($this->input->post('id'));
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
		$this->mdl_reports->deleteFileR($this->input->post('id'));
		$return  = 	array('type'=>true,
						'msg'=>'<i class="ion-android-warning"></i>&nbsp;&nbsp;File Removed !');
		echo json_encode($return);
	}
	

	public function restoreReport(){
		$data = array('id'=>$this->input->post('restore_record_id'));
		$this->mdl_reports->restoreReport($data);
		$action = $this->common->getUserActions(6);
		$this->common->logRec($action[0]['action_name'],$this->input->post('restore_record_id'));
	}

	public function deleteReportPermanant(){
		$data = array('id'=>$this->input->post('delete_record_id'));
		$this->mdl_reports->deleteReportPermanant($data);
		$action = $this->common->getUserActions(5);
		$this->common->logRec($action[0]['action_name'],$this->input->post('delete_record_id'));
	}

	public function deleteReport(){
		$data = array('id'=>$this->input->post('delete_record_id'));
		$this->mdl_reports->deleteReport($data);
		$action = $this->common->getUserActions(4);
		$this->common->logRec($action[0]['action_name'],$this->input->post('delete_record_id'));
	}


}
