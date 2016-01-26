<?php
class Categories extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('post_model');
		$this->load->model('category_model');
	}
	public function index(){
		$categories = $this->category_model->get_categories();
		$data['categories'] = $this->category_model->get_categories();
		$this->load->view("templates/header");
		$this->load->view('categories/index', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer');
	}
	public function view($slug = NULL){
		$data['posts'] = $this->post_model->get_category_posts($slug);
		$this->load->view('templates/header');
		$this->load->view('posts/index', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/footer');
	}
}