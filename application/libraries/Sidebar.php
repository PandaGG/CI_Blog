<?php
class Sidebar {

    protected $CI;


    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('post_model','sb_post_model');
    }

    public function initialize()
    {
        $this->CI->load->view('sidebar/sidebar_begin');
        $this->lastest_posts();
        $this->archives_posts();
        $this->CI->load->view('sidebar/sidebar_end');
    }

    protected function lastest_posts(){
        $sb_data['sb_posts'] = $this->CI->sb_post_model->get_posts(0,5);
        $this->CI->load->view('sidebar/latest_posts',$sb_data);
    }

    protected function archives_posts(){
        $sb_archives = $this->CI->sb_post_model->get_archives();
        foreach($sb_archives as $archives){
            $time = strtotime($archives['publish_date']);
            $date_str = date('Y',$time).'年'.date('m',$time).'月';
            $archives['publish_date'] = $date_str;
            $sb_data['sb_archives'][] = $archives;
        }
        $this->CI->load->view('sidebar/archives_posts',$sb_data);
    }

}