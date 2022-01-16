<?PHP
	
class Resturants_model extends CI_Model{
		





        public function updateDietOrderStatus($data = '')
        {
            $where = array(
                'DCO_ID' => $data['DCO_ID']
            );
            $this->db->where($where);
            $query = $this->db->update('diet_customer_orders', $data);
            return $query;
            
        }


		public  function getTodayItems($current_week_nbr, $day){

            return $this->db
                                            ->select('i.*,dip.DCIP_ID,dip.Type_ID')
                                            ->from('diet_customers as dip')
                                            ->join('items as i', 'i.Item_ID = dip.Item_ID')
                                            //->where('dip.Diet_ID', $Diet_Plans_ID)
                                            ->where('dip.Week_ID', $current_week_nbr)
                                            ->where('dip.Day_ID', $day)
                                            //->where('dip.Period_ID', $period)
                                            //->where_in('dip.Type_ID', $available_types)
                                            //->where('dip.Customer_ID', $Customer_ID)
                                            ->get()
                                            ->result();

    }


    public function make_diet_customer_orders($order = array()){

            $this->db->insert('diet_customer_orders', $order);
            return $this->db->insert_id();
    }

    public function get_diet_customer_orders($order = array()){

             return  $this->db
                                            ->select('*')
                                            ->from('diet_customer_orders')
                                            ->where('Week_ID', $order['Week_ID'])
                                            ->where('Day_ID', $order['Day_ID'])
                                            ->where('Customer_ID', $order['Customer_ID'])
                                            ->where('SCH_ID', $order['SCH_ID'])
                                            ->where('Order_Date', $order['Order_Date'])
                                            ->get()
                                            ->row();

    }

    public function getAllActiveSubscriptionsAndDiscrit($date,$city,$district){


          $SQL = "

SELECT cs.*,dco.*,s.*,c.* 
FROM subscription_customers cs
RIGHT JOIN customers c ON c.Customer_ID = cs.Customer_ID 
RIGHT JOIN  (
              SELECT * FROM  diet_customer_orders  WHERE Order_Date = '$date' ORDER BY DCO_ID DESC 
          ) dco ON (dco.Customer_ID = cs.Customer_ID AND cs.SC_ID = dco.SC_ID)

RIGHT JOIN  (
              SELECT ccda.* FROM customer_current_delivery_address ccda             
               ORDER BY ccda.Delivery_ID DESC                 
          ) s ON (s.Customer_ID = cs.Customer_ID)         


WHERE cs.`SC_ID` IS NOT NULL 
GROUP BY cs.Customer_ID

 ";
          

    $ActiveSubscriptions =   $this->db->query($SQL)->result();

       foreach ($ActiveSubscriptions as $ActiveSubscription) {
                   
        $ActiveSubscription->District_ID =  $this->db
                                            ->select('*')
                                            ->from('customer_delivery_addresses as cda')
                                            ->join('districts as d', 'd.District_ID = cda.discrit')
                                            ->where('cda.Address_ID', $ActiveSubscription->Address_ID)
                                            ->where('cda.city', $city)
                                            ->get()
                                            ->row('District_ID');
       }


       return $ActiveSubscriptions;


    }



     public function getAllActiveDistricts($date,$city){



        $SQL = "
SELECT cs.*,dco.*,s.*
FROM subscription_customers cs
RIGHT JOIN  (
              SELECT * FROM  diet_customer_orders  WHERE Order_Date = '$date' ORDER BY DCO_ID DESC 
          ) dco ON (dco.Customer_ID = cs.Customer_ID AND cs.SC_ID = dco.SC_ID)

RIGHT JOIN  (
              SELECT ccda.* FROM customer_current_delivery_address ccda             
               ORDER BY ccda.Delivery_ID DESC                 
          ) s ON (s.Customer_ID = cs.Customer_ID)
          
WHERE cs.`SC_ID` IS NOT NULL
GROUP BY cs.Customer_ID
        ";
          
       $active_addresses =   $this->db->query($SQL)->result();

       $active_districts = array();
       foreach ($active_addresses as $active_address) {
                   
        $active_districts[] =  $this->db
                                            ->select('d.*,cda.*')
                                            ->from('customer_delivery_addresses as cda')
                                            ->join('districts as d', 'd.District_ID = cda.discrit')
                                            ->where('cda.Address_ID', $active_address->Address_ID)
                                            ->where('cda.city', $city)
                                            ->get()
                                            ->result();

       }

       return $active_districts;

                      
    }


