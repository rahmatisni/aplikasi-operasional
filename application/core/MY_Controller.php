<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    function render_page($content, $data=null){

        $data['include']   = $this->load->view('partial/include', $data, TRUE);
        $data['navbar']    = $this->load->view('partial/navbar', $data, TRUE);
        $data['sidebar']   = $this->load->view('partial/sidebar', $data, TRUE);
        $data['content']   = $this->load->view($content, $data, TRUE);

        $this->load->view('admin-view', $data);

    }

}
