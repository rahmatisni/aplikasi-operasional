<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlacklistModel extends CI_Model {
    
    var $table              = 'pcs_blacklist';
    var $select_column      = array('id','uuid','info','tick');
    var $order_column       = array('id','uuid','info','tick');
 
    public function setKoneksi($database){
        parent::__construct();
        $this->dbx=$this->load->database("pcs".$database,TRUE);
        $this->dbl=$this->load->database($database,TRUE);
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
             $this->dbx->order_by("id","ASC");
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

    public function join()
    {
        $this->dbx=$this->load->database("pcs06",TRUE);
        return $this->dbx->query("select a.uuid,b.* from mtn_pcs_06.pcs_blacklist a left join mtn_lattol_06.tbl_penerbitan_kartu b on a.uuid=b.ktp_id")->result();
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
        $gerbang="pcs".$data['gerbang'];
        $this->dbp=$this->load->database($gerbang,TRUE);
        if($data['id'] == 0)
        {
            $item=array(
                'uuid'=>$data['uuid'],
                'tick'=>$data['tick'],
                'info'=>$data['info']
            );

            $insert=$this->dbp->insert('pcs_blacklist',$item);
            return $hasil = array('event' => 'tambah','status'=>$insert); 
        }
        else
        {
            $item=array(
                    'uuid'=>$data['uuid'],
                    'tick'=>$data['tick'],
                    'info'=>$data['info']
            );
        
            $this->dbp->where('id', $data['id']);
            $update=$this->dbp->update('pcs_blacklist', $item); 
            return $hasil = array('event' => 'update','status'=>$update); 
        }
        
    }

    public function showBlacklist($id,$gerbang)
    {
        $gerbang="pcs".$gerbang;
        $this->dbp=$this->load->database($gerbang, TRUE);
        $this->dbp->select('*');
        $this->dbp->from('pcs_blacklist');
        $this->dbp->where('id',$id);

        return $this->dbp->get()->result();
      
    }

    public function deleteBlacklist($id,$gerbang)
    {
        $gerbang="pcs".$gerbang;
        $this->dbp=$this->load->database($gerbang, TRUE);  
        $this->dbp->where('id', $id);
        $delete=$this->dbp->delete('pcs_blacklist');

        return $delete;
    }
    

    


}