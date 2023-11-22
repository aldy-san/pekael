<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('customView')){

function customView($viewName, $data=array()){
	$CI = &get_instance();
	$CI->load->view('layouts/header', $data);
	$CI->load->view($viewName, $data);
	$CI->load->view('layouts/footer', $data);
}
}
