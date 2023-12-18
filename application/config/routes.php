<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Auth/login';
$route['register'] = 'Auth/register';
$route['logout'] = 'Logged/logout';
$route['dashboard'] = 'Logged/index';
$route['profile/edit'] = 'Logged/profile_edit';
$route['profile/change-password'] = 'Logged/profile_change_password';

$route['berkas'] = 'Mahasiswa/berkas';
$route['berkas/edit'] = 'Mahasiswa/berkas_edit';
