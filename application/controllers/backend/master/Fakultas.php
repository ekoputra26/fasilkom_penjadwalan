<?php
defined('BASEPATH') or exit('No direct script allowed');
class Fakultas extends MY_Controller
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
		$this->data['groupTitle'] = 'Data Master';
	}

	public function index()
	{
		$this->data['title']    = 'Fakultas';
		$this->data['content']  = 'master/fakultas';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_master/fakultas.js"></script>',
		];
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$data = $this->fakultas_m->get_by_order('fakultas_id','ASC');
		echo json_encode($data);
	}

	public function create_data(){
		$fakultas_nama = $this->post('fakultas_nama');
		if(empty($fakultas_nama)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		} else {
			$data = [
				'fakultas_nama' => $fakultas_nama,
			];

			$insert = $this->fakultas_m->insert($data);
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
		$fakultas_id = $this->post('fakultas_id');
		$fakultas_nama = $this->post('fakultas_nama');
		
		$data = [
			'fakultas_nama' => $fakultas_nama,
		];
		
		$update = $this->fakultas_m->update($fakultas_id,$data);
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

		$delete = $this->fakultas_m->delete($id);
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
