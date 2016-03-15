<?php
class Setting_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
    public function get_site_info(){
        $sql = "SELECT site_name, site_description, site_keywords, copyright FROM site_option WHERE site_id = 1 LIMIT 1";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

	public function update_site_info($site_name, $site_description, $site_keywords, $copyright){
        $this->db->where('site_id', 1);
        $this->db->update('site_option',array('site_name'=>$site_name, 'site_description'=>$site_description, 'site_keywords'=>$site_keywords, 'copyright'=>$copyright));
        return $this->db->affected_rows();
	}

}