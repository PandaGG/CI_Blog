<?php
class Posts extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('post_model');
        $this->load->helper('date');
	}
	public function index($cur_page = 1){
		$total_num = $this->post_model->get_posts_count();
		$this->load->library('pagination');
		/*分页 开始*/
		$per_page = 5;
		$config = array(
			'base_url' => site_url('posts').'/',
			'total_rows' => $total_num,
			'per_page' => $per_page,
			'$num_links' => 3,
			'cur_page' => $cur_page
		);
		$this->pagination->initialize($config);
		$pagination_link = $this->pagination->create_links();
		$data['pagination_link'] = $pagination_link;
		/*分页 结束*/
		$offset = (int)($per_page*($cur_page-1));
		$posts = $this->post_model->get_posts($offset,$per_page);
		foreach($posts as $post){
			$datetime = new DateTime($post['post_date']);
			$post['post_date'] = formatElapseTime($datetime->format('Y-m-d H:i'));
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