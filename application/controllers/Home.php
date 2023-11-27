<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public $globalData;
	public function __construct() {
        parent::__construct();
		if ($this->session->userdata('user')) {
			redirect('dashboard');
		}
		$this->globalData = [
            'withSidebar' => false,
        ];
    }
	public function index()
	{
		$data = $this->globalData;
		customView('index', $data);
	}
}
