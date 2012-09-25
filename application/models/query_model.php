<?php

	class Query_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
		function add_feed($title, $url, $type){
			if ($title == '' || $url == ''){
				return 'Oops - you are missing something!';
			}
			 else if ($this->db->get_where('feed', array('username' => $this->session->userdata('username'), 'title' => $title))->num_rows() > 0){
				return 'You already have another feed with the same name. Try another.';
			} else {
				$this->load->model('loader_model');
				$feed_count = $this->loader_model->get_feedCount($this->session->userdata('username'));	// get the current feed count of the user
				$new_feed = array(
				'username' => $this->session->userdata('username'),
				'title' => $title,
				'url' => $url,
				'type' => $type, 
				'pos_id' => $feed_count+1
				);
				$this->db->insert('feed', $new_feed);
				$this->db->where('username', $this->session->userdata('username'));
				$this->db->update('membership', array('feed_count' => $feed_count+1));	//update the feed count
				$query = $this->db->get_where('feed', array('username' => $this->session->userdata('username'), 'title' => $title));
				return intval($query->row()->id);
			}
		}
		function add_label($label_name, $new_label){
			foreach($new_label as $id){
				$target = $this->db->get_where('feed', array('id' => $id))->row();
				if ($target->type == 'keyword'){
					$url = 'feed://news.google.com/news/feeds?gl=us&pz=1&cf=all&ned=us&hl=en&q='.$target->url.'&output=rss';
				} else{
					$url = $target->url;
				}
				$this->db->insert('label', array('username' => $this->session->userdata('username'), 'label_name' => $label_name, 'feed_url' => $url, 'feed_title' => $target->title, 'ref_id' => $id));
			}
			
			$this->load->model('loader_model');
			$label_count = $this->loader_model->get_labelCount($this->session->userdata('username'));
			$this->db->insert('label_list', array('username' => $this->session->userdata('username'), 'label' => $label_name, 'pos_id' => $label_count+1));
			$this->db->where('username', $this->session->userdata('username'));
			$this->db->update('membership', array('label_count' => $label_count+1));
		}
		function updateLabel($feeds, $id){
			$label_name = $this->db->get_where('label_list', array('id' => $id))->row()->label;
			if ($this->db->get_where('label', array(
				'username' => $this->session->userdata('username'), 
				'label_name' => $label_name, 
				'feed_title' => $feeds)
				)->num_rows() > 0){
				return 'You already have that feed in this label.';
			} else if ($this->db->get_where('feed', array('username' => $this->session->userdata('username'), 'title' => $feeds))->num_rows() > 0){
				//Insert the new feed to the label
				$this->load->model('loader_model');
				$count = $this->loader_model->get_labelContentCount($id);
				$targetFeed = $this->db->get_where('feed', array('username' => $this->session->userdata('username'), 'title' => $feeds))->row();
				$feed_url = $targetFeed->url;
				$ref_id = $targetFeed->id;
				$this->db->insert('label', array('username' => $this->session->userdata('username'), 'label_name' => $label_name, 'feed_url' => $feed_url, 'feed_title' => $feeds, 'ref_id' => $ref_id, 'pos_id' => $count+1));
				
				//Update the label count
				$this->db->where('id', $id);
				$this->db->update('label_list', array('count' => $count+1));
				
				//Return the information
				$result = $this->db->get_where('label', array('username' => $this->session->userdata('username'), 'label_name' => $label_name, 'feed_url' => $feed_url, 'feed_title' => $feeds, 'ref_id' => $ref_id))->row()->id;
				return array($ref_id, $result);
			}
			else{
				return 'You are not subscribed to that feed yet.';
			}
		}
		function delete_feed($id){
			$this->load->model('loader_model');	// decrease  the user's feed count
			$feed_count = $this->loader_model->get_feedCount($this->session->userdata('username'));
			$this->db->where('username', $this->session->userdata('username'));
			$this->db->update('membership', array('feed_count' => $feed_count-1));
			
			$feed = $this->db->get_where('feed', array('id' => $id))->row();	//update feeds with higher pos_id to avoid duplicate pos_id
			$target = $this->db->get_where('feed', array('pos_id >' => $feed->pos_id))->result();
			foreach($target as $item){
				$this->db->where('id', $item->id);
				$this->db->update('feed', array('pos_id' => ($item->pos_id)-1));
			}
			
			$this->db->delete('feed', array('id' => $id));
			$this->db->delete('label', array('ref_id' => $id));
			//BUG FIX NEEDED
		}
		
		function delete_label($id){
			$this->load->model('loader_model'); // decrease the user's label count
			$label_count = $this->loader_model->get_labelCount($this->session->userdata('username'));
			$this->db->where('username', $this->session->userdata('username'));
			$this->db->update('membership', array('label_count' => $label_count-1));
			
			$label = $this->db->get_where('label_list', array('id' => $id))->row(); //update labels with higher pos_id to avoid duplicate pos_id
			$target = $this->db->get_where('label_list', array('pos_id >' => $label->pos_id))->result();
			foreach($target as $item){
				$this->db->where('id', $item->id);
				$this->db->update('label_list', array('pos_id' => ($item->pos_id)-1));
			}
					
			$this->db->delete('label', array('username' => $this->session->userdata('username'), 'label_name' => $label->label));
			$this->db->delete('label_list', array('username' => $this->session->userdata('username'), 'id' => $id));
		}
		function delete_labelContent($id){
			$labelContent = $this->db->get_where('label', array('id' => $id))->row();
			$label = $this->db->get_where('label_list', array('username' => $labelContent->username, 'label' => $labelContent->label_name))->row();
			$this->db->where('id', $label->id);
			$this->db->update('label_list', array('count' => ($label->count)-1));
			
			$target = $this->db->get_where('label', array('pos_id >' => $labelContent->pos_id))->result();
			foreach($target as $item){
				$this->db->where('id', $item->id);
				$this->db->update('label', array('pos_id' => ($item->pos_id)-1));
			}
			
			$this->db->delete('label', array('id' => $id));
		}
		function add_article($permalink, $title, $source, $date, $content){
			$this->db->insert('articles', array(
				'aid' => $permalink, 'title' => $title, 'source' => $source, 'date' => $date, 'content' => $content
			));
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
		function share_clip($sender, $recipient, $permalink, $title, $content, $source, $date, $type){
			if ($this->db->get_where('articles', array('aid' => $permalink))->num_rows() == 0){
				$this->db->insert('articles', array(
					'aid' => $permalink, 'title' => $title, 'source' => $source, 'date' => $date, 'content' => $content
				));
			}  
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
		function mark($aid){
			$this->db->insert('mark', array('aid' => $aid, 'username' => $this->session->userdata('username'), 'timestamp' => date("Y-m-d")));
		}
		function move_clip($id, $destination){
			$update = array('type' => $destination);
			$this->db->where('id', $id);
			$this->db->update('clips', $update);
		}
		function delete_clip($id){
			$target = $this->db->get_where('clips', array('id' => $id))->row();
			if ($target->username == $this->session->userdata('username')){
				$this->db->delete('clips', array('id' => $id));
				
			}else{
				redirect('site/feed/');
			}
		}
		function feed_position($feedOrder){
			foreach ($feedOrder['feed'] as $key => $value ){
				$this->db->where('id', $value);
				$this->db->update('feed', array('pos_id' => $key+1));
			}
			// receives an array of the user's feeds and for each feed, change its pos_id according to its index values in array.
			// add to database: a new pos_id column for feeds table that store's the feed's position.
			// add to database: feed_count and label_count that stores the number of feeds and labels the user has.
			// modify add_feed(): add_feed increases feed_count and the new feed's pos_id is the incremented feed_count
			// modify delete_feed(): delete_feed decreases feed_count. 
			// modify add_label(): add_label increases label_count and the new label's pos_id is the incremented label_count
			//modify delete_label(): delete_label decreases label_count.
			
			// pos_id invariant: <pos_id is unique to the user's feed>
			// pos_id is an integer from 0 to onwards, and increments as the user adds new feeds.
			// it is important to note that pos_id is not unique; it is unique to the user.
			// therefore, a user has pos_id (0 ~ ) and the other user has seperate pos_id (0 ~ ), so on.
		}
		function label_position($labelOrder){
			foreach($labelOrder['label'] as $key => $value ){
				$this->db->where('id', $value);
				$this->db->update('label_list', array('pos_id' => $key+1));
			}
		}
		function labelContent_position($labelContentOrder){
			foreach($labelContentOrder['labelContent'] as $key => $value ){
				$this->db->where('id', $value);
				$this->db->update('label', array('pos_id' => $key+1));
			}
		}
	}
?>