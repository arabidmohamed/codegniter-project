<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/customer/controllers/Base_Controller.php');

class Support extends Base_Controller
{

	protected $thisCtrl = "cu/support";

	function __construct()
	{
		parent::__construct();

		$this->load->model("support_model", "support");
		$this->load->helper('image_helper');
		$this->load->library('parser');

		$userid = $this->session->userdata($this->site_session->userid());
		$this->allOpenTicketsNum = count($this->customer_model->getAllOpenTickets($userid));
    }

	public function index($page = 1)
	{
		$customer_id = $this->session->userdata($this->site_session->userid());

		$data['website_data']          = $this->home_model->Get_Website_Data();
		$data['customer']       = $this->customer_model->getCustomerData($customer_id);
        $data['pageTitle'] = getSystemString('my_consulting');
		
		//$data['tickets'] = $this->support->getAllTickets($customer_id);
		//$data['tickets'] = $this->support->getAllTickets($customer_id);

		$data['pages_count'] = (int) ceil(count($this->support->getAllTickets($customer_id)) / 6);
        if ( $page > $data['pages_count'] ) {
            $page = $data['pages_count'];
        }
        $data['tickets'] = $this->getTicketsList($page);
        $data['current_page'] = $page;
        $data['next_page'] = $page + 1;
        $data['pre_page'] = $page - 1;


		$this->LoadView_m("support/tickets", $data);
	}



	public function getTicketsList($page = 1)
    {
        $this->load->library('parser');

        $data      = array() ;

        $customer_id = $this->session->userdata($this->site_session->userid());

        $tickets = $this->support->getAllTickets($customer_id);

        $limit = 6;

        $offset = ($page - 1) * $limit;
        $numberOfPages = (int) ceil(count($tickets) / $limit);

        $tickets = array_slice($tickets, $offset, $limit);

        return $tickets;
    }


	public function ticket_details($ticket_id = 0)
	{
		$ticket_id = decryptIt($ticket_id);
		$customer_id = $this->session->userdata($this->site_session->userid());
		$data['website_data']          = $this->home_model->Get_Website_Data();
		$data['ticket'] = $this->support->getTicketDetails($customer_id, $ticket_id);
		$data['customer']       = $this->customer_model->getCustomerData($customer_id);
		//dd($data['ticket']);
		if(empty($data['ticket']))
		{
			show_404();
			die();
		}
		$this->LoadView_m("support/ticket_details", $data);
	}

	public function new_ticket()
	{
		$customer_id = $this->session->userdata($this->site_session->userid());
		$data['website_data']       = $this->home_model->Get_Website_Data();
		$data['customer']           = $this->customer_model->getCustomerData($customer_id);
		$data['tickets'] = $this->support->getAllTickets($customer_id);



		$this->LoadView_m("support/new_ticket", $data);

	}

	public function addTicket_POST()
	{
		$this->load->library('form_validation');
		//echo '<pre>';print_r($_FILES);

		$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('requestMsgErr', validation_errors());

			redirect($this->thisCtrl."/new_ticket");
		}
		$customer_id = $this->session->userdata($this->site_session->userid());
		$type =  $this->input->post('selected_option')?:'other';

		$ticket = array(
			"CustomerId" => $customer_id,
			"Title" => $this->input->post("title"),
			"Description" => $this->input->post("description"),
			'Cause' => $type,
		);


		// to send files
		$target_dir = $GLOBALS['img_tickets_dir'];
		// *****************************
		// 1st file
		// *****************************
		// file options
		$file_options = array(
			'file' 		  => 'file',
			'directory'   => $target_dir,
			'allowed_types' => 'gif|jpg|png|pdf',
			'file_name'   => date('Y-m-d H-i-s').'-file_1'
		);

		$upload_data = UploadFile($file_options);

		if (is_array($upload_data) && array_key_exists('file_name', $upload_data))
		{
			$ticket['File'] = $upload_data['file_name'];
		}

		// *****************************
		// 2nd file
		// *****************************
		// file options
		$file_2nd_options = array(
			'file' 		  => 'attach',
			'directory'   => $target_dir,
			'allowed_types' => 'gif|jpg|png|pdf',
			'file_name'   => date('Y-m-d H-i-s').'-file_2'
		);

		$upload_2nd_data = UploadFile($file_2nd_options);

		if (is_array($upload_2nd_data) && array_key_exists('file_name', $upload_2nd_data))
		{
			$ticket['File_two'] = $upload_2nd_data['file_name'];
		}
		// ends
		//echo '<pre>';print_r($ticket);die();
		$ticket_id = $this->support->addTicket($ticket);
		
