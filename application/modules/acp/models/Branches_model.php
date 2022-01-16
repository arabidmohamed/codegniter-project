<?PHP
	
	class Branches_model extends CI_Model
	{
		
		public function getAll($id = 0)
		{
			if($id != 0)
			{
				$this->db->where('b.Branch_ID', $id);
			}
			
			$branches = $this->db
								->select('b.*,b.Address as branch_address,c.*')
								->from('branches as b')
								->join('Customers as c','c.Customer_ID  = b.Branch_Manager_ID')
								->order_by('b.Timestamp', 'DESC')
								->get();
			
			if($id != 0)
			{
				return $branches->row();
			}
			
			return $branches->result();
			
		}

		public function getAllBranchManagers(){
			return $this->db
								->select('*')
								->from('Customers')
								->where('Customer_Type','branch_manager')
								->where('Status',1)

								->get()->result();
		}
		
		public function add($branch = array())
		{
			$this->db->insert('branches', $branch);
			return $this->db->insert_id();
		}
		
		public function update($branch = array())
		{
			$this->db->where('Branch_ID', $branch['Branch_ID']);
			
			return $this->db->update('branches', $branch);
		}
		
		public function delete($id = 0)
		{
			return $this->db->where('Branch_ID', $id)->delete('branches');
		}
		
	}
	
?>