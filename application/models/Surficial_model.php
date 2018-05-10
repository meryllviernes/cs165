<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surficial_model extends CI_Model {

	public function tsExists($data) {
		$query = "SELECT * FROM marker_observations WHERE site_id = '".$data['site_id']."' AND ts = '".$data['ts']."'";
		$result = $this->db->query($query);
		return $result->result();
	}

	public function addSurficialMeas($data) {
		$query = "INSERT INTO marker_observations (site_id, ts, meas_event, observer, weather_id, sender) VALUES (".$data['site_id'].",'".$data['ts']."','".$data['meas_event']."','".$data['observer']."',".$data['weather_id'].",'".$data['sender']."');";
		$result = $this->db->query($query);

		$query = "SELECT LAST_INSERT_ID() as mo_id;";
		$mo = $this->db->query($query);
		$mo_id = $mo->result();

		$query = "SELECT MAX(marker_id) as marker_id FROM markers WHERE site_id = '".$data['site_id']."'";
		$result = $this->db->query($query);
		$marker_id = $result->result();

		if ($mo_id != "" || $mo_id != null) {
			$query = "INSERT INTO marker_data (marker_id, mo_id, meas) VALUES ('".$data['marker_id']."', '".$mo_id[0]->mo_id."', '".$data['marker_measurement']."')";
			$result = $this->db->query($query);
			return $result;
		} else {
			return false;
		}
	}
	public function getALlSurficial($data) {
		$query = "SELECT * FROM marker_meas where marker_id in ( select marker_id from markers where site_id = '".$data['site_id']."') and ts LIKE '%".$data['ts']."%'";
		$result = $this->db->query($query);
		$surficial = $result->result();
		return $surficial;
	}

	public function updateSurficial($data) {
		$query = "UPDATE marker_data SET meas = '".$data['new_meas']."' WHERE data_id = '".$data['data_id']."';";
		$result = $this->db->query($query);

		if ($result != 0) {
			$query = "UPDATE marker_observations SET sender = '".$data['user_id']."' WHERE mo_id = '".$data['mo_id']."'";
			$result = $this->db->query($query);
		}
		return $result;
	}

	public function deleteSurficial($data) {
		$query = "DELETE FROM marker_data WHERE data_id = '".$data['data_id']."'";
		$result = $this->db->query($query);
		return $result;
	}

	public function markerNames($data) {
		$query = "SELECT * FROM marker_names WHERE site_id = '".$data['site_id']."'";
		$result = $this->db->query($query);
		return $result->result();
	}

	public function weather() {
		$query = "SELECT * FROM weather";
		$result = $this->db->query($query);
		return $result->result();
	}
}

?>