<?php 

class User_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'user';
		$this->data['primary_key']	= 'user_id';
	}

	public function get_user(){
		$sql  = $this->db->query("SELECT a.user_id,a.user_nama,a.user_username,a.user_password,a.last_login,a.group_id,a.uk_id,b.group_nama,c.uk_nama FROM user a
			LEFT JOIN group_user b ON a.group_id=b.group_id
			LEFT JOIN unit_kerja c ON a.uk_id=c.uk_id
			ORDER by a.user_id DESC")->result();

		return $sql;	
	}
}