<?PHP
    class Events_model extends CI_Model
    {
		
        // get active categories
		public function getCategories()
		{
			$query = $this->db
							->distinct()
							->select('pc.*')
							->from(TBL_EVENTS_CATEGORIES.' as pc')
                            ->join(TBL_EVENTS_SUBCATEGORIES.' as psc', 'psc.Category_ID = pc.Category_ID')
                            ->join(TBL_EVENTS.' as p', 'p.SubCategory_ID = psc.SubCategory_ID')
                            ->where('psc.Status', 1)
                            ->where('p.Status', 1)
							->order_by('pc.Order_In_List', 'ASC')
							->get();
			
							// echo $this->db->last_query(); die();
			return $query->result();
		}
        
        public function getSubCategories($category_slug = '', $subcategory_slug = '')
        {
            if(!empty($category_slug))
            {
				$this->db->where('pc.CSlug', $category_slug);
			}
			
			if(!empty($subcategory_slug))
            {
				$this->db->where('psc.SCSlug', $subcategory_slug);
			}
            
			$query = $this->db
							->distinct()
							->select('pc.CSlug, pc.Category_en, pc.Category_ar, pc.Icon as categoryIcon, psc.*')
							->from(TBL_EVENTS_SUBCATEGORIES.' as psc')
                            ->join(TBL_EVENTS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID')
                            ->join(TBL_EVENTS.' as p', 'p.SubCategory_ID = psc.SubCategory_ID')
                            ->where('psc.Status', 1)
                            ->where('p.Status', 1)
							->order_by('psc.Order_In_List', 'ASC')
							->get();
			
							// echo $this->db->last_query(); die();
			return $query->result();
		}

		public function EventsList($limitStart, $limit)
		{
			$select_fields = "p.*, p.TimeStamp as pTimeStamp, pd.Cover_Thumb, psc.SCSlug, psc.SubCategory_en, psc.SubCategory_ar, pc.CSlug, pc.Category_en, pc.Category_ar, pd.Cover_Thumb as Thumbnail";
        
			$this->db->distinct();
			$events = $this->db
									->select("$select_fields")
									->from(TBL_EVENTS." as p")
									->join(TBL_EVENTS_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = p.SubCategory_ID')
									->join(TBL_EVENTS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID')
									->join(TBL_EVENTS_PICS." as pd", "p.Event_ID = pd.Event_ID", "left")
									->group_by('p.Event_ID', 'DESC')
									->order_by('p.Event_ID', 'DESC')
									->limit($limit)
									->get();
			
			return $events->result();
		}
		
		public function getDetailsByID($event_slug = ''){
			$data = $this->db
								->distinct()
								->select("p.*, pc.CSlug, psc.SCSlug, p.TimeStamp as pTimeStamp, l.Address, l.Latitude, l.Longitude, pc.Category_en, pc.Category_ar, psc.SubCategory_en, psc.SubCategory_ar")
								->from(TBL_EVENTS." as p")
								->join(TBL_EVENTS_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = p.SubCategory_ID')
								->join(TBL_EVENTS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID')
								->join(TBL_EVENTS_LOCATIONS.' as l', 'l.Event_ID = p.Event_ID', 'LEFT')
								->where('p.Slug', $event_slug)
								->where('p.Status', 1)
								->get()
								->row();
			
			$id = @$data->Event_ID;

			// get event details
			$data->Pictures = $this->db
												  ->where('Event_ID', $id)
												  ->get(TBL_EVENTS_PICS)
												  ->result();
												  
			// get event details
			$data->Slider = $this->db
												  ->where('Event_ID', $id)
												  ->order_by('Order_In_List', 'ASC')
												  ->get(TBL_EVENTS_SLIDER)
												  ->result();

			// get product reviews
			$data->Reviews = $this->db
												  ->select('r.*, c.Fullname')
												  ->from(TBL_EVENTS_REVIEWS.' as r')
												  ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = r.Customer_ID')
												  ->where('r.Event_ID', $id)
												  ->get()
												  ->result();
			
			return $data;
								
		}
		
		/** -------------------------------------------
		 * ----------- Childrens ------------- *
		 *--------------------------------------------- **/
		 
		 public function getChildrens($customer_id = 0)
		 {
			 return $this->db->where('Customer_ID', $customer_id)->get(TBL_CUST_MEMBERS)->result();
		 }
		 
		 public function getSelectedChildrens($customer_id = 0, $booking_id = 0)
		 {
			 return $this->db
			 				->select('m.*')
			 				->from(TBL_CUST_MEMBERS.' as m')
			 				->join(TBL_BOOKINGDETAILS.' as bd', 'bd.Member_ID = m.CM_ID')
			 				->join(TBL_BOOKINGS.' as b',  'b.Booking_ID = bd.Booking_ID')
			 				->where('b.Booking_ID', $booking_id)
			 				->where('b.Customer_ID', $customer_id)
			 				->get()
			 				->result();
		 }
		
		/** -------------------------------------------
		 * ----------- Order processing ------------- *
		 * --------------------------------------------- **/
		
		public function getCustomerDetails($customer_id = 0){
			$query = '';
			if($customer_id){
				$query = $this->db->where('Customer_ID', $customer_id)->get(TBL_CUSTOMERS)->result();
				return $query;
			}
			return 0;
		}
		
		public function addBooking($data = array()){
			$query = $this->db->insert(TBL_BOOKINGS, $data);
			return $this->db->insert_id();
		}
		
		public function updateBooking($details = array())
		{
			return $this->db
							->where('Booking_ID', $details['Booking_ID'])
							->where('Customer_ID', $details['Customer_ID'])
							->update(TBL_BOOKINGS, $details);
		}
		
		public function addBookingDetails($data = array())
		{
			//$query = $this->db->insert(TBL_ORDER_HISTORY, $data);
			
			$query = $this->db->insert(TBL_BOOKINGDETAILS, $data);
			
			return $this->db->insert_id();
		}
		
		public function deleteBookingDetails($booking_id = 0)
		{
			$this->db->where('Booking_ID', $booking_id)->delete(TBL_BOOKINGDETAILS);
		}
		
		public function updateBookingDetails($details = array())
		{	
			return $this->addBookingDetails($details);
		}
		
		public function getBookingDetails($customer_id = 0, $booking_id = 0)
		{
		    $booking = $this->db
		    				->distinct()
		    				->select('Booking_ID, b.Customer_ID, Booking_Total, b.Timestamp, b.Status, b.Event_ID, p.Title_en, p.Title_ar, p.From_Date, p.To_Date, p.Amount_Person, p.Total_Days, pd.Cover_Thumb, c.Fullname, c.Email')
		    				->from(TBL_BOOKINGS.' as b')
		    				->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = b.Customer_ID')
		    				->join(TBL_EVENTS.' as p', 'p.Event_ID = b.Event_ID')
			    			->join(TBL_EVENTS_PICS.' as pd', 'pd.Event_ID = p.Event_ID', 'LEFT')
		    				->where('b.Customer_ID', $customer_id)
		    				->where('b.Booking_ID', $booking_id)
		    				->order_by('Timestamp', 'DESC')
		    				->order_by('pd.Is_Cover', 'ASC')
		    				->group_by('b.Booking_ID')
		    				->get();
		    
		    //echo $this->db->last_query(); die();
		    
		    $booking = $booking->row();
		    
		    if(count($booking) > 0)
		    {
			    $booking_id = $booking->Booking_ID;
				$booking->bookingDetails = $this->db
		    								->select('m.*')
		    								->from(TBL_BOOKINGDETAILS.' as bd')
		    								->join(TBL_CUST_MEMBERS.' as m', 'm.CM_ID = bd.Member_ID')
		    								->where('bd.Member_ID', $booking_id)
		    								->get()
		    								->result();
		    }
		    
		    return $booking;   
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
                'Event_ID' => $data['Event_ID'],
                'Review' => $data['Review']
            );
            $this->db->insert(TBL_EVENTS_REVIEWS, $arr);
            return $this->db->insert_id();
        }

        public function UpdateReview($data = array())
        {
            return $this->db->where('Review_ID', $data['Review_ID'])->update(TBL_EVENTS_REVIEWS, $data);
        }
	
	/** -------------------------------------------
		*----------- Rating -------------*
	*--------------------------------------------- **/
	
	public function Get_TotalRating($event_id = 0)
	{
		return $this->db->where('Event_ID', $event_id)->get(TBL_EVENTS_RATING)->num_rows();
	}
	
	public function Get_AvgUserRating($event_id = 0)
	{
		$r5 = $this->db->query("SELECT SUM(Rating)/(COUNT(*)) as rating FROM ".TBL_EVENTS_RATING." WHERE Event_ID = $event_id GROUP BY Event_ID")->result();
		return ceil(@$r5[0]->rating);
	}
	
	public function Get_CurrentRatingByCustomer($event_id = 0, $customer_id = 0)
	{
		return $this->db->where('Event_ID', $event_id)->where('Customer_ID', $customer_id)->get(TBL_EVENTS_RATING)->result();
	}
	
	public function SubmitRating($data = array())
	{

		$q = $this->db->where('Event_ID', $data['Event_ID'])->where('Customer_ID', $data['Customer_ID'])->get(TBL_EVENTS_RATING);
		if ($q->num_rows() == 0) {
			return $this->db->insert(TBL_EVENTS_RATING, $data);
		}
		else
		if ($q->num_rows() == 1) {
			return $this->db->where('Event_ID', $data['Event_ID'])->where('Customer_ID', $data['Customer_ID'])->update(TBL_EVENTS_RATING, $data);
		}

		return 0;
	}
	
	/** -------------------------------------------
		*----------- Whishlist -------------*
	*--------------------------------------------- **/
	
	public function checkInCustomerWhishlist($id = 0, $customer_id = 0){
		$query = $this->db
						->where('Event_ID', $id)
						->where('Customer_ID', $customer_id)
						->get(TBL_EVENTS_WISHLIST);
		return $query->num_rows();
	}
	
	public function addEventToWhislist($customer_id = 0, $id = 0){
		$data = array(
			'Customer_ID' => $customer_id,
			'Event_ID' => $id
		);
		
		//check if present then delete it
		$check = $this->db->where($data)->get(TBL_EVENTS_WISHLIST)->num_rows();
		if($check){
			
			// delete it
			$this->db->where($data)->delete(TBL_EVENTS_WISHLIST);
			return 0;
		}
		
		$this->db->insert(TBL_EVENTS_WISHLIST, $data);
		return $this->db->affected_rows();
	}
	
	
	
	public function addEventsViews($id = 0, $ip_address = ''){
		return $this->db->insert(TBL_EVENTS_VIEWS, array('Event_ID' => $id, 'IP_Address' => $ip_address));
	}
		

    /** -------------------------------------------
		*----------- Datatable -------------*
	*--------------------------------------------- **/

    private function _get_events_query()
    { 
	    $where_subcategory = '';
	    $where_category = '';
	    $where_name = '';
	    $where_cost = '';
	    $where_rating = '';
		$select_rating = '0 as rating';
		$where_search = '';
	    
	    // search not empty && category empty
	    if(!empty($_POST['search']))
	    {
	        $search = trim($_POST['search']);
		    $where_search = "(p.Title_ar LIKE '%{$search}%' OR p.Title_en LIKE '%$search%' OR p.Description_en LIKE '%{$search}%' OR p.Description_ar LIKE '%{$search}%' OR pc.Category_en LIKE '%{$search}%' OR pc.Category_ar LIKE '%{$search}%' OR psc.SubCategory_en LIKE '%{$search}%' OR psc.SubCategory_ar LIKE '%{$search}%') AND";
	    }
		
        if(!empty($_POST['category_slug']))
		{
	        $slug = $_POST['category_slug'];
	        $where_category = "pc.CSlug = '{$slug}' AND ";
		}
		
		if(!empty($_POST['subcategory_slug'])){
	        $slug = $_POST['subcategory_slug'];
	        $where_subcategory = "psc.SCSlug = '{$slug}' AND ";
        }
        
        if(!empty($_POST['name'])){
	        $name = trim($_POST['name']);
	        $where_name = "(p.Title_en LIKE '%$name%' OR p.Title_ar LIKE '%{$name}%') AND";
        }
        
        if(!empty(@$_POST['rating'])){
	        $rate = $_POST['rating'];
	        $select_rating = "(SELECT SUM(Rating)/(COUNT(*)) FROM ".TBL_EVENTS_RATING." r where r.Rated_User_ID=u.User_ID GROUP BY Rated_User_Id HAVING ROUND(SUM(Rating)/(COUNT(*))) = $rate ) as rating";
	        $order_by = 'rating_count';
        }
	    
        $where = "{$where_category} {$where_subcategory} p.Status = 1 AND pd.Is_Cover = 1";
        $select_fields = "p.*, l.Address, pd.Cover_Thumb, pc.CSlug, psc.SCSlug";
        
        $this->db->distinct();
		$this->db
				->select("{$select_fields}")
                ->from(TBL_EVENTS." as p")
                ->join(TBL_EVENTS_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = p.SubCategory_ID')
                ->join(TBL_EVENTS_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID')
				->join(TBL_EVENTS_LOCATIONS.' as l', 'l.Event_ID = p.Event_ID', 'LEFT')
				->join(TBL_EVENTS_PICS.' as pd', 'pd.Event_ID = p.Event_ID', 'LEFT')
				->where($where)
				->group_by('p.Event_ID', 'DESC')
				->order_by('p.TimeStamp', 'DESC');
				
    }
 
    function getDataEvents()
    {
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
		
		$this->_get_events_query();
		$products = $this->db->get();
		
		//echo $this->db->last_query(); die();
				
        return $products->result();
    }
 
    function eventsCount_filtered()
    {
       $this->_get_events_query();
	   return $this->db->get()->num_rows();
    }
 
    public function eventsCount_all()
    {
        $this->_get_events_query();
	    return $this->db->get()->num_rows();
    }
}
?>