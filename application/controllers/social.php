<?php

/*
The controller for loading entries.
Each function call loads entries from RSS feeds or the user's clips.
*/

class Social extends CI_controller{
	
	function clips($init, $username){
		$this->load->model('social_model');
		if ($username == $this->session->userdata('username')){
			$clip_array = $this->social_model->get_myClips();
			$data['clip_list'] = array_reverse($clip_array);
		} else if ($username == 'received'){
			$data['clip_list'] = $this->social_model->get_receivedClips();
		} else{
			$clip_array = $this->social_model->get_clips($username);
			$data['clip_list'] = array_reverse($clip_array);
		}
		$data['init'] = $init;
		$this->load->view('loader/clip_viewer', $data);
	}
	
	function give_bump($type){
		$permalink = $this->input->post('permalink');
		$username = $this->session->userdata('username');
		$this->load->model('social_model');
		$result = $this->social_model->give_bump($type, $permalink, $username);
		echo $result;
	}
	
	function add_clip(){
		$permalink = $this->input->post('permalink');
		$username = $this->session->userdata('username');
		$this->load->model('social_model');
		$result = $this->social_model->add_clip($permalink, $username, 'public');
		echo $result;
	}
		
	function share_entry(){
		$permalink = $this->input->post('permalink');
		$sender = $this->session->userdata('username');
		$recipient = $this->input->post('recipient');
		$this->load->model('social_model');
		$result = $this->social_model->share_clip($sender, $recipient, $permalink, 'received');
		echo $result;	
	}
	
	function move_clip($id, $destination){
		$this->load->model('query_model');
		$this->query_model->move_clip($id, $destination);
	}
	
	function delete_clip($id){
		$this->load->model('query_model');
		$this->query_model->delete_clip($id);
		redirect('site/clips');
	}
	
	function get_people(){
		$this->load->model('social_model');
		$data['result'] =  $this->social_model->get_people();
		$this->load->view('modal/people_view_subscribed', $data);
	}
	
	function find_person(){
		$input = $this->input->post('input');
		$this->load->model('social_model');
		$data['result'] = $this->social_model->find_person($input);
		$this->load->view('modal/people_view_search', $data);
	}
		
	function subscribe_person(){
		$person = $this->input->post('person');
		$this->load->model('social_model');
		$username = $this->session->userdata('username');
		$this->social_model->subscribe_person($username, $person);
		$this->social_model->update_count_subscribers($person);
	}
	
	function unsubscribe_person(){
		$person = $this->input->post('person');
		$this->load->model('social_model');
		$username = $this->session->userdata('username');
		$this->social_model->unsubscribe_person($username, $person);
		$this->social_model->update_count_subscribers($person);
	}	
	
	function edit_profilepic(){
		$config['upload_path'] = './user/profilePic';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['file_name'] = $this->session->userdata('username');
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			echo $error['error'];
		}
		else
		{	
			$upload_data = $this->upload->data();
			$ext = $upload_data['file_ext'];
			$this->load->model('social_model');
			$this->social_model->update_profileInfo($this->session->userdata('username'), $ext);
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}
	}
}