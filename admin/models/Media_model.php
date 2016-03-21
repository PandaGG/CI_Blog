<?php
class Media_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
    public function get_medias($offset = NULL, $num = NULL){
        $sql = "SELECT media_id, media_post, IFNULL(post_title, '未关联') AS post_name , IF(media_timestamp = 0, '使用中', '未使用') AS media_status, media_name, media_extension, media_path, media_datetime, media_thumb FROM medias m LEFT JOIN posts p on m.media_post = p.post_id ORDER BY media_id DESC";
        if($offset !== NULL AND $num !== NULL){
            $sql .= " LIMIT ".$this->db->escape($offset).", ".$this->db->escape($num);
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_medias_count(){
        $sql = "SELECT media_id FROM medias m LEFT JOIN posts p on m.media_post = p.post_id";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

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

    public function get_related_medias($timestamp, $post_id){
        $sql = "SELECT media_id, media_post, media_timestamp, media_name FROM medias WHERE media_timestamp = ".$timestamp;
        if($post_id != -1){
            $sql .= " OR media_post = ".$post_id;
        }
        $query = $this->db->query($sql);
        error_log($this->db->last_query());
        return $query->result_array();
    }

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
        error_log($this->db->last_query());
        return $this->db->affected_rows();
    }

    public function get_unused_medias_by_post_id($post_id){
        $sql = "SELECT media_id, media_post, media_timestamp, media_path, media_thumb FROM medias WHERE media_post = ".$post_id." AND media_timestamp != 0";
        $query = $this->db->query($sql);
        error_log($this->db->last_query());
        return $query->result_array();
    }

    public function get_unrelated_media($timestamp = NULL){
        $sql = "SELECT media_id, media_post, media_timestamp, media_path, media_thumb FROM medias WHERE media_post = -1 AND media_timestamp <=". $timestamp;
        $query = $this->db->query($sql);
        error_log($this->db->last_query());
        return $query->result_array();
    }

    public function delete_medias($media_ids = array()){
        if(count($media_ids) == 0){
            return 0;
        }
        $this->db->where_in('media_id',$media_ids);
        $this->db->delete('medias');
        error_log($this->db->last_query());
        return $this->db->affected_rows();
    }


}