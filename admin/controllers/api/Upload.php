<?php
class Upload extends MY_Controller{
	public function __construct(){
		parent::__construct();
        $this->load->library('Media_upload');
        $this->load->model('Media_model');
	}
	public function index(){
        $this->post_image();
	}
    public function post_image(){
        //需传入的参数 $_FILES post_id timestamp
        $post_id = $this->input->post('post_id');
        $timestamp = $this->input->post('timestamp');
        $config = array(
            'original_file' => $_FILES["file"]
        );

        $this->media_upload->initialize($config);
        $path = $this->media_upload->doUpload();
        if($path){
            $result = array('message'=>'success', 'path'=>$path);
            $extension = $this->media_upload->getFileExtension();
            $filename = $this->media_upload->getFileName();
            $thumb_path = $this->media_upload->getRelativeThumbFilePath();
            $this->Media_model->insert_record($post_id, $timestamp, $filename, $extension, $path, $thumb_path);
        }else{
            $result = array('message'=>'fail', 'error_msg'=>$this->media_upload->getErrorMsg());
        }
        echo json_encode($result);
    }
}