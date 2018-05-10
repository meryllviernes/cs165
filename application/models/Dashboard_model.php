<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function getAllSurficial($data) {
		$query = "SELECT * FROM marker_meas where marker_id in ( select marker_id from markers where site_id = '".$data['site_id']."') order by ts desc;";
		$result = $this->db->query($query);
		return $result->result();
	}

	public function getAllMoms($data) {
		$query = "SELECT * FROM moms_name where site_id = '".$data['site_id']."' order by ts_observation desc;";
		$result = $this->db->query($query);
		return $result->result();
	}

}

?>