<?php
class Upload extends MY_Controller{
	public function __construct(){
		parent::__construct();
        $this->load->library('Document_upload');
        $this->load->model('Document_model');
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

        $this->document_upload->initialize($config);
        $path = $this->document_upload->doUpload();
        if($path){
            $result = array('message'=>'success', 'path'=>$path);
            $extension = $this->document_upload->getFileExtension();
            $filename = $this->document_upload->getFileName();
            $this->Document_model->insert_record($post_id, $timestamp, $filename, $extension, $path);
        }else{
            $result = array('message'=>'fail', 'error_msg'=>$this->document_upload->getErrorMsg());
        }
        echo json_encode($result);
    }
}