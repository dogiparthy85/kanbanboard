<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public $aBreadcrumbMenu = array();
	public function __construct() {
		parent::__construct();
		$this->aBreadcrumbMenu['index'] = 'Home';
		$this->load->model('Login_model', 'login');
		$this->load->model('Task_model', 'task');
		$this->config->set_item('system_name', 'Kanbanview');
		$this->config->set_item('system_footer', '');
		$this->template->set('sub_title', '');
	}
	public function index() {
		header("Access-Control-Allow-Origin: *");
		if ($this->session->userdata('staff_authenticated') == FALSE) {
			redirect('index.php/home/login'); // the user is not logged in, redirect them!
		} else {
			$this->template->set('breadcrumb', $this->aBreadcrumbMenu);
			$this->login->setUserID($this->session->userdata('user_id'));
			$this->template->set('title', 'Home');
			$this->template->load('dashboardblock');
		}
	}
	public function login() {
		if ($this->session->userdata('staff_authenticated') == FALSE) {
			$this->template->set('title', 'Login');
			$this->template->load('login', 'login_layout');
		} else {
			redirect('index.php/home/index');
		}
	}
	// Login Action
	function doLogin() {
		// Check form  validation
		$data = array();
		$this->form_validation->set_rules('username', 'UserName', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			//Field validation failed.  User redirected to login page
			$this->template->set('title', 'Login');
			$this->template->load('login_layout', 'contents', 'login', $data);
		} else {
			$sessArray = array();
			//Field validation succeeded.  Validate against database
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->login->setUsername($username);
			$this->login->setPassword(hash('sha256', $password));
			//query the database
			$result = $this->login->login();

			if ($result) {
				foreach ($result as $row) {
					$sessArray = array(
						'user_id' => $row->id,
						'name' => $row->first_name . ' ' . $row->last_name,
						'email' => $row->email,
						'staff_authenticated' => TRUE,
					);
					$this->session->set_userdata($sessArray);
				}
				redirect('index.php/home/index');
			} else {
				redirect('index.php/home/login?msg=1');
			}
		}
	}
	// Logout
	public function logout() {
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('staff_authenticated');
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time() - 42000, '/', null, false, true);
		}
		//End Gluu Server
		$this->session->sess_destroy();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");

		redirect('index.php/home/login');
	}
	function submitTask() {
		// Check form  validation

		$this->aBreadcrumbMenu['#'] = 'Home';
		$this->form_validation->set_rules('name', 'Task Name', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->template->set('title', 'Home');
			$this->template->set('breadcrumb', $this->aBreadcrumbMenu);
			$this->template->load('dashboardblock');

		} else {
			$name = $this->input->post('name');
			$type = $this->input->post('type');

			$task_id = create_guid();
			if (!empty($name)) {
				$input = array(
					'id' => $task_id,
					'name' => $name,
					'type' => $type,
					'date_created' => date("Y-m-d H:i:s"),
					'deleted' => 0,
				);
				$this->task->insertData('tasks', $input);
				$userSubject = 'New Task - ' . $this->input->post('name') . '  Created';
				$userBody = '<html>
										<body>
									<p> New Task ' . $this->input->post('name') . ' is Created</p>
						</body>
						</html>';
				//$mailResponse = sendMail($userSubject, $userBody, 'manager@admin.com');
				/*if ($mailResponse != true || $mailResponse != '1') {
					print_r($mailResponse);
					die();
				} else {
					print_r("Task Not Created Sucessfully");
					die();
				}
				*/

			}
			redirect('index.php/home/index');
		}
	}
	public function getTaskList() {
		$aTaskList = $this->task->getData('tasks', array('deleted' => 0));
		$view = '';
		$aTaskGroup = [];
		if (!empty($aTaskList)) {
			foreach ($aTaskList as $key => $aRow) {
				$aTaskGroup[$aRow['type']][] = $aRow;
			}
			if (!empty($aTaskGroup)) {
				$view .= '<div class="col-md-3"><div class="elementlistbox">';
				$view .= '<div class="box-header with-border">
                <h3 class="box-title">Backlog</h3>
            			</div>';
				$view .= '<div class="box-body">';
				$view .= '<ul class="brisklist-unstyled" id="backlog">';
				$view .= '<li></li>';
				if (!empty($aTaskGroup['Backlog'])) {
					foreach ($aTaskGroup['Backlog'] as $aParam) {
						$view .= '<li id="' . $aParam['id'] . '" datavalue = "' . $aParam['name'] . '" datatype = "' . $aParam['type'] . '" onclick="taskupdate(this);"><a href="#">' . $aParam['name'] . '</a></li>';
					}
				}
				$view .= '</ul>';
				$view .= '</div>';
				$view .= '</div>';
				$view .= '</div>';

				//Start 2nd
				$view .= '<div class="col-md-3"><div class="elementlistbox">';
				$view .= '<div class="box-header with-border">
                <h3 class="box-title">To Do</h3>
            			</div>';
				$view .= '<div class="box-body">';
				$view .= '<ul class="brisklist-unstyled" id="todo">';
				$view .= '<li></li>';
				if (!empty($aTaskGroup['To Do'])) {
					foreach ($aTaskGroup['To Do'] as $aParam) {
						$view .= '<li id="' . $aParam['id'] . '" datavalue = "' . $aParam['name'] . '" datatype = "' . $aParam['type'] . '" onclick="taskupdate(this);"><a href="#">' . $aParam['name'] . '</a></li>';
					}
				}
				$view .= '</ul>';
				$view .= '</div>';
				$view .= '</div>';
				$view .= '</div>';

				//Start 3rd

				$view .= '<div class="col-md-3"><div class="elementlistbox">';
				$view .= '<div class="box-header with-border">
                <h3 class="box-title">Ongoing</h3>
            			</div>';
				$view .= '<div class="box-body">';
				$view .= '<ul class="brisklist-unstyled" id="ongoing">';
				$view .= '<li></li>';
				if (!empty($aTaskGroup['Ongoing'])) {
					foreach ($aTaskGroup['Ongoing'] as $aParam) {
						$view .= '<li id="' . $aParam['id'] . '" datavalue = "' . $aParam['name'] . '" datatype = "' . $aParam['type'] . '" onclick="taskupdate(this);"><a href="#">' . $aParam['name'] . '</a></li>';
					}
				}
				$view .= '</ul>';
				$view .= '</div>';
				$view .= '</div>';
				$view .= '</div>';

				//Start 4th

				$view .= '<div class="col-md-3"><div class="elementlistbox">';
				$view .= '<div class="box-header with-border">
                <h3 class="box-title">Done</h3>
            			</div>';
				$view .= '<div class="box-body">';
				$view .= '<ul class="brisklist-unstyled" id="done">';
				$view .= '<li></li>';
				if (!empty($aTaskGroup['Done'])) {
					foreach ($aTaskGroup['Done'] as $aParam) {
						$view .= '<li id="' . $aParam['id'] . '" datavalue = "' . $aParam['name'] . '" datatype = "' . $aParam['type'] . '" onclick="taskupdate(this);"><a href="#">' . $aParam['name'] . '</a></li>';
					}
				}
				$view .= '</ul>';
				$view .= '</div>';
				$view .= '</div>';
				$view .= '</div>';

			}

		} else {
			$view .= '';
		}
		echo $view;
	}
	function removeTask() {
		$metaInput = json_decode($_REQUEST['metadata'], true);
		if (!empty($metaInput['task_id'])) {
			$input['deleted'] = 1;
			$where['id'] = $metaInput['task_id'];
			$this->task->updateData('tasks', $input, $where);
			echo "DONE";
		} else {
			echo "FAIL";
		}
	}
	function moveForwardTask() {
		$taskIndex = array('Backlog', 'To Do', 'Ongoing', 'Done');
		$metaInput = json_decode($_REQUEST['metadata'], true);
		$key = array_search($metaInput['task_type'], $taskIndex);
		$forwardValue = $key + 1;
		if (!empty($metaInput['task_id'])) {
			$input['type'] = $taskIndex[$forwardValue];
			$where['id'] = $metaInput['task_id'];
			$this->task->updateData('tasks', $input, $where);
			echo "DONE";
		} else {
			echo "FAIL";
		}
	}
	function moveBackwardTask() {
		$taskIndex = array('Backlog', 'To Do', 'Ongoing', 'Done');
		$metaInput = json_decode($_REQUEST['metadata'], true);
		$key = array_search($metaInput['task_type'], $taskIndex);
		$backwardValue = $key - 1;
		if (!empty($metaInput['task_id'])) {
			$input['type'] = $taskIndex[$backwardValue];
			$where['id'] = $metaInput['task_id'];
			$this->task->updateData('tasks', $input, $where);
			echo "DONE";
		} else {
			echo "FAIL";
		}
	}
}
