<?php 

class Barang_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'barang';
		$this->data['primary_key']	= 'barang_id';
	}
}