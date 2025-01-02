<?php 

class Ruang_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'ruang';
		$this->data['primary_key']	= 'ruang_id';
	}

	public function group_gedung($lokasi){
		$q = $this->db->query("SELECT ruang_kode as title, ruang_id as id, ruang_lantai, gedung.gedung_nama FROM ruang LEFT JOIN gedung ON ruang.gedung_id = gedung.gedung_id WHERE gedung.gedung_lokasi = '$lokasi' ORDER BY gedung.gedung_nama AND ruang.ruang_lantai")->result();

		return $q;
	}
}