        public function getAllActiveSubscriptions(){

    
        return  $this->db
                                            ->select('cs.*,c.*,sp.plan_type')
                                            ->from(TBL_CUSTOMER_SUBSCRIPTIONS.' as cs')

                                            ->join('customers as c', 'c.Customer_ID = cs.Customer_ID')

                                            ->join('subscription_plans as sp', 'cs.Plan_ID = sp.Plan_ID')

                                            ->where('sp.plan_type !=', 'plan_only')
                                            ->where('cs.Starts_At <=', date('Y-m-d'))
                                            ->where('cs.Expires_At >= ' , date('Y-m-d'))                                       

                                            ->group_by('cs.Customer_ID') 
                                            ->order_by('cs.SC_ID',"DESC")                                       
                                            ->get()
                                            ->result();


    }





    public function getAllSubscriptionFreezingDurations($SCH_ID = 0){
                    return  $this->db
                                     ->where('SCH_ID', $SCH_ID)
                                     ->get('subscription_freezing_durations')
                                     ->result();
        }

        

    public function getCurrentAddress($Address_ID=0){
             return  $this->db
                                            ->select('*')
                                            ->from('customer_delivery_addresses')
                                            ->where('Address_ID ' , $Address_ID)
                                            ->get()
                                            ->row();
    }

        public function getCurrentDiscrit($customer_id=0){
             return  $this->db
                                            ->select('cda.*')
                                            ->from('customer_current_delivery_address as ccda')
                                            ->join('customer_delivery_addresses as cda', 'cda.Address_ID = ccda.Address_ID')
                                            ->where('ccda.Customer_ID ' , $customer_id)
                                            ->order_by('ccda.Delivery_ID','desc')
                                            ->get()
                                            ->row();
    }

    public  function getItemsByPeriod($current_week_nbr, $day,$period,$customer_id=0){


         $active_subscriptions = $this->getAllActiveSubscriptions();


foreach ($active_subscriptions as $row) {


if($row->Customer_ID !=''){
//echo $row->Customer_ID.' '.$row->Starts_At.' '.$row->Expires_At.'dsfsd<br>';
    		$query[] =  $this->db
                                      
                                            ->select('*')
                                            ->from('diet_customers as dip')
                                            ->join('items as i', 'i.Item_ID = dip.Item_ID')                                      
                                            ->where('dip.Week_ID', $current_week_nbr)
                                            ->where('dip.Day_ID', $day)
                                            ->where('dip.Period_ID', $period)
                                            ->where('dip.Customer_ID', $row->Customer_ID)                              
                                            ->get()
                                            ->result();
                            }

                         }

       // var_dump($query);

//exit();
         return $query;

    }

        public  function getItemsByPeriodOnOrders($current_week_nbr, $day,$period,$customer_id=0){

             return $this->db
                                            ->select('*')
                                            ->from('diet_customers as dip')
                                            ->join('items as i', 'i.Item_ID = dip.Item_ID')                                       
                                            ->where('dip.Week_ID', $current_week_nbr)
                                            ->where('dip.Day_ID', $day)
                                            ->where('dip.Period_ID', $period)
                                            ->where('dip.Customer_ID', $customer_id)                                     
                                            ->get()
                                            ->result();
        

    }

