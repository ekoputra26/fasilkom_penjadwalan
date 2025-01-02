<?php
defined('BASEPATH') or exit('No direct script allowed');
class Home extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->module = 'backend';

		$this->data['token'] = $this->session->userdata('token');

		$this->load->model('jadwal_m');
		$this->load->model('ruang_m');
		$this->load->model('mata_kuliah_m');
		$this->load->model('dosen_m');
		$this->load->model('prodi_m');
		$this->load->model('dosen_jadwal_m');
		$this->load->model('tahun_ajaran_m');
		$this->load->library('libunsripenjadwalan');
		$this->data['groupTitle'] = 'Data Jadwal';
		$this->data['ta'] = $this->tahun_ajaran_m->get_row(['ta_status' => 'Aktif']);
	}

	public function index()
	{
		$this->data['title']    = 'Penjadwalan';

		$this->data['content']  = 'jadwal/penjadwalan_home';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_jadwal/penjadwalan_home.js"></script>',
		];
		$this->data['ruang']= $this->ruang_m->get();
		$this->data['mata_kuliah']= $this->mata_kuliah_m->get(['ta_id' => $this->data['ta']->ta_id
		]);
		$this->data['dosen']= $this->dosen_m->get();
		$this->data['semua_prodi']= $this->prodi_m->get();
		$this->data['semua_tahun']= $this->tahun_ajaran_m->get();
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$gedung = $this->post('gedung');
		$gedung = str_replace("#","",$gedung);
		if($gedung == 'km5'){
			$gedung = 'KM 5';
		} else {
			$gedung = ucfirst($gedung);
		}
		$data = $this->jadwal_m->get_data($this->data['ta']->ta_id,$gedung);
		echo json_encode($data);
	}

	public function get_data_id(){
		$id = $this->get('id');
		$data = $this->jadwal_m->get_data_id($id);
		$resdata = [];
		if($data['jadwal']->prodi_id == $this->data['token']['prodi']){
			$resdata = $data;
			$response = [
				'text' => MESSAGE_SUCCESS['GET']['TEXT'],
				'info' => MESSAGE_SUCCESS['GET']['INFO'],
			];
		} else {
			$resdata = [];
			$response = [
				'text' => MESSAGE_FAIL['GET_NO_AUTH']['TEXT'],
				'info' => MESSAGE_FAIL['GET_NO_AUTH']['INFO'],
			];
		}

		$res = [
			'response' => $response,
			'data' => $resdata,
		];
		echo json_encode($res);
	}
	public function get_ruangan(){
		$lokasi = $this->get('lokasi');
		$lokasi = str_replace("#","",$lokasi);
		if($lokasi == 'km5'){
			$lokasi = 'KM 5';
		} else {
			$lokasi = ucfirst($lokasi);
		}
		$data = $this->ruang_m->group_gedung($lokasi);
		echo json_encode($data);
	}


	public function get_jadwal_perprodi(){
		$prodi =  $this->get('prodi');
		$ta = $this->get('ta');
		$data = $this->jadwal_m->get_jadwal_per_prodi($prodi, $ta);
		echo json_encode($data);
	}

	public function get_data_jadwal(){
		$gedung = $this->post('gedung');
		$gedung = str_replace("#","",$gedung);
		if($gedung == 'km5'){
			$gedung = 'KM 5';
		} else {
			$gedung = ucfirst($gedung);
		}
		$data = $this->jadwal_m->get_data($this->tahun_ajaran_m->get_row(['ta_status' => 'Aktif'])->ta_id,$gedung);
		echo json_encode($data);
	}

}
