<?php
class MY_upload {
    /*
     * 必须传入的参数
     * */
    protected $original_file = array();
    /*
     * 可选参数
     * */
    public $upload_path = '';
    /*
     * 非必须传入的参数
     * */
    protected $CI;
    protected $base_upload_path = '';
    protected $upload_size = 0;
    protected $timestamp = 0;
    protected $max_size = 1048576; //1024*1024
    protected $filename_prefix = 'post_';
    protected $filename = '';
    protected $tmp_name = '';
    protected $file_ext = '';
    protected $error_msg = '';

    public function __construct($config = array())
    {
        $this->CI =& get_instance();
        $this->base_upload_path = $this->CI->config->item('upload_path');
        $this->max_size = $this->CI->config->item('max_size');
        $this->timestamp = time();
        empty($config) OR $this->initialize($config);
    }

    public function initialize($config = array())
    {
        foreach ($config as $key => $val)
        {
            if (isset($this->$key))
            {
                $this->$key = $val;
            }
        }
        return $this;
    }

    protected function setUploadPath(){
        if($this->upload_path != ''){
            $upload_path = rtrim($this->upload_path, '/').'/';
        }else{
            $upload_path = $this->base_upload_path;
            if (!is_dir($upload_path)){
                mkdir($upload_path, 0777);
            }
            $year = date('Y', $this->timestamp);
            $month = date('m', $this->timestamp);
            $upload_path .= $year.'/';
            if (!is_dir($upload_path)){
                mkdir($upload_path, 0777);
            }
            $upload_path .= $month.'/';
            if (!is_dir($upload_path)){
                mkdir($upload_path, 0777);
            }
            $this->upload_path = $upload_path;
        }
    }

    protected  function setFileExtension(){
        $file = $this->original_file;
        switch($file["type"]){
            case 'image/gif':
                $ext = 'gif';
                break;
            case 'image/png':
                $ext = 'png';
                break;
            case 'image/jpeg':
            case 'image/pjpeg':
            default:
                $ext = 'jpg';
                break;

        }
        $this->file_ext = $ext;
    }

    protected function setFileName(){
        $temp_name = date('YmdHis', $this->timestamp);
        $this->filename = $this->filename_prefix.$temp_name.'.'.$this->file_ext;
    }

    protected function moveUploadFile(){
        $upload_path = $this->getUploadFilePath();
        if (file_exists($upload_path)){
            $this->error_msg = $upload_path. " 文件已经存在";
            return FALSE;
        }else{
            $result = move_uploaded_file($this->tmp_name, $upload_path);
            if($result){
                return TRUE;
            }else{
                $this->error_msg = '上传文件失败';
                return FALSE;
            }
        }
    }

    protected function getUploadFilePath(){
        return $this->upload_path.$this->filename;
    }

    protected function isAbleAndPrepare(){
        if($this->original_file ==  NULL){
            $this->error_msg = '并未上传文件';
            return FALSE;
        }
        $file = $this->original_file;

        if ( ! ($file["type"] == "image/gif" || $file["type"] == "image/png" || $file["type"] == "image/jpeg" || $file["type"] == "image/pjpeg") )
        {
            $this->error_msg = '只支持jpg, gif, png格式';
            return FALSE;
        }
        if ($file["size"] > $this->max_size)
        {
            $this->error_msg = '文件过大';
            return FALSE;
        }

        if ($file["error"] > 0)
        {
            $this->error_msg = '文件上传错误';
            return FALSE;
        }

        $this->tmp_name = $this->original_file['tmp_name'];
        return TRUE;
    }

    public function getFileName(){
        return $this->filename;
    }

    public function getErrorMsg(){
        return $this->error_msg;
    }

    public function getRelativeUploadFilePath(){
        return str_replace(PUBLICPATH,"/",$this->getUploadFilePath());
    }

    public function getFileExtension(){
        return $this->file_ext;
    }

    public function doUpload(){
        if($this->isAbleAndPrepare() === FALSE){
            return FALSE;
        }
        $this->setFileExtension();
        $this->setUploadPath();
        $this->setFileName();
        $result = $this->moveUploadFile();
        if($result){
            $this->error_msg = '';
            return $this->getRelativeUploadFilePath();
        }
        return FALSE;
    }






}