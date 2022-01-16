<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication_hr {
	
	/**
		* function to check if user is logged in or not
		* @param1: user id from session
		* @param2: user email from session
		* @param3: redirection controller
	**/
	public function IsLoggedIn($chk_id, $email, $module){
		$CI =& get_instance();
		$check_methods = array('userLogin',
							   'login',
							   'changeLanguage', 
							   'passwordReset',
							   'passwordResetMobile',
							   'passwordResetEmail', 
							   'register', 
							   'UserRegisteration', 
							   'verifyAccount',
							   'two_factor_authentication', 
							   'resetPasswordRequest', 
							   'changePassword_Request',
							   'verifyByEmail',
							   'code_verification',
							   'codeCheck',
							   'change_phone_number',
							   'phone_changed',
							   'forget_password',
							   'sendVerificationCode',
							   'sendVerificationEmailAgain',
							   'verifyByChangedEmail','two_factor_verification');
		
		
	    	
    	if(!$this->CheckIsLoggedIn($chk_id, $email, $CI->router->fetch_module()) && !in_array($CI->router->fetch_method(), $check_methods))
    	{	
	    	if (isset($_SERVER['REDIRECT_URL'])) 
	    	{
				$_SESSION['redirect_url_ref'] = $_SERVER['REDIRECT_URL'];
    		}	
	    	
	    	redirect($module.'/login');
	    	exit();
    	}
	} // End Is Logged In
	
	/**
		* function to check if user is logged in with valid credentials
		* @param1: user id from session
		* @param2: user email from session
	**/
	protected function CheckIsLoggedIn($chk_id, $email, $module)
	{
		$CI =& get_instance();
		$data['email'] = $email;
		$data['user_id'] = $chk_id;
		$model = '';
		
		if($module == 'acp')
		{
			$model = 'auth';
			$CI->load->model('acp/authentication_model', $model);
		}
		
		if($module == 'customer')
		{
			$model = 'customer';
			$CI->load->model('customer/customer_model', $model);
		}
		
		if($module == 'company')
		{
			$model = 'cauth';
			$CI->load->model('company/auth_model', $model);
		}
		
		if(empty($model)){
			return 0;
		}
		
		return $CI->$model->isLoggedIn_check($data);
	}

	/**
		* function to check if user is authenticated to a specific method or not
		* @param1: user role id from session
	**/
    public function CheckMethodAuthentication($role_id){
	    $CI =& get_instance();
	    $check_methods = array('index', 'userLogin', 'login', 'changeLanguage', 'passwordReset', 'register', 'UserRegisteration', 'verifyAccount', 'resetPasswordRequest', 'changePassword_Request');
	    
	    $check_methods1 = array('index', 'ask', 'login' ,'passwordReset', 'resetPasswordRequest', 'changePassword_Request');
	    $check_methods2 = array('ChangeStatus', 'ChangeOrder');
	    
	    //$check_methods3 = array('changePassword', 'changeCredentials');
	  
		// if the user not logged in to any account
/*
	    if(empty($role_id)  && !in_array($CI->router->fetch_method(), $check_methods)){
		    show_404();
		    die();
	    }
*/
	    
		$module = $CI->router->fetch_module();
		$controller = $CI->router->fetch_class();
	    // if the $controller is for ACP admin
		if($role_id == 1 || $role_id == 3){
			// don't give access to CP if logged in as site admin First logout 
	    	if($module == 'cp'){
		    	redirect('acp/logout/return_cp');
	    	}
    	}
    	
    	// if the $controller is for resturant `store` #4
		if($role_id == 4){
			$resturant_admin_controllers = array('cp', 'products_rm', 'orders', 'datatable');
			
	    	if(!in_array($controller, $resturant_admin_controllers) && !in_array($CI->router->fetch_method(), $check_methods2)){
		    	
		    	$CI->session->set_userdata('role_login', ADMIN_ROLE);
		    	redirect('cp/logout/return_acp');
	    	}
    	}
		
    	
    	// if the $controller is for customer and normal User
    	if($role_id == 2 || $role_id == 5){
	    	if($module != 'customer' && !in_array($CI->router->fetch_method(), $check_methods2)){
		    	show_404();
		    	die();
	    	}
    	}
    	
	} // End Check Method Authentication
}