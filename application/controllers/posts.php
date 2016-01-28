<?php
class Posts extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('post_model');
	}
	public function index(){
		$posts = $this->post_model->get_posts();
		foreach($posts as $post){
			$datetime = new DateTime($post['post_date']);
			$post['post_date'] = $datetime->format('Y-m-d H:i');
			$data['posts'][] = $post;
		}
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template('', $main_html);
	}
	public function view($id = NULL){
		$post_result = $this->post_model->get_posts($id);
		if(empty($post_result)){
			show_404();
		}
		$this->post_model->add_hit($id);
		$title = $post_result['post_title'];
		$data['post_item'] = $post_result;
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/view', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($title, $main_html);
	}
}