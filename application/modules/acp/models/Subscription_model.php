<?PHP
	class Subscription_model extends CI_Model{
		
		/*-----------------------------------------------------------
		---------------------- Subscriptions -----------------
		--------------------------------------------------------*/
	
		// #Add category function
		public function addSubscription($data = array()){
			$this->db->insert(TBL_CUSTOMER_SUBSCRIPTIONS, $data);
			return $this->db->insert_id();
		}
		
		// #get Category function
		public function getSubscriptions($data = array()){
			// $query = $this->db->order_by('SC_ID', 'asc')->get(TBL_CUSTOMER_SUBSCRIPTIONS);
			// return $query->result(); //AND (m.Expires_At >= now())

				$this->db->select('c.*,m.*,sp.*');
				$this->db->from(TBL_CUSTOMERS.' as c');
				$this->db->join(TBL_CUSTOMER_SUBSCRIPTIONS.' as m', 'c.Customer_ID = m.Customer_ID  ', 'left'); 
				//$this->db->join(TBL_CUSTOMER_SUBSCRIPTIONS.' as m1', 'm.Customer_ID = m1.Customer_ID AND m.SC_ID < m1.SC_ID AND (m.Starts_At <= now()) AND (m.Expires_At >= now())', 'left');
				$this->db->join('subscription_plans AS sp', 'm.TLD_ID = sp.TLD_ID'); 				
				$this->db->where('m.Starts_At <= ' , date('Y-m-d'));
			    $this->db->where('m.Expires_At >= ' , date('Y-m-d'));
			    $this->db->group_by('m.Customer_ID');

				//$this->db->where('m1.SC_ID IS NULL', null, true);
				
				return $this->db->get()->result(); 

		}
		
		// #get Category By ID function
		public function getSubscriptionByID($data = array()){
			$where = array('SC_ID' => $data['SC_ID']);
			$this->db->where($where);
			$query = $this->db->get(TBL_CUSTOMER_SUBSCRIPTIONS);
			return $query->row();
		}
		
		// #update Category function 
		public function updateSubscription($data = array()){
			$where = array('SC_ID' => $data['SC_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_CUSTOMER_SUBSCRIPTIONS, $data);
			return $query;

		}
		
		// #delete Category function 
		public function deleteSubscription($data = array()){
			$where = array('SC_ID' => $data['SC_ID']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_CUSTOMER_SUBSCRIPTIONS);
			return $query;

		}
		
		/*-----------------------------------------------------------
	---------------------- Subscription plans -----------------
	--------------------------------------------------------*/

	        function getPayedPlan(){

        	    $this->db->from(TLD);
                $this->db->select('*');
			    $this->db->where('Deleted IS NULL', null, true);

                $this->db->order_by('TLD_ID', 'ASC');

                return $this->db->get()->result();
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
	// #Add category function
		public function addPlan($data = array()){
			$this->db->insert(TLD, $data);
			return $this->db->insert_id();
		}
		
		// #get Category function
		public function getPlans($subscription_id = 0){
			if($subscription_id != 0){
				$this->db->where('Subscription_ID', $subscription_id);
			}
			$query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_SUBSCRIPTION_PLANS);
			return $query->result();
		}
		
		// #get Category By ID function
		public function getPlanByID($data = array()){
			$where = array('TLD_ID' => $data['TLD_ID']);
			$this->db->where($where);
			$query = $this->db->get(TLD);
			return $query->row();
		}

		public function getAllTlds(){

			
			$this->db->group_by('TLD_Name');
			$this->db->where('Deleted IS NULL', null, true);
			$query = $this->db->get(TLD);
			return $query->result();


		}
		
		// #update Category function 
		public function updatePlan($data = array()){
			$where = array('TLD_ID' => $data['TLD_ID']);
			$this->db->where($where);
			$query = $this->db->update(TLD, $data);
			return $query;

		}
		
		// #delete Category function 
		public function deletePlan($tld_id, $data = array()){
			$where = array('TLD_ID' => $tld_id);
			$this->db->where($where);
			$query = $this->db->update(TLD, $data);
			return $query;

		}
		
		public function deletePlansBySubscription($subscription_id = 0){
			$where = array('Subscription_ID' => $subscription_id);
			$this->db->where($where);
			$query = $this->db->delete(TBL_SUBSCRIPTION_PLANS);
			return $query;
		}
		
		/*-----------------------------------------------------------
		---------------------- Customer Subscription -----------------
		--------------------------------------------------------*/
	
		public function getCustomerSubscription($customer_id = 0)
		{
            $s = $this->db
						->select("sh.*, GROUP_CONCAT(dt.DType) as AllowedDietFeatures")
						->from(TBL_CUSTOMER_SUBSCRIPTION_HISTORY." as sh")
						->join(TBL_SUBSCRIPTION_PLANS." as p", "p.TLD_ID = sh.TLD_ID")
						->join("subscription_diet_types as sdt", "sdt.TLD_ID = p.TLD_ID", "LEFT")
						->join("diet_types as dt", "dt.DType_ID = sdt.DType_ID", "LEFT")
            			->where('sh.Customer_ID', $customer_id)
            			->where('sh.Payment_Verified', 1)
            			->order_by('sh.SCH_ID', 'DESC')
						->group_by("sdt.TLD_ID")
            			->limit(1)
            			->get();
            			
            return $s->row();
        }
        
		public function addSubscriptionHistory($data = array())
		{
			$this->db->insert(TBL_CUSTOMER_SUBSCRIPTION_HISTORY, $data);
			return $this->db->insert_id();
		}
		
		public function subscribeCustomer($data = array())
		{
			$this->db->where('Customer_ID', $data['Customer_ID'])->delete(TBL_CUSTOMER_SUBSCRIPTIONS);
			
			$this->db->insert(TBL_CUSTOMER_SUBSCRIPTIONS, $data);
			return $this->db->insert_id();
		}
		
		public function updateUserCredentials($data = array())
		{
			$id = $data['Customer_ID'];
			$this->db
					->where('Customer_ID', $id)
					->update(TBL_CUSTOMERS, $data);
			
			return $this->db->affected_rows();		
		}
		
		public function getPlanOptions($TLD_ID = 0){
			return $this->db->where("TLD_ID", $TLD_ID)->get("subscription_plan_options")->result();
		}
		
		public function addSubscriptionOptions($options_details = array()){
			$this->db->where("TLD_ID", $options_details["TLD_ID"])->delete("subscription_plan_options");
			
			foreach($options_details["Options"] as $option){
				$dt = array(
					"TLD_ID" => $options_details["TLD_ID"],
					"Option_ID" => $option
				);
				$this->db->insert("subscription_plan_options", $dt);
			}
		}
		
		public function getPlanDietTypes($TLD_ID = 0){
			return $this->db->where("TLD_ID", $TLD_ID)->get("subscription_diet_types")->result();
		}
		
		
		public function getSubscriptionLogs_Csv(){
			return $this->db->select('sh.CS_ID, sh.Timestamp, p.Plan_Name, p.Plan_Price, p.Plan_For_Months, sh.Payment_Source, c.Fullname, promo.Code, sh.Expires_At, dp.Created_By, sh.Balance, sh.PromoDiscount')
			         ->from(TBL_CUSTOMER_SUBSCRIPTION_HISTORY.' as sh')
					 ->join('promo_codes as promo', 'promo.Code = sh.PromoCode', 'LEFT')
			         ->join(TBL_SUBSCRIPTION_PLANS.' as p', 'p.TLD_ID = sh.TLD_ID')
			         ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = sh.Customer_ID')
			         // Note: added by A (29 Sep 2019) to display more data into export excell sheet
			         ->join('customer_diet_plan as cdp', 'cdp.Customer_ID = c.Customer_ID', 'LEFT')
					 ->join('diet_plans as dp', 'dp.Diet_ID = cdp.Diet_ID', 'LEFT')
			         // ends
					 ->where('sh.Payment_Verified', 1)
			         ->order_by('sh.Timestamp', 'desc')
					 ->get();
		}
		
		public function getSubscriptionLogs_Excel(){
			$logs = $this->getSubscriptionLogs_Csv();
			return $logs->result();
		}
		
	}
?>