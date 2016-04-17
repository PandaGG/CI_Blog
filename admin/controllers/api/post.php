<?php
class Post extends MY_Controller
{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Post_model');
    }
    public function is_slug_available($slug = NULL, $post_id = -1){
        $isExist = $this->Post_model->isExistSlug($slug, $post_id);
        if($isExist){
            $result = array('message'=>'no');
        }else{
            $result = array('message'=>'yes');
        }
        echo json_encode($result);
    }

}