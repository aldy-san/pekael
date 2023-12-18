<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public $globalData;
    public function __construct() {

        parent::__construct();
		if ($this->session->userdata('user')) {
			$user = $this->db->get_where('user', ['email' => $this->session->userdata('user')['email']])->row_array();
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
	public function berkas()
	{
		$data = $this->globalData;
		$data['isEdit'] = false;
		$data['list_file'] = [
			[
				'title' => 'Form Lab',
				'key' => 'form_lab'
			],
			[
				'title' => 'Transkrip',
				'key' => 'transkrip'
			],
			[
				'title' => 'KRS',
				'key' => 'krs'
			],
			[
				'title' => 'Nilai Laporan PKL',
				'key' => 'nilai_laporan_pkl'
			],
			[
				'title' => 'Nilai Laporan MSIB',
				'key' => 'nilai_laporan_msib'
			],
			[
				'title' => 'Jurnal Nasional',
				'key' => 'jurnal_nasional'
			],
			[
				'title' => 'Jurnal Internasional',
				'key' => 'jurnal_internasional'
			],
			[
				'title' => 'Review Jurnal',
				'key' => 'review_jurnal'
			],
			[
				'title' => 'Point SKPM',
				'key' => 'point_skpm'
			],
		];
		$data['base'] = 'berkas';
		$data['data'] = $this->db->get_where('berkas_syarat', ['id_mahasiswa' => $data['user']['id']])->row_array();
		//var_dump($data['data']);die;
		$withEdit = true;
		customView('forms/berkas', $data);
	}
	public function berkas_edit()
	{
		$data = $this->globalData;
		$data['isEdit'] = true;
		$data['list_file'] = [
			[
				'title' => 'Form Lab',
				'key' => 'form_lab'
			],
			[
				'title' => 'Transkrip',
				'key' => 'transkrip'
			],
			[
				'title' => 'KRS',
				'key' => 'krs'
			],
			[
				'title' => 'Nilai Laporan PKL',
				'key' => 'nilai_laporan_pkl'
			],
			[
				'title' => 'Nilai Laporan MSIB',
				'key' => 'nilai_laporan_msib'
			],
			[
				'title' => 'Jurnal Nasional',
				'key' => 'jurnal_nasional'
			],
			[
				'title' => 'Jurnal Internasional',
				'key' => 'jurnal_internasional'
			],
			[
				'title' => 'Review Jurnal',
				'key' => 'review_jurnal'
			],
			[
				'title' => 'Point SKPM',
				'key' => 'point_skpm'
			],
		];
		$data['base'] = 'berkas';
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
					'id_mahasiswa' => $data['user']['id']
				],
				$file_data
			);
			if($data['data'] !== NULL){
				$this->db->where(['id_mahasiswa' => $data['user']['id']])->update('berkas_syarat', $form);
			}else {
				$this->db->insert('berkas_syarat', $form);
			}
			redirect('berkas');
		}
		$data['data'] = $this->db->get_where('berkas_syarat', ['id_mahasiswa' => $data['user']['id']])->row_array();
		//var_dump($data['data']);die;
		customView('forms/berkas', $data);
	}

	public function pengajuan_add()
	{
		$data = $this->globalData;
		$data['base'] = 'pengajuan';
		$data['title'] = 'Ajukan Judul';
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
					'judul' => $this->input->post('judul'),
					'permasalahan' => $this->input->post('permasalahan'),
					'tanggal' => $this->input->post('tanggal'),
					'status' => "diajukan"
				],
				$file_data
			);
			$this->db->insert($data['base'], $form);
			$this->session->set_flashdata('alertForm', 'Tambah data berhasil');
			$this->session->set_flashdata('alertType', 'success');
			redirect($data['base']);
		}
		customView('forms/pengajuan', $data);
	}
	public function pengajuan_edit($id)
	{
		$data = $this->globalData;
		$data['base'] = 'pengajuan';
		$data['title'] = 'Edit Pengajuan Judul';
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
					'judul' => $this->input->post('judul'),
					'permasalahan' => $this->input->post('permasalahan'),
					'tanggal' => $this->input->post('tanggal'),
					'status' => "diajukan"
				],
				$file_data
			);
			$this->db->where(['id' => $id])->update($data['base'], $form);
			$this->session->set_flashdata('alertForm', 'Tambah data berhasil');
			$this->session->set_flashdata('alertType', 'success');
			redirect($data['base']);
		}
		$data['data'] = $this->db->get_where($data['base'], ['id' => $id])->row_array();
		customView('forms/pengajuan', $data);
	}
	public function pengajuan_detail($id)
	{
		$data = $this->globalData;
		$data['base'] = 'pengajuan';
		$data['title'] = 'Detail Pengajuan Judul';
		$data['isEdit'] = false;
		$data['data'] = $this->db->get_where($data['base'], ['id' => $id])->row_array();
		customView('forms/pengajuan', $data);
	}
	
	public function pengajuan_delete()
	{
		$data['base'] = 'pengajuan';
		$this->db->where(['id' => $this->input->post('id')])->delete($data['base']);
        $this->session->set_flashdata('alertForm', 'Hapus data berhasil');
		$this->session->set_flashdata('alertType', 'success');
        redirect($data['base']);
	}
}
