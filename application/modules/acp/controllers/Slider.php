<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Slider extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/slider";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
    }
    
    public function listall_GET()
	{
		$data['slides'] = $this->admin_model->getSlides();

		$this->LoadView('slider/home_slider', $data);
	}
	
	public function new_slide_ADD()
	{
		$this->LoadView('slider/add_slide');
	}
	
	public function editSlide_EDIT($slideid = 0)
	{

		$data['slide_id'] = $slideid;
		$data['slide'] 	  = $this->admin_model->getSlideByID($data);

		$log = array(
						'row_id'	   => $slideid,
						'action_table' => 'website slider',
						'content' 	   => $slideid,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$this->LoadView('slider/home_slider', $data);
	}
	
	public function addNewSlide_POST()
	{
		if($this->input->post('submit'))
		{

// image options
            // $image_options = array(
            //     'file'    => 'slide_picture',
            //     'directory' => $GLOBALS['img_slides_dir'],
            //     'max_width' => 1920,
            //     'file_name' => date('Y-m-d H-i-s').'-slider'
            // );

            // $upload = UploadFile($image_options);

            // if(!is_array($upload) && !array_key_exists('file_name', $upload))
            // {
            //     $this->session->set_flashdata('requestMsgErr', $upload);
            //     redirect($this->thisCtrl.'/new_slide');

            // }

            // $file_name = $upload['file_name'];

            // $directory = $GLOBALS['img_slides_dir'];

            // $this->load->library('image_lib');
            // $config['image_library'] = 'gd2';
            // $config['source_image'] = $directory.$file_name;
            // $config['create_thumb'] = TRUE;
            // $config['maintain_ratio'] = TRUE;
            // $config['height'] =  400;
            // $config['width'] = 400;
            // $config['new_image'] = $file_name;//you should have write permission here..
            // $this->image_lib->initialize($config);
            // $this->image_lib->resize();

	 $otherrandomName = '';
      if (isset($_FILES['slide_picture']) && !empty($_FILES['slide_picture']['name'])) {
          $config['upload_path'] = $GLOBALS['img_slides_dir'];
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

       
              if (!$this->upload->do_upload("slide_picture")) {
                $this->session->set_flashdata('requestMsgErr', getSystemString('system_error_msg'));
                redirect($this->thisCtrl.'/new_slide');
              
            } else {               
                $uploadedFileData = $this->upload->data();
                $otherrandomName = md5(time()) .'-slider'. $uploadedFileData['file_ext'];
                rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $otherrandomName);
               // $uploadedFileData["file_name"] = $otherrandomName;

                $updateData['Slide_Image'] = $otherrandomName;
				$updateData['Slide_Image_Phone'] = $otherrandomName;
            }

    }

            $data = array(
                'Title_en' => $this->input->post('title_en'),
                'Title_ar' => $this->input->post('title_ar'),
                'Slide_Caption_en' => $this->input->post('caption_en'),
                'Slide_Caption_ar' => $this->input->post('caption_ar'),
                'Slide_Image' => $otherrandomName,
                'Slide_Image_Phone' => $otherrandomName,
                'Target_Link' => $this->input->post('link')
                
            );

            $result = $this->admin_model->addSlide($data);

            $slide_id = $this->db->insert_id();

            $log = array(
                'row_id'   => $slide_id,
                'action_table' => 'website slider',
                'content'   => $_POST,
                'event'   => 'add'
            );

            $this->logs->add_log($log);

            if($result)
            {
                $this->session->set_flashdata('requestMsgSucc', 121);
            }
            else
            {
                $this->session->set_flashdata('requestMsgErr', 119);
            }

        }
		redirect($this->thisCtrl.'/listall');
	}
	
	public function updateSlide_PUT()
	{
		if($this->input->post('submit'))
		{
			$id = $this->input->post('slide_id');
			$title_en = $this->input->post('title_en');
			$title_ar = $this->input->post('title_ar');
			
			$updateData = array(
									'Slide_ID' => $id,
									'Title_en' => $title_en,
									'Title_ar' => $title_ar,
									'Slide_Caption_en' => $this->input->post('caption_en'),
									'Slide_Caption_ar' => $this->input->post('caption_ar'),
									'Target_Link' => $this->input->post('link')
									
								);


if (isset($_FILES['slide_picture']) && !empty($_FILES['slide_picture']['name'])) {
          $config['upload_path'] = $GLOBALS['img_slides_dir'];
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

       
              if (!$this->upload->do_upload("slide_picture")) {
                 $this->session->set_flashdata('requestMsgErr', getSystemString('system_error_msg'));
                redirect($this->thisCtrl.'/new_slide');
              
            } else {               
                $uploadedFileData = $this->upload->data();
                $otherrandomName = md5(time()) .'-slider'. $uploadedFileData['file_ext'];
                rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $otherrandomName);
               // $uploadedFileData["file_name"] = $otherrandomName;

                $updateData['Slide_Image'] = $otherrandomName;
				$updateData['Slide_Image_Phone'] = $otherrandomName;
            }

    }
								
			// // image options
			// $image_options = array(
			// 						'file' 	    => 'slide_picture',
			// 						'directory' => $GLOBALS['img_slides_dir'],
			// 						'max_width' => 1920,
			// 						'file_name' => date('Y-m-d H-i-s').'-slider'
			// 					);

			// $upload = UploadFile($image_options);
   //          $file_name = $upload['file_name'];

   //          $directory = $GLOBALS['img_slides_dir'];

   //          $this->load->library('image_lib');
   //          $config['image_library'] = 'gd2';
   //          $config['source_image'] = $directory.$file_name;
   //          $config['create_thumb'] = TRUE;
   //          $config['maintain_ratio'] = TRUE;
   //          $config['height'] =  400;
   //          $config['width'] = 400;
   //          $config['new_image'] = $file_name;//you should have write permission here..
   //          $this->image_lib->initialize($config);
   //          $this->image_lib->resize();
	  //       if (is_array($upload) && array_key_exists('file_name', $upload))
	  //       {
			// 	$file_name = $upload['file_name'];
			// 	$updateData['Slide_Image'] = $file_name;
			// 	$updateData['Slide_Image_Phone'] = str_replace('.', '_thumb.', $config['new_image']);
	  //       }
	        
	        $result = $this->admin_model->updateSlide($updateData);

			$log = array(
							'row_id' 		=> $id,
							'action_table'  => 'website slider',
							'content' 	    => $_POST,
							'event' 		=> 'update'
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
	
	public function deleteSlide_DELETE($slideid = 0)
	{
        $data['Slide_ID'] = $slideid;
        $images             = $this->admin_model->getSlideImages($data);

        foreach($images as $img){
            if(strlen($img->Slide_Image) > 0){
                unlink('./'.$GLOBALS['img_slides_dir'].$img->Slide_Image);
            }
            if(strlen($img->Slide_Image_Phone) > 0){
                unlink('./'.$GLOBALS['img_slides_dir'].$img->Slide_Image_Phone);
            }
        }
		$log = array(
						'row_id' 	   => $slideid,
						'action_table' => 'website slider',
						'content' 	   => $_POST,
						'event' 	   => 'delete'
					);

		$this->logs->add_log($log);

		$data['Slide_ID'] = $slideid;

		$result = $this->admin_model->deleteSlide($data);

		if($result)
		{
            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }

	    redirect($this->thisCtrl.'/listall');
	}
}