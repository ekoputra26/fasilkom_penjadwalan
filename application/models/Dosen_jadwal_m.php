<?php 

class Dosen_jadwal_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'dosen_jadwal';
		$this->data['primary_key']	= 'dj_id';
	}
}