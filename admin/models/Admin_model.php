<?php
class Admin_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function login_user($username, $password){
		$query = $this->db->query('SELECT uid, user_name FROM admin WHERE user_name = ? AND password = ?', array($username, $password));
		return $query->row_array();
	}
}