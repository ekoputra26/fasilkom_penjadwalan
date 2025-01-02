<?php
defined('BASEPATH') or exit('No direct script allowed');
class Barang extends MY_Controller
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
		$this->load->model('ruang_m');
		$this->load->model('barang_m');
		$this->data['groupTitle'] = 'Data Ruangan';
	}

	public function index()
	{
		$this->data['ruang'] = $this->ruang_m->get_by_order('ruang_id','desc');
		$this->data['title']    = 'Barang';
		$this->data['content']  = 'ruangan/barang';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_ruangan/barang.js"></script>',
		];
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$data = $this->barang_m->getDataJoin(['ruang'],['barang.ruang_id = ruang.ruang_id'],[],'barang_id','ASC');
		echo json_encode($data);
	}

	public function create_data(){
		$ruang_id = $this->post('ruang_id');
		$barang_nama = $this->post('barang_nama');
		$barang_nup = $this->post('barang_nup');
		$barang_merek = $this->post('barang_merek');
		$barang_kondisi = $this->post('barang_kondisi');
		$barang_keterangan = $this->post('barang_keterangan');
		if(empty($ruang_id) || empty($barang_nama) || empty($barang_kondisi)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		} else {
			$data = [
				'ruang_id' => $ruang_id,
				'barang_nama' => $barang_nama,
				'barang_nup' => $barang_nup,
				'barang_merek' => $barang_merek,
				'barang_kondisi' => $barang_kondisi,
				'barang_keterangan' => $barang_keterangan,
			];
			$insert = $this->barang_m->insert($data);
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
		$barang_id = $this->post('barang_id');
		$ruang_id = $this->post('ruang_id');
		$barang_nama = $this->post('barang_nama');
		$barang_nup = $this->post('barang_nup');
		$barang_merek = $this->post('barang_merek');
		$barang_kondisi = $this->post('barang_kondisi');
		$barang_keterangan = $this->post('barang_keterangan');
		
		$data = [
			'ruang_id' => $ruang_id,
			'barang_nama' => $barang_nama,
			'barang_nup' => $barang_nup,
			'barang_merek' => $barang_merek,
			'barang_kondisi' => $barang_kondisi,
			'barang_keterangan' => $barang_keterangan,
		];
		$update = $this->barang_m->update($barang_id,$data);
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

		$delete = $this->barang_m->delete($id);
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
