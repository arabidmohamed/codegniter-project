<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Projects extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/projects";
	public $__directories = array();
	
	function __construct()
	{
    	parent::__construct();
   
    	$this->load->model('projects_model', 'projects');
		//send controller name to views
		$this->load->library('parser');
    	$this->load->vars( array('__controller' => $this->thisCtrl));
  	}
	
	/*-----------------------------------------------------------
	---------------------- News CATEGORY Section -----------------
	--------------------------------------------------------*/
		
	// #categories view function
	public function categories_GET()
	{
		$this->LoadView('projects/categories/add_categories');
	}	
	
	// #add-category function
	public function addCategory_ADD()
	{
		if($this->input->post('submit'))
		{
			$slugTitle = $this->input->post('name_en');
			if(strlen($this->input->post('name_en')) == 0)
			{
				$slugTitle = $this->input->post('name_ar');
			}
			$slug = getUniqueSlug($slugTitle, TBL_PROJECTS_CATEGORIES, 'CSlug');

			$data = array(
				'Category_en' => $this->input->post('name_en'),
				'Category_ar' => $this->input->post('name_ar'),
				'CSlug' => $slug
			);

			$result = $this->projects->addCategory($data);

			$Category_ID = $this->db->insert_id();

	   		$log = array(
							'row_id' 	   => $Category_ID,
							'action_table' => 'project categories',
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
		redirect($this->thisCtrl.'/categories_list');
	}
	
	public function addCategory_HTTP_POST()
	{
		$name_ar = $this->input->post('option_ar');
		$name_en = $this->input->post('option_en');

		$slugTitle = $name_en;
		if(strlen($name_en) == 0)
		{
			$slugTitle = $name_ar;
		}
		$slug = getUniqueSlug($slugTitle, TBL_PROJECTS_CATEGORIES, 'CSlug');
		
		$data = array(
			'Category_en' => $name_en,
			'Category_ar' => $name_ar,
			'CSlug' => $slug
		);
		$category_id = $this->projects->addCategory($data);
		echo json_encode(array('id' => $category_id));
	}
	
	public function categories_list_GET()
	{
   		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'project categories',
						'content' 	   => $_POST,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);


		$data['categories'] = $this->projects->getCategories();
		$this->LoadView('projects/categories/manage_categories', $data);
	}
	
	// #edit service
	public function editCategory_EDIT($categoryID = 0)
	{
   		$log = array(
						'row_id' 	   => $categoryID,
						'action_table' => 'project categories',
						'content' 	   => $categoryID,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['category_id'] = $categoryID;
		$data['category'] = $this->projects->getCategoryByID($data);
		$this->LoadView('projects/categories/manage_categories', $data);
	}
	
	// #update service
	public function updateCategory_POST()
	{
		if($this->input->post('submit'))
		{
			$id = $this->input->post('category_id');

			$slugTitle = $this->input->post('name_en');
			if(strlen($this->input->post('name_en')) == 0)
			{
				$slugTitle = $this->input->post('name_ar');
			}
			$slug = getUniqueSlug($slugTitle, TBL_PROJECTS_CATEGORIES, 'CSlug');

			$updateData = array(
				'Category_ID' => $id,
				'Category_en' => $this->input->post('name_en'),
				'Category_ar' => $this->input->post('name_ar'),
				'CSlug' => $slug
			);
				
			$result = $this->projects->updateCategory($updateData);

	   		$log = array(
							'row_id' 	   => $id,
							'action_table' => 'project categories',
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
		redirect($this->thisCtrl.'/categories_list');
	}
	
	// #delete service function
	public function deleteCategory_DELETE($categoryID = 0)
	{
		$data['category_id'] = $categoryID;
		$result = $this->projects->deleteCategory($data);

   		$log = array(
						'row_id' 	   => $categoryID,
						'action_table' => 'project categories',
						'content' 	   => $_POST,
						'event' 	   => 'delete'
					);

		$this->logs->add_log($log);

		if($result)
		{
	        $this->session->set_flashdata('requestMsgSucc', 122);
	    }
	    else
	    {
	        $this->session->set_flashdata('requestMsgErr', 119);
	    }
		
		redirect($this->thisCtrl.'/categories_list');
	}
	
	/*-----------------------------------------------------------
		---------------------- #projects -----------------
		--------------------------------------------------------*/
    
    // #work view function
    public function add_ADD()
    {
        $data['categories'] = $this->projects->getActiveCategories();
        $this->LoadView('projects/add', $data);
    }
    
 	// #add project function 
    public function add_POST()
    {
        if ($this->input->post('submit')) 
        {
	        
	        $from_date = new DateTime($this->input->post('fromdate'));
            $to_date = new DateTime($this->input->post('todate'));
	        
            $category_id = $this->input->post('category');
            
            $__details = $this->input->post('project_details');
            $result    = '';
			
			$slugTitle = $this->input->post('title_en');
			if(strlen($this->input->post('title_en')) == 0)
			{
				$slugTitle = $this->input->post('title_ar');
			}
			$slug = getUniqueSlug($slugTitle, TBL_PROJECTS, 'Slug');

            $insertData = array(
                'Category_ID' => $category_id,
                'Title_en' => $this->input->post('title_en'),
                'Title_ar' => $this->input->post('title_ar'),
                'Description_en' => $this->input->post('description_en'),
                'Description_ar' => $this->input->post('description_ar'),
                'Latitude' => $this->input->post('lat'),
                'Longitude' => $this->input->post('lng'),
                'Video_Link1' => $this->input->post('video_1'),
                'Video_Link2' => $this->input->post('video_2'),
                'Address' => $this->input->post('address'),
                'From_Date' => $from_date->format('Y-m-d'),
                'To_Date' => $to_date->format('Y-m-d'),
				'Total_Days' => $this->input->post('duration'),
				'Slug' => $slug
            );
            
            // upload PDF File
            $target_pdf = $GLOBALS['img_projectPDF_dir'];
			// image options
			$file_options = array(
									'file' 		  => 'pdf_file',
									'directory'   => $target_pdf,
									'valid_types' => 'pdf|doc|docx',
									'file_name'   => date('Y-m-d H-i-s')
								);

			$upload_data = UploadFile($file_options);
			
			if (is_array($upload_data) && array_key_exists('file_name', $upload_data))
	        {
				$insertData['PDF_File'] = $upload_data['file_name'];
			}
            
            $Project_ID = $this->projects->addProject($insertData);
            
            $pd_ids = explode(',', $__details);
            // Generate project cover thumbnail
            $pd_detail = $this->projects->getPDFirstImg($pd_ids[0]);
            
            $get_filename = $pd_detail[0]->Pictures;
            // generate thumbnail
			$thumbnail_name = $this->_generateThumb($Project_ID, $get_filename);
            
            if($Project_ID)
            {
                $insertDataDetails = array(
						                    'PD_ID'       => $pd_ids,
						                    'Project_ID'  => $Project_ID,
						                    'Cover_Thumb' => $thumbnail_name
						                );
                
                $result = $this->projects->updateProjectDetails_ARR($insertDataDetails);

		   		$log = array(
								'row_id' 	   => $Project_ID,
								'action_table' => 'projects',
								'content' 	   => $_POST,
								'event' 	   => 'add'
							);

				$this->logs->add_log($log);

            }
            
            
            if ($result) {
                $this->session->set_flashdata('requestMsgSucc', 121);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
        
        redirect($this->thisCtrl . '/listall');
    }
    
    public function SetProjectCover_GET()
    {
	    $id = $this->input->post('id');
	    $pid = $this->input->post('pid');
	    $pd_detail = $this->projects->getPDFirstImg($id);
            
        $get_filename = $pd_detail[0]->Pictures;
		$thumbnail_name = $this->_generateThumb($pd_detail[0]->Project_ID, $get_filename);
        
        $insertDataDetails = array(
                'PD_ID' => $id,
                'Cover_Thumb' => $thumbnail_name,
                'Is_Cover' => 1
        ); 
        $res = $this->projects->PDSetDefaults($pid);      
        $result = $this->projects->updateProjectDetails($insertDataDetails);
        echo $result;
    }

       public function details_GET($Project_ID = 0)
    {


	    $data['project'] = $this->projects->getProjectByID($Project_ID);

		$this->LoadView('projects/details', $data);
    }

    
    // #manage-projects function
    public function listall_GET()
    {
   		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'projects',
						'content' 	   => $_POST,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

        $data['categories'] = $this->projects->getCategories();
        $data['pageName'] = $this->projects->getProjectPageName();
        $this->LoadView('projects/list', $data);
    }
    
    // #edit project
    public function edit_EDIT($projectID = 0)
    {
   		$log = array(
						'row_id' 	   => $projectID,
						'action_table' => 'projects',
						'content' 	   => $_POST,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);


        $data['Project_ID']    = $projectID;
       // $data['project_det']   = $this->projects->getProjectDetails($data);
        $data['project']       = $this->projects->getProjectByID($data);
        $data['categories'] = $this->projects->getActiveCategories();
        $this->LoadView('projects/edit', $data);
    }
    
	// #update project
    public function edit_POST()
    {
        if ($this->input->post('Project_ID')) 
        {
	        
	        $from_date = new DateTime($this->input->post('fromdate'));
            $to_date = new DateTime($this->input->post('todate'));
	        
            $id          = $this->input->post('Project_ID');
            $category_id = $this->input->post('category');
			
			$slugTitle = $this->input->post('title_en');
			if(strlen($this->input->post('title_en')) == 0)
			{
				$slugTitle = $this->input->post('title_ar');
			}
			$slug = getUniqueSlug($slugTitle, TBL_PROJECTS, 'Slug');

            $result     = '';
            $updateData = array(
                'Project_ID' => $id,
                'Category_ID' => $category_id,
                'Title_en' => $this->input->post('title_en'),
                'Title_ar' => $this->input->post('title_ar'),
                'Description_en' => $this->input->post('description_en'),
                'Description_ar' => $this->input->post('description_ar'),
                'Latitude' => $this->input->post('lat'),
                'Longitude' => $this->input->post('lng'),
                'Video_Link1' => $this->input->post('video_1'),
                'Video_Link2' => $this->input->post('video_2'),
                'Address' => $this->input->post('address'),
                'From_Date' => $from_date->format('Y-m-d'),
                'To_Date' => $to_date->format('Y-m-d'),
				'Total_Days' => $this->input->post('duration'),
				'Slug' => $slug
            );
			
			// file options
			$file_options = array(
				'file' => 'pdf_file',
				'directory' => $target_pdf,
				'valid_types' => 'pdf|doc|docx',
				'file_name' => date('Y-m-d H-i-s')
			);
			$upload_data = UploadFile($file_options);
			
			if (is_array($upload_data) && array_key_exists('file_name', $upload_data))
	        {
				$updateData['PDF_File'] = $upload_data['file_name'];
			}
            
            $result = $this->projects->updateProject($updateData);

	   		$log = array(
							'row_id' 	   => $id,
							'action_table' => 'projects',
							'content' 	   => $_POST,
							'event' 	   => 'update'
						);

			$this->logs->add_log($log);

            if ($result) {
	            
	            // generate project cover if it does not have a cover
	            $id = $this->input->post('Project_ID');
	            // 1) check if cover exists or not ?
				$project_cover = $this->projects->getProjectCoverBool($id);
		        if(count($project_cover) <= 0){
			        
			        // 2) get project images for cover
			        $pd_detail = $this->projects->getProjectDetailsImagesForCover($id);
			        if(count($pd_detail) > 0){
				        $get_filename = $pd_detail[0]->Pictures;
						$thumbnail_name = $this->_generateThumb($pd_detail[0]->Project_ID, $get_filename);
				        $insertDataDetails = array(
				                'PD_ID' => $pd_detail[0]->PD_ID,
				                'Cover_Thumb' => $thumbnail_name,
				                'Is_Cover' => 1
				        ); 
				        // 4) set project cover defaults (remove is_cover, and cover_thumb)
				        $res = $this->projects->PDSetDefaults($pid); 
				        // 5) update details     
						$result = $this->projects->updateProjectDetails($insertDataDetails);
				    }    
			        
		        }   
		        
	           $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
            
        }
        redirect($this->thisCtrl . '/listall');
    }
    
    // #delete project function
    public function delete_DELETE($projectID = 0)
    {
        $data['Project_ID'] = $projectID;
        $images             = $this->projects->getProjectImages($data);
		
        foreach($images as $img){
	        if(strlen($img->Pictures) > 0){
	        	unlink('./'.$GLOBALS['img_projects_dir'].$img->Pictures);
	        }
	        if(strlen($img->Cover_Thumb) > 0){
	        	unlink('./'.$GLOBALS['img_projects_dir'].$img->Cover_Thumb);
	        }
        }
        
        $result  = $this->projects->deleteProject($data);

   		$log = array(
						'row_id' 	   => $projectID,
						'action_table' => 'projects',
						'content' 	   => $projectID,
						'event' 	   => 'delete'
					);

		$this->logs->add_log($log);

        if ($result)
        {
            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }

        redirect($this->thisCtrl . '/listall');
    }
    
    // #delete project function
    public function deleteDet_GET($projectDet_ID = '', $Project_ID = '')
    {
	    $data['projectDet_ID'] = $projectDet_ID;
	    // delete its image from server
        $images             = $this->projects->getProjectDetImages($data);
        foreach($images as $img){
	         if(strlen($img->Pictures) > 0){
	        	unlink('./'.$GLOBALS['img_projects_dir'].$img->Pictures);
	        }
	        if(strlen($img->Cover_Thumb) > 0){
	        	unlink('./'.$GLOBALS['img_projects_dir'].$img->Cover_Thumb);
	        }
        }
        
        $result  = $this->projects->deleteProjectDetail($data);

   		$log = array(
						'row_id' 	   => $projectDet_ID,
						'action_table' => 'project details',
						'content' 	   => $projectDet_ID,
						'event' 	   => 'delete'
					);

		$this->logs->add_log($log);

        if ($result)
        {
            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }

        redirect($this->thisCtrl . '/editProject/' . $Project_ID);
    }
    
    
	public function bookings()
	{
   		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'project bookings',
						'content' 	   => 0,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

	    $this->LoadView('projects/bookings', '');
    }
    
    // #delete project function
    public function deleteBooking($id = 0)
    {
        $data['ID'] = $id;
        
        $result  = $this->projects->deleteProjectBooking($data);

   		$log = array(
						'row_id' 	   => $id,
						'action_table' => 'project bookings',
						'content' 	   => $projectDet_ID,
						'event' 	   => 'delete'
					);

		$this->logs->add_log($log);

        if ($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl . '/project_bookings');
    }
    
    public function finance_calculator_records()
    {
	    $this->LoadView('projects/finance_calculator', '');
    }
    
    /*-----------------------------------------------------------
		---------------------- #project images -----------------
		--------------------------------------------------------*/
    
    public function uploadProjectImages_GET()
	{
		
		$result = '';
		if (empty($_FILES)) 
		{
			exit();
        }
        
        // image options
		$image_options = array(
			'file' => 'file',
			'directory' => $GLOBALS['img_projects_dir'],
			'max_width' => 1000,
			'file_name' => date('Y-m-d H-i-s')
		);
		
		$upload = UploadFile($image_options);
        if (!is_array($upload) && !array_key_exists('file_name', $upload)) 
        {
		    exit();
	    }
	    
	    $upload_data = $this->upload->data();
		$file_name = $upload_data['file_name'];
	    
	    $data = array(
		    'Project_ID' => $this->input->post('target_for_id'),
			'Pictures' => $file_name
	    );
	 	$result = $this->projects->addProjectDetails($data);   
	    
	    echo $result;
	}
	
	public function unlinkImage_GET()
	{
		$image = $this->input->post('imageid');
	    
		$imageName = $this->projects->getPDImageName($image);
	    if(unlink('./'.$GLOBALS['img_projects_dir'].$imageName))
	    {
	        echo $this->projects->deletePDImage($image);
	    }
	}
    
    private function _generateThumb($Project_ID = 0, $get_filename = '')
    {
	    $file_name_arr = explode('.', $get_filename);
		$extension = array_pop($file_name_arr);
		$thumbname = $Project_ID;
		$thumbname_with_ext = $thumbname.'.'.$extension;
        
        $return_thmbname = GenerateThumbFromImage($GLOBALS['img_projects_dir'], $get_filename, $thumbname_with_ext, 330, 214);
		$thumbnail_name = $thumbname.$return_thmbname.'.'.$extension; // picture_thumb_1x.jpg
		
		return $thumbnail_name;
	}
	
	/**---------------------------------------
	  	* Projects list *
	  	-------------------------------------**/
	public function getDataList_GET()
	{
		$list = $this->projects->getProjectsList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		foreach ($list as $product) {
			$no++;
			$i++;
			$dt = new DateTime($product->TimeStamp);
			$date = $dt->format('d-m-Y');
			
			$action_data = array(
				'details_url' => base_url($this->thisCtrl.'/details/'.$product->Project_ID.'/'),
				'delete_url' => base_url($this->thisCtrl.'/delete/'.$product->Project_ID.'/')
			);											
			
			//image
			// $image = '';
			// if(strlen($product->Thumbnail) > 0){
			// 	$image = '<img src="'.base_url($GLOBALS['img_projects_dir'].$product->Thumbnail).'" style="width: 60px">';
			// }
			
			// actions template
			$actions = ''.$this->parser->parse('projects/snippets/actions-template', $action_data, TRUE);
			
			//member status template
			$status_chk = '';
			$status_not_chk = '';
			if($product->Status) { $status_chk = 'checked'; }
			if(!$product->Status) { $status_not_chk = 'checked'; }
			$status = '<div data-toggle="hurkanSwitch" data-status="'.$product->Status.'">
							<input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
							<input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
					</div>';	
			
			// multi-language code												

			$category = 'Category_'.$this->session->userdata($this->acp_session->__lang());
			
			$row = array();
			$row[] = $product->Project_ID;
			$row[] = $date;
			$row[] = $product->Full_Name;
			$row[] = $product->Email;
			$row[] = $product->Phone;
			$row[] = $product->$category;
			$row[] = $status;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->projects->projectsCount_all(),
						"recordsFiltered" => $this->projects->projectsCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	/**---------------------------------------
	  	* Bookings list *
	  	-------------------------------------**/
  	
		  public function getBookings()
		  {
			  
			$list = $this->datatable->getProjectBookings();
			$data = array();
			$no = $_POST['start'];
	
			//print_r($list);
			foreach ($list as $r) {
				
				$dt = new DateTime($r->TimeStamp);
				$date = $dt->format('d-m-Y');
				
				// multi-language code												
				$title = 'Title_'.$this->session->userdata($this->acp_session->__lang());
				
				$action_data = array(
					'delete_url' => base_url($this->thisCtrl.'/deleteBooking/'.$r->ID.'/')
				);
				$actions = ''.$this->parser->parse('projects/snippets/actions-template-pb', $action_data, TRUE);
							
				$row = array();
				$row[] = $date;
				$row[] = $r->$title;
				$row[] = $r->Name;
				$row[] = $r->Email;
				$row[] = $r->Phone;
				$row[] = $r->Message;
				$row[] = $actions;
				
				
				$data[] = $row;
				
			} // end foreach
			
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->datatable->projectBookingsCount_all(),
				"recordsFiltered" => $this->datatable->projectBookingsCount_filtered(),
				"data" => $data,
			);
			//output to json format
			echo json_encode($output);
			  
		  }
		  
		  
		  /**---------------------------------------
			  * Finance calculator list *
			  -------------------------------------**/
		  public function getFinanceRecords()
		  {
			  $list = $this->datatable->getFinanceRecords();
			$data = array();
			$no = $_POST['start'];
	
			//print_r($list);
			foreach ($list as $r) {
				
				$dt = new DateTime($r->TimeStamp);
				$date = $dt->format('d-m-Y');
				$buyer = 'buyer';
				if($r->First_Buyer){
					$buyer = 'First Time';
				}
					
				$row = array();
				$row[] = $date;
				$row[] = $r->Company_Name;
				$row[] = $r->Sector;
				$row[] = $r->Region;
				$row[] = $r->Earnings;
				$row[] = $r->Expenses;
				$row[] = $r->Age;
				$row[] = $buyer;
				$row[] = $r->Repayment_Years;
				
				$data[] = $row;
				
			} // end foreach
			
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->datatable->financeCount_all(),
				"recordsFiltered" => $this->datatable->financeCount_filtered(),
				"data" => $data,
			);
			//output to json format
			echo json_encode($output);
		  }
}		
	
?>