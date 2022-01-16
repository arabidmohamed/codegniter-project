<?PHP
	class Events_model extends CI_Model{
        
        	/*-----------------------------------------------------------
		---------------------- CATEGORIES Section -----------------
		--------------------------------------------------------*/
	
		// #Add category function
			public function addCategory($data = array()){
				$this->db->insert(TBL_EVENTS_CATEGORIES, $data);
				return  $this->db->insert_id();
			}
			
			// #get Category function
			public function getCategories($data = array()){
				$query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_EVENTS_CATEGORIES);
				return $query->result();
			}
			
			// #get Category function
		    public function getActiveCategories($data = null)
		    {
		        $this->db->where(array(
		            'Status' => 1
		        ));
		        $query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_EVENTS_CATEGORIES);
		        return $query->result();
		    }
			
			// #get Category By ID function
			public function getCategoryByID($data = array()){
				$where = array('Category_ID' => $data['category_id']);
				$this->db->where($where);
				$query = $this->db->get(TBL_EVENTS_CATEGORIES);
				return $query->result();
			}
			
			// #update Category function 
			public function updateCategory($data = array()){
				$where = array('Category_ID' => $data['Category_ID']);
				$this->db->where($where);
				$query = $this->db->update(TBL_EVENTS_CATEGORIES, $data);
				return $query;
	
			}
			
			// #delete Category function 
			public function deleteCategory($data = array()){
				$where = array('Category_ID' => $data['category_id']);
				$this->db->where($where);
				$query = $this->db->delete(TBL_EVENTS_CATEGORIES);
				return $query;
	
			}
			
			/*-----------------------------------------------------------
		---------------------- SUBCATEGORIES Section -----------------
		--------------------------------------------------------*/
	
		// #Add category function
		public function addSubCategory($data = array()){
			$this->db->insert(TBL_EVENTS_SUBCATEGORIES, $data);
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
							->from(TBL_EVENTS_SUBCATEGORIES.' as psc')
							->join(TBL_EVENTS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID')
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
							->from(TBL_EVENTS_SUBCATEGORIES.' as psc')
							->join(TBL_EVENTS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID')
							->order_by('Order_In_List', 'asc')
							->get();
							
			return $query->result();
	    }
		
		// #get Category By ID function
		public function getSubCategoryByID($data = array()){
			$where = array('SubCategory_ID' => $data['subcategory_id']);
			$this->db->where($where);
			$query = $this->db->get(TBL_EVENTS_SUBCATEGORIES);
			return $query->result();
		}
		
		// #update Category function 
		public function updateSubCategory($data = array()){
			$where = array('SubCategory_ID' => $data['SubCategory_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_EVENTS_SUBCATEGORIES, $data);
			return $query;

		}
		
		// #delete Category function 
		public function deleteSubCategory($data = array()){
			$where = array('SubCategory_ID' => $data['subcategory_id']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_EVENTS_SUBCATEGORIES);
			return $query;

		}
		
		public function deleteSubCategoriesByCategory($category_id = 0){
			$where = array('Category_ID' => $category_id);
			$this->db->where($where);
			$query = $this->db->delete(TBL_EVENTS_SUBCATEGORIES);
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
							->get(TBL_EVENTS_SUBCATEGORIES);
			return $query->result();
		}

		public function getHistory($id = 0){
			
			$totalBookings = "(SELECT COUNT(*) FROM ".TBL_EVENTS_BOOKINGS." WHERE Event_ID = $id) as TotalBookings";
            //$totalSales = "(SELECT SUM(Price) FROM ".TBL_EVENTS_BOOKINGS." WHERE Event_ID = $id) as TotalSales";
            $totalViews = "(SELECT COUNT(*) FROM ".TBL_EVENTS_VIEWS." WHERE Event_ID = $id) as TotalViews";
			
			$event = $this->db
							->select("e.*, el.Address, psc.SubCategory_en, psc.SubCategory_ar, pc.Category_en, pc.Category_ar, {$totalBookings}, {$totalViews}")
                            ->from(TBL_EVENTS." as e")
                            ->join(TBL_EVENTS_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = e.SubCategory_ID')
                            ->join(TBL_EVENTS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID')
                            ->join(TBL_EVENTS_LOCATIONS.' as el', 'el.Event_ID = e.Event_ID', 'left')
							->join('event_views as pv', 'pv.Event_ID = e.Event_ID', 'left')
                            ->join(TBL_EVENTS_BOOKINGS.' as od', 'od.Event_ID = e.Event_ID', 'left')
							->where('e.Event_ID', $id)
							->get()
							->result();
							
/*
			echo $this->db->last_query();
			die();
*/
			// get product details
			foreach($event as $pd){
				$pd->Pictures = $this->db
													->select('pd.*')
													->from(TBL_EVENTS_PICS.' as pd')
													->join(TBL_EVENTS.' as p', 'p.Event_ID = pd.Event_ID')
													->where('pd.Event_ID', $id)
													->get()
													->result();
			}										
			return $event[0];
        }
        
        public function Get_TotalRated($id = 0)
		{
			return $this->db->where('Event_ID', $id)->get(TBL_EVENTS_RATING)->num_rows();
		}
	
		public function Get_AvgRating($id = 0)
		{
			$r5 = $this->db->query("SELECT SUM(Rating)/(COUNT(*)) as rating FROM ".TBL_EVENTS_RATING." WHERE Event_ID = $id GROUP BY Event_ID")->result();
			return ceil(@$r5[0]->rating);
		}
		
	    public function add($data = array())
	    {
	        $query = $this->db->insert(TBL_EVENTS, $data);
	        return $this->db->insert_id();
        }
	    
	    public function getByID($data = '')
	    {
	        $where = array(
	            'Event_ID' => $data['id']
	        );
	        $this->db->where($where);
	        $query = $this->db->get(TBL_EVENTS);
	        return $query->result();
	    }
	    
	    public function update($data = '')
	    {
	        $where = array(
	            'Event_ID' => $data['Event_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->update(TBL_EVENTS, $data);
	        return $query;	        
	    }
	    
	    public function delete($data = array())
	    {
	        $where = array(
	            'Event_ID' => $data['Event_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete(TBL_EVENTS);
	        if ($query) {
	            $where1 = array(
	                'Event_ID' => $data['Event_ID']
	            );
	            $this->db->where($where1);
	            $query1 = $this->db->delete(TBL_EVENTS_PICS);
	            return $query;
	        }
	        
        }
        
    /*-----------------------------------------------------------
		---------------------- #Locations -----------------
		--------------------------------------------------------*/

        public function addLocations($locations = array())
		{
			$this->db->where('Event_ID', $locations['Event_ID'])->delete(TBL_EVENTS_LOCATIONS);
			
			$this->db->insert(TBL_EVENTS_LOCATIONS, $locations);
			return $this->db->insert_id();
		}
		
		public function getLocationsByID($data = '')
	    {
	        $where = array(
	            'Event_ID' => $data['id']
	        );
	        $this->db->where($where);
	        $query = $this->db->get(TBL_EVENTS_LOCATIONS);
	        return $query->result();
        }
        

    /*-----------------------------------------------------------
		---------------------- #Pictures -----------------
		--------------------------------------------------------*/

        public function getDetails($data = '')
	    {
	        $where = array(
	            'Event_ID' => $data['id']
	        );
	        $this->db->where($where);
	        $this->db->order_by('Order_In_List', 'asc');
	        $query = $this->db->get(TBL_EVENTS_PICS);
	        return $query->result();
	    }

	    public function getImages($data = array()){
		    $where = array(
	            'Event_ID' => $data['Event_ID']
	        );
	       return $this->db->select('Pictures, Cover_Thumb')->from(TBL_EVENTS_PICS)->where($where)->get()->result();
	    }
	    
	    public function getDetImages($data = array()){
		    $where = array(
	            'PD_ID' => $data['id']
	        );
	       return $this->db->select('Pictures, Cover_Thumb')->from(TBL_EVENTS_PICS)->where($where)->get()->result();
	    }

        public function addDetails($data = array())
	    {
	        $query = $this->db->insert(TBL_EVENTS_PICS, $data);
	        return $this->db->insert_id();
	    }
	    
	    public function updateDetails_ARR($data = array())
	    {
	        $upd = array(
	            'Event_ID' => $data['Event_ID']
	        );
	        $i = 0;
	        foreach ($data["PD_ID"] as $id) {
		        $where = array(
	                'PD_ID' => $id
	            );
		        if($i == 0){
			        $this->db->where($where);
			        $d['Event_ID'] = $data['Event_ID'];
			        $d['Cover_Thumb'] = $data['Cover_Thumb'];
			        $d['Is_Cover'] = 1;
					$query = $this->db->update(TBL_EVENTS_PICS, $d);
					$i++;
		        } else {
		            $this->db->where($where);
		            $query = $this->db->update(TBL_EVENTS_PICS, $upd);
		            $i++;
		        }
	        }
	        return $query;
	    }
	    
	    public function getPDFirstImg($id = 0){
		   return $this->db->where('PD_ID', $id)
		    		 ->get(TBL_EVENTS_PICS)->result();
	    }
	    
	    public function PDSetDefaults($id){
		    $data = array(
			    'Is_Cover' => 0,
			    'Cover_Thumb' => ''
		    );
		    return $this->db->where('Event_ID', $id)
		    		 ->update(TBL_EVENTS_PICS, $data);
	    }
	    
	    // #update trip details
	    public function updateDetails($data = array())
	    {
	        $where = array(
	            'PD_ID' => $data['PD_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->update(TBL_EVENTS_PICS, $data);
	        return $query;
	    }
	    
	    public function getCoverBool($id = 0){
		   return $this->db
		   				->where('Event_ID', $id)
		   				->where('Is_Cover', 1)
		   				->get(TBL_EVENTS_PICS)->result();
	    }
	    
	    public function getDetailsImagesForCover($id = 0){
		   return $this->db
		   				->where('Event_ID', $id)
		   				->where('Is_Cover', 0)
		   				->get(TBL_EVENTS_PICS)->result();
	    }
	    
	    // #delete project details function 
	    public function deleteDetail($data = null)
	    {
	        $where = array(
	            'PD_ID' => $data['id']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete(TBL_EVENTS_PICS);
	        return $query;
	        
	    }
	    
	    public function getPDImageName($id){
			return $this->db->where('PD_ID', $id)->get(TBL_EVENTS_PICS)->result()[0]->Pictures;
		}
		
		public function deletePDImage($id){
			return $this->db->where('PD_ID', $id)->delete(TBL_EVENTS_PICS);
		}
		
		
		
	/*-----------------------------------------------------------
		---------------------- #Slider -----------------
		--------------------------------------------------------*/
		
		
		public function addSlider($data = array())
	    {
	        $query = $this->db->insert(TBL_EVENTS_SLIDER, $data);
	        return $this->db->insert_id();
	    }
	    
	    public function getSlides($data = '')
	    {
	        $where = array(
	            'Event_ID' => $data['id']
	        );
	        $this->db->where($where);
	        $this->db->order_by('Order_In_List', 'asc');
	        $query = $this->db->get(TBL_EVENTS_SLIDER);
	        return $query->result();
	    }
	    
	    public function getSlideImage($data = array()){
		    $where = array(
	            'ESlider_ID' => $data['slider_id']
	        );
	       return $this->db->select('Slider')->from(TBL_EVENTS_SLIDER)->where($where)->get()->result();
	    }
	    
	    // #delete project details function 
	    public function deleteSlide($data = null)
	    {
	        $where = array(
	            'ESlider_ID' => $data['slider_id']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete(TBL_EVENTS_SLIDER);
	        return $query;
	        
	    }
	    
	    public function updateSlider_ARR($data = array())
	    {
	        $upd = array(
	            'Event_ID' => $data['Event_ID']
	        );
	        $i = 0;
	        foreach ($data["ESlider_ID"] as $id) {
		        $where = array(
	                'ESlider_ID' => $id
	            );
		        
	            $this->db->where($where);
	            $query = $this->db->update(TBL_EVENTS_SLIDER, $upd);
	            $i++;
	            
	        }
	        return $query;
	    }
	    
	    public function getPDSliderName($id){
			return $this->db->where('ESlider_ID', $id)->get(TBL_EVENTS_SLIDER)->result()[0]->Slider;
		}
		
		public function deletePDSlider($id){
			return $this->db->where('ESlider_ID', $id)->delete(TBL_EVENTS_SLIDER);
		}	
        
        

   /*-----------------------------------------------------------
		---------------------- #Events List -----------------
		--------------------------------------------------------*/
    
	var $order_columns_1  = array('p.Event_ID', 'p.Created_At', '', 'p.Title_en', 'l.Address', 'p.From_Date', 'p.To_Date');
	private function _get_query()
	{
		
        $where_to_date = '';
        $where_title = '';
        $where_from_date = '';
        
        if(!empty($_POST['title'])){
            $title = $_POST['title'];
            $where_title = "(p.Title_en LIKE '%$title%' OR p.Title_ar LIKE '%$title%') AND";
        }
        
        if(!empty($_POST['from_date']))
        {
            $from_date = $_POST['from_date'];
            $where_from_date = "p.From_Date >= DATE_FORMAT(STR_TO_DATE('$from_date', '%d-%m-%Y'), '%Y-%m-%d') AND";
        }
        
        if(!empty($_POST['to_date']))
        {
            $to_date = $_POST['to_date'];
            $where_to_date = "p.To_Date <= DATE_FORMAT(STR_TO_DATE('$to_date', '%d-%m-%Y'), '%Y-%m-%d') AND";
        }
        
        $where = "$where_from_date $where_to_date $where_title p.Status >= 0";
        
        $this->db->distinct();
        $this->db->select('p.*, l.Address, pd.Cover_Thumb as Thumbnail'); 
		$this->db->from(TBL_EVENTS.' AS p');
		$this->db->join(TBL_EVENTS_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = p.SubCategory_ID');
		$this->db->join(TBL_EVENTS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID');
        $this->db->join(TBL_EVENTS_PICS.' as pd', 'pd.Event_ID = p.Event_ID', 'left');
        $this->db->join(TBL_EVENTS_LOCATIONS.' as l', 'l.Event_ID = p.Event_ID', 'left');
        $this->db->where($where);
        $this->db->group_by('p.Event_ID');
        
        //print_r($_POST['order']);
        if(isset($_POST['order'])){
            $ind = $_POST['order'][0]['column'];
            $oColumn = $this->order_columns_1[$ind];
            $direction = $_POST['order'][0]['dir'];
            $where_order = "$oColumn $direction";
            $this->db->order_by($where_order);
        } else {
            $this->db->order_by("a.Event_ID", "DESC");
        }
    }
 
    function getDataList()
    {
        $this->_get_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function dataCount_filtered()
    {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function dataCount_all()
    {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
	}
	
 	/*-----------------------------------------------------------
		---------------------- #Bookings -----------------
		--------------------------------------------------------*/
	public function getBookingByID($booking_id = 0){
	    $bookings = $this->db
	    				->select('oh.Booking_ID, oh.OrderTotal_Price, oh.Address_Optional, oh.TimeStamp, oh.Order_Status, c.Fullname, c.Phone, c.Address, 0 as OrderDetails')
	    				->from(TBL_ORDERS_HEAD.' as oh')
	    				->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = oh.Customer_ID')
	    				->where('oh.Booking_ID', $booking_id)
	    				->get()
	    				->result();
	    								
	    // get order details
	    foreach($bookings as $booking){
		    
		    $booking_id = $booking->Booking_ID;
		    $booking->BookingDetails = $this->db
		    								->select('od.Quantity, od.Price, od.Class_ID, p.Title_en, p.Title_ar')
		    								->from(TBL_ORDER_DETAILS.' as od')
		    								->join(TBL_CLASSES.' as p', 'p.Class_ID = od.Class_ID')
		    								->where('od.Booking_ID', $booking_id)
		    								->get()
		    								->result();
	    } // end foreach
	    
	    return @$bookings[0];   
    }
    
    
    public function changeOrderStatus($data = array(), $Class_IDs = '', $qty = ''){
	    $booking_id = $data['Booking_ID'];
	    $upd = $this->db->where('Booking_ID', $booking_id)->update(TBL_ORDERS_HEAD, $data);
	    $upd = $this->db->affected_rows();
	    if($upd){
		    $status = $data['Order_Status'];
		    if($status == 'Delivered'){
			    // decrease quantity from product
			    $i = 0;
			    foreach($Class_IDs as $id){
				    $quantity = $qty[$i];
				    $this->db->query("UPDATE ".TBL_CLASSES." SET Quantity = Quantity - $quantity WHERE Class_ID = $id");
			    }
/*
			    echo $this->db->last_query();
			    die();
*/
		    }
		    
	    }
	    
	    return 1;
    }

	var $booking_columns_1  = array('b.Booking_ID', 'b.Created_At', 'c.Fullname', 'c.Phone', 'b.Order_Status', 'b.Customer_ID');
	private function _get_bookings_query()
	{
		$where_order_no = '';
		$where_mobile_no = '';
		$where_status = '';
		$where_name = '';
		$where_category = '';
		$where_subcategory = '';
		$where_customer = '';
		
		if(!empty($_POST['booking_no'])){
			$id = $_POST['booking_no'];
			$where_order_no = "b.Booking_ID = $id AND";
		}

		if(!empty($_POST['customer_id'])){
			$id = $_POST['customer_id'];
			$where_customer = "b.Customer_ID = $id AND";
		}
		
		if(!empty($_POST['mobile_no'])){
			$phone = $_POST['mobile_no'];
			$where_mobile_no = "c.Phone = '$phone' AND";
		}
		
		if(!empty($_POST['name'])){
			$name = $_POST['name'];
			$where_name = "c.Fullname LIKE '%$name%' AND";
		}
		
		// if($_POST['status'] != -1){
		// 	$status = $_POST['status'];
		// 	$where_status = "b.Booking_Status = '$status' AND";
		// }
		
		$where = "{$where_order_no} {$where_customer} {$where_mobile_no} {$where_name} {$where_status} {$where_category} {$where_subcategory} c.Phone >= 0";
		
		$this->db->distinct();
		$this->db->select('b.*, c.Fullname, c.Phone'); 
		$this->db->from(TBL_EVENTS_BOOKINGS." AS b");
		$this->db->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = b.Customer_ID');
		$this->db->where($where);
		
		//print_r($_POST['order']);
		if(isset($_POST['order'])){
			$ind = $_POST['order'][0]['column'];
			$oColumn = $this->booking_columns_1[$ind];
			$direction = $_POST['order'][0]['dir'];
			$where_order = "$oColumn $direction";
			$this->db->order_by($where_order);
		} else {
			$this->db->order_by("b.Booking_ID", "DESC");
		}
    }
 
    function getBookingsList()
    {
        $this->_get_bookings_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function bookingsCount_filtered()
    {
        $this->_get_bookings_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function bookingsCount_all()
    {
        $this->_get_bookings_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

}

?>