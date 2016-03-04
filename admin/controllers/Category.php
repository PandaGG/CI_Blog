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
		$this->load->view('categories/category_create');
	}
	public function edit($cid = NULL){
		if($cid === NULL){
			show_404();
		}else{
			$category = $this->Category_model->get_category($cid);
			if($category){
				$data['category'] = $category;
				$this->load->view('categories/category_edit',$data);
			}else{
				show_404();
			}
		}
	}
	public function insert(){
		$cname = $this->input->post('cname');
		$cslug = $this->input->post('cslug');
		$result = $this->Category_model->add_category($cname, $cslug);
		if($result){
			$this->pageTips('插入成功','category', 2);
		}else{
			$this->pageTips('插入失败','category', 2, 'fail');
		}
	}
	
	
}