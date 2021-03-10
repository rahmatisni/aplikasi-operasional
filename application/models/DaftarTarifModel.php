<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarTarifModel extends CI_Model {
    
    var $table              = 'tbl_tarif_open a';
    var $select_column      = array('a.id','a.gerbang_id','a.gol1','a.gol2','a.gol3','a.gol4','a.gol5','a.id_dasar_tarif','a.tgl_berlaku', 'b.gerbang_nama');
    var $order_column       = array('a.id','a.gerbang_id','a.gol1','a.gol2','a.gol3','a.gol4','a.gol5','a.id_dasar_tarif','a.tgl_berlaku', 'b.gerbang_nama');
 
    public function setKoneksi($database){
        parent::__construct();
        $this->dbx=$this->load->database($database,TRUE);
    }

    public function make_query()
    {
        $dbgerbang=$this->input->post('gerbang');
        
        // $this->dbx->select($this->select_column);
        // $this->dbx->from($this->table);
        // $this->dbx->where('gerbang_id',$dbgerbang);
        $this->dbx->select($this->select_column);
        $this->dbx->from($this->table);
        $this->dbx->join('tbl_gerbang b', 'a.gerbang_id = b.gerbang_id');

        $this->dbx->where('a.gerbang_id',$dbgerbang);
        

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
             $this->dbx->order_by("tgl_berlaku","DESC");
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
        $gerbang=$data['gerbang'];
        $this->dbp=$this->load->database($gerbang,TRUE);
        if($data['id'] == 0)
        {
            $item=array(
                'ruas'=>'34',
                'gol1'=>$data['totalgol1'],
                'gol1_d'=>$this->tarifConverter($data['mtngol1'],$data['jangergol1'],$data['mmsgol1'],$data['bsdgol1'],$data['csjgol1'],$data['jkcgol1']),
                'gol2'=>$data['totalgol2'],
                'gol2_d'=> $this->tarifConverter($data['mtngol2'],$data['jangergol2'],$data['mmsgol2'],$data['bsdgol2'],$data['csjgol2'],$data['jkcgol2']),
                'gol3'=>$data['totalgol3'],
                'gol3_d'=> $this->tarifConverter($data['mtngol3'],$data['jangergol3'],$data['mmsgol3'],$data['bsdgol3'],$data['csjgol3'],$data['jkcgol3']),
                'gol4'=>$data['totalgol4'],
                'gol4_d'=>$this->tarifConverter($data['mtngol4'],$data['jangergol4'],$data['mmsgol4'],$data['bsdgol4'],$data['csjgol4'],$data['jkcgol4']),
                'gol5'=>$data['totalgol5'],
                'gol5_d'=>$this->tarifConverter($data['mtngol5'],$data['jangergol5'],$data['mmsgol5'],$data['bsdgol5'],$data['csjgol5'],$data['jkcgol5']),
                'tgl_berlaku'=>$data['waktu'],
                'aktif'=>1,
                'gerbang_id'=>$data['gerbang']=='default' ? '05' : $data['gerbang'],
                'id_dasar_tarif'=>$data['dasar_tarif'],
                'tarif_inv'=>'[JM000,AST00,00000,00000,00000,00000,00000,00000,00000,00000,00000]',
                'bagi_hasil'=>'[MTN,JM-JANGER,MMS,BSD]'
            );

            $insert=$this->dbp->insert('tbl_tarif_open',$item);
            return $hasil = array('event' => 'tambah','status'=>$insert); 
        }
        else
        {
            $item=array(
                'ruas'=>'34',
                'gol1'=>$data['totalgol1'],
                'gol1_d'=>$this->tarifConverter($data['mtngol1'],$data['jangergol1'],$data['mmsgol1'],$data['bsdgol1'],$data['csjgol1'],$data['jkcgol1']),
                'gol2'=>$data['totalgol2'],
                'gol2_d'=> $this->tarifConverter($data['mtngol2'],$data['jangergol2'],$data['mmsgol2'],$data['bsdgol2'],$data['csjgol2'],$data['jkcgol2']),
                'gol3'=>$data['totalgol3'],
                'gol3_d'=> $this->tarifConverter($data['mtngol3'],$data['jangergol3'],$data['mmsgol3'],$data['bsdgol3'],$data['csjgol3'],$data['jkcgol3']),
                'gol4'=>$data['totalgol4'],
                'gol4_d'=>$this->tarifConverter($data['mtngol4'],$data['jangergol4'],$data['mmsgol4'],$data['bsdgol4'],$data['csjgol4'],$data['jkcgol4']),
                'gol5'=>$data['totalgol5'],
                'gol5_d'=>$this->tarifConverter($data['mtngol5'],$data['jangergol5'],$data['mmsgol5'],$data['bsdgol5'],$data['csjgol5'],$data['jkcgol5']),
                'tgl_berlaku'=>$data['waktu'],
                'aktif'=>1,
                'gerbang_id'=>$data['gerbang']=='default' ? '05' : $data['gerbang'],
                'id_dasar_tarif'=>$data['dasar_tarif'],
                'tarif_inv'=>'[JM000,AST00,00000,00000,00000,00000,00000,00000,00000,00000,00000]',
                'bagi_hasil'=>'[MTN,JM-JANGER,MMS,BSD]'
            );

        
            $this->dbp->where('id', $data['id']);
            $update=$this->dbp->update('tbl_tarif_open', $item); 
            return $hasil = array('event' => 'update','status'=>$update); 
        }
        
    }

    public function tarifConverter($a,$b,$c,$d,$e,$f)
    {
        $hasil='';
        $hasil .='[';
        $hasil .= $a.',';
        $hasil .= $b.',';
        $hasil .= $c.',';
        $hasil .= $d.',';
        $hasil .= $e.',';
        $hasil .= $f.',';
        $hasil .= '0,';
        $hasil .= '0,';
        $hasil .= '0,';
        $hasil .= '0';
        $hasil .=']';

        return $hasil;
    }
    

    public function showDaftarTarif($id,$gerbang)
    {
        $this->dbp=$this->load->database($gerbang, TRUE);
        $this->dbp->select('*');
        $this->dbp->from('tbl_tarif_open');
        $this->dbp->where('id',$id);

        return $this->dbp->get()->result();
      
    }

    public function deleteDaftarTarif($id,$gerbang)
    {
        $this->dbp=$this->load->database($gerbang, TRUE);  
        $this->dbp->where('id', $id);
        $delete=$this->dbp->delete('tbl_tarif_open');

        return $delete;
    }
    

    


}