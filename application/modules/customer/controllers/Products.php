<?php

defined('BASEPATH') or exit('No direct script access allowed');

// Require main contoller
require_once APPPATH . 'modules/customer/controllers/Base_Controller.php';

class Products extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model', 'product');
        $this->load->model('domain_model', 'domain');
        date_default_timezone_set('UTC');
    }

    // This method is to show list of product subscriptions which are created 
    public function index() {
        // Getting logged in user id
        $userid = $this->session->userdata($this->site_session->userid());
        
        // Getting product list
        $data['products'] = $this->product->getProductList();

        // Getting user's "created subscriptions"
        $data['subscriptions'] = $this->product->getSubscriptions($userid);

        // Getting website configurations
        $data['settings'] = $this->home_model->Get_Website_Configuration();
        $this->LoadView_m('products/main', $data);
    }

    // This method is used to show details of product subscription
    public function details($id) {
        // Decrypting subscription id
        $id = decryptIt($id);
        
        // Getting logged in user id
        $user_id = $this->session->userdata($this->site_session->userid());

        // Getting subscription details
        $data['subscription'] = $this->product->getSubscriptionDetails($id, $user_id);
        
        // checking for dnet emails
        if($data['subscription']->Product_ID == 2){
            
            // loading cpanel library
            $this->load->library('Cpanel_lib');
            
            $data['emails'] = json_decode($this->cpanel_lib->listEmail($data['subscription']->domain))->data;
            
        }

        // Getting website configurations
        $data['settings'] = $this->home_model->Get_Website_Configuration();

        // Get the MX DNS records
        $data['check_host'] = dns_get_record($data['subscription']->domain, DNS_MX);

        if (!empty($data['check_host'])) {
            // Get values for each MX record
            $record_target_1 = array_search('aspmx.l.google.com', array_column($data['check_host'], 'target'));
            $record_pri_1 = $data['check_host'][$record_target_1]['pri'];
            if ($record_pri_1 == 1) {
                $data['record_1'] = TRUE;
            }

            $record_target_2 = array_search('alt1.aspmx.l.google.com', array_column($data['check_host'], 'target'));
            $record_pri_2 = $data['check_host'][$record_target_2]['pri'];
            if ($record_pri_2 == 5) {
                $data['record_2'] = TRUE;
            }

            $record_target_3 = array_search('alt2.aspmx.l.google.com', array_column($data['check_host'], 'target'));
            $record_pri_3 = $data['check_host'][$record_target_3]['pri'];
            if ($record_pri_3 == 5) {
                $data['record_3'] = TRUE;
            }

            $record_target_4 = array_search('alt3.aspmx.l.google.com', array_column($data['check_host'], 'target'));
            $record_pri_4 = $data['check_host'][$record_target_4]['pri'];
            if ($record_pri_4 == 10) {
                $data['record_4'] = TRUE;
            }

            $record_target_5 = array_search('alt4.aspmx.l.google.com', array_column($data['check_host'], 'target'));
            $record_pri_5 = $data['check_host'][$record_target_5]['pri'];
            if ($record_pri_5 == 10) {
                $data['record_5'] = TRUE;
            }

            // Check that all record is TRUE
            if ($data['record_1'] == TRUE && $data['record_2'] == TRUE && $data['record_3'] == TRUE && $data['record_4'] == TRUE && $data['record_5'] == TRUE) {
                $data['records_pass'] = TRUE;
            }
        }

        $this->LoadView_m('products/product_details', $data);
    }

    public function product_list() {
        // Getting website configurations
        $data['settings'] = $this->home_model->Get_Website_Configuration();

        // Getting product list
        $data['products'] = $this->product->getProductList();

        $this->LoadView_m('products/list', $data);
    }

    // Method for showing product subscription details entry form
    public function product_subscription($id) {
        // Decrypting Product id
        $id = decryptIt($id);

        // Saving product id for view
        $data['pId'] = $id;

        // for checking domain is exist in database OR not
        if ($this->input->get('id')) {
            $data['domain_id'] = decryptIt($this->input->get('id'));
        } else {
            $data['domain_id'] = 0;
        }

        // Getting website configurations
        $data['settings'] = $this->home_model->Get_Website_Configuration();

        // Getting logged in user id
        $userid = $this->session->userdata($this->site_session->userid());

        // Getting product details
        $data['product'] = $this->product->getProduct($id);

        // Getting product's pricing
        $data['prices'] = $this->product->getProductPrices($id);

        // Getting user's registered domain list
        $data['domains'] = $this->domain->getMyDomains($userid);

        // Getting user's subscribed domain list for removing it from registered domain list
        $data['subscribed_domains'] = $this->domain->getMyDomainsForProduct($userid);

        $this->LoadView_m('products/subscription', $data);
    }

    // Method for saving subscription details
    public function product_subscription_post() {
        // Getting product details
        $p = $this->product->getProduct($this->input->post('pId'));

        // product subscription period
        $numberOfDays = $p->period;

        // setting timezone
        date_default_timezone_set('UTC');

        // Preparing data for insertion
        $data = array(
            'domain' => $this->input->post('domain'),
            'S_first_name' => $this->input->post('first_name'),
            'S_last_name' => $this->input->post('last_name'),
            'S_organization_name' => $this->input->post('organization_name'),
            'primary_email' => $this->input->post('primary_email'),
            'primary_password' => encryptIt($this->input->post('primary_password')), // Encrypting and saving primary email's password
            'alternate_email' => $this->input->post('alternate_email'),
            'Product_ID' => $this->input->post('pId'),
            'Customer_ID' => $this->session->userdata($this->site_session->userid()),
            'Expires_At' => date('Y-m-d', strtotime('+' . $numberOfDays . ' days')), // Calculating and saving expiry date
            'Start_At' => date('Y-m-d'),
            'Price_ID' => $this->input->post('prId'),
            'Num_of_licenses' => $this->input->post('No_of_licenses'),
        );

        // Check wheter data is inserted or not
        if ($this->product->addSubscription($data)) {
            $rId = $this->db->insert_id(); // requestion id
            redirect('products/buy_product/' . encryptIt($rId));  // redirecting to payment procedure
        } else {
            redirect('products/subscription/' . $this->input->post('pId')); // redirecting to subscription details entry form
        }
    }

    // Method for payment details entry
    public function buy_product($rId) {
        // Decrypting subscription id
        $rId = decryptIt($rId);

        // Getting logged in user id
        $user_id = $this->session->userdata($this->site_session->userid());

        // Getting subsription details of loggedin user
        $req = $this->product->getSubscriptionDetails($rId, $user_id);

        //checking for gsuite account
        if($req->Product_ID == 1){
            $this->load->library('ResellerGSuite', 'resellergsuite'); // loading gsuit library

            /*
              |
              |--------------------------------------------------------------------------
              | Set Reseller Admin User/Email From Config/Config.php Global Variable.
              |--------------------------------------------------------------------------

              |
             */
            $RESELLER_ADMIN_EMAIL = $this->config->item('reseller_admin_email');

            /*
              |
              |--------------------------------------------------------------------------
              | Pass Customer Domain and Site To Check If Is It Available.
              |--------------------------------------------------------------------------

              |
             */
            $RESELLER_CUSTOMER_DOMAIN = $req->domain;
            $RESELLER_CUSTOMER_SITE = 'www.' . $req->domain;

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //Call createSiteToken to create Site Token To Verify
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $this->resellergsuite->createSiteToken($RESELLER_ADMIN_EMAIL, $RESELLER_CUSTOMER_DOMAIN, $RESELLER_CUSTOMER_SITE);


            $is_exist = $this->resellergsuite->verifyCustomer($RESELLER_CUSTOMER_DOMAIN);

            // Check domain if it already registered in Gsuite OR Not
            if ($is_exist) {
                redirect("products/result?r=workspace_error_1001");
            }
            
        }elseif($req->Product_ID == 2){ //checking for dnet emails
            
            // loading cpanel library
            $this->load->library('Cpanel_lib');
        
            // search for addon domain
            $result = json_decode($this->cpanel_lib->getEmailAddondomainList($req->domain))->cpanelresult->data;

            // Checking addondomain if it is already exists
            if (count($result) > 0) {
                redirect("products/result?r=dnetemails_error_1001");
            }
        }

        $this->load->library('E_Wallet');
        $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($user_id, 1);
        $data['can_add_transaction'] = $can_add_transaction;

        // Checking subscription availablility against provided id
        if (count($req)) {
            $data['price'] = $this->product->getPriceDetails($req->Price_ID); // Getting product price
            $data['rId'] = $rId; // For passing subscription id into view
            $data['subscription'] = $req; // For passing subscription details into view
            $data['settings'] = $this->home_model->Get_Website_Configuration(); // Getting Website Configurations
            $this->LoadView_m('products/payment', $data); // redirect to payment verification
        } else {
            redirect(''); // redirect to home
        }
    }

    // Method for payment checkout
    public function checkout($rId) {
        // Decrypting subscription id
        $rId = decryptIt($rId);

        // Getting logged in user id
        $user_id = $this->session->userdata($this->site_session->userid());


        $req = $this->product->getSubscriptionDetails($rId, $user_id); // Getting subscription details
        //checking wheter required subscription is logged in user's property or not
        if (count($req)) {
            $this->load->library('payments/hyperpay_lib'); // loading hyperpay library
            $data['settings'] = $this->home_model->Get_Website_Configuration(); //
            // Getting logged in user id
            $customer_id = $this->session->userdata($this->site_session->userid());

            // Getting product's price
            $price = $this->product->getPriceDetails($req->Price_ID);

            // required payment method
            $paymenttype = $this->input->post('payment_type');

            // Calculating VAT
            $VAT = round(($data['settings']['web_settings'][0]->Vat / 100) * ($price->Price * $req->Num_of_licenses), 2);

            // number of licenses
            $num_of_seats = array('num_of_seats' => $req->Num_of_licenses);


            $sub_amount = ($price->Price * $req->Num_of_licenses);
            $total_price = ($price->Price * $req->Num_of_licenses) + $VAT; 
            $total_price = number_format((float) $total_price, 2, '.', '');

            // Preparing data for order insertion
            $data = array(
                'Subscription_ID' => $req->Subscription_ID,
                'VAT' => $data['settings']['web_settings'][0]->Vat,
                'subamount' => $sub_amount,
                'Total_Price' => $total_price,
                'Cart_Type' => $paymenttype,
                'Order_Type' => $req->OrderType.'_new',
                'Order_Details' => json_encode($num_of_seats),
            );
            $order_id = $this->product->addOrder($data); // order insertion
            // Getting customer's details
            $customerDetails = $this->customer_model->getUser(array('user_id' => $customer_id));

            // Saving payment method in session for later use
            $this->session->set_userdata('PaymentType', $paymenttype);

            $this->load->library('E_Wallet');
            $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($customer_id, $total_price);
            $data['can_add_transaction'] = $can_add_transaction;

            $code = 0;
            if ($paymenttype == 'WALLET') {
                $data['current_balance'] = $this->e_wallet->getCustomerWalletBalance($user_id);
                $payment_referance = randomNumber(20) . '-e-wallet';
            } else {
                // Payment checkout
                $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price, $order_id, $customerDetails[0], $paymenttype));
                $code = $response->result->code;
                $payment_referance = $response->id;
            }

            // Checking payment checkout response's code
            if ($code == '000.200.100' || $paymenttype == 'WALLET') {
                $data['checkout_id'] = $payment_referance;
                $data['payment_type'] = $paymenttype;

                // * Payment Log
                $log = array(
                    'Customer_ID' => $customer_id,
                    'Type' => 'Select Hyperpay payment method',
                    'Response' => json_encode($response),
                );
                $this->product->addAPISLog($log);
                // Update subscription customer payment data
                $subscription_up = array(
                    'Order_ID' => $order_id,
                    'payment_ref' => $payment_referance,
                );
                $where = array('Order_ID' => $order_id);
                $this->db->where($where);
                $this->db->update('product_orders', $subscription_up);
            }
            $data['action'] = base_url("products/verify_product_payment/");
            $this->load->view('products/hyperpay_pay', $data);
        }
    }

    // Method to show payment success or failure information
    public function product_payment_result() {
        // Checking result input and user session
        if (isset($_GET['r']) && $this->session->userdata($this->site_session->userid())) {
            $data['pageTitle'] = getSystemString('products');
            $data['settings'] = $this->home_model->Get_Website_Configuration();
            $this->LoadView_m('products/payment_result', $data);
        } else {
            redirect();
        }
    }

    // Method for saving details of subscription updation
    public function buy_product_addition($rId) {
        // Decrypting subscription id
        $rId = decryptIt($rId);

        // Getting logged in user id
        $user_id = $this->session->userdata($this->site_session->userid());
        $req = $this->product->getSubscriptionDetails($rId, $user_id); // Getting subscription details and checking wheter required subscription is logged in user's property or nor

        $this->load->library('E_Wallet');
        $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($user_id, 1);
        $data['can_add_transaction'] = $can_add_transaction;

        // Checking subscription availablility against provided id
        if (count($req) && $this->input->post('licenses')) {
            $data['price'] = $this->product->getPriceDetails($req->Price_ID); // Getting product's price details
            $data['rId'] = $rId;  // passing subscription id to view
            $data['req'] = $req;  // passing subscription details to view
            $data['licenses'] = $this->input->post('licenses');  // passing number of licenses to view
            $data['subscription'] = $req; // passing subscription details to view
            $data['settings'] = $this->home_model->Get_Website_Configuration();
            $this->LoadView_m('products/payment_addition', $data);
        } else {
            redirect('');
        }
    }

    // Method for payment checkout for subscription updation
    public function checkout_addition($rId) {
        // Decrypting subscription id
        $rId = decryptIt($rId);

        // Getting logged in user id
        $user_id = $this->session->userdata($this->site_session->userid());

        // Getting subscription details and checking required subscription is logged in user's property or not
        $req = $this->product->getSubscriptionDetails($rId, $user_id);

        // Checking subscription availablility against provided id
        if (count($req) && $this->input->post('licenses')) {
            $this->load->library('payments/hyperpay_lib'); // loading hyperpay library
            $data['settings'] = $this->home_model->Get_Website_Configuration();  // website configuration

            $customer_id = $this->session->userdata($this->site_session->userid());
            $price = $this->product->getPriceDetails($req->Price_ID);
            $paymenttype = $this->input->post('payment_type');
            $sub_total = ($price->Price * $this->input->post('licenses'));
            $per_day = $sub_total / $req->period;
            // Calculating total amount for remaining days in scubscription 
            $total = round($per_day * ((strtotime($req->Expires_At) - strtotime(date('Y-m-d'))) / (60 * 60 * 24)), 2);
            $VAT = round(($data['settings']['web_settings'][0]->Vat / 100) * ($total), 2);
            $num_of_seats = array('num_of_seats' => $this->input->post('licenses'));

            $total_price = $total + $VAT;
            $total_price = number_format((float) $total_price, 2, '.', '');
            // Preparing data for order insertion
            $data = array(
                'Subscription_ID' => $req->Subscription_ID,
                'VAT' => $data['settings']['web_settings'][0]->Vat,
                'subamount' => $total,
                'Total_Price' => $total_price,
                'Cart_Type' => $paymenttype,
                'Order_Type' => $req->OrderType.'_license_addition',
                'Order_Details' => json_encode($num_of_seats)
            );
            $order_id = $this->product->addOrder($data); // order insertion..
            // Getting customer's details
            $customerDetails = $this->customer_model->getUser(array('user_id' => $customer_id));
            
            // Saving payment method in session for later use
            $this->session->set_userdata('PaymentType', $paymenttype);

            $this->load->library('E_Wallet');
            $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($customer_id, $total_price);
            $data['can_add_transaction'] = $can_add_transaction;

            $code = 0;
            if ($paymenttype == 'WALLET') {
                $data['current_balance'] = $this->e_wallet->getCustomerWalletBalance($user_id);
                $payment_referance = randomNumber(20) . '-e-wallet';
            } else {
                // Payment checkout
                $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price, $order_id, $customerDetails[0], $paymenttype));
                $code = $response->result->code;
                $payment_referance = $response->id;
            }

            // Checking payment checkout response's code
            if ($code == '000.200.100' || $paymenttype == 'WALLET') {
                $data['checkout_id'] = $payment_referance;
                $data['payment_type'] = $paymenttype;

                // * Payment Log
                $log = array(
                    'Customer_ID' => $customer_id,
                    'Type' => 'Select Hyperpay payment method',
                    'Response' => json_encode($response),
                );
                $this->product->addAPISLog($log);
                //update subscription customer payment data
                $subscription_up = array(
                    'Order_ID' => $order_id,
                    'payment_ref' => $payment_referance,
                );
                $where = array('Order_ID' => $order_id);
                $this->db->where($where);
                $this->db->update('product_orders', $subscription_up);
            }
            $data['action'] = base_url("products/verify_product_addition_payment/");
            $this->load->view('products/hyperpay_pay', $data);
        }
    }

    // Method for payment verification
    public function verify_product_payment() {
        $data['settings'] = $this->home_model->Get_Website_Configuration(); // website configuration
        $payment_referance = $this->input->GET('id'); // Payment reference id
        // Checking payment reference id
        if ($payment_referance) {

            $product_order_info = $this->product->getProductOrderByReferancePayment($payment_referance);
            $cart_type = $product_order_info->Cart_Type;

            $total_price = $product_order_info->Total_Price;

            // Check payment type
            if ($cart_type == 'WALLET') {

                /* add wallet transactions */
                $customer_id = $product_order_info->Customer_ID;
                $this->load->library('E_Wallet');
                $transaction_result = $this->e_wallet->modifyCreditsForCustomers($customer_id, '-', $total_price, 'Workspace Create', $customer_id, $payment_referance);
                $response_id = $payment_referance;
                $order_id = $product_order_info->Order_ID;
            } else {

                $this->load->library('payments/hyperpay_lib'); // loading payment library
                $response = json_decode($this->hyperpay_lib->VerifyPayment($payment_referance, $this->session->userdata('PaymentType'))); // verifying payment
                $this->session->unset_userdata('PaymentType'); // removing from session

                $code = $response->result->code;  // Getting verification response code
                $order_id = $response->merchantTransactionId; // Getting verification response transaction id

                $customer_id = $this->session->userdata($this->site_session->userid()); // customer id
                //verify payment response log
                $log = array(
                    'Customer_ID' => $customer_id,
                    'Type' => 'Verify Payment Response',
                    'Response' => json_encode($response),
                );
                $this->product->addAPISLog($log);
            }

            // Check verification response
            if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code) || $transaction_result) {
                $updata['Order_ID'] = $order_id;
                $updata['Payment_Verified'] = 1;

                $this->product->updateOrder($updata); // updating order's details
                $this->_sendProductOrderEmail($order_id); // sending billing email

                $data['result'] = 'success';
                $this->LoadView_m('products/payment_result', $data);
            } else {

                $this->session->set_flashdata('error_sub', 535);
                $data['result'] = 'failed';
                $this->LoadView_m('products/payment_result', $data);
            }
        } else {
            $data['pageTitle'] = getSystemString('products');
            $data['result'] = 'failed';
            $this->LoadView_m('products/payment_result', $data);
        }
    }

    // Method for payment verification for subscription updation
    public function verify_product_addition_payment() {
        $data['settings'] = $this->home_model->Get_Website_Configuration(); // website configuration
        $payment_referance = $this->input->GET('id'); // Payment reference id
        // Checking payment reference id
        if ($payment_referance) {

            $product_order_info = $this->product->getProductOrderByReferancePayment($payment_referance);
            $cart_type = $product_order_info->Cart_Type;

            $total_price = $product_order_info->Total_Price;
            if ($cart_type == 'WALLET') {

                /* add wallet transactions */
                $customer_id = $product_order_info->Customer_ID;
                $this->load->library('E_Wallet');
                $transaction_result = $this->e_wallet->modifyCreditsForCustomers($customer_id, '-', $total_price, 'Workspace Create', $customer_id, $payment_referance);
                $response_id = $payment_referance;
                $order_id = $product_order_info->Order_ID;
            } else {

                $this->load->library('payments/hyperpay_lib'); // loading payment library
                $response = json_decode($this->hyperpay_lib->VerifyPayment($payment_referance, $this->session->userdata('PaymentType'))); // verifying payment
                $this->session->unset_userdata('PaymentType'); // removing from session

                $code = $response->result->code;  // Getting verification response code
                $order_id = $response->merchantTransactionId; // Getting verification response transaction id

                $customer_id = $this->session->userdata($this->site_session->userid()); // customer id
                // verify payment response log
                $log = array(
                    'Customer_ID' => $customer_id,
                    'Type' => 'Verify Payment Response',
                    'Response' => json_encode($response),
                );
                $this->product->addAPISLog($log);
            }

            //verify payment verification response
            if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code) || $transaction_result) {
                $details = $this->product->getorderById($order_id);
                $updata['Order_ID'] = $order_id;
                $updata['Payment_Verified'] = 1;
                
                // for dnet emails
                if($details->Product_ID == 2){
                    $updata['isCreated'] = 1;
                    $updata['Created_At'] = date('Y-m-d H:i:s');
                }
                
                $num_of_seats = json_decode($details->Order_Details)->num_of_seats; // required number of seats
                $this->product->updateSubscription($details->Subscription_ID, $details->Order_ID, $num_of_seats); // updating subscription
                $this->product->updateOrder($updata); // updating order's details
                $this->_sendProductOrderEmail($order_id); // sending billing email
                $data['result'] = 'success';
                $this->LoadView_m('products/payment_result', $data);
            } else {

                $this->session->set_flashdata('error_sub', 535);
                $data['result'] = 'failed';
                $this->LoadView_m('products/payment_result', $data);
            }
        } else {
            $data['pageTitle'] = getSystemString('products');
            $data['result'] = 'failed';
            $this->LoadView_m('products/payment_result', $data);
        }
    }

    // Method for checking workspace dns
    function workspace_dns_check($domain) {
        // Decrypting domain name
        $domain = decryptIt($domain);

        // Get the MX DNS records
        $data['check_host'] = dns_get_record($domain, DNS_MX);
        $data['domain'] = $domain;

        if (!empty($data['check_host'])) {
            // Get values for each MX record
            $record_target_1 = array_search('aspmx.l.google.com', array_column($data['check_host'], 'target'));
            $record_pri_1 = $data['check_host'][$record_target_1]['pri'];
            if ($record_pri_1 == 1) {
                $data['record_1'] = TRUE;
            }

            $record_target_2 = array_search('alt1.aspmx.l.google.com', array_column($data['check_host'], 'target'));
            $record_pri_2 = $data['check_host'][$record_target_2]['pri'];
            if ($record_pri_2 == 5) {
                $data['record_2'] = TRUE;
            }

            $record_target_3 = array_search('alt2.aspmx.l.google.com', array_column($data['check_host'], 'target'));
            $record_pri_3 = $data['check_host'][$record_target_3]['pri'];
            if ($record_pri_3 == 5) {
                $data['record_3'] = TRUE;
            }

            $record_target_4 = array_search('alt3.aspmx.l.google.com', array_column($data['check_host'], 'target'));
            $record_pri_4 = $data['check_host'][$record_target_4]['pri'];
            if ($record_pri_4 == 10) {
                $data['record_4'] = TRUE;
            }

            $record_target_5 = array_search('alt4.aspmx.l.google.com', array_column($data['check_host'], 'target'));
            $record_pri_5 = $data['check_host'][$record_target_5]['pri'];
            if ($record_pri_5 == 10) {
                $data['record_5'] = TRUE;
            }

            // Check that all record is TRUE
            if ($data['record_1'] == TRUE && $data['record_2'] == TRUE && $data['record_3'] == TRUE && $data['record_4'] == TRUE && $data['record_5'] == TRUE) {
                $data['records_pass'] = TRUE;
            }
        }

        $this->LoadView_m('products/workspace_dns_check', $data);
    }
    
    // Method for creating email
    public function create_email() {
        
        $domain = decryptIt($this->input->post('domain'));
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $subscription_id = $this->input->post('sub');
        
        // loading cpanel library
        $this->load->library('Cpanel_lib');
        
        // Getting logged in user id
        $user_id = $this->session->userdata($this->site_session->userid());
        
        // getting subscription details
        $subscription = $this->product->getSubscriptionDetails(decryptIt($subscription_id), $user_id);
        
        // getting all email
        $emails = json_decode($this->cpanel_lib->listEmail($domain))->data;
        
        // balance licenses
        $balance = $subscription->Num_of_licenses - count($emails) ;

        // checking license limit
        if($balance < 1){
            $this->session->set_flashdata('requestMsgErr', 'email_limit_reached');
        }else{
        
            $email = $email.'@'.$domain;
            $quota = 10240;
            $email_created = json_decode( $this->cpanel_lib->createEmail($email,$password,$quota));

            // check email creat
            if($email_created->status){
                $this->session->set_flashdata('requestMsgSucc', 'email_created');
            }else{
                $this->session->set_flashdata('requestMsgErr', 'email_not_created');
            }
        }
        redirect("products/details/".$subscription_id);
    }
    
    // Method for setting email's password
    public function update_email_password() {
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $subscription_id = $this->input->post('sub');
        $domain = decryptIt($this->input->post('domain'));
        
        // loading cpanel library
        $this->load->library('Cpanel_lib');
        
        // updating password
        $email_updated = json_decode($this->cpanel_lib->setPasswordEmail($email,$password,$domain));
        
        // check email creat
        if($email_updated->status){
            $this->session->set_flashdata('requestMsgSucc', 'email_updated');
        }else{
            $this->session->set_flashdata('requestMsgErr', 'email_not_updated');
        }
        
        redirect("products/details/".$subscription_id);
    }
    
    // Method for deleting email
    public function delete_email($subscription_id, $email) {

        $email = decryptIt($email);

        // Getting logged in user id
        $user_id = $this->session->userdata($this->site_session->userid());

        // Getting subsription details of loggedin user
        $subscription = $this->product->getSubscriptionDetails(decryptIt($subscription_id), $user_id);

        // Checking subscription availablility against provided id
        if (!count($subscription)) {
            $this->session->set_flashdata('requestMsgErr', 'email_subscription_not_found');
            redirect('products');
        }
        
        // loading cpanel library
        $this->load->library('Cpanel_lib');

        // deleting email
        $email_deleted = json_decode($this->cpanel_lib->deleteEmail($email . '@' . $subscription->domain));

        // check email creat
        if ($email_deleted->status) {
            $this->session->set_flashdata('requestMsgSucc', 'email_deleted');
        } else {
            $this->session->set_flashdata('requestMsgErr', 'email_not_deleted');
        }

        redirect("products/details/" . $subscription_id);
    }

    // Method for sending order detail's email
    private function _sendProductOrderEmail($order_id = 0) {
        // Get order's details
        $order = $this->product->getorderById($order_id);

        // Preparing data to pass to view
        $data['Order_ID'] = $order->Order_ID;
        $data['Timestamp'] = $order->Timestamp;
        $data['domain'] = $order->domain;
        $data['period'] = $order->period;
        $data['type'] = getSystemString($order->Order_Type);
        $data['msg'] = getSystemString('product_payed');
        $data['price_without_vat'] = $order->subamount;
        $data['total_price'] = $order->Total_Price;
        $data['vat'] = $order->VAT;
        $data['total_vat'] = round(($order->Total_Price) - ($order->Total_Price / (1 + ($order->VAT / 100))), 2);
        // Getting website info for email template
        $website_data = $this->home_model->Get_Website_Data();
        $data['Website_MobileNo'] = $website_data['web_settings'][0]->Website_MobileNo;
        $data['Website_Email'] = $website_data['web_settings'][0]->Website_Email;
        $data['Prefix_ar'] = $website_data['about_us']->Prefix_ar;
        $data['Twitter'] = $website_data['web_contact_info'][0]->Twitter;
        $data['LinkedIn'] = $website_data['web_contact_info'][0]->LinkedIn;
        $data['Instagram'] = $website_data['web_contact_info'][0]->Instagram;
        $this->load->library('parser');
        $temp_msg = '' . $this->parser->parse('site/includes/email/product_invoice', $data, true);

        //send email
        $options = array(
            'to' => $order->Email,
            'subject' => getSystemString('invoice') . ' #INV' . $order->Order_ID . ' dnet.sa',
            'message' => $temp_msg,
        );

        $this->load->helper('utilities_helper');
        return SendEmail($options);
    }

    // this is for testing purpose for the time being
    public function add_user() {

//        $req = $this->product->getSubscriptionDetails($rId);
//        if (count($req)) {

        $this->load->library('ResellerGSuite', 'resellergsuite');


        /* Process 1
          |
          |--------------------------------------------------------------------------
          | Set Reseller Admin User/Email From Config/Config.php Global Variable.
          |--------------------------------------------------------------------------
          | admin@yourresellerdomain.com
          |
         */
        $RESELLER_ADMIN_EMAIL = $this->config->item('reseller_admin_email');

        /*
          |
          |--------------------------------------------------------------------------
          | Pass Customer Domain and Site To Check If Is It Available.
          |--------------------------------------------------------------------------
          | example.com
          | https://www.example.com/ -- www.example.com
          |
         */
        $RESELLER_CUSTOMER_DOMAIN = 'testdomain.sa';
        $RESELLER_CUSTOMER_SITE = 'www.' . 'testdomain.sa';

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // Step 1 : Call createSiteToken to create Site Token To Verify
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $this->resellergsuite->createSiteToken($RESELLER_ADMIN_EMAIL, $RESELLER_CUSTOMER_DOMAIN, $RESELLER_CUSTOMER_SITE);


        $is_exist = $this->resellergsuite->testCust();
        exit;
        if ($is_exist) {
            redirect("products/result?r=workspace_error_1001");
        }
//        }
    }

}
