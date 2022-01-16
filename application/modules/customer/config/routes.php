<?PHP defined('BASEPATH') OR exit('No direct script access allowed');

$route['customer/verify_phone_number'] = 'customer/authentication/verify_phone_number';
$route['auth/(:any)'] = 'customer/authentication/$1';
$route['auth/(:any)/(:any)'] = 'customer/authentication/$1/$2';
$route['auth/(:any)/(:any)/(:any)'] = 'customer/authentication/$1/$2/$3';
$route['auth/(:any)/(:any)/(:any)/(:any)'] = 'customer/authentication/$1/$2/$3/$4';
$route['login'] = 'customer/authentication/login';
$route['customer/login'] = 'customer/authentication/login';
$route['register'] = 'customer/authentication/register';
$route['change_phone_number/(:any)'] = 'customer/authentication/change_phone_number/$1';
$route['phone_changed'] = 'customer/authentication/phone_changed';
$route['forget_password'] = 'customer/authentication/forget_password';

$route['hd/getOrdersList'] = 'customer/home_datatable/getOrdersList';
$route['hd/getPurchasesList'] = 'customer/home_datatable/getPurchasesList';
$route['hd/getDomainsList'] = 'customer/home_datatable/getDomainsList';
$route['hd/getTicketsList'] = 'customer/home_datatable/getTicketsList';
$route['payment_methods_renew'] = 'customer/domains/payment_methods_renew';
$route['cu/updateTicketStatus'] = 'customer/support/updateTicketStatus';
$route['cu/updateTicketRate'] = 'customer/support/updateTicketRate';




/* domain routes*/
$route['dashboard'] = 'customer/domains/dashboard';
$route['wallet'] = 'customer/domains/wallet';
$route['add_domain_record'] = 'customer/domains/add_domain_record';
$route['register_domain'] = 'customer/domains/register_domain';
$route['edit_register_domain/(:any)'] = 'customer/domains/edit_register_domain/$1';
$route['domain_docs'] = 'customer/domains/domain_docs';
$route['edit_domain_docs/(:any)'] = 'customer/domains/edit_domain_docs/$1';
$route['domain_review'] = 'customer/domains/domain_review';
$route['edit_domain_review/(:any)'] = 'customer/domains/edit_domain_review/$1';
$route['speech_pdf/(:any)'] = 'customer/domains/speech_pdf/$1';
$route['edit_speech_pdf/(:any)/(:any)'] = 'customer/domains/edit_speech_pdf/$1/$2';
$route['domain_certificate/(:any)'] = 'customer/domains/domain_certificate/$1';


/* product routes*/
$route['products'] = 'customer/products/index';
$route['products/list'] = 'customer/products/product_list';
$route['products/subscription/(:any)'] = 'customer/products/product_subscription/$1';
$route['products/users'] = 'customer/products/users';
$route['products/subscription_post'] = 'customer/products/product_subscription_post';
$route['products/details/(:any)'] = 'customer/products/details/$1';
$route['products/checkout/(:any)'] = 'customer/products/checkout/$1';
$route['products/checkout_addition/(:any)'] = 'customer/products/checkout_addition/$1';
$route['products/verify_product_payment'] = 'customer/products/verify_product_payment';
$route['products/verify_product_addition_payment'] = 'customer/products/verify_product_addition_payment';
$route['products/buy_product/(:any)'] = 'customer/products/buy_product/$1';
$route['products/buy_product_addition/(:any)'] = 'customer/products/buy_product_addition/$1';
$route['products/result'] = 'customer/products/product_payment_result';
$route['products/create_email'] = 'customer/products/create_email';
$route['products/update_email'] = 'customer/products/update_email_password';
$route['products/delete_email/(:any)/(:any)'] = 'customer/products/delete_email/$1/$2';
$route['products/workspace_dns_check/(:any)'] = 'customer/products/workspace_dns_check/$1';


$route['send_app_admin'] = 'customer/domains/send_app_admin';
$route['edit_send_app_admin/(:any)'] = 'customer/domains/edit_send_app_admin/$1';
$route['transfer_domain_request/(:any)'] = 'customer/domains/transfer_domain_request/$1';
$route['checkIfCustomerExist'] = 'customer/domains/checkIfCustomerExist';
$route['cancel_request_customer/(:any)/(:any)'] = 'customer/domains/cancel_request_customer/$1/$2';
$route['cancel_applications/(:any)/(:any)'] = 'customer/domains/cancel_applications/$1/$2';
$route['cancel_waiver/(:any)/(:any)'] = 'customer/domains/cancel_waiver/$1/$2';


$route['order_details/(:any)/(:any)'] = 'customer/domains/order_details/$1/$2';
$route['application_details/(:any)'] = 'customer/domains/application_details/$1';
$route['domain_waiver/(:any)'] = 'customer/domains/domain_waiver/$1';
$route['edit_waiver_docs/(:any)'] = 'customer/domains/edit_waiver_docs/$1';
$route['edit_waiver_review/(:any)'] = 'customer/domains/edit_waiver_review/$1';
$route['waiver_send_app_admin/(:any)'] = 'customer/domains/waiver_send_app_admin/$1';



$route['domain_renew_details/(:any)'] = 'customer/domains/domain_renew_details/$1';


$route['getInfo'] = 'customer/domains/getInfo';



$route['transfer_domain_check'] = 'customer/domains/transfer_domain_check';
$route['transfer_domain_in'] = 'customer/domains/transfer_domain_in';
$route['transfer_domain_in_request'] = 'customer/domains/transfer_domain_in_request';
$route['resend_transfer_request_email'] = 'customer/domains/resend_transfer_request_email';
$route['repay_order'] = 'customer/domains/repay_order';
$route['repay_order_change_cart'] = 'customer/domains/repay_order_change_cart';
$route['repay_success'] = 'customer/domains/repay_success';

