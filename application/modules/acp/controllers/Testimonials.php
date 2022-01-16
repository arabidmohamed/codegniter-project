<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Testimonials extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/testimonials"; 
	
	function __construct()
	{
    	parent::__construct();
    	    	
    	// send controller name to views
    	$this->load->model('testimonials_model', 'testimonials');
  	}
	
	// ****************************************************
	// Note: Testimonials
	// ****************************************************
	
	public function listall_GET()
	{
		$data['reviews'] = $this->testimonials->getAllCustomerReview();
		
		$this->LoadView('testimonials/listall', $data);
	}
	
	public function add_customer_review_GET()
	{
		$this->LoadView('testimonials/add');
	}
	
	public function addCustomerReview_POST()
	{
		if($this->input->post('submit'))
		{
	        $title = $this->input->post('title');
			$editor = $this->input->post('editor');
			$video = $this->input->post('video');
			$type = $this->input->post('type');
			    
            $insertData = array(
				'Stars' => $this->input->post('stars'),
	            'Title'   => $title,
	            'Video'   => $video,
	            'Type'    => $type,
	            'Quotes'  => $editor
            );


            $target_dir = $GLOBALS['img_ck_dir'] ;

          if (isset($_FILES['background_picture']) && !empty($_FILES['background_picture']['name'])) {
                $config['upload_path'] = $target_dir;
                $config['allowed_types'] = '*';
                $config['max_size'] = '0';
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);

               
                      if (!$this->upload->do_upload("background_picture")) {
                          $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode(array('status' => false, 'msgu' => ' يجب تحميل ملف بصيغة بد دي اف')));
                      
                    } else {               
                        $uploadedFileData = $this->upload->data();
                        $background_picture = md5(time()) .'background_picture'. $uploadedFileData['file_ext'];
                        rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $background_picture);
                        $insertData["Picture"] = $background_picture;
                    }

         }


            
            $result = $this->testimonials->addCustomerReview($insertData);
            if($result){
				$this->session->set_flashdata('requestMsgSucc', 121);
	        } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	        }
            redirect($this->thisCtrl.'/listall');
		}
		redirect($this->thisCtrl.'/listall');
	}
	
	public function edit_customer_review_GET($id = 0)
	{
		$data['ID'] = $id;
		$data['reviews'] = $this->testimonials->getCustomerReviewByID($id);
		$this->LoadView('testimonials/edit', $data);
	}
	
	public function updateCustomerReview_PUT()
	{
		if($this->input->post('submit'))
		{
	            
            $data = array(
	            'ID'      => $this->input->post('id'),
				'Stars'   => $this->input->post('stars'),
	            'Title'   => $this->input->post('title'),
	            'Quotes'  => $this->input->post('editor'),
	            'Type'  => $this->input->post('type'),
	            'Video'  => $this->input->post('video')
            );

             $target_dir = $GLOBALS['img_ck_dir'] ;
        if (isset($_FILES['background_picture']) && !empty($_FILES['background_picture']['name'])) {
                $config['upload_path'] = $target_dir;
                $config['allowed_types'] = '*';
                $config['max_size'] = '0';
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);

               
                      if (!$this->upload->do_upload("background_picture")) {
                          $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode(array('status' => false, 'msgu' => ' يجب تحميل ملف بصيغة بد دي اف')));
                      
                    } else {               
                        $uploadedFileData = $this->upload->data();
                        $background_picture = md5(time()) .'background_picture'. $uploadedFileData['file_ext'];
                        rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $background_picture);
                        $data["Picture"] = $background_picture;
                    }

         }

            $result = $this->testimonials->updateCustomerReview($data);
            if($result){
				$this->session->set_flashdata('requestMsgSucc', 121);
	        } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}
		redirect($this->thisCtrl.'/listall');
	}
	
	public function deleteCustomerReview_GET($id = 0)
	{
		//echo '<pre>';print_r($id);die();
		$result = $this->testimonials->deleteCustomerReview($id);
		if($result)
		{
	         $this->session->set_flashdata('requestMsgSucc', 122);
         } else {
             $this->session->set_flashdata('requestMsgErr', 119);
         }
		redirect($this->thisCtrl.'/listall');
	}
	
	// Ends
	// ****************************************************
	
}