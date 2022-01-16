<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends MY_Controller 
{
	
   protected $thisCtrl = "";


	function __construct()
	{
    	parent::__construct();
    	
    	$this->load->library('Site_Session');
       $this->load->library('cart');

       $this->load->vars( array('__controller' => $this->thisCtrl));

       $this->load->model('customer_model');
       $this->load->model('site/home_model');
       $this->load->helper('utilities_helper');
	     

       // by mohamed arabid 27/12/2020 to save before login
      $method = $this->router->fetch_method();
       if($method =='register_domain' && !empty($this->input->post('tld_id')) && !empty($this->input->post('domain_name')) && !$_SESSION['is_redirect']){
          $this->session->set_userdata($this->site_session->tld_id(), $this->input->post('tld_id'));             
          $this->session->set_userdata($this->site_session->domain_name(), $this->input->post('domain_name')); 
       }

     $userid = $this->session->userdata($this->site_session->userid());
     if(!empty($userid)){
       $lang = $this->home_model->getCustomerLang($userid);
       $this->session->set_userdata($this->site_session->__lang_h(), $lang);
             
     }

     // to check that user status is active
     if(!empty($userid)){
      $status = $this->home_model->checkUserStatus($userid);
 
      if(!$status){
        $this->session->sess_destroy();
        redirect('login');
        die();
      }
            
     }

	   $siteLang = $this->session->userdata($this->site_session->__lang_h());
	   if(empty($siteLang) || $siteLang == 'null'){
		   $this->session->set_userdata($this->site_session->__lang_h(), 'ar');
	   }
	   $this->config->set_item('route_url', base_url().$siteLang."/");

        // User authentication and authorization
       $this->load->library('authentication_hr');
       $userid = $this->session->userdata($this->site_session->userid());
       $email  = $this->session->userdata($this->site_session->email_address());

       $is_guest = $this->session->userdata($this->site_session->guestUserId()); 
       if(empty($is_guest)){
         $this->authentication_hr->IsLoggedIn($userid, $email, $this->router->fetch_module());
         $this->authentication_hr->CheckMethodAuthentication($this->session->userdata($this->site_session->role()));
       }
  	}
	
	/*-----------------------------------------------------------
    ---------------------- #Functions -----------------
    --------------------------------------------------------*/
    
    public function LoadView_m($view = array(), $data = array(), $metaData = array())
    {
        $this->load->helper('configuration_helper');
       /*
			* this will set website language + 
			* it will return website configurations
			* --------
			* $data['website_config'] = $CI->home_model->Get_Website_Configuration(); // called in this function
			* $data['website_lang'] = $website_language == 'en-ar' ? true : false; // set in the above function
			* --------
		*/
		$data = getAndApplyWebsiteConfigurations($data);
        
      //print_r($metaData);die();
        if(count($metaData) > 0)
        {
          $data['pageTitle'] = isset($metaData['pageTitle']) ? $metaData['pageTitle'] : '';
          $data['pageDescription'] = isset($metaData['pageDescription']) ? $metaData['pageDescription'] : '';
        }

        $data['page_title'] = 'Register';

        $data['website_data'] = $this->home_model->Get_Website_Data();

       // $this->load->model('site/products_model');
        // $data['categories_menu'] = $this->products_model->Get_Categories(6,0);
        // $data['other_categories'] = $this->products_model->Get_Categories(6,6);
        
        // this header only contain meta-deta and common css contents, the rest of the header will be loaded in the view 
        $this->load->view('site/includes/header', $data);
        $this->load->view($view);
    }
  	
}