<?php
class Widget extends MY_Controller
{
	/**
	 * 静态ci对象
	 */
	public $ci;
	 
	/**
	 * 构造函数用于实现单例模式
	 */
	public function __construct()
	{
		parent::__construct();
		$this->ci = & get_instance();
		
	}
	/**
	 * 获取当前类名
	 */
	private static function _getClass()
	{
		return __CLASS__;
	}
	
	/**
	 * 普通控制器方法
	 */
	public static function sidebar()
	{
		/**
		 * 实例化
		 */
		$class = self::_getClass();
		$instance = new $class();//延迟绑定
		$instance->load->model('post_model');
		//$data['posts'] = $instance->post_model->get_posts();
		$instance->load->view('sidebar/sidebar_begin');
		//$instance->load->view('sidebar/latest_posts',$data);
		$instance->load->view('sidebar/sidebar_end');
	}
}