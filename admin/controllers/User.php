<?php
class User extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin_model');
	}
	public function index(){
        $username = $this->session->username;
        $data = $this->Admin_model->get_user_info($username);
		$this->load->view('users/user', $data);
	}
	public function update(){
        $username = $this->session->username;
		$email = $this->input->post('email');
		$result = $this->Admin_model->update_user_info($username, $email);
		if($result){
			$this->pageTips('更新用户信息成功','user', 2);
		}else{
			$this->pageTips('更新用户信息失败','user', 2, 'fail');
		}
	}
}