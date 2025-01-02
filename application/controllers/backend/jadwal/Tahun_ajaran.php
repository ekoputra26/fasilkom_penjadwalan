<?php
defined('BASEPATH') or exit('No direct script allowed');
class Tahun_ajaran extends MY_Controller
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
		$this->load->model('tahun_ajaran_m');
		$this->data['groupTitle'] = 'Data Jadwal';
	}

	public function index()
	{
		$this->data['title']    = 'Tahun Ajaran';
		$this->data['content']  = 'jadwal/tahun_ajaran';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_jadwal/tahun_ajar_aktif.js"></script>',
		];
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$data = $this->tahun_ajaran_m->get_by_order('ta_id','desc');
		echo json_encode($data);
	}

	public function create_data(){
		$ta_nama = $this->post('ta_nama');
		$ta_status = $this->post('ta_status');
		
		if(empty($ta_nama) || empty($ta_status)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		} else {
			
			$data = [
				'ta_nama' => $ta_nama,
				'ta_status' => $ta_status,
			];

			if($ta_status == 'Aktif'){
				$this->tahun_ajaran_m->update_where(['ta_status' => 'Aktif'],['ta_status' => 'Tidak Aktif']);
			}
			$insert = $this->tahun_ajaran_m->insert($data);
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
		$ta_id = $this->post('ta_id');
		$ta_nama = $this->post('ta_nama');
		$ta_status = $this->post('ta_status');
		
		$data = [
			'ta_nama' => $ta_nama,
			'ta_status' => $ta_status,
		];
		if($ta_status == 'Aktif'){
			$this->tahun_ajaran_m->update_where(['ta_status' => 'Aktif'],['ta_status' => 'Tidak Aktif']);
		}
		$update = $this->tahun_ajaran_m->update($ta_id,$data);
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

		$delete = $this->tahun_ajaran_m->delete($id);
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
