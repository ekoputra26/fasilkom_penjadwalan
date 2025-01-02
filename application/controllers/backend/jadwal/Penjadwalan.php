<?php
defined('BASEPATH') or exit('No direct script allowed');
class Penjadwalan extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->module = 'backend';

		$this->data['token'] = $this->session->userdata('token');
		if (!isset($this->data['token'])) {
			$this->session->sess_destroy();
			$this->flashmsg('Anda harus login untuk mengakses halaman tersebut', 'warning');
			redirect('login');
			exit;
		}
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
      
		$this->data['content']  = 'jadwal/penjadwalan';
		$ext_foot = [
			'<script src="'.backend_url().'js/calendar/main.min.js"></script>',
			'<script src="'.backend_url().'js/calendar/interaction.min.js"></script>',
			'<script src="'.backend_url().'js/calendar/daygrid.min.js"></script>',
			'<script src="'.backend_url().'js/calendar/timegrid.min.js"></script>',
			'<script src="'.backend_url().'js/calendar/list.min.js"></script>',
			'<script src="'.backend_url().'js/calendar/calendar-bootstrap.min.js"></script>',
			'<script src="'.backend_url().'js/calendar/resourcecommon.min.js"></script>',
			'<script src="'.backend_url().'js/calendar/timelinemain.min.js"></script>',
			'<script src="'.backend_url().'js/calendar/resourcetimeline.min.js"></script>',
			'<script src="'.backend_url().'js/custom/data_jadwal/penjadwalan.js"></script>',
		];
		$this->data['ruang']= $this->ruang_m->get();
		$this->data['mata_kuliah']= $this->mata_kuliah_m->get(['ta_id' => $this->data['ta']->ta_id,
			'prodi_id' => $this->data['token']['prodi']
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
	public function editTanggal(){

		$id = $this->post('id');
		$start = $this->post('start');
		$end = $this->post('end');
		$hari = $this->post('hari');
		$ruangan = $this->post('ruangan');
		$cek = $this->jadwal_m->get_data_id($id);

		if($cek['jadwal']->prodi_id == $this->data['token']['prodi']){
			$update = $this->jadwal_m->update($id,['jadwal_hari' => $hari,'jadwal_jam_masuk' => $start,'jadwal_jam_keluar' => $end, 'ruang_id' => $ruangan]);
			if($update == 1){
				$response = [
					'text' => MESSAGE_SUCCESS['UPDATE']['TEXT'],
					'info' => MESSAGE_SUCCESS['UPDATE']['INFO'],
				];
			} else {
				$response = [
					'text' => MESSAGE_FAIL['UPDATE']['TEXT'],
					'info' => MESSAGE_FAIL['UPDATE']['INFO'],
				];
			}
		} else {
			$response = [
				'text' => MESSAGE_FAIL['GET_NO_AUTH']['TEXT'],
				'info' => MESSAGE_FAIL['GET_NO_AUTH']['INFO'],
			];
		}

		echo json_encode($response);
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

	public function create_data(){
		$jadwal_hari = $this->post('jadwal_hari');
		$jadwal_masuk = $this->post('jadwal_masuk');
		$jadwal_keluar = $this->post('jadwal_keluar');
		$ruang_id = $this->post('ruang_id');
		$mk_id = $this->post('mk_id');
		$dosen_id = $this->post('dosen_id');
		$jadwal_kelas = $this->post('jadwal_kelas');
		$jadwal_semester = $this->post('jadwal_semester');
		$jadwal_sks = $this->post('jadwal_sks');

		if(empty($jadwal_hari) || empty($jadwal_masuk) || empty($jadwal_keluar) || empty($ruang_id) || empty($mk_id) || empty($dosen_id) || empty($jadwal_kelas) || empty($jadwal_semester) || empty($jadwal_sks)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		}
		else {

			$exMasuk = explode(":", $jadwal_masuk);
			$exKeluar = explode(":", $jadwal_keluar);

			$roundMasuk = $this->libunsripenjadwalan->roundUpToAny($exMasuk[1]);
			$roundKeluar = $this->libunsripenjadwalan->roundUpToAny($exKeluar[1]);

			$jadwal_masuk = $exMasuk[0].':'.$roundMasuk; 
			$jadwal_keluar = $exKeluar[0].':'.$roundKeluar; 

			$jadwal_masuk_c = $exMasuk[0].':'.$roundMasuk.':00'; 
			$jadwal_keluar_c = $exKeluar[0].':'.$roundKeluar.':00'; 

//			$hari = $this->libunsripenjadwalan->getday();

			$cekJadwal = [];
			$result = "success";
			if(count($cekJadwal) > 0){
				$response = [
					'text' => 'Jadwal telah terisi',
					'info' => $result,
				];
			} else {
				$data = [
					'jadwal_hari' => $jadwal_hari,
					'jadwal_jam_masuk' => $jadwal_masuk,
					'jadwal_jam_keluar' => $jadwal_keluar,
					'ruang_id' => $ruang_id,
					'mk_id' => $mk_id,
					'jadwal_kelas' => $jadwal_kelas,
					'jadwal_semester' => $jadwal_semester,
					'jadwal_sks' => $jadwal_sks,		
					'ta_id' => $this->data['ta']->ta_id,		
				];

				$insert = $this->jadwal_m->insert($data);
				if($insert['sts'] == 1){

					for($i=0;$i<count($dosen_id);$i++){
						$this->dosen_jadwal_m->insert([
							'jadwal_id' => $insert['id'],
							'dosen_id' => $dosen_id[$i],
						]);
					}
					$response = [
						'text' => MESSAGE_SUCCESS['ADD']['TEXT'],
						'info' => MESSAGE_SUCCESS['ADD']['INFO'],
                      	'DATA_DOSEN' => $dosen_id,
					];
				} else {
					$response = [
						'text' => MESSAGE_FAIL['ADD']['TEXT'],
						'info' => MESSAGE_FAIL['ADD']['INFO'],
					];
				}
			}
		}
		echo json_encode($response);
	}
	public function validate(){
		$jadwal_hari = $this->post('jadwal_hari');
		$jadwal_masuk = $this->post('jadwal_masuk');
		$jadwal_keluar = $this->post('jadwal_keluar');
		$ruang_id = $this->post('ruang_id');
		$mk_id = $this->post('mk_id');
		$dosen_id = $this->post('dosen_id');
		$jadwal_kelas = $this->post('jadwal_kelas');
		$jadwal_semester = $this->post('jadwal_semester');
		$jadwal_sks = $this->post('jadwal_sks');

		if(empty($jadwal_hari) || empty($jadwal_masuk) || empty($jadwal_keluar) || empty($ruang_id) || empty($mk_id) || empty($dosen_id) || empty($jadwal_kelas) || empty($jadwal_semester) || empty($jadwal_sks)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		}
		else {

			$exMasuk = explode(":", $jadwal_masuk);
			$exKeluar = explode(":", $jadwal_keluar);

			$roundMasuk = $this->libunsripenjadwalan->roundUpToAny($exMasuk[1]);
			$roundKeluar = $this->libunsripenjadwalan->roundUpToAny($exKeluar[1]);


			$jadwal_masuk_c = $exMasuk[0].':'.$roundMasuk.':00';
			$jadwal_keluar_c = $exKeluar[0].':'.$roundKeluar.':00';

			$result = $this->jadwal_m->validateJadwalBaru($dosen_id, $jadwal_hari, $jadwal_masuk_c, $jadwal_keluar_c, $ruang_id, $jadwal_kelas);
			$response = [
				'text' => $result,
				'info' => MESSAGE_SUCCESS['GET']['INFO'],
			];
		}
		echo json_encode($response);
	}

	public function update_data(){
		$jadwal_id = $this->post('jadwal_id');
		$jadwal_hari = $this->post('jadwal_hari');
		$jadwal_masuk = $this->post('jadwal_masuk');
		$jadwal_keluar = $this->post('jadwal_keluar');
		$ruang_id = $this->post('ruang_id');
		$mk_id = $this->post('mk_id');
		$dosen_id = $this->post('dosen_id');
		$jadwal_kelas = $this->post('jadwal_kelas');
		$jadwal_semester = $this->post('jadwal_semester');
		$jadwal_sks = $this->post('jadwal_sks');		

		$data = [
			'jadwal_hari' => $jadwal_hari,
			'jadwal_jam_masuk' => $jadwal_masuk,
			'jadwal_jam_keluar' => $jadwal_keluar,
			'ruang_id' => $ruang_id,
			'mk_id' => $mk_id,
			'jadwal_kelas' => $jadwal_kelas,
			'jadwal_semester' => $jadwal_semester,
			'jadwal_sks' => $jadwal_sks,		
		];

		$update = $this->jadwal_m->update($jadwal_id,$data);
		if($update == 1){
			if(count($dosen_id) > 0){
				$this->dosen_jadwal_m->delete_by(['jadwal_id' => $jadwal_id]);
				for($i=0;$i<count($dosen_id);$i++){
					$this->dosen_jadwal_m->insert([
						'jadwal_id' => $jadwal_id,
						'dosen_id' => $dosen_id[$i],
					]);
				}
			}
			$response = [
				'text' => MESSAGE_SUCCESS['UPDATE']['TEXT'],
				'info' => MESSAGE_SUCCESS['UPDATE']['INFO'],
			];
		} else {
			$response = [
				'text' => MESSAGE_FAIL['UPDATE']['TEXT'],
				'info' => MESSAGE_FAIL['UPDATE']['INFO'],
			];
		}
		echo json_encode($response);
	}



	public function delete_data(){
		$id = $this->post('id');
		$cek = $this->jadwal_m->get_data_id($id);
		if($cek['jadwal']->prodi_id == $this->data['token']['prodi']){
			$delete = $this->jadwal_m->delete($id);
			if($delete == 1){
				$response = [
					'text' => MESSAGE_SUCCESS['DELETE']['TEXT'],
					'info' => MESSAGE_SUCCESS['DELETE']['INFO'],
				];
			} else {
				$response = [
					'text' => MESSAGE_FAIL['DELETE']['TEXT'],
					'info' => MESSAGE_FAIL['DELETE']['INFO'],
				];
			}
		} else {
			$response = [
				'text' => MESSAGE_FAIL['GET_NO_AUTH']['TEXT'],
				'info' => MESSAGE_FAIL['GET_NO_AUTH']['INFO'],
			];
		}
		echo json_encode($response);
	}

	public function get_jadwal_perprodi(){
		$prodi =  $this->get('prodi');
		$ta = $this->get('ta');
		$data = $this->jadwal_m->get_jadwal_per_prodi($prodi, $ta);
		echo json_encode($data);
	}

}
