<?php
class Post_model extends CI_Model{
	public function __construct(){
		
	}
	public function get_posts($post_id = NULL){
		if($post_id === NULL){
			$query = $this->db->query("SELECT post_id, post_title, post_excerpt, post_date, category_name, category_slug 
					FROM posts INNER JOIN categories ON post_category = category_id 
					WHERE post_status = 'publish' 
					ORDER BY post_date DESC");
			return $query->result_array();
		}else{
			$query = $this->db->query("SELECT * FROM posts WHERE post_status = 'publish' AND post_id = ?" , array($post_id));
			return $query->row_array();
		}
	}
	public function get_category_posts($category_slug = NULL){
		if($category_slug === NULL){
			return array();
		}
		$query = $this->db->query("SELECT post_id, post_title, post_excerpt, post_date, category_name, category_slug 
				FROM posts INNER JOIN categories ON post_category = category_id 
				WHERE post_status = 'publish' 
				AND category_slug = ? 
				ORDER BY post_date DESC",
				array($category_slug));
		
		return $query->result_array();
	}
}