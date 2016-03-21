<?php
class Media_uti {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('Media_model');

    }

    public function match_image($timestamp, $pid){
        $this->CI->load->model('Post_model');
        $post_info = $this->CI->Post_model->get_post_info($pid);
        $post_content = $post_info['post_content'];
        preg_match_all('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(\/.*?)\\1[^>]*?\/?\s*>/i',$post_content,$match);
        error_log(print_r($match[2],true));

        $media_names = array();
        for($i=0; $i<count($match[2]); $i++){
            $name = substr(strrchr($match[2][$i], '/'), 1);
            if( ! in_array($name, $media_names)){
                $media_names[] = substr(strrchr($match[2][$i], '/'), 1);
            }
        }
        error_log(print_r($media_names,true));

        $related_medias = $this->CI->Media_model->get_related_medias($timestamp, $pid);
        error_log(print_r($related_medias,true));
        if(empty($related_medias)){
            return;
        }

        $update_post_id_arr = array();
        $update_timestamp_arr = array();

        foreach($related_medias as $related_media){
            if( in_array($related_media['media_name'], $media_names)){
                $related_media['media_post'] = $pid;
                $related_media['media_timestamp'] = 0;
            }else{
                $related_media['media_post'] = $pid;
                $related_media['media_timestamp'] = $timestamp;
            }
            $update_post_id_arr[$related_media['media_id']] = $related_media['media_post'];
            $update_timestamp_arr[$related_media['media_id']] = $related_media['media_timestamp'];
        }

        $update_media_ids = implode(',', array_keys($update_post_id_arr));;
        $update_result = $this->CI->Media_model->update_related_medias($update_media_ids, $update_post_id_arr, $update_timestamp_arr);
        $this->delete_unused_by_post_id($pid);
    }

    function delete_unused_by_post_id($pid){
        $unused_medias = $this->CI->Media_model->get_unused_medias_by_post_id($pid);
        if(empty($unused_medias)){
            return;
        }
        $delete_media_ids = array();
        foreach($unused_medias as $unused_media){
            $filepath = PUBLICPATH.substr($unused_media['media_path'],1);
            error_log($filepath);
            if( file_exists($filepath) ){
                $result = unlink($filepath);
                if($result == TRUE){
                    $delete_media_ids[] = $unused_media['media_id'];
                    error_log('删除'.$filepath.'成功');
                }else{
                    error_log('删除'.$filepath.'失败');
                }
            }else{
                $delete_media_ids[] = $unused_media['media_id'];
            }
        }
        $delete_result = $this->CI->Media_model->delete_unused_medias($delete_media_ids);
        if($delete_result){
            error_log('数据库删除共'.$delete_result);
        }else{
            error_log('数据库无删除');
        }
    }

}