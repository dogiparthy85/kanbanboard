<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

@ini_set('max_execution_time', 240);
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('PHPASS_HASH_STRENGTH', 8);
define('PHPASS_HASH_PORTABLE', false);

class Install {
	private $error = '';
	private $service_name = '';
	private $service_id = '';

	private $passed_steps = [];

	private $config_path = '../application/config/app-config-sample.php';
	private $new_config_path = '../application/config/app-config.php';

	public function __construct($service_list) {
		$this->passed_steps = [
			1 => false,
			2 => false,
			3 => false,
			4 => false,
		];
		$this->service_name = $service_list[$_REQUEST['service']];
		$this->service_id = $_REQUEST['service'];
	}

	public function go() {
		$debug = '';
		$step = 1;

		if (isset($_POST) && !empty($_POST)) {
			if (isset($_POST['step']) && $_POST['step'] == 2) {
				$step = 2;
				$this->passed_steps[1] = true;
				$this->passed_steps[2] = true;
			} elseif (isset($_POST['step']) && $_POST['step'] == 3) {
				if ($_POST['hostname'] == '') {
					$this->error = 'Hostname is required';
				} elseif ($_POST['database'] == '') {
					$this->error = 'Enter database name';
				} elseif ($_POST['password'] == '' && !$this->is_localhost()) {
					$this->error = 'Enter database password';
				} elseif ($_POST['username'] == '') {
					$this->error = 'Enter database username';
				}
				$step = 3;
				$this->passed_steps[1] = true;
				$this->passed_steps[2] = true;
				if ($this->error === '') {
					$this->passed_steps[3] = true;

					$h = trim($_POST['hostname']);
					$u = trim($_POST['username']);
					$p = trim($_POST['password']);
					$d = trim($_POST['database']);

					$link = @new mysqli($h, $u, $p);

					if ($link->connect_errno) {
						$this->error .= 'Error: Unable to connect to MySQL.<br />';
						$this->error .= 'Debugging errno: ' . $link->connect_errno . '<br />';
						$this->error .= 'Debugging error: ' . $link->connect_error;
					} else {
						$sql = "CREATE  DATABASE IF NOT EXISTS {$d} DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
						$debug .= 'Success: A proper connection to MySQL was made! <br />';
						$debug .= 'Host information: ' . $link->host_info . '<br />';
						if ($link->query($sql) === TRUE) {
							$debug .= 'Database ' . $d . ' successfully created';
							$step = 4;
							$link->close();

						} else {
							$this->error .= 'Error: ' . $conn->error;

						}
					}
				}
			} elseif (isset($_POST['requirements_success'])) {
				$variable_flag = true;
				switch ($this->service_id) {
				case 'rbac_service':
					if ($_POST['staff_url'] == '') {
						$variable_flag = false;
					}
					break;
				case 'platform_service':
					if ($_POST['reg_url'] == '') {
						$variable_flag = false;
					}
					break;
				case 'dashboard_service':
					if ($_POST['staff_url'] == '') {
						$variable_flag = false;
					}
					break;
				case 'dataapi_service':
					if ($_POST['staff_url'] == '') {
						$variable_flag = false;
					}
					if ($_POST['org_url'] == '') {
						$variable_flag = false;
					}
					break;
				case 'department_service':
					if ($_POST['staff_url'] == '') {
						$variable_flag = false;
					}
					break;
				case 'division_service':
					if ($_POST['staff_url'] == '') {
						$variable_flag = false;
					}
					break;
				case 'organization_service':
					if ($_POST['staff_url'] == '') {
						$variable_flag = false;
					}
					break;
				case 'registry_service':
					if ($_POST['staff_url'] == '') {
						$variable_flag = false;
					}
					if ($_POST['org_url'] == '') {
						$variable_flag = false;
					}
					if ($_POST['access_url'] == '') {
						$variable_flag = false;
					}
					break;
				case 'advancereport_service':
					if ($_POST['staff_url'] == '') {
						$variable_flag = false;
					}
					if ($_POST['org_url'] == '') {
						$variable_flag = false;
					}
					break;
				case 'skill_service':
					if ($_POST['staff_url'] == '') {
						$variable_flag = false;
					}
					break;
				case 'questionbank_service':
					if ($_POST['staff_url'] == '') {
						$variable_flag = false;
					}
					break;
				}
				if ($variable_flag) {
					$step = 2;
					$this->passed_steps[1] = true;
					$this->passed_steps[2] = true;
				} else {
					$this->error = 'Please enter Depended Service url';
					$step = 1;
					$this->passed_steps[1] = true;
				}
			} elseif (isset($_POST['permissions_success'])) {
				$step = 3;
				$this->passed_steps[1] = true;
				$this->passed_steps[2] = true;
				$this->passed_steps[3] = true;
			} elseif (isset($_POST['permissions_scriptrun'])) {
				$per_contents = file_get_contents('../permission.sh');
				$aPerContent = explode("\n", $per_contents);
				foreach ($aPerContent as $command) {
					$output = shell_exec($command);
					//print_r($output);
				}
				$step = 2;
				$this->passed_steps[1] = true;
				$this->passed_steps[2] = true;
			} elseif (isset($_POST['step']) && $_POST['step'] == 4) {
				if ($_POST['base_url'] == '') {
					$this->error = 'Please enter base url';
				}
				$this->passed_steps[1] = true;
				$this->passed_steps[2] = true;
				$this->passed_steps[3] = true;
				$this->passed_steps[4] = true;
				$step = 4;
			}
			if ($this->error === '' && isset($_POST['step']) && $_POST['step'] == 4) {
				include_once 'sqlparser.php';
				$parser = new SqlScriptParser();

				$sqlStatements = $parser->parse('../Database/initialDB.sql');

				$h = trim($_POST['hostname']);
				$u = trim($_POST['username']);
				$p = trim($_POST['password']);
				$d = trim($_POST['database']);

				$link = new mysqli($h, $u, $p, $d);

				foreach ($sqlStatements as $statement) {
					$distilled = $parser->removeComments($statement);
					if (!empty($distilled)) {
						$link->query($distilled);
					}
				}

				$this->write_app_config();

				/*if (!$this->rename_app_config()) {
					$rename_failed = true;
				}*/

				//require_once 'phpass.php';

				//$hasher    = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);

				$password = hash('sha256', $_POST['admin_passwordr']);
				$email = $_POST['admin_email'];
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];

				$datecreated = date('Y-m-d H:i:s');

				// https://stackoverflow.com/questions/20867182/insert-query-executes-successfully-but-data-is-not-inserted-to-the-database
				// There is a commit in the database.sql
				$link->autocommit(true);

				$timezone = $_POST['timezone'];
				//$sql = "UPDATE tbloptions SET value='$timezone' WHERE name='default_timezone'";
				//$link->query($sql);

				$di = time();
				//$sql = "UPDATE tbloptions SET value='$di' WHERE name='di'";
				//$link->query($sql);

				$installMsg = '<div class="col-md-12">';
				$installMsg .= '<div class="alert alert-success">';
				$installMsg .= '<h4 class="bold">Congratulation on your installation!</h4>';
				$installMsg .= '<p>Now, you can activate modules that comes with the installation in <b>Setup->Modules<b>.</p>';
				$installMsg .= '</div>';
				$installMsg .= '</div>';

				$this->passed_steps[1] = true;
				$this->passed_steps[2] = true;
				$this->passed_steps[3] = true;
				$this->passed_steps[4] = true;

				if (!file_exists('../.htaccess') && is_writable('../')) {
					fopen('../.htaccess', 'w');
					$fp = fopen('../.htaccess', 'a+');
					if ($fp) {
						fwrite($fp, 'RewriteEngine on' . PHP_EOL . 'RewriteCond $1 !^(index\.php|resources|robots\.txt)' . PHP_EOL . 'RewriteCond %{REQUEST_FILENAME} !-f' . PHP_EOL . 'RewriteCond %{REQUEST_FILENAME} !-d' . PHP_EOL . 'RewriteRule ^(.*)$ index.php?/$1 [L,QSA]' . PHP_EOL . 'AddDefaultCharset utf-8');
						fclose($fp);
					}
				}
				$step = 5;
			} else {
				$error = $this->error;
			}
		}
		$passed_steps = $this->passed_steps;
		require_once 'html.php';
	}

	public function is_localhost() {
		$whitelist = [
			'127.0.0.1',
			'::1',
		];

		if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
			return true;
		}

		return false;
	}

	private function write_app_config() {
		$hostname = trim($_POST['hostname']);
		$database = trim($_POST['database']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		$base_url = trim($_POST['base_url']);
		$base_url = rtrim($base_url, '/') . '/';

		//$encryption_key = bin2hex($this->create_key(16));
		$encryption_key = '';
		$config_path = $this->config_path;
		$new_config_path = $this->new_config_path;

		@chmod($config_path, FILE_WRITE_MODE);
		@chmod($new_config_path, FILE_WRITE_MODE);

		$config_file = file_get_contents($config_path);
		$config_file = trim($config_file);

		$config_file = str_replace('[db_hostname]', $hostname, $config_file);

		$config_file = str_replace('[db_username]', $username, $config_file);
		$config_file = str_replace('[db_password]', $password, $config_file);
		$config_file = str_replace('[db_name]', $database, $config_file);
		$config_file = str_replace('[encryption_key]', $encryption_key, $config_file);
		$config_file = str_replace('[base_url]', $base_url, $config_file);
		$config_file = str_replace("define('APP_INSTALLER_LOCKED', false)", "define('APP_INSTALLER_LOCKED', true)", $config_file);
		switch ($this->service_id) {
		case 'rbac_service':
			$staff_url = trim($_POST['staff_url']);
			$staff_url = rtrim($staff_url, '/') . '/';
			$config_file = str_replace('[staff_url]', $staff_url, $config_file);
			break;
		case 'dashboard_service':
			$staff_url = trim($_POST['staff_url']);
			$staff_url = rtrim($staff_url, '/') . '/';
			$config_file = str_replace('[staff_url]', $staff_url, $config_file);
			break;
		case 'dataapi_service':
			$staff_url = trim($_POST['staff_url']);
			$staff_url = rtrim($staff_url, '/') . '/';
			$config_file = str_replace('[staff_url]', $staff_url, $config_file);
			$org_url = trim($_POST['org_url']);
			$org_url = rtrim($org_url, '/') . '/';
			$config_file = str_replace('[org_url]', $org_url, $config_file);

			break;
		case 'department_service':
			$staff_url = trim($_POST['staff_url']);
			$staff_url = rtrim($staff_url, '/') . '/';
			$config_file = str_replace('[staff_url]', $staff_url, $config_file);
			break;
		case 'division_service':
			$staff_url = trim($_POST['staff_url']);
			$staff_url = rtrim($staff_url, '/') . '/';
			$config_file = str_replace('[staff_url]', $staff_url, $config_file);
			break;
		case 'organization_service':
			$staff_url = trim($_POST['staff_url']);
			$staff_url = rtrim($staff_url, '/') . '/';
			$config_file = str_replace('[staff_url]', $staff_url, $config_file);
			break;
		case 'platform_service':
			$reg_url = trim($_POST['reg_url']);
			$reg_url = rtrim($reg_url, '/') . '/';
			$config_file = str_replace('[reg_url]', $reg_url, $config_file);
			break;
		case 'registry_service':
			$staff_url = trim($_POST['staff_url']);
			$staff_url = rtrim($staff_url, '/') . '/';
			$config_file = str_replace('[staff_url]', $staff_url, $config_file);
			$org_url = trim($_POST['org_url']);
			$org_url = rtrim($org_url, '/') . '/';
			$config_file = str_replace('[org_url]', $org_url, $config_file);
			$access_url = trim($_POST['access_url']);
			$access_url = rtrim($access_url, '/') . '/';
			$config_file = str_replace('[access_url]', $access_url, $config_file);
			break;
		case 'advancereport_service':
			$staff_url = trim($_POST['staff_url']);
			$staff_url = rtrim($staff_url, '/') . '/';
			$config_file = str_replace('[staff_url]', $staff_url, $config_file);
			$org_url = trim($_POST['org_url']);
			$org_url = rtrim($org_url, '/') . '/';
			$config_file = str_replace('[org_url]', $org_url, $config_file);
			break;
		case 'skill_service':
			$staff_url = trim($_POST['staff_url']);
			$staff_url = rtrim($staff_url, '/') . '/';
			$config_file = str_replace('[staff_url]', $staff_url, $config_file);
			break;
		case 'questionbank_service':
			$staff_url = trim($_POST['staff_url']);
			$staff_url = rtrim($staff_url, '/') . '/';
			$config_file = str_replace('[staff_url]', $staff_url, $config_file);
			break;

		}

		if (!$fp = fopen($new_config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
			return false;
		}

		flock($fp, LOCK_EX);
		fwrite($fp, $config_file, strlen($config_file));
		flock($fp, LOCK_UN);
		fclose($fp);
		@chmod($new_config_path, FILE_READ_MODE);

		return true;
	}

	private function rename_app_config() {
		if (@rename('../application/config/app-config-sample.php', '../application/config/app-config.php') == true) {
			return true;
		}

		return false;
	}

	public function guess_base_url() {
		$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ? 'https' : 'http';
		$base_url .= '://' . $_SERVER['HTTP_HOST'];
		$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
		$base_url = preg_replace('/install.*/', '', $base_url);

		return $base_url;
	}

	public function get_timezones_list() {
		return [
			'EUROPE' => DateTimeZone::listIdentifiers(DateTimeZone::EUROPE),
			'AMERICA' => DateTimeZone::listIdentifiers(DateTimeZone::AMERICA),
			'INDIAN' => DateTimeZone::listIdentifiers(DateTimeZone::INDIAN),
			'AUSTRALIA' => DateTimeZone::listIdentifiers(DateTimeZone::AUSTRALIA),
			'ASIA' => DateTimeZone::listIdentifiers(DateTimeZone::ASIA),
			'AFRICA' => DateTimeZone::listIdentifiers(DateTimeZone::AFRICA),
			'ANTARCTICA' => DateTimeZone::listIdentifiers(DateTimeZone::ANTARCTICA),
			'ARCTIC' => DateTimeZone::listIdentifiers(DateTimeZone::ARCTIC),
			'ATLANTIC' => DateTimeZone::listIdentifiers(DateTimeZone::ATLANTIC),
			'PACIFIC' => DateTimeZone::listIdentifiers(DateTimeZone::PACIFIC),
			'UTC' => DateTimeZone::listIdentifiers(DateTimeZone::UTC),
		];
	}
}
