<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public $globalData;
	public function __construct() {
        parent::__construct();
		if ($this->session->userdata('user')) {
			$user = $this->db->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
			if(!$user) redirect('dashboard');
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
		$data['data'] = $this->db->order_by('id', 'DESC')->get_where('user', ['role' => 'dosen'])->result_array();
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
				'title' => 'Email',
				'key' => 'email',
				'type' => 'string'
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
					'email' => $this->input->post('email'),
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
		$data['title'] = 'Detail Program';
		$data['isEdit'] = false;
		$data['data'] = $this->db->get_where('user', ['id' => $id])->row_array();
		customView('forms/dosen', $data);
	}
	public function dosen_edit($id)
	{
		$data = $this->globalData;
		$data['base'] = 'dosen';
		$data['title'] = 'Edit Program';
		$data['isEdit'] = true;
		if($this->input->post()){
			$form = [
				'username' => $this->input->post('username'),
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
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
}
