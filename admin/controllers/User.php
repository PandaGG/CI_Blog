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
	public function change_password(){
        $this->load->view('users/change_password');
	}
    public function set_password(){
        $username = $this->session->username;
        $user_info = $this->Admin_model->get_user_info($username);
        $old_password = md5($this->input->post('old_password'));
        $new_password = md5($this->input->post('new_password'));
        $new_password_again = md5($this->input->post('new_password_again'));
        if($old_password === $user_info['password']){
            if($new_password === $new_password_again){
                $result = $this->Admin_model->update_user_password($username, $new_password);
                if($result){
                    $this->pageTips('更新密码成功','user', 2);
                }else{
                    $this->pageTips('更新密码失败','user', 2, 'fail');
                }
                return;
            }
        }
        $this->pageTips('更新密码失败','user', 2, 'fail');
    }

}