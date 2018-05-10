<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('login_model');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('login_page');
	}

	public function validateCredentials() {
		$credentials = $_POST;
		$result = $this->login_model->validateCreds($credentials);
		print json_encode($result);
	}
}
