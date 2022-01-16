<?PHP
	class Portfolio_model extends CI_Model
	{
		
		/*
			------ Portfolio CATEGRORIES --------
		*/
		public function addCategory($data = array())
		{
			$this->db->insert(TBL_PORTFOLIO_CATEGORIES, $data);
			return  $this->db->insert_id();
		}
			
		public function getcategories($data = array())
		{
			$query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_PORTFOLIO_CATEGORIES);
			return $query->result();
		}
		
		public function getActivecategories($data = array())
		{
			$this->db->where(array('Status' => 1));
			$query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_PORTFOLIO_CATEGORIES);
			return $query->result();
		}
		
		public function getCategoryByID($data = array())
		{
			$where = array('Category_ID' => $data['category_id']);
			$this->db->where($where);
			$query = $this->db->get(TBL_PORTFOLIO_CATEGORIES);
			return $query->result();
		}
		
		public function updateCategory($data = array())
		{
			$where = array('Category_ID' => $data['Category_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_PORTFOLIO_CATEGORIES, $data);
			return $query;

		}
		
		public function deleteCategory($data = array())
		{
			$where = array('Category_ID' => $data['category_id']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_PORTFOLIO_CATEGORIES);
			return $query;

		}
		
		/*
			------ PORTFOLIOs --------
		*/

		public function add($data = array())
		{
			$query = $this->db->insert(TBL_PORTFOLIO, $data);
			return  $this->db->insert_id();
		}
		
		public function getAll()
		{
			$query = $this->db
							->select('al.*, alc.Category_en, alc.Category_ar, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr')
							->from(TBL_PORTFOLIO.' as al')
							->join(TBL_PORTFOLIO_CATEGORIES.' alc', 'alc.Category_ID = al.Category_ID')
							->join(TBL_SECTIONS.' as s', 's.Section_ID = al.Section_ID')
							->get();
							
			return $query->result();
		}
		
		public function getByID($data = '')
		{
			$where = array('Portfolio_ID' => $data['portfolio_id']);
			$this->db->where($where);
			$query = $this->db->get(TBL_PORTFOLIO);
			return $query->result();
		}
		
		public function update($data = '')
		{
			$where = array('Portfolio_ID' => $data['Portfolio_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_PORTFOLIO, $data);
			return $query;

		}
		
		public function delete($data = array())
		{
			$where = array('Portfolio_ID' => $data['portfolio_id']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_PORTFOLIO);
			if($query)
			{
				$where1 = array('Portfolio_ID' => $data['portfolio_id']);
				$this->db->where($where1);
				$query1 = $this->db->delete(TBL_PORTFOLIO_DETAILS);
				return $query;
			}

		}
		
		
		/*
			------ Portfolio DETAILS --------
		*/
		
		public function addDetails($data = array())
		{
			$query = $this->db->insert(TBL_PORTFOLIO_DETAILS, $data);
			return  $this->db->insert_id();
		}
		
		// #get Portfolio detail
		public function getDetails($data = '')
		{
			$where = array('Portfolio_ID' => $data['portfolio_id']);
			$this->db->where($where);
			$query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_PORTFOLIO_DETAILS);
			return $query->result();
		}
		
		// #get Portfolio details by id
		public function getDetailByID($data = '')
		{
			$where = array('AD_ID' => $data['portfolioDet_ID']);
			$this->db->where($where);
			$query = $this->db->get(TBL_PORTFOLIO_DETAILS);
			return $query->result();
		}
		
		public function updateDetails_ARR($data = array())
		{
			$upd = array(
				'Portfolio_ID' => $data['Portfolio_ID']
			);
			foreach($data["AD_ID"] as $id){
				$where = array('AD_ID' => $id);
				$this->db->where($where);
				$query = $this->db->update(TBL_PORTFOLIO_DETAILS, $upd);	
			}
			return $query;
		}
		
		// #update Portfolio details
		public function updateDetails($data = array())
		{
			$where = array('AD_ID' => $data['AD_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_PORTFOLIO_DETAILS, $data);
			return $query;
		}

		// #delete Portfolio details function 
		public function deleteDetail($data = array())
		{
			$where = array('AD_ID' => $data['portfolioDet_ID']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_PORTFOLIO_DETAILS);
			return $query;

		}
		
		public function getImages($data = array())
		{
		    $where = array(
	            'p.Portfolio_ID' => $data['portfolio_id']
	        );
	       return $this->db->select('p.Thumbnail, pd.Details')
	       					->from(TBL_PORTFOLIO.' as p')
	       					->join(TBL_PORTFOLIO_DETAILS.' as pd', 'pd.Portfolio_ID = p.Portfolio_ID')
	       					->where($where)->get()->result();
		}
		
		public function getPDImageName($id)
		{
			return $this->db->where('AD_ID', $id)->get(TBL_PORTFOLIO_DETAILS)->result()[0]->Details;
		}
		
		public function deletePDImage($id)
		{
			return $this->db->where('AD_ID', $id)->delete(TBL_PORTFOLIO_DETAILS);
		}
	}
	
?>