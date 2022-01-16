<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/customer/controllers/Base_Controller.php');

class Communicate_admin extends Base_Controller 
{
	
	protected $thisCtrl = "communicate_admin";

	function __construct()
	{
       parent::__construct();
	   
	   $this->load->model("communication_model", "communication");


	
    }
	
	public function index()
	{
		$customer_id = $this->session->userdata($this->site_session->userid());
		$data['communications'] = $this->communication->getAllcommunications($customer_id);
		$data['website_data']          = $this->home_model->Get_Website_Data();
		$data['customer']       = $this->customer_model->getCustomerData($customer_id);
		//$data['current_subscription']       = $this->customer_model->getCurrentActiveSubscription($customer_id);

		//var_dump($data); exit();

		
		$this->LoadView_m("communication/communications", $data);
	}
	
	public function communication_details($communication_id = 0)
	{
		$customer_id = $this->session->userdata($this->site_session->userid());
		$data['website_data']          = $this->home_model->Get_Website_Data();
		$data['communication'] = $this->communication->getcommunicationDetails($customer_id, $communication_id);
		$data['customer']       = $this->customer_model->getCustomerData($customer_id);
		if(empty($data['communication']))
		{
			show_404();
			die();
		}
		$this->LoadView_m("communication/communication_details", $data);
	}
	
	public function new_communication()
	{	
		$customer_id = $this->session->userdata($this->site_session->userid());

		  $data['website_data']          = $this->home_model->Get_Website_Data();
		  $data['communication_types']        =$this->home_model->get_all(array('parent'=>14,'Status'=>1),'*',null,'constants');
		  $data['customer']       = $this->customer_model->getCustomerData($customer_id);
		$this->LoadView_m("communication/new_communication", $data);
	
	}
	
	public function addcommunication_POST()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata('requestMsgErr', validation_errors());

			redirect($this->thisCtrl."/new_communication");
		}
		$customer_id = $this->session->userdata($this->site_session->userid());
		$communication = array(
			"CustomerId" => $customer_id,
			"Title" => $this->input->post("title"),
			"Description" => $this->input->post("description"),
			"Communication_type" => $this->input->post("communication_types"),
		);
		$result = $this->communication->addcommunication($communication);

		
		if($result > 0)
		{
			$settings = $this->communication->getSettings();
			$data = array(
				'name' => $this->session->userdata($this->site_session->username()),
				'email' => $this->session->userdata($this->site_session->Email()),
				'title' => $this->input->post("title"),
				'description' => $this->input->post("description")
			);
			$this->load->library('parser');
			$temp_msg = ''.$this->parser->parse('email-templates/new_ticket_email', $data, TRUE);
		
			//send email
			$options = array(
				'to' => $settings->Website_Email,
				'subject' => $this->input->post("title"),
				'message' => $temp_msg,
				'from' => $this->session->userdata($this->site_session->email_address())
			);
			$this->load->helper('utilities_helper');
			SendEmail($options);
			
			$this->session->set_flashdata('success', true);
		} else {
			$this->session->set_flashdata('error', true);
		}
		
		redirect($this->thisCtrl);
	}
	
	
	public function addcommunicationComment()
	{
		$comment = array(
			"Comment" => $this->input->post("comment"),
			"CommunicationId" => $this->input->post("communicationId"),
			"Role" => "customer",
			"AddedBy_ID" => $this->session->userdata($this->site_session->userid()),
			"AddedBy" => $this->session->userdata($this->site_session->username())
		);
		$commentid = $this->communication->addcommunicationComment($comment);
		
		// $communication = $this->communication->getcommunicationDetails($customer_id, $communication_id);
		// $settings = $this->communication->getSettings();
		// $data = array(
			// 'name' => $this->session->userdata($this->site_session->username()),
			// 'title' => $this->input->post("title"),
			// 'description' => $this->input->post("description")
		// );
		// $this->load->library('parser');
		// $temp_msg = ''.$this->parser->parse('includes/email/communication', $data, TRUE);
	
		// //send email
		// $options = array(
			// 'to' => $settings->Website_Email,
			// 'subject' => $this->input->post("title"),
			// 'message' => $temp_msg,
			// 'from' => $this->session->userdata($this->site_session->email_address())
		// );
		// $this->load->helper('utilities_helper');
		// SendEmail($options);
		
		echo $commentid;
	}
}