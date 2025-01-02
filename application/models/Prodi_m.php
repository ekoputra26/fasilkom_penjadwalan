<?php 

class Prodi_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'prodi';
		$this->data['primary_key']	= 'prodi_id';
	}
}