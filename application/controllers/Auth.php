<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public $globalData;
    public function __construct() {

        parent::__construct();
		if ($this->session->userdata('user')) {
			//$user = $this->d->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
			$this->_redirect($user['level']);
		}
        $this->globalData = [
            'withNavbar' => true,
        ];
    }
	public function login()
	{
		//if ($this->input->post()){
		//	$this->form_validation->set_rules('username','username','trim|required');
		//	$this->form_validation->set_rules('password','password','trim|required');
		//	if(!$this->form_validation->run()){
		//		$this->session->set_flashdata('alertForm', 'Mohon isi form dengan benar');
		//	} else {
		//		$username = $this->input->post('username');
		//		$password = $this->input->post('password');
		//		$user = $this->db_master->get_where('user', ['username' => $username])->row_array();
		//		if (!$user){
		//			$this->session->set_flashdata('alertForm', 'Anda tidak terdaftar');
		//		}

		//		if (md5($password) === $user['pasword']){
		//			$this->session->set_flashdata('alertForm', 'Anda berhasil login');
		//			$this->session->set_flashdata('alertType', 'success');
		//			$sessionUser = [
		//				'username' => $user['username'],
		//				'nama_lengkap' => $user['nama_lengkap'],
		//				'role' => $user['role'],
		//			];
		//			$this->session->set_userdata('user',$sessionUser);
		//			$this->_redirect($user['role']);
		//		}else {
		//			$this->session->set_flashdata('alertForm', 'Password Salah');
		//		}
		//	}
		//}
		$data = $this->globalData;
		customView('auth/login', $data);
	}
}
