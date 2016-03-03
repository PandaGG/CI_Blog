<?php
class Category_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function get_category($cid = FALSE){
		if($cid === FALSE){
			$query = $this->db->get('categories');
			return $query->result_array();
		}else{
			$query = $this->db>get_where('categories',array('category_id' => $cid));
			return $query->row_array();
		}
	}
}