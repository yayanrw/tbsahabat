<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login/user'] = 'Login/index';
$route['logout'] = 'Login/Logout';
$route['auth/user']['post'] = 'Login/AuthUser';

// dashboard
$route['dashboard'] = 'Dashboard/index';

// master
$route['master/roles'] = 'Master/Roles';
$route['master/roles/get-all'] = 'Master/Roles/GetAll';
$route['master/roles/datatable'] = 'Master/Roles/Datatable';
$route['master/roles/get/(:num)'] = 'Master/Roles/Get/$1';
$route['master/roles/insert'] = 'Master/Roles/Insert';
$route['master/roles/update'] = 'Master/Roles/Update';
$route['master/roles/delete/(:num)'] = 'Master/Roles/Delete/$1';

$route['brands'] = 'Brand';
$route['brands/update-active/(:num)/(:num)'] = 'Brand/UpdateActive/$1/$2';
$route['brands/get-all'] = 'Brand/GetAll';
$route['brands/datatable'] = 'Brand/Datatable';
$route['brands/get/(:num)'] = 'Brand/Get/$1';
$route['brands/insert'] = 'Brand/Insert';
$route['brands/update'] = 'Brand/Update';
$route['brands/delete/(:num)'] = 'Brand/Delete/$1';

$route['banners'] = 'Banner';
$route['banners/update-active/(:num)/(:num)'] = 'Banner/UpdateActive/$1/$2';
$route['banners/get-all'] = 'Banner/GetAll';
$route['banners/datatable'] = 'Banner/Datatable';
$route['banners/get/(:num)'] = 'Banner/Get/$1';
$route['banners/insert'] = 'Banner/Insert';
$route['banners/update'] = 'Banner/Update';
$route['banners/delete/(:num)'] = 'Banner/Delete/$1';

$route['master/users'] = 'Master/Users';
$route['master/users/get-all'] = 'Master/Users/GetAll';
$route['master/users/datatable'] = 'Master/Users/Datatable';
$route['master/users/get/(:num)'] = 'Master/Users/Get/$1';
$route['master/users/insert'] = 'Master/Users/Insert';
$route['master/users/update'] = 'Master/Users/Update';
$route['master/users/delete/(:num)'] = 'Master/Users/Delete/$1';

// transaction
$route['events'] = 'Events';
$route['events/detail/(:num)'] = 'Events/Detail/$1';
$route['events/update-active/(:num)/(:num)'] = 'Events/UpdateActive/$1/$2';
$route['events/get-all'] = 'Events/GetAll';
$route['events/datatable'] = 'Events/Datatable';
$route['events/get/(:num)'] = 'Events/Get/$1';
$route['events/insert'] = 'Events/Insert';
$route['events/update'] = 'Events/Update';
$route['events/delete/(:num)'] = 'Events/Delete/$1';

$route['events/voucher'] = 'Events/Voucher';
$route['events/voucher/get-all'] = 'Events/Voucher/GetAll';
$route['events/voucher/datatable'] = 'Events/Voucher/Datatable';
$route['events/voucher/get/(:num)'] = 'Events/Voucher/Get/$1';
$route['events/voucher/insert'] = 'Events/Voucher/Insert';
$route['events/voucher/update'] = 'Events/Voucher/Update';
$route['events/voucher/delete/(:num)'] = 'Events/Voucher/Delete/$1';
