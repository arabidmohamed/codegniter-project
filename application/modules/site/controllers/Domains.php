


<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Require main contoller
require_once APPPATH . 'modules/site/controllers/HomeBase_Controller.php';

class Domains extends HomeBase_Controller
{

    // define controller
    protected $thisCtrl = "domains";

    public function __construct()
    {

        /**************************************
         * By Eng.Mohammed Arabid *
         ***************************************/

        parent::__construct();

        $this->load->vars(array('__controller' => $this->thisCtrl));
        $this->load->model('home_model');
        $this->load->model('customer/domain_model', 'domain');
        $this->load->helper('utilities_helper');
        $this->load->helper('configuration_helper');

        $this->load->library('Cpanel_lib');

        date_default_timezone_set('UTC');

        /*
         * It checks the status for the menu item.
         */
        $this->__lang = $this->session->userdata($this->site_session->__lang_h());
        $link = uri_string();
        $controller = $this->uri->segment(1);

        $menu = $this->home_model->Is_Menu_Disabled($controller);

        if (!empty($menu)) {
            show_404();
        }

    }

    /*
   *  * Home
     */
    public function index()
    {


        $data['tlds'] = $this->home_model->get_all_tlds();
        $data['services'] = $this->home_model->Get_services();

        $data['pages_1'] = $this->home_model->get_pages(4,0);
        $data['pages_2'] = $this->home_model->get_pages(4,4);
        $data['pages_3'] = $this->home_model->get_pages(4,8);


        $data['faqs'] = $this->home_model->getFirstFaqs(5,0);


        $data['pageTitle'] = getSystemString('saudi_domain_registration');
        $data['slides'] = $this->home_model->Get_back_slider();
        $data['about'] = $this->home_model->get_pages();
        $data['settings'] = $this->home_model->Get_Website_Configuration();
        $data['clients'] = $this->home_model->ClientsList();
        $data['achievement'] = $this->home_model->getAchievements();
        $data['solutions'] = $this->home_model->getSolutions();
        //echo '<pre>';print_r($data['solutions']);die();
        $metaData['pageTitle'] = getSystemString('saudi_domain_registration');
        $this->LoadView_m('domains', $data, $metaData);
    }

    public function uncaught_syntax(){

        $data['settings'] = $this->home_model->Get_Website_Configuration();

        $this->LoadView_m('site/404', $data);
    }

    public function domain_check()
    {

        $domain_name = $this->input->post('domain_name');
        $tld_id = $this->input->post('dotDomain');

        if($_POST)
            {
                $this->session->set_userdata($this->site_session->domain_name(), $this->input->post('domain_name'));
                $this->session->set_userdata($this->site_session->tld_id(), $this->input->post('dotDomain'));
            } 


        $domain_name = $this->session->userdata($this->site_session->domain_name());
        $tld_id = $this->session->userdata($this->site_session->tld_id());
        $search_text = $domain_name;



        $data['selected_domain'] = '';
        if (!empty($domain_name)) {

            $this->load->library('nic/epp_lib');

            $data['domain_name'] = $domain_name;
            $data['dotDomain'] = $tld_id;


            //dd($data);
            $this->load->library('form_validation');
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('domain_name', 'domain name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('dotDomain', 'dotDomain', 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('requestMsgErr', validation_errors());

                redirect(base_url('uncaught_syntax'));
            }

            $tld_info = $this->domain->getDomainTldsByID($tld_id);
            $search_text = $domain_name;
            $domain_name = $domain_name . $tld_info->TLD_Name; 
            $result = $this->domain->getAllSuggestedTld($domain_name);

            $suggested_tlds = $this->epp_lib->domain_check($result['suggested_tld']);

            $suggested_tlds = $suggested_tlds[0]['epp']['response']['resData']['domain:chkData']['domain:cd'];

            /*to get post data from search*/
            $_SESSION['is_redirect'] = 0;

            $suggested = [];
            foreach ($suggested_tlds as $key => $tld) {
                $suggested['avail'][] = $tld['domain:name']['@attributes']['avail'];
                $suggested['value'][] = $tld['domain:name']['_value'];
                $suggested['reason'][] = $tld['domain:reason'];

            }

            $data['suggested_tlds'] = $suggested; // all available tlds
            $data['domain_name'] = $domain_name; // desire domain
            $data['search_text'] = $search_text; // search_text domain            
            $data['domain_prices'] = $result['prices_tld']; // registration prices
            $data['tld_ids'] = $result['tld_ids']; // registration prices
            $data['search_domain'] = $result['search_domain']; // registration prices

            $data['tlds'] = $this->home_model->get_all_tlds();
            $data['selected_tld'] = $tld_info->TLD_Name;
            $data['selected_tld_id'] = $tld_id;
            $data['selected_domain'] = $search_text;
            $data['settings'] = $this->home_model->Get_Website_Configuration();

            //  echo $data['domain_name']; exit();

            $_POST['domain_name'] = null;

            $data['pageTitle'] = getSystemString('search_domains');

            $this->LoadView_m('epp/search', $data, $metaData);
        }

        //print_r($suggested_tlds[0]['domain:name']); exit();

    }


    /* resend verification code on transfer request */
    public function sendVerificationCodeTransferRequest(){

        $data['id'] = decryptIt($this->input->post('id'));
        $data['c_id'] = $this->input->post('c_id');
        $data['page_token'] = $this->input->post('page_token');

        $request = $this->domain->getTransferRequest($data);
        $data['auth_code'] = $request->DTI_Auth_Code;
        $this->_check_transfer_validation($request);


        $request_date = date('Y-m-d',strtotime($request->Last_SMS_Sent_Date));
        $today = date('Y-m-d');

        if($today > $request_date){
               $upd = array(
                                    'Total_SMS_Sent' => 0,
                                    'Last_SMS_Sent_Date' => date('Y-m-d H:i:s'),
                                );
                 $this->domain->updateTransferRequestInfo($data['id'], $upd);
                 //$request = $this->domain->getTransferRequest($data);
        }

        $domain = $request->DTI_Domain_Name . $request->DTI_TLD;
        // checking if authcode is correct
        $this->load->library('nic/epp_lib');
        $domain_info = $this->epp_lib->domain_info($domain, 0, $data['auth_code']);
        $code = $domain_info[0]['epp']['response']['result']['@attributes']['code'];

        if ($code != '1000') {
            echo 'Domain or Authocode is incorrect';
            die();
        }

        // getting current admin email

        $current_admin_id = 0;
        $contacts = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:contact'];
        foreach ( $contacts as $key => $contact){
                        if($contact['@attributes']['type'] == 'admin'){
                         $current_admin_id =  $contact['_value'];
                        }
        }

        $admin_detiles = $this->epp_lib->contact_info($current_admin_id, 0, $data['auth_code']);
        $admin_phone = $admin_detiles[0]['epp']['response']['extension']['snic:contactInfo']['snic:mobile'];


        $admin_phone = explode('.', $admin_phone);
        $admin_phone = $admin_phone[1];


        if ((!empty($request) && $request->DCR_Phone_Verified == 0)) {

            $request_date = date('Y-m-d',strtotime($request->Last_SMS_Sent_Date));
            $today = date('Y-m-d');

      
            if($today == $request_date && $request->Total_SMS_Sent <= 4) {

            

                                $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
                                $verify_token = md5($rand);
                                //Send verification code to user phone
                                $message = 'Pin Code is:' . $rand;
                                $upd = array(
                                    'DCR_Verify_Token' => $verify_token,
                                    'DCR_IS_SMS_Sent' => 1,
                                    'DCR_Phone_Verified' => 0,
                                    'Total_SMS_Sent' => $request->Total_SMS_Sent + 1,
                                    'Last_SMS_Sent_Date' => date('Y-m-d H:i:s'),
                                );
                       

                                    if (sendSMSTo($admin_phone, $message)) {
                                       // if(true){
                                             $this->domain->updateTransferRequestInfo($data['id'], $upd);                                        
                                            echo json_encode(array(
                                                    'info' => 1,
                                                    'msg' => getSystemString('code_sms_sent'),
                                                    'attempts' => $request->Total_SMS_Sent + 1
                                                ));

                                    } else {

                                         echo json_encode(array(
                                                    'info' => 0,
                                                    'msg' => getSystemString('error_sms'),
                                                    'attempts' => $request->Total_SMS_Sent + 1
                                                ));
                                    }


            }else{
                    echo json_encode(array(
                                                    'info' => 0,
                                                    'msg' => getSystemString('Minimum_usage'),
                                                    'attempts' => $request->Total_SMS_Sent
                                                ));
            }
        }

    }




     /* resend verification code on contact on domain registration */
        public function sendVerificationCodeContact()
    {



        $domain_id = $this->input->post('domain_id');
        $domain_id = decryptIt($domain_id);
        $token = $this->input->post('token');

        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
        $admin_id = (empty($admin_officer->Epp_ID))?$admin_officer->Org_Usr_ID:$admin_officer->Epp_ID;


        if (!$admin_officer) {
            $this->session->set_flashdata('requestMsg', 46);
            redirect(base_url('uncaught_syntax'));
        }

        $request_date = date('Y-m-d',strtotime($admin_officer->Last_SMS_Sent));
        $today = date('Y-m-d');

        if($today > $request_date){
               $upd = array(
                                    'Total_SMS_Sent' => 0,
                                    'Last_SMS_Sent' => date('Y-m-d H:i:s'),
                                );
                  $this->domain->updateDomainUserInfo($admin_officer->Org_Usr_ID, $upd);
        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');

        }



if ((!empty($admin_officer) && $admin_officer->Phone_verified == 0)) {

            $request_date = date('Y-m-d',strtotime($admin_officer->Last_SMS_Sent));
            $today = date('Y-m-d');

      
            if($today == $request_date && $admin_officer->Total_SMS_Sent <= 4) {

            

                                $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
                                $verify_token = md5($rand);
                                //Send verification code to user phone
                                $message = 'Pin Code is:' . $rand;
                                $upd = array(
                                    'Verify_Token' => $verify_token,
                                    'Is_SMS_Sent' => 1,
                                    'Phone_verified' => 0,
                                    'Total_SMS_Sent' => $admin_officer->Total_SMS_Sent + 1,
                                    'Last_SMS_Sent' => date('Y-m-d H:i:s'),
                                );
                       

                                    if (sendSMSTo($admin_officer->User_Mobile, $message)) {
                                        //if(true){
      
                                       $this->domain->updateDomainUserInfo($admin_officer->Org_Usr_ID, $upd);

                                            echo json_encode(array(
                                                    'info' => 1,
                                                    'msg' => getSystemString('code_sms_sent'),
                                                    'attempts' => $admin_officer->Total_SMS_Sent + 1
                                                ));

                                    } else {

                                         echo json_encode(array(
                                                    'info' => 0,
                                                    'msg' => getSystemString('error_sms'),
                                                    'attempts' => $admin_officer->Total_SMS_Sent + 1
                                                ));
                                    }


            }else{
                    echo json_encode(array(
                                                    'info' => 0,
                                                    'msg' => getSystemString('Minimum_usage'),
                                                    'attempts' => $admin_officer->Total_SMS_Sent
                                                ));
            }

        

    

        }


    }


     /* resend verification code on request */
        public function sendVerificationCodeRequest()
    {



        $domain_id = $this->input->post('domain_id');
        $domain_id = decryptIt($domain_id);
        $token = $this->input->post('token');

        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
        $admin_id = (empty($admin_officer->Epp_ID))?$admin_officer->Org_Usr_ID:$admin_officer->Epp_ID;
        $request = $this->domain->getRequestInfo($domain_id, $admin_id, $token);
        $this->_check_request_validation($request);

        $request_date = date('Y-m-d',strtotime($request->Last_SMS_Sent_Date));
        $today = date('Y-m-d');

        if($today > $request_date){
               $upd = array(
                                    'Total_SMS_Sent' => 0,
                                    'Last_SMS_Sent_Date' => date('Y-m-d H:i:s'),
                                );
                 $this->domain->updateRequestInfo($admin_id, $token, $upd);
        $request = $this->domain->getRequestInfo($domain_id, $admin_id, $token);

        }



if ((!empty($request) && $request->DCR_Phone_Verified == 0)) {

            $request_date = date('Y-m-d',strtotime($request->Last_SMS_Sent_Date));
            $today = date('Y-m-d');

      
            if($today == $request_date && $request->Total_SMS_Sent <= 4) {

            

                                $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
                                $verify_token = md5($rand);
                                //Send verification code to user phone
                                $message = 'Pin Code is:' . $rand;
                                $upd = array(
                                    'DCR_Verify_Token' => $verify_token,
                                    'DCR_IS_SMS_Sent' => 1,
                                    'DCR_Phone_Verified' => 0,
                                    'Total_SMS_Sent' => $request->Total_SMS_Sent + 1,
                                    'Last_SMS_Sent_Date' => date('Y-m-d H:i:s'),
                                );
                       

                                    if (sendSMSTo($admin_officer->User_Mobile, $message)) {
                                        //if(true){
                                        $this->domain->updateRequestInfo($admin_id, $token, $upd);
                                            echo json_encode(array(
                                                    'info' => 1,
                                                    'msg' => getSystemString('code_sms_sent'),
                                                    'attempts' => $request->Total_SMS_Sent + 1
                                                ));

                                    } else {

                                         echo json_encode(array(
                                                    'info' => 0,
                                                    'msg' => getSystemString('error_sms'),
                                                    'attempts' => $request->Total_SMS_Sent + 1
                                                ));
                                    }


            }else{
                    echo json_encode(array(
                                                    'info' => 0,
                                                    'msg' => getSystemString('Minimum_usage'),
                                                    'attempts' => $request->Total_SMS_Sent
                                                ));
            }

        

    

        }


    }


