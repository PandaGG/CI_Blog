<?php
class Upload extends MY_Controller{
	public function __construct(){
		parent::__construct();
        $this->load->library('upload');
	}
	public function index(){
        $config = array(
            'original_file' => $_FILES["file"]
        );

        $this->upload->initialize($config);
        $path = $this->upload->doUpload();
        if($path){
            $result = array('message'=>'success', 'path'=>$path);
        }else{
            $result = array('message'=>'fail', 'error_msg'=>$this->upload->getErrorMsg());
        }
        echo json_encode($result);
	}
}