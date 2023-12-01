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
					'status' => 5
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
}
