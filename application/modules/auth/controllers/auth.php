<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_auth');
		$this->load->module('common');
	}
	function index(){
		$this->home();
	}
	function home(){
		$css_array = array('../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css','bootstrap-datetimepicker.min.css');
		$js_array = array('../vendor/datatables/media/js/jquery.dataTables.min.js','../vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js','moment.min.js','bootstrap-datetimepicker.min.js','validator.min.js');
		$this->common->header($css_array,$js_array);
		if (isset($_COOKIE['username'])) {
			setcookie('username',$username,time() - 3600);
		}
		$this->load->view('signin');
		$this->common->footer();
	}

	function unauth(){
		$css_array = array();
		$js_array = array();
		$this->common->header($css_array,$js_array);
		$this->load->view('unauth');
		$this->common->footer();
	}

	function login(){
		try{
			$data = array('username' => $this->input->post('username'),'password'=>$this->input->post('password'));
			$result = $this->mdl_auth->login($data);
			if(is_null($result)){
				$type = 'fail';
			}else{
				$type = 'success';
			}
			$return  = 	array('type'=>$type,
						'data'=>$result,
						'msg'=>'<i class="ion-android-warning"></i>&nbsp;&nbsp;Login Failed !');
			echo json_encode($return);
		}
		catch(Exception $e){
			log_message('error',$e->getMessage());
		}
	}


	function logout(){
		$this->session->unset_userdata('logged_in');
		redirect(BASEURL.'auth/home', 'refresh');
	}

	function isAuthenticated(){
		$loggedinuser=$this->session->userdata ( 'logged_in');
		if($loggedinuser==''){
			redirect(BASEURL.'auth/home', 'refresh');
		}else{
			return true;
		}
	}

	function isAuthorized(){
		$loggedinuser=$this->session->userdata ( 'logged_in');
		$user_details = Modules::run('user/getUser',$loggedinuser['id']);
		if($user_details[0]['authority']=='3'){
			return true;
		}else{
			redirect(BASEURL.'auth/unauth', 'refresh');
		}
	}



}
