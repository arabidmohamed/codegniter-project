<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/customer/controllers/Base_Controller.php');

class Customer extends Base_Controller
{

	protected $thisCtrl = "cu";

	function __construct()
	{
       parent::__construct();
       $this->load->model('address_model', 'address');
       $this->load->model('domain_model', 'domain');

        date_default_timezone_set('UTC');

           $userid = $this->session->userdata($this->site_session->userid());
          // $this->allOpenTicketsNum = count($this->customer_model->getAllOpenTickets($userid));



// getActiveConsulations(); exit();
    }

   public function index()
   {
       redirect('login');
   }

    /* -----------------------------------------------------------
    ---------------------- Profile MANAGEMENT -----------------
    -------------------------------------------------------- */









    // #profile function
    public function profile()
    {
        $userid = $this->session->userdata($this->site_session->userid());
        $data['customer']       = $this->customer_model->getCustomerData($userid);
        $data['pageTitle']       = getSystemString(100);


        $data['gender']  = $this->customer_model->get_all(array('parent'=>1,'Status'=>1),'*',null,'constants');


        $data['settings'] = $this->home_model->Get_Website_Configuration();


        $this->LoadView_m('my_profile', $data);
    }



    public function deleteCustomer(){
        $customer_id = $this->session->userdata($this->site_session->userid());

 
        
        $this->load->model('customer/domain_model', 'domains');
        $domains_count = count($this->domains->getAllDomainsByCustomerID($customer_id));

        if($domains_count == 0)
             {

                /*  delete customer */
                     $data = ['Customer_ID'=>$customer_id,
                                        'Status' => 0,
                                        'Deleted_at'=> date('Y-m-d H:i:s')];
                     $is_deleted = $this->customer_model->deleteCustomer($data); 
                 $this->session->set_flashdata('success', getSystemString('customer_deleted_succ'));
                 
             } else {
                 
                 $this->session->set_flashdata('error', getSystemString('customer_deleted_error'));
             }
            
        
        
             redirect('profile');

         
    }

    

