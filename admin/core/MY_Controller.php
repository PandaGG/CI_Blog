<?php
class MY_Controller extends CI_Controller {
	  public function __construct()
    {
        parent::__construct();
	 	if(!$this->checkSession()){
	 		echo '还未登录!<br/>';
	 		echo '请返回<a href="'.site_url('login').'">登录</a>页面';
			exit();
		};
    }
	
	protected function checkSession(){
		if($this->session->uid)
		{
			//已登入
			return true;
		}
		else
		{
			//未登入
			return false;
		}
	}
}
