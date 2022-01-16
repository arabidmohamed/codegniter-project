<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);


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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
------------------------------------------------------------------------------------------
This Project Rules
------------------------------------------------------------------------------------------
*/

define('SUPER_ADMIN_ROLE', 1); // id 1 is for role `super_admin` 		-> cp / acp
define('ADMIN_ROLE', 3); // id 1 is for role `admin` 			 		-> cp / acp
define('CUSTOMER_ROLE', 2); // id 1 is for role `customer` 		 		-> site
define('COMPANY_ROLE', 4); // id 1 is for role `store` 		 		-> site / cp
define('RBRANCH_ROLE', 6); // id 1 is for role `store` 		 		-> site / cp
define('NORMAL_USER_ROLE', 5); // id 1 is for role `normal_user / user` -> site

define('FREEZING_DURATION', 8); // id 1 is for role `normal_user / user` -> site

/*
------------------------------------------------------------------------------------------
Table names
------------------------------------------------------------------------------------------
*/

define('TBL_USERS', 'users');
define('TBL_USER_ROLES', 'users_roles');

define('TBL_SERVICES', 'services');

define('TBL_SECTIONS', 'sections');

define('TBL_ABOUTUS', 'aboutus');

define('TBL_APPOINTMENTS', 'appointments');

define('TBL_CLASSES', 'classes');
define('TBL_CLASS_DETAILS', 'class_details');
define('TBL_CLASSES_WISHLIST', 'products_wishlist');
define('TBL_CLASS_CATEGORIES', 'class_categories');
define('TBL_CLASS_SUBCATEGORIES', 'class_subcategories');
define('TBL_Class_PRICE_PERUNIT', 'class_priceperunit');
define('TBL_CLASS_REVIEWS', 'class_reviews');
define('TBL_CLASS_UNITS', 'class_units');
define('TBL_CLASS_VIEWS', 'class_views');
define('TBL_CLASS_RATING', 'class_rating');

define('TBL_COUNTERS', 'counter');


define('ORGANIZATION', 'domains_organizations');
define('USERS', 'domains_contacts');
define('DOMAIN', 'domains');
define('INFO', 'domains_info');
define('LOG', 'domains_nic_logs');
define('APP_LOG', 'domains_app_logs');
define('DOMAIN_HIS', 'domains_history');
define('DOCUMENT', 'domains_documents');
define('TLD', 'domains_tld');
define('ORDERS', 'domains_orders');
define('REQUEST', 'domains_change_requests');
define('TRANSFER', 'domains_transfer_in');
define('TRANSFER_ORDERS', 'domains_transfer_orders');
define('WAIVERS', 'domains_waivers');
define('NOTIFICATIONS', 'domains_notifications');
define('INSIDE_DNET', 'domains_inside_dnet_log');
















define('TBL_ITEMS', 'items');
define('TBL_ITEM_CATEGORIES', 'item_categories');
define('TBL_ITEM_SUBCATEGORIES', 'item_subcategories');


define('TBL_ALBUMS', 'albums');
define('TBL_ALBUMS_CATEGORIES', 'albums_categories');

define('TBL_PORTFOLIO', 'portfolio');
define('TBL_PORTFOLIO_DETAILS', 'portfolio_details');
define('TBL_PORTFOLIO_CATEGORIES', 'portfolio_categories');

define('TBL_PROJECTS', 'projects');
define('TBL_PROJECTS_CATEGORIES', 'project_categories');
define('TBL_PROJECTS_DETAILS', 'project_details');
define('TBL_PROJECTS_BOOKINGS', 'project_bookings');

define('TBL_ORDERS', 'product_orders');
define('TBL_PRODUCT_SUBSCRIPTIONS', 'product_subscriptions');
define('TBL_PRODUCTS', 'products');

define('TBL_EVENTS', 'events');
define('TBL_EVENTS_CATEGORIES', 'events_categories');
define('TBL_EVENTS_SUBCATEGORIES', 'events_subcategories');
define('TBL_EVENTS_LOCATIONS', 'event_locations');
define('TBL_EVENTS_PICS', 'event_pictures');
define('TBL_EVENTS_SLIDER', 'event_slider');
define('TBL_EVENTS_BOOKINGS', 'events_bookings');
define('TBL_EVENTS_REVIEWS', 'event_reviews');
define('TBL_EVENTS_VIEWS', 'event_views');
define('TBL_EVENTS_RATING', 'event_ratings');

define('TBL_NEWS', 'news');
define('TBL_NEWS_CATEGORIES', 'news_categories');
define('TBL_NEWS_PICS', 'news_pictures');
define('TBL_NEWS_TAGS', 'news_tags');

define('TBL_CAREERS', 'careers');
define('TBL_CAREERS_APPLICATIONS', 'career_applications');

define('TBL_ORDERS_HEAD', 'orders_head');
define('TBL_ORDER_DETAILS', 'order_details');

define('TBL_CUSTOMERS', 'customers');
define('TBL_CUST_PROFESSIONS', 'customer_professions');
define('TBL_CUST_MEMBERS', 'customer_members');
define('TBL_CUST_PREFERANCES', 'customer_preferences');
define('TBL_CUST_TICKETS', 'customer_tickets');
define('TBL_CUSTOMERS_DISCOUNTS', 'customers_discounts');