		if($ticket_id > 0)
		{
			$settings = $this->support->getSettings();
			$data = array(
				'name' => $this->session->userdata($this->site_session->username()),
				'email' => $this->session->userdata($this->site_session->Email()),
				'title' => $this->input->post("title"),
				'description' => $this->input->post("description")
			);
			$this->load->library('parser');
			$temp_msg = ''.$this->parser->parse('email-templates/new_ticket_email', $data, TRUE);

			//send email to admin email [support@dnet.sa]
			$options = array(
				'to' => $settings->Website_Email,
				'subject' => $this->input->post("title"),
				'message' => $temp_msg,
				'from' => $this->session->userdata($this->site_session->email_address())
			);
			$this->load->helper('utilities_helper');
			SendEmail($options);
			// send email to customer after successfully opening a ticket
			$customer_details = $this->support->getTicketDetails($customer_id, $ticket_id);
			//dd($customer_details);
			$data = array(
				'ticket_id' => $customer_details->TicketId,
				'title' => $customer_details->Title,
				'description' => $customer_details->Description,
				'fullname' => $customer_details->Fullname,
				'customer_email' => $customer_details->Email,
				'app_lang' => $customer_details->APP_LANG,
				'timestamp' => $customer_details->Timestamp
			);
			//dd($data);
			$this->_notifyCustomerWithNewCreatedTicket($data);
			// ends
			$this->session->set_flashdata('requestMsgSucc', 'new_ticket_validation');
		} else {
			$this->session->set_flashdata('requestMsgErr', 119);
		}

		redirect($this->thisCtrl);
	}


	public function addTicketComment()
	{
		$comment = array(
			"Comment" => $this->input->post("comment"),
			"TicketId" => decryptIt($this->input->post("ticketId")),
			"Role" => "customer",
			"AddedBy_ID" => $this->session->userdata($this->site_session->userid()),
			"AddedBy" => $this->session->userdata($this->site_session->username())
		);
		//dd($ticketStatus);
		$commentid = $this->support->addTicketComment($comment);

		// to notify admin user when a new reply is made by customer
		$ticket_id = decryptIt($this->input->post("ticketId"));
		$admin_user_id = $this->input->post("adminUserID");
		$customer_id = $this->session->userdata($this->site_session->userid());
		$ticket = $this->support->getTicketDetails($customer_id, $ticket_id);
		$reply = $this->support->getTicketCommentByID($ticket_id, $admin_user_id);
		$settings = $this->support->getSettings();
		//dd($reply);
		// used to change status from answered to Pending only in ticket comment [reply]
		$ticketStatus = array(
			'TicketId' => decryptIt($ticket_id),
			'Status' => 'Pending',
			'Is_send' => 0
		);
		$this->support->updateTicketStatusOnReply($ticketStatus);
		//dd($ticketStatus);
		$admin_username = $reply[0]->Username; // eg: adam@dnet.sa
		$data = array(
			'name' => $reply[0]->Fullname,
			'ticket_id' => $reply[0]->TicketId,
			'title' => 'Reply Ticket | رد على تذكرة #ID'.$reply[0]->TicketId
		);
		
		$this->load->library('parser');
		$temp_msg = ''.$this->parser->parse('email-templates/ticket_reply_notify', $data, TRUE);

		//send email
		$options = array(
			'to' => $admin_username,
			'subject' => 'Reply Ticket | رد على تذكرة #ID'.$reply[0]->TicketId,
			'message' => $temp_msg
		);
		$this->load->helper('utilities_helper');
		SendEmail($options);

		echo $commentid;
	}


	public function updateTicketStatus()
	{
		//echo '<pre>';print_r($_POST);die();
		$data = array(
			'TicketId' => decryptIt($this->input->post('ticketId')),
			'Status' => $this->input->post('ticketStatus'),
			'Is_send' => 0, // once ticket is updated by customer to open then need to set is_send to 0
			'updated_at' => date('Y-m-d H:i:s')
		);

    	$result = $this->support->updateTicketStatus($data);

		if($result){
			echo json_encode(array('result' => '1'));
			die();
		}
	}

	public function updateTicketRate()
	{
		// echo '<pre>';print_r($_POST);die();
		$data = array(
			'TicketId' => decryptIt($this->input->post('ticketId')),
			'Rate' => $this->input->post('ticketRate')
		);

    	$result = $this->support->updateTicketRate($data);

		if($result){
			echo json_encode(array('result' => '1'));
			die();
		}
	}

	// ************************************************************************
	// Note: to send notification email to the customer when new ticket created
	// ************************************************************************
	public function _notifyCustomerWithNewCreatedTicket($data = array())
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
		$this->load->library('parser');
		$temp_msg = ''.$this->parser->parse('email-templates/send-new-ticket-email-notifications', $data, TRUE);
		
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

}
