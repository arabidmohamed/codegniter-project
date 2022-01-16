<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Require main contoller
require_once APPPATH . 'modules/customer/controllers/Base_Controller.php';

class Domains extends Base_Controller
{

    /* -----------------------------------------------------------
    ---------------------- By Eng. Mohamed Arabid -----------------
    -------------------------------------------------------------- */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('domain_model', 'domain');
        $this->load->model('product_model', 'product');
        date_default_timezone_set('UTC');

        $userid = $this->session->userdata($this->site_session->userid());

        $this->load->library('nic/epp_lib');
        $this->load->library('Cpanel_lib');

    }

    public function index()
    {
        redirect('login');
    }

    public function dashboard()
    {

        $customer_id = $this->session->userdata($this->site_session->userid());

        $current_date = date('Y-m-d');
        $data['pageTitle'] = getSystemString(90);

        $data['num_active_domains'] = $this->domain->getNumOfAciveDomains($customer_id);
        $data['num_uncompleted_orders'] = $this->domain->getNumOfUncompletedOrders($customer_id);
        $data['num_open_tickets'] = $this->domain->getNumOfOpenTickets($customer_id);

        $data['expired_domains'] = $this->domain->getExpiredDomains($customer_id, $current_date);
        $data['upcomming_expired_domains'] = $this->domain->getUpcommingExpiredDomains($customer_id, $current_date);
        
        $data['settings'] = $this->home_model->Get_Website_Configuration();

        $this->LoadView_m('dashboard/dashboard', $data);
    }

        public function wallet()
    {

        $customer_id = $this->session->userdata($this->site_session->userid());

        $this->load->library('E_Wallet');
        $wallet =  $this->e_wallet->getWalletTransactionsByCustomer($customer_id);

            if(!empty($wallet)){

                $data['current_balance'] =  $this->e_wallet->getCustomerWalletBalance($customer_id);
                $data['transactions']    = $wallet;
            }else{
                $data['current_balance'] = 0;
            }


        
        $data['settings'] = $this->home_model->Get_Website_Configuration();

        $this->LoadView_m('dashboard/wallet', $data);
    }

        // pdf method
        public function pdf($order_id,$type)
        {
            $order_id = decryptIt($order_id);
            $customer_id = $this->session->userdata($this->site_session->userid());
            $data['website_config'] = $this->home_model->Get_WebsiteSettings();
        
            $orders_details = $this->domain->getInvoiceDetails($customer_id,$order_id,$type);
            $request        = $this->domain->getRequestByID($orders_details->Request_ID);

            /*this is on case the domain not created yet*/
           if(empty($request) || ($request->DCR_Request_Type == 'domain_transfer_in' && $request->DCR_Status !='approved')){
                 $orders_details = $this->domain->getTransferDomainOrderV2($order_id,$customer_id);
           }

           if(empty($orders_details)){
                  show_404();
                   exit();
           }
            $data['type'] = $type;     
            $data['orders_details'] = $orders_details;
            $data['price_without_vat'] = round($orders_details->Total_Price /(1+($orders_details->Vat/100)),2);
            $data['total_price'] = $orders_details->Total_Price;
            $data['vat'] = $orders_details->Vat;
            $data['total_vat'] =  round(($orders_details->Total_Price) - ($orders_details->Total_Price / (1+($orders_details->Vat/100))),2);
            
            $data['request'] =  $request;

            $this->load->view('snippets/bill', $data);
           

        }



    public function order_details($domain_id, $request_id)
    {
        $domain_id = decryptIt($domain_id);
        $request_id = decryptIt($request_id);
        $customer_id = $this->session->userdata($this->site_session->userid());

        $data['domain_id'] = $domain_id;
        $data['request_id'] = $request_id;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');
        $this->form_validation->set_rules('request_id', 'request_id', 'numeric|trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        $request_details = $this->domain->getRequestInfoByID($domain_id, $request_id, $customer_id);
        if (empty($request_details)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        $domain = $this->domain->getDomainByID_All($domain_id);
        $data['domain_details'] = $domain;

        $transfer_request = $this->domain->getTransferDomainRequest($request_id);
        $data['transfer_details'] = $transfer_request;

    $data['customer'] = $this->customer_model->getCustomerData($customer_id);

     $domain_ns = $domain->Domain_Name.$domain->TLD;
     $order_details = $this->domain->getOrderDetailsByRequestID($request_id);
     $data['order_details'] = $order_details;



        if($domain->Domain_Status == 'REJECTED' || $request_details->DCR_Status == 'need_modification'){
            $log = $this->domain->getAppLogDetailsByDomainID($domain_id,'domain_reject');
            $lang = $this->session->userdata($this->site_session->__lang_h());
            $desc = 'Description_'.$lang;
            $reject_reasons = '';

            $reasons = explode(',',$log->DAL_Fixed_Reasons);

            if(!empty($reasons[0])){
                    foreach ($reasons as $requirment_id){
                                            $requirment = $this->domain->getRequirmentByID($requirment_id);
                                            $reject_reasons .= '<li>'.$requirment->$desc.'</li>';
                                        }
                    }

            if($lang == 'ar'){$reso = $log->DAL_Reason_ar;}else{$reso = $log->DAL_Reason_en;}
            $reject_reasons .= '<li>'.$reso.'</li>'; 

            $data['reject_reasons'] = $reject_reasons;


        }
        $data['request_details'] = $request_details;

        $data['settings'] = $this->home_model->Get_Website_Configuration();

        $this->LoadView_m('dashboard/request_details', $data);

    }

    public function application_details($domain_id)
    {
        $domain_id = decryptIt($domain_id);
        $customer_id = $this->session->userdata($this->site_session->userid());

        $data['domain_id'] = $domain_id;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        $domain = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (empty($domain)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }
        $admin = $this->domain->getDomainOrgUsers($domain_id, 'Admin');

        $data['domain_details'] = $domain;
        $data['admin'] = $admin;

        $this->LoadView_m('dashboard/application_details', $data);

    }

    public function resend_request_email($domain_id, $request_id){

        $domain_id = decryptIt($domain_id);
        $request_id = decryptIt($request_id);
        $customer_id = $this->session->userdata($this->site_session->userid());

        $data['domain_id'] = $domain_id;
        $data['request_id'] = $request_id;

        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');
        $this->form_validation->set_rules('request_id', 'request_id', 'numeric|trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }


        $request = $this->domain->getRequestByID($request_id);
        $num = str_pad($request->DCR_ID, 5, '0', STR_PAD_LEFT);
        $post_data = json_decode($request->DCR_POST_DATA); 
        $domain = $this->domain->getDomainByID($domain_id, $customer_id);
        if (empty($domain) && ($request->DCR_Request_Type != 'domain_transfer_in')) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        $transfer_request = $this->domain->getTransferRequestByRequestID($request_id,$customer_id);

        $type = $request->DCR_Request_Type;
        $verify_page_token = $request->DCR_Verify_Page_Token;
        $domain_ns = $transfer_request->DTI_Domain_Name_Query;
        if(empty($domain_ns)){
            $domain_ns = $domain->Domain_Name.$domain->TLD;
        }

        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
        $data['type'] = getSystemString($type);
        $data['domain'] = $domain;
        $data['url'] = base_url('change_request/') . '?do=' . encryptIt($domain_id) . '&to=' . $verify_page_token;
        $data['website_data'] = $this->home_model->Get_Website_Data();
        $data['DCR_ID'] = $request_id;

        if($request->DCR_Request_Type == 'create_domain'){
            $data['url'] = base_url('admin_officer_verify_domain/') . '?do=' . encryptIt($domain_id) . '&to=' . $verify_page_token;
            $data['type'] = getSystemString('insert_application');
        }

        if($request->DCR_Request_Type == 'domain_transfer_in'){
            $data['domain'] = $transfer_request->DTI_Domain_Name_Query;
            $verify_page_token = $transfer_request->DCR_Verify_Page_Token;
            $data['transfer_request'] = $transfer_request;
            $data['url'] = base_url('transfer_request/') . '?id=' . encryptIt($transfer_request->DTI__ID) . '&c_id=' . $request->DCR_USER_ID. '&code=' . $verify_page_token;
            $data['type'] = getSystemString('domain_transfer_in');
        }

      


        $this->load->library('parser');
        if($request->DCR_Request_Type == 'domain_transfer_in'){
            $message = $this->parser->parse('customer/email-templates/confirm_transfer_domain', $data, true);
            $options = array(
                'to' => $post_data->DTI_Admin_Email,
                'subject' => getSystemString('confirm_domain_transfer').' | #'.$num.' | '.$domain_ns,
                'message' => $message,
            );
        }else{
            $message = $this->parser->parse('email-templates/send_verification_email_to_admin_officer', $data, true);
            $options = array(
                'to' => $admin_officer->User_Email,
                'subject' => getSystemString($type).' | #'.$num.' | '.$domain_ns,
                'message' => $message,
            );
        }


        if (SendEmail($options)) {
            $this->session->set_flashdata('requestMsgSucc', 'success_request');            
        }else{
            $this->session->set_flashdata('requestMsgErr', 119);            
        }

        redirect($this->thisCtrl . "/order_details/".encryptIt($domain_id).'/'.encryptIt($request_id));


    }

    public function cancel_request_customer($domain_id, $request_id)
    {

        $domain_id = decryptIt($domain_id);
        $request_id = decryptIt($request_id);
        $customer_id = $this->session->userdata($this->site_session->userid());

        $data['domain_id'] = $domain_id;
        $data['request_id'] = $request_id;

        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');
        $this->form_validation->set_rules('request_id', 'request_id', 'numeric|trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }


        $request = $this->domain->getRequestByID($request_id);
        $domain = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (empty($domain) && ($request->DCR_Request_Type != 'domain_transfer_in')) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }




        /* set domain status to canceled by the user it self */
        if($request->DCR_Request_Type == 'domain_transfer_in'){

            $post_data = json_decode($request->DCR_POST_DATA); 
            $domain_ns = $post_data->DTI_Domain_Name.$post_data->DTI_TLD; 
            $order = $this->domain->getRequestByDomainNameV2($domain_ns,'PENDING');

            /* set request status to canceled by the user it self by mohamed arabid 03/03/2021*/
            $request_update_status = ['DCR_Status' => 'canceled'];
            $affected_id = $this->domain->save($request_update_status, ['DCR_ID' => $request_id], REQUEST); 

            $transfer_update_status = ['DTI_Status' => 'CANCELED'];
            $affected_id = $this->domain->save($transfer_update_status, ['DTI__ID' => $order->DTI__ID], TRANSFER);        

         
        }elseif($request->DCR_Request_Type != 'transfer_out' && $request->DCR_Request_Type != 'domain_transfer_in' ){
            /* set request status to canceled by the user it self by mohamed arabid 21/01/2021*/
            $request_update_status = ['DCR_Status' => 'canceled'];
            $affected_id = $this->domain->save($request_update_status, ['DCR_ID' => $request_id], REQUEST);

        }elseif($request->DCR_Request_Type =='create_domain'){

            $application_update_status = ['Domain_Status' => 'Canceled'];
            $affected_id = $this->domain->save($application_update_status, ['Domain_ID' => $domain_id], DOMAIN);

            $info_update_status = ['Registrar_Cancel' => 1];
            $affected_id = $this->domain->save($info_update_status, ['Domain_ID' => $domain_id], INFO);

        }elseif($request->DCR_Request_Type == 'transfer_out'){
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
        }else{

            $request_update_status = ['DCR_Status' => 'canceled'];
            $affected_id = $this->domain->save($request_update_status, ['DCR_ID' => $request_id], REQUEST);
        }


        if ($affected_id) {
            $this->session->set_flashdata('requestMsgSucc', 'cancel_request_msg');
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);           
        }

         redirect($this->thisCtrl . "/order_details/".encryptIt($domain_id).'/'.encryptIt($request_id));


    }

    public function cancel_waiver($domain_id,$role="registrant")
    {

        $domain_id = decryptIt($domain_id);
        $customer_id = $this->session->userdata($this->site_session->userid());

        $data['domain_id'] = $domain_id;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        $domain = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        $waiver = $this->domain->get_domain_waiver($customer_id, $domain_id);

        if (empty($waiver)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        /* set domain status to canceled by the user it self by mohamed arabid 21/01/2021*/
        $application_update_status = ['DW_Status' => 'CANCELED'];
        $affected_id = $this->domain->save($application_update_status, ['DW_ID' => $waiver->DW_ID], WAIVERS);


        /* delete request */
         $status = 'pending';
         $type   = 'domain_waiver';
         $new_status = 'canceled';
         $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $status,$new_status);

        $status = ($role == 'registrant')?'reg_wvr_cnl':'adm_wvr_cnl';
        $log = [ 'DAL_Domain_ID'=>$domain_id,'DAL_Type'=>'Customer','DAL_User_ID'=>$customer_id,'DAL_Status'=>$status,'DAL_Created'=>date('Y-m-d H:i:s')];
        $this->domain->insert(APP_LOG, $log);

        if ($affected_id) {
            $this->session->set_flashdata('requestMsgSucc', 'cancel_request_msg');
            redirect($this->thisCtrl . "/my_orders");
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

    }

    public function cancel_applications($domain_id,$role="registrant")
    {

        $domain_id = decryptIt($domain_id);
        $customer_id = $this->session->userdata($this->site_session->userid());

        $data['domain_id'] = $domain_id;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        $domain = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (empty($domain)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        /* set domain status to canceled by the user it self by mohamed arabid 21/01/2021*/
        $application_update_status = ['Domain_Status' => 'Canceled'];
        $affected_id = $this->domain->save($application_update_status, ['Domain_ID' => $domain_id], DOMAIN);

        if($role == 'registrant'){
            $info_update_status = ['Registrar_Cancel' => 1];
            $affected_id = $this->domain->save($info_update_status, ['Domain_ID' => $domain_id], INFO);            
        }

        if($role == 'admin'){
            $info_update_status = ['Admin_Cancel' => 1];
            $affected_id = $this->domain->save($info_update_status, ['Domain_ID' => $domain_id], INFO);
        }

        /* delete request */
        $status = 'incomplete';
        $type   = 'create_domain';
        $new_status = 'canceled';
        $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $status,$new_status);

        $status = ($role == 'registrant')?'registrar_application_canceled':'admin_application_cancel';
        $log_type = ($role == 'registrant')?'Customer':'Contact';
        $log = [ 'DAL_Domain_ID'=>$domain_id,'DAL_Type'=>$log_type,'DAL_User_ID'=>$customer_id,'DAL_Status'=>$status,'DAL_Created'=>date('Y-m-d H:i:s')];
        $this->domain->insert(APP_LOG, $log);


          /*when successfuly save application set session to null*/
          $this->session->set_userdata($this->site_session->tld_id(), '');
          $this->session->set_userdata($this->site_session->domain_name(), '');
          $this->session->set_userdata($this->site_session->domain_id(), '');

        if ($affected_id) {
            $this->session->set_flashdata('requestMsgSucc', 'cancel_request_msg');
            redirect($this->thisCtrl . "/my_orders");
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

    }

    public function checkIfCustomerExist()
    {
        $auth_code = $this->input->post('auth_code');

        $data['auth_code'] = $auth_code;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('auth_code', 'auth code', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/dashboard");
        }

        $customer = $this->domain->getDomainByAuthCode($auth_code);

        if (!empty($customer)) {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => true)));
        } else {
            $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('incorrect_account_number') . "</p>";

            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));
        }

    }

    public function transfer_domain_request($domain_id)
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);

        $auth_code = $this->input->post('auth_code');

        $data['auth_code'] = $auth_code;
        $data['domain_id'] = $domain_id;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');
        $this->form_validation->set_rules('auth_code', 'auth code', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/dashboard");
        }

        $domain = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (empty($domain)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/dashboard");
        }

        /* send email verification to admin */
        $type = 'transfer_inside';
        $this->_send_change_request_to_admin($domain_id, $type);

    }

    public function transfer_domain($domain_id)
    {
        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);

        $domain = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (empty($domain)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/dashboard");
        }

        $data['domain'] = $domain;

        $data['settings'] = $this->home_model->Get_Website_Configuration();

        $this->LoadView_m('domain_registration/transfers/transfer_inside_dnet_request', $data);

    }

    // public function getInfo(){


    //        $transfer_request = $this->domain->getDomainTransferRequest(1,'stars');
    //        $request_update_status = ['DCR_Status' => 'approved','DCR_Domain_ID'=>6,'DCR_Admin_ID'=>'01046226181-dnet'];
    //        $this->domain->save($request_update_status, ['DCR_ID' => $transfer_request->DCR_ID], REQUEST);

    //         dd($transfer_request);

    //   // $domain = 'mohamed.net.sa';

    //   //  $res =  $this->epp_lib->domain_info($domain);

    //   //  //$res  = $res[0]['epp']['response']['resData'];
    //   //  echo '<pre>';
    //   //  print_r($res); exit;
    // }

    /* include domain from outside */
    public function transfer_domain_in()
    {

        /*  get payed transfer in requests */
        $customer_id = $this->session->userdata($this->site_session->userid());        
        $data['requests'] = $this->domain->getAllPayedTransferRequests($customer_id);

        $data['settings'] = $this->home_model->Get_Website_Configuration();
        $metaData['pageTitle'] = getSystemString('domain_transfer_in_log');

        $this->LoadView_m('domain_registration/transfers/transfer_outside_list', $data, $metaData);     

    }

    public function add_domain_record(){

        $output = $this->load->view('customer/domain_registration/transfers/domain_record',$data,true);

        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => true,'result'=>$output)));

    }
        public function transfer_domain_check()
    {
        //$host = $this->input->post('host');
        $host = $this->input->post('domain_name');


        $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString(119) . "</p>";

        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('host', 'host', 'trim|required|xss_clean');

        // if ($this->form_validation->run() == false) {
        //     $this->output
        //         ->set_content_type("application/json")
        //         ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));
        // }

        $beforeDot = array_shift(explode('.', $host));
        $after_dot = substr($host, (strpos($host, '.') ?: -1) + 1);

        $domain_tlds = $this->domain->getDomainTlds();
        $make_check = 0;
        foreach ($domain_tlds as $key => $row) {
            if ($row->TLD_Name == '.' . $after_dot) {
                $make_check = 1;
                break;
            }
        }

        $result = '';
        $result->reason = 'available';
        $code = '2303';
        $msg = '';
        if ($make_check) {

            $responseJSON = $this->epp_lib->domain_check($host);
            $suggested_tlds = $responseJSON[0]['epp']['response']['resData']['domain:chkData']['domain:cd'];
            $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];

            $result->avail = $suggested_tlds['domain:name']['@attributes']['avail'];
            $result->value = $suggested_tlds['domain:name']['_value'];
            $result->reason = $suggested_tlds['domain:reason'];
            $result->domain_name = $host;




            if ($code == '1000') { //in_use
                $msg = "<p class='domain-exists text-center mt-3'> " . getSystemString($result->reason) . "</p>";
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true, 'msg' => '', 'result' => $result)));
            } else {
                $msg = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('name_server_error') . "</p>";
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false, 'msg' => $msg, 'result' => $result)));
            }

        } else {
            $msg = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('name_server_error') . "</p>";
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $msg, 'result' => $result)));
        }


        $auth_code = $this->input->post('auth_code');
        $domain_name_q = $this->input->post('domain_name');
        if(!empty($auth_code) && !empty($domain_name_q)){
            $this->check_if_can_transfer($domain_name_q,$auth_code);
        }

    }

    private function check_if_can_transfer($domain_name_q,$auth_code){

        $customer_id = $this->session->userdata($this->site_session->userid());

        $request = $this->domain->getRequestByDomainNameV2($domain_name_q);


        //checking if authcode is correct
        $responseJSON = $this->epp_lib->domain_info($domain_name_q, 0, $auth_code);
        $status = $responseJSON[0]['epp']['response']['resData']['domain:infData']['domain:status'];
        $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];


        // checking if transfer prohabited
        foreach($status as $s){
            $flag = $s['@attributes']['s'];
            if($flag == 'serverTransferProhibited' || $flag == 'clientTransferProhibited'){
                $this->output->set_content_type('application/json');
                $err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('domain_transfer_lock_error') . "</p>";
                die(json_encode(array('status' => false, 'msg' => $err)));
            }
        }

        // checking if he  is already registred  inside dnet
        $current_reg = $responseJSON[0]['epp']['response']['resData']['domain:infData']['domain:clID'];

        if($current_reg == $this->config->item('EPP_USERNAME')){
            $this->output->set_content_type('application/json');
            $err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('current_registerar_error') . "</p>";
            die(json_encode(array('status' => false, 'msg' => $err)));
        }

        

        // checking if he created less than 60 days
        $created_date = $responseJSON[0]['epp']['response']['resData']['domain:infData']['domain:crDate'];
        $now = time(); // or your date as well
        $your_date = strtotime($created_date);
        $datediff = $now - $your_date;
        $rest_days =  round($datediff / (60 * 60 * 24));

        if($rest_days <= 60){
                 $this->output->set_content_type('application/json');
            $err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('create_date_error') . "</p>";
            die(json_encode(array('status' => false, 'msg' => $err)));
        }

        $last_transfer_date = $responseJSON[0]['epp']['response']['resData']['domain:infData']['domain:trDate'];

        if ($last_transfer_date){

            // checking if he transfared less than 60 days
            $now = time(); // or your date as well
            $your_date = strtotime($last_transfer_date);
            $datediff = $now - $your_date;
            $last_transfer_days =  round($datediff / (60 * 60 * 24));
    
            if($last_transfer_days <= 60){
                     $this->output->set_content_type('application/json');
                $err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('create_transfer_date_error') . "</p>";
                die(json_encode(array('status' => false, 'msg' => $err)));
            }

        }

        // if($status == 'inactive'){
        //     $this->output->set_content_type('application/json');
        //     $err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('domain_transfer_inactive_error') . "</p>";
        //     die(json_encode(array('status' => false, 'msg' => $err)));
        //  }

        if($status == 'pendingTransfer' || !empty($request)){
            $this->output->set_content_type('application/json');
            $err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('domain_transfer_pending_error') . "</p>";
            die(json_encode(array('status' => false, 'msg' => $err)));
        }

        if ($code != '1000') {
            $this->output
                ->set_content_type('application/json');
            //I passed the data to die(). in order to disregard the previous response
            // and get the expected response
            // {'status': false, 'msg': 'Domain or Authocode is incorrect'}
           $err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('domain_transfer_inactive_error') . "</p>";
            die(json_encode(array('status' => false, 'msg' => $err)));
        }

        return $responseJSON;
    }

    public function transfer_domain_in_request()
    {


        if($_POST){

        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_names = $this->input->post('domain_name');
        $codes = $this->input->post('auth_code');



        if(!empty($domain_names) && !empty($codes)){
           //for($i=0; $i<count($domain_name); $i++){
         
            foreach ($domain_names as $key => $domain_name) {                           

            $domain_name_q = $domain_name;
            $auth_code     = $codes[$key];



            if(!empty($domain_name_q) && !empty($auth_code)){

                $responseJSON =  $this->check_if_can_transfer($domain_name_q,$auth_code);
                $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
                // getting current admin email
                //$current_admin_id = $responseJSON[0]['epp']['response']['resData']['domain:infData']['domain:contact'][0]['_value'];
               $current_admin_id = 0;
               $contacts = $responseJSON[0]['epp']['response']['resData']['domain:infData']['domain:contact'];
                foreach ( $contacts as $key => $contact){
                    if($contact['@attributes']['type'] == 'admin'){
                     $current_admin_id =  $contact['_value'];
                    }
                }

                $admin_detiles = $this->epp_lib->contact_info($current_admin_id, 0, $auth_code);
                $admin_email = $admin_detiles[0]['epp']['response']['resData']['contact:infData']['contact:email'];
                //$admin_email = 'm.arabid@dnet.so';
                //$admin_email = 'yaman@dnet.sa';


                $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
                $rand2 = rand(111111, 999999);
                $verify_page_token = urlencode(md5($rand . '' . $rand2));




                $domain_name = array_shift(explode('.', $domain_name_q));
                $tld_name = substr($domain_name_q, (strpos($domain_name_q, '.') ?: -1) + 1);



                $domain_transfer_in_data = [
                    'DTI_Domain_Name' => $domain_name,
                    'DTI_TLD' => '.'.$tld_name,
                    'DTI_Auth_Code' => $auth_code,
                    'DTI_Status' => 'PENDING',
                    'DTI_Domain_Name_Query' => $domain_name_q,
                    'DTI_Customer_ID' => $customer_id,
                    'DTI_Admin_Email' => $admin_email, 
                    'DCR_Verify_Page_Token' => $verify_page_token,           
                    'DTI_Created' => date('Y-m-d H:i:s'),                    
                ];
                $dtn_id = $this->domain->insert(TRANSFER, $domain_transfer_in_data);

                        /*add pending transfer request*/
                                $status = 'incomplete';
                                $type   = 'domain_transfer_in';

                    $previous_requests = $this->domain->getDomainTransferRequest($customer_id,$domain_name_q);
                    if(!empty($previous_requests)){

                        foreach ($previous_requests as $key => $previous_request) {
                           $request_update_status = ['DCR_Status' => 'canceled'];
                          $this->domain->save($request_update_status, ['DCR_ID' => $previous_request->DCR_ID], REQUEST);
                        }
                          
                    }

            $request_data = [
                                            'DCR_Request_Type' => $type,
                                            'DCR_Domain_ID' => 0,
                                            'DCR_USER_ID' => $customer_id,
                                            'DCR_Admin_ID' => 0,
                                            'DCR_Status' => $status,
                                            'DCR_Phone_Verified' => 1,
                                            'DCR_Verify_Page_Token' => $verify_page_token,
                                            'DCR_POST_DATA' => json_encode($domain_transfer_in_data),
                                            'Need_Payment'  => 1,
                    ];
            $request_id = $this->domain->insert(REQUEST, $request_data);

            /* update request id on transfer */
            $new_status = ['Request_ID' => $request_id];
            $this->domain->save($new_status, ['DTI__ID' => $dtn_id], TRANSFER);



                /* send email verification to admin */
               // $this->_send_transfer_request_to_admin($dtn_id);

            }




         }


        $msg = 'success_request';
        $this->session->set_flashdata('requestMsgSucc',$msg); 
        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => true, 'msg' => $msg)));

        }else{
            $err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('domain_transfer_pending_error') . "</p>";
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $err)));
        }

     


    }else{

           $data['settings'] = $this->home_model->Get_Website_Configuration();
           $metaData['pageTitle'] = getSystemString('domain_transfer_in');

           $this->LoadView_m('domain_registration/transfers/transfer_outside_dnet_request', $data, $metaData);
    }


    }




        public function my_domains()
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        // $my_domains = $this->domain->getMyDomains($customer_id);
        // $data['my_domains'] = $my_domains;

        // $data['pages_count'] = (int) ceil(count($this->domain->getMyDomains($customer_id)) / 6);
        // if ( $page > $data['pages_count'] ) {
        //     $page = $data['pages_count'];
        // }
        // $data['domains'] = $this->getDomainsList($page);
        // $data['current_page'] = $page;
        // $data['next_page'] = $page + 1;
        // $data['pre_page'] = $page - 1;
        $data['pageTitle'] = getSystemString('my_domains');

        $data['settings'] = $this->home_model->Get_Website_Configuration();


        $this->LoadView_m('dashboard/my_domains', $data);

    }






    /* end include domain from outside */

    public function my_orders($page = 1)
    {
        $customer_id = $this->session->userdata($this->site_session->userid());
        $data['pageTitle'] = getSystemString(103);

        $data['settings'] = $this->home_model->Get_Website_Configuration();

        $this->LoadView_m('dashboard/my_orders', $data);
    }



        public function my_purchases($page = 1)
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        $data['pageTitle'] = getSystemString('my_purchases');

        $data['settings'] = $this->home_model->Get_Website_Configuration();
        $this->LoadView_m('dashboard/my_purchases', $data);

    }




    public function domain_details($domain_id)
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        $data['domain_info'] = $this->domain->getDomainByID_All($data['domain_details']->Domain_ID);
        
        // Product work starts
        $data['products'] = $this->product->getProductList();
        
        foreach($data['products'] as $row){ // preparing data for if subscription is present for specific domain
            $data['product_info'][$row->Product_ID] = $this->product->getProductByDomain($data['domain_details']->Domain_Name.$data['domain_details']->TLD,$row->Product_ID);
        }
        // Product work ends
        
        $data['countries'] = $this->domain->get_all(null, '*', null, 'countries');

        /*get expire date*/
        // $verified_renew = $this->domain->getRenewVerifiedPayment($domain_id);
        // if (!empty($verified_renew)) {
        //     $last_verified_renew = end($verified_renew);
        //     $expire_date = $last_verified_renew->Expire_Date;
        // } else {
            $expire_date = $data['domain_info']->Expire_Date;
       // }


        
        // check if domain is deleted
        if ($data['domain_info']->Domain_Status == 'PENDING DELETE'){
            $epp_domain_info = $this->epp_lib->domain_info($data['domain_info']->Domain_Name.$data['domain_info']->TLD);
            $status = $epp_domain_info[0]['epp']['response']['resData']['domain:infData']['domain:status'][0]['@attributes']['s'];

            /* allow user to restore domain on the first 30 days of delete date */
            $deleted_at = $data['domain_info']->Deleted_at;            
            if(!empty($deleted_at)){
                    $now = time(); 
                    $your_date = strtotime($deleted_at);
                    $datediff = $now - $your_date;
                    $delete_days =  round($datediff / (60 * 60 * 24));

                    if($status == 'pendingDelete' && $delete_days <= 30){
                        redirect($this->thisCtrl . "/domain_restore/".encryptIt($domain_id));
                     } else {
                           $this->LoadView_m('dashboard/404', $data);
                     } 

            }else{
                  $this->LoadView_m('dashboard/404', $data);                
            }   
        }

        if ($data['domain_info']->Domain_Status == 'DELETED'){
             $this->LoadView_m('dashboard/404', $data);
        }



        $data['expire_date'] = $expire_date;

        $data['domain_registrar'] = $data['domain_info']->Registrar;
        $data['domain_admin'] = $data['domain_info']->Admin;
        $data['domain_technical'] = $data['domain_info']->Technical;
        $data['domain_financial'] = $data['domain_info']->Financial;

        if (empty($data['domain_info']->Technical)) {
            $data['domain_technical'] = $data['domain_info']->Admin;
        }
        if (empty($data['domain_info']->Financial)) {
            $data['domain_financial'] = $data['domain_info']->Admin;
        }

        $data['settings'] = $this->home_model->Get_Website_Configuration();

        $this->LoadView_m('dashboard/domain_details', $data);

    }

