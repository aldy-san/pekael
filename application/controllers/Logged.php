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
			$user = $this->db->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
			if($password === $confirmPassword){
				if(md5($oldPassword) === $user['password']){
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
}
