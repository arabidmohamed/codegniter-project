<?PHP
class Admin_model extends CI_Model
{
	public function getReports($fromDate = '', $toDate = '')
	{
		if(!empty($fromDate))
		{
			$fromDate = date("Y-m-d", strtotime($fromDate));
			$this->db->where("cs.created_at >= '{$fromDate} 00:00:00'");
		}
		if(!empty($toDate))
		{
			$toDate = date("Y-m-d", strtotime($toDate));
			$this->db->where("cs.created_at <= '{$toDate} 23:59:00'");
		}

		$this->db->distinct();
		$this->db->select('c.Customer_ID,cs.created_at'); 
		$this->db->from(TBL_CUSTOMERS.' AS c');
		$this->db->join('subscription_customers as cs', 'cs.Customer_ID = c.Customer_ID');
		$this->db->where('cs.Starts_At <=',date('Y-m-d',strtotime('+6 day')));
		$this->db->where('cs.Expires_At >= ' , date('Y-m-d')); 
		$this->db->group_by('c.Customer_ID');
		$this->db->where('c.Deleted_At IS NULL');
		$active_now =     $this->db->get()->result_array();

		return array(
			'active_now' => $newOrders,
			// 'total_completed' => $total_completed,
			// 'total_incomplete' => $total_incomplete,
			// 'totalOrders' => $totalOrders[0]->totalOrders,
			// 'totalIncome' => $totalIncome,
			// 'expire_subscriptions'=>count($expire_subscriptions),
			// 'active_subscriptions'=>count($active_subscriptions),
			// 'free_subscriptions'=>count($free_subscriptions)
		);
	}


        public function getReports($fromDate = '', $toDate = '')
    	{
    		if(!empty($fromDate))
			{
				$fromDate = date("Y-m-d", strtotime($fromDate));
				$this->db->where("cs.created_at >= '{$fromDate} 00:00:00'");
			}
			if(!empty($toDate))
			{
				$toDate = date("Y-m-d", strtotime($toDate));
				$this->db->where("cs.created_at <= '{$toDate} 23:59:00'");
			}

			$this->db->distinct();
			$this->db->select('c.Customer_ID,cs.created_at'); 
			$this->db->from(TBL_CUSTOMERS.' AS c');
			$this->db->join('subscription_customers as cs', 'cs.Customer_ID = c.Customer_ID');
            $this->db->where('cs.Starts_At <=',date('Y-m-d',strtotime('+6 day')));
            $this->db->where('cs.Expires_At >= ' , date('Y-m-d')); 
             $this->db->group_by('c.Customer_ID');
               $this->db->where('c.Deleted_At IS NULL');
            $active_subscriptions =     $this->db->get()->result_array();



            if(!empty($fromDate))
			{
				$fromDate = date("Y-m-d", strtotime($fromDate));
				$this->db->where("cs.created_at >= '{$fromDate} 00:00:00'");
			}
			if(!empty($toDate))
			{
				$toDate = date("Y-m-d", strtotime($toDate));
				$this->db->where("cs.created_at <= '{$toDate} 23:59:00'");
			}

			$this->db->distinct();
			$this->db->select('c.Customer_ID,cs.created_at'); 
			$this->db->from(TBL_CUSTOMERS.' AS c');
			$this->db->join('(select max(SC_ID) max_id, Customer_ID
				                    from subscription_customers group by Customer_ID) as cs1', 'cs1.Customer_ID = c.Customer_ID');
			$this->db->join('subscription_customers as cs', 'cs.SC_ID = cs1.max_id ');
			$this->db->where('cs.Expires_At <= ' , date('Y-m-d'));
			$this->db->where('cs.Plan_ID !=' , 1);
			 $this->db->group_by('c.Customer_ID');
			    $this->db->where('c.Deleted_At IS NULL');
            $expire_subscriptions =     $this->db->get()->result_array();

           // var_dump($expire_subscriptions); exit();
    		


            if(!empty($fromDate))
			{
				$fromDate = date("Y-m-d", strtotime($fromDate));
				$this->db->where("cs.created_at >= '{$fromDate} 00:00:00'");
			}
			if(!empty($toDate))
			{
				$toDate = date("Y-m-d", strtotime($toDate));
				$this->db->where("cs.created_at <= '{$toDate} 23:59:00'");
			}


			$this->db->distinct();
			$this->db->select('c.Customer_ID,cs.created_at'); 
			$this->db->from(TBL_CUSTOMERS.' AS c');
			$this->db->join('subscription_customers as cs', 'cs.Customer_ID = c.Customer_ID');
            $this->db->where('cs.Plan_ID', 1);  
             $this->db->group_by('c.Customer_ID');
                $this->db->where('c.Deleted_At IS NULL');
            $free_subscriptions =     $this->db->get()->result_array();




            if(!empty($fromDate))
			{
				$fromDate = date("Y-m-d", strtotime($fromDate));
				$this->db->where("created_at >= '{$fromDate} 00:00:00'");
			}
			if(!empty($toDate))
			{
				$toDate = date("Y-m-d", strtotime($toDate));
				$this->db->where("created_at <= '{$toDate} 23:59:00'");
			}

			$newOrders = $this->db->where('Order_Status', 'Pending')->get(TBL_ORDERS_HEAD)->num_rows();



			if(!empty($fromDate))
			{
				$fromDate = date("Y-m-d", strtotime($fromDate));
				$this->db->where("Created_At >= '{$fromDate} 00:00:00'");
			}
			if(!empty($toDate))
			{
				$toDate = date("Y-m-d", strtotime($toDate));
				$this->db->where("Created_At <= '{$toDate} 23:59:00'");
			}


				$totalOrders		=	$this->db
									->select('SUM(oh.OrderTotal_Price) as totalOrders')
									->from(TBL_ORDERS_HEAD.' as oh')
									->where("oh.Payment_Verified = 1")
									->get()
									->result();



					if(!empty($fromDate))
			{
				$fromDate = date("Y-m-d", strtotime($fromDate));
				$this->db->where("Created_At >= '{$fromDate} 00:00:00'");
			}
			if(!empty($toDate))
			{
				$toDate = date("Y-m-d", strtotime($toDate));
				$this->db->where("Created_At <= '{$toDate} 23:59:00'");
			}

				$totalIncome		=	$this->db
									->select('SUM(Balance) as totalIncome')
									->from('subscription_customers')
									->where("Payment_Verified = 1")
									->get()
									->result();

				$totalIncome = number_format((float)($totalIncome[0]->totalIncome), 2, '.', '');

					if(!empty($fromDate))
			{
				$fromDate = date("Y-m-d", strtotime($fromDate));
				$this->db->where("Created_At >= '{$fromDate} 00:00:00'");
			}
			if(!empty($toDate))
			{
				$toDate = date("Y-m-d", strtotime($toDate));
				$this->db->where("Created_At <= '{$toDate} 23:59:00'");
			}

				$total_incomplete = $this->db
									->select('*')
									->from(TBL_ORDERS_HEAD.' as oh')
									->where("oh.Payment_Verified = 0")
									->get()
									->num_rows();


		 			if(!empty($fromDate))
			{
				$fromDate = date("Y-m-d", strtotime($fromDate));
				$this->db->where("Created_At >= '{$fromDate} 00:00:00'");
			}
			if(!empty($toDate))
			{
				$toDate = date("Y-m-d", strtotime($toDate));
				$this->db->where("Created_At <= '{$toDate} 23:59:00'");
			}

			
			$total_completed = $this->db
									->select('*')
									->from(TBL_ORDERS_HEAD.' as oh')
									->where("oh.Payment_Verified = 1")
									->get()
									->num_rows();
	
			return array(
				'newOrders' => $newOrders,
				'total_completed' => $total_completed,
				'total_incomplete' => $total_incomplete,
				'totalOrders' => $totalOrders[0]->totalOrders,
				'totalIncome' => $totalIncome,
				'expire_subscriptions'=>count($expire_subscriptions),
				'active_subscriptions'=>count($active_subscriptions),
				'free_subscriptions'=>count($free_subscriptions)
			);
    	}



        public function getUsedCoupons($from,$to){

			if(!empty($from))
			{
				$from = date("Y-m-d", strtotime($from));
				$this->db->where("cs.created_at >= '{$from} 00:00:00'");
			}
			if(!empty($to))
			{
				$to = date("Y-m-d", strtotime($to));
				$this->db->where("cs.created_at <= '{$to} 23:59:00'");
			}
			
						$this->db->distinct();
						$this->db->select('*');
						$this->db->from('promo_codes as promo');
						$this->db->join('subscription_customer_history as cs', 'promo.Code = cs.PromoCode');
						$this->db->where('cs.Payment_Verified ' , 1);
						$this->db->where('cs.canceled_at IS NULL');
						$this->db->group_by('promo.Code');

					$used_promo =	$this->db->get()->result();

			foreach ($used_promo as $key => $row) {


			if(!empty($from))
			{
				$from = date("Y-m-d", strtotime($from));
				$this->db->where("cs.created_at >= '{$from} 00:00:00'");
			}
			if(!empty($to))
			{
				$to = date("Y-m-d", strtotime($to));
				$this->db->where("cs.created_at <= '{$to} 23:59:00'");
			}

						$used_promo[$key]->TotalIncome =   $this->db
							->select_sum('cs.Balance')
							->from('subscription_customer_history as cs')
							->join(TBL_CUSTOMERS.' AS c', 'c.Customer_ID = cs.Customer_ID','LEFT')
							->where('cs.Payment_Verified ' , 1)
							->where('cs.PromoCode' , $row->Code)
							->where('cs.canceled_at IS NULL')			
							->get()->row();


		if(!empty($from))
			{
				$from = date("Y-m-d", strtotime($from));
				$this->db->where("cs.created_at >= '{$from} 00:00:00'");
			}
			if(!empty($to))
			{
				$to = date("Y-m-d", strtotime($to));
				$this->db->where("cs.created_at <= '{$to} 23:59:00'");
			}
						$used_promo[$key]->count =   $this->db
							->select('*')
							->from('subscription_customer_history as cs')
							->join('promo_codes as promo', 'promo.Code = cs.PromoCode')
							->join(TBL_CUSTOMERS.' AS c', 'c.Customer_ID = cs.Customer_ID')
							->where('cs.Payment_Verified ' , 1)
							->where('cs.PromoCode' , $row->Code)
							->where('cs.canceled_at IS NULL')
							->get()->num_rows();
							
			}

			return $used_promo;
		}


        public function chartReportsData()
		{
			$TotalIncome = $this->db
									->select("DATE_FORMAT(TimeStamp, '%Y-%m-%d') as date, SUM(OrderTotal_Price) as value")
									->from(TBL_ORDERS_HEAD)
									->group_by('DAY(TimeStamp)')
									->get()
									->result();
										
			$MostOrderedProducts = $this->db
											->select('count(*) as Orders, p.Title_en as ProductTitle')
											->from(TBL_ORDER_DETAILS.' as od')
											->join(TBL_PRODUCTS.' as p', 'p.Product_ID = od.Product_ID')
											->group_by('od.Product_ID')
											->order_by('Orders', 'DESC')
											->limit(10)
											->get()
											->result();
												
			$MostViewedProducts = $this->db
											->select('count(*) as Views, p.Title_en as ProductTitle')
											->from(TBL_PRODUCT_VIEWS.' as pv')
											->join(TBL_PRODUCTS.' as p', 'p.Product_ID = pv.Product_ID')
											->group_by('pv.Product_ID')
											->order_by('Views', 'DESC')
											->limit(10)
											->get()
											->result();
			
			return array(
				'TotalIncome' => $TotalIncome,
				'MostOrderedProducts' => $MostOrderedProducts,
				'MostViewedProducts' => $MostViewedProducts
			);
		}
}