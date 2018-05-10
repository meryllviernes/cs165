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


$route['dashboard'] = 'HomeDashboard';
$route['moms/add'] = 'Moms/add';
$route['moms/view'] = 'Moms/view';
$route['moms/update'] = 'Moms/updateMoms';
$route['moms/delete'] = 'Moms/delemteMoms';
$route['marker_history'] = 'MarkerHistory/index';
$route['marker_history/get_marker_name'] = 'MarkerHistory/get_marker_name_history';
$route['marker_history/insert_marker_history'] = 'MarkerHistory/insert_marker_history';
$route['marker_history/check_marker_ts'] = 'MarkerHistory/check_marker_ts';

$route['dashboard/surficial_data'] = 'HomeDashboard/surficial_data';
$route['dashboard/moms_data'] = 'HomeDashboard/moms_data';

$route['surficial/add'] = 'Surficial/add';
$route['suficial/add_new_surficial'] = 'Surficial/addNewSurficial';
$route['surficial/get_marker_name'] = 'Surficial/getMarkerNames';
$route['surficial/get_weather'] = 'Surficial/getWeather';

$route['default_controller'] = 'login';
$route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;