/*edit actions */

    public function edit_speech_pdf($domain_id,$lang='ar')
    {

        $data['website_data'] = $this->home_model->Get_Website_Data();
        $data['website_config'] = $this->home_model->Get_WebsiteSettings();
        $data['domain'] = $this->domain->getDomainByID_All($domain_id, 1);

        if($lang == 'ar'){
            $this->load->view('snippets/speech', $data);
        }else{
            $this->load->view('snippets/speech_en', $data);            
        }
        

    }

    public function edit_register_domain($domain_id)
    {
        $domain_id = decryptIt($domain_id);
        
        /* the user can edit the application on case NEW OR NEED MODIFICATION */
        $userid = $this->session->userdata($this->site_session->userid());

        // START check if he can access this domain
        $domain = $this->domain->getApplications($userid, $domain_id);
        $data['domain_details'] = $domain;
        if (!$data['domain_details']) {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        if (!empty($domain_id)) {
            $tld = json_decode($domain[0]->LTD_History);
            $tld_id = $tld->TLD_ID;
            $domain_name = $domain[0]->Domain_Name;
        }


        // $type = 'create_domain';
        // $request = $this->domain->getRequestByType($type,$domain_id,'incomplete');
        $request = $this->domain->getIncompleteCreateRequestByDomainID($domain_id);
        $data['request'] = $request;

        $data['tld_id'] = $tld_id;
        $data['domain_name'] = $domain_name;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('tld_id', 'tld id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('domain_name', 'domain name', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        if (null !== $tld_id && null !== $domain_name) {

            $data['tlds'] = $this->domain->getDomainTlds();
            $data['tld_info'] = $this->domain->getDomainTldsByID($tld_id);

            $request_post_data = json_decode($request->DCR_POST_DATA);
            $period = $request_post_data->Period;
            $data['period'] = $period;

            $vat = 15;
            $register_price = $data['tld_info']->Register_Price;
            $total_vat = ($register_price * $vat) / 100;
            $total_vat = number_format((float) $total_vat, 2, '.', '');
            $registration_price = $register_price + $total_vat;
            $total_price = ($register_price + $total_vat) * $period; 
            $total_price = number_format((float) $total_price, 2, '.', '');
            $data['total_price'] = $total_price;
            $data['registration_price'] = $registration_price;



            $data['activity_types'] = $this->domain->getConstantsByParantID(68);
            $data['countries'] = $this->domain->get_all(null, '*', null, 'countries');

            $data['customer'] = $this->customer_model->getCustomerData($userid);
            $data['domain_name'] = $domain_name;
            $data['tld_id'] = $tld_id;
            $data['tld_name'] = $data['tld_info']->TLD_Name;

            $data['pageTitle'] = getSystemString(100);

            // set domain and tld in session yaman
            $this->session->set_userdata($this->site_session->domain_name(), $domain_name);
            $this->session->set_userdata($this->site_session->tld_id(), $tld_id);

            /* this is for edit */
            if (!empty($domain_id)) {
                $data['domain'] = $this->domain->getDomainByID_All($domain_id);
            }

            $this->LoadView_m('domain_registration/edit_domain/domain_register_step_1', $data);
        }

    }

    public function edit_domain_docs($domain_id)
    {

        $domain_id = decryptIt($domain_id);
        
        $userid = $this->session->userdata($this->site_session->userid());

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $userid);
        if (!$data['domain_details']) {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        if (!empty($domain_id)) {
            $domain = $this->domain->getApplications($userid, $domain_id);
            // if($this->session->userdata($this->site_session->tld_id())){
            //     $tld_id = $this->session->userdata($this->site_session->tld_id());
            // } else {
                $tld = json_decode($domain[0]->LTD_History);
                $tld_id = $tld->TLD_ID;
            //}

            $domain_name = $this->input->post('domain_name');
            if(empty($domain_name)){
                $domain_name = $domain[0]->Domain_Name;
            }

        }

        $customer_id = $userid;

        $primary_server = $this->input->post('primary_server');
        $secondary_server = $this->input->post('secondary_server');

        $server_ips = $this->input->post('server_ips');
        $secondary_servers = $this->input->post('secondary_servers');
        $secondary_servers_ips = $this->input->post('secondary_servers_ips');

        if(!empty($secondary_servers)){

            for($i=0; $i<count($secondary_servers); $i++){
                $ss[] = ['name_server'=>$secondary_servers[$i],'ip'=>$secondary_servers_ips[$i]];
            }
            $secondary_servers = $ss;
        }

        $period = $this->input->post('period')?:1;        


        if (empty($domain_name) || empty($primary_server) || empty($secondary_server)) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        if (!empty($domain_id)) {
            $domain = $this->domain->getDomainByID_All($domain_id);
            $data['domain'] = $domain;
        }
        /* -----------------------------------------------------------
        ---------------------- Oganization info -----------------
        -------------------------------------------------------- */

        $activity_type = $this->input->post('activity_type');
        $entity_name = $this->input->post('entity_name');
        $first_address_org = $this->input->post('first_address_org');
        $second_address_org = $this->input->post('second_address_org');
        $country_org = $this->input->post('country_org');
        $region_org = $this->input->post('region_org');
        $city_org = $this->input->post('city_org');
        $post_code_org = $this->input->post('post_code_org');



        /* -----------------------------------------------------------
        ---------------------- Users info -----------------
        -------------------------------------------------------- */

        $tec_man = $this->input->post('tech-man');
        $eco_man = $this->input->post('eco-man');

        $full_name = $this->input->post('full_name');
        $employer_name = $this->input->post('employer_name');
        $job_title = $this->input->post('job_title');
        $first_address = $this->input->post('first_address');
        $second_address = $this->input->post('second_address');
        $city = $this->input->post('city');
        $country = $this->input->post('country');
        $region = $this->input->post('region');
        $post_code = $this->input->post('post_code');
        $phone = $this->input->post('phone');
        $mobile = $this->input->post('mobile');
        $mobile_key = $this->input->post('mobile_key');        
        $fax = $this->input->post('fax');
        $email = $this->input->post('email');

        $nbr_urs = 0;
        for ($i = 0; $i < count($full_name); $i++) {
            if (!empty($full_name[$i])) {
                $nbr_urs++;
            }
        }

        // var_dump($full_name); exit();

        // echo $nbr_urs; exit();
        //  echo $domain->Admin_ID; exit();

        /* this is for edit */

        $this->db->where('Org_Usr_ID', $domain->Admin_ID)->delete(USERS);
        $this->db->where('Org_Usr_ID', $domain->Technical_ID)->delete(USERS);
        $this->db->where('Org_Usr_ID', $domain->Financial_ID)->delete(USERS);
        $this->db->where('Org_Usr_ID', $domain->Registrar_ID)->delete(USERS);

        $customer__data = $this->domain->get_one(['Customer_ID' => $customer_id], '*', 'customers');
        $registrant_epp_id = randomNumber(10).'0-dnet';
        $registrar_data = [
            'Epp_ID' => $registrant_epp_id,            
            'Full_Name' => $entity_name,
            'Employer_Name' => $entity_name,
            'User_Job_Title' => $job_title[0],
            'User_Country_ID' => $country_org,
            'User_Region' => $region_org,
            'User_City' => $city_org,
            'User_Post_Code' => $post_code_org,
            'User_Fax' => $fax[0],
            'User_Phone' => $phone[0],
            'User_Email' => $email[0],
            'Mobile_Key' => $mobile_key[0], 
            'User_Mobile' => $mobile[0],
            'User_Address1' => $first_address_org,
            'User_Address2' => $second_address_org,
        ];

        $registrar_id = $this->domain->insert(USERS, $registrar_data);
        $registrar_id = $registrant_epp_id;

        if ($nbr_urs == 1) {
            $admin_epp_id = randomNumber(10).'1-dnet';            
            $users_domain_data = [
                'Epp_ID' => $admin_epp_id,                                
                'Full_Name' => $full_name[0],
                'Employer_Name' => $employer_name[0],
                'User_Job_Title' => $job_title[0],
                'User_Country_ID' => $country[0],
                'User_Region' => $region[0],
                'User_City' => $city[0],
                'User_Post_Code' => $post_code[0],
                'User_Fax' => $fax[0],
                'User_Phone' => $phone[0],
                'User_Email' => $email[0],
                'User_Mobile' => $mobile[0],
                'Mobile_Key' => $mobile_key[0],
                'User_Address1' => $first_address[0],
                'User_Address2' => $second_address[0],
            ];

            $admin_id = $this->domain->insert(USERS, $users_domain_data);
            $admin_id = $admin_epp_id;
            $finantial_id = $admin_id;
            $technical_id = $admin_id;
        }
        if ($nbr_urs == 2) {
            $admin_epp_id = randomNumber(10).'1-dnet';                        
            $users_domain_data = [
                'Epp_ID' => $admin_epp_id,
                'Full_Name' => $full_name[0],
                'Employer_Name' => $employer_name[0],
                'User_Job_Title' => $job_title[0],
                'User_Country_ID' => $country[0],
                'User_Region' => $region[0],
                'User_City' => $city[0],
                'User_Post_Code' => $post_code[0],
                'User_Fax' => $fax[0],
                'User_Phone' => $phone[0],
                'User_Email' => $email[0],
                'User_Mobile' => $mobile[0],
                'Mobile_Key' => $mobile_key[0],
                'User_Address1' => $first_address[0],
                'User_Address2' => $second_address[0],
            ];

            $admin_id = $this->domain->insert(USERS, $users_domain_data);
            $admin_id = $admin_epp_id;

            if ($tec_man) {
                $tech_epp_id = randomNumber(10).'2-dnet';                
                $users_domain_data = [
                    'Epp_ID' => $tech_epp_id,                    
                    'Full_Name' => $full_name[1],
                    'Employer_Name' => $employer_name[1],
                    'User_Job_Title' => $job_title[1],
                    'User_Country_ID' => $country[1],
                    'User_Region' => $region[1],
                    'User_City' => $city[1],
                    'User_Post_Code' => $post_code[1],
                    'User_Fax' => $fax[1],
                    'User_Phone' => $phone[1],
                    'User_Email' => $email[1],
                    'User_Mobile' => $mobile[1],
                    'Mobile_Key' => $mobile_key[1],
                    'User_Address1' => $first_address[1],
                    'User_Address2' => $second_address[1],
                ];

                $technical_id = $this->domain->insert(USERS, $users_domain_data);
                $technical_id = $tech_epp_id;

                $technical_id = $technical_id;
                $finantial_id = $admin_id;
            }

            if ($eco_man) {
                $billing_epp_id = randomNumber(10).'3-dnet';
                $users_domain_data = [
                    'Epp_ID' => $billing_epp_id,                                        
                    'Full_Name' => $full_name[2],
                    'Employer_Name' => $employer_name[2],
                    'User_Job_Title' => $job_title[2],
                    'User_Country_ID' => $country[2],
                    'User_Region' => $region[2],
                    'User_City' => $city[2],
                    'User_Post_Code' => $post_code[2],
                    'User_Fax' => $fax[2],
                    'User_Phone' => $phone[2],
                    'User_Email' => $email[2],
                    'User_Mobile' => $mobile[2],
                    'Mobile_Key' => $mobile_key[2],
                    'User_Address1' => $first_address[2],
                    'User_Address2' => $second_address[2],
                ];

                $finantial_id = $this->domain->insert(USERS, $users_domain_data);
                $finantial_id = $billing_epp_id;

                $technical_id = $admin_id;
                $finantial_id = $finantial_id;
            }

        }
        if ($nbr_urs == 3) {
            $admin_epp_id = randomNumber(10).'1-dnet';                                    
            $users_domain_data = [
                'Epp_ID' => $admin_epp_id,                
                'Full_Name' => $full_name[0],
                'Employer_Name' => $employer_name[0],
                'User_Job_Title' => $job_title[0],
                'User_Country_ID' => $country[0],
                'User_Region' => $region[0],
                'User_City' => $city[0],
                'User_Post_Code' => $post_code[0],
                'User_Fax' => $fax[0],
                'User_Phone' => $phone[0],
                'User_Email' => $email[0],
                'User_Mobile' => $mobile[0],
                'Mobile_Key' => $mobile_key[0],
                'User_Address1' => $first_address[0],
                'User_Address2' => $second_address[0],
            ];

            $admin_id = $this->domain->insert(USERS, $users_domain_data);
            $admin_id = $admin_epp_id;

            $tech_epp_id = randomNumber(10).'2-dnet';                            
            $users_domain_data = [
                'Epp_ID' => $tech_epp_id,                                    
                'Full_Name' => $full_name[1],
                'Employer_Name' => $employer_name[1],
                'User_Job_Title' => $job_title[1],
                'User_Country_ID' => $country[1],
                'User_Region' => $region[1],
                'User_City' => $city[1],
                'User_Post_Code' => $post_code[1],
                'User_Fax' => $fax[1],
                'User_Phone' => $phone[1],
                'User_Email' => $email[1],
                'User_Mobile' => $mobile[1],
                'Mobile_Key' => $mobile_key[1],
                'User_Address1' => $first_address[1],
                'User_Address2' => $second_address[1],
            ];

            $technical_id = $this->domain->insert(USERS, $users_domain_data);
            $technical_id = $tech_epp_id;

            $billing_epp_id = randomNumber(10).'3-dnet';            
            $users_domain_data = [
                'Epp_ID' => $billing_epp_id,                                                       
                'Full_Name' => $full_name[2],
                'Employer_Name' => $employer_name[2],
                'User_Job_Title' => $job_title[2],
                'User_Country_ID' => $country[2],
                'User_Region' => $region[2],
                'User_City' => $city[2],
                'User_Post_Code' => $post_code[2],
                'User_Fax' => $fax[2],
                'User_Phone' => $phone[2],
                'User_Email' => $email[2],
                'User_Mobile' => $mobile[2],
                'Mobile_Key' => $mobile_key[2],
                'User_Address1' => $first_address[2],
                'User_Address2' => $second_address[2],
            ];

            $finantial_id = $this->domain->insert(USERS, $users_domain_data);
            $finantial_id = $billing_epp_id;

        }

        /* -----------------------------------------------------------
        ----------------------Domain -----------------
        -------------------------------------------------------- */
        $tld_info = $this->domain->getDomainTldsByID($tld_id);

        $domain_data = ['Customer_ID' => $customer_id,
            'Domain_Name' => $domain_name,
            'TLD' => $tld_info->TLD_Name,
            'Primary_Server' => $primary_server,
            'Secondery_Server' => $secondary_server,
            'Secondary_Servers' => json_encode($secondary_servers),
            'Server_ips' => json_encode($server_ips),

        ];

        if (empty($domain_id)) {
            $domain_id = $this->domain->insert(DOMAIN, $domain_data);
            // $this->session->set_userdata($this->site_session->domain_id(), $domain_id);

        } else {
            $this->domain->save($domain_data, ['Domain_ID' => $domain->Domain_ID], DOMAIN);
        }

        /* -----------------------------------------------------------
        ----------------------Domain info -----------------
        -------------------------------------------------------- */
        $domain_info = $this->domain->getDomainInfo($domain_id);
        $domain_info_data = [
            'Domain_ID' => $domain_id,
            'Admin_ID' => $admin_id,
            'Technical_ID' => $technical_id,
            'Financial_ID' => $finantial_id,
            'Registrar_ID' => $registrar_id,
            'Org_Activity_ID' => $activity_type,
        ];

        if (empty($domain_info)) {
            $DINFO_ID = $this->domain->insert(INFO, $domain_info_data);
        } else {
            $this->domain->save($domain_info_data, ['DINFO_ID' => $domain->DINFO_ID], INFO);
        }


        $request = $this->domain->getIncompleteCreateRequestByDomainID($domain_id);


    if($request->DCR_Status !='need_modification'){ /* dont make new request on casr need modification* /
        /* add create domain request */

        $domain_info_data['Period'] = $period;
        $status = 'incomplete';
        $type   = 'create_domain';
        $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $status);
        $request_data = [
                    'DCR_Request_Type' => $type,
                    'DCR_Domain_ID' => $domain_id,
                    'DCR_USER_ID' => $customer_id,
                    'DCR_Admin_ID' => $admin_id,
                    'DCR_Status' => $status,
                    'DCR_Phone_Verified' => 1,
                    'DCR_Verify_Page_Token' => $customer__data->Verify_Page_Token,
                    'DCR_POST_DATA' => json_encode($domain_info_data),
                    'Need_Payment'  => 1,
                ];
        $request_id = $this->domain->insert(REQUEST, $request_data);
    }

        /* -----------------------------------------------------------
        ----------------------Domain history -----------------
        -------------------------------------------------------- */
        //insert domain history

        $history_data = [
            'Customer_ID' => $customer_id,
            'Domain_ID' => $domain_id,
            'Domain_Name' => $domain_name,
            'TLD' => $tld_info->TLD_Name,
            //'Period' => $period,
            'Primary_Server' => $primary_server,
            'Secondery_Server' => $secondary_server,
            'LTD_History' => json_encode($tld_info),
            'ORG_History' => json_encode($registrar_data),
            'INFO_History' => json_encode($domain_info_data),
        ];

        //insert domain history
        $dh_id = $this->domain->insert(DOMAIN_HIS, $history_data);
        $this->domain->save(['DH_ID' => $dh_id], ['Domain_ID' => $domain_id], DOMAIN);

        /* -----------------------------------------------------------
        ----------------------APP LOG -----------------
        -------------------------------------------------------- */
        $domain_data = [
            'DAL_Domain_ID' => $domain_id,
            'DAL_User_ID' => $customer_id,
            'DAL_Status' => (!empty($DINFO_ID)) ? 'insert_application' : 'update_application',
            'DAL_Created' => date("Y-m-d H:i:s"),
            'DAL_Type'=>'Customer',
        ];
        // insert data
        $log_id = $this->domain->insert(APP_LOG, $domain_data);

        $data['doc_types'] = $this->domain->getAllDocsType();
        $data['doc_issures'] = $this->domain->getAllIssuers();

        if (!empty($domain_id)) {
            $domain = $this->domain->getDomainByID_All($domain_id);

            /* if selected date meladi change the format to be display by the date picker */
            $doc_date = $domain->Docs->support->Doc_Date;
            $orderdate = explode('-', $doc_date);
            $year   = $orderdate[0];
            $data['is_hejri'] = TRUE;
            if($year >= 2000){
                $domain->Docs->support->Doc_Date = date('d-m-Y',strtotime($domain->Docs->support->Doc_Date));
                $data['is_hejri'] = FALSE;
            }
            /* end */

            $data['domain'] = $domain;
        }
        
        $data['domain_id'] = $domain_id;
        $this->LoadView_m('domain_registration/edit_domain/domain_register_step_2', $data);

    }

    public function edit_domain_review($domain_id)
    {

        $domain_id = decryptIt($domain_id);
        
        $customer_id = $this->session->userdata($this->site_session->userid());

        // START check if he can access this domain yaman
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details']) {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        //support_file
        $doc_number = $this->input->post('doc_number');
        $doc_date = $this->input->post('doc_date');
        $doc_title = $this->input->post('doc_title');
        $doc_type = $this->input->post('document-type');
        $relation = $this->input->post('relation_between_registrar');
        //$hijri_date = $this->input->post('hijri_date');
        //$meladi_date = $this->input->post('meladi_date');

        /* get hijri and meladi date */
        $doc_date     = date('Y-m-d',strtotime($doc_date));
        $orderdate = explode('-', $doc_date);
        $year   = $orderdate[0];
        $month  = $orderdate[1];
        $day    = $orderdate[2];

        if($year < 2000){
                $hijri_date      = $this->input->post('doc_date');
                $meladi_date     = Hijri2Greg($day, $month, $year);
                $meladi_date     = $meladi_date['year'].'-'.$meladi_date['month'].'-'.$meladi_date['day'];

        } else {
                $hijri_date      = Greg2Hijri($day, $month, $year);
                $hijri_date      = $hijri_date['year'].'-'.$hijri_date['month'].'-'.$hijri_date['day'];               
                $meladi_date     = $this->input->post('doc_date');
        }
        $meladi_date     = date('Y-m-d',strtotime($meladi_date));
        /* end */

        $config['upload_path'] = $GLOBALS['domain_doc_dir'];
        $config['allowed_types'] = 'jpeg|png|pdf|bmp';
        $config['max_size'] = '40000';
        $config['overwrite'] = true;
        $this->load->library('upload', $config);

        // $domain_id =  $this->session->userdata($this->site_session->domain_id());
        //  $this->db->where('Domain_ID',$domain_id)->delete(DOCUMENT);
        $data['domain_id'] = $domain_id;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'tld id', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');

            redirect($this->thisCtrl . "/my_orders");
        }

        $update_info = [
            // 'Step'=>2,
            'Relation_Between' => $relation,
        ];
        $this->domain->save($update_info, ['Domain_ID' => $domain_id], INFO);

        $domain = $this->domain->getDomainByID_All($domain_id);

            $doc_info = $this->domain->getDocsTypeByID($doc_type);
            $issures_id = $doc_info->Issuer_ID;
            $doc_code = $doc_info->Code;

            if($doc_info->Issuer_ID == 0){
                $issures_id = $this->input->post('issures_id');
                $issuer = $this->domain->getIssuersByID($issures_id);
                $data['issuer'] = $issuer;
                $doc_code = $issuer->Code;
            }

        if(!empty($domain->Docs->support)){
              $update_support_doc = [
                    'Domain_ID' => $domain_id,
                    'Doc_Title' => $doc_title,
                    'Doc_Type_ID' => $doc_type,
                    'Doc_Code' => $doc_code,
                    'Doc_Issures_ID'=> $issures_id,
                    'Doc_Num' => $doc_number,
                    'Doc_Date' => $doc_date,
                    'Hijri_Date' => $hijri_date,
                    'Meladi_Date' => $meladi_date,
                ];

                $where = array('Domain_Doc_ID' => $domain->Docs->support->Domain_Doc_ID);
                $this->domain->save($update_support_doc, $where, DOCUMENT);
        }

        if (isset($_FILES['speech_file']) && !empty($_FILES['speech_file']['name'])) {

            if (!$this->upload->do_upload("speech_file")) {

                $upload_error = $this->upload->display_errors();
                $this->session->set_flashdata('requestMsgErr', $upload_error);
                redirect($this->thisCtrl . "/edit_register_domain/".encryptIt($domain_id));


            } else {
                $uploadedFileData = $this->upload->data();
                $speech_file = md5(time()) . 'speech_file' . $uploadedFileData['file_ext'];
                rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $speech_file);

                $speech_doc = [
                    'Domain_ID' => $domain_id,
                    'Doc_Title' => 'speech',
                    'Doc_Type' => 'speech',
                    'Doc_Path' => $speech_file,
                ];

                $this->domain->insert(DOCUMENT, $speech_doc);

            }

        }

        if (isset($_FILES['additional_file']) && !empty($_FILES['additional_file']['name'])) {

            if (!$this->upload->do_upload("additional_file")) {

                $upload_error = $this->upload->display_errors();
                $this->session->set_flashdata('requestMsgErr', $upload_error);
                redirect($this->thisCtrl . "/edit_register_domain/".encryptIt($domain_id));
                

            } else {
                $uploadedFileData = $this->upload->data();
                $additional_file = md5(time()) . 'additional_file' . $uploadedFileData['file_ext'];
                rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $additional_file);

                //additional_file
                $additional_doc = [
                    'Domain_ID' => $domain_id,
                    'Doc_Title' => 'additional',
                    'Doc_Type' => 'additional',
                    'Doc_Path' => $additional_file,
                ];
                $this->domain->insert(DOCUMENT, $additional_doc);

            }

        }

        if (isset($_FILES['support_file']) && !empty($_FILES['support_file']['name'])) {

            if (!$this->upload->do_upload("support_file")) {

                $upload_error = $this->upload->display_errors();
                $this->session->set_flashdata('requestMsgErr', $upload_error);
                redirect($this->thisCtrl . "/edit_register_domain/".encryptIt($domain_id));
                
            } else {
                $uploadedFileData = $this->upload->data();
                $support_file = md5(time()) . 'support_file' . $uploadedFileData['file_ext'];
                rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $support_file);

                //speech_file

                $support_doc = [
                    'Domain_ID' => $domain_id,
                    'Doc_Title' => $doc_title,
                    'Doc_Type' => 'support',
                    'Doc_Type_ID' => $doc_type,
                    'Doc_Code' => $doc_code,
                    'Doc_Issures_ID'=> $issures_id,
                    'Doc_Num' => $doc_number,
                    'Doc_Date' => $doc_date,
                    'Doc_Path' => $support_file,
                    'Hijri_Date' => $hijri_date,
                    'Meladi_Date' => $meladi_date,
                ];

                $this->domain->insert(DOCUMENT, $support_doc);

            }

        }

        //here we should update domain with step and relation between
        $data['domain'] = $this->domain->getDomainByID_All($domain_id);

        $request = $this->domain->getIncompleteCreateRequestByDomainID($domain_id);
        $data['request'] = $request;

        $this->LoadView_m('domain_registration/edit_domain/domain_register_step_3', $data);

    }

    public function edit_send_app_admin($domain_id)
    {

        $domain_id = decryptIt($domain_id);
        $userid = $this->session->userdata($this->site_session->userid());
        $customer = $this->customer_model->getCustomerData($userid);
        $customer = $customer[0];

        // START check if he can access this domain yaman
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $userid);
        if (!$data['domain_details']) {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
        $data['admin_officer'] = $admin_officer;

        //if app email send redirect to home
        $is_email_sent = $this->domain->getAppLogByDomainID($domain_id, 'admin_officer_email');

        $domain = $this->domain->getDomainByID($domain_id);
        $data['domain'] = $domain;

        $request = $this->domain->getIncompleteCreateRequestByDomainID($domain_id);


        if (!$is_email_sent || $request->DCR_Status =='need_modification') {
            // send verify domain email to admin officer
            
            $data['url'] = base_url('admin_officer_verify_domain/') . '?do=' . encryptIt($domain_id) . '&to=' . $customer->Verify_Page_Token;
            $data['type'] =  getSystemString('update_application');

            $info_data = [
                'Domain_Term_Approved' => 1,
            ];
            $this->domain->save($info_data, ['DINFO_ID' => $domain->DINFO_ID], INFO);


            //terms logs
            $domain_data = [
                'DAL_Domain_ID' => $domain_id,
                'DAL_User_ID' => $userid,
                'DAL_Status' => 'registrar_term_approve',
                'DAL_Created' => date("Y-m-d H:i:s"),
                'DAL_Type'=>'Customer',
            ];
            $log_id = $this->domain->insert(APP_LOG, $domain_data);


            // $status = 'incomplete';
            // $type   = 'create_domain';
            // $new_status = 'pending';
            // $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $status,$new_status);

            // //echo $data['url']; exit();
            // /* get request details */
            // $request = $this->domain->getRequestByType($type,$domain_id,'pending');
            $data['DCR_ID'] = $request->DCR_ID;
            $num = str_pad($request->DCR_ID, 5, '0', STR_PAD_LEFT);
            $domain_ns = $domain->Domain_Name . $domain->TLD;

            $this->load->library('parser');
            $message = '' . $this->parser->parse('email-templates/send_verification_email_to_admin_officer', $data, true);

            // echo $message; exit();
            $options = array(
                'to' => $admin_officer->User_Email,
                'subject' => getSystemString('email_verify_subject').' | #'.$num.' | '.$domain_ns,
                'message' => $message,
            );
            if (SendEmail($options)) {
                //domains logs
                $domain_data = [
                    'DAL_Domain_ID' => $domain_id,
                    'DAL_User_ID' => $admin_officer->Org_Usr_ID,
                    'DAL_Status' => 'admin_officer_email',
                    'DAL_Created' => date("Y-m-d H:i:s"),
                    'DAL_Type'=>'Contact',
                ];
                $log_id = $this->domain->insert(APP_LOG, $domain_data);



                $info_data = ['DCR_Status' => 'pending'];
                $this->domain->save($info_data, ['DCR_ID' => $request->DCR_ID], REQUEST);

                /*when successfuly save application set session to null*/
                $this->session->set_userdata($this->site_session->tld_id(), '');
                $this->session->set_userdata($this->site_session->domain_name(), '');
                $this->session->set_userdata($this->site_session->domain_id(), '');

            }
        }

        $this->LoadView_m('domain_registration/edit_domain/domain_register_step_4', $data);

    }

