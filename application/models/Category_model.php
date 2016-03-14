<?php
Class Category_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function get_categories(){
		$queries = $this->db->query("SELECT category_id, category_name, category_slug, count(p2.post_id) AS post_num
			FROM categories c LEFT JOIN
				(SELECT p1.post_id, p1.post_category, p1.post_status FROM posts p1 WHERE p1.post_status = 'publish') p2
			ON c.category_id = p2.post_category
			GROUP BY c.category_id ORDER BY c.category_id ASC");
		return $queries->result_array();
	}
	public function get_category_by_slug($slug = NULL){
		if($slug === NULL){
			return array();
		}else{
			$queries = $this->db->query("SELECT category_id, category_name, category_slug FROM categories WHERE category_slug = ? ", array($slug));
			return $queries->row_array();
		}
		
	}
}