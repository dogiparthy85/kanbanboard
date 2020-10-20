<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {
	public function getData($tablename, $where = array(), $singleRow = false, $select = array()) {
		if (!empty($select)) {
			$sSelect = implode(',', $select);
			$this->db->select($sSelect);
		} else {
			$this->db->select();
		}
		$this->db->from($tablename);
		foreach ($where as $field => $condition) {
			$this->db->where($field, $condition);
		}
		$query = $this->db->get();
		if (!empty($singleRow)) {
			return $query->row_array();
		} else {
			return $query->result('array');
		}
	}
	public function insertData($tablename, $input) {
		$this->db->insert($tablename, $input);
	}
	public function updateData($tablename, $input, $where = array()) {
		$this->db->update($tablename, $input, $where);
	}
}
?>
