<?php
defined('BASEPATH') or exit('No direct script allowed');
class Absen extends MY_Controller
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
		$this->load->model('dosen_m');
		$this->load->model('jadwal_m');
		$this->load->model('mata_kuliah_m');
		$this->load->model('absen_m');
		$this->load->library('libencrypt');
		$this->load->library('libunsripenjadwalan');
		$this->data['groupTitle'] = 'Data Jadwal';
	}

	public function checkin(){
		//mN7k+w273/Aa+JtpwH5bD/s9zvmhKxtPNaNz8UtEeeE=#$&#*#-2.9851756#$&#*#104.732164
		$hash = $this->post('hash');
		$dosen_nip = $this->post('dosen_nip');
		//$dosen_nip = '008';
		//$hash = 'mN7k+w273/Aa+JtpwH5bD/s9zvmhKxtPNaNz8UtEeeE=#$&#*#-2.9851756#$&#*#104.732164';


		if(empty($hash) && empty($dosen_nip)){
			$res = [
				'status' => 'error',
				'message' => 'Maaf, Parameter yang dikirim tidak lengkap'
			];
		} else {
			$has_explode = explode("#$&#*#",$hash);
			$kode = $has_explode[0];
			$latitude = $has_explode[1];
			$longitude = $has_explode[2];

			$cek_dosen = $this->dosen_m->get_row(['dosen_nip' => $dosen_nip]);
			if(empty($cek_dosen) || $cek_dosen == null){
				$res = [
					'status' => 'error',
					'message' => 'Maaf, data dosen tersebut tidak terdaftar dalam sistem kami'
				];
			} else {
				$haskey = $this->libencrypt->decData($kode);
				if($haskey == false){
					$res = [
						'status' => 'error',
						'message' => 'Maaf, kode enkripsi yang anda kirim tidak tersedia dalam sistem kami'
					];
				} else {
					$explode_hash = explode("#@#", $haskey);
					$ruang_id = $explode_hash[0];
					$gedung_id = $explode_hash[1];
					$ruang_kode = $explode_hash[2];
					$ruang_lantai = $explode_hash[3];

					$cek_ruang = $this->ruang_m->get_row(['ruang_id' => $ruang_id]);

					if(empty($cek_ruang)){
						$res = [
							'status' => 'error',
							'message' => 'Maaf, ruangan tidak tersedia'
						];
					} else {
						$lat = $cek_ruang->ruang_latitude;
						$long = $cek_ruang->ruang_longitude;

						$jarak = $this->libunsripenjadwalan->distance($latitude,$longitude,$lat,$long,'M');

						if($jarak > 20){
							$res = [
								'status' => 'error',
								'message' => 'Maaf, jarak lokasi anda terlalu jauh'
							];
						} else {
							$hari = $this->libunsripenjadwalan->getday();
							$dosen_id = $cek_dosen->dosen_id;
							$cek_jadwal = $this->jadwal_m->get_row(['dosen_id' => $dosen_id,'jadwal_hari' => $hari,'ruang_id'=>$ruang_id]);

							if(empty($cek_jadwal)){
								$res = [
									'status' => 'error',
									'message' => 'Maaf, jadwal tidak tersedia'
								];
							} else {
								$cek_absen = $this->absen_m->get_row(['jadwal_id' => $cek_jadwal->jadwal_id,'dosen_id'=> $cek_dosen->dosen_id,'DATE(absen_waktu)' => date('Y-m-d')]);

								if(!empty($cek_absen)){
									$res = [
										'status' => 'error',
										'message' => 'Maaf, anda sudah melakukan checkin'
									];
								} else {
									$absen = [
										'jadwal_id' => $cek_jadwal->jadwal_id,
										'dosen_id' => $dosen_id,
										'absen_status' => 'Checkin',
									];

									$ins = $this->absen_m->insert($absen);

									if($ins['sts'] == '1'){
										$up = $this->jadwal_m->update($cek_jadwal->jadwal_id,['jadwal_status' => 'Terpakai']);

										if($up == 1){
											$res = [
												'status' => 'success',
												'message' => 'Sukses melakukan checkin'
											];
										} else {
											$res = [
												'status' => 'error',
												'message' => 'Maaf, gagal memperbaharui status ruangan'
											];
										}
									} else {
										$res = [
											'status' => 'error',
											'message' => 'Maaf, gagal melakukan checkin ruangan'
										];
									}
								}
							}
						}
					}
				}
			}
		}

		echo json_encode($res);
	}


	public function checkout(){
		//mN7k+w273/Aa+JtpwH5bD/s9zvmhKxtPNaNz8UtEeeE=#$&#*#-2.9851756#$&#*#104.732164
		$hash = $this->post('hash');
		$dosen_nip = $this->post('dosen_nip');
		//$dosen_nip = '008';
		//$hash = 'mN7k+w273/Aa+JtpwH5bD/s9zvmhKxtPNaNz8UtEeeE=#$&#*#-2.9851756#$&#*#104.732164';


		if(empty($hash) && empty($dosen_nip)){
			$res = [
				'status' => 'error',
				'message' => 'Maaf, Parameter yang dikirim tidak lengkap'
			];
		} else {
			$has_explode = explode("#$&#*#",$hash);
			$kode = $has_explode[0];
			$latitude = $has_explode[1];
			$longitude = $has_explode[2];

			$cek_dosen = $this->dosen_m->get_row(['dosen_nip' => $dosen_nip]);
			if(empty($cek_dosen) || $cek_dosen == null){
				$res = [
					'status' => 'error',
					'message' => 'Maaf, data dosen tersebut tidak terdaftar dalam sistem kami'
				];
			} else {
				$haskey = $this->libencrypt->decData($kode);
				if($haskey == false){
					$res = [
						'status' => 'error',
						'message' => 'Maaf, kode enkripsi yang anda kirim tidak tersedia dalam sistem kami'
					];
				} else {
					$explode_hash = explode("#@#", $haskey);
					$ruang_id = $explode_hash[0];
					$gedung_id = $explode_hash[1];
					$ruang_kode = $explode_hash[2];
					$ruang_lantai = $explode_hash[3];

					$cek_ruang = $this->ruang_m->get_row(['ruang_id' => $ruang_id]);

					if(empty($cek_ruang)){
						$res = [
							'status' => 'error',
							'message' => 'Maaf, ruangan tidak tersedia'
						];
					} else {
						$lat = $cek_ruang->ruang_latitude;
						$long = $cek_ruang->ruang_longitude;

						$jarak = $this->libunsripenjadwalan->distance($latitude,$longitude,$lat,$long,'M');

						if($jarak > 20){
							$res = [
								'status' => 'error',
								'message' => 'Maaf, jarak lokasi anda terlalu jauh'
							];
						} else {
							$hari = $this->libunsripenjadwalan->getday();
							$dosen_id = $cek_dosen->dosen_id;
							$cek_jadwal = $this->jadwal_m->get_row(['dosen_id' => $dosen_id,'jadwal_hari' => $hari,'ruang_id'=>$ruang_id]);

							if(empty($cek_jadwal)){
								$res = [
									'status' => 'error',
									'message' => 'Maaf, jadwal tidak tersedia'
								];
							} else {

								$cek_absen = $this->absen_m->get_row(['jadwal_id' => $cek_jadwal->jadwal_id,'dosen_id'=> $cek_dosen->dosen_id,'DATE(absen_waktu)' => date('Y-m-d'),'absen_status' => 'Checkin']);

								if(empty($cek_absen)){
									$res = [
										'status' => 'error',
										'message' => 'Maaf, anda belum melakukan checkin'
									];
								} else {
									$cek_absen_out = $this->absen_m->get_row(['jadwal_id' => $cek_jadwal->jadwal_id,'dosen_id'=> $cek_dosen->dosen_id,'DATE(absen_waktu)' => date('Y-m-d'),'absen_status' => 'Checkout']);

									if(!empty($cek_absen_out)){
										$res = [
											'status' => 'error',
											'message' => 'Maaf, anda sudah melakukan checkout'
										];
									} else {
										$absen = [
											'jadwal_id' => $cek_jadwal->jadwal_id,
											'dosen_id' => $dosen_id,
											'absen_status' => 'Checkout',
										];

										$ins = $this->absen_m->insert($absen);

										if($ins['sts'] == '1'){
											$up = $this->jadwal_m->update($cek_jadwal->jadwal_id,['jadwal_status' => 'Terisi']);

											if($up == 1){
												$res = [
													'status' => 'success',
													'message' => 'Sukses melakukan checkout'
												];
											} else {
												$res = [
													'status' => 'error',
													'message' => 'Maaf, gagal memperbaharui status ruangan'
												];
											}
										} else {
											$res = [
												'status' => 'error',
												'message' => 'Maaf, gagal melakukan checkout ruangan'
											];
										}
									}
								}
							}
						}
					}
				}
			}
		}

		echo json_encode($res);
	}
}
