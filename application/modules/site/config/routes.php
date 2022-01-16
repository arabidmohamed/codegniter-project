<?php defined('BASEPATH') OR exit('No direct script access allowed');





$route['ar'] = 'site/ar';
$route['en'] = 'site/en';
$route['ar/(:any)'] = 'site/ar/$1';
$route['en/(:any)'] = 'site/en/$1';

$route['changeLanguage/(:any)'] = 'site/changeLanguage/$1';
$route['changeLanguage/(:any)/(:any)'] = 'site/changeLanguage/$1/$2';

$route['logout'] = 'site/logout';
$route['contactus'] = 'site/contactus';
$route['services'] = 'site/services';
$route['TakeAppointment'] = 'site/TakeAppointment';
$route['show_custom_pages/(:num)'] = 'site/show_custom_pages/$1';
$route['logout'] = 'site/logout';
$route['contactus'] = 'site/contactus';
$route['sendEmailToWebsite'] = 'site/sendEmailToWebsite';
$route['subscribeToNewsLetter'] = 'site/subscribeToNewsLetter';
$route['aboutus'] = 'site/aboutus';
$route['faq'] = 'site/faq';
$route['google-workspace'] = 'site/google_workplace';
$route['terms_conditions'] = 'site/terms_conditions';
$route['news'] = 'site/news';
$route['albums'] = 'site/albums';
$route['branches'] = 'site/branches';
$route['how_to_transfer'] = 'site/how_to_transfer';
$route['brancheDetails/(:num)'] = 'site/brancheDetails/$1';
$route['classDetails/(:num)'] = 'site/classDetails/$1';

/* domain routes*/
$route['domains'] = 'site/domains';
$route['search'] = 'site/domains/domain_check';
$route['domain_verified'] = 'site/domains/domain_verified';
$route['admin_officer_verify_domain'] = 'site/domains/admin_officer_verify_domain';
$route['domain_verify_mobile'] = 'site/domains/domain_verify_mobile';
$route['process_payment'] = 'site/domains/process_payment';
$route['payment_success'] = 'site/domains/payment_success';
$route['change_request'] = 'site/domains/change_request';
$route['mobile_verify_change_request'] = 'site/domains/mobile_verify_change_request';
$route['domain_approve_modifications'] = 'site/domains/domain_approve_modifications';


$route['sendVerificationCodeRequest'] = 'site/domains/sendVerificationCodeRequest';
$route['sendVerificationCodeTransferRequest'] = 'site/domains/sendVerificationCodeTransferRequest';
$route['sendVerificationCodeContact'] = 'site/domains/sendVerificationCodeContact';

$route['restore_payment_success'] = 'site/domains/restore_payment_success';
$route['cancel_request/(:any)/(:any)'] = 'site/domains/cancel_request/$1/$2';
$route['cancel_request/(:any)/(:any)/(:any)'] = 'site/domains/cancel_request/$1/$2/$3';
$route['uncaught_syntax'] = 'site/domains/uncaught_syntax';





$route['transferDomainContacts/(:any)'] = 'site/refactory/transferDomainContacts/$1';


$route['transfer_payment_success'] = 'site/domains/transfer_payment_success';
$route['mobile_verify_change_transfer_request'] = 'site/domains/mobile_verify_change_transfer_request';

$route['transfer_request'] = 'site/domains/transfer_request';
$route['change_approved'] = 'site/domains/change_approved';
$route['transfer_approved'] = 'site/domains/transfer_approved';
$route['payment_methods'] = 'site/domains/payment_methods';

$route['payment_methods_transfer'] = 'site/domains/payment_methods_transfer';
$route['payment_methods_restore'] = 'site/domains/payment_methods_restore';
$route['resend_transfer_request'] = 'site/domains/resend_transfer_request';
$route['repay_transfer'] = 'site/domains/repay_transfer';




// for testing
$route['domain_cpanel_create/(:any)'] = 'site/cpanel/domain_cpanel_create/$1';
$route['DNSSEC_enable/(:any)'] = 'site/cpanel/DNSSEC_enable/$1';
$route['DNSSECkey_get/(:any)'] = 'site/cpanel/DNSSECkey_get/$1';
$route['dnsRecords_get/(:any)'] = 'site/cpanel/dnsRecords_get/$1';





