<?php

class Social_model extends CI_Model{
	public function __construct(){
			$this->load->database();
	}
	function give_bump($type, $permalink, $username){
		// Get the article the user bumped and it's primary key
		$article = $this->db->get_where('articles', array('aid' => $permalink))->row();
		$ref_id = $article->id;
		
		// Get the rows for the user's bumps on this article
		$query_check_bumped = $this->db->get_where('bumps', array('username' => $username,'ref_id'=>$ref_id));
		
		// Check to make sure that there are only 0 or 1 entries returned. If it isn't, then this an error.
		if($query_check_bumped->num_rows() > 1)
		{
			// Error - return with no changes.
			return $article->bump_up_count.';'.$article->bump_down_count;
		}
		
		// If the user hasn't ever bumped
		elseif($query_check_bumped->num_rows() == 0)
		{
			// Record the bump in the 'bumps' table
			$this->db->insert('bumps', array(
				'username' => $username, 
				'type' => $type, 
				'ref_id' => $ref_id
			));
			
			$up_bump_count = intval($article->bump_up_count);
			$down_bump_count = intval($article->bump_down_count);
			
			// if the bump was a like ('0') increment the up in the 'articles' table
			if ($type == '0')
			{
				$this->db->where('aid', $permalink);
				$this->db->update('articles', array('bump_up_count' => ++$up_bump_count));
			}
			// if the bump was a dislike ('1') increment the down in the 'articles' table 
			else
			{
				$this->db->where('aid', $permalink);
				$this->db->update('articles', array('bump_down_count' => ++$down_bump_count));
			}
			
			return $up_bump_count.';'.$down_bump_count;
		}
		
		// if the user has bumped and the bump type is the same as before
		elseif($query_check_bumped->row()->type == $type)
		{
			return $article->bump_up_count.';'.$article->bump_down_count;
		}
		
		// if the user has bumped and the bump type is different
		else
		{
			$to_return = 0;
			// Delete the existing entry
			$this->db->delete('bumps',array('id' => $query_check_bumped->row()->id));
			
			// if the new bump was a like, decrement the bump down count in 'articles' table
			if ($type == '0')
			{
				$bump_count = intval($article->bump_down_count);
				$this->db->where('aid', $permalink);
				$this->db->update('articles', array('bump_down_count' => $bump_count-1));
			}
			// if the new bump was a dislike, decrement the bump up count in the 'articles' table
			else 
			{
				$bump_count = intval($article->bump_up_count);
				$this->db->where('aid', $permalink);
				$this->db->update('articles', array('bump_up_count' => $bump_count-1));
			}
			
			return $this->give_bump($type, $permalink, $username);	
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
