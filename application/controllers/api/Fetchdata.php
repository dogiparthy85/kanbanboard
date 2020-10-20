<?php

require APPPATH . 'libraries/REST_Controller.php';

class Fetchdata extends REST_Controller {

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Task_model', 'task');
		$this->load->helper('cstmsystem_helper');
		$this->load->helper('string');
	}
	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function index_post() {
		if ($_REQUEST['method'] == 'submitData') {
			$input = $this->input->post();
			$taskID = create_guid();
			$task_input = array(
				'id' => $taskID,
				'name' => $input['name'],
				'type' => $input['type'],
				'date_created' => date("Y-m-d H:i:s"),
				'deleted' => 0,
			);
			$this->db->insert('tasks', $task_input);
			$this->response('Task Created Successfully : ' . $taskID, REST_Controller::HTTP_OK);
		} elseif ($_REQUEST['method'] == 'updateData') {
			$task_input = [];
			if (!empty($_REQUEST['name'])) {
				$task_input['name'] = $_REQUEST['name'];
			}
			if (!empty($_REQUEST['type'])) {
				$task_input['type'] = $_REQUEST['type'];
			}
			$this->db->update('tasks', $task_input, array('id' => $_REQUEST['recordID']));
			$this->response('Task updated Successfully', REST_Controller::HTTP_OK);
		} elseif ($_REQUEST['method'] == 'updatePassword') {
			$user_input = array(
				'password' => hash('sha256', $_REQUEST['password']),
			);
			$this->db->update('oauth_users', $user_input, array('id' => $_REQUEST['id']));
			$this->response('Password Updated Successfully', REST_Controller::HTTP_OK);
		} elseif ($_REQUEST['method'] == 'deleteData') {
			$updateinput = array(
				'deleted' => 1,
			);
			$this->db->update('tasks', $updateinput, array('id' => $_REQUEST['recordID']));
			$this->response("Task deleted successfully", REST_Controller::HTTP_OK);
		} else {
			if (!empty($_REQUEST['select'])) {
				$select = json_decode($_REQUEST['select'], 1);
				$sSelect = implode(',', $select);
				$this->db->select($sSelect);
			} else {
				$this->db->select();
			}
			$this->db->from('tasks');
			if (!empty($_REQUEST['where'])) {
				$where = json_decode($_REQUEST['where'], 1);
				foreach ($where as $field => $condition) {
					$this->db->where($field, $condition);
				}
			}
			if (!empty($_REQUEST['after_like'])) {
				$after_like = json_decode($_REQUEST['after_like'], 1);
				foreach ($after_like as $field => $condition) {
					$this->db->like($field, $condition, 'after');
				}
			}
			if (!empty($_REQUEST['before_like'])) {
				$before_like = json_decode($_REQUEST['before_like'], 1);
				foreach ($before_like as $field => $condition) {
					$this->db->like($field, $condition, 'before');
				}
			}
			if (!empty($_REQUEST['full_like'])) {
				$full_like = json_decode($_REQUEST['full_like'], 1);
				foreach ($full_like as $field => $condition) {
					$this->db->like($field, $condition, 'both');
				}
			}
			$query = $this->db->get();
			if (!empty($singleRow)) {
				$data = $query->row_array();
			} else {
				$data = $query->result('array');
			}
			$this->response($data, REST_Controller::HTTP_OK);
		}
	}
}
