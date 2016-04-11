<?php
class Categories extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('date');
		$this->load->model('post_model');
		$this->load->model('category_model');
	}
	public function index(){
		$data['categories'] = $this->category_model->get_categories();
		$title = '文章类别';
		/*暂存页面输出结果*/
		$main_html = $this->load->view('categories/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($title, $main_html);
	}
	public function view($slug = NULL, $cur_page = 1){
		if($slug === NULL){
			$this->show_404();
			return FALSE;
		}
		$category_info = $this->category_model->get_category_by_slug($slug);
		if(empty($category_info)){
			$title = '';
		}else{
			$title = $category_info['category_name'];
		}
		$total_num = $this->post_model->get_category_posts_num($slug);
		$this->load->library('pagination');
		/*分页 开始*/
		$per_page = 10;
		$config = array(
			'base_url' => site_url('categories').'/'.$slug.'/',
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

		$posts = $this->post_model->get_category_posts($slug, $offset, $per_page);
        if(empty($posts)){
			$data['posts'] = array();
			$data['pagination_link'] = '';
        }else{
			foreach($posts as $post){
				$post['post_date'] = formatElapseTime($post['post_date']);
				$data['posts'][] = $post;
			}
		}

		$data['page_title'] = '文章类别: '.$title;
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($title, $main_html);
	}
}