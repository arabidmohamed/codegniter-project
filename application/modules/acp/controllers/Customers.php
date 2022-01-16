<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Customers extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/customers";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
        $this->load->vars( array('__controller' => $this->thisCtrl));
        $this->load->library('parser');
        $this->load->model('customers_model', 'customers');
    }

	public function addNewTicket_GET()
	{
		$this->LoadView('customers/tickets/add_tickets');
	}

    /*********** Tickets ***************/
    // Note: added by A | to display members tickets
    public function tickets_GET()
    {
		$data['stats'] = $this->customers->getTicketsStats();
		$data['all_tickets'] = $this->customers->getTickets();

	    $this->LoadView('customers/tickets/listall', $data);
    }

	public function update_customer_eandom_id_GET(){

		$this->load->model('acp/generic_model', 'generic');

		$all_customers = $this->generic->get_all(null,'*',null,TBL_CUSTOMERS);

		foreach ($all_customers as $row){
				$random_id  = date('y').ceil(date('n', time()) / 3).rand(111, 999).$row->Customer_ID;
				$update_random_id = ['Random_ID' => $random_id];
				$this->generic->save($update_random_id, ['Customer_ID' => $row->Customer_ID], TBL_CUSTOMERS);
		}

		echo 'All Customer Random ID Updated'; exit;

	}
    

    public function deleteCustomer_GET($customer_id = 0){


      $this->load->model('customer/domain_model', 'domains');
     


			$domains_count = count($this->domains->getAllDomainsByCustomerID($customer_id));


	    if($domains_count == 0)
	         {
	         	 $this->load->model('customer/customer_model', 'customer');
	         	/*  delete customer */
	         		 $data = ['Customer_ID'=>$customer_id,
	         		 					'Status' => 0,
	         		 					'Deleted_at'=> date('Y-m-d H:i:s')];
	         		 $is_deleted = $this->customer->deleteCustomer($data); 
	             $this->session->set_flashdata('requestMsgSucc', 'customer_deleted_succ');
	             
	         } else {
		         
	             $this->session->set_flashdata('requestMsgErr', 'customer_deleted_error');
	         }
	        
	    
	    
	    redirect('acp/customerDetails/'.$customer_id);
    }

    public function ticketDetails_GET($ticketId = 0)
    {
		$data['ticket'] = $this->customers->getTickets($ticketId);
		$data['comments'] = $this->customers->getTicketComments($ticketId);

		$customer_id = $data['ticket']->CustomerId;
		$data['customer']        = $this->admin_model->getCustomerByID($customer_id);
        $data['ticketHistories'] = $this->db->where('CustomerId', $customer_id)->get('customer_tickets')->num_rows();
		$data['ticket_review'] = $this->db->select('Rate')->where('TicketId', $ticketId)->get('customer_tickets')->row();
		//dd($data['ticket_review']);
	    $this->LoadView('customers/tickets/details', $data);
    }
	
	public function updateTicketStatus_POST(){

		$ticket_id = $this->input->post('ticketId');
		$status = $this->input->post('ticketStatus');
		$email = $this->input->post('ticketSenderEmail');
		
		//dd($_POST);
		if($status == 'Customer reply')
		{
			$data = array(
				'TicketId' => $ticket_id,
				'Status' => $status
			);
		} else {
			$data = array(
				'TicketId' => $ticket_id,
				'Status' => $status,
				'Is_send' => 0,
				'updated_at' => date('Y-m-d H:i:s')	 		
			);
		}
        $result = $this->customers->updateTicketStatus($data);       
        if($result)
        {
			$this->session->set_flashdata('requestMsgSucc', 120);
		} 
		else 
		{
			$this->session->set_flashdata('requestMsgErr', 119);
		}
		if($result){
			echo json_encode(array('result' => '1'));
		}
	}
	
	public function addTicketComment_POST(){
		date_default_timezone_set('UTC');

		$ticket_id = $this->input->post('ticketId');
		$comment = array(
			'TicketId' => $ticket_id,
			'AddedBy' => $this->session->userdata($this->acp_session->username()),
			'AddedBy_ID' => $this->session->userdata($this->acp_session->userid()),
			'Role' => 'admin',
			'Comment' => $this->input->post('comment'),
			'Timestamp' => date('Y-m-d H:i:s')
		);
		
		$result = $this->customers->addTicketComment($comment);
		// send email to customer on each comment
		if($result)
		{
			$ticket_detail = $this->customers->getTickets($ticket_id);
			//dd($ticket_detail);
			$data = array(
				'ticket_id' => $ticket_id,
				'title' => $ticket_detail->Title,
				'description' => $ticket_detail->Description,
				'fullname' => $ticket_detail->Fullname,
				'customer_email' => $ticket_detail->Email,
				'app_lang' => $ticket_detail->APP_LANG,
				'timestamp' => $ticket_detail->Timestamp
			);
			$this->_notifyCustomerWhenAdminReplies($data);
		}
		// update ticket status 
		$ticketArr = array(
			'TicketId' => $this->input->post('ticketId'),
			'RepliedBy' => $this->session->userdata($this->acp_session->username()),
			'Is_Seen' => 1
		);
		$result = $this->customers->updateTicketStatus($ticketArr);
		
		if($result){
			echo json_encode(array('result' => '1'));
		}
	}
	
    // Ends

	// ************************************************************************
	// Note: send email to customer on each comment
	// ************************************************************************
	public function _notifyCustomerWhenAdminReplies($data = array())
	{	
		
		$setting = $this->db->get('website_settings')->row();
		$website_email = $setting->Website_Email;
		$website_phone = $setting->Website_MobileNo;
		
		$this->load->helper('utilities_helper');

		$data = array(
			'ticket_id' => $data['ticket_id'],
			'title' => $data['title'],
			'description' => $data['description'],
			'fullname' => $data['fullname'],
			'customer_email' => $data['customer_email'],
			'app_lang' => $data['app_lang'],
			'ticket_created_at' => $data['timestamp'],
			'phone' => $website_phone,
			'email' => $website_email

		);
		//dd($data);
		$this->load->library('parser');
		$temp_msg = ''.$this->parser->parse('acp_includes/email/ticket_reply_notify', $data, TRUE);
		
		$options = array(
			'to' => $data['customer_email'],
			'subject' => 'dnet.sa | '.$data['title'].' | Ticket #'.$data['ticket_id'],
			'message' => $temp_msg,
			'from' => 'noreply@dnet.sa'
		);
		//dd($options);
		SendEmail($options);
	}
	// Ends
	// ************************************************************************


    // ********************************************
	// Note: Credits for customers 
	// ********************************************
	public function addCreditsToCustomer_GET($customer_id = 0)
	{
		$data['customer_id'] = $customer_id;
		$this->LoadView('customers/credits/add_credits', $data);
	}
	
	public function modifyCreditsForCustomers_POST()
	{

        $this->load->library('E_Wallet');
				
		if($this->input->post('submit'))
		{
			
			$add_subtract = $this->input->post('type');
			$amount = $this->input->post('amount');
			$customer_id = $this->input->post('customer_id');
			$reason = $this->input->post('reason');
			$added_by = $this->session->userdata($this->acp_session->username()).' - '.$this->session->userdata($this->acp_session->userid());

			$result = $this->e_wallet->modifyCreditsForCustomers($customer_id,$add_subtract,$amount, $reason,$added_by);

	         if($result)
	         {
	             $this->session->set_flashdata('requestMsgSucc', 121);
	             
	         } else {
		         
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }
	        
	    }
	    
	    redirect('acp/customerDetails/'.$customer_id);
	}
	
	public function getCustomerCredits_POST()
	{
		$sales = $this->wallet_model->getCustomerCredits();
		$data = array();
		$no = $_POST['start'];
		

	}	

	// End of credit for customers
	// ********************************************


  	
}