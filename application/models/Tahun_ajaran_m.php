<?php 

class Tahun_ajaran_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'tahun_ajaran';
		$this->data['primary_key']	= 'ta_id';
	}
}