    public  function countItemsByPeriodAndItemID($item_id,$Type_ID,$current_week_nbr, $day,$period,$is_weekend,$customer_id=0){




       $ss = $this->getAllActiveSubscriptions();


    $today            = date('Y-m-d');



                    $total_meals = 0;

foreach ($ss as $row) {


		        $subscription_type = $row->meal_period;
			     if($subscription_type == 58){ // صباحي
			      $assigned_meal_period = array(27,28);
			     }elseif ($subscription_type == 59){ //غداء
			       $assigned_meal_period = array(28);
			     }elseif ($subscription_type == 60){ // عشاء
			       $assigned_meal_period = array(28,29);
			     }elseif ($subscription_type == 61){ // كامل
			       $assigned_meal_period = array(27,28,29);
			     }

         $is_freezed = $row->Is_Freezed;


        if($is_freezed){
            $freezed_durations   = end($this->getAllSubscriptionFreezingDurations($row->SCH_ID));
            $Start_freezed_At    = $freezed_durations->Start_freezed_At;
            $End_freezed_At      = $freezed_durations->End_freezed_At;
        }

        if($is_freezed && ($Start_freezed_At <= $today) && ($End_freezed_At >= $today)){
              $is_freezed = 1;
        }else{
              $is_freezed = 0;
        }

if(in_array($period, $assigned_meal_period)  &&  !$is_freezed  &&  !(($row->include_weekend==31)&&($is_weekend)) ){
$query = $this->db
                                            ->select('*')
                                            ->from('diet_customers as dip')                                       
                                            ->where('dip.Week_ID', $current_week_nbr)
                                            ->where('dip.Day_ID', $day)
                                            ->where('dip.Type_ID', $Type_ID)
                                            ->where('dip.Period_ID', $period) 
                                            ->where('dip.Item_ID',$item_id)
                                            ->where('dip.Customer_ID', $row->Customer_ID)                                      
                                            ->get();
                     $total_meals += $query->num_rows();

                }
}
           	                


                   return  $total_meals;  
                                           

    }
		
		public function addResturant($data = array())
	    {
	        $query = $this->db->insert(TBL_RESTURANTS, $data);
	        return $this->db->insert_id();
	    }
	    
	    // #get project by id 
	    public function getResturantByID($data = '')
	    {
	        $where = array(
	            'Store_ID' => $data['Store_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->get(TBL_RESTURANTS);
	        return $query->result();
	    }
	    
	    // #update project function 
	    public function updateResturant($data = '')
	    {
	        $where = array(
	            'Store_ID' => $data['Store_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->update(TBL_RESTURANTS, $data);
	        return $query;
	        
	    }
	    
	    // #delete project function 
	    public function deleteResturant($data = array())
	    {
	        $where = array(
	            'Store_ID' => $data['Store_ID']
	        );
	        $this->db->where($where);
	        $query = $this->db->delete(TBL_RESTURANTS);
/*
	        if ($query) {
	            $where1 = array(
	                'Store_ID' => $data['Store_ID']
	            );
	            $this->db->where($where1);
	            $query1 = $this->db->delete(TBL_CLASS_DETAILS);
	            return $query;
	        }
*/
	        
	    }
		
	/**
		*------- Orders List *---------
	**/

	var $order_columns_1  = array('r.Store_ID', 'r.TimeStamp', 'r.StoreName_en', 'r.Phone', 'TotalProducts', 'r.Status');
	private function _get_resturants_query()
	{
		
		$where_mobile_no = '';
		$where_name = '';
		
		if(!empty($_POST['mobile_no'])){
			$phone = $_POST['mobile_no'];
			$where_mobile_no = "r.Phone = '$phone' AND";
		}
		
		if(!empty($_POST['name'])){
			$name = $_POST['name'];
			$where_name = "(r.StoreName_en LIKE '%$name%' OR r.StoreName_ar LIKE '%$name%') AND";
		}
		
		$where = "$where_mobile_no $where_name r.Phone >= 0";
		
	    $this->db->distinct();
        $this->db->select('r.*, COUNT(*) as TotalProducts'); 
        $this->db->from(TBL_RESTURANTS." AS r");
        $this->db->join(TBL_USERS.' as u', 'u.User_ID = r.User_ID');
        $this->db->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Store_ID = r.Store_ID');
        $this->db->join(TBL_CLASS_SUBCATEGORIES.' as psc', 'psc.Category_ID = pc.Category_ID');
        $this->db->join(TBL_CLASSES.' as p', 'p.SubCategory_ID = psc.SubCategory_ID');
        $this->db->where($where);
        $this->db->group_by('r.Store_ID');
        
        //print_r($_POST['order']);
	    if(isset($_POST['order'])){
		    $ind = $_POST['order'][0]['column'];
		    $oColumn = $this->order_columns_1[$ind];
			$direction = $_POST['order'][0]['dir'];
			$where_order = "$oColumn $direction";
			$this->db->order_by($where_order);
	    } else {
		    $this->db->order_by("r.Store_ID", "DESC");
	    }
    }
 
    function getResturantsList()
    {
        $this->_get_resturants_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function resturantsCount_filtered()
    {
        $this->_get_resturants_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function resturantsCount_all()
    {
        $this->db->from(TBL_RESTURANTS." AS r");

        return $this->db->count_all_results();
    }
		
}
	
?>