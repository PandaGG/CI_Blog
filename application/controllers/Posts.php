<?php
class Posts extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('date');
		$this->load->model('post_model');
	}
	public function index($cur_page = 1){
		$total_num = $this->post_model->get_posts_count();
		$this->load->library('pagination');
		/*分页 开始*/
		$per_page = 10;
		$config = array(
			'base_url' => site_url('posts').'/',
			'total_rows' => $total_num,
			'per_page' => $per_page,
			'num_links' => 3,
			'cur_page' => $cur_page
		);
		$this->pagination->initialize($config);
		$pagination_link = $this->pagination->create_links();
		$data['pagination_link'] = $pagination_link;
		/*分页 结束*/
		$offset = (int)($per_page*($cur_page-1));
		$posts = $this->post_model->get_posts($offset, $per_page);
		if(empty($posts)){
			$data['posts'] = array();
			$data['pagination_link'] = '';
		}else{
			foreach($posts as $post){
				$post['post_date'] = formatElapseTime($post['post_date']);
				$data['posts'][] = $post;
			}
		}

		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template('', $main_html);
	}
	public function view($slug = NULL){
		$post_result = $this->post_model->get_post_by_slug($slug);
		if(empty($post_result)){
			$this->show_404();
			return FALSE;
		}
		$id = $post_result['post_id'];

		$this->load->model('redis/post_redis_model');
		$mark_result = $this->post_redis_model->markUserViewPost($id);
		if($mark_result){
			$this->post_model->add_hit($id);
		}
		$title = $post_result['post_title'];
		$post_date = $post_result['post_date'];
		$post_modified = $post_result['post_modified'];

		$this->manage_recent_view($id, $slug, $title);

		$data['post_prev'] = $this->post_model->get_prev_post($post_date);
		$data['post_next'] = $this->post_model->get_next_post($post_date);
		$data['post'] = $post_result;
		$data['recent_view_posts'] = $this->recent_view();
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/view', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($title, $main_html);
	}

	protected function recent_view(){
		$this->load->model('redis/post_redis_model');
		$rv_posts = array();
		$post_ids = $this->post_redis_model->getRecentPosts(0, 4);
		if($post_ids){
			foreach($post_ids as $post_id){
				$post = $this->post_redis_model->getCachePostInfo($post_id);
				if($post){
					$rv_posts[] = $post;
				}
			}
		}
		if($rv_posts){
			return $this->load->view('posts/recent_view', array('rv_posts'=>$rv_posts), true);
		}else{
			return '';
		}

	}

	protected function manage_recent_view($id = NULL, $slug = NULL, $title = NULL){
		if($id === NULL || $slug === NULL || $title === NULL){
			return FALSE;
		}
		$this->load->model('redis/post_redis_model');
		if($this->post_redis_model->checkPost($id) || $this->post_redis_model->cachePost($id, $slug, $title) ){
			$this->post_redis_model->markRecentPost($id);
			$this->post_redis_model->markRecentPost($id);
			$this->post_redis_model->trimRecentPosts(10, 15);
		}
	}
}