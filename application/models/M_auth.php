<?php 
class M_auth extends CI_Model{	
	function auth_check($table,$where){		
		return $this->db->get_where($table,$where);
	}	
}