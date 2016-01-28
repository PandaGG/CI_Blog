<?php
Class Category_model extends CI_Model{
	public function __construct(){
		
	}
	public function get_categories(){
		$queries = $this->db->query("SELECT category_name, category_slug, count(category_slug) AS count
					FROM posts INNER JOIN categories ON post_category = category_id 
					WHERE post_status = 'publish' 
					GROUP BY category_slug
					ORDER BY category_id ASC");
		return $queries->result_array();
	}
	public function get_category_by_slug($slug = NULL){
		if($slug === NULL){
			return array();
		}else{
			$queries = $this->db->query("SELECT category_id, category_name, category_slug FROM categories WHERE category_slug = ? ", array($slug));
			return $queries->result_array();
		}
		
	}
}