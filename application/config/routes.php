<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['dashboard']='backend/home';

$route['ruangan/gedung']='backend/ruangan/gedung';
$route['ruangan/ruang']='backend/ruangan/ruang';
$route['ruangan/barang']='backend/ruangan/barang';
$route['jadwal/tahun-ajaran']='backend/jadwal/tahun_ajaran';
$route['jadwal/mata-kuliah']='backend/jadwal/mata_kuliah';
$route['jadwal/penjadwalan']='backend/jadwal/penjadwalan';
$route['master/dosen']='backend/master/dosen';
$route['master/fakultas']='backend/master/fakultas';
$route['master/jurusan']='backend/master/jurusan';
$route['master/prodi']='backend/master/prodi';
$route['master/user']='backend/master/user';

$route['absen/checkin']='backend/jadwal/absen/checkin';
$route['absen/checkout']='backend/jadwal/absen/checkout';


$route['404-error']='errpage/notfound_err';
$route['406-error']='errpage/nojs_err';
$route['default_controller'] = 'backend/home';
$route['404_override'] = 'errpage/notfound_err';
$route['translate_uri_dashes'] = FALSE;
