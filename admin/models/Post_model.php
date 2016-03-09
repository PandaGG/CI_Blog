<?php
class Post_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function get_posts(){
        $sql = 'SELECT post_id, post_title, post_slug, post_content, post_excerpt, post_status, post_date, post_modified, post_hit FROM posts ORDER BY post_modified DESC';
        $query = $this->db->query($sql);
        return $query->result_array();
	}

    public function get_post_info($pid = NULL){
        if($pid === NULL){
            return NULL;
        }
        $query = $this->db->get_where('posts',array('post_id' => $pid));
        return $query->row_array();
    }
    public function insert_post($cid, $title, $slug, $description, $html_context, $status = 'draft'){
        if(empty($cid) || empty($title) || empty($slug)){
            return 0;
        }

        $current_time = date('Y-m-d H:i:s');
        $data = array(
            'post_title' => $title,
            'post_slug' => $slug,
            'post_content' => $html_context,
            'post_excerpt' => $description,
            'post_status' => $status,
            'post_category' => $cid,
            'post_date' => $current_time,
            'post_modified' => $current_time
        );

        $sql = $this->db->insert_string('posts', $data);
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function update_post($pid, $cid, $title, $slug, $description, $html_context, $status = 'draft'){
        if(empty($pid) || empty($cid) || empty($title) || empty($slug)){
            return 0;
        }

        $current_time = date('Y-m-d H:i:s');
        $data = array(
            'post_title' => $title,
            'post_slug' => $slug,
            'post_content' => $html_context,
            'post_excerpt' => $description,
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

}