<?php
class Post_model extends CI_Model{
	public function __construct(){
		
	}
	public function get_posts($slug = NULL){
		if($slug === NULL){
			$query = $this->db->query('SELECT * FROM posts');
			return $query->result_array();
		}else{
			$query = $this->db->query('SELECT * FROM posts WHERE slug = ?', array($slug));
			return $query->row_array();
		}
	}
}