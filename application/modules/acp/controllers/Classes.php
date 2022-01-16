<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Classes extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/classes"; 
	public $__directories = array();
	
	function __construct()
	{
    	parent::__construct();
    	    	
    	// send controller name to views
		$this->load->vars( array('__controller' => $this->thisCtrl));
		$this->load->library('parser');
    	$this->load->model('classes_model');
  	}



	/*-----------------------------------------------------------
		---------------------- installation price  Section -----------------
		--------------------------------------------------------*/



	public function add_installation_price_POST() 
	{
		if($this->input->post('submit'))
		{


			$log = array(
				'row_id' => 0,
				'action_table' => 'installation_price',
				'content' => $_POST,
				'event' => 'add'
			);
			$this->logs->add_log($log);



			$installation_price = array(
				'City_ID' => $this->input->post('City_ID'),
				'Installation_Percentage' => $this->input->post('Installation_Percentage'),			
			);

	        $result = $this->classes_model->add_installation_price($installation_price);
	        
		    if($result){
	            $this->session->set_flashdata('requestMsgSucc', 121);
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
			redirect($this->thisCtrl.'/listall_installation_price');
		}else{
			    $data['cities'] = $this->classes_model->get_cities();
				$this->LoadView('classes/installation_price/add',$data);
		}
		
	}


	// #update
	public function edit_installation_price_POST($id){
		if($this->input->post('submit'))
		{
			$log = array(
				'row_id' => 0,
				'action_table' => 'class_discount',
				'content' => $_POST,
				'event' => 'update'
			);
			$this->logs->add_log($log);
			
			
	
			$installation_price = array(
				'installation_price_id' => $id,
				'City_ID' => $this->input->post('City_ID'),
				'Installation_Percentage' => $this->input->post('Installation_Percentage'),			
			);
			
	        
	        $result = $this->classes_model->update_installation_price($installation_price);
	        
		    if($result){
	            $this->session->set_flashdata('requestMsgSucc', 120);
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
				redirect($this->thisCtrl.'/listall_installation_price');
		}else{
				
				$data['installation_price_id'] = $id;
				$data['cities'] = $this->classes_model->get_cities();
				$data['installation_price'] = $this->classes_model->get_installation_price($data);
				$this->LoadView('classes/installation_price/edit', $data);
				}
		
	}



		public function delete_installation_price_POST($installation_price_id = 0)
	{
		$data['installation_price_id'] = $installation_price_id;
		$data['Is_Deleted'] = 1;
		

		$result = $this->classes_model->delete_installation_price($data);
		
		if($result){
			
            $this->session->set_flashdata('requestMsgSucc', 122);
         } else {
             $this->session->set_flashdata('requestMsgErr', 119);
         }
		redirect($this->thisCtrl.'/listall_installation_price');
	}
	

	
	public function listall_installation_price_GET() 
	{
		 $data['cities'] = $this->classes_model->get_cities();
		$this->LoadView('classes/installation_price/list_all',$data);		
	}

	
	public function installation_price_list_GET()
	{

		//var_dump($_POST); exit();
		$installation_prices = $this->classes_model->getInstallationPricesList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		foreach ($installation_prices as $installation_price) {
			$no++;
			$i++;
			//$dt = new DateTime($discount->Created);
			// $date = $dt->format('d-m-Y');
			
			$action_data = array(
				'edit_url' => base_url($this->thisCtrl.'/edit_installation_price/'.$installation_price->installation_price_id),
				'delete_url' => base_url($this->thisCtrl.'/delete_installation_price/'.$installation_price->installation_price_id),
			);
			
			// actions template
			$this->load->library('parser');
			$actions = ''.$this->parser->parse('classes/snippets/discount_actions', $action_data, TRUE);
			
			$status_chk = '';
			$status_not_chk = '';
			if($installation_price->Status) { $status_chk = 'checked'; }
			if(!$installation_price->Status) { $status_not_chk = 'checked'; }
			$status = '<div data-toggle="hurkanSwitch" data-status="'.$installation_price->Status.'">
							<input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
							<input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
					  </div>';

			$__lang = $this->session->userdata($this->acp_session->__lang());
			$city = 'City_'.$__lang;




			
			
			$row = array();
			$row[] = $installation_price->installation_price_id;
			$row[] = $installation_price->$city;
			$row[] = $installation_price->Installation_Percentage. '%';

			$row[] = $status;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->classes_model->installation_priceCount_all(),
						"recordsFiltered" => $this->classes_model->installation_priceCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

		


	/*-----------------------------------------------------------
		---------------------- Discounts  Section -----------------
		--------------------------------------------------------*/

	public function add_discount_POST() 
	{
		if($this->input->post('submit'))
		{


			$log = array(
				'row_id' => 0,
				'action_table' => 'class_discount',
				'content' => $_POST,
				'event' => 'add'
			);
			$this->logs->add_log($log);


			
			$Valid_From = new DateTime($this->input->post('Valid_From'));
			$Valid_From = $Valid_From->format('Y-m-d');
			$Valid_Until = new DateTime($this->input->post('Valid_Until'));
			$Valid_Until = $Valid_Until->format('Y-m-d');
			
			$Type = $this->input->post('Discount_Type');
			if($Type=='categories'){
				$categories_ids = $this->input->post('categories_ids');
				$ids = implode(',', $categories_ids);
			}
			else{
				$classes_ids = $this->input->post('classes_ids');
				$ids =  implode(',', $classes_ids);
			}
		


			$discount = array(
				'Title_ar' => $this->input->post('Title_ar'),
				'Discount_Unit' => $this->input->post('Discount_Unit'),
				'Discount_Value' => $this->input->post('Discount_Value'),
				'Valid_From' => $Valid_From,
				'Valid_Until' => $Valid_Until,
				'Discount_Type' => $this->input->post('Discount_Type'),
				'IDS' => $ids			
			);

	        $result = $this->classes_model->add_discount($discount);
	        
		    if($result){
	            $this->session->set_flashdata('requestMsgSucc', 121);
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
			redirect($this->thisCtrl.'/discount/listall_discount');
		}else{
			    $data['categories'] = $this->classes_model->getCategories();
			     $data['classes'] = $this->classes_model->getAllclasses();
				$this->LoadView('classes/discount/add',$data);
		}
		
	}
	
	public function listall_discount_GET() 
	{
		 $data['categories'] = $this->classes_model->getCategories();
		 $data['classes'] = $this->classes_model->getAllclasses();
		$this->LoadView('classes/discount/list_all',$data);		
	}

	
	public function getDiscountList_GET()
	{

		//var_dump($_POST); exit();
		$discounts = $this->classes_model->getdiscountsList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		foreach ($discounts as $discount) {
			$no++;
			$i++;
			//$dt = new DateTime($discount->Created);
			// $date = $dt->format('d-m-Y');
			
			$action_data = array(
				'edit_url' => base_url($this->thisCtrl.'/edit_discount/'.$discount->PD_ID),
				'delete_url' => base_url($this->thisCtrl.'/delete_discount/'.$discount->PD_ID),
			);
			
			// actions template
			$this->load->library('parser');
			$actions = ''.$this->parser->parse('classes/snippets/discount_actions', $action_data, TRUE);
			
			$status_chk = '';
			$status_not_chk = '';
			if($discount->Status) { $status_chk = 'checked'; }
			if(!$discount->Status) { $status_not_chk = 'checked'; }
			$status = '<div data-toggle="hurkanSwitch" data-status="'.$discount->Status.'">
							<input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
							<input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
					  </div>';

			$__lang = $this->session->userdata($this->acp_session->__lang());
			$cat = 'Category_'.$__lang;
			$title = 'Title_'.$__lang;
					  $query = null;
			if($discount->Discount_Type == 'classes'){
					$query = $this->db
							    ->select("p.Class_ID,GROUP_CONCAT(p.".$title." SEPARATOR ',') AS discount_options")
							    ->from("class_discount AS pd")
							    ->join("classes AS p","find_in_set(p.Class_ID,pd.IDS)<> 0","left",false)
							    ->where('pd.PD_ID', $discount->PD_ID)
							    ->get()
							    ->result();

			}else if($discount->Discount_Type == 'categories'){
						$query = $this->db
							    ->select("GROUP_CONCAT(pc.".$cat." SEPARATOR ',')AS discount_options")
							    ->from("class_discount AS pd")
							    ->join("class_categories AS pc","find_in_set(pc.Category_ID,pd.IDS)<> 0","left",false)
							    ->where('pd.PD_ID', $discount->PD_ID)
							    ->get()
							    ->result();
			}

			
			
			$row = array();
			$row[] = $discount->PD_ID;
			$row[] = $discount->$title;
			$row[] = getSystemString($discount->Discount_Type);
			// $row[] = $image;
			// $row[] = $query[0]->discount_options;
			$row[] = date('d-m-Y',strtotime($discount->Valid_From));
			$row[] = date('d-m-Y',strtotime($discount->Valid_Until));
			$row[] = $discount->Discount_Value.' '.$discount->Discount_Unit;
			$row[] = $status;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->classes_model->discountCount_all(),
						"recordsFiltered" => $this->classes_model->discountCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

		// #update
	public function edit_discount_POST($id){
		if($this->input->post('submit'))
		{
			$log = array(
				'row_id' => 0,
				'action_table' => 'class_discount',
				'content' => $_POST,
				'event' => 'update'
			);
			$this->logs->add_log($log);
			
			$Valid_From = new DateTime($this->input->post('Valid_From'));
			$Valid_From = $Valid_From->format('Y-m-d');
			$Valid_Until = new DateTime($this->input->post('Valid_Until'));
			$Valid_Until = $Valid_Until->format('Y-m-d');
			
			$Type = $this->input->post('Discount_Type');
			if($Type=='categories'){
				$categories_ids = $this->input->post('categories_ids');
				$ids = implode(',', $categories_ids);
			}
			else{
				$classes_ids = $this->input->post('classes_ids');
				$ids =  implode(',', $classes_ids);
			}
			
			$discount = array(
				'PD_ID' => $id,
				'Title_ar' => $this->input->post('Title_ar'),
				'Discount_Unit' => $this->input->post('Discount_Unit'),
				'Discount_Value' => $this->input->post('Discount_Value'),
				'Valid_From' => $Valid_From,
				'Valid_Until' => $Valid_Until,
				'Discount_Type' => $this->input->post('Discount_Type'),
				'IDS' => $ids			
			);
			
	        
	        $result = $this->classes_model->update_discount($discount);
	        
		    if($result){
	            $this->session->set_flashdata('requestMsgSucc', 120);
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
			redirect($this->thisCtrl.'/discount/listall_discount');
		}else{
				
				$data['PD_ID'] = $id;
				 $data['categories'] = $this->classes_model->getCategories();
			     $data['classes'] = $this->classes_model->getAllclasses();
				$data['discount'] = $this->classes_model->get_discount($data);
				$this->LoadView('classes/discount/edit', $data);
				}
		
	}


		public function delete_discount_POST($discount_id = 0)
	{
		$data['PD_ID'] = $discount_id;
		$data['Is_Deleted'] = 1;
		

		$result = $this->classes_model->delete_discount($data);
		
		if($result){
			
            $this->session->set_flashdata('requestMsgSucc', 122);
         } else {
             $this->session->set_flashdata('requestMsgErr', 119);
         }
		redirect($this->thisCtrl.'/discount/listall_discount');
	}



	
	/*-----------------------------------------------------------
		---------------------- classes CATEGORY Section -----------------
		--------------------------------------------------------*/
		
	// #categories view function
	public function categories_GET()
	{
		 $data['categories'] = $this->classes_model->getActiveCategories();
		$this->LoadView('classes/categories/add_categories',$data);
	}	
	
	// #add-category function
	public function addCategory_POST()
	{
		if($this->input->post('submit'))
		{
			$slugTitle = $this->input->post('name_en');
			if(strlen($this->input->post('name_en')) == 0)
			{
				$slugTitle = $this->input->post('name_ar');
			}
			$slug = getUniqueSlug($slugTitle, TBL_CLASS_CATEGORIES, 'Slug');

			$data = array(
				'Category_en' => $this->input->post('name_en'),
				'Category_ar' => $this->input->post('name_ar'),
				//'Is_Shown_On_Home' => $this->input->post('Is_Shown_On_Home'),
				//'Order_In_List' => $this->input->post('Order_In_List'),
				'Slug' => $slug
			);



			if ($_FILES['fileToUpload']['size'] !== 0)
			{

                            $target_image = $GLOBALS['img_class_categories_dir'];
							// image options
							$file_options = array(
													'file' 		  => 'fileToUpload',
													'directory'   => $target_image,
													'file_name'   => date('Y-m-d H-i-s')
												);

							$upload_data = UploadFile($file_options);
							
							if (is_array($upload_data) && array_key_exists('file_name', $upload_data))
					        {
								$data['Icon'] = $upload_data['file_name'];
							}


             }


			$result = $this->classes_model->addCategory($data);
			if($result){
	             $this->session->set_flashdata('requestMsgSucc', 121);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }	
		}
		redirect($this->thisCtrl.'/manageCategories');
	}
	
	public function addCategoryPOP_POST()
	{
		$name_ar = $this->input->post('option_ar');
		$name_en = $this->input->post('option_en');

		$slugTitle = $name_en;
		if(strlen($name_en) == 0)
		{
			$slugTitle = $name_ar;
		}
		$slug = getUniqueSlug($slugTitle, TBL_CLASS_CATEGORIES, 'Slug');
		
		$data = array(
			'Category_en' => $name_en,
			'Category_ar' => $name_ar,
			'Slug' => $slug
		);
		$category_id = $this->classes_model->addCategory($data);
		echo json_encode(array('id' => $category_id));
	}
	
	public function manageCategories_GET()
	{
		$data['categories'] = $this->classes_model->getCategories();
		$this->LoadView('classes/categories/manage_categories', $data);
	}
	
	// #edit service
	public function editCategory_GET($categoryID = 0,$subcategory_id='')
	{
		if($subcategory_id){
			$data['title'] = getSystemString('edit_item_subcategory');
			$data['subcategory_id'] = $subcategory_id;
			$data['categories'] = $this->classes_model->getActiveCategories();
		    $data['subcategory'] = $this->classes_model->getSubCategoryBySubCategoryID($data);
		}
		else{
			$data['title'] = getSystemString('edit_item_category');
			$data['category_id'] = $categoryID;
		    $data['category'] = $this->classes_model->getCategoryByID($data);
		}

		
		$this->LoadView('classes/categories/edit_category', $data);
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
			$slug = getUniqueSlug($slugTitle, TBL_CLASS_CATEGORIES, 'Slug');

			$updateData = array(
				'Category_ID' => $id,
				'Category_en' =>  $this->input->post('name_en'),
				'Category_ar' =>  $this->input->post('name_ar'),
				//'Is_Shown_On_Home' => $this->input->post('Is_Shown_On_Home'),
				//	'Order_In_List' => $this->input->post('Order_In_List'),
				'Slug' => $slug
			);
			

             if ($_FILES['fileToUpload']['size'] !== 0)
					{

		                            $target_image = $GLOBALS['img_class_categories_dir'];
									// image options
									$file_options = array(
															'file' 		  => 'fileToUpload',
															'directory'   => $target_image,
															'file_name'   => date('Y-m-d H-i-s')
														);

									$upload_data = UploadFile($file_options);
									
									if (is_array($upload_data) && array_key_exists('file_name', $upload_data))
							        {
										$updateData['Icon'] = $upload_data['file_name'];
									}


		             }

				
			$result = $this->classes_model->updateCategory($updateData);
	        
	         if($result){
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }	

		}
		redirect($this->thisCtrl.'/manageCategories');
	}
	
	// #delete service function
	public function deleteCategory_POST($categoryID = 0)
	{
		$data['category_id'] = $categoryID;
		
		//after deleting record we have to also remove its picture for that we have to get record detail first then delete it.
		$category = $this->classes_model->getCategoryByID($data);
		
		$result = $this->classes_model->deleteCategory($data);
		if($result){
			
			// now delete its icon as well
			foreach($category as $row){
				unlink('./'.$GLOBALS['img_class_categories_dir'].$row->Icon);
			}
			
			// also delete its subcategories
			$this->deleteSubCategoriesByCategory($category_id);
			
            $this->session->set_flashdata('requestMsgSucc', 122);
         } else {
             $this->session->set_flashdata('requestMsgErr', 119);
         }
		redirect($this->thisCtrl.'/manageCategories');
	}
	
	/*-----------------------------------------------------------
		---------------------- class SUBCATEGORY Section -----------------
		--------------------------------------------------------*/
		
	// #categories view function
	public function subcategories_GET($category_id = 3)
	{
		if($category_id == 0){
			exit();
		}
		$data['category_id'] = $category_id;
		$data['category'] = $this->classes_model->getCategoryByID($data);
		$this->LoadView('classes/categories/subcategories/add_subcategories', $data);
	}	
	
	// #add-category function
	public function saveSubCategory_PUT()
	{
		if($this->input->post('submit'))
		{
			$slugTitle = $this->input->post('name_en');
			if(strlen($this->input->post('name_en')) == 0)
			{
				$slugTitle = $this->input->post('name_ar');
			}
			$slug = getUniqueSlug($slugTitle, TBL_CLASS_SUBCATEGORIES, 'Slug');

			$category_id = $this->input->post('category_id');
			
			$data = array(
				'Category_ID' => $category_id,
				'SubCategory_en' => $this->input->post('name_en'),
				'SubCategory_ar' => $this->input->post('name_ar'),
				'Slug' => $slug,
				'Order_In_List' => $this->input->post('Order_In_List'),
			);

			// if ($_FILES['fileToUpload']['size'] !== 0)
			// {
   //                  //upload profile thumbnail
   //              $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_class_categories_dir']);
			// 	if ($file) 
			// 	{
   //                  $data['Icon'] = substr($file, strrpos($file, '/') + 1);
   //              }
   //           }

			$result = $this->classes_model->addSubCategory($data);
			if($result){
	             $this->session->set_flashdata('requestMsgSucc', 121);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }	
		}
		redirect($this->thisCtrl.'/manageCategories');
	}
	
	public function addSubCategory_POST()
	{
		$name_ar = $this->input->post('option_ar');
		$name_en = $this->input->post('option_en');
		$category_id = $this->input->post('parent_id');

		$slugTitle = $name_en;
		if(strlen($name_en) == 0)
		{
			$slugTitle = $name_ar;
		}
		$slug = getUniqueSlug($slugTitle, TBL_CLASS_SUBCATEGORIES, 'Slug');
		
		$data = array(
			'Category_ID' => $category_id,
			'SubCategory_en' => $name_en,
			'SubCategory_ar' => $name_ar,
			'Slug' => $slug,
			'Order_In_List' => $this->input->post('Order_In_List'),
		);
		$category_id = $this->classes_model->addSubCategory($data);
		echo json_encode(array('id' => $category_id));
	}
	
	// #edit service
	public function editSubCategory_GET($subcategoryID = 0)
	{
		$data['subcategory_id'] = $subcategoryID;
		$data['categories'] = $this->classes_model->getActiveCategories();
		$data['subcategory'] = $this->classes_model->getSubCategoryByID($data);
		$this->LoadView('classes/categories/subcategories/edit_subcategory', $data);
	}
	
	// #update service
	public function updateSubCategory_POST()
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
			$slug = getUniqueSlug($slugTitle, TBL_CLASS_SUBCATEGORIES, 'Slug');

			$updateData = array(
				'SubCategory_ID' => $id,
				'Category_ID' => $category_id,
				'SubCategory_en' => $this->input->post('name_en'),
				'SubCategory_ar' => $this->input->post('name_ar'),
				'Slug' => $slug,
				'Order_In_List' => $this->input->post('Order_In_List'),
			);

			if ($_FILES['fileToUpload']['size'] !== 0)
			{
                //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_class_categories_dir']);
                if ($file) {
                    $updateData['Icon'] = substr($file, strrpos($file, '/') + 1);
                }
			}
			
			$result = $this->classes_model->updateSubCategory($updateData);
	        
	         if($result){
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }	

		}
		redirect($this->thisCtrl.'/manageCategories');
	}
	
	public function manageSubCategories_GET()
	{
		$data['subcategories'] = $this->classes_model->getSubCategories();
		$this->LoadView('classes/categories/subcategories/manage_subcategories', $data);
	}
	
	// #delete service function
	public function deleteSubCategory_DELETE($subcategoryID = 0)
	{
		$data['subcategory_id'] = $subcategoryID;
		
		//after deleting record we have to also remove its picture for that we have to get record detail first then delete it.
		//$subcategory = $this->classes_model->getSubCategoryByID($data);
		
		$result = $this->classes_model->deleteSubCategory($data);
		if($result)
		{
			// now delete its icon as well
			// foreach($subcategory as $row)
			// {
			// 	unlink('./'.$GLOBALS['img_class_categories_dir'].$row->Icon);
			// }
			
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
             $this->session->set_flashdata('requestMsgErr', 119);
        }
		redirect($this->thisCtrl.'/manageCategories');
	}
	
	public function deleteSubCategoriesByCategory($category_id = 0)
	{
		
		//after deleting record we have to also remove its picture for that we have to get record detail first then delete it.
		$subcategory = $this->classes_model->getSubCategoriesByCategory($category_id);
		
		$result = $this->classes_model->deleteSubCategoriesByCategory($category_id);
		if($result){
			
			// now delete its icon as well
			foreach($subcategory as $row)
			{
				unlink('./'.$GLOBALS['img_class_categories_dir'].$row->Icon);
			}
			
		}
		return $result;
		
	}
	
	/*-----------------------------------------------------------
		---------------------- #HTTP Request -----------------
		--------------------------------------------------------*/
	
	public function getSubCategoriesByCategory_GET($category_id = 0)
	{
		$__lang = $this->session->userdata($this->acp_session->__lang());
		echo json_encode($this->classes_model->getSubCategoriesByCategory($category_id, $__lang));
	}
	
	
	/*-----------------------------------------------------------
		---------------------- #classes -----------------
		--------------------------------------------------------*/
    
    // #work view function
    public function newclass_GET()
    {
       	    $data['branches']    = $this->classes_model->getAllBranches();

	    $data['all_teachers']    = $this->classes_model->getAllTeachers();

        $this->LoadView('classes/add', $data);
    }

    public function check_sku_exists_POST(){
    		$sku  = $this->input->post('SKU');
    		$this->db->select('SKU'); 
		    $this->db->from('classes');
		    $this->db->where('SKU', $sku);
		    $query = $this->db->get();
		    $result = $query->result_array();
		    if(empty($result)){
		    	 $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('exist'=>0)));
            }else{
            	 $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('exist'=>1)));
            }
    } 

    public function check_sku_exists_by_Class_ID_POST(){
    		$sku  = $this->input->post('SKU');
    		$Class_ID  = $this->input->post('Class_ID');

    		//get class info
    		$this->db->select('*'); 
		    $this->db->from('classes');
		    $this->db->where('Class_ID', $Class_ID);
		    $query = $this->db->get();
		    $result = $query->result_array();
		    if($sku == $result->SKU){
		    	 $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('exist'=>0)));
		    }

    		$this->db->select('*'); 
		    $this->db->from('classes');
		    $this->db->where('SKU', $sku);
		    $this->db->where('Class_ID !=', $Class_ID);
		    $query = $this->db->get();
		    $result = $query->result_array();
		    if(empty($result)){
		    	 $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('exist'=>0)));
            }else{
            	 $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('exist'=>1)));
            }
    } 
    public function add_pricing_record_POST(){
    	$data['width'] = $this->classes_model->getAllclassesWidth();

		$output = $this->load->view('classes/snippets/add_pricing_record',$data,true);

        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => true,'result'=>$output)));

    }

        public function add_pricing_per_meter_POST(){
    	$data['width'] = $this->classes_model->getAllclassesWidth();

    	
    	$data['unit_id'] =  $this->input->post('unit_id');
    	$data['Class_ID'] =  $this->input->post('Class_ID');
    	 $data['class_unit']  = $this->classes_model->getPricePerUnit($data);

		$output = $this->load->view('classes/snippets/per_meter_price',$data,true);

        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => true,'result'=>$output)));

    }

        public function add_pricing_per_unit_POST(){
    	$data['width'] = $this->classes_model->getAllclassesWidth();


    	$data['unit_id'] =  $this->input->post('unit_id');
    	$data['Class_ID'] =  $this->input->post('Class_ID');

    	 $data['class_unit']  = $this->classes_model->getPricePerUnit($data);

		$output = $this->load->view('classes/snippets/per_unit_price',$data,true);

        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => true,'result'=>$output)));

    }
    
    public function details_GET($Class_ID = 0)
    {


        $data['class']   = $this->classes_model->getClassDetails($Class_ID);
		$this->LoadView('classes/details', $data);
    }
    
    // #add project function 
    public function add_POST()
    {
		if ($this->input->post('submit')) 
		{
        
            $branch_id = $this->input->post('branch_id');
            $title_en    = $this->input->post('title_en');
            $title_ar    = $this->input->post('title_ar');
            $content_en     = $this->input->post('content_en');
            $content_ar     = $this->input->post('content_ar');
            $teacher_id     = $this->input->post('teacher_id');

            $Student_Number     = $this->input->post('Student_Number');


            
            $__details = $this->input->post('class_details');
            $result    = '';
			

			
            $insertData = array(
                'Title_en' => $title_en,
                'Title_ar' => $title_ar,
                'Content_en' => $content_en,
                'Content_ar' => $content_ar,
                'Description_en' => $desc_en,
                'Description_ar' => $desc_ar,
                'Branch_ID' => $branch_id,
                'Teacher_ID' => $teacher_id, 
                'Student_Number'=>$Student_Number  
            );

            $Class_ID = $this->classes_model->addclasses($insertData);
            

            
            $pd_ids = explode(',', $__details);
           // Generate project cover thumbnail
            $pd_detail = $this->classes_model->getPDFirstImg($pd_ids[0]);
            
            $upd_filename = $pd_detail[0]->Pictures;
            
            // generate thumbnail
            $file_name_arr = explode('.', $upd_filename);
			$extension = array_pop($file_name_arr);
			$thumbname = date('YmdHis');
			$thumbname_with_ext = $thumbname.'.'.$extension;
            $return_thmbname = GenerateThumbFromImage($GLOBALS['img_class_dir'], $upd_filename, $thumbname_with_ext, 400, 400); // updated from (200px 200px)
            
            if ($Class_ID) 
            {
                $insertDataDetails = array(
                    'PD_ID' => $pd_ids,
                    'Class_ID' => $Class_ID,
                    'Cover_Thumb' => $thumbname.$return_thmbname.'.'.$extension
                );


                
                $result = $this->classes_model->updateDetails_ARR($insertDataDetails);
            }
            
            
            if ($result) {
                $this->session->set_flashdata('requestMsgSucc', 121);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
        
        redirect($this->thisCtrl . '/listall');
    }
    
    public function SetclassCover_POST()
    {
	    $id = $this->input->post('id');
	    $pid = $this->input->post('pid');
	    $pd_detail = $this->classes_model->getPDFirstImg($id);
            
        $upd_filename = $pd_detail[0]->Pictures;
        // generate thumbnail
        $file_name_arr = explode('.', $upd_filename);
		$extension = array_pop($file_name_arr);
		$thumbname = date('YmdHis');
		$thumbname_with_ext = $thumbname.'.'.$extension;
        $return_thmbname = GenerateThumbFromImage($GLOBALS['img_class_dir'], $upd_filename, $thumbname_with_ext, 400, 400);
        
        $insertDataDetails = array(
                'PD_ID' => $id,
                'Cover_Thumb' => $thumbname.$return_thmbname.'.'.$extension,
                'Is_Cover' => 1
        ); 
        $res = $this->classes_model->PDSetDefaults($pid);      
        $result = $this->classes_model->updateDetails($insertDataDetails);
        echo $result;
    }
    
    // #manage-projects function
    public function listall_GET($store_id = 0, $store_name = '')
    {
	    //$data['units'] = $this->classes_model->getAllWeightUnits();
	    //$data['subcategories'] = $this->classes_model->getSubCategories();
	    $data['academic_years'] = $this->classes_model->getAllAcademicYears();
      	$data['branches'] = $this->classes_model->getAllBranches();
        $data['teachers'] = $this->classes_model->getAllTeachers();
        $this->LoadView('classes/list', $data);
    }
    
// class Options
	public function modifyclassOptions_POST($classId)
	{

		//$classId = ($classId != '')?$classId:$this->input->post('classId');
		if ($classId) 
        {
			$option = array(
				"Parent_id" => $classId,
				"Class_ID" => $this->input->post('optionclass'),
				"Title_en" => $this->input->post('optionTitle_en'),
				"Title_ar" => $this->input->post('optionTitle_ar'),
				"option_type" => $this->input->post('option_type'),				
			);
			if(!empty($this->input->post('optionId')))
			{
				$option['Id'] = $this->input->post('optionId');
			}

			$size_only = $this->input->post('size_only');

			$result = $this->classes_model->modifyclassOptions($option,$size_only);

			if($result){
				$this->session->set_flashdata('requestMsgSucc', 120);
            } else {
               $this->session->set_flashdata('requestMsgErr', 119);
            }
		}

		redirect($this->thisCtrl . '/editclass/'.$classId);
	}

		// #delete project function
    public function deleteOption_POST($optionId, $classId)
    {
        $result  = $this->classes_model->deleteOption($optionId,$classId);
        if ($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        //redirect($this->thisCtrl . '/edit/'.$classId);
        redirect($_SERVER["HTTP_REFERER"]);
    }
   
    // #edit
	public function editclass_GET($classID = 0)
    {
  

        $data['Class_ID']    = $classID;
        $data['class_det']   = $this->classes_model->getDetails($data);
        $data['class']       = $this->classes_model->getByID($data);


	    $data['branches']    = $this->classes_model->getAllBranches();

	    $data['all_teachers']    = $this->classes_model->getAllTeachers();



	    
	    $sub['category_id'] = $data['class'][0]->Category_ID;


        $this->LoadView('classes/edit', $data);
        
    }
  //   public function editByVendId($classID = 0)
  //   {
		// $data['class']       = $this->classes_model->getByID(array('Class_ID' => $classID, "byVendId" => true));
  //       $data['Class_ID']    = @$data['class'][0]->Class_ID;
  //       $data['class_det']   = $this->classes_model->getDetails($data);
  //       $data['class_unit']  = $this->classes_model->getPricePerUnit($data);
  //       $data['units'] 		   = $this->classes_model->getAllWeightUnits();
	 //    $data['categories']    = $this->classes_model->getCategories();
	    
	 //    $sub['subcategory_id'] = $data['class'][0]->SubCategory_ID;
	    
	 //    $data['subcategories'] = $this->classes_model->getSubCategoryByID($sub);
  //       $this->LoadView('classes/edit', $data);
  //   }
    
    // #update
    public function edit_POST()
    {
           if ($this->input->post('Class_ID')) 
        {
            $id          = $this->input->post('Class_ID');
            $branch_id = $this->input->post('branch_id');
            $title_en    = $this->input->post('title_en');
            $title_ar    = $this->input->post('title_ar');
            $content_en     = $this->input->post('content_en');
            $content_ar     = $this->input->post('content_ar');
            $teacher_id     = $this->input->post('teacher_id');

            $Student_Number     = $this->input->post('Student_Number');



            $first_cover = $this->classes_model->getAllImg($id);                   
           // Generate project cover thumbnail
            $pd_detail = $this->classes_model->getPDFirstImg($first_cover[0]->PD_ID);            
            $upd_filename = $pd_detail[0]->Pictures;
            
            // generate thumbnail
            $file_name_arr = explode('.', $upd_filename);
			$extension = array_pop($file_name_arr);
			$thumbname = date('YmdHis');
			$thumbname_with_ext = $thumbname.'.'.$extension;
            $return_thmbname = GenerateThumbFromImage($GLOBALS['img_class_dir'], $upd_filename, $thumbname_with_ext, 400, 400); // updated from (200px 200px)
            
            if ($id) 
            {
                $insertDataDetails = array(
                    'PD_ID' => $first_cover[0]->PD_ID,
                    'Class_ID' => $id,
                    'Cover_Thumb' => $thumbname.$return_thmbname.'.'.$extension
                );
                	$result = $this->classes_model->updateDetails($insertDataDetails);
               
            }



            $result     = '';
            $updateData = array(
                'Class_ID' => $id,
                'Title_en' => $title_en,
                'Title_ar' => $title_ar,
                'Content_en' => $content_en,
                'Content_ar' => $content_ar,
                'Description_en' => $desc_en,
                'Description_ar' => $desc_ar,
                'Branch_ID' => $branch_id,
                'Teacher_ID' => $teacher_id, 
                'Student_Number'=>$Student_Number               
            );
            
            $result = $this->classes_model->update($updateData);

            
            if ($result) 
            {
	           $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
               $this->session->set_flashdata('requestMsgErr', 119);
            }
            
        }
       
        redirect($this->thisCtrl . '/listall');
    }
    
    // #delete project function
    public function delete_POST($projectID = 0)
    {
        $data['Class_ID'] = $projectID;
        $images             = $this->classes_model->getImages($data);
        foreach($images as $img){
	        unlink('./'.$GLOBALS['img_class_dir'].$img->Pictures);
	        unlink('./'.$GLOBALS['img_class_dir'].$img->Cover_Thumb);
        }
        
        $result  = $this->classes_model->delete($data);
        if ($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl . '/listall');
    }
    
    // #delete project function
    public function deleteDet_POST($projectDet_ID = '', $Class_ID = '')
    {
	    $data['classDet_ID'] = $projectDet_ID;
	    // delete its image from server
        $images             = $this->classes_model->getDetImages($data);
        foreach($images as $img){
	        unlink('./'.$GLOBALS['img_class_dir'].$img->Pictures);
	        unlink('./'.$GLOBALS['img_class_dir'].$img->Cover_Thumb);
        }
        
        $result  = $this->classes_model->deleteDetail($data);
        
        if ($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl . '/editclass/' . $Class_ID);
    }
    
    public function uploadclassImages_POST()
	{
		
		        $config['upload_path']          = $GLOBALS['img_class_dir'];
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                //$config['max_width']            = 2000;
/*
                $config['max_size']             = 100;
                $config['max_height']           = 768;
*/

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('file'))
                {
						exit();
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());                        
                        
						$file_name = $data['upload_data']['file_name'];
					    
					    $data = array(
						    'Class_ID' => $this->input->post('target_for_id'),
							'Pictures' => $file_name
					    );

					 	$result = $this->classes_model->addDetails($data);   
					    
					    echo $result;
                        
                }
	}
	
	public function unlinkImage()
	{
		$image = $this->input->post('imageid');
	    
		$imageName = $this->classes_model->getPDImageName($image);
	    if(unlink('./'.$GLOBALS['img_class_dir'].$imageName))
	    {
	        echo $this->classes_model->deletePDImage($image);
	    }
	}

	public function classReviews(){
		$this->LoadView('classes/reviews');
	}




	/**---------------------------------------
	* class list *
	-------------------------------------**/
	public function getDataList_GET()
	{
		$list = $this->classes_model->getDataList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		foreach ($list as $class) 
		{
			$no++;
			$i++;
			$dt = new DateTime($class->TimeStamp);
			$date = $dt->format('d-m-Y');
			
			$action_data = array(
				'details_url' => base_url($this->thisCtrl.'/details/'.$class->Class_ID),
				'edit_url' => base_url($this->thisCtrl.'/editclass/'.$class->Class_ID),
				'delete_url' => base_url($this->thisCtrl.'/delete/'.$class->Class_ID)
			);											
			
			//image
			$image = '<img src="'.base_url('style/acp/img/placeholder.png').'" style="width: 60px">';
			if(strlen($class->Thumbnail) > 0){
				$image = '<img src="'.base_url($GLOBALS['img_class_dir'].$class->Thumbnail).'" style="width: 60px">';
			}
			
			// actions template
			$actions = ''.$this->parser->parse('classes/snippets/actions', $action_data, TRUE);
			
			$status_chk = '';
			$status_not_chk = '';
			if($class->Status) { $status_chk = 'checked'; }
			if(!$class->Status) { $status_not_chk = 'checked'; }
			$sysStatus = '<div data-toggle="hurkanSwitch" data-status="'.$class->Status.'">
							<input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
							<input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
						</div>';


			
			// multi-language code												
			$title = 'Title_'.$this->session->userdata($this->acp_session->__lang());
			$branch = 'Name_'.$this->session->userdata($this->acp_session->__lang());
			
			$row = array();
			$row[] = $class->Class_ID;
			$row[] = $class->Academic_Year;
			$row[] = $image;
			$row[] = $class->$title;
			$row[] = $class->$branch;
			$row[] = $class->Fullname;			
			$row[] = $sysStatus;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->classes_model->dataCount_all(),
				"recordsFiltered" => $this->classes_model->dataCount_filtered(),
				"data" => $data,
		);
		//output to json format

		echo json_encode($output);
	}
		
	/**---------------------------------------
	* class Reviews list *
	-------------------------------------**/
	
	public function getReviews()
	{
		
		$list = $this->classes_model->getReviews();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		
		// multi-language code												
		$title = 'Title_'.$this->session->userdata($this->acp_session->__lang());
		
		//print_r($list);
		foreach ($list as $rev) {
			$no++;
			$i++;
			$dt = new DateTime($rev->TimeStamp);
			$date = $dt->format('d-m-Y');
			
			$url = base_url($this->thisCtrl.'/details/'.$rev->Class_ID.'/');
			$class_url = '<a href="'.$url.'">'.$rev->$title.'</a>';
			
			$row = array();
			$row[] = $rev->Review_ID;
			$row[] = $date;
			$row[] = $class_url;
			$row[] = $rev->Fullname;
			$row[] = $rev->Phone;
			$row[] = $rev->Review;
			
			
			$data[] = $row;
			
		} // end foreach
		
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->classes_model->reviewsCount_all(),
			"recordsFiltered" => $this->classes_model->reviewsCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
		
	}
}