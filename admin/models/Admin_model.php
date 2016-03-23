<?php
class Admin_model extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function login_user($username, $password){
		$query = $this->db->query('SELECT uid, user_name, user_type FROM users WHERE user_type = 99 AND user_name = ? AND password = ?', array($username, $password));
		return $query->row_array();
	}
    public function get_user_info($username){
        $query = $this->db->query('SELECT uid, user_name, password, email, user_type FROM users WHERE user_name = ?', array($username));
        return $query->row_array();
    }
	public function update_user_info($username, $email){
        $this->db->query('UPDATE users SET email = ? WHERE user_name = ?', array($email, $username));
        return $this->db->affected_rows();
	}

    public function update_user_password($username, $password){
        $this->db->query('UPDATE users SET password = ? WHERE user_name = ?', array($password, $username));
        return $this->db->affected_rows();
    }
}