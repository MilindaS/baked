<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_auth extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	function login($data){
		$email = $data['username'];
		$password = sha1($data['password']);

		$users = $this->db->where(array('username'=>$email,'password'=>$password))->get('user');
		$result = $users->result_array();
		if(count($result)>0){
			// log_message('error',$result[0]['id']);
			$sess_array = array(
					'id' => (string)$result[0]['id'],
					'username' => strtolower($result[0]['username']),
					'key' => intval(microtime(true))
				);
		   	$this->session->set_userdata('logged_in', $sess_array);
		   	
		   return $result;
		}else{
			return null;
		}

	}

}
