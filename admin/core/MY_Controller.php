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

    protected function pageTips($tips='',$url='/',$refreshTime='1',$type='default'){
        switch ($type){
            case 'fail':
                $type = 'danger';
                break;
            case 'success':
            default:
                $type = 'default';
        }

        $data = array(
            'tips' => $tips,
            'url' => $url,
            'refreshTime' => $refreshTime,
            'type' => $type //default, danger
        );
        $this->load->view('pagetips',$data);
    }

    /*保存当前页面的uri包括query string到session*/
    protected function saveUri(){
        $query_string = $_SERVER["QUERY_STRING"];
        $current_uri = uri_string();
        if($query_string){
            $current_uri .= '?'.$query_string;
        }
        $_SESSION['lastUri'] = $current_uri;
    }


}
