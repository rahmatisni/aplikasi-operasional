<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainModel extends CI_Model {

	public function getfullgerbang()
    {		
        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_gerbang');
		$this->db->where('status','1');
		// $this->db->where('ruas_id','37');	
	
		// $this->db->where('jenis_gerbang','4');	

		$rs = $this->db->get();	  
		// return $rs->result();		
		return json_encode($rs->result());

	}
	public function getmatriksopenfull()
    {		

		$arr_gerbang_id = array();
		$arr_asal_gerbang = array();
		$arr_gol1 = array();
		$arr_gol1_d = array();
		$arr_gol2 = array();
		$arr_gol2_d = array();
		$arr_gol3 = array();
		$arr_gol3_d = array();
		$arr_gol4 = array();
		$arr_gol4_d = array();
		$arr_gol5 = array();
		$arr_gol5_d = array();
		$tgl_berlaku = array();
		$id_dasar_tarif = array();
		$arr_tarif_inv = array();
		
        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_gerbang');
		$this->db->where('status','1');
		// $this->db->where('ruas_id',37);	
		$this->db->where('jenis_gerbang','4');	

		$rs = $this->db->get();	  
		$rs = $rs->result();
		// $new_array[] = array("host"=>$rs[0]->host, "user"=>$rs[0]->user, "pass"=>$rs[0]->pass, "port"=>$rs[0]->port , "database"=>$rs[0]->database);   
		// return ($rs[0]);
		
		// return ($rs);

		for ($i = 0; $i < sizeof($rs); $i++) {
			// $new_array[] = array("host"=>$rs[$i]->host, "user"=>$rs[$i]->user, "pass"=>$rs[$i]->pass, "port"=>$rs[$i]->port , "database"=>$rs[$i]->database); 
			$servername = $rs[$i]->host;
			$username =  $rs[$i]->user;
			$password =  $rs[$i]->pass;
			$dbname =  $rs[$i]->database;
	
			$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
			if ($conn->connect_error) {
	
			}
			$sql = "SELECT * FROM tbl_tarif_open t1 WHERE tgl_berlaku = (SELECT max(tgl_berlaku) from tbl_tarif_open WHERE gerbang_id = t1.gerbang_id)";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
                // output data of each row
				while($row = $result->fetch_assoc()) {
					// echo "Gerbang: " . $row["gerbang_id"]."<br>";
					array_push($arr_gerbang_id, $row["gerbang_id"]);
					array_push($tgl_berlaku, $row["tgl_berlaku"]);   
					array_push($id_dasar_tarif, $row["id_dasar_tarif"]);                
					array_push($arr_gol1, $row["gol1"]);     
					array_push($arr_gol1_d, $row["gol1_d"]);                           
					array_push($arr_gol2, $row["gol2"]);  
					array_push($arr_gol2_d, $row["gol2_d"]);                           
					array_push($arr_gol3, $row["gol3"]);                
					array_push($arr_gol3_d, $row["gol3_d"]);                           
					array_push($arr_gol4, $row["gol4"]);
					array_push($arr_gol4_d, $row["gol4_d"]);                           
					array_push($arr_gol5, $row["gol5"]);                
					array_push($arr_gol5_d, $row["gol5_d"]);    
					array_push($arr_tarif_inv, $row["tarif_inv"]);                           				
                       				
				}
			} else {
				// echo "0 results";
			}
		}
		$conn->close();

		$new_array = array();
		for ($i = 0; $i < sizeof($arr_gerbang_id); $i++) {
			$new_array[] = array("gerbang_id"=>"$arr_gerbang_id[$i]", "Gol1"=>"$arr_gol1[$i]","Gol1_d"=>"$arr_gol1_d[$i]", "Gol2"=>"$arr_gol2[$i]","Gol2_d"=>"$arr_gol2_d[$i]", "Gol3"=>"$arr_gol3[$i]","Gol3_d"=>"$arr_gol3_d[$i]", "Gol4"=>"$arr_gol4[$i]","Gol4_d"=>"$arr_gol4_d[$i]", "Gol5"=>"$arr_gol5[$i]","Gol5_d"=>"$arr_gol5_d[$i]", "tgl"=>"$tgl_berlaku[$i]","id_tarif"=>"$id_dasar_tarif[$i]","tarif_inv"=>"$arr_tarif_inv[$i]" );   
		}
		return ($new_array);
	}

	public function getmatriksclosefull()
    {		

		$arr_gerbang_id = array();
		$arr_asal_gerbang = array();
		$arr_gol1 = array();
		$arr_gol2 = array();
		$arr_gol3 = array();
		$arr_gol4 = array();
		$arr_gol5 = array();
		$arr_gol1d = array();
		$arr_gol2d = array();
		$arr_gol3d = array();
		$arr_gol4d = array();
		$arr_gol5d = array();
		$arr_jenis = array();
		$tgl_berlaku = array();
		$id_dasar_tarif = array();
		$tarif_inv = array();

        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_gerbang');
		$jeniss = ['1','3'];
		$this->db->where_in('jenis_Gerbang',$jeniss);
		$this->db->where('ruas_id',40);
		// kode ruas
		$this->db->where('status',1);


		// $this->db->where_in('jenis_gerbang',$jenis_gerbang);	

		$rs = $this->db->get();	  
		$rs = $rs->result();
		// $new_array[] = array("host"=>$rs[0]->host, "user"=>$rs[0]->user, "pass"=>$rs[0]->pass, "port"=>$rs[0]->port , "database"=>$rs[0]->database);   
		// return ($rs[0]);
		
		// return ($rs);

		for ($i = 0; $i < sizeof($rs); $i++) {
			// $new_array[] = array("host"=>$rs[$i]->host, "user"=>$rs[$i]->user, "pass"=>$rs[$i]->pass, "port"=>$rs[$i]->port , "database"=>$rs[$i]->database); 
			$servername = $rs[$i]->host;
			$username =  $rs[$i]->user;
			$password =  $rs[$i]->pass;
			$dbname =  $rs[$i]->database;
			$gerbang_id =  $rs[$i]->gerbang_id;

			$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
			if ($conn->connect_error) {
	
			}
			// $sql = "SELECT * FROM tbl_tarif_exit t1 WHERE tgl_berlaku = (SELECT max(tgl_berlaku) from tbl_tarif_exit WHERE gerbang_id = t1.gerbang_id) AND gerbang_id = $gerbang_id AND jenis NOT LIKE 'KHL'";
			
			$sql = "SELECT d.* FROM (SELECT asal_gerbang, Max(tgl_berlaku) as MaxDate FROM tbl_tarif_exit where gerbang_id = $gerbang_id AND jenis NOT LIKE ('KHL')GROUP BY asal_gerbang) r  INNER JOIN tbl_tarif_exit d on d.asal_gerbang = r.asal_gerbang and d.tgl_berlaku = r.MaxDate AND gerbang_id = $gerbang_id ORDER by r.asal_gerbang";

			$result = $conn->query($sql);
			if ($result) {
                // output data of each row
				while($row = $result->fetch_assoc()) {
					// echo "Gerbang: " . $row["gerbang_id"]."<br>";
					array_push($arr_asal_gerbang, $row["asal_gerbang"]);
					array_push($arr_gerbang_id, $row["gerbang_id"]);
					array_push($tgl_berlaku, $row["tgl_berlaku"]);   
					array_push($id_dasar_tarif, $row["id_dasar_tarif"]);     
					array_push($arr_jenis, $row["jenis"]);                           
					array_push($arr_gol1, $row["gol1"]);                
					array_push($arr_gol2, $row["gol2"]);                
					array_push($arr_gol3, $row["gol3"]);                
					array_push($arr_gol4, $row["gol4"]);
					array_push($arr_gol5, $row["gol5"]);    
					array_push($arr_gol1d, $row["gol1_d"]);                
					array_push($arr_gol2d, $row["gol2_d"]);                
					array_push($arr_gol3d, $row["gol3_d"]);                
					array_push($arr_gol4d, $row["gol4_d"]);
					array_push($arr_gol5d, $row["gol5_d"]);   
					array_push($tarif_inv, $row["tarif_inv"]);             
          
				}
			} else {
				// echo "0 results";
			}
		}
		$conn->close();

		$new_array = array();
		for ($i = 0; $i < sizeof($arr_gerbang_id); $i++) {
			$new_array[] = array("gerbang_id"=>"$arr_gerbang_id[$i]", "jenis"=>"$arr_jenis[$i]", "asal_gerbang"=>"$arr_asal_gerbang[$i]", "Gol1"=>"$arr_gol1[$i]", "Gol2"=>"$arr_gol2[$i]", "Gol3"=>"$arr_gol3[$i]", "Gol4"=>"$arr_gol4[$i]", "Gol5"=>"$arr_gol5[$i]", "tgl"=>"$tgl_berlaku[$i]","id_tarif"=>"$id_dasar_tarif[$i]","Gol1_d"=>"$arr_gol1d[$i]", "Gol2_d"=>"$arr_gol2d[$i]", "Gol3_d"=>"$arr_gol3d[$i]", "Gol4_d"=>"$arr_gol4d[$i]", "Gol5_d"=>"$arr_gol5d[$i]", "tarif_inv"=>"$tarif_inv[$i]");   
		}
		// return ($rs);

		return ($new_array);
	}



	public function getnamanyagerbang()
    {		
        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_gerbang');
		
		$rs = $this->db->get();	  
		return json_encode($rs->result());

	}

	public function getnamanyagerbangmclose()
    {		
        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_gerbang');
		// $this->db->where_in('jenis_gerbang',['1','2','4']);

		$rs = $this->db->get();	  
		return json_encode($rs->result());

	}

	public function getnamanyagerbangarray()
    {		
        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_gerbang');
		$rs = $this->db->get();	  
		return $rs->result();		

	}

    public function getOptionGerbang()
    {		
        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_gerbang');
		$this->db->where('status','1');		
		$rs = $this->db->get();	  
		return $rs->result();		
	}

	public function getOptionGerbangTarif()
    {		
        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_gerbang');
		$this->db->where('status','1');
		// kode ruas

		// $this->db->where('ruas_id','40');		
		
		$rs = $this->db->get();	  
		return $rs->result();		
	}

	public function getOptionShift()
    {		
        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_shift');
		$this->db->where('nm_shift !=','-');	
		$rs = $this->db->get();	  
		return $rs->result();		
	}

	public function getOptionGerbangExit()
    {		
        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_gerbang');
		$this->db->where('status','1');	
		// $this->db->where('ruas_id','37');	
	
		$rs = $this->db->get();	  
		return $rs->result();		
	}
	
	
	public function getOptionGerbangPCS()
    {		
        $this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_gerbang');
		$this->db->where('status','1');
		$rs = $this->db->get();	  
		return $rs->result();		
	}


	public function getOptionDasarTarif($gerbang)
	{
		$this->dbx=$this->load->database($gerbang,TRUE);
		$this->dbx->select('*');
		$this->dbx->from('tbl_dasar_tarif');
		$rs = $this->dbx->get();	  
		return $rs->result();		
	}

	public function getFilterMatriksOpen($db)
	{
		$this->dbx=$this->load->database($db,TRUE);
		$this->dbx->select('*');
		$this->dbx->from('tbl_tarif_open');
		$rs = $this->dbx->get();	  
		return $rs->result();		
	}

	public function getFilterMatriksClose($db)
	{
		$this->dbx=$this->load->database($db,TRUE);
		$this->dbx->select('*');
		$this->dbx->from('tbl_tarif_exit');
		$this->dbx->where('gerbang_id',$db);
		$this->dbx->not_like('asal_gerbang','99');
		$this->dbx->order_by('gerbang_id',"ASC");

		$rs = $this->dbx->get();	  
		return $rs->result();		
	}



	public function getOptionDasarTarifOption($gerbang)
	{
		$this->dbx=$this->load->database($gerbang,TRUE);
		$this->dbx->select('*');
		$this->dbx->from('tbl_dasar_tarif');
		$rs = $this->dbx->get();	  
		return $rs->result();		
	}

	public function getOptionNama($gerbang)
	{
		$this->dbx=$this->load->database($gerbang,TRUE);
		$this->dbx->select('*');
		$this->dbx->from('tbl_penerbitan_kartu');
		$rs = $this->dbx->get();	  
		return $rs->result();		
	}

	public function getOptionKSPT($gerbang)
	{
		$this->dbx=$this->load->database($gerbang,TRUE);
		$this->dbx->select('*');
		$this->dbx->from('tbl_pegawai');
		$this->dbx->where('jabatan_id','2');
		$rs = $this->dbx->get();	  
		return $rs->result();		
	}

	public function getOptionPLT($gerbang)
	{
		$this->dbx=$this->load->database($gerbang,TRUE);
		$this->dbx->select('*');
		$this->dbx->from('tbl_pegawai');
		//$this->dbx->where('jabatan_id','3');
		$rs = $this->dbx->get();	  
		return $rs->result();		
	}

	public function getLokasiGerbang()
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('tbl_lokasi_gerbang');
		$rs = $this->db->get();	  
		return $rs->result();		
	}



	
}