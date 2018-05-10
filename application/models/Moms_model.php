<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moms_model extends CI_Model {
	public function getFeatureName($data) {
		$query = "SELECT * FROM feature_types natural join features where site_id = '".$data['site_id']."' and feat_type_id = '".$data['feat_id']."'";
		$result = $this->db->query($query);
		return $result->result();
	}

	public function insertMoms($data) {
		if (is_numeric($data['feat_id']) == false) {
			$query = "INSERT INTO features (site_id, feat_type_id, name) VALUES ('".$data['site_id']."', '".$data['feat_type_id']."', '".$data['feat_id']."')";
			$last_id_raw = $this->db->query($query);
			
			$query = "SELECT LAST_INSERT_ID() as feat_id;";
			$mo = $this->db->query($query);
			$raw = $mo->result();
			$data['feat_id'] = $raw[0]->feat_id;

			if (sizeOf($this->checkIfMomsExists($data)) != 0) {
				$query = "INSERT INTO moms (feat_id, ts_observation, report, observer, reporter) VALUES ('".$data['feat_id']."', '".$data['observance_timestamp']."','".$data['narrative']."','".$data['observer']."', '".$data['user_id']."')";
				$result = $this->db->query($query);
				return $result;
			} else {
				return false;
			}
		}
		if (sizeOf($this->checkIfMomsExists($data)) != 0) {
			$query = "INSERT INTO moms (feat_id, ts_observation, report, observer, reporter) VALUES ('".$data['feat_id']."', '".$data['observance_timestamp']."','".$data['narrative']."','".$data['observer']."', '".$data['user_id']."')";
			$result = $this->db->query($query);
			return $result;
		} else {
			return false;
		}
	}

	public function checkIfMomsExists($data) {
		$query = "SELECT EXISTS (SELECT * FROM feature_types natural join features natural join moms where site_id = '".$data['site_id']."' and feat_type_id = '".$data['feat_type_id']."' and ts_observation = '".$data['observance_timestamp'].":00"."')";
		$result = $this->db->query($query);
		return $result->result();
	}

	public function getAllMoms($data) {
		$query = "SELECT * FROM moms_name WHERE site_id = '".$data['site_id']."' AND ts_observation LIKE '%".$data['ts']."%' ORDER BY ts_observation DESC";
		$result = $this->db->query($query);
		return $result->result();
	}

	public function updateMomsNarrative($data) {
		$query = "UPDATE moms_name SET report = '".$data['narrative']."', reporter = '".$data['reporter']."' where moms_id = '".$data['moms_id']."'";
		$result = $this->db->query($query);
		return $result;
	}

	public function deleteMoms($data) {
		$query = "DELETE FROM moms WHERE moms_id='".$data['moms_id']."'";
		$result = $this->db->query($query);
		return $result;
	}
}

?>
