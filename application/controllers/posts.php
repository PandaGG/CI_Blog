<?php
class Posts extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('post_model');
		
	}
	public function index(){
		$data['title'] = 'All Blogs';
		$data['posts'] = $this->post_model->get_posts();
		$this->load->view('templates/header', $data);
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer', $data);
	}
	public function view($slug = NULL){
		$data['post_item'] = $this->post_model->get_post($slug);
		if(empty($data['post_item'])){
			show_404();
		}
		
		$data['title'] = $data['post_item']['title'];
		$this->load->view('templates/header', $data);
		$this->load->view('posts/view', $data);
		$this->load->view('templates/footer', $data);
	}
}