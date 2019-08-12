<?php
class Request {
	public $get = array();
	public $post = array();
	public $cookie = array();
	public $files = array();
	public $server = array();
	
	public function __construct() {
		if(isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/admin') === false && $_SERVER['REQUEST_METHOD'] === 'GET'){
			if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')){
				if(file_exists($_SERVER["DOCUMENT_ROOT"].'/seoshield-client/main.php')){
					include_once($_SERVER["DOCUMENT_ROOT"].'/seoshield-client/main.php');
					if(function_exists('seo_shield_start_cms')){
						seo_shield_start_cms();
					}
				}
			}
		}
		$_GET = $this->clean($_GET);
		$_POST = $this->clean($_POST);
		$_REQUEST = $this->clean($_REQUEST);
		$_COOKIE = $this->clean($_COOKIE);
		$_FILES = $this->clean($_FILES);
		$_SERVER = $this->clean($_SERVER);
		
		$this->get = $_GET;
		$this->post = $_POST;
		$this->request = $_REQUEST;
		$this->cookie = $_COOKIE;
		$this->files = $_FILES;
		$this->server = $_SERVER;
	}
	
	public function clean($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				unset($data[$key]);
				
				$data[$this->clean($key)] = $this->clean($value);
			}
		} else { 
			$data = htmlspecialchars($data, ENT_COMPAT);
		}

		return $data;
	}
}
?>