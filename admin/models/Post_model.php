<?php
class Post_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function get_post($pid = NULL){
        if($pid === NULL){
            $query = $this->db->get('posts');
            return $query->result_array();
        }else{
            $query = $this->db->get_where('posts',array('post_id' => $pid));
            return $query->row_array();
        }
	}
}