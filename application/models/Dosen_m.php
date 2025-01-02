<?php 

class Dosen_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'dosen';
		$this->data['primary_key']	= 'dosen_id';
	}
}