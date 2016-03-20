<?php
class Document_uti {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('Document_model');

    }

    public function match_image($timestamp, $pid){
        $this->CI->load->model('Post_model');
        $post_info = $this->CI->Post_model->get_post_info($pid);
        $post_content = $post_info['post_content'];
        preg_match_all('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(\/.*?)\\1[^>]*?\/?\s*>/i',$post_content,$match);
        error_log(print_r($match[2],true));

        if(count($match[2])<1){
            return;
        }
        $document_names = array();
        for($i=0; $i<count($match[2]); $i++){
            $name = substr(strrchr($match[2][$i], '/'), 1);
            if( ! in_array($name, $document_names)){
                $document_names[] = substr(strrchr($match[2][$i], '/'), 1);
            }
        }
        error_log(print_r($document_names,true));

        $related_documents = $this->CI->Document_model->get_related_documents($timestamp, $pid);
        error_log(print_r($related_documents,true));
        if(empty($related_documents)){
            return;
        }

        $update_post_id_arr = array();
        $update_timestamp_arr = array();

        foreach($related_documents as $related_document){
            if( in_array($related_document['document_name'], $document_names)){
                $related_document['document_post'] = $pid;
                $related_document['document_timestamp'] = 0;
            }else{
                $related_document['document_post'] = $pid;
                $related_document['document_timestamp'] = $timestamp;
            }
            $update_post_id_arr[$related_document['document_id']] = $related_document['document_post'];
            $update_timestamp_arr[$related_document['document_id']] = $related_document['document_timestamp'];
        }

        $update_document_ids = implode(',', array_keys($update_post_id_arr));;
        $update_result = $this->CI->Document_model->update_related_documents($update_document_ids, $update_post_id_arr, $update_timestamp_arr);
        $this->delete_unused_by_post_id($pid);
    }

    function delete_unused_by_post_id($pid){
        $unused_documents = $this->CI->Document_model->get_unused_documents_by_post_id($pid);
        if(empty($unused_documents)){
            return;
        }
        $delete_document_ids = array();
        foreach($unused_documents as $unused_document){
            $filepath = PUBLICPATH.substr($unused_document['document_path'],1);
            error_log($filepath);
            if( file_exists($filepath) ){
                $result = unlink($filepath);
                if($result == TRUE){
                    $delete_document_ids[] = $unused_document['document_id'];
                    error_log('删除'.$filepath.'成功');
                }else{
                    error_log('删除'.$filepath.'失败');
                }
            }else{
                $delete_document_ids[] = $unused_document['document_id'];
            }
        }
        $delete_result = $this->CI->Document_model->delete_unused_documents($delete_document_ids);
        if($delete_result){
            error_log('数据库删除共'.$delete_result);
        }else{
            error_log('数据库无删除');
        }
    }

}