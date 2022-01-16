<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Communications extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/communications";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
        $this->load->vars( array('__controller' => $this->thisCtrl));
        $this->load->library('parser');


    }

    /*********** communications ***************/
    // Note: added by Mohammed Arabid | to display members communications
    public function listAll_GET()
    {
		 $data['stats'] = $this->admin_model->getcommunicationsStats();
		 $data['communications'] = $this->admin_model->getcommunications();

	     $this->LoadView('customers/communications/listall', $data);
    }
    
    public function communicationDetails_GET($CommunicationId = 0)
    {
		$data['communication'] = $this->admin_model->getcommunications($CommunicationId);
		$data['comments'] = $this->admin_model->getcommunicationComments($CommunicationId);
	    $this->LoadView('customers/communications/details', $data);
    }
	
	public function updatecommunicationStatus_POST(){
		$data = array(
			'CommunicationId' => $this->input->post('CommunicationId'),
			'Status' => $this->input->post('communicationStatus'),
		);

        $result = $this->admin_model->updatecommunicationstatus($data);
        
        if($result)
        {
			$this->session->set_flashdata('requestMsgSucc', 120);
		} 
		else 
		{
			$this->session->set_flashdata('requestMsgErr', 119);
		}
		redirect($this->thisCtrl.'/communicationDetails/'.$this->input->post('CommunicationId'));
	}
	
	public function addcommunicationComment_POST(){
		date_default_timezone_set('UTC');
		
		$comment = array(
			'CommunicationId' => $this->input->post('CommunicationId'),
			'AddedBy' => $this->session->userdata($this->acp_session->username()),
			'AddedBy_ID' => $this->session->userdata($this->acp_session->userid()),
			'Role' => 'admin',
			'Comment' => $this->input->post('comment'),
			'Timestamp' => date('Y-m-d H:i:s')
		);
		
		$result = $this->admin_model->addcommunicationComment($comment);
		
		// update communication status 
		$communicationArr = array(
			'CommunicationId' => $this->input->post('CommunicationId'),
			'RepliedBy' => $this->session->userdata($this->acp_session->username())
		);
		$this->admin_model->updatecommunicationstatus($communicationArr);
		
		echo $result;
	}
	
	
	
    // Ends
  	
}