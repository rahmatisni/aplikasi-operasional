<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogActivityModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
		$this->load->database();	
	}
	
	public function make_log($activity,$event,$keterangan,$gerbang)
	{
		$data = array(
			'npp_no' => $this->session->userdata('nppno'),
			'id_jabatan' => $this->session->userdata('jabatan_id'),
			'gerbang_id'=>  $gerbang,
			'kategori'=>$activity,
			'waktu' => date("Y-m-d H:i:s"),
			'event'=>  $event,
			'keterangan' => $keterangan			
		);

		$insert=$this->db->insert('tbl_log_operasional',$data);

		return $insert;
	}	 

}