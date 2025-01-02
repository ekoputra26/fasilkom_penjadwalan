<?php
defined('BASEPATH') or exit('No direct script allowed');
class Prodi extends MY_Controller
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
		$this->load->model('jurusan_m');
		$this->load->model('prodi_m');
		$this->data['groupTitle'] = 'Data Master';
	}

	public function index()
	{
		$this->data['jurusan'] = $this->jurusan_m->get_by_order('jurusan_id','ASC');
		$this->data['title']    = 'Prodi';
		$this->data['content']  = 'master/prodi';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_master/prodi.js"></script>',
		];
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$data = $this->prodi_m->getDataJoin(['jurusan'],['prodi.jurusan_id = jurusan.jurusan_id'],[],'prodi_id','DESC');
		echo json_encode($data);
	}

	public function get_data_by(){
		$jurusan_id = $this->post('jurusan_id');
		$data = $this->prodi_m->get(['jurusan_id' => $jurusan_id]);
		echo json_encode($data);
	}

	public function create_data(){
		$prodi_nama = $this->post('prodi_nama');
		$jurusan_id = $this->post('jurusan_id');
		$prodi_warna = $this->post('prodi_warna');
		if(empty($prodi_nama) || empty($jurusan_id) || empty($prodi_warna)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		} else {
			$data = [
				'jurusan_id' => $jurusan_id,
				'prodi_nama' => $prodi_nama,
				'prodi_warna' => $prodi_warna,
			];

			$insert = $this->prodi_m->insert($data);
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
		$prodi_id = $this->post('prodi_id');
		$prodi_nama = $this->post('prodi_nama');
		$jurusan_id = $this->post('jurusan_id');
		$prodi_warna = $this->post('prodi_warna');
		
		$data = [
			'jurusan_id' => $jurusan_id,
			'prodi_nama' => $prodi_nama,
			'prodi_warna' => $prodi_warna,
		];
		
		$update = $this->prodi_m->update($prodi_id,$data);
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

		$delete = $this->prodi_m->delete($id);
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
