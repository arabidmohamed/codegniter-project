<?PHP
	class Customer_model extends CI_Model{

		 /*-----------------------------------------------------------
    ---------------------- Authentication -----------------
    --------------------------------------------------------*/

    public function deleteCustomer($data = array()){
        return $this->db->where('Customer_ID', $data['Customer_ID'])->update(TBL_CUSTOMERS, $data);
    }

    // #Login Function
    public function checkAuthentication($data = array())
    {
        $username = $data['Username'];

        // check string
        if(is_numeric($username)){

	        $this->db->where('Phone', $username);
            $this->db->where('Guest', 0);
        } else {

	        $this->db->where('Email', $username);
        }

        $this->db->where('Status',1);
        $this->db->where('Deleted_At',NULL);

        $dt = $this->db->get(TBL_CUSTOMERS);
        if ($dt->num_rows() == 1) {
            return $dt->result();
        } else {
            return null;
        }
    }

    public function getUserByEmail($email){
         $where = array(
            'Email' => $email
        );
        $this->db->where($where);
        $dt = $this->db->get(TBL_CUSTOMERS);
        return $dt->result();
    }

    public function getUserByPhone($phone){
         $where = array(
            'Phone' => $phone
        );
        $this->db->where($where);
        $dt = $this->db->get(TBL_CUSTOMERS);
        return $dt->result();
    }
    
     // #get user function
    public function getUser($data = array())
    {
        $where = array(
            'Customer_ID' => $data['user_id']
        );
        $this->db->where($where);
        $dt = $this->db->get(TBL_CUSTOMERS);
        return $dt->result();
    }

    public function check_email($data = array()){
	    $email = $data['email'];
	    $id = $data['id'];
	    $q = $this->db->query("SELECT * FROM `".TBL_CUSTOMERS."` WHERE `Phone` = '$email' AND `Customer_ID` != $id");
	    if ($q->num_rows() > 0) {
            return 1;
        }
        return 0;

    }

    public function checkResetPasswordToken($reset_token = ''){
	    $q = $this->db->query("SELECT * FROM `".TBL_CUSTOMERS."` WHERE `Reset_Token` = '$reset_token' AND Status = 1");
	    if ($q->num_rows() > 0) {
            return 1;
        }
        return 0;

    }


            public function getAllItems($week_id = 0,$day_id = 0,$period_id=0,$type_id=0,$item_id=0){
                   return $this->db
                            ->select('*')
                            ->from('items')

                            ->where("FIND_IN_SET(".$week_id.",available_weeks) >",0)
                            ->where("FIND_IN_SET(".$day_id.",week_days) >",0)
                            ->where("FIND_IN_SET(".$period_id.",meal_period) >",0)
                            ->where("FIND_IN_SET(".$type_id.",meal_type) >",0)
                            ->where("Item_ID !=",$item_id)
                            ->where("Is_Deleted", 0)

                            ->get()
                            ->result();

        }

        public function deleteCustomeItems($dcip=0) {


                                            $this->db->where('DCIP_ID',  $dcip);

                                    $del=$this->db->delete('diet_customers');
            return $del;

        }
/*
    public function check2_email($data = array()){
	    $email = $data['email'];
	    $id = $data['id'];
	    $q = $this->db->query("SELECT * FROM `".TBL_CUSTOMERS."` WHERE `Phone` = '$email' AND `Customer_ID` = $id");
	    if ($q->num_rows() > 0) {
            return 1;
        }
        return 0;
    }
*/




    public function isLoggedIn_check($data = array())
    {
        $where = array(
            'Customer_ID' => $data['user_id'],
            'Email' => $data['email']
        );

        $this->db->where($where);
        $dt = $this->db->get(TBL_CUSTOMERS);

        if ($dt->num_rows() == 1) {
            return $dt->num_rows();
        } else {
            return 0;
        }
    }

     /*-----------------------------------------------------------
    ---------------------- #Mobile Reset Password -----------------
    --------------------------------------------------------*/
    
    public function checkUserNumber($data = array())
    {
        //header('Content-Type: application/json');
        $this->db->where($data);
        $result = $this->db->get(TBL_CUSTOMERS);
        $dt     = $result->result();


        if ($result->num_rows() == 1) {
            return array(
                'info' => '1'
            );
            
        }
        
        if ($result->num_rows() != 1) {    
        return json_encode(array(
                'info' => '0',
                'msg' => getSystemString(184)
            ));
        }    
    }

    public function verifySMSLimitVerification($data = array())
    {
        $phone = $data['Phone'];
	    $token = $data['Verify_Token'];
	    $query = $this->db->query("UPDATE ".TBL_CUSTOMERS." SET Verify_Token = '{$token}', Total_SMS_Sent = Total_SMS_Sent + 1 WHERE Phone = '{$phone}'");

         $query = $this->db->query("UPDATE ".TBL_CUSTOMERS." SET Verify_Token = '{$token}', Total_SMS_Sent = Total_SMS_Sent + 1 WHERE Changed_Phone = '{$phone}'");
		/*
					echo $this->db->last_query();
					die();
		*/
        return $this->db->affected_rows();
    }

    /*-----------------------------------------------------------
    ---------------------- #Email Reset Password -----------------
    --------------------------------------------------------*/

    //password reset @check user if exists then send email
	public function checkUserEmail($data = array()){
		header('Content-Type: application/json');

		 $this->db->where($data);
		 $result = $this->db->get(TBL_CUSTOMERS);
		 $dt = $result->result();

		 if($result->num_rows() == 1){

			 //generate reset token
			 $reset_token = urlencode(md5(time().'qz'.rand(1000, 99999).rand(100, 999)));

			 $upd = array('Reset_Token' => $reset_token);
			 $this->db->where(array('Customer_ID' => $dt[0]->Customer_ID));
			 $q = $this->db->update(TBL_CUSTOMERS, $upd);

			 if($q){
				return array('info' => '1', 'reset_token' => $reset_token);
			 }
		 }

		 return json_encode(array('info' => '0', 'msg' => getSystemString(188)));
	}

	public function updateUserPassword($data = array(), $reset_token = ''){
		return $this->db->where('Reset_Token', $reset_token)->update(TBL_CUSTOMERS, $data);
	}

   /*-----------------------------------------------------------
    ---------------------- SMS & Tokens -----------------
    --------------------------------------------------------*/
    public function changeMobilePhone($Customer_ID){
            $customer = $this->db
                             ->where('Customer_ID', $Customer_ID)
                             ->get(TBL_CUSTOMERS)
                             ->row();

        $data = array(
            'Phone' => $customer->Changed_Phone,
            'Phone_Key' => $customer->Changed_Phone_key,
            'Changed_Phone'=> NULL,
            'Changed_Phone_Key'=> NULL

        );

        $this->db->where('Customer_ID',$Customer_ID);
        $this->db->update(TBL_CUSTOMERS, $data);
        return $this->db->affected_rows();

    }

    public function changeNewEmail($Customer_ID,$changed_email){

        $data = array(
            'Email' => $changed_email,       
            'Changed_Email'=> NULL,          
        );

        $this->db->where('Customer_ID',$Customer_ID);
        $this->db->update(TBL_CUSTOMERS, $data);
        return $this->db->affected_rows();

    }


    public function ResetTotalSMSSentLimit($phone){
        return $this->db->where('Phone', $phone)->where('Guest', 0)->update(TBL_CUSTOMERS, array('Total_SMS_Sent' => 1));
    }
    
    public function checkTotalSMSSent($phone){
        return $this->db->select('*')->where('Phone', $phone)->or_where('Changed_Phone', $phone)->where('Guest', 0)->get(TBL_CUSTOMERS)->result();
    }
    
    public function updateUserToken($data = array()){
        $phone = $data['Phone'];
        $Verify_Token = $data['Verify_Token'];
        $query = $this->db->query("UPDATE ".TBL_CUSTOMERS." SET Verify_Token = '{$Verify_Token}', Total_SMS_Sent = Total_SMS_Sent + 1 WHERE Phone = '{$phone}'");
        //echo $this->db->last_query();
        return $query;
    }
    
    public function verifyPasswordToken($token = ''){
        return $this->db->where('Verify_Token', $token)->get(TBL_CUSTOMERS)->num_rows();
    }
    
    public function updateUserPasswordUsingToken($data = array()){
        // $upd = array(
        //     'Password' => $data['Password'],
        //     'Verify_Token' => 0
        // );
        // return $this->db->where('Verify_Token', $data['token'])->update(TBL_CUSTOMERS, $upd);

        $phone = $data['Phone'];
        $password = $data['Password'];
    $query = $this->db->query("UPDATE ".TBL_CUSTOMERS." SET Verify_Token = 0 ,Password = '{$password}', Total_SMS_Sent = Total_SMS_Sent + 1 WHERE Phone = '{$phone}'");
        //echo $this->db->last_query();
        return $query;
    }

    public function update_two_fa_token($two_fa_token,$verify_page_token,$customer_id){
        $where = array(
        'Customer_ID' => $customer_id,
        );
        $upd = array(
        'Two_Factor_Token' => $two_fa_token,
        'Verify_Page_Token' => $verify_page_token
        );

        $this->db->where($where);
        $this->db->update(TBL_CUSTOMERS, $upd);
    }

    public function updateUserVerifyToken($verify_token,$verify_page_token,$customer_id,$reset = 0){

        $where = array(
        'Customer_ID' => $customer_id,
        );
        $upd = array(
        'Verify_Token' => $verify_token,
        'Verify_Page_Token' => $verify_page_token
        );
        if($reset){
               $upd = array(
                'Verify_Token' => $verify_token,
                'Verify_Page_Token' => $verify_page_token,
                'Phone_Verified' => 0,
                );
        }
        $this->db->where($where);
        $this->db->update(TBL_CUSTOMERS, $upd);
    }

    /*-----------------------------------------------------------
    ---------------------- Add Member #Account -----------------
    --------------------------------------------------------*/

    public function addMember($data = array()){
		//check if register as guest before
		$guest = $this->db->where("Guest", 1)->where("Email", $data["Email"])->get(TBL_CUSTOMERS)->row();
		if(count($guest) > 0){
			$data["Guest"] = 0;
			return $this->db->where("Guest", 1)->where("Email", $data["Email"])->update(TBL_CUSTOMERS, $data);
		}

              $this->db->insert(TBL_CUSTOMERS,$data);
              $insert_id = $this->db->insert_id();
             return  $insert_id;
    }


	// Note: added by A (21 Oct 2019) to check the unique pone
	public function isPhoneUnique($key = '',$phone = ''){

		return $this->db->where("Phone", $phone)
                        ->where("Phone_Key", $key)
                        ->where('Status', 1)
                        ->where('Deleted_At', NULL)
                        ->get(TBL_CUSTOMERS)
                        ->result();
	}
    public function isEmailUnique($email = ''){

        return $this->db->where("Email", $email)
                        ->where('Status', 1)
                        ->where('Deleted_At', NULL)
                        ->get(TBL_CUSTOMERS)
                        ->result();
    }
	// Ends

    /*-----------------------------------------------------------
    ---------------------- Account Verification -----------------
    --------------------------------------------------------*/

      public function getUserByPhoneAndVerifyPageToken($data = array())
    {
        $where = array(
            //'Phone' => $data['phone'],
            'Verify_Page_Token' => $data['verify_page_token'],
        );

        $this->db->where($where);

        $dt = $this->db->get(TBL_CUSTOMERS);

            return $dt->result();

    }

      // verify by mobile
    public function getUserByVerifyToken($data = array())
    {
        $where = array(
            'Verify_Token' => $data['Verify_Token'],
            'Verify_Page_Token' => $data['Verify_Page_Token'],
            'Phone_Verified' =>1,
        );
        $this->db->where($where);

        $dt = $this->db->get(TBL_CUSTOMERS);
        if ($dt->num_rows() == 1) {
            return $dt->result();
        } else {
            return array(
                'result' => getSystemString(11)
            );
        }

    }

    public function getUserByTwoFAtoken($data = array())
    {
        $where = array(
            'Two_Factor_Token' => $data['Two_Factor_Token'],
            'Verify_Page_Token' => $data['Verify_Page_Token'],
            'Phone_Verified' =>1,
        );
        $this->db->where($where);

        $dt = $this->db->get(TBL_CUSTOMERS);
        if ($dt->num_rows() == 1) {
            return $dt->result();
        } else {
            return array(
                'result' => getSystemString(11)
            );
        }

    }

    // verify by mobile
    public function getUserByVerifyTokenV2($data = array())
    {
        $where = array(
            'Verify_Page_Token' => $data['Verify_Page_Token'],
            'Phone_Verified' =>1,
        );
        $this->db->where($where);

        $dt = $this->db->get(TBL_CUSTOMERS);
        if ($dt->num_rows() == 1) {
            return $dt->result();
        } else {
            return array(
                'result' => getSystemString(11)
            );
        }

    }

    // verify by mobile
    public function verifyUser($data = array())
    {
        $where = array(
            'Verify_Token' => $data['Verify_Token'],
            'Verify_Page_Token' => $data['Verify_Page_Token'],
        );
        $this->db->where($where);
        $this->db->update(TBL_CUSTOMERS, $data);

        return $this->db->affected_rows();
    }

    // verify by mobile
    public function verifyUserV2($data = array())
    {
        $where = array(
            'Verify_Page_Token' => $data['Verify_Page_Token'],
        );
        $this->db->where($where);
        $this->db->update(TBL_CUSTOMERS, $data);

        return $this->db->affected_rows();
    }

    // verify by email
    public function verifyUserEmail($data = array())
    {
        $where = array(
            'Verify_Page_Token' => $data['Verify_Page_Token'],
        );
        $this->db->where($where);
        $this->db->update(TBL_CUSTOMERS, $data);

        return $this->db->affected_rows();
    }

    public function updateCustomerVerificationToke($email = '', $token = ''){
	    $where = array(
            'Email' => $email,
        );
        $this->db->where($where);
        $this->db->update(TBL_CUSTOMERS, array("Verify_Page_Token" => $token));

        return $this->db->affected_rows();
    }

    /*-----------------------------------------------------------
    ---------------------- Profile -----------------
    --------------------------------------------------------*/


    public function isHaveActivePayedSubscription($customer_id = 0){
             $this->db->select("*");
             $this->db->where('Customer_ID', $customer_id);
             //$this->db->where('Starts_At <= ' , date('Y-m-d', strtotime("+3 day")));
             $this->db->where('Expires_At >= ' , date('Y-m-d'));
             $this->db->order_by('SCH_ID',"DESC");
            $result =  $this->db->get(TBL_CUSTOMER_SUBSCRIPTIONS)->row();

            // if(empty($result)){
            //     $this->db->select("*");
            //      $this->db->where('Customer_ID', $customer_id);
            //      $this->db->where('Starts_At <= ' , date('Y-m-d'));
            //      $this->db->where('Expires_At >= ' , date('Y-m-d'));
            //      $this->db->order_by('SCH_ID',"DESC");
            //     $result =  $this->db->get(TBL_CUSTOMER_SUBSCRIPTIONS)->row();
            // }

            if(!empty($result)){
                return True;
            }
            return False;
    }

    public function getActivePayedSubscription($customer_id = 0){
             $this->db->select("*");
             $this->db->where('Customer_ID', $customer_id);
             //$this->db->where('Starts_At <= ' , date('Y-m-d', strtotime("+3 days")));
             $this->db->where('Expires_At >= ' , date('Y-m-d'));
             $this->db->order_by('SCH_ID',"DESC");
            $result =  $this->db->get(TBL_CUSTOMER_SUBSCRIPTIONS)->row();
            return $result;
    }

    public function getAllCustomerBmiValues($customer_id = 0){
            return $this->db->where("Customer_ID", $customer_id)->order_by('BMI_ID',"DESC")->get('customer_bmi')->result();
    }
    public function getLastCustomerBmiValues($customer_id = 0){
            return $this->db->where("Customer_ID", $customer_id)->order_by('BMI_ID',"DESC")->get('customer_bmi')->row();
    }

    public function getCurrentActiveSubscription($customer_id = 0){
       

                $this->db->select("*");
            $this->db->where('Customer_ID', $customer_id);
             $this->db->where('Starts_At <= ' , date('Y-m-d'));
             $this->db->where('Expires_At >= ' , date('Y-m-d'));
             $this->db->order_by('SC_ID',"DESC");
            $result =  $this->db->get(TBL_CUSTOMER_SUBSCRIPTIONS)->row();

            if(empty($result)){
                 $this->db->select("*");
            $this->db->where('Customer_ID', $customer_id);
             //$this->db->where('Starts_At <= ' , date('Y-m-d', strtotime("+3 days")));
             $this->db->where('Expires_At >= ' , date('Y-m-d'));
             $this->db->order_by('SC_ID',"DESC");
            $result =  $this->db->get(TBL_CUSTOMER_SUBSCRIPTIONS)->row();
            }

            if(empty($result)){
                $this->db->select("*");
                $this->db->where('Customer_ID', $customer_id);
                $this->db->where('Plan_ID' , 1);
                $this->db->order_by('SC_ID',"DESC");
                $result =   $this->db->get(TBL_CUSTOMER_SUBSCRIPTIONS)->row();
            }
            return $result;
        }

function getMostRelevantDietPlan($Customer_ID = 0){

    $customer_preferance = $this->db
                                            ->select('goals,interests,activities')
                                            ->from('customer_preferences')
                                            ->where('Customer_ID', $Customer_ID)
                                            ->limit(1)
                                            ->order_by('ID','DESC')
                                            ->get()
                                            ->row();

    $Plan_Objectives = $customer_preferance->goals;
    $Plan_Programs   = $customer_preferance->interests;
    $Plan_activities = $customer_preferance->activities;



        $this->db->select('*');
        foreach ($Plan_Objectives as $objective) {
           $this->db->where("FIND_IN_SET(".$objective.",Plan_Objectives) >",0);
        }
        foreach ($Plan_Programs as $program) {
           $this->db->where("FIND_IN_SET(".$program.",Plan_Programs) >",0);
        }
        foreach ($Plan_activities as $activity) {
           $this->db->where("FIND_IN_SET(".$activity.",Plan_activities) >",0);
        }
                                $this->db->limit(1);
                                $this->db->order_by('Diet_Plans_ID','DESC');

return $this->db->get('diet_plans')->row();


}


function getPlanItems($diet_id = 0){
    return $this->db
                                            ->select('dip.*')
                                            ->from('diet_items_plans as dip')
                                            ->join('items as i', 'i.Item_ID = dip.Item_ID')
                                            ->where("i.Is_Deleted", 0)
                                            ->where('dip.Diet_ID', $diet_id)
                                            ->where("i.Is_Deleted", 0)
                                            ->get()
                                            ->result();
}

function getAssignedCustomerPlanByCustomerID($Customer_ID = 0,$SCH_ID=0){
     return $this->db
                                            ->select('*')
                                            ->from('diet_customers')
                                            ->where('Customer_ID', $Customer_ID)
                                            ->where('SCH_ID', $SCH_ID)
                                            ->limit(1)
                                            ->order_by('DCIP_ID','DESC')
                                            ->get()
                                            ->row();
}

    function getAssignedCustomerPlanWithItemsByCustomerID($Customer_ID = 0){


            return $this->db
                                            ->select('i.Thumbnail,i.Status,i.Title_en,i.Title_ar,dip.*')
                                            ->from('diet_customers as dcp')
                                            ->join('diet_items_plans as dip', 'dcp.Diet_ID = dip.Diet_ID')
                                            ->join('items as i', 'i.Item_ID = dip.Item_ID')
                                            ->where('dcp.Customer_ID', $Customer_ID)
                                            ->get()
                                            ->result();

    }

        function getItemBy($Diet_Plans_ID,$current_week_nbr, $day,$period,$type,$Customer_ID){


            return $this->db
                                            ->select('i.*,dip.DCIP_ID')
                                            ->from('diet_customers as dip')
                                            ->join('items as i', 'i.Item_ID = dip.Item_ID')
                                            ->where('dip.Diet_ID', $Diet_Plans_ID)
                                            ->where('dip.Week_ID', $current_week_nbr)
                                            ->where('dip.Day_ID', $day)
                                            ->where('dip.Period_ID', $period)
                                            ->where('dip.Type_ID', $type)
                                            ->where('dip.Customer_ID', $Customer_ID)
                                            ->get()
                                            ->result();

    }


            function getItemByPeriod($Diet_Plans_ID,$current_week_nbr, $day,$period,$Customer_ID){

                $available_types = array(49,50,51);
            return $this->db
                                            ->select('i.*,dip.DCIP_ID,dip.Type_ID')
                                            ->from('diet_customers as dip')
                                            ->join('items as i', 'i.Item_ID = dip.Item_ID')
                                            ->where('dip.Diet_ID', $Diet_Plans_ID)
                                            ->where('dip.Week_ID', $current_week_nbr)
                                            ->where('dip.Day_ID', $day)
                                            ->where('dip.Period_ID', $period)
                                            ->where_in('dip.Type_ID', $available_types)
                                            ->where('dip.Customer_ID', $Customer_ID)
                                            ->get()
                                            ->result();

    }

            function getCustomeItemBy($current_week_nbr, $day,$period,$type,$original_item_id,$Customer_ID){


            return $this->db
                                            ->select('i.*')
                                            ->from('diet_custom_item_plans as dcip')
                                            ->join('items as i', 'i.Item_ID = dcip.Item_ID')
                                            ->where('dcip.Week_ID', $current_week_nbr)
                                            ->where('dcip.Day_ID', $day)
                                            ->where('dcip.Period_ID', $period)
                                            ->where('dcip.Type_ID', $type)
                                            ->where('dcip.Customer_ID', $Customer_ID)
                                            ->where('dcip.Original_Item_ID', $original_item_id)
                                            ->get()
                                            ->result();

    }


            function insert($table,$data){
                  $this->db->insert($table,$data);
            $insert_id = $this->db->insert_id();
             return  $insert_id;
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

    public function getDomainTlds(){
        return  $this->db
                                                ->select("*")
                                                ->from("domains_tld")
                                                ->where('Status',1)
                                                ->get()
                                                ->result();
    }

    public function getDomainTldsByID($tld_id){
        return  $this->db
                                                ->select("*")
                                                ->from("domains_tld")
                                                ->where('Status',1)
                                                ->where('TLD_ID',$tld_id)
                                                ->get()
                                                ->row();
    }

    public function getConstantsByParantID($parent_id){
                return  $this->db
                                                ->select("*")
                                                ->from("constants")
                                                ->where('Status',1)
                                                ->where('parent',$parent_id)                                                
                                                ->get()
                                                ->result();
    }

    public function getCustomerData($customer_id = 0){
	    return $this->db->where('Customer_ID', $customer_id)->get(TBL_CUSTOMERS)->result();
    }

	public function getGuestByEmail($email = 0){
	    return $this->db->where('Email', $email)->where("Guest", 1)->get(TBL_CUSTOMERS)->row();
    }

    public function updateCustomer($data = array()){
	   // $this->db->where('Customer_ID', $data['Customer_ID'])->update(TBL_CUSTOMERS, $data);

        $this->db->reset_query();
            $this->db->where('Customer_ID', $data['Customer_ID']);
            $this->db->update(TBL_CUSTOMERS,$data);
            return $this->db->affected_rows();

    }
                public function getAllOpenTickets($customer_id = 0)
    {
        return $this->db
                                    ->select('*')
                                    ->from('customer_tickets')
                                    ->where('CustomerId', $customer_id)
                                    ->where('Status', 'In Progress')
                                    ->get()
                                    ->result();
    }


    /*-----------------------------------------------------------
    ---------------------- orders -----------------
    --------------------------------------------------------*/

    public function getCustomerOrdersByCustomerID($customer_id = 0){
	    $orders = $this->db
	    				->select('*')
	    				->from(TBL_ORDERS_HEAD)
	    				->where('Customer_ID', $customer_id)
	    				->where('Order_Confirmed', 1)
	    				->order_by('Order_ID', 'DESC')
	    				->get()
	    				->result();

	    // get order details
	    foreach($orders as $order)
	    {

		    $order_id = $order->Order_ID;
		    $order->OrderDetails = $this->db
		    								->select('od.Quantity, od.Price, od.Product_ID, p.Title_en, p.Title_ar, pd.Cover_Thumb, p.Slug, pc.Slug as CSlug')
		    								->from(TBL_ORDER_DETAILS.' as od')
                                            ->join(TBL_CLASSES.' as p', 'p.Product_ID = od.Product_ID')
                                            ->join(TBL_CLASS_DETAILS.' as pd', 'pd.Product_ID = p.Product_ID AND pd.Is_Cover = 1', 'left')
                                            //->join(TBL_CLASS_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = p.SubCategory_ID')
									        ->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = p.Category_ID')
                                            ->where('od.Order_ID', $order_id)
		    								->get()
		    								->result();

		    $order->Review = $this->db->where('Order_ID', $order_id)->get('order_reviews')->row();
	    } // end foreach

	    return $orders;
    }

    public function getOrder($customer_id = '', $order_id = '')
    {
	    return $this->db
	    				->select('*')
	    				->from(TBL_ORDERS_HEAD)
	    				->where('Customer_ID', $customer_id)
	    				->where('Order_ID', $order_id)
	    				->where('Order_Confirmed', 1)
	    				->get()
	    				->row();
    }


		public function getOrderDetails($customer_id = '', $order_id = '')
		{


				return $this->db
							->select('pu.UnitName_en,pu.UnitName_ar,od.Quantity, od.Price, od.Product_ID, p.Title_en, p.Title_ar, pd.Cover_Thumb, p.Slug, pc.Slug as CSlug')
								->from(TBL_ORDER_DETAILS.' as od')
                                ->join(TBL_ORDERS_HEAD.' as o', 'o.Order_ID = od.Order_ID')
								->join(TBL_CLASSES.' as p', 'p.Product_ID = od.Product_ID')
								->join(TBL_CLASS_DETAILS.' as pd', 'pd.Product_ID = p.Product_ID AND pd.Is_Cover = 1', 'left')
								->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = p.Category_ID')
                                ->join('product_units as pu', 'pu.Unit_ID = od.Unit_ID', 'left')
								->where('o.Order_ID', $order_id)
                                ->where('o.Order_Confirmed', 1)
                                ->where('o.Customer_ID', $customer_id)
								->get()
								->result();


		}

    public function updateOrderStatus($status = array())
    {
	    return $this->db
	    				->where('Customer_ID', $status['Customer_ID'])
	    				->where('Order_ID', $status['Order_ID'])
	    				->update(TBL_ORDERS_HEAD, $status);
    }


}
?>
