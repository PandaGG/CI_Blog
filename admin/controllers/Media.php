<?php
class Media extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Media_model');
    }
    public function index(){
        $this->saveUri();
        $status = $this->input->get('status') ? $this->input->get('status') : 'all';
        $paged = $this->input->get('paged') ? $this->input->get('paged') : 1;
        $data['info']['status'] = $status;
        $data['status_count'] = array(
            'all' => $this->Media_model->get_medias_count('all'),
            'related' => $this->Media_model->get_medias_count('related'),
            'unrelated' => $this->Media_model->get_medias_count('unrelated')
        );
        /*分页 开始*/
        $this->load->library('pagination');

        $query_string = $_SERVER["QUERY_STRING"];
        if($query_string){
            $query_parm = explode('&', $query_string);
            for($i=0; $i<count($query_parm); $i++){
                if(strpos($query_parm[$i], 'paged') !== FALSE){
                    unset($query_parm[$i]);
                    break;
                }
            }
            $query_string = implode('&', $query_parm);
        }

        $pagination_base_url = site_url('media');
        if($query_string){
            $pagination_base_url .= '?'.$query_string.'&paged=';
        }else{
            $pagination_base_url .= '?paged=';
        }
        $per_page = 10;
        $config = array(
            'base_url' => $pagination_base_url,
            'total_rows' => $data['status_count'][$status],
            'per_page' => $per_page,
            'num_links' => 3,
            'cur_page' => $paged
        );
        $this->pagination->initialize($config);
        $pagination_link = $this->pagination->create_links();
        $data['pagination_link'] = $pagination_link;
        /*分页 结束*/
        $offset = (int)($per_page*($paged-1));
        $data['medias'] = $this->Media_model->get_medias($status,$offset, $per_page);
        $this->load->view('media/media_list', $data);
    }

    //清除没有使用的media
    public function clear(){
        $current = time();
        $before_timestamp = $current-3600*24;
        $unrelated_medias = $this->Media_model->get_unrelated_media($before_timestamp);

        $this->load->library('Media_uti');
        if(empty($unrelated_medias)){
            $result = 0;
        }else{
            $delete_media_ids = array();
            foreach($unrelated_medias as $unrelated_media){
                $filepath = PUBLICPATH.substr($unrelated_media['media_path'],1);
                $thumbpath = PUBLICPATH.substr($unrelated_media['media_thumb'],1);

                if( $this->media_uti->delete_media_files($filepath, $thumbpath) ){
                    $delete_media_ids[] = $unrelated_media['media_id'];
                }
            }
            $result = $this->media_uti->delete_media_records($delete_media_ids);
        }
        if($result){
            $this->pageTips('清除无效的图片',$this->session->lastUri, 2);
        }else{
            $this->pageTips('未发现可清除的图片',$this->session->lastUri, 2);
        }
    }

    public function delete($media_id = NULL){
        if($media_id === NULL){
            show_404();
        }else{
            $media = $this->Media_model->get_media_record_by_id($media_id);
            if(empty($media)){
                $result = 0;
            }else{
                $this->load->library('Media_uti');
                $delete_media_ids = array();
                $filepath = PUBLICPATH.substr($media['media_path'],1);
                $thumbpath = PUBLICPATH.substr($media['media_thumb'],1);
                error_log($filepath);
                if( $this->media_uti->delete_media_files($filepath, $thumbpath) ){
                    $delete_media_ids[] = $media['media_id'];
                }
                $result = $this->media_uti->delete_media_records($delete_media_ids);
            }

            if($result){
                $this->pageTips('永久删除成功',$this->session->lastUri, 2);
            }else{
                $this->pageTips('永久删除失败',$this->session->lastUri, 2, 'fail');
            }
        }
    }

    public function group_operation(){
        $ids = $this->input->post('ids');
        //批量永久删除
        if($this->input->post('group-delete')){

            $medias = $this->Media_model->get_media_record_by_ids($ids);
            if(empty($medias)){
                $result = 0;
            }else{
                $this->load->library('Media_uti');
                $delete_media_ids = array();
                foreach($medias as $media){
                    $filepath = PUBLICPATH.substr($media['media_path'],1);
                    $thumbpath = PUBLICPATH.substr($media['media_thumb'],1);
                    error_log($filepath);

                    if( $this->media_uti->delete_media_files($filepath, $thumbpath) ){
                        $delete_media_ids[] = $media['media_id'];
                    }
                }
                $result = $this->media_uti->delete_media_records($delete_media_ids);
            }
            if($result){
                $this->pageTips('批量永久删除成功',$this->session->lastUri, 2);
            }else{
                $this->pageTips('批量永久删除失败',$this->session->lastUri, 2, 'fail');
            }
            return;
        }
    }

}