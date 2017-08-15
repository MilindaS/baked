<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_user');
		$this->load->module('common');
		$this->load->module('auth');
		$this->auth->isAuthenticated();
	}
	function index(){
		$this->home();
	}
	function home(){
		$css_array = array('dropzone.css','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css','bootstrap-datetimepicker.min.css');
		$js_array = array('../vendor/typeahead.js/dist/typeahead.bundle.min.js','dropzone.js','../vendor/datatables/media/js/jquery.dataTables.min.js','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js','moment.min.js','bootstrap-datetimepicker.min.js','validator.min.js');
		$this->common->header($css_array,$js_array);
		$this->load->view('home');
		$this->common->footer();
	}

	public function getUsers(){
		return $this->mdl_user->getUsers();
	}

	function profile($id){
		$css_array = array('dropzone.css','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css','bootstrap-datetimepicker.min.css');
		$js_array = array('../vendor/typeahead.js/dist/typeahead.bundle.min.js','dropzone.js','../vendor/datatables/media/js/jquery.dataTables.min.js','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js','moment.min.js','bootstrap-datetimepicker.min.js','validator.min.js');
		$this->common->header($css_array,$js_array);
		$data['user'] = $this->mdl_user->getUser($id);
		$this->load->view('profile',$data);
		$this->common->footer();
	}


	public function uploadProfPic($id){
		$ds = DIRECTORY_SEPARATOR;  //1
		$storeFolder = 'public'.$ds.'profPics';   //2
		if (!empty($_FILES)) {
		    $tempFile = $_FILES['file']['tmp_name'];          //3
		    $targetPath = FCPATH . $storeFolder . $ds;  //4
		    $post_file_name = str_replace('%','_',$_FILES['file']['name']);
		    $post_file_name = microtime().'_'.$post_file_name;
		    $targetFile =  $targetPath. $post_file_name;  //5
		    move_uploaded_file($tempFile,$targetFile); //6
		    $data['prevPath'] = base_url().'public'.$ds.'profPics'.$ds. $post_file_name;
		    $data['filePath'] = $targetFile;
		    $data['id'] = $id;
		    $result = $this->mdl_user->saveUpld($data);
			redirect(BASEURL.'user/home', 'refresh');
		}
	}

	public function getUser($user_id){
		return $this->mdl_user->getUser($user_id);
	}

	public function getUserJSON($user_id){
		$result = $this->mdl_user->getUser($user_id);
		echo json_encode($result[0]);
	}
	
	public function changeGenDetails(){
		$this->mdl_user->changeGenDetails($this->input->post());
		redirect(BASEURL.'user/home', 'refresh');
	}

	public function changePwd(){
		$this->mdl_user->changePwd($this->input->post());
		redirect(BASEURL.'user/home', 'refresh');
	}

	function other(){
		$this->load->view('other');
	}

	function pill(){
		return 'Have fun with web development!';
	}
	function get($order_by){
		$query = $this->mdl_welcome->get($order_by);
		return $query;
	}

	function get_with_limit($limit,$offset,$order_by){

		$query = $this->mdl_welcome->get_with_limit($limit,$offset,$order_by);
		return $query;
	}

	function get_where($id){

		$query = $this->mdl_welcome->get_where($id);
		return $query;
	}

	function get_where_custom($col,$value){

		$query = $this->mdl_welcome->get_where_custom($col,$value);
		return $query;
	}

	function get_group_by($col){
		$query = $this->mdl_tracking->get_group_by($col);
		return $query;
	}

	function _insert($data){

		$this->mdl_welcome->_insert($data);
	}

	function _update($id,$data){

		$this->mdl_welcome->_update($id,$data);
	}

	function _delete($id){

		$this->mdl_welcome->_delete($id);
	}

	function count_where($column,$value){

		$count = $this->mdl_welcome->count_where($column,$value);
		return $count;
	}
	function count_all(){

		$num_rows = $this->mdl_welcome->count_all();
		return $num_rows;
	}

	function get_max(){

		$max_id = $this->mdl_welcome-> get_max();
		return $max_id;

	}

	function _custom_query($mysql_query){

		$query = $this->mdl_welcome->_custom_query($mysql_query);
		return $query;

	}



}
