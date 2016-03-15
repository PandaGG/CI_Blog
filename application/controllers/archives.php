<?php
class Archives extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('date');
		$this->load->model('post_model');
	}
	public function index(){
		$main_html = $this->load->view('archives/index', array(), true);
		$this->show_full_main_template('', $main_html);
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
		$browse_month_time = strtotime($browse_month);
		$display_date = date('Y',$browse_month_time).'年'.date('m',$browse_month_time).'月';
		$page_title = '文章归档: '.$display_date;
		$data['page_title'] = $page_title;
		/*暂存页面输出结果*/
		$main_html = $this->load->view('posts/index', $data, true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template($display_date, $main_html);
	}
}