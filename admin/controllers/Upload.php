<?php
class Upload extends MY_Controller{
	public function __construct(){
		parent::__construct();
        $this->load->library('upload');
	}
	public function index(){
        $ext = substr(strrchr($_FILES["file"]["name"], '.'), 1);
        $tmp_name = $_FILES["file"]["tmp_name"];
        $config = array(
            'tmp_name' => $tmp_name,
            'file_ext' => $ext
        );
        $this->upload->initialize($config);
        $path = $this->upload->doUpload();
        if($path){
            $result = array('message'=>'success', 'path'=>$path);
        }else{
            $result = array('message'=>'fail', 'path'=>'');
        }
        echo json_encode($result);
	}
}