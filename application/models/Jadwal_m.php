<?php

class Jadwal_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'jadwal';
		$this->data['primary_key']	= 'jadwal_id';
	}

	public function group_jam(){
		$q = $this->db->query("SELECT jadwal_jam_masuk,jadwal_jam_keluar FROM jadwal GROUP BY jadwal_jam_masuk,jadwal_jam_keluar ORDER BY jadwal_jam_masuk ASC")->result();

		return $q;
	}

	public function group_gedung($day){
		$q = $this->db->query("SELECT a.ruang_id,b.ruang_kode,c.gedung_nama FROM jadwal a INNER JOIN ruang b ON a.ruang_id=b.ruang_id INNER JOIN gedung c ON b.gedung_id=c.gedung_id  WHERE a.jadwal_hari='$day' GROUP BY c.gedung_id ORDER BY c.gedung_nama ASC")->result();

		return $q;
	}

	public function get_data_id($id){
		$q=$this->db->query("SELECT 
			a.*,b.mk_nama,c.ruang_kode,c.ruang_status,b.prodi_id 
			FROM jadwal a INNER JOIN mata_kuliah b ON a.mk_id=b.mk_id INNER JOIN ruang c ON a.ruang_id=c.ruang_id INNER JOIN gedung d ON c.gedung_id=d.gedung_id WHERE a.jadwal_id = '$id' ORDER BY a.jadwal_id ASC")->row();

		$res = [];
		if(!empty($q)){
			$res = [
				'jadwal' => $q,
				'dosen' => $this->get_dosen_jadwal($q->jadwal_id)
			];
		}

		return $res;
	}

	public function get_data($ta_id,$gedung){
		$q=$this->db->query("SELECT 
			a.*,b.mk_nama,b.mk_kode,b.sks as mk_sks,c.ruang_kode,c.ruang_status,e.prodi_warna,b.prodi_id 
			FROM jadwal a 
			INNER JOIN mata_kuliah b ON a.mk_id=b.mk_id 
			INNER JOIN ruang c ON a.ruang_id=c.ruang_id 
			INNER JOIN gedung d ON c.gedung_id=d.gedung_id 
			INNER JOIN prodi e ON b.prodi_id=e.prodi_id 
			WHERE a.ta_id = '$ta_id' AND d.gedung_lokasi = '$gedung' ORDER BY a.jadwal_id ASC")->result();

		$res = [];
		if(count($q) > 0){
			foreach($q as $i){
				$res[] = [
					'jadwal' => $i,
					'dosen' => $this->get_dosen_jadwal($i->jadwal_id)
				];
			}
		}

		return $res;
	}
	public function get_jadwal_per_prodi($prodi, $ta_id){
		$listJadwal =  $this->listJadwalPerProdi($prodi, $ta_id);
		foreach ($listJadwal as $index => $jadwal){
			$listJadwal[$index]->dosen = $this->get_dosen_jadwal($jadwal->jadwal_id);
		}
		return $listJadwal;
	}
	public function get_dosen_jadwal($jadwal_id){
		$q = $this->db->query("SELECT * FROM dosen_jadwal a INNER JOIN dosen b ON a.dosen_id=b.dosen_id WHERE a.jadwal_id = '$jadwal_id' order by dj_id asc")->result();

		return $q;
	}

	public function get_jadwal_ruangan($ta_id){
		$q  =$this->db->query("SELECT 
			a.*,b.mk_nama,c.ruang_kode,e.dosen_nama,c.ruang_status 
			FROM jadwal a INNER JOIN mata_kuliah b ON a.mk_id=b.mk_id INNER JOIN ruang c ON a.ruang_id=c.ruang_id INNER JOIN dosen e ON a.dosen_id=e.dosen_id WHERE a.ta_id = '$ta_id' ORDER BY a.jadwal_id ASC")->result();
		return $q;
	}
	private function listJadwalPerProdi($prodi, $ta_id){
		$prodi = $prodi == 'all' ? 'IS NOT NULL' : ' = '.$prodi;
		$ta_id = $ta_id  ? $ta_id : 3;
		return $this->db->query("
			SELECT jadwal.*, mata_kuliah.mk_nama, mata_kuliah.mk_kode, mata_kuliah.prodi_id, ruang.ruang_kode, ruang.ruang_lantai, gedung.gedung_nama, gedung.gedung_lokasi
			FROM jadwal
			LEFT JOIN mata_kuliah ON jadwal.mk_id = mata_kuliah.mk_id
			LEFT JOIN ruang ON jadwal.ruang_id = ruang.ruang_id
			LEFT JOIN gedung ON ruang.gedung_id = gedung.gedung_id
			WHERE jadwal.ta_id = '$ta_id' AND mata_kuliah.prodi_id $prodi
		")->result();
	}
	public function validateJadwalBaru($dosen_id, $hari, $jam_masuk, $jam_keluar, $ruang_id, $jadwal_kelas) {

		$ta = $this->getTahunAjaranAktif()[0];
		$konflikLokasi = $this->cekKonflikLokasiDosen($dosen_id,$hari, $ta, $ruang_id);
		$result = '';
		if (!empty($konflikLokasi)) {
			foreach ($konflikLokasi as $konflik) {
				$result .=  "Dosen " . $konflik['dosen_nama'] . " sudah terjadwal di " . $konflik['gedung_lokasi'] . "  pada hari " . $konflik['jadwal_hari'] . "<br> ";
			}
		} else {
			$result = "";
		}
		return $result;
	}

	private function getGedungIdByRuangId($ruang_id) {
		$query = $this->db->query("SELECT gedung_lokasi FROM ruang LEFT JOIN gedung on ruang.gedung_id = gedung.gedung_id WHERE ruang_id = ?", array($ruang_id));
		return $query->row()->gedung_lokasi;
	}

	private function getTahunAjaranAktif() {
		$query = $this->db->query("SELECT ta_id FROM tahun_ajaran WHERE ta_status = 'Aktif'");
		$ta_aktif = [];
		foreach ($query->result() as $row) {
			$ta_aktif[] = $row->ta_id;
		}
		return $ta_aktif[0];
	}
	private function cekKonflikLokasiDosen($dosen_ids, $tanggal, $ta, $ruang_id) {
		$this->db->select('j.jadwal_id, j.jadwal_kelas, j.jadwal_hari, r.gedung_id, g.gedung_lokasi, dos.dosen_nama, COUNT(g.gedung_lokasi) AS jumlah_kehadiran');
		$this->db->from('jadwal j');
		$this->db->join('dosen_jadwal dj', 'dj.jadwal_id = j.jadwal_id');
		$this->db->join('ruang r', 'r.ruang_id = j.ruang_id');
		$this->db->join('gedung g', 'g.gedung_id = r.gedung_id');
		$this->db->join('dosen dos', 'dj.dosen_id = dos.dosen_id');
		$this->db->where_in('dj.dosen_id', $dosen_ids);
		$this->db->where('j.jadwal_hari', $tanggal);
		$this->db->where('g.gedung_lokasi !=', $this->getGedungIdByRuangId($ruang_id));
		$this->db->where('j.ta_id', $ta);
		$this->db->group_by('dj.dosen_id, g.gedung_lokasi');

		$query = $this->db->get();

		return $query->result_array();
	}
}
