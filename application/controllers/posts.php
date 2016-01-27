<?php
class Posts extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('post_model');
	}
	public function index(){
		$data['posts'] = $this->post_model->get_posts();
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($main_html);
	}
	public function view($id = NULL){
		$post_result = $this->post_model->get_posts($id);
		if(empty($post_result)){
			show_404();
		}
		$data['post_item'] = $post_result;
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/view', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($main_html);
	}
}