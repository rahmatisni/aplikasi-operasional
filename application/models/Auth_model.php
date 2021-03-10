<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
		$this->load->database('default');	
	}
	
	public function login($data,$table)
	{
		$this->db->where($data);
		$query=$this->db->get($table);     	
		return $query;  	
	}

}