     // #update profile function
    public function updateProfile()
    {
        if ($this->input->post('submit'))
        {
            // dd($_POST);
            $this->load->library('form_validation');

            $data = array(
                'Customer_ID' => $this->session->userdata($this->site_session->userid())
            );

            // check if both email or phone is change check availability
            $field_phone_key = $this->input->post('phone_key'); // eg: 966
            $field_phone = $this->input->post('phone');
            $field_email = $this->input->post('email');
            $run_validation = 0;
            $phone_change_request = 0;
            $email_change_request = 0;

            //phone change request
            if($field_phone != $this->session->userdata($this->site_session->phone()))
            {
               $phone_change_request = 1;
            }

            // check email
           if($field_email != $this->session->userdata($this->site_session->email_address())){

               $this->form_validation->set_rules('email', 'Email Address', 'valid_email|xss_clean|is_unique['.TBL_CUSTOMERS.'.Email]',
                array('is_unique' => getSystemString(287)));

               $run_validation = 1;
               $email_change_request = 1;
           }

            // Run validation if any of above condition is true
           if($run_validation){
               if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                    /*echo validation_errors();
                    die();*/
                    redirect($this->thisCtrl . '/profile');
                }
            }

            // if validation successfull check for change in phone
            if($phone_change_request)
            {   
                
                $rand  = str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                $rand2 = rand(111111, 999999);
                $verify_page_token = urlencode(md5($rand.''.$rand2));
                $verify_token = md5($rand);
                $message = 'Your verification code is '.$rand;
                
                // sendSMSTo($field_phone, $message, $field_phone_key);


                if ($field_phone_key == 966) {

                $message = 'Pin Code is:' . $rand;
                $send_result = sendSMSTo($field_phone, $message, $field_phone_key);

                } else {

                    $send_result = SendVerifyOTP($field_phone_key.$field_phone);

                    if($send_result->status == 'pending'){
                        $send_result = TRUE;
                    } else {
                        $send_result = FALSE;
                    }
                    
                }


                if($send_result){
                    $data['Verify_Token'] = $verify_token;
                    $data['Changed_Phone_key'] = $field_phone_key; // eg: 966
                    $data['Changed_Phone'] = $field_phone;
                    $data['Phone'] = $this->session->userdata($this->site_session->phone());
                    $this->customer_model->verifySMSLimitVerification($upd); 
                }

            }

            // check change in email
            if($email_change_request)
            {

                $rand = rand(1111, 9999);
                $rand2 = rand(111111, 999999);
                $verify_page_token = urlencode(md5(time().$rand.''.$rand2));
                $url = base_url('auth/verifyByChangedEmail/'.$verify_page_token);

                $this->_SendVerificationEmail($field_email, $verify_page_token,$url);

                $data['Verify_Page_Token'] = $verify_page_token;
                //$data['Email_Verified'] = 0;
                $data['Changed_Email'] = $field_email;
                //$this->session->set_userdata($this->site_session->email_verified(), 0);
            }

            if ($_FILES['fileToUpload']['size'] !== 0)
            {
                $this->load->helper('image_helper');
                //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_customers_dir']);
                if ($file)
                {
                    $data['Picture'] = substr($file, strrpos($file, '/') + 1);

                    // image options
                    $image_options = array(
                        'file' => 'fileToUpload',
                        'directory' => $GLOBALS['img_customers_dir'],
                        'max_width' => 1920,
                        'file_name' => date('Y-m-d H-i-s').'-album'
                    );
                    $upload = UploadFile($image_options);

                    if (is_array($upload) && array_key_exists('file_name', $upload))
                    {
                        $file_name = $upload['file_name'];
                        $data['Original_Img'] = $file_name;
                    }
                }
            }

            // $data['Phone'] = $field_phone;
            //$data['Email'] = $field_email;

            // $data['first_name'] = $this->input->post('first_name');
            // $data['last_name']  = $this->input->post('last_name');
            // $data['Fullname']   = $data['first_name'].' '.$data['last_name'];
            $data['Fullname']       = $this->input->post('Fullname');
            $data['Gender']         = $this->input->post('Gender');
            $data['Two_Factor_Auth']         = $this->input->post('two_factor_auth')?:0;
            //var_dump($data); exit();
            $result  = $this->customer_model->updateCustomer($data);


            $this->session->set_userdata($this->site_session->username(), $data['Fullname']);
            //$this->session->set_userdata($this->site_session->email_address(), $data['Email']);


            if ($result) {
                $this->session->set_flashdata('success', getSystemString(704));
            }
                    //} // END else validation

        }
        redirect($this->thisCtrl . '/profile');
    }



    public function change_password()
    {


        if ($_POST) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('oldPassword', 'Password', 'trim|min_length[3]|required|xss_clean');
            $this->form_validation->set_rules('newPassword', 'New Password', 'trim|min_length[3]|required|xss_clean');
            $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[newPassword]|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', validation_errors());

                redirect($this->thisCtrl."/profile");
            }

            //check for old password
            $oldPass = $this->input->post('oldPassword');
            $password = $this->input->post('newPassword');

            $this->load->library('bcrypt');
            $cstmr['user_id'] = $this->session->userdata($this->site_session->userid());
            $result = $this->customer_model->getUser($cstmr);
            $password_ret = $result[0]->Password;

            if (!$this->bcrypt->check_password($oldPass, $password_ret))
            {
               $this->session->set_flashdata('error', getSystemString(333));
               redirect($this->thisCtrl . '/profile');
            }

            $data['Customer_ID'] = $this->session->userdata($this->site_session->userid());
            $data['Password'] = $this->bcrypt->hash_password($password);


            $result = $this->customer_model->updateCustomer($data);
            if($result){
                $this->session->set_flashdata('success', getSystemString(434));
            } else {
                $this->session->set_flashdata('error', getSystemString(255));
            }


        }
        redirect($this->thisCtrl."/profile");

    } // end function



    /*-----------------------------------------------------------
    ---------------------- Orders -----------------
    --------------------------------------------------------*/
    public function my_orders()
    {
       $customer_id = $this->session->userdata($this->site_session->userid());
        //$data['website_data']          = $this->home_model->Get_Website_Data();

       $data['orders'] = $this->customer_model->getCustomerOrdersByCustomerID($customer_id);
       $data['customer_id'] = $customer_id;
       $data['customer']    = $this->customer_model->getCustomerData($customer_id);


        // $data['subscription_info'] = $this->checkout_model->getCurrentActiveSubscriptionV2($customer_id);
        // $data['plan'] = $this->checkout_model->getPlanByID($data['subscription_info']->Plan_ID);
        // $data['subscription_history'] = $this->checkout_model->getAllSubscriptionHistorybyCustomerID($customer_id);

       $this->LoadView_m('orders', $data);
    }


        public function communication_administration()
    {
       $customer_id = $this->session->userdata($this->site_session->userid());
       $data = array();
              $data['website_data']          = $this->home_model->Get_Website_Data();


       $this->LoadView_m('communication_administration', $data);
    }

	public function cancelOrder($orderId = 0)
	{
		$customer_id = $this->session->userdata($this->site_session->userid());
        $order = $this->customer_model->getOrder($customer_id, $orderId);

        if(count($order) == 0){
	        die('No order found');
        }

        if($order->Order_Status != 'Pending')
        {
	        die('Sorry! you cannot change the order status now.');
        }

        $orderStatus = array(
	        'Order_Status' => 'Returned',
	        'Order_ID' => $orderId,
	        'Customer_ID' => $customer_id
        );
        $result = $this->customer_model->updateOrderStatus($orderStatus);

        if($result)
        {
	        $this->load->helper('vend_helper');
	        $vendOrder = json_decode(VEND_GET('/register_sales/'.$order->Vend_Sale_ID));

	        $vendStatusUPD = array(
				'id' => $order->Vend_Sale_ID,
				'source_id' => $orderId,
				'invoice_id' => $orderId,
				'user_id' => VEND_USER_ID,
				'note' => "",
				'status' => 'VOIDED',
				'register_sale_products' => $vendOrder->register_sales[0]->register_sale_products
			);

			$response = json_decode(Vend_POST('/register_sales', json_encode($vendStatusUPD)));

			// * Receive Log
			$log = array(
				'Order_ID' => $orderId,
				'Type' => 'Vend Response Sale Status Updating',
				'Response' => json_encode($response)
			);
			$this->load->model('site/products_model', 'products');
			$this->products->addAPISLog($log);

			$this->session->set_flashdata('requestMsgSucc', 930903);
        } else {

	        $this->session->set_flashdata('requestMsgErr', 119);
        }

        redirect($this->thisCtrl.'/orders_history');
	}

    /*-----------------------------------------------------------
    ---------------------- Whishlist -----------------
    --------------------------------------------------------*/
    public function wishlist()
    {
       $customer_id = $this->session->userdata($this->site_session->userid());
              $data['website_data']          = $this->home_model->Get_Website_Data();
            $this->load->model('site/products_model', 'products');
       $data['wishlist'] = $this->products->getCustomerWhishlistByCustomerID($customer_id);
       $this->LoadView_m('wishlist', $data);
    }

   //send email function
   private function _SendVerificationEmail($email, $token,$url=null){
        $data = array(
            'email' => $email,
            'verify_token' => $token,
            'url' => $url,
        );
        $this->load->library('parser');
        $message = ''.$this->parser->parse('email-templates/send_verification_email', $data, TRUE);

        //send email
        $options = array(
        'to' => $email,
        'subject' => getSystemString(486),
        'message' => $message,
    );
        return SendEmail($options); // from utilities

    }

}
