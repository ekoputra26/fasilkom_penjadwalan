<?php
defined('BASEPATH') or exit('No direct script allowed');
class Mata_kuliah extends MY_Controller
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
		$this->load->model('prodi_m');
		$this->load->model('mata_kuliah_m');
		$this->load->model('tahun_ajaran_m');
		$this->data['ta'] = $this->tahun_ajaran_m->get_row(['ta_status' => 'Aktif']);
		$this->data['groupTitle'] = 'Data Jadwal';
	}

	public function index()
	{
		$this->data['prodi'] = $this->prodi_m->get_by_order('prodi_id','ASC');
		$this->data['title']    = 'Mata Kuliah';
		$this->data['content']  = 'jadwal/mata_kuliah';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_jadwal/mata_kuliah.js"></script>',
		];
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$data = $this->mata_kuliah_m->getDataJoin(['prodi'],['mata_kuliah.prodi_id = prodi.prodi_id'],['mata_kuliah.ta_id' => $this->data['ta']->ta_id],'mk_id','DESC');
		echo json_encode($data);
	}

	public function create_data(){
		$prodi_id = $this->post('prodi_id');
		$mk_nama = $this->post('mk_nama');
		$mk_kode = $this->post('mk_kode');
		if(empty($prodi_id) || empty($mk_nama) || empty($mk_kode)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		} else {
			$data = [
				'prodi_id' => $prodi_id,
				'mk_kode' => $mk_kode,
				'mk_nama' => $mk_nama,
				'ta_id' => $this->data['ta']->ta_id,		
			];

			$insert = $this->mata_kuliah_m->insert($data);
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
		$mk_id = $this->post('mk_id');
		$prodi_id = $this->post('prodi_id');
		$mk_nama = $this->post('mk_nama');
		$mk_kode = $this->post('mk_kode');
		
		$data = [
			'prodi_id' => $prodi_id,
			'mk_kode' => $mk_kode,
			'mk_nama' => $mk_nama,
		];
		
		$update = $this->mata_kuliah_m->update($mk_id,$data);
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

		$delete = $this->mata_kuliah_m->delete($id);
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
