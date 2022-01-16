<?PHP
	class Testimonials_model extends CI_Model 
	{	
		
		public function getAllCustomerReview()
		{
			return $this->db->select('*')
			       			->from('testimonials')
			       			->order_by('Order_In_List', 'desc')
			       			->get()
							->result();
		}
		
		public function addCustomerReview($data = array())
		{
			return $this->db->insert('testimonials', $data);
		}
		
		public function getCustomerReviewByID($id = 0)
		{
			return $this->db->select('*')
			       			->from('testimonials')
			       			->order_by('Order_In_List', 'desc')
			       			->where('ID', $id)
			       			->get()
							->result();
		}
		
		public function updateCustomerReview($data = array()){
			
			return $this->db
					->where('ID', $data['ID'])
					->update('testimonials', $data);
			
		}
		
		public function deleteCustomerReview($id = 0){
			return $this->db
					->where('ID', $id)
					->delete('testimonials');			
		}
			
	}
?>