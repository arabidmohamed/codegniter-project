<?PHP defined('BASEPATH') OR exit('No direct script access allowed');

$route['authentication/(:any)'] = 'acp/authentication/$1';

$route['acp']          = 'acp/index';
$route['ar/acp']       = 'acp/index/ar';
$route['en/acp']       = 'acp/index/en';
$route['ar/acp/login'] = 'acp/login';
$route['en/acp/login'] = 'acp/login';
