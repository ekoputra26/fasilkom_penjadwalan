<?php
defined('BASEPATH') or exit('No direct script allowed');
class Home extends MY_Controller
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
		$this->data['groupTitle'] = 'Dashboard';

		$this->load->model('jadwal_m');
		$this->load->model('ruang_m');
		$this->load->model('mata_kuliah_m');
		$this->load->model('dosen_m');
		$this->load->model('prodi_m');
		$this->load->model('dosen_jadwal_m');
		$this->load->model('tahun_ajaran_m');
		$this->load->library('libunsripenjadwalan');

		$this->load->model('gedung_m');
		$this->data['groupTitle'] = 'Data Jadwal';
		$this->data['ta'] = $this->tahun_ajaran_m->get_row(['ta_status' => 'Aktif']);
	}


	function jadwalRuang($hari,$ta_id){
		$ruang = $this->ruang_m->get();
		foreach($ruang as $i){
			$data[] =[
				'ruang_kode'=>$i->ruang_kode,
				'ruang_status'=>$i->ruang_status,
				'jadwal' => $this->dataJadwal($hari,$i->ruang_id,$i->ruang_status,$ta_id),
			];
		}
		return $data;
	}

	function dataJadwal($hari,$ruang,$status,$ta_id){
		$ta_id = $this->data['ta']->ta_id;
		$q = $this->db->query("SELECT * FROM jadwal a
			INNER JOIN dosen b ON a.dosen_id=b.dosen_id
			INNER JOIN mata_kuliah c ON a.mk_id=c.mk_id WHERE a.jadwal_hari = '$hari' && a.ruang_id = '$ruang'
			&& a.ta_id = '$ta_id'
			ORDER BY a.ruang_id,a.jadwal_jam_masuk
			")->result();
		$data =[];

		$tb = range(1,108);
		$tl = [];
		$dx = [];
		foreach($q as $i){
			$dx[]  = [
				'dosen_nip' => $i->dosen_nip,
				'dosen_nama' => $i->dosen_nama,
				'jadwal_kelas' => $i->jadwal_kelas,
				'mk_kode' => $i->mk_kode,
				'mk_nama' => $i->mk_nama,
				'ruang_status' => $status,
				'jadwal_status' => $i->jadwal_status,
				'range' => (int)count(range($this->libunsripenjadwalan->hoursToMinutes($i->jadwal_jam_masuk),$this->libunsripenjadwalan->hoursToMinutes($i->jadwal_jam_keluar))),
				'start' => (int)$this->libunsripenjadwalan->hoursToMinutes($i->jadwal_jam_masuk),
				'end' => (int)$this->libunsripenjadwalan->hoursToMinutes($i->jadwal_jam_keluar),
				'jam_masuk' =>$i->jadwal_jam_masuk,
				'jam_keluar' =>$i->jadwal_jam_keluar,
			];

			for($j=$this->libunsripenjadwalan->hoursToMinutes($i->jadwal_jam_masuk);$j<=$this->libunsripenjadwalan->hoursToMinutes($i->jadwal_jam_keluar);$j++){
				$tl[$j] = $j;	
			}
		}
		$dataTL=[];
		$lastOut=0;
		for($i=1;$i<=120;$i++){
			$dataTL[$i] = '<td></td>';
			foreach($dx as $w => $j){
				if(in_array($i,$tl)){
					unset($dataTL[$i]);
				}
				if($w>0){
					if($dx[($w-1)]['jam_keluar'] == $j['jam_masuk']){
						$lastOut=0;
					} else {
						$lastOut=1;
					}
				} else {
					$lastOut=1;
				}
				$dataTL[$j['start']] = "<td class='text-center text-white bg-".$this->libunsripenjadwalan->getColorJadwal($j['jadwal_status'],$j['ruang_status'])."' colspan='".($j['end'] - $j['start']+$lastOut)."'>
				<b>".$j['dosen_nama']."</b><br><span class='badge badge-dark'>".$j['jadwal_kelas']."</span><br><span class='badge badge-primary'>".$j['jam_masuk'] . ' s/d '. $j['jam_keluar'] ."</span><br>(".$j['mk_nama'].")
				</td>";
			}
		}

		$res = [
			'timeline' => $dataTL,
		];

		return $res;
	}

	function generateRuang($start,$end){
		$data = [];
		for($i=1;$i<=108;$i++){
			$data[$i] = 'n';
			if($i >= $start && $i <= $end){
				$data[$i] = 'y';
			}
		}

		return $data;
	}

	public function index()
	{

		$arr =['Selesa','Rabu','Kamis','Jumat','Sabtu'];
		$data = [];
		foreach($arr as $i){
			$data[] =[
				'hari' => $i,
				'ruang' => $this->jadwalRuang($i, '8'),
			];
		}
		$jam = [];
		for($i=8;$i<=17;$i++){
			if($i < 10){
				$jam[] = '0'.$i.':00';
			} else {
				$jam[] = $i.':00';
			}
		}

		$this->data['jam'] = $jam;
		$this->data['jadwalAktif'] = $data;
		$ext_foot = [
			'<script src="'.backend_url().'assets/vendor_components/echarts/dist/echarts-en.min.js"></script>',
			'<script src="'.backend_url().'assets/vendor_components/chart.js-master/Chart.min.js"></script>',
			'<script src="'.backend_url().'js/custom.js"></script>',
			'<script src="'.backend_url().'js/custom/dashboard.js"></script>',
		];
		$data_barang = [];
		$barang = $this->db->query("SELECT barang_nama,COUNT(*) as total FROM `barang` GROUP BY barang_nama")->result();
		foreach($barang as $i){
			$data_barang[] = [
				'barang' => $i,
				'detail' => $this->db->query("SELECT 'Baik' as barang_kondisi,COUNT(*) as total FROM `barang` WHERE barang_nama = '$i->barang_nama' && barang_kondisi='Baik'
					UNION ALL
					SELECT barang_kondisi,COUNT(*) as total FROM `barang` WHERE barang_nama = '$i->barang_nama' && barang_kondisi='Sedang'
					UNION ALL
					SELECT 'Buruk' as barang_kondisi,COUNT(*) as total FROM `barang` WHERE barang_nama = '$i->barang_nama' && barang_kondisi='Buruk'")->result(),
			];
		}

		$this->data['total_gedung'] = count($this->gedung_m->get());
		$this->data['total_ruang'] = count($this->ruang_m->get());
		$this->data['data_barang'] = $data_barang;
		$this->data['ext_foot'] = $ext_foot;
		$this->data['gedung'] = $this->gedung_m->get();
		$this->data['group_jam'] = $this->jadwal_m->group_jam();
		$this->data['title']    = 'Dashboard';
		$this->data['content']  = 'home';
		$this->template($this->data, $this->module);
	}

	public function get_data(){
		$ta_id = $this->data['ta']->ta_id;
		$grafikJenisRuang = $this->db->query("SELECT COUNT(*) as total,ruang_jenis FROM `ruang` GROUP BY ruang_jenis")->result();	
		$grafikStatusRuang = $this->db->query("SELECT COUNT(*) as total, 'Baik' as status FROM ruang WHERE ruang_status = 'Baik' UNION ALL SELECT COUNT(*) as total, 'Rusak' as status FROM ruang WHERE ruang_status = 'Rusak' UNION ALL SELECT COUNT(*) as total, 'N/A' as status FROM ruang WHERE ruang_status = 'N/A'")->result();	
		$totalRuang = count($this->ruang_m->get());
		$grafikKodisiRuang = $this->db->query("SELECT COUNT(*) as total, 'Kosong' as kondisi FROM jadwal a 
			right JOIN ruang b ON a.ruang_id=b.ruang_id WHERE a.jadwal_id IS NULL && a.ta_id='$ta_id'
			UNION ALL
			SELECT COUNT(*) AS total, 'Terisi' as kondisi FROM jadwal WHERE jadwal.jadwal_status='Terisi' && jadwal.ta_id='$ta_id'
			UNION ALL
			SELECT COUNT(*) as total, 'Rusak' as kondisi FROM jadwal a 
			right JOIN ruang b ON a.ruang_id=b.ruang_id WHERE b.ruang_status='Rusak' && a.ta_id='$ta_id'")->result();
		$data = [
			'grafikJenisRuang' => $grafikJenisRuang,
			'grafikStatusRuang' => $grafikStatusRuang,
			'grafikKodisiRuang' => $grafikKodisiRuang,
			'totalRuang' => $totalRuang,
		];
		echo json_encode($data);
	}

	public function get_data_jadwal(){
		$gedung = $this->post('gedung');
		$gedung = str_replace("#","",$gedung);
		if($gedung == 'km5'){
			$gedung = 'KM 5';
		} else {
			$gedung = ucfirst($gedung);
		}
		$data = $this->jadwal_m->get_data($this->tahun_ajaran_m->get_row(['ta_status' => 'Aktif'])->ta_id,$gedung);
		echo json_encode($data);
	}

	public function getJadwalAktif(){
		$ta_id = $this->data['ta']->ta_id;
		$dayNow = $this->libunsripenjadwalan->getday(date('D'));
		$arr[] = $dayNow;

		$jadwal = [];
		foreach($arr as $i){
			$jadwal[] =[
				'hari' => $i,
				'ruang' => $this->jadwalRuang($i,$ta_id),
			];
		}
		$jam = [];
		for($i=8;$i<=17;$i++){
			if($i < 10){
				$jam[] = '0'.$i.':00';
			} else {
				$jam[] = $i.':00';
			}
		}
		$data = [
			'jam' => $jam,
			'jadwal' => $jadwal,
		];
		echo json_encode($data);
	}
}
