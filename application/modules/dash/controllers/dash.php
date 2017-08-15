<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dash extends MX_Controller {
	const RAW_OUTPUT = true;
	
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_dash');
		$this->load->module('common');
		$this->load->module('auth');
		$this->auth->isAuthenticated();
	}
	function index(){
		$this->home();
	}
	function home(){
		$data['totalSpace'] = $this->totalSpace();
		$data['usedSpace'] = $this->usedSpace();
		$data['freeSpace'] = $this->freeSpace();
		$css_array = array();
		$js_array = array();
		$this->common->header($css_array,$js_array);
		$this->load->view('home',$data);
		$this->common->footer();
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

	public function totalSpace($rawOutput = false) {
      $diskTotalSpace = @disk_total_space('/');

      if ($diskTotalSpace === FALSE) {
        throw new Exception('totalSpace(): Invalid disk path.');
      }

      return $rawOutput ? $diskTotalSpace : $this->addUnits($diskTotalSpace);
    }

    public function usedSpace($precision = 1) {
	    try {
	      return round((100 - ($this->freeSpace(self::RAW_OUTPUT) / $this->totalSpace(self::RAW_OUTPUT)) * 100), $precision);
	    } catch (Exception $e) {
	      throw $e;
	    }
  	}

  	public function freeSpace($rawOutput = false) {
	    $diskFreeSpace = @disk_free_space('/');

	    if ($diskFreeSpace === FALSE) {
	      throw new Exception('freeSpace(): Invalid disk path.');
	    }

	    return $rawOutput ? $diskFreeSpace : $this->addUnits($diskFreeSpace);
	  }

    private function addUnits($bytes) {
	    $units = array( 'B', 'KB', 'MB', 'GB', 'TB' );

	    for($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++ ) {
	      $bytes /= 1024;
	    }

	    return round($bytes, 1).' '.$units[$i];
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
