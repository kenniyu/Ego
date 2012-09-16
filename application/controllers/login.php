<?php
class Login extends CI_Controller {

	function index(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(isset($is_logged_in) && $is_logged_in == 1){
			redirect('site/label');
		}
		else{
			$this->load->view('site/landing');
			//$this->load->view('login_form');
		}
	}
	function validate_credentials(){
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		if($query){
			$data = array(
				'username' => $this->input->post('username'), 
				'is_logged_in' => 1
			);
			$this->session->set_userdata($data);
			redirect('site/label');
		}
		else{
			$this->index();
		}
	}
	function logout()  
	{  
   		$this->session->sess_destroy();  
   		$this->index();  
	} 
	function signup(){
		$this->load->view('signup_form');
	}
	function ccn_check($ccn){
		if ($ccn == '26474')
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('ccn_check', 'You have entered a wrong CCN."');
			return FALSE;
		}
	}
	function create_member(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('ccn', 'CCN', 'callback_ccn_check');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password ', 'trim|required|matches[password]');
		
		if($this->form_validation->run() == FALSE){
			   $this->signup();
		}
		else{
			$this->load->model('membership_model');
			if($query = $this->membership_model->create_member()){
				$data = array(
				'username' => $this->input->post('username'), 
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('site/label');
			}
			else{
				$this->signup();
			}
		}
		
	}
}