<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public $globalData;
    public function __construct() {

        parent::__construct();
		if ($this->session->userdata('user')) {
			$user = $this->db->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
			if(!$user || $user['role'] != 'mahasiswa') redirect('dashboard');
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
		customView('mahasiswa/dashboard', $data);
	}

	public function pkl_add()
	{
		$data = $this->globalData;
		$data['base'] = 'pkl';
		$data['title'] = 'Ajukan PKL';
		$data['isEdit'] = true;
        if($this->input->post()){
			$config['upload_path']	= './files';
			$config['allowed_types'] = 'pdf';
			$file_data = [];
			foreach ($_FILES as $key => $value) {
				if($value['size'] > 0){
					$file = $_FILES['file']['name'];
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
				],
				$file_data
			);
			$this->db->insert($data['base'], $form);
			$this->session->set_flashdata('alertForm', 'Tambah data berhasil');
			$this->session->set_flashdata('alertType', 'success');
			redirect($data['base']);
		}
		$data['dosen'] = $this->db->order_by('id', 'DESC')->get_where('user', ['role' => 'dosen'])->result_array();
		customView('forms/pkl', $data);
	}

	

	public function pkl_edit_laporan($id)
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
					'judul_laporan' => $this->input->post('judul_laporan'),
					'tanggal_seminar' => $this->input->post('tanggal_seminar'),
					'ruang_seminar' => $this->input->post('ruang_seminar'),
					'status' => 3
				],
				$file_data
			);
			$this->db->where(['id' => $id])->update($data['base'], $form);
			$this->session->set_flashdata('alertForm', 'Edit Laporan berhasil');
			$this->session->set_flashdata('alertType', 'success');
			redirect($data['base']);
		}
	}
	public function pkl_edit_nilai($id)
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
					'status' => 4
				],
				$file_data
			);
			$this->db->where(['id' => $id])->update($data['base'], $form);
			$this->session->set_flashdata('alertForm', 'Tambah Nilai berhasil');
			$this->session->set_flashdata('alertType', 'success');
			redirect($data['base']);
		}
	}

	public function pkl_delete()
	{
		$data['base'] = 'pkl';
		$this->db->where(['id' => $this->input->post('id')])->delete($data['base']);
        $this->session->set_flashdata('alertForm', 'Hapus data berhasil');
		$this->session->set_flashdata('alertType', 'success');
        redirect($data['base']);
	}

	//public function program()
	//{
	//	$data = $this->globalData;
	//	$data['base'] = 'program';
	//	$data['data'] = $this->db->get($data['base'])->result_array();
	//	//var_dump($data['data']);die;
	//	$data['title'] = "Program";
	//	$data['columns'] = [
	//		[
	//			'title' => 'Program Name',
	//			'key' => 'name',
	//			'type' => 'string'
	//		],
	//		[
	//			'title' => 'Start Date',
	//			'key' => 'start_date',
	//			'attr' => 'data-type="date" data-format="DD/MM/YYYY"',
	//			'type' => 'string'
	//		],
	//		[
	//			'title' => 'End Date',
	//			'key' => 'end_date',
	//			'attr' => 'data-type="date" data-format="DD/MM/YYYY"',
	//			'type' => 'string'
	//		],
	//		[
	//			'title' => 'File',
	//			'key' => 'file',
	//			'attr' => 'data-sortable="false"',
	//			'type' => 'file'
	//		],
	//		[
	//			'title' => 'File 2',
	//			'key' => 'file2',
	//			'attr' => 'data-sortable="false"',
	//			'type' => 'file'
	//		],
	//	];
	//	customView('layouts/table_page', $data);
	//}
	//public function program_add()
	//{
	//	$data = $this->globalData;
	//	$data['base'] = 'program';
	//	$data['title'] = 'Add Program';
	//	$data['isEdit'] = true;
    //    if($this->input->post()){
	//		$config['upload_path']	= './files';
	//		$config['allowed_types'] = 'pdf';
	//		$file_data = [];
	//		foreach ($_FILES as $key => $value) {
	//			if($value['size'] > 0){
	//				$file = $_FILES['file']['name'];
	//				$this->load->library('upload');
	//				$this->upload->initialize($config);
	//				if (!$this->upload->do_upload($key)) {
	//					$file_data[$key] = '';
	//				} else {
	//					$file_data[$key] = $this->upload->data('file_name');
	//				}
	//			}
	//		}
	//		$form = array_merge(
	//			[
	//				'name' => $this->input->post('name'),
	//				'start_date' => $this->input->post('start_date'),
	//				'end_date' => $this->input->post('end_date'),
	//			],
	//			$file_data
	//		);
	//		$this->db->insert($data['base'], $form);
	//		$this->session->set_flashdata('alertForm', 'Tambah data berhasil');
	//		$this->session->set_flashdata('alertType', 'success');
	//		redirect($data['base']);
	//	}
	//	customView('forms/program', $data);
	//}
	//public function program_detail($id)
	//{
	//	$data = $this->globalData;
	//	$data['base'] = 'program';
	//	$data['title'] = 'Detail Program';
	//	$data['isEdit'] = false;
	//	$data['data'] = $this->db->get_where($data['base'], ['id' => $id])->row_array();
	//	customView('forms/program', $data);
	//}
	//public function program_edit($id)
	//{
	//	$data = $this->globalData;
	//	$data['base'] = 'program';
	//	$data['title'] = 'Edit Program';
	//	$data['isEdit'] = true;
	//	if($this->input->post()){
	//		$config['upload_path']	= './files';
	//		$config['allowed_types'] = 'pdf';
	//		$file_data = [];
	//		foreach ($_FILES as $key => $value) {
	//			if($value['size'] > 0){
	//				$file = $_FILES[$key]['name'];
	//				$this->load->library('upload');
	//				$this->upload->initialize($config);
	//				if (!$this->upload->do_upload($key)) {
	//					$file_data[$key] = '';
	//				} else {
	//					$file_data[$key] = $this->upload->data('file_name');
	//				}
	//			}
	//		}
	//		$form = array_merge(
	//			[
	//				'name' => $this->input->post('name'),
	//				'start_date' => $this->input->post('start_date'),
	//				'end_date' => $this->input->post('end_date'),
	//			],
	//			$file_data
	//		);
	//		$this->db->where(['id' => $id])->update($data['base'], $form);
	//		$this->session->set_flashdata('alertForm', 'Edit data berhasil');
	//		$this->session->set_flashdata('alertType', 'success');
	//		redirect($data['base']);
	//	}
	//	$data['data'] = $this->db->get_where($data['base'], ['id' => $id])->row_array();
	//	customView('forms/program', $data);
	//}
	//public function program_delete()
	//{
	//	$data['base'] = 'program';
	//	$this->db->where(['id' => $this->input->post('id')])->delete($data['base']);
    //    $this->session->set_flashdata('alertForm', 'Hapus data berhasil');
	//	$this->session->set_flashdata('alertType', 'success');
    //    redirect($data['base']);
	//}
}