define('TBL_BOOKINGS', 'bookings');
define('TBL_BOOKINGDETAILS', 'booking_details');

define('TBL_QUESTIONS', 'questions');

define('TBL_RESTURANTS', 'stores');

define('TBL_WEBSITE_SETTINGS', 'website_settings');
define('TBL_WEBSITE_CONTACTS', 'website_contacts');
define('TBL_WEBSITE_MAPLOCATIONS', 'website_map_locations');
define('TBL_WEBSITE_SLIDER', 'website_slider');
define('TBL_WEBSITE_SHOWREEL', 'website_showreel');

define('TBL_CLIENTS', 'clients');

define('TBL_LOGS_OPERATIONS', 'logs_operations');
define('TBL_LOGS_SMS', 'logs_sms');

define('TBL_CITIES', 'tbl_cities');
define('TBL_NATS', 'tbl_nationalities');

define('TBL_CRON_MEMBEREMAILS', 'cron_admin_member_emails');
define('TBL_CRON_EMAILLOGS', 'cron_email_log');

define('TBL_SUBSCRIPTIONS', 'subscriptions');
define('TBL_SUBSCRIPTION_PLANS', 'subscription_plans');
define('TBL_CUSTOMER_SUBSCRIPTIONS', 'subscription_customers');
define('TBL_CUSTOMER_SUBSCRIPTION_HISTORY', 'subscription_customer_history');
define('TBL_CUSTOMER_UNPAYED_SUBSCRIPTION_HISTORY', 'subscription_customer_history_unpayed');

define('TBL_ROLES_PERMISSIONS', 'rbac_roles_permissions');
define('TBL_MENU_ACTIONS', 'rbac_menu_actions');
define('TBL_MENUS', 'rbac_menus');
define('TBL_WEBSITE_FEATURES', 'website_features');

define('TBL_SUBSCRIBERS', 'subscribers');
define('TBL_PAGES', 'pages');

/*
------------------------------------------------------------------------------------------
DWebsite Global Variables
------------------------------------------------------------------------------------------
*/
$GLOBALS['assets_dir'] = 'content';
$GLOBALS['img_dir'] = 'content/';

$GLOBALS['img_ck_dir'] = $GLOBALS['assets_dir'].'/ck-uploads/';

$GLOBALS['img_services_dir'] = $GLOBALS['assets_dir'].'/services/';
$GLOBALS['img_tickets_dir'] = $GLOBALS['assets_dir'].'/tickets/';
$GLOBALS['img_faq_dir'] = $GLOBALS['assets_dir'].'/faq/';
$GLOBALS['img_work_dir'] = $GLOBALS['assets_dir'].'/work/';
$GLOBALS['domain_doc_dir'] = $GLOBALS['assets_dir'].'/domains-docs/';


$GLOBALS['img_work_details_dir'] = $GLOBALS['assets_dir'].'/work/work-details/';
$GLOBALS['img_clients_dir'] = $GLOBALS['assets_dir'].'/clients/';
$GLOBALS['img_slides_dir'] = $GLOBALS['assets_dir'].'/slides/';
$GLOBALS['img_product_categories_dir'] = $GLOBALS['assets_dir'].'/product-categories/';
$GLOBALS['img_news_dir'] = $GLOBALS['assets_dir'].'/news/';
$GLOBALS['img_class_dir'] = $GLOBALS['assets_dir'].'/classes/';

$GLOBALS['img_item_dir'] = $GLOBALS['assets_dir'].'/items/';

$GLOBALS['img_solutions_dir'] = $GLOBALS['assets_dir'].'/solutions/';

$GLOBALS['img_projects_dir'] = $GLOBALS['assets_dir'].'/projects/';
$GLOBALS['img_projectPDF_dir'] = $GLOBALS['img_projects_dir'].'pdf_files/';

$GLOBALS['img_professions_dir'] = $GLOBALS['assets_dir'].'/professions/';
$GLOBALS['img_customers_dir'] = $GLOBALS['assets_dir'].'/customers/';

$GLOBALS['img_users_dir'] = $GLOBALS['assets_dir'].'/users/';
$GLOBALS['img_section_bg_dir'] = $GLOBALS['assets_dir'].'/sections_bg/';
$GLOBALS['applications_dir'] = $GLOBALS['assets_dir'].'/careers/';

$GLOBALS['svg_icon'] = $GLOBALS['assets_dir'].'/svg/';

$GLOBALS['acp_assets_dir'] = 'style/acp';
$GLOBALS['home_assets_dir'] = 'style/site';

$GLOBALS['acp_js_dir'] = $GLOBALS['acp_assets_dir'].'/js';
$GLOBALS['acp_css_dir'] = $GLOBALS['acp_assets_dir'].'/css';
$GLOBALS['acp_img_dir'] = $GLOBALS['acp_assets_dir'].'/img';
$GLOBALS['img_products_dir'] = $GLOBALS['assets_dir'].'/products/';

$GLOBALS['home_js_dir'] = $GLOBALS['home_assets_dir'].'/js';
$GLOBALS['home_css_dir'] = $GLOBALS['home_assets_dir'].'/css';
$GLOBALS['home_img_dir'] = $GLOBALS['home_assets_dir'].'/img';
