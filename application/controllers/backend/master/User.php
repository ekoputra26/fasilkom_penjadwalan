<?php
defined('BASEPATH') or exit('No direct script allowed');
class User extends MY_Controller
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
		$this->load->model('user_m');
		$this->data['groupTitle'] = 'Data Master';
	}

	public function index()
	{
		$this->data['title']    = 'User';
		$this->data['content']  = 'master/user';
		$ext_foot = [
			'<script src="'.backend_url().'js/custom/data_master/user.js"></script>',
		];
		$this->data['ext_foot'] = $ext_foot;
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$data = $this->db->query("SELECT a.*,b.prodi_nama,c.jurusan_id,d.fakultas_id FROM user a LEFT JOIN prodi b ON a.prodi_id=b.prodi_id LEFT JOIN jurusan c ON b.jurusan_id=c.jurusan_id LEFT JOIN fakultas d ON c.fakultas_id=d.fakultas_id ORDER BY a.user_id DESC")->result();
		echo json_encode($data);
	}

	public function create_data(){
		$user_nama = $this->post('user_nama');
		$user_username = $this->post('user_username');
		$user_role = $this->post('user_role');
		$user_password = $this->post('user_password');
		$user_repassword = $this->post('user_repassword');
		$prodi_id = $this->post('prodi_id');
		if(empty($user_nama) || empty($user_username) || empty($user_password) || empty($user_repassword)){
			$response = [
				'text' => MESSAGE_FAIL['FORM_REQUIRED']['TEXT'],
				'info' => MESSAGE_FAIL['FORM_REQUIRED']['INFO'],
			];
		} else {
			$cekuname=$this->user_m->get(['user_username' => $user_username]);
			if(count($cekuname)==1){
				$response = [
					'text' => MESSAGE_FAIL['USERNAME_USED']['TEXT'],
					'info' => MESSAGE_FAIL['USERNAME_USED']['INFO'],
				];
			}else{
				if(empty($user_password) || empty($user_repassword)){
					$response = [
						'text' => MESSAGE_FAIL['EMPTY_PASSWORD']['TEXT'],
						'info' => MESSAGE_FAIL['EMPTY_PASSWORD']['INFO'],
					];
				} else {
					if($user_password==$user_repassword){
						$data = [
							'user_nama' => $user_nama,
							'user_username' => $user_username,
							'user_role' => md5($user_role),
							'user_password' => $user_password,
						];

						if(!empty($prodi_id)){
							$data['prodi_id'] = $prodi_id;
						}

						$insert = $this->user_m->insert($data);
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
					}else {
						$response = [
							'text' => MESSAGE_FAIL['PASSWORD_NO_MATCH']['TEXT'],
							'info' => MESSAGE_FAIL['PASSWORD_NO_MATCH']['INFO'],
						];
					}
				}
			}
		}
		echo json_encode($response);
	}



	public function update_data(){
		$user_id = $this->post('user_id');
		$user_nama = $this->post('user_nama');
		$user_username = $this->post('user_username');
		$user_role = $this->post('user_role');
		$user_password = $this->post('user_password');
		$user_repassword = $this->post('user_repassword');
		$prodi_id = $this->post('prodi_id');
		
		$cekuname=$this->user_m->get(['user_username' => $user_username,'user_id !=' => $user_id]);
		if(count($cekuname)==1){
			$response = [
				'text' => MESSAGE_FAIL['USERNAME_USED']['TEXT'],
				'info' => MESSAGE_FAIL['USERNAME_USED']['INFO'],
			];
		} else {
			if(empty($user_password) && empty($user_repassword)){
				$data = [
					'user_nama' => $user_nama,
					'user_username' => $user_username,
					'user_role' => md5($user_role),
				];

				if(!empty($prodi_id)){
					$data['prodi_id'] = $prodi_id;
				}

				$update = $this->user_m->update($user_id,$data);
				if($update == '1'){
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
				if($user_password==$user_repassword){
					$data = [
						'user_nama' => $user_nama,
						'user_username' => $user_username,
						'user_password' => $user_password,
						'user_role' => md5($user_role),
					];

					if(!empty($prodi_id)){
						$data['prodi_id'] = $prodi_id;
					}

					$update = $this->user_m->update($user_id,$data);
					if($update == '1'){
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
				}else {
					$response = [
						'text' => MESSAGE_FAIL['PASSWORD_NO_MATCH']['TEXT'],
						'info' => MESSAGE_FAIL['PASSWORD_NO_MATCH']['INFO'],
					];
				}
			}
		}
		echo json_encode($response);
	}

	public function delete_data(){
		$id = $this->post('id');

		$delete = $this->user_m->delete($id);
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
