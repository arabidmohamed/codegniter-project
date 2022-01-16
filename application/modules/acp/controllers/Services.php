<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Services extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/services";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
    }

    public function add_ADD()
    {
        $this->LoadView('services/section_services');
    }

    // #add-service function
    public function addService_POST()
    {
        if($this->input->post('submit'))
        {
            $title_en   = $this->input->post('title_en');
            $content_en = $this->input->post('editor1');
            $title_ar   = $this->input->post('title_ar');
            $content_ar = $this->input->post('editor2');

            $insertData = array(
                                    'Title_en' => $title_en,
                                    'Title_ar' => $title_ar,
                                    'Content_en' => $content_en,
                                    'Content_ar' => $content_ar
                                );
            $target_dir = $GLOBALS['img_services_dir'] ;

          if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name'])) {
                $config['upload_path'] = $target_dir;
                $config['allowed_types'] = '*';
                $config['max_size'] = '0';
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);

               
                      if (!$this->upload->do_upload("fileToUpload")) {
                          $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode(array('status' => false, 'msgu' => ' يجب تحميل ملف بصيغة بد دي اف')));
                      
                    } else {               
                        $uploadedFileData = $this->upload->data();
                        $fileToUpload = md5(time()) .'fileToUpload'. $uploadedFileData['file_ext'];
                        rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $fileToUpload);
                        $insertData["Icon"] = $fileToUpload;
                    }

         }
        
            $result = $this->admin_model->addService($insertData);

            $service_id = $this->db->insert_id();

            $log = array(
                            'row_id' 	   => $service_id,
                            'action_table' => 'service',
                            'content' 	   => $_POST,
                            'event' 	   => 'add'
                        );
            
            $this->logs->add_log($log);


            if($result)
            {
                $this->session->set_flashdata('requestMsgSucc', 121);
            }
        }
        redirect($this->thisCtrl.'/listall');
    }

    // #manage-Services function
    public function listall_GET()
    {

        $log = array(
                        'row_id' 	   => 0,
                        'action_table' => 'service',
                        'content' 	   => $_POST,
                        'event' 	   => 'select'
                    );
        
        $this->logs->add_log($log);

        $data['services'] = $this->admin_model->getServices();
        $data['total'] = $this->admin_model->getTotals();
        $data['activeSerMale'] = $this->admin_model->getServiceMale();
        $data['inActiveSerFemale'] = $this->admin_model->getServiceFemale();
        $this->LoadView('services/manage_services', $data);
    }

    // #edit service
    public function editService_EDIT($servieID = null)
    {
        $log = array(
                        'row_id' 	   => $servieID,
                        'action_table' => 'service',
                        'content' 	   => $servieID,
                        'event' 	   => 'select'
                    );

        $this->logs->add_log($log);

        $data['service_id'] = $servieID;
        $data['service'] = $this->admin_model->getServiceByID($data);
        $this->LoadView('services/manage_services', $data);
    }

    // #update service
    public function updateService_PUT()
    {
        if($this->input->post('submit'))
        {
            $id = $this->input->post('service_id');
            $title_en = $this->input->post('title_en');
            $content_en = $this->input->post('editor1');
            $title_ar = $this->input->post('title_ar');
            $content_ar = $this->input->post('editor2');

            $data['Service_ID'] = $id;
            $images             = $this->admin_model->getServiceImages($data);

            // foreach($images as $img){
            //     if(strlen($img->Original_Img) > 0){
            //         unlink('./'.$GLOBALS['img_services_dir'].$img->Original_Img);
            //     }
            //     if(strlen($img->Icon) > 0){
            //         unlink('./'.$GLOBALS['img_services_dir'].$img->Icon);
            //     }
            // }

            $result = '';
            
            $updateData = array(
                'Service_ID' => $id,
                'Title_en' => $title_en,
                'Title_ar' => $title_ar,
                'Content_en' => $content_en,
                'Content_ar' => $content_ar
            );
            

            $target_dir = $GLOBALS['img_services_dir'] ;

          if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name'])) {
                $config['upload_path'] = $target_dir;
                $config['allowed_types'] = '*';
                $config['max_size'] = '0';
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);

               
                      if (!$this->upload->do_upload("fileToUpload")) {
                          $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode(array('status' => false, 'msgu' => ' يجب تحميل ملف بصيغة بد دي اف')));
                      
                    } else {               
                        $uploadedFileData = $this->upload->data();
                        $fileToUpload = md5(time()) .'fileToUpload'. $uploadedFileData['file_ext'];
                        rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $fileToUpload);
                        $updateData["Icon"] = $fileToUpload;
                    }

         }
                
            $result = $this->admin_model->updateService($updateData);

            $log = array(
                            'row_id' 	   => $id,
                            'action_table' => 'service',
                            'content' 	   => $_POST,
                            'event' 	   => 'update'
                        );

            $this->logs->add_log($log);

            if($result){
                $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
        redirect($this->thisCtrl.'/listall');
    }

    // #delete service function
    public function deleteService_DELETE($servieID = null)
    {
        $data['Service_ID'] = $servieID;
        $images             = $this->admin_model->getServiceImages($data);

        foreach($images as $img){
            if(strlen($img->Original_Img) > 0){
                unlink('./'.$GLOBALS['img_services_dir'].$img->Original_Img);
            }
            if(strlen($img->Icon) > 0){
                unlink('./'.$GLOBALS['img_services_dir'].$img->Icon);
            }
        }
        $log = array(
                        'row_id' 		=> $servieID,
                        'action_table'  => 'service',
                        'content'		=> $servieID,
                        'event' 		=> 'delete'
                    );

        $this->logs->add_log($log);

        $data['service_id'] = $servieID;
        $result = $this->admin_model->deleteService($data);
        if($result){
                $this->session->set_flashdata('requestMsgSucc', 122);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
            redirect($this->thisCtrl.'/listall');
    }

}