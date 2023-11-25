<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public $globalData;
    public function __construct() {

        parent::__construct();
		if ($this->session->userdata('user')) {
			$user = $this->db->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
			redirect('dashboard');
		}
        $this->globalData = [
            'withSidebar' => false,
        ];
    }
	public function login()
	{
		if ($this->input->post()){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user = $this->db->get_where('user', ['username' => $username])->row_array();
			if ($user){
				if (md5($password) === $user['password']){
					$this->session->set_flashdata('alertForm', 'Login Berhasil!, Selamat datang '.$user['name']);
					$this->session->set_flashdata('alertType', 'success');
					$sessionUser = [
						'username' => $user['username'],
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
			$user = $this->db->get_where('user', ['username' => $this->input->post('username')])->row_array();
			if(!$user){
				if ($this->input->post('password') === $this->input->post('confirm-password')){
					$form = [
						'username' => $this->input->post('username'),
						'name' => $this->input->post('name'),
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
					$this->session->set_flashdata('alertForm', 'Username sudah terdaftar');
			}
		}
		$data = $this->globalData;
		customView('auth/register', $data);
	}
}
