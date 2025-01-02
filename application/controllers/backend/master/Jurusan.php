<?php
defined('BASEPATH') or exit('No direct script allowed');
class Jurusan extends MY_Controller
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
		$this->load->model('fakultas_m');
		$this->load->model('jurusan_m');
		$this->data['groupTitle'] = 'Data Master';
	}

	public function index()
	{
		$this->data['fakultas'] = $this->fakultas_m->get_by_order('fakultas_id','ASC');
		$this->data['title']    = 'Jurusan';
		$this->data['content']  = 'master/jurusan';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_master/jurusan.js"></script>',
		];
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$data = $this->jurusan_m->getDataJoin(['fakultas'],['jurusan.fakultas_id = fakultas.fakultas_id'],[],'jurusan_id','DESC');
		echo json_encode($data);
	}

	public function get_data_by(){
		$fakultas_id = $this->post('fakultas_id');
		$data = $this->jurusan_m->get(['fakultas_id' => $fakultas_id]);
		echo json_encode($data);
	}

	public function create_data(){
		$jurusan_nama = $this->post('jurusan_nama');
		$fakultas_id = $this->post('fakultas_id');
		if(empty($jurusan_nama) || empty($fakultas_id)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		} else {
			$data = [
				'fakultas_id' => $fakultas_id,
				'jurusan_nama' => $jurusan_nama,
			];

			$insert = $this->jurusan_m->insert($data);
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
		$jurusan_id = $this->post('jurusan_id');
		$jurusan_nama = $this->post('jurusan_nama');
		$fakultas_id = $this->post('fakultas_id');
		
		$data = [
			'fakultas_id' => $fakultas_id,
			'jurusan_nama' => $jurusan_nama,
		];
		
		$update = $this->jurusan_m->update($jurusan_id,$data);
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

		$delete = $this->jurusan_m->delete($id);
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
