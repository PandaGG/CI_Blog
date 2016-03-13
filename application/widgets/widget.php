<?php
class Widget extends MY_Controller
{
	/**
	 * 静态ci对象$instance
	 */
	public static $instance;
	 
	/**
	 * 构造函数用于实现单例模式
	 */
	public function __construct()
	{
		parent::__construct();
		self::$instance = & get_instance();
		self::$instance->load->model('post_model','sb_post_model');
	}
	/**
	 * 获取当前类名
	 */
	private static function _getClass()
	{
		return __CLASS__;
	}
	
	private static function _createInstance()
	{
		/**
		 * 实例化
		 */
		$class = self::_getClass();
		self::$instance = new $class();//延迟绑定
	}
	
	/**
	 * 普通控制器方法
	 */
	public static function sidebar()
	{
		self::_createInstance();
		self::$instance->load->view('sidebar/sidebar_begin');
		self::_lastest_posts();
		self::_archives_posts();
		self::$instance->load->view('sidebar/sidebar_end');
	}
	private static function _lastest_posts()
	{
		$sb_data['sb_posts'] = self::$instance->sb_post_model->get_posts(0,5);
		self::$instance->load->view('sidebar/latest_posts',$sb_data);
	}
	private static function _archives_posts()
	{
		$sb_archives = self::$instance->sb_post_model->get_archives();
		foreach($sb_archives as $archives){
			$time = strtotime($archives['publish_date']);
			$date_str = date('Y',$time).'年'.date('m',$time).'月';
			$archives['publish_date'] = $date_str;
			$sb_data['sb_archives'][] = $archives;
		}
		self::$instance->load->view('sidebar/archives_posts',$sb_data);
	}
}