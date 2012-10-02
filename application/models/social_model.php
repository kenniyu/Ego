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
			$article = $this->db->get_where('articles', array('aid' => $permalink))->row();
			$ref_id = $article->id;
			$this->db->insert('clips', array(
				'username' => $username, 'type' => $type, 'ref_id' => $ref_id
			));
			
			$user_clipcount = $this->user_clipcount($username);
			$this->db->where('username', $username);
			$this->db->update('membership', array('clip_count' => $user_clipcount));
			
			$clip_count = intval($article->clip_count);
			$this->db->where('aid', $permalink);
			$this->db->update('articles', array('clip_count' => $clip_count+1));
			
			return $clip_count+1;
	}
	
	function user_clipcount($username){
		return $this->db->get_where('clips', array('username' => $username, 'type' => 'public'))->num_rows();
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

	
	function check_subscribed($person){
		if ($this->db->get_where('people', array('username' => $this->session->userdata('username'), 'subscribed_person' => $person))->num_rows() > 0){
			return TRUE;
		} else{
			return FALSE;
		}
	}
	
	function get_people(){
		$username = $this->session->userdata('username');
		$result = $this->db->get_where('people', array('username' => $username))->result();
		$array_people = array();
		foreach($result as $user){
			array_push($array_people, $this->db->get_where('membership', array('username' => $user->subscribed_person))->row());
		}
		return $array_people;
	}
	
	function find_person($input){
		$query = "SELECT * FROM membership WHERE whole_name LIKE '%".$input."%' OR username LIKE '%".$input."%'";
		$result = $this->db->query($query)->result();
		foreach($result as $person){
			$person->subscribed = $this->check_subscribed($person->username);
		}
		return $result;
	}
	
	function subscribe_person($username, $person){
			$this->db->insert('people', array('username' => $username, 'subscribed_person' => $person, 'since' => date("Y-m-d")));
	}
	
	function unsubscribe_person($username, $person){
		$this->db->delete('people', array('username' => $username, 'subscribed_person' => $person));
	}
	
	function update_count_subscribers($username){
		$count = $this->db->get_where('people', array('subscribed_person' => $username))->num_rows();
		$this->db->where('username', $username);
		$this->db->update('membership', array('subscribers' => $count));
	}
	
	function update_profileInfo($username, $ext){
		$profileInfo = array('profile_ext' => $ext);
		$this->db->where('username', $username);
		$this->db->update('membership', $profileInfo);
	}
	
}


?>