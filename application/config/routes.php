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
$route['default_controller'] 		= 'welcome';
$route['404_override'] 				= '';
$route['translate_uri_dashes'] 		= TRUE;

// Admin panel 
$route['admin'] 					= 'admin/admin';
$route['admin/dashboard'] 			= 'admin/admin';
$route['admin/settings'] 			= 'admin/admin/settings';
$route['admin/edit_profile'] 		= 'admin/admin/edit_profile';
$route['admin/login'] 				= 'admin/users/login';
$route['admin/change_password'] 	= 'admin/admin/change_password';
$route['admin/books/new'] 			= 'admin/books/new_book';
$route['admin/settings/api'] 		= 'admin/admin/api';
$route['admin/settings/points'] 	= 'admin/admin/points';
$route['admin/settings/badges'] 	= 'admin/admin/badges';
$route['admin/settings/cron'] 		= 'admin/admin/cronjobs';
$route['admin/settings/general'] 	= 'admin/admin/general';
$route['admin/settings/schools'] 	= 'admin/admin/schools';
$route['admin/settings/setstyle'] 	= 'admin/admin/setstyle';
$route['admin/settings/profilepicture'] 	= 'admin/admin/profilepicture';
$route['admin/settings/removepicture'] 	= 'admin/admin/removepicture';
$route['admin/settings/upload_profile_picture'] 	= 'admin/admin/upload_profile_picture';
$route['admin/library'] 	= 'admin/admin/library';
$route['admin/getLibraryDetails'] 	= 'admin/admin/getLibraryDetails';
$route['admin/edit_my_profile'] 	= 'admin/admin/edit_my_profile';

$route['delete_saved_files'] 		= 'welcome/deleteSavedFiles';
$route['disclaimer'] 				= 'welcome/disclaimer';
$route['programs'] 					= 'welcome/programs';
$route['events'] 					= 'welcome/events';
$route['admin/books/(:num)']		= 'admin/books/index/$1';
