<?php
	

		class Wallet_model extends CI_Model{


	// public function getCustomerCredits($customer_id = 0, $is_paid = 1)
	// {
 //    	return $this->db
 //    					->where('Customer_ID', $customer_id)
 //    					->get(TBL_CUSTOMER_CREDITS)
 //    					->row();	
	// }
	
	// ********************************************
	// Note: Credits for customers 
	// ********************************************
	public function getCreditValueFromCustomer($customer_id = 0)
	{
    	return $this->db->where('Customer_ID', $customer_id)->get('customers_wallet')->row();
	}	

	public function getCustomerTransactions($customer_id = 0){
			return $this->db
							->where('Customer_ID', $customer_id)
							->order_by('Created_at', 'DESC')
							->get('customers_wallet')
							->result();
	}
	
	 public function getCustomerCredit($userid = 0){
	    return $this->db
    					->select('SUM(Credits) as TotalCredit')
    					->from('customers_wallet')
    					->where('Customer_ID', $userid)
    					->where('Type', '+')
    					->order_by('Created_at', 'DESC')
    					->get()
    					->result();
    }
    
    public function getCustomerDepit($userid = 0){
	    return $this->db
    					->select('SUM(Credits) as TotalDepit')
    					->from('customers_wallet')
    					->where('Customer_ID', $userid)
    					->where('Type', '-')
    					->order_by('Created_at', 'DESC')
    					->get()
    					->result();
    }

	public function modifyCreditsForCustomers($data = array())
	{
	    $this->db->insert('customers_wallet', $data);
	    return $this->db->insert_id();
	}
	// Ends
	// ********************************************
	var $credits_order  = array('', 'c.Fullname', 'c.Email');
    private function _get_customer_credits()
    {
	    $where_name = '';
	    $where_email = '';
	    $where_credits = '';
	    
	    if(!empty($_POST['name']))
	    {
			$name = $_POST['name'];
			$where_name = "c.Fullname LIKE '%$name%' AND";
		}
		
		if(!empty($_POST['email']))
	    {
			$email = $_POST['email'];
			$where_email = "c.Email LIKE '%$email%' AND";
		}
		
		if(!empty($_POST['credits']))
		{
			$credits = $_POST['credits'];
			$limit = $_POST['limit'];
			$where_credits = "cd.Was_Price $limit $credits AND";
			
		} else {
			
			$where_credits = "cd.Was_Price != 0";
		}
		
		$where = "{$where_name} {$where_email} {$where_credits}";
		
		// Note: updated by A (10 Oct 2019) to get the total of all sales
				
		$credits = "(SELECT SUM(ch.Credits_Paid) FROM ".TBL_CC_HISTORY." as ch WHERE ch.Customer_ID = c.Customer_ID) as Total_Paid_Credits";	
			
		$this->db
				->distinct()
				->select("cd.Timestamp, c.Customer_ID , c.Email, c.Fullname, c.Picture, SUM(cd.Was_Price) as Total_Sales")
				->select("{$credits}")
				->from(TBL_CUSTOMERS." as c")
				->join(TBL_PICTURES.' as p', 'p.Customer_ID = c.Customer_ID')
				->join(TBL_CUSTOMER_DOWNLOADS.' as cd', 'cd.Picture_ID = p.Picture_ID')				
				->group_by('c.Customer_ID')
				->where($where);		
		// Ends			
				
		if(isset($_POST['order']))
		{
		    $ind = $_POST['order'][0]['column'];
		    $oColumn = $this->credits_order[$ind];
			$direction = $_POST['order'][0]['dir'];
			$where_order = "$oColumn $direction";
			$this->db->order_by($where_order);
	    } else {
		    $this->db->order_by("cd.Timestamp", "DESC");
	    }
    }
    
    /*************************************************************/
	
	public function getCustomerCredits()
    {
	    // if($_POST['length'] != -1)
     //    $this->db->limit($_POST['length'], $_POST['start']);
		
		$this->_get_customer_credits();		
        $data = $this->db->get();
        
        //echo $this->db->last_query();
        
		return $data->result();
    }
    
    function creditsCount_all()
    {
        $this->_get_customer_credits();	
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }
 
    public function creditsCount_filtered()
    {
        $this->_get_customer_credits();	
        return $this->db->get()->num_rows();
    }
}
?>