    private function _payment_for_restore_domain($request,$domain){


     
                    $domain_id = $request->DCR_Domain_ID; 
                    $expire_date = $domain->Expire_Date;
                    $data['domain'] = $domain;
                    $data['period'] = 1;


                    $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
                    $admin_id      = $admin_officer->Org_Usr_ID;
                    $cart_type = 'MADA';


                    $this->load->library('payments/Hyperpay_lib');
                    $data['success'] = getSystemString(254);

                    /* renew fees */
                    $domain_his = $this->domain->getDomainHistory($domain->DH_ID);
                    $domain_ltd = json_decode($domain_his->LTD_History);
                    $tld_info = $this->domain->getDomainTldsByID($domain_ltd->TLD_ID);
                    $renew_price = $tld_info->Renew_Price;
                    $data['renew_price'] = $renew_price;

                    /* vat calculation */
                    $website_config = $this->home_model->Get_WebsiteSettings();
                    $vat = $website_config[0]->Vat;
                    $total_vat = ($vat * $renew_price) / 100;
                    $total_vat = number_format((float) $total_vat, 2, '.', '');
                    $data['vat'] = $vat;
                    $data['total_vat'] = $total_vat;

                    /* total to pay */
                    $total_price = $renew_price + $total_vat;
                    $total_price = number_format((float) $total_price, 2, '.', '');
                    $data['total_price'] = $total_price;
                   
                    $order_id = $this->_makeUnConfirmedRestoreOrder($domain_id, $admin_id, $total_price, $vat, $expire_date,$cart_type);
                    $or_id = 'RS'.$order_id;
                    $customer->Email    = $admin_officer->User_Email;
                    $customer->Fullname = $admin_officer->Full_Name;


                    $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price, $or_id, $customer, $cart_type));

                    $code = $response->result->code;
                    if ($code == '000.200.100') {

                        $data['customer'] = $customer;
                        $data['checkout_id'] = $response->id;

                        // * Payment Log
                        $log = array(
                            'Customer_ID' => $admin_id,
                            'Type' => 'Select Hyperpay payment method',
                            'Response' => json_encode($response),
                        );
                        $this->domain->addAPISLog($log);

                        //update subscription customer payment data
                        $domain_order_up = array(
                            'OR_ID' => $or_id,
                            'Payment_Referance' => $response->id,
                        );
                        $where = array('DO_ID' => $order_id);
                        $this->domain->save($domain_order_up, $where, ORDERS);
                        $this->session->set_userdata('Payment_Referance', $response->id);

                    }

                    $this->LoadView_m('customer/dashboard/domain_restore_payment', $data);


    }

    public function payment_methods_restore(){

                    $cart_type = $this->input->post('cart_type');
                    $domain_id = $this->input->post('domain_id'); 
                    $domain_id = decryptIt($domain_id);
                    $domain = $this->domain->getDomainByID_All($domain_id);


                    $expire_date = $domain->Expire_Date;
                    $data['domain'] = $domain;

                    $admin_officer = $domain->Admin;
                    $admin_id      = $admin_officer->Org_Usr_ID;
  


                    $this->load->library('payments/Hyperpay_lib');
                    $data['success'] = getSystemString(254);

                    /* renew fees */
                    $domain_his = $this->domain->getDomainHistory($domain->DH_ID);
                    $domain_ltd = json_decode($domain_his->LTD_History);
                    $tld_info = $this->domain->getDomainTldsByID($domain_ltd->TLD_ID);
                    $renew_price = $tld_info->Renew_Price;
                    $data['renew_price'] = $renew_price;

                    /* vat calculation */
                    $website_config = $this->home_model->Get_WebsiteSettings();
                    $vat = $website_config[0]->Vat;
                    $total_vat = ($vat * $renew_price) / 100;
                    $total_vat = number_format((float) $total_vat, 2, '.', '');
                    $data['vat'] = $vat;
                    $data['total_vat'] = $total_vat;

                    /* total to pay */
                    $total_price = $renew_price + $total_vat;
                    $total_price = number_format((float) $total_price, 2, '.', '');
                    $data['total_price'] = $total_price;
                   
                    $order_id = $this->_makeUnConfirmedRestoreOrder($domain_id, $admin_id, $total_price, $vat, $expire_date,$cart_type);
                    $or_id = 'RS'.$order_id;
                    $customer->Email    = $admin_officer->User_Email;
                    $customer->Fullname = $admin_officer->Full_Name;


                            $can_add_transaction = false;
                            $code = 0;
                            if($cart_type == 'WALLET'){
                                    $customer_id =  $domain->Customer_ID;
                                    $this->load->library('E_Wallet');  
                                    $data['current_balance'] = $this->e_wallet->getCustomerWalletBalance($customer_id);

                                    $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($customer_id,$total_price);
                                    $data['can_add_transaction'] = $can_add_transaction;      
                                    
                                    $payment_referance =  randomNumber(20).'-e-wallet'; ;              
                            }else{
                                $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price, $or_id, $customer, $cart_type));
                                $code = $response->result->code;
                                $payment_referance = $response->id; 
                            }


                    if ($code == '000.200.100' || $cart_type=='WALLET') {

                        $data['customer'] = $customer;
                        $data['checkout_id'] = $payment_referance;
                        $data['cart_type'] = $cart_type;


                        // * Payment Log
                        $log = array(
                            'Customer_ID' => $admin_id,
                            'Type' => 'Select Hyperpay payment method',
                            'Response' => json_encode($response),
                        );
                        $this->domain->addAPISLog($log);

                        //update subscription customer payment data
                        $domain_order_up = array(
                            'OR_ID' => $or_id,
                            'Payment_Referance' => $payment_referance,
                        );
                        $where = array('DO_ID' => $order_id);
                        $this->domain->save($domain_order_up, $where, ORDERS);
                        $this->session->set_userdata('Payment_Referance', $payment_referance);

                        $hayperPay_panel= $this->load->view('customer/snippets/hyperpay_panel_restore', $data, TRUE);
                        $this->output
                                ->set_content_type("application/json")
                                ->set_output(json_encode(array('status' => true,'hayperPay_panel'=>$hayperPay_panel)));

        }else{
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false)));
        }
    }

    public function restore_payment_success(){

        $this->load->library('payments/Hyperpay_lib');

        $payment_referance = $this->input->GET('id');

        $domain_order_info = $this->domain->getDomainOrderByReferancePayment($payment_referance);
        if (!$domain_order_info) {
            show_404();
            exit();
        }


         $transaction_result = false;        
        if (!$domain_order_info->Payment_Verified) {
            $cart_type = $domain_order_info->Cart_Type;            
            
            $total_price = $domain_order_info->Total_Price;
            if($cart_type == 'WALLET'){

                /* add wallet transactions*/
                $customer_id =  $domain_order_info->Customer_ID;
                $this->load->library('E_Wallet');
                $transaction_result =  $this->e_wallet->modifyCreditsForCustomers($customer_id,'-',$total_price,'Domain Restore',$customer_id,$payment_referance);
                $response_id = $payment_referance;
                $order_id = $domain_order_info->OR_ID;


            }else{
                $response = json_decode($this->hyperpay_lib->VerifyPayment($payment_referance,$cart_type));
                $code = $response->result->code;
                $order_id = $response->merchantTransactionId;
                $response_id = $response->id;
                //verify payment response
                $log = array(
                    'Customer_ID' => $domain_order_info->Customer_ID,
                    'Type' => 'Verify Payment Response',
                    'Response' => json_encode($response),
                );
                $this->domain->addAPISLog($log); 
            }

            $domain_id = $domain_order_info->Domain_ID;
            $request = $this->domain->get_last_restore_request($domain_id);

            if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code) || $transaction_result) {

                $this->load->library('nic/epp_lib');                                
                $domain_ns = $domain_order_info->Domain_Name . $domain_order_info->TLD;
    
                $responseJSON = $this->epp_lib->domain_restore($domain_ns, $domain_id);

                


                $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
                $msg = $responseJSON[0]['epp']['response']['result']['msg'];

                if ($code !== '1000') {
                    $err['restore']['msg'] = getSystemString('accountDisabled');
                } else {

                    $domain_info = $this->epp_lib->domain_info($domain_ns,$domain_id);
                    $expire_date = date('Y-m-d H-i-s',strtotime($domain_info[0]['epp']['response']['resData']['domain:infData']['domain:exDate']));

                    $where = ['Domain_ID' => $domain_id];
                    $upd_info = ['Domain_Status' => 'Done' , 'Expire_Date' => $expire_date];
                    $this->domain->save($upd_info, $where, DOMAIN);

                    /* make the request approved */
                    $restore_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
                    $this->domain->save($restore_request, ['DCR_ID' => $request->DCR_ID], REQUEST);

                    $scc['restore']['msg'] = getSystemString('restore_domain_success');
                }

                /* make order verified */
                $data = array(
                    'HY_ID'=> $response->id,
                    'Payment_Verified' => 1,
                    'Payed_AT' => date('Y-m-d H:i:s'),
                    'Request_ID' => $request->DCR_ID,
                );
                $where = array('OR_ID' => $order_id);
                $this->domain->save($data, $where, ORDERS);

                $this->session->unset_userdata('Payment_Reference');
                /* insert order logs */
                $app_log = [
                    'DAL_Domain_ID' => $domain_order_info->Domain_ID,
                    'DAL_User_ID' => $domain_order_info->Customer_ID,
                    'DAL_Created' => date("Y-m-d H:i:s"),
                    'DAL_Type'=>'Customer',
                ];
                $app_log['DAL_Status'] = 'restore_domain_payed';
                $this->domain->insert(APP_LOG, $app_log);
     

                /* send renew order email */
                $subject = 'Domain Restore Order';
                $this->_sendOrderEmail($order_id);


            } else {

                $data = array(
                    'Payment_Verified' => 0,
                    'Payed_AT' => date('Y-m-d H:i:s'),
                     'Request_ID' => $request->DCR_ID,
                );

                $where = array('OR_ID' => $order_id);
                $this->domain->save($data, $where, ORDERS);
                $this->session->unset_userdata('Payment_Reference');

                $err['restore']['msg'] = getSystemString('payment_error');


            }
        }


        $data['error'] = $err;
        $data['success'] = $scc;
        $data['domain'] = $domain_order_info;


        $this->LoadView_m('customer/domain_registration/approve_change_request_2', $data);


    }


        private function _makeUnConfirmedRestoreOrder($domain_id, $customer_id, $totalPrice, $vat, $expire_date,$cart_type='MADA')
    {
        $data = array(
            'Domain_ID' => $domain_id,
            'Customer_ID' => $customer_id,
            'Total_Price' => $totalPrice,
            'Order_Type' => 'restore',
            'Expire_Date' => date('Y-m-d H-i-s', strtotime('+1 year', strtotime($expire_date))),
            'Vat' => $vat,
            'Cart_Type' => $cart_type,
            'Created_AT' => date('Y-m-d H:i:s'),
        );
        $order_id = $this->domain->insert(ORDERS, $data);

        return $order_id;
    }


    public function change_approved()
    {

        $data['token'] = $this->input->get('to');
        $domain_id = decryptIt($this->input->get('do'));
        $data['domain_id'] = $domain_id;
        $data['do'] = $this->input->get('do');
        $this->load->library('nic/epp_lib');

        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('token', 'token', 'trim|required|xss_clean');
        $this->form_validation->set_rules('domain_id', 'domain_id', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgErr', validation_errors());
            redirect(base_url('uncaught_syntax'));
        }

        //verify domain info
        $request = $this->domain->verify_request($data);
        $this->_check_request_validation($request);


        $domain = $this->domain->getDomainByID_All($domain_id,1);
        $requests = $this->domain->getAllPendingRequest($domain_id,$data['token']);
        $data['domain'] = $domain;

        if (empty($requests)) {
            redirect('');
        }

        $scc = [];
        $err = [];






        /* --------------------approve host change request-------------
        ----------------------- Mohamed Arabid ------------------
        --------------------------05/01/2021--------------------- */

        $host = $requests->host;
        $primary_server = $domain->Primary_Server;
        $secondary_server = $domain->Secondery_Server;
        if (!empty($host)) {

            $post = json_decode($host->DCR_POST_DATA);
            $primary_server = $post->primary_server;
            $secondary_server = $post->secondary_server;

            $server_ips = $post->server_ips;
            $secondary_servers = $post->secondary_servers;

            $primary_ip = '';
            $secondary_ip = '';
            if(!empty($server_ips)){
              $primary_ip = $server_ips[0];
              $secondary_ip = $server_ips[1];
             }

            $domain_ns = $domain->Domain_Name . $domain->TLD;
            $domain_info = $this->epp_lib->domain_info($domain_ns, $domain_id);
            $old_name_servers = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:ns']['domain:hostObj'];
            $code = $domain_info[0]['epp']['response']['result']['@attributes']['code'];
            $msg = $domain_info[0]['epp']['response']['result']['msg'];
            if ($code !== '1000') {
                $err['host']['domain_info']['msg'] = $msg;
            }

            // create host
            $this->epp_lib->host_create($primary_server,$domain_id,$primary_ip);
            $this->epp_lib->host_create($secondary_server,$domain_id,$secondary_ip);

            if (!empty($old_name_servers)) { /* when the domain deleted it return empty old servers */
                $new_name_servers = array(
                    '0' => $primary_server,
                    '1' => $secondary_server,
                );
            foreach ($secondary_servers as $key => $server) {
                $this->epp_lib->host_create($server->name_server,$domain_id,$server->ip);
                $new_name_servers[] = $server->name_server;
            }

              

                $responseJSON = $this->epp_lib->domain_nameserver_change($domain_ns, $new_name_servers, $old_name_servers, $domain_id);
                $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
                $msg = $responseJSON[0]['epp']['response']['result']['msg'];
                if ($code !== '1000') {
                    $err['host']['nameserver_change']['msg'] = $msg;
                } else {

                    /* make the request approved */
                    $host_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
                    $this->domain->save($host_request, ['DCR_ID' => $host->DCR_ID], REQUEST);
                    $scc['host']['nameserver_change']['msg'] = 'تم تعديل بيانات الخادم بنجاح';

                    /* add on history  */
                    $old_data = ['key' => 'Chg_Name_Server_history',
                        'value' => json_encode($post)];
                    $dh_id = $this->domain->duplicateHisRecord(DOMAIN_HIS, 'DH_ID', $domain->DH_ID, $old_data);

                    $domain__data = ['Primary_Server' => $primary_server, 'Secondery_Server' => $secondary_server, 'DH_ID' => $dh_id,'Secondary_Servers' => json_encode($secondary_servers),'Server_ips' => json_encode($server_ips)];
                    $this->domain->save($domain__data, ['Domain_ID' => $domain_id], DOMAIN);

                }
            }
        }
        /*  end host request    */

        /* -------------------- auth code  ----------------------
        --------------------------16/01/2021--------------------- */
        $auth_code = $requests->auth_code;
        if (!empty($auth_code)) {

            /* make the request approved */
            $auth_code_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
            $this->domain->save($auth_code_request, ['DCR_ID' => $auth_code->DCR_ID], REQUEST);
            $scc['auth_code']['msg'] = 'تمت الموافقة على  طلب رمز المصادقة';

        }

        /*  end auth code    */


        /* -------------------- transfer out  ----------------------
        --------------------------22/01/2021--------------------- */
        $transfer_out = $requests->transfer_out;
        if (!empty($transfer_out)) {

            $domain_ns = $domain->Domain_Name . $domain->TLD;
            $responseJSON = $this->epp_lib->domain_transfer_status($domain_ns, 'approve');

            $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
            $msg = $responseJSON[0]['epp']['response']['result']['msg'];

            if ($code !== '1000') {

                $err['lock']['msg'] = getSystemString('accountDisabled');

            } else {

                /* make the request approved */
                $transfer_out_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
                $this->domain->save($transfer_out_request, ['DCR_ID' => $transfer_out->DCR_ID], REQUEST);
                $scc['transfer_out_request']['msg'] = 'تمت الموافقة على طلب نقل نطاق';

            }

        }

        /*  end transfer out    */

        /* --------------------delete domain-----------------------
        --------------------------16/01/2021--------------------- */
        $delete_domain = $requests->delete_domain;
        if (!empty($delete_domain)) {

            $domain_ns = $domain->Domain_Name . $domain->TLD;
            $responseJSON = $this->epp_lib->domain_delete($domain_ns, $domain_id);

            $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
            $msg = $responseJSON[0]['epp']['response']['result']['msg'];

            if ($code !== '1000') {
                $err['delete']['msg'] = getSystemString('accountDisabled');
            } else {

            $epp_domain_info = $this->epp_lib->domain_info($domain_ns);
            $status = $epp_domain_info[0]['epp']['response']['resData']['domain:infData']['domain:status'][0]['@attributes']['s'];
            if($status == 'pendingDelete'){

                $where = ['Domain_ID' => $domain_id];
                $upd_info = ['Domain_Status' => "PENDING DELETE", 'Deleted_at' => date('Y-m-d H:i:s')];
                $this->domain->save($upd_info, $where, DOMAIN);
                
            }else{

                $where = ['Domain_ID' => $domain_id];
                $upd_info = ['Domain_Status' => 'DELETED', 'Deleted_at' => date('Y-m-d H:i:s')];
                $this->domain->save($upd_info, $where, DOMAIN);
            }

               

                /* make the request approved */
                $delete_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
                $this->domain->save($delete_request, ['DCR_ID' => $delete_domain->DCR_ID], REQUEST);

                $scc['delete']['msg'] = getSystemString('delete_domain_success');
            }

        }
/*  end delete domain request    */



        /* --------------------restore domain-----------------------
        --------------------------23/01/2021--------------------- */
        $restore_domain = $requests->restore_domain;
        if (!empty($restore_domain)) {

            /* redirect to payment page */
            $this->_payment_for_restore_domain($restore_domain,$domain);
            
        }
        /*  end restore domain request    */





        /* --------------------lock domain-----------------------
        --------------------------16/01/2021--------------------- */
        $lock = $requests->lock;
        if (!empty($lock)) {

            $domain_ns = $domain->Domain_Name . $domain->TLD;

            $add_flags = array(
                '0' => 'clientTransferProhibited',
            );

            $remove_flags = array(

            );

            $responseJSON = $this->epp_lib->domain_flags_change($domain_ns, $add_flags, $remove_flags, $domain_id);

            $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
            $msg = $responseJSON[0]['epp']['response']['result']['msg'];

            if ($code !== '1000') {

                $err['lock']['msg'] = getSystemString('accountDisabled');

            } else {

                /* make the request approved */
                $lock_disable_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
                $this->domain->save($lock_disable_request, ['DCR_ID' => $lock->DCR_ID], REQUEST);

                $scc['lock']['msg'] = getSystemString('lock_msg');

                /* add on history  */
                $new_data = ['key' => 'lock_history',
                    'value' => $msg];
                $dh_id = $this->domain->duplicateHisRecord(DOMAIN_HIS, 'DH_ID', $domain->DH_ID, $new_data);

                $where = ['Domain_ID' => $domain_id];
                $upd_info = ['Domain_Lock_Status' => 1, 'DH_ID' => $dh_id];
                $this->domain->save($upd_info, $where, DOMAIN);

            }
        }

        /*  end lock domain request    */

        /* --------------------unlock domain-----------------------
        --------------------------16/01/2021--------------------- */
        $unlock = $requests->unlock;
        if (!empty($unlock)) {

            $domain_ns = $domain->Domain_Name . $domain->TLD;

            $add_flags = array(

            );

            $remove_flags = array(
                '0' => 'clientTransferProhibited',
            );

            $responseJSON = $this->epp_lib->domain_flags_change($domain_ns, $add_flags, $remove_flags, $domain_id);

            $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
            $msg = $responseJSON[0]['epp']['response']['result']['msg'];

            if ($code !== '1000') {
                $err['unlock']['msg'] = getSystemString('accountDisabled');
            } else {

                /* make the request approved */
                $unlock_disable_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
                $this->domain->save($unlock_disable_request, ['DCR_ID' => $unlock->DCR_ID], REQUEST);

                /* add on history  */
                $new_data = ['key' => 'unlock_history',
                    'value' => $msg];
                $dh_id = $this->domain->duplicateHisRecord(DOMAIN_HIS, 'DH_ID', $domain->DH_ID, $new_data);

                $where = ['Domain_ID' => $domain_id];
                $upd_info = ['Domain_Lock_Status' => 0, 'DH_ID' => $dh_id];
                $this->domain->save($upd_info, $where, DOMAIN);

                $scc['unlock']['msg'] = getSystemString('unlock_msg');
            }
        }
        /*  end unlock domain request    */

        /* --------------------dnssec disable---------------------
        --------------------------14/01/2021--------------------- */

        $dnssec_disable = $requests->dnssec_disable;
        if (!empty($dnssec_disable)) {
            // $dnssec_disable = json_decode($dnssec_disable->DCR_POST_DATA);

            $domain_ns = $domain->Domain_Name . $domain->TLD;
            // get dnssec key detiles from epp
            $domain_detiles = $this->epp_lib->domain_info($domain_ns, $domain_id);
            $epp_dnssec_key = $domain_detiles[0]['epp']['response']['extension']['secDNS:infData']['secDNS:dsData'];

            if (empty($epp_dnssec_key)) {

                $err['dnssec_disable']['empty']['msg'] = getSystemString('dnssec_disable_error_msg');

            }

            // disable dnssec in dns server
            $dnssec_disable_res = json_decode($this->cpanel_lib->disableDNSSEC($domain_ns));

            if ($dnssec_disable_res->status != 1) {

                $err['dnssec_disable']['dns_server_cpanel']['msg'] = getSystemString('dnssec_disable_error_msg');

            } else {

                //  dnssec key data
                $keyTag = $domain_detiles[0]['epp']['response']['extension']['secDNS:infData']['secDNS:dsData']['secDNS:keyTag'];
                $alg = $domain_detiles[0]['epp']['response']['extension']['secDNS:infData']['secDNS:dsData']['secDNS:alg'];
                $digestType = $domain_detiles[0]['epp']['response']['extension']['secDNS:infData']['secDNS:dsData']['secDNS:digestType'];
                $digest = $domain_detiles[0]['epp']['response']['extension']['secDNS:infData']['secDNS:dsData']['secDNS:digest'];

                $remove_record = array(
                    'keyTag' => $keyTag,
                    'alg' => $alg,
                    'digestType' => $digestType,
                    'digest' => $digest,
                );

                $add_record = array(
                );

                //  remove dnssec key data in epp
                $responseJSON = $this->epp_lib->domain_dnssec_change($domain_ns, $add_record, $remove_record, $domain_id);

                $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];

                if ($code == '1000') {

                    /* add on history  */
                    $new_data = ['key' => 'Dnssec_Disable_history',
                        'value' => json_encode($remove_record)];
                    $dh_id = $this->domain->duplicateHisRecord(DOMAIN_HIS, 'DH_ID', $domain->DH_ID, $new_data);

                    //  update dnssec status in database
                    $domain__data = ['DNSSEC_Status' => '0', 'DH_ID' => $dh_id];
                    $this->domain->save($domain__data, ['Domain_ID' => $domain_id], DOMAIN);

                    /* make the request approved */
                    $dnssec_disable_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
                    $this->domain->save($dnssec_disable_request, ['DCR_ID' => $dnssec_disable->DCR_ID], REQUEST);

                    $scc['dnssec_disable']['change']['msg'] = getSystemString('dnssec_disable_msg');

                } else {

                    $err['dnssec_disable']['change']['msg'] = getSystemString('dnssec_disable_error_msg');
                }
            } // end is changed

        }
        /*  end dnssec disable request    */

        /* --------------------dnssec enable---------------------
        --------------------------13/01/2021--------------------- */
        $dnssec_enable = $requests->dnssec_enable;
        if (!empty($dnssec_enable)) {
            $dnssec_enable_keys = json_decode($dnssec_enable->DCR_POST_DATA);
            $keys = current($dnssec_enable_keys->keys);

            // foreach($keys as $key){
            if (!empty($keys)) {

                $add_record = array(
                    'keyTag' => $keys->keyTag,
                    'alg' => $keys->alg,
                    'digestType' => $keys->digests[1]->algo_desc,
                    'digest' => $keys->digests[1]->digest,
                );
                $domain_ns = $domain->Domain_Name . $domain->TLD;

                $remove_record = array(
                );

                //  add dnssec key data in epp
                $responseJSON = $this->epp_lib->domain_dnssec_change($domain_ns, $add_record, $remove_record, $domain_id);

            }
            // }

            $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];

            if ($code == '1000') {

                /* add on history  */
                $new_data = ['key' => 'Dnssec_history',
                    'value' => json_encode($keys)];
                $dh_id = $this->domain->duplicateHisRecord(DOMAIN_HIS, 'DH_ID', $domain->DH_ID, $new_data);
                //  update dnssec status in database
                $domain__data = ['DNSSEC_Status' => '1', 'DH_ID' => $dh_id];
                $this->domain->save($domain__data, ['Domain_ID' => $domain_id], DOMAIN);

                /* make the request approved */
                $dnssec_enable_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
                $this->domain->save($dnssec_enable_request, ['DCR_ID' => $dnssec_enable->DCR_ID], REQUEST);

                $scc['dnssec_enable']['msg'] = getSystemString('dnssec_msg');

            } else {
                $err['dnssec_enable']['msg'] = getSystemString('dnssec_error_msg');
            }

        }

        /* end dnssec enable*/

        /* --------------------transfer inside dnet request-------------
        --------------------------12/01/2021--------------------- */

        $transfer_inside = $requests->transfer_inside;
        if (!empty($transfer_inside)) {
            $post = json_decode($transfer_inside->DCR_POST_DATA);
            $request_id = $transfer_inside->DCR_ID;

            if (!$this->_transfer_inside_dnet($post, $domain, $request_id)) {
                $err['contact']['admin']['msg'] = getSystemString(255);
            } else {
                $scc['contact']['admin']['msg'] = 'تم التنازل عن النطاق بنجاح';
            }

        }

        /* --------------------approve entity request-------------
        --------------------------05/01/2021--------------------- */
        $entity = $requests->entity;
        if (!empty($entity)) {

            $post = json_decode($entity->DCR_POST_DATA);

            //$entity_name = $post->registrant_entity_name;
            $first_address = $post->registrant_first_address_org;
            $second_address = $post->registrant_second_address_org;
            $country = $post->registrant_country_org;
            $region = $post->registrant_region_org;
            $city = $post->registrant_city_org;
            $post_code = $post->registrant_post_code_org;
            $job_title = $post->registrant_job_title;

            $entity_name = $domain->Registrar->Full_Name;
            /* 1- insert new contact
            3- nic  "contact_create"
            4- update nic authcode
            5- nic "domain_registrant_change"
            6- update registrar on info
             */
            $customer__data = $this->domain->get_one(['Customer_ID' => $domain->Customer_ID], '*', 'customers');
            $registrant_epp_id = randomNumber(10).'0-dnet';
            $registrar_data = [
                'Epp_ID' => $registrant_epp_id,                
                'Full_Name' => $domain->Registrar->Full_Name,
                'Employer_Name' => $entity_name,
                'User_Job_Title' => $job_title,
                'Phone_verified' => 1,
                'User_Country_ID' => $country,
                'User_Region' => $region,
                'User_City' => $city,
                'User_Post_Code' => $post_code,
                'User_Fax' => $customer__data->Phone,
                'User_Phone' => $customer__data->Phone,
                'User_Email' => $customer__data->Email,
                'User_Mobile' => $customer__data->Phone,
                'Mobile_Key' => $customer__data->Phone_Key,                
                'User_Address1' => $first_address,
                'User_Address2' => $second_address,
                'Country_Code'  => 'SA',
            ];
            /*1- */$registrar_id = $this->domain->insert(USERS, $registrar_data);
                   $registrar_id = $registrant_epp_id;


            /*3- */
            $registrar_data = json_decode(json_encode($registrar_data));
    if(!empty($registrar_data->User_Phone)){ $registrar_data->User_Phone = '+'.$registrar_data->Mobile_Key.'.'.$registrar_data->User_Phone; }
    if(!empty($registrar_data->User_Fax))  { $registrar_data->User_Fax = '+'.$registrar_data->Mobile_Key.'.'.$registrar_data->User_Fax;}
    if(!empty($registrar_data->User_Mobile)){$registrar_data->User_Mobile = '+'.$registrar_data->Mobile_Key.'.'.$registrar_data->User_Mobile;}
            $response = $this->epp_lib->contact_create($registrar_data, $domain_id);
            $authCode = $response['authCode'];



            /*4- */
            $upd_reg = ['Auth_Code' => $authCode];
            $where = ['Epp_ID' => $registrar_id];
            $this->domain->save($upd_reg, $where, USERS);

            /*5- */
            $domain_ns = $domain->Domain_Name . $domain->TLD;
            $response_registrant_change = $this->epp_lib->domain_registrant_change($domain_ns, $registrar_id, $domain->Domain_ID);
            $code = $response_registrant_change[0]['epp']['response']['result']['@attributes']['code'];
            $msg = $response_registrant_change[0]['epp']['response']['result']['msg'];

            if ($code !== '1000') {
                $err['entity']['registrant_change']['msg'] = $msg;
            } else {

                /* make the request approved */
                $entity_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
                $this->domain->save($entity_request, ['DCR_ID' => $entity->DCR_ID], REQUEST);

                /* add on history  */
                $old_data = ['key' => 'Chg_Entity_history',
                    'value' => json_encode($post)];
                $dh_id = $this->domain->duplicateHisRecord(DOMAIN_HIS, 'DH_ID', $domain->DH_ID, $old_data);

                $auth__data = ['DH_ID' => $dh_id];
                $this->domain->save($auth__data, ['Domain_ID' => $domain->Domain_ID], DOMAIN);

                /*6- */
                $where = ['DINFO_ID' => $domain->DINFO_ID];
                $upd_info = ['Registrar_ID' => $registrar_id];
                $this->domain->save($upd_info, $where, INFO);

                $scc['entity']['registrant_change']['msg'] = 'تم تعديل بيانات الجهةبنجاح';

            }

        }
        /*  end approve entity request   */

        /* --------------------approve contact admin request-------------
        --------------------------05/01/2021--------------------- */
   
            $new_admin = $requests->new_admin;
            if (!empty($new_admin)) {
                $type = 'new_admin';
                $request_id = $new_admin->DCR_ID;
                $post = json_decode($new_admin->DCR_POST_DATA);
                if (!$this->_approve_contact_change($post, $type, $domain_id, $request_id)) {
                    $err['contact']['new_admin']['msg'] = getSystemString(255);
                } else {
                    $scc['contact']['new_admin']['msg'] = 'تم تعديل بيانات المسؤول الاداري بنجاح';
                }
            }
 
        if (!empty($domain->Admin)) {
            $admin = $requests->admin;
            if (!empty($admin)) {
                $type = 'Admin';
                $request_id = $admin->DCR_ID;
                $post = json_decode($admin->DCR_POST_DATA);
                $email = $post->email;
                if (!$this->_approve_contact_change($post, $type, $domain_id, $request_id)) {
                        $err['contact']['admin']['msg'] = getSystemString(255);
                } else {                 
                       $scc['contact']['admin']['msg'] = 'تم ارسال ايميل للمنسق الاداري الجديد '.$email;
                }
            }
        }
        if (!empty($domain->Technical)) {
            $technical = $requests->technical;
            if (!empty($technical)) {
                $type = 'Technical';
                $request_id = $technical->DCR_ID;
                $post = json_decode($technical->DCR_POST_DATA);
                if (!$this->_approve_contact_change($post, $type, $domain_id, $request_id)) {
                    $err['contact']['technical']['msg'] = getSystemString(255);
                } else {
                    $scc['contact']['technical']['msg'] = 'تم تعديل بيانات المسؤوول التقني بنجاح';
                }
            }
        }
        if (!empty($domain->Financial)) {
            $financial = $requests->financial;
            if (!empty($financial)) {
                $type = 'Financial';
                $request_id = $financial->DCR_ID;
                $post = json_decode($financial->DCR_POST_DATA);
                if (!$this->_approve_contact_change($post, $type, $domain_id, $request_id)) {
                    $err['contact']['financial']['msg'] = getSystemString(255);
                } else {
                    $scc['contact']['financial']['msg'] = 'تم تعديل بيانات المسؤول المالي بنجاح';
                }
            }
        }
        /*  end approve contact admin request   */

        /* --------------------domain admin waiver---------------
        --------------------------23/01/2021--------------------- */
        $domain_waiver_request = $requests->domain_waiver;
        if(!empty($domain_waiver_request)){


            $waiver_post_data  = json_decode($domain_waiver_request->DCR_POST_DATA);
            $dw_id = $waiver_post_data->DW_ID;

            /* send request to the second admin waiver */
            $_POST = ['DW_ID'=>$dw_id];
            $domain_id = $domain_waiver_request->DCR_Domain_ID;
            $waiver_info = $this->domain->get_domain_waiver_by_id($dw_id, $domain_id);
            $admin = json_decode($waiver_info->Admin_Data);
            $admin_email = $admin->User_Email;

            $waiver_info = ['Admin_Email_Sent' => date('Y-m-d H:i:s')];
            $this->domain->save($waiver_info, ['DW_ID' => $dw_id], WAIVERS);


            if($this->_send_change_request_to_second_admin_waiver($dw_id, $domain_id, $admin_email,$domain_waiver_request)){
                    $scc['domain_waiver']['msg'] = 'تمت موافقة التنازل بنجاح . سيتم ارسال طلب موافقة للطرف الثاني (المتنازل اليه) على الايميل  '.$admin_email;

            }else{
                 $err['domain_waiver']['msg'] = 'عذرا لم يتم ارسال بريد الكتروني';
            }
        }

        /*  end domain admin waivert   */


        /* --------------------second admin waiver---------------
        --------------------------23/01/2021--------------------- */
        $second_admin_waiver_request = $requests->second_admin_waiver;
        if(!empty($second_admin_waiver_request)){


            $waiver_post_data  = json_decode($second_admin_waiver_request->DCR_POST_DATA);
            $dw_id = $waiver_post_data->DW_ID;


            /* second admin approve to the waiver */
            $contact_request = ['DW_Status' => 'APPROVED','Second_Admin_Email'=>date('Y-m-d H:i:s')];
            $this->domain->save($contact_request, ['DW_ID' => $dw_id], WAIVERS);
            $scc['second_admin_waiver_request']['msg'] = 'تمت الموافقة بنجاح';

             /* make the request approved */
            $request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
            $this->domain->save($request, ['DCR_ID' => $second_admin_waiver_request->DCR_ID], REQUEST);

        }

        /*  end second admin waiver   */



        $data['error'] = $err;
        $data['success'] = $scc;

        $this->LoadView_m('customer/domain_registration/approve_change_request_2', $data);

    }

    private function _send_change_request_to_second_admin_waiver($dw_id, $domain_id,$admin_email,$domain_waiver_request){
       
        $type = 'second_admin_waiver';
        $status = 'NEW';
        $waiver_info = $this->domain->get_domain_waiver_by_id($dw_id, $domain_id);


        $userid = $waiver_info->DW_Customer_ID;

        /*update customer page token*/
        $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
        $rand2 = rand(111111, 999999);
        $verify_page_token = urlencode(md5($rand . '' . $rand2));

        $admin_officer = json_decode($waiver_info->Admin_Data);


       
        $domain = $this->domain->getDomainByID($domain_id);
        $domain_ns = $domain->Domain_Name . $domain->TLD;
        $data['domain'] = $domain;
        $data['url'] = base_url('change_request/') . '?do=' . encryptIt($domain_id) . '&to=' . $verify_page_token;
        $data['website_data'] = $this->home_model->Get_Website_Data();
        $data['DCR_ID'] = $domain_waiver_request->DCR_ID;


        $this->load->library('parser');
        $message = '' . $this->parser->parse('customer/email-templates/send_verification_email_to_admin_officer', $data, true);

        $admin_email = $admin_officer->User_Email;
        $options = array(
            'to' => $admin_email,
            'subject' => getSystemString('email_verify_subject') . ' | ' . getSystemString($type).' | '.$domain_ns,
            'message' => $message,
        );


        if (SendEmail($options)) {
           // if(true){

             $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
             $admin_id = (empty($admin_officer->Epp_ID))?$admin_officer->Org_Usr_ID:$admin_officer->Epp_ID;

            /* here we should add request to to be executed by admin*/ 
            $status = 'pending';
            $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $status);
            $request_data = [
                'DCR_Request_Type' => $type,
                'DCR_Domain_ID' => $domain_id,
                'DCR_USER_ID' => $userid,
                'DCR_Admin_ID' => $admin_id,
                'DCR_Status' => $status,
                'DCR_Phone_Verified' => 0,
                'DCR_Verify_Page_Token' => $verify_page_token,
                'DCR_POST_DATA' => json_encode($_POST),
            ];

            $request_id = $this->domain->insert(REQUEST, $request_data);

            /* make the request approved */
            $contact_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
            $this->domain->save($contact_request, ['DCR_ID' => $domain_waiver_request->DCR_ID], REQUEST);


            /* make waiver pending */
            $waiver_post_data  = json_decode($domain_waiver_request->DCR_POST_DATA);
            $dw_id = $waiver_post_data->DW_ID;
            $contact_request = ['DW_Status' => 'PENDING'];
            $this->domain->save($contact_request, ['DW_ID' => $dw_id], WAIVERS);

            $msg = getSystemString('success_request');
            $msg = "<p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i>" . $msg . "</p>";

            return true;

        } else {
           return false;
        }
    }

    private function _transfer_inside_dnet($post, $domain, $request_id)
    {

        /* 1- get destination by auth code
        2- duplicate history record with new registrant id
        3- update the domain with new registrant id and history record
         */
        $auth_code = $post->auth_code;
        $dist_domain = $this->domain->getDomainByAuthCode($auth_code);
        if (!empty($dist_domain)) {
            $destination_id = $dist_domain->Customer_ID;
            $current_id = $domain->Customer_ID;

            /* 2- duplicate history record with new registrant id */
            $old_data = ['key' => 'Customer_ID',
                'value' => $current_id];
            $dh_id = $this->domain->duplicateHisRecord(DOMAIN_HIS, 'DH_ID', $domain->DH_ID, $old_data);

            /* 3- update the domain with new registrant id and history record*/
            $update_date = ['Customer_ID' => $destination_id, 'DH_ID' => $dh_id];
            $this->domain->save($update_date, ['Domain_ID' => $domain->Domain_ID], DOMAIN);

            /* insert log on domain dnet inside table*/
            $inside_dnet = ['Domain_ID' => $domain->Domain_ID,'Request_ID' => $request_id, 'Old_Owner_ID' => $current_id,'New_Owner_ID' => $destination_id];
            $this->domain->insert(INSIDE_DNET,$inside_dnet);

            /* make the request approved */
            $request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
            $this->domain->save($request, ['DCR_ID' => $request_id], REQUEST);

            return true;

        } else {
            return false;
        }

    }



    private function _send_verification_email_request_new_admin($domain_id,$admin_email,$request_id,$post){


        $type = 'new_admin';
        /*update customer page token*/
        $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
        $rand2 = rand(111111, 999999);
        $verify_page_token = urlencode(md5($rand . '' . $rand2));



       
        $domain = $this->domain->getDomainByID($domain_id);
        $domain_ns = $domain->Domain_Name . $domain->TLD;
        $data['domain'] = $domain;
        $data['url'] = base_url('change_request/') . '?do=' . encryptIt($domain_id) . '&to=' . $verify_page_token;
        $data['website_data'] = $this->home_model->Get_Website_Data();

       


        $this->load->library('parser');
        $message = '' . $this->parser->parse('customer/email-templates/send_verification_email_to_admin_officer', $data, true);

        $options = array(
            'to' => $admin_email,
            'subject' => getSystemString('email_verify_subject') . ' | ' . getSystemString($type).' | '.$domain_ns,
            'message' => $message,
        );

        if (SendEmail($options)) {
           // if(true){

             $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
             $admin_id = (empty($admin_officer->Epp_ID))?$admin_officer->Org_Usr_ID:$admin_officer->Epp_ID;


             $request_info = $this->domain->getRequestByID($request_id);

            /* here we should add request to to be executed by admin*/ 
            $status = 'pending';
            $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $status);
            $request_data = [
                'DCR_Request_Type' => $type,
                'DCR_Domain_ID' => $domain_id,
                'DCR_USER_ID' => $request_info->DCR_USER_ID,
                'DCR_Admin_ID' => $admin_id,
                'DCR_Status' => $status,
                'DCR_Phone_Verified' => 0,
                'DCR_Verify_Page_Token' => $verify_page_token,
                'DCR_POST_DATA' => json_encode($post),
            ];

            $request_new_id = $this->domain->insert(REQUEST, $request_data);

            /* make the request approved */
            $contact_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
            $this->domain->save($contact_request, ['DCR_ID' => $request_id], REQUEST);



            $msg = getSystemString('success_request');
            $msg = "<p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i>" . $msg . "</p>";

            return true;

        } else {
           return false;
        }

    }

    private function _approve_contact_change($post, $type, $domain_id, $request_id)
    {

        $domain = $this->domain->getDomainByID($domain_id);




        $full_name = $post->full_name;
        $employer_name = $post->employer_name;
        $job_title = $post->job_title;
        $first_address = $post->first_address;
        $second_address = $post->second_address;
        $country = $post->country;
        $region = $post->region;
        $city = $post->city;
        $post_code = $post->post_code;
        $phone = $post->phone;
        $mobile = $post->mobile;
        $mobile_key = $post->mobile_key;        
        $fax = $post->fax;
        $email = $post->email;

        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');

        if($type == 'Admin' && ($admin_officer->User_Email !=$email || $admin_officer->User_Phone !=$phone) ){
            /* send new admin request email */
            return $this->_send_verification_email_request_new_admin($domain_id,$email,$request_id,$post);
            die;

        }

        /* 1- insert new contact
        2- nic  "contact_create"
        3- update nic authcode
        4- nic "domain_admin_change"
        5- update contact on info
         */
        $new_id = randomNumber(10).'0-dnet';        
        $contact_data = [
            'Epp_ID' => $new_id,                                                            
            'Full_Name' => $full_name,
            'Employer_Name' => $employer_name,
            'User_Job_Title' => $job_title,
            'Phone_verified' => 1,
            'User_Country_ID' => $country,
            'User_Region' => $region,
            'User_City' => $city,
            'User_Post_Code' => $post_code,
            'User_Fax' => $fax,
            'User_Phone' => $phone,
            'User_Email' => $email,
            'User_Mobile' => $mobile,
            'Mobile_Key' => ($mobile_key)?:'966',
            'User_Address1' => $first_address,
            'User_Address2' => $second_address,
            'Country_Code'  => 'SA',
        ];
        /*1- */$contact_id = $this->domain->insert(USERS, $contact_data);

        /*2- */
        $contact_data['Org_Usr_ID'] = $contact_id;
        $contact_data = json_decode(json_encode($contact_data));
        if(!empty($contact_data->User_Phone)){ $contact_data->User_Phone = '+966.'.$contact_data->User_Phone; }
        if(!empty($contact_data->User_Fax))  { $contact_data->User_Fax = '+966.'.$contact_data->User_Fax;}
        if(!empty($contact_data->User_Mobile)){$contact_data->User_Mobile = '+'.$contact_data->Mobile_Key.'.'.$contact_data->User_Mobile;}
        $response = $this->epp_lib->contact_create($contact_data, $domain_id);
        $authCode = $response['authCode'];
        


        

        /*3- */
        $upd_reg = ['Auth_Code' => $authCode];
        $where = ['Org_Usr_ID' => $contact_id];
        $this->domain->save($upd_reg, $where, USERS);

        /*4- *///"domain_admin_change"
        $domain_ns = $domain->Domain_Name . $domain->TLD;
        $type_id = $type . '_ID';
        //$new_id = $contact_id;
        $old_id = $domain->$type_id;

        if ($type == 'new_admin' || $type == 'Admin') {
            $old_id = $domain->Admin_ID;            
            $role = 'admin';
        } elseif ($type == "Technical") {
            $role = 'tech';
        } elseif ($type == 'Financial') {
            $role = 'billing';
        }



        $response_registrant_change = $this->epp_lib->domain_admin_change($domain_ns, $new_id, $old_id, $role, $domain->Domain_ID);
        $code = $response_registrant_change[0]['epp']['response']['result']['@attributes']['code'];
        $msg = $response_registrant_change[0]['epp']['response']['result']['msg'];

        if ($code !== '1000') {

            return false;

        } else {

            /*5- */
            $where = ['DINFO_ID' => $domain->DINFO_ID];

            if ($type == "Technical") {
                $upd_info = ['Technical_ID' => $new_id];
            }
            if ($type == 'Financial') {
                $upd_info = ['Financial_ID' => $new_id];
            }
            if ($type == 'new_admin' || $type == 'Admin') {
                $upd_info = ['Admin_ID' => $new_id];
            }

            $this->domain->save($upd_info, $where, INFO);

            if ($role == 'admin') {

                /* change domain auth code */
                $domain_authocde_change = $this->epp_lib->domain_authocde_change($domain_ns, $domain->Domain_ID);
                $msg = $domain_authocde_change[0]['epp']['response']['result']['msg'];
                $code = $domain_authocde_change[0]['epp']['response']['result']['@attributes']['code'];
                $new_authCode = $domain_authocde_change['authCode'];

                if ($code == '1000') {
                    /* add on history  */
                    $Auth_Code_history = ['Admin_ID' => $domain->Admin_ID, 'Auth_Code' => $domain->Auth_Code];
                    $old_data = ['key' => 'Auth_Code_history',
                        'value' => json_encode($Auth_Code_history)];
                    $dh_id = $this->domain->duplicateHisRecord(DOMAIN_HIS, 'DH_ID', $domain->DH_ID, $old_data);

                    /* save the new domain auth code */
                    $auth__data = ['Auth_Code' => $new_authCode, 'DH_ID' => $dh_id];
                    $this->domain->save($auth__data, ['Domain_ID' => $domain->Domain_ID], DOMAIN);
                }

            }

            /* make the request approved */
            $contact_request = ['DCR_Status' => 'approved','DCR_Admin_Approve' => 1];
            $this->domain->save($contact_request, ['DCR_ID' => $request_id], REQUEST);

            return true;

        }
    }




        public function cancel_request($domain_id, $request_id,$token=0)
    {

        $domain_id = decryptIt($domain_id);
        $request_id = decryptIt($request_id);


        $data['domain_id'] = $domain_id;
        $data['request_id'] = $request_id;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');
        $this->form_validation->set_rules('request_id', 'request_id', 'numeric|trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect();
        }

        $request = $this->domain->getRequestByID($request_id);
        $customer_id = $request->DCR_USER_ID;

        if($request->DCR_Request_Type == 'domain_transfer_in'){
            $data['id'] = $domain_id;
            $data['c_id'] = $customer_id;
            $data['page_token'] = $token;            
            $transfer_request = $this->domain->getTransferRequest($data);
            if(!empty($transfer_request)){

                $transfer_update = ['DTI_Status' => 'CANCELED'];
                $affected_id = $this->domain->save($transfer_update, ['DTI__ID' => $transfer_request->DTI__ID], TRANSFER);

                $request_update_status = ['DCR_Status' => 'canceled'];
                $affected_id = $this->domain->save($request_update_status, ['DCR_ID' => $request_id], REQUEST);
            }
        }

        

        if($request->DCR_Request_Type != 'domain_transfer_in'){
            $domain = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
            if (empty($domain)) {
                $this->session->set_flashdata('requestMsgErr', 119);
                redirect();
            }
        }


        if($request->DCR_Request_Type != 'transfer_out' && $request->DCR_Request_Type != 'domain_transfer_in'){
            /* set request status to canceled by the user it self by mohamed arabid 21/01/2021*/
            $request_update_status = ['DCR_Status' => 'canceled'];
            $affected_id = $this->domain->save($request_update_status, ['DCR_ID' => $request_id], REQUEST);
        }


        /* set domain status to canceled by the user it self */
        if($request->DCR_Request_Type =='create_domain'){

            $application_update_status = ['Domain_Status' => 'Canceled'];
            $affected_id = $this->domain->save($application_update_status, ['Domain_ID' => $domain_id], DOMAIN);

            $info_update_status = ['Admin_Cancel' => 1];
            $affected_id = $this->domain->save($info_update_status, ['Domain_ID' => $domain_id], INFO);

             $log = [ 'DAL_Domain_ID'=>$domain_id,'DAL_User_ID'=>$customer_id,'DAL_Status'=>'admin_application_cancel','DAL_Created'=>date('Y-m-d H:i:s'),'DAL_Type'=>'Customer'];
            $this->domain->insert(APP_LOG, $log);
        }


        /*  by mohamed arabid 30/01/2021*/
        if($request->DCR_Request_Type == 'domain_waiver' || $request->DCR_Request_Type == 'second_admin_waiver'){
            $waiver = $this->domain->get_domain_waiver($customer_id, $domain_id);            
            $application_update_status = ['DW_Status' => 'CANCELED'];
            $affected_id = $this->domain->save($application_update_status, ['DW_ID' => $waiver->DW_ID], WAIVERS);

            $status = ($request->DCR_Request_Type == 'domain_waiver')?'adm_wvr_cnl':'sec_adm_wvr_cnl';
            $log = [ 'DAL_Domain_ID'=>$domain_id,'DAL_User_ID'=>$customer_id,'DAL_Status'=>$status,'DAL_Created'=>date('Y-m-d H:i:s'),'DAL_Type'=>'Customer'];
            $this->domain->insert(APP_LOG, $log);
        }

        /* reject domain transfer_out from chnage request email 04/02/2021 */
        if($request->DCR_Request_Type == 'transfer_out'){
            $this->load->library('nic/epp_lib');            
            $domain_ns = $domain->Domain_Name . $domain->TLD;
            $responseJSON = $this->epp_lib->domain_transfer_status($domain_ns, 'reject');

            $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
            $msg = $responseJSON[0]['epp']['response']['result']['msg'];

            if ($code !== '1000') {

                $affected_id =  0;

            } else {

                /* make the request approved */
                $transfer_out_request = ['DCR_Status' => 'refused'];
                $affected_id =  $this->domain->save($transfer_out_request, ['DCR_ID' => $request_id], REQUEST);          
            }
        }



        if ($affected_id) {
            $this->session->set_flashdata('requestMsgSucc', 'cancel_request_msg');            
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }

        $customer_id = $this->session->userdata($this->site_session->userid());
        if(!empty($customer_id)){
            redirect('my_orders');
        }else{
            redirect();
        }

    }


    public function change_request()
    {

        $data['token'] = $this->input->get('to');
        $domain_id = decryptIt($this->input->get('do'));
        $data['domain_id'] = $domain_id;
        $data['do'] = $domain_id;

        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('token', 'token', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('user_id', 'user_id', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('domain_id', 'domain_id', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgErr', validation_errors());
            redirect(base_url('uncaught_syntax'));
        }

        $request = $this->domain->verify_request($data);
        $this->_check_request_validation($request);
        

        $data['domain'] = $this->domain->getDomainByID_All($domain_id);

        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
        $admin_id = (empty($admin_officer->Epp_ID))?$admin_officer->Org_Usr_ID:$admin_officer->Epp_ID;
        $token = $data['token'];

        $request = $this->domain->getRequestInfo($domain_id, $admin_id, $token);

        if($request->DCR_Request_Type == 'second_admin_waiver'){
              $ss = json_decode($request->DCR_POST_DATA);
              $dw_id = $ss->DW_ID;
              $status = 'PENDING';
              $waiver_info =  $this->domain->get_domain_waiver_by_id($dw_id, $request->DCR_Domain_ID,$status);

              $second_admin_data = json_decode($waiver_info->Admin_Data);
              $phone = $second_admin_data->User_Mobile;
        }else{
              $phone = $admin_officer->User_Mobile;

        }
        $data['settings'] = $this->home_model->Get_Website_Configuration();

        $data['msg'] = 'verify_mobile_title_msg_admin';
        $data['msg_title'] = 'verify_mobile_title_msg_admin_2';
        $data['phone'] = $phone;
        $data['role'] = 'Admin';
     

        if(!empty($_SESSION['request_id']) && $_SESSION['request_id'] != $request->DCR_ID) {
            $_SESSION['request_id'] = '';
        }


        if ((!empty($request) && $request->DCR_Phone_Verified == 0)) {


            if ($request->DCR_IS_SMS_Sent == 0) {

                $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
                $verify_token = md5($rand);
                //Send verification code to user phone
                $message = 'Pin Code is:' . $rand;
                $upd = array(
                    'DCR_Verify_Token' => $verify_token,
                    'DCR_IS_SMS_Sent' => 1,
                    'DCR_Phone_Verified' => 0,
                    'Total_SMS_Sent' => $request->Total_SMS_Sent + 1,
                    'Last_SMS_Sent_Date' => date('Y-m-d H:i:s'),
                );

                $app_log = [
                    'DAL_Domain_ID' => $domain_id,
                    'DAL_User_ID' => $admin_officer->Org_Usr_ID,
                    'DAL_Created' => date("Y-m-d H:i:s"),
                    'DAL_Type'=>'Contact',
                ];
               
            
                $this->session->set_userdata('intended_url', '');
                if(ENVIRONMENT == 'development') {
                    $action = true;
                }else{
                    $action = sendSMSTo($phone, $message);            
                }
                if ($action) {
                     //if(true){
                    // $this->domain->updateDomainUserInfo($admin_officer->Org_Usr_ID,$upd);
                    $this->domain->updateRequestInfo($admin_id, $token, $upd);
                    $data['success'] = getSystemString(254);
                    $app_log['DAL_Status'] = 'sms_admin_officer';
                    

                } else {
                    $data['error'] = getSystemString('error_sms');
                    $app_log['DAL_Status'] = 'sms_admin_officer_no';

                }
                  $log_id = $this->domain->insert(APP_LOG, $app_log);

                $this->LoadView_m('customer/domain_registration/mobile_verify_change_request', $data);

            } else {

                $this->LoadView_m('customer/domain_registration/mobile_verify_change_request', $data);

            }

        } else if($_SESSION['request_id'] == $request->DCR_ID) {
            $data['success'] = getSystemString(254);
            $data['domain'] = $this->domain->getDomainByID_All($domain_id);
            $data['requests'] = $this->domain->getAllPendingRequest($domain_id,$token);
            $data['token'] = $token;

            $this->LoadView_m('customer/domain_registration/approve_change_request_1', $data);
        }else if(empty($_SESSION['request_id'])){
              $this->LoadView_m('customer/domain_registration/mobile_verify_change_request', $data);
        }

    }

/* this request used to verify mobile on change request on domain */
    public function mobile_verify_change_request()
    {

        $token = $this->input->post('verify_page_token');
        // $url = $this->input->post('url');

        $domain_id = decryptIt(str_replace(' ', "+", $this->input->post('do')));

        $url = base_url('change_request/') . '?do=' . encryptIt($domain_id) . '&to=' . $token;
        //verify domain data
        $data['domain_id'] = $domain_id;
        $data['token'] = $token;
        $request = $this->domain->verify_request($data);
        $this->_check_request_validation($request);
        

        //verify account data
        $verify_code = $this->input->post('code1') . $this->input->post('code2') . $this->input->post('code3') . $this->input->post('code4');
        $verify_code = md5($verify_code);
        $role = 'Admin';
        $officer = $this->domain->getDomainOrgUsers($domain_id, $role);
        $admin_id = (empty($officer->Epp_ID))?$officer->Org_Usr_ID:$officer->Epp_ID;



        $request = $this->domain->getRequestInfo($domain_id, $admin_id, $token,$verify_code);
        if (!empty($request) && ($request->DCR_Phone_Verified == 0 || empty($_SESSION['request_id'])) )  {
            $upd['DCR_Phone_Verified'] = 1;

                $_SESSION['request_id'] = $request->DCR_ID;
                $this->domain->updateRequestInfo($admin_id, $token, $upd);

                if(!empty($request)){
                    $this->session->set_flashdata('requestMsgSucc', 'phoneVerified');
                }
                else{
                  $this->session->set_flashdata('requestMsgErr', 119);
                }
                
                redirect($url);

        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($url);
        }

    }

    public function admin_officer_verify_domain()
    {

        $data['token'] = $this->input->get('to');
        $domain_id = decryptIt($this->input->get('do'));
        $data['domain_id'] = $domain_id;

        $data['do'] = $this->input->get('do');

        $data['settings'] = $this->home_model->Get_Website_Configuration();


        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('token', 'token', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('user_id', 'user_id', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('domain_id', 'domain_id', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgErr', validation_errors());
            redirect(base_url('uncaught_syntax'));
        }

        //verify domain info
        $verified = $this->domain->verifyDomainInfo($data);
        if (!$verified) {
            $this->session->set_flashdata('requestMsg', 46);
            redirect(base_url('uncaught_syntax'));
        }

        /* get last pending create domain request */
        $request = $this->domain->get_pending_create_request($domain_id);
        $data['request'] = $request;


          /* this action used to verify domain info by domain*/
        $data['domain'] = $this->domain->getDomainByID_All($domain_id);
        if ($data['domain']->Domain_Status == 'Canceled' || empty($request)) {
            $this->session->set_flashdata('requestMsg', 46);
            redirect(base_url('uncaught_syntax'));
        }

        // echo  $_SESSION['token'].' '.$data['token']; exit;

        /* check if domain payed for registration */
        // $is_payed = $this->domain->getRegistrationVerifiedPayment($domain_id);
        // if ($is_payed) {
            
        //     $data['is_payed'] = $is_payed;
        //     $data['domain'] = $this->domain->getDomainByID_All($domain_id);
        //     $this->LoadView_m('customer/domain_registration/financial_officer_step_2', $data);
        // }else{


        if(!empty($_SESSION['token']) && $_SESSION['token'] != $data['token']) {
            $_SESSION['token'] = '';
        }

        $reset = 0;
        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin', $reset);
        
        $data['msg'] = 'verify_mobile_title_msg_admin';
        $data['msg_title'] = 'verify_mobile_title_msg_admin_2';
        $data['phone'] = $admin_officer->User_Mobile;
        $data['role'] = 'Admin';


        //if (!empty($admin_officer) && $admin_officer->Phone_verified == 0 || empty($_SESSION['token'])) {
        if (!empty($admin_officer) && $admin_officer->Phone_verified == 0) {

           if ($admin_officer->Is_SMS_Sent == 0) {

            $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
            $verify_token = md5($rand);
            //Send verification code to user phone
            $message = 'Pin Code is:' . $rand;

            $upd = array(
                'Verify_Token' => $verify_token,
                'IS_SMS_Sent' => 1,
                'Phone_Verified' => 0,
                'Total_SMS_Sent' => $admin_officer->Total_SMS_Sent + 1,
                'Last_SMS_Sent' => date('Y-m-d H:i:s'),
            );                               
            $app_log = [
                'DAL_Domain_ID' => $domain_id,
                'DAL_User_ID' => $admin_officer->Org_Usr_ID,
                'DAL_Created' => date("Y-m-d H:i:s"),
                'DAL_Type'=>'Contact',

            ];

            if (sendSMSTo($admin_officer->User_Mobile, $message)) {
                //if(true){    

                $this->domain->updateDomainUserInfo($admin_officer->Org_Usr_ID, $upd);
                $data['success'] = getSystemString(254);
                $app_log['DAL_Status'] = 'sms_admin_officer';
              

            } else {
                $data['error'] = getSystemString('error_sms');
                $app_log['DAL_Status'] = 'sms_admin_officer_no';

            }

            $log_id = $this->domain->insert(APP_LOG, $app_log);

            $this->session->set_userdata('intended_url', '');
            $data['url'] = 'admin_officer_verify_domain/' . '?do=' . encryptIt($domain_id) . '&to=' . $data['token'];
            $this->session->set_userdata('intended_url', $url);
            $this->LoadView_m('customer/domain_registration/code_verification', $data);

            } else {
                $this->LoadView_m('customer/domain_registration/code_verification', $data);
            }

        } else if($_SESSION['token'] == $data['token']){
            $data['success'] = getSystemString(254);

            $data['domain'] = $this->domain->getDomainByID_All($domain_id);

            $reg_payments = $this->domain->getRegistrationVerifiedPayment($domain_id);
            $tran_payments = $this->domain->getTransferVerifiedPayment($domain_id);
            $data['is_payed'] = FALSE;            
            if($reg_payments > 0 || $tran_payments > 0){
                $data['is_payed'] = TRUE;
            }

            $issures_id = $data['domain']->Docs->speech->Doc_Issures_ID;
            $issuer = $this->domain->getIssuersByID($issures_id);
            $data['issuer'] = $issuer;
            

            $this->LoadView_m('customer/domain_registration/admin_officer_step_1', $data);
        }else if(empty($_SESSION['token'])){
            $this->LoadView_m('customer/domain_registration/code_verification', $data);
        }

    //}

    }

    public function domain_verify_mobile()
    {

        $phone = $this->input->post('phone');
        $token = $this->input->post('verify_page_token');
        $url = $this->input->post('url');

        $domain_id = decryptIt(str_replace(' ', "+", $this->input->post('do')));

        //verify domain data
        $data['domain_id'] = $domain_id;
        $data['token'] = $token;
        $verified = $this->domain->verifyDomainInfo($data);

        // var_dump($verified); exit();
        if (!$verified) {
            $this->session->set_flashdata('requestMsg', 46);
            redirect(base_url('uncaught_syntax'));
        }

        //verify account data
        $verify_code = $this->input->post('code1') . $this->input->post('code2') . $this->input->post('code3') . $this->input->post('code4');
        $verify_code = md5($verify_code);
        $role = $this->input->post('role');
       // $officer = $this->domain->getDomainOrgUsers($domain_id, $role, $verify_code);

        $officer = $this->domain->getDomainOrgUsers($domain_id , $role ,0 , $verify_code);

        if($role == 'Financial'){
           $url = base_url('process_payment/') . '?do=' . encryptIt($domain_id) . '&to=' . $token;
        }else{
           $url = base_url('admin_officer_verify_domain/') . '?do=' . encryptIt($domain_id) . '&to=' . $token; 
        }
        $request = $this->domain->get_pending_create_request($domain_id);

        if (!empty($officer) && ($officer->Phone_verified == 0 || empty($_SESSION['token'])) ) {
            $upd['Phone_verified'] = 1;
            //$this->session->set_userdata('token', $token);
            $_SESSION['token'] = $token;
            $this->domain->updateDomainUserInfo($officer->Org_Usr_ID, $upd);
            
                if (strlen($this->session->userdata('intended_url')) > 0) {
                    $intended_url = $this->session->userdata('intended_url');                    
                    $this->session->set_userdata('intended_url', '');
                    redirect($intended_url);
                } else {
                    $this->session->set_flashdata('requestMsgSucc', 'phoneVerified');
                    redirect($url);
                }
         
        } else {
            $intended_url = $this->session->userdata('intended_url');
            $this->session->set_userdata('intended_url', '');
            $this->session->set_flashdata('requestMsgErr', 60);
            redirect($url);
        }

    }

    public function domain_approve_modifications(){

        $data['token'] = $this->input->get('to');
        $domain_id = decryptIt($this->input->get('do'));
        $data['domain_id'] = $domain_id;

        $data['do'] = $this->input->get('do');



        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('token', 'token', 'trim|required|xss_clean');
        $this->form_validation->set_rules('domain_id', 'domain_id', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgErr', validation_errors());
            redirect(base_url('uncaught_syntax'));
        }

        //verify domain info
        $verified = $this->domain->verifyDomainInfo($data);
        if (!$verified) {
            $this->session->set_flashdata('requestMsg', 46);
            redirect(base_url('uncaught_syntax'));
        }

        $domain = $this->domain->getDomainByID_All($domain_id);
        $request = $this->domain->getCreateRequestByDomainID($domain_id);
        $this->_check_request_validation($request);
        $data['domain'] = $domain;

        $request_data = ['DCR_Admin_Approve'=>1];
        $this->domain->save($request_data, ['DCR_ID' => $request->DCR_ID], REQUEST);
        
        $info_data = ['Domain_Admin_Approved' => 1];
        $this->domain->save($info_data, ['DINFO_ID' => $domain->DINFO_ID], INFO);

        $app_log = [
                    'DAL_Domain_ID' => $domain_id,
                    'DAL_User_ID' =>  $domain->Admin->Org_Usr_ID,
                    'DAL_Created' => date("Y-m-d H:i:s"),
                    'DAL_Type'=>'Contact',

        ];
        $app_log['DAL_Status'] = 'admin_officer_approve';
        $this->domain->insert(APP_LOG, $app_log);

        /* after approve the need modification application make the domain status pending */
        $new_status = ['Domain_Status' => 'PENDING'];
        $this->domain->save($new_status, ['Domain_ID' => $domain_id], DOMAIN);

        // $old_status = 'pending';
        // $new_status = 'approved';
        // $this->domain->change_create_domain_request_status($domain_id,$old_status,$new_status);

        $data['success']['need_modification'] = getSystemString(176);
        $this->LoadView_m('customer/domain_registration/approve_change_request_2', $data);


    }

    public function domain_verified()
    {

        // $data['token'] = $this->input->get('TO');
        // // $data['user_id'] = $this->input->get('UR');
        // // $data['customer_id'] = $this->input->get('CU');
        // $data['domain_id'] = $this->input->get('DO');

        $data['token'] = $this->input->get('to');
        $domain_id = decryptIt($this->input->get('do'));
        $data['domain_id'] = $domain_id;

        $data['do'] = $this->input->get('do');
        $resend = $this->input->get('resend');


        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('token', 'token', 'trim|required|xss_clean');

        $this->form_validation->set_rules('domain_id', 'domain_id', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgErr', validation_errors());
            redirect(base_url('uncaught_syntax'));
        }

        //get domain info
        $verified = $this->domain->verifyDomainInfo($data);
        if (!$verified) {
            $this->session->set_flashdata('requestMsg', 46);
            redirect(base_url('uncaught_syntax'));
        }

        //if app email send redirect to home
        $is_email_sent = $this->domain->getAppLogByDomainID($domain_id, 'email_financial_officer');
        $reset = 0;
        $financial_officer = $this->domain->getDomainOrgUsers($data['domain_id'], 'Financial', $reset);
        $data['email'] = $financial_officer->User_Email;
        if (!$is_email_sent || $resend) {

            $data['url'] = base_url('process_payment/') . '?do=' . encryptIt($domain_id) . '&to=' . $data['token'];

            $domain = $this->domain->getDomainByID_All($domain_id);
            $data['domain'] = $domain;
            $domain_ns = $domain->Domain_Name.$domain->TLD;

            $info_data = [
                'Domain_Admin_Approved' => 1,
            ];
            $this->domain->save($info_data, ['DINFO_ID' => $domain->DINFO_ID], INFO);

            $data['website_data']      = $this->home_model->Get_Website_Data();

            /* get request details */
            $type   = 'create_domain';
            $request = $this->domain->getRequestByType($type,$domain_id,'pending');
            $data['DCR_ID'] = $request->DCR_ID;
            $num = str_pad($request->DCR_ID, 5, '0', STR_PAD_LEFT);

            /* update admin approve flag request */
            $this->domain->approveRequestByAdmin($request->DCR_ID);

            $this->load->library('parser');
            $message = '' . $this->parser->parse('customer/email-templates/send_payment_email_to_finantial_officer', $data, true);

            // echo $message; exit();
            $options = array(
                'to' => $financial_officer->User_Email,
                'subject' => getSystemString('payment_email_subject').' | #'.$num.' | '.$domain_ns,
                'message' => $message,
            );
            if (SendEmail($options)) {
                $domain_data = [
                    'DAL_Domain_ID' => $domain_id,
                    'DAL_User_ID' => $financial_officer->Org_Usr_ID,
                    'DAL_Status' => 'admin_officer_approve',
                    'DAL_Created' => date("Y-m-d H:i:s"),
                    'DAL_Type'=>'Contact',

                ];
                $log_id = $this->domain->insert(APP_LOG, $domain_data);

                $domain_data = [
                    'DAL_Domain_ID' => $domain_id,
                    'DAL_User_ID' => $financial_officer->Org_Usr_ID,
                    'DAL_Status' => 'email_financial_officer',
                    'DAL_Created' => date("Y-m-d H:i:s"),
                    'DAL_Type'=>'Contact',

                ];
                $log_id = $this->domain->insert(APP_LOG, $domain_data);

            }
        }
        $this->LoadView_m('customer/domain_registration/admin_officer_step_2', $data);
    }



        public function payment_methods()
            {


        $data['token'] = $this->input->post('token');
        $domain_id = decryptIt($this->input->post('domain_id'));
        $data['domain_id'] = $domain_id;
        $cart_type = $this->input->post('cart_type');

        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('token', 'token', 'trim|required|xss_clean');
        $this->form_validation->set_rules('domain_id', 'domain_id', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false)));
        }

        //verify domain info
        $verified = $this->domain->verifyDomainInfo($data);
        if (!$verified) {
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false)));
        }

        $data['domain'] = $this->domain->getDomainByID_All($domain_id);

                $this->load->library('payments/Hyperpay_lib');

                $data['success'] = getSystemString(254);

                $request = $this->domain->getCreateRequestByDomainID($domain_id);
                $this->_check_request_validation($request);
                $request_post_data = json_decode($request->DCR_POST_DATA);
                $period = $request_post_data->Period;

                // $period = $data['domain']->Period;

                /* registrations fees */
                $domain_his = $this->domain->getDomainHistory($data['domain']->DH_ID);
                $domain_ltd = json_decode($domain_his->LTD_History);
                $registration_price = $domain_ltd->Register_Price;
                $data['registration_price'] = $registration_price;

                /* vat calculation */
                $website_config = $this->home_model->Get_WebsiteSettings();
                $vat = $website_config[0]->Vat;
                $total_vat = ($vat * $registration_price) / 100;
                $total_vat = number_format((float) $total_vat, 2, '.', '');
                $data['vat'] = $vat;
                $data['total_vat'] = $total_vat;

                /* total to pay */
                $total_price = ($registration_price + $total_vat) * $period;
                $total_price = number_format((float) $total_price, 2, '.', '');
                $data['total_price'] = $total_price;

                /* custumer discount */
                $discount_type = 'register';
                $c_discount = $this->domain->getCustumerDiscount($data['domain']->Customer_ID,$discount_type);
                $discount = 0;
                $discount_details = '';
                if(!empty($c_discount)){

                    // get disscount detiles
                    $c_discount_percentage = $c_discount->d_value;
                    $c_discount_value = ($total_price * ($c_discount_percentage / 100));
                    $data['discount_percentage'] = $c_discount_percentage;
                    $data['discount_value'] = $c_discount_value;
                    $data['discount_value_before_vat'] = number_format((float) ($registration_price * ($c_discount_percentage / 100)), 2, '.', ''); 

                    // calculate vat after discount
                    $total_vat = $total_vat - ($total_vat * ($c_discount_percentage / 100));
                    $total_vat = number_format((float) $total_vat, 2, '.', ''); 
                    $data['total_vat'] = $total_vat;  

                    // calculate total after discount
                    $total_price = $total_price - ($total_price * ($c_discount_percentage / 100));
                    $total_price = number_format((float) $total_price, 2, '.', '');
                    $data['total_price'] = $total_price;

                    $discount = $c_discount_value;
                    $discount_details = $c_discount_percentage;

                }

                $financial_officer = $this->domain->getDomainOrgUsers($domain_id, 'Financial');

                $order_id = $this->_makeUnConfirmedOrder($domain_id, $data['domain']->Customer_ID, $total_price, $vat,$discount,$discount_details,$cart_type,$period);
                $or_id = 'N'.$order_id;
                $customer->Email    = $financial_officer->User_Email;
                $customer->Fullname = $financial_officer->Full_Name;

        $can_add_transaction = false;
        $code = 0;
        if($cart_type == 'WALLET'){
                $customer_id =  $data['domain']->Customer_ID;
                $this->load->library('E_Wallet');  

                $data['current_balance'] = $this->e_wallet->getCustomerWalletBalance($customer_id);

                $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($customer_id,$total_price);
                $data['can_add_transaction'] = $can_add_transaction;      
                
                $payment_referance =  randomNumber(20).'-e-wallet'; ;              
        }else{
            $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price, $or_id, $customer,$cart_type));
            $code = $response->result->code;
            $payment_referance = $response->id; 
        }


                if ($code == '000.200.100' || $cart_type=='WALLET') {

                    $data['customer'] = $customer;
                    $data['checkout_id'] = $payment_referance;
                    $data['cart_type'] = $cart_type;
                    

                    // * Payment Log
                    $log = array(
                        'Customer_ID' => $financial_officer->Org_Usr_ID,
                        'Type' => 'Select Hyperpay payment method',
                        'Response' => json_encode($response),
                    );
                    $this->domain->addAPISLog($log);

                    //update subscription customer payment data
                    $domain_order_up = array(
                        'OR_ID' => $or_id,                                        
                        'Payment_Referance' => $payment_referance,
                        'Request_ID' => $request->DCR_ID,
                        
                    );
                    $where = array('DO_ID' => $order_id);
                    $this->domain->save($domain_order_up, $where, ORDERS);
                    $this->session->set_userdata('Payment_Referance', $payment_referance);

                    $domain__data = ['Domain_Status' => 'PENDING'];
                    $this->domain->save($domain__data, ['Domain_ID' => $domain_id], DOMAIN);


                    $hayperPay_panel= $this->load->view('customer/snippets/hyperpay_panel', $data, TRUE);

                    $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true,'hayperPay_panel'=>$hayperPay_panel)));

                }

            }


    public function process_payment()
    {

        $data['token'] = $this->input->get('to');
        $domain_id = decryptIt($this->input->get('do'));
        $data['domain_id'] = $domain_id;

        $data['do'] = $this->input->get('do');
        $request = $this->domain->getCreateRequestByDomainID($domain_id);
        $this->_check_request_validation($request);

        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('token', 'token', 'trim|required|xss_clean');
        $this->form_validation->set_rules('domain_id', 'domain_id', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgErr', validation_errors());
            redirect(base_url('uncaught_syntax'));
        }

        //verify domain info
        $verified = $this->domain->verifyDomainInfo($data);
        if (!$verified) {
            $this->session->set_flashdata('requestMsg', 46);
            redirect(base_url('uncaught_syntax'));
        }

        $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
        $verify_token = md5($rand);
            //Send verification code to user phone
        $message = 'Pin Code is:' . $rand;
        $upd = array(
                'Verify_Token' => $verify_token,
                'IS_SMS_Sent'  => 1,
        );

        $data['msg'] = 'verify_mobile_title_msg_financial';
        $data['msg_title'] = 'verify_mobile_title_msg_financial_2';
        $data['phone'] = $financial_officer->User_Mobile;
        $data['role'] = 'Financial';

        $app_log = [
                'DAL_Domain_ID' => $domain_id,
                'DAL_User_ID' => $financial_officer->Org_Usr_ID,
                'DAL_Created' => date("Y-m-d H:i:s"),
                'DAL_Type'=>'Contact',

        ];


        $financial_officer = $this->domain->getDomainOrgUsers($domain_id, 'Financial');
        if (!empty($financial_officer) && $financial_officer->Phone_verified == 0) {



        if($financial_officer->Is_SMS_Sent == 0){
            if (sendSMSTo($financial_officer->User_Mobile, $message)) {
                // if(true){
                //$_SESSION['payment_token'] = $data['token'];
                $this->domain->updateDomainUserInfo($financial_officer->Org_Usr_ID, $upd);
                $data['success'] = getSystemString(254);
                $app_log['DAL_Status'] = 'sms_financial_officer';
            } else {
                $data['error'] = getSystemString('error_sms');
                $app_log['DAL_Status'] = 'sms_financial_officer_no';
            }

            $log_id = $this->domain->insert(APP_LOG, $app_log);
        }

            $this->session->set_userdata('intended_url', '');
            $data['url'] = 'process_payment/' . '?do=' . encryptIt($domain_id) . '&to=' . $data['token'];
            $this->session->set_userdata('intended_url', $url);
            $this->LoadView_m('customer/domain_registration/code_verification', $data);        

        } else {
            //check if the selected domain have payment verified to registration
            $is_payed = $this->domain->getRegistrationVerifiedPayment($domain_id);
            $data['is_payed'] = $is_payed;
            $data['domain'] = $this->domain->getDomainByID_All($domain_id);

            if(empty($financial_officer)){
                $financial_officer =  $this->domain->getDomainOrgUsers($domain_id, 'Admin', $reset);
            }

            if (!$is_payed) {

                $this->load->library('payments/Hyperpay_lib');

                $data['success'] = getSystemString(254);
                //$request = $this->domain->get_pending_create_request($domain_id);
                $request_post_data = json_decode($request->DCR_POST_DATA);
                $period = $request_post_data->Period;
                // $period = $data['domain']->Period;
                $data['period'] = $period;

                /* update admin approve flag request */
                $this->domain->approveRequestByAdmin($request->DCR_ID);


                /* registrations fees */
                $domain_his = $this->domain->getDomainHistory($data['domain']->DH_ID);
                $domain_ltd = json_decode($domain_his->LTD_History);
                $registration_price = $domain_ltd->Register_Price;
                $data['registration_price'] = $registration_price;

                /* vat calculation */
                $website_config = $this->home_model->Get_WebsiteSettings();
                $vat = $website_config[0]->Vat;
                $total_vat = ($vat * $registration_price) / 100;
                $total_vat = number_format((float) $total_vat, 2, '.', '');
                $data['vat'] = $vat;
                $data['total_vat'] = $total_vat;

                /* total to pay */
                $total_price = ($registration_price + $total_vat) * $period;
                $total_price = number_format((float) $total_price, 2, '.', '');
                $data['total_price'] = $total_price;


                /* custumer discount */
                $discount_type = 'register';
                $c_discount = $this->domain->getCustumerDiscount($data['domain']->Customer_ID,$discount_type);
                $discount = 0;
                $discount_details = '';
                if(!empty($c_discount)){

                    // get disscount detiles
                    $c_discount_percentage = $c_discount->d_value;
                    $c_discount_value = ($total_price * ($c_discount_percentage / 100));
                    $data['discount_percentage'] = $c_discount_percentage;
                    $data['discount_value'] = $c_discount_value;
                    $data['discount_value_before_vat'] = number_format((float) ($registration_price * ($c_discount_percentage / 100)), 2, '.', '');

                    // calculate vat after discount
                    $total_vat = $total_vat - ($total_vat * ($c_discount_percentage / 100));
                    $total_vat = number_format((float) $total_vat, 2, '.', ''); 
                    $data['total_vat'] = $total_vat;  

                    // calculate total after discount
                    $total_price = $total_price - ($total_price * ($c_discount_percentage / 100));
                    $total_price = number_format((float) $total_price, 2, '.', '');
                    $data['total_price'] = $total_price;

                    $discount = $c_discount_value;
                    $discount_details = $c_discount_percentage;

                }


                $order_id = $this->_makeUnConfirmedOrder($domain_id, $data['domain']->Customer_ID, $total_price, $vat,$discount,$discount_details,'MADA',$period);
                $or_id = 'N'.$order_id;
                $customer->Email    = $financial_officer->User_Email;
                $customer->Fullname = $financial_officer->Full_Name;
                $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price, $or_id, $customer, 'MADA'));


                $customer_id =  $data['domain']->Customer_ID;
                $this->load->library('E_Wallet');  
                $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($customer_id,$total_price);
                $data['can_add_transaction'] = $can_add_transaction; 


                $code = $response->result->code;
                if ($code == '000.200.100') {

                    $data['customer'] = $customer;
                    $data['checkout_id'] = $response->id;

                    // * Payment Log
                    $log = array(
                        'Customer_ID' => $financial_officer->Org_Usr_ID,
                        'Type' => 'Select Hyperpay payment method',
                        'Response' => json_encode($response),
                    );
                    $this->domain->addAPISLog($log);

                    //update subscription customer payment data
                    $domain_order_up = array(
                        'OR_ID' => $or_id,                                        
                        'Payment_Referance' => $response->id,
                        'Request_ID' => $request->DCR_ID,
                    );
                    $where = array('DO_ID' => $order_id);
                    $this->domain->save($domain_order_up, $where, ORDERS);
                    $this->session->set_userdata('Payment_Referance', $response->id);

                    $domain__data = ['Domain_Status' => 'PENDING'];
                    $this->domain->save($domain__data, ['Domain_ID' => $domain_id], DOMAIN);

                }

                $this->LoadView_m('customer/domain_registration/financial_officer_step_1', $data);

            } else {
                $this->LoadView_m('customer/domain_registration/financial_officer_step_2', $data);
            }

        }

        //if domain verified redirect to home

    }

    private function _makeUnConfirmedOrder($domain_id, $customer_id, $totalPrice, $vat,$discount = 0 ,$discount_details ='', $cart_type = 'MADA',$period = 1)
    {
        $data = array(
            'Domain_ID' => $domain_id,
            'Customer_ID' => $customer_id,
            'Total_Price' => $totalPrice,
            'Vat' => $vat,
            'Period' =>$period,
            'Discount_Details' => $discount_details,            
            'Discount' => $discount,
            'Cart_Type' => $cart_type,
            'Created_AT' => date('Y-m-d H:i:s'),
        );
        $order_id = $this->domain->insert(ORDERS, $data);

        return $order_id;
    }

    public function payment_success()
    {

        $this->load->library('payments/Hyperpay_lib');

        $payment_referance = $this->input->GET('id');
        $domain_order_info = $this->domain->getDomainOrderByReferancePayment($payment_referance);
        if (!$domain_order_info) {
            show_404();
            exit();
        }



        $transaction_result = false;
        if (!$domain_order_info->Payment_Verified) {
            $cart_type = $domain_order_info->Cart_Type;
           
            $total_price = $domain_order_info->Total_Price;
            if($cart_type == 'WALLET'){

                /* add wallet transactions*/
                $customer_id =  $domain_order_info->Customer_ID;
                $this->load->library('E_Wallet');
                $transaction_result =  $this->e_wallet->modifyCreditsForCustomers($customer_id,'-',$total_price,'Domain Create',$customer_id,$payment_referance);
                $response_id = $payment_referance;
                $order_id = $domain_order_info->OR_ID;


            }else{
                $response = json_decode($this->hyperpay_lib->VerifyPayment($payment_referance,$cart_type));
                $code = $response->result->code;
                $order_id = $response->merchantTransactionId;
                $response_id = $response->id;
                //verify payment response
                $log = array(
                    'Customer_ID' => $domain_order_info->Customer_ID,
                    'Type' => 'Verify Payment Response',
                    'Response' => json_encode($response),
                );
                $this->domain->addAPISLog($log); 
            }




            if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code) || $transaction_result) {
               
                $type   = 'create_domain';
                $request = $this->domain->getRequestByType($type,$domain_order_info->Domain_ID,'pending');

                $data = array(
                    'HY_ID'=> $response_id,                    
                    'Payment_Verified' => 1,
                    'Payed_AT' => date('Y-m-d H:i:s'),
                    'Request_ID' =>  $request->DCR_ID,
                );
                $where = array('OR_ID' => $order_id);
                $this->domain->save($data, $where, ORDERS);

                $period = $domain_order_info->Period;

                /* make domain status pending when payment success*/
                //$expire_date = date('Y-m-d', strtotime('+'.$period.'year'));
                $domain__data = ['Domain_Status' => 'PENDING'];
                $this->domain->save($domain__data, ['Domain_ID' => $domain_order_info->Domain_ID], DOMAIN);

                $this->session->unset_userdata('Payment_Reference');

                $app_log = [
                    'DAL_Domain_ID' => $domain_order_info->Domain_ID,
                    'DAL_User_ID' => $domain_order_info->Customer_ID,
                    'DAL_Created' => date("Y-m-d H:i:s"),
                    'DAL_Type'=>'Customer',
                ];
                $app_log['DAL_Status'] = 'domain_payed';
                $this->domain->insert(APP_LOG, $app_log);
                $app_log['DAL_Status'] = 'email_invoice';
                $this->domain->insert(APP_LOG, $app_log);
                $app_log['DAL_Status'] = 'admin_officer_approve';
                $this->domain->insert(APP_LOG, $app_log);

                $info_data = [
                    'Domain_Admin_Approved' => 1,
                ];
                $this->domain->save($info_data, ['DINFO_ID' => $domain_order_info->DINFO_ID], INFO);


                $this->_sendOrderEmail($order_id);
            } else {

                $data = array(
                    'Payment_Verified' => 0,
                    'Payed_AT' => date('Y-m-d H:i:s'),
                    'Request_ID' =>  $request->DCR_ID,
                    
                );

                $where = array('OR_ID' => $order_id);
                $this->domain->save($data, $where, ORDERS);
                $this->session->unset_userdata('Payment_Reference');

                $domain__data = ['Domain_Status' => 'PENDING'];
                $this->domain->save($domain__data, ['Domain_ID' => $domain_order_info->Domain_ID], DOMAIN);

            }
        }

        $data['domain_order'] = $this->domain->getDomainOrderByReferancePayment($payment_referance);
        $domain_rigstrar = $this->domain->getDomainRegitrar($domain_order_info->Domain_ID);
        $data['domain'] = $this->domain->getDomainByID_All($domain_order_info->Domain_ID);
        $data['settings'] = $this->home_model->Get_Website_Configuration();
        

        $data['url'] = base_url('process_payment/') . '?do=' . encryptIt($domain_rigstrar->Domain_ID) . '&to=' . $domain_rigstrar->Verify_Page_Token;
        $this->LoadView_m('customer/domain_registration/financial_officer_step_2', $data);

    }



    public function transfer_request()
    {


        $data['id'] = decryptIt($this->input->get('id'));
        $data['c_id'] = $this->input->get('c_id');
        $data['page_token'] = $this->input->get('code');

        $request = $this->domain->getTransferRequest($data);
        $this->_check_transfer_validation($request);
        

        $domain = $request->DTI_Domain_Name . $request->DTI_TLD;

        $auth_code = $request->DTI_Auth_Code;

        // checking if authcode is correct
        $this->load->library('nic/epp_lib');
        $domain_info = $this->epp_lib->domain_info($domain, 0, $auth_code);
        $code = $domain_info[0]['epp']['response']['result']['@attributes']['code'];

        if ($code != '1000') {
            echo 'Domain or Authocode is incorrect';
            die();
        }

        // getting current admin email
        $current_admin_id = 0;
        $contacts = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:contact'];
        foreach ( $contacts as $key => $contact){
                        if($contact['@attributes']['type'] == 'admin'){
                         $current_admin_id =  $contact['_value'];
                        }
        }
        $admin_detiles = $this->epp_lib->contact_info($current_admin_id, 0, $auth_code);
        $admin_phone = $admin_detiles[0]['epp']['response']['extension']['snic:contactInfo']['snic:mobile'];

        $admin_phone = explode('.', $admin_phone);
        $admin_phone = $admin_phone[1];

        $data['customer'] = $this->domain->get_one(['Customer_ID'=>$data['c_id']],'*','customers');

        $data['msg'] = 'verify_mobile_title_msg_admin';
        $data['msg_title'] = 'verify_mobile_title_msg_admin_2';
        $data['phone'] = $admin_phone;
        $data['role'] = 'Admin';

        if(!empty($_SESSION['request_id']) && $_SESSION['request_id'] != $request->DTI__ID) {
            $_SESSION['request_id'] = '';
        }

        if ((!empty($request) && $request->DCR_Phone_Verified == 0)) {
                   
                    if ($request->DCR_IS_SMS_Sent == 0) {

                        $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
                        $verify_token = md5($rand);
                        //Send verification code to user phone
                        $message = 'Pin Code is:' . $rand;
                        $upd = array(
                            'DCR_Verify_Token' => $verify_token,
                            'DCR_IS_SMS_Sent' => 1,
                            'DCR_Phone_Verified' => 0,
                            'Total_SMS_Sent' => $request->Total_SMS_Sent + 1,
                            'Last_SMS_Sent_Date' => date('Y-m-d H:i:s'),
                        );


                        
                        $this->session->set_userdata('intended_url', '');
                                      if (sendSMSTo($admin_phone, $message)) {
                                            //if (true) {
                                                $this->domain->updateTransferRequestInfo($data['id'], $upd);
                                                $data['success'] = getSystemString(254);
                                            } else {
                                                $data['error'] = getSystemString('error_sms');
                                         
                                            }

                                            $this->LoadView_m('site/transfer/mobile_verify_change_request', $data);

                    } else {
                            $this->LoadView_m('site/transfer/mobile_verify_change_request', $data);

                    }


        } else if($_SESSION['request_id'] == $request->DTI__ID) {
                $data['success'] = getSystemString(254);
                $data['requests'] = $this->domain->getTransferRequest($data);
                $data['domain']->Domain_Name = $request->DTI_Domain_Name;
                $data['domain']->TLD = '.' . $request->DTI_TLD;
                 $this->domain->approveRequestByAdmin($request->DCR_ID);


                $this->LoadView_m('site/transfer/approve_change_request_1', $data);
        }else if(empty($_SESSION['request_id'])){
               $this->LoadView_m('site/transfer/mobile_verify_change_request', $data);
        }
        
    }

    /* this request used to verify mobile on change request on domain */
    public function mobile_verify_change_transfer_request()
    {

        $page_token = $this->input->post('page_token');
        $c_id = $this->input->post('c_id');
        $id = decryptIt($this->input->post('id'));


        $url = base_url('transfer_request/') . '?id=' . encryptIt($id) . '&c_id=' . $c_id. '&code=' . $page_token;

        //verify domain data
        $data['page_token'] = $page_token;
        $data['c_id'] = $c_id;
        $data['id'] = $id;
        //$transfer_request = $this->domain->getTransferRequest($data);


        //verify account data
        $verify_code = $this->input->post('code1') . $this->input->post('code2') . $this->input->post('code3') . $this->input->post('code4');
        $verify_code = md5($verify_code);
        $data['verify_code'] = $verify_code;


        $request = $this->domain->getTransferRequest($data);


     
          if (!empty($request) && ($request->DCR_Phone_Verified == 0 || empty($_SESSION['request_id']))) {
            $upd['DCR_Phone_Verified'] = 1;

               $_SESSION['request_id'] = $request->DTI__ID;
               $this->domain->updateTransferRequestInfo($data['id'], $upd);
            if (!empty($request)) {
                $this->session->set_flashdata('requestMsgSucc', 'phoneVerified');
                redirect($url);

            } else {

                 $this->session->set_flashdata('requestMsgErr', 119);
                redirect($url);
            }
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($url);
        }

    }

    private function _check_transfer_validation($request = null){
         if(!($request)){
            $this->session->set_flashdata('requestMsg', 46);
            redirect(base_url('uncaught_syntax'));
        }elseif($request->DTI_Status == 'APPROVED'){
            $this->session->set_flashdata('requestMsg', 'approved_request');
            redirect(base_url('uncaught_syntax'));
        }elseif($request->DTI_Status == 'REJECTED'){
            $this->session->set_flashdata('requestMsg', 'rejected_request');
            redirect(base_url('uncaught_syntax'));
        }elseif($request->DTI_Status == 'CANCELED'){
            $this->session->set_flashdata('requestMsg', 'canceled_request');
            redirect(base_url('uncaught_syntax'));
        }
    }

    private function _check_request_validation($request = null){
         if(!($request)){
            $this->session->set_flashdata('requestMsg', 46);
            redirect(base_url('uncaught_syntax'));
        }elseif($request->DCR_Status == 'approved'){
            $this->session->set_flashdata('requestMsg', 'approved_request');
            redirect(base_url('uncaught_syntax'));
        }elseif($request->DCR_Status == 'refused'){
            $this->session->set_flashdata('requestMsg', 'rejected_request');
            redirect(base_url('uncaught_syntax'));
        }elseif($request->DCR_Status == 'canceled'  || $request->DCR_Status == 'deleted'){
            $this->session->set_flashdata('requestMsg', 'canceled_request');
            redirect(base_url('uncaught_syntax'));
        }
    }



        public function payment_methods_transfer()
    {


        $data['id'] = decryptIt($this->input->post('id'));
        $data['c_id'] = $this->input->post('c_id');
        $data['page_token'] = $this->input->post('page_token');
        $cart_type = $this->input->post('cart_type');
        //$page_token = $data['page_token'];

        $id = $data['id'];
        $c_id = $data['c_id'];
        

        $request = $this->domain->getTransferRequest($data);
        $this->_check_transfer_validation($request);

        $auth_code = $request->DTI_Auth_Code;

        $domain = $request->DTI_Domain_Name . $request->DTI_TLD;

        $data['request'] = $request;
        $data['period'] = 1;



        $this->load->library('payments/Hyperpay_lib');
        $data['success'] = getSystemString(254);
        /* renew fees */
        $tld_info       = $this->domain->getDomainTldsByName($request->DTI_TLD);
        $renew_price = $tld_info->Renew_Price;
        $data['renew_price'] = $renew_price;


        /* vat calculation */
        $website_config = $this->home_model->Get_WebsiteSettings();
        $vat = $website_config[0]->Vat;
        $total_vat = ($vat * $renew_price)/100;
        $total_vat = number_format((float)$total_vat, 2, '.', '');
        $data['vat'] = $vat;
        $data['total_vat'] = $total_vat;

        /* total to pay */
        $total_price = $renew_price + $total_vat;
        $total_price = number_format((float)$total_price, 2, '.', '');
        $data['total_price'] = $total_price;

        /* custumer discount */
        $discount_type = 'transfer';
        $c_discount = $this->domain->getCustumerDiscount($request->DTI_Customer_ID,$discount_type);
        $discount = 0;
        $discount_details = '';

        if(!empty($c_discount)){

            // get disscount detiles
            $c_discount_percentage = $c_discount->d_value;
            $c_discount_value = ($total_price * ($c_discount_percentage / 100));
            $data['discount_percentage'] = $c_discount_percentage;
            $data['discount_value'] = $c_discount_value;
            $data['discount_value_before_vat'] = number_format((float) ($renew_price * ($c_discount_percentage / 100)), 2, '.', '');

            // calculate vat after discount
            $total_vat = $total_vat - ($total_vat * ($c_discount_percentage / 100));
            $total_vat = number_format((float) $total_vat, 2, '.', ''); 
            $data['total_vat'] = $total_vat;  

            // calculate total after discount
            $total_price = $total_price - ($total_price * ($c_discount_percentage / 100));
            $total_price = number_format((float) $total_price, 2, '.', '');
            $data['total_price'] = $total_price;

            $discount = $c_discount_value;
            $discount_details = $c_discount_percentage;

        }

        $order_id = $this->_makeUnConfirmedTransferOrder($id,$c_id,$total_price,$vat,$discount,$discount_details,$cart_type,$data['period']);
        $or_id = 'TRA'.$order_id;
        $customer  = $this->domain->get_one(['Customer_ID'=>$c_id],'*','customers');
        $data['customer'] = $customer;



        $can_add_transaction = false;
        $code = 0;
        if($cart_type == 'WALLET'){
                $customer_id =  $c_id;
                $this->load->library('E_Wallet');  
                $data['current_balance'] = $this->e_wallet->getCustomerWalletBalance($customer_id);
                $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($customer_id,$total_price);
                $data['can_add_transaction'] = $can_add_transaction; 
                     
                $payment_referance =  randomNumber(20).'-e-wallet'; ;              
        }else{
            $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price,$or_id,$customer,$cart_type));
            $code = $response->result->code;
            $payment_referance = $response->id; 
        }


        if($code == '000.200.100' || $cart_type=='WALLET')
          {

          $data['customer']       = $customer;
          $data['checkout_id']    = $payment_referance;
          $data['cart_type'] = $cart_type;


          // * Payment Log
          $log = array(
              'Customer_ID' => $customer_id,
              'Type' => 'Select Hyperpay payment method',
              'Response' => json_encode($response)
          );
          $this->domain->addAPISLog($log);

          //update subscription customer payment data
          $transfer_order['OR_ID'] = $or_id;
          $transfer_order['Payment_Referance'] = $payment_referance;
          $previous_request = $this->domain->getDomainTransferRequestInfo($data['c_id'],$domain);
          $transfer_order['Request_ID'] = $previous_request->DCR_ID;

           $where = array('DTO_ID'=>$order_id);
          $this->domain->save($transfer_order,$where,TRANSFER_ORDERS);
          $this->session->set_userdata('Payment_Referance',$payment_referance);

              $hayperPay_panel= $this->load->view('customer/snippets/hyperpay_panel_transfer', $data, TRUE);
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true,'hayperPay_panel'=>$hayperPay_panel)));

        }else{
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false)));
        }





                    

    }

    public function transfer_approved()
    {

        $data['id'] = decryptIt($this->input->post('id'));
        $data['c_id'] = $this->input->post('c_id');
        $data['page_token'] = $this->input->post('code');

        if(empty($_POST)){
            $data['id'] = decryptIt($this->input->get('id'));
            $data['c_id'] = $this->input->get('c_id');
            $data['page_token'] = $this->input->get('code');        
        }

        $page_token = $data['page_token'];


        $id = $data['id'];
        $c_id = $data['c_id'];
        

        $is_phone_verified = 1;
        $request = $this->domain->getTransferRequest($data,null,$is_phone_verified);
        $this->_check_transfer_validation($request);
        


        $auth_code = $request->DTI_Auth_Code;

        $domain = $request->DTI_Domain_Name . $request->DTI_TLD;

        $transfer_request = $this->domain->getDomainTransferRequestInfo($c_id,$domain,'incomplete');
        $request_update = ['DCR_Admin_Approve'=>1];

        $this->domain->save($request_update, ['DCR_ID' => $transfer_request->DCR_ID], REQUEST);
        //checking if authcode is correct
        $this->load->library('nic/epp_lib');
        $domain_info = $this->epp_lib->domain_info($domain, 0, $auth_code);
        $status = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:status']['@attributes']['s'];
        $url = base_url('transfer_request/') . '?id=' . encryptIt($id) . '&c_id=' . $c_id. '&code=' . $page_token;


        $created_date = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:crDate'];
        $now = time(); // or your date as well
        $your_date = strtotime($created_date);
        $datediff = $now - $your_date;
        $rest_days =  round($datediff / (60 * 60 * 24));

        if($rest_days <= 60){
            $this->session->set_flashdata('requestMsgErr', 'create_date_error');
            redirect($url); 
        }

        if($status == 'inactive'){
            $this->session->set_flashdata('requestMsgErr', 'domain_transfer_inactive_error');
            redirect($url); 

         }



        if($status == 'clientTransferProhibited'){        
            $this->session->set_flashdata('requestMsgErr', 'domain_transfer_client_error');
            redirect($url);           
         }

        if($status == 'pendingTransfer'){
            $this->session->set_flashdata('requestMsgErr', 'domain_transfer_pending_error');
            redirect($url);   
        }



        $data['request'] = $request;
        $data['period'] = 1;



        $this->load->library('payments/Hyperpay_lib');
        $data['success'] = getSystemString(254);
        /* renew fees */
        $tld_info       = $this->domain->getDomainTldsByName($request->DTI_TLD);
        $renew_price = $tld_info->Renew_Price;
        $data['renew_price'] = $renew_price;


        /* vat calculation */
        $website_config = $this->home_model->Get_WebsiteSettings();
        $vat = $website_config[0]->Vat;
        $total_vat = ($vat * $renew_price)/100;
        $total_vat = number_format((float)$total_vat, 2, '.', '');
        $data['vat'] = $vat;
        $data['total_vat'] = $total_vat;

        /* total to pay */
        $total_price = $renew_price + $total_vat;
        $total_price = number_format((float)$total_price, 2, '.', '');
        $data['total_price'] = $total_price;

        /* custumer discount */
        $discount_type = 'transfer';
        $c_discount = $this->domain->getCustumerDiscount($request->DTI_Customer_ID,$discount_type);
        $discount = 0;
        $discount_details = '';

        if(!empty($c_discount)){

            // get disscount detiles
            $c_discount_percentage = $c_discount->d_value;
            $c_discount_value = ($total_price * ($c_discount_percentage / 100));
            $data['discount_percentage'] = $c_discount_percentage;
            $data['discount_value'] = $c_discount_value;
            $data['discount_value_before_vat'] = number_format((float) ($renew_price * ($c_discount_percentage / 100)), 2, '.', '');

            // calculate vat after discount
            $total_vat = $total_vat - ($total_vat * ($c_discount_percentage / 100));
            $total_vat = number_format((float) $total_vat, 2, '.', ''); 
            $data['total_vat'] = $total_vat;  

            // calculate total after discount
            $total_price = $total_price - ($total_price * ($c_discount_percentage / 100));
            $total_price = number_format((float) $total_price, 2, '.', '');
            $data['total_price'] = $total_price;

            
            $discount = $c_discount_value;
            $discount_details = $c_discount_percentage;

        }

        $order_id = $this->_makeUnConfirmedTransferOrder($id,$c_id,$total_price,$vat,$discount,$discount_details,'MADA',$data['period']);
        $or_id = 'TRA'.$order_id;
        $customer  = $this->domain->get_one(['Customer_ID'=>$c_id],'*','customers');
        $data['customer'] = $customer;
        $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price,$or_id,$customer,'MADA'));

        $this->load->library('E_Wallet');
        $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($request->DTI_Customer_ID,$total_price);
        $data['can_add_transaction'] = $can_add_transaction; 

        $code = $response->result->code;
        if($code == '000.200.100')
          {

          $data['customer']       = $customer;
          $data['checkout_id']    = $response->id;

          // * Payment Log
          $log = array(
              'Customer_ID' => $customer_id,
              'Type' => 'Select Hyperpay payment method',
              'Response' => json_encode($response)
          );
          $this->domain->addAPISLog($log);

          //update subscription customer payment data
          $previous_request = $this->domain->getDomainTransferRequestInfo($data['c_id'],$domain);
          $transfer_order = array(
              'OR_ID' => $or_id,                
              'Payment_Referance' => $response->id,
              'Request_ID' => $previous_request->DCR_ID,
          );
           $where = array('DTO_ID'=>$order_id);
          $this->domain->save($transfer_order,$where,TRANSFER_ORDERS);
          $this->session->set_userdata('Payment_Referance',$response->id);

         }
        $this->LoadView_m('site/transfer/domain_transfer_in_payment', $data);




    }


    public function transfer_payment_success(){

        /* send domain transfer request to epp */
        $this->load->library('nic/epp_lib'); 
        $this->load->library('payments/Hyperpay_lib');
        $payment_referance = $this->input->GET('id');
        $transfer_order_info = $this->domain->getTransferOrderByReferancePayment($payment_referance);

        if (!$transfer_order_info) {
            show_404();
            exit();
        }


        $domain_ns = $transfer_order_info->DTI_Domain_Name.$transfer_order_info->DTI_TLD;
        $auth_code = $transfer_order_info->DTI_Auth_Code;

        $transaction_result = false;
        if (!$transfer_order_info->Payment_Verified) {
            $cart_type = $transfer_order_info->Cart_Type;  

            $total_price = $transfer_order_info->Total_Price;
            if($cart_type == 'WALLET'){

                /* add wallet transactions*/
                $customer_id =   $transfer_order_info->Customer_ID;
                $this->load->library('E_Wallet');
                $transaction_result =  $this->e_wallet->modifyCreditsForCustomers($customer_id,'-',$total_price,'Domain Transfer',$customer_id,$payment_referance);
                $response_id = $payment_referance;
                $order_id = $transfer_order_info->OR_ID;


            }else{
                $response = json_decode($this->hyperpay_lib->VerifyPayment($payment_referance,$cart_type));
                $code = $response->result->code;
                $order_id = $response->merchantTransactionId;
                $response_id = $response->id;
                //verify payment response
                $log = array(
                    'Customer_ID' => $transfer_order_info->Customer_ID,
                    'Type' => 'Verify Payment Response',
                    'Response' => json_encode($response),
                );
                $this->domain->addAPISLog($log); 
            }


            $customer_id = $transfer_order_info->Customer_ID;
            $previous_request = $this->domain->getDomainTransferRequestInfo($customer_id,$domain_ns);

            if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code) || $transaction_result) {

                

                $data = array(
                    'HY_ID'=> $response->id,
                    'Payment_Verified' => 1,
                    'DTO_Payed_At' => date('Y-m-d H:i:s'),
                    'Request_ID' => $previous_request->DCR_ID,
                );
                $where = array('OR_ID' => $order_id);
                $this->domain->save($data, $where, TRANSFER_ORDERS);


                /* save contacts info before the transfer request */
                $domain_info = $this->epp_lib->domain_info($domain_ns,0,$auth_code);

                $Info_Data = $domain_info[0]['epp']['response']['resData']['domain:infData'];

                $dns_data =$domain_info[0]['epp']['response']['extension']['secDNS:infData']['secDNS:dsData'];

                $registrant_id = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:registrant'];
                $registrant_details = $this->epp_lib->contact_info($registrant_id, 0, $auth_code);




        $current_admin_id = 0;
        $contacts = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:contact'];
        foreach ( $contacts as $key => $contact){
                        if($contact['@attributes']['type'] == 'admin'){
                            $admin_id = $contact['_value'];
                            $admin_details = $this->epp_lib->contact_info($admin_id, 0, $auth_code);
                        }

                        if($contact['@attributes']['type'] == 'tech'){
                            $tech_id =  $contact['_value'];
                            $tech_details = $this->epp_lib->contact_info($tech_id, 0, $auth_code);
                        }

                        if($contact['@attributes']['type'] == 'billing'){
                            $billing_id =  $contact['_value'];
                            $billing_details = $this->epp_lib->contact_info($billing_id, 0, $auth_code);
                        }
        }


             

                $transfer_data = [
                                    'Registrant_Details'=>json_encode($registrant_details),
                                    'Admin_Details'=>json_encode($admin_details),
                                    'Technical_Details'=>json_encode($tech_details),
                                    'Financial_Details'=>json_encode($billing_details), 
                                    'Info_Data' =>   json_encode($Info_Data),
                                    'DNSSEC_Details' =>  json_encode($dns_data)                                
                                ];                
                $where = array('DTI__ID' => $transfer_order_info->DTI_ID);
                $this->domain->save($transfer_data, $where, TRANSFER);
                /* end contacts info */
            




                $this->session->unset_userdata('Payment_Reference');

                $app_log = [
                    'DAL_Domain_ID' => $transfer_order_info->DTI_ID,
                    'DAL_User_ID' => $transfer_order_info->Customer_ID,
                    'DAL_Created' => date("Y-m-d H:i:s"),
                    'DAL_Type' =>'Customer',
                ];
                $app_log['DAL_Status'] = 'domain_payed';
                $this->domain->insert(APP_LOG, $app_log);
                $app_log['DAL_Status'] = 'email_invoice';
                $this->domain->insert(APP_LOG, $app_log);


                                 
                $responseJSON = $this->epp_lib->domain_transfer($domain_ns,$auth_code);
                $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
                $msg  = $responseJSON[0]['epp']['response']['result']['msg'];

                if($code == '1000' || $code== '1001'){
                    $data['success_msg'] = getSystemString(252);
                }else{
                    $data['success_msg'] = getSystemString('accountDisabled');
                }
         

            
                    if(!empty($previous_request)){
                          $request_update_status = ['DCR_Status' => 'pending'];
                          $this->domain->save($request_update_status, ['DCR_ID' => $previous_request->DCR_ID], REQUEST);
                    }

                    $order_id = $transfer_order_info->DTO_ID;

                $this->_sendTransferOrderEmail($order_id,$transfer_order_info->Email);
            } else {

                $data = array(
                    'Payment_Verified' => 0,
                    'DTO_Payed_At' => date('Y-m-d H:i:s'),
                    'Request_ID' => $previous_request->DCR_ID,
                );

                $where = array('OR_ID' => $order_id);
                $this->domain->save($data, $where, TRANSFER_ORDERS);
                $this->session->unset_userdata('Payment_Reference');

                $transfer_data = array('DTI_Status' => 'PENDING');                
                $where = array('DTI__ID' => $transfer_order_info->DTI_ID);
                $this->domain->save($transfer_data, $where, TRANSFER);



            }
        }

        $transfer_order = $this->domain->getTransferOrderByReferancePayment($payment_referance);
        $data['transfer_order'] = $transfer_order;

        $data['customer'] = $this->domain->get_one(['Customer_ID'=>$transfer_order->Customer_ID],'*','customers');

        $data['url'] = base_url('transfer_request/') . '?id=' . $transfer_order->DTI__ID . '&c_id=' . $transfer_order->Customer_ID. '&code=' . $transfer_order->DCR_Verify_Page_Token;

        $this->LoadView_m('site/transfer/domain_transfer_in_payment_success', $data);


    }

    private function _sendOrderEmail($order_id = 0)
    {
        $order = $this->domain->getOrderDetails($order_id);
        $domain_ns = $order->Domain_Name . $order->TLD;

        $data['order'] = $order;
        $data['website_data'] = $this->home_model->Get_Website_Data();

        $request_post_data = json_decode($order->DCR_POST_DATA);
        $period = $request_post_data->Period;
        $data['period'] = $period;


        if($order->Order_Type == 'registration_domain'){
            $type = getSystemString('register_new_domain');
            $msg =  getSystemString('domain_payed');


        }elseif($order->Order_Type == 'restore'){
            $type = getSystemString('restore');
            $msg =  getSystemString('restore_domain_payed');  

        }elseif($order->Order_Type == 'renew'){
            $type = getSystemString('restore'); 
            $msg =  getSystemString('domain_payed');          
        }
        $data['type'] = $type;
        $data['msg'] =  $msg;


        $data['price_without_vat'] = round($order->Total_Price /(1+($order->Vat/100)),2);
        $data['total_price'] = $order->Total_Price;
        $data['vat'] = $order->Vat;
        $data['total_vat'] = round(($order->Total_Price) - ($order->Total_Price / (1+($order->Vat/100))),2);

        //dd($data);
        $this->load->library('parser');
        $temp_msg = '' . $this->parser->parse('site/includes/email/invoice_status', $data, true);

        //send email
        $options = array(
            'to' => $order->User_Email,
            'subject' => getSystemString('invoice').' #INV'.$order->DO_ID.' | '.$domain_ns,
            'message' => $temp_msg,
        );

        $this->load->helper('utilities_helper');
        return SendEmail($options);
    }

        private function _sendTransferOrderEmail($order_id = 0,$admin_email)
    {
        $order = $this->domain->getTransferDomainOrder($order_id);
        $order->Period = 1;
        $data['order'] = $order;
        $data['website_data'] = $this->home_model->Get_Website_Data();

        $data['type'] = getSystemString('transfer_in');
        $data['msg'] =  getSystemString('domain_payed');  

        $data['price_without_vat'] = round($order->Total_Price /(1+($order->Vat/100)),2);
        $data['total_price'] = $order->Total_Price;
        $data['vat'] = $order->Vat;
        $data['total_vat'] = round(($order->Total_Price) - ($order->Total_Price / (1+($order->Vat/100))),2);

        $this->load->library('parser');
        $temp_msg = '' . $this->parser->parse('site/includes/email/invoice_status', $data, true);

        //send email
        $options = array(
            'to' => $admin_email,
            'subject' => getSystemString('invoice').' #INV'.$order->DO_ID.' dnet.sa',
            'message' => $temp_msg,
        );


        $this->load->helper('utilities_helper');
        return SendEmail($options);
    }


        private function _makeUnConfirmedTransferOrder($dti_id, $customer_id, $totalPrice, $vat,$discount=0,$discount_details='',$cart_type='MADA',$period = 1)
    {
        $data = array(
            'DTI_ID' => $dti_id,
            'Customer_ID' => $customer_id,
            'Total_Price' => $totalPrice,
            'Period'=>$period,
            //'Expire_Date' => date('Y-m-d H-i-s', strtotime('+1 year', time())),
            'Cart_Type' => $cart_type,            
            'Vat' => $vat,
            'Discount_Details' => $discount_details,            
            'Discount' => $discount
        );
        $order_id = $this->domain->insert(TRANSFER_ORDERS, $data);

        return $order_id;
    }

}