<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Events extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/events"; 
	public $__directories = array();
	
	function __construct()
	{
    	parent::__construct();
    	    	
    	// send controller name to views
        $this->load->vars( array('__controller' => $this->thisCtrl));
        $this->load->model('events_model', 'events');
  	}
	
	/*-----------------------------------------------------------
		---------------------- Products CATEGORY Section -----------------
		--------------------------------------------------------*/
		
	// #categories view function
	public function new_category(){
		$this->LoadView('events/categories/add');
	}	
	
	// #add-category function
	public function addCategory(){
		if($this->input->post('submit'))
		{
			$slugTitle = $this->input->post('name_en');
			if(strlen($this->input->post('name_en')) == 0)
			{
				$slugTitle = $this->input->post('name_ar');
			}
			$slug = getUniqueSlug($slugTitle, TBL_EVENTS_CATEGORIES, 'CSlug');

			$data = array(
				'Category_en' => $this->input->post('name_en'),
				'Category_ar' => $this->input->post('name_ar'),
				'CSlug' => $slug
			);
            
            if ($_FILES['fileToUpload']['size'] !== 0)
			{
                //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_product_categories_dir']);
                if ($file) {
                    $data['Icon'] = substr($file, strrpos($file, '/') + 1);
                }
             }

            $result = $this->events->addCategory($data);
            
            $Category_ID = $this->db->insert_id();

			if($result)
			{
				$log = array(
								'row_id' 	   => $categoryID,
								'action_table' => 'event categories',
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
		redirect($this->thisCtrl.'/categories_list');
    }
    
    public function addCategory_HTTP()
	{
		$name_ar = $this->input->post('option_ar');
		$name_en = $this->input->post('option_en');

		$slugTitle = $name_en;
		if(strlen($name_en) == 0)
		{
			$slugTitle = $name_ar;
		}
		$slug = getUniqueSlug($slugTitle, TBL_EVENTS_CATEGORIES, 'CSlug');
		
		$data = array(
			'Category_en' => $name_en,
			'Category_ar' => $name_ar,
			'CSlug' => $slug
		);
		$category_id = $this->events->addCategory($data);
		echo json_encode(array('id' => $category_id));
	}
	
	public function categories_list()
	{
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'event categories',
						'content' 	   => 0,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['categories'] = $this->events->getCategories();
		$this->LoadView('events/categories/list', $data);
	}
	
	// #edit service
	public function editCategory($categoryID = 0)
	{
		$log = array(
						'row_id' 	   => $categoryID,
						'action_table' => 'event categories',
						'content' 	   => $categoryID,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['category_id']   = $categoryID;
		$data['category'] 	   = $this->events->getCategoryByID($data);
		$data['subcategories'] = $this->events->getSubCategories($categoryID);

		$this->LoadView('events/categories/edit', $data);
	}
	
	// #update service
    public function updateCategory()
    {
		if($this->input->post('submit'))
		{
			$id = $this->input->post('category_id');

			$slugTitle = $this->input->post('name_en');

			if(strlen($this->input->post('name_en')) == 0)
			{
				$slugTitle = $this->input->post('name_ar');
			}

			$slug = getUniqueSlug($slugTitle, TBL_EVENTS_CATEGORIES, 'CSlug');

			$updateData = array(
									'Category_ID' => $id,
									'Category_en' =>  $this->input->post('name_en'),
									'Category_ar' =>  $this->input->post('name_ar'),
									'CSlug' => $slug
								);
			
			if ($_FILES['fileToUpload']['size'] !== 0)
			{
                //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_product_categories_dir']);

                if ($file)
                {
                    $updateData['Icon'] = substr($file, strrpos($file, '/') + 1);
                }
             }
				
			$result = $this->events->updateCategory($updateData);
	        
	        if($result)
	        {
				$log = array(
								'row_id' 	   => $id,
								'action_table' => 'event categories',
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

		redirect($this->thisCtrl.'/categories_list');
	}
	
	// #delete service function
	public function deleteCategory($categoryID = 0)
	{
		$data['category_id'] = $categoryID;
		
		//after deleting record we have to also remove its picture for that we have to get record detail first then delete it.
		$category = $this->events->getCategoryByID($data);
		
		$result = $this->events->deleteCategory($data);

		if($result)
		{
			$log = array(
							'row_id' 	   => $categoryID,
							'action_table' => 'event categories',
							'content' 	   => $_POST,
							'event' 	   => 'delete'
						);

			$this->logs->add_log($log);

			// now delete its icon as well
			foreach($category as $row)
			{
				unlink('./'.$GLOBALS['img_product_categories_dir'].$row->Icon);
			}
			
			// also delete its subcategories
			$this->deleteSubCategoriesByCategory($category_id);
			
            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
		redirect($this->thisCtrl.'/categories_list');
    }

    /*-----------------------------------------------------------
		---------------------- SUBCATEGORY Section -----------------
		--------------------------------------------------------*/
		
	// #categories view function
	public function subcategories($category_id = 0)
	{
		if($category_id == 0)
		{
			exit();
		}

		$data['category_id'] = $category_id;
		$data['category'] = $this->events->getCategoryByID($data);

		$this->LoadView('events/categories/subcategories/add', $data);
	}	
	
	// #add-category function
	public function addSubCategory()
	{
		if($this->input->post('submit'))
		{
			$slugTitle = $this->input->post('name_en');
			if(strlen($this->input->post('name_en')) == 0)
			{
				$slugTitle = $this->input->post('name_ar');
			}
			$slug = getUniqueSlug($slugTitle, TBL_EVENTS_SUBCATEGORIES, 'SCSlug');
			$category_id = $this->input->post('category_id');
			
			$data = array(
				'Category_ID' => $category_id,
				'SubCategory_en' => $this->input->post('name_en'),
				'SubCategory_ar' => $this->input->post('name_ar'),
				'SCSlug' => $slug
			);

			if ($_FILES['fileToUpload']['size'] !== 0)
			{
                    //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_product_categories_dir']);
				if ($file) 
				{
                    $data['Icon'] = substr($file, strrpos($file, '/') + 1);
                }
			}
			
			$result = $this->events->addSubCategory($data);

			$subcategory_id = $this->db->insert_id();

			if($result)
			{
				$log = array(
								'row_id' 	   => $subcategory_id,
								'action_table' => 'event subcategories',
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
		redirect($this->thisCtrl.'/subcategories/'.$category_id.'/');
	}
	
	public function addSubCategory_HTTP()
	{
		$name_ar = $this->input->post('option_ar');
		$name_en = $this->input->post('option_en');
		$category_id = $this->input->post('parent_id');

		$slugTitle = $name_en;
		if(strlen($name_en) == 0)
		{
			$slugTitle = $name_ar;
		}
		$slug = getUniqueSlug($slugTitle, TBL_EVENTS_SUBCATEGORIES, 'SCSlug');
		
		$data = array(
			'Category_ID' => $category_id,
			'SubCategory_en' => $name_en,
			'SubCategory_ar' => $name_ar,
			'SCSlug' => $slug
		);
		$category_id = $this->events->addSubCategory($data);
		echo json_encode(array('id' => $category_id));
	}
	
	// #edit service
	public function editSubCategory($category_id = 0, $subcategoryID = 0)
	{
		$log = array(
						'row_id' 	   => $subcategoryID,
						'action_table' => 'event subcategories',
						'content' 	   => $subcategoryID,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['subcategory_id'] = $subcategoryID;
		$data['categories'] = $this->events->getActiveCategories();
		$data['subcategory'] = $this->events->getSubCategoryByID($data);
		$this->LoadView('events/categories/subcategories/edit', $data);
	}
	
	// #update service
	public function updateSubCategory()
	{
		if($this->input->post('submit'))
		{
			$id = $this->input->post('subcategory_id');
			$category_id = $this->input->post('category_id');

			$slugTitle = $this->input->post('name_en');
			if(strlen($this->input->post('name_en')) == 0)
			{
				$slugTitle = $this->input->post('name_ar');
			}
			$slug = getUniqueSlug($slugTitle, TBL_EVENTS_SUBCATEGORIES, 'SCSlug');

			$updateData = array(
				'SubCategory_ID' => $id,
				'Category_ID' => $category_id,
				'SubCategory_en' => $this->input->post('name_en'),
				'SubCategory_ar' => $this->input->post('name_ar'),
				'SCSlug' => $slug
			);

			if ($_FILES['fileToUpload']['size'] !== 0)
			{
                //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_product_categories_dir']);
                if ($file) {
                    $updateData['Icon'] = substr($file, strrpos($file, '/') + 1);
                }
            }
				
			$result = $this->events->updateSubCategory($updateData);
	        
	        if($result)
	        {
				$log = array(
								'row_id' 	   => $id,
								'action_table' => 'event subcategories',
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
		redirect($this->thisCtrl.'/editCategory/'.$category_id);
	}
	
	// #delete service function
	public function deleteSubCategory($category_id = 0 ,$subcategoryID = 0)
	{
		$data['subcategory_id'] = $subcategoryID;
		
		//after deleting record we have to also remove its picture for that we have to get record detail first then delete it.
		$subcategory = $this->events->getSubCategoryByID($data);
		
		$result = $this->events->deleteSubCategory($data);

		if($result)
		{
			$log = array(
							'row_id' 	   => $subcategoryID,
							'action_table' => 'event subcategories',
							'content' 	   => $subcategoryID,
							'event' 	   => 'delete'
						);

			$this->logs->add_log($log);

			// now delete its icon as well
			foreach($subcategory as $row)
			{
				unlink('./'.$GLOBALS['img_product_categories_dir'].$row->Icon);
			}
			
            $this->session->set_flashdata('requestMsgSucc', 122);
        } 
        else 
        {
             $this->session->set_flashdata('requestMsgErr', 119);
        }

		redirect($this->thisCtrl.'/editCategory/'.$category_id);
	}
	
	public function deleteSubCategoriesByCategory($category_id = 0){
		
		//after deleting record we have to also remove its picture for that we have to get record detail first then delete it.
		$subcategory = $this->events->getSubCategoriesByCategory($category_id);
		
		$result = $this->events->deleteSubCategoriesByCategory($category_id);

		if($result)
		{
			// now delete its icon as well
			foreach($subcategory as $row)
			{
				unlink('./'.$GLOBALS['img_product_categories_dir'].$row->Icon);
			}
		}

		return $result;
		
	}
    
    /*-----------------------------------------------------------
		---------------------- #HTTP Request -----------------
		--------------------------------------------------------*/
	
	public function getSubCategoriesByCategory($category_id = 0)
	{
		$__lang = $this->session->userdata($this->acp_session->__lang());
		echo json_encode($this->events->getSubCategoriesByCategory($category_id, $__lang));
	}
	
	/*-----------------------------------------------------------
		---------------------- #Events -----------------
		--------------------------------------------------------*/
    
    public function add()
    {
        $data['categories'] = $this->events->getCategories();
        $this->LoadView('events/add', $data);
    }
    
    public function details($id = 0)
    {
    	$log = array(
						'row_id' 	   => $id,
						'action_table' => 'events details',
						'content' 	   => $id,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

        $data['event'] = $this->events->getHistory($id);
	    $data['rating_count'] = $this->events->Get_TotalRated($id);
		$data['avgRating'] = $this->events->Get_AvgRating($id);
		$this->LoadView('events/details', $data);
    }
    
    // #add function 
    public function add_POST()
    {
        if ($this->input->post('submit')) {
	        
	        $from_date = new DateTime($this->input->post('fromdate'));
            $to_date = new DateTime($this->input->post('todate'));
            
            $__details = $this->input->post('details');
            $__slides = $this->input->post('slider');
			$result    = '';
			
			$slugTitle = $this->input->post('title_en');
			if(strlen($this->input->post('title_en')) == 0)
			{
				$slugTitle = $this->input->post('title_ar');
			}
			$slug = getUniqueSlug($slugTitle, TBL_EVENTS, 'Slug');
            
            date_default_timezone_set('UTC');

            $insertData = array(
					                'Title_en' => $this->input->post('title_en'),
					                'Title_ar' => $this->input->post('title_ar'),
					                'SubCategory_ID' => $this->input->post('subcategory'),
					                'Description_en' => $this->input->post('description_en'),
					                'Description_ar' => $this->input->post('description_ar'),
					                'From_Date' => $from_date->format('Y-m-d'),
					                'To_Date' => $to_date->format('Y-m-d'),
					                'Total_Days' => $this->input->post('duration'),
									'Amount_Person' => $this->input->post('amount_person'),
									'Slug' => $slug,
					                'Created_At' => date('Y-m-d H:i:s')
					            );

            $event_id = $this->events->add($insertData);
            
            if(strlen($this->input->post('address')) > 0)
            {
	            $locations = array(
		            'Event_ID' => $event_id,
		            'Address' => $this->input->post('address'),
		            'Latitude' => $this->input->post('latitude'),
		            'Longitude' => $this->input->post('longitude')
	            );
	            $this->events->addLocations($locations);
            }
            
            $pd_ids = explode(',', $__details);
            // Generate project cover thumbnail
            $pd_detail = $this->events->getPDFirstImg($pd_ids[0]);
            
            if(count($pd_detail) > 0)
            {
	         	$upd_filename = $pd_detail[0]->Pictures;
            
	            // generate thumbnail
	            $file_name_arr = explode('.', $upd_filename);
				$extension = array_pop($file_name_arr);
				$thumbname = date('YmdHis');
				$thumbname_with_ext = $thumbname.'.'.$extension;
	            $return_thmbname = GenerateThumbFromImage($GLOBALS['img_product_dir'], $upd_filename, $thumbname_with_ext, 500, 350);
	            
	            if ($event_id) {
	                $insertDataDetails = array(
	                    'PD_ID' => $pd_ids,
	                    'Event_ID' => $event_id,
	                    'Cover_Thumb' => $thumbname.$return_thmbname.'.'.$extension
	                );
	                
	                $result = $this->events->updateDetails_ARR($insertDataDetails);
	            }   
            }
            
            // update trip slider
            $slider_ids = explode(',', $__slides);
            if(count($pd_ids) > 0)
            {
	            $updateSlider = array(
	                'ESlider_ID' => $slider_ids,
	                'Event_ID' => $event_id
	            );
	            $result = $this->events->updateSlider_ARR($updateSlider);
            }
            
            if($event_id)
            {
				$log = array(
								'row_id' 	   => $event_id,
								'action_table' => 'events',
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
        
        redirect($this->thisCtrl . '/listall');
    }
    
    public function SetCover()
    {
	    $id = $this->input->post('id');
	    $pid = $this->input->post('pid');
	    $pd_detail = $this->events->getPDFirstImg($id);
            
        $upd_filename = $pd_detail[0]->Pictures;
        // generate thumbnail
        $file_name_arr = explode('.', $upd_filename);
		$extension = array_pop($file_name_arr);
		
		$thumbname = date('YmdHis');
		$thumbname_with_ext = $thumbname.'.'.$extension;
        $return_thmbname = GenerateThumbFromImage($GLOBALS['img_product_dir'], $upd_filename, $thumbname_with_ext, 500, 350);
        
        $insertDataDetails = array(
            'PD_ID' => $id,
            'Cover_Thumb' => $thumbname.$return_thmbname.'.'.$extension,
            'Is_Cover' => 1
        ); 
        $res = $this->events->PDSetDefaults($pid);      
        $result = $this->events->updateDetails($insertDataDetails);
        echo $result;
    }
    
    //#manage function
    public function listall()
    {
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'events',
						'content' 	   => 0,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

        $data['subcategories'] = $this->events->getSubCategories();
      	$data['categories'] = $this->events->getCategories();
        $this->LoadView('events/list', $data);
    }
    
    // #edit
    public function edit($id = 0)
    {

		$log = array(
						'row_id' 	   => $id,
						'action_table' => 'events',
						'content' 	   => $id,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

        $data['id']    = $id;
        $data['details']   = $this->events->getDetails($data);
        $data['slider']   = $this->events->getSlides($data);
        $data['event']       = $this->events->getByID($data);
        $data['elocaitons']       = $this->events->getLocationsByID($data);
        $data['categories'] = $this->events->getCategories();
	    
	    $sub['subcategory_id'] = $data['event'][0]->SubCategory_ID;
        $data['subcategories'] = $this->events->getSubCategoryByID($sub);
        
        $this->LoadView('events/edit', $data);
    }
    
    // #update
    public function edit_POST()
    {
        if($this->input->post('id')) 
        {
            $id         = $this->input->post('id');
            $from_date  = new DateTime($this->input->post('fromdate'));
            $to_date 	= new DateTime($this->input->post('todate'));
            
            $slugTitle = $this->input->post('title_en');

			if(strlen($this->input->post('title_en')) == 0)
			{
				$slugTitle = $this->input->post('title_ar');
			}

			$slug = getUniqueSlug($slugTitle, TBL_EVENTS, 'Slug');

            $updateData = array(
					                'Event_ID' => $id,
					                'Title_en' => $this->input->post('title_en'),
					                'Title_ar' => $this->input->post('title_ar'),
					                'SubCategory_ID' => $this->input->post('subcategory'),
					                'Description_en' => $this->input->post('description_en'),
					                'Description_ar' => $this->input->post('description_ar'),
					                'From_Date' => $from_date->format('Y-m-d'),
					                'To_Date' => $to_date->format('Y-m-d'),
					                'Total_Days' => $this->input->post('duration'),
									'Amount_Person' => $this->input->post('amount_person'),
									'Slug' => $slug
					            );
            
            $result = $this->events->update($updateData);
            
            // update trip locations
            $locations = array(
						            'Event_ID' => $id,
						            'Address' => $this->input->post('address'),
						            'Latitude' => $this->input->post('latitude'),
						            'Longitude' => $this->input->post('longitude')
					            );

            $this->events->addLocations($locations);
            
            if ($result) 
            {
				$log = array(
								'row_id' 	   => $id,
								'action_table' => 'events',
								'content' 	   => $_POST,
								'event' 	   => 'update'
							);

				$this->logs->add_log($log);
            	
	            // generate project cover if it does not have a cover
	            $id = $this->input->post('Event_ID');

	            // 1) check if cover exists or not ?
				$project_cover = $this->events->getCoverBool($id);
		        if(count($project_cover) <= 0){
			        
			        // 2) get project images for cover
			        $pd_detail = $this->events->getDetailsImagesForCover($id);
			        if(count($pd_detail) > 0)
			        {
				    	$upd_filename = $pd_detail[0]->Pictures;
			        
				        // 3) generate thumbnail
				        $file_name_arr = explode('.', $upd_filename);
						$extension = array_pop($file_name_arr);
						$thumbname = date('YmdHis');
						$thumbname_with_ext = $thumbname.'.'.$extension;
				        $return_thmbname = GenerateThumbFromImage($GLOBALS['img_product_dir'], $upd_filename, $thumbname_with_ext, 500, 350);
				        
				        $insertDataDetails = array(
				            'PD_ID' => $pd_detail[0]->PD_ID,
				            'Cover_Thumb' => $thumbname.$return_thmbname.'.'.$extension,
				            'Is_Cover' => 1
				        ); 
				        // 4) set project cover defaults (remove is_cover, and cover_thumb)
				        $res = $this->events->PDSetDefaults($pid); 
				        // 5) update details     
				        $result = $this->events->updateDetails($insertDataDetails);   
			        }
		        }   
		        
	           $this->session->set_flashdata('requestMsgSucc', 120);
            } 
            else 
            {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
            
        }
        redirect($this->thisCtrl . '/listall');
    }
    
    // #delete function
    public function delete($id = 0)
    {
        $data['Event_ID'] = $id;
        $images           = $this->events->getImages($data);

        foreach($images as $img)
        {
	        @unlink('./'.$GLOBALS['img_product_dir'].$img->Pictures);
	        @unlink('./'.$GLOBALS['img_product_dir'].$img->Cover_Thumb);
        }
        
        $result  = $this->events->delete($data);

        if ($result)
        {
			$log = array(
							'row_id' 	   => $id,
							'action_table' => 'events',
							'content' 	   => $id,
							'event' 	   => 'delete'
						);

			$this->logs->add_log($log);

            $this->session->set_flashdata('requestMsgSucc', 122);
        } 
        else 
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl . '/listall');
    }
    
    /*-----------------------------------------------------------
		---------------------- #Pictures Gallery -----------------
		--------------------------------------------------------*/

    // #delete project function
    public function deleteDet($id = '', $event_ID = '')
    {
	    $data['id'] = $id;
	    // delete its image from server
        $images   = $this->events->getDetImages($data);

        foreach($images as $img){
	        unlink('./'.$GLOBALS['img_product_dir'].$img->Pictures);
	        unlink('./'.$GLOBALS['img_product_dir'].$img->Cover_Thumb);
        }
        
        $result  = $this->events->deleteDetail($data);
        
        if ($result) 
        {
        	$log = array(
							'row_id' 	   => $id,
							'action_table' => 'events gallery',
							'content' 	   => $id,
							'event' 	   => 'delete'
						);

			$this->logs->add_log($log);

            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl . '/edit/' . $event_ID);
    }
    
    public function uploadImages()
	{
		
		$result = '';
		if (empty($_FILES)) 
		{
			exit();
        }
        
        // image options
		$image_options = array(
									'file' => 'file',
									'directory' => $GLOBALS['img_product_dir'],
									'max_width' => 2000
								);
		
		$upload = UploadFile($image_options);
        if (!is_array($upload) && !array_key_exists('file_name', $upload)) 
        {
		    exit();
	    }
	    
	    $upload_data = $this->upload->data();
		$file_name = $upload_data['file_name'];
	    
	    $data = array(
					    'Event_ID' => $this->input->post('target_for_id'),
						'Pictures' => $file_name
				    );

	 	$result = $this->events->addDetails($data);   
	    
	    echo $result;
	}
	
	public function unlinkImage()
	{
		$image = $this->input->post('imageid');
	    
		$imageName = $this->events->getPDImageName($image);
	    if(unlink('./'.$GLOBALS['img_product_dir'].$imageName))
	    {
	        echo $this->events->deletePDImage($image);
	    }
	}
	
	
	/*-----------------------------------------------------------
		---------------------- #Slider -----------------
		--------------------------------------------------------*/
	
	// #delete project function
    public function deleteSlider($id = '', $event_ID = '')
    {
	    $data['slider_id'] = $id;
	    // delete its image from server
        $images = $this->events->getSlideImage($data);

        foreach($images as $img)
        {
	        unlink('./'.$GLOBALS['img_product_dir'].$img->Slider);
        }
        
        $result  = $this->events->deleteSlide($data);
        
        if ($result)
        {
        	$log = array(
							'row_id' 	   => $id,
							'action_table' => 'events slider',
							'content' 	   => $id,
							'event' 	   => 'delete'
						);

			$this->logs->add_log($log);

            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl . '/edit/' . $event_ID);
    }
	
	public function uploadSlide()
	{
		
		$result = '';
		if (empty($_FILES)) 
		{
			exit();
        }
        
        // image options
		$image_options = array(
			'file' => 'file',
			'directory' => $GLOBALS['img_product_dir'],
			'max_width' => 2000
		);
		
		$upload = UploadFile($image_options);
        if (!is_array($upload) && !array_key_exists('file_name', $upload)) 
        {
		    exit();
	    }
	    
	    $upload_data = $this->upload->data();
		$file_name = $upload_data['file_name'];
	    
	    $data = array(
		    'Event_ID' => $this->input->post('target_for_id'),
			'Slider' => $file_name
	    );
	 	$result = $this->events->addSlider($data);   
	    
	    echo $result;
	}
	
	public function unlinkSliderImage()
	{
		$image = $this->input->post('imageid');
	    
		$imageName = $this->events->getPDSliderName($image);
	    if(unlink('./'.$GLOBALS['img_product_dir'].$imageName))
	    {
	        echo $this->events->deletePDSlider($image);
	    }
    }
    

    /**---------------------------------------
	  	* list *
	  	-------------------------------------**/
	public function getDataList()
	{
		$list = $this->events->getDataList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

        $this->load->library('parser');

		foreach ($list as $dt) 
		{
			$no++;
			$i++;
			$datetime = new DateTime($dt->TimeStamp);
			$date = $datetime->format('d-m-Y');
			
			$action_data = array(
				'edit_url' => base_url($this->thisCtrl.'/edit/'.$dt->Event_ID),
				'delete_url' => base_url($this->thisCtrl.'/delete/'.$dt->Event_ID)
			);											
			
			//image
			$image = '';
			if(strlen($dt->Thumbnail) > 0){
				$image = '<img src="'.base_url($GLOBALS['img_product_dir'].$dt->Thumbnail).'" style="width: 60px">';
			}
			
			// actions template
			$actions = ''.$this->parser->parse('events/snippets/actions-template', $action_data, TRUE);
			
			//member status template
			$status_chk = '';
			$status_not_chk = '';
			if($dt->Status) { $status_chk = 'checked'; }
			if(!$dt->Status) { $status_not_chk = 'checked'; }
			$status = '<div data-toggle="hurkanSwitch" data-status="'.$dt->Status.'">
							<input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
							<input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
					  </div>';	
			
			// multi-language code												
			$title = 'Title_'.$this->session->userdata($this->acp_session->__lang());
			$category = 'SubCategory_'.$this->session->userdata($this->acp_session->__lang());
			
			$row = array();
			$row[] = $dt->Event_ID;
			$row[] = $date;
			$row[] = $image;
			$row[] = $dt->$title;
			$row[] = $dt->Address;
			$row[] = $dt->From_Date;
			$row[] = $dt->To_Date;
		    $row[] = $status;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->events->dataCount_all(),
						"recordsFiltered" => $this->events->dataCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
}		
	
?>