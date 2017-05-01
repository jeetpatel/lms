<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
 * Define root resources folder name for js/css/img files
 */
define('RES_DIR', 'resource');

/*
 * Detect AJAX Request for MY_Session
 */
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

/*
 * Portable PHP password hashing framework
 * http://www.openwall.com/phpass/
 */
define('PHPASS_HASH_STRENGTH', 8);
define('PHPASS_HASH_PORTABLE', FALSE);

define('SITENAME','LAB MANAGEMENT');

define('CURD', TRUE);
define('RECORDSPERPAGE', 15);

define('ADMIN','admin');

define('LOGOUT','auth/account/sign_out');
define('SIGNUP','auth/account/sign_up');
define('SIGNIN','auth/account/sign_in');
define('FORGOTPASSWORD','auth/account/forgot_password');
define('MANAGE_ROLES','auth/account/manage_roles');
define('ADD_ROLE','auth/account/manage_roles/save');
define('MANAGE_PERMISSIONS','auth/account/manage_permissions');
define('ADD_PERMISSION','auth/account/manage_permissions/save');
define('ACCOUNT_PROFILE', 'auth/account/account_profile');
define('ACCOUNT_SETTINGS', 'auth/account/account_settings');
define('ACCOUNT_PASSWORD', 'auth/account/account_password');
define('MANAGE_USERS', 'auth/account/manage_users');
define('ADD_USER', 'auth/account/manage_users/save');

define('SITESETTINGS','admin/sitesettings');

define('ALLTESTS','admin/tests');
define('ADDTEST','admin/tests/create');

define('ALLDOCTORS', 'admin/doctors');
define('ADDDOCTOR', 'admin/doctors/create');

define('ALLAPPOINTMENTS', 'admin/appointments');
define('ADDAPPOINTMENT', 'admin/appointments/create');
define('TODAYAPPOINTMENTS', 'admin/appointments/todayAppointments');
define('GETAPPOINTMENTSBYDATE','admin/appointments/getAppointmentsByDate');

define('EMAILSETTINGS', 'admin/emailsettings');
define('REPORTS', 'admin/reports');

/* End of file constants.php */
/* Location: ./application/config/constants.php */