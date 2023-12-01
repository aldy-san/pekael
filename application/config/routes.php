<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Auth/login';
$route['register'] = 'Auth/register';
$route['logout'] = 'Logged/logout';
$route['dashboard'] = 'Logged/index';
$route['profile/edit'] = 'Logged/profile_edit';
$route['profile/change-password'] = 'Logged/profile_change_password';

$route['dosen'] = 'Admin/dosen';
$route['dosen/add'] = 'Admin/dosen_add';
$route['dosen/detail/(:num)'] = 'Admin/dosen_detail/$1';
$route['dosen/edit/(:num)'] = 'Admin/dosen_edit/$1';
$route['dosen/delete'] = 'Admin/dosen_delete';

$route['pkl'] = 'Logged/pkl';
$route['pkl/detail/(:num)'] = 'Logged/pkl_detail/$1';
$route['pkl/edit/(:num)'] = 'Logged/pkl_edit/$1';
$route['pkl/delete'] = 'Mahasiswa/pkl_delete';

$route['pkl/add'] = 'Mahasiswa/pkl_add';

$route['pkl/edit_dosen/(:num)'] = 'Admin/pkl_edit/$1';
$route['pkl/edit_penguji/(:num)'] = 'Admin/pkl_edit_penguji/$1';
$route['pkl/edit_laporan/(:num)'] = 'Mahasiswa/pkl_edit_laporan/$1';
$route['pkl/edit_nilai/(:num)'] = 'Mahasiswa/pkl_edit_nilai/$1';
