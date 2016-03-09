<?php
class MY_upload {
    /*
     * 必须传入的参数
     * */
    protected $tmp_name = '';
    protected $file_ext = '';
    /*
     * 非必须传入的参数
     * */
    protected $CI;
    protected $base_upload_path = '';
    protected $upload_size = 0;
    protected $timestamp = 0;
    protected $filename_prefix = 'post_';
    protected $filename = '';
    public $upload_path = '';

    public function __construct($config = array())
    {
        $this->CI =& get_instance();
        $this->base_upload_path = $this->CI->config->item('upload_path');
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

    protected function setFileName(){
        $temp_name = date('YmdHis', $this->timestamp);
        $this->filename = $this->filename_prefix.$temp_name.'.'.$this->file_ext;
    }

    protected function moveUploadFile(){
        $upload_path = $this->getUploadFilePath();
        if (file_exists($upload_path)){
            error_log($upload_path. " already exists.");
            return FALSE;
        }else{
            $result = move_uploaded_file($this->tmp_name, $upload_path);
            if($result){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }

    protected function getUploadFilePath(){
        return $this->upload_path.$this->filename;
    }

    protected function isParamFine(){
        if($this->tmp_name != '' AND $this->file_ext != ''){
            return TRUE;
        }
        return FALSE;
    }

    public function getRelativeUploadFilePath(){
        return str_replace(PUBLICPATH,"/",$this->getUploadFilePath());
    }

    public function doUpload(){
        if($this->isParamFine() === FALSE){
            return FALSE;
        }
        $this->setUploadPath();
        $this->setFileName();
        $result = $this->moveUploadFile();
        if($result){
            return $this->getRelativeUploadFilePath();
        }
        return FALSE;
    }







}