<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surficial extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('surficial_model');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function add(){
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('surficial_page');
		$this->load->view('templates/footer');
	}

	public function check_ts_surficial() {
		$data = $_POST;
		$result = $this->surficial_model->tsExists($data);
		print json_encode($result);
	}

	public function add_surficial_meas() {
		$data = $_POST;
		$result = $this->surficial_model->addSurficialMeas($data);
		print json_encode($result);
	}

	public function update_surficial() {
		$data = $_POST;
		$result = $this->surficial_model->updateSurficial($data);
		print $result;
	}

	public function delete_surficial() {
		$data = $_POST;
		$result = $this->surficial_model->deleteSurficial($data);
		print $result;
	}

	public function view() {
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('surficial_view');
		$this->load->view('templates/footer');
	}

	public function getMarkerNames() {
		$data = $_POST;
		$result = $this->surficial_model->markerNames($data);
		print json_encode($result);
	}

	public function getWeather() {
		$result = $this->surficial_model->weather();
		print json_encode($result);
	}

	public function get_all_surficial() {
		$data = $_POST;
		$surficial = [];
		$result = $this->surficial_model->getAllSurficial($data);
		for ($counter = 0; $counter < sizeof($result); $counter++) {
			$result[$counter] = (array) $result[$counter];
			$result[$counter]['functions'] = "<div>".
			"<span class='update-surficial glyphicon glyphicon-pencil' aria-hidden='true' style='margin-right: 25%;'></span>".
			"<span class='delete-surficial glyphicon glyphicon-trash' aria-hidden='true' style='margin-right: 25%;'></span>".
			"</div>";
		}
		$surficial['data'] = $result;
		print json_encode($surficial);
	}

	public function delete() {

	}
}
