<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Transactions extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/transactions"; 
	public $__directories = array();
	
	function __construct()
	{
    	parent::__construct();
    	    	
    	// send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
    	$this->load->model('transactions_model', 'transactions');
  	}
  	
  	public function listall()
  	{
	  	$this->LoadView('customers/payment_transfers/listall');
  	}
  	
  	public function details($customer_id = 0, $subscription_id = 0)
	{
		$data['customer_id'] = $customer_id;
		$data['customer'] = $this->admin_model->getCustomerByID($customer_id);
		$data['subscription'] = $this->admin_model->getCustomerPendingSubscriptionDetails($subscription_id);
		
		$this->LoadView('customers/payment_transfers/details', $data);
	}
	
	public function verifyPaymentTransfer()
	{
		$sub_id = $this->input->post('cs_id');
		$customer_id = $this->input->post('customer_id');
		$subDetails = $this->admin_model->getCustomerPendingSubscriptionDetails($sub_id);
		
		if(count($subDetails) > 0)
		{
			$paymentStatus = 'Rejected';
			$paymentFlag = -1;
			
			if($this->input->post('payment_status') == 'verify_payment')
			{
				$paymentStatus = 'Verified';
				$paymentFlag = 1;
				
				$subActDetails = array(
					'Customer_ID' => $subDetails->Customer_ID,
					'Plan_ID' =>  $subDetails->Plan_ID,
					'Balance' => $subDetails->Plan_Price,
					'Starts_At' => $subDetails->Starts_At,
					'Expires_At' => $subDetails->Expires_At
				);
				$s = $this->admin_model->subscribeCustomer($subActDetails);
				
				// make user a Member
				$customer['Is_Member'] = 1;
				$customer['Customer_ID'] = $subDetails->Customer_ID;
				$this->admin_model->updateCustomer($customer);	
			}
			
			$payment = array(
				'CS_ID' => $sub_id,
				'Payment_Verified' => $paymentFlag,
				'Status' => $paymentStatus
			);
			$result = $this->admin_model->modifyPaymentBySID($payment);
			
			if($result){
	            $this->session->set_flashdata('requestMsgSucc', 1003);
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }	
		}
		
		redirect($this->thisCtrl.'/details/'.$customer_id.'/'.$sub_id);
	}
  	
  	/**
        *------- Data List *---------
    **/
    
  	public function getDataList()
  	{
  		$transactions = $this->transactions->getDataList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		//print_r($list);
		foreach ($transactions as $t) 
		{
			$no++;
			$i++;

			$dt = new DateTime($t->Timestamp);
			$date = $dt->format('d-m-Y');
					  
			// actions template
			$details_url = base_url($this->thisCtrl.'/details/'.$t->Customer_ID.'/'.$t->CS_ID);
			
			// status Label
			$statusLabel = "";
			$statuses = array(
				"Pending" => "warning",
				"Verified" => "success",
				"Rejected" => "danger"
			);
			$cStatus = $t->Status;
			if(empty($cStatus)){ $cStatus = 'Pending'; }
			$statusLabel = "<label class='label label-".$statuses["$cStatus"]."'>".getSystemString($cStatus)."</label>";
			
			$row = array();
			$row[] = $t->Customer_ID;
			$row[] = $date;
			$row[] = $t->Fullname;
			$row[] = $t->Email;
			$row[] = "$t->Plan_Name";
			$row[] = $statusLabel;
			$row[] = '<a href="'.$details_url.'" style="color: #333" class="btn btn-default"> <i class="fa fa-eye"></i> '.getSystemString(324).'</a>';
			
			$data[] = $row;
			
		} // end foreach

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->transactions->Count_all(),
			"recordsFiltered" => $this->transactions->Count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	  	
}