/* end edit actions */

    public function register_domain()
    {

        $userid = $this->session->userdata($this->site_session->userid());
        $tld_id = $this->session->userdata($this->site_session->tld_id());
        $domain_name = $this->session->userdata($this->site_session->domain_name());

        $domain_id = $this->session->userdata($this->site_session->domain_id());

        $data['tld_id'] = $tld_id;
        $data['domain_name'] = $domain_name;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('tld_id', 'tld id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('domain_name', 'domain name', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        if (null !== $tld_id && null !== $domain_name) {

            $data['tlds'] = $this->domain->getDomainTlds();
            $data['tld_info'] = $this->domain->getDomainTldsByID($tld_id);
            $type   = 'create_domain';
            $request = $this->domain->getRequestByType($type,$domain_id,'incomplete');
            if(!empty($request)){
                $request_post_data = json_decode($request->DCR_POST_DATA);
                $period = $request_post_data->Period;
                $data['period'] = $period;
            }else{
                $period = 1;
            }


            $vat = 15;
            $register_price = $data['tld_info']->Register_Price;
            $total_vat = ($register_price * $vat) / 100;
            $total_vat = number_format((float) $total_vat, 2, '.', '');
            $registration_price = $register_price + $total_vat;
            $total_price = ($register_price + $total_vat); 
            $total_price = number_format((float) $total_price, 2, '.', '');
            $data['total_price'] = $total_price  * $period;
            $data['registration_price'] = $registration_price;


            $data['activity_types'] = $this->domain->getConstantsByParantID(68);
            $data['countries'] = $this->domain->get_all(null, '*', null, 'countries');

            $data['customer'] = $this->customer_model->getCustomerData($userid);
            $data['domain_name'] = $domain_name;
            $data['tld_id'] = $tld_id;
            $data['tld_name'] = $data['tld_info']->TLD_Name;

            $data['pageTitle'] = getSystemString('domain_registration_request_form');

            /* this is for edit */
            if (!empty($domain_id)) {
                $data['domain'] = $this->domain->getDomainByID_All($domain_id);
            }
            //  var_dump($data['domain']); exit();

            $this->LoadView_m('domain_registration/domain_register_step_1', $data);
        }

    }

    public function domain_docs()
    {

        $userid = $this->session->userdata($this->site_session->userid());

        $tld_id = $this->session->userdata($this->site_session->tld_id());
        $domain_name = strtolower($this->session->userdata($this->site_session->domain_name()));
        $customer_id = $this->session->userdata($this->site_session->userid());

        $primary_server = $this->input->post('primary_server');
        $secondary_server = $this->input->post('secondary_server');
        $period = $this->input->post('period')?:1;


        $domain_id = $this->session->userdata($this->site_session->domain_id());

        if (empty($domain_name) || empty($primary_server) || empty($secondary_server)) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        if (!empty($domain_id)) {
            $domain = $this->domain->getDomainByID_All($domain_id);
            $data['domain'] = $domain;
        }

        $server_ips = $this->input->post('server_ips');        
        $secondary_servers = $this->input->post('secondary_servers');
        $secondary_servers_ips = $this->input->post('secondary_servers_ips');

        if(!empty($secondary_servers)){

            for($i=0; $i<count($secondary_servers); $i++){
                $ss[] = ['name_server'=>$secondary_servers[$i],'ip'=>$secondary_servers_ips[$i]];
            }
            $secondary_servers = $ss;
        }


        /* -----------------------------------------------------------
        ---------------------- Oganization info -----------------
        -------------------------------------------------------- */ 


        $activity_type = $this->input->post('activity_type');
        $entity_name = $this->input->post('entity_name');
        $first_address_org = $this->input->post('first_address_org');
        $second_address_org = $this->input->post('second_address_org');
        $country_org = $this->input->post('country_org');
        $region_org = $this->input->post('region_org');
        $city_org = $this->input->post('city_org');
        $post_code_org = $this->input->post('post_code_org');



        /* -----------------------------------------------------------
        ---------------------- Users info -----------------
        -------------------------------------------------------- */

        $tec_man = $this->input->post('tech-man');
        $eco_man = $this->input->post('eco-man');

        $full_name = $this->input->post('full_name');
        $employer_name = $this->input->post('employer_name');
        $job_title = $this->input->post('job_title');
        $first_address = $this->input->post('first_address');
        $second_address = $this->input->post('second_address');
        $city = $this->input->post('city');
        $country = $this->input->post('country');
        $region = $this->input->post('region');
        $post_code = $this->input->post('post_code');
        $phone = $this->input->post('phone');
        $mobile = $this->input->post('mobile');
        $mobile_key = $this->input->post('mobile_key');                
        $fax = $this->input->post('fax');
        $email = $this->input->post('email');

        $nbr_urs = 0;
        for ($i = 0; $i < count($full_name); $i++) {
            if (!empty($full_name[$i])) {
                $nbr_urs++;
            }
        }


        /* this is for edit */

        $this->db->where('Epp_ID', $domain->Admin_ID)->delete(USERS);
        $this->db->where('Epp_ID', $domain->Technical_ID)->delete(USERS);
        $this->db->where('Epp_ID', $domain->Financial_ID)->delete(USERS);
        $this->db->where('Epp_ID', $domain->Registrar_ID)->delete(USERS);

        $customer__data = $this->domain->get_one(['Customer_ID' => $customer_id], '*', 'customers');
        $registrant_epp_id = randomNumber(10).'0-dnet';

        $registrar_data = [
            'Epp_ID' => $registrant_epp_id,            
            'Full_Name' => $entity_name,
            'Employer_Name' => $entity_name,
            'User_Job_Title' => $job_title[0],
            'User_Country_ID' => $country_org,
            'User_Region' => $region_org,
            'User_City' => $city_org,
            'User_Post_Code' => $post_code_org,
            'User_Fax' => $fax[0],
            'User_Phone' => $phone[0],
            'User_Email' => $email[0],
            'User_Mobile' => $mobile[0],
            'Mobile_Key' => $mobile_key[0],
            'User_Address1' => $first_address_org,
            'User_Address2' => $second_address_org,
        ];

        $registrar_row_id = $this->domain->insert(USERS, $registrar_data);
        $registrar_id = $registrant_epp_id;


        if ($nbr_urs == 1) {
            $admin_epp_id = randomNumber(10).'1-dnet';            
            $users_domain_data = [
                'Epp_ID' => $admin_epp_id,                                
                'Full_Name' => $full_name[0],
                'Employer_Name' => $employer_name[0],
                'User_Job_Title' => $job_title[0],
                'User_Country_ID' => $country[0],
                'User_Region' => $region[0],
                'User_City' => $city[0],
                'User_Post_Code' => $post_code[0],
                'User_Fax' => $fax[0],
                'User_Phone' => $phone[0],
                'User_Email' => $email[0],
                'User_Mobile' => $mobile[0],
                'Mobile_Key' => $mobile_key[0],
                'User_Address1' => $first_address[0],
                'User_Address2' => $second_address[0],
            ];

            $admin_id = $this->domain->insert(USERS, $users_domain_data);
            $admin_id = $admin_epp_id;
            $finantial_id = $admin_id;
            $technical_id = $admin_id;
        }
        if ($nbr_urs == 2) {
            $admin_epp_id = randomNumber(10).'1-dnet';                        
            $users_domain_data = [
                'Epp_ID' => $admin_epp_id,
                'Full_Name' => $full_name[0],
                'Employer_Name' => $employer_name[0],
                'User_Job_Title' => $job_title[0],
                'User_Country_ID' => $country[0],
                'User_Region' => $region[0],
                'User_City' => $city[0],
                'User_Post_Code' => $post_code[0],
                'User_Fax' => $fax[0],
                'User_Phone' => $phone[0],
                'User_Email' => $email[0],
                'User_Mobile' => $mobile[0],
                'Mobile_Key' => $mobile_key[0],
                'User_Address1' => $first_address[0],
                'User_Address2' => $second_address[0],
            ];

            $admin_id = $this->domain->insert(USERS, $users_domain_data);
            $admin_id = $admin_epp_id;
            $finantial_id = $admin_id;
            $technical_id = $admin_id;

            if ($tec_man) {
                $tech_epp_id = randomNumber(10).'2-dnet';                
                $users_domain_data = [
                    'Epp_ID' => $tech_epp_id,                    
                    'Full_Name' => $full_name[1],
                    'Employer_Name' => $employer_name[1],
                    'User_Job_Title' => $job_title[1],
                    'User_Country_ID' => $country[1],
                    'User_Region' => $region[1],
                    'User_City' => $city[1],
                    'User_Post_Code' => $post_code[1],
                    'User_Fax' => $fax[1],
                    'User_Phone' => $phone[1],
                    'User_Email' => $email[1],
                    'User_Mobile' => $mobile[1],
                    'Mobile_Key' => $mobile_key[1],
                    'User_Address1' => $first_address[1],
                    'User_Address2' => $second_address[1],
                ];

                $technical_id = $this->domain->insert(USERS, $users_domain_data);
                $technical_id = $tech_epp_id;
            }

            if ($eco_man) {
                $billing_epp_id = randomNumber(10).'3-dnet';
                $users_domain_data = [
                    'Epp_ID' => $billing_epp_id,                                        
                    'Full_Name' => $full_name[2],
                    'Employer_Name' => $employer_name[2],
                    'User_Job_Title' => $job_title[2],
                    'User_Country_ID' => $country[2],
                    'User_Region' => $region[2],
                    'User_City' => $city[2],
                    'User_Post_Code' => $post_code[2],
                    'User_Fax' => $fax[2],
                    'User_Phone' => $phone[2],
                    'User_Email' => $email[2],
                    'User_Mobile' => $mobile[2],
                    'Mobile_Key' => $mobile_key[2],
                    'User_Address1' => $first_address[2],
                    'User_Address2' => $second_address[2],
                ];

                $finantial_id = $this->domain->insert(USERS, $users_domain_data);
                $finantial_id = $billing_epp_id;
            }
        }



        
        if ($nbr_urs == 3) {
            $admin_epp_id = randomNumber(10).'1-dnet';                                    
            $users_domain_data = [
                'Epp_ID' => $admin_epp_id,                
                'Full_Name' => $full_name[0],
                'Employer_Name' => $employer_name[0],
                'User_Job_Title' => $job_title[0],
                'User_Country_ID' => $country[0],
                'User_Region' => $region[0],
                'User_City' => $city[0],
                'User_Post_Code' => $post_code[0],
                'User_Fax' => $fax[0],
                'User_Phone' => $phone[0],
                'User_Email' => $email[0],
                'User_Mobile' => $mobile[0],
                'Mobile_Key' => $mobile_key[0],
                'User_Address1' => $first_address[0],
                'User_Address2' => $second_address[0],
            ];

            $admin_id = $this->domain->insert(USERS, $users_domain_data);
            $admin_id = $admin_epp_id;
            $finantial_id = $admin_id;
            $technical_id = $admin_id;

        if ($tec_man) {
            $tech_epp_id = randomNumber(10).'2-dnet';                            
            $users_domain_data = [
                'Epp_ID' => $tech_epp_id,                                    
                'Full_Name' => $full_name[1],
                'Employer_Name' => $employer_name[1],
                'User_Job_Title' => $job_title[1],
                'User_Country_ID' => $country[1],
                'User_Region' => $region[1],
                'User_City' => $city[1],
                'User_Post_Code' => $post_code[1],
                'User_Fax' => $fax[1],
                'User_Phone' => $phone[1],
                'User_Email' => $email[1],
                'User_Mobile' => $mobile[1],
                'Mobile_Key' => $mobile_key[1],
                'User_Address1' => $first_address[1],
                'User_Address2' => $second_address[1],
            ];

            $technical_id = $this->domain->insert(USERS, $users_domain_data);
            $technical_id = $tech_epp_id;
        }
         if ($eco_man) {
            $billing_epp_id = randomNumber(10).'3-dnet';            
            $users_domain_data = [
                'Epp_ID' => $billing_epp_id,                                                       
                'Full_Name' => $full_name[2],
                'Employer_Name' => $employer_name[2],
                'User_Job_Title' => $job_title[2],
                'User_Country_ID' => $country[2],
                'User_Region' => $region[2],
                'User_City' => $city[2],
                'User_Post_Code' => $post_code[2],
                'User_Fax' => $fax[2],
                'User_Phone' => $phone[2],
                'User_Email' => $email[2],
                'User_Mobile' => $mobile[2],
                'Mobile_Key' => $mobile_key[2],
                'User_Address1' => $first_address[2],
                'User_Address2' => $second_address[2],
            ];

            $finantial_id = $this->domain->insert(USERS, $users_domain_data);
            $finantial_id = $billing_epp_id;
         }

        }

        /* -----------------------------------------------------------
        ----------------------Domain -----------------
        -------------------------------------------------------- */
        $tld_info = $this->domain->getDomainTldsByID($tld_id);

        $domain_data = ['Customer_ID' => $customer_id,
            'Domain_Name' => $domain_name,
            'TLD' => $tld_info->TLD_Name,
            'Primary_Server' => $primary_server,
            'Secondery_Server' => $secondary_server,
            'Secondary_Servers'=>json_encode($secondary_servers),
            'Server_ips' => json_encode($server_ips),
        ];

        if (empty($domain_id)) {
            $domain_id = $this->domain->insert(DOMAIN, $domain_data);
            $this->session->set_userdata($this->site_session->domain_id(), $domain_id);

        } else {
            $this->domain->save($domain_data, ['Domain_ID' => $domain->Domain_ID], DOMAIN);
        }

        /* -----------------------------------------------------------
        ----------------------Domain info -----------------
        -------------------------------------------------------- */
        $domain_info = $this->domain->getDomainInfo($domain_id);
        $domain_info_data = [
            'Domain_ID' => $domain_id,
            'Admin_ID' => $admin_id,
            'Technical_ID' => $technical_id,
            'Financial_ID' => $finantial_id,
            'Registrar_ID' => $registrar_id,
            'Org_Activity_ID' => $activity_type,
        ];

        if (empty($domain_info)) {
            $DINFO_ID = $this->domain->insert(INFO, $domain_info_data);
        } else {
            $this->domain->save($domain_info_data, ['DINFO_ID' => $domain->DINFO_ID], INFO);
        }



        /* add create domain request */
        $domain_info_data['Period'] = $period;
        $status = 'incomplete';
        $type   = 'create_domain';
        $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $status);
        $request_data = [
                    'DCR_Request_Type' => $type,
                    'DCR_Domain_ID' => $domain_id,
                    'DCR_USER_ID' => $userid,
                    'DCR_Admin_ID' => $admin_id,
                    'DCR_Status' => $status,
                    'DCR_Phone_Verified' => 1,
                    'DCR_Verify_Page_Token' => $customer__data->Verify_Page_Token,
                    'DCR_POST_DATA' => json_encode($domain_info_data),
                    'Need_Payment'  => 1,
                ];
        $request_id = $this->domain->insert(REQUEST, $request_data);

        /* -----------------------------------------------------------
        ----------------------Domain history -----------------
        -------------------------------------------------------- */
        //insert domain history

        $history_data = [
            'Customer_ID' => $customer_id,
            'Domain_ID' => $domain_id,
            'Domain_Name' => $domain_name,
            'TLD' => $tld_info->TLD_Name,
            //'Period' => $period,
            'Primary_Server' => $primary_server,
            'Secondery_Server' => $secondary_server,
            'LTD_History' => json_encode($tld_info),
            'ORG_History' => json_encode($registrar_data),
            'INFO_History' => json_encode($domain_info_data),
        ];

        //insert domain history
        $dh_id = $this->domain->insert(DOMAIN_HIS, $history_data);
        $this->domain->save(['DH_ID' => $dh_id], ['Domain_ID' => $domain_id], DOMAIN);

        /* -----------------------------------------------------------
        ----------------------APP LOG -----------------
        -------------------------------------------------------- */
        $domain_data = [
            'DAL_Domain_ID' => $domain_id,
            'DAL_User_ID' => $customer_id,
            'DAL_Status' => (!empty($DINFO_ID)) ? 'insert_application' : 'update_application',
            'DAL_Created' => date("Y-m-d H:i:s"),
            'DAL_Type'=>'Customer',
        ];
        // insert data
        $log_id = $this->domain->insert(APP_LOG, $domain_data);

        $data['doc_types'] = $this->domain->getAllDocsType();
        $data['doc_issures'] = $this->domain->getAllIssuers();

        if (!empty($domain_id)) {
            $domain = $this->domain->getDomainByID_All($domain_id);

            /* if selected date meladi change the format to be display by the date picker */
            $doc_date = $domain->Docs->support->Doc_Date;
            $orderdate = explode('-', $doc_date);
            $year   = $orderdate[0];
            $data['is_hejri'] = TRUE;
            if($year >= 2000){
                $domain->Docs->support->Doc_Date = date('d-m-Y',strtotime($domain->Docs->support->Doc_Date));
                $data['is_hejri'] = FALSE;
            }
            /* end */


            $data['domain'] = $domain;
        }

        $data['domain_id'] = $domain_id;

        $this->LoadView_m('domain_registration/domain_register_step_2', $data);

    }

    public function speech_pdf($lang='ar')
    {
        $domain_id = $this->session->userdata($this->site_session->domain_id());
        $data['website_data'] = $this->home_model->Get_Website_Data();
        $data['website_config'] = $this->home_model->Get_WebsiteSettings();
        $data['domain'] = $this->domain->getDomainByID_All($domain_id, 1);

        if($lang == 'ar'){
            $this->load->view('snippets/speech', $data);
        }else{
            $this->load->view('snippets/speech_en', $data);
        }
    }
        public function domain_certificate($domain_id,$lang='ar')
    {
        $userid = $this->session->userdata($this->site_session->userid());

        $domain_id = decryptIt($domain_id);
        $data['website_data'] = $this->home_model->Get_Website_Data();
        $data['website_config'] = $this->home_model->Get_WebsiteSettings();
        $data['domain'] = $this->domain->getDomainByID_All($domain_id, 1);

        // prevent unauthorized users
        if($data['domain']->Customer_ID != $userid){
            dd('not authorized');
        }    

        $this->load->view('snippets/domain_certificate', $data);
      
    }

    public function domain_review()
    {

        //support_file
        $doc_number = $this->input->post('doc_number');
        $doc_date = $this->input->post('doc_date');
        $doc_title = $this->input->post('doc_title');
        $doc_type = $this->input->post('document-type');
        $relation = $this->input->post('relation_between_registrar');
        // $hijri_date = $this->input->post('hijri_date');
        // $meladi_date = $this->input->post('meladi_date');

        /* get hijri and meladi date */
        $doc_date     = date('Y-m-d',strtotime($doc_date));
        $orderdate = explode('-', $doc_date);
        $year   = $orderdate[0];
        $month  = $orderdate[1];
        $day    = $orderdate[2];

        if($year < 2000){
                $hijri_date      = $this->input->post('doc_date');
                $meladi_date     = Hijri2Greg($day, $month, $year);
                $meladi_date     = $meladi_date['year'].'-'.$meladi_date['month'].'-'.$meladi_date['day'];

        } else {
                $hijri_date      = Greg2Hijri($day, $month, $year);
                $hijri_date      = $hijri_date['year'].'-'.$hijri_date['month'].'-'.$hijri_date['day'];               
                $meladi_date     = $this->input->post('doc_date');
        }
        $meladi_date     = date('Y-m-d',strtotime($meladi_date));
        /* end */

        

            $doc_info = $this->domain->getDocsTypeByID($doc_type);
            $issures_id = $doc_info->Issuer_ID;
            $doc_code = $doc_info->Code;

            if($doc_info->Issuer_ID == 0){
                $issures_id = $this->input->post('issures_id');
                $issuer = $this->domain->getIssuersByID($issures_id);
                $data['issuer'] = $issuer;
                $doc_code = $issuer->Code;
            }
             
        



        $config['upload_path'] = $GLOBALS['domain_doc_dir'];
         $config['allowed_types'] = 'jpeg|png|pdf|bmp';
        $config['max_size'] = '40000';
        $config['overwrite'] = true;
        $this->load->library('upload', $config);


        $domain_id = $this->session->userdata($this->site_session->domain_id());
        //  $this->db->where('Domain_ID',$domain_id)->delete(DOCUMENT);
        $data['domain_id'] = $domain_id;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'tld id', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');

            redirect($this->thisCtrl . "/my_orders");
        }

        $update_info = [
            // 'Step'=>2,
            'Relation_Between' => $relation,
        ];
        $this->domain->save($update_info, ['Domain_ID' => $domain_id], INFO);

        $domain = $this->domain->getDomainByID_All($domain_id);

        if(!empty($domain->Docs->support)){
              $update_support_doc = [
                    'Domain_ID' => $domain_id,
                    'Doc_Title' => $doc_title,
                    'Doc_Type_ID' => $doc_type,
                    'Doc_Code' => $doc_code,
                    'Doc_Issures_ID'=> $issures_id,
                    'Doc_Num' => $doc_number,
                    'Doc_Date' => $doc_date,
                    'Hijri_Date' => $hijri_date,
                    'Meladi_Date' => $meladi_date,
                ];

                $where = array('Domain_Doc_ID' => $domain->Docs->support->Domain_Doc_ID);
                $this->domain->save($update_support_doc, $where, DOCUMENT);
        }

        if (isset($_FILES['speech_file']) && !empty($_FILES['speech_file']['name'])) {

            if (!$this->upload->do_upload("speech_file")) {

                $upload_error = $this->upload->display_errors();
                $this->session->set_flashdata('requestMsgErr', $upload_error);
                redirect("register_domain");

            } else {
                $uploadedFileData = $this->upload->data();
                $speech_file = md5(time()) . 'speech_file' . $uploadedFileData['file_ext'];
                rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $speech_file);

                $speech_doc = [
                    'Domain_ID' => $domain_id,
                    'Doc_Title' => 'speech',
                    'Doc_Type' => 'speech',
                    'Doc_Path' => $speech_file,

                ];


                $this->domain->insert(DOCUMENT, $speech_doc);

            }

        }

        if (isset($_FILES['additional_file']) && !empty($_FILES['additional_file']['name'])) {

            if (!$this->upload->do_upload("additional_file")) {
                $upload_error = $this->upload->display_errors();
                $this->session->set_flashdata('requestMsgErr', $upload_error);
                redirect("register_domain");

            } else {
                $uploadedFileData = $this->upload->data();
                $additional_file = md5(time()) . 'additional_file' . $uploadedFileData['file_ext'];
                rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $additional_file);

                //additional_file
                $additional_doc = [
                    'Domain_ID' => $domain_id,
                    'Doc_Title' => 'additional',
                    'Doc_Type' => 'additional',
                    'Doc_Path' => $additional_file,
                ];
                $this->domain->insert(DOCUMENT, $additional_doc);

            }

        }

        if (isset($_FILES['support_file']) && !empty($_FILES['support_file']['name'])) {

            if (!$this->upload->do_upload("support_file")) {
                
                $upload_error = $this->upload->display_errors();
                $this->session->set_flashdata('requestMsgErr', $upload_error);
                redirect("register_domain");
                

            } else {
                $uploadedFileData = $this->upload->data();
                $support_file = md5(time()) . 'support_file' . $uploadedFileData['file_ext'];
                rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $support_file);

                $support_doc = [
                    'Domain_ID' => $domain_id,
                    'Doc_Title' => $doc_title,
                    'Doc_Type' => 'support',
                    'Doc_Type_ID' => $doc_type,
                    'Doc_Code' => $doc_code,
                    'Doc_Issures_ID'=> $issures_id,                    
                    'Doc_Num' => $doc_number,
                    'Doc_Date' => $doc_date,
                    'Doc_Path' => $support_file,
                    'Hijri_Date' => $hijri_date,
                    'Meladi_Date' => $meladi_date,

                ];
                $this->domain->insert(DOCUMENT, $support_doc);

            }

        }

        //here we should update domain with step and relation between
        $data['domain'] = $this->domain->getDomainByID_All($domain_id);
        $type   = 'create_domain';
        $request = $this->domain->getRequestByType($type,$domain_id,'incomplete');
        $request_post_data = json_decode($request->DCR_POST_DATA);
        $period = $request_post_data->Period;
        $data['period'] = $period;
        $data['request'] = $request;

        $tld_info = $this->domain->getDomainTldsByName($data['domain']->TLD);
        $vat = 15;
        $register_price = $tld_info->Register_Price;
        $total_vat = ($register_price * $vat) / 100;
        $total_vat = number_format((float) $total_vat, 2, '.', '');

        $total_price = ($register_price + $total_vat) * $period; 
        $total_price = number_format((float) $total_price, 2, '.', '');
        $data['total_price'] = $total_price;


        $this->LoadView_m('domain_registration/domain_register_step_3', $data);

    }

    public function send_app_admin()
    {

        $userid = $this->session->userdata($this->site_session->userid());
        $customer = $this->customer_model->getCustomerData($userid);
        $customer = $customer[0];

        $domain_id = $this->session->userdata($this->site_session->domain_id());
        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
        $data['admin_officer'] = $admin_officer;

        //if app email send redirect to home
        $is_email_sent = $this->domain->getAppLogByDomainID($domain_id, 'admin_officer_email');

        if (!$is_email_sent && !empty($domain_id)) {
            // send verify domain email to admin officer
            $domain = $this->domain->getDomainByID($domain_id);
            $data['domain'] = $domain;
            $data['url'] = base_url('admin_officer_verify_domain/') . '?do=' . encryptIt($domain_id) . '&to=' . $customer->Verify_Page_Token;
            $data['type'] = getSystemString('insert_application');

            $info_data = [
                'Domain_Term_Approved' => 1,
            ];
            $this->domain->save($info_data, ['DINFO_ID' => $domain->DINFO_ID], INFO);

            //terms logs
            $domain_data = [
                'DAL_Domain_ID' => $domain_id,
                'DAL_User_ID' => $userid,
                'DAL_Status' => 'registrar_term_approve',
                'DAL_Created' => date("Y-m-d H:i:s"),
                'DAL_Type'=>'Customer',
            ];
            $log_id = $this->domain->insert(APP_LOG, $domain_data);

            $status = 'incomplete';
            $type   = 'create_domain';
            $new_status = 'pending';
            $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $status,$new_status);

            /* get request details */
            $request = $this->domain->getRequestByType($type,$domain_id,'pending');
            $data['DCR_ID'] = $request->DCR_ID;
            $num = str_pad($request->DCR_ID, 5, '0', STR_PAD_LEFT);
            $domain_ns = $domain->Domain_Name . $domain->TLD;
            //echo $data['url']; exit();
            $data['website_data']      = $this->home_model->Get_Website_Data();
            $this->load->library('parser');
            $message = '' . $this->parser->parse('email-templates/send_verification_email_to_admin_officer', $data, true);

            // echo $message; exit();
            $options = array(
                'to' => $admin_officer->User_Email,
                'subject' => getSystemString('email_verify_subject').' | #'.$num.' | '.$domain_ns,
                'message' => $message,
            );
            if (SendEmail($options)) {
                //domains logs
                $domain_data = [
                    'DAL_Domain_ID' => $domain_id,
                    'DAL_User_ID' => $admin_officer->Org_Usr_ID,
                    'DAL_Status' => 'admin_officer_email',
                    'DAL_Created' => date("Y-m-d H:i:s"),
                    'DAL_Type'=>'Contact',
                ];
                $log_id = $this->domain->insert(APP_LOG, $domain_data);

                /* change create request status to pending */
                $old_status = 'incomplete';
                $new_status = 'pending';
                $this->domain->change_create_domain_request_status($domain_id,$old_status,$new_status);

                /*when successfuly save application set session to null*/
                $this->session->set_userdata($this->site_session->tld_id(), '');
                $this->session->set_userdata($this->site_session->domain_name(), '');
                $this->session->set_userdata($this->site_session->domain_id(), '');

            }
        }

        $this->LoadView_m('domain_registration/domain_register_step_4', $data);

    }



    public function host_check()
    {
        $host = $this->input->post('host');
        $domain = $this->input->post('domain')?:'';


        $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('nameserver_check_error') . "</p>";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('host', 'host', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));
        }


        $host_domain_name = substr($host, (strpos($host, '.') ?: -1) + 1);



        // Checking if namseserver is correct
        $check_host = dns_get_record($host,DNS_A);

        if ($host_domain_name == $domain) {
            $this->output->set_content_type('application/json');
            die(json_encode(array('status' => true, 'msg' => $sys_err)));     
        }

        if (empty($check_host)) {
            $this->output->set_content_type('application/json');
            die(json_encode(array('status' => false, 'msg' => $sys_err)));     
        }

 

        $this->output->set_content_type('application/json');
        die(json_encode(array('status' => true, 'msg' => $sys_err)));   

    }

    public function domain_nameserver_change()
    {
        $userid = $this->session->userdata($this->site_session->userid());
        $domain_id = $this->input->post('domain_id');
        $domain_id = decryptIt($domain_id);
        $primary_server = $this->input->post('primary_server');
        $secondary_server = $this->input->post('secondary_server');


        $server_ips = $this->input->post('server_ips');
        $secondary_servers = $this->input->post('secondary_servers');
        $secondary_servers_ips = $this->input->post('secondary_servers_ips');

        if(!empty($secondary_servers)){
            for($i=0; $i<count($secondary_servers); $i++){
                $ss[] = ['name_server'=>$secondary_servers[$i],'ip'=>$secondary_servers_ips[$i]];
            }
            $secondary_servers = $ss;
        }

        $_POST['secondary_servers'] = $secondary_servers;
        $_POST['domain_id'] = $domain_id;
        $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString(119) . "</p>";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');
        $this->form_validation->set_rules('primary_server', 'primary_server', 'trim|required|xss_clean');
        $this->form_validation->set_rules('secondary_server', 'secondary_server', 'trim|required|xss_clean');

        
        if ($this->form_validation->run() == false) {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));

        }

        $domain = $this->domain->getDomainByID($domain_id);

        if (empty($domain)) {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));
        }


        // check if DNSSEC is enabled he should disabled to change name server
        if ($domain->DNSSEC_Status == 1) {
            $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString('nameserver_dnssec_disable') . "</p>";
            $this->output->set_content_type('application/json');
            die(json_encode(array('status' => false, 'msg' => $sys_err)));  
        }

        /* send email verification to customer */
        $type = 'host';
        $this->_send_change_request_to_admin($domain_id, $type);

    }

    public function domain_check_ajax()
    {

        $domain_name = $this->input->post('_domain_name');
        $tld = $this->input->post('_tld');
        $tld_id = $this->input->post('_tld_id');
        $is_edit = $this->input->post('_is_edit');

        if (empty($domain_name) || empty($tld_id)) {
            $domain_name = $this->session->userdata($this->site_session->domain_name());
            $tld_id = $this->session->userdata($this->site_session->tld_id());
        }

        if (!empty($domain_name) && !empty($tld_id)) {

            $this->session->set_userdata($this->site_session->tld_id(), $tld_id);
            $this->session->set_userdata($this->site_session->domain_name(), $domain_name);
            /*to prevent get post data on refresh register domain*/
            $_SESSION['is_redirect'] = 1;

            $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString(119) . "</p>";

            $tld_info = $this->domain->getDomainTldsByID($tld_id);

            $userid = $this->session->userdata($this->site_session->userid());
            $incomplete_applications = [];
            if(!empty($userid)){
               $incomplete_applications = $this->domain->getIncompletedApplication($domain_name,$tld_info->TLD_Name,$userid);
            }
            if(!empty($incomplete_applications) && !$is_edit){

                $domain_id = $incomplete_applications->Domain_ID;
                $request_id = $incomplete_applications->DCR_ID;
                $url = base_url('order_details/').encryptIt($domain_id).'/'.encryptIt($request_id);
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false, 'msg' => '', 'result' => '','url'=>$url,'incomp'=>1)));

            }else{

            $required_tld = $domain_name . $tld_info->TLD_Name;
            $responseJSON = $this->epp_lib->domain_check($required_tld);

            $suggested_tlds = $responseJSON[0]['epp']['response']['resData']['domain:chkData']['domain:cd'];

            $result = '';

            $result->avail = $suggested_tlds['domain:name']['@attributes']['avail'];
            $result->value = $suggested_tlds['domain:name']['_value'];
            $result->reason = $suggested_tlds['domain:reason'];
            $result->domain_name = $domain_name;

            $lang = $this->session->userdata($this->site_session->__lang_h());
            $msg = '';
            $TldDescription = 'Description_'.$lang;
            $description = $tld_info->$TldDescription;

            if (($result->reason == 'available' || $result->reason == 'reserved_zone' || $result->reason == 'reserved_word') && $result->avail == 1 ) {
                $msg = "<p class='domain-exists text-center mt-3'> " . getSystemString($result->reason) . "</p>";
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true, 'msg' => $msg, 'description' => $description, 'tld_id' => $tld_id, 'result' => $result,'incomp'=>0)));
            } else {
                $msg = "<p class='domain-not-exists text-center mt-3'> " . getSystemString($result->reason) . "</p>";
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false, 'msg' => $msg, 'result' => $result,'incomp'=>0)));
            }

        }

        } else {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));
        }

    }

    private function _change_registrar_data($domain_id)
    {
        $registrant_city_org = $this->input->post('registrant_city_org');
        $registrant_region_org = $this->input->post('registrant_region_org');
        $registrant_country_org = $this->input->post('registrant_country_org');
        // $registrant_entity_name = $this->input->post('registrant_entity_name');
        $registrant_first_address_org = $this->input->post('registrant_first_address_org');
        $registrant_second_address_org = $this->input->post('registrant_second_address_org');
        $registrant_post_code_org = $this->input->post('registrant_post_code_org');

        $_POST['domain_id'] = $domain_id;
        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
        $_POST['registrant_job_title'] = $admin_officer->User_Job_Title;

        $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString(119) . "</p>";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');
        $this->form_validation->set_rules('registrant_city_org', 'registrant_city_org', 'trim|required|xss_clean');
        $this->form_validation->set_rules('registrant_region_org', 'registrant_region_org', 'trim|required|xss_clean');
        $this->form_validation->set_rules('registrant_country_org', 'registrant_country_org', 'trim|required|xss_clean');
        $this->form_validation->set_rules('registrant_entity_name', 'registrant_entity_name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('registrant_first_address_org', 'registrant_first_address_org', 'trim|required|xss_clean');
        $this->form_validation->set_rules('registrant_second_address_org', 'registrant_second_address_org', 'trim|required|xss_clean');
        $this->form_validation->set_rules('registrant_post_code_org', 'registrant_post_code_org', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));

        }

        $domain = $this->domain->getDomainByID($domain_id);

        if (empty($domain)) {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));

        }

        /* send email verification to customer */
        $type = 'entity';
        $this->_send_change_request_to_admin($domain_id, $type);

    }

    private function _send_change_request_to_admin($domain_id, $type)
    {
        $userid = $this->session->userdata($this->site_session->userid());

        /*update customer page token*/
        $rand = str_pad(rand(0, pow(10, 4) - 1), 4, '0', STR_PAD_LEFT);
        $rand2 = rand(111111, 999999);
        $verify_page_token = urlencode(md5($rand . '' . $rand2));
        //$this->domain->changeCustomerPageToken($userid,$verify_page_token);
        /* end update */

        // $customer       = $this->customer_model->getCustomerData($userid);
        // $customer = $customer[0];

        // $reset = 1; /* reset mobile verification 05/01/2021 */


        $admin_officer = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
        $domain = $this->domain->getDomainByID($domain_id);
        $domain_ns = $domain->Domain_Name . $domain->TLD;

        $data['type'] = getSystemString($type);
        $data['domain'] = $domain;
        $data['url'] = base_url('change_request/') . '?do=' . encryptIt($domain_id) . '&to=' . $verify_page_token;
        $data['website_data'] = $this->home_model->Get_Website_Data();

        /* here we should add request to to be executed by admin*/
            //$type = 'host';
        $status = 'pending';
        $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $status);
        $request_data = [
                'DCR_Request_Type' => $type,
                'DCR_Domain_ID' => $domain_id,
                'DCR_USER_ID' => $userid,
                'DCR_Admin_ID' => (empty($admin_officer->Epp_ID))?$admin_officer->Org_Usr_ID:$admin_officer->Epp_ID,
                'DCR_Status' => $status,
                'DCR_Phone_Verified' => 0,
                'DCR_Verify_Page_Token' => $verify_page_token,
                'DCR_POST_DATA' => json_encode($_POST),
                'Need_Payment' => ($type == 'restore_domain')?1:0,
        ];
        $request_id = $this->domain->insert(REQUEST, $request_data);
        $num = str_pad($request_id, 5, '0', STR_PAD_LEFT);
        $data['DCR_ID'] = $request_id;


        $this->load->library('parser');
        $message = $this->parser->parse('email-templates/send_verification_email_to_admin_officer', $data, true);

        //echo $admin_officer->User_Email; exit();
        // var_dump($admin_officer); exit();

        $options = array(
            'to' => $admin_officer->User_Email,
            'subject' => '#'.$num.' | '.getSystemString($type).' | '.$domain_ns,
            'message' => $message,
        );


        if (SendEmail($options)) {
           // if(true){

            if ($type == 'dnssec_disable') {
                $_POST = [];
                // get dnssec key detiles from epp
                $domain_detiles = $this->epp_lib->domain_info($domain_ns, $domain_id);
                $epp_dnssec_key = $domain_detiles[0]['epp']['response']['extension']['secDNS:infData']['secDNS:dsData'];
                if (!empty($epp_dnssec_key)) {
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
                    $_POST = $remove_record;
                }
            }



            $msg = getSystemString('success_request');
            $msg = "<p class='domain-exists text-center mt-3'> " . $msg . "</p>";

            if ($type == 'host') {
                $primary_server = $this->input->post('primary_server');
                $secondary_server = $this->input->post('secondary_server');
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true, 'primary_server' => $primary_server, 'secondary_server' => $secondary_server, 'msg' => $msg)));
            } elseif ($type == 'entity') {
                $registrar = $this->domain->getDomainOrgUsers($domain_id, 'Registrar');
                $registrar->Country = GetCountryById($registrar->User_Country_ID, 'ar');
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true, 'registrar' => $registrar, 'msg' => $msg)));
            } elseif ($type == 'transfer_inside' || $type == 'dnssec_enable' || $type == 'dnssec_disable' || $type == 'lock' || $type == 'unlock' || $type == 'delete_domain' || $type == 'restore_domain' || $type == 'auth_code' || $type == 'domain_transfer_in') {

                $this->session->set_flashdata('success',$msg);
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true, 'msg' => $msg)));
            }elseif($type == 'domain_waiver'){
                    return true;
            }else {
                $type = ucfirst($type);
                $contact = $this->domain->getDomainOrgUsers($domain_id, $type);
                $contact->Country = GetCountryById($contact->User_Country_ID, 'ar');
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true, 'contact' => $contact, 'msg' => $msg)));
            }

        } else {
            $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString(119) . "</p>";

            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));
        }

    }


    public function resend_transfer_request_email(){
        $dtn_id = $this->input->GET('id');

        $userid = $this->session->userdata($this->site_session->userid());

        $transfer_request = $this->domain->getTransferRequestByID($dtn_id,$userid);



        $admin_email = $transfer_request->DTI_Admin_Email;
        $verify_page_token = $transfer_request->DCR_Verify_Page_Token;
        $domain_ns = $transfer_request->DTI_Domain_Name_Query;



        $data['url'] = base_url('resend_transfer_request/') . '?id=' . encryptIt($dtn_id) . '&c_id=' . $userid. '&code=' . $verify_page_token;
        $data['type'] = getSystemString('domain_transfer_in');
        $data['transfer_request'] = $transfer_request;
        $data['website_data'] = $this->home_model->Get_Website_Data();
        $data['DCR_ID'] = $dtn_id;
        $num = str_pad($dtn_id, 5, '0', STR_PAD_LEFT);


        $this->load->library('parser');
        $message = '' . $this->parser->parse('email-templates/confirm_transfer_domain', $data, true);

        $options = array(
            'to' => $admin_email,
            'subject' => getSystemString('confirm_domain_transfer',$userid).' | #'.$num.' | '.$domain_ns,
            'message' => $message,
        );

         if (SendEmail($options) && !empty($transfer_request)) {

          $msg = 'success_request';
          $this->session->set_flashdata('requestMsgSucc',$msg); 

        } else {
           $msg = 119;
            $this->session->set_flashdata('requestMsgErr',$msg); 
        }
        redirect('my_orders');

    }




    /* -----------------------------------------------------------
    ---------------------- Repay unpayed orders -----------------
    -------------------------------------------------------------- */


        public function repay_success(){

        $this->load->library('payments/Hyperpay_lib');

        $payment_referance = $this->input->GET('id');

        $type = '';
        $order_details = $this->domain->getDomainOrderByReferancePayment($payment_referance);
        if(empty($order_details)){
            $order_details = $this->domain->getTransferOrderByReferancePayment($payment_referance);
            $type = 'transfer_in';
        }

        if (!$order_details) {
            show_404();
            exit();
        }



        if (!$order_details->Payment_Verified) {
            $cart_type = $order_details->Cart_Type;            
            $response = json_decode($this->hyperpay_lib->VerifyPayment($payment_referance,$cart_type));

            $code = $response->result->code;
            $order_id = $response->merchantTransactionId;

            //verify payment response
            $log = array(
                'Customer_ID' => $order_details->Customer_ID,
                'Type' => 'Verify Payment Response',
                'Response' => json_encode($response),
            );
            $this->domain->addAPISLog($log);

            if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code)) {




                                if($type == 'transfer_in'){
                                            $data = array(
                                                'HY_ID'=> $response->id,
                                                'Payment_Verified' => 1,
                                                'DTO_Payed_At' => date('Y-m-d H:i:s'),
                                            );
                                            $where = array('OR_ID' => $order_id);
                                            $this->domain->save($data, $where, TRANSFER_ORDERS);
                                            $order_id = $order_details->DTO_ID;

                       $this->_sendTransferOrderEmail($order_id,$order_details->DTI_Admin_Email);

                                }else{
                                            $data = array(
                                                'HY_ID'=> $response->id,
                                                'Payment_Verified' => 1,
                                                'Payed_AT' => date('Y-m-d H:i:s'),
                                            );
                                            $where = array('OR_ID' => $order_id);
                                            $this->domain->save($data, $where, ORDERS);

                                            $this->_sendOrderEmail($order_id);
                                }
                    $scc['restore']['msg'] = getSystemString('payment_success');
                            


                


            } else {

                            if($type == 'transfer_in'){

                                 $data = array(
                                    'Payment_Verified' => 0,
                                    'DTO_Payed_At' => date('Y-m-d H:i:s'),
                                );

                                $where = array('OR_ID' => $order_id);
                                $this->domain->save($data, $where, TRANSFER_ORDERS);
                            }else{
                                $data = array(
                                    'Payment_Verified' => 0,
                                    'Payed_AT' => date('Y-m-d H:i:s'),
                                );
                                $where = array('OR_ID' => $order_id);
                                $this->domain->save($data, $where, ORDERS);
                            }
                

                           $err['restore']['msg'] = getSystemString('payment_error');



            }

        }


        $data['error'] = $err;
        $data['success'] = $scc;
        $data['domain'] = $order_details;


        $this->LoadView_m('customer/domain_registration/approve_change_request_2', $data);


    }



    public function repay_order_change_cart(){
        $customer_id = $this->session->userdata($this->site_session->userid());        
        $order_id   = $this->input->post('or_id');
        $request_id = $this->input->post('req_id');
        $cart_type  = $this->input->post('cart_type');


        $request = $this->domain->getRequesDetails($request_id,$customer_id);
        if (empty($request)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        $discount_type = '';
        if($request->DCR_Request_Type == 'domain_transfer_in'){
            /* get order details from transfer orders*/
            $discount_type = 'transfer';
            $order_details =  $this->domain->getUnpayedTransferOrderByID($order_id);
        }else{
            /* get order details from orders*/
            $discount_type = 'register';                        
            $order_details =  $this->domain->getUnpayedOrderByID($order_id);
        }


        if (empty($order_details)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }


        $domain_id = $order_details->Domain_ID;
        $total_price = $order_details->Total_Price;
        $vat         = $order_details->Vat;

        $this->load->library('payments/Hyperpay_lib');
        $website_config = $this->home_model->Get_WebsiteSettings();
        $customer  = $this->domain->get_one(['Customer_ID'=>$customer_id],'*','customers');

        $domain_details = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        $data['domain_details'] = $domain_details;

        $data['period'] = $domain_details->Period;
        $price = $total_price - (($vat * $total_price) / 100);
        $price = number_format((float) $price, 2, '.', '');
        $data['price']  = $price;

        $total_vat = ($vat * $total_price) / 100;
        $total_vat = number_format((float) $total_vat, 2, '.', '');
        $data['total_vat']  = $total_vat;
        $data['vat']  = $vat;

        $data['total_price']  = $total_price;


        $total_price = number_format((float) $total_price, 2, '.', '');
    
        /* custumer discount */
        $c_discount = $this->domain->getCustumerDiscount($data['domain_details']->Customer_ID,$discount_type);
        $discount = $order_details->Discount;
        $discount_details = $order_details->Discount_Details;
        if(!empty($c_discount)){

            // get disscount detiles
            $c_discount_percentage = $c_discount->d_value;
            $c_discount_value = ($total_price * ($c_discount_percentage / 100));
            $data['discount_percentage'] = $c_discount_percentage;
            $data['discount_value'] = $c_discount_value;

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


        if($request->DCR_Request_Type == 'domain_transfer_in'){

            $data['msg'] = '  التفاصيل المالية لضم نطاق من خارج DNet ';
            $id = $order_details->DTI__ID;
            $order_id = $this->_makeUnConfirmedTransferOrder($id,$customer_id,$total_price,$vat,$discount,$discount_details,$cart_type,'MADA',1);
            $or_id = 'TRA'.$order_id;           
            $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price,$or_id,$customer,$cart_type));

        }else{
            $data['msg'] = ' التفاصيل المالية لانشاء نطاق ';
            
            $order_id = $this->_makeUnConfirmedOrder($domain_id, $customer_id, $total_price, $vat,$discount,$discount_details,$cart_type,1);
            $or_id = 'N'.$order_id;
            $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price, $or_id, $customer,$cart_type));

        }


        $code = $response->result->code;

        if($code == '000.200.100')
          {

          $data['customer']       = $customer;
          $data['checkout_id']    = $response->id;
          $data['cart_type'] = $cart_type;


          // * Payment Log
          $log = array(
              'Customer_ID' => $customer_id,
              'Type' => 'Select Hyperpay payment method',
              'Response' => json_encode($response)
          );
          $this->domain->addAPISLog($log);

                            
                            if($request->DCR_Request_Type == 'domain_transfer_in'){
                                  $transfer_order = array(
                                      'OR_ID' => $or_id,                
                                      'Payment_Referance' => $response->id,
                                      'Domain_ID'  => $domain_id,
                                  );
                                  $where = array('DTO_ID'=>$order_id);
                                  $this->domain->save($transfer_order,$where,TRANSFER_ORDERS);
                                  $this->session->set_userdata('Payment_Referance',$response->id);
                              }else{

                                       $domain_order_up = array(
                                            'OR_ID' => $or_id,                                        
                                            'Payment_Referance' => $response->id,
                                        );
                                        $where = array('DO_ID' => $order_id);
                                        $this->domain->save($domain_order_up, $where, ORDERS);
                              }



              $hayperPay_panel= $this->load->view('customer/snippets/hyperpay_panel_repay', $data, TRUE);
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true,'hayperPay_panel'=>$hayperPay_panel)));

        }else{
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false)));
        }

    }


        public function repay_order(){

        $customer_id = $this->session->userdata($this->site_session->userid());        
        $order_id = $this->input->get('or_id');
        $request_id = $this->input->get('req_id');

        $data['order_id'] = $order_id;
        $data['request_id'] =  $request_id;


        $request = $this->domain->getRequesDetails($request_id,$customer_id);
        if (empty($request)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        $discount_type = '';
        if($request->DCR_Request_Type == 'domain_transfer_in'){
            /* get order details from transfer orders*/
            $discount_type = 'transfer';
            $order_details =  $this->domain->getUnpayedTransferOrderByID($order_id);
        }else{
            /* get order details from orders*/
            $discount_type = 'register';            
            $order_details =  $this->domain->getUnpayedOrderByID($order_id);
        }

        if (empty($order_details)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        $domain_id = $order_details->Domain_ID;
        $total_price = $order_details->Total_Price;
        $vat         = $order_details->Vat;

        $this->load->library('payments/Hyperpay_lib');
        $website_config = $this->home_model->Get_WebsiteSettings();
        $customer  = $this->domain->get_one(['Customer_ID'=>$customer_id],'*','customers');

        $domain_details = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        $data['domain_details'] = $domain_details;

        $data['period'] = $domain_details->Period;
        $price = $total_price - (($vat * $total_price) / 100);
        $price = number_format((float) $price, 2, '.', '');
        $data['price']  = $price;

        $total_vat = ($vat * $total_price) / 100;
        $total_vat = number_format((float) $total_vat, 2, '.', '');
        $data['total_vat']  = $total_vat;
        $data['vat']  = $vat;

        $data['total_price']  = $total_price;


        $total_price = number_format((float) $total_price, 2, '.', '');
  
        /* custumer discount */
        $c_discount = $this->domain->getCustumerDiscount($data['domain_details']->Customer_ID,$discount_type);
        $discount = $order_details->Discount;
        $discount_details = $order_details->Discount_Details;

        if(!empty($c_discount)){

            // get disscount detiles
            $c_discount_percentage = $c_discount->d_value;
            $c_discount_value = ($total_price * ($c_discount_percentage / 100));
            $data['discount_percentage'] = $c_discount_percentage;
            $data['discount_value'] = $c_discount_value;
   
            // calculate vat after discount
            $total_vat = $total_vat - ($total_vat * ($c_discount_percentage / 100));
            $total_vat = number_format((float) $total_vat, 2, '.', ''); 
            $data['total_vat'] = $total_vat;

            $data['discount_value_before_vat'] = number_format((float) (($total_price - $total_vat) * ($c_discount_percentage / 100)) , 2, '.', ''); 

            // calculate total after discount
            $total_price = $total_price - ($total_price * ($c_discount_percentage / 100));
            $total_price = number_format((float) $total_price, 2, '.', '');
            $data['total_price'] = $total_price;

            $discount = $c_discount_value;
            $discount_details = $c_discount_percentage;

        }



        if($request->DCR_Request_Type == 'domain_transfer_in'){

            $data['msg'] = '  التفاصيل المالية لضم نطاق من خارج DNet ';
            $id = $order_details->DTI__ID;
            $order_id = $this->_makeUnConfirmedTransferOrder($id,$customer_id,$total_price,$vat,$discount,$discount_details,'MADA',1);
            $or_id = 'TRA'.$order_id;           
            $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price,$or_id,$customer,'MADA'));

        }else{
            $data['msg'] = ' التفاصيل المالية لانشاء نطاق ';
            
        $order_id = $this->_makeUnConfirmedOrder($domain_id, $customer_id, $total_price, $vat,$discount,$discount_details,'MADA',1);
            $or_id = 'N'.$order_id;
            $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price, $or_id, $customer,'MADA'));

        }

   


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




                            if($request->DCR_Request_Type == 'domain_transfer_in'){
                                  $transfer_order = array(
                                      'OR_ID' => $or_id,                
                                      'Payment_Referance' => $response->id,
                                      'Domain_ID'  => $domain_id,
                                      'Request_ID' => $request_id,
                                  );
                                  $where = array('DTO_ID'=>$order_id);
                                  $this->domain->save($transfer_order,$where,TRANSFER_ORDERS);
                                  $this->session->set_userdata('Payment_Referance',$response->id);
                              }else{

                                       $domain_order_up = array(
                                            'OR_ID' => $or_id,                                        
                                            'Payment_Referance' => $response->id,                                      'Request_ID' => $request_id,
                                        );
                                        $where = array('DO_ID' => $order_id);
                                        $this->domain->save($domain_order_up, $where, ORDERS);
                              }


         }
        $this->LoadView_m('customer/domain_registration/repay_order', $data);
        
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
        $data['total_vat'] =  round(($order->Total_Price) - ($order->Total_Price / (1+($order->Vat/100))),2);


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

        private function _makeUnConfirmedTransferOrder($dti_id, $customer_id, $totalPrice, $vat,$discount,$discount_details,$cart_type='MADA',$period = 1)
    {
        $data = array(
            'DTI_ID' => $dti_id,
            'Customer_ID' => $customer_id,
            'Total_Price' => $totalPrice,
            //'Expire_Date' => date('Y-m-d', strtotime('+1 year', time())),
            'Cart_Type' => $cart_type,            
            'Vat' => $vat,
            'Period' => $period,
            'Discount_Details' => $discount_details,            
            'Discount' => $discount,
        );
        $order_id = $this->domain->insert(TRANSFER_ORDERS, $data);

        return $order_id;
    }
        private function _makeUnConfirmedOrder($domain_id, $customer_id, $totalPrice, $vat,$discount,$discount_details, $cart_type = 'MADA',$period = 1)
    {
        $data = array(
            'Domain_ID' => $domain_id,
            'Customer_ID' => $customer_id,
            'Total_Price' => $totalPrice,
            'Vat' => $vat,
            'Period' => $period,            
            'Discount_Details' => $discount_details,            
            'Discount' => $discount,
            'Cart_Type' => $cart_type,
            'Created_AT' => date('Y-m-d H:i:s'),
        );
        $order_id = $this->domain->insert(ORDERS, $data);

        return $order_id;
    }

    /* -----------------------------------------------------------
    ---------------------- END Repayed unpayed orders -----------------
    -------------------------------------------------------------- */












    private function _change_contact_data($domain_id, $type)
    {
        $full_name = $this->input->post('full_name');
        $employer_name = $this->input->post('employer_name');
        $job_title = $this->input->post('job_title');
        $first_address = $this->input->post('first_address');
        $second_address = $this->input->post('second_address');
        $country = $this->input->post('country');
        $region = $this->input->post('region');
        $city = $this->input->post('city');

        $post_code = $this->input->post('post_code');
        $phone = $this->input->post('phone');
        $mobile = $this->input->post('mobile');
        $mobile_key = $this->input->post('mobile_key');

        $fax = $this->input->post('fax');
        $email = $this->input->post('email');

        $_POST['domain_id'] = $domain_id;
        $_POST['mobile_key'] = $mobile_key;

        $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString(119) . "</p>";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('domain_id', 'domain_id', 'numeric|trim|required|xss_clean');

        $this->form_validation->set_rules('full_name', 'full_name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('employer_name', 'employer_name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('job_title', 'job_title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('first_address', 'first_address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('second_address', 'second_address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('country', 'country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('region', 'region', 'trim|required|xss_clean');
        $this->form_validation->set_rules('city', 'city', 'trim|required|xss_clean');
        $this->form_validation->set_rules('post_code', 'post_code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required|xss_clean');       
        $this->form_validation->set_rules('fax', 'fax', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));

        }

        $domain = $this->domain->getDomainByID($domain_id);

        if (empty($domain)) {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));

        }

        /* send email verification to customer */
        $type = strtolower($type);
        $this->_send_change_request_to_admin($domain_id, $type);

    }

    public function domain_contact_change() /*PENDING*/
    {
        $domain_id = $this->input->post('domain_id');
        $domain_id = decryptIt($domain_id);

        $type = $this->input->post('applied_type');

        if ($type == 'Registrant') {
            $this->_change_registrar_data($domain_id);
        }

        if ($type == 'Admin') {
            $this->_change_contact_data($domain_id, $type);
        }

        if ($type == 'Technical') {
            $this->_change_contact_data($domain_id, $type);
        }

        if ($type == 'Financial') {
            $this->_change_contact_data($domain_id, $type);
        }

    }

    public function domain_delete($domain_id)
    {
        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);
        $data['domain_info'] = $this->domain->getDomainByID_All($domain_id);


        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain


        $this->LoadView_m('dashboard/domain_delete', $data);
    }

    public function domain_delete_request($domain_id)
    {
        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);
        $domain = $this->domain->getDomainByID_All($domain_id);

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        if (empty($domain)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        $type = 'delete_domain';
        $this->_send_change_request_to_admin($domain_id, $type);

    }

    public function domain_restore($domain_id)
    {
        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);
        $data['domain_info'] = $this->domain->getDomainByID_All($domain_id);

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

                // check if domain is deleted
        if ($data['domain_info']->Domain_Status == 'PENDING DELETE'){
            $epp_domain_info = $this->epp_lib->domain_info($data['domain_info']->Domain_Name.$data['domain_info']->TLD);
            $status = $epp_domain_info[0]['epp']['response']['resData']['domain:infData']['domain:status'][0]['@attributes']['s'];

            /* allow user to restore domain on the first 30 days of delete date */
            $deleted_at = $data['domain_info']->Deleted_at;            
            if(!empty($deleted_at)){
                    $now = time(); 
                    $your_date = strtotime($deleted_at);
                    $datediff = $now - $your_date;
                    $delete_days =  round($datediff / (60 * 60 * 24));

                    if($status == 'pendingDelete' && $delete_days <= 30){
                        // redirect($this->thisCtrl . "/domain_restore/".$domain_id);
                     } else {
                           $this->LoadView_m('dashboard/404', $data);
                     } 

            }else{
                  $this->LoadView_m('dashboard/404', $data);                
            }   
        }elseif ($data['domain_info']->Domain_Status == 'DELETED'){
             $this->LoadView_m('dashboard/404', $data);
        }else{
            $this->LoadView_m('dashboard/domain_restore', $data);
        }



        
    }

    public function domain_restore_request($domain_id)
    {
        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);
        $domain = $this->domain->getDomainByID_All($domain_id);

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        if (empty($domain)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }



        $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString(119) . "</p>";
        // check if domain is deleted
        if ($domain->Domain_Status == 'PENDING DELETE'){
            $epp_domain_info = $this->epp_lib->domain_info($domain->Domain_Name.$domain->TLD);
            $status = $epp_domain_info[0]['epp']['response']['resData']['domain:infData']['domain:status'][0]['@attributes']['s'];

            /* allow user to restore domain on the first 30 days of delete date */
            $deleted_at = $domain->Deleted_at;            
            if(!empty($deleted_at)){
                    $now = time(); 
                    $your_date = strtotime($deleted_at);
                    $datediff = $now - $your_date;
                    $delete_days =  round($datediff / (60 * 60 * 24));

                    if($status == 'pendingDelete' && $delete_days <= 30){
                        //redirect($this->thisCtrl . "/domain_restore/".$domain_id);
                    } else {
                        $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));
                    
                    } 

            }else{
              $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));   
              
            }   
        }elseif ($domain->Domain_Status == 'DELETED'){                
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));           
        }else{
            $type = 'restore_domain';
            $this->_send_change_request_to_admin($domain_id, $type);
        }

    }

    public function send_authentication_code($domain_id)
    {
        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);
        $domain = $this->domain->getDomainByID_All($domain_id);

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        if (empty($domain)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        $auth_code = $domain->Auth_Code;

        $_POST['auth_code'] = $auth_code;
        $_POST['domain_id'] = $domain_id;

        $type = 'auth_code';
        $this->_send_change_request_to_admin($domain_id, $type);

    }

    public function domain_unlock($domain_id)
    {
        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);
        $domain = $this->domain->getDomainByID_All($domain_id);

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        if (empty($domain)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        $type = 'unlock';
        $this->_send_change_request_to_admin($domain_id, $type);

    }

    public function domain_lock($domain_id)
    {
        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);
        $domain = $this->domain->getDomainByID_All($domain_id);

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        if (empty($domain)) {
            $this->session->set_flashdata('requestMsgErr', 119);
            redirect($this->thisCtrl . "/my_orders");
        }

        $type = 'lock';
        $this->_send_change_request_to_admin($domain_id, $type);

    }

    public function domain_dnssec_enable($domain_id)
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        $data['domain'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        $domain = $data['domain']->Domain_Name . $data['domain']->TLD;

        // check if tld is arabic
        $is_arabic = preg_match('~[a-z]~ui', $domain);

        if(!$is_arabic){
            $domain = idn_to_ascii($domain);
        }

        // redirect the user to dnssec form if he is not using dnet nameserver
        if ($data['domain']->Primary_Server != 'ns1.dnetns.com' || $data['domain']->Secondery_Server != 'ns2.dnetns.com') {
            $url = base_url('domain_dnssec_enable_form/?domain_id=' . encryptIt($domain_id));
               $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false,'url'=>$url)));


        }else{


        // enable dnssec
        $dnssec_enable = json_decode($this->cpanel_lib->enableDNSSEC($domain));

        if ($dnssec_enable->status == 1) {
            // get dnssec key
            $dnssec_key = json_decode($this->cpanel_lib->getDNSSECkey($domain));
        }

        //  dnssec key data
        $keys = $dnssec_key->data->$domain->keys;

        foreach($keys as $key){
            if($key->digests){

                $keys_data = array(
                    'key' => array(
                        'keyTag'=> $key->key_tag,
                        'alg'=> $key->algo_num,
                        'digests' => array(
                            array(
                            ),
                            array(
                                'algo_desc' => $key->digests[1]->algo_num,
                                'digest' => $key->digests[1]->digest
                            ),
                        ),
                        
                    ),
                );

            }
        }

        $_POST['keys'] = $keys_data;
        $type = 'dnssec_enable';
        $this->_send_change_request_to_admin($domain_id, $type);

    }

    }

    public function domain_dnssec_enable_form()
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($this->input->get('domain_id'));

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        $data['domain'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        $domain = $data['domain']->Domain_Name . $data['domain']->TLD;

        //  dnssec key data
        $keyTag = $this->input->post('keyTag');
        $alg = $this->input->post('alg');
        $digestType = $this->input->post('digestType');
        $digest = $this->input->post('digest');

        if ($keyTag && $alg && $digestType && $digest) {

        //  dnssec key data
        $keys = array(
            'key' => array(
                'keyTag'=> $keyTag,
                'alg'=> $alg,
                'digests' => array(
                    array(
                    ),
                    array(
                        'algo_desc' => $digestType,
                        'digest' => $digest
                    ),
                ),
                
            ),
        );

        $_POST['keys'] = $keys;
        $type = 'dnssec_enable';
        $this->_send_change_request_to_admin($domain_id, $type);

        } else {

            $data['domain_id'] = $domain_id;
            $this->LoadView_m('dashboard/domain_dnssec_enable_form', $data);

        }
    }

    public function domain_dnssec_disable($domain_id)
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        $data['domain'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        $domain = $data['domain']->Domain_Name . $data['domain']->TLD;

        /* there is no post for it the post will get from epp*/
        $type = 'dnssec_disable';
        $this->_send_change_request_to_admin($domain_id, $type);

    }

    public function domain_dns_management($domain_id)
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($domain_id);

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        $data['domain'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);

        $domain = $data['domain']->Domain_Name . $data['domain']->TLD;


        // check if tld is arabic
        $is_arabic = preg_match('~[a-z]~ui', $domain);

        if(!$is_arabic){
            $domain = idn_to_ascii($domain);
        }

        $dns_records = json_decode($this->cpanel_lib->getDomainDnsRecords($domain));
        $data['dns_records'] = $dns_records->data->zone[0]->record;

        $data['allowed_records_types'] = array("TXT", "A", "CNAME", "MX", "AAAA", "NS");

        if ($data['domain']->Primary_Server == 'ns1.dnetns.com' || $data['domain']->Secondery_Server == 'ns2.dnetns.com') {
            $data['dnet_nameserver'] = true;
        }

        $data['settings'] = $this->home_model->Get_Website_Configuration();

        $this->LoadView_m('dashboard/domain_dns_management', $data);

    }

    public function dns_record_add()
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($this->input->post('domain_id'));

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        $domain_detiles = $this->domain->getDomainDetailsByID($domain_id, $customer_id);

        $domain = $domain_detiles->Domain_Name . $domain_detiles->TLD;

        // check if tld is arabic
        $is_arabic = preg_match('~[a-z]~ui', $domain);

        if(!$is_arabic){
            $domain = idn_to_ascii($domain);
        }

        $name = rtrim(trim($this->input->post('name')), '.');
        $type = $this->input->post('type');
        $address = rtrim(trim($this->input->post('value')), '.');
        $ttl = $this->input->post('ttl');
        $preference = trim($this->input->post('priority'));

        if(!$ttl){
            $ttl = '86400';
        }
        
        
        $record = array(
            "name" => $name,
            "type" => $type,
            "address" => $address,
            "ttl" => $ttl,
            "preference" => $preference,
        );

        $result = json_decode($this->cpanel_lib->setDomainDnsRecord($domain, $record));

        if($result->result[0]){
            echo json_encode(array("status" => $result->result[0]->status,"statusmsg" => $result->result[0]->statusmsg));
        } else {
            echo json_encode(array("status" => $result->status,"statusmsg" => $result->statusmsg));
        }

    }

    public function dns_record_edit()
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($this->input->post('domain_id'));

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        $domain_detiles = $this->domain->getDomainDetailsByID($domain_id, $customer_id);

        $domain = $domain_detiles->Domain_Name . $domain_detiles->TLD;

        // check if tld is arabic
        $is_arabic = preg_match('~[a-z]~ui', $domain);

        if(!$is_arabic){
            $domain = idn_to_ascii($domain);
        }

        $line = $this->input->post('line');
        $name = $this->input->post('name');
        $type = $this->input->post('type');
        $address = $this->input->post('value');
        $ttl = $this->input->post('ttl');
        $preference = $this->input->post('priority');

        $record = array(
            "line" => $line,
            "name" => $name,
            "type" => $type,
            "address" => $address,
            "ttl" => $ttl,
            "preference" => $preference,
        );

        $result = json_decode($this->cpanel_lib->editDomainDnsRecord($domain, $record));

        if($result->result[0]){
            echo json_encode(array("status" => $result->result[0]->status,"statusmsg" => $result->result[0]->statusmsg));
        } else {
            echo json_encode(array("status" => $result->status,"statusmsg" => $result->statusmsg));
        }

    }

    public function dns_record_delete()
    {

        $customer_id = $this->session->userdata($this->site_session->userid());
        $domain_id = decryptIt($this->input->post('domainid'));
        $line = $this->input->post('line');

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        $domain_detiles = $this->domain->getDomainDetailsByID($domain_id, $customer_id);

        $domain = $domain_detiles->Domain_Name . $domain_detiles->TLD;

        // check if tld is arabic
        $is_arabic = preg_match('~[a-z]~ui', $domain);

        if(!$is_arabic){
            $domain = idn_to_ascii($domain);
        }

        $result = json_decode($this->cpanel_lib->deleteDomainDnsRecord($domain, $line));

        echo json_encode(array("status" => $result->result[0]->status));

    }


       /*
        ----------- 27/01/2021 by Mohammed Arabid --------------
        -------------------------------------------------------- */
    public function _verify_domain_grace_period($domain_info){

        $domain_name = $domain_info->Domain_Name . $domain_info->TLD;
        $domain_id   = $domain_info->Domain_ID;
        $auth_code   = $domain_info->Auth_Code;

        $responseJSON = $this->epp_lib->domain_info($domain_name, $domain_info->Domain_ID, $auth_code);
        $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
        if ($code != '1000') {
            /* error fomain info*/
            $this->session->set_flashdata('error', getSystemString('domain_info_error'));
            redirect($this->thisCtrl . "/domain_details/".encryptIt($domain_id));

        } else {

            if($responseJSON[0]['epp']['response']['resData']['domain:infData']['domain:crID'] == $this->config->item('EPP_USERNAME')){

                $created_date = $responseJSON[0]['epp']['response']['resData']['domain:infData']['domain:crDate'];
                $now = time(); 
                $your_date = strtotime($created_date);
                $datediff = $now - $your_date;
                $crDate_nbr_days =  round($datediff / (60 * 60 * 24));

                if($crDate_nbr_days <= 60){
                    /* error for 60 days */
                    $this->session->set_flashdata('error', getSystemString('renew_create_date_error'));
                    redirect($this->thisCtrl . "/domain_details/".encryptIt($domain_id));

                }else{
                                /* make check for the client transfer flags*/
                $status = $responseJSON[0]['epp']['response']['resData']['domain:infData']['domain:status'];
                                // checking if transfer prohabited
                                foreach($status as $row){
                                    $flag = $row['s'];
                                    if(empty($flag)){$flag = $row['@attributes']['s'];}
                                    if($flag == 'clientRenewProhibited' || $flag == 'serverRenewProhibited'){
                                        $this->session->set_flashdata('error', getSystemString('flags_renew_error'));
                                        redirect($this->thisCtrl . "/domain_details/".encryptIt($domain_id));                                      
                                    }elseif($flag == 'serverTransferProhibited'){
                                    $this->session->set_flashdata('error', getSystemString('domain_transfer_lock_error'));
                                    redirect($this->thisCtrl . "/domain_details/".encryptIt($domain_id));

                                    }
                                }


                }/* end create date */
            }        
      }/*end domain info */
    }

   public function domain_renew_details($domain_id)
    {

        
        $domain_id = decryptIt($domain_id);
        $data['domain_info'] = $this->domain->getDomainByID_All($domain_id);
        $this->_verify_domain_grace_period($data['domain_info']);
        $expire_date = $data['domain_info']->Expire_Date;
        $today_date  = date('Y-m-d');
        $diff = abs(strtotime($expire_date)-strtotime($today_date));
        $years = floor($diff / (365*60*60*24));
        $data['years_number'] = $years;
        $rest_years = 10-$years-1; 
        if($rest_years == 0){
            $this->session->set_flashdata('error', getSystemString('domain_info_error'));
            redirect($this->thisCtrl . "/domain_details/".encryptIt($domain_id));
        }


        $this->LoadView_m('dashboard/domain_renew_details', $data);


    }

    public function domain_renew()
    {
        $customer_id =  $this->session->userdata($this->site_session->userid());
        $domain_id = $this->input->post('domain_id');
        $domain_id = decryptIt($domain_id);
        $period = $this->input->post('period');

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $customer_id);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain


        $domain         = $this->domain->getDomainByID_All($domain_id);

        $this->_verify_domain_grace_period($domain);

        $data['domain'] = $domain;
        $data['period'] = $period;
        

        //if(!$is_payed){

        $this->load->library('payments/Hyperpay_lib');

        $data['success'] = getSystemString(254);

        /* renew fees */
        $domain_his = $this->domain->getDomainHistory($data['domain']->DH_ID);
        $domain_ltd = json_decode($domain_his->LTD_History);
        $tld_info = $this->domain->getDomainTldsByID($domain_ltd->TLD_ID);
        $data['renew_price_per_year'] = $tld_info->Renew_Price;
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
        $total_price = ($renew_price + $total_vat)*$period;
        $total_price = number_format((float) $total_price, 2, '.', '');
        $data['total_price'] = $total_price;
        $cart_type = 'MADA';
        $customer_id =  $domain->Admin->Org_Usr_ID;

        
        /* custumer discount */
        $discount_type = 'renew';
        $c_discount = $this->domain->getCustumerDiscount($data['domain']->Customer_ID,$discount_type);
        $discount = 0;
        $discount_details = '';
        if(!empty($c_discount)){

            // get disscount detiles
            $c_discount_percentage = $c_discount->d_value;
            $c_discount_value = ($total_price * ($c_discount_percentage / 100));
            $data['discount_percentage'] = $c_discount_percentage;
            $data['discount_value'] = $c_discount_value;
            $data['discount_value_before_vat'] = number_format((float) ($period * $renew_price * ($c_discount_percentage / 100)), 2, '.', ''); 


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


        $order_id = $this->_makeUnConfirmedRenewOrder($domain_id, $customer_id, $total_price, $vat,$cart_type,$discount,$discount_details);
        $or_id = 'RN'.$order_id;
        $admin = $this->domain->get_one(['Org_Usr_ID' => $customer_id], '*', USERS);
        $customer->Email    = $admin->User_Email;
        $customer->Fullname = $admin->Full_Name;

        $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price, $or_id, $customer, $cart_type));


        $customer_id =  $this->session->userdata($this->site_session->userid());
        $this->load->library('E_Wallet');
        $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($customer_id,$total_price);
        $data['can_add_transaction'] = $can_add_transaction; 

        $code = $response->result->code;
        if ($code == '000.200.100') {

            $data['customer'] = $customer;
            $data['checkout_id'] = $response->id;

            // * Payment Log
            $log = array(
                'Customer_ID' => $customer_id,
                'Type' => 'Select Hyperpay payment method',
                'Response' => json_encode($response),
            );
            $this->domain->addAPISLog($log);

                /*  add pending change request */
                $request_status = 'pending';
                $type   = 'renew';
                $new_status = 'deleted';
                $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $request_status,$new_status);
                $request_post_data = array(
                    'Customer_ID' => $customer_id,
                    'checkout_id' =>   $response->id,
                    'period' => $period,
                    'cart_type' => $cart_type,
                    'domain_id' => $domain_id,                
                );           
                $request_data = [
                    'DCR_Request_Type' => $type,
                    'DCR_Domain_ID' => $domain_id,
                    'DCR_USER_ID' => $customer_id,
                    'DCR_Admin_ID' => $domain->Registrar_ID,
                    'DCR_Status' => $request_status,
                    'DCR_Phone_Verified' => 0,
                    'DCR_Verify_Page_Token' => '',
                    'DCR_POST_DATA' => json_encode($request_post_data),
                    'Need_Payment'  => 1,
                ];

                $request_id = $this->domain->insert(REQUEST, $request_data);

            //update subscription customer payment data
            $domain_order_up = array(
                'OR_ID' => $or_id,
                'Payment_Referance' => $response->id,
                'Request_ID' => $request_id,
            );
            $where = array('DO_ID' => $order_id);
            $this->domain->save($domain_order_up, $where, ORDERS);
            $this->session->set_userdata('Payment_Referance', $response->id);

        }

        $this->LoadView_m('dashboard/domain_renew', $data);

        // }else{
        //      $this->LoadView_m('dashboard/domain_renew', $data);
        // }

    }


    public function payment_methods_renew()
    {

        
        $domain_id = $this->input->post('domain_id');
        $domain_id = decryptIt($domain_id);
        $period = $this->input->post('period');
        $cart_type = $this->input->post('cart_type');
        $data['cart_type'] = $cart_type;


        //get all verified renew payments to get the last renew date
       // $verified_renew = $this->domain->getRenewVerifiedPayment($domain_id);
        $domain         = $this->domain->getDomainByID_All($domain_id);

        $data['domain'] = $domain;
        $expire_date = $domain->Expire_Date;

        //if(!$is_payed){

        $this->load->library('payments/Hyperpay_lib');
        $data['success'] = getSystemString(254);


        /* renew fees */
        $domain_his = $this->domain->getDomainHistory($data['domain']->DH_ID);
        $domain_ltd = json_decode($domain_his->LTD_History);
        $tld_info = $this->domain->getDomainTldsByID($domain_ltd->TLD_ID);
        $data['renew_price_per_year'] = $tld_info->Renew_Price;
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
        $total_price = ($renew_price + $total_vat)*$period;
        $total_price = number_format((float) $total_price, 2, '.', '');
        $data['total_price'] = $total_price;
        $customer_id =  $domain->Admin->Org_Usr_ID;

        /* custumer discount */
        $discount_type = 'renew';
        $c_discount = $this->domain->getCustumerDiscount($data['domain']->Customer_ID,$discount_type);
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

        $order_id = $this->_makeUnConfirmedRenewOrder($domain_id, $customer_id, $total_price, $vat,$cart_type,$discount,$discount_details);
        $or_id = 'RN'.$order_id;
        $admin = $this->domain->get_one(['Org_Usr_ID' => $customer_id], '*', USERS);
        $customer->Email    = $admin->User_Email;
        $customer->Fullname = $admin->Full_Name;


        $customer_id =  $this->session->userdata($this->site_session->userid());
        $this->load->library('E_Wallet');
        $can_add_transaction = $this->e_wallet->checkIfCanMakeTransactions($customer_id,$total_price);
        $data['can_add_transaction'] = $can_add_transaction; 


        $code = 0;
        if($cart_type == 'WALLET'){ 
                $data['current_balance'] = $this->e_wallet->getCustomerWalletBalance($customer_id);
                $payment_referance =  randomNumber(20).'-e-wallet';              
        }else{
            $response = json_decode($this->hyperpay_lib->HyperPayCheckOut($total_price, $or_id, $customer,$cart_type));
            $code = $response->result->code;
            $payment_referance = $response->id; 
        }

        
        if ($code == '000.200.100' || $cart_type=='WALLET') {

            $data['customer'] = $customer;
            $data['checkout_id'] = $payment_referance;
            $data['cart_type'] = $cart_type;
            $data['period'] = $period;



            // * Payment Log
            $log = array(
                'Customer_ID' => $customer_id,
                'Type' => 'Select Hyperpay payment method',
                'Response' => json_encode($response),
            );
            $this->domain->addAPISLog($log);


                /*  add pending change request */
                $request_status = 'pending';
                $type   = 'renew';
                $new_status = 'deleted';
                $this->domain->makeDisableAllPreviousRequest($type, $domain_id, $request_status,$new_status);
                $request_post_data = array(
                    'Customer_ID' => $customer_id,
                    'checkout_id' =>  $payment_referance,
                    'period' => $period,
                    'cart_type' => $cart_type, 
                    'domain_id' => $domain_id,                                                
                );

                $request_data = [
                    'DCR_Request_Type' => $type,
                    'DCR_Domain_ID' => $domain_id,
                    'DCR_USER_ID' => $customer_id,
                    'DCR_Admin_ID' => $domain->Registrar_ID,
                    'DCR_Status' => $request_status,
                    'DCR_Phone_Verified' => 0,
                    'DCR_Verify_Page_Token' => '',
                    'DCR_POST_DATA' => json_encode($request_post_data),
                    'Need_Payment'  => 1,
                ];

                $request_id = $this->domain->insert(REQUEST, $request_data);

            //update subscription customer payment data
            $domain_order_up = array(
                'OR_ID' => $or_id,
                'Payment_Referance' => $payment_referance,
                'Request_ID' => $request_id,                
            );
            $where = array('DO_ID' => $order_id);
            $this->domain->save($domain_order_up, $where, ORDERS);
            $this->session->set_userdata('Payment_Referance', $payment_referance);


            $hayperPay_panel= $this->load->view('customer/snippets/hyperpay_panel_renew', $data, TRUE);
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true,'hayperPay_panel'=>$hayperPay_panel)));

        }else{
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false)));
        }


                    

    }


    public function renew_payment_success()
    {

        $this->load->library('payments/Hyperpay_lib');

        $payment_referance = $this->input->GET('id');

        $domain_order_info = $this->domain->getDomainOrderByReferancePayment($payment_referance);
        if (!$domain_order_info) {
            show_404();
            exit();
        }

        $cart_type   = $domain_order_info->Cart_Type;                   
        $total_price = $domain_order_info->Total_Price;
        $domain_id   = $domain_order_info->Domain_ID;
        $expire_date = $domain_order_info->domain_expire_date;
        $request_id  = $domain_order_info->Request_ID;


        $transaction_result = false;
        if (!$domain_order_info->Payment_Verified) {

            if($cart_type == 'WALLET'){

                /* add wallet transactions*/ 
                $customer_id =  $this->session->userdata($this->site_session->userid());               
                $this->load->library('E_Wallet');
                $transaction_result =  $this->e_wallet->modifyCreditsForCustomers($customer_id,'-',$total_price,'Domain Renew',$customer_id,$payment_referance);
                $response_id = $payment_referance;
                $order_id = $domain_order_info->OR_ID;


            }else{
                $response = json_decode($this->hyperpay_lib->VerifyPayment($payment_referance,$cart_type));
                $code = $response->result->code;
                $order_id = $response->merchantTransactionId;
                $response_id = $response->id;
                //verify payment response
                $log = array(
                    'Customer_ID' => $customer_id,
                    'Type' => 'Verify Payment Response',
                    'Response' => json_encode($response),
                );
                $this->domain->addAPISLog($log); 
            }


            if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code) || $transaction_result) {



                /* renew the order with nic */
                $customer_id = $domain_order_info->Customer_ID;
                $domain = $domain_order_info->Domain_Name . $domain_order_info->TLD;
                $request_info = $this->domain->getRequesDetails($request_id,$customer_id);
                $post_data = json_decode($request_info->DCR_POST_DATA);
                $period = $post_data->period;

                /* make order verified */
                $data = array(
                        'HY_ID'=> $response_id,
                        'Payment_Verified' => 1,
                        'Payed_AT' => date('Y-m-d H:i:s'),
                );
                $where = array('OR_ID' => $order_id);
                $this->domain->save($data, $where, ORDERS);

                $expire_date = date('Y-m-d',strtotime($expire_date));

                $responseJSON = $this->epp_lib->domain_renew($domain, $expire_date, $period, $domain_id);
                $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];

               
                /* if the renew process failed make the domain status to pending */
                if ($code != '1000') {
                    $request_status = 'refused';
                        if($cart_type == 'WALLET'){
                               $customer_id =  $this->session->userdata($this->site_session->userid());               
                                $this->load->library('E_Wallet');
                                $transaction_result =  $this->e_wallet->modifyCreditsForCustomers($customer_id,'+',$domain_order_info->Total_Price,'Refund Domain Renew',$customer_id,$response_id);
                                 $refund_data = ['Payment_Refunded' => 1];
                                $this->domain->save($refund_data, ['HY_ID' => $response_id], ORDERS);
                        }else{
                            /* refund the amount of payments*/
                            $total_price = number_format((float) $domain_order_info->Total_Price, 2, '.', '');
                             $response = json_decode($this->hyperpay_lib->RefundPayment($response_id, $total_price, $cart_type));
                                $log = array(
                                        'Customer_ID' => $customer_id,
                                        'Order_ID' => $domain_order_info->OR_ID,
                                        'Type' => 'Hyperpay payment refund',
                                        'Response' => json_encode($response),
                                    );
                                $this->domain->addAPISLog($log);
                                $code = $response->result->code;
                                if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code)) {
                                    $refund_data = ['Payment_Refunded' => 1];
                                    $this->domain->save($refund_data, ['HY_ID' => $response_id], ORDERS);              
                                }
                            /* end refund */
                        }

        

                } else {
                    /* add Done request */
                    $request_status = 'approved';
                    $domain_info = $this->epp_lib->domain_info($domain,$domain_id);
                    $expire_date = date('Y-m-d H-i-s',strtotime($domain_info[0]['epp']['response']['resData']['domain:infData']['domain:exDate']));

                    //$expire_date =  date('Y-m-d', strtotime('+'.$period.' year', strtotime($expire_date)));
                    $domain__data = ['Expire_Date' => $expire_date];
                    $this->domain->save($domain__data, ['Domain_ID' => $domain_id], DOMAIN);


                    /* insert order logs */
                    $app_log = [
                        'DAL_Domain_ID' => $domain_order_info->Domain_ID,
                        'DAL_User_ID' => $domain_order_info->Customer_ID,
                        'DAL_Created' => date("Y-m-d H:i:s"),
                        'DAL_Type'=>'Customer',
                    ];
                    $app_log['DAL_Status'] = 'renew_domain_payed';
                    $this->domain->insert(APP_LOG, $app_log);
                    $app_log['DAL_Status'] = 'email_invoice';
                    $this->domain->insert(APP_LOG, $app_log);

                    /* send renew order email */
                    $subject = 'Domain Renew Order';
                    $this->_sendOrderEmail($order_id);

                    /* delete domain notifications  */
                    $this->domain->delete_domain_notification($domain_id);

                }/* end domain renewed successfuly */

                $request_update_status = ['DCR_Status' =>  $request_status,'DCR_Admin_Approve'=> 1];
                $affected_id = $this->domain->save($request_update_status, ['DCR_ID' => $request_id], REQUEST); 









   

            } else {

                $data = array(
                    'Payment_Verified' => 0,
                    'Payed_AT' => date('Y-m-d H:i:s'),
                );

                $where = array('OR_ID' => $order_id);
                $this->domain->save($data, $where, ORDERS);
                $this->session->unset_userdata('Payment_Reference');

            }
        }

        $data['domain_order'] = $this->domain->getDomainOrderByReferancePayment($payment_referance);
        $data['url'] = base_url('domain_details/' . encryptIt($data['domain_order']->Domain_ID));

        $this->LoadView_m('customer/domain_registration/domain_renew_success', $data);

    }





    public function domain_waiver($domain_id){

        $domain_id = decryptIt($domain_id);
        $userid = $this->session->userdata($this->site_session->userid());

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $userid);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        if (!empty($domain_id)) {
            $domain_waiver = $this->domain->get_domain_waiver($userid, $domain_id);
            $admin = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
            $domain_info = $data['domain_details'];
            $domain_name = $domain_info->Domain_Name.$domain_info->TLD;

        }



        $data['domain_name'] = $domain_name;
        $data['admin_email'] = $admin->User_Email;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_name', 'domain name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('admin_email', 'domain name', 'trim|required|xss_clean');


        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        if ( null !== $domain_name) {

        

            $data['activity_types'] = $this->domain->getConstantsByParantID(68);
            $data['countries'] = $this->domain->get_all(null, '*', null, 'countries');

            $data['customer'] = $this->customer_model->getCustomerData($userid);
            $data['domain_name'] = $domain_name;
            $data['domain'] = $domain_waiver;

            //dd($data['domain']);



            $data['pageTitle'] = getSystemString(100);

  

            $this->LoadView_m('domain_registration/waiver/domain_register_step_1', $data);
        }


       



    }



       public function edit_waiver_docs($domain_id)
    {
        $domain_id = decryptIt($domain_id);
        
        $userid = $this->session->userdata($this->site_session->userid());
        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $userid);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        if (!empty($domain_id)) {
            $domain_waiver = $this->domain->get_domain_waiver($userid, $domain_id);
            $admin = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
            $domain_info = $this->domain->getDomainByID($domain_id);
            $domain_name = $domain_info->Domain_Name.$domain_info->TLD;

        }
        $customer_id = $userid;

        $primary_server = $domain_info->Primary_Server;
        $secondary_server = $domain_info->Secondery_Server;
        $period = 1; // one year



        // if (empty($domain_name) || empty($primary_server) || empty($secondary_server)) {
        //     $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
        //     redirect($this->thisCtrl . "/my_orders");
        // }

        if(!empty($_POST)){

        $waiver_reasons = $this->input->post('waiver_reasons');


        $server_ips = $this->input->post('server_ips');
        $secondary_servers = $this->input->post('secondary_servers');
        $secondary_servers_ips = $this->input->post('secondary_servers_ips');

        if(!empty($secondary_servers)){

            for($i=0; $i<count($secondary_servers); $i++){
                $ss[] = ['name_server'=>$secondary_servers[$i],'ip'=>$secondary_servers_ips[$i]];
            }
            $secondary_servers = $ss;
        }


        /* -----------------------------------------------------------
        ---------------------- Oganization info -----------------
        -------------------------------------------------------- */

        $activity_type = $this->input->post('activity_type');
        $entity_name = $this->input->post('entity_name');
        $first_address_org = $this->input->post('first_address_org');
        $second_address_org = $this->input->post('second_address_org');
        $country_org = $this->input->post('country_org');
        $region_org = $this->input->post('region_org');
        $city_org = $this->input->post('city_org');
        $post_code_org = $this->input->post('post_code_org');




        /* -----------------------------------------------------------
        ---------------------- Users info -----------------
        -------------------------------------------------------- */

        $tec_man = $this->input->post('tech-man');
        $eco_man = $this->input->post('eco-man');

        $full_name = $this->input->post('full_name');
        $employer_name = $this->input->post('employer_name');
        $job_title = $this->input->post('job_title');
        $first_address = $this->input->post('first_address');
        $second_address = $this->input->post('second_address');
        $city = $this->input->post('city');
        $country = $this->input->post('country');
        $region = $this->input->post('region');
        $post_code = $this->input->post('post_code');
        $phone = $this->input->post('phone');
        $mobile = $this->input->post('mobile');
        $mobile_key = $this->input->post('mobile_key');
        $fax = $this->input->post('fax');
        $email = $this->input->post('email');

        $nbr_urs = 0;
        for ($i = 0; $i < count($full_name); $i++) {
            if (!empty($full_name[$i])) {
                $nbr_urs++;
            }
        }


        $customer__data = $this->domain->get_one(['Customer_ID' => $customer_id], '*', 'customers');
        $registrant_epp_id = randomNumber(10).'0-dnet';
        $registrar_data = [
            'Epp_ID' => $registrant_epp_id,            
            'Full_Name' => $entity_name,
            'Employer_Name' => $entity_name,
            'User_Job_Title' => $job_title[0],
            'User_Country_ID' => $country_org,
            'User_Region' => $region_org,
            'User_City' => $city_org,
            'User_Post_Code' => $post_code_org,
            'User_Fax' => $fax[0],
            'User_Phone' => $phone[0],
            'User_Email' => $email[0],
            'User_Mobile' => $mobile[0],
            'Mobile_Key' => $mobile_key[0],
            'User_Address1' => $first_address_org,
            'User_Address2' => $second_address_org,
            'Country_Code' => 'SA',
        ];



        $admin_data = '';
        $tech_data = '';
        $billing_data = '';

        if ($nbr_urs == 1) {
            $admin_epp_id = randomNumber(10).'1-dnet';            
            $users_domain_data = [
                'Epp_ID' => $admin_epp_id,                                
                'Full_Name' => $full_name[0],
                'Employer_Name' => $employer_name[0],
                'User_Job_Title' => $job_title[0],
                'User_Country_ID' => $country[0],
                'User_Region' => $region[0],
                'User_City' => $city[0],
                'User_Post_Code' => $post_code[0],
                'User_Fax' => $fax[0],
                'User_Phone' => $phone[0],
                'User_Email' => $email[0],
                'User_Mobile' => $mobile[0],
                'Mobile_Key' => $mobile_key[0],                
                'User_Address1' => $first_address[0],
                'User_Address2' => $second_address[0],
                'Country_Code' => 'SA',
            ];
            $admin_data = $users_domain_data;

        }
        if ($nbr_urs == 2) {
            $admin_epp_id = randomNumber(10).'1-dnet';                        
            $users_domain_data = [
                'Epp_ID' => $admin_epp_id,
                'Full_Name' => $full_name[0],
                'Employer_Name' => $employer_name[0],
                'User_Job_Title' => $job_title[0],
                'User_Country_ID' => $country[0],
                'User_Region' => $region[0],
                'User_City' => $city[0],
                'User_Post_Code' => $post_code[0],
                'User_Fax' => $fax[0],
                'User_Phone' => $phone[0],
                'User_Email' => $email[0],
                'User_Mobile' => $mobile[0],
                'Mobile_Key' => $mobile_key[0],
                'User_Address1' => $first_address[0],
                'User_Address2' => $second_address[0],
                'Country_Code' => 'SA',
            ];
            $admin_data = $users_domain_data;




            if ($tec_man) {
                $tech_epp_id = randomNumber(10).'2-dnet';                
                $users_domain_data = [
                    'Epp_ID' => $tech_epp_id,                    
                    'Full_Name' => $full_name[1],
                    'Employer_Name' => $employer_name[1],
                    'User_Job_Title' => $job_title[1],
                    'User_Country_ID' => $country[1],
                    'User_Region' => $region[1],
                    'User_City' => $city[1],
                    'User_Post_Code' => $post_code[1],
                    'User_Fax' => $fax[1],
                    'User_Phone' => $phone[1],
                    'User_Email' => $email[1],
                    'User_Mobile' => $mobile[1],
                    'Mobile_Key' => $mobile_key[1],
                    'User_Address1' => $first_address[1],
                    'User_Address2' => $second_address[1],
                    'Country_Code' => 'SA',
                ];
            $tech_data = $users_domain_data;


            }

            if ($eco_man) {
                $billing_epp_id = randomNumber(10).'3-dnet';
                $users_domain_data = [
                    'Epp_ID' => $billing_epp_id,                                        
                    'Full_Name' => $full_name[2],
                    'Employer_Name' => $employer_name[2],
                    'User_Job_Title' => $job_title[2],
                    'User_Country_ID' => $country[2],
                    'User_Region' => $region[2],
                    'User_City' => $city[2],
                    'User_Post_Code' => $post_code[2],
                    'User_Fax' => $fax[2],
                    'User_Phone' => $phone[2],
                    'User_Email' => $email[2],
                    'User_Mobile' => $mobile[2],
                    'Mobile_Key' => $mobile_key[2],
                    'User_Address1' => $first_address[2],
                    'User_Address2' => $second_address[2],
                    'Country_Code' => 'SA',
                ];
            $billing_data = $users_domain_data;


            }

        }
        if ($nbr_urs == 3) {
            $admin_epp_id = randomNumber(10).'1-dnet';                                    
            $users_domain_data = [
                'Epp_ID' => $admin_epp_id,                
                'Full_Name' => $full_name[0],
                'Employer_Name' => $employer_name[0],
                'User_Job_Title' => $job_title[0],
                'User_Country_ID' => $country[0],
                'User_Region' => $region[0],
                'User_City' => $city[0],
                'User_Post_Code' => $post_code[0],
                'User_Fax' => $fax[0],
                'User_Phone' => $phone[0],
                'User_Email' => $email[0],
                'User_Mobile' => $mobile[0],
                'Mobile_Key' => $mobile_key[0],
                'User_Address1' => $first_address[0],
                'User_Address2' => $second_address[0],
            ];
            $admin_data = $users_domain_data;



            $tech_epp_id = randomNumber(10).'2-dnet';                            
            $users_domain_data = [
                'Epp_ID' => $tech_epp_id,                                    
                'Full_Name' => $full_name[1],
                'Employer_Name' => $employer_name[1],
                'User_Job_Title' => $job_title[1],
                'User_Country_ID' => $country[1],
                'User_Region' => $region[1],
                'User_City' => $city[1],
                'User_Post_Code' => $post_code[1],
                'User_Fax' => $fax[1],
                'User_Phone' => $phone[1],
                'User_Email' => $email[1],
                'User_Mobile' => $mobile[1],
                'Mobile_Key' => $mobile_key[1],
                'User_Address1' => $first_address[1],
                'User_Address2' => $second_address[1],
            ];
            $tech_data = $users_domain_data;



            $billing_epp_id = randomNumber(10).'3-dnet';            
            $users_domain_data = [
                'Epp_ID' => $billing_epp_id,                                                       
                'Full_Name' => $full_name[2],
                'Employer_Name' => $employer_name[2],
                'User_Job_Title' => $job_title[2],
                'User_Country_ID' => $country[2],
                'User_Region' => $region[2],
                'User_City' => $city[2],
                'User_Post_Code' => $post_code[2],
                'User_Fax' => $fax[2],
                'User_Phone' => $phone[2],
                'User_Email' => $email[2],
                'User_Mobile' => $mobile[2],
                'Mobile_Key' => $mobile_key[2],
                'User_Address1' => $first_address[2],
                'User_Address2' => $second_address[2],
            ];
            $billing_data = $users_domain_data;

 

        }

        /* -----------------------------------------------------------
        ----------------------Domain -----------------
        -------------------------------------------------------- */

        $primary_server = $this->input->post('primary_server');
        $secondary_server = $this->input->post('secondary_server');

        $domain_data = ['Customer_ID' => $customer_id,
            'Domain_Name' => $domain_name,
            'TLD' => $domain_info->TLD,
            'Period' => $period,
            'Primary_Server' => $primary_server,
            'Secondery_Server' => $secondary_server,
            'Secondary_Servers' => json_encode($secondary_servers),
            'Server_ips' => json_encode($server_ips),
        ];


        $waiver_data = [
                            'Org_Data'=>json_encode($registrar_data),
                            'Registrant_Data'=>json_encode($registrar_data),
                            'Admin_Data'=>json_encode($admin_data),
                            'Tech_Data'=>json_encode($tech_data),
                            'Billing_Data'=> json_encode($billing_data),
                            'Name_Servers_Data'=>json_encode($domain_data), 
                            'Waivers_Reasons'   =>$waiver_reasons,  
                            'Admin_Email'   => $admin->User_Email, 
                            'Org_Activity_ID' => $activity_type,
                            'DW_Customer_ID'=>$customer_id,
                            'DW_Domain_ID'=>$domain_id                  
                       ];

        if (empty($domain_waiver)) {
            $dw_id = $this->domain->insert(WAIVERS, $waiver_data);
        } else {
            $this->domain->save($waiver_data, ['DW_ID' => $domain_waiver->DW_ID], WAIVERS);
        }

    }// end post
        

        $data['domain'] = $domain_waiver;
        $data['doc_types'] = $this->domain->getAllDocsType();
        $data['doc_issures'] = $this->domain->getAllIssuers();

        $data['domain_id'] = $domain_id;
        $this->LoadView_m('domain_registration/waiver/domain_register_step_2', $data);

    }

        public function edit_waiver_review($domain_id)
    {

        $domain_id = decryptIt($domain_id);
        
        $userid = $this->session->userdata($this->site_session->userid());

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $userid);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        if (!empty($domain_id)) {
            $domain_waiver = $this->domain->get_domain_waiver($userid, $domain_id);
            $admin = $this->domain->getDomainOrgUsers($domain_id, 'Admin');
            $domain_info = $data['domain_details'];
            $domain_name = $domain_info->Domain_Name.$domain_info->TLD;

        }
        $customer_id = $userid;

        if (empty($domain_name)) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        $data['domain_name'] = $domain_name;
        //support_file
        $doc_number = $this->input->post('doc_number');
        $doc_date = $this->input->post('doc_date');
        $doc_title = $this->input->post('doc_title');
        $doc_type = $this->input->post('document-type');
        $relation = $this->input->post('relation_between_registrar');
        $relation = $this->input->post('relation_between_registrar');
        $hijri_date = $this->input->post('hijri_date');
        $meladi_date = $this->input->post('meladi_date');

        

            $doc_info = $this->domain->getDocsTypeByID($doc_type);
            $issures_id = $doc_info->Issuer_ID;
            $doc_code = $doc_info->Code;

            if($doc_info->Issuer_ID == 0){
                $issures_id = $this->input->post('issures_id');
                $issuer = $this->domain->getIssuersByID($issures_id);
                $data['issuer'] = $issuer;
                $doc_code = $issuer->Code;
            }

        $config['upload_path'] = $GLOBALS['domain_doc_dir'];
         $config['allowed_types'] = 'jpeg|png|pdf|bmp';
        $config['max_size'] = '40000';
        $config['overwrite'] = true;
        $this->load->library('upload', $config);

        // $domain_id =  $this->session->userdata($this->site_session->domain_id());
        //  $this->db->where('Domain_ID',$domain_id)->delete(DOCUMENT);
        $data['domain_id'] = $domain_id;
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('domain_id', 'tld id', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');

            redirect($this->thisCtrl . "/my_orders");
        }

        $update_info = [
            'Relation_Between' => $relation,
        ];

        $this->domain->save($update_info, ['DW_ID' => $domain_waiver->DW_ID], WAIVERS);

 $domain_support = json_decode($domain->Support_File);
            $support_doc = [
                    'Domain_ID' => $domain_id,
                    'Doc_Title' => $doc_title,
                    'Doc_Type' => 'support',
                    'Doc_Type_ID' => $doc_type,
                    'Doc_Num' => $doc_number,
                    'Doc_Date' => $doc_date,
                    'Doc_Path' => $domain_support->Doc_Path,
                    'Doc_Code' => $doc_code,
                    'Doc_Issures_ID'=> $issures_id,
                    'Hijri_Date' => $hijri_date,
                    'Meladi_Date' => $meladi_date,
                ];
               $support_doc = ['Support_File'=>json_encode($support_doc)];
               $this->domain->save($support_doc, ['DW_ID' => $domain_waiver->DW_ID], WAIVERS);

        if (isset($_FILES['support_file']) && !empty($_FILES['support_file']['name'])) {



            if (!$this->upload->do_upload("support_file")) {
               $upload_error = $this->upload->display_errors();
                $this->session->set_flashdata('requestMsgErr', $upload_error);
                redirect($this->thisCtrl ."/domain_waiver/".$domain_id);

            } else {
                $uploadedFileData = $this->upload->data();
                $support_file = md5(time()) . 'support_file' . $uploadedFileData['file_ext'];
                rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $support_file);

                //speech_file
                $support_doc = [
                    'Domain_ID' => $domain_id,
                    'Doc_Title' => $doc_title,
                    'Doc_Type' => 'support',
                    'Doc_Type_ID' => $doc_type,
                    'Doc_Num' => $doc_number,
                    'Doc_Date' => $doc_date,
                    'Doc_Path' => $support_file,
                    'Doc_Code' => $doc_code,
                    'Doc_Issures_ID'=> $issures_id,
                    'Hijri_Date' => $hijri_date,
                    'Meladi_Date' => $meladi_date,
                ];
               $support_doc = ['Support_File'=>json_encode($support_doc)];
               $this->domain->save($support_doc, ['DW_ID' => $domain_waiver->DW_ID], WAIVERS);

            }

        }

        $domain = $this->domain->get_domain_waiver($userid, $domain_id);        
        $data['domain'] = $domain;

            $this->LoadView_m('domain_registration/waiver/domain_register_step_3', $data);
     

    }


        public function waiver_send_app_admin($domain_id)
    {


        $domain_id = decryptIt($domain_id);
        
        $userid = $this->session->userdata($this->site_session->userid());

        // START check if he can access this domain
        $data['domain_details'] = $this->domain->getDomainDetailsByID($domain_id, $userid);
        if (!$data['domain_details'] || $data['domain_details']->Domain_Status !='Done') {
            $this->LoadView_m('dashboard/404', $data);
        }
        // END check if he can access this domain

        $customer = $this->customer_model->getCustomerData($userid);
        $customer = $customer[0];
        if (!empty($domain_id)) {
            $domain_waiver = $this->domain->get_domain_waiver($userid, $domain_id);
        }
        if (empty($domain_waiver)) {
            $this->session->set_flashdata('requestMsgSucc', 'you_can_change_domain');
            redirect($this->thisCtrl . "/my_orders");
        }

        $data['admin_officer'] = $domain_waiver->Admin_Email;

        $Admin_Email_Sent = $domain_waiver->Admin_Email_Sent;




        if (empty($Admin_Email_Sent)) {
            // send verify domain email to admin officer

         $_POST = ['DW_ID'=>$domain_waiver->DW_ID];
         $type = 'domain_waiver';
         $this->_send_change_request_to_admin($domain_id, $type);

        }
                //domains logs
                $domain_data = [
                    'DAL_Domain_ID' => $domain_id,
                    'DAL_User_ID' => $userid,
                    'DAL_Status' => 'admin_email_waiver',
                    'DAL_Created' => date("Y-m-d H:i:s"),
                    'DAL_Type'=>'Customer',
                ];
                $log_id = $this->domain->insert(APP_LOG, $domain_data);

            
        



        $this->LoadView_m('domain_registration/waiver/domain_register_step_4', $data);

    }

    private function _sendOrderEmail($order_id = 0)
    {
        $order = $this->domain->getOrderDetails($order_id);
        $data['order'] = $order;
        $data['website_data'] = $this->home_model->Get_Website_Data();
        $data['period'] = $order->period;


        if($order->Order_Type == 'registration_domain'){
            $type = getSystemString('register_new_domain');
            $msg =  getSystemString('domain_payed');  

        }elseif($order->Order_Type == 'restore'){
            $type = getSystemString('restore');
            $msg =  getSystemString('restore_domain_payed');  

        }elseif($order->Order_Type == 'renew'){
            $type = getSystemString('renew'); 
            $msg =  getSystemString('renew_domain_payed');  
            $request_id = $order->Request_ID;
            $request_info = $this->domain->getRequestByID($request_id);
            $post_data = json_decode($request_info->DCR_POST_DATA);
            $data['period'] = $post_data->period;
        }
        $data['type'] = $type;
        $data['msg'] =  $msg;

        $data['price_without_vat'] = round($order->Total_Price /(1+($order->Vat/100)),2);
        $data['total_price'] = $order->Total_Price;
        $data['vat'] = $order->Vat;
        $data['total_vat'] =  round(($order->Total_Price) - ($order->Total_Price / (1+($order->Vat/100))),2);


        $this->load->library('parser');
        $temp_msg = '' . $this->parser->parse('site/includes/email/invoice_status', $data, true);

        //send email
        $options = array(
            'to' => $order->User_Email,
            'subject' => $msg,
            'message' => $temp_msg,
        );

        $this->load->helper('utilities_helper');
        return SendEmail($options);
    }

    private function _makeUnConfirmedRenewOrder($domain_id, $customer_id, $totalPrice, $vat,$cart_type='MADA',$discount,$discount_details)
    {
        $data = array(
            'Domain_ID' => $domain_id,
            'Customer_ID' => $customer_id,
            'Total_Price' => $totalPrice,
            'Order_Type' => 'renew',
            'Discount'   => $discount,
            'Discount_Details'=> $discount_details,
            'Vat' => $vat,
            'Cart_Type' => $cart_type,            
            'Created_AT' => date('Y-m-d H:i:s'),
        );
        $order_id = $this->domain->insert(ORDERS, $data);

        return $order_id;
    }



}
