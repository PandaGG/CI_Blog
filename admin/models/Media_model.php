<?php
class Media_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
    public function insert_record($post_id, $timestamp, $filename, $extension, $path){
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
            'media_datetime' => $current_time
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
        $sql = "SELECT media_id, media_post, media_timestamp, media_path FROM medias WHERE media_post = ".$post_id." AND media_timestamp != 0";
        $query = $this->db->query($sql);
        error_log($this->db->last_query());
        return $query->result_array();
    }

    public function delete_unused_medias($media_ids = array()){
        if(count($media_ids) == 0){
            return 0;
        }
        $this->db->where_in('media_id',$media_ids);
        $this->db->delete('medias');
        error_log($this->db->last_query());
        return $this->db->affected_rows();
    }


}