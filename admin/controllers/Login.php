<?php
class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin_model');
	}
	
	public function index(){
		if(!empty($_SESSION['username']) AND $_SESSION['user_type'] == 99){
			redirect('home');
		}
		$this->load->view('login');
	}
	
	public function check(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$query = $this->Admin_model->login_user($username, $password);
		if($query){
			$_SESSION['uid'] = $query['uid'];
			$_SESSION['username'] = $query['user_name'];
			$_SESSION['user_type'] = $query['user_type'];
			redirect('home');
		}else{
			redirect('login');
		}
	}
	public function login_out(){
		session_destroy();
		redirect('login');
	}
	
}