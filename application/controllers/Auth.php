<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public $globalData;
    public function __construct() {

        parent::__construct();
		if ($this->session->userdata('user')) {
			$user = $this->db->get_where('user', ['username' => $this->session->userdata('user')['username']])->row_array();
			$this->_redirect($user['role']);
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
			//var_dump(md5($password) === $user['pasword']);
			//var_dump(md5($password));
			//var_dump($user); die;
			if ($user){
				if (md5($password) === $user['password']){
					$this->session->set_flashdata('alertForm', 'Login Successfully');
					$this->session->set_flashdata('alertType', 'success');
					$sessionUser = [
						'username' => $user['username'],
						'role' => $user['role'],
					];
					$this->session->set_userdata('user',$sessionUser);
					$this->_redirect($user['role']);
				}else {
					$this->session->set_flashdata('alertForm', 'Wrong Password');
				}
			}else {
				$this->session->set_flashdata('alertForm', 'You are not registered');
			}

		}
		$data = $this->globalData;
		customView('auth/login', $data);
	}
	private function _redirect($role){
		if ($role === 'mahasiswa'){
			redirect('dashboard');
		}
		//else if (getRole($level) === 'mahasiswa') {
		//	redirect('/mahasiswa/dashboard');
		//} else if (getRole($level) === 'dosen') {
		//	redirect('/dosen/dashboard');
		//} else if (getRole($level) === 'tendik'){
		//	redirect('/tendik/dashboard');
		//}
	}
}
