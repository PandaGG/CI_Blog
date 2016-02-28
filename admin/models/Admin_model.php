<?php
class Admin_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function login_user($username, $password){
		$query = $this->db->get_where('admin',array('user_name'=>$username, 'password'=>$password));
		return $query->row_array();
	}
}