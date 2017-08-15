<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mdl_common');
	}

	public function header($css_array=null,$js_array=null,$meta_array=null,$meta_og_array=null){
		$data['css_array'] = $css_array;
		$data['js_array'] = $js_array;
		$data['meta_array'] = $meta_array;
		$data['meta_og_array'] = $meta_og_array;
		$this->load->view('header',$data);
	}
	
	public function navigationBarMain(){
		$this->load->view('navigationBarMain');
	}

	public function headBarMain(){
		$this->load->view('headBar');
	}

	public function footBarMain(){
		$this->load->view('footBar');
	}

	public function footer(){
		$this->load->view('footer');
	}

	public function getStatusReportCount($status,$user){
		return $this->mdl_common->getStatusReportCount($status,$user);
	}

	public function logRec($action,$rec_id){
		$this->mdl_common->logRec($action,$rec_id);
	}

	public function getLog(){
		return $this->mdl_common->getLog();
	}

	public function getUserLog($usreid){
		return $this->mdl_common->getUserLog($usreid);
	}


	public function getAllLog(){
		return $this->mdl_common->getAllLog();
	}

	public function getUserActions($id){
		return $this->mdl_common->getUserActions($id);
	}

	public function getNextRefNo(){
		$max_row = $this->mdl_common->getNextRefNo();
		echo json_encode($max_row[0]['MRF']+1);
	}

	public function getUserAjax($user_id){
		echo json_encode($this->mdl_common->getUser($user_id));
	}

	public function saveChatMsg(){
		$this->mdl_common->saveChatMsg($this->input->post());
	}

	public function getChatMsg($from,$count){
		echo json_encode($this->mdl_common->getChatMsg($from,$count));
	}

	public function getChatCount(){
		echo count($this->mdl_common->getChatCount());
	}

	function getWallPostsJSON($limit,$offset){
		echo json_encode($this->mdl_common->getWallPosts($limit,$offset));
	}


	function addComment(){
		$result = $this->mdl_common->addComment($this->input->post());
		$liked_user = $this->mdl_common->getUser($this->input->post('user_idx'));
		// $not_arr = array('post_mid'=>$result[0]['_id'],'user'=>$result[0]['user'],'username'=>$result[0]['username'],'profpic'=>$result[0]['profpic'],'action'=>'commented');
		$seen_arr = array($liked_user[0]['id']);
		$not_arr = array('post_mid'=>$result[0]['_id'],'user_p'=>$result[0]['user'],'user_a'=>$liked_user[0]['id'],'action'=>'commented','seen_by'=>$seen_arr);
		$resultn = $this->mdl_common->addNotification($not_arr);
		$return  = 	array('type'=>'success',
						'data'=>$result,
						'msg'=>'<i class="ion-checkmark-circled"></i>&nbsp;&nbsp;Document Saved !');
		echo json_encode($return);
	}

	function addLiketoPost(){
		$result = $this->mdl_common->addLiketoPost($this->input->post());
		$liked_user = $this->mdl_common->getUser($this->input->post('user_idx'));
		
		$seen_arr = array($liked_user[0]['id']);

		$not_arr = array('post_mid'=>$result[0]['_id'],'user_p'=>$result[0]['user'],'user_a'=>$liked_user[0]['id'],'action'=>'liked','seen_by'=>$seen_arr);
		$resultn = $this->mdl_common->addNotification($not_arr);
		$return  = 	array('type'=>'success',
						'data'=>$result,
						'msg'=>'<i class="ion-checkmark-circled"></i>&nbsp;&nbsp;Document Saved !');
		echo json_encode($return);
	}

	function submitPost(){
		$result = $this->mdl_common->submitPost($this->input->post());
		$added_user = $this->mdl_common->getUser($this->input->post('user_idx'));
		$seen_arr = array($result[0]['user']);
		$not_arr = array('post_mid'=>$result[0]['_id'],'user_p'=>$result[0]['user'],'user_a'=>$added_user[0]['id'],'action'=>'added','seen_by'=>$seen_arr);

		$resultn = $this->mdl_common->addNotification($not_arr);
		$return  = 	array('type'=>'success',
						'data'=>$result,
						'msg'=>'<i class="ion-checkmark-circled"></i>&nbsp;&nbsp;Document Saved !');
		echo json_encode($return);
	}

	function removePost(){
		$this->mdl_common->removePost($this->input->post());
	}

	

	public function getPostCount(){
		echo count($this->mdl_common->getPostCount());
	}

	public function addPostSeen(){
		$this->mdl_common->addPostSeen($this->input->post());
	}

	
	public function getUnseenCount(){
		echo json_encode( $this->mdl_common->getUnseenCount($this->input->post()));
	}
	
	public function getNotifications(){
		echo json_encode( $this->mdl_common->getNotifications());
	}

	
}
