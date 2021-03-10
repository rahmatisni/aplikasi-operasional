<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model','authmodel');		
	}

	public function index()
	{
		if($this->session->status == "logged"){
			redirect(base_url('main'));
		}
		else
		{
			$this->load->view('login-view');
		}
		
    }
    
    public function cekLogin()
	{
		$npp	  =$this->input->post('npp');
		$password =$this->input->post('password');
		
		$where = array(
					'npp_no' => $npp,
					'password' => $password,
                    'activated'=> 1                    
				  );

		  $rs = $this->authmodel->login($where,'tbl_pegawai')->row();
		  if(!empty($rs)){

				$data_session = array(
						'nppno'=>$rs->npp_no,
						'nama' => $rs->nama_pegawai,
						'jabatan_id' => $rs->jabatan_id,
						'status' => "logged",
						'administrator' => false,
						'ip' => '-',
						'kota' => '-',
						'loc' => '-',
						'company' => '-',
						'time'=> date('d-m-Y H:i:s')
					);
	 			
			 	$this->session->set_userdata($data_session);
			 	redirect(base_url('main'));
	 
			 }else{

				$this->session->set_flashdata('status', 'error');
				redirect(base_url('auth'));
			}

	}
    
    function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}

}