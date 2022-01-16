<?PHP
	class Products_model extends CI_Model
	{


			/*------------------------------------------
					----- discounts --------------
					------------------------------------------------ */
			public function get_discount_details($id,$discount_type){
					
									return  $this->db
											    ->select("*")
											    ->from("product_discount")
											    ->where("FIND_IN_SET(".$id.",IDS) >",0)
											    ->where('Discount_Type', $discount_type)
											    ->where('Valid_From <=',date('Y-m-d'))
												->where('Valid_Until >=',date('Y-m-d'))
												->where('Status',1)
												->where('Is_Deleted',0)
											    ->get()
											    ->row();
											 

			}


		public function Get_Categories($limit,$start){
				return $this->db
											->select('*')
											->from(TBL_CLASS_CATEGORIES)										
											->where('Status', 1)										
											->order_by('Order_In_List', 'ASC')											
											->limit($limit,$start)
											->get()
											->result();
		}

		public function get_other_categories(){

				return $this->db
											->select('*')
											->from(TBL_CLASS_CATEGORIES)										
											->where('Status', 1)
											->where('Is_Shown_On_Home', 1)									
											->order_by('Order_In_List', 'ASC')										
											->get()
											->result();
		}


					public function get_count_daily_orders(){
					
									return  $this->db
											    ->select("*")
											    ->from(TBL_ORDERS_HEAD)
												->where('DATE(TimeStamp)',date('Y-m-d'))
												->where('Order_Confirmed',1)
												->where('Payment_Verified',1)
											    ->get()
											    ->num_rows();
											 

			}



		    /*-----------------------------------------------------------
    ---------------------- whishlist -----------------
    --------------------------------------------------------*/

    public function getCustomerWhishlistByCustomerID($customer_id){
	     $products =   $this->db
	    				->distinct()
						->select("p.*,pc.Slug as SlugCategory, p.TimeStamp as pTimeStamp, IFNULL(pd.Pictures, 'default.png') as Pictures, IFNULL(pd.Cover_Thumb, 'default.png') as Cover_Thumb")
						->from(TBL_CLASSES_WISHLIST.' as pw')
						->join(TBL_CLASSES.' as p', 'p.Class_ID = pw.Class_ID')
                        ->join(TBL_CLASS_SUBCATEGORIES.' as pc', 'pc.SubCategory_ID = p.SubCategory_ID')
                        ->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1', 'left')
                        ->where('pw.Customer_ID', $customer_id)
						->order_by('pw.TimeStamp', 'DESC')
						->group_by('p.Class_ID')
						->get()
						->result();



					foreach ($products as  $product) {
						$product->prices = 		$this->db
												  ->where('pp.Class_ID', $product->Class_ID)
												  ->where('pp.Status', 1)
												  ->where('pp.Unit_ID', $product->Unit_ID)
												  ->join("product_units as pu", "pp.Unit_ID = pu.Unit_ID", "left")
								                  ->join("product_width as pw", "pw.Product_Width_ID = pp.Width", "left")
												  ->get('product_priceperunit as pp')
												  ->result();
						$product->ProdutsDiscount = $this->get_discount_details($product->Class_ID,'products');
						$product->CategoriesDiscount = $this->get_discount_details($product->Category_ID,'categories');
					}

					return  $products;
    }



		public function Get_latest_products($limit=12){
			  $products =  $this->db  
					->select("p.*,pc.Slug as SlugCategory, p.TimeStamp as pTimeStamp, IFNULL(pd.Pictures, 'default.png') as Pictures, IFNULL(pd.Cover_Thumb, 'default.png') as Cover_Thumb")
					->from(TBL_CLASSES." as p")
					->join(TBL_CLASS_CATEGORIES.' as pc', 'p.Category_ID = pc.Category_ID')
					->join(TBL_CLASS_DETAILS." as pd", "p.Class_ID = pd.Class_ID AND pd.Is_Cover = 1", "left")

					
					->where('p.Status', 1)
					->where('p.Is_Linked', 0)
					//->where('pd.Is_Cover', 1)
					->group_by('p.Class_ID')
					->order_by('p.Class_ID', 'DESC')
					->limit($limit)
					->get()->result();




					foreach ($products as  $product) {
						$product->prices = 		$this->db
												  ->where('pp.Class_ID', $product->Class_ID)
												  ->where('pp.Status', 1)
												  ->where('pp.Unit_ID', $product->Unit_ID)
												  ->join("product_units as pu", "pp.Unit_ID = pu.Unit_ID", "left")
								                  ->join("product_width as pw", "pw.Product_Width_ID = pp.Width", "left")
												  ->get('product_priceperunit as pp')
												  ->result();
						$product->ProdutsDiscount = $this->get_discount_details($product->Class_ID,'products');
						$product->CategoriesDiscount = $this->get_discount_details($product->Category_ID,'categories');
					}

					return  $products;

		}
		public function Get_ProductCategories($getProducts = false,$limit=4)
		{

			$subcategories = $this->db
											->select('*')
											->from(TBL_CLASS_CATEGORIES.' AS pc')
											->where('pc.Status', 1)						
											->order_by('pc.Order_In_List', 'ASC')
											->group_by('pc.Category_ID')
											->limit(6,0)											
											->get()
											->result();

			if($getProducts){
				// get products for this subcategory
				foreach($subcategories as $p)
				{

                  $products = $this->db
					->select("p.*, p.TimeStamp as pTimeStamp, IFNULL(pd.Pictures, 'default.png') as Pictures, IFNULL(pd.Cover_Thumb, 'default.png') as Cover_Thumb")
					->from(TBL_CLASSES." as p")
					->join(TBL_CLASS_DETAILS." as pd", "p.Class_ID = pd.Class_ID AND pd.Is_Cover = 1", "left")
					
					->where('p.Status', 1)
					->where('p.Is_Linked', 0)
					//->where('pd.Is_Cover', 1)
				    ->where('p.Category_ID', $p->Category_ID)
					->group_by('p.Class_ID')
					->order_by('p.Class_ID', 'DESC')
					->limit($limit)
					->get()->result();

					



					foreach ($products as  $product) {
						$product->prices = 		$this->db
												  ->where('pp.Class_ID', $product->Class_ID)
												  ->where('pp.Status', 1)
												  ->where('pp.Unit_ID', $product->Unit_ID)
												  ->join("product_units as pu", "pp.Unit_ID = pu.Unit_ID", "left")
								                  ->join("product_width as pw", "pw.Product_Width_ID = pp.Width", "left")
												  ->get('product_priceperunit as pp')
												  ->result();

						$product->ProdutsDiscount = $this->get_discount_details($product->Class_ID,'products');
					}

					$p->Products =  $products;
					$p->CategoriesDiscount = $this->get_discount_details($p->Category_ID,'categories');
					
						
				}
			}

			return $subcategories;
		}


						public function Get_AllCategories($limit=0,$start=0)
		{

			// if($limit && $start){
			// 	$this->db->limit($limit,$start);
			// }

			$categories = $this->db
											->select('pc.*')
											->from(TBL_CLASS_CATEGORIES.' AS pc')
											->where('pc.Status', 1)
											->order_by('pc.Order_In_List', 'ASC')
											->group_by('pc.Category_ID')
											->limit($limit,$start)
											->get()
											->result();


		   	foreach($categories as $p)
				{
						$product_category =  $this->db
										->select("ps.*")
										->from(TBL_CLASSES." as p")
										->join(TBL_CLASS_SUBCATEGORIES.' as ps', 'ps.SubCategory_ID = p.SubCategory_ID')
										->where('p.Status', 1)
										->where('p.Is_Linked', 0)
									    ->where('p.Category_ID', $p->Category_ID)
										->group_by('p.SubCategory_ID')
										->order_by('ps.Order_In_List', 'ASC')
										->get()->result();
						
						$subcategries = null;
						$tot = 0;
						foreach ($product_category as $key=> $row) {
							$product_subcategory =  $this->db
										->select("ps.*")
										->from(TBL_CLASSES." as p")
										->join(TBL_CLASS_SUBCATEGORIES. " as ps", "ps.SubCategory_ID = p.SubCategory_ID", "left")
										->where('p.Status', 1)
										->where('p.Is_Linked', 0)
										->where('p.Category_ID', $row->Category_ID)
									    ->where('p.SubCategory_ID', $row->SubCategory_ID)
									    ->order_by('ps.Order_In_List', 'ASC')
										->group_by('p.Class_ID')
										->order_by('p.Class_ID', 'DESC')
										->get()->result();


							$product_subcategory[$key]->Products = $product_subcategory;
							$subcategries[$key] = $product_subcategory;

							$subCategoriesCount = count($product_subcategory);
							$product_subcategory[$key]->SubCategoriesCount = $subCategoriesCount;
							$tot += $subCategoriesCount;
							$subcategries[$key] = $product_subcategory;
							 	
															    							    
						}
						//if($tot == 0) continue;
						$p->SubCategories =  $subcategries;
						$p->ProductsCount = $tot;
	
						
				}


			return $categories;
		}

		// 		public function Get_CategoryGallery($limit=0,$start=0)
		// {

		// 	// if($limit && $start){
		// 	// 	$this->db->limit($limit,$start);
		// 	// }

		// 	$categories = $this->db
		// 									->select('pc.*')
		// 									->from(TBL_CLASS_CATEGORIES.' AS pc')
		// 									->where('pc.Status', 1)
		// 									->group_by('pc.Category_ID')
		// 									->limit($limit,$start)
		// 									->get()
		// 									->result();


		//    	foreach($categories as $p)
		// 		{
		// 				$product_category =  $this->db
		// 								->select("ps.*")
		// 								->from(TBL_CLASSES." as p")
		// 								->join(TBL_CLASS_SUBCATEGORIES.' as ps', 'ps.SubCategory_ID = p.SubCategory_ID')
		// 								->where('p.Status', 1)
		// 								->where('p.Is_Linked', 0)
		// 							    ->where('p.Category_ID', $p->Category_ID)
		// 								->group_by('p.SubCategory_ID')
		// 								->order_by('p.Class_ID', 'DESC')
		// 								->get()->result();
						
		// 				$subcategries = null;
		// 				$tot = 0;
		// 				foreach ($product_category as $key=> $row) {
		// 					return  $this->db
		// 								->select("p.*,ps.*, p.TimeStamp as pTimeStamp, IFNULL(pd.Pictures, 'default.png') as Pictures_Orginal, IFNULL(pd.Cover_Thumb, 'default.png') as Thumbnail")
		// 								->from(TBL_CLASSES." as p")
		// 								->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1','left')
		// 								->join(TBL_CLASS_SUBCATEGORIES. " as ps", "ps.SubCategory_ID = p.SubCategory_ID", "left")
		// 								->where('p.Status', 1)
		// 								->where('p.Is_Linked', 0)
		// 								->where('p.Category_ID', $row->Category_ID)
		// 							    ->where('p.SubCategory_ID', $row->SubCategory_ID)
		// 								->group_by('p.Class_ID')
		// 								->order_by('p.Class_ID', 'DESC')
		// 								->get()->result();

		// 					$subCategoriesCount = count($product_subcategory);
		// 					$product_subcategory[$key]->SubCategoriesCount = $subCategoriesCount;
		// 					$product_subcategory[$key]->Products = $product_subcategory;
		// 					$tot += $subCategoriesCount;
		// 					$subcategries[$key] = $product_subcategory;
							 	
															    							    
		// 				}
		// 				//if($tot == 0) continue;
		// 				$p->SubCategories =  $subcategries;
		// 				$p->ProductsCount = $tot;
	
						
		// 		}


		// 	return $categories;
		// }


			public function Get_ProductGalleryByCategoriesAndSubCategoryies($category_id,$subcategory_id,$limit,$start,$price_type=0)
		{
			
                  $products = $this->db
					->select("p.*,ps.*,pc.Category_en,pc.Category_ar,`pc`.`Slug` as `scSlug`, p.TimeStamp as pTimeStamp, IFNULL(pd.Pictures, 'default.png') as Pictures_Orginal, IFNULL(pd.Cover_Thumb, 'default.png') as Thumbnail")

					->from(TBL_CLASSES." as p")
					->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1','left')
					->join(TBL_CLASS_CATEGORIES.' AS pc', "p.Category_ID = pc.Category_ID", "left")
					
					->join(TBL_CLASS_SUBCATEGORIES. " as ps", "ps.Category_ID = p.Category_ID", "left")
					->where('p.Status', 1)
					->where('p.Is_Linked', 0)
					//->where('pd.Is_Cover', 1)
				    ->where_in('p.Category_ID', $category_id)
				     ->where_in('p.SubCategory_ID', $subcategory_id)
					->group_by('p.Class_ID')
					// ->order_by('p.Class_ID', 'DESC')
					->order_by('p.Class_ID', 'RANDOM')
					->limit($limit,$start)
					->get()->result();



					foreach ($products as  $product) {

						if($price_type){
							if( $price_type=='lowest_price')
									$this->db->select_min('pp.Price');
							else
								$this->db->select_max('pp.Price');
						}
						$product->prices = 		$this->db
												  ->where('pp.Class_ID', $product->Class_ID)
												  ->where('pp.Status', 1)
												  ->where('pp.Unit_ID', $product->Unit_ID)
												  ->join("product_units as pu", "pp.Unit_ID = pu.Unit_ID", "left")
								                  ->join("product_width as pw", "pw.Product_Width_ID = pp.Width", "left")
												  ->get('product_priceperunit as pp')
												  ->result();
						$product->ProdutsDiscount = $this->get_discount_details($product->Class_ID,'products');
						$product->CategoriesDiscount = $this->get_discount_details($product->Category_ID,'categories');
					}
			

			return $products;
		}

						public function Get_ProductGalleryByCategories($category_id,$limit,$start)
		{
			if(!empty($category_id)){
                  $products = $this->db
					->select("p.*,pc.Category_en,pc.Category_ar,`pc`.`Slug` as `scSlug`, p.TimeStamp as pTimeStamp, IFNULL(pd.Pictures, 'default.png') as Pictures_Orginal, IFNULL(pd.Cover_Thumb, 'default.png') as Thumbnail")
					->from(TBL_CLASSES." as p")
					->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1','left')
					->join(TBL_CLASS_CATEGORIES.' AS pc', "p.Category_ID = pc.Category_ID", "left")
					->join(TBL_CLASS_SUBCATEGORIES. " as ps", "ps.Category_ID = p.Category_ID", "left")
				
					->where('p.Status', 1)
					->where('p.Is_Linked', 0)
					//->where('pd.Is_Cover', 1)
				    ->where_in('p.Category_ID', $category_id)
					->group_by('p.Class_ID')
					// ->order_by('p.Class_ID', 'DESC')
					->order_by('p.Class_ID', 'RANDOM')
					->limit($limit,$start)
					->get()->result();

						foreach ($products as  $product) {
						$product->prices = 		$this->db
												  ->where('pp.Class_ID', $product->Class_ID)
												  ->where('pp.Status', 1)
												  ->where('pp.Unit_ID', $product->Unit_ID)
												  ->join("product_units as pu", "pp.Unit_ID = pu.Unit_ID", "left")
								                  ->join("product_width as pw", "pw.Product_Width_ID = pp.Width", "left")
												  ->get('product_priceperunit as pp')
												  ->result();
					}
			}

			return $products;
		}


		public function searchProductsList( $limit, $start, $text)
		{

			$select_fields = "p.*, p.TimeStamp as pTimeStamp, IFNULL(pd.Pictures, 'default.png') as Pictures_Orginal, IFNULL(pd.Cover_Thumb, 'default.png') as Thumbnail";
        
			$this->db->distinct();
			$products = $this->db
									->select("$select_fields")
									->from(TBL_CLASSES." as p")
									->join(TBL_CLASS_DETAILS." as pd", "p.Class_ID = pd.Class_ID", "left")
								
									->where('p.Status', 1)
									->where('p.Is_Linked', 0)
									->like('p.Title_ar',$text)
									->or_like('p.Title_en',$text)
									->or_like('p.Content_ar',$text)
									->or_like('p.Content_en',$text)
									->group_by('p.Class_ID', 'DESC')
									->order_by('p.Class_ID', 'DESC')
									->limit($limit,$start)
									->get()
									->result();

						foreach ($products as  $product) {
						$product->prices = 		$this->db
												  ->where('pp.Class_ID', $product->Class_ID)
												  ->where('pp.Status', 1)
												  ->where('pp.Unit_ID', $product->Unit_ID)
												  ->join("product_units as pu", "pp.Unit_ID = pu.Unit_ID", "left")
								                  ->join("product_width as pw", "pw.Product_Width_ID = pp.Width", "left")
												  ->get('product_priceperunit as pp')
												  ->result();
							$product->ProdutsDiscount = $this->get_discount_details($product->Class_ID,'products');
						$product->CategoriesDiscount = $this->get_discount_details($product->Category_ID,'categories');
					}
								
			return $products;
		}



		
		// get active categories
		public function getCategories($category_slug = '')
		{
			if(!empty($category_slug))
			{
				$this->db->where('pc.Slug', $category_slug);
			}
			$query = $this->db
							->distinct()
							->select('pc.*')
							->from(TBL_CLASS_CATEGORIES.' as pc')
                            ->join(TBL_CLASS_SUBCATEGORIES.' as psc', 'psc.Category_ID = pc.Category_ID')
                            ->join(TBL_CLASSES.' as p', 'p.SubCategory_ID = psc.SubCategory_ID')
                            ->where('psc.Status', 1)
                            ->where('p.Status', 1)
                            ->where('p.SysStatus', 1)
							->order_by('pc.Order_In_List', 'ASC')
							->get();
			
							// echo $this->db->last_query(); die();
			return $query->result();
		}
		
		public function getSubCategories($category_slug = '', $subcategory_slug = '')
        {
            if(!empty($category_slug))
            {
				$this->db->where('pc.Slug', $category_slug);
			}
			
			if(!empty($subcategory_slug))
            {
				$this->db->where('psc.Slug', $subcategory_slug);
			}
            
			$query = $this->db
							->distinct()
							->select('pc.Slug as CSlug, pc.Category_en, pc.Category_ar, pc.Icon as categoryIcon, psc.*')
							->from(TBL_CLASS_SUBCATEGORIES.' as psc')
                            ->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID')
                            ->join(TBL_CLASSES.' as p', 'p.SubCategory_ID = psc.SubCategory_ID')
                            ->where('psc.Status', 1)
                            ->where('p.Status', 1)
                            ->where('p.SysStatus', 1)
							->order_by('psc.Order_In_List', 'ASC')
							->get();
			
							//echo $this->db->last_query(); die();
			return $query->result();
		}
		
		public function ProductsList($limitStart, $limit)
		{

			$select_fields = "p.*, p.TimeStamp as pTimeStamp, pd.Cover_Thumb, psc.Slug as SCSlug, psc.SubCategory_en, psc.SubCategory_ar, pc.Slug as CSlug, pc.Category_en, pc.Category_ar, IFNULL(pd.Cover_Thumb, 'default.png') as Thumbnail";
        
			$this->db->distinct();
			$products = $this->db
									->select("$select_fields")
									->from(TBL_CLASSES." as p")
									->join(TBL_CLASS_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = p.SubCategory_ID', 'LEFT')
									->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID', 'LEFT')
									->join(TBL_CLASS_DETAILS." as pd", "p.Class_ID = pd.Class_ID", "left")
									//->where("((p.Quantity > 0 AND p.Track_Inventory = 1) OR (p.Quantity = 0 AND p.Track_Inventory = 0)) ")
									->where('p.Status', 1)
									->where('p.Class_ID NOT IN (SELECT Class_ID FROM product_options)')
									->where('p.SysStatus', 1)
									->group_by('p.Class_ID', 'DESC')
									->order_by('p.Class_ID', 'DESC')
									->limit($limit)
									->get();
			
			return $products->result();
		}		
		
		public function getProductDetails($Class_ID)
		{
			$composites = $this->db->select("CompositeP_ID as Vend_Class_ID")->where("Class_ID", $Class_ID)->get("product_composites")->result();
			if(count($composites) > 0){
				return $composites;
			}
			
			return $this->db->select("Vend_Class_ID")->where("Class_ID", $Class_ID)->get("products")->result();
		}
		
		public function getInventoryDetails($Class_ID, $outlet_id){
			$inventory = $this->db
								->select("Quantity")
								->where("Vend_Class_ID", $Class_ID)
								->where("Outlet_ID", $outlet_id)
								->get("products_inventory");
			
			//echo $this->db->last_query();
			return $inventory->row();
		}

		public function getOnlyProductByID($Class_ID){

			
			return $this->db
								->select("*")
								->from(TBL_CLASSES)
								->where('Status',1)
								->where('Class_ID', $Class_ID)
								->get()->row();
		
			

		}
		
		public function getProductByID($item_slug = 0, $get_cover = false)
		{

			
			if(is_numeric($item_slug))
			{
				$this->db->where('p.Class_ID', $item_slug);
				
			} else {
				
				$this->db->where('p.Slug', $item_slug);
			}
			
			$product = $this->db
								->distinct()
								->select("p.*,
										  p.TimeStamp as pTimeStamp, 
										  pc.Category_en, 
										  pc.Category_ar,
										  pc.Slug as CSlug")

								->from(TBL_CLASSES." as p")
								->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = p.Category_ID', 'LEFT')
								->where('p.Status',1)
								//->where('p.Is_Linked', 0)
								->get();
			

			
			$product = $product->row();
									
			$Class_ID = $product->Class_ID;

			$product->ProductDetails = $this->db
												  ->where('Class_ID', $Class_ID)
												  //->where('Is_Cover', 1)
												  ->get(TBL_CLASS_DETAILS)
												  ->result();
			$product->ProductDetailsCover = $this->db
												  ->where('Class_ID', $Class_ID)
												  ->where('Is_Cover', 1)
												  ->get(TBL_CLASS_DETAILS)
												  ->result();

			$product->prices = 		$this->db  
												->distinct()
											      ->select('*')
												  ->where('pp.Class_ID', $Class_ID)
												  ->where('pp.Status', 1)
												  ->where('pp.Unit_ID', $product->Unit_ID)
												  ->join("product_units as pu", "pp.Unit_ID = pu.Unit_ID", "left")
								                  ->join("product_width as pw", "pw.Product_Width_ID = pp.Width", "left")
												  ->get('product_priceperunit as pp')
												  ->result();										  
			$product->ProdutsDiscount = $this->get_discount_details($Class_ID,'products');
			$product->CategoriesDiscount = $this->get_discount_details($product->Category_ID,'categories');
												  
			// get product reviews
			// $composites = $this->db
			// 								->distinct()
			// 								->select('p.*, pd.Cover_Thumb as Thumbnail')
			// 								->from(TBL_CLASSES.' as p')
			// 								->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1', 'LEFT')
			// 								->where('p.Class_ID', $Class_ID)
			// 								->group_by('p.Class_ID')
			// 								->get();
			// //echo $this->db->last_query();								
			// $composites = $composites->result();
											
			// foreach($composites as $c){
			// 	$c->RelatedProducts = $this->getRelatedProducts($c->Tags_en);
			// }
			
			// $product->Composites = $composites;
			
			return $product;
								
		}

		public function getCartProducts($Class_IDs = '')
		{
			$query = $this->db
							->select("p.*, IFNULL(pd.Pictures, 'default.png') as Pictures, IFNULL(pd.Cover_Thumb, 'default.png') as Cover_Thumb")
							->from(TBL_CLASSES.' as p')
							->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1','left')
							->where("p.Class_ID IN ($Class_IDs)")
							//->where('pd.Is_Cover', 1)
							->get();
			
			return $query->result();
		}

				public function getCartProduct($Class_ID = '')
		{
			$query = $this->db
							->select("p.*, IFNULL(pd.Pictures, 'default.png') as Pictures, IFNULL(pd.Cover_Thumb, 'default.png') as Cover_Thumb")
							->from(TBL_CLASSES.' as p')
							->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1','left')
							->where("p.Class_ID", $Class_ID)
							//->where('pd.Is_Cover', 1)
							->get();
			
			return $query->row();
		}
		
		public function getSettings()
		{
			return $this->db->get('website_settings')->row();
		}
		


			public function getRelatedProducts($Category_ID = "")
		{
			$select_fields = "p.*,`pc`.`Slug` as `scSlug`, p.TimeStamp as pTimeStamp, IFNULL(pd.Pictures, 'default.png') as Pictures, IFNULL(pd.Cover_Thumb, 'default.png') as Thumbnail";

			$this->db->distinct();
			$products = $this->db
									->select("$select_fields")
									->from(TBL_CLASSES." as p")
									->join(TBL_CLASS_DETAILS." as pd", "p.Class_ID = pd.Class_ID", "left")
									->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = p.Category_ID')
									->where('p.Status', 1)
									->where('p.Is_Linked', 0)
									->where('p.Category_ID', $Category_ID)
									->group_by('p.Class_ID', 'DESC')
									->order_by('p.Class_ID', 'RANDOM')
									->limit(4)
									->get()
									->result();

						foreach ($products as  $product) {
						$product->prices = 		$this->db
												  ->where('pp.Class_ID', $product->Class_ID)
												  ->where('pp.Status', 1)
												  ->where('pp.Unit_ID', $product->Unit_ID)
												  ->join("product_units as pu", "pp.Unit_ID = pu.Unit_ID", "left")
								                  ->join("product_width as pw", "pw.Product_Width_ID = pp.Width", "left")
												  ->get('product_priceperunit as pp')
												  ->result();
					   $product->ProdutsDiscount = $this->get_discount_details($product->Class_ID,'products');
						$product->CategoriesDiscount = $this->get_discount_details($product->Category_ID,'categories');
					}

					return  $products;
									
			//echo $this->db->last_query();						
			//return $products->result();
		}


					public function getLinkedProducts($Products_IDS = array())
		{
			$linked_products = array();

			 foreach ($Products_IDS as $Class_ID) {
			
			$select_fields = "p.*,`pc`.`Slug` as `scSlug`, p.TimeStamp as pTimeStamp, IFNULL(pd.Pictures, 'default.png') as Pictures, IFNULL(pd.Cover_Thumb, 'default.png') as Thumbnail";

			$this->db->distinct();
			$products = $this->db
									->select("$select_fields")
									->from(TBL_CLASSES." as p")
									->join(TBL_CLASS_DETAILS." as pd", "p.Class_ID = pd.Class_ID", "left")
									->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = p.Category_ID')
									->where('p.Status', 1)
									->where('p.Class_ID', $Class_ID)
									->get()
									->result();


						foreach ($products as  $product) {
						$product->prices = 		$this->db
												  ->where('pp.Class_ID', $product->Class_ID)
												  ->where('pp.Status', 1)
												  ->where('pp.Unit_ID', $product->Unit_ID)
												  ->join("product_units as pu", "pp.Unit_ID = pu.Unit_ID", "left")
								                  ->join("product_width as pw", "pw.Product_Width_ID = pp.Width", "left")
												  ->get('product_priceperunit as pp')
												  ->result();
					   $product->ProdutsDiscount = $this->get_discount_details($product->Class_ID,'products');
						$product->CategoriesDiscount = $this->get_discount_details($product->Category_ID,'categories');
					}

		 		array_push($linked_products, $products);

			 }	


			 			return  $linked_products;			
		}
		
		/* -------------------------------------------
		 *----------- Customer Addresses -------------*
		 --------------------------------------------- **/
		 
		 public function addNewCustomerAddress($address = array())
		 {
			 $this->db->insert('customer_delivery_addresses', $address);
			 return $this->db->insert_id();
		 }
		 
		 public function getCustomerAddresses($customer_id = 0, $multiple = false)
		 {
			$address = $this->db->where('Customer_ID', $customer_id)->get('customer_delivery_addresses');
			if($multiple)
			{
				return $address->result();
			}
			
			return $address->row();
		 }
		 
		 public function checkDeliveryZoneOfCustomer($lat = 0, $lng = 0)
		 {	 
			$query = $this->db->query("SELECT * from branches where ST_CONTAINS(DeliveryZone, point({$lng},{$lat}))");
			return $query->row();
		 }
		
		/* -------------------------------------------
			*----------- Order processing -------------*
		 --------------------------------------------- **/
		
		public function getCustomerDetails($customer_id = 0)
		{
			$query = '';
			if($customer_id)
			{
				$query = $this->db->where('Customer_ID', $customer_id)->get(TBL_CUSTOMERS)->result();
				return $query;
			}
			return 0;
		}
		
		public function getGuestDetails($customer_id = 0)
		{
			return $this->db->where('Customer_ID', $customer_id)->get(TBL_CUSTOMERS)->row();
		}
		
		public function getAddressDetails($address_id){
			return $this->db->where('Address_ID', $address_id)->get("customer_delivery_addresses")->row();
		}
		
		public function addOrderHead($data = array())
		{
			$query = $this->db->insert(TBL_ORDERS_HEAD, $data);
			return $this->db->insert_id();
		}
		
		public function addOrderDetails($data = array())
		{
			$query = $this->db->insert(TBL_ORDER_DETAILS, $data);
			return $this->db->insert_id();
		}

		public function updateSaledQuantityStock($order_id = 0){

						$OrderDetails = $this->db
											->select('*')
											->from(TBL_ORDER_DETAILS)
											->where('Order_ID', $order_id)
											->get()
											->result();
											
						foreach ($OrderDetails as $detail) {
							    $this->db->where('PricePerUnit_ID',$detail->PricePerUnit_ID);
							    $this->db->set('Saled_Quantity', "Saled_Quantity +".$detail->Quantity, FALSE);
							    $this->db->update('product_priceperunit'); 
						}
											
			             return true;
		}

		public function modifyOrderHead($data = array())
		{
			if(array_key_exists('Customer_ID', $data)){
				$this->db->where('Customer_ID', $data['Customer_ID']);
			}
			$query = $this->db
							  ->where('Order_ID', $data['Order_ID'])
							  ->update(TBL_ORDERS_HEAD, $data);
			return $data['Order_ID'];
		}
		public function modifyOrderHeadByReferance($data = array())
		{
			if(array_key_exists('Customer_ID', $data)){
				$this->db->where('Customer_ID', $data['Customer_ID']);
			}
			$query = $this->db
							  ->where('Payment_Reference', $data['Order_ID'])
							  ->update(TBL_ORDERS_HEAD, $data);
			return $data['Payment_Reference'];
		}
		
		public function updateOrderStatus($data = array())
		{
			$query = $this->db
							  ->where('Order_ID', $data['Order_ID'])
							  ->update(TBL_ORDERS_HEAD, $data);
			return $this->db->affected_rows();
		}

		public function updatePushNotificationStatus($data = array())
		{
			
			$query = $this->db
							  ->where('Order_ID', $data['Order_ID'])
							  ->update(TBL_ORDERS_HEAD, $data);
		}		
		
		public function getOrderByReferance($referance_payment,$Customer_ID){
		
			$query = $this->db
							->select('oh.*, 
									  c.Fullname, 
									  c.Email, 
									  c.Phone,
									  c.Guest')
									  
							->from(TBL_ORDERS_HEAD.' as oh')
							->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = oh.Customer_ID', 'LEFT')
							->where('oh.Payment_Reference', $referance_payment)
							->where('oh.Customer_ID', $Customer_ID)
							->get();
					
			$order = $query->row();			

			
			$order->OrderDetails = $this->db
											->select("pu.UnitName_en,pu.UnitName_ar,p.*, od.Quantity, od.Price as OrderItemPrice, od.Price,  IFNULL(pd.Pictures, 'default.png') as Pictures, IFNULL(pd.Cover_Thumb, 'default.png') as Thumbnail")
											->from(TBL_ORDER_DETAILS.' as od')
											->join(TBL_CLASSES.' as p', 'p.Class_ID = od.Class_ID')
											->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1', 'left')
											->join('product_units as pu', 'pu.Unit_ID = od.Unit_ID', 'left')
											->where('od.Order_ID', $order->Order_ID)
											->get()
											->result();
											
			return $order;
		}

		public function getOrderDetails($order_id = 0, $customer_id = 0)
		{
			if($customer_id != 0)
			{
				$this->db->where('oh.Customer_ID', $customer_id);	
			}
			
			$query = $this->db
							->select('oh.*, 
									  c.Fullname, 
									  c.Email, 
									  c.Phone,
									  c.Guest')
									  
							->from(TBL_ORDERS_HEAD.' as oh')
							->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = oh.Customer_ID', 'LEFT')
							->where('oh.Order_ID', $order_id)
							->get();
			
			//echo $this->db->last_query();				
			$order = $query->row();
			
			$order->OrderDetails = $this->db
											->select("pu.UnitName_en,pu.UnitName_ar,p.*, od.Quantity, od.Price as OrderItemPrice, od.Price, IFNULL(pd.Pictures, 'default.png') as Pictures, IFNULL(pd.Cover_Thumb, 'default.png') as Thumbnail")
											->from(TBL_ORDER_DETAILS.' as od')
											->join(TBL_CLASSES.' as p', 'p.Class_ID = od.Class_ID')
											->join('product_units as pu', 'pu.Unit_ID = od.Unit_ID', 'left')
											->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1', 'left')
											->where('od.Order_ID', $order_id)
											->get()
											->result();
											
			return $order;
		}
		
		public function getBranchDetails($register_id = '')
		{
			return $this->db->where("Register_ID", $register_id)->get("branches")->row();
		}
		
		/** -------------------------------------------
			*----------- Reviews -------------*
		 *--------------------------------------------- **/
	public function deleteXHRReview($data = array())
	{
		return $this->db->where($data['column'], $data['value'])->delete($data['table']);
	}

	public function SubmitReview($data = array())
	{ 	
		$arr = array(
			'Customer_ID' => $data['Customer_ID'],
			'Class_ID' => $data['Class_ID'],
			'Review' => $data['Review']
		);
		$this->db->insert(TBL_CLASS_REVIEWS, $arr);
		return $this->db->insert_id();
	}

	public function UpdateReview($data = array())
	{
		return $this->db->where('Review_ID', $data['Review_ID'])->update(TBL_CLASS_REVIEWS, $data);
	}
	
	/** -------------------------------------------
		*----------- Rating -------------*
	*--------------------------------------------- **/
	
	public function Get_TotalRating($Class_ID = 0)
	{
		return $this->db->where('Class_ID', $Class_ID)->get(TBL_CLASS_RATING)->num_rows();
	}
	
	public function Get_AvgUserRating($Class_ID = 0)
	{
		$r5 = $this->db->query("SELECT SUM(Rating)/(COUNT(*)) as rating FROM ".TBL_CLASS_RATING." WHERE Class_ID = $Class_ID GROUP BY Class_ID")->result();
		return ceil(@$r5[0]->rating);
	}
	
	public function Get_CurrentProductRatingByCustomer($Class_ID = 0, $customer_id = 0)
	{
		return $this->db->where('Class_ID', $Class_ID)->where('Customer_ID', $customer_id)->get(TBL_CLASS_RATING)->result();
	}
	
	public function SubmitRating($data = array())
	{

		$q = $this->db->where('Class_ID', $data['Class_ID'])->where('Customer_ID', $data['Customer_ID'])->get(TBL_CLASS_RATING);
		if ($q->num_rows() == 0) {
			return $this->db->insert(TBL_CLASS_RATING, $data);
		}
		else
		if ($q->num_rows() == 1) {
			return $this->db->where('Class_ID', $data['Class_ID'])->where('Customer_ID', $data['Customer_ID'])->update(TBL_CLASS_RATING, $data);
		}

		return 0;
	}
	
	/** -------------------------------------------
		*----------- Whishlist -------------*
	*--------------------------------------------- **/
	
	public function checkInCustomerWhishlist($Class_ID = 0, $customer_id = 0){
		$query = $this->db
						->where('Class_ID', $Class_ID)
						->where('Customer_ID', $customer_id)
						->get(TBL_CLASSES_WISHLIST);
		return $query->num_rows();
	}
	
	public function addProductToWhislist($customer_id = 0, $Class_ID = 0){
		$data = array(
			'Customer_ID' => $customer_id,
			'Class_ID' => $Class_ID
		);
		
		//check if present then delete it
		$check = $this->db->where($data)->get(TBL_CLASSES_WISHLIST)->num_rows();
		if($check){
			
			// delete it
			$this->db->where($data)->delete(TBL_CLASSES_WISHLIST);
			return 0;
		}
		
		$this->db->insert(TBL_CLASSES_WISHLIST, $data);
		return $this->db->affected_rows();
	}

		public function removeProductfromWhislist($customer_id = 0, $Class_ID = 0){
		$data = array(
			'Customer_ID' => $customer_id,
			'Class_ID' => $Class_ID
		);
		

			// delete it
			$this->db->where($data)->delete(TBL_CLASSES_WISHLIST);
			return true;
		

	}
	
	
	
	public function addProductViews($Class_ID = 0, $ip_address = ''){
		return $this->db->insert(TBL_CLASS_VIEWS, array('Class_ID' => $Class_ID, 'IP_Address' => $ip_address));
	}
	
	/** -------------------------------------------
		*----------- APIS Log -------------*
	*--------------------------------------------- **/
	
	public function addAPISLog($log = array())
	{
		$this->db->insert('apis_log', $log);
	}
		
	
	public function registerCustomer($customer = array()){
		$cus = $this->db->where('Email', $customer['Email'])->get('customers')->row();
		if(count($cus) > 0){
			return $cus->Customer_ID;
		}
		
		$this->db->insert('customers', $customer);
		return $this->db->insert_id();
	}
}
?>
