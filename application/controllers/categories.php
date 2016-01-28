<?php
class Categories extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('post_model');
		$this->load->model('category_model');
	}
	public function index(){
		$categories = $this->category_model->get_categories();
		$data['categories'] = $this->category_model->get_categories();
		$title = '分类';
		/*暂存页面输出结果*/
		$main_html = $this->load->view('categories/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($title, $main_html);
	}
	public function view($slug = NULL){
		$data['posts'] = $this->post_model->get_category_posts($slug);
		$category_info = $this->category_model->get_category_by_slug($slug);
		error_log(print_r($category_info,true));
		if(empty($category_info)){
			$title = '';
		}else{
			$title = $category_info['category_name'];
		}
		
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($title, $main_html);
	}
}