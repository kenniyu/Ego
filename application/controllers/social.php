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
		$this->load->model('query_model');
		$result = $this->query_model->add_clip($permalink, $username, 'public');
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
	
	function get_friendsList($username){
		$this->load->model('social_model');
		$data['friendsList'] = $this->social_model->get_friendsList($username);
		$this->load->view('social/friends_list', $data);
	}
	
	function search_member(){
		$this->load->model('social_model');
		$username = $this->input->post('username');
		$data['result'] = $this->social_model->search_member($username);
		$this->load->view('social/search_list', $data);
	}
	
	function add_friend($friend_name){
		$this->load->model('social_model');
		$username = $this->session->userdata('username');
		$this->social_model->add_friend($username, $friend_name);
		redirect('site/clips');
	}
	
	function share_entry(){
		$sender = $this->session->userdata('username');
		$recipient = $this->input->post('recipient');
		$permalink = $this->input->post('permalink');
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$source = $this->input->post('source');
		$date = $this->input->post('date');
		$this->load->model('query_model');
		$result = $this->query_model->share_clip($sender, $recipient, $permalink, $title, $content, $source, $date, 'received');
		echo $result;
	}
	
	function edit_profilepic(){
		$config['upload_path'] = './user/profilePic';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['file_name'] = $this->session->userdata('username');
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			echo $error;
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