<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Faq extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/faq";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
    }

    public function listall_GET()
	{
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'faq',
						'content' 	   => $_POST,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['faq'] = $this->admin_model->getFaqs();
		$this->LoadView('faq/faq', $data);
	}
	
	public function addQuestion_ADD()
	{
		$this->LoadView('faq/add_question');
	}
	
	public function addNewQuestion_POST()
	{
		if($this->input->post('submit'))
		{
			$slug = url_title($this->input->post('title_ar'), '-', true);
	            
            $data = array(
	            'User_ID' => $this->session->userdata($this->acp_session->userid()),
	            'Title_en' => $this->input->post('title_en'),
	            'Answer_en' => $this->input->post('editor1'),
	            'Title_ar' => $this->input->post('title_ar'),
	            'Answer_ar' => $this->input->post('editor2'),
	            'Slug' => $slug
            );
            
            // image options
			$image_options = array(
				'file' => 'faq_picture',
				'directory' => $GLOBALS['img_faq_dir'],
				'max_width' => 800,
				'file_name' => date('Y-m-d H-i-s').'-faq'
			);
			$upload = UploadFile($image_options);
            
	        if (is_array($upload) && array_key_exists('file_name', $upload))
	        {
				$file_name = $upload['file_name'];
				$data['Picture'] = $file_name;
	        }
            
            $result = $this->admin_model->addQuestion($data);

            $question_id = $this->db->insert_id();

			$log = array(
							'row_id' 	   => $question_id,
							'action_table' => 'faq',
							'content' 	   => $_POST,
							'event' 	   => 'add'
						);

			$this->logs->add_log($log);

            if($result){
				$this->session->set_flashdata('requestMsgSucc', 121);
	        } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	        }
            
		}
		redirect($this->thisCtrl.'/listall');
	}

	public function editQuestion_EDIT($id = 0)
	{
		$log = array(
						'row_id' 	   => $id,
						'action_table' => 'faq',
						'content' 	   => $_POST,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);


		$data['question_id'] = $id;
		$data['question'] = $this->admin_model->getQuestionByID($id);
		$this->LoadView('faq/faq', $data);
	}
	
	public function updateQuestion_PUT()
	{
		if($this->input->post('submit'))
		{
			$slug = url_title($this->input->post('title'), '-', true);
	            
            $data = array(
	            'Q_ID' => $this->input->post('question_id'),
	            'Title_en' => $this->input->post('title_en'),
	            'Answer_en' => $this->input->post('editor1'),
	            'Title_ar' => $this->input->post('title_ar'),
	            'Answer_ar' => $this->input->post('editor2'),
	            'Slug' => $slug
            );
            
            // image options
			$image_options = array(
				'file' => 'faq_picture',
				'directory' => $GLOBALS['img_faq_dir'],
				'max_width' => 800,
				'file_name' => date('Y-m-d H-i-s').'-faq'
			);
			$upload = UploadFile($image_options);
			
	        if (is_array($upload) && array_key_exists('file_name', $upload))
	        {
				$file_name = $upload['file_name'];
				$data['Picture'] = $file_name;
	        }
            
            $result = $this->admin_model->updateQuestion($data);

			$log = array(
							'row_id' 	   => $data['Q_ID'],
							'action_table' => 'faq',
							'content' 	   => $_POST,
							'event' 	   => 'update'
						);

			$this->logs->add_log($log);

            if($result)
            {
				$this->session->set_flashdata('requestMsgSucc', 120);
	        }
	        else
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
            
		}
		redirect($this->thisCtrl.'/listall');
	}

    public function deleteQuestion_DELETE($id = 0)
    {
        $result = $this->admin_model->deleteQuestion($id);

        $log = array(
            'row_id' 	   => $id,
            'action_table' => 'faq',
            'content' 	   => $id,
            'event' 	   => 'delete'
        );

        $this->logs->add_log($log);


        if($result)
        {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl.'/listall');
    }

}