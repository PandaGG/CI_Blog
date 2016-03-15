<?php
class Site_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
    public function get_site_info(){
        $sql = "SELECT site_name, site_description, site_keywords, copyright FROM site_option WHERE site_id = 1 LIMIT 1";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
}