<?php
class Post_model extends CI_Model{
	public function __construct(){
		
	}
	public function add_hit($post_id = NULL){
		if($post_id === NULL) return;
		$query = $this->db->query("UPDATE posts SET post_hit = post_hit + 1 WHERE post_id = ?" , array($post_id));
	}
	
	public function get_posts_count(){
		$query = $this->db->query("SELECT post_id
				FROM post_detail
				WHERE post_status = 'publish'");
		return $query->num_rows();
	}
	
	public function get_posts($offset = NULL, $num = NULL){
		if($offset === NULL || $num === NULL){
			$query = $this->db->query("SELECT post_id, post_slug, post_title, post_excerpt, post_date, post_hit, category_name, category_slug
				FROM post_detail
				WHERE post_status = 'publish'
				ORDER BY post_date DESC");
		}else{
			$query = $this->db->query("SELECT post_id, post_slug, post_title, post_excerpt, post_date, post_hit, category_name, category_slug
				FROM post_detail
				WHERE post_status = 'publish'
				ORDER BY post_date DESC
				LIMIT ?, ?",
				array($offset, $num));
		}
		return $query->result_array();
	}
	
	public function get_post_by_id($post_id = NULL){
		if($post_id === NULL){
			return array();
		}else{
			$sql = "SELECT post_id, post_slug, post_title, post_excerpt, post_content, post_date, post_hit, category_name, category_slug
				FROM post_detail
				WHERE post_status = 'publish' AND post_id = ".$this->db->escape($post_id);
			$query = $this->db->query($sql);
			return $query->row_array();
		}
	}
	
	public function get_post_by_slug($post_slug = NULL){
		if($post_slug === NULL){
			return array();
		}else{
			$sql = "SELECT post_id, post_slug, post_title, post_excerpt, post_content, post_date, post_modified, post_hit, category_name, category_slug
				FROM post_detail
				WHERE post_status = 'publish' AND post_slug = ".$this->db->escape($post_slug);
			$query = $this->db->query($sql);
			return $query->row_array();
		}
	}

	public function get_prev_post($post_date){
		$sql = "SELECT post_id, post_slug, post_title FROM posts WHERE post_status = 'publish' AND post_date > ".$this->db->escape($post_date);
		$sql .= "  ORDER BY post_date ASC LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function get_next_post($post_date){
		$sql = "SELECT post_id, post_slug, post_title FROM posts WHERE post_status = 'publish' AND post_date < ".$this->db->escape($post_date);
		$sql .= "  ORDER BY post_date DESC LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	/* Category Begin*/
	public function get_category_posts($category_slug = NULL, $offset = NULL, $num = NULL){
		if($category_slug === NULL){
			return array();
		}
		$sql = "SELECT post_id, post_slug, post_title, post_excerpt, post_date, post_hit, category_name, category_slug
				FROM post_detail
				WHERE post_status = 'publish'";
		$sql .=	" AND category_slug = ".$this->db->escape($category_slug);
		$sql .=	" ORDER BY post_date DESC";
		if($offset !== NULL AND $num !== NULL){
			$sql .= " LIMIT ".$this->db->escape($offset).", ".$this->db->escape($num);
		}
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}

	public function get_category_posts_num($category_slug = NULL){
		if($category_slug === NULL){
			return 0;
		}

		$sql = "SELECT post_id
				FROM post_detail
				WHERE post_status = 'publish'";
		$sql .=	" AND category_slug = ".$this->db->escape($category_slug);
		$query = $this->db->query($sql);

		return $query->num_rows();
	}
	/* Category End*/

	/* Archives Begin*/
	public function get_archives(){
		$query = $this->db->query("SELECT LEFT(post_date, 7) AS publish_date, COUNT(*) as cnt FROM posts WHERE post_status = 'publish' GROUP BY publish_date ORDER BY publish_date DESC");
		return $query->result_array();
	}

	public function get_specify_month_posts($browse_month = NULL, $offset = NULL, $num = NULL){
		if($browse_month === NULL){
			return array();
		}
		$sql = "SELECT post_id, post_slug, post_title, post_excerpt, post_date, post_hit, category_name, category_slug
				FROM post_detail
				WHERE post_status = 'publish'";
		$sql .=	" AND post_date like ".$this->db->escape($browse_month."%");
		$sql .=	" ORDER BY post_date DESC";
		if($offset !== NULL AND $num !== NULL){
			$sql .= " LIMIT ".$this->db->escape($offset).", ".$this->db->escape($num);
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_specify_month_posts_num($browse_month = NULL){
		if($browse_month === NULL){
			return 0;
		}
		$sql = "SELECT post_id
				FROM post_detail
				WHERE post_status = 'publish'";
		$sql .=	" AND post_date like ".$this->db->escape($browse_month."%");
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	/* Archives End*/
}