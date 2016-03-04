<?php
class Category_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function get_category($cid = FALSE){
		if($cid === FALSE){
            $sql = 'SELECT category_id, category_name, category_slug, count(post_id) AS post_num FROM categories c LEFT JOIN posts p on c.category_id = p.post_category GROUP BY category_id ORDER BY category_id ASC';
            $query = $this->db->query($sql);
            return $query->result_array();
		}else{
			$query = $this->db>get_where('categories',array('category_id' => $cid));
			return $query->row_array();
		}
	}
	public function add_category($cname, $cslug){
        if(empty($cname) || empty($cslug)){
            return 0;
        }

        $check_sql = 'SELECT count(*) from category WHERE category_name =　? OR category_slug = ?';
        $check_result = $this->db->query($check_sql, array($cname, $cslug));
        if($check_result){
            return 0;
        }

		$sql = 'INSERT INTO categories (category_name, category_slug) VALUES (?, ?)';
        $this->db->query($sql, array($cname, $cslug));
        return $this->db->affected_rows();
	}
}