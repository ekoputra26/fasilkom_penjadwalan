<?php
defined('BASEPATH') or exit('No direct script allowed');
include 'assets/phpqrcode/qrlib.php';
class Ruang extends MY_Controller
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
		$this->load->model('gedung_m');
		$this->load->model('ruang_m');
		$this->load->library('libencrypt');
		$this->data['groupTitle'] = 'Data Ruangan';
	}

	public function index()
	{
		$this->data['gedung'] = $this->gedung_m->get_by_order('gedung_id','desc');
		$this->data['title']    = 'Ruang';
		$this->data['content']  = 'ruangan/ruang';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_ruangan/ruang.js"></script>',
		];
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$data = $this->ruang_m->getDataJoin(['gedung'],['ruang.gedung_id = gedung.gedung_id'],[],'ruang_id','ASC');
		echo json_encode($data);
	}

	public function create_data(){
		$gedung_id = $this->post('gedung_id');
		$ruang_kode = $this->post('ruang_kode');
		$ruang_lantai = $this->post('ruang_lantai');
		$ruang_status = $this->post('ruang_status');
		$ruang_keterangan = $this->post('ruang_keterangan');
		$ruang_jenis = $this->post('ruang_jenis');
		$ruang_latitude = $this->post('ruang_latitude');
		$ruang_longitude = $this->post('ruang_longitude');
		if(empty($gedung_id) || empty($ruang_kode) || empty($ruang_status) || empty($ruang_jenis) || empty($ruang_latitude) || empty($ruang_longitude)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		} else {
			$data = [
				'gedung_id' => $gedung_id,
				'ruang_kode' => $ruang_kode,
				'ruang_lantai' => $ruang_lantai,
				'ruang_status' => $ruang_status,
				'ruang_keterangan' => $ruang_keterangan,
				'ruang_jenis' => $ruang_jenis,
				'ruang_latitude' => $ruang_latitude,
				'ruang_longitude' => $ruang_longitude,
			];
			$insert = $this->ruang_m->insert($data);
			if($insert['sts'] == 1){
				$nameQR = $insert['id'].$gedung_id.str_replace(" ", "", $ruang_kode).$ruang_lantai;
				$haskey = $this->libencrypt->encData($insert['id']."#@#".$gedung_id."#@#".str_replace(" ", "", $ruang_kode)."#@#".$ruang_lantai)."#$&#*#".$ruang_latitude."#$&#*#".$ruang_longitude;
				QRcode::png($haskey,'assets/uploads/ruang/'.$nameQR.".png","Q", 8, 8);

				$update = $this->ruang_m->update($insert['id'],['ruang_qrcode' => $nameQR.".png"]);

				$response = [
					'text' => MESSAGE_SUCCESS['ADD']['TEXT'],
					'info' => MESSAGE_SUCCESS['ADD']['INFO'],
				];
			} else {
				$response = [
					'text' => MESSAGE_FAIL['ADD']['TEXT'],
					'info' => MESSAGE_FAIL['ADD']['INFO'],
				];
			}
		}
		echo json_encode($response);
	}

	public function update_data(){
		$ruang_id = $this->post('ruang_id');
		$gedung_id = $this->post('gedung_id');
		$ruang_kode = $this->post('ruang_kode');
		$ruang_lantai = $this->post('ruang_lantai');
		$ruang_status = $this->post('ruang_status');
		$ruang_keterangan = $this->post('ruang_keterangan');
		$ruang_jenis = $this->post('ruang_jenis');
		$ruang_latitude = $this->post('ruang_latitude');
		$ruang_longitude = $this->post('ruang_longitude');
		
		$data = [
			'gedung_id' => $gedung_id,
			'ruang_kode' => $ruang_kode,
			'ruang_lantai' => $ruang_lantai,
			'ruang_status' => $ruang_status,
			'ruang_keterangan' => $ruang_keterangan,
			'ruang_jenis' => $ruang_jenis,
			'ruang_latitude' => $ruang_latitude,
			'ruang_longitude' => $ruang_longitude,
		];
		$update = $this->ruang_m->update($ruang_id,$data);
		if($update == 1){
			
			$nameQR = $ruang_id.$gedung_id.str_replace(" ", "", $ruang_kode).$ruang_lantai;
			$haskey = $this->libencrypt->encData($ruang_id."#@#".$gedung_id."#@#".str_replace(" ", "", $ruang_kode)."#@#".$ruang_lantai)."#$&#*#".$ruang_latitude."#$&#*#".$ruang_longitude;
			QRcode::png($haskey,'assets/uploads/ruang/'.$nameQR.".png","Q", 8, 8);
			$update = $this->ruang_m->update($ruang_id,['ruang_qrcode' => $nameQR.".png"]);

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

		$delete = $this->ruang_m->delete($id);
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
		echo json_encode($response);
	}
}
