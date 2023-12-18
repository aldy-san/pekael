<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public $globalData;
	public function __construct() {
        parent::__construct();
		if ($this->session->userdata('user')) {
			$user = $this->db->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
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

	public function dosen()
	{
		$data = $this->globalData;
		$data['base'] = 'dosen';
		$data['data'] = $this->db->select('u.*, COUNT(u.id) as total, p.status')->join('pkl p', 'p.id_dosen = u.id', 'left')->order_by('u.id', 'DESC')->group_by('u.id,p.id_mahasiswa')->where("role = 'dosen' AND (p.status != 4 OR p.status is NULL)")->get('user u')->result_array();
		foreach ($data['data'] as $key => $value) {
			if(!$value['status']){
				$data['data'][$key]['total'] = "0";
			}
		}
		$data['title'] = "Dosen";
		$data['columns'] = [
			[
				'title' => 'NIP',
				'key' => 'username',
				'type' => 'string'
			],
			[
				'title' => 'Nama Dosen',
				'key' => 'name',
				'type' => 'string'
			],
			[
				'title' => 'Total Bimbingan',
				'key' => 'total',
				'type' => 'string',
				'default' => '0'
			],
		];
		customView('layouts/table_page', $data);
	}
	public function dosen_add()
	{
		$data = $this->globalData;
		$data['base'] = 'dosen';
		$data['title'] = 'Tambah Dosen';
		$data['isEdit'] = true;
		$user = $this->db->get_where('user', ['username' => $this->input->post('username')])->row_array();
		if(!$user){
			if($this->input->post()){
				$form = [
					'username' => $this->input->post('username'),
					'name' => $this->input->post('name'),
					'password' => md5($this->input->post('password')),
					'role' => 'dosen'
				];
				$this->db->insert('user', $form);
				$this->session->set_flashdata('alertForm', 'Tambah data berhasil');
				$this->session->set_flashdata('alertType', 'success');
				redirect($data['base']);
			}
		}else {
			$this->session->set_flashdata('alertForm', 'Username sudah ada');
			$this->session->set_flashdata('alertType', 'danger');
		}
		customView('forms/dosen', $data);
	}
	public function dosen_detail($id)
	{
		$data = $this->globalData;
		$data['base'] = 'dosen';
		$data['title'] = 'Detail Dosen';
		$data['isEdit'] = false;
		$data['data'] = $this->db->get_where('user', ['id' => $id])->row_array();
		customView('forms/dosen', $data);
	}
	public function dosen_edit($id)
	{
		$data = $this->globalData;
		$data['base'] = 'dosen';
		$data['title'] = 'Edit Dosen';
		$data['isEdit'] = true;
		if($this->input->post()){
			$form = [
				'username' => $this->input->post('username'),
				'name' => $this->input->post('name'),
				'password' => md5($this->input->post('password')),
				'role' => 'dosen'
			];
			$this->db->where(['id' => $id])->update('user', $form);
			$this->session->set_flashdata('alertForm', 'Tambah data berhasil');
			$this->session->set_flashdata('alertType', 'success');
			redirect($data['base']);
		}
		$data['data'] = $this->db->get_where('user', ['id' => $id])->row_array();
		customView('forms/dosen', $data);
	}
	public function dosen_delete()
	{
		$data['base'] = 'dosen';
		$this->db->where(['id' => $this->input->post('id')])->delete('user');
        $this->session->set_flashdata('alertForm', 'Hapus data berhasil');
		$this->session->set_flashdata('alertType', 'success');
        redirect($data['base']);
	}
	
	public function pkl_edit($id)
	{
		$data = $this->globalData;
		$data['base'] = 'pkl';
		if($this->input->post()){
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
					'id_dosen' => $this->input->post('id_dosen'),
					'status' => 2
				],
				$file_data
			);
			$this->db->where(['id' => $id])->update($data['base'], $form);
			$this->session->set_flashdata('alertForm', 'Edit Dosen berhasil');
			$this->session->set_flashdata('alertType', 'success');
			redirect($data['base']);
		}
	}
	public function pkl_edit_penguji($id)
	{
		$data = $this->globalData;
		$data['base'] = 'pkl';
		if($this->input->post()){
			$form = [
				'id_penguji' => $this->input->post('id_penguji'),
				'status' => 4
			];
			$this->db->where(['id' => $id])->update($data['base'], $form);
			$this->session->set_flashdata('alertForm', 'Edit Dosen berhasil');
			$this->session->set_flashdata('alertType', 'success');
			redirect($data['base']);
		}
	}
}
