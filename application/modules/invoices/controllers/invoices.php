<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_invoices');
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
		// $data['reports'] = $this->mdl_invoices->getReports();
		$data['users'] = $this->user->getUsers();
		$this->load->view('home',$data);
		$this->common->footer();
	}

	function getNextRefNo(){
		$max_row = $this->mdl_invoices->getNextRefNo();
		echo json_encode($max_row[0]['MRF']+1);
	}

	function reports_mon(){	
		$css_array = array('mcalendar.css','bootstrap.vertical-tabs.min.css','fullcalendar.css');
		$js_array = array('moment.min.js','fullcalendar.js');
		$this->common->header($css_array,$js_array);
		// $data['reports'] = $this->mdl_invoices->getReports();
		$data['users'] = $this->user->getUsers();
		$this->load->view('reports_mon',$data);
		$this->common->footer();
	}

	function getMonthlyReportsByName(){
		echo json_encode($this->mdl_invoices->getMonthlyReportsByName($this->input->post('report_name')));
	}

	function getInvoices($sort){
		echo json_encode($this->mdl_invoices->getInvoices($sort));
	}

	function getMonthlyReportNames(){
		return $this->mdl_invoices->getMonthlyReportNames();
	}

	function getMonthlyReports(){
		return $this->mdl_invoices->getMonthlyReports();
	}

	function getWeeklyReports(){
		return $this->mdl_invoices->getWeeklyReports();
	}
	public function deleted(){
		$this->auth->isAuthorized();
		$css_array = array('dropzone.css','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css','bootstrap-datetimepicker.min.css');
		$js_array = array('../vendor/typeahead.js/dist/typeahead.bundle.min.js','dropzone.js','../vendor/datatables/media/js/jquery.dataTables.min.js','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js','moment.min.js','bootstrap-datetimepicker.min.js','validator.min.js');
		$this->common->header($css_array,$js_array);
		$data['dreports'] = $this->mdl_invoices->getDeletedReports();
		$this->load->view('dreports',$data);
		$this->common->footer();
	}

	public function checkNDA(){
		$post_id = $this->mdl_invoices->checkNDA($this->input->get('compName'));
		if($post_id){
			http_response_code(400);
		}else{
			http_response_code(200);
		}
	}

	public function addInvoice(){
		if($this->input->post('idE')){
			$data = array(
			'id'=>$this->input->post('idE'),
			'invoice_no'=>$this->input->post('invoice_noE'),
			'date'=>$this->input->post('dateE'),
			'invoice_amount'=>$this->input->post('invoice_amountE'),
			'paid_amount'=>$this->input->post('paid_amountE'),
			'payment_details'=>$this->input->post('payment_detailsE'),
			'payment_date'=>$this->input->post('payment_dateE'),
			'payment_type'=>$this->input->post('payment_typeE'),
			'pending_amount'=>$this->input->post('pending_amountE'),
			'remarks'=>$this->input->post('remarksE')
			);
		}else{
			$data = array(
			'id'=>null,
			'invoice_no'=>$this->input->post('invoice_no'),
			'date'=>$this->input->post('date'),
			'invoice_amount'=>$this->input->post('invoice_amount'),
			'paid_amount'=>$this->input->post('paid_amount'),
			'payment_details'=>$this->input->post('payment_details'),
			'payment_date'=>$this->input->post('payment_date'),
			'payment_type'=>$this->input->post('payment_type'),
			'pending_amount'=>$this->input->post('pending_amount'),
			'remarks'=>$this->input->post('remarks')
			);
		}
		
		$post_id = $this->mdl_invoices->addInvoice($data);
		$action = $this->common->getUserActions(1);
		$this->common->logRec($action[0]['action_name'],$post_id);
		echo 1;
	}

	public function checkValidRefNo(){
		$post_id = $this->mdl_invoices->checkValidRefNo($this->input->get('refNo'));
		if($post_id){
			http_response_code(400);
		}else{
			http_response_code(200);
		}
	}

	

	function searchMonthlyRepName(){
		$result = $this->mdl_invoices->searchMonthlyRepName($this->input->post('monRepName'),$this->input->post('reportTypeX'));
		echo json_encode($result);
	}

	function searchConsignee(){
		$result = $this->mdl_invoices->searchConsignee($this->input->post('compNameE'));
		echo json_encode($result);
	}

	function searchConsigneeNameOrTin(){
		$result = $this->mdl_invoices->searchConsigneeNameOrTin($this->input->post('compNameE'));
		echo json_encode($result);
	}

	function searchConsigneeTin(){
		$result = $this->mdl_invoices->searchConsigneeTin($this->input->post('compNameE'));
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
 //                $this->mdl_invoices->editReport($data);

 //                $action = $this->common->getUserActions(2);
 //                $this->common->logRec($action[0]['action_name'],$this->input->post('refIdE'));
 //                echo 1;
 //        }

	public function updateReportToCusdecFormat(){
		$this->mdl_invoices->updateReportToCusdecFormat($this->input->post());
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
		$this->mdl_invoices->editReport($data);

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
		    $result = $this->mdl_invoices->saveUpld($data);
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
		    $result = $this->mdl_invoices->saveUpldR($data);
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
		$result = $this->mdl_invoices->loadFiles($this->input->post('id'));
		echo json_encode($result);
	}

	public function loadFilesR(){
		$result = $this->mdl_invoices->loadFilesR($this->input->post('id'));
		echo json_encode($result);
	}
	
	public function loadRecord(){
		$id = $this->input->post('id');
		$result = $this->mdl_invoices->loadRecord($id);
		echo json_encode($result[0]);
	}

	public function deleteFile(){
		$ds = DIRECTORY_SEPARATOR;  //1
		$storeFolder = 'public'.$ds.'uploads'; 
		$file = $this->input->post('soft_file_path');
		// log_message('error',$file);
		// exit();
		unlink($file);
		$this->mdl_invoices->deleteFile($this->input->post('id'));
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
		$this->mdl_invoices->deleteFileR($this->input->post('id'));
		$return  = 	array('type'=>true,
						'msg'=>'<i class="ion-android-warning"></i>&nbsp;&nbsp;File Removed !');
		echo json_encode($return);
	}
	

	public function restoreReport(){
		$data = array('id'=>$this->input->post('restore_record_id'));
		$this->mdl_invoices->restoreReport($data);
		$action = $this->common->getUserActions(6);
		$this->common->logRec($action[0]['action_name'],$this->input->post('restore_record_id'));
	}

	public function deleteReportPermanant(){
		$data = array('id'=>$this->input->post('delete_record_id'));
		$this->mdl_invoices->deleteReportPermanant($data);
		$action = $this->common->getUserActions(5);
		$this->common->logRec($action[0]['action_name'],$this->input->post('delete_record_id'));
	}

	public function deleteInvoice(){
		$data = array('id'=>$this->input->post('delete_record_id'));
		$this->mdl_invoices->deleteInvoice($data);
		$action = $this->common->getUserActions(4);
		$this->common->logRec($action[0]['action_name'],$this->input->post('delete_record_id'));
	}


}
