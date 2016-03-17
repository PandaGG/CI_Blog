<?php
class About extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		/*暂存页面输出结果*/
		$main_html = $this->load->view('about', array(), true);
		/*把页面输出的HTML内容放入模版中*/
		$this->show_default_template('关于', $main_html);
	}
}