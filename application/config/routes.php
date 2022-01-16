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
|	$route['default_controller'] = 'home';
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

$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'customer/login';
$route['cu'] = 'customer';
$route['cu/(:any)'] = 'customer/$1';
$route['acp'] = 'acp';
$route['acp/(:any)'] = 'acp/$1';
$route['acp/(:any)/(:any)'] = 'acp/$1/$2';

//APIS
$route['api'] = 'api';

$route['api/albums/getCategories']            = 'api/albums/getCategories';
$route['api/albums/getAlbumPictures']         = 'api/albums/getAlbumPictures';

$route['api/offers/allOffers']                = 'api/offers/allOffers';
$route['api/offers/details']                  = 'api/offers/details';

$route['api/user/giveFeedback']               = 'api/user/giveFeedback';
$route['api/user/login']                      = 'api/user/login';
$route['api/user/register_user']              = 'api/user/register_user';
$route['api/user/register_user']              = 'api/user/register_user';
$route['api/user/update_profile']             = 'api/user/update_profile';
$route['api/user/reset_password']             = 'api/user/reset_password';
$route['api/user/change_password']            = 'api/user/change_password';
$route['api/user/update_mobile_id']           = 'api/user/update_mobile_id';
$route['api/user/resendVerificationEmail']    = 'api/user/resendVerificationEmail';
$route['api/user/get_user_terms_conditions']  = 'api/user/get_user_terms_conditions';
$route['api/events/interestedInEvent']        = 'api/events/interestedInEvent';


$route['api/events/allEvents']                = 'api/events/allEvents';
$route['api/events/details']                  = 'api/events/details';

$route['api/bookings/getHistory']             = 'api/events/getHistory';
$route['api/bookings/bookingDetails']         = 'api/events/bookingDetails';
$route['api/bookings/eventBookingDetails']    = 'api/events/eventBookingDetails';
$route['api/bookings/bookEvent']              = 'api/events/bookEvent';


$route['api/codedecode/get_departments']      = 'api/codedecode/get_departments';
$route['api/codedecode/slides']               = 'api/codedecode/slides';
$route['api/codedecode/website_contacts']     = 'api/codedecode/website_contacts';

$route['api/campaigns/details']               = 'api/campaigns/details';
$route['api/campaigns/allCampaigns']          = 'api/campaigns/allCampaigns';


$route['acp/keys/get_Keys'] = 'acp/keys/get_Keys' ;
$route['acp/keys/add_Key']  = 'acp/keys/add_Key' ;
$route['acp/keys/edit_Key'] = 'acp/keys/edit_Key' ;


//Groups
$route['acp/groups/listall'] = 'acp/groups/listall' ;

/*--------------------- Load Module specific routes -------------------------
---------------------------------------------------------------*/
$modules_path = APPPATH.'modules/';
$modules = scandir($modules_path);

foreach($modules as $module)
{
    if($module === '.' || $module === '..') continue;
    if(is_dir($modules_path) . '/' . $module)
    {
        $routes_path = $modules_path . $module . '/config/routes.php';
        if(file_exists($routes_path))
        {
            require($routes_path);
        }
        else
        {
            continue;
        }
    }
}

$route['(:any)'] = 'site/products_rm/productsByCategory/$1';
$route['(:any)'] = 'site/pages/pageByPrefix/$1';
$route['send/sendEmail'] = 'site/send/sendEmail';
$route['(:any)/(:any)'] = 'site/products_rm/productsBySubCategory/$1/$2';
$route['(:any)/(:any)/(:any)'] = 'site/products_rm/productDetails/$1/$2/$3';


