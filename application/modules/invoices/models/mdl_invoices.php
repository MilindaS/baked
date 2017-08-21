<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_invoices extends CI_Model {

	// $this->loggedinuser = null;

	function __construct(){
		parent::__construct();
		$this->loggedinuser=$this->session->userdata ( 'logged_in');
		// $user_details = Modules::run('user/getUser',$loggedinuser['id']);
	}

	public function getMonthlyReportNames(){
		$sql = "SELECT * FROM monthly_report_names";
		$params = array();
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

	public function getMonthlyReports(){
		$sql = "SELECT * FROM report WHERE report_type = ?";
		$params = array(1);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

	public function getWeeklyReports(){
		$sql = "SELECT * FROM report WHERE report_type = ?";
		$params = array(2);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

	public function getMonthlyReportsByName($report_name){
		$sql = "SELECT * FROM report WHERE report_name = ? AND report_type =? ";
		$params = array($report_name,1);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

	public function addInvoice($data){

		$invoice_no = $data['invoice_no'];
		$date = date('Y-m-d',strtotime($data['date']));
		$invoice_amount = $data['invoice_amount'];
		$paid_amount = $data['paid_amount'];
		$payment_details = $data['payment_details'];
		$payment_date = date('Y-m-d',strtotime($data['payment_date']));

		$payment_type = $data['payment_type'];
		$pending_amount = $data['pending_amount'];
		$remarks = $data['remarks'];
		$userArr = $this->loggedinuser;
		$updated_by = $userArr['id'];

		if($data['id']!=null){
			$sql = "UPDATE invoices set 
						invoice_no = ? ,
						date = ? ,
						invoice_amount = ? ,
						paid_amount = ? ,
						payment_details = ? ,
						payment_date = ? ,
						payment_type = ? ,
						pending_amount = ? ,
						remarks = ? ,
						updated_by = ? 
						WHERE id =?";
			$params = array(
							$invoice_no,
							$date,
							$invoice_amount,
							$paid_amount,
							$payment_details,
							$payment_date,
							$payment_type,
							$pending_amount,
							$remarks,
							$updated_by,
							$data['id']
							);
		}else{
			
			$sql = "INSERT INTO invoices (invoice_no,
											date,
											invoice_amount,
											paid_amount,
											payment_details,
											payment_date,
											payment_type,
											pending_amount,
											remarks,
											updated_by) 
								VALUES(?,?,?,?,?,?,?,?,?,?)";
			$params = array(
							$invoice_no,
							$date,
							$invoice_amount,
							$paid_amount,
							$payment_details,
							$payment_date,
							$payment_type,
							$pending_amount,
							$remarks,
							$updated_by
							);

		}
		$query = $this->db->query($sql,$params);
		$post_id = $this->db->insert_id();

		return $post_id;	
	}

	public function checkValidRefNo($id){
		$sql = "SELECT * FROM report where ref_no=?";
		$params = array($id);
		$query = $this->db->query($sql,$params);
		$nr = $query->num_rows();

		if($nr>0){
			return 1;
		}else{
			return 0;
		}
	}


	public function checkNDA($compName){
		$sql = "SELECT * FROM nda where consignee_name=? AND  end_date < '".date('Y-m-d')."'";
		$params = array($compName);
		$query = $this->db->query($sql,$params);
		$nr = $query->num_rows();
		log_message('error',$nr);
		if($nr>0){
			return 1;
		}else{
			return 0;
		}
	}

	public function loadFiles($id){
		// log_message('error',json_encode($id));
		$sql = "SELECT * FROM report_soft_files inner join report on (report_soft_files.report_id = report.id) where report_id=?";
		$params = array($id);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

	public function loadFilesR($id){
		$sql = "SELECT *,report_request_files.id as report_soft_id FROM report_request_files inner join report on (report_request_files.report_id = report.id) where report_id=?";
		$params = array($id);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

	public function searchMonthlyRepName($monRepName,$reportType){
		if($reportType==1){
			$docs = $this->db->like("report_name",$monRepName)->get('monthly_report_names',5,0);
		}else if($reportType==2){
			$docs = $this->db->like("report_name",$monRepName)->get('weekly_report_names',5,0);
		}
		$result = $docs->result_array();
		$bl_arr = array();
		foreach ($result as $value) {
			$bl_arr[] = array('value'=>$value['report_name']);
		}
		return $bl_arr;
	}

	public function searchConsignee($compNameE){
		$docs = $this->db->like("consignee_name",$compNameE)->get('consignee',5,0);
		$result = $docs->result_array();
		$bl_arr = array();
		foreach ($result as $value) {
			$bl_arr[] = array('value'=>$value['consignee_name']);
		}
		return $bl_arr;
	}

	public function searchConsigneeNameOrTin($compNameE){
		$docs = $this->db->or_like(array("consignee_name"=>$compNameE,"tin_no"=>$compNameE))->get('consignee',5,0);
		$result = $docs->result_array();
		$bl_arr = array();
		foreach ($result as $value) {
			$bl_arr[] = array('value'=>$value['tin_no'].' - '.$value['consignee_name']);
		}
		return $bl_arr;
	}

	

	public function searchConsigneeTin($compNameE){
		$docs = $this->db->like("tin_no",$compNameE)->get('consignee',5,0);
		$result = $docs->result_array();
		$bl_arr = array();
		foreach ($result as $value) {
			$bl_arr[] = array('value'=>$value['tin_no'].' - '.$value['consignee_name']);
		}
		return $bl_arr;
	}

	

	// public function searchConsignee($compNameE){
	// 	$docs = $this->db->like("consignee_name",$compNameE)->get('consignee',5,0);
	// 	$result = $docs->result_array();
	// 	$bl_arr = array();
	// 	foreach ($result as $value) {
	// 		$bl_arr[] = array('value'=>$value['title'],
	// 							'_id'=>$value['_id'],
	// 							'ts'=>$value['ts'],
	// 							'title'=>$value['title'],
	// 							'privacy_toggle'=>$value['privacy_toggle'],
	// 							'content'=>$value['content'],
	// 							'user'=>$value['user']
	// 							);
	// 	}
	// 	return $bl_arr;
	// }

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
	public function updateReportToCusdecFormat($data){
		$sql = "UPDATE report set report_format = ? WHERE id =?";
		$params = array($data['value'],$data['id']);
		$query = $this->db->query($sql,$params);
		return true;
	}


	public function editReport($data){
		$reportType = $data['reportType'];
		$refId = $data['refId'];
		$refNo = $data['refNo'];
		
		
		
		$contactName = $data['contactName'];
		$contactNo = $data['contactNo'];
		$reptCost = $data['reptCost'];
		$reciptNo = $data['reciptNo'];
		$remarks = $data['remarks'];
		$compName = $data['compName'];
		$reportUnderTaken = $data['reportUnderTaken'];
		
		$priority = $data['priority'];
		$repStatus = $data['repStatus'];
		
		$sql = "SELECT * FROM report where id=?";
		$params = array($refId,0);
		$query = $this->db->query($sql,$params);
		$incomplt_rpt = $query->result_array();

		if($incomplt_rpt[0]['status']==0){
			if($repStatus){
				$sql = "UPDATE report set complt_date = ? WHERE id =?";
				$params = array(date("Y-m-d"),$refId);
				$query = $this->db->query($sql,$params);
			}
		}

		log_message('error',json_encode($data));

		if($reportType==0){
			$recvDate = date('Y-m-d',strtotime($data['recvDate']));
			
			$reportName = $data['reportName'];
			$entityType = $data['entityType'];
			
			$sql = "UPDATE report set ref_no = ? ,recv_date = ? ,comp_name  = ?,report_name = ?,contact_name = ?,contact_no = ?,status = ?,file_cost=? ,remarks=? , entity_type=? , priority=? , report_at=? , report_type =? , recipt_no = ? WHERE id =?";
			$params = array($refNo,$recvDate,$compName,$reportName,$contactName,$contactNo,$repStatus,$reptCost,$remarks,$entityType,$priorityE,$reportUnderTaken,$reportTypeE,$reciptNo,$refId);
		}else if($reportType==1){
			$repMonName = $data['repMonName'];
			$effMonth = $data['effMonth'];
			$year = date('Y',strtotime($data['effMonth']));
			$month = date('m',strtotime($data['effMonth']));
			
			$sqlconsCheck = "SELECT * FROM monthly_report_names where report_name=?";
			$params = array($repMonName);
			$query = $this->db->query($sqlconsCheck,$params);
			$nr_cons = $query->num_rows();
			if($nr_cons==0){
				$sql = "INSERT INTO monthly_report_names (report_name) VALUES(?)";
				$params = array($repMonName);
				$query = $this->db->query($sql,$params);
			}

			$sql = "UPDATE report set ref_no = ? ,comp_name  = ?,report_name = ?,contact_name = ?,contact_no = ?,status = ?,file_cost=? ,remarks=? , priority=? , report_at=? ,month =? ,year=? ,report_type =? WHERE id =?";
			$params = array($refNo,$compName,$repMonName,$contactName,$contactNo,$repStatus,$reptCost,$remarks,$priority,$reportUnderTaken,$month,$year,$reportType,$refId);

		}else if($reportType==2){
			$repMonName = $data['repMonName'];
			$fromDate =date('Y-m-d',strtotime($data['fromDate'])); 
			$toDate =date('Y-m-d',strtotime($data['toDate'])); 
			

			$sqlconsCheck = "SELECT * FROM weekly_report_names where report_name=?";
			$params = array($repMonName);
			$query = $this->db->query($sqlconsCheck,$params);
			$nr_cons = $query->num_rows();
			if($nr_cons==0){
				$sql = "INSERT INTO weekly_report_names (report_name) VALUES(?)";
				$params = array($repMonName);
				$query = $this->db->query($sql,$params);
			}
			
			$sql = "UPDATE report set ref_no = ? ,comp_name  = ?,report_name = ?,contact_name = ?,contact_no = ?,status = ?,file_cost=? ,remarks=? , priority=? , report_at=? , week_start_on = ? , week_ends_on = ?,report_type =? WHERE id =?";
			$params = array($refNo,$compName,$repMonName,$contactName,$contactNo,$repStatus,$reptCost,$remarks,$priority,$reportUnderTaken,$fromDate, $toDate,$reportType,$refId);
		}


		
		$query = $this->db->query($sql,$params);


		return true;
	}

	public function loadRecord($id){
		$sql = "SELECT * FROM invoices where id=?";
		$params = array($id);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

	public function deleteFile($id){
		$sql = "DELETE FROM report_soft_files where id=?";
		$params = array($id);
		$query = $this->db->query($sql,$params);
	}

	public function deleteFileR($id){
		$sql = "DELETE FROM report_request_files where id=?";
		$params = array($id);
		$query = $this->db->query($sql,$params);
	}

	function saveUpld($data){
		$report_id = $data['id'];
		$soft_file_link = $data['prevPath'];
		$soft_file_path  = $data['filePath'];
		// log_message('error',$report_id);
		$sql = "INSERT INTO report_soft_files (report_id,soft_file_link,soft_file_path) VALUES(?,?,?)";
		$params = array($report_id,$soft_file_link,$soft_file_path);
		$query = $this->db->query($sql,$params);
	}

	function saveUpldR($data){
		$report_id = $data['id'];
		$soft_file_link = $data['prevPath'];
		$soft_file_path  = $data['filePath'];

		$sql = "INSERT INTO report_request_files (report_id,soft_file_link,soft_file_path) VALUES(?,?,?)";
		$params = array($report_id,$soft_file_link,$soft_file_path);
		$query = $this->db->query($sql,$params);
	}

	public function getInvoices($sortGET){


		$aColumns = array(
			'id',
            'invoice_no',
            'date',
            'invoice_amount',
            'paid_amount',
            'payment_details',
            'payment_date',
            'payment_type',
            'pending_amount',
            'remarks',
            'updated_by'
            );
 
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";
 
        /* Total data set length */
        $sQuery = "SELECT COUNT('" . $sIndexColumn . "') AS row_count
            FROM invoices";
        $rResultTotal = $this->db->query($sQuery);
        $aResultTotal = $rResultTotal->row();
        $iTotal = $aResultTotal->row_count;
 
        /*
         * Paging
         */
        $sLimit = "";
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $sLimit = "LIMIT " . intval($iDisplayStart) . ", " .
                    intval($iDisplayLength);
        }
 
        $uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/\%5B/", '[', $uri_string);
        $uri_string = preg_replace("/\%5D/", ']', $uri_string);
 
        $get_param_array = explode("&", $uri_string);
        $arr = array();
        foreach ($get_param_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            $arr[$explode[0]] = $explode[1];
        }
 
        $index_of_columns = strpos($uri_string, "columns", 1);
        $index_of_start = strpos($uri_string, "start");
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode("&", $uri_columns);
        $arr_columns = array();
        foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
        }
 
        /*
         * Ordering
         */
        $sOrder = "ORDER BY ";
        $sOrderIndex = $arr['order[0][column]'];
        $sOrderDir = $arr['order[0][dir]'];
        $bSortable_ = $arr_columns['columns[' . $sOrderIndex . '][orderable]'];
        if ($bSortable_ == "true") {
            $sOrder .= $aColumns[$sOrderIndex] .
                    ($sOrderDir === 'asc' ? ' asc' : ' desc');
        }
 
        /*
         * Filtering
         */
        $sWhere = "";
        $sSearchVal = $arr['search[value]'];
        $sSearchVal = str_replace("+", " ", $sSearchVal);
        if (isset($sSearchVal) && $sSearchVal != '') {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $sSearchVal . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }
 
        /* Individual column filtering */
        $sSearchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($aColumns); $i++) {
            $bSearchable_ = $arr['columns[' . $i . '][searchable]'];
            if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                $search_val = $arr['columns[' . $i . '][search][value]'];
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . $search_val . "%' ";
            }
        }
 		
 		// $sWhere .= " AND is_deleted = 0";

 
        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
        FROM invoices
        $sWhere
        $sOrder
        $sLimit
        ";
        $rResult = $this->db->query($sQuery);
 
        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS() AS length_count";
        $rResultFilterTotal = $this->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->row();
        $iFilteredTotal = $aResultFilterTotal->length_count;
 
        /*
         * Output
         */
        $sEcho = $this->input->get_post('draw', true);
        $output = array(
            "draw" => intval($sEcho),
            "recordsTotal" => $iTotal,
            "recordsFiltered" => $iFilteredTotal,
            "data" => array()
        );
 
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
            	// $row[] = $aRow[$col];
                if($col=='updated_by'){
                	$aRow[$col] = 	"<a data-record_id=".$aRow['id']." class='btn btn-xs btn-primary pt-opt-edit'><i class='fa fa-pencil-square-o'></i></a>";
                	$aRow[$col] .= 	"&nbsp;&nbsp;<a data-toggle='modal' data-record_id=".$aRow['id']." data-target='#deleteRecordModal' class='js-delete-record btn btn-xs btn-danger'><i class='fa fa-trash'></i></a>";	
                }
                $row[] = $aRow[$col];
            }
                log_message('ERROR',json_encode($row));
            $output['data'][] = $row;
        }
 
        return $output;


	}	

	public function getNextRefNo(){
    	$sql = "SELECT MAX(invoice_no) AS MRF FROM invoices";
		$params = array();
		$query = $this->db->query($sql,$params);
		return $query->result_array();
    }

	public function getDeletedReports(){
		$sql = "SELECT * FROM report WHERE is_deleted=?";
		$params = array(1);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}	
	
	public function deleteReportPermanant($data){
		$sql = "DELETE from report WHERE id=?";
		$params = array($data['id']);
		$query = $this->db->query($sql,$params);
		return true;
	}

	public function restoreReport($data){
		
		$sql = "UPDATE report SET is_deleted = ? WHERE id=?";
		$params = array(0,$data['id']);
		$query = $this->db->query($sql,$params);
		return true;
	}

	public function deleteInvoice($data){
		$sql = "DELETE from invoices WHERE id=?";
		$params = array($data['id']);
		$query = $this->db->query($sql,$params);
		return true;
	}
}
