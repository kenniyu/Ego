<?php

class Query extends CI_Controller{
	function add_feed(){
		$title = $this->input->post('site_name');
		$url = $this->input->post('rss_address');
		$this->load->model('query_model');
		$result = $this->query_model->add_feed($title, $url, 'site');
		if (is_int($result)){
			echo '<li class="rightList"><a href="/site/feed/'.$result.'">'.$title.'</a></li>';
		} else{
			echo $result;
		}
	}
	function add_keyword(){
		$keyword = $this->input->post('keyword');
		$url = str_replace(' ', '+', $keyword);
		$this->load->model('query_model');
		$result = $this->query_model->add_feed($keyword, $url, 'keyword');
		if (is_int($result)){
			echo '<li class="rightList"><a href="/site/feed/'.$result.'">'.$keyword.'</a></li>';
		} else{
			echo $result;
		}
	}

	function add_label(){
		$label_name = $this->input->post('label_name');
		$new_label = $this->input->post('feeds');
		$this->load->model('query_model');
		$this->query_model->add_label($label_name, $new_label);
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}

  function search_typeahead() {
		$query_string = $this->input->post('query');
		$this->load->model('query_model');
		$feed_results = $this->query_model->get_feeds_by_title($query_string);
    array_unshift($feed_results, array("id" => "-1", "title" => "Feed Title"));
    $json = json_encode($feed_results);
    echo $json;
  }

	function update_label(){
		$feeds = $this->input->post('feeds');
		$id = $this->input->post('id');
		$this->load->model('query_model');
		$result = $this->query_model->updateLabel($feeds, $id);
		if (is_array($result)){
			echo '<li class="rightListInner"><a href="/site/feed/'.$result[0].'">'.$feeds.'</a><div class="rightListToolbox"><div class="rightListDelete" data-type="labelContent" data-id="'.$result[1].'"><img src="/icons/right_toolbox/delete.png" /></div></div></li>';
		} else{
			echo $result;
		}
		
	}

	function delete_feed($id){
		$this->load->model('query_model');
		$this->query_model->delete_feed($id);
	}
	function delete_label($id){
		$this->load->model('query_model');
		$this->query_model->delete_label($id);
	}
	function delete_labelContent($id){
		$this->load->model('query_model');
		$this->query_model->delete_labelContent($id);
	}
	function feed_position(){
		parse_str($_POST['feeds'], $feedOrder);
		$this->load->model('query_model');
		$this->query_model->feed_position($feedOrder);
		//receives an array of the user's feeds as post and sends the array to the model.
		//room for optimization: determine only the feeds whose pos_id need to be changed.
	}
	function label_position(){
		parse_str($_POST['labels'], $labelOrder);
		$this->load->model('query_model');
		$this->query_model->label_position($labelOrder);
	}
	function labelContent_position(){
		parse_str($_POST['labelContents'], $labelContentOrder);
		$this->load->model('query_model');
		$this->query_model->labelContent_position($labelContentOrder);
	}
	function mark(){
		$aid = $this->input->post('aid');
		$this->load->model('query_model');
		$this->query_model->mark($aid);
	}
	function add_mailingList(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		if ($this->form_validation->run() == FALSE){
			echo 'There\'s something wrong with your email';
		}
		else if ($this->db->get_where('mailinglist', array('email_address' => $this->input->post('email_address')))->num_rows() > 0){
				echo 'I know you love us, but your email address is already in our mailing list.';
		}
		else{	
			$this->db->insert('mailinglist', array('email_address' => $this->input->post('email_address')));	
			echo 'Thank you for signing up for our mailing list. We will keep you posted!';
		}
	}
	
	
}
