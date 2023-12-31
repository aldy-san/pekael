<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public $globalData;
    public function __construct() {

        parent::__construct();
		if ($this->session->userdata('user')) {
			$user = $this->db->get_where('user', ['email' => $this->session->userdata('user')['email']])->row_array();
			redirect('dashboard');
		}
        $this->globalData = [
            'withSidebar' => false,
        ];
    }
	public function login()
	{
		if ($this->input->post()){
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$user = $this->db->get_where('user', ['email' => $email])->row_array();
			if ($user){
				if (md5($password) === $user['password']){
					$this->session->set_flashdata('alertForm', 'Login Berhasil!, Selamat datang '.$user['name']);
					$this->session->set_flashdata('alertType', 'success');
					$sessionUser = [
						'email' => $user['email'],
						'role' => $user['role'],
					];
					$this->session->set_userdata('user',$sessionUser);
					redirect('dashboard');
				}else {
					$this->session->set_flashdata('alertForm', 'Password Salah');
				}
			}else {
				$this->session->set_flashdata('alertForm', 'Anda tidak terdaftar');
			}

		}
		$data = $this->globalData;
		customView('auth/login', $data);
	}
	public function register()
	{
		if ($this->input->post()){
			$user = $this->db->get_where('user', ['email' => $this->input->post('email')])->row_array();
			if(!$user){
				if ($this->input->post('password') === $this->input->post('confirm-password')){
					$form = [
						'nama' => $this->input->post('nama'),
						'npm' => $this->input->post('npm'),
						'prodi' => $this->input->post('prodi'),
						'angkatan' => $this->input->post('angkatan'),
						'email' => $this->input->post('email'),
						'password' => md5($this->input->post('password')),
						'role' => 'mahasiswa',
					];

					$this->db->insert('user', $form);
					$this->session->set_flashdata('alertForm', 'Akun berhasil dibuat');
					$this->session->set_flashdata('alertType', 'success');
					redirect('login');
				}else{
					$this->session->set_flashdata('alertForm', 'Konfirmasi Password tidak sama');
				}
			}else {
					$this->session->set_flashdata('alertForm', 'Email sudah terdaftar');
			}
		}
		$data = $this->globalData;
		customView('auth/register', $data);
	}
}
