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
		
		/*暂存页面输出结果*/
		$main_html = $this->load->view('categories/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($main_html);
	}
	public function view($slug = NULL){
		$data['posts'] = $this->post_model->get_category_posts($slug);
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($main_html);
	}
}