<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marker_history_model extends CI_Model {

	public function getMarkerName($data) {
		$query = "SELECT * FROM marker_names WHERE site_id = '".$data['site_id']."' AND marker_id not in (select marker_id from marker_comm_hist where ts LIKE '%".$data['ts']."%')";
		$result = $this->db->query($query);
		return $result->result();
	}

	public function insertMarkerHistory($data) {
		$query = "INSERT INTO marker_histories (ts, marker_id, event_id) VALUES ('".$data['ts']."', '".$data['marker_id']."', '".$data['event_id']."')";
		$result = $this->db->query($query);
		return $result;
	}

	public function renameMarkerHistory($data) {
		$query = "INSERT INTO marker_histories (ts, marker_id, event_id , name) VALUES ('".$data['ts']."', '".$data['marker_id']."', '".$data['event_id']."' , '".$data['new_marker_name']."')";
		$result = $this->db->query($query);
		return $result;
	}

	public function getMarkerTS($data) {
		$query = "SELECT EXISTS (SELECT * FROM marker_histories WHERE marker_id = '".$data['marker_id']."' AND ts = '".$data['ts']."') as status";
		$result = $this->db->query($query);
		return $result->result();
	}
}

?>