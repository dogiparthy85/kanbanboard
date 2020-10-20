<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	// declare private variable
	private $_id;
	private $_name;
	private $_userName;
	private $_email;
	private $_password;
	private $_status;

	public function setUserID($id) {
		$this->_id = $id;
	}
	public function setEmail($email) {
		$this->_email = $email;
	}
	public function setUsername($username) {
		$this->_userName = $username;
	}
	public function setPassword($password) {
		$this->_password = $password;
	}

	public function getUserInfo() {
		$this->db->select(array('u.id', 'u.first_name', 'u.last_name', 'u.email'));
		$this->db->from('oauth_users as u');
		$this->db->where('u.id', $this->_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	function login() {
		$this->db->select();
		$this->db->from('oauth_users');
		$this->db->where('username', $this->_userName);
		$this->db->where('password', $this->_password);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
}
?>
