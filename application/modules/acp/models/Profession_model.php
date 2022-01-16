<?PHP
	class Profession_model extends CI_Model{
		
		/*-----------------------------------------------------------
		---------------------- CATEGORIES Section -----------------
		--------------------------------------------------------*/
	
		// #Add category function
		public function addCategory($data = array()){
			$query = $this->db->insert(TBL_CUST_PROFESSIONS, $data);
			return  $query;
		}
		
		// #get Category function
		public function getcategories($data = array()){
			$query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_CUST_PROFESSIONS);
			return $query->result();
		}
		
		// #get Category By ID function
		public function getCategoryByID($data = array()){
			$where = array('Category_ID' => $data['category_id']);
			$this->db->where($where);
			$query = $this->db->get(TBL_CUST_PROFESSIONS);
			return $query->result();
		}
		
		// #update Category function 
		public function updateCategory($data = array()){
			$where = array('Category_ID' => $data['Category_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_CUST_PROFESSIONS, $data);
			return $query;

		}
		
		// #delete Category function 
		public function deleteCategory($data = array()){
			$where = array('Category_ID' => $data['category_id']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_CUST_PROFESSIONS);
			return $query;

		}
		
	}
?>