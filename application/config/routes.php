<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Splash'; // Jadikan halaman login default

// Rute Autentikasi
$route['login'] = 'Auth/login';
$route['register'] = 'Auth/register';
$route['logout'] = 'Auth/logout';

// Rute Dashboard
$route['dashboard'] = 'Dashboard';

// Rute Admin (Contoh untuk Users)
$route['admin/users'] = 'admin/Admin_users'; // Mengarahkan ke admin/Admin_users controller
$route['admin/users/create'] = 'admin/Admin_users/create';
$route['admin/users/edit/(:num)'] = 'admin/Admin_users/edit/$1';
$route['admin/users/delete/(:num)'] = 'admin/Admin_users/delete/$1';

// Rute Kategori
$route['admin/kategori'] = 'admin/Admin_kategori';
$route['admin/kategori/create'] = 'admin/Admin_kategori/create';
$route['admin/kategori/edit/(:num)'] = 'admin/Admin_kategori/edit/$1';
$route['admin/kategori/delete/(:num)'] = 'admin/Admin_kategori/delete/$1';

// Rute Penyelenggara
$route['admin/penyelenggara'] = 'admin/Admin_penyelenggara';
$route['admin/penyelenggara/create'] = 'admin/Admin_penyelenggara/create';
$route['admin/penyelenggara/edit/(:num)'] = 'admin/Admin_penyelenggara/edit/$1';
$route['admin/penyelenggara/delete/(:num)'] = 'admin/Admin_penyelenggara/delete/$1';

// Rute Event
$route['admin/events'] = 'admin/Admin_events';
$route['admin/events/create'] = 'admin/Admin_events/create';
$route['admin/events/edit/(:num)'] = 'admin/Admin_events/edit/$1';
$route['admin/events/delete/(:num)'] = 'admin/Admin_events/delete/$1';

// Rute Event Saya
$route['event-saya'] = 'Event_saya';



// Rute umum
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;