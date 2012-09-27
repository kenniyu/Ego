<?php

class Social_model extends CI_Model{
	public function __construct(){
			$this->load->database();
	}
	function give_bump($type, $permalink, $username){
		$article = $this->db->get_where('articles', array('aid' => $permalink))->row();
		$ref_id = $article->id;
		$this->db->insert('bumps', array(
			'username' => $username, 'type' => $type, 'ref_id' => $ref_id
		));
		if ($type == '0'){
			$bump_count = intval($article->bump_up_count);
			$this->db->where('aid', $permalink);
			$this->db->update('articles', array('bump_up_count' => $bump_count+1));
			return $bump_count+1;
		} else{
			$bump_count = intval($article->bump_down_count);
			$this->db->where('aid', $permalink);
			$this->db->update('articles', array('bump_down_count' => $bump_count+1));
			return $bump_count+1;
		}
		
	}
	function add_clip($permalink, $username, $type){
			/*
			if ($this->db->get_where('articles', array('aid' => $permalink))->num_rows() == 0){
				$this->db->insert('articles', array(
					'aid' => $permalink, 'title' => $title, 'source' => $source, 'date' => $date, 'content' => $content
				));
			} 
			*/ 
			$article = $this->db->get_where('articles', array('aid' => $permalink))->row();
			$ref_id = $article->id;
			$this->db->insert('clips', array(
				'username' => $username, 'type' => $type, 'ref_id' => $ref_id
			));
			$clip_count = intval($article->clip_count);
			$this->db->where('aid', $permalink);
			$this->db->update('articles', array('clip_count' => $clip_count+1));
			return $clip_count+1;
	}
	function share_clip($sender, $recipient, $permalink, $type){
			$article = $this->db->get_where('articles', array('aid' => $permalink))->row();
			$ref_id = $article->id;
			$this->db->insert('clips', array(
				'username' => $recipient, 'type' => $type, 'sender' => $sender, 'ref_id' => $ref_id
			));
			$share_count = intval($article->share_count);
			$this->db->where('aid', $permalink);
			$this->db->update('articles', array('share_count' => $share_count+1));
			return $share_count+1;
	}
	
	function get_clips($username){
			/*
			$query = $this->db->get_where('clip', array('username' => $username, 'type' => 'public'));
			return $query->result();
			*/
			$result = array();
			$target = $this->db->get_where('clips', array('username' => $username, 'type' => 'public'))->result();
			foreach ($target as $item){
				$article = $this->db->get_where('articles', array('id' => $item->ref_id))->row();
				$article->type = $item->type;
				array_push($result, $article);
			}
			return $result;
	}
	function get_myClips(){
			/*
			$query = $this->db->get_where('clip', array('username' => $this->session->userdata('username'), 'type !=' => 'received'));
			return $query->result();
			*/
			$result = array();
			$target = $this->db->get_where('clips', array('username' => $this->session->userdata('username'), 'type !=' => 'received'))->result();
			foreach($target as $item){
				$article = $this->db->get_where('articles', array('id' => $item->ref_id))->row();
				$article->id = $item->id;
				$article->type = $item->type;
				$article->ref_id = $item->ref_id;
				array_push($result, $article);
			}
			return $result;
	}
	function get_receivedClips(){
			/*
			$query = $this->db->get_where('clip', array('username' => $this->session->userdata('username'), 'type' => 'received'));
			return $query->result();
			*/
			$result = array();
			$target = $this->db->get_where('clips', array('username' => $this->session->userdata('username'), 'type' => 'received'))->result();
			foreach($target as $item){
				$article = $this->db->get_where('articles', array('id' => $item->ref_id))->row();
				$article->type = $item->type;
				array_push($result, $article);
			}
			return $result;
	}	
	function get_friendsList($username){
		$query = $this->db->get_where('friendship', array('username' => $username));
		
		$ID_List = $query->result();
		$friendsList = array();
		foreach ($ID_List as $friend){
			array_push($friendsList, $this->db->get_where('membership', array('username' => $friend->friend_name))->row());
		}
		return $friendsList;
	}
	function search_member($username){
		$query = $this->db->get_where('membership', array('username' => $username));
		return $query->result();
	}
	function add_friend($username, $friend_name){
		$friend = array(
				'username' => $username,
				'friend_name' => $friend_name,
				'friend_since' => date("Y-m-d")
		);
		$this->db->insert('friendship', $friend);
	}
	function update_profileInfo($username, $ext){
		$profileInfo = array('profile_ext' => $ext);
		$this->db->where('username', $username);
		$this->db->update('membership', $profileInfo);
	}
}


?>