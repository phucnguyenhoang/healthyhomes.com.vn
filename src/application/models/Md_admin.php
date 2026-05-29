<?php
class Md_admin extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function login($username, $password) {
		$sql = array('username' => $username, 'password' => md5($password));
		$this->db->where($sql);
		$query = $this->db->get('admin');
		if ($query->num_rows() <= 0) return false;
		
		$admin = $query->row_array();
		$this->session->set_userdata('admin', $admin);
		return $admin;
	}
	
	public function resetPassword($email) {
		$this->db->select('id');
		$this->db->where('email', $email);
		$query = $this->db->count_all_results('admin');
		
		if (!$query) {
			return $query;
		}
		
		$newPassword = $this->_generateRandomPassword();
		$this->db->set('password', md5($newPassword));
		$this->db->where('email', $email);
		$this->db->update('admin');
		
		return $newPassword;
	}
	
	public function changePassword($newPassword) {
		$admin = $this->session->userdata('admin');
		if (empty($admin)) redirect(base_url('admin/login'));
		
		$this->db->set('password', md5($newPassword));
		$this->db->where('id', $admin['id']);
		$this->db->update('admin');
		
		return true;
	}
	
	public function getUserByEmail($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('admin');
	}
	
	private function _generateRandomPassword($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}