<?php
Class MY_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * 导入Widget侧边栏
	 * 
	 * @param string $name Widget名称，需与widgets目录下文件同名
	 * 
	 */
	protected function widget($name = '')
	{
		if (isset($name) && $name != '')
		{
			require_once APPPATH.'widgets/'.$name.'.php';
		}
	}
	/**
	 * 显示默认布局页面 Header - ( Main | Sidebar ) - Footer
	 * 
	 * @param string $main_html HTML内容字串
	 * 
	 */
	protected function show_default_template($title = '', $main_html = '')
	{
		$site_name = 'PandaGG的博客';
		if($title == ''){
			$page_title = $site_name;
		}else{
			$page_title = $title.' | '.$site_name;
		}
		$this->widget('widget');
		
		$this->load->view('templates/header',array('page_title'=>$page_title));
		/*把页面输出的HTML内容放入模版中*/
		$this->load->view('templates/main',array('main_page'=>$main_html));
		Widget::sidebar();
		$this->load->view('templates/footer');
	}
}