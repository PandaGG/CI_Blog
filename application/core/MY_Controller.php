<?php
Class MY_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		session_start();
	}

	/**
	 * 显示默认布局页面 Header - ( Main | Sidebar ) - Footer
	 * 
	 * @param string $main_html HTML内容字串
	 * 
	 */
	protected function show_default_template($title = '', $main_html = '')
	{
		$this->load->library('sidebar');

		if( ! isset($_SESSION['site_info'])){
			$this->set_session_site_info();
		}

		$site_name = $_SESSION['site_info']['site_name'];
		if($title == ''){
			$page_title = $site_name;
		}else{
			$page_title = $title.' | '.$site_name;
		}
		$this->load->view('templates/header',array('page_title'=>$page_title));
		/*把页面输出的HTML内容放入模版中*/
		$this->load->view('templates/main',array('main_page'=>$main_html));
		$this->sidebar->initialize();
		$this->load->view('templates/footer');
	}

	protected function set_session_site_info(){
		$this->load->model('Site_model');
		$site_info = $this->Site_model->get_site_info();
		if($site_info){
			$_SESSION['site_info'] = $this->Site_model->get_site_info();
		}else{
			$_SESSION['site_info'] = array(
				'site_name' => '',
				'site_description' => '',
				'site_keywords' => '',
				'copyright' => ''
			);
		}

	}
}