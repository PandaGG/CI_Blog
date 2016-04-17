<?php
class Media_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}

    /**
     * 取出所有的图片记录
     * @param null $offset
     * @param null $num
     * @return mixed
     */
    public function get_medias($status = 'all', $offset = NULL, $num = NULL){
        $sql = "SELECT media_id, media_post, post_id, IFNULL(post_title, '未关联') AS post_name , media_name, media_extension, media_path, media_datetime, media_thumb FROM media_detail ";
        if($status == 'unrelated'){
            $sql .= " WHERE ISNULL(post_id)";
        }else if($status == 'related'){
            $sql .= " WHERE post_id IS NOT NULL";
        }
        $sql .= " ORDER BY media_id DESC";
        if($offset !== NULL AND $num !== NULL){
            $sql .= " LIMIT ".$this->db->escape($offset).", ".$this->db->escape($num);
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 计算所有图片记录总数
     * @return mixed
     */
    public function get_medias_count($status = 'all'){
        $sql = "SELECT media_id FROM media_detail";
        if($status == 'unrelated'){
            $sql .= " WHERE ISNULL(post_id)";
        }else if($status == 'related'){
            $sql .= " WHERE post_id IS NOT NULL";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 插入一条图片记录
     * @param $post_id
     * @param $timestamp
     * @param $filename
     * @param $extension
     * @param $path
     * @param $thumb_path
     * @return int
     */
    public function insert_record($post_id, $timestamp, $filename, $extension, $path, $thumb_path){
        if(empty($filename)){
            return 0;
        }

        $current_time = date('Y-m-d H:i:s');
        $data = array(
            'media_post' => $post_id,
            'media_timestamp' => $timestamp,
            'media_name' => $filename,
            'media_extension' => $extension,
            'media_path' => $path,
            'media_datetime' => $current_time,
            'media_thumb' => $thumb_path
        );

        $sql = $this->db->insert_string('medias', $data);
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function get_media_record_by_id($media_id = NULL){
        if($media_id === NULL){
            return 0;
        }
        $sql = 'SELECT media_id, media_post, media_timestamp, media_path, media_thumb FROM medias WHERE media_id = '.$this->db->escape($media_id);
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function get_media_record_by_ids($media_ids = array()){
        if(count($media_ids) == 0){
            return 0;
        }
        $this->db->where_in('media_id',$media_ids);
        $query = $this->db->get('medias');
        return $query->result_array();
    }

    /**
     * 根据时间戳和post id来获取上传的图片
     * @param $timestamp
     * @param $post_id
     * @return mixed
     */
    public function get_related_medias($timestamp, $post_id){
        $sql = "SELECT media_id, media_post, media_timestamp, media_name FROM medias WHERE media_timestamp = ".$timestamp;
        if($post_id != -1){
            $sql .= " OR media_post = ".$post_id;
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 批量更新图片的post id与timestamp信息 （重新关联图片与文章）
     * @param $media_ids
     * @param $post_id_arr
     * @param $timestamp_arr
     * @return mixed
     */
    public function update_related_medias($media_ids, $post_id_arr, $timestamp_arr){
        $sql = "UPDATE medias SET media_post = CASE media_id ";
        foreach ($post_id_arr as $media_id => $post_id) {
            $sql .= sprintf("WHEN %d THEN %d ", $media_id, $post_id);
        }
        $sql .= "END, media_timestamp = CASE media_id ";
        foreach ($timestamp_arr as $media_id => $timestamp) {
            $sql .= sprintf("WHEN %d THEN %d ", $media_id, $timestamp);
        }
        $sql .= "END WHERE media_id IN ($media_ids)";

        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    /**
     * 根据post id取出为使用的图片记录
     * @param $post_id
     * @return mixed
     */
    public function get_unused_medias_by_post_id($post_id){
        $sql = "SELECT media_id, media_post, media_timestamp, media_path, media_thumb FROM medias WHERE media_post = ".$post_id." AND media_timestamp != 0";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 取出一个时间之前的还未关联文章的图片
     * @param null $timestamp
     * @return mixed
     */
    public function get_unrelated_media($timestamp = NULL){
        $sql = "SELECT media_id, media_post, media_timestamp, media_path, media_thumb FROM media_detail WHERE ISNULL(post_id) AND media_timestamp <=". $timestamp;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * 根据图片的id批量删除图片
     * @param array $media_ids
     * @return int
     */
    public function delete_medias($media_ids = array()){
        if(count($media_ids) == 0){
            return 0;
        }
        $this->db->where_in('media_id',$media_ids);
        $this->db->delete('medias');
        return $this->db->affected_rows();
    }


}