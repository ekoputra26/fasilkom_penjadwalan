<?php
defined('BASEPATH') or exit('No direct script allowed');
class Gedung extends MY_Controller
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
		$this->data['groupTitle'] = 'Data Ruangan';
	}

	public function index()
	{
		$this->data['title']    = 'Gedung';
		$this->data['content']  = 'ruangan/gedung';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_ruangan/gedung.js"></script>',
		];
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$data = $this->gedung_m->get_by_order('gedung_id','desc');
		echo json_encode($data);
	}

	public function create_data(){
		$gedung_nama = $this->post('gedung_nama');
		$gedung_lokasi = $this->post('gedung_lokasi');
		$gedung_keterangan = $this->post('gedung_keterangan');
		if(empty($gedung_nama) || empty($gedung_lokasi)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		} else {
			$data = [
				'gedung_nama' => $gedung_nama,
				'gedung_lokasi' => $gedung_lokasi,
				'gedung_keterangan' => $gedung_keterangan,
			];
			$insert = $this->gedung_m->insert($data);
			if($insert['sts'] == 1){
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
		$gedung_id = $this->post('gedung_id');
		$gedung_nama = $this->post('gedung_nama');
		$gedung_lokasi = $this->post('gedung_lokasi');
		$gedung_keterangan = $this->post('gedung_keterangan');
		
		$data = [
			'gedung_id' => $gedung_id,
			'gedung_nama' => $gedung_nama,
			'gedung_lokasi' => $gedung_lokasi,
			'gedung_keterangan' => $gedung_keterangan,
		];
		$update = $this->gedung_m->update($gedung_id,$data);
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
		echo json_encode($response);
	}



	public function delete_data(){
		$id = $this->post('id');

		$delete = $this->gedung_m->delete($id);
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
