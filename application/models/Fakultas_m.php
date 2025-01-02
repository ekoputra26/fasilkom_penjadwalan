<?php 

class Fakultas_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'fakultas';
		$this->data['primary_key']	= 'fakultas_id';
	}
}