<?php

class MY_Controller extends CI_Controller
{
	public $title 		= 'SIPADU | @AdityaDess | AdityaDS';
	public $count_visitor;
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		ini_set('xdebug.var_display_max_depth', '10');
		ini_set('xdebug.var_display_max_children', '256');
		ini_set('xdebug.var_display_max_data', '10240');
		$this->load->helper('counter');
		$this->count_visitor = count_visitor();
		$this->load->library('PHPCount');
	}

	protected function template($data, $module = '')
	{
		$data['global_title'] 	= $this->title;
		/*if (isset($data['title'])) {
			$ptitle = $data['title'];
		} else {
			$ptitle = 'none';
		}
		for($i = 0; $i < 1; $i++)
		{
			PHPCount::AddHit($ptitle);
		}*/
		$data['module']			= $module;
		if ( strlen( $module ) > 0 ) return $this->load->view( $module . '/layouts/index', $data );
		return $this->load->view( 'layouts/index', $data );
	}

	protected function POST($name)
	{
		return $this->input->post($name);
	}

	protected function GET($name, $clean = false)
	{
		return $this->input->get($name, $clean);
	}

	protected function METHOD()
	{
		return $this->input->method();
	}

	protected function flashmsg($msg, $type = 'success',$name='msg')
	{
		return $this->session->set_flashdata($name, '<div class="alert alert-'.$type.' alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>');
	}

	protected function flashadmin($msg, $type = 'success',$name='msg')
	{
		return $this->session->set_flashdata($name, '<div class="card-alert card '.$type.'"><div class="card-content white-text"><p>'.$msg.'</p></div><button type="button" class="close white-text" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
	}

	protected function upload($id, $directory, $tag_name = 'userfile', $max_size = 0)
	{
		if ( isset( $_FILES[$tag_name] ) && !empty( $_FILES[$tag_name]['name'] ) )
		{
			$upload_path = realpath(FCPATH . $directory . '/');
			@unlink($upload_path . '/' . $id . '.jpg');
			$config = [
				'file_name' 		=> $id . '.jpg',
				'allowed_types'		=> 'jpg|png|bmp|jpeg',
				'upload_path'		=> $upload_path,
				'max_size'			=> $max_size
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
		}
		return FALSE;
	}

	
	protected function go_upload($filename = '', $dir, $allowed_file_types = '', $enc = TRUE)
	{
		if(isset($_FILES[$filename]) && !empty($_FILES[$filename]['name'])){

			if (!is_dir($dir)) {
				mkdir($dir, 0777, TRUE);
			}

			$config['upload_path'] = $dir;
			$config['allowed_types'] = $allowed_file_types;
			$config['file_name'] = $_FILES[$filename]['name'];
			$config['encrypt_name'] = $enc;

			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if($this->upload->do_upload($filename)){
				$uploadData = $this->upload->data();
				$response['filename'] = $uploadData['file_name'];
				$response['response'] = 'File berhasil diupload';
				$response['status'] = 'OK';
			} else {
				$response['response'] = 'File gagal diupload, Format harus (jpg,jpeg,png, atau pdf)';
				$response['status'] = 'Failure ';
			}

		} else {
			$response['response'] = 'Silahkan lampirkan file terlebih dahulu';
			$response['status'] = 'No Content';
		}
		return $response;
	}



	protected function dump($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}

	protected function go_back( $index ) 
	{
		echo '<script type="text/javascript">window.history.go(' . $index . ');</script>'; 
	}

	protected function check_allowance( $condition, $message = [ 'Required parameter is missing', 'danger' ], $redirect_index = -1 )
	{
		if ( $condition ) 
		{

			$this->flashmsg( $message[0], $message[1] );
			$this->go_back( $redirect_index );
			exit;

		}
	}

	protected function __generate_random_string($length = 5)
	{
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';
		for ($i = 0; $i < $length; $i++)
		{
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
		return $string;
	}

	protected function __generate_random_id() 
	{
		return mt_rand();
	}

	protected function remove_directory($path) 
	{
		$files = array_diff(scandir($path), ['.', '..']);
		foreach ($files as $file) 
		{
			if (is_dir($file))
			{
				removeDirectory($file);	
			}
			else
			{
				if (file_exists($file))
				{
					unlink($file);
				}
			}
		}
		rmdir($path);
		return;
	}
}
