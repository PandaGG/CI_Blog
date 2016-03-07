<?php
class Post_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function get_posts(){
        $sql = 'SELECT post_id, post_title, post_slug, post_content, post_excerpt, post_status, post_date, post_modified, post_hit FROM posts ORDER BY post_modified DESC';
        $query = $this->db->query($sql);
        return $query->result_array();
	}

    public function get_post_info($pid = NULL){
        if($pid === NULL){
            return NULL;
        }
        $query = $this->db->get_where('posts',array('post_id' => $pid));
        return $query->row_array();
    }
}