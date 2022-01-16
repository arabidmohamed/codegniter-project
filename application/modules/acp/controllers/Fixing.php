<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Fixing extends Base_Controller {

    // define controller
    protected $thisCtrl = "fixing";

    function __construct()
    {
        parent::__construct();

        //send controller name to views
        $this->load->vars( array('__controller' => $this->thisCtrl));


    }


public function update_period_request_GET(){
	      $transfer_orders = $this->db
                ->select('r.DCR_POST_DATA,o.*')
                ->where('DCR_Request_Type', 'domain_transfer_in')
                ->where('o.Payment_Verified', 1)
                //->where('o.Payment_Refunded', 0)
                ->join(REQUEST . ' as r', 'o.Request_ID = r.DCR_ID')
                ->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID')
                ->from(TRANSFER_ORDERS . ' as o')
                ->get()
                ->result();


        foreach ($transfer_orders as $order){
            // $post_data = json_decode($order->DCR_POST_DATA);
             $period = 1;

            $this->db->where('DTO_ID',$order->DTO_ID);
			$this->db->update(TRANSFER_ORDERS, array('Period'=>$period));
        }


        $create_orders = $this->db
                ->select('r.DCR_POST_DATA,o.*')
                ->where('DCR_Request_Type', 'create_domain')
                ->where('o.Payment_Verified', 1)
                //->where('o.Payment_Refunded', 0)
                ->join(REQUEST . ' as r', 'o.Request_ID = r.DCR_ID')
                ->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID')
                ->from(ORDERS . ' as o')
                ->get()
                ->result();


        foreach ($create_orders as $order){
            $post_data = json_decode($order->DCR_POST_DATA);
            $period =  $post_data->period;
             if(empty($period)){
                 $period =  $post_data->Period;
             }


            $this->db->where('DO_ID',$order->DO_ID);
			$this->db->update(ORDERS, array('Period'=>$period));
        }

        $renew_orders = $this->db
                ->select('r.DCR_POST_DATA,o.*')
                ->where('DCR_Request_Type', 'renew')
                ->where('o.Payment_Verified', 1)
                //->where('o.Payment_Refunded', 0)
                ->join(REQUEST . ' as r', 'o.Request_ID = r.DCR_ID')
                ->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID')
                ->from(ORDERS . ' as o')
                ->get()
                ->result();


        foreach ($renew_orders as $order){
            $post_data = json_decode($order->DCR_POST_DATA);
             $period =  $post_data->period;
             if(empty($period)){
                 $period =  $post_data->Period;
             }
            $this->db->where('DO_ID',$order->DO_ID);
			$this->db->update(ORDERS, array('Period'=>$period));
        }

        echo 'All Orders Periods Updates !!!'; exit;
}

 public function update_app_log_table_GET(){
 	$this->db->select('*'); 
        $this->db->from(APP_LOG);        
        $query = $this->db->get();
        $all_logs = $query->result();



        $customer_logs = ['registrar_term_approve','registrar_application_canceled','insert_application','update_application','domain_payed','email_invoice','renew_domain_payed','admin_email_waiver','restore_domain_payed','reg_wvr_cnl'];

        $contact_logs = ['admin_officer_email','admin_officer_approve','email_financial_officer','sms_admin_officer','sms_admin_officer_no','sms_financial_officer','sms_financial_officer_no','adm_wvr_cnl','sec_adm_wvr_cnl','admin_application_cancel'];

        $admin_logs = ['super_admin_approve','domain_reject'];


        foreach ($all_logs as $log){

        		$dal_id = $log->DAL_ID;
			$status = $log->DAL_Status;

			$dal_type = '';

			if(in_array($status,$customer_logs)){
				$dal_type = 'Customer';
			}

			if(in_array($status,$contact_logs)){
				$dal_type = 'Contact';
			}

			if(in_array($status,$admin_logs)){
				$dal_type = 'Admin';
			}

			$this->db->where('DAL_ID',$dal_id);
			$this->db->update(APP_LOG, array('DAL_Type'=>$dal_type));
        }

        echo 'All Logs updated !!!'; exit;
 }


/* get the customer_id from domain and update it on orders */
public function update_customer_id_on_orders_GET(){

	$this->db->select('*, d.Customer_ID as uid'); 
        $this->db->from(DOMAIN." AS d");
        $this->db->join(ORDERS.' as o', 'o.Domain_ID = d.Domain_ID','left');
        $query = $this->db->get();
        $domains = $query->result();


        foreach ($domains as $domain){
        		$this->db->where('DO_ID',$domain->DO_ID);
                $this->db->update(ORDERS, array('Customer_ID'=>$domain->uid));
        }

        echo 'all customer_id on orders updated !!!'; exit;

}


/*
	public function renew_custome_domain_GET($domain_id,$period){

        $this->load->library('nic/epp_lib');
		$domain         = $this->domains->getdomainByID($domain_id);
		$domain_ns = $domain->Domain_Name.$domain->TLD;

		// $domain_info = $this->epp_lib->domain_info($domain_ns, $domain_id);
		// $expire_date = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:exDate'];
		// $expire_date = date('Y-m-d',strtotime($expire_date));
		//$expire_date = date('Y-m-d', strtotime('+'.$period.' year', strtotime($expire_date)));

		$expire_date = $domain->Expire_Date;


        $responseJSON = $this->epp_lib->domain_renew($domain_ns, $expire_date, $period, $domain_id);
        $code = $responseJSON[0]['epp']['response']['result']['@attributes']['code'];
	    $msg  = $responseJSON[0]['epp']['response']['result']['msg'];        
        if ($code != '1000') {
        	echo 'Error '.$msg;
        }else{
        	$domain_info = $this->epp_lib->domain_info($domain_ns, $domain_id);
		    $expire_date = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:exDate'];
		    $expire_date = date('Y-m-d',strtotime($expire_date));

		    $domain__data = ['Expire_Date' => $expire_date];
            $this->domains->save($domain__data, ['Domain_ID' => $domain_id], DOMAIN);

            echo 'Domain Renewed Successfully';
        }
	} */


/*
	public function update_org_activity_id_GET(){
		$this->db->select('*'); 
        $this->db->from(DOMAIN." AS d");
         $this->db->join(ORGANIZATION.' as o', 'o.Org_ID = d.Org_ID','left');
        $query = $this->db->get();
        $domains = $query->result();

        foreach ($domains as $domain){
        		$this->db->where('Domain_ID',$domain->Domain_ID);
                $this->db->update(INFO, array('Org_Activity_ID'=>$domain->Org_Activity_ID));
        }

        echo 'all activities updated !!!'; exit;
	}*/


/*
	public function update_Create_date_GET(){
		$this->db->select('*'); 
        $this->db->from(DOMAIN." AS d");
         $this->db->join(ORGANIZATION.' as o', 'o.Org_ID = d.Org_ID','left');
        $query = $this->db->get();
        $domains = $query->result();

        foreach ($domains as $domain){
        		$this->db->where('Domain_ID',$domain->Domain_ID);
                $this->db->update(DOMAIN, array('CREATE_DATE'=>$domain->Org_Created_At));
        }

        echo 'all create date updated !!!'; exit;
	}
*/



/*
	public function update_expire_date_GET(){

				$this->db->select('*'); 
		        $this->db->from(DOMAIN." AS d");
		        $this->db->where('d.Expire_Date !=','NULL');
		        //$this->db->where('d.Domain_ID',593);
		        $query = $this->db->get();
		        $domains = $query->result();

		        $this->load->library('nic/epp_lib');


		  foreach ($domains as $domain){
		  		$domain_id = $domain->Domain_ID;
        		$domain_details = $this->domains->getdomainByID($domain_id);
			    $domain_ns = $domain_details->Domain_Name.$domain_details->TLD;

			    
			    $domain_info = $this->epp_lib->domain_info($domain_ns, $domain_id,$domain->Auth_Code);
			    $code = $domain_info[0]['epp']['response']['result']['@attributes']['code'];
	        
			      if ($code !== '1000') {

			      }else{
			      	 $expire_date = $domain_info[0]['epp']['response']['resData']['domain:infData']['domain:exDate'];
			      	 $expire_date =  date('Y-m-d H-i-s',strtotime($expire_date));
					 $this->db->where('Domain_ID',$domain->Domain_ID);
		             $this->db->update(DOMAIN, array('Expire_Date'=>$expire_date));
			      }
			   			                   
        }

	
 echo 'all domains updated !!!'; exit;
		      

	}*/













	/*

	public function update_transfer_orders_request_id_GET(){

		$this->db->select('*'); 
		$this->db->from(TRANSFER_ORDERS." AS o");
		$this->db->join(REQUEST.' as r', 'r.DCR_Domain_ID = o.Domain_ID');
		$this->db->where('o.Request_ID IS NULL');
		$this->db->where('o.Payment_Verified','1');
		$this->db->where('r.DCR_Request_Type','domain_transfer_in');
		$query = $this->db->get();
		$transfer_orders = $query->result();


	foreach ($transfer_orders as $transfer_order){

			$order_id = $transfer_order->DTO_ID;
			$request_id = $transfer_order->DCR_ID;

			$this->db->where('DTO_ID',$order_id);
			$this->db->update(TRANSFER_ORDERS, array('Request_ID'=>$request_id));
										
		}


	echo 'all domains updated !!!'; exit;
	  

	} */









/*
	public function update_domain_orders_request_id_GET(){

		$this->db->select('*'); 
		$this->db->from(ORDERS." AS o");
		$this->db->join(REQUEST.' as r', 'r.DCR_Domain_ID = o.Domain_ID');
		$this->db->where('o.Request_ID IS NULL');
		$this->db->where('o.Payment_Verified','1');
		$this->db->where('r.DCR_Request_Type','create_domain');
		$this->db->where('r.DCR_Status','approved');
		$query = $this->db->get();
		$domain_orders = $query->result();

		
	foreach ($domain_orders as $domain_order){

			$order_id = $domain_order->DO_ID;
			$request_id = $domain_order->DCR_ID;

			$this->db->where('DO_ID',$order_id);
			$this->db->update(ORDERS, array('Request_ID'=>$request_id));
										
		}


	echo 'all domains updated !!!'; exit;
	  

	}*/











	/*
	public function update_need_modification_domains_request_GET(){
				$this->db->select('*'); 
		        $this->db->from(DOMAIN." AS d");
		        $this->db->where("d.Domain_Status",'NEED MODIFICATION');
		        $query = $this->db->get();
		        $domains = $query->result();


	    foreach ($domains as $domain){
        		$this->db->where('DCR_Domain_ID',$domain->Domain_ID);
        		$this->db->where('DCR_Request_Type','create_domain');
        		$this->db->where('DCR_Status','incomplete');
                $this->db->update(REQUEST, array('DCR_Status'=>'need_modification'));

       
                	$this->db->where('Domain_ID',$domain->Domain_ID);
	                $this->db->update(DOMAIN, array('Domain_Status'=>'PENDING'));
                
        }
         foreach ($domains as $domain){
        		$this->db->where('DCR_Domain_ID',$domain->Domain_ID);
        		$this->db->where('DCR_Request_Type','domain_transfer_in');
        		$this->db->where('DCR_Status','incomplete');
                $this->db->update(REQUEST, array('DCR_Status'=>'need_modification'));

             
                	$this->db->where('Domain_ID',$domain->Domain_ID);
	                $this->db->update(DOMAIN, array('Domain_Status'=>'PENDING'));
                
        }

        echo 'all request updated !!!'; exit;
	}
*/




}