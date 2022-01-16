<?PHP
	class Projects_model extends CI_Model{
		
			/*-----------------------------------------------------------
		---------------------- News CATEGORIES Section -----------------
		--------------------------------------------------------*/
	
		// #Add category function
			public function addCategory($data = array()){
				$this->db->insert(TBL_PROJECTS_CATEGORIES, $data);
				return  $this->db->insert_id();
			}
			
			// #get Category function
			public function getCategories($data = array()){
				$query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_PROJECTS_CATEGORIES);
				return $query->result();
			}
			
			// #get Category function
		    public function getActiveCategories($data = null)
		    {
		        $this->db->where(array(
		            'Status' => 1
		        ));
		        $query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_PROJECTS_CATEGORIES);
		        return $query->result();
		    }
			
			// #get Category By ID function
			public function getCategoryByID($data = array()){
				$where = array('Category_ID' => $data['category_id']);
				$this->db->where($where);
				$query = $this->db->get(TBL_PROJECTS_CATEGORIES);
				return $query->result();
			}
			
			// #update Category function 
			public function updateCategory($data = array()){
				$where = array('Category_ID' => $data['Category_ID']);
				$this->db->where($where);
				$query = $this->db->update(TBL_PROJECTS_CATEGORIES, $data);
				return $query;
	
			}
			
			// #delete Category function 
			public function deleteCategory($data = array()){
				$where = array('Category_ID' => $data['category_id']);
				$this->db->where($where);
				$query = $this->db->delete(TBL_PROJECTS_CATEGORIES);
				return $query;
	
			}
			
			/*-----------------------------------------------------------
		---------------------- Products Section -----------------
		--------------------------------------------------------*/
    
	    public function addProject($data = null)
	    {
	        $query = $this->db->insert(TBL_PROJECTS, $data);
	        return $this->db->insert_id();
	    }
	    
	    public function addProjectDetails($data = array())
	    {
	        $query = $this->db->insert(TBL_PROJECTS_DETAILS, $data);
	        return $this->db->insert_id();
	    }
	    
	    public function getProjectPageName(){
		    return $this->db
		    				->select('*')
		    				->from(TBL_SECTIONS.' as s')
		    				->where('s.Section_ID = 13')
		    				->get()
		    				->result();
	    }
	    
	    public function updateProjectDetails_ARR($data = array())
	    {
	        $upd = array(
	            'Project_ID' => $data['Project_ID']
	        );
	        $i = 0;
	        foreach ($data["PD_ID"] as $id) {
		        $where = array(
	                'PD_ID' => $id
	            );
		        if($i == 0){
			        $this->db->where($where);
			        $d['Project_ID'] = $data['Project_ID'];
			        $d['Cover_Thumb'] = $data['Cover_Thumb'];
			        $d['Is_Cover'] = 1;
					$query = $this->db->update(TBL_PROJECTS_DETAILS, $d);
					$i++;
		        } else {
		            $this->db->where($where);
		            $query = $this->db->update(TBL_PROJECTS_DETAILS, $upd);
		            $i++;
		        }
	        }
	        return $query;
	    }



	    
	    public function getPDFirstImg($id = 0){
		   return $this->db->where('PD_ID', $id)
		    		 ->get(TBL_PROJECTS_DETAILS)->result();
	    }
	    
	    public function PDSetDefaults($id){
		    $data = array(
			    'Is_Cover' => 0,
			    'Cover_Thumb' => ''
		    );
		    return $this->db->where('Project_ID', $id)
		    		 ->update(TBL_PROJECTS_DETAILS, $data);
	    }
	    
	    public function getProjectCoverBool($id = 0){
		   return $this->db
		   				->where('Project_ID', $id)
		   				->where('Is_Cover', 1)
		   				->get(TBL_PROJECTS_DETAILS)->result();
	    }
	    
	    public function getProjectDetailsImagesForCover($id = 0){
		   return $this->db
		   				->where('Project_ID', $id)
		   				->where('Is_Cover', 0)
		   				->get(TBL_PROJECTS_DETAILS)->result();
	    }
	    
	    // #get project by id 
	    public function getProjectByID($Project_ID = '')
	    {

	        return $this->db
							->select('p.*,c.Category_en, c.Category_ar')
							->from(TBL_PROJECTS.' as p')
							->join(TBL_PROJECTS_CATEGORIES.' as c', 'c.Category_ID = p.Category_ID')
							->where('Project_ID',$Project_ID)
							->get()
							->row();

	    }
	    
	    // #get project detail
	    public function getProjectDetails($data = '')
	    {
	        $where = array(
	            'Project_ID' => $data['Project_ID']
	        );
	        $this->db->where($where);
	        $this->db->order_by('Order_In_List', 'asc');
	        $query = $this->db->get(TBL_PROJECTS_DETAILS);
	        return $query->result();
	    }
	    
	    // #get project details by id
	    public function getProjectDetailByID($data = '')
	    {
	        $where = array(
	            'PD_ID' => $data['productDet_id']
	        );
	        $this->db->where($where);
	        $query = $this->db->get(TBL_PROJECTS_DETAILS);
	        return $query->result();
	    }
	    
	    // #update project function 
	    public function updateProject($data = '')
	    {
	        $where = array(
	            'Project_ID' => $data['Project_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->update(TBL_PROJECTS, $data);
	        return $query;
	        
	    }
	    
	    // #update project details
	    public function updateProjectDetails($data = array())
	    {
	        $where = array(
	            'PD_ID' => $data['PD_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->update(TBL_PROJECTS_DETAILS, $data);
	        return $query;
	    }
	    
	    public function getProjectImages($data = array()){
		    $where = array(
	            'Project_ID' => $data['Project_ID']
	        );
	       return $this->db->select('Pictures, Cover_Thumb')->from(TBL_PROJECTS_DETAILS)->where($where)->get()->result();
	    }
	    
	    public function getProjectDetImages($data = array()){
		    $where = array(
	            'PD_ID' => $data['projectDet_ID']
	        );
	       return $this->db->select('Pictures, Cover_Thumb')->from(TBL_PROJECTS_DETAILS)->where($where)->get()->result();
	    }
	    
	    // #delete project function 
	    public function deleteProject($data = array())
	    {
	        $where = array(
	            'Project_ID' => $data['Project_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete(TBL_PROJECTS);
	        if ($query) {
	            $where1 = array(
	                'Project_ID' => $data['Project_ID']
	            );
	            $this->db->where($where1);
	            $query1 = $this->db->delete(TBL_PROJECTS_DETAILS);
	            return $query;
	        }
	        
	    }
	    
	    // #delete project details function 
	    public function deleteProjectDetail($data = null)
	    {
	        $where = array(
	            'PD_ID' => $data['projectDet_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete(TBL_PROJECTS_DETAILS);
	        return $query;
	        
	    }
	    
	    public function getPDImageName($id){
				return $this->db->where('PD_ID', $id)->get(TBL_PROJECTS_DETAILS)->result()[0]->Pictures;
			}
			
			public function deletePDImage($id){
				return $this->db->where('PD_ID', $id)->delete(TBL_PROJECTS_DETAILS);
			}
		
		
		//for excel
		public function getAllProjects_Excel(){
			return $this->db
							->select('p.Project_ID,c.Category_en, c.Category_ar, p.Title_en, p.Title_ar, p.Address, p.TimeStamp')
							->from(TBL_PROJECTS.' as p')
							->join(TBL_PROJECTS_CATEGORIES.' as c', 'c.Category_ID = p.Category_ID')
							->order_by("Project_ID", "DESC")
							->get()
							->result();
		}
		
		//for Csv
		public function getAllProjects_Csv(){
			return $this->db
							->select('p.Project_ID,c.Category_en, c.Category_ar, p.Title_en, p.Title_ar, p.Address, p.TimeStamp')
							->from(TBL_PROJECTS.' as p')
							->join(TBL_PROJECTS_CATEGORIES.' as c', 'c.Category_ID = p.Category_ID')
							->order_by("Project_ID", "DESC")
							->get();
		}
		
		// #delete project details function 
	    public function deleteProjectBooking($data = null)
	    {
	        $where = array(
	            'ID' => $data['ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete('TBL_PROJECTS_BOOKINGS');
	        return $query;
	        
		}
		


	/**
		*------- Projects List *---------
	**/

	var $projects_order  = array('p.Project_ID', 'p.TimeStamp');
	private function _get_projects_query()
	    {
		    
		    $where_title = '';
			$where_cat = '';
			$where_adr = '';
			
			if(!empty($_POST['title'])){
				$title = $_POST['title'];
				$where_title = "(p.Full_Name LIKE '%$title%') AND";
			}
			
			if($_POST['category'] != -1){
				$category = $_POST['category'];
				$where_cat = "p.Category_ID = $category AND";
			}
			
			if(!empty($_POST['email'])){
				$email = $_POST['email'];
				$where_adr = "p.Email LIKE '%$email%' AND";
			}
			
			$where = "$where_cat $where_title $where_adr p.Status >= 0";
		    
		    $this->db->distinct();
	        $this->db->select('p.*, c.Category_en, c.Category_ar'); 
	        $this->db->from(TBL_PROJECTS.' as p');
	        $this->db->join(TBL_PROJECTS_CATEGORIES.' as c', 'c.Category_ID = p.Category_ID');
	        $this->db->where($where);
	        $this->db->group_by('p.Project_ID');
	        
	        //print_r($_POST['order']);
		    if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->projects_order[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("a.Project_ID", "DESC");
		    }
	
    }
 
    function getProjectsList()
    {
        $this->_get_projects_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function projectsCount_filtered()
    {
        $this->_get_projects_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function projectsCount_all()
    {
        $this->db->from(TBL_PROJECTS);
        return $this->db->count_all_results();
    }
    
    /**
		*------- Project Booking List *---------
	**/
	
	var $order_columns_pb  = array('b.TimeStamp', 'p.Title_en', 'b.Name', 'b.Email', 'b.Phone', 'b.Message');
	
	private function _get_projects_booking_query()
    { 
        $this->db->select('b.*, p.Title_en, p.Title_ar')
			         ->from(TBL_PROJECTS_BOOKINGS.' as b')
			         ->join(TBL_PROJECTS.' as p', 'p.Project_ID = b.Project_ID');
		
		//searching
		if(isset($_POST['search'])){
			$search_value = $_POST['search']['value'];
			$where = "(p.Title_en LIKE '%$search_value%' OR p.Title_ar LIKE '%$search_value%') OR b.Name LIKE '%$search_value%' OR b.Email LIKE '%$search_value%' OR b.Phone LIKE '%$search_value%'";
			$this->db->where($where);
		}
		
		// ordering
		if(isset($_POST['order'])){
		    $ind = $_POST['order'][0]['column'];
		    $oColumn = $this->order_columns_pb[$ind];
			$direction = $_POST['order'][0]['dir'];
			$where_order = "$oColumn $direction";
			$this->db->order_by($where_order);
		} else {
			$this->db->order_by("b.TimeStamp", "DESC");
		}
		
    }
    
    
    public function getProjectBookings(){
	    if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
		
		$this->_get_projects_booking_query();		
        $user_data = $this->db->get()->result();
		return $user_data;
    }
    
    function projectBookingsCount_all()
    {
        $this->_get_projects_booking_query();	
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }
 
    public function projectBookingsCount_filtered()
    {
        $this->_get_projects_booking_query();	
        return $this->db->get()->num_rows();
    }
		
		
		
		
	 /**
		*------- Finance Calculator Records List *---------
	**/
	
	var $order_columns_cal  = array('TimeStamp', 'Company_Name', 'Sector', 'Region', 'Earnings', 'Expenses', 'Age', 'First_Buyer', 'Repayment_Years');
	
	private function _get_finance_query()
    { 
        $this->db->select('*')
			         ->from('tbl_calculator');
		
		//searching
		if(isset($_POST['search'])){
			$search_value = $_POST['search']['value'];
			$where = "Company_Name LIKE '%$search_value%' OR Sector LIKE '%$search_value%' OR Region LIKE '%$search_value%' OR Earnings LIKE '%$search_value%' OR Expenses LIKE '%$search_value%' OR Age LIKE '%$search_value%'";
			$this->db->where($where);
		}
		
		// ordering
		if(isset($_POST['order'])){
		    $ind = $_POST['order'][0]['column'];
		    $oColumn = $this->order_columns_cal[$ind];
			$direction = $_POST['order'][0]['dir'];
			$where_order = "$oColumn $direction";
			$this->db->order_by($where_order);
		} else {
			$this->db->order_by("TimeStamp", "DESC");
		}
		
    }
    
    
    public function getFinanceRecords(){
	    if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
		
		$this->_get_finance_query();		
        $user_data = $this->db->get()->result();
		return $user_data;
    }
    
    function financeCount_all()
    {
        $this->_get_finance_query();	
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }
 
    public function financeCount_filtered()
    {
        $this->_get_finance_query();	
        return $this->db->get()->num_rows();
    }
}

?>