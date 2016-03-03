<?php
class Category extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Category_model');
	}
	public function index(){
		$data['categories'] = $this->Category_model->get_category();
		$this->load->view('categories/category_list', $data);
	}
	public function create(){
		$this->load->view('categories/create');	
	}
	public function edit(){
		
		$this->load->view('categories/edit',$data);
	}
	
	
}