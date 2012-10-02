<?php

/*
The controller for managing the front-end UI layer of the website.
Each function call loads a designated area of the website.
Users cannot access any of the functions without user authentication.
The Site Controller loads:
	1. Username
	2. User's Feed List
	3. User's Label List
	4. and other data required to display in the UI layer.
*/

class Site extends CI_Controller {
	function __construct()	//Constructor
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->is_logged_in();
	}
	
	function is_logged_in(){	//Login check
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true){
			redirect('login');
		}
	}
	
	function apply(){	//Ego DeCal Application
		$this->load->view('site/apply');
	}
	
	function article($id){
		$this->load->model('loader_model');
		$data['main_content'] = 'article';
		$data['username'] = $this->session->userdata('username');
		$data['first_name'] = $this->loader_model->get_firstname($data['username']);
		$data['whole_name'] = $this->loader_model->get_wholename($data['username']);
		$data['feed_list'] = $this->loader_model->get_feeds($data['username']);
		$data['feed_type'] = 'null';
		$data['label_list'] = $this->loader_model->get_labels($data['username']);
		$data['profile_ext'] = $this->loader_model->get_profileExt($data['username']);
		$data['article'] = $this->loader_model->load_article_by_id($id);
		$this->load->view('site/template', $data);
	}
	
	
	function feed($id=7){	//Ego Feed (Single Feed)
		$this->load->model('loader_model');
		$data['main_content'] = 'feed'; 
		$data['username'] = $this->session->userdata('username');
		$data['first_name'] = $this->loader_model->get_firstname($data['username']);
		$data['whole_name'] = $this->loader_model->get_wholename($data['username']);
		$data['feed_list'] = $this->loader_model->get_feeds($data['username']);
		$data['label_list'] = $this->loader_model->get_labels($data['username']);
		$data['profile_ext'] = $this->loader_model->get_profileExt($data['username']);
		$data['feed_id'] = $id;
		$feed = $this->loader_model->select_feed($id);
		$data['feed_type'] = $feed->type;
		$data['feed_title'] = $feed->title;
		$this->load->view('site/template', $data);
	}
	
	function label($id='all_feeds'){	//Ego Feed - Label (Multifeeds)
		$this->load->model('loader_model');
		$data['main_content'] = 'feed';
		$data['username'] = $this->session->userdata('username');
		$data['first_name'] = $this->loader_model->get_firstname($data['username']);
		$data['whole_name'] = $this->loader_model->get_wholename($data['username']);
		$data['feed_list'] = $this->loader_model->get_feeds($data['username']);
		$data['label_list'] = $this->loader_model->get_labels($data['username']);
		$data['profile_ext'] = $this->loader_model->get_profileExt($data['username']);
		$data['feed_type'] = 'label';
		if ($id == 'all_feeds'){
			$data['label_title'] = 'All Feeds';
			$data['label_id'] = 'all_feeds';
		}else{
			$label = $this->loader_model->select_label($data['username'], $id);
			$data['label_title'] = $label->label;
			$data['label_id'] = $label->id;
		}
		$this->load->view('site/template', $data);
	}
	
	function fpage(){	//Ego Front Page
		$this->load->model('loader_model');
		$data['main_content'] = 'fpage'; 
		$data['username'] = $this->session->userdata('username');
		$data['first_name'] = $this->loader_model->get_firstname($data['username']);
		$data['whole_name'] = $this->loader_model->get_wholename($data['username']);
		$data['feed_list'] = $this->loader_model->get_feeds($data['username']);
		$data['feed_type'] = 'null';
		$data['label_list'] = $this->loader_model->get_labels($data['username']);
		$data['profile_ext'] = $this->loader_model->get_profileExt($data['username']);
		$this->load->view('site/template', $data);
	}
	
	function clips($clip_user='self'){	//Ego Clips
		$this->load->model('loader_model');
		$data['main_content'] = 'clips'; 
		$data['username'] = $this->session->userdata('username');
		$data['first_name'] = $this->loader_model->get_firstname($data['username']);
		$data['whole_name'] = $this->loader_model->get_wholename($data['username']);
		$data['feed_list'] = $this->loader_model->get_feeds($data['username']);
		$data['feed_type'] = 'null';
		$data['label_list'] = $this->loader_model->get_labels($data['username']);
		$data['profile_ext'] = $this->loader_model->get_profileExt($data['username']);
		if ($clip_user == 'self'){
			$data['clip_user'] = $data['username'];
			$data['clip_user_name'] = $this->loader_model->get_firstname($data['username']);
		} else if ($clip_user == 'received'){
			$data['clip_user'] = 'received';
			$data['clip_user_name'] = $this->loader_model->get_firstname($data['username']);
		}
		else{
				$data['clip_user'] = $clip_user;
				$data['clip_user_name'] = $this->loader_model->get_firstname($data['clip_user']);
		}
		
		$this->load->view('site/template', $data);
	}
	
	function modal_profile(){
		$this->load->model('loader_model');
		$data['username'] = $this->session->userdata('username');
		$data['whole_name'] = $this->loader_model->get_wholename($data['username']);
		$data['profile_ext'] = $this->loader_model->get_profileExt($data['username']);
		$data['email_address'] = $this->loader_model->get_email($data['username']);
		$this->load->view('modal/profile_view', $data);
	}
	
	function modal_people(){
		$this->load->model('social_model');
		$data['username'] = $this->session->userdata('username');
		//$data['people_list'] = $this->social_model->get_people($data['username']);
		$this->load->view('modal/people_view', $data);
	}
	
	function modal_feed(){
		$this->load->model('loader_model');
		$data['label_list'] = $this->loader_model->get_labels($this->session->userdata('username'));
		$data['feed_list'] = $this->loader_model->get_feeds($this->session->userdata('username'));
		$this->load->view('modal/feedlist_view', $data);
	}
	
}