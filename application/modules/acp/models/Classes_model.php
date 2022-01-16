<?PHP
	class Classes_model extends CI_Model{
		
			/*-----------------------------------------------------------
		---------------------- class CATEGORIES Section -----------------
		--------------------------------------------------------*/
	
		// #Add category function
			public function addCategory($data = array()){
				$this->db->insert(TBL_CLASS_CATEGORIES, $data);
				return  $this->db->insert_id();
			}
			
			// #get Category function
			public function getCategories($data = array()){
				$query = $this->db->order_by('Category_ID', 'desc')->get(TBL_CLASS_CATEGORIES);
				return $query->result();
			}
			
			// #get Category function
		    public function getActiveCategories($data = null)
		    {
		        $this->db->where(array(
		            'Status' => 1
		        ));
		        $query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_CLASS_CATEGORIES);
		        return $query->result();
		    }
			
			// #get Category By ID function
			public function getCategoryByID($data = array()){
				$where = array('Category_ID' => $data['category_id']);
				$this->db->where($where);
				$query = $this->db->get(TBL_CLASS_CATEGORIES);
				return $query->result();
			}
			
			// #update Category function 
			public function updateCategory($data = array()){
				$where = array('Category_ID' => $data['Category_ID']);
				$this->db->where($where);
				$query = $this->db->update(TBL_CLASS_CATEGORIES, $data);
				return $query;
	
			}
			
			// #delete Category function 
			public function deleteCategory($data = array()){
				$where = array('Category_ID' => $data['category_id']);
				$this->db->where($where);
				$query = $this->db->delete(TBL_CLASS_CATEGORIES);
				return $query;
	
			}

			public function getAllAcademicYears(){

				        $query = $this->db
										->select('*')
										->from('academic_years')
										->order_by('Academic_Year_ID', 'asc')
										->get();
										
						return $query->result();
			}

				/*-----------------------------------------------------------
		---------------------- installation_price Section -----------------
		--------------------------------------------------------*/

		    public function get_cities(){
				return $this->db
							->get("tbl_cities")
							->result();
	
			}


			public function add_installation_price($data = array()){
				$this->db->insert('installation_price', $data);
				return  $this->db->insert_id();
	
			}

			public function delete_installation_price($data = array()){
					$where = array('installation_price_id' => $data['installation_price_id']);
					$this->db->where($where);
					$query = $this->db->update('installation_price', $data);
					return $query;
			}

			public function update_installation_price($data = array()){
				$where = array('installation_price_id' => $data['installation_price_id']);
				$this->db->where($where);
				$query = $this->db->update('installation_price', $data);
				return $query;
			}
			public function get_installation_price($data = array()){
				$where = array('installation_price_id' => $data['installation_price_id']);
				$this->db->where($where);
				$query = $this->db->get('installation_price');
				return $query->row();
			}
			
		
	var $order_columns_3  = array('installation_price_id');
		private function _get_installation_price_query()
		{
			$filter_city = '';

			
			if(!empty($_POST['filter_city']))
			{
				$filter_city = $_POST['filter_city'];
				$filter_city = "{$filter_city} = ip.City_ID  AND";
			}
			
			$where = "{$filter_city} ip.Is_Deleted = 0";
			
			$this->db
					 ->select('ip.*,c.City_en,c.City_ar')
					 ->from('installation_price ip')
					 ->join('tbl_cities as c', 'c.City_ID = ip.City_ID')
					 ->where($where);
			
			if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->order_columns_3[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("ip.installation_price_id", "DESC");
		    }
		}
		
		function getInstallationPricesList()
	    {
	        $this->_get_installation_price_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	
			$query = $this->db->get();
			
			//echo $this->db->last_query();
	        return $query->result();
	    }
	 
	    function installation_priceCount_filtered()
	    {
	        $this->_get_installation_price_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function installation_priceCount_all()
	    {
	        $this->_get_installation_price_query();
	        $query = $this->db->get();
	
	        return $this->db->count_all_results();
	    }
				/*-----------------------------------------------------------
		---------------------- Discount Section -----------------
		--------------------------------------------------------*/
			public function add_discount($data = array()){
				$this->db->insert('class_discount', $data);
				return  $this->db->insert_id();
	
			}

			public function delete_discount($data = array()){
					$where = array('PD_ID' => $data['PD_ID']);
					$this->db->where($where);
					$query = $this->db->update('class_discount', $data);
					return $query;
			}

			public function update_discount($data = array()){
				$where = array('PD_ID' => $data['PD_ID']);
				$this->db->where($where);
				$query = $this->db->update('class_discount', $data);
				return $query;
			}
			public function get_discount($data = array()){
				$where = array('PD_ID' => $data['PD_ID']);
				$this->db->where($where);
				$query = $this->db->get('class_discount');
				return $query->row();
			}
			
		
	var $order_columns_2  = array('PD_ID','Discount_Type', 'Valid_From', 'Valid_Until');
		private function _get_discount_query()
		{
			$filter_category = '';

			
			if(!empty($_POST['filter_category']))
			{
				$filter_category = $_POST['filter_category'];
				$filter_category = "find_in_set({$filter_category},IDS)<> 0  AND";
			}

				if(!empty($_POST['filter_classes']))
			{
				$filter_classes = $_POST['filter_classes'];
				$filter_classes = "find_in_set({$filter_classes},IDS)<> 0  AND";
			}
			
			$where = "{$filter_classes} {$filter_category} Is_Deleted = 0";
			
			$this->db
					 ->select('*')
					 ->from('class_discount')
					 ->where($where);
			
			if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->order_columns_2[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("PD_ID", "DESC");
		    }
		}
		
		function getdiscountsList()
	    {
	        $this->_get_discount_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	
			$query = $this->db->get();
			
			//echo $this->db->last_query();
	        return $query->result();
	    }
	 
	    function discountCount_filtered()
	    {
	        $this->_get_discount_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function discountCount_all()
	    {
	        $this->_get_discount_query();
	        $query = $this->db->get();
	
	        return $this->db->count_all_results();
	    }
			
			/*-----------------------------------------------------------
		---------------------- class SUBCATEGORIES Section -----------------
		--------------------------------------------------------*/
	
		// #Add category function
		public function addSubCategory($data = array())
		{
			$this->db->insert(TBL_CLASS_SUBCATEGORIES, $data);
			return  $this->db->insert_id();
		}
		
		// #get Category function
		// public function getSubCategories($categoryid = 0)
		// {
		// 	if($categoryid != 0)
		// 	{
		// 		$this->db->where('psc.Category_ID', $categoryid);
		// 	}
			
		// 	$query = $this->db
		// 					->select('psc.*, pc.Category_en, pc.Category_ar')
		// 					->from(TBL_CLASS_SUBCATEGORIES.' as psc')
		// 					->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID')
		// 					->order_by('Order_In_List', 'asc')
		// 					->get();
		// 	return $query->result();
		// }
		
		// #get Category function
	    public function getActiveSubCategories($categoryid = 0)
	    {
		    $where = array('psc.Status' => 1 );
		    if($categoryid != 0){
				$where['Category_ID'] = $categoryid;
			}
			
	        $this->db->where($where);
	        $query = $this->db
							->select('psc.*')
							->from(TBL_CLASS_SUBCATEGORIES.' as psc')
							->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID')
							->order_by('Order_In_List', 'asc')
							->get();
							
			return $query->result();
	    }
		
		// #get Category By ID function
		public function getSubCategoryByID($data = array()){
			$where = array('Category_ID' => $data['category_id']);
			$this->db->where($where);
			$query = $this->db->get(TBL_CLASS_SUBCATEGORIES);
			return $query->result();
		}

			// #get Category By ID function
		public function getSubCategoryBySubCategoryID($data = array()){
			$where = array('SubCategory_ID' => $data['subcategory_id']);
			$this->db->where($where);
			$query = $this->db->get(TBL_CLASS_SUBCATEGORIES);
			return $query->result();
		}
		
		// #update Category function 
		public function updateSubCategory($data = array()){
			$where = array('SubCategory_ID' => $data['SubCategory_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_CLASS_SUBCATEGORIES, $data);
			return $query;

		}
		
		// #delete Category function 
		public function deleteSubCategory($data = array()){
			$where = array('SubCategory_ID' => $data['subcategory_id']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_CLASS_SUBCATEGORIES);
			return $query;

		}
		
		public function deleteSubCategoriesByCategory($category_id = 0){
			$where = array('Category_ID' => $category_id);
			$this->db->where($where);
			$query = $this->db->delete(TBL_CLASS_SUBCATEGORIES);
			return $query;
		}
			
			/*-----------------------------------------------------------
		---------------------- HTTP Request -----------------
		--------------------------------------------------------*/
			
		public function getSubCategoriesByCategory($category_id = 0, $__lang = 'en')
		{
			$subcategory = 'SubCategory_'.$__lang;
			
			$where = array('Category_ID' => $category_id);
			$this->db->where($where);
			
			$query = $this->db
							->select("SubCategory_ID, Category_ID, {$subcategory} as SubCategory")
							->get(TBL_CLASS_SUBCATEGORIES);
			return $query->result();
		}
			
		/*--------------------------------------------------------
		---------------------- classes Section -----------------
		--------------------------------------------------------*/


		public function getAllclassesWidth(){

							return $this->db->get("class_width")->result();
		}



		
		public function getclassesByCategories($Category_ID)
		{
			return $this->db
							->where('Category_ID = '.$Category_ID)
							->get(TBL_CLASSES)
							->result();
		}

		public function getAllSizes()
		{
			return $this->db
							->get("size")
							->result();
		}

		// public function getclasseselectedOptions($Class_ID)
		// {
		// 		$result =   $this->db
		// 					->select('p.Class_ID,o.Id,o.option_type, o.Parent_id, o.Class_ID, o.Title_en as OptionTitle_en, o.Title_ar as OptionTitle_ar, p.Title_en, p.Title_ar,p.SKU')
		// 					->from('class_options as o')
		// 					->join('classes as p', 'p.Class_ID = o.Class_ID')
		// 					->where('o.Parent_id', $Class_ID)
		// 					->where('o.option_type', 1)
		// 					->order_by('o.Id', 'ASC')
		// 					->get()
		// 					->result();	
	
		// 		return $result;			
		// }    

		// 	public function getclasseselectedSizes($parent_id)
		// {
		// 		return   $this->db
		// 					->select('p.Class_ID,o.Id,o.option_type, o.Parent_id, o.Class_ID, o.Title_en as OptionTitle_en, o.Title_ar as OptionTitle_ar, p.Title_en, p.Title_ar, p.Title_ar,p.SKU,p.Price')
		// 					->from('class_options as o')
		// 					->join('classes as p', 'p.Class_ID = o.Class_ID')
		// 					->where('o.Parent_id', $parent_id)
		// 					->where('o.option_type', 2)
		// 					->order_by('o.Id', 'DESC')
		// 					->get()
		// 					->result();					
		// } 

		// public function modifyclassOptions($option = array(),$size_only=0)
		// {

		// 	if(!isset($option['Id'])){

		// 		$this->db->insert("class_options", $option);
		// 		return $this->db->insert_id();
		// 	}


		// 	$this->db->where('Id', $option['Id'])->update('class_options', $option);
		// 	return 1;
		// }

		// public function deleteOption($optionId,$Class_ID = '')
		// {			

		// 	//$this->db->where('option_taste_id', $optionId)->delete('class_tastes_sizes');
		//     return $this->db->where('Id', $optionId)->delete('class_options');
		// }



		public function getAllTeachers(){
			return $this->db->where('Status',1)->where('Customer_Type','teacher')->order_by('Customer_ID', 'ASC')->get('customers')->result();
		}

		public function getAllBranches(){
			return $this->db->where('Status',1)->order_by('Branch_ID', 'ASC')->get('branches')->result();
		}

		public function getAllWeightUnits(){
			return $this->db->order_by('Order_In_List', 'ASC')->get(TBL_CLASS_UNITS)->result();
		}
		
		public function Get_TotalRated($Class_ID = 0)
		{
			return $this->db->where('Class_ID', $Class_ID)->get(TBL_CLASS_RATING)->num_rows();
		}
	
		public function Get_AvgRating($Class_ID = 0)
		{
			$r5 = $this->db->query("SELECT SUM(Rating)/(COUNT(*)) as rating FROM ".TBL_CLASS_RATING." WHERE Class_ID = $Class_ID GROUP BY Class_ID")->result();
			return ceil(@$r5[0]->rating);
		}
		
		public function getHistory($Class_ID = 0){
			
			// $totalOrders = "(SELECT COUNT(*) FROM ".TBL_ORDER_DETAILS." WHERE Class_ID = $Class_ID) as TotalOrders";
			// $totalViews = "(SELECT COUNT(*) FROM ".TBL_CLASS_VIEWS." WHERE Class_ID = $Class_ID) as TotalViews";
			$totalSales = "(SELECT SUM(Price) FROM ".TBL_ORDER_DETAILS." WHERE Class_ID = $Class_ID) as TotalSales";
			
			$class = $this->db
							->select("p.*, pp.Price,  $totalSales, 0 as classPictures")
							->from(TBL_CLASSES." as p")
							// ->join(TBL_CLASS_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = p.SubCategory_ID', 'left')
							//->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = p.Category_ID', 'left')
							// ->join(TBL_ORDER_DETAILS.' as od', 'od.Class_ID = p.Class_ID', 'left')
							// ->join(TBL_CLASS_VIEWS.' as pv', 'pv.Class_ID = p.Class_ID', 'left')
							->join(TBL_Class_PRICE_PERUNIT.' as pp', 'pp.Class_ID = p.Class_ID', 'left')
							->where('p.Class_ID', $Class_ID)
							->get()
							->result();
							
/*
			echo $this->db->last_query();
			die();
*/
			// get class details
			foreach($class as $pd){
				$pd->classPictures = $this->db
													->select('pd.*')
													->from(TBL_CLASS_DETAILS.' as pd')
													->join(TBL_CLASSES.' as p', 'p.Class_ID = pd.Class_ID')
													->where('pd.Class_ID', $Class_ID)
													->get()
													->result();
													
				// $pd->Inventory = $this->db
				// 						 ->select("i.*, b.Name_en, b.Name_ar")
				// 						 ->from("classes_inventory as i")
				// 						 ->join("branches as b", "b.Vend_ID = i.Outlet_ID")
				// 						 ->where("i.Class_ID", $Class_ID)
				// 						 ->get()->result();
			}										
			return $class[0];
		}
		
		public function getVariants($Class_ID = 0)
		{
			//return $this->db->where('Class_ID', $Class_ID)->get('class_variants')->result();
		}
		
		// public function getComposites($Class_ID = 0)
		// {
		// 	return $this->db
		// 					->select('p.Created_At, p.Title_en, p.Title_ar, psc.SubCategory_en, psc.SubCategory_ar, p.Price, p.Quantity, pc.Pieces, pc.CClass_ID, pc.CompositeP_ID, pd.Cover_Thumb as Thumbnail')
		// 					->from('class_composites as pc')
		// 					->join(TBL_CLASSES.' as p', 'p.Vend_Class_ID = pc.CompositeP_ID')
		// 					->join(TBL_CLASS_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = p.SubCategory_ID', 'left')
		// 					->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1', 'left')
		// 					->where('pc.Class_ID', $Class_ID)
		// 					->group_by('p.Class_ID')
		// 					->get()
		// 					->result();
		// }
		
		
	    public function addclasses($data = array())
	    {
		    $query = $this->db->insert(TBL_CLASSES, $data);
			return $this->db->insert_id();
	    }
	    
	    public function addPerUnitPrice($data = array()){


	    	 if($data['Unit_ID'] == 12){  // per meter

	    			for ($i=0; $i < sizeof($data['Price']) ; $i++) { 
	    			if( $data['Price'][$i] !=''){
	    				$update_data = [   'Class_ID' => $data['Class_ID'],
								            'Price' => $data['Price'][$i],
								            'Cost' => $data['Cost'][$i],
								            'Width' => $data['Width'][$i],
								            'Unit_ID' => $data['Unit_ID'],
								            'Status' => $data['Status'][$i],
								            'Quantity' => $data['Quentity'][$i],
								            'Minimum_Sale_Amount' => $data['Minimum_Sale_Amount'][$i]
								             ];
					   
					
						    	$query = $this->db->insert(TBL_Class_PRICE_PERUNIT, $update_data);
						    }
					}
	    		


	    	}else{

	    			$update_data = [   'Class_ID' => $data['Class_ID'],
								            'Price' => $data['Price'],
								            'Cost' => $data['Cost'],
								            'Width' => 1,
								            'Unit_ID' => $data['Unit_ID'],
								            'Status' => $data['Status'],
								            'Quantity' => $data['Quentity'],
								            'Minimum_Sale_Amount' => $data['Minimum_Sale_Amount']
								             ];
					   
					
						    	$query = $this->db->insert(TBL_Class_PRICE_PERUNIT, $update_data);
	     }

		    
	        return $query;
	    }
	    
	    public function addDetails($data = array())
	    {
	        $query = $this->db->insert(TBL_CLASS_DETAILS, $data);
	        return $this->db->insert_id();
	    }
	    
	    public function getPageName(){
		    return $this->db
		    				->select('*')
		    				->from(TBL_SECTIONS.' as s')
		    				->where('s.Section_ID = 11')
		    				->get()
		    				->result();
	    }
	    
	    public function updateDetails_ARR($data = array())
	    {
	        $upd = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        $i = 0;
	        foreach ($data["PD_ID"] as $id) {
		        $where = array(
	                'PD_ID' => $id
	            );
		        if($i == 0){
			        $this->db->where($where);
			        $d['Class_ID'] = $data['Class_ID'];
			        $d['Cover_Thumb'] = $data['Cover_Thumb'];
			        $d['Is_Cover'] = 1;
					$query = $this->db->update(TBL_CLASS_DETAILS, $d);
					$i++;
		        } else {
		            $this->db->where($where);
		            $query = $this->db->update(TBL_CLASS_DETAILS, $upd);
		            $i++;
		        }
	        }
	        return $query;
	    }

	    	    
	    public function getAllImg($id = 0){
		   return $this->db
		                 ->where('Class_ID', $id)
		                  ->where('Is_Cover', 1)
		    		 ->get(TBL_CLASS_DETAILS)->result();
	    }

	    
	    public function getPDFirstImg($id = 0){
		   return $this->db->where('PD_ID', $id)
		    		 ->get(TBL_CLASS_DETAILS)->result();
	    }
	    
	    public function PDSetDefaults($id){
		    $data = array(
			    'Is_Cover' => 0
		    );
		    return $this->db->where('Class_ID', $id)
		    		 ->update(TBL_CLASS_DETAILS, $data);
	    }
	    
	    public function getCoverBool($id = 0){
		   return $this->db
		   				->where('Class_ID', $id)
		   				->where('Is_Cover', 1)
		   				->get(TBL_CLASS_DETAILS)->result();
	    }
	    
	    public function getclassDetailsImagesForCover($id = 0){
		   return $this->db
		   				->where('Class_ID', $id)
		   				->where('Is_Cover', 0)
		   				->get(TBL_CLASS_DETAILS)->result();
	    }
	    
	    // #get project by id 
	    public function getByID($data = '')
	    {
			$where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        
	        $this->db->where($where);
	        $query = $this->db->get(TBL_CLASSES);
	        return $query->result();
	    }

	    public function getClassDetails($class_id=0){
	    						$this->db->select("*,IFNULL(cd.Pictures, 'default.png') as Picture,b.Address as branch_address")
		    		 ->from(TBL_CLASSES." as cls")
		    		 ->join(TBL_CLASS_DETAILS." as cd", 'cd.Class_ID = cls.Class_ID','left')
		    		 ->join("branches as b", 'b.Branch_ID = cls.Branch_ID','right')		    		 
		    		 ->join(TBL_CUSTOMERS." as c", 'c.Customer_ID = cls.Teacher_ID','right')
		    		 ->join("customer_experiences as cp", 'cp.Customer_ID = c.Customer_ID','right')
		    		 ->join("academic_years as ay", 'ay.Academic_Year_ID = cls.Academic_Year_ID','right')
					 ->where('c.Status', 1)
					 ->where('cls.class_id', $class_id)
					 ->where('c.Customer_Type', 'teacher')					 
					 ->where('cd.Is_Cover', 1)
		    		 ->order_by('cls.Class_ID','DESC');

			$data = $this->db->get();
		    $class =  $data->row();
		    if(!empty($class)){
		    $class->Picture = base_url($GLOBALS['img_class_dir'].$class->Picture);
		    $class->ClassGallery = 	$this->db->select("*")
						    		 ->from(TBL_CLASS_DETAILS)
						    		 ->where('Status', 1)
						    		 ->where('Class_ID', $class->Class_ID)
		    						->get()->result();

		     $class->ClassStudents = 	$this->getClassStudents($class->Class_ID);
		    	return $class;
		    }else{
		    	return null;
		    }
	    }

	    public function getClassStudents($class_id = 0){
	    		return	$this->db->select("c.Fullname,cs.*")
		    		 ->from("class_students as cs")	    		 
		    		 ->join(TBL_CUSTOMERS." as c", 'c.Customer_ID = cs.Parent_ID','right')
		    		 // ->join("constants as cn", 'cn.id = cs.Student_Gender','right')
		    		 // ->join("constants as cn1", 'cn.id = cs.Relation_Type','right')
					 ->where('cs.Status', 1)
					 ->where('cs.Class_ID', $class_id)
					 ->where('c.Customer_Type', 'parent')					 
		    		 ->order_by('cs.STD_ID','asc')
		    		 ->get()
					 ->result();
	    }
	    
	    public function getPricePerUnit($data = ''){
		    // $where = array(
	     //        'Class_ID' => $data['Class_ID']
	     //    );
	     //    $this->db->where($where);
	     //    $query = $this->db->get(TBL_Class_PRICE_PERUNIT);
	     //    return $query->result();

	       if(isset($data['unit_id'])){
				$this->db->where('ppu.unit_id',$data['unit_id']);
			}

	        	return $this->db
												->select('*,ppu.Status as class_Stock_Status')
												->from(TBL_Class_PRICE_PERUNIT.' AS ppu')
												->join('class_width as pw', 'pw.class_Width_ID = ppu.Width','left')
												->join(TBL_CLASS_UNITS.' as pu', 'pu.Unit_ID = ppu.Unit_ID')
												->where('ppu.Class_ID', $data['Class_ID'])
												->get()
												->result();

	    }
	    
	    // #get project detail
	    public function getDetails($data = '')
	    {
	        $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        $this->db->where($where);
	        $this->db->order_by('Order_In_List', 'asc');
	        $query = $this->db->get(TBL_CLASS_DETAILS);
	        return $query->result();
	    }
	    
	    // #get project details by id
	    public function getDetailByID($data = '')
	    {
	        $where = array(
	            'PD_ID' => $data['classDet_id']
	        );
	        $this->db->where($where);
	        $query = $this->db->get(TBL_CLASS_DETAILS);
	        return $query->result();
	    }
	    
	    // #update project function 
	    public function update($data = '')
	    {
	        $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->update(TBL_CLASSES, $data);
	        return $query;
	        
	    }
	    
	    public function updatePerUnitPrice($data = ''){
		     // $where = array(
	      //       'Class_ID' => $data['Class_ID']
	      //   );

		     // $this->db->where($where);
	      //    $query = $this->db->delete(TBL_Class_PRICE_PERUNIT);

	         if($data['Unit_ID']==12){  //price per meter
	    		for ($i=0; $i < sizeof($data['Price']) ; $i++) { 
	    			if( $data['Price'][$i] !=''){
	    				$update_data = [   'Class_ID' => $data['Class_ID'],
								            'Price' => $data['Price'][$i],
								            'Cost' => $data['Cost'][$i],
								            'Width' => $data['Width'][$i],
								            'Unit_ID' => $data['Unit_ID'],
								            'Status' => $data['Status'][$i],
								            'Quantity' => $data['Quentity'][$i],
								            'Minimum_Sale_Amount' => $data['Minimum_Sale_Amount'][$i]
								             ];
					   
							if($data['PricePerUnit_ID'][$i] !=''){
						        $this->db->where('PricePerUnit_ID',$data['PricePerUnit_ID'][$i]);
						        $query = $this->db->update(TBL_Class_PRICE_PERUNIT, $update_data);
						    }else{
						    	$query = $this->db->insert(TBL_Class_PRICE_PERUNIT, $update_data);
						    }
					   }
	    		}
	    	}else{
	    		
	    			    $update_data = [   'Class_ID' => $data['Class_ID'],
								            'Price' => $data['Price'],
								            'Cost' => $data['Cost'],
								            'Width' => 1,
								            'Unit_ID' => $data['Unit_ID'],
								            'Status' => $data['Status'],
								             'Quantity' => $data['Quentity'],
								             'Minimum_Sale_Amount' => $data['Minimum_Sale_Amount']
								              ];

						if($data['PricePerUnit_ID'] !=''){					    
	    				     $this->db->where('PricePerUnit_ID',$data['PricePerUnit_ID']);
						        $query = $this->db->update(TBL_Class_PRICE_PERUNIT, $update_data);
						    }else{
						    	$query = $this->db->insert(TBL_Class_PRICE_PERUNIT, $update_data);
						    }
	    	}


	        return $query;
	    }
	    
	    // #update project details
	    public function updateDetails($data = array())
	    {
	        $where = array(
	            'PD_ID' => $data['PD_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->update(TBL_CLASS_DETAILS, $data);
	        return $query;
	    }
	    
	    public function getImages($data = array()){
		    $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	       return $this->db->select('PD_ID, Pictures, Cover_Thumb')->from(TBL_CLASS_DETAILS)->where($where)->get()->result();
	    }
	    
	    public function getDetImages($data = array()){
		    $where = array(
	            'PD_ID' => $data['classDet_ID']
	        );
	       return $this->db->select('Pictures, Cover_Thumb')->from(TBL_CLASS_DETAILS)->where($where)->get()->result();
	    }
	    
	    // #delete project function 
	    public function delete($data = array())
	    {
	        $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete(TBL_CLASSES);
	        if ($query) {
	            $where1 = array(
	                'Class_ID' => $data['Class_ID']
	            );
	            $this->db->where($where1);
	            $query1 = $this->db->delete(TBL_CLASS_DETAILS);
	            return $query;
	        }
	        
	    }
	    
	    // #delete project details function 
	    public function deleteDetail($data = null)
	    {
	        $where = array(
	            'PD_ID' => $data['classDet_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete(TBL_CLASS_DETAILS);
	        return $query;
	        
	    }
	    
	    public function getPDImageName($id){
				return $this->db->where('PD_ID', $id)->get(TBL_CLASS_DETAILS)->result()[0]->Pictures;
			}
			
			public function deletePDImage($id){
				return $this->db->where('PD_ID', $id)->delete(TBL_CLASS_DETAILS);
			}
	
		
		public function getAllclasses(){
			return $this->db
							->select('*')
							->from(TBL_CLASSES.' as p')
							->order_by("Class_ID", "DESC")
							->get()
							->result();
		}

		//for excel
		public function getAllclasses_Excel(){
			return $this->db
							->select('p.Class_ID,c.Category_en, c.Category_ar, p.Title_en, p.Title_ar, p.Quantity, p.Price, p.TimeStamp')
							->from(TBL_CLASSES.' as p')
							->join(TBL_CLASS_CATEGORIES.' as c', 'c.Category_ID = p.Category_ID')
							->order_by("Class_ID", "DESC")
							->get()
							->result();
		}
		
		//for Csv
		public function getAllclasses_Csv(){
			return $this->db
							->select('p.Class_ID,c.Category_en, c.Category_ar, p.Title_en, p.Title_ar, p.Quantity, p.Price, p.TimeStamp')
							->from(TBL_CLASSES.' as p')
							->join(TBL_CLASS_CATEGORIES.' as c', 'c.Category_ID = p.Category_ID')
							->order_by("Class_ID", "DESC")
							->get();
		}


		/**
		*------- classes List *---------
	**/

    
	var $order_columns_1  = array('p.Class_ID', 'p.TimeStamp', '', 'p.Title_en', '', 'p.Price', 'p.Status', 'p.SysStatus');
	private function _get_data_query()
	{
		
			$where_title = '';
			$where_category = '';
			$where_subcategory = '';
			$where_quantity = '';
			$where_status = '';
			$where_sku = '';
			

			
	//$where = "{$where_category} {$where_title} {$where_sku}";

	//echo 'gdfgf'.$where.'gdfgf'; exit();

		    $this->db->distinct();
	        $this->db->select('p.*,ay.*,pc.Name_en,pc.Name_ar,c.Fullname, pd.Cover_Thumb as Thumbnail'); 
	        $this->db->from(TBL_CLASSES.' AS p');
	        $this->db->join('branches as pc', 'pc.Branch_ID = p.Branch_ID', 'LEFT');
	        $this->db->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = p.Teacher_ID', 'LEFT');
	        $this->db->join('Academic_Years as ay', 'ay.Academic_Year_ID = p.Academic_Year_ID', 'LEFT');	        
	        $this->db->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1', 'LEFT');
	        $this->db->group_by('p.Class_ID');
	 
	    
	        $this->db->group_by('p.Class_ID');

	        if(!empty($_POST['title'])){
				$title = trim($_POST['title']);
				//$where_title = "(p.Title_en LIKE '%{$title}%' OR p.Title_ar LIKE '%{$title}%') AND";
				$this->db->like('c.Fullname', $title);

			}
			
			if($_POST['teacher'] != -1){
				$teacher = $_POST['teacher'];
				$this->db->where('p.Teacher_ID',$teacher);
			}	

			if(!empty($_POST['academic_year'])){
				$academic_year_id = $_POST['academic_year'];
				$this->db->where('p.Academic_Year_ID',$academic_year_id);
			}						
			
			if($_POST['branch'] != -1){
				$branch = trim($_POST['branch']);
				$this->db->where('p.Branch_ID',$branch);
			}

		    if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->order_columns_1[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("p.Class_ID", "DESC");
		    }
	        return $this->db->get()->result();


    }
 
    function getDataList()
    {
        return $this->_get_data_query();
        // if($_POST['length'] != -1)
        // $this->db->limit($_POST['length'], $_POST['start']);

		// $query = $this->db->get();
		
		// // //echo $this->db->last_query();
  //        return $query->result();
    }
 
    function dataCount_filtered()
    {
        //$this->_get_data_query();
        //$query = $this->db->get();
        return count($this->_get_data_query());
    }
 
    public function dataCount_all()
    {
        //$this->_get_data_query();
       // $query = $this->db->get();
        return count($this->_get_data_query());
    }	
	
		
	/**
		*------- class reviews *---------
	**/
	
	private function _get_reviews_query()
    { 
        $this->db->select('r.*, c.Fullname, c.Phone, p.Title_en, p.Title_ar')
			         ->from(TBL_CLASS_REVIEWS.' as r')
			         ->join(TBL_CLASSES.' as p', 'p.Class_ID = r.Class_ID')
			         ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = r.Customer_ID')
			         ->order_by('r.TimeStamp', 'desc');
				
/*
				$this->db->get();
				echo $this->db->last_query();
*/
    }
    
    
    public function getReviews(){
	    if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
		
		$this->_get_reviews_query();		
        $user_data = $this->db->get()->result();
		return $user_data;
    }
    
    function reviewsCount_all()
    {
        $this->_get_reviews_query();	
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }
 
    public function reviewsCount_filtered()
    {
        $this->_get_reviews_query();	
        return $this->db->get()->num_rows();
    }
	
	public function addAPISLog($log = array())
	{
		$this->db->insert('apis_log', $log);
	}
}

?>