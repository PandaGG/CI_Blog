<?php
class Document_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
    public function insert_record($post_id, $timestamp, $filename, $extension, $path){
        if(empty($filename)){
            return 0;
        }

        $current_time = date('Y-m-d H:i:s');
        $data = array(
            'document_post' => $post_id,
            'document_timestamp' => $timestamp,
            'document_name' => $filename,
            'document_extension' => $extension,
            'document_path' => $path,
            'document_datetime' => $current_time
        );

        $sql = $this->db->insert_string('documents', $data);
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function get_related_documents($timestamp, $post_id){
        $sql = "SELECT document_id, document_post, document_timestamp, document_name FROM documents WHERE document_timestamp = ".$timestamp;
        if($post_id != -1){
            $sql .= " OR document_post = ".$post_id;
        }
        $query = $this->db->query($sql);
        error_log($this->db->last_query());
        return $query->result_array();
    }

    public function update_related_documents($document_ids, $post_id_arr, $timestamp_arr){
        $sql = "UPDATE documents SET document_post = CASE document_id ";
        foreach ($post_id_arr as $document_id => $post_id) {
            $sql .= sprintf("WHEN %d THEN %d ", $document_id, $post_id);
        }
        $sql .= "END, document_timestamp = CASE document_id ";
        foreach ($timestamp_arr as $document_id => $timestamp) {
            $sql .= sprintf("WHEN %d THEN %d ", $document_id, $timestamp);
        }
        $sql .= "END WHERE document_id IN ($document_ids)";

        $this->db->query($sql);
        error_log($this->db->last_query());
        return $this->db->affected_rows();
    }

    public function get_unused_documents_by_post_id($post_id){
        $sql = "SELECT document_id, document_post, document_timestamp, document_path FROM documents WHERE document_post = ".$post_id." AND document_timestamp != 0";
        $query = $this->db->query($sql);
        error_log($this->db->last_query());
        return $query->result_array();
    }

    public function delete_unused_documents($document_ids = array()){
        if(count($document_ids) == 0){
            return 0;
        }
        $this->db->where_in('document_id',$document_ids);
        $this->db->delete('documents');
        error_log($this->db->last_query());
        return $this->db->affected_rows();
    }


}