<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DurasiTarifModel extends CI_Model
{

    var $table              = 'tbl_durasi';
    var $select_column      = array('gerbang_id', 'asal_gerbang', 'durasi');
    var $order_column      = array('gerbang_id', 'asal_gerbang', 'durasi');

    public function setKoneksi($database)
    {
        parent::__construct();
        $this->dbx = $this->load->database($database, TRUE);
    }

    public function make_query()
    {
        $dbgerbang = $this->input->post('gerbang');

        $this->dbx->select($this->select_column);
        $this->dbx->from($this->table);
        $this->dbx->where('gerbang_id', $dbgerbang);


        $i = 0;

        foreach ($this->select_column as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->dbx->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->dbx->like($item, $_POST['search']['value']);
                } else {
                    $this->dbx->or_like($item, $_POST['search']['value']);
                }

                if (count($this->select_column) - 1 == $i) //last loop
                    $this->dbx->group_end(); //close bracket
            }

            $i++;
        }


        if (isset($_POST["order"])) {
            $this->dbx->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            //  $this->dbx->order_by("mulai_berlaku","DESC");
        }
    }

    public function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->dbx->limit($_POST['length'], $_POST['start']);
        }
        $query =  $this->dbx->get();
        return $query->result();
    }

    public function get_filtered_data()
    {
        $this->make_query();
        $query = $this->dbx->get();
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
        $gerbang = $data['gerbang_id'];
        // $this->dbp = $this->load->database($gerbang, TRUE);
        // $this->make_query();
        // $query = $this->dbp->get();
        $this->dbp = $this->load->database($gerbang, TRUE);

        // if ($data['gerbang_id'] == 0) {
        $item = array(
            'gerbang_id' => $data['gerbang_id'],
            'asal_gerbang' => $data['asal_gerbang'],
            'durasi' => $data['durasi']
        );

        $insert = $this->dbp->replace('tbl_durasi', $item);
        return $hasil = array('event' => 'tambah', 'status' => $insert);
        // } else {
        //     $item = array(
        //         'gerbang_id' => $data['gerbang_id'],
        //         'asal_gerbang' => $data['asal_gerbang'],
        //         'durasi' => $data['durasi']
        //     );

        //     $this->dbp->where('gerbang_id', $data['gerbang_id']);
        //     $update = $this->dbp->update('tbl_dasar_tarif', $item);
        //     return $hasil = array('event' => 'update', 'status' => $update);
        // }
    }

    public function deleteDurasiTarif($data)
    {
        $gerbang_id = $data['gerbang_id'];
        $asal_gerbang = $data['asal_gerbang'];

        $this->dbp = $this->load->database($gerbang_id, TRUE);
        $this->dbp->where('asal_gerbang', $asal_gerbang);
        $this->dbp->where('gerbang_id', $gerbang_id);

        $delete = $this->dbp->delete('tbl_durasi');

        return $delete;
    }

    public function getOptionGerbang()
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('tbl_gerbang');
        // $this->db->where('ruas_id','37');  
        $this->db->where('status', '1');
        // $jenisgerbang = ['1','3'];
        // $this->db->where_in('jenis_gerbang',$jenisgerbang);


        $rs = $this->db->get();
        return $rs->result();
    }

    public function getOptionGerbangTarif()
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('tbl_gerbang');
        // $this->db->where('ruas_id','37');  
        $this->db->where('status', '1');
        // $jenisgerbang = ['1','3'];
        // $this->db->where_in('jenis_gerbang',$jenisgerbang);


        $rs = $this->db->get();
        return $rs->result();
    }

    public function getOptionGerbangModal()
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('tbl_gerbang');
        // $this->db->where('ruas_id',37);
        // $this->db->where('status', '1');
        $this->db->not_like('jenis_gerbang','3');
        $this->db->not_like('jenis_gerbang','0');


        $rs = $this->db->get();
        return $rs->result();
    }
}
