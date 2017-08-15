<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_common extends CI_Model {

	private $_data;
	private $_sessionOwner;

	function __construct(){
		parent::__construct();
		$this->mongodb = new Cimongo();
		$this->_sessionOwner = $this->session->userdata( 'logged_in');
		$this->_data['ts'] = array(
								'datetime'=>date('Y-M-d H:i:s'),
								'ts'=>microtime(true)*1000);
	}
	
	
	public function getStatusReportCount($status,$user=null){
		if($user !=null){
			$sql = "SELECT * FROM report WHERE status=? AND report_at=?";
			$params = array($status,$user);
		}else{
			$sql = "SELECT * FROM report WHERE status=?";
			$params = array($status);
		}
		$query = $this->db->query($sql,$params);
		return $query->num_rows();
	}

	public function logRec($action,$rec_id){
		$loggedinuser=$this->session->userdata ( 'logged_in');
	 	// print_r($loggedinuser); 
		$user_id = $loggedinuser['id'];
		$action_effected_date = date('Y-m-d H:i:s');

		$sql = "INSERT INTO log (user_id,action,action_effected_date,effected_record) VALUES(?,?,?,?)";
		$params = array($user_id,$action,$action_effected_date,$rec_id);
		$query = $this->db->query($sql,$params);
		$post_id = $this->db->insert_id();

		return true;
	}

	
	public function saveChatMsg($data){
		$sql = "INSERT INTO chat(user_id,username,profilepic,messege) VALUES(?,?,?,?)";
		$params = array($data['userid'],$data['username'],$data['user_profPic'],$data['msg']);
		$query = $this->db->query($sql,$params);

		return true;
	}

	public function getChatMsg($from,$count){
		$sql = "SELECT * FROM chat ORDER BY ts DESC LIMIT ".$from.",".$count;
		$params = array();
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

	public function getChatCount(){
		$sql = "SELECT * FROM chat";
		$params = array();
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}


	public function getPostCount(){
		$posts = $this->mongodb->get('posts');
		$result = $posts->result_array();
		return $result;
	}


	
    
    public function getLog(){
    	$sql = "SELECT * FROM log INNER JOIN user ON user.id = log.user_id INNER JOIN report ON log.effected_record = report.id ORDER BY log.action_effected_date DESC LIMIT 0,10 ";
		$params = array();
		$query = $this->db->query($sql,$params);
		return $query->result_array();
    }


    public function getUserLog($userid){
    	$sql = "SELECT * FROM log INNER JOIN user ON user.id = log.user_id INNER JOIN report ON log.effected_record = report.id WHERE user.id = ? ORDER BY log.action_effected_date DESC LIMIT 0,10 ";
		$params = array($userid);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
    }

    public function getAllLog(){
    	$sql = "SELECT * FROM log INNER JOIN user ON user.id = log.user_id INNER JOIN report ON report.id = log.effected_record ORDER BY log.action_effected_date DESC";
		$params = array();
		$query = $this->db->query($sql,$params);
		return $query->result_array();
    }
    
    public function getUserActions($id){
    	$sql = "SELECT * FROM actions where id=?";
		$params = array($id);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
    }

    public function getNextRefNo(){
    	$sql = "SELECT MAX(ref_no) AS MRF FROM report";
		$params = array();
		$query = $this->db->query($sql,$params);
		return $query->result_array();
    }

    public function getUser($user_id){
		$sql = "SELECT * FROM user where id=?";
		$params = array($user_id);
		$query = $this->db->query($sql,$params);
		return $query->result_array();
	}

	public function getWallPosts($limit,$offset){
		$posts = $this->mongodb->order_by(array("ts.ts"=>"desc"))->get('posts',$limit,$offset);
		$result = $posts->result_array();
		return $result;
	}

	public function submitPost($data){
		$this->_data['post'] =$data['post'];

		$posts = $this->mongodb->get('posts');
		$result = $posts->result_array();

		$this->_data['postid'] =count($result);
		$this->_data['user'] =$data['user_idx'];
		

		$user_arr = $this->getUser($data['user_idx']);
		$user = $user_arr[0];

		$this->_data['username'] = $user['username'];
		$this->_data['profpic'] = $user['file_link'];
		
		$result = $this->mongodb->insert('posts',$this->_data);
		if($result){
			$docs = $this->mongodb->where(array('_id'=>new MongoID($this->mongodb->insert_id())))->get('posts');
			$result = $docs->result_array();
			return $result;
		}
	}


	public function removePost($data){
		$this->mongodb->where(array('_id'=>new MongoID($data['post_id'])))->delete('posts');
		$this->mongodb->where(array('post_mid'=>new MongoID($data['post_id'])))->delete('notifications');
	}

	public function addNotification($data){
		$noteData = array();
		$noteData['post_mid'] = $data['post_mid'];
		$noteData['user_p'] = $data['user_p'];
		$noteData['user_a'] = $data['user_a'];
		$noteData['action'] = $data['action'];
		$noteData['seen_by'] = $data['seen_by'];
		$noteData['ts'] = array(
									'datetime'=>date('Y-M-d H:i:s'),
									'ts'=>microtime(true)*1000);
		$result = $this->mongodb->insert('notifications',$noteData);
	}

	public function getNotifications(){
		$docs = $this->mongodb->order_by(array("ts.ts"=>"desc"))->get('notifications');
		$result = $docs->result_array();
		// log_message('error',json_encode($result));
		$x = 0;
		foreach ($result as $notification) {
			$user_id = $notification['user_p'];
			$user_arr = $this->getUser($user_id);
			$userp = $user_arr[0];

			$result[$x]['user_p_username'] = $userp['username'];
			$result[$x]['user_p_profpic']= $userp['file_link'];

			$user_id = $notification['user_a'];
			$user_arr = $this->getUser($user_id);
			$usera = $user_arr[0];

			$result[$x]['user_a_username'] = $usera['username'];
			$result[$x]['user_a_profpic']= $usera['file_link'];


			$x++;
		}
		// array_push($result, $datau);
		return $result;
	}

	public function addComment($data){
		// $posts = $this->mongodb->get('posts');
		// $posts = $this->mongodb->where(array('_id'=>new MongoID($data['post_id'])))->get('posts');
		$posts = $this->mongodb->where(array('_id'=>new MongoID($data['post_id'])))->get('posts');
		$result = $posts->result_array();
		
		$temp_arr = array();

		if(isset($result[0]['comments'])){
			$comments_arr = $result[0]['comments'];
			$id = count($result[0]['comments']);
		}else{
			$comments_arr = array();
			$id = 0;
		}

		// log_message('error','---p--------'.json_encode($data['post_id']));
		// log_message('error',json_encode($result));

		$temp_arr['id'] = $id;
		$temp_arr['user'] = $data['user_idx'];
		$temp_arr['ts'] = array(
									'datetime'=>date('Y-M-d H:i:s'),
									'ts'=>microtime(true)*1000);
		$temp_arr['content'] = $data['comment'];

		$user_arr = $this->getUser($data['user_idx']);
		$user = $user_arr[0];

		$temp_arr['username'] = $user['username'];
		$temp_arr['profpic'] = $user['file_link'];

		array_push($comments_arr, $temp_arr);

		$this->_data['comments'] = $comments_arr;

		// log_message('error',json_encode($this->_data['comments']));
		// exit();
		if($data['post_id']!=null){
			$result = $this->mongodb->where(array('_id'=>new MongoID($data['post_id'])))->update('posts',$this->_data);
		}
		$comments_arr = array();

		if($result){
			$docs = $this->mongodb->where(array('_id'=>new MongoID($data['post_id'])))->get('posts');
			$result = $docs->result_array();
			return $result;
		}
	}

	
	public function addPostSeen($data){
		$userid = $data['userid'];
		log_message('error','Seen by'.$userid);
		$username = $data['username'];
		$post_id = $data['post_id'];

		if(is_null($post_id) || $post_id == NULL){
		log_message('error','------Fk'.json_encode($post_id));
			$notification_arr = $this->mongodb->get('notifications');
		}else{
			$notification_arr = $this->mongodb->where(array('post_mid'=>new MongoID($data['post_id'])))->get('notifications');
		}
		$result = $notification_arr->result_array();
		// $seenByArr = array();
		// log_message('error',count($result));


		for($x=0;$x<count($result);$x++){
			if(!in_array($userid, $result[$x]['seen_by'])){
				array_push($result[$x]['seen_by'], $userid);
				$this->_data["seen_by"] = $result[$x]['seen_by'];
				if(is_null($post_id) || $post_id == NULL){
					$this->mongodb->update_batch('notifications',$this->_data);
				}else{
					$this->mongodb->where(array('post_mid'=>new MongoID($data['post_id'])))->update_batch('notifications',$this->_data);
				}
			}
		}
	}

	public function getUnseenCount($data){
		$userid = $data['user_idx'];
		$notifications = $this->mongodb->get('notifications',30,0);
		$result = $notifications->result_array();
		$y = 0;
		for($x=0;$x<count($result);$x++){
			// log_message('error',json_encode($result[$x]['seen_by']));
			if(!in_array($userid, $result[$x]['seen_by'])){
				$y = $y +1;
			}
		}

		return $y;

	}

	public function addLiketoPost($data){
		$postid = $data['post_id'];

		// $posts = $this->mongodb->get('posts');
		$posts = $this->mongodb->where(array('_id'=>new MongoID($data['id'])))->get('posts');
		$result = $posts->result_array();
		
		$temp_arr = array();

		if(isset($result[0]['likes'])){
			$likes_arr = $result[0]['likes'];
			foreach ($result[0]['likes'] as $like) {
				if($like['user'] == $data['user_idx']){ exit();}
			}
			$id = count($result[0]['likes']);
		}else{
			$likes_arr = array();
			$id = 0;
		}


		$temp_arr['id'] = $id;
		$temp_arr['user'] = $data['user_idx'];
		$user_arr = $this->getUser($data['user_idx']);
		$user = $user_arr[0];
		$temp_arr['username'] = $user['username'];
		$temp_arr['profpic'] = $user['file_link'];

		array_push($likes_arr, $temp_arr);

		$this->_data['likes'] = $likes_arr;

		if($data['post_id']!=null){
			$result = $this->mongodb->where(array('_id'=>new MongoID($data['id'])))->update('posts',$this->_data);
		}

		if($result){
			$docs = $this->mongodb->where(array('_id'=>new MongoID($data['id'])))->get('posts');
			$result = $docs->result_array();
			return $result;
		}

		// return true;
	}
}
