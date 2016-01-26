<?php
class Posts extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('post_model');
		
	}
	public function index(){
		$data['title'] = 'All Blogs';
		$data['posts'] = $this->post_model->get_posts();
		$this->load->view('templates/header');
		$this->load->view('posts/index', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer');
	}
	public function view($id = NULL){
		$post_result = $this->post_model->get_posts($id);
		if(empty($post_result)){
			show_404();
		}
		$data['post_item'] = $post_result;
		$this->load->view('templates/header');
		$this->load->view('posts/view', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer');
	}
}