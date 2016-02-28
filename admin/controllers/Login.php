<?php
class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin_model');
	}
	
	public function index(){
		$this->load->view('login');	
	}
	
	public function check(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$query = $this->Admin_model->login_user($username, $password);
		
		if(query){
			redirect('home');
		}else{
			redirect('login');
		}
	}
	
	
}