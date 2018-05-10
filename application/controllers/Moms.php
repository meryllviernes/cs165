<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moms extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('moms_model');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function add(){
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('moms_page');
		$this->load->view('templates/footer');
	}

	public function view() {
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('moms_view_page');
		$this->load->view('templates/footer');
	}

	public function get_feature_name() {
		$data = $_POST;
		$result = $this->moms_model->getFeatureName($data);
		print_r(json_encode($result));
	}

	public function insert_moms() {
		$data = $_POST;
		$result = $this->moms_model->insertMoms($data);
		print $result;
	}

	public function get_all_moms() {
		$data = $_POST;
		$moms = [];
		$result = $this->moms_model->getAllMoms($data);
		for ($counter = 0; $counter < sizeof($result); $counter++) {
			$result[$counter] = (array) $result[$counter];
			$result[$counter]['functions'] = "<div>".
			"<span class='update-moms glyphicon glyphicon-pencil' aria-hidden='true' style='margin-right: 25%;'></span>".
			"<span class='delete-moms glyphicon glyphicon-trash' aria-hidden='true' style='margin-right: 25%;'></span>".
			"</div>";
		}
		$moms['data'] = $result;
		print json_encode($moms);
	}

	public function update_moms() {
		$data = $_POST;
		$result = $this->moms_model->updateMomsNarrative($data);
		print $result;
	}

	public function delete_moms() {
		$data = $_POST;
		$result = $this->moms_model->deleteMoms($data);
		print $result;
	}

}
