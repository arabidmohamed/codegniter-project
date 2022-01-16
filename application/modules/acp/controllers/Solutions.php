<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Solutions extends Base_Controller {

	// define controller
	protected $thisCtrl = "acp/solutions";

	function __construct()
	{
    	parent::__construct();

    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
			$this->load->model('Solution_model', 'solution_model');
    }


		// ************************************
		// Note: solutions features
		// ************************************
		public function feature_list_GET()
		{
			$data['features'] = $this->solution_model->getAllPlansFeature();

			$this->LoadView('solutions/features/listall', $data);
		}

		public function addNewFeatures_ADD()
		{
			$this->LoadView('solutions/features/add');
		}

		public function add_New_Plan_Feature_POST()
		{
			if($this->input->post('submit'))
			{
	            $data = array(
		            'Title_en'   => $this->input->post('title_en'),
		            'Title_ar'   => $this->input->post('title_ar'),
                    'Content_en'   => $this->input->post('Content_en'),
                    'Content_ar'   => $this->input->post('Content_ar')
	            );

	            //echo '<pre>';print_r($data);die();
	            $result = $this->solution_model->insertPlanFeatureData($data);

	            if($result){
					$this->session->set_flashdata('requestMsgSucc', 121);
		        } else {
		             $this->session->set_flashdata('requestMsgErr', 119);
		        }

			}
			redirect($this->thisCtrl.'/feature_list');
		}

		public function editFeature_EDIT($feature_id = 0)
		{
			$log = array(
							'row_id' 	   => $feature_id,
							'action_table' => 'features',
							'content' 	   => $_POST,
							'event' 	   => 'select'
						);

			$this->logs->add_log($log);


			$data['feature_id'] = $feature_id;
			$data['features'] = $this->solution_model->getPlansFeatureByID($feature_id);

			//echo '<pre>';print_r($data);die();

			$this->LoadView('solutions/features/edit', $data);
		}

		public function update_Plan_Feature_PUT()
		{
			if($this->input->post('submit'))
			{
				$feature_id    = $this->input->post('feature_id');

	            $data = array(
		            'Feature_ID' 	 => $feature_id,
		            'Title_en'   => $this->input->post('title_en'),
		            'Title_ar'   => $this->input->post('title_ar'),
                    'Content_en'   => $this->input->post('Content_en'),
                    'Content_ar'   => $this->input->post('Content_ar')
	            );

	            //echo '<pre>';print_r($data);die();
	            $result = $this->solution_model->updatePlansFeature($data);

	            if($result)
	            {
					$this->session->set_flashdata('requestMsgSucc', 120);
		        }
		        else
		        {
		            $this->session->set_flashdata('requestMsgErr', 119);
		        }

			}
			redirect($this->thisCtrl.'/features/feature_list');
		}

	    public function deleteFeature_DELETE($plan_id = 0)
	    {
	        $result = $this->solution_model->deletePlansFeature($plan_id);

	        $log = array(
	            'row_id' 	   => $plan_id,
	            'action_table' => 'plans',
	            'content' 	   => $plan_id,
	            'event' 	   => 'delete'
	        );

	        $this->logs->add_log($log);


	        if($result)
	        {
	            $this->session->set_flashdata('requestMsgSucc', 122);
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
	        redirect($this->thisCtrl.'/features/feature_list');
	    }




    public function add_ADD()
    {
				$data['features'] = $this->solution_model->getAllPlansFeature();
        $this->LoadView('solutions/section_solution',$data);
    }

    // #add-service function
    public function addSolution_POST()
    {
        if($this->input->post('submit'))
        {
            $title_en   = $this->input->post('title_en');
            $content_en = $this->input->post('editor1');
            $title_ar   = $this->input->post('title_ar');
            $content_ar = $this->input->post('editor2');
						$feature = implode(",",$this->input->post('feature'));

            $insertData = array(
                                    'Title_en' => $title_en,
                                    'Title_ar' => $title_ar,
                                    'Content_en' => $content_en,
                                    'Content_ar' => $content_ar,
																		'Features' => $feature
                                );
            $target_dir = $GLOBALS['img_solutions_dir'] ;

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

         if (isset($_FILES['fileToUpload2']) && !empty($_FILES['fileToUpload2']['name'])) {
            $config['upload_path'] = $target_dir;
            $config['allowed_types'] = '*';
            $config['max_size'] = '0';
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);


                  if (!$this->upload->do_upload("fileToUpload2")) {
                      $this->output
                        ->set_content_type("application/json")
                        ->set_output(json_encode(array('status' => false, 'msgu' => ' يجب تحميل ملف بصيغة بد دي اف')));

                } else {
                    $uploadedFileData = $this->upload->data();
                    $fileToUpload = md5(time()) .'fileToUpload2'. $uploadedFileData['file_ext'];
                    rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $fileToUpload);
                    $insertData["Picture"] = $fileToUpload;
                }

     }

            $result = $this->solution_model->addSolution($insertData);

            $solution_id = $this->db->insert_id();

            $log = array(
                            'row_id' 	   => $solution_id,
                            'action_table' => 'solutions',
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
                        'action_table' => 'solutions',
                        'content' 	   => $_POST,
                        'event' 	   => 'select'
                    );

        $this->logs->add_log($log);

        $data['solutions'] = $this->solution_model->getSolution();

        $this->LoadView('solutions/manage_solution', $data);
    }

    // #edit service
    public function editSolution_EDIT($id = null)
    {
        $log = array(
                        'row_id' 	   => $id,
                        'action_table' => 'solutions',
                        'content' 	   => $id,
                        'event' 	   => 'select'
                    );

        $this->logs->add_log($log);

        $data['solution_id'] = $id;
        $data['solution'] = $this->solution_model->getSolutionByID($data);
				$data['features'] = $this->solution_model->getAllPlansFeature();
        $this->LoadView('solutions/manage_solution', $data);
    }

    // #update service
    public function updateSolution_PUT()
    {
        if($this->input->post('submit'))
        {
            $id = $this->input->post('solution_id');
            $title_en = $this->input->post('title_en');
            $content_en = $this->input->post('editor1');
            $title_ar = $this->input->post('title_ar');
            $content_ar = $this->input->post('editor2');
			$feature    = implode(",",$this->input->post('feature'));

            $data['solution_id'] = $id;
            $images             = $this->solution_model->getSolutionImages($data);

            // foreach($images as $img){
            //     if(strlen($img->Original_Img) > 0){
            //         unlink('./'.$GLOBALS['img_services_dir'].$img->Original_Img);
            //     }
            //     if(strlen($img->Icon) > 0){
            //         unlink('./'.$GLOBALS['img_services_dir'].$img->Icon);
            //     }
            // }

            $result = '';
            $target_dir = $GLOBALS['img_solutions_dir'] ;

            $updateData = array(
                'ID' => $id,
                'Title_en' => $title_en,
                'Title_ar' => $title_ar,
                'Content_en' => $content_en,
                'Content_ar' => $content_ar,
				'Features' => $feature
            );



            

          if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name'])) {
                $config['upload_path'] = $target_dir;
                $config['allowed_types'] = '*';
                $config['max_size'] = '2097152';
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);


                      if (!$this->upload->do_upload("fileToUpload")) {
                          $this->output
                            ->set_content_type("application/json")
                            ->set_output(json_encode(array('status' => false, 'msgu' => ' يجب تحميل ملف بصيغة بد دي اف')));

                    } else {
                        $uploadedFileData = $this->upload->data();
                        $fileToUpload = date('Y-m-d H-i-s').'-solution'. $uploadedFileData['file_ext'];
                        rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $fileToUpload);
                        $updateData["Icon"] = $fileToUpload;
                    }

         }
         if (isset($_FILES['fileToUpload2']) && !empty($_FILES['fileToUpload2']['name'])) {
            $config['upload_path'] = $target_dir;
            $config['allowed_types'] = '*';
            $config['max_size'] = '2097152';
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);


                  if (!$this->upload->do_upload("fileToUpload2")) {
                      $this->output
                        ->set_content_type("application/json")
                        ->set_output(json_encode(array('status' => false, 'msgu' => ' يجب تحميل ملف بصيغة بد دي اف')));

                } else {
                    $uploadedFileData = $this->upload->data();
                    $fileToUpload = date('Y-m-d H-i-s').'-solution'. $uploadedFileData['file_ext'];
                    rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $fileToUpload);
                    $updateData["Picture"] = $fileToUpload;
                }

     }
            // echo '<pre>';print_r($image_options);
            // echo '<pre>';print_r($upload);
            // echo '<pre>';print_r($file_name);
            // echo '<pre>';print_r($updateData);die();
            $result = $this->solution_model->updateSolution($updateData);

            $log = array(
                            'row_id' 	   => $id,
                            'action_table' => 'solutions',
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
    public function deleteSolution_DELETE($id = null)
    {
        $data['solution_id'] = $id;
        $images             = $this->solution_model->getSolutionImages($data);

        foreach($images as $img){
            if(strlen($img->Original_Img) > 0){
                unlink('./'.$GLOBALS['img_solutions_dir'].$img->Original_Img);
            }
            if(strlen($img->Icon) > 0){
                unlink('./'.$GLOBALS['img_solutions_dir'].$img->Icon);
            }
        }
        $log = array(
                        'row_id' 		=> $id,
                        'action_table'  => 'solution',
                        'content'		=> $id,
                        'event' 		=> 'delete'
                    );

        $this->logs->add_log($log);

        $data['solution_id'] = $id;
        $result = $this->solution_model->deleteSolution($data);
        if($result){
                $this->session->set_flashdata('requestMsgSucc', 122);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
            redirect($this->thisCtrl.'/listall');
    }

}
