<?php
class Archives extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('date');
		$this->load->model('post_model');
	}
	public function index(){
		show_404();
	}
	public function view($browse_month = NULL, $cur_page = 1){
		$total_num = $this->post_model->get_specify_month_posts_num($browse_month);
		$this->load->library('pagination');
		/*分页 开始*/
		$per_page = 10;
		$config = array(
			'base_url' => site_url('archives/view').'/'.$browse_month.'/',
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
		$posts = $this->post_model->get_specify_month_posts($browse_month,$offset, $per_page);
		if(empty($posts)){
			show_404();
		}
		foreach($posts as $post){
			$post['post_date'] = formatElapseTime($post['post_date']);
			$data['posts'][] = $post;
		}
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($browse_month, $main_html);
	}
}