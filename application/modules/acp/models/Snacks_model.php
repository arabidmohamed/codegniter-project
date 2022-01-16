<?PHP
	class Snacks_model extends CI_Model{
		
			/*-----------------------------------------------------------
		---------------------- Product CATEGORIES Section -----------------
		--------------------------------------------------------*/
	
		// #Add category function
			public function addCategory($data = array()){
				$this->db->insert(TBL_CLASS_CATEGORIES_SNACKS, $data);
				return  $this->db->insert_id();
			}
			
			// #get Category function
			public function getCategories($data = array()){
				$query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_CLASS_CATEGORIES_SNACKS);
				return $query->result();
			}
			
			// #get Category function
		    public function getActiveCategories($data = null)
		    {
		        $this->db->where(array(
		            'Status' => 1
		        ));
		        $query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_CLASS_CATEGORIES_SNACKS);
		        return $query->result();
		    }
			
			// #get Category By ID function
			public function getCategoryByID($data = array()){
				$where = array('Category_ID' => $data['category_id']);
				$this->db->where($where);
				$query = $this->db->get(TBL_CLASS_CATEGORIES_SNACKS);
				return $query->result();
			}
			
			// #update Category function 
			public function updateCategory($data = array()){
				$where = array('Category_ID' => $data['Category_ID']);
				$this->db->where($where);
				$query = $this->db->update(TBL_CLASS_CATEGORIES_SNACKS, $data);
				return $query;
	
			}
			
			// #delete Category function 
			public function deleteCategory($data = array()){
				$where = array('Category_ID' => $data['category_id']);
				$this->db->where($where);
				$query = $this->db->delete(TBL_CLASS_CATEGORIES_SNACKS);
				return $query;
	
			}
			
			/*-----------------------------------------------------------
		---------------------- Product SUBCATEGORIES Section -----------------
		--------------------------------------------------------*/
	
		// #Add category function
		public function addSubCategory($data = array()){
			$this->db->insert(TBL_CLASS_SUBCATEGORIES_SNACKS, $data);
			return  $this->db->insert_id();
		}
		
		// #get Category function
		public function getSubCategories($categoryid = 0)
		{
			if($categoryid != 0)
			{
				$this->db->where('psc.Category_ID', $categoryid);
			}
			
			$query = $this->db
							->select('psc.*')
							->from(TBL_CLASS_SUBCATEGORIES_SNACKS.' as psc')
							->join(TBL_CLASS_CATEGORIES_SNACKS.' as pc', 'pc.Category_ID = psc.Category_ID')
							->order_by('Order_In_List', 'asc')
							->get();
			return $query->result();
		}
		
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
							->from(TBL_CLASS_SUBCATEGORIES_SNACKS.' as psc')
							->join(TBL_CLASS_CATEGORIES_SNACKS.' as pc', 'pc.Category_ID = psc.Category_ID')
							->order_by('Order_In_List', 'asc')
							->get();
							
			return $query->result();
	    }
		
		// #get Category By ID function
		public function getSubCategoryByID($data = array()){
			$where = array('SubCategory_ID' => $data['subcategory_id']);
			$this->db->where($where);
			$query = $this->db->get(TBL_CLASS_SUBCATEGORIES_SNACKS);
			return $query->result();
		}
		
		// #update Category function 
		public function updateSubCategory($data = array()){
			$where = array('SubCategory_ID' => $data['SubCategory_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_CLASS_SUBCATEGORIES_SNACKS, $data);
			return $query;

		}
		
		// #delete Category function 
		public function deleteSubCategory($data = array()){
			$where = array('SubCategory_ID' => $data['subcategory_id']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_CLASS_SUBCATEGORIES_SNACKS);
			return $query;

		}
		
		public function deleteSubCategoriesByCategory($category_id = 0){
			$where = array('Category_ID' => $category_id);
			$this->db->where($where);
			$query = $this->db->delete(TBL_CLASS_SUBCATEGORIES_SNACKS);
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
							->get(TBL_CLASS_SUBCATEGORIES_SNACKS);
			return $query->result();
		}
			
			/*-----------------------------------------------------------
		---------------------- Products Section -----------------
		--------------------------------------------------------*/
		
		public function getAllWeightUnits(){
			return $this->db->order_by('Order_In_List', 'ASC')->get(TBL_CLASS_UNITS)->result();
		}
		
		
		
		
		public function Get_TotalRatedProduct($Class_ID = 0)
		{
			return $this->db->where('Class_ID', $Class_ID)->get(TBL_CLASS_RATING)->num_rows();
		}
	
		public function Get_AvgProductRating($Class_ID = 0)
		{
			$r5 = $this->db->query("SELECT SUM(Rating)/(COUNT(*)) as rating FROM ".TBL_CLASS_RATING." WHERE Class_ID = $Class_ID GROUP BY Class_ID")->result();
			return ceil(@$r5[0]->rating);
		}
		
		public function getProductHistory($Class_ID = 0){
			
			$totalOrders = "(SELECT COUNT(*) FROM ".TBL_ORDER_DETAILS." WHERE Class_ID = $Class_ID) as TotalOrders";
			$totalViews = "(SELECT COUNT(*) FROM ".TBL_CLASS_REVIEWS." WHERE Class_ID = $Class_ID) as TotalViews";
			$totalSales = "(SELECT SUM(Price) FROM ".TBL_ORDER_DETAILS." WHERE Class_ID = $Class_ID) as TotalSales";
			
			$product = $this->db
							->select("p.*, ppu.Price, pu.UnitName_en, pu.UnitName_ar, psc.SubCategory_en, psc.SubCategory_ar, pc.Category_en, pc.Category_ar, $totalOrders, $totalViews, $totalSales, 0 as ProductPictures")
							->from(TBL_CLASSES_SNACKS." as p")
							->join(TBL_Class_PRICE_PERUNIT.' as ppu', 'ppu.Class_ID = p.Class_ID')
							->join(TBL_CLASS_UNITS.' as pu', 'pu.Unit_ID = pu.Unit_ID')
							->join(TBL_CLASS_SUBCATEGORIES_SNACKS.' as psc', 'psc.SubCategory_ID = p.SubCategory_ID')
							->join(TBL_CLASS_CATEGORIES_SNACKS.' as pc', 'pc.Category_ID = psc.Category_ID')
							->join(TBL_ORDER_DETAILS.' as od', 'od.Class_ID = p.Class_ID', 'left')
							->join(TBL_CLASS_VIEWS.' as pv', 'pv.Class_ID = p.Class_ID', 'left')
							->where('p.Class_ID', $Class_ID)
							->get()
							->result();
							
/*
			echo $this->db->last_query();
			die();
*/
			// get product details
			foreach($product as $pd){
				$pd->ProductPictures = $this->db
													->select('pd.*')
													->from(TBL_CLASS_DETAILS_SNACKS.' as pd')
													->join(TBL_CLASSES_SNACKS.' as p', 'p.Class_ID = pd.Class_ID')
													->where('pd.Class_ID', $Class_ID)
													->get()
													->result();
			}										
			return $product[0];
		}
		
		
		
		
		
		
	    public function addProduct($data = array())
	    {
	        $query = $this->db->insert(TBL_CLASSES_SNACKS, $data);
	        return $this->db->insert_id();
	    }
	    
	    public function addProductPerUnitPrice($data = array()){
		    $query = $this->db->insert(TBL_Class_PRICE_PERUNIT, $data);
	        return $this->db->insert_id();
	    }
	    
	    public function addProductDetails($data = array())
	    {
	        $query = $this->db->insert(TBL_CLASS_DETAILS_SNACKS, $data);
	        return $this->db->insert_id();
	    }
	    
	    public function getProductPageName(){
		    return $this->db
		    				->select('*')
		    				->from(TBL_SECTIONS.' as s')
		    				->where('s.Section_ID = 11')
		    				->get()
		    				->result();
	    }
	    
	    public function updateProductDetails_ARR($data = array())
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
					$query = $this->db->update(TBL_CLASS_DETAILS_SNACKS, $d);
					$i++;
		        } else {
		            $this->db->where($where);
		            $query = $this->db->update(TBL_CLASS_DETAILS_SNACKS, $upd);
		            $i++;
		        }
	        }
	        return $query;
	    }
	    
	    public function getPDFirstImg($id = 0){
		   return $this->db->where('PD_ID', $id)
		    		 ->get(TBL_CLASS_DETAILS_SNACKS)->result();
	    }
	    
	    public function PDSetDefaults($id){
		    $data = array(
			    'Is_Cover' => 0,
			    'Cover_Thumb' => ''
		    );
		    return $this->db->where('Class_ID', $id)
		    		 ->update(TBL_CLASS_DETAILS_SNACKS, $data);
	    }
	    
	    public function getProductCoverBool($id = 0){
		   return $this->db
		   				->where('Class_ID', $id)
		   				->where('Is_Cover', 1)
		   				->get(TBL_CLASS_DETAILS_SNACKS)->result();
	    }
	    
	    public function getProductDetailsImagesForCover($id = 0){
		   return $this->db
		   				->where('Class_ID', $id)
		   				->where('Is_Cover', 0)
		   				->get(TBL_CLASS_DETAILS_SNACKS)->result();
	    }
	    
	    // #get project by id 
	    public function getProductByID($data = '')
	    {
	        $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->get(TBL_CLASSES_SNACKS);
	        return $query->result();
	    }
	    
	    public function getProductPricePerUnit($data = ''){
		    $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->get(TBL_Class_PRICE_PERUNIT);
	        return $query->result();
	    }
	    
	    // #get project detail
	    public function getProductDetails($data = '')
	    {
	        $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        $this->db->where($where);
	        $this->db->order_by('Order_In_List', 'asc');
	        $query = $this->db->get(TBL_CLASS_DETAILS_SNACKS);
	        return $query->result();
	    }
	    
	    // #get project details by id
	    public function getProductDetailByID($data = '')
	    {
	        $where = array(
	            'PD_ID' => $data['productDet_id']
	        );
	        $this->db->where($where);
	        $query = $this->db->get(TBL_CLASS_DETAILS_SNACKS);
	        return $query->result();
	    }
	    
	    // #update project function 
	    public function updateProduct($data = '')
	    {
	        $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->update(TBL_CLASSES_SNACKS, $data);
	        return $query;
	        
	    }
	    
	    public function updateProductPerUnitPrice($data = ''){
		     $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->update(TBL_Class_PRICE_PERUNIT, $data);
	        return $query;
	    }
	    
	    // #update project details
	    public function updateProductDetails($data = array())
	    {
	        $where = array(
	            'PD_ID' => $data['PD_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->update(TBL_CLASS_DETAILS_SNACKS, $data);
	        return $query;
	    }
	    
	    public function getProductImages($data = array()){
		    $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	       return $this->db->select('Pictures, Cover_Thumb')->from(TBL_CLASS_DETAILS_SNACKS)->where($where)->get()->result();
	    }
	    
	    public function getProductDetImages($data = array()){
		    $where = array(
	            'PD_ID' => $data['productDet_ID']
	        );
	       return $this->db->select('Pictures, Cover_Thumb')->from(TBL_CLASS_DETAILS_SNACKS)->where($where)->get()->result();
	    }
	    
	    // #delete project function 
	    public function deleteProduct($data = array())
	    {
	        $where = array(
	            'Class_ID' => $data['Class_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete(TBL_CLASSES_SNACKS);
	        if ($query) {
	            $where1 = array(
	                'Class_ID' => $data['Class_ID']
	            );
	            $this->db->where($where1);
	            $query1 = $this->db->delete(TBL_CLASS_DETAILS_SNACKS);
	            return $query;
	        }
	        
	    }
	    
	    // #delete project details function 
	    public function deleteProductDetail($data = null)
	    {
	        $where = array(
	            'PD_ID' => $data['productDet_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete(TBL_CLASS_DETAILS_SNACKS);
	        return $query;
	        
	    }
	    
	    public function getPDImageName($id){
				return $this->db->where('PD_ID', $id)->get(TBL_CLASS_DETAILS_SNACKS)->result()[0]->Pictures;
			}
			
			public function deletePDImage($id){
				return $this->db->where('PD_ID', $id)->delete(TBL_CLASS_DETAILS_SNACKS);
			}
			
		//for excel
		public function getAllProducts_Excel(){
			return $this->db
							->select('p.Class_ID,c.Category_en, c.Category_ar, p.Title_en, p.Title_ar, p.Quantity, p.Price, p.TimeStamp')
							->from(TBL_CLASSES_SNACKS.' as p')
							->join(TBL_CLASS_CATEGORIES_SNACKS.' as c', 'c.Category_ID = p.Category_ID')
							->order_by("Class_ID", "DESC")
							->get()
							->result();
		}
		
		//for Csv
		public function getAllProducts_Csv(){
			return $this->db
							->select('p.Class_ID,c.Category_en, c.Category_ar, p.Title_en, p.Title_ar, p.Quantity, p.Price, p.TimeStamp')
							->from(TBL_CLASSES_SNACKS.' as p')
							->join(TBL_CLASS_CATEGORIES_SNACKS.' as c', 'c.Category_ID = p.Category_ID')
							->order_by("Class_ID", "DESC")
							->get();
		}
		
}

?>