$route['faqs'] = 'site/faqs';
$route['portfolios'] = 'site/portfolios';
$route['portfolios/details/(:num)'] = 'site/portfolio_details/$1';
$route['projects'] = 'site/projects';
$route['projects/details/(:num)/(:any)'] = 'site/project_details/$1/$2';
$route['partners'] = 'site/partners';
$route['clients'] = 'site/clients';
$route['news/(:num)'] = 'site/news_details/$1';
$route['subscriptionPlans'] = 'site/subscriptionPlans';
$route['hd/(:any)'] = 'site/home_datatable/$1';
$route['blogs'] = 'site/blogs';
$route['blogs/(:any)'] = 'site/blogs/$1';
$route['blogs/details/(:num)'] = 'site/blog_detail/$1';
$route['blogs/tag/(:any)'] = 'site/blogsByTags/$1';


$route['solutions'] = 'site/solutions';
$route['solutions/(:num)'] = 'site/solutions_details/$1';

$route['cronjobs/check_domain_transfer_status'] = 'site/cronjobs/check_domain_transfer_status';
$route['cronjobs/notifiyExpireDomains'] = 'site/cronjobs/notifiyExpireDomains';
$route['cronjobs/pollMessages'] = 'site/cronjobs/pollMessages';
$route['cronjobs/workspace_create'] = 'site/cronjobs/workspace_create';
$route['cronjobs/dnet_email_create'] = 'site/cronjobs/dnet_email_create';
$route['cronjobs/change_seats'] = 'site/cronjobs/change_seats';
$route['cronjobs/checkPendingDelete'] = 'site/cronjobs/checkPendingDelete';
$route['cronjobs/send_transfer_emails_request'] = 'site/cronjobs/send_transfer_emails_request';

$route['cronjobs/test'] = 'site/cronjobs/test';
$route['cronjobs/change_request_reminder'] = 'site/cronjobs/change_request_reminder';
$route['cronjobs/cancel_change_request'] = 'site/cronjobs/cancel_change_request';
$route['cronjobs/updateDocs'] = 'site/cronjobs/updateDocs';

$route['cronjobs/getAllTicketsWithAnsweredStatus'] = 'site/cronjobs/getAllTicketsWithAnsweredStatus';


$route['loadMoreProductsByCategoryAndSubCategory'] = 'site/products/loadMoreProductsByCategoryAndSubCategory';

$route['rateYourOrder/(:any)/(:any)'] = 'site/rateYourOrder/$1/$2';
$route['saveOrderRate'] = 'site/saveOrderRate';

$route['make_diet_orders'] = 'site/make_diet_orders';
$route['generate_invoice'] = 'site/generate_invoice';


$route['foodTable'] = 'site/foodTable';

$route['categories'] = 'site/Products/categories';
$route['categories/(:num)'] = 'site/Products/categories/$1';
$route['categories/(:num)/(:num)'] = 'site/Products/categories/$1/$2';

$route['loadMoreProductsGallery'] = 'site/products/loadMoreProductsGallery';
// $route['productsGalleryCustome'] = 'site/productsGalleryCustome';
$route['loadMoreNews'] = 'site/loadMoreNews';

$route['PagesDetails/(:any)'] = 'site/PagesDetails/$1';

$route['products/(:any)'] = 'site/Products/productDetails/$1';
$route['products/(:any)/(:any)'] = 'site/Products/productDetails/$1/$2';
$route['products/(:any)/(:any)/(:any)'] = 'site/Products/productDetails/$1/$2/$3';

$route['getPricePerUnit'] = 'site/Products/getPricePerUnit';
$route['cartDetails'] = 'site/Cart/cart_details';
$route['getAvailableStock'] = 'site/Products/getAvailableStock';




$route['subscriptionDetails'] = 'site/subscriptionDetails';
$route['getPayedSubscriptions'] = 'site/getPayedSubscriptions';
$route['saveCustomerPreferances'] = 'site/saveCustomerPreferances';
$route['my_consulting'] = 'support/index';


$route['customerAddress'] = 'customer/addresses/save_address';

$route['careers'] = 'site/careers';
$route['careers/(:any)'] = 'site/careers/$1';

$route['c/(:any)'] = 'site/cart/$1';
$route['c/(:any)/(:num)'] = 'site/cart/$1/$2';
$route['c/(:any)/(:num)/(:num)'] = 'site/cart/$1/$2/$3';

$route['checkout/payment/(:num)/(:any)'] = 'site/hyperpay/payment_page/$1/$2';

$route['paytabs/(:any)'] = 'site/paytabs/$1';
$route['hyperpay/(:any)'] = 'site/hyperpay/$1';
//$route['search'] = 'site/products/search';

$route['^(ar|en)/c/check_promocode'] = 'site/cart/check_promocode';
$route['^(ar|en)/c/cart_details'] = 'site/cart/cart_details';
$route['^(ar|en)/c/(:any)'] = 'site/cart/$1';
$route['^(ar|en)/c/(:any)/(:num)'] = 'site/cart/$1/$2';
$route['^(ar|en)/c/(:any)/(:num)/(:num)'] = 'site/cart/$1/$2/$3';
$route['c/(:any)'] = 'site/cart/$1';
$route['c/(:any)/(:num)'] = 'site/cart/$1/$2';
$route['c/(:any)/(:num)/(:num)'] = 'site/cart/$1/$2/$3';



$route['hyperpay/create_charge'] = 'site/hyperpay/create_charge';


$route['order/checkOrderLimit'] = 'site/hyperpay/checkOrderLimit';
$route['order/checkOrderLimit/(:any)'] = 'site/hyperpay/checkOrderLimit/$1';
$route['order/success'] = 'site/hyperpay/order_success';
$route['order/success/(:any)/(:any)'] = 'site/hyperpay/order_success/$1/$2';
$route['checkout/payment/(:num)/(:any)'] = 'site/hyperpay/payment_page/$1/$2';
$route['paytabs/(:any)'] = 'site/paytabs/$1';
$route['^(ar|en)/order/checkOrderLimit'] = 'site/hyperpay/checkOrderLimit';
$route['^(ar|en)/order/checkOrderLimit/(:any)'] = 'site/hyperpay/checkOrderLimit/$1';
$route['^(ar|en)/order/success/(:num)'] = 'site/hyperpay/order_success/$1';
$route['^(ar|en)/checkout/payment/(:num)/(:any)'] = 'site/hyperpay/payment_page/$1/$2';
$route['^(ar|en)/paytabs/(:any)'] = 'site/paytabs/$1';
$route['hyperpay/(:any)'] = 'site/hyperpay/$1';
$route['hyperpay/payment_success/(:num)/(:any)'] = 'site/hyperpay/payment_success/$1/$2';
$route['^(ar|en)/hyperpay/(:any)'] = 'site/hyperpay/$1';
$route['^(ar|en)/hyperpay/payment_success/(:num)/(:any)'] = 'site/hyperpay/payment_success/$1/$2';

$route['search_products'] = 'site/products/search_products';
$route['chocolates'] = 'site/products/products_list';
$route['products/httpGetSubCategories'] = 'site/products/httpGetSubCategories';
$route['products/SubmitReview'] = 'site/products/SubmitReview';
$route['products/deleteXHRReview'] = 'site/products/deleteXHRReview';
$route['products/SubmitRating'] = 'site/products/SubmitRating';
$route['products/addProductToWhislist'] = 'site/products/addProductToWhislist';
$route['^(ar|en)/search_products'] = 'site/products/search_products';
$route['^(ar|en)/chocolates'] = 'site/products/products_list';
$route['^(ar|en)/products/httpGetSubCategories'] = 'site/products/httpGetSubCategories';
$route['^(ar|en)/products/SubmitReview'] = 'site/products/SubmitReview';
$route['^(ar|en)/products/deleteXHRReview'] = 'site/products/deleteXHRReview';
$route['^(ar|en)/products/SubmitRating'] = 'site/products/SubmitRating';

$route['addToWishlist'] = 'site/products/addToWishlist';
$route['removeFromWishlist'] = 'site/products/removeFromWishlist';
