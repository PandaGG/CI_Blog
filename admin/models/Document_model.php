<?php
class Document_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
    public function insert_record($post_id, $timestamp, $filename, $extension, $path){
        if(empty($filename) || empty($extension)){
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

}