<?php
class Media extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Media_model');
    }
    public function index(){
        $paged = $this->input->get('paged') ? $this->input->get('paged') : 1;
        /*分页 开始*/
        $this->load->library('pagination');
        $pagination_base_url = site_url('media').'?paged=';

        $per_page = 10;
        $config = array(
            'base_url' => $pagination_base_url,
            'total_rows' => $this->Media_model->get_medias_count(),
            'per_page' => $per_page,
            'num_links' => 3,
            'cur_page' => $paged
        );
        $this->pagination->initialize($config);
        $pagination_link = $this->pagination->create_links();
        $data['pagination_link'] = $pagination_link;
        /*分页 结束*/
        $offset = (int)($per_page*($paged-1));
        $data['medias'] = $this->Media_model->get_medias($offset, $per_page);
        $this->load->view('media/media_list', $data);
    }

    //清除没有使用的media
    public function clear(){
        $current = time();
        $before_timestamp = $current-3600*24;
        error_log(date('Y-m-d H:i:s', $before_timestamp));
        $unrelated_medias = $this->Media_model->get_unrelated_media($before_timestamp);
        error_log(print_r($unrelated_medias,true));

        $this->load->library('Media_uti');
        if(empty($unrelated_medias)){
            $result = 0;
        }else{
            $delete_media_ids = array();
            foreach($unrelated_medias as $unrelated_media){
                $filepath = PUBLICPATH.substr($unrelated_media['media_path'],1);
                $thumbpath = PUBLICPATH.substr($unrelated_media['media_thumb'],1);
                error_log($filepath);

                if( $this->media_uti->delete_media_files($filepath, $thumbpath) ){
                    $delete_media_ids[] = $unrelated_media['media_id'];
                }
            }
            $result = $this->media_uti->delete_media_records($delete_media_ids);
        }
        if($result){
            $this->pageTips('清除冗余图片完成','media', 2);
        }else{
            $this->pageTips('未发现可清除的图片','media', 2);
        }
    }

}