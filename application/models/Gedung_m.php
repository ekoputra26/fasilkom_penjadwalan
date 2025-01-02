<?php 

class Gedung_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'gedung';
		$this->data['primary_key']	= 'gedung_id';
	}
}