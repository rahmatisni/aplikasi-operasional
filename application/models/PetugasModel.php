<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PetugasModel extends CI_Model {
    
    var $table              = 'tbl_pegawai';
    var $select_column      = array('npp_no','nama_pegawai','jabatan_id','gerbang_id','kode_tugas','penempatan_gerbang');
    var $order_column       = array('id','npp_no','nama_pegawai','jabatan_id','gerbang_id','kode_tugas',null,null);
 
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

    public function insertOrUpdate($data)
    {        
        //echo json_encode($data);

        //$this->dbp=$this->load->database($data['gerbang'],TRUE);    
        
        // if($data['id'] == 0)
        // {
        //     $item=array(
        //         'npp_no'=>$data['npp'],
        //         'nama_pegawai'=>$data['petugas'],
        //         'jabatan_id'=>$data['jabatan'],
        //         'password'=>$data['npp'],
        //         'gerbang_id'=>$data['gerbang']=='default' ? '04' : $data['gerbang'],
        //         'kode_tugas'=>$data['kode_tugas'],
        //         'penempatan_gerbang'=> implode(',', $data['penempatan'])
        //     );

        //     $insert=$this->dbp->insert('tbl_pegawai',$item);

        //     return $hasil = array('event' => 'tambah','status'=>$insert); 
        // }
        // else
        // {            
        //     $item=array(
        //         'npp_no'=>$data['npp'],
        //         'nama_pegawai'=>$data['petugas'],
        //         'jabatan_id'=>$data['jabatan'],
        //         'password'=>$data['npp'],
        //         'gerbang_id'=>$data['gerbang']=='default' ? '04' : $data['gerbang'],
        //         'kode_tugas'=>$data['kode_tugas'],
        //         'penempatan_gerbang'=> implode(',', $data['penempatan'])
        //     );

        //     $this->dbp->where('npp_no', $data['npp']);
        //     $update=$this->dbp->update('tbl_pegawai', $item); 

            
        //     return $hasil = array('event' => 'update','status'=>$update); 
        // }
            
        if($data['id'] == 0)
        {
            $this->dbp=$this->load->database($data['gerbang'],TRUE);    
            $item=array(
                'npp_no'=>$data['npp'],
                'nama_pegawai'=>$data['petugas'],
                'jabatan_id'=>$data['jabatan'],
                'password'=>$data['npp'],
                'gerbang_id'=>'-',
                'kode_tugas'=>$data['kode_tugas'],
                'penempatan_gerbang'=> implode(',', $data['penempatan'])
            );

            $insert=$this->dbp->insert('tbl_pegawai',$item);

            if($insert)
            {   
                foreach ($data['penempatan'] as $gerbang) {
                    $this->dbs=$this->load->database($gerbang,TRUE);
                    $item=array(
                        'npp_no'=>$data['npp'],
                        'nama_pegawai'=>$data['petugas'],
                        'jabatan_id'=>$data['jabatan'],
                        'password'=>$data['npp'],
                        'gerbang_id'=>$gerbang,
                        'kode_tugas'=>$data['kode_tugas'],
                        'penempatan_gerbang'=> implode(',', $data['penempatan'])
                    );
        
                    $insert=$this->dbs->insert('tbl_pegawai',$item);
                }
            }

            return $hasil = array('event' => 'tambah','status'=>$insert); 
        }
        else
        {
            $this->dbp=$this->load->database($data['gerbang'],TRUE);    
            //get own penempatan_gerbang
            $old_penempatan=$this->getGerbangPenempatan($data['npp']);       
            $penempatan=explode(',',$old_penempatan[0]->penempatan_gerbang);

            $item=array(
                'npp_no'=>$data['npp'],
                'nama_pegawai'=>$data['petugas'],
                'jabatan_id'=>$data['jabatan'],
                'password'=>$data['npp'],
                'gerbang_id'=>$data['gerbang']=='default' ? '04' : $data['gerbang'],
                'kode_tugas'=>$data['kode_tugas'],
                'penempatan_gerbang'=> implode(',', $data['penempatan'])
            );

            $this->dbp->where('npp_no', $data['npp']);
            $update= $this->dbp->update('tbl_pegawai', $item);
            
            if($update)
            {               

                //clear old data from own gerbang
                foreach ($penempatan as $gerbang) {                  
                   $this->dbx=$this->load->database($gerbang,TRUE);
                   $this->dbx->where('npp_no',$data['npp']);  
                   $this->dbx->delete('tbl_pegawai');      
                }  

                //insert new One Update
                foreach ($data['penempatan'] as $gerbang) {
                    $this->dbs=$this->load->database($gerbang,TRUE);
                    $new=array(
                        'npp_no'=>$data['npp'],
                        'nama_pegawai'=>$data['petugas'],
                        'jabatan_id'=>$data['jabatan'],
                        'password'=>$data['npp'],
                        'gerbang_id'=>$gerbang,
                        'kode_tugas'=>$data['kode_tugas'],
                        'penempatan_gerbang'=> implode(',', $data['penempatan'])
                    );
        
                    $insert=$this->dbs->insert('tbl_pegawai',$new);
                } 

            }

            return $hasil = array('event' => 'update','status'=>$update); 
        }             
           
    }

    public function insertOrUpdateRencana($data)
    {   
        $jenis  = $data['jenis'];
        $this->dbp=$this->load->database($data['gerbang'],TRUE);    

        if($data['id'] == 0)
        {
            if($jenis==3)
            {
                $item=array(
                    'gerbang_id'=>$data['gerbang'],
                    'tgl_jadwal'=>$data['tgl'],
                    'shift'=>$data['shift'],
                    'pultol_id'=>$data['npp'],
                    'entry_id'=>$this->session->nppno,
                    'entry_date'=>date("Y-m-d H:i:s"),                   
                );
    
                $insert=$this->dbp->insert('tbl_rencana_pultol',$item);
                return $hasil = array('event' => 'insert','status'=>$insert); 

            }else if($jenis==2)
            {
                $item=array(
                    'gerbang_id'=>$data['gerbang'],
                    'tgl_jadwal'=>$data['tgl'],
                    'shift'=>$data['shift'],
                    'kspt_id'=>$data['npp'],
                    'entry_id'=>$this->session->nppno,
                    'entry_date'=>date("Y-m-d H:i:s"),                      
                );
    
                $insert=$this->dbp->insert('tbl_rencana_kspt',$item);
                return $hasil = array('event' => 'insert','status'=>$insert); 
            }
        }
        else
        {
            if($jenis==3)
            {
                $item=array(
                    'gerbang_id'=>$data['gerbang'],
                    'tgl_jadwal'=>$data['tgl'],
                    'shift'=>$data['shift'],
                    'pultol_id'=>$data['npp'],
                    'entry_id'=>$this->session->nppno,
                    'entry_date'=>date("Y-m-d H:i:s"),                   
                );
  
                $this->dbp->where('tgl_jadwal', $data['tgl']);
                $this->dbp->where('shift', $data['id']);
                $this->dbp->where('pultol_id', $data['npp']);

                $update=$this->dbp->update('tbl_rencana_pultol',$item);        
               
                return $hasil = array('event' => 'update','status'=>$update); 

            }else if($jenis==2)
            {
                $item=array(
                    'gerbang_id'=>$data['gerbang'],
                    'tgl_jadwal'=>$data['tgl'],
                    'shift'=>$data['shift'],
                    'kspt_id'=>$data['npp'],
                    'entry_id'=>$this->session->nppno,
                    'entry_date'=>date("Y-m-d H:i:s"),                      
                );
    
                $this->dbp->where('tgl_jadwal', $data['tgl']);
                $this->dbp->where('kspt_id', $data['npp']);
                $this->dbp->where('shift', $data['shift']);
                $update=$this->dbp->update('tbl_rencana_kspt', $item);        
               
                return $hasil = array('event' => 'update','status'=>$update); 
            }

        }
    }

    public function deleteRencanaPetugas($tgl,$gerbang,$shift,$jenis,$npp)
    {
        $this->dbp=$this->load->database($gerbang, TRUE);

        if($jenis==3)
        {
            $this->dbp->where('pultol_id', $npp);
            $this->dbp->where('shift', $shift);
            $this->dbp->where('tgl_jadwal', $tgl);
            $delete=$this->dbp->delete('tbl_rencana_pultol');
        }
        else if($jenis==2)
        {
            $this->dbp->where('kspt_id', $npp);
            $this->dbp->where('shift', $shift);
            $this->dbp->where('tgl_jadwal', $tgl);
            $delete=$this->dbp->delete('tbl_rencana_kspt');
        }

        return $delete;
    }

    public function showPetugas($id,$gerbang)
    {
        
        $this->dbp=$this->load->database($gerbang, TRUE);
        $this->dbp->select('*');
        $this->dbp->from('tbl_pegawai');
        $this->dbp->where('npp_no',$id);

        return $this->dbp->get()->result();
      
    }

    public function deletePetugas($id,$gerbang)
    {
        $old_penempatan=$this->getGerbangPenempatan($id);       
        $this->dbp=$this->load->database($gerbang, TRUE);  
        $this->dbp->where('npp_no', $id);
        $delete=$this->dbp->delete('tbl_pegawai');

        if($delete)
        {
            $penempatan=explode(',',$old_penempatan[0]->penempatan_gerbang) ;
            foreach($penempatan as $gerbang)
            {
                $this->dbs=$this->load->database($gerbang,TRUE);
                $this->dbs->where('npp_no', $id);
                $delete=$this->dbs->delete('tbl_pegawai');
            }
        }

        return $delete;
    }

    public function truncate_gerbang($gerbang)
    {
        foreach($gerbang as $data)
        {
            $this->dbp=$this->load->database($data, TRUE);  
            $this->dbp->truncate('tbl_pegawai');
        }

        return true;
    }
    
    public function syncPegawai($gerbang)
    {
        $this->dbp=$this->load->database('default', TRUE);
        $this->dbp->select('*');
        $this->dbp->from('tbl_pegawai');
        $res=$this->dbp->get()->result();

        foreach ($res as $row)
        {
            $penempatan=explode(',',$row->penempatan_gerbang);
            foreach($penempatan as $gerbang)
            {
                $this->dbs=$this->load->database($gerbang,TRUE);
                $data=array(
                    'npp_no'=>$row->npp_no,
                    'nama_pegawai'=>$row->nama_pegawai,
                    'jabatan_id'=>$row->jabatan_id,
                    'password'=>$row->password,
                    'gerbang_id'=>$gerbang,
                    'kode_tugas'=>$row->kode_tugas,
                    'penempatan_gerbang'=>$row->penempatan_gerbang
                );
                
                $insert=$this->dbs->insert('tbl_pegawai',$data);
            }

        }

        return true;

    }

    public function getGerbangPenempatan($npp)
    {
        $this->dbx=$this->load->database('default',TRUE);
        $this->dbx->select('penempatan_gerbang');
        $this->dbx->from('tbl_pegawai');
        $this->dbx->where('npp_no',$npp);

        return $this->dbx->get()->result(); 
    }

    public function deleteDataOnGerbang($npp,$db)
    {
        $this->dbx=$this->load->database($db,TRUE);
        $this->dbx->where('npp_no', $npp);        
        return $this->dbx->delete('tbl_pegawai');
    }

    public function ExistPetugas($npp)
    {
        $this->dbx=$this->load->database('default',TRUE);
        $this->dbx->select('*');
        $this->dbx->from('tbl_pegawai');
        $this->dbx->where('npp_no',$npp);

        return $this->dbx->get()->num_rows();
    }

    public function showNamaPetugasRencana($gerbang,$jenis,$tahun,$bulan)
    {
        $this->dbx=$this->load->database($gerbang,TRUE);
       
        //$this->dbx->distinct();
        $this->dbx->select('npp_no as npp,nama_pegawai as nama');
        $this->dbx->from('tbl_pegawai');
        $this->dbx->where('jabatan_id',$jenis);
        // if($jenis==2)
        // {   
            
        //     // $this->dbx->select('tbl_rencana_kspt.kspt_id as npp,tbl_pegawai.nama_pegawai as nama');
        //     // $this->dbx->from('tbl_rencana_kspt');
        //     // $this->dbx->join('tbl_pegawai', 'tbl_rencana_kspt.kspt_id = tbl_pegawai.npp_no');
        //     // $this->dbx->where(' YEAR(tbl_rencana_kspt.tgl_jadwal) ',$tahun);
        //     // $this->dbx->where(' MONTH(tbl_rencana_kspt.tgl_jadwal) ',$bulan);


        // }else
        // {   
        //     $this->dbx->select('tbl_rencana_pultol.pultol_id as npp,tbl_pegawai.nama_pegawai as nama');
        //     $this->dbx->from('tbl_rencana_pultol');
        //     $this->dbx->join('tbl_pegawai', 'tbl_rencana_pultol.pultol_id = tbl_pegawai.npp_no');
        //     $this->dbx->where(' YEAR(tbl_rencana_pultol.tgl_jadwal) ',$tahun);
        //     $this->dbx->where(' MONTH(tbl_rencana_pultol.tgl_jadwal) ',$bulan);
        // }      

        return $this->dbx->get()->result();
    }

    public function loadRencanaPetugas($gerbang,$jenis,$tahun,$bulan,$npp)
    {
        $this->dbx=$this->load->database($gerbang,TRUE);
    
        if($jenis==2)
        {   
            $this->dbx->select('tbl_rencana_kspt.*,tbl_pegawai.npp_no as npp,tbl_pegawai.nama_pegawai as nama,tbl_pegawai.jabatan_id as tipe');
            $this->dbx->from('tbl_rencana_kspt');    
            $this->dbx->join('tbl_pegawai', 'tbl_rencana_kspt.kspt_id = tbl_pegawai.npp_no');
            $this->dbx->where(' YEAR(tbl_rencana_kspt.tgl_jadwal) ',$tahun);
            $this->dbx->where(' MONTH(tbl_rencana_kspt.tgl_jadwal) ',$bulan);
            $this->dbx->where('tbl_rencana_kspt.kspt_id',$npp);

            $result =$this->dbx->get()->result_array();
            return ($result);
            
        }else if($jenis==3)
        {   
            $this->dbx->select('tbl_rencana_pultol.*,tbl_pegawai.npp_no as npp,tbl_pegawai.nama_pegawai as nama,tbl_pegawai.jabatan_id as tipe');
            $this->dbx->from('tbl_rencana_pultol');  
            $this->dbx->join('tbl_pegawai', 'tbl_rencana_pultol.pultol_id = tbl_pegawai.npp_no');
            $this->dbx->where(' YEAR(tbl_rencana_pultol.tgl_jadwal) ',$tahun);
            $this->dbx->where(' MONTH(tbl_rencana_pultol.tgl_jadwal) ',$bulan);
            $this->dbx->where('tbl_rencana_pultol.pultol_id',$npp);

            $result =$this->dbx->get()->result_array();            
            return ($result);
        }      

        
       
    }

}