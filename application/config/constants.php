<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



define('MESSAGE_SUCCESS', [
	'ADD' => [
		'INFO' => 'success',
		'TEXT' => 'Berhasil Menambah Data',
		'CODE' => 201,
	],
	'REGISTER' => [
		'INFO' => 'success',
		'TEXT' => 'Berhasil mendaftar',
		'CODE' => 201,
	],
	'DELETE' => [
		'INFO' => 'success',
		'TEXT' => 'Berhasil Menghapus Data',
		'CODE' => 201,
	],
	'UPDATE' => [
		'INFO' => 'success',
		'TEXT' => 'Berhasil Merubah Data',
		'CODE' => 201,
	],
	'GET' => [
		'INFO' => 'success',
		'TEXT' => 'Berhasil Mendapatkan Data',
		'CODE' => 200,
	],
]);

define('MESSAGE_FAIL', [
	'ADD' => [
		'INFO' => 'error',
		'TEXT' => 'Terjadi kesalahan, Gagal Menambah Data',
		'CODE' => 400,
	],
	'REGISTER' => [
		'INFO' => 'error',
		'TEXT' => 'Gagal mendaftar',
		'CODE' => 201,
	],
	'DELETE' => [
		'INFO' => 'error',
		'TEXT' => 'Terjadi kesalahan, Gagal Menghapus Data',
		'CODE' => 400,
	],
	'UPDATE' => [
		'INFO' => 'error',
		'TEXT' => 'Terjadi kesalahan, Gagal Merubah Data',
		'CODE' => 400,
	],
	'GET_NO_DATA' => [
		'INFO' => 'warning',
		'TEXT' => 'Data Tidak Tersedia',
		'CODE' => 204,
	],
	'GET_BAD' => [
		'INFO' => 'ERROR',
		'TEXT' => 'Terjadi kesalahan, Gagal Mendapatkan Data',
		'CODE' => 400,
	],
	'GET_NO_AUTH' => [
		'INFO' => 'error',
		'TEXT' => 'Gagal Mendapatkan Data, Authorization dibutuhkan',
		'CODE' => 401,
	],
	'GET_REQUIRED' => [
		'INFO' => 'error',
		'TEXT' => 'Gagal Mendapatkan Data, Form tidak boleh kosong',
		'CODE' => 401,
	],
	'GET_REQUIRED_PARAM' => [
		'INFO' => 'error',
		'TEXT' => 'Gagal Mendapatkan Data, Parameter tidak boleh kosong',
		'CODE' => 401,
	],
	'USERNAME_USED' => [
		'INFO' => 'warning',
		'TEXT' => 'Username telah digunakan',
	],
	'USERNAME_EMPTY' => [
		'INFO' => 'warning',
		'TEXT' => 'Username tidak boleh kosong',
	],
	'PASSWORD_NO_MATCH' => [
		'INFO' => 'warning',
		'TEXT' => 'Password tidak sama',
	],
	'MUST_LOGIN' => [
		'INFO' => 'warning',
		'TEXT' => 'Anda harus login untuk mengakses halaman tersebut',
	],
	'EMPTY_PASSWORD' => [
		'INFO' => 'error',
		'TEXT' => 'Password/repassword Tidak Boleh Kosong',
	],
	'AUTH_WRONG' => [
		'INFO' => 'error',
		'TEXT' => 'Error Auth',
	],
	'FORM_REQUIRED' => [
		'INFO' => 'error',
		'TEXT' => 'Silahkan lengkapi form terlebih dahulu',
	],
]);


define('MESSAGE_UPLOAD', [
	'SUCCESS' => [
		'INFO' =>  'success',
		'TEXT' =>  'Berhasil Mengupload File',
		'CODE' => 201,
	],
	'FAIL' => [
		'INFO' =>  'error',
		'TEXT' =>  'Gagal Mengupload File',
		'CODE' => 400,
	],
	'LIMIT' => [
		'INFO' =>  'warning',
		'TEXT' =>  'File Terlalu Besar',
		'CODE' => 204,
	],
	'TYPE' => [
		'INFO' =>  'warning',
		'TEXT' =>  'Tipe File Tidak Sesuai',
		'CODE' => 204,
	],
	'NO_FILE' => [
		'INFO' =>  'error',
		'TEXT' =>  'Silahkan lampirkan file terlebih dahulu',
		'CODE' => 204,
	],
]);


define('ROLE_AKSES', [
	'Prodi' => 'Prodi',
	'SUPERADMIN' => 'Superadmin',
	'PIMPINAN' => 'Pimpinan',
	'DOSEN' => 'Dosen',
]);