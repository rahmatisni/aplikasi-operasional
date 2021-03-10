<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenerbitanKartuModel extends CI_Model {
    
    var $table              = 'tbl_penerbitan_kartu';
    var $select_column      = array('id','ktp_id','no_registrasi','ktp_jenis_id','tgl_terbit','tgl_kadaluarsa','nama');
    var $order_column       = array('id','ktp_id','no_registrasi','ktp_jenis_id','tgl_terbit','tgl_kadaluarsa','nama');
 
    public function setKoneksi($database){
        parent::__construct();
        $this->dbx=$this->load->database( $database,TRUE);
    }

    public function make_query()
    {
      
        $this->dbx->select($this->select_column);
        $this->dbx->from($this->table);
           
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
             $this->dbx->order_by("no_registrasi","DESC");
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

    public function insertOrUpdate($data)
    {
        $this->dbp=$this->load->database($data['gerbang'],TRUE);
        if($data['id'] == 0)
        {
            $item=array(
                'nama'=>$data['nama'],
                'tgl_kadaluarsa'=>$data['tglkadaluarsa'],
                'tgl_terbit'=>$data['tglterbit'],
                'ktp_jenis_id'=>$data['jenis_ktp'],
                'no_registrasi'=>$data['noregistrasi']
                
            );

            $insert=$this->dbp->insert('tbl_penerbitan_kartu',$item);
            return $hasil = array('event' => 'tambah','status'=>$insert); 
        }
        else
        {
            $item=array(
                'nama'=>$data['nama'],
                'tgl_kadaluarsa'=>$data['tglkadaluarsa'],
                'tgl_terbit'=>$data['tglterbit'],
                'ktp_jenis_id'=>$data['jenis_ktp'],
                'no_registrasi'=>$data['noregistrasi']
                
            );

            $this->dbp->where('id', $data['id']);
            $update=$this->dbp->update('tbl_penerbitan_kartu', $item); 
            return $hasil = array('event' => 'update','status'=>$update); 
        }
        
    }

    public function showPetugas($id,$gerbang)
    {
        
        $this->dbp=$this->load->database($gerbang, TRUE);
        $this->dbp->select('*');
        $this->dbp->from('tbl_penerbitan_kartu');
        $this->dbp->where('id',$id);

        return $this->dbp->get()->result();
      
    }

    public function deletePetugas($id,$gerbang)
    {
        $this->dbp=$this->load->database($gerbang, TRUE);  
        $this->dbp->where('id', $id);
        $delete=$this->dbp->delete('tbl_penerbitan_kartu');

        return $delete;
    }
    

    


}