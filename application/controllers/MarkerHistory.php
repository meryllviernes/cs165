<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Markerhistory extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('marker_history_model');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('marker_history_page');
		$this->load->view('templates/footer');
	}

	public function get_marker_name_history() {
		$data = $_POST;
		$result = $this->marker_history_model->getMarkerName($data);
		print json_encode($result);
	}

	public function insert_marker_history() {
		$data = $_POST;
		if ($data['new_marker_name'] == "") {
			$result = $this->marker_history_model->insertMarkerHistory($data);
		} else {
			$result = $this->marker_history_model->renameMarkerHistory($data);
		}
		print $result;
	}

	public function check_marker_ts() {
		$data = $_POST;
		$result = $this->marker_history_model->getMarkerTS($data);
		print json_encode($result);
	}
}
