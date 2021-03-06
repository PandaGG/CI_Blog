<?php
class Post_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function get_posts($status = 'all', $cid = 0, $offset = NULL, $num = NULL){
        $sql = "SELECT post_id, post_title, post_slug, post_content, post_excerpt, post_status, post_date, post_modified, post_hit FROM post_detail";
        if($status == 'all'){
            $sql .= " WHERE (post_status = 'publish' OR post_status = 'draft')";
        }else{
            $sql .= " WHERE post_status = ".$this->db->escape($status);
        }

        if($cid != 0){
            $sql .= " AND category_id = ".$this->db->escape($cid);
        }
        $sql .= " ORDER BY post_modified DESC";

        if($offset !== NULL AND $num !== NULL){
            $sql .= " LIMIT ".$this->db->escape($offset).", ".$this->db->escape($num);
        }

        $query = $this->db->query($sql);
        return $query->result_array();
	}

    public function count_condition_posts($status = 'all', $cid = 0){
        $sql = "SELECT post_id FROM post_detail";

        if($status == 'all'){
            $sql .= " WHERE (post_status = 'publish' OR post_status = 'draft')";
        }else{
            $sql .= " WHERE post_status = ".$this->db->escape($status);
        }

        if($cid != 0){
            $sql .= " AND category_id = ".$this->db->escape($cid);
        }

        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function get_search_posts($keywords = NULL, $offset = NULL, $num = NULL){
        $sql = "SELECT post_id, post_title, post_slug, post_content, post_excerpt, post_status, post_date, post_modified, post_hit FROM post_detail";
        $sql .= " WHERE (post_status = 'publish' OR post_status = 'draft')";

        if($keywords != NULL){
            $sql .= " AND post_title like ".$this->db->escape('%'.$keywords.'%');
        }
        $sql .= " ORDER BY post_modified DESC";

        if($offset !== NULL AND $num !== NULL){
            $sql .= " LIMIT ".$this->db->escape($offset).", ".$this->db->escape($num);
        }

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function count_search_posts($keywords = NULL){
        $sql = "SELECT post_id FROM post_detail";
        $sql .= " WHERE (post_status = 'publish' OR post_status = 'draft')";

        if($keywords != NULL){
            $sql .= " AND post_title like ".$this->db->escape('%'.$keywords.'%');
        }

        $query = $this->db->query($sql);
        return $query->num_rows();
    }


    public function get_post_info($pid = NULL){
        if($pid === NULL){
            return NULL;
        }
        $query = $this->db->get_where('posts',array('post_id' => $pid));
        return $query->row_array();
    }


    public function insert_post($cid, $title, $slug, $excerpt, $html_context, $status = 'draft'){
        if(empty($cid) || empty($title) || empty($slug)){
            return 0;
        }

        $current_time = date('Y-m-d H:i:s');
        $data = array(
            'post_title' => $title,
            'post_slug' => $slug,
            'post_content' => $html_context,
            'post_excerpt' => $excerpt,
            'post_status' => $status,
            'post_category' => $cid,
            'post_date' => $current_time,
            'post_modified' => $current_time
        );

        $sql = $this->db->insert_string('posts', $data);
        $this->db->query($sql);
        if($this->db->affected_rows()){
            return $this->db->insert_id();
        }
        return 0;
    }

    public function update_post($pid, $cid, $title, $slug, $excerpt, $html_context, $status = 'draft'){
        if(empty($pid) || empty($cid) || empty($title) || empty($slug)){
            return 0;
        }

        $current_time = date('Y-m-d H:i:s');
        $data = array(
            'post_title' => $title,
            'post_slug' => $slug,
            'post_content' => $html_context,
            'post_excerpt' => $excerpt,
            'post_status' => $status,
            'post_category' => $cid,
            'post_modified' => $current_time
        );
        $where = 'post_id = '.$pid;
        $sql = $this->db->update_string('posts', $data, $where);
        $this->db->query($sql);
        return $this->db->affected_rows();
        return 0;
    }

    public function updateCategory($ids = array(), $cid = NULL){
        if(count($ids) == 0 || $cid === NULL){
            return 0;
        }
        $this->db->where_in('post_id',$ids);
        $this->db->update('posts',array('post_category'=>$cid));
        return $this->db->affected_rows();
    }

    public function updateStatus($ids = array(), $status = NULL){
        if(count($ids) == 0  ||  $status === NULL ){
            return 0;
        }
        $this->db->where_in('post_id',$ids);
        $this->db->update('posts',array('post_status'=>$status));
        return $this->db->affected_rows();
    }

    public function deletePost($ids = array()){
        if(count($ids) == 0){
            return 0;
        }
        $this->db->where_in('post_id',$ids);
        $this->db->delete('posts');
        return $this->db->affected_rows();
    }

    public function isExistSlug($slug = NULL, $pid = -1){
        if($slug === NULL){
            return 1;
        }

        $sql = "SELECT post_id FROM post_detail";

        if($pid == -1){
            $sql .= " WHERE post_slug = ".$this->db->escape($slug);
        }else{
            $sql .= " WHERE post_slug = ".$this->db->escape($slug)." AND post_id <> ".$this->db->escape($pid);
        }

        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}