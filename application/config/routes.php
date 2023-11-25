<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Auth/login';
$route['register'] = 'Auth/register';
$route['logout'] = 'Home/logout';
$route['dashboard'] = 'Logged/index';
$route['profile/edit'] = 'Logged/profile_edit';
$route['profile/change-password'] = 'Logged/profile_change_password';

$route['program'] = 'Mahasiswa/program';
$route['program/add'] = 'Mahasiswa/program_add';
$route['program/detail/(:num)'] = 'Mahasiswa/program_detail/$1';
$route['program/edit/(:num)'] = 'Mahasiswa/program_edit/$1';
$route['program/delete'] = 'Mahasiswa/program_delete';
