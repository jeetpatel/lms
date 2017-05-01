<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = "auth";
$route['404_override'] = 'home/error_404';
//authentication, user, roles, permissions management routes
$route['auth']              							= "auth";
$route['auth/account/sign_in'] 							= "auth/account/sign_in";
$route['auth/account/sign_up'] 							= "auth/account/sign_up";
$route['auth/account/forgot_password'] 					= "auth/account/forgot_password";
$route['auth/account/sign_out'] 						= "auth/account/sign_out";
$route['auth/account/manage_roles'] 					= "auth/account/manage_roles";
$route['auth/account/manage_roles/save/(:num)'] 		= "auth/account/manage_roles/save/$1";
$route['auth/account/manage_permissions'] 				= "auth/account/manage_permissions";
$route['auth/account/manage_permissions/save/(:num)'] 	= "auth/account/manage_permissions/save/$1";
$route['auth/account/manage_users'] 					= "auth/account/manage_users";
$route['auth/account/manage_users/save'] 				= "auth/account/manage_users/save";
$route['auth/account/manage_users/save/(:num)'] 		= "auth/account/manage_users/save/$1";
$route['auth/account/account_password'] 				= "auth/account/account_password";
$route['auth/account/account_settings'] 				= "auth/account/account_settings";
$route['auth/account/account_profile'] 					= "auth/account/account_profile";
$route['auth/account/account_profile/(:any)'] 			= "auth/account/account_profile/index/$1";
$route['auth/account/reset_password'] 					= "auth/account/reset_password";
$route['admin'] = "admin/index";
$route['admin/sendMail'] = "admin/sendMail";
//sitesettings module routes
$route['admin/sitesettings'] = "admin/sitesettings/index";
$route['admin/sitesettings/updateAction'] = "admin/sitesettings/updateAction";
//tests module routes
$route['admin/tests'] = "admin/tests/index";
$route['admin/tests/(:num)'] = "admin/tests/index/$1";
$route['admin/tests/create'] = "admin/tests/create";
$route['admin/tests/read/(:num)'] = "admin/tests/read/$1";
$route['admin/tests/createAction'] = "admin/tests/createAction";
$route['admin/tests/update/(:num)'] = "admin/tests/update/$1";
$route['admin/tests/updateAction'] = "admin/tests/updateAction";
$route['admin/tests/getTestPrice'] = "admin/tests/getTestPrice";
$route['admin/tests/checkTestExists'] = "admin/tests/checkTestExists";
//doctors module routes
$route['admin/doctors'] = "admin/doctors/index";
$route['admin/doctors/(:num)'] = "admin/doctors/index/$1";
$route['admin/doctors/create'] = "admin/doctors/create";
$route['admin/doctors/read/(:num)'] = "admin/doctors/read/$1";
$route['admin/doctors/createAction'] = "admin/doctors/createAction";
$route['admin/doctors/update/(:num)'] = "admin/doctors/update/$1";
$route['admin/doctors/updateAction'] = "admin/doctors/updateAction";
//Appointments module routes
$route['admin/appointments'] = "admin/appointments/index";
$route['admin/appointments/(:num)'] = "admin/appointments/index/$1";
$route['admin/appointments/create'] = "admin/appointments/create";
$route['admin/appointments/read/(:num)'] = "admin/appointments/read/$1";
$route['admin/appointments/createAction'] = "admin/appointments/createAction";
$route['admin/appointments/update/(:num)'] = "admin/appointments/update/$1";
$route['admin/appointments/updateAction'] = "admin/appointments/updateAction";
$route['admin/appointments/todayAppointments'] = "admin/appointments/todayAppointments";
$route['admin/appointments/getAppointmentsByDate'] = "admin/appointments/getAppointmentsByDate";
$route['admin/appointments/todayAppointments/(:num)'] = "admin/appointments/todayAppointments/$1";
$route['admin/appointments/excel'] = "admin/appointments/excel";
$route['admin/appointments/uploadReportsForm'] = "admin/appointments/uploadReportsForm";
$route['admin/appointments/uploadReports'] = "admin/appointments/uploadReports";
$route['admin/appointments/sendMail'] = "admin/appointments/sendMail";
$route['admin/appointments/generate/(:num)'] = "admin/appointments/generate/$1";
//email settings module routes
$route['admin/emailsettings'] = "admin/emailsettings/index";
$route['admin/emailsettings/updateAction'] = "admin/emailsettings/updateAction";
$route['admin/reports'] = "admin/reports";
//redirect to 404
$route['(.*)'] = 'auth/error404';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
