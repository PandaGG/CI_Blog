<?php
class Post extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->load->model('Post_model');
	}
	
	public function index(){
        $data['posts'] = $this->Post_model->get_post();
		$this->load->view('posts/post_list',$data);
	}


}
