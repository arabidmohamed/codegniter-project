<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Domains extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/domains";
	//public $__domainStatuses = array('Pending', 'In Process', 'On The Way','Delivered', 'Returned');

	public $__domainStatuses = array( 'Done','NIC PENDING','DELETED','ADMIN DELETE','PENDING DELETE','REJECTED');

	public $__applicationFilter = array('NEW','PENDING', 'Canceled', 'Transferred Out','REJECTED','NEED MODIFICATION');

	public $__applicationStatuses = array('NEW','PENDING', 'Canceled', 'Transferred Out','REJECTED','NEED MODIFICATION','Done','NIC PENDING','DELETED','ADMIN DELETE','PENDING DELETE');

	public $__transferStatuses = array('PENDING','APPROVED', 'REJECTED', 'CANCELED');

	public $__requestStatuses = array('pending','approved', 'refused', 'deleted','canceled','incomplete','need_modification','admin_waiting_approve');


	public $__system_logs = array('admin_officer_email','email_financial_officer','sms_admin_officer','sms_admin_officer_no','sms_financial_officer','sms_financial_officer_no','email_invoice','admin_email_waiver');
	                                        
	function __construct()
	{
    	parent::__construct();
    	    	
    	// send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl, '__domainStatuses' => $this->__domainStatuses, '__applicationStatuses' => $this->__applicationStatuses,'__applicationFilter' => $this->__applicationFilter,'__transferStatuses' => $this->__transferStatuses,'__requestStatuses' => $this->__requestStatuses,'__system_logs' => $this->__system_logs));
    	
    	$this->load->model('domains_model', 'domains');
    	//$this->load->model('products_model');
    	$this->load->library('parser');
		$this->load->library('Cpanel_lib');
  	}
	
	public function managedomains_GET()
	{
		//$data['units'] = $this->products_model->getAllWeightUnits();
	    //$data['subcategories'] = $this->products_model->getSubCategories();
      	//$data['categories'] = $this->products_model->getCategories();
		$this->LoadView('domains/manage_domains', $data);
	}

	public function incompleteOrders_GET(){
		$data['status'] = 'INCOMPLETE';
		$this->LoadView('domains/manage_orders', $data);
	}

	public function payedOrders_GET(){
		$data['status'] = 'PAYED';
		$this->LoadView('domains/manage_orders', $data);
	}

	public function unpayedOrders_GET(){
		$data['status'] = 'UNPAYED';
		$this->LoadView('domains/manage_orders', $data);
	}

	public function domains_GET(){
		$data['status'] = 'DOMAINS';
		$this->LoadView('domains/manage_domains', $data);
	}

	public function domains_waivers_GET(){
		$data['status'] = 'DOMAINS_WAIVERS';
		$this->LoadView('domains/manage_waivers', $data);
	}

	public function transfer_in_GET(){
		$data['status'] = 'TRANSFER_IN';
		$this->LoadView('domains/manage_transfer_in', $data);
	}




	public function contact_info_GET(){
			$uid = $this->input->get('uid');

			//get user information
			$contact_info = $this->domains->getUserInfo($uid);

			if(!empty($contact_info)){
					$this->output
		                ->set_content_type("application/json")
		                ->set_output(json_encode(array('contact_info' => $contact_info,'status' => true)));
			}else{
					$this->output
		                ->set_content_type("application/json")
		                ->set_output(json_encode(array('status' => false)));
			}

	}


		public function save_registrant_POST(){

		if($_POST){

			$contact_id   = $this->input->post('contact_id');
			$domain_id    = $this->input->post('domain_id');
			$update_epp   = $this->input->post('update_epp');
			$request_id   = $this->input->post('request_id');


			$registrant_activity_type = $this->input->post('registrant_activity_type');


			$contact->Full_Name = $this->input->post('entity_name');
			//$contact->Employer_Name = $this->input->post('entity_name');			
			$contact->User_Address1 = $this->input->post('registrant_first_address');
			$contact->User_Country_ID = $this->input->post('registrant_country');
			$contact->User_Region = $this->input->post('registrant_region');
			$contact->User_City = $this->input->post('registrant_city');
			$contact->User_Post_Code = $this->input->post('registrant_post_code');
			$contact->User_Phone = $this->input->post('registrant_phone');
			$contact->User_Mobile = $this->input->post('registrant_mobile');
			$contact->User_Email = $this->input->post('registrant_email');
			$contact->Country_Code = 'SA';
			$type = 'entity';


			$domain_details = $this->domains->getdomainByID($domain_id);
			$domain_ns = $domain_details->Domain_Name.$domain_details->TLD;
			$registrant_data = $this->domains->getDomainRegitrar($domain_id,'Registrar');

			$this->load->library('nic/epp_lib');


			$registrant_epp_id = randomNumber(10).'0-dnet';
            $contact->Epp_ID = $registrant_epp_id;

         

		  if(!empty($contact->User_Phone) && strpos($contact->User_Phone,'+966.') === false){ 
		  	$contact->User_Phone = '+966.'.$contact->User_Phone;
		  	 }
          if(!empty($contact->User_Mobile) && strpos($contact->User_Mobile,'+966.') === false){
          	$contact->User_Mobile = '+966.'.$contact->User_Mobile;
          }

          $phone = $this->input->post('registrant_phone');
          $mobile = $this->input->post('registrant_mobile');


          $authCode = '';
		  if($update_epp == 'TRUE'){
          	$response  = $this->epp_lib->contact_create($contact,$domain_id);
		  }

          $code = $response[0]['epp']['response']['result']['@attributes']['code'];
	        
	      if ($code !== '1000' && $update_epp == 'TRUE') {
	                 $this->session->set_flashdata('requestMsgErr', 'accountDisabled');
	                 redirect($this->thisCtrl.'/domainDetails/'.$domain_id);
	      } else {

	      		            $users_data = [
				                    'Epp_ID' => $contact->Epp_ID,                    
				                    'Full_Name' => $contact->Full_Name,
				                    //'Employer_Name' => $contact->Employer_Name,
				                    'User_Job_Title' => $contact->User_Job_Title,
				                    'User_Country_ID' => $contact->User_Country_ID,
				                    'User_Region' => $contact->User_Region,
				                    'User_City' => $contact->User_City,
				                    'User_Post_Code' => $contact->User_Post_Code,
				                    'User_Phone' => $phone,
				                    'User_Email' => $contact->User_Email,
				                    'User_Mobile' => $mobile,
				                    'User_Address1' => $contact->User_Address1,
				                    'User_Address2' => $contact->User_Address2,
				            ];
				            
				            if(empty($contact_id)){
				                     $contact_id = $this->domains->insert(USERS, $users_data);                	
				            }else{
				                	 $where   = ['Org_Usr_ID' => $contact_id];
				                     $this->domains->save($users_data,$where,USERS);
				            }

				            $username = $this->session->userdata($this->acp_session->username());
        					$userid = $this->session->userdata($this->acp_session->userid());
        					$approved_by = $username.'-'.$userid;

				            $domain_admin_change = [
				            	'Domain_ID' => $domain_id,
				            	'Old_Data' =>  json_encode($registrant_data),
				            	'New_Data' =>  json_encode($users_data),
				            	'Type' => $type,
				            	'Updated_By' => $approved_by,
				            	'Updated_At' => date('Y-m-d H-i-s'), 
				            ];
				            $admin_change_id = $this->domains->insert('domain_change_log', $domain_admin_change); 


							if($update_epp == 'TRUE'){
							
								$authCode = $response['authCode'];
								/* update contact info */
								$upd_reg = ['Auth_Code'  => $authCode];
								$where   = ['Org_Usr_ID' => $contact_id];
								$this->domains->save($upd_reg,$where,USERS);

							}

				            $info_data = ['Registrar_ID'=> $registrant_epp_id,'Org_Activity_ID' => $registrant_activity_type];
				            $this->domains->save($info_data, ['Domain_ID' => $domain_id], INFO);


							if($update_epp == 'TRUE'){

				      			$this->epp_lib->domain_registrant_change($domain_ns, $registrant_epp_id, $domain_id);

				      			$domain_authocde_change = $this->epp_lib->domain_authocde_change($domain_ns, $domain_id);
							
								$new_authCode = $domain_authocde_change['authCode'];
								/* save the new domain auth code */
								$auth__data = ['Auth_Code' => $new_authCode];
								$this->domains->save($auth__data, ['Domain_ID' => $domain_id], DOMAIN);

							}



	      }

		  if($update_epp == 'TRUE'){
	            $this->session->set_flashdata('requestMsgSucc', 360);
	            redirect($this->thisCtrl.'/domainDetails/'.$domain_id);
		  } else {
			$this->session->set_flashdata('requestMsgSucc', 360);
			redirect($this->thisCtrl.'/Request_Details/'.$request_id);		  
		  }	

	   } //end is post


	}

	public function save_docs_POST(){

		if($_POST){

			$contact_id   = $this->input->post('contact_id');
			$domain_id    = $this->input->post('domain_id');
			$update_epp   = $this->input->post('update_epp');
			$request_id   = $this->input->post('request_id');
			$doc_id   = $this->input->post('doc_id');
			
			$Doc_Type_ID   = $this->input->post('Doc_Type_ID');
	
			if($Doc_Type_ID == 74){
				$issures_id    = 4;
			} else {
				$issures_id    = $this->input->post('issures_id');
			}
	
			$Doc_Date      = $this->input->post('Doc_Date');
			$Doc_Num       = $this->input->post('Doc_Num');
	
			$orderdate = explode('-', $Doc_Date);
			$year 	= $orderdate[0];
			$month  = $orderdate[1];
			$day  	= $orderdate[2];
	
			if($year < 2000){
				$Hijri_Date      = $this->input->post('Doc_Date');
				$Meladi_Date     = Hijri2Greg($day, $month, $year);
				$Meladi_Date 	 = $Meladi_Date['year'].'-'.$Meladi_Date['month'].'-'.$Meladi_Date['day'];
			} else {
				$Hijri_Date      = Greg2Hijri($day, $month, $year);
				$Hijri_Date 	 = $Hijri_Date['year'].'-'.$Hijri_Date['month'].'-'.$Hijri_Date['day'];
				$Meladi_Date     = $this->input->post('Doc_Date');
			}

			/* update doc info */
			$upd_doc = ['Doc_Type_ID'  => $Doc_Type_ID, 'Doc_Issures_ID'  => $issures_id, 'Doc_Date'  => $Doc_Date, 'Hijri_Date'  => $Hijri_Date, 'Meladi_Date'  => $Meladi_Date, 'Doc_Num'  => $Doc_Num,];
			$where   = ['Domain_Doc_ID' => $doc_id];
			$this->domains->save($upd_doc,$where,DOCUMENT);

			if($update_epp == 'TRUE'){
	            $this->session->set_flashdata('requestMsgSucc', 360);
	            redirect($this->thisCtrl.'/domainDetails/'.$domain_id);
		  } else {
			$this->session->set_flashdata('requestMsgSucc', 360);
			redirect($this->thisCtrl.'/Request_Details/'.$request_id);		  
		  }	

	   } //end is post


	}

	public function save_contact_info_POST(){

		if($_POST){

			$contact_role = $this->input->post('contact_role');
			$contact_id   = $this->input->post('contact_id');
			$domain_id    = $this->input->post('domain_id');


			$contact->Full_Name = $this->input->post('Full_Name');
			$contact->Employer_Name = $this->input->post('Employer_Name');
			$contact->User_Job_Title = $this->input->post('User_Job_Title');
			$contact->User_Address1 = $this->input->post('User_Address1');
			$contact->User_Country_ID = $this->input->post('User_Country_ID');
			$contact->User_Region = $this->input->post('User_Region');
			$contact->User_City = $this->input->post('User_City');
			$contact->User_Phone = $this->input->post('User_Phone');
			$contact->User_Mobile = $this->input->post('User_Mobile');
			$contact->Mobile_Key = $this->input->post('mobile_key');			
			$contact->User_Email = $this->input->post('User_Email');
			$contact->User_Post_Code = $this->input->post('User_Post_Code');
			$contact->Country_Code = 'SA';

			$domain_details = $this->domains->getdomainByID($domain_id);
			$domain_ns = $domain_details->Domain_Name.$domain_details->TLD;

			$this->load->library('nic/epp_lib');
			$domain_info = $this->epp_lib->domain_info($domain_ns, $domain_id);
			$contacts = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:contact'];
		    foreach ( $contacts as $key => $row){
		    	            if($row['@attributes']['type'] == 'admin'){
		                     $old_admin_epp_id =  $row['_value'];
		                    }

		                    if($row['@attributes']['type'] == 'tech'){
		                     $old_tech_epp_id =  $row['_value'];
		                    }

		                    if($row['@attributes']['type'] == 'billing'){
		                     $old_billing_epp_id =  $row['_value'];
		                    }
		     }



			if($contact_role == 'admin'){
				$epp_id = randomNumber(10).'1-dnet'; 
			     if($old_admin_epp_id == $old_tech_epp_id && $old_admin_epp_id == $old_billing_epp_id){
			     	$level = 3; //chnage all users
			     	$info_data = ['Admin_ID' => $epp_id,'Technical_ID'=>$epp_id,'Financial_ID'=>$epp_id];
			     }
			     if($old_admin_epp_id == $old_tech_epp_id && $old_admin_epp_id != $old_billing_epp_id){
			     	$level = 2; //change admin and technical
			     	$info_data = ['Admin_ID' => $epp_id,'Technical_ID'=>$epp_id];
			     }
			     if($old_admin_epp_id != $old_tech_epp_id && $old_admin_epp_id == $old_billing_epp_id){
			     	$level = 1; //change admin and billing
			     	$info_data = ['Admin_ID' => $epp_id,'Financial_ID'=>$epp_id];
			     }
			     if($old_admin_epp_id != $old_tech_epp_id && $old_admin_epp_id != $old_billing_epp_id){
			     	$level = 0; //change admin only
			     	$info_data = ['Admin_ID' => $epp_id];
			     }  

			     $old_contact = $domain_details->Admin;
			     $type = 'admin';         	           	 
            }

            if($contact_role == 'technical'){
             	$epp_id = randomNumber(10).'2-dnet';

			     	$level = 5; //change technical
			     	$info_data = ['Technical_ID'=>$epp_id];
			     
			      $old_contact = $domain_details->Technical; 
			      $type = 'technical'; 
 
            }

            if($contact_role == 'financial'){
             	$epp_id = randomNumber(10).'3-dnet';
             	
			     	$level = 6; //change financial
			     	$info_data = ['Financial_ID'=>$epp_id];
			     
			      $old_contact = $domain_details->Financial; 
			      $type = 'financial';
			     

            }





            $contact->Epp_ID = $epp_id;

         

		  if(!empty($contact->User_Phone) && strpos($contact->User_Phone,'+966.') === false){ 
		  	$contact->User_Phone = '+966.'.$contact->User_Phone;
		  	 }
          if(!empty($contact->User_Mobile) && strpos($contact->User_Mobile,'+966.') === false){
          	$contact->User_Mobile = '+966.'.$contact->User_Mobile;
          }
          
          $phone = $this->input->post('User_Phone');
          $mobile = $this->input->post('User_Mobile');


          $authCode = '';
          $response  = $this->epp_lib->contact_create($contact,$domain_id);
          $code = $response[0]['epp']['response']['result']['@attributes']['code'];
	        
	      if ($code !== '1000') {
	                 $this->session->set_flashdata('requestMsgErr', 'accountDisabled');
	                 redirect($this->thisCtrl.'/domainDetails/'.$domain_id);
	      } else {

	      		            $users_data = [
				                    'Epp_ID' => $epp_id,                    
				                    'Full_Name' => $contact->Full_Name,
				                    'Employer_Name' => $contact->Employer_Name,
				                    'User_Job_Title' => $contact->User_Job_Title,
				                    'User_Country_ID' => $contact->User_Country_ID,
				                    'User_Region' => $contact->User_Region,
				                    'User_City' => $contact->User_City,
				                    'User_Post_Code' => $contact->User_Post_Code,
				                    'User_Phone' => $phone,
				                    'User_Email' => $contact->User_Email,
				                    'User_Mobile' => $mobile,
				                    'User_Address1' => $contact->User_Address1,
				                    'User_Address2' => $contact->User_Address2,
				            ];
				            
				            if(empty($contact_id)){
				                     $contact_id = $this->domains->insert(USERS, $users_data);                	
				            }else{
				                	 $where   = ['Org_Usr_ID' => $contact_id];
				                     $this->domains->save($users_data,$where,USERS);
				            }


				            $username = $this->session->userdata($this->acp_session->username());
        					$userid = $this->session->userdata($this->acp_session->userid());
        					$approved_by = $username.'-'.$userid;

				            $contact_change = [
				            	'Domain_ID' => $domain_id,
				            	'Old_Data' =>  json_encode($old_contact),
				            	'New_Data' =>  json_encode($users_data),
				            	'Type' => $type,
				            	'Updated_By' => $approved_by,
				            	'Updated_At' => date('Y-m-d H-i-s'), 
				            ];
				            $admin_change_id = $this->domains->insert('domain_change_log', $contact_change); 


				            $authCode = $response['authCode'];
				            /* update contact info */
				            $upd_reg = ['Auth_Code'  => $authCode];
				            $where   = ['Org_Usr_ID' => $contact_id];
				            $this->domains->save($upd_reg,$where,USERS);

				            $this->domains->save($info_data, ['Domain_ID' => $domain_id], INFO);


				            if($level == 3){
				            	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_admin_epp_id, 'admin', $domain_id);
				            	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_tech_epp_id, 'tech', $domain_id);
				            	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_billing_epp_id, 'billing', $domain_id);
				            }

				            if($level == 2){
				            	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_admin_epp_id, 'admin', $domain_id);
				            	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_tech_epp_id, 'tech', $domain_id);				            
				            }
				            
				            if($level == 1){
				            	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_admin_epp_id, 'admin', $domain_id);
				            	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_billing_epp_id, 'billing', $domain_id);				            
				            }
				            if($level == 0){
				            	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_admin_epp_id, 'admin', $domain_id);			            
				            }
				            // if($level == 4){
				            // 	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_tech_epp_id, 'tech', $domain_id);
				            // 	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_billing_epp_id, 'billing', $domain_id);			            
				            // }
				            if($level == 5){
				            	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_admin_epp_id, 'tech', $domain_id);			            
				            }
				            if($level == 6){
				            	  $this->epp_lib->domain_admin_change($domain_ns, $epp_id, $old_admin_epp_id, 'billing', $domain_id);			            
				            }


						if($contact_role == 'admin'){
							$domain_authocde_change = $this->epp_lib->domain_authocde_change($domain_ns, $domain_id);
			                $new_authCode = $domain_authocde_change['authCode'];
			                /* save the new domain auth code */
			                $auth__data = ['Auth_Code' => $new_authCode];
			                $this->domains->save($auth__data, ['Domain_ID' => $domain_id], DOMAIN);
			            }



	      }

	            $this->session->set_flashdata('requestMsgSucc', 360);
	            redirect($this->thisCtrl.'/domainDetails/'.$domain_id);
	   } //end is post


	}

	public function SaveRequestRequirments_POST(){
		$idsArr = $this->input->post('idsArr');
		$request_id = $this->input->post('request_id');

		$idsArr = implode(',',$idsArr);
		
		$requirments__data = ['Request_Requirments' => $idsArr];
	    $this->domains->save($requirments__data, ['DCR_ID' => $request_id], REQUEST);
	}

	public function save_domain_name_POST(){


			$domain_id   = $this->input->post('domain_id');
			$domain_name = $this->input->post('domain_name');
			$tld_name    = $this->input->post('tld_name');
			$request_id = $this->input->post('request_id');

		    $domain = $this->domains->getdomainByID($domain_id);
			$old_data = ['Domain_Name' => $domain->Domain_Name,'TLD' => $domain->TLD];



			
		if(!empty($_POST['submit'])){

			$domain_data = ['Domain_Name' => $domain_name,'TLD' => $tld_name];
	        $this->domains->save($domain_data, ['Domain_ID' => $domain_id], DOMAIN);

	        $username = $this->session->userdata($this->acp_session->username());
        	$userid = $this->session->userdata($this->acp_session->userid());
        	$updated_by = $username.'-'.$userid;
	        
	        $change_log = [	
	        	        'Domain_ID'=> $domain_id,
	        			'Old_Data' => json_encode($old_data),
	        			'New_Data' => json_encode($domain_data),	        		
	        			'Type' => 'edit_domain_name',
	        			'Updated_By' => $updated_by,
	        			'Updated_At' => date('Y-m-d H-i-s'),
			];


        	$this->domains->insert('domain_change_log', $change_log);

			$this->session->set_flashdata('requestMsgSucc', 176);
			redirect($this->thisCtrl.'/Request_Details/'.$request_id);

		}

	}

	    public function domain_check_POST()
    {

        $domain_name = $this->input->post('domain_name');
        $tld = $this->input->post('tld_name');

        if (!empty($domain_name) && !empty($tld)) {
			$this->load->library('nic/epp_lib');


            $sys_err = "<p class='domain-not-exists text-center mt-3'> " . getSystemString(119) . "</p>";


            $required_tld = $domain_name . $tld;
            $responseJSON = $this->epp_lib->domain_check($required_tld);

            $suggested_tlds = $responseJSON[0]['epp']['response']['resData']['domain:chkData']['domain:cd'];

            $result = '';

            $result->avail = $suggested_tlds['domain:name']['@attributes']['avail'];
            $result->value = $suggested_tlds['domain:name']['_value'];
            $result->reason = $suggested_tlds['domain:reason'];
            $result->domain_name = $domain_name;

            $lang = $this->session->userdata($this->site_session->__lang_h());
            $msg = '';


            if (($result->reason == 'available' || $result->reason == 'reserved_zone' || $result->reason == 'reserved_word') && $result->avail == 1 ) {
                $msg = "<p class='domain-exists text-center mt-3'> " . getSystemString($result->reason) . "</p>";
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true, 'msg' => $msg, 'result' => $result)));
            } else {
                $msg = "<p class='domain-not-exists text-center mt-3'> " . getSystemString($result->reason) . "</p>";
                $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false, 'msg' => $msg, 'result' => $result)));
            }

   

        } else {
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false, 'msg' => $sys_err)));
        }

    }


		public function Request_Details_GET($request_id = 0)
	{
		$data['settings'] = $this->admin_model->getSettings();
		$data['request'] = $this->domains->getRequestByID($request_id);
		$request = $data['request'];

		$domain_id =  $data['request']->Domain_ID;
		$data['domain'] = $this->domains->getdomainByID($domain_id);
		$data['request_id'] = $request_id;
		
        $data['countries'] = $this->domains->get_all(null, '*', null, 'countries');
        $data['activity_types'] = $this->domains->getConstantsByParantID(68);
        $data['doc_types'] = $this->domains->getAllDocsType();
        $data['doc_issures'] = $this->domains->getAllIssuers();
        $data['requirments'] = $this->domains->getAllDomainRequirments($data['domain']->Org_Activity_ID);

        $data['payment_transaction'] = $this->domains->getPayedDomainTransaction($domain_id);

        $data['tlds'] = $this->domains->getallTlds();

        $data['app_logs'] = $this->domains->getDomainAppLogs($domain_id);

      	foreach ($data['app_logs'] as $key => $log){
        	$fullname = $log->contact_name; 
        	if(empty($fullname)){ $fullname = $log->customer_name;}
        	if(empty($fullname)){ $fullname = $log->admin_name;}

        	if(in_array($log->DAL_Status,$this->__system_logs)){$fullname = getsystemstring('System');}
        	$data['app_logs'][$key]->user_full_name = $fullname;
        }



        $status = array(
  			                                $this->__requestStatuses[0] => 'primary',
							  	  			$this->__requestStatuses[1] => 'success', 
							  	  			$this->__requestStatuses[2] => 'danger', 
							  	  			$this->__requestStatuses[3] => 'danger',
							  	  			$this->__requestStatuses[4] => 'danger',
							  	  			$this->__requestStatuses[5] => 'primary',
							  	  			$this->__requestStatuses[6] => 'danger',
							  	  			$this->__requestStatuses[7] => 'primary',							  	  			
		   );


        if($request->DCR_Status == 'pending' && $request->DCR_Admin_Approve == 0){
			 	$request_status = 'admin_waiting_approve';
			 	$label = 'primary';
		}else{
				$request_status = $request->DCR_Status;
			    $label = $status["$request_status"];
		}
		$data['request_status'] = $request_status;
		$data['label']          = $label; 


		$this->LoadView('domains/register_request_details', $data);
	}

	
	public function domainDetails_GET($domain_id = 0)
	{
		$data['settings'] = $this->admin_model->getSettings();	
		$data['request'] = $this->domains->getCreateRequestByDomainID($domain_id);
		$data['all_change_requests'] = $this->domains->getAllDomainChangeRequest($domain_id);		
		$data['request_id'] = $data['request']->DCR_ID;
		$data['domain'] = $this->domains->getdomainByID($domain_id);
        $data['countries'] = $this->domains->get_all(null, '*', null, 'countries');
        $data['activity_types'] = $this->domains->getConstantsByParantID(68);
		$data['dns_records'] =  json_decode($this->cpanel_lib->getDomainDnsRecords($data['domain']->Domain_Name.$data['domain']->TLD))->data->zone[0]->record;

		$data['inside_domain_changes'] = $this->domains->getDomainAdminChange($domain_id);
		$data['transfer_inside_dnet_logs'] = $this->domains->getDomainInsideDnet($domain_id);

		$data['app_logs'] = $this->domains->getDomainAppLogs($domain_id); 
		foreach ($data['app_logs'] as $key => $log){
        	$fullname = $log->contact_name; 
        	if(empty($fullname)){ $fullname = $log->customer_name;}
        	if(empty($fullname)){ $fullname = $log->admin_name;}

        	if(in_array($log->DAL_Status,$this->__system_logs)){$fullname = getsystemstring('System');}
        	$data['app_logs'][$key]->user_full_name = $fullname;
        }

        


		$this->LoadView('domains/domain_details', $data);
	}

	public function delete_domain_POST(){

		$domain_id      = $this->input->post('domain_id');
		$refund_status  = $this->input->post('refund_status');
		$delete_reasons = $this->input->post('delete_reasons');

		/*get order details*/
		
		$domain = $this->domains->getdomainByID($domain_id);


		if(!empty($domain->RegisterOrder)){
			/*register domain */
			$order_id = $domain->RegisterOrder->DO_ID;
			$order =  $this->domains->get_order($domain_id,$order_id);
			$order_type = 'registration';
		}else{
			/*transfer domain */
			$orders = $domain->Transfer_Orders;
			$order  = [];
			foreach ($orders as $row){
					if($row->Payment_Verified){
						$order = $row;	
					}
			}
			$order_type = 'transfer';			
	
		}



		/* make delete request to nic */
        $this->load->library('nic/epp_lib');            			
		$domain_ns = $domain->Domain_Name . $domain->TLD;
        $responseJSON = $this->epp_lib->domain_delete($domain_ns, $domain_id);

        $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
        if ($code !== '1000') {
                 $this->session->set_flashdata('requestMsgErr', 'accountDisabled');
        } else {




		$cart_type = $order->Cart_Type;
		$hy_id     = $order->HY_ID;

		if($refund_status && !empty($order)){

			if($cart_type =='WALLET'){

				   $customer_id =  $domain->Customer_ID;               
                   $this->load->library('E_Wallet');
                   $transaction_result =  $this->e_wallet->modifyCreditsForCustomers($customer_id,'+',$order->Total_Price,'Refund Admin Delete Domain',$customer_id,$hy_id);
                        $refund_data = ['Payment_Refunded' => 1];
                        if($order_type == 'registration'){
						  $this->domains->save($refund_data, ['HY_ID' => $hy_id], ORDERS);				 
						}else{
						  $this->domains->save($refund_data, ['HY_ID' => $hy_id], TRANSFER_ORDERS);		  
						}

			}else{

					$total_price = number_format((float) $order->Total_Price, 2, '.', '');
					 /* refund amount */	
					 $this->load->library('payments/Hyperpay_lib');
					 $response = json_decode($this->hyperpay_lib->RefundPayment($hy_id, $total_price, $cart_type));
					// * Payment refund Log
					$log = array(
						'Customer_ID' => $domain->Customer_ID,
						'Order_ID' => $order->OR_ID,
						'Type' => 'Hyperpay payment refund',
						'Response' => json_encode($response),
					);
					$this->domains->addAPISLog($log);
					$code = $response->result->code;
					if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code)) {
						$refund_data = ['Payment_Refunded' => 1];
						if($order_type == 'registration'){
						  $this->domains->save($refund_data, ['HY_ID' => $hy_id], ORDERS);				 
						}else{
						  $this->domains->save($refund_data, ['HY_ID' => $hy_id], TRANSFER_ORDERS);		  
						}
					 
					}				
			}

		}

		/* update domain status to rejected*/		  
		$domain__data = ['Domain_Status' => 'ADMIN DELETE', 'Deleted_at' => date('Y-m-d H:i:s')];
		$this->domains->save($domain__data, ['Domain_ID' => $domain_id], DOMAIN);

	    $username = $this->session->userdata($this->acp_session->username());
	    $domain_info_id = $domain->DINFO_ID;		
		$delete__data = ['Admin_Delete_Date' => date('Y-m-d H:i:s'),'Admin_Delete_Reason' => $delete_reasons,'Admin_Delete_User_Name' => $username];
		$this->domains->save($delete__data, ['DINFO_ID' => $domain_info_id], INFO);
		$is_delete_email = 1;

		/* disable all previous requests */
		$status = 'pending';
        $this->domains->makeDisableAllPreviousRequest($domain_id, $status);

		$this->_send_reject_email_to_admin_registrant($domain, $delete_reasons,$is_delete_email);


	    $this->session->set_flashdata('requestMsgSucc', 'delete_domain_success');
		 
	 	    
   } /* if delete nic request success */ 
     redirect($this->thisCtrl.'/domainDetails/'.$domain_id);
}


	public function reject_domain_POST(){

		$request_id      = $this->input->post('request_id');
		$domain_id      = $this->input->post('domain_id');
		$order_id          = $this->input->post('do_id');
		$reject_status  = $this->input->post('reject_status');
		$reasons_ar = $this->input->post('reasons_ar');
		$reasons_en = $this->input->post('reasons_en');

		$fixed_reasons = '';
		if($reject_status == 'need_modification'){

			$fixed_reasons = $this->input->post('fixed_reasons');

		}




		/*get order details*/
		$domain = $this->domains->getdomainByID($domain_id);

		$this->load->model('site/home_model');
		$sys_lang = $this->home_model->getCustomerLang($domain->Customer_ID);
		$desc = 'Description_'.$sys_lang;
		$reject_reasons = '';

		$reasons = explode(',',$fixed_reasons);
		if(!empty($reasons[0])){
			foreach ($reasons as $requirment_id){
				$requirment = $this->domains->getRequirmentByID($requirment_id);
				$reject_reasons .= '<li>'.$requirment->$desc.'</li>';
			}
		}

		if($sys_lang == 'ar'){$reso = $reasons_ar;}else{$reso = $reasons_en;}
		$reject_reasons .= '<li>'.$reso.'</li>';


		if(!empty($domain->RegisterOrder)){
			/*register domain */
			$order_id = $domain->RegisterOrder->DO_ID;
			$order =  $this->domains->get_order($domain_id,$order_id);
			$order_type = 'registration';
		}else{
			/*transfer domain */
			$orders = $domain->Transfer_Orders;
			$order  = [];
			foreach ($orders as $row){
					if($row->Payment_Verified){
						$order = $row;	
					}
			}
			$order_type = 'transfer';			
	
		}


		$request = $this->domains->getCreateRequestByRequestID($request_id);


		if($reject_status == 'reject'){
	 

         if(!empty($order)){

         	$cart_type = $order->Cart_Type;
		    $hy_id     = $order->HY_ID;


			if($cart_type =='WALLET'){

				   $customer_id =  $domain->Customer_ID;               
                   $this->load->library('E_Wallet');
                   $transaction_result =  $this->e_wallet->modifyCreditsForCustomers($customer_id,'+',$order->Total_Price,'Refund Admin Reject Domain',$customer_id,$hy_id);
                        $refund_data = ['Payment_Refunded' => 1];
                        if($order_type == 'registration'){
						  $this->domains->save($refund_data, ['HY_ID' => $hy_id], ORDERS);				 
						}else{
						  $this->domains->save($refund_data, ['HY_ID' => $hy_id], TRANSFER_ORDERS);		  
						}

			}else{

					$total_price = number_format((float) $order->Total_Price, 2, '.', '');
					 /* refund amount */	
					 $this->load->library('payments/Hyperpay_lib');
					 $response = json_decode($this->hyperpay_lib->RefundPayment($hy_id, $total_price, $cart_type));
					// * Payment refund Log
					$log = array(
						'Customer_ID' => $domain->Customer_ID,
						'Order_ID' => $order->OR_ID,
						'Type' => 'Hyperpay payment refund',
						'Response' => json_encode($response),
					);
					$this->domains->addAPISLog($log);
					$code = $response->result->code;
					if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code)) {
						$refund_data = ['Payment_Refunded' => 1];
						if($order_type == 'registration'){
						  $this->domains->save($refund_data, ['HY_ID' => $hy_id], ORDERS);				 
						}else{
						  $this->domains->save($refund_data, ['HY_ID' => $hy_id], TRANSFER_ORDERS);		  
						}
					 
					}				
			}

		}

			  /* update request status to refused */
			  $dcr_id = $request->DCR_ID;
	          $request__data = ['DCR_Status' => 'refused'];
		      $this->domains->save($request__data, ['DCR_ID' => $dcr_id], REQUEST);

			 /* update domain status to rejected*/		  
		      $domain__data = ['Domain_Status' => 'REJECTED'];
		      $this->domains->save($domain__data, ['Domain_ID' => $domain_id], DOMAIN);

		        $log = [ 
			          'DAL_Domain_ID'=>$domain_id,
			          'DAL_User_ID'=>$userid,
			          'DAL_Status'=>'domain_reject',
			          'DAL_Reason_ar'=>$reasons_ar,
			          'DAL_Reason_en'=>$reasons_en,
			          'DAL_Fixed_Reasons'=>$fixed_reasons,
			          'DAL_Created'=>date('Y-m-d H:i:s'),
			          'DAL_Type' =>'Admin',
	      		];
        	  $this->domains->insert(APP_LOG, $log);

		     $this->_send_reject_email_to_admin_registrant($domain, $reject_reasons);
	     }

	     if($reject_status == 'need_modification'){


	          
	          $dcr_id = $request->DCR_ID;
	          $request__data = ['DCR_Status' => 'need_modification','DCR_Admin_Approve'=>0];
		      $this->domains->save($request__data, ['DCR_ID' => $dcr_id], REQUEST);


		    $info_data = [
                'Domain_Admin_Approved' => 0,
            ];
            $this->domains->save($info_data, ['DINFO_ID' => $domain->DINFO_ID], INFO);

		      $url = base_url('order_details/'.encryptIt($domain_id).'/'.encryptIt($dcr_id));	

		      $this->_send_need_modification_email_to_registrant($domain, $url, $reject_reasons,$dcr_id);

	     }
	          $userid = $this->session->userdata($this->acp_session->userid());
	          $log = [ 
			          'DAL_Domain_ID'=>$domain_id,
			          'DAL_User_ID'=>$userid,
			          'DAL_Status'=>'domain_reject_modification',
			          'DAL_Reason_ar'=>$reasons_ar,
			          'DAL_Reason_en'=>$reasons_en,
			          'DAL_Fixed_Reasons'=>$fixed_reasons,
			          'DAL_Created'=>date('Y-m-d H:i:s'),
			          'DAL_Type' =>'Admin',
	      		];
        	  $this->domains->insert(APP_LOG, $log);

	      $this->session->set_flashdata('requestMsgSucc', 360);
		  redirect($this->thisCtrl.'/Request_Details/'.$request->DCR_ID);
	}


		   private function _send_need_modification_email_to_registrant($domain, $url, $reject_reasons,$dcr_id)
		  {

		    $this->load->model('customer/domain_model');
		    $this->load->model('site/home_model');    
		    $this->load->library('parser');
		    $customer_id = $domain->Customer_ID;

		        $data['website_data'] = $this->home_model->Get_Website_Data();
		        $data['title'] = getSystemString('domain_need_modifications',$customer_id);
		        $data['reject_reasons'] = $reject_reasons;
		        $data['url'] = $url;
		        $data['domain'] = $domain;
		      


		        $num = str_pad($dcr_id, 5, '0', STR_PAD_LEFT);
		        $data['num'] = $num;		        
		        $subject = getSystemString('domain_need_modifications',$customer_id).' | #'.$num.' | '.$domain->Domain_Name.$domain->TLD;


		        $contacts[] = $this->domain_model->getDomainOrgUsers($domain->Domain_ID,'Registrar');
		        //$contacts[] = $this->domain_model->getDomainOrgUsers($domain_id,'Admin');

		        
		        foreach ($contacts as $key => $contact) {

		            $temp_msg = '' . $this->parser->parse('site/includes/email/need_modification', $data, true);

		            //send email
		            $options = array(
		                'to' => $contact->User_Email,
		                'subject' => $subject,
		                'message' => $temp_msg,
		            );

		            SendEmail($options);
		        }

		        return true;

  		}



	   private function _send_reject_email_to_admin_registrant($domain,$reject_reasons,$is_delete_email = 0)
		  {

		    $this->load->model('customer/domain_model');
		    $this->load->model('site/home_model');    
		    $this->load->library('parser');

		    	$customer_id = $domain->Customer_ID;
		        $data['website_data'] = $this->home_model->Get_Website_Data();
		        if($is_delete_email){
		        	$data['title'] = getSystemString('delete_domain',$customer_id);
		        	$subject = getSystemString('delete_domain',$customer_id);
		        }else{
		        	$data['title'] = getSystemString('domain_reject_succ',$customer_id);
		        	$subject = getSystemString('domain_reject_succ',$customer_id);
		        }
		        
		        $data['reject_reasons'] = $reject_reasons;
		        $data['url'] = $url;
		        $data['domain'] = $domain;
		        $domain_id = $domain->Domain_ID;
		        
		        		    

		        $contacts[] = $this->domain_model->getDomainOrgUsers($domain_id,'Registrar');
		        //$contacts[] = $this->domain_model->getDomainOrgUsers($domain_id,'Admin');


		        foreach ($contacts as $key => $contact) {

		            $temp_msg = '' . $this->parser->parse('site/includes/email/reject_domain', $data, true);

		            //send email
		            $options = array(
		                'to' => $contact->User_Email,
		                'subject' => $subject,
		                'message' => $temp_msg,
		            );

		            SendEmail($options);
		        }

		        return true;

  		}

	public function all_requests_GET(){
		$data['status'] = 'create_domain';
		$this->LoadView('domains/manage_orders', $data);
	}
	

		public function domain_waiver_details_GET($dw_id = 0,$domain_id)
	{
		$data['settings'] = $this->admin_model->getSettings();
		$data['domain'] = $this->domains->getdomainByID($domain_id);
		$data['domain_waivers'] = $this->domains->getdomainWaiversByID($dw_id);


		$this->LoadView('domains/domain_waiver_details', $data);
	}
	
	public function incompleted()
	{
		$this->LoadView('domains/incomplete_domains', $data);
	}
	
	public function changedomainStatus_POST()
	{
		$domain_id = '';
		if($this->input->post('submit')){
			$domain_id = $this->input->post('domain_id');
			$domain_status = $this->input->post('domain_status');
			
			$Class_IDs = $this->input->post('products');

			$cancel_reasons = $this->input->post('cancel_reasons');
			$qty = $this->input->post('qty');

			$data = array(
				'domain_ID' => $domain_id,
				'domain_Status' => $domain_status,
				'Cancel_Reasons' => $cancel_reasons,
			);
			$result = $this->domains->updatedomain($data);
			
			if($result)
			{
				
				$domain = $this->domains->getdomainByID($domain_id);
				if($domain_status == 'In Process')
				{
// 					$response = $this->_senddomainToUPace($domain);
// 					$log = array(
// 						'domain_ID' => $domain_id,
// 						'Type' => 'UPace Sending domain',
// 						'Response' => $response
// 					);
// 					$this->products_model->addAPISLog($log);
// 					$upaceR = json_decode($response);
					
					//if(!isset($upaceR->backend_id)){
// 						$domainDId = array(
// 							'domain_ID' => $domain_id,
// 							'domain_Status' => 'Pending'
// 						);
// 						$this->domains->updatedomain($domainDId);
// 						$this->session->set_flashdata('requestMsgErr', 991);
// 					} else{
						// $domainDId = array(
						// 	'domain_ID' => $domain_id,
						// 	'Upace_ID' => $upaceR->id
						// );
						// $this->domains->updatedomain($domainDId);
						$this->session->set_flashdata('requestMsgSucc', 360);
					//}
				}
				
				if($domain_status == 'Delivered')
				{
					$this->_senddomainEmail($domain_id);
					$this->session->set_flashdata('requestMsgSucc', 360);
				}
				
				if($domain_status == 'On The Way')
				{
					$this->session->set_flashdata('requestMsgSucc', 360);
				}				
				
				if($domain_status == 'Returned')
				{
					// $this->load->helper('vend_helper');
			  //       $venddomain = json_decode(VEND_GET('/register_sales/'.$domain->Vend_Sale_ID));
			        
			  //       $vendStatusUPD = array(
					// 	'id' => $domain->Vend_Sale_ID,
					// 	'source_id' => $domain_id,
					// 	'invoice_id' => $domain_id,
					// 	'user_id' => VEND_USER_ID,
					// 	'note' => "",
					// 	'status' => 'VOIDED',
					// 	'register_sale_products' => $venddomain->register_sales[0]->register_sale_products
					// );
					
					// $response = json_decode(Vend_POST('/register_sales', json_encode($vendStatusUPD)));
					
					// * Receive Log
					// $log = array(
					// 	'domain_ID' => $domain_id,
					// 	'Type' => 'Vend Response Sale Status Updating',
					// 	'Response' => json_encode($response)
					// );
					// $this->products_model->addAPISLog($log);
					$this->session->set_flashdata('requestMsgSucc', 360);
				}
				
	        } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	        }	
		}
		redirect($this->thisCtrl.'/domainDetails/'.$domain_id);
	}
	
	// Send domain to upace for delivery
	private function _senddomainToUPace($od = array())
	{
		$this->load->helper('upace_helper');
		
		$payload = array (
			'backend_id' => $od->domain_ID,
			'delivery_address' => array (
				'latitude' => $od->CLatitude,
				'longitude' => $od->CLongitude,
				'description' => $od->CAddress,
				'name' => $od->Fullname,
				'mobile' => $od->Phone,
				'backend_id' => $od->domain_ID,
			),
			'pickup_address' => array (
				'longitude' => $od->Longitude,
				'latitude' => $od->Latitude,
				'description' => $od->Address,
				'name' => 'Anoosh Store',
				'mobile' => '920013222',
				'backend_id' => $od->domain_ID,
			),
			'payment' => 'prepaid',
			'delivery_fee' => 0,
			'collect_at_customer' => 0,
			'pay_at_pickup' => 0,
			'allow_to_pickup' => true,
			'allow_to_pay' => true,
		);
		
		foreach($od->domainDetails as $odd)
		{
			$payload['line_items'][] = array (
				'quantity' => $odd->Quantity,
				'description' => $odd->Title_en,
				'name' => $odd->Title_en,
				'price' => $odd->Price,
			);
		}
		
		$log = array(
			'domain_ID' => $od->domain_ID,
			'Type' => 'UPace domain Send',
			'Response' => json_encode($payload)
		);
		$this->products_model->addAPISLog($log);
		
		return UPace_POST('platforms/domains?client_id='.UPACE_CLIENT_ID, json_encode($payload), 'live');
	}
	
	private function _senddomainEmail($domain_id = 0)
	{
		$domain = $this->domains->getdomainByID($domain_id);
        $data['domain'] = (array)$domain;
		$this->load->model('site/home_model');
        $data['website_data']      = (array)$this->home_model->Get_Website_Data();
		$this->load->library('parser');
		$temp_msg = ''.$this->parser->parse('acp_includes/email/invoice_status', $data, TRUE);
	
		//send email
		$options = array(
			'to' => $domain->Email,
			'subject' => 'domain Delivered Successfully',
			'message' => $temp_msg
		);
		
		return SendEmail($options);
	}
	
	/*-----------------------------------------------------------
	---------------------- Reviews -----------------
	--------------------------------------------------------*/
	
	public function reviews_GET()
	{
		$this->LoadView('domains/reviews/list');
	}
	
	public function reviewDetails_GET($domain_id = 0)
	{
		$data['domain'] = $this->domains->getdomainByID($domain_id);
		$data['review'] = $this->domains->getReviewBydomainID($domain_id);
		$this->LoadView('domains/reviews/details', $data);
	}
	
	public function anooshReviews()
	{
		$this->LoadView('domains/anoosh_reviews/list');
	}
	
	public function anooshReviewDetails($review_id = 0)
	{
		$data['review'] = $this->domains->getAnooshReviewByID($review_id);
		$this->LoadView('domains/anoosh_reviews/details', $data);
	}



			/*-----------------------------------------------------------
		---------------------- orders Datatable -----------------
		--------------------------------------------------------*/
	public function getDomainsWaiversList_GET()
	{
		$domains = $this->domains->getOrdersList();

		//var_dump($domains); exit();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		
		$status = array(
  			                                $this->__applicationStatuses[0] => 'primary',
							  	  			$this->__applicationStatuses[1] => 'warning', 
							  	  			$this->__applicationStatuses[2] => 'danger', 
							  	  			$this->__applicationStatuses[3] => 'success',
							  	  			$this->__applicationStatuses[4] => 'danger',
							  	  			$this->__applicationStatuses[5] => 'warning',
							  	  			
		);

		foreach ($domains as $domain) {
			$no++;
			$i++;
			$dt = new DateTime($domain->Created);
			$date = $dt->format('d-m-Y h:m:s A');

			$action_data = array(
				'domain_details' => base_url($this->thisCtrl.'/domain_waiver_details/'.$domain->DW_ID.'/'.$domain->DW_Domain_ID),
				// 'edit_url' => base_url($this->thisCtrl.'/editdomain/'.$domain->DID.'/'),
				'reject_url' => base_url($this->thisCtrl.'/reject_waiver/'.$domain->DW_ID.'/'.$domain->DW_Domain_ID)
			);	

			$action_data['domain'] = $domain;										

			
			// actions template
			$actions = ''.$this->parser->parse('domains/snippets/actions_template_waiver', $action_data, TRUE);
			
			//domain status label
			$domain_status = $domain->DW_Status;

		  	$label = $status["$domain_status"];	
			$status_label = '<span class="label label-'.$label.'">'.getSystemString($domain_status).'</span>';

			$waiver_status = ($domain->IS_Admin_Approve)?'تم التنازل':'لم يتم التنازل';
			$payment_label = ($domain->IS_Admin_Approve)?'success':'warning';	
			$payment = '<span class="label label-'.$payment_label.'">'.$waiver_status.'</span>';

			//$lbl = $status["$domain->DW_Status"];	
			//$waiver_staus = '<span class="label label-'.$lbl.'">'.getSystemString($domain->DW_Status).'</span>';


			//$tld = json_decode($domain->LTD_History);

			$status = ($domain->DW_Status == 'APPROVED')?'Done':$domain->DW_Status;

			
			$row = array();
		
			$row[] = $date;
			$row[] = $domain->Domain_Name.$domain->TLD;
			$row[] = $domain->Fullname.' #'.$domain->Customer_ID;
			$row[] = $domain->Full_Name;
			$row[] = getSystemString($status);
			$row[] = $payment;
			$row[] = $domain->Admin_Email_Sent;
			$row[] = $domain->Second_Admin_Email;
		
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->domains->domainsCount_all(),
						"recordsFiltered" => $this->domains->domainsCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


		public function reject_waiver_GET($dw_id = 0,$domain_id=0){


		$waiver_request = $this->domains->getLastWaiverRequest($domain_id);



		  /* update domain status to rejected*/		  
	      $waiver__data = ['DW_Status' => 'REFUSED'];
	      $this->domains->save($waiver__data, ['DW_ID' => $dw_id], WAIVERS);


	      $waiver_request = ['DCR_Status' => 'refused'];
          $this->domains->save($waiver_request, ['DCR_ID' => $waiver_request->DCR_ID], REQUEST);

	       $this->_send_reject_waiver_email($dw_id, $domain_id);

	      $this->session->set_flashdata('requestMsgSucc', 360);
		  //redirect($this->thisCtrl.'/domainDetails/'.$domain_id);

		  redirect($this->thisCtrl.'/domains_waivers');


		  
	}


		   private function _send_reject_waiver_email($dw_id, $domain_id)
		  {

		    $this->load->model('customer/domain_model');
		    $this->load->model('site/home_model');    
		    $this->load->library('parser');

		        $domain_waivers = $this->domains->getdomainWaiversByID($dw_id);
		        $data['website_data'] = $this->home_model->Get_Website_Data();
		        $data['msg'] = getSystemString('waiver_reject_succ');
		        $data['domain'] = $this->domains->getdomainByID($domain_id);
		        $data['dw_id'] = $dw_id;


		        
		        

		        $subject = getSystemString('waiver_reject_succ');


		        $emails[] = $domain_waivers[0]->Admin_Email;
		       // $emails[] = $this->domain_model->getDomainOrgUsers($domain_id,'Admin');


		        foreach ($emails as $key => $email) {

		            $temp_msg = '' . $this->parser->parse('site/includes/email/reject_waiver', $data, true);

		            //send email
		            $options = array(
		                'to' => $email,
		                'subject' => $subject,
		                'message' => $temp_msg,
		            );

		            SendEmail($options);
		        }

		        return true;

  		}



		/*-----------------------------------------------------------
		---------------------- orders Datatable -----------------
		--------------------------------------------------------*/
	public function getIncompletedApplicationList_GET()
	{
		$domains = $this->domains->getdomainsList();

		//var_dump($domains); exit();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		
		$status = array(
  			                                $this->__domainStatuses[0] => 'success',
							  	  			$this->__domainStatuses[1] => 'primary', 
							  	  			$this->__domainStatuses[2] => 'success', 
							  	  			$this->__domainStatuses[3] => 'warning',
							  	  			$this->__domainStatuses[4] => 'success',
							  	  			$this->__domainStatuses[5] => 'danger',
							  	  			$this->__domainStatuses[6] => 'danger',
							  	  			$this->__domainStatuses[7] => 'danger',
		);

		foreach ($domains as $domain) {
			$no++;
			$i++;
			$dt = new DateTime($domain->DAL_Created);
			$date = $dt->format('d-m-Y h:m:s A');

			$action_data = array(
				'domain_details' => base_url($this->thisCtrl.'/domainDetails/'.$domain->DID.'/'),
				'edit_url' => base_url($this->thisCtrl.'/editdomain/'.$domain->DID.'/'),
				'delete_url' => base_url($this->thisCtrl.'/deletedomain/'.$domain->DID.'/')
			);											
			
			// actions template
			$actions = ''.$this->parser->parse('domains/snippets/actions-template', $action_data, TRUE);
			
			//domain status label
			$domain_status = $domain->Domain_Status;

		  	$label = $status["$domain_status"];	
			$status_label = '<span class="label label-'.$label.'">'.getSystemString($domain_status).'</span>';

			$payment_status = ($domain->Payment_Verified)?102:'payment_not_verified';
			$payment_label = ($domain->Payment_Verified)?'success':'warning';	
			$payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';


			//$tld = json_decode($domain->LTD_History);

			
			$row = array();
			$row[] = $domain->DID;
			$row[] = $date;
			$row[] = $domain->Domain_Name.$domain->TLD;
			$row[] = $domain->Org_Name;
			$row[] = getSystemString($domain->Order_Type);
			$row[] = $status_label;
			// $row[] = $tld->Register_Price.' SAR';
			$row[] = $payment;
			$row[] = $domain->Total_Price.' SAR';
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->domains->domainsCount_all(),
						"recordsFiltered" => $this->domains->domainsCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}



		/*-----------------------------------------------------------
		---------------------- transfer in list -----------------
		--------------------------------------------------------*/

		public function domainTransferDetails_GET($DTI__ID){
					$data['settings'] = $this->admin_model->getSettings();
		            $data['domain'] = $this->domains->getdomainTransferByID($DTI__ID);

		            $data['orders'] = $this->domains->getdomainTransferOrders($DTI__ID);

		            $domain_id = '';
		            foreach ($data['orders'] as $key => $order) {
		            	if(!empty($order->Domain_ID)){
		                   $domain_id = $order->Domain_ID;
		            	}
		            }
		            $data['domain_id'] = $domain_id;



		            // dd($data['domain']);
		            $this->LoadView('domains/domain_transfer_details', $data);
		}

	public function requestDetails_GET($request_id){

			$data['request'] = $this->domains->getRequestByID($request_id);
			$data['request_id'] = $request_id;
			$this->LoadView('domains/request_details', $data);
	}	



	public function getTransferIn_GET()
	{
		$transfers = $this->domains->getTransferInList();

		$data = array();
		$no = $_POST['start'];
		$i = 0;
		
		$status = array(
  			                                $this->__transferStatuses[0] => 'warning',
							  	  			$this->__transferStatuses[1] => 'success', 
							  	  			$this->__transferStatuses[2] => 'danger', 
							  	  			$this->__transferStatuses[3] => 'danger',
							  	  	
							  	  		

		);
		//dd($status);
		

		foreach ($transfers as $transfer) {
			$no++;
			$i++;
			// $dt = new DateTime($domain->DAL_Created);
			// $date = $dt->format('d-m-Y h:m:s A');

			$action_data = array(
				'domain_details' => base_url($this->thisCtrl.'/domainTransferDetails/'.$transfer->DTI__ID),
				//'edit_url' => base_url($this->thisCtrl.'/editdomain/'.$domain->DID.'/'),
				//'delete_url' => base_url($this->thisCtrl.'/deletedomain/'.$domain->DID.'/')
				//'reject_url' => base_url($this->thisCtrl.'/reject_domain/'.$transfer->DID.'/'.$transfer->DO_ID)
			);	
			
			$action_data['domain'] = $domain;										
			
			// actions template
			$actions = ''.$this->parser->parse('domains/snippets/actions-template', $action_data, TRUE);
			
			//domain status label
			$transfer_status = $transfer->DTI_Status;

		  	$label = $status["$transfer_status"];	
			 
			$status_label = '<span class="label label-'.$label.'">'.getSystemString($transfer_status).'</span>';
			$payment_label = ($transfer->Payment_Verified && !$transfer->Payment_Refunded)?'success':'warning';
			if($transfer->Payment_Verified && !$transfer->Payment_Refunded){
					$payment_status = 102;
			}elseif($transfer->Payment_Verified && $transfer->Payment_Refunded){
						$payment_status = 'refunded';
						$payment_label = 'info';				
			}else{
						$payment_status = 'payment_not_verified';								
			}
			
			$payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';


			//$tld = json_decode($domain->LTD_History);




			
			$row = array();
			$row[] = $transfer->request_id;
			$row[] = $transfer->DTI_Created;
			$row[] = $transfer->DTI_Domain_Name.$transfer->DTI_TLD;
			$row[] = $transfer->Email;
			$row[] = $transfer->DTI_Admin_Email;
			$row[] = $status_label;
			// $row[] = $tld->Register_Price.' SAR';
			$row[] = $payment;
			$row[] = $transfer->Total_Price.' SAR';
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->domains->transferCount_all(),
						"recordsFiltered" => $this->domains->transferCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	
	
	/*-----------------------------------------------------------
		---------------------- orders Datatable -----------------
		--------------------------------------------------------*/


	public function getDomainsList_GET()
	{
		$domains = $this->domains->getDomainsList();

		
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		
		$status = array(
  			                                $this->__domainStatuses[0] => 'success',
							  	  			$this->__domainStatuses[1] => 'primary', 
							  	  			$this->__domainStatuses[2] => 'success', 
							  	  			$this->__domainStatuses[3] => 'warning',
							  	  			$this->__domainStatuses[4] => 'success',
							  	  			$this->__domainStatuses[5] => 'danger',
							  	  			$this->__domainStatuses[6] => 'danger',
							  	  			$this->__domainStatuses[7] => 'danger',
							  	  	


		);

		foreach ($domains as $domain) {
			$no++;
			$i++;
			// $dt = new DateTime($domain->DAL_Created);
			// $date = $dt->format('d-m-Y h:m:s A');

			$action_data = array(
				'domain_details' => base_url($this->thisCtrl.'/domainDetails/'.$domain->DID),
				//'edit_url' => base_url($this->thisCtrl.'/editdomain/'.$domain->DID.'/'),
				//'delete_url' => base_url($this->thisCtrl.'/deletedomain/'.$domain->DID.'/')
				'reject_url' => base_url($this->thisCtrl.'/reject_domain/'.$domain->DID.'/'.$domain->DO_ID)
			);	

			$action_data['domain'] = $domain;										
			
			// actions template
			$actions = ''.$this->parser->parse('domains/snippets/actions-template', $action_data, TRUE);

		    if(!empty($domain->DCR_Request_Type)){
				$order_type = getSystemString($domain->DCR_Request_Type);
				//$payment_status = ($domain->Payment_Verified)?102:'payment_not_verified';
				if($domain->Payment_Verified && !$domain->Payment_Refunded){
					$payment_status = 102;
				}elseif($domain->Payment_Verified && $domain->Payment_Refunded){
					$payment_status = 'refunded';				
				}else{
					$payment_status = 'payment_not_verified';								
				}
			    $payment_label = ($domain->Payment_Verified && !$domain->Payment_Refunded)?'success':'warning';	
			    $payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';
			}else{ /* thats means its transfer domain */
				$customer_id = $domain->Customer_ID;
				$domain_name = $domain->Domain_Name;

				$order_type = getSystemString('transfer_in');
				//$transferOrder = $this->domains->getPayedTransferOrders($customer_id,$domain_name);				
			}

			$total_price = empty($domain->Total_Price) ? "" : $domain->Total_Price.' SAR';

			if($_POST['status'] == 'DOMAINS'){
				if($domain->DTO_ID){
					$order_type = getSystemString('transfer_in');
					//$payment_status = ($domain->TR_Payment_Verified)?102:'payment_not_verified';
					if($domain->TR_Payment_Verified && !$domain->TR_Payment_Refunded){
					$payment_status = 102;
					}elseif($domain->TR_Payment_Verified && $domain->TR_Payment_Refunded){
						$payment_status = 'refunded';				
					}else{
						$payment_status = 'payment_not_verified';								
					}

				$payment_label = ($domain->TR_Payment_Verified && !$domain->TR_Payment_Refunded)?'success':'warning';	
				$payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';
					$total_price = empty($domain->TR_Total_Price) ? "" : $domain->TR_Total_Price.' SAR';
				}
			}	

			//domain status label
			$domain_status = $domain->Domain_Status;

		  	$label = $status["$domain_status"];	
			$status_label = '<span class="label label-'.$label.'">'.getSystemString($domain_status).'</span>';


			// ($domain->Modification_Status == 0 && $domain->Domain_Status == 'NEED MODIFICATION')? $status_label .= '<span class="label label-success"><i class="fa fa-check-circle"></i></span>' : '';
		


			//$tld = json_decode($domain->LTD_History);
	
			
			$row = array();
			$row[] = $domain->DID;
			$row[] = $domain->CREATE_DATE;
			$row[] = $domain->Domain_Name.$domain->TLD;
			$row[] = $domain->domain_expire_date;
			$row[] = $domain->Full_Name;
			$row[] = $order_type;
			$row[] = $status_label;
			// $row[] = $tld->Register_Price.' SAR';
			$row[] = $payment;
			$row[] = $total_price;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->domains->domainsCount_all(),
						"recordsFiltered" => $this->domains->domainsCount_filteredV2(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	public function getOrdersList_GET()
	{
		$domains = $this->domains->getOrdersList();

		// var_dump($domains[0]->DAL_Created); exit();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		


				$status = array(
  			                                $this->__requestStatuses[0] => 'primary',
							  	  			$this->__requestStatuses[1] => 'success', 
							  	  			$this->__requestStatuses[2] => 'danger', 
							  	  			$this->__requestStatuses[3] => 'danger',
							  	  			$this->__requestStatuses[4] => 'danger',
							  	  			$this->__requestStatuses[5] => 'primary',
							  	  			$this->__requestStatuses[6] => 'danger',
							  	  			$this->__requestStatuses[7] => 'primary',							  	  			
		        );




		foreach ($domains as $domain) {
			$no++;
			$i++;
			// $dt = new DateTime($domain->DAL_Created);
			// $date = $dt->format('d-m-Y h:m:s A');

			$action_data = array(
				//'domain_details' => base_url($this->thisCtrl.'/domainDetails/'.$domain->DID.'/'.$domain->DCR_ID),
				'request_details' => base_url($this->thisCtrl.'/Request_Details/'.$domain->DCR_ID),
				//'edit_url' => base_url($this->thisCtrl.'/editdomain/'.$domain->DID.'/'),
				//'delete_url' => base_url($this->thisCtrl.'/deletedomain/'.$domain->DID.'/')
				'reject_url' => base_url($this->thisCtrl.'/reject_domain/'.$domain->DID.'/'.$domain->DO_ID)
			);	

			$action_data['domain'] = $domain;										
			
			// actions template
			$actions = ''.$this->parser->parse('domains/snippets/actions-template', $action_data, TRUE);

			if($domain->Payment_Verified && !$domain->Payment_Refunded){
				$payment_status = 102;
			}elseif($domain->Payment_Verified && $domain->Payment_Refunded){
				$payment_status = 'refunded';				
			}else{
				$payment_status = 'payment_not_verified';								
			}

		    if(!empty($domain->DCR_Request_Type)){
				$order_type = getSystemString($domain->DCR_Request_Type);
			    $payment_label = ($domain->Payment_Verified)?'success':'warning';	
			    $payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';
			}else{ /* thats means its transfer domain */
				$customer_id = $domain->Customer_ID;
				$domain_name = $domain->Domain_Name;

				$order_type = getSystemString('transfer_in');
				//$transferOrder = $this->domains->getPayedTransferOrders($customer_id,$domain_name);				
			}

			$total_price = empty($domain->Total_Price) ? "" : $domain->Total_Price.' SAR';

			if($_POST['status'] == 'DOMAINS'){
				if($domain->DTO_ID){
					$order_type = getSystemString('transfer_in');
					$payment_status = ($domain->TR_Payment_Verified)?102:'payment_not_verified';
					$payment_label = ($domain->TR_Payment_Verified)?'success':'warning';	
					$payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';
					$total_price = empty($domain->TR_Total_Price) ? "" : $domain->TR_Total_Price.' SAR';
				}
			}	

			//domain status label
			// $domain_status = $domain->Domain_Status;
		 //  	$label = $status["$domain_status"];	
			// $status_label = '<span class="label label-'.$label.'">'.getSystemString($domain_status).'</span>';


			 if($domain->DCR_Status == 'pending' && $domain->DCR_Admin_Approve == 0){
			 	$domain_status = 'admin_waiting_approve';
			 	$label = 'primary';
			 }else{
				$domain_status = $domain->DCR_Status;
			    $label = $status["$domain_status"];
			}
			$status_label = '<span class="label label-'.$label.'">'.getSystemString($domain_status).'</span>';


			// ($domain->Modification_Status == 0 && $domain->Domain_Status == 'NEED MODIFICATION')? $status_label .= '<span class="label label-success"><i class="fa fa-check-circle"></i></span>' : '';
		


			//$tld = json_decode($domain->LTD_History);
	
			
			$row = array();
			$row[] = $domain->DCR_ID;
			$row[] = $domain->CREATE_DATE;
			$row[] = $domain->Domain_Name.$domain->TLD;
			$row[] = $domain->Full_Name;
			$row[] = $order_type;
			$row[] = $status_label;
			// $row[] = $tld->Register_Price.' SAR';
			$row[] = $payment;
			$row[] = $total_price;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->domains->domainsCount_all(),
						"recordsFiltered" => $this->domains->domainsCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	/*-----------------------------------------------------------
		---------------------- Incompleted domains Datatable -----------------
		--------------------------------------------------------*/
	public function getIncompleteddomainsList()
	{
		$domains = $this->domains->getIncompleteddomainsList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		
		$status = array(
			                                $this->__domainStatuses[0] => 'warning',
							  	  			$this->__domainStatuses[1] => 'primary', 
							  	  			$this->__domainStatuses[2] => 'success', 
							  	  			$this->__domainStatuses[3] => 'warning',
							  	  			$this->__domainStatuses[4] => 'success',
							  	  			$this->__domainStatuses[5] => 'danger',
							  	  			$this->__domainStatuses[6] => 'danger',
		);

		foreach ($domains as $domain) {
			$no++;
			$i++;
			$dt = new DateTime($domain->TimeStamp);
			$date = $dt->format('d-m-Y h:m:s A');
			
			$action_data = array(
				'domain_details' => base_url($this->thisCtrl.'/domainDetails/'.$domain->domain_ID.'?incompleted=true'),
				'edit_url' => base_url($this->thisCtrl.'/editdomain/'.$domain->domain_ID.'/'),
				'delete_url' => base_url($this->thisCtrl.'/deletedomain/'.$domain->domain_ID.'/')
			);											
			
			// actions template
			$actions = ''.$this->parser->parse('domains/snippets/actions-template', $action_data, TRUE);
			
			//domain status label
			$domain_status = $domain->domain_Status;
		  	$label = $status["$domain_status"];	
			$status_label = '<span class="label label-'.$label.'">'.getSystemString($domain_status).'</span>';
			
			$row = array();
			$row[] = $domain->domain_ID;
			$row[] = $date;
			$row[] = $domain->Fullname;
			$row[] = $domain->Phone;
			$row[] = $status_label;
			$row[] = $domain->domainTotal_Price.' SAR';
			$row[] = getSystemString(strtolower($domain->PaymentType));
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->domains->incompleteddomainsCount_all(),
			"recordsFiltered" => $this->domains->incompleteddomainsCount_filtered(),
			"data" => $data
		);
		//output to json format
		echo json_encode($output);
	}
	
	/*-----------------------------------------------------------
		---------------------- Reviews Datatable -----------------
		--------------------------------------------------------*/
	public function getReviewsList_GET()
	{
		$reviews = $this->domains->getReviewsList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		foreach ($reviews as $review) 
		{
			$dt = new DateTime($review->Timestamp);
			
			$action_data = array(
				'review_details' => base_url($this->thisCtrl.'/reviewDetails/'.$review->domain_ID),
// 				'delete_url' => base_url($this->thisCtrl.'/deleteReview/'.$review->domain_ID)
			);											
			// actions template
			$actions = ''.$this->parser->parse('domains/reviews/snippets/actions', $action_data, TRUE);
			
			$rating['rating'] = $review->Overall_Rating;
			$ratings = ''.$this->parser->parse('domains/reviews/snippets/ratings', json_decode(json_encode ($rating), true), TRUE);
			
			$cName = $review->Fullname;
			if(strlen($cName) == 0)
			{
				$cName = '<span class="text-success">vend domain</span>';
			}
			
			$row = array();
			$row[] = $dt->format('d-m-Y');
			$row[] = $review->domain_ID;
			$row[] = $cName;
			$row[] = $ratings;
			$row[] = '<p class="review">'.$review->Review.'</p>';
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->domains->reviewsCount_all(),
						"recordsFiltered" => $this->domains->reviewsCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
    public function getCompanyInfoWathq_GET($rno = '', $type = '' , $return = false)
    {
        if(empty($rno))
        {
            return array();
        }

		if($type == '74'){
			$url = 'https://api.wathq.sa/v4/commercialregistration/info/'.$rno;
		}

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "apikey: XxXFIMeNptIpk75n6lZPlnJbWflCRG7D",
            "Content-Type: application/json"
        ));
        $r = curl_exec($curl);
        curl_close($curl);

        if($return)
        {
            return $r;
        }

        echo $r;
    }
		
		
}
