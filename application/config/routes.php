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
$route['admin/roles'] = 'Master/Roles';
$route['admin/roles/get-all'] = 'Master/Roles/GetAll';
$route['admin/roles/datatable'] = 'Master/Roles/Datatable';
$route['admin/roles/get/(:num)'] = 'Master/Roles/Get/$1';
$route['admin/roles/insert'] = 'Master/Roles/Insert';
$route['admin/roles/update'] = 'Master/Roles/Update';
$route['admin/roles/delete/(:num)'] = 'Master/Roles/Delete/$1';

$route['admin/users'] = 'Master/Users';
$route['admin/users/get-all'] = 'Master/Users/GetAll';
$route['admin/users/datatable'] = 'Master/Users/Datatable';
$route['admin/users/get/(:num)'] = 'Master/Users/Get/$1';
$route['admin/users/insert'] = 'Master/Users/Insert';
$route['admin/users/update'] = 'Master/Users/Update';
$route['admin/users/delete/(:num)'] = 'Master/Users/Delete/$1';

$route['admin/brands'] = 'Brand';
$route['admin/brands/update-active/(:num)/(:num)'] = 'Brand/UpdateActive/$1/$2';
$route['admin/brands/get-all'] = 'Brand/GetAll';
$route['admin/brands/datatable'] = 'Brand/Datatable';
$route['admin/brands/get/(:num)'] = 'Brand/Get/$1';
$route['admin/brands/insert'] = 'Brand/Insert';
$route['admin/brands/update'] = 'Brand/Update';
$route['admin/brands/delete/(:num)'] = 'Brand/Delete/$1';

$route['admin/banners'] = 'Banner';
$route['admin/banners/update-active/(:num)/(:num)'] = 'Banner/UpdateActive/$1/$2';
$route['admin/banners/get-all'] = 'Banner/GetAll';
$route['admin/banners/datatable'] = 'Banner/Datatable';
$route['admin/banners/get/(:num)'] = 'Banner/Get/$1';
$route['admin/banners/insert'] = 'Banner/Insert';
$route['admin/banners/update'] = 'Banner/Update';
$route['admin/banners/delete/(:num)'] = 'Banner/Delete/$1';

$route['admin/social-medias'] = 'SocialMedia';
$route['admin/social-medias/update-active/(:num)/(:num)'] = 'SocialMedia/UpdateActive/$1/$2';
$route['admin/social-medias/get-all'] = 'SocialMedia/GetAll';
$route['admin/social-medias/datatable'] = 'SocialMedia/Datatable';
$route['admin/social-medias/get/(:num)'] = 'SocialMedia/Get/$1';
$route['admin/social-medias/insert'] = 'SocialMedia/Insert';
$route['admin/social-medias/update'] = 'SocialMedia/Update';
$route['admin/social-medias/delete/(:num)'] = 'SocialMedia/Delete/$1';

$route['admin/about'] = 'About';
$route['admin/about/get/(:num)'] = 'About/Get/$1';
$route['admin/about/update'] = 'About/Update';

$route['admin/categories'] = 'ProductCategory';
$route['admin/categories/update-active/(:num)/(:num)'] = 'ProductCategory/UpdateActive/$1/$2';
$route['admin/categories/get-all'] = 'ProductCategory/GetAll';
$route['admin/categories/datatable'] = 'ProductCategory/Datatable';
$route['admin/categories/get/(:num)'] = 'ProductCategory/Get/$1';
$route['admin/categories/insert'] = 'ProductCategory/Insert';
$route['admin/categories/update'] = 'ProductCategory/Update';
$route['admin/categories/delete/(:num)'] = 'ProductCategory/Delete/$1';

$route['admin/categories/(:num)/sub-categories'] = 'ProductCategory/ProductSubCategory/Show/$1';
$route['admin/sub-categories/update-active/(:num)/(:num)'] = 'ProductCategory/ProductSubCategory/UpdateActive/$1/$2';
$route['admin/sub-categories/get-all'] = 'ProductCategory/ProductSubCategory/GetAll';
$route['admin/sub-categories/datatable'] = 'ProductCategory/ProductSubCategory/Datatable';
$route['admin/sub-categories/get/(:num)'] = 'ProductCategory/ProductSubCategory/Get/$1';
$route['admin/sub-categories/insert'] = 'ProductCategory/ProductSubCategory/Insert';
$route['admin/sub-categories/update'] = 'ProductCategory/ProductSubCategory/Update';
$route['admin/sub-categories/delete/(:num)'] = 'ProductCategory/ProductSubCategory/Delete/$1';

$route['admin/sub-categories/(:num)/groups'] = 'ProductCategory/ProductGroup/Show/$1';
$route['admin/groups/update-active/(:num)/(:num)'] = 'ProductCategory/ProductGroup/UpdateActive/$1/$2';
$route['admin/groups/get-all'] = 'ProductCategory/ProductGroup/GetAll';
$route['admin/groups/datatable'] = 'ProductCategory/ProductGroup/Datatable';
$route['admin/groups/get/(:num)'] = 'ProductCategory/ProductGroup/Get/$1';
$route['admin/groups/insert'] = 'ProductCategory/ProductGroup/Insert';
$route['admin/groups/update'] = 'ProductCategory/ProductGroup/Update';
$route['admin/groups/delete/(:num)'] = 'ProductCategory/ProductGroup/Delete/$1';
