<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_user extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function get_table(){
		$table = "tablename";
		return $table;
	}
	
	
	public function getUser($user_id){
		$sql = "SELECT * FROM user where id=?";
		$params = array($user_id);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

	public function getUsers(){
		$sql = "SELECT * FROM user";
		$params = array();
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

    public function changeGenDetails($data){
    	$loggedinuser = $this->session->userdata ( 'logged_in');
    	$sql = "UPDATE user set fullname = ? ,username = ? WHERE id =?";
		$params = array($data['fullname'],$data['username'],$loggedinuser['id']);
		$query = $this->db->query($sql,$params);
    }

    public function changePwd($data){
    	$loggedinuser = $this->session->userdata ( 'logged_in');
    	$sql = "UPDATE user set password = ? WHERE id =?";
		$params = array(sha1($data['password']),$loggedinuser['id']);
		$query = $this->db->query($sql,$params);
    }

    public function saveUpld($data){
    	$loggedinuser = $this->session->userdata ( 'logged_in');
    	$sql = "UPDATE user set file_path = ? ,file_link = ? WHERE id =?";
		$params = array($data['filePath'],$data['prevPath'],$loggedinuser['id']);
		$query = $this->db->query($sql,$params);
    }
}
