<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LihatPetugasModel extends CI_Model {
    
    var $table              = 'tbl_pegawai';
    var $select_column      = array('npp_no','nama_pegawai','jabatan_id','gerbang_id','kode_tugas','penempatan_gerbang');
    var $order_column       = array('npp_no','nama_pegawai','jabatan_id','gerbang_id','kode_tugas',null);
 
    public function setKoneksi($database){
        parent::__construct();
        $this->dbx=$this->load->database( $database,TRUE);
    }

    public function make_query()
    {
      
        $this->dbx->select($this->select_column);
        $this->dbx->from($this->table);
        
        if($this->input->post('jabatan'))
		{
			$this->dbx->where('jabatan_id', $this->input->post('jabatan'));
        }
        
        $i = 0;
	
		foreach ($this->select_column as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					 $this->dbx->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					 $this->dbx->like($item, $_POST['search']['value']);
				}
				else
				{
					 $this->dbx->or_like($item, $_POST['search']['value']);
				}

				if(count($this->select_column) - 1 == $i) //last loop
					 $this->dbx->group_end(); //close bracket
			}

			$i++;
		}
       
        
        if(isset($_POST["order"]))
        {
             $this->dbx->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
        }
        else
        {
             $this->dbx->order_by("jabatan_id","ASC");
        }
        
    }

    public function make_datatables()
    {
        $this->make_query();
        if($_POST["length"] != -1)
        {
             $this->dbx->limit($_POST['length'], $_POST['start']);
        }
        $query=  $this->dbx->get();
        return $query->result();
    }

    public function get_filtered_data()
    {
        $this->make_query();
        $query= $this->dbx->get();
        return $query->num_rows();
    }

    public function get_all_data()
    {
         $this->dbx->select('*');
         $this->dbx->from($this->table);
        return  $this->dbx->count_all_results();
    }


    


}