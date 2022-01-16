<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Branches extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/branches";
	
	function __construct()
	{
    	parent::__construct();
    	    	
    	// send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
    	
    	$this->load->model('branches_model', 'branches');
    	$this->load->library('parser');
  	}
  	
  	public function listall_GET()
  	{
   		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'branches',
						'content' 	   => 0,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

	  	$data['branches'] = $this->branches->getAll();
	  	$this->LoadView('branches/listall', $data);
  	}
  	
  	public function add_ADD()
  	{
  		 	$data['managers'] = $this->branches->getAllBranchManagers();
	  	$this->LoadView('branches/add', $data);
  	}
  	
  	public function add_POST()
  	{
	  	if($this->input->post('submit'))
	  	{
		  	 	$branch = array(
						  	'Name_en' => $this->input->post('name_en'),
						  	'Name_ar' => $this->input->post('name_ar'),
						  	'Details_en' => $this->input->post('description_en'),
						  	'Details_ar' => $this->input->post('description_ar'),
						  	'Address' => $this->input->post('address'),
						  	'City_en' => $this->input->post('city_en'),
						  	'City_ar' => $this->input->post('city_ar'),
						  	'Phone' => $this->input->post('phone'),
						  	'Branch_Manager_ID' =>$this->input->post('branch_manager_id'),
						  	'Latitude' => $this->input->post('latitude'),
						  	'Longitude' => $this->input->post('longitude'),
						  	'Created_At' => date('Y-m-d')
					  	);
					  	
		  	$result = $this->branches->add($branch);
		  	
		  	$branchId = $this->db->insert_id();

		  	if($result)
		  	{
		   		$log = array(
								'row_id' 	   => $branchId,
								'action_table' => 'branches',
								'content' 	   => $_POST,
								'event' 	   => 'add'
							);

				$this->logs->add_log($log);

	            $this->session->set_flashdata('requestMsgSucc', 121);
	        } 
	        else 
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
	  	}
	  	
	  	redirect($this->thisCtrl.'/listall');
  	}
  	
  	public function edit_EDIT($id = 0)
  	{
   		$log = array(
						'row_id' 	   => $id,
						'action_table' => 'branches',
						'content' 	   => $id,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

	  	$data['branch'] = $this->branches->getAll($id);
	  	$data['managers'] = $this->branches->getAllBranchManagers();

	  	$this->LoadView('branches/edit', $data);
  	}
  	
  	public function edit_POST()
  	{
	  	
	  	if($this->input->post('submit'))
	  	{
	  		$branch = array(
						  		'Branch_ID' => $this->input->post('branchId'),
						  	'Branch_Manager_ID' =>$this->input->post('branch_manager_id'),						  		
							  	'Name_en' => $this->input->post('name_en'),
							  	'Name_ar' => $this->input->post('name_ar'),
							  	'Details_en' => $this->input->post('Details_en'),
							  	'Details_ar' => $this->input->post('Details_ar'),
							  	'Address' => $this->input->post('address'),
							  		'City_en' => $this->input->post('city_en'),
						  	'City_ar' => $this->input->post('city_ar'),
							  	 'Latitude' => $this->input->post('latitude'),
							  	 'Longitude' => $this->input->post('longitude')
						  	);
		  	
		  	$result = $this->branches->update($branch);
	  		
		  	if($result)
		  	{
		   		$log = array(
								'row_id' 	   => $branch['Branch_ID'],
								'action_table' => 'branches',
								'content' 	   => $_POST,
								'event' 	   => 'update'
							);

				$this->logs->add_log($log);

	            $this->session->set_flashdata('requestMsgSucc', 120);
	        } 
	        else 
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
        }
        
        redirect($this->thisCtrl.'/listall');
  	}
  	
  	public function delete_DELETE($id = 0)
  	{
	  	$result = $this->branches->delete($id);
	  	
		if($result)
		{
	   		$log = array(
							'row_id' 	   => $id,
							'action_table' => 'branches',
							'content' 	   => $_POST,
							'event' 	   => 'delete'
						);

			$this->logs->add_log($log);

            $this->session->set_flashdata('requestMsgSucc', 122);
        } 
        else 
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        
		redirect($this->thisCtrl.'/listall');
  	}
  	
}