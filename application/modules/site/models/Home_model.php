<?PHP
	class Home_model extends CI_Model{

		/* Get website configuration */
		public function Get_Website_Configuration()
		{
			$arr = array(
				'web_settings' => $this->Get_WebsiteSettings(),
				'web_contact_info' => $this->Get_ContactDetails(),
				'term_use' => $this->page_by_id(3),
				'privecy' => $this->page_by_id(2),
				'support_center' => $this->page_by_id(6),


				'pages_1' => $this->get_pages(3,0),
                 'pages_2' => $this->get_pages(3,3),
                 'pages_3' => $this->get_pages(3,6),

			);

			return $arr;
		}

		
		/* Get Website FULL DATA */
		public function Get_Website_Data()
		{

			$arr = array(
				//'website_slider' => $this->Get_back_slider(),
				'web_settings' => $this->Get_WebsiteSettings(),
				'web_contact_info' => $this->Get_ContactDetails(),


				'about_us' => $this->page_by_id(1),
				'privecy' => $this->page_by_id(2),
				'term_use' => $this->page_by_id(3),
				'term_refund' => $this->page_by_id(4),
				'term_conditions' => $this->page_by_id(14),
				'domain_tansfer_steps' => $this->page_by_id(6),

				'pages_footer' => $this->get_pages_footer(),

			);


			return $arr;
		}

		public function get_about_us_info(){

			$arr = array(
			'about_us' => $this->get_about_us('about_us'),
			'our_vision' => $this->get_about_us('our_vision'),
			'our_message' => $this->get_about_us('our_message'),
			'our_standads' => $this->get_about_us('our_standads')
			);

			return $arr;

		}

		public function get_all_tlds(){
			$this->db->group_by('TLD_Name');
			$this->db->where('Deleted IS NULL', null, true);
			$this->db->where('Status', 1);
             $this->db->order_by('TLD_ID', 'asc');
			$query = $this->db->get(TLD);
			return $query->result();
		}

		public function get_pages($limit=0,$start=0)
		{
		                  	return  $this->db
											->select('*')
											->from('pages')
											->where('Status', 1)
											->limit($limit,$start)
											->get()
											->result();

	}


		       private function get_about_us($slug = '') {
            $query = $this->db
                ->select('*')
                ->from('about_us')
                ->where('Slug', $slug)
                ->get();

            return $query->row();
        }



            function get_one($where, $fileds, $table) {
        if (isset($fileds)) {
            $this->db->select($fileds);
        }if (isset($where)) {
            $this->db->where($where);
        }
        $this->db->from($table);
        $this->db->limit(1);
        $ret = $this->db->get()->first_row();

        return $ret;
    }
		public function get_rbac_menus() {
            $query = $this->db
                ->select('m.*, wf.*')
                ->from(TBL_MENUS.' as m')
                ->join("website_features as wf", "wf.PID = m.Id")
                ->where('wf.Website_Link !=', '')
                ->where('wf.Status', 1)
                ->order_by('wf.Order_In_List', 'asc')
                ->get();

            return $query->result();
        }

        public function get_page_by_prefix() {
            $query = $this->db
                ->select('p.*')
                ->from(TBL_PAGES.' as p')
                ->where('p.Prefix_en', uri_string())
                ->or_where('p.Prefix_ar', uri_string())
                ->get();

            return $query->row();
        }

        public function are_pages_Disabled($pid = 167) {
            return $this->db
                ->select('m.*, wf.*')
                ->from(TBL_MENUS.' as m')
                ->join("website_features as wf", "wf.PID = m.Id")
                ->where('wf.Status', 1)
                ->where('wf.PID', $pid)
                ->get()
                ->result();
        }


		public function getNews($limit,$start){
			$this->db->select("*")
		    		 ->from(TBL_NEWS." as new")
		    		 ->join(TBL_SECTIONS." as s", 'new.Section_ID = s.Section_ID')
					 ->where('new.Status', 1)
					 ->limit($limit,$start)
					 ->order_by('Order_In_List', 'asc');
			$data = $this->db->get();
		    return $data->result();
		}
		public function getNewsDetails($id){
			$this->db->select("*")
		    		 ->from(TBL_NEWS." as ser")
		    		 ->join(TBL_SECTIONS." as s", 'ser.Section_ID = s.Section_ID')
					 ->where('ser.Status', 1)
					 ->where('ser.News_ID', $id)
					 ->order_by('Order_In_List', 'asc');
			$data = $this->db->get();
		    return $data->row();
		}

		public function getAllPlansFeature()
		{
			$data = $this->db->select('*')
							 ->from('solutions_features')
							 ->order_by('Feature_ID', 'desc')
							 ->get();

				return $data->result();
		}

	public function NewsRandomList($news_id)
		{

			$this->db->select("*")
		    		 ->from(TBL_NEWS." as new")
		    		 ->join(TBL_SECTIONS." as s", 'new.Section_ID = s.Section_ID')
					 ->where('new.Status', 1)
					 ->where('new.News_ID !=', $news_id)
					  ->limit(3)
		    		 ->order_by('rand()');
			$data = $this->db->get();



		    return $data->result();
		}


		public function getBranchByID($branch_id=0,$get_class = 1){

			$branch = $this->db
				                ->select('*')
				                ->from('branches')
				                ->where('Branch_ID', $branch_id)
				                ->get()
				                ->row();

			if(!empty($branch)){
				$result['branch'] = $branch;
				if($get_class){
			    	$classes = $this->getBranchClasses($branch_id);
			    	$result['classes'] = $classes;
				}
			    return $result;
			}else{
				return null;
			}

		}

		public function getBranchClasses($branch_id = 0){

			$this->db->select("*,IFNULL(cd.Pictures, 'default.png') as Picture")
		    		 ->from(TBL_CLASSES." as cls")
		    		 ->join(TBL_CLASS_DETAILS." as cd", 'cd.Class_ID = cls.Class_ID','left')
		    		 ->join(TBL_CUSTOMERS." as c", 'c.Customer_ID = cls.Teacher_ID','right')
		    		 ->join(TBL_CUST_PREFERANCES." as cp", 'cp.Customer_ID = c.Customer_ID','right')
					 ->where('c.Status', 1)
					 ->where('cls.Branch_ID', $branch_id)
					 ->where('c.Customer_Type', 'teacher')
					 ->where('cd.Is_Cover', 1)
		    		 ->order_by('cls.Class_ID','DESC');
			$data = $this->db->get();
		    $classes =  $data->result();
		    foreach ($classes as $key => $class) {
		    	 $class->Picture = base_url($GLOBALS['img_class_dir'].$class->Picture);
		    }
		    return $classes;
		}

		public function getClassDetails($class_id = 0){

					$this->db->select("*,IFNULL(cd.Pictures, 'default.png') as Picture,b.Address as branch_address")
		    		 ->from(TBL_CLASSES." as cls")
		    		 ->join(TBL_CLASS_DETAILS." as cd", 'cd.Class_ID = cls.Class_ID','left')
		    		 ->join("branches as b", 'b.Branch_ID = cls.Branch_ID','right')
		    		 ->join(TBL_CUSTOMERS." as c", 'c.Customer_ID = cls.Teacher_ID','right')
		    		 ->join(TBL_CUST_PREFERANCES." as cp", 'cp.Customer_ID = c.Customer_ID','right')
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
		    	return $class;
		    }else{
		    	return null;
		    }


		}



        public function is_aboutus_disabled() {
            return $this->db
                ->select('p.*')
                ->from(TBL_PAGES . ' as p')
                ->where('p.Status', 1)
                ->where('p.Id', 1)
                ->get()
                ->result();
        }

        public function is_page_Disabled($pid = 0) {
            return $this->db
                ->select('*')
                ->from(TBL_WEBSITE_FEATURES)
                ->where('Status', 0)
                ->where('PID', $pid)
                ->get()
                ->result();
        }

        public function page_by_id($id = 0) {
            return $this->db
                ->select('*')
                ->from(TBL_PAGES)
                ->where('Id', $id)
                ->get()
                ->row();
        }
        public function get_pages_8() {
            $limit	=0;
            $offset	=8;
            $query = $this->db
                ->select('p.*')
                ->from(TBL_PAGES.' as p')
                ->where('p.Status', 1)
                ->limit($offset, $limit)
                ->order_by('p.Order_In_List', 'asc')
                ->get();

            return $query->result();
        }

        public function get_pages_7() {
            $limit	=8;
            $offset	=7;
            $query = $this->db
                ->select('p.*')
                ->from(TBL_PAGES.' as p')
                ->where('p.Status', 1)
                ->limit($offset, $limit)
                ->order_by('p.Order_In_List', 'asc')
                ->get();

            return $query->result();
        }

        public function get_pages_footer() {
            $limit	=4;
            //$offset	=1;
            $query = $this->db
                ->select('p.*')
                ->from(TBL_PAGES.' as p')
                ->where('p.Status', 1)
                ->limit($limit)
                ->order_by('p.Id', 'asc')
                ->get();

            return $query->result();
        }

        public function Is_Menu_Disabled($link) {
            return $this->db
                ->select('m.*, wf.*')
                ->from(TBL_MENUS.' as m')
                ->join("website_features as wf", "wf.PID = m.Id")
                ->where('wf.Status', 0)
                ->where('wf.Website_Link', $link)
                ->get()
                ->result();
        }
        public function get_rbac_menus_by_link($link) {
            return $this->db
                ->select('m.*')
                ->from(TBL_MENUS.' as m')
                ->where('m.Link', $link)
                ->get()
                ->result();
        }

		// to get projects
		public function getProjects()
		{
			$this->db->select("pr.*, s.*, pd.*")
		    		 ->from('projects as pr')
		    		 ->join('project_details as pd', 'pr.Project_ID = pd.Project_ID')
		    		 ->join(TBL_SECTIONS." AS s", 'pr.Section_ID = s.Section_ID')
		    		 ->where('pr.Status', 1)
		    		 ->where('pd.Status', 1)
		    		 ->where('pd.Is_Cover', 1);

		    $data = $this->db->get();

		    return $data->result();
		}

		public function getAchievements()
		{
			$q = $this->db->select("*")
			    		 ->from('counter')
							 ->get();

		    return $q->row();
		}

		public function getTeamwork()
		{
			$q = $this->db->select("*")
			    		 ->from('top_management')
							 ->where('Status', 1)
							 ->get();

		    return $q->result();
		}

		public function getLimitSolutions()
		{
			$q = $this->db->select("*")
			    		 ->from('solutions')
							 ->where('Status', 1)
							 ->limit(5,0)
							 ->order_by('Created_At', 'desc')
							 ->get();

		    return $q->result();
		}

		public function getSolutions()
		{
			$q = $this->db->select("*")
			    		 ->from('solutions')
						->where('Status', 1)
						->order_by('Created_At', 'desc')
						->get();

		    return $q->result();
		}
		public function getSolutionsByID($id)
		{
			$q = $this->db->select("*")
			    		 ->from('solutions')
							 ->where('Status', 1)
							 ->where('ID', $id)
							 ->get();

		    return $q->row();
		}

			// to get projects
		public function getProjectsCategories()
		{
			$this->db->select("*")
		    		 ->from('project_categories')
		    		 ->where('Status', 1);

		    $data = $this->db->get();

		    return $data->result();
		}


		public function updateCustomerLang($lang,$customer_id){
				$data = ['APP_LANG'=>$lang];
				$query = $this->db
							  ->where('Customer_ID', $customer_id)
							  ->update('customers', $data);
				return $this->db->affected_rows();
		}

		public function getCustomerLang($customer_id){
					$customer = $this->db
							->select('*')
							->from('customers')				
							->where('Customer_ID',$customer_id)
							->get()
							->row();

			        return $customer->APP_LANG;
		}

		public function checkUserStatus($customer_id){
			$customer = $this->db
					->select('*')
					->from('customers')				
					->where('Customer_ID',$customer_id)
					->where('Status',1)
					->get()
					->num_rows();

			return $customer;
		}

		public function getProjectByID($id = 0)
		{

			if($id)
			{
				$this->db->where('p.Project_ID', $id);
			}

			$this->db->select("p.*, pd.*, pc.Category_en, pc.Category_ar, s.*")
		    		 ->from(TBL_PROJECTS." as p")
		    		 ->join(TBL_PROJECTS_CATEGORIES." as pc", 'pc.Category_ID = p.Category_ID')
		    		 ->join('project_details as pd', 'p.Project_ID = pd.Project_ID')
		    		 ->join(TBL_SECTIONS." as s", 'p.Section_ID = s.Section_ID')
					 ->where('p.Status', 1)
					 ->where('pd.Status', 1)
		    		 ->where('pd.Is_Cover', 1)
					 ->order_by('p.Project_ID', 'DESC');
			$data = $this->db->get();

			$projects = $data->result();

			foreach($projects as $project)
			{
				$project->Details = $this->db
												->where('Project_ID', $project->Project_ID)
												->where('Status', 1)
												->get('project_details')
												->result();
			}

			if($id)
			{
				return $projects[0];
			}
			//print_r($portfolios); die();
			return $projects;

/*
			if($id)
			{
				return $data->row();
			}

		    return $data->result();
*/
		}

		function insert($table,$data){
			$insert_id = $this->db->insert($table,$data);
			return $this->db->insert_id();
			//return $insert_id;
		}
		function save($data,$where,$table){
			$this->db->reset_query();
            $this->db->where($where);
			$this->db->update($table,$data);
			return $this->db->affected_rows();

		}

        function get_all($where,$fileds,$order_by,$table){
            if (isset($fileds)){
                $this->db->select($fileds);
            }
            if (isset($where)){
                $this->db->where($where,FALSE);
            }
            if (isset($order_by)){
                $this->db->order_by($order_by[0],$order_by[1]);
            }

            $this->db->from($table);
            $ret = $this->db->get()->result();
            return $ret;
        }



       /* ------------------------------------------
		   ------------- Promo Code ---------------
		------------------------------------------------ */


		public function getPromotionDetails($customer_id = '')
		{

			$promo = $this->db
							->select('p.*,pu.PUID')
							->from('promo_codes as p')
							->join('promo_code_usage as pu', 'pu.PromoCode_ID = p.ID', 'LEFT')
							->where('p.Delete_Status', 0)
							->where('p.Status', 1)
							->where('CURDATE() <= p.EndDate')
							->where('CURDATE() >= p.StartDate')
							->where('pu.Status','pending')
							->where('pu.Customer_ID',$customer_id)
							->get();

			//echo $this->db->last_query();

			return $promo->row();
		}


		public function getPromotionCode($code = '', $totalUsed = true)
		{
			if($totalUsed)
			{
				$this->db->having('TotalUsed < p.NumberOfUse');
			}

			if(empty($code))
			{
				return array();
			}

			$promo = $this->db
							->select('p.*, COUNT(pu.PromoCode_ID) as TotalUsed')
							->from('promo_codes as p')
							->join('promo_code_usage as pu', 'pu.PromoCode_ID = p.ID', 'LEFT')
							->where('p.Code', $code)
							->where('p.Delete_Status', 0)
							->where('p.Status', 1)
							->where('CURDATE() <= p.EndDate')
							->where('CURDATE() >= p.StartDate')
							->get();

			//echo $this->db->last_query();

			return $promo->row();
		}

				public function getPromotionByCode($code = '')
		{


			$promo = $this->db
							->select('p.*')
							->from('promo_codes as p')
							->where('p.Code', $code)
							->where('p.Delete_Status', 0)
							->where('p.Status', 1)
							->where('CURDATE() <= p.EndDate')
							->where('CURDATE() >= p.StartDate')
							->get();

			//echo $this->db->last_query();

			return $promo->row();
		}

		public function checkCurrentUserCodeLimit($id, $customer_id)
		{

			$promo = $this->db
							->select('p.NumberOfUsePerPerson, COUNT(pu.Customer_ID) as TotalUsed')
							->from('promo_code_usage as pu')
							->join('promo_codes as p', 'p.ID = pu.PromoCode_ID')
							->where('pu.Customer_ID', $customer_id)
							->where('p.ID', $id)
							->having('TotalUsed < p.NumberOfUsePerPerson')
							->get();

			//echo $this->db->last_query();

			return $promo->result();
		}

			public function checkCurrentUserCodeStatus($id, $customer_id)
		{
				$promo = $this->db
							->select('pu.*')
							->from('promo_code_usage as pu')
							->join('promo_codes as p', 'p.ID = pu.PromoCode_ID')
							->where('pu.Customer_ID', $customer_id)
							->where('pu.PromoCode_ID', $id)
							->where('pu.Status', 'pending')
							->get();


			return $promo->result();
		}

		public function usePromotion($promotion = array())
		{
			return $this->db->insert('promo_code_usage', $promotion);
		}

		public function removePromotion($customer_id, $promoId)
		{
			$this->db->where('Customer_ID', $customer_id)->where('PromoCode_ID', $promoId)->delete('promo_code_usage');
		}


		// to get apps links
		public function getAppLinks()
		{
			$this->db->select("app.IOS_link, app.Android_link")
		    		 ->from(TBL_WEBSITE_SETTINGS.' as app');

		    $data = $this->db->get();
		    return $data->result();
		}
		// to get top managements data
		public function getTopManagements()
		{
			$this->db->select("*")
		    		 ->from('top_management')
		    		 ->where('Status', 1);
		    $data = $this->db->get();
		    return $data->result();
		}
		public function Get_ContactDetails()
		{
		     $data = $this->db->get(TBL_WEBSITE_CONTACTS);
		    return $data->result();
		}

		public function Get_WebsiteSettings()
		{
		    $data = $this->db->get(TBL_WEBSITE_SETTINGS);
		    return $data->result();
		}

		public function getMarkers()
		{
			$this->db->select('lat, lng, Address');
				$query = $this->db->get(TBL_WEBSITE_MAPLOCATIONS);
				return $query->result();
		}

		public function getShowreel()
		{
			$this->db->select("*")
		    		 ->from(TBL_WEBSITE_SHOWREEL." AS sh")
		    		 ->join(TBL_SECTIONS." as s", 'sh.Section_ID = s.Section_ID');
			return $this->db->get()->result();
		}

		public function Get_back_slider()
		{
			$this->db->where('Status', 1);
			$data = $this->db->order_by('Order_In_List', 'asc')->get(TBL_WEBSITE_SLIDER);
		    return $data->result();
		}

		public function Get_about_company()
		{
			$this->db->select("*")
		    		 ->from(TBL_ABOUTUS." as a")
		    		 ->join(TBL_SECTIONS." as s", 'a.Section_ID = s.Section_ID');
			$data = $this->db->get();
		    return $data->result();
		}

		/*------------------------------------------
			----- Services Seciton --------------
		------------------------------------------------ */

		public function Get_services()
		{
			$this->db->select("*")
		    		 ->from(TBL_SERVICES." as ser")
		    		 ->join(TBL_SECTIONS." as s", 'ser.Section_ID = s.Section_ID')
					 ->where('ser.Status', 1)
					 ->order_by('Order_In_List', 'desc');
			$data = $this->db->get();
		    return $data->result();
		}

				public function Get_testimonials()
		{
			$this->db->select("*")
		    		 ->from("testimonials")
					 ->where('Status', 1)
					 ->order_by('Order_In_List', 'asc');
			$data = $this->db->get();
		    return $data->result();
		}

		/*------------------------------------------
			----- News Seciton --------------
		------------------------------------------------ */

		public function NewsList($id = 0)
		{
			if($id)
			{
				$this->db->where('n.News_ID', $id);
			}

			$this->db->select("n.*, nc.Category_en, nc.Category_ar, s.*")
		    		 ->from(TBL_NEWS." as n")
		    		 ->join(TBL_NEWS_CATEGORIES." as nc", 'nc.Category_ID = n.Category_ID')
		    		 ->join(TBL_SECTIONS." as s", 'n.Section_ID = s.Section_ID')
					 ->where('n.Status', 1)
					 ->order_by('n.News_ID', 'DESC');
			$data = $this->db->get();

			if($id)
			{
				return $data->row();
			}

		    return $data->result();
		}

		/*------------------------------------------
			----- Branches Seciton --------------
		------------------------------------------------ */
    public function getDomainTlds(){
        return  $this->db
                                                ->select("*")
                                                ->from(TLD)
                                                ->where('Status',1)
                                                ->get()
                                                ->result();
    }
		public function getBranches()
		{


			$query = $this->db->order_by('Branch_ID', 'ASC')->get_where('branches');
            return $query->result();

		}

		// public function getBranchesLocations()
		// {
		// 	return $this->db
		// 					->select('Latitude as lat, Longitude as lng, Address')
		// 					->get('branches')
		// 					->result();
		// }

		/*------------------------------------------
			----- Albums Seciton --------------
		------------------------------------------------ */

		public function AlbumsCategories()
		{
			$q = $this->db
						 ->distinct()
						 ->select('c.*')
						 ->from(TBL_ALBUMS_CATEGORIES.' as c')
						 ->join(TBL_ALBUMS.' as a', 'FIND_IN_SET(c.Category_ID, a.Category_ID)')
						 ->where('c.Status', 1)
						 ->where('a.Status', 1)
						 ->order_by('c.Order_In_List', 'ASC')
						 ->get();

						 //echo $this->db->last_query(); die();
			return $q->result();
		}

		public function AlbumsList($id = 0, $limit = 0)
		{
			if($id)
			{
				$this->db->where('a.Album_ID', $id);
			}

			if($limit)
			{
				$this->db->limit($limit, 0);
			}

			$this->db
					 ->distinct()
					 ->select("a.*, s.*")
		    		 ->from(TBL_ALBUMS." as a")
		    		 ->join(TBL_ALBUMS_CATEGORIES." as ac", 'ac.Category_ID = a.Category_ID')
		    		 ->join(TBL_SECTIONS." as s", 'a.Section_ID = s.Section_ID')
					 ->where('a.Status', 1)
					 ->where('ac.Status', 1)
					 ->order_by('Order_In_List', 'asc');
			$data = $this->db->get();

			if($id)
			{
				return $data->row();
			}

		    return $data->result();
		}




		/*------------------------------------------
			----- Portfolio Seciton --------------
		------------------------------------------------ */

		public function PortfolioCategories()
		{
			$q = $this->db
						 ->distinct()
						 ->select('c.*')
						 ->from(TBL_PORTFOLIO_CATEGORIES.' as c')
						 ->join(TBL_PORTFOLIO.' as p', 'FIND_IN_SET(c.Category_ID, p.Category_ID)')
						 ->where('c.Status', 1)
						 ->where('p.Status', 1)
						 ->order_by('c.Order_In_List', 'ASC')
						 ->get();

						 //echo $this->db->last_query(); die();
			return $q->result();
		}

		public function PortfolioList()
		{
			$this->db->select("p.*")
					 ->distinct()
		    		 ->from(TBL_PORTFOLIO." as p")
					 ->where('p.Status', 1)
					 ->order_by('p.Order_In_List', 'asc');
			$data = $this->db->get();

			$portfolios = $data->result();

			//print_r($portfolios); die();
			return $portfolios;
		}

		/*------------------------------------------
			----- Partners Seciton --------------
		------------------------------------------------ */

		public function ClientsList()
		{
			$this->db->select("*")
		    		 ->from(TBL_CLIENTS." as c")
		    		 ->join(TBL_SECTIONS." as s", 's.Section_ID = c.Section_ID')
					 ->where('c.Status', 1)
					 //->where('c.Type', 1)
					 ->order_by('Order_In_List', 'asc');
			$data = $this->db->get();
		    return $data->result();
		}

		public function getPartnerList()
		{
			$this->db->select("*")
		    		 ->from(TBL_CLIENTS." as c")
		    		 ->join(TBL_SECTIONS." as s", 's.Section_ID = c.Section_ID')
					 ->where('c.Status', 1)
					 ->where('c.Type', 2)
					 ->order_by('Order_In_List', 'asc');
			$data = $this->db->get();
		    return $data->result();
		}

		/*------------------------------------------
			----- EVENTS --------------
		------------------------------------------------ */

		public function Get_EventsCategories()
		{
			$categories = $this->db
									->select('c.*')
									->from(TBL_EVENTS_CATEGORIES.' AS c')
									->join(TBL_EVENTS_SUBCATEGORIES.' as pc', 'pc.Category_ID = c.Category_ID')
                            		->join(TBL_EVENTS.' as e', 'e.SubCategory_ID = pc.SubCategory_ID')
									->where('c.Status', 1)
									->where('pc.Status', 1)
									->where('e.Status', 1)
									->order_by('c.Order_In_List', 'ASC')
									->group_by('c.Category_ID')
									->get()
									->result();

			foreach($categories as $row)
			{
				$category_id = $row->Category_ID;
				$row->SubCategories = $this->db
												->select('pc.*')
												->from(TBL_EVENTS_SUBCATEGORIES.' AS pc')
												->join(TBL_EVENTS.' as e', 'e.SubCategory_ID = pc.SubCategory_ID')
												->where('pc.Status', 1)
												->where('e.Status', 1)
												->where('pc.Category_ID', $category_id)
												->order_by('pc.Order_In_List', 'ASC')
												->group_by('pc.SubCategory_ID')
												->get()
												->result();
			}

			return $categories;
		}

		/*------------------------------------------
			------- Subscriptions ---------------------
		------------------------------------------------ */

		public function getSubscriptionPlans()
		{
			$plans = $this->db
							 ->where('Status', 1)
							 ->order_by('Plan_Downloads', 'asc')
							 ->get(TBL_SUBSCRIPTION_PLANS)
							 ->result();

			return $plans;
		}




		public function getCustomerCheckoutToken($customer_id = 0)
		{
			return $this->db->where('Customer_ID', $customer_id)->get('customers')->row()->ckeckout_token;
		}

		/*------------------------------------------
			------- NewsLetter Subscriptions ---------------------
		------------------------------------------------ */

        public function subscribeToNewsLetter($email = array())
        {
            $check_email = $this->db->where('Email', $email['Email'])->get(TBL_SUBSCRIBERS)->num_rows();
            if($check_email > 0)
            {
                return 0;
            }

            $this->db->insert(TBL_SUBSCRIBERS, $email);
            return $this->db->insert_id();
        }

		/*------------------------------------------
			----- Careers --------------
		------------------------------------------------ */

		public function getCareers(){
			$this->db->where('Status', 1);
			$data = $this->db->get(TBL_CAREERS);
			return $data->result();
		}

		public function GetJobByID($data = array()){
			$this->db->where('Career_ID', $data['job_id']);
			return $this->db->get(TBL_CAREERS)->result();
		}

		public function GetUnitPriceByID($price_unit_id = 0){


			return $this->db
												->select('*,ppu.Status as Product_Stock_Status')
												->from('product_priceperunit AS ppu')
												->join('product_width as pw', 'pw.Product_Width_ID = ppu.Width','right')
												->join('product_units as pu', 'pu.Unit_ID = ppu.Unit_ID')
												->where('ppu.PricePerUnit_ID', $price_unit_id)
												->get()
												->row();

		}

		public function getNationalities(){
			$this->db->select("*")
		    		 ->from('tbl_nationalities');
			$data = $this->db->get();
		    return $data->result();
		}

		public function getCities(){
			$query = $this->db->get('sa_cities');
			return $query->result();
		}

		public function addAplication($application = array()){
			$this->db->insert('career_applications', $application);
			return $this->db->insert_id();
		}

		/*------------------------------------------
			------- Appointments ---------------------
		------------------------------------------------ */
		public function TakeAppointment($data = array())
		{
			$this->db->insert(TBL_APPOINTMENTS, $data);
			return $this->db->insert_id();
		}


		/*------------------------------------------
			------- Blogs ---------------------
		------------------------------------------------ */
		public function getBlogsList()
		{
			$query = $this->db->select("*")
			    		  ->from(TBL_NEWS)
			    		  ->where('Status', 1)
			    		  ->order_by('News_ID', 'desc')
						  ->get();

		    return $query->result();
		}
		public function getBlogByID($id = 0)
		{
			$query = $this->db->select("*")
		    		 ->from(TBL_NEWS)
					 ->where('Status', 1)
					 ->where('News_ID', $id)
					 ->order_by('Order_In_List', 'asc')
			         ->get();

		    return $query->result();
		}
		public function getRecomendedBlogList($id)
		{
			$query = $this->db->select("*")
			    		  ->from(TBL_NEWS)
			    		  ->where('Status', 1)
			    		  ->where('News_ID !=', $id)
			    		  ->order_by('News_ID', 'desc')
			    		  ->limit(3)
						  ->get();

		    return $query->result();
		}
	    public function blogsCount_all()
	    {
	        $this->db->from(TBL_NEWS." AS c");

	        return $this->db->count_all_results();
	    }


		/*-----------------------------------------------------------
		---------------------- Faq -----------------
		--------------------------------------------------------*/

		public function getFaqs(){
			return $this->db
							->select('q.*')
							->from(TBL_QUESTIONS.' as q')
			    		    ->where('Status', 1)
							->order_by('q.Q_ID', 'asc')
							->get()
							->result();
		}


		public function getFirstFaqs($limit=0,$start=0){
			    	return  $this->db
											->select('*')
											->from(TBL_QUESTIONS)
											->where('Status', 1)
											->limit($limit,$start)
											->get()
											->result();
		}

		// *******************************************
		// Note: CronJob used for Support Ticket to
		// close the ticket when no replay after 3 day
		// when status is [Answered, Customer reply] and Not yet sent
		// *******************************************
		public function getAllTicketsWithAnsweredStatus()
		{
			$query = $this->db->select('t.TicketId, t.Title, t.Status, t.Timestamp, t.updated_at, t.Is_send, c.Email, c.Fullname, c.APP_LANG')
							  ->from('customer_tickets as t')
							  ->join('customers as c', 'c.Customer_ID = t.CustomerId')
							  ->where('t.Status', 'Answered')
							  ->or_where('t.Status', 'Customer reply')
							  //->where('TicketId', 18) // for testing purpose only
							  ->group_by('TicketId')
							  ->get();
				return $query->result();
		}
		// Ends
		// *******************************************

	}
?>
