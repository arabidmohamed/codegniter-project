<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeBase_Controller extends MY_Controller
{

	public $sessObj;

	function __construct()
	{
    	parent::__construct();

    	$this->load->library('Site_Session');
    	$this->load->library('cart');



    	$this->load->model('home_model');
  	}

  	// Change language function
	public function changeLanguage($lang = '', $redirectUrl = '')
	{
		$website_config = $this->home_model->Get_Website_Configuration();

		$userid = $this->session->userdata($this->site_session->userid());
		if(!empty($userid)){
			       $this->home_model->updateCustomerLang($lang,$userid);
		}

		if($website_config['web_settings'][0]->Website_Language == 'en-ar')
		{
			$this->session->set_userdata($this->site_session->__lang_h(), $lang);
		}

		if(empty($redirectUrl))
		{
			redirect(base_url());
		}

		$redirectUri = explode("__", $redirectUrl);
		$redirectUri = implode("/", $redirectUri);

		$baseUrl = explode("/", base_url());
		$redirectUrl = explode("/", $redirectUri);

		$c = 0;
		foreach($redirectUrl as $r)
		{
			if(in_array($r, $baseUrl))
			{
				echo 'true';
				unset($redirectUrl[$c]);
			}
			$c++;
		}

		$path = implode("/", $redirectUrl);

		redirect(base_url($path));
	}

	/*-----------------------------------------------------------
		---------------------- #Functions -----------------
		--------------------------------------------------------*/

	// #generalLoadView function
	public function LoadView($view = array(), $data = array(), $metaData = array())
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

		/*
			* Check for meta data if set then use the meta data in headers
		*/
		if(count($metaData) > 0)
		{
			$data['pageTitle'] = isset($metaData['pageTitle']) ? $metaData['pageTitle'] : '';
			$data['pageDescription'] = isset($metaData['pageDescription']) ? $metaData['pageDescription'] : '';
		}

		$this->load->model('products_model');

		$data['website_data'] = $this->home_model->Get_Website_Data();
        // $data['categories_menu'] = $this->products_model->Get_AllCategories(6,0);
        // $data['other_categories'] = $this->products_model->Get_AllCategories(10,6);

		// this header only contain meta-deta and common css contents, the rest of the header will be loaded in the view
		$this->load->view('includes/header', $data);
		$this->load->view($view);
	}


    public function LoadView_m($view = array(), $data = array())
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
