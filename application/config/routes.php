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

$route = array();

switch (strtoupper($_SERVER['REQUEST_METHOD']))
{
	case 'GET':
		$route['trackers'] = 'trackers/index';
		$route['trackers/(:any)/values'] = 'values/index/$2';
		$route['trackers/(:any)'] = 'trackers/show/$2';
		break;

	case 'POST':
		$route['trackers'] = 'trackers/create';
		$route['trackers/(:any)/values'] = 'values/create/$2';
		break;

	case 'PUT':
		$route['trackers/(:any)'] = 'trackers/update/$2';
		break;

	case 'DELETE':
		$route['trackers/(:any)'] = 'trackers/delete/$2';
		break;
}

foreach ($route as $key => $val)
{
	$route['(v[0-9]+\/)?' . $key . '(\.[a-zA-Z0-9]+)?'] = 'api_router/index/$1/' . $route[$key];
	unset($route[$key]);
}

$route['default_controller'] = "welcome";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */