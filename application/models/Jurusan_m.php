<?php 

class Jurusan_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'jurusan';
		$this->data['primary_key']	= 'jurusan_id';
	}
}