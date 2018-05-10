<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function validateCreds($credentials) {
		$query = "SELECT * FROM users WHERE username = '".$credentials['user']."' AND password = '".$credentials['pass']."';";
		$result = $this->db->query($query);
		return $result->result();
	}
}

?>