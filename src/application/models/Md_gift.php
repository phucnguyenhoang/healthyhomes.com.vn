<?php
class Md_gift extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function add($input) {
		$data = array(
			'thumbnail' => $input['imgThumb'],
			'name' => htmlentities($input['txtName']),
			'description' => htmlentities($input['txtDescription']),
			'price' => htmlentities($input['txtPrice']),
			'show_order' => !empty($input['txtOrder']) ? htmlentities($input['txtOrder']) : null,
			'active' => !empty($input['chkActive']) && $input['chkActive'] == 1 ? 1 : 0,
		);
		$this->db->insert('gifts', $data);
	}

	public function get($field = '*', $page = null) {
		$this->db->select($field);
		$this->db->order_by('show_order', 'ASC');
		$query = $this->db->get('gifts');

		return $query->result_array();
	}

	public function getById($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('gifts');

		return $query->row_array();
	}

	public function update($id, $input) {
		$data = array(
			'thumbnail' => $input['imgThumb'],
			'name' => htmlentities($input['txtName']),
			'description' => htmlentities($input['txtDescription']),
			'price' => htmlentities($input['txtPrice']),
			'show_order' => !empty($input['txtOrder']) ? htmlentities($input['txtOrder']) : null,
			'active' => !empty($input['chkActive']) && $input['chkActive'] == 1 ? 1 : 0,
		);
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('gifts');
	}

	public function checkExist($id) {
		$this->db->where('id', $id);
		return $this->db->count_all_results('gifts');
	}

	public function deleteById($id) {
		$this->db->where('id', $id);
		$this->db->delete('gifts');
	}
}