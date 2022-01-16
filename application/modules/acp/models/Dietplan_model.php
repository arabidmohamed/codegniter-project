<?PHP
    class Dietplan_model extends CI_Model{
        public function add($plan = array())
        {
            $this->db->insert('diet_plans', $plan);
            return $this->db->insert_id();
        }

          public function add_plan_item($plan = array())
        {
            $this->db->insert('diet_items_plans', $plan);
            return $this->db->insert_id();
        }


        public function getAllItems($week_id = 0,$day_id = 0,$period_id=0,$type_id=0){
                   return $this->db
                            ->select('*')
                            ->from('items')

                            ->where("FIND_IN_SET(".$week_id.",available_weeks) >",0)
                            ->where("FIND_IN_SET(".$day_id.",week_days) >",0)
                            ->where("FIND_IN_SET(".$period_id.",meal_period) >",0)
                            ->where("FIND_IN_SET(".$type_id.",meal_type) >",0)

                            ->where("Is_Deleted",0)

                            ->get()
                            ->result();
        }

        public function add_customerDiet($plan = array())
        {
            $this->db->insert('customer_diet_plan', $plan);
            return $this->db->insert_id();
        }

        public function add_DietTemplate($plan = array())
        {
            $this->db->insert('diet_plans', $plan);
            return $this->db->insert_id();
        }

        public function add_foodPlan($foodPlan = array())
        {
            $this->db->insert('diet_food_plan', $foodPlan);
            return $this->db->insert_id();
        }
        
        public function add_snackPlan($foodPlan = array())
        {
            $this->db->insert('diet_snacks_plan', $foodPlan);
            return $this->db->insert_id();
        }

        public function add_sportsPlan($sportPlan = array())
        {
            $this->db->insert('diet_sports_plan', $sportPlan);
            return $this->db->insert_id();
        }
		
		public function modifySubscription($customer_id = 0){
			return $this->db->where("Customer_ID", $customer_id)
							->where("Payment_Verified", 1)
							->order_by("CS_ID", "DESC")
							->limit(1)
							->update("customer_subscription_history", array("DietPlan_Created" => 1));
		}

        public function getByID($diet_plan_id = '', $customer_id = '')
        {

            if(!empty($customer_id))
            {
                $this->db->where('cdp.Customer_ID', $customer_id);
            }

            if(!empty($diet_plan_id))
            {
                $this->db->where('d.Diet_ID', $diet_plan_id);
            }

			$d = $this->db
						 ->select('d.*, c.Fullname, c.Email, c.Phone, c.Customer_ID')
                         ->from('diet_plans as d')
                         ->join('customer_diet_plan as cdp', 'cdp.Diet_ID = d.Diet_ID')
                         ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = cdp.Customer_ID')
						 ->order_by('d.Diet_ID', 'DESC')
						 ->get();
			
            $diet = $d->row();

            if(count($diet) > 0)
            {
                // diet food plan
                $foodPlan = $this->db
                                ->select('df.MealType_ID, df.QuantityNote, df.Notes, f.Class_ID as Class_ID, mt.Type_ar as MealType, sb.SubCategory_ar, f.Title_ar as FoodItem, df.MealType_Note')
                                ->from('diet_food_plan as df')
                                ->join('diet_meal_types as mt', 'mt.MealType_ID = df.MealType_ID')
                                ->join(TBL_CLASSES.' as f', 'f.Class_ID = df.Item_ID')
                                ->join(TBL_CLASS_SUBCATEGORIES.' as sb', 'sb.SubCategory_ID = f.SubCategory_ID')
                                ->where('df.Diet_ID', $diet_plan_id)
                                ->order_by('df.MealType_ID', 'DESC')
                                ->get();

                $diet->FoodPlan = $foodPlan->result();

                // GET snacks plan for every mealType
                $snacksPlans = $this->db
                                ->select('ds.MealType_ID, ds.QuantityNote, f.Class_ID as Class_ID, mt.Type_ar as MealType, sb.SubCategory_ar, f.Title_ar as SnacksItem, f.Quantity, ds.Notes as SnacksPlanNotes')
                                ->from('diet_snacks_plan as ds')
                                ->join('diet_meal_types as mt', 'mt.MealType_ID = ds.MealType_ID')
                                ->join(TBL_CLASSES_SNACKS.' as f', 'f.Class_ID = ds.Item_ID')
                                ->join(TBL_CLASS_SUBCATEGORIES_SNACKS.' as sb', 'sb.SubCategory_ID = f.SubCategory_ID')
                                ->where('ds.Diet_ID', $diet_plan_id)
                                ->order_by('ds.MealType_ID', 'ASC')
                                ->get(); 
                                
                $diet->SnacksPlans = $snacksPlans->result();

                // diet sports plan
                $sportsPlan = $this->db
                                        ->select('ds.SportName, ds.Duration, ds.SP_Notes')
                                        ->from('diet_sports_plan as ds')
                                        ->where('ds.Diet_ID', $diet_plan_id)
                                        ->get();
                
                $diet->SportsPlan = $sportsPlan->result();

                // diet pictures
                $pictures = $this->db
                                        ->select('*')
                                        ->from('diet_plan_pictures as dp')
                                        ->where('dp.Diet_ID', $diet_plan_id)
                                        ->get();
                
                $diet->Pictures = $pictures->result();

                // diet reivews
                $reviews = $this->db
                                        ->select('r.*, c.Fullname')
                                        ->from('diet_plan_reviews as r')
                                        ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = r.Customer_ID')
                                        ->where('r.Diet_ID', $diet_plan_id)
                                        ->get();

                $diet->Reviews = $reviews->result();
            }

			return $diet;
        }

        public function update($plan = array())
        {
            return $this->db->where('Diet_Plans_ID', $plan['Diet_Plans_ID'])->update('diet_plans', $plan);
        }

        public function delete($diet_plan_id = 0)
        {
            $delete = $this->db->where('Diet_ID', $diet_plan_id)->delete('diet_plans');
            $this->delete_foodPlan($diet_plan_id);
            $this->delete_sportsPlan($diet_plan_id);

            return $delete;
        }

        public function deleteTemplate($diet_temp_id,$diet_plan_id)
        {
            $delete = $this->db->where('Template_ID', $diet_temp_id)->delete('diet_plans');
            $this->delete($diet_plan_id);
            return $delete;
        }

        public function delete_foodPlan($diet_plan_id = 0)
        {
            $this->db->where('Diet_ID', $diet_plan_id)->delete('diet_items_plans');
        }
        
        public function delete_snacksPlan($diet_plan_id = 0)
        {
            $this->db->where('Diet_ID', $diet_plan_id)->delete('diet_snacks_plan');
        }

        public function delete_sportsPlan($diet_plan_id = 0)
        {
            $this->db->where('Diet_ID', $diet_plan_id)->delete('diet_sports_plan');
        }
        
        public function getDietComments($ev_id = '')
        {
	        return $this->db
	        				->select('c.*')
	        				->from('customer_evaluation_comments as c')
	        				->join('customer_evaluations as e', 'e.EV_ID = c.EV_ID')
	        				->where('c.EV_ID', $ev_id)
	        				->order_by('c.Timestamp', 'ASC')
							->get()
							->result();
        }
        
        public function getLastEvaluationDetails($customer_id = '')
		{
			return $this->db
							->from('customer_evaluations')
							->where('Customer_ID', $customer_id)
							->order_by('EV_ID', 'DESC')
							->get()
							->row();
		}

        /**
            *------- diet List *---------
        **/

        var $order_columns_1  = array('d.Diet_ID', 'd.Timestamp', 'd.Diet_Name', 'd.Created_By', 'c.Fullname', 'd.Start_From', 'd.Status');
        private function _get_diet_query()
        {
            $where_title = '';
            $where_customer = '';
            $where_user = '';
            $where_subscription = '';
            $where_fromDate = '';
            $where_toDate = '';
            $subJoin = 'LEFT';
            
            if(!empty($_POST['title'])){
                $title = $_POST['title'];
                $where_title = "d.Diet_Name LIKE '%{$title}%' AND";
            }
            
            if($_POST['customer_id'] != -1){
                $customer_id = $_POST['customer_id'];
                $where_customer = "cd.Customer_ID = {$customer_id} AND";
            }
            
            if(!empty(@$_POST['userId'])){
                $user_id = $_POST['userId'];
                $where_user = "u.User_ID = {$user_id} AND";
            }
            
            // START INSIDE JOIN WHERE
            if(!empty(@$_POST['paidSubscriptions']))
            {
	            $subJoin = 'INNER';
	            $where_subscription = ' AND sp.Plan_Price > 0';
            }
            
            if(!empty(@$_POST['freeSubscriptions']))
            {
	            $subJoin = 'INNER';
	            $where_subscription = ' AND sp.Plan_Price = 0';
            }
            // END
            
            if(!empty(@$_POST['fromDate']))
			{
				$fromDate = $_POST['fromDate'];
				$where_fromDate = " d.Created_At >= '{$fromDate}' AND";
			}
			if(!empty(@$_POST['toDate']))
			{
				$toDate = $_POST['toDate'];
				$where_toDate = " d.Created_At <= '{$toDate}' AND";
			}
            
            $where = "{$where_title} {$where_customer} {$where_user} {$where_fromDate} {$where_toDate} d.Status >= 0";
            
            $this->db->distinct();
            $this->db->select('d.*, c.Fullname, c.Customer_ID'); 
            $this->db->from('diet_plans AS d');
            $this->db->join('customer_diet_plan as cd', 'cd.Diet_ID = d.Diet_ID');
            $this->db->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = cd.Customer_ID');
            $this->db->join('customer_subscriptions as cs', 'cs.Customer_ID = c.Customer_ID', $subJoin);
            $this->db->join('subscription_plans as sp', 'sp.Plan_ID = cs.Plan_ID '.$where_subscription, $subJoin);
            $this->db->join('users as u', 'u.User_ID = d.CreatedBy_ID', 'LEFT');
            $this->db->where($where);
            $this->db->group_by('d.Diet_ID');
            
            //print_r($_POST['order']);
            if(isset($_POST['order'])){
                $ind = $_POST['order'][0]['column'];
                $oColumn = $this->order_columns_1[$ind];
                $direction = $_POST['order'][0]['dir'];
                $where_order = "$oColumn $direction";
                $this->db->order_by($where_order);
            } else {
                $this->db->order_by("d.Diet_ID", "DESC");
            }
        }
    
        function getDietsList()
        {
            $this->_get_diet_query();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

            $query = $this->db->get();
            
            //echo $this->db->last_query();
            return $query->result();
        }
    
        function dietCount_filtered()
        {
            $this->_get_diet_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
    
        public function dietCount_all()
        {
            $this->_get_diet_query();
            $query = $this->db->get();
            return $query->num_rows();
        }

        /*---------------------------------------------
         *---------------- Diet Pictures ---------------
         ---------------------------------------------*/

        public function addDietPictures($picture = array())
        {
            $this->db->insert('diet_plan_pictures', $picture);
            return $this->db->insert_id();
        }

        public function updateDietPictures($picture = array())
        {
           return $this->db->where('Picture_ID', $picture['Picture_ID'])->update('diet_plan_pictures', $picture);
        }

        public function getDietPictureByID($id = 0)
        {
            return $this->db->where('Picture_ID', $id)->get('diet_plan_pictures')->row();
        }

        public function deleteDietPicture($id = 0)
        {
            return $this->db->where('Picture_ID', $id)->delete('diet_plan_pictures');
        }

        /*---------------------------------------------
         *---------------- Code Decode ---------------
         ---------------------------------------------*/
        public function getMealTypes()
        {
            return $this->db->get('diet_meal_types')->result();
        }

        public function getFoodItems()
        {
            $foodItems = $this->db
                                  ->where('Status', 1)
                                  ->order_by('Order_In_List', 'ASC')
                                  ->get(TBL_CLASS_SUBCATEGORIES)
                                  ->result();
            
            foreach($foodItems as $f)
            {
                $f->FoodItems = $this->db
                                                ->where('Status', 1)
                                                ->where('SubCategory_ID', $f->SubCategory_ID)
                                                ->get(TBL_CLASSES)
                                                ->result();
            }
            
            return $foodItems;
        }
        
        public function getSnackItems()
        {
            $foodItems = $this->db
                                  ->where('Status', 1)
                                  ->order_by('Order_In_List', 'ASC')
                                  ->get(TBL_CLASS_SUBCATEGORIES_SNACKS)
                                  ->result();
            
            foreach($foodItems as $f)
            {
                $f->SnackItems = $this->db
                                                ->where('Status', 1)
                                                ->where('SubCategory_ID', $f->SubCategory_ID)
                                                ->get(TBL_CLASSES_SNACKS)
                                                ->result();
            }

            return $foodItems;
        }

        public function getSports()
        {
            return $this->db->get('diet_sports')->result();
        }

        public function getTemplatesPlan()
        {
            return $this->db->get('diet_plans')->result();
        }
        public function getPlanOptions(){
            return $this->db->get('customer_preferance_options')->result();
        }


          public function addPlanOption($option = array())
        {
            $this->db->insert('customer_preferance_options', $option);
            return $this->db->insert_id();
        }


         public function getOptionByID($id = 0)
        {
            return $this->db->where('option_id', $id)->get('customer_preferance_options')->row();
        }


   public function updateOption($option = array())
        {
           return $this->db->where('option_id', $option['option_id'])->update('customer_preferance_options', $option);
        }


//         public function getTemplateByID($diet_plan_id = '', $customer_id = '')
//         {

//             if(!empty($diet_plan_id))
//             {
//                 $this->db->where('Diet_ID', $diet_plan_id);
//             }

// 			$d = $this->db
// 						 ->select('*')
//                          ->from('diet_plans')
// 						 ->order_by('Diet_ID', 'DESC')
// 						 ->get();

// /*                         ->select('d.*, c.Fullname, c.Email, c.Phone, c.Customer_ID')
//                          ->from('diet_plans as d')
//                          ->join('customer_diet_plan as cdp', 'cdp.Diet_ID = d.Diet_ID')
//                          ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = cdp.Customer_ID')
// 						 ->order_by('d.Diet_ID', 'DESC')
// 						 ->get();*/

//             $diet = $d->row();

//             if(count($diet) > 0)
//             {
//                 // diet food plan
//                 $foodPlan = $this->db
//                                 ->select('df.MealType_ID, df.QuantityNote, df.Notes, f.Class_ID as Class_ID, mt.Type_ar as MealType, sb.SubCategory_ar, f.Title_ar as FoodItem, df.MealType_Note')
//                                 ->from('diet_food_plan as df')
//                                 ->join('diet_meal_types as mt', 'mt.MealType_ID = df.MealType_ID')
//                                 ->join(TBL_CLASSES.' as f', 'f.Class_ID = df.Item_ID')
//                                 ->join(TBL_CLASS_SUBCATEGORIES.' as sb', 'sb.SubCategory_ID = f.SubCategory_ID')
//                                 ->where('df.Diet_ID', $diet_plan_id)
//                                 ->order_by('df.MealType_ID', 'DESC')
//                                 ->get();

//                 $diet->FoodPlan = $foodPlan->result();

//                 // GET snacks plan for every mealType
//                 $snacksPlans = $this->db
//                                 ->select('ds.MealType_ID, ds.QuantityNote, f.Class_ID as Class_ID, mt.Type_ar as MealType, sb.SubCategory_ar, f.Title_ar as SnacksItem, f.Quantity, ds.Notes as SnacksPlanNotes')
//                                 ->from('diet_snacks_plan as ds')
//                                 ->join('diet_meal_types as mt', 'mt.MealType_ID = ds.MealType_ID')
//                                 ->join(TBL_CLASSES_SNACKS.' as f', 'f.Class_ID = ds.Item_ID')
//                                 ->join(TBL_CLASS_SUBCATEGORIES_SNACKS.' as sb', 'sb.SubCategory_ID = f.SubCategory_ID')
//                                 ->where('ds.Diet_ID', $diet_plan_id)
//                                 ->order_by('ds.MealType_ID', 'ASC')
//                                 ->get();

//                 $diet->SnacksPlans = $snacksPlans->result();

//                 // diet sports plan
//                 $sportsPlan = $this->db
//                                         ->select('ds.SportName, ds.Duration, ds.SP_Notes')
//                                         ->from('diet_sports_plan as ds')
//                                         ->where('ds.Diet_ID', $diet_plan_id)
//                                         ->get();

//                 $diet->SportsPlan = $sportsPlan->result();

//                 // diet pictures
//                 $pictures = $this->db
//                                         ->select('*')
//                                         ->from('diet_plan_pictures as dp')
//                                         ->where('dp.Diet_ID', $diet_plan_id)
//                                         ->get();

//                 $diet->Pictures = $pictures->result();


//             }

// 			return $diet;
//         }


       public function getPlanTemplatebyplanID($diet_id = '') {
                    $this->db->where('Diet_Plans_ID',$diet_id);
             return $this->db->get('diet_plans')->row();
       }

        public function getPlanTemplateItemsbyplanID($diet_id = '') {
                    $this->db->where('Diet_ID',$diet_id);
             return $this->db->get('diet_items_plans')->result();
       }
    }
?>