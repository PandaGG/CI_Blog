<?php
class Post_model extends CI_Model{
	public function __construct(){
		
	}
	public function get_posts($id = NULL){
		if($id === NULL){
			$query = $this->db->query('SELECT * FROM posts ORDER BY post_date DESC');
			return $query->result_array();
		}else{
			$query = $this->db->query('SELECT * FROM posts WHERE post_id = ?', array($id));
			return $query->row_array();
		}
	}
}