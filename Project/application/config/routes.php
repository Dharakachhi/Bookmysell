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
$route['default_controller'] = 'Home_Controller';
$route['login']='Home_Controller/index';
$route['register'] = 'Home_Controller/register';
$route['register/user'] = 'Home_Controller/register_user';
$route['login/user']  ="Home_Controller/login_check";
$route['forgetpassword'] = "Home_Controller/forgetpass";
$route['forgot-password'] = "Home_Controller/forgot_password";
$route['reset/(:any)'] = "Home_Controller/reset/$1";
$route['reset-password'] = "Home_Controller/reset_password";

//After Login Routes
$route['dashboard'] = 'Dashboard_Controller/index';
$route['insert_disable_location'] = 'Dashboard_Controller/insert_disable_location';
$route['placeorder'] = 'Dashboard_Controller/placeorder';
$route['logout'] = 'Home_Controller/logout';
$route['insertitem'] = 'Dashboard_Controller/additem';
$route['insertorder']= 'Dashboard_Controller/insertorder';
$route['vieworder'] = 'Dashboard_Controller/vieworder';
$route['userlisting'] = 'Dashboard_Controller/userlisting';
$route['viewfullorder/(:num)'] = 'Dashboard_Controller/viewfullorder/$1';
$route['power-of-attorny'] = 'Dashboard_Controller/powerofattony';
$route['duplicate_order/(:num)'] = 'Dashboard_Controller/duplicate_order/$1';
$route['deleteorder/(:num)']='Dashboard_Controller/deleteorder/$1';
$route['delete_copyorder/(:num)']='Dashboard_Controller/delete_copyorder/$1';
$route['updateordermaster/(:num)']='Dashboard_Controller/updateordermaster/$1';
$route['update_edit_order/(:num)']='Dashboard_Controller/update_edit_order/$1';
$route['copy_order/(:num)']='Dashboard_Controller/copy_order/$1';
$route['edit/(:num)']='Dashboard_Controller/editorder/$1';

// edit-copy order controller
$route['edit']='Edit_copy_Controller/edit_copy_order_insert';



// pdf Controller
$route['minvoice']='Pdf_Controller/index';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
