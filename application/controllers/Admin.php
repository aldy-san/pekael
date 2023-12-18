<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public $globalData;
	public function __construct() {
        parent::__construct();
		if ($this->session->userdata('user')) {
			$user = $this->db->get_where('user', ['email' => $this->session->userdata('user')['email']])->row_array();
			if(!$user || $user['role'] != 'admin') redirect('dashboard');
		}else{
			redirect('login');
		}
		$this->globalData = [
            'withSidebar' => true,
            'mainClass' => 'main',
			'user' => $user
        ];
    }

	public function pengajuan_approve()
	{
		$id = $this->input->post('id');
		$config['upload_path']	= './files';
		$config['allowed_types'] = 'pdf';
		$file_data = [];
		foreach ($_FILES as $key => $value) {
			if($value['size'] > 0){
				$file = $_FILES[$key]['name'];
				$this->load->library('upload');
				$this->upload->initialize($config);
				if (!$this->upload->do_upload($key)) {
					$file_data[$key] = '';
				} else {
					$file_data[$key] = $this->upload->data('file_name');
				}
			}
		}
		$form = array_merge(
			[
				'status' => "diterima",
			],
			$file_data
		);
		$this->db->where(['id' => $id])->update('pengajuan', $form);
		redirect('pengajuan');
	}
	public function pengajuan_reject()
	{
		$id = $this->input->post('id');
		$form = [
			'status' => "ditolak",
		];
		$this->db->where(['id' => $id])->update('pengajuan', $form);
		redirect('pengajuan');
	}
}
