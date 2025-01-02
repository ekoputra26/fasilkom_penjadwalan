<?php
defined('BASEPATH') or exit('No direct script allowed');
class Dosen extends MY_Controller
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
		$this->load->model('dosen_m');
		$this->data['groupTitle'] = 'Data Master';
	}

	public function index()
	{
		$this->data['prodi'] = $this->prodi_m->get_by_order('prodi_id','ASC');
		$this->data['title']    = 'Dosen';
		$this->data['content']  = 'master/dosen';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_master/dosen.js"></script>',
		];
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$data = $this->dosen_m->getDataJoin(['prodi'],['dosen.prodi_id = prodi.prodi_id'],[],'dosen_id','DESC');
		echo json_encode($data);
	}

	public function create_data(){
		$dosen_nama = $this->post('dosen_nama');
		$dosen_nip = $this->post('dosen_nip');
		$dosen_jabatan = $this->post('dosen_jabatan');
		$dosen_jabfung = $this->post('dosen_jabfung');
		$dosen_golongan = $this->post('dosen_golongan');
		$prodi_id = $this->post('prodi_id');
		if(empty($dosen_nama) || empty($dosen_nip) || empty($prodi_id)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		} else {
			$ceknip=$this->dosen_m->get(['dosen_nip' => $dosen_nip]);
			if(count($ceknip)==1){
				$response = [
					'text' => 'NIP telah terpakai',
					'info' => 'warning',
				];
			} else {
				$data = [
					'prodi_id' => $prodi_id,
					'dosen_nama' => $dosen_nama,
					'dosen_nip' => $dosen_nip,
					'dosen_jabatan' => $dosen_jabatan,
					'dosen_jabfung' => $dosen_jabfung,
					'dosen_golongan' => $dosen_golongan,
				];

				$insert = $this->dosen_m->insert($data);
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
		}
		echo json_encode($response);
	}

	public function update_data(){
		$dosen_id = $this->post('dosen_id');
		$dosen_nama = $this->post('dosen_nama');
		$dosen_nip = $this->post('dosen_nip');
		$dosen_jabatan = $this->post('dosen_jabatan');
		$dosen_jabfung = $this->post('dosen_jabfung');
		$dosen_golongan = $this->post('dosen_golongan');
		$prodi_id = $this->post('prodi_id');

		$ceknip=$this->dosen_m->get(['dosen_nip' => $dosen_nip,'dosen_id !=' => $dosen_id]);
		if(count($ceknip)==1){
			$response = [
				'text' => 'NIP telah terpakai',
				'info' => 'warning',
			];
		} else {
			$data = [
				'prodi_id' => $prodi_id,
				'dosen_nama' => $dosen_nama,
				'dosen_nip' => $dosen_nip,
				'dosen_jabatan' => $dosen_jabatan,
				'dosen_jabfung' => $dosen_jabfung,
				'dosen_golongan' => $dosen_golongan,
			];

			$update = $this->dosen_m->update($dosen_id,$data);
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
		}
		echo json_encode($response);
	}



	public function delete_data(){
		$id = $this->post('id');

		$delete = $this->dosen_m->delete($id);
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