// special offer
$route['transfer_domain_in_offer'] = 'customer/domains/transfer_domain_in_request';

$route['transfer_domain/(:any)'] = 'customer/domains/transfer_domain/$1';
$route['search_ajax'] = 'customer/domains/domain_check_ajax';
$route['my_domains'] = 'customer/domains/my_domains';
$route['my_orders'] = 'customer/domains/my_orders';
$route['my_purchases'] = 'customer/domains/my_purchases';
$route['domain_details/(:any)'] = 'customer/domains/domain_details/$1';
$route['host_check'] = 'customer/domains/host_check';
$route['domain_nameserver_change'] = 'customer/domains/domain_nameserver_change';
$route['domain_contact_change'] = 'customer/domains/domain_contact_change';
$route['domain_delete/(:any)'] = 'customer/domains/domain_delete/$1';
$route['domain_delete_request/(:any)'] = 'customer/domains/domain_delete_request/$1';
$route['domain_restore/(:any)'] = 'customer/domains/domain_restore/$1';
$route['domain_restore_request/(:any)'] = 'customer/domains/domain_restore_request/$1';
$route['send_authentication_code/(:any)'] = 'customer/domains/send_authentication_code/$1';
$route['domain_renew'] = 'customer/domains/domain_renew';
$route['renew_payment_success'] = 'customer/domains/renew_payment_success';
$route['domain_unlock/(:any)'] = 'customer/domains/domain_unlock/$1';
$route['domain_lock/(:any)'] = 'customer/domains/domain_lock/$1';
$route['resend_request_email/(:any)/(:any)'] = 'customer/domains/resend_request_email/$1/$2';




/* domain dns routes*/
$route['domain_dns_management/(:any)'] = 'customer/domains/domain_dns_management/$1';
$route['dns_record_add'] = 'customer/domains/dns_record_add';
$route['dns_record_delete'] = 'customer/domains/dns_record_delete';
$route['dns_record_edit'] = 'customer/domains/dns_record_edit';
$route['domain_dnssec_enable/(:any)'] = 'customer/domains/domain_dnssec_enable/$1';
$route['domain_dnssec_disable/(:any)'] = 'customer/domains/domain_dnssec_disable/$1';
$route['domain_dnssec_enable_form'] = 'customer/domains/domain_dnssec_enable_form';











$route['cu/(:any)'] = 'customer/$1';
$route['cu/(:any)/(:any)'] = 'customer/$1/$2';
$route['cu/addresses/(:any)'] = 'customer/addresses/$1';
$route['cu/addresses/(:any)/(:any)'] = 'customer/addresses/$1/$2';

$route['cu/(:any)/(:any)/(:any)'] = 'customer/$1/$2/$3';

$route['profile'] = 'customer/profile';
//$route['my_orders'] = 'customer/my_orders';
$route['wishlist'] = 'customer/wishlist';
$route['delivery_addresses'] = 'customer/addresses/delivery_addresses';
$route['save_address'] = 'customer/addresses/save_address';
$route['save_cart_address'] = 'customer/addresses/save_cart_address';
$route['get_customer_address'] = 'customer/addresses/get_customer_address';

$route['get_customer_cart_addresses'] = 'customer/addresses/get_customer_cart_addresses';
$route['add_address'] = 'customer/addresses/add_address';
$route['edit_address/(:num)'] = 'customer/addresses/edit_address/$1';
$route['delete_address/(:num)'] = 'customer/addresses/delete_address/$1';

$route['get_installation_feature'] = 'customer/addresses/get_installation_feature';
$route['get_related_discrets'] = 'customer/addresses/get_related_discrets';


$route['subscriptions'] = 'customer/subscriptions';
$route['health_status'] = 'customer/health_status';
$route['own_program'] = 'customer/own_program';
$route['my_consulting'] = 'customer/my_consulting';
$route['communication_administration'] = 'customer/communication_administration';
$route['settings'] = 'customer/change_password';
$route['getAddress'] = 'customer/getAddress';
$route['pdf/(:any)/(:any)'] = 'customer/domains/pdf/$1/$2';

$route['customerAddress'] = 'customer/customerAddress';
$route['saveAddress'] = 'customer/saveAddress';

$route['communicate_admin'] = 'customer/communicate_admin';
$route['communicate_admin/(:any)'] = 'customer/communicate_admin/$1';
$route['communicate_admin/(:any)/(:any)'] = 'customer/communicate_admin/$1/$2';

$route['^(en|ar)/customer/verify_phone_number'] = 'customer/authentication/verify_phone_number';
$route['^(en|ar)/auth/(:any)'] = 'customer/authentication/$1';
$route['^(en|ar)/auth/(:any)/(:any)'] = 'customer/authentication/$1/$2';
$route['^(en|ar)/auth/(:any)/(:any)/(:any)'] = 'customer/authentication/$1/$2/$3';
$route['^(en|ar)/auth/(:any)/(:any)/(:any)/(:any)'] = 'customer/authentication/$1/$2/$3/$4';
$route['^(en|ar)/login'] = 'customer/authentication/login';
$route['^(en|ar)/customer/login'] = 'customer/authentication/login';
$route['^(en|ar)/register'] = 'customer/authentication/register';
$route['^(en|ar)/cu/(:any)'] = 'customer/$2';
$route['^(en|ar)/cu/(:any)/(:any)'] = 'customer/$2/$3';
$route['^(en|ar)/cu/addresses/(:any)'] = 'customer/addresses/$2';
$route['^(en|ar)/cu/addresses/(:any)/(:any)'] = 'customer/addresses/$2/$3';
$route['sendVerificationEmailAgain'] = 'customer/authentication/sendVerificationEmailAgain';
