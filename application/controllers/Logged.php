<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logged extends CI_Controller {
	public $globalData;
	public function __construct() {
        parent::__construct();
		if ($this->session->userdata('user')) {
			$user = $this->db->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
		}else{
			redirect('login');
		}
		$this->globalData = [
            'withSidebar' => true,
            'mainClass' => 'main',
			'user' => $user
        ];
    }
	public function index()
	{
		$data = $this->globalData;
		customView('dashboard', $data);
	}
	public function profile_edit()
	{
		if ($this->input->post()){
			$config['upload_path']	= './photos';
			$config['allowed_types'] = 'jpg|gif|png|jpeg';
			$file = '';
			if($_FILES['file']['size'] > 0){
				$file = $_FILES['file']['name'];
				$this->load->library('upload');
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('file')) {
					$file = '';
				} else {
					$file = $this->upload->data('file_name');
				}
			}
			$form = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
			];
			if($file){
				$form = array_merge($form, ['photo' => $file]);
			}
			$this->db->where(['username' => $this->globalData['user']['username']])->update('user', $form);
			$this->globalData['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
		}
		$data = $this->globalData;
		customView('dashboard', $data);
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
					$this->db->where(['username' => $this->globalData['user']['username']])->update('user', $form);
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
		customView('dashboard', $data);
	}

	public function pkl()
	{
		$data = $this->globalData;
		$data['base'] = 'pkl';
		if($data['user']['role'] === 'mahasiswa'){
			//$data['access'] = ['EDIT'];

			$data['data'] = $this->db->select('p.*, d.name as nama_dosen, s.status as status')->join('user d', 'd.id = p.id_dosen', 'left')->join('status s', 's.id = p.status', 'left')->order_by('id', 'DESC')->get_where($data['base'].' p', ['id_mahasiswa' => $this->globalData['user']['id']])->result_array();
			$inserted = [[
				'title' => 'Dosen Pembimbing',
				'key' => 'nama_dosen',
				'type' => 'string',
				'default' => '(Belum ada)'
			]];
		} else if($data['user']['role'] === 'admin'){
			$data['access'] = ['EDIT'];
			$data['data'] = $this->db->select('p.*, m.name as nama_mahasiswa, d.name as nama_dosen, s.status as status')->join('user m', 'm.id = p.id_mahasiswa', 'left')->join('user d', 'd.id = p.id_dosen', 'left')->join('status s', 's.id = p.status', 'left')->get($data['base'].' p')->result_array();
			$inserted = [
				[
					'title' => 'Nama Mahasiswa',
					'key' => 'nama_mahasiswa',
					'type' => 'string',
					'default' => '(Belum ada)'
				],
				[
					'title' => 'Dosen Pembimbing',
					'key' => 'nama_dosen',
					'type' => 'string',
					'default' => '(Belum ada)'
				]
			];
		} else {
			$data['access'] = ['DETAIL'];
			$data['data'] = $this->db->select('p.*, m.name as nama_mahasiswa, s.status as status')->join('user m', 'm.id = p.id_mahasiswa', 'left')->join('status s', 's.id = p.status', 'left')->order_by('id', 'DESC')->get_where($data['base'].' p', ['id_dosen' => $this->globalData['user']['id']])->result_array();
			$inserted = [[
				'title' => 'Nama Mahasiswa',
				'key' => 'nama_mahasiswa',
				'type' => 'string',
				'default' => '(Belum ada)'
			]];
		}

		//$data['data'] = $this->db->select('*, m.name as nama_mahasiswa, d.name as nama_dosen')->join('user m', 'm.id = p.id_mahasiswa')->join('user d', 'd.id = p.id_dosen')->get_where($data['base'].' p', ['id_mahasiswa' => $this->globalData['user']['id']])->result_array();
		//var_dump($data['data']);die;
		$data['title'] = "PKL";
		$data['columns'] = [
			[
				'title' => 'Status',
				'key' => 'status',
				'type' => 'status'
			],
			[
				'title' => 'Perusahaan',
				'key' => 'perusahaan',
				'type' => 'string'
			],
			[
				'title' => 'Periode Mulai',
				'key' => 'periode_mulai',
				'attr' => 'data-type="date" data-format="DD/MM/YYYY"',
				'type' => 'string'
			],
			[
				'title' => 'Periode Akhir',
				'key' => 'periode_akhir',
				'attr' => 'data-type="date" data-format="DD/MM/YYYY"',
				'type' => 'string'
			],
			[
				'title' => 'Berkas Syarat',
				'key' => 'berkas_syarat',
				'attr' => 'data-sortable="false"',
				'type' => 'file',
				'default' => '(Belum ada)'
			],
			[
				'title' => 'Surat Tugas',
				'key' => 'surat_tugas',
				'attr' => 'data-sortable="false"',
				'type' => 'file',
				'default' => '(Belum ada)'
			],
			[
				'title' => 'Data Seminar',
				'key' => '#seminarModal',
				'type' => 'modal',
				'condition' => 'DILAPORKAN,SELESAI',
				'func' => 'tes',
				'default' => '(Belum ada)'
			],
			[
				'title' => 'Data Nilai PKL',
				'key' => '#nilaiModal',
				'type' => 'modal',
				'condition' => 'SELESAI',
				'default' => '(Belum ada)'
			]
			//[
			//	'title' => 'Laporan',
			//	'key' => 'file_laporan',
			//	'attr' => 'data-sortable="false"',
			//	'type' => 'file',
			//	'default' => '(Belum ada)'
			//],
			//[
			//	'title' => 'Ruang Seminar',
			//	'key' => 'ruang_seminar',
			//	'type' => 'string',
			//	'default' => '(Belum ada)'
			//],
			//[
			//	'title' => 'Tanggal Seminar',
			//	'key' => 'tanggal_seminar',
			//	'attr' => 'data-type="datetime-local" data-format="DD/MM/YYYY hh:mm:ss"',
			//	'type' => 'string',
			//	'default' => '(Belum ada)'
			//],
			//[
			//	'title' => 'Berkas Seminar',
			//	'key' => 'berkas_seminar',
			//	'attr' => 'data-sortable="false"',
			//	'type' => 'file',
			//	'default' => '(Belum ada)'
			//],
		];
		array_splice($data['columns'], 5, 0, $inserted);
		customView('layouts/table_page', $data);
	}

	public function pkl_detail($id)
	{
		$data = $this->globalData;
		$data['base'] = 'pkl';
		$data['title'] = 'Detail PKL';
		$data['isEdit'] = false;
		$data['data'] = $this->db->get_where($data['base'], ['id' => $id])->row_array();
		$data['dosen'] = $this->db->order_by('id', 'DESC')->get_where('user', ['role' => 'dosen'])->result_array();
		customView('forms/pkl', $data);
	}

	public function pkl_edit($id)
	{
		$data = $this->globalData;
		$data['base'] = 'pkl';
		$data['title'] = 'Edit PKL';
		$data['isEdit'] = true;
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
					'id_mahasiswa' => $this->globalData['user']['id'],
					'perusahaan' => $this->input->post('perusahaan'),
					'periode_mulai' => $this->input->post('periode_mulai'),
					'periode_akhir' => $this->input->post('periode_akhir'),
					'status' => 1
				],
				$file_data
			);
			$this->db->where(['id' => $id])->update($data['base'], $form);
			$this->session->set_flashdata('alertForm', 'Edit data berhasil');
			$this->session->set_flashdata('alertType', 'success');
			redirect($data['base']);
		}
		$data['dosen'] = $this->db->order_by('id', 'DESC')->get_where('user', ['role' => 'dosen'])->result_array();
		$data['data'] = $this->db->get_where($data['base'], ['id' => $id])->row_array();
		customView('forms/pkl', $data);
	}
}
