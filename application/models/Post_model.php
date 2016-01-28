<?php
class Post_model extends CI_Model{
	public function __construct(){
		
	}
	public function add_hit($post_id = NULL){
		if($post_id === NULL) return;
		$query = $this->db->query("UPDATE posts SET post_hit = post_hit + 1 WHERE post_id = ?" , array($post_id));
	}
	
	public function get_posts_count(){
		$query = $this->db->query("SELECT *
				FROM posts INNER JOIN categories ON post_category = category_id
				WHERE post_status = 'publish'");
		return $query->num_rows();
	}
	
	public function get_posts($offset = NULL, $num = NULL){
		if($offset === NULL || $num === NULL){
			$query = $this->db->query("SELECT post_id, post_title, post_excerpt, post_date, post_hit, category_name, category_slug
				FROM posts INNER JOIN categories ON post_category = category_id
				WHERE post_status = 'publish'
				ORDER BY post_date DESC");
			return $query->result_array();
		}else{
			$query = $this->db->query("SELECT post_id, post_title, post_excerpt, post_date, post_hit, category_name, category_slug
				FROM posts INNER JOIN categories ON post_category = category_id
				WHERE post_status = 'publish'
				ORDER BY post_date DESC
				LIMIT ?, ?",
					array($offset, $num));
			return $query->result_array();
		}
	}
	
	public function get_post_by_id($post_id = NULL){
		if($post_id === NULL){
			return array();
		}else{
			$query = $this->db->query("SELECT * FROM posts WHERE post_status = 'publish' AND post_id = ?" , array($post_id));
			return $query->row_array();
		}
	}
	
	public function get_category_posts($category_slug = NULL){
		if($category_slug === NULL){
			return array();
		}
		$query = $this->db->query("SELECT post_id, post_title, post_excerpt, post_date, post_hit, category_name, category_slug 
				FROM posts INNER JOIN categories ON post_category = category_id 
				WHERE post_status = 'publish' 
				AND category_slug = ? 
				ORDER BY post_date DESC",
				array($category_slug));
		
		return $query->result_array();
	}
}