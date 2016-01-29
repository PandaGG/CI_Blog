<?php
class Posts extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('post_model');
	}
	public function index(){
		$total_num = $this->post_model->get_posts_count();
		
		$posts = $this->post_model->get_posts(0,5);
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
	public function view($slug = NULL){
		$post_result = $this->post_model->get_post_by_slug($slug);
		if(empty($post_result)){
			show_404();
		}
		$id = $post_result['post_id'];
		$this->post_model->add_hit($id);
		$title = $post_result['post_title'];
		$data['post_item'] = $post_result;
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/view', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($title, $main_html);
	}
}