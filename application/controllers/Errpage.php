<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errpage extends CI_Controller {

	public function notfound_err()
	{
		$this->data['title']    = 'Not Found';
		$this->load->view('errpage/error_404', $this->data);
	}


	public function nojs_err()
	{
		$this->data['title']    = 'Not Acceptable';
		$this->load->view('errpage/error_406', $this->data);
	}
}
