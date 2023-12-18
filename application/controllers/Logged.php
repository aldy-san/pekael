<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logged extends CI_Controller {
	public $globalData;
	public function __construct() {
        parent::__construct();
		if ($this->session->userdata('user')) {
			$user = $this->db->get_where('user', ['email' => $this->session->userdata('user')['email']])->row_array();
		}else{
			redirect('login');
		}
		$this->globalData = [
            'withSidebar' => true,
			'user' => $user,
			'check_berkas' => is_null($this->db->get_where('berkas_syarat', ['id_mahasiswa' => $user['id']])->row_array()),
        ];
    }
	public function logout()
	{
        if ($this->session->userdata('user')){
            $this->session->unset_userdata('user');
        }
        redirect('');
	}
	public function index()
	{
		$data = $this->globalData;
		customView('dashboard', $data);
	}
	public function profile_edit()
	{
		if ($this->input->post()){
			$form = [
				'nama' => $this->input->post('nama'),
				'npm' => $this->input->post('npm'),
				'angkatan' => $this->input->post('angkatan'),
				'prodi' => $this->input->post('prodi'),
			];
			$this->db->where(['email' => $this->globalData['user']['email']])->update('user', $form);
			$this->globalData['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('user')['email']])->row_array();
			$this->session->set_flashdata('alertForm', 'Data berhasil diubah');
			$this->session->set_flashdata('alertType', 'success');
		}
		$data = $this->globalData;
		redirect('dashboard');
	}
	public function profile_change_password()
	{
		if ($this->input->post()){
			$oldPassword = $this->input->post('old-password');
			$password = $this->input->post('password');
			$confirmPassword = $this->input->post('confirm-password');
			if($password === $confirmPassword){
				if(md5($oldPassword) === $this->globalData['user']['password']){
					$form = ['password' => md5($this->input->post('password')),];
					$this->db->where(['email' => $this->globalData['user']['email']])->update('user', $form);
					$this->session->set_flashdata('alertForm', 'Password berhasil diubah');
					$this->session->set_flashdata('alertType', 'success');
				}else {
					$this->session->set_flashdata('alertForm', 'Password lama salah');
					$this->session->set_flashdata('alertType', 'danger');
				}
			}else {
				$this->session->set_flashdata('alertForm', 'Konfirmasi password tidak sama');
				$this->session->set_flashdata('alertType', 'danger');
			}
		}
		$data = $this->globalData;
		redirect('dashboard');
	}
	public function pengajuan()
	{
		$data = $this->globalData;
		$data['title'] = 'Pengajuan';
		$data['base'] = 'pengajuan';
		if ($data['user']['role'] === 'mahasiswa'){
			$data['data'] = $this->db->order_by('id', 'DESC')->get_where($data['base'],['id_mahasiswa' => $data['user']['id']])->result_array();
			$inserted = [];
		} else if ($data['user']['role'] === 'admin'){
			$data['data'] = $this->db->select('pengajuan.*, u.nama as nama_mahasiswa, b.*, pengajuan.id as id')->order_by('pengajuan.id', 'DESC')->join('user u', 'u.id = pengajuan.id_mahasiswa', 'left')->join('berkas_syarat b', 'b.id_mahasiswa = pengajuan.id_mahasiswa', 'left')->get_where($data['base'],[])->result_array();
			$inserted = [
				[
					'title' => 'Nama Mahasiswa',
					'key' => 'nama_mahasiswa',
					'type' => 'string',
					'default' => '(Belum ada)'
				],
				[
					'title' => 'Berkas Persyaratan',
					'key' => '#berkasModal',
					'type' => 'modal',
					'default' => '(Belum ada)'
				]
			];
			$data['access'] = [];
		}

		$data['columns'] = [
			[
				'title' => 'Judul',
				'key' => 'judul',
				'type' => 'string',
				'default' => '(Belum ada)'
			],
			[
				'title' => 'Permasalahan',
				'key' => 'permasalahan',
				'type' => 'string',
				'default' => '(Belum ada)'
			],
			[
				'title' => 'File Pra-Proposal',
				'key' => 'proposal',
				'type' => 'file',
				'default' => '(Belum ada)'
			],
			[
				'title' => 'Tanggal',
				'key' => 'tanggal',
				'type' => 'string',
				'default' => '(Belum ada)'
			],
			[
				'title' => 'Surat Tugas',
				'key' => 'surat_tugas',
				'type' => 'file',
				'default' => '(Belum ada)'
			],
			[
				'title' => 'Status',
				'key' => 'status',
				'type' => 'status',
				'default' => '(Belum ada)'
			],
		];

		array_splice($data['columns'], 1, 0, $inserted);

		$data['check_berkas'] = is_null($this->db->get_where('berkas_syarat', ['id_mahasiswa' => $data['user']['id']])->row_array());
		if ($data['check_berkas'] && $data['user']['role'] === 'mahasiswa') {
			$data['warning'] = 'Anda belum memasukkan berkas persyaratan. Lengkapi Berkas Persyaratan untuk mengajukan judul.';
		}
		customView('layouts/table_page', $data);
	}
}
