<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PetugasModel', 'petugas');
		$this->load->model('LihatPetugasModel', 'lihatpetugas');
		$this->load->model('BlacklistModel', 'blacklist');
		$this->load->model('DasarTarifModel', 'dasartarif');
		$this->load->model('DaftarTarifModel', 'daftartarif');
		$this->load->model('DaftarTarifCloseModel', 'daftartarifclose');
		$this->load->model('LogModel', 'logmodel');
		$this->load->model('LogActivityModel', 'logActivity');
		$this->load->model('PenerbitanKartuModel', 'kartumodel');
		$this->load->model('MainModel', 'model');
		$this->load->model('DurasiTarifModel', 'durasitarif');
	}

	public function index()
	{
		if ($this->session->status == "logged") {
			$this->dashboard();
		} else {
			redirect(base_url("auth"));
		}
	}



	public function matriks_tarif_close()
	{
		$data['fullgerbang'] = $this->model->getfullgerbang();
		$data['namanyagerbang'] = $this->model->getnamanyagerbangmclose();
		$data['fullgerbang3'] = $this->model->getmatriksclosefull();

		$this->render_page('page/matriks_tarif_close', $data);
	}
	// public function matriks_tarif_close2()
	// {
	// 	$data['fullgerbang']=$this->model->getfullgerbang();
	// 	$data['namanyagerbang']=$this->model->getnamanyagerbang();
	// 	$data['fullgerbang3']=$this->model->getmatriksclosefull();

	// 	$this->render_page('page/matriks_tarif_close2',$data);
	// }

	public function matriks_tarif_open()
	{
		$data['fullgerbang'] = $this->model->getfullgerbang();
		$data['namanyagerbang'] = $this->model->getnamanyagerbang();
		$data['fullgerbang2'] = $this->model->getmatriksopenfull();
		// $data['fullgerbang2']="asd";


		$this->render_page('page/matriks_tarif_open', $data);
	}


	public function matriks_tarif_open_f()
	{
		$data['meneng'] = $this->input->post('inputopen');
		// $db='07';
		$db = $this->input->post('inputopen');
		$data['namanyagerbang'] = $this->model->getnamanyagerbang();
		$data['fullgerbang'] = $this->model->getfullgerbang();
		$data['GerbangOption'] = $this->model->getOptionGerbangTarif();
		$data['matriksopenf'] = $this->model->getFilterMatriksOpen($db);

		$this->render_page('page/matriks_tarif_open_f', $data);
	}

	public function matriks_tarif_close_f()
	{
		$data['meneng'] = $this->input->post('inputclose');
		// $db='07';
		$db = $this->input->post('inputclose');
		$data['namanyagerbang'] = $this->model->getnamanyagerbang();
		$data['fullgerbang'] = $this->model->getfullgerbang();
		$data['GerbangOption'] = $this->model->getOptionGerbangTarif();
		$data['matriksclosef'] = $this->model->getFilterMatriksClose($db);

		$this->render_page('page/matriks_tarif_close_f', $data);
	}

	public function rokok()
	{
		//$db='06';
		//$this->blacklist->setKoneksi($db);
		$list = $this->blacklist->join();

		var_dump($list);
	}

	public function petugas()
	{
		$data['GerbangOption'] = $this->model->getOptionGerbang();
		$this->render_page('page/petugas', $data);
	}

	public function lihat_petugas()
	{
		$data['GerbangOption'] = $this->model->getOptionGerbang();
		$this->render_page('page/lihat_petugas', $data);
	}

	public function log()
	{
		$data['GerbangOption'] = $this->model->getOptionGerbang();
		$this->render_page('page/log', $data);
	}

	public function dasar_tarif()
	{
		$data['GerbangOption'] = $this->model->getOptionGerbang();
		$this->render_page('page/dasar_tarif', $data);
	}


	public function durasi_tarif()
	{
		$data['GerbangOption'] = $this->durasitarif->getOptionGerbang();
		$data['GerbangOptionModal'] = $this->durasitarif->getOptionGerbangModal();

		$this->render_page('page/durasi_tarif', $data);
	}


	public function daftar_tarif()
	{
		$data['GerbangOption'] = $this->model->getOptionGerbangTarif();

		$this->render_page('page/daftar_tarif', $data);
	}

	public function dashboard()
	{
		$data['GerbangLokasi'] = $this->model->getLokasiGerbang();
		$this->render_page('page/dashboard', $data);
	}

	public function kartu_operasional()
	{
		$data['GerbangOption'] = $this->model->getOptionGerbang();
		$this->render_page('page/kartu_operasional', $data);
	}


	public function kartu_dinas()
	{
		$data['GerbangOption'] = $this->model->getOptionGerbang();
		$this->render_page('page/kartu_dinas', $data);
	}

	public function perpanjangan()
	{
		$data['GerbangOption'] = $this->model->getOptionGerbang();
		$this->render_page('page/perpanjangan_kartu_dinas', $data);
	}

	public function rencana_petugas()
	{
		$data['GerbangOption']=$this->model->getOptionGerbang();
		$data['ShiftOption']=$this->model->getOptionShift();
		$this->render_page('page/rencana_petugas',$data);
	}

	public function jadwal_gerbang()
	{
		$data['GerbangOption']=$this->model->getOptionGerbang();
		$data['ShiftOption']=$this->model->getOptionShift();
		$this->render_page('page/jadwal_gerbang',$data);
	}
	
	public function penerbitan_kartu()
	{
		$data['GerbangOption'] = $this->model->getOptionGerbang();
		$this->render_page('page/penerbitan_kartu', $data);
	}

	public function showDasarTarifOption()
	{
		$db = $this->input->post('gerbang');
		$data = $this->model->getOptionDasarTarifOption($db);

		echo json_encode($data);
	}

	public function showNamaOption()
	{
		$db = $this->input->post('gerbang');
		$data = $this->model->getOptionNama($db);

		echo json_encode($data);
	}

	public function showKSPTOption()
	{
		$db = $this->input->post('gerbang');
		$data = $this->model->getOptionKSPT($db);

		echo json_encode($data);
	}

	public function showPLTOption()
	{
		$db = $this->input->post('gerbang');
		$data = $this->model->getOptionPLT($db);

		echo json_encode($data);
	}

	public function blacklist()
	{
		$data['GerbangOption'] = $this->model->getOptionGerbang();
		$this->render_page('page/blacklist', $data);
	}

	////// PETUGAS
	public function ajax_list_petugas()
	{
		$db = $this->input->post('gerbang');
		$this->petugas->setKoneksi($db);
		$list = $this->petugas->make_datatables();

		$data = array();
		$no = 0;

		foreach ($list as $item) {
			
			$button = '<btn onclick="btnEditPetugasModal(`' . $item->npp_no . '`)" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></btn>';
			$button .= '&nbsp;';
			$button .= '<btn onclick="btnDeletePetugas(`' . $item->npp_no . '`)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></btn>';

			switch ($item->jabatan_id) {
				case 0:
					$jabatan = 'MA';
					break;
				case 1:
					$jabatan = 'KBT';
					break;
				case 2:
					$jabatan = 'KSPT';
					break;
				case 3:
					$jabatan = 'PLT';
					break;
				case 4:
					$jabatan = 'TEKNISI';
					break;
				default:
					$jabatan = 'UNKNOWNN';
					break;
			}

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $item->npp_no;
			$row[] = $item->nama_pegawai;
			$row[] = 'Operasional';
			$row[] = $jabatan;
			$row[] = $item->kode_tugas;
			$row[] = $this->GerbangAlias($item->penempatan_gerbang);
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->petugas->get_all_data(),
			"recordsFiltered" => $this->petugas->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function addEditPetugas()
	{
		$post['id']				= $this->input->post('id');
		//$post['gerbang']		= $this->input->post('gerbangmodal');
		$post['gerbang']		= 'default';
		$post['petugas']		= $this->input->post('petugas');
		$post['npp']			= $this->input->post('npp');
		$post['jabatan']		= $this->input->post('jabatanModal');
		$post['kode_tugas']		= $this->input->post('kode_tugas');
		$post['penempatan']		= $this->input->post('penempatan');

		$insertOrUpdate = $this->petugas->insertOrUpdate($post);
		// if($this->input->post('id')==0)	
		// {
		// 	$this->logActivity->make_log(1,'add',$this->input->post('npp'),$this->input->post('gerbangmodal')=='default' ? '4':$this->input->post('gerbangmodal'));
		// }else
		// {
		// 	$this->logActivity->make_log(1,'update',$this->input->post('npp'),$this->input->post('gerbangmodal')=='default'? '4':$this->input->post('gerbangmodal'));
		// }		
		echo json_encode($insertOrUpdate);
	}
	

	public function addEditRencanaPetugas()
	{
		$post['id']				= $this->input->post('id');
		$post['gerbang']		= $this->input->post('mgerbang');	
		$post['npp']			= $this->input->post('mnpp');
		$post['tgl']			= $this->input->post('mtgl');
		$post['shift']			= $this->input->post('mshift');
		$post['jenis']			= $this->input->post('mjenis');
		
		$insertOrUpdate=$this->petugas->insertOrUpdateRencana($post);	

		echo json_encode($insertOrUpdate);	
	}
	

	public function showPetugas()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$select		= $this->petugas->showPetugas($id, $gerbang);
		echo json_encode($select);
	}

	public function loadRencanaPetugas()
	{
		$tahun		= $this->input->post('tahun');
		$gerbang	= $this->input->post('gerbang');
		$bulan		= $this->input->post('bulan');
		$jenis		= $this->input->post('jenis');
		$npp		= $this->input->post('npp');

		$select		= $this->petugas->loadRencanaPetugas($gerbang,$jenis,$tahun,$bulan,$npp);
		
		$data = array();

		foreach($select as $row)
		{
			
			$data[] = array(
			'id'   	=> $row["id_jadwal"],
			//'title' => $this->getTipeJabatan($row["tipe"]).' / '.$row["npp"].' / '.$row["nama"].' /  Shift '.$row["shift"],
			'title' => $row["shift"],
			'start' => $row["tgl_jadwal"],
			'end'   => $row["tgl_jadwal"]
			);
		}

		echo json_encode($data);

	}

	public function getNamaShift($shift)
	{
		$hasil="";
		switch($shift)
		{
			case '1' :
				$hasil='Shift 1';
				break;
			case '2' :
				$hasil='Shift 1';
				break;
			case '3' :
				$hasil='Shift 1';
				break;
			case '4' :
				$hasil='Libur';
				break;
			case '0' :
				$hasil='Cuti';
				break;
			default: 
				$hasil= 'Unknown';
				break;
		}
		return $hasil;
	}

	public function getTipeJabatan($i)
	{
		$hasil='';
		switch($i)
		{
			case '1' :
				$hasil='KBT';
				break;
			case '2' :
				$hasil='KSPT';
				break;
			case '3' :
				$hasil='PLT';
				break;
			case '4' :
				$hasil='MA';
				break;
			default: 
				$hasil= 'Unknown';
				break;
		}

		return $hasil;
	}

	public function showNamaPetugasRencana()
	{
		$tahun		= $this->input->post('tahun');
		$gerbang	= $this->input->post('gerbang');
		$bulan		= $this->input->post('bulan');
		$jenis		= $this->input->post('jenis');
		
		$select		= $this->petugas->showNamaPetugasRencana($gerbang,$jenis,$tahun,$bulan);
		
		echo json_encode($select);
	}

	public function deleteRencanaPetugas()
	{
		$tgl		= $this->input->post('tgl');
		$gerbang	= $this->input->post('gerbang');
		$shift		= $this->input->post('shift');
		$jenis		= $this->input->post('jenis');
		$npp		= $this->input->post('npp');

		$delete		= $this->petugas->deleteRencanaPetugas($tgl,$gerbang,$shift,$jenis,$npp);
		
		echo json_encode($delete);
	}

	public function deletePetugas()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$delete		= $this->petugas->deletePetugas($id, $gerbang);
		$this->logActivity->make_log(1, 'delete', $this->input->post('id'), $this->input->post('gerbang') == 'default' ? '4' : $this->input->post('gerbang'));
		echo json_encode($delete);
	}

	public function syncPetugas()
	{
		$gerbang	= $this->input->post('gerbang');
		$gr 		= array();

		for($a=0;$a<count($gerbang);$a++)
		{
			array_push($gr,$gerbang[$a]['gerbang_id']);
		}

		//truncate all gerbang
		$truncate_gerbang=$this->petugas->truncate_gerbang($gr);
		//insert step by step
		$sync_pegawai=$this->petugas->syncPegawai($gr);

		echo json_encode($truncate_gerbang);
	}

	public function petugasExist()
	{
		$npp		= $this->input->post('npp');
		$select		= $this->petugas->ExistPetugas($npp);
		echo json_encode($select);
	}

	public function GerbangAlias($data)
	{
		$hasil = "";
		$file = explode(",", $data);

		$i = 0;
		$len = count($file);
		foreach ($file as $item) {
			$hasil .= $this->switchNameGerbang($item);
			// if ($i != $len - 1) {
			// 	$hasil.=',';
			// }		
			$i++;
		}

		return $hasil;
	}
	////// PETUGAS

	public function switchNameGerbang($id)
	{
		$gerbang = "";
		switch ($id) {
			case '01':
				$gerbang = '<span style="background-color:blue;" class="badge">KUNCIRAN 3</span>';
				break;
			case '02':
				$gerbang = '<span style="background-color:blue;" class="badge">KUNCIRAN 4</span>';
				break;
			case '03':
				$gerbang = '<span style="background-color:blue;" class="badge">KUNCIRAN 5</span>';
				break;
			case '04':
				$gerbang = '<span style="background-color:blue;" class="badge">JELUPANG</span>';
				break;
			case '05':
				$gerbang = '<span style="background-color:blue;" class="badge">PARIGI</span>';
				break;
			case '06':
				$gerbang = '<span style="background-color:blue;" class="badge">SERPONG 1</span>';
				break;
			case '07':
				$gerbang = '<span style="background-color:blue;" class="badge">SERPONG 2</span>';
				break;
			case '08':
				$gerbang = '<span style="background-color:blue;" class="badge">SERPONG 3</span>';
				break;
			case '09':
				$gerbang = '<span style="background-color:blue;" class="badge">SERPONG 4</span>';
				break;
			case '11':
				$gerbang = '<span style="background-color:blue;" class="badge">HUSEIN SASTRA NEGARA</span>';
				break;
			case '12':
				$gerbang = '<span style="background-color:blue;" class="badge">TANAH TINGGI 1</span>';
				break;
			case '13':
				$gerbang = '<span style="background-color:blue;" class="badge">TANAH TINGGI 2</span>';
				break;
			case '14':
				$gerbang = '<span style="background-color:blue;" class="badge">BUARAN 1</span>';
				break;
			case '15':
				$gerbang = '<span style="background-color:blue;" class="badge">BUARAN 2</span>';
				break;
			case '16':
				$gerbang = '<span style="background-color:blue;" class="badge">TIRTAYASA 1</span>';
				break;
			case '17':
				$gerbang = '<span style="background-color:blue;" class="badge">TIRTAYASA 2</span>';
				break;
			case '18':
				$gerbang = '<span style="background-color:blue;" class="badge">TIRTAYASA 3</span>';
				break;
			case '19':
				$gerbang = '<span style="background-color:blue;" class="badge">TIRTAYASA 4</span>';
				break;
			case '20':
				$gerbang = '<span style="background-color:blue;" class="badge">KUNCIRAN 6</span>';
				break;
			case '21':
				$gerbang = '<span style="background-color:blue;" class="badge">KUNCIRAN 7</span>';
				break;
			case '22':
				$gerbang = '<span style="background-color:blue;" class="badge">KUNCIRAN 8</span>';
				break;
			case '31':
				$gerbang = '<span style="background-color:blue;" class="badge">SERPONG 5</span>';
				break;
			case '32':
				$gerbang = '<span style="background-color:blue;" class="badge">SERPONG 6</span>';
				break;
			case '33':
				$gerbang = '<span style="background-color:blue;" class="badge">SERPONG 7</span>';
				break;
			case '34':
				$gerbang='<span style="background-color:blue;" class="badge">PAMULANG</span>';
			break;
			case '35':
				$gerbang = '<span style="background-color:blue;" class="badge">KEMIRI</span>';
				break;
			case '36':
				$gerbang = '<span style="background-color:blue;" class="badge">PALARAYA</span>';
				break;
			default:
				$gerbang = '<span style="background-color:blue;" class="badge">UNKNOWN</span>';
				break;
		}

		return $gerbang;
	}

	////// LIHAT PETUGAS
	public function ajax_list_lihat_petugas()
	{
		$db = $this->input->post('gerbang');
		$this->lihatpetugas->setKoneksi($db);
		$list = $this->lihatpetugas->make_datatables();

		$data = array();
		$no = 0;

		foreach ($list as $item) {
					
			switch($item->jabatan_id)
			{
				case 4 :
					$jabatan='TEKNISI';
				break;
				case 1 :
					$jabatan='KBT';
				break;
				case 2 :
					$jabatan='KSPT';
				break;
				case 3 :
					$jabatan='PLT';
				break;
				case 0 :
					$jabatan='MA';
				break;
				default  :
					$jabatan='UNKNOWNN';
				break;
			}

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $item->npp_no;
			$row[] = $item->nama_pegawai;
			$row[] = $this->gerbangName($item->gerbang_id);
			$row[] = $jabatan;
			$row[] = $item->kode_tugas;
			$row[] = $this->GerbangAlias($item->penempatan_gerbang);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->lihatpetugas->get_all_data(),
			"recordsFiltered" => $this->lihatpetugas->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}


	////// LIHAT PETUGAS

	////// BLACKLIST
	public function ajax_list_blacklist()
	{
		$db = $this->input->post('gerbang');
		$this->blacklist->setKoneksi($db);
		$list = $this->blacklist->make_datatables();

		$data = array();
		$no = 0;


		foreach ($list as $item) {

			$button = '<btn onclick="btnEditblacklistModal(`' . $item->id . '`)" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></btn>';
			$button .= '&nbsp;';
			$button .= '<btn onclick="btnDeleteblacklist(`' . $item->id . '`)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></btn>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $item->uuid;
			$row[] = $item->info;
			$row[] = $item->tick;
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->blacklist->get_all_data(),
			"recordsFiltered" => $this->blacklist->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function addEditBlacklist()
	{
		$post['id']				= $this->input->post('id');
		$post['uuid']			= $this->input->post('uuid');
		$post['tick']			= $this->input->post('tick');
		$post['info']			= $this->input->post('info');
		$post['gerbang']		= $this->input->post('gerbangmodal');

		$insertOrUpdate = $this->blacklist->insertOrUpdate($post);
		if ($this->input->post('id') == 0) {
			$this->logActivity->make_log(5, 'add', $this->input->post('uuid'), $this->input->post('gerbangmodal') == 'default' ? '4' : $this->input->post('gerbangmodal'));
		} else {
			$this->logActivity->make_log(5, 'update', $this->input->post('uuid'), $this->input->post('gerbangmodal') == 'default' ? '4' : $this->input->post('gerbangmodal'));
		}
		echo json_encode($insertOrUpdate);
	}

	public function showBlacklist()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$select		= $this->blacklist->showBlacklist($id, $gerbang);
		echo json_encode($select);
	}

	public function deleteBlacklist()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$delete		= $this->blacklist->deleteBlacklist($id, $gerbang);
		$this->logActivity->make_log(5, 'delete', $this->input->post('id'), $this->input->post('gerbang') == 'default' ? '4' : $this->input->post('gerbang'));
		echo json_encode($delete);
	}

	////// BLACKLIST

	////// DASAR TARIF
	public function ajax_list_dasartarif()
	{
		$db = $this->input->post('gerbang');
		$this->dasartarif->setKoneksi($db);
		$list = $this->dasartarif->make_datatables();

		$data = array();
		$no = 0;


		foreach ($list as $item) {

			$button = '<btn onclick="btnEditDasarTarifModal(`' . $item->id_dasar_tarif . '`)" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></btn>';
			$button .= '&nbsp;';
			$button .= '<btn onclick="btnDeleteDasarTarif(`' . $item->id_dasar_tarif . '`)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></btn>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $item->versi_tarif;
			$row[] = $item->dasar_tarif;
			$row[] = $item->mulai_berlaku;
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dasartarif->get_all_data(),
			"recordsFiltered" => $this->dasartarif->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}


	///durasi tarif
	public function ajax_list_durasitarif()
	{
		$db = $this->input->post('gerbang');
		$this->durasitarif->setKoneksi($db);
		$list = $this->durasitarif->make_datatables();

		$data = array();
		$no = 0;


		foreach ($list as $item) {

			// $button = '&nbsp;';
			// $button ='<btn onclick="btnEditDasarTarifModal(`'.$item->id_dasar_tarif.'`)" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></btn>';
			// $button .='&nbsp;';
			$button = '<btn onclick="btnDeleteDurasiTarif(`' . $item->asal_gerbang . '`)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></btn>';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $this->gerbangName($item->asal_gerbang);
			$row[] = $this->gerbangName($item->gerbang_id);
			// $row[] = $item->gerbang_id;
			$row[] = $item->durasi;
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->durasitarif->get_all_data(),
			"recordsFiltered" => $this->durasitarif->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}
	
	public function addEditDurasiTarif()
	{

		$post['gerbang_id']		= $this->input->post('gerbangidmodal');
		$post['asal_gerbang']	= $this->input->post('asalgerbangidmodal');
		$post['durasi']			= $this->input->post('durasimodal');

		$insertOrUpdate = $this->durasitarif->insertOrUpdate($post);
		echo json_encode($insertOrUpdate);
	}

	public function deleteDurasiTarif()
	{
		$post['gerbang_id']		= $this->input->post('gerbang_id');
		$post['asal_gerbang']	= $this->input->post('asal_gerbang');
		$delete		= $this->durasitarif->deleteDurasiTarif($post);
		echo json_encode($delete);
	}

// dasartarif


	public function addEditDasarTarif()
	{
		$post['id']						= $this->input->post('id');
		$post['versi_tarif']			= $this->input->post('versi');
		$post['dasar_tarif']			= $this->input->post('sk');
		$post['mulai_berlaku']			= $this->input->post('waktu');
		$post['gerbang']				= $this->input->post('gerbangmodal');

		$insertOrUpdate = $this->dasartarif->insertOrUpdate($post);
		echo json_encode($insertOrUpdate);
	}

	public function showDasarTarif()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$select		= $this->dasartarif->showDaftarTarif($id, $gerbang);
		echo json_encode($select);
	}

	public function deleteDasarTarif()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$delete		= $this->dasartarif->deleteDasarTarif($id, $gerbang);
		echo json_encode($delete);
	}

	////// DASAR TARIF

	public function ajax_list_daftartarifclose()
	{
		$db = $this->input->post('gerbang');
		$this->daftartarifclose->setKoneksi($db);
		$list = $this->daftartarifclose->make_datatables();

		$data = array();
		$no = 0;


		foreach ($list as $item) {

			$button = '<btn onclick="btnEditDaftarTarifModal(`' . $item->id . '`)" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></btn>';
			$button .= '&nbsp;';
			$button .= '<btn onclick="btnDeleteDaftarTarif(`' . $item->id . '`)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></btn>';
			$modall = '<btn onclick="btnDetailDaftarTarif(`' . $item->id . '`)" class="no-bold">' . $this->gerbangName($item->asal_gerbang) . '</btn>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $modall;
			$row[] = $this->gerbangName($item->gerbang_id);
			$row[] = strtoupper($item->jenis);
			$row[] = $item->id_dasar_tarif;
			$row[] = $item->gol1;
			$row[] = $item->gol2;
			$row[] = $item->gol3;
			$row[] = $item->gol4;
			$row[] = $item->gol5;
			$row[] = $item->tgl_berlaku;
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->daftartarifclose->get_all_data(),
			"recordsFiltered" => $this->daftartarifclose->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}


	////// DAFTAR TARIF
	public function ajax_list_daftartarif()
	{
		$db = $this->input->post('gerbang');
		$this->daftartarif->setKoneksi($db);
		$list = $this->daftartarif->make_datatables();

		$data = array();
		$no = 0;


		foreach ($list as $item) {

			$button = '<btn onclick="btnEditDaftarTarifModal(`' . $item->id . '`)" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></btn>';
			$button .= '&nbsp;';
			$button .= '<btn onclick="btnDeleteDaftarTarif(`' . $item->id . '`)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></btn>';
			$modall = '<btn onclick="btnDetailDaftarTarif(`' . $item->id . '`)" class="no-bold">' . $this->gerbangName($item->gerbang_id) . '</btn>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $modall;
			$row[] = $item->id_dasar_tarif;
			$row[] = $item->gol1;
			$row[] = $item->gol2;
			$row[] = $item->gol3;
			$row[] = $item->gol4;
			$row[] = $item->gol5;
			$row[] = $item->tgl_berlaku;
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->daftartarif->get_all_data(),
			"recordsFiltered" => $this->daftartarif->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function addEditDaftarTarif()
	{
		$post['id']						= $this->input->post('id');
		$post['gerbang']				= $this->input->post('gerbangmodal');
		$post['dasar_tarif']			= $this->input->post('dasartarifmodal');
		$post['waktu']					= $this->input->post('waktu');
		$post['mtngol1']				= $this->input->post('mtngol1');
		$post['jangergol1']				= $this->input->post('jangergol1');
		$post['mmsgol1']				= $this->input->post('mmsgol1');
		$post['bsdgol1']				= $this->input->post('bsdgol1');
		$post['csjgol1']				= $this->input->post('csjgol1');
		$post['jkcgol1']				= $this->input->post('jkcgol1');
		$post['totalgol1']				= $this->input->post('totalgol1');
		$post['mtngol2']				= $this->input->post('mtngol2');
		$post['jangergol2']				= $this->input->post('jangergol2');
		$post['mmsgol2']				= $this->input->post('mmsgol2');
		$post['bsdgol2']				= $this->input->post('bsdgol2');
		$post['csjgol2']				= $this->input->post('csjgol2');
		$post['jkcgol2']				= $this->input->post('jkcgol2');
		$post['totalgol2']				= $this->input->post('totalgol2');
		$post['mtngol3']				= $this->input->post('mtngol3');
		$post['jangergol3']				= $this->input->post('jangergol3');
		$post['mmsgol3']				= $this->input->post('mmsgol3');
		$post['bsdgol3']				= $this->input->post('bsdgol3');
		$post['csjgol3']				= $this->input->post('csjgol3');
		$post['jkcgol3']				= $this->input->post('jkcgol3');
		$post['totalgol3']				= $this->input->post('totalgol3');
		$post['mtngol4']				= $this->input->post('mtngol4');
		$post['jangergol4']				= $this->input->post('jangergol4');
		$post['mmsgol4']				= $this->input->post('mmsgol4');
		$post['bsdgol4']				= $this->input->post('bsdgol4');
		$post['csjgol4']				= $this->input->post('csjgol4');
		$post['jkcgol4']				= $this->input->post('jkcgol4');
		$post['totalgol4']				= $this->input->post('totalgol4');
		$post['mtngol5']				= $this->input->post('mtngol5');
		$post['jangergol5']				= $this->input->post('jangergol5');
		$post['mmsgol5']				= $this->input->post('mmsgol5');
		$post['bsdgol5']				= $this->input->post('bsdgol5');
		$post['csjgol5']				= $this->input->post('csjgol5');
		$post['jkcgol5']				= $this->input->post('jkcgol5');
		$post['totalgol5']				= $this->input->post('totalgol5');

		$insertOrUpdate = $this->daftartarif->insertOrUpdate($post);
		echo json_encode($insertOrUpdate);
	}

	public function addEditDaftarTarifClose()
	{
		$post['id']						= $this->input->post('id');
		$post['gerbang']				= $this->input->post('gerbangmodal');
		$post['asal_gerbang']			= $this->input->post('asal_gerbang');
		$post['asal_gerbang_update']	= $this->input->post('asal_gerbang_update');
		$post['jenis']					= $this->input->post('jenis');
		$post['dasar_tarif']			= $this->input->post('dasartarifmodal');
		$post['waktu']					= $this->input->post('waktu');
		$post['mtngol1']				= $this->input->post('mtngol1');
		$post['jangergol1']				= $this->input->post('jangergol1');
		$post['mmsgol1']				= $this->input->post('mmsgol1');
		$post['bsdgol1']				= $this->input->post('bsdgol1');
		$post['csjgol1']				= $this->input->post('csjgol1');
		$post['jkcgol1']				= $this->input->post('jkcgol1');
		$post['totalgol1']				= $this->input->post('totalgol1');
		$post['mtngol2']				= $this->input->post('mtngol2');
		$post['jangergol2']				= $this->input->post('jangergol2');
		$post['mmsgol2']				= $this->input->post('mmsgol2');
		$post['bsdgol2']				= $this->input->post('bsdgol2');
		$post['csjgol2']				= $this->input->post('csjgol2');
		$post['jkcgol2']				= $this->input->post('jkcgol2');
		$post['totalgol2']				= $this->input->post('totalgol2');
		$post['mtngol3']				= $this->input->post('mtngol3');
		$post['jangergol3']				= $this->input->post('jangergol3');
		$post['mmsgol3']				= $this->input->post('mmsgol3');
		$post['bsdgol3']				= $this->input->post('bsdgol3');
		$post['csjgol3']				= $this->input->post('csjgol3');
		$post['jkcgol3']				= $this->input->post('jkcgol3');
		$post['totalgol3']				= $this->input->post('totalgol3');
		$post['mtngol4']				= $this->input->post('mtngol4');
		$post['jangergol4']				= $this->input->post('jangergol4');
		$post['mmsgol4']				= $this->input->post('mmsgol4');
		$post['bsdgol4']				= $this->input->post('bsdgol4');
		$post['csjgol4']				= $this->input->post('csjgol4');
		$post['jkcgol4']				= $this->input->post('jkcgol4');
		$post['totalgol4']				= $this->input->post('totalgol4');
		$post['mtngol5']				= $this->input->post('mtngol5');
		$post['jangergol5']				= $this->input->post('jangergol5');
		$post['mmsgol5']				= $this->input->post('mmsgol5');
		$post['bsdgol5']				= $this->input->post('bsdgol5');
		$post['csjgol5']				= $this->input->post('csjgol5');
		$post['jkcgol5']				= $this->input->post('jkcgol5');
		$post['totalgol5']				= $this->input->post('totalgol5');

		$insertOrUpdate = $this->daftartarifclose->insertOrUpdate($post);
		echo json_encode($insertOrUpdate);
	}

	public function showDaftarTarif()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$select		= $this->daftartarif->showDaftarTarif($id, $gerbang);
		echo json_encode($select);
	}


	public function showDaftarTarifClose()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$select		= $this->daftartarifclose->showDaftarTarifClose($id, $gerbang);
		echo json_encode($select);
	}

	public function deleteDaftarTarif()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$delete		= $this->daftartarif->deleteDaftarTarif($id, $gerbang);
		echo json_encode($delete);
	}

	public function deleteDaftarTarifClose()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$delete		= $this->daftartarifclose->deleteDaftarTarifClose($id, $gerbang);
		echo json_encode($delete);
	}



	public function gerbangName($id)
	{
		$gerbang_id_list = array();
		$gerbang_list = array();

		$list = $this->model->getnamanyagerbangarray();
		foreach ($list as $item) {
			$gerbang_id_list[] = $item->gerbang_id;
			$gerbang_list[] = $item->gerbang_nama;
		}
		// $gerbang_id_list = array("01","02","03","04","05","06","07","08","09","11","12","13","14","15","16","17","18","19","20","21","22","31","32","33","34","35","36","99");
		// $gerbang_list = array("KUNCIRAN 3","KUNCIRAN 4","KUNCIRAN 5","JELUPANG","PARIGI","SERPONG 1","SERPONG 2","SERPONG 3","SERPONG 4","HUSEIN SASTRA NEGARA","TANAH TINGGI 1","TANAH TINGGI 2","BUARAN 1","BUARAN 2","TIRTAYASA 1","TIRTAYASA 2","TIRTAYASA 3","TIRTAYASA 4","KUNCIRAN 6","KUNCIRAN 7","KUNCIRAN 8","SERPONG 5","SERPONG 6","SERPONG 7","MARTADINATA","KEMIRI","PALARAYA","HILANG");

		for ($x = 0; $x < sizeof($gerbang_id_list); $x++) {
			if ($id == $gerbang_id_list[$x]) {
				$hasil = $gerbang_list[$x];
				return $hasil;
			} else {
				$hasil = "unknown";
			}
		}


		// switch($id)
		// {
		// 	case '01' : 
		// 		$hasil='KUNCIRAN 3';
		// 		break;	
		// 	case '02' : 
		// 		$hasil='KUNCIRAN 4';
		// 		break;
		// 	case '03' : 
		// 		$hasil='KUNCIRAN 5';
		// 		break;	
		// 	case '04' : 
		// 		$hasil='JELUPANG';
		// 		break;
		// 	case '05' : 
		// 		$hasil='PARIGI';
		// 		break;	
		// 	case '06' : 
		// 		$hasil='SERPONG 1';
		// 		break;
		// 	case '07' : 
		// 		$hasil='SERPONG 2';
		// 		break;
		// 	case '08' : 
		// 		$hasil='SERPONG 3';
		// 		break;	
		// 	case '09' : 
		// 		$hasil='SERPONG 4';
		// 		break;
		// 	default: 
		// 		$hasil='UNKNOWN';
		// 		break;	
		// }


	}
	////// DETAIL TARIF

	////// LOG
	public function ajax_list_log()
	{
		$db = $this->input->post('gerbang');
		$this->logmodel->setKoneksi($db);
		$list = $this->logmodel->make_datatables();

		$data = array();
		$no = 0;


		foreach ($list as $item) {

			// $button ='<btn onclick="btnEditDasarTarifModal(`'.$item->id.'`)" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></btn>';
			// $button .='&nbsp;';
			// $button .='<btn onclick="btnDeleteDasarTarif(`'.$item->id.'`)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></btn>';
			switch ($item->id_jabatan) {
				case 0:
					$jabatan = 'MA';
					break;
				case 1:
					$jabatan = 'KBT';
					break;
				case 2:
					$jabatan = 'KSPT';
					break;
				case 3:
					$jabatan = 'PLT';
					break;
				default:
					$jabatan = 'UNKNOWNN';
					break;
			}

			switch ($item->kategori) {
				case 1:
					$kategori = 'Petugas';
					break;
				case 2:
					$kategori = 'Tarif';
					break;
				case 3:
					$kategori = 'Kartu Dinas';
					break;
				case 4:
					$kategori = 'Kartu Pass Pull';
					break;
				case 5:
					$kategori = 'Blacklist';
					break;
				default:
					$kategori = 'UNKNOWNN';
					break;
			}

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $item->npp_no;
			$row[] = $item->nama_pegawai;
			$row[] = $jabatan;
			$row[] = $this->gerbangName($item->gerbang_id);
			$row[] = $item->waktu;
			$row[] = $kategori;
			$row[] = $item->event;
			$row[] = $item->keterangan;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->logmodel->get_all_data(),
			"recordsFiltered" => $this->logmodel->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}


	////// LOG

	////// PENERBITAN KARTU
	public function ajax_list_penerbitan_kartu()
	{
		$db = $this->input->post('gerbang');
		$this->kartumodel->setKoneksi($db);
		$list = $this->kartumodel->make_datatables();

		$data = array();
		$no = 0;


		foreach ($list as $item) {

			$button = '<btn onclick="btnEditPenerbitanKartuModal(`' . $item->id . '`)" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></btn>';
			$button .= '&nbsp;';
			$button .= '<btn onclick="btnDeletePenerbitanKartu(`' . $item->id . '`)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></btn>';

			if ($item->ktp_jenis_id == 1) {
				$jenis = 'Operasional';
			} else if ($item->ktp_jenis_id == 2) {
				$jenis = 'Mitra';
			} else if ($item->ktp_jenis_id == 3) {
				$jenis = 'Karyawan';
			} else {
				$jenis = 'UNKNOWN';
			}

			if ($item->ktp_id == '') {
				$ktpid = 'UNKNOWN';
			} else {
				$ktpid = $item->ktp_id;
			}

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $item->nama;
			$row[] = $ktpid;
			$row[] = $item->no_registrasi;
			$row[] = $jenis;
			$row[] = $item->tgl_terbit;
			$row[] = $item->tgl_kadaluarsa;
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kartumodel->get_all_data(),
			"recordsFiltered" => $this->kartumodel->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function addEditPenerbitanKartu()
	{
		$post['id']				= $this->input->post('id');
		$post['gerbang']		= $this->input->post('gerbangmodal');
		$post['nama']			= $this->input->post('nama');
		//$post['ktpid']			= $this->input->post('ktpid');
		$post['jenis_ktp']		= $this->input->post('jenis_ktp');
		$post['noregistrasi']	= $this->input->post('noregistrasi');
		$post['tglterbit']		= $this->input->post('tglterbit');
		$post['tglkadaluarsa']	= $this->input->post('tglkadaluarsa');

		$insertOrUpdate = $this->kartumodel->insertOrUpdate($post);
		echo json_encode($insertOrUpdate);
	}

	public function showPenerbitanKartu()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$select		= $this->kartumodel->showPetugas($id, $gerbang);
		echo json_encode($select);
	}

	public function deletePenerbitanKartu()
	{
		$id			= $this->input->post('id');
		$gerbang	= $this->input->post('gerbang');
		$delete		= $this->kartumodel->deletePetugas($id, $gerbang);
		echo json_encode($delete);
	}
	////// PENERBITAN KARTU
}
