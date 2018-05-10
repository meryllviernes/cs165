<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homedashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}
	
	public function index(){
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('dashboard_page');
		$this->load->view('templates/footer');
	}

	public function surficial_data() {
		$data = $_POST;
		$surficial = [];
		$result = $this->dashboard_model->getAllSurficial($data);
		for ($counter = 0; $counter < sizeof($result); $counter++) {
			$result[$counter] = (array) $result[$counter];
		}
		$surficial['data'] = $result;
		print json_encode($surficial);
	}

	public function moms_data() {
		$data = $_POST;
		$moms = [];
				
		$result = $this->dashboard_model->getAllMoms($data);
		for ($counter = 0; $counter < sizeof($result); $counter++) {
			$result[$counter] = (array) $result[$counter];
		}
		$moms['data'] = $result;
		print json_encode($moms);
	}
}
