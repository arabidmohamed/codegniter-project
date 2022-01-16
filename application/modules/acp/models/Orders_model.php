<?PHP
class Orders_model extends CI_Model{
	
	
	public function getOrderByID($order_id = 0)
	{
	    $orders = $this->db
	    				->select('oh.*, c.Fullname, c.Phone, c.Address, c.Email')
	    				->from(TBL_ORDERS_HEAD.' as oh')
	    				->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = oh.Customer_ID', 'LEFT')
						//->join('branches as b', 'b.Register_ID = oh.Vend_Register_ID')
						//->join('customer_delivery_addresses as ca', 'ca.Address_ID = oh.Address_ID', 'LEFT')
	    				->where('oh.Order_ID', $order_id)
	    				->get()
	    				->result();
	    								
	    // get order details
	    foreach($orders as $order)
	    {


		    $order_id = $order->Order_ID;
		    $order->OrderDetails = $this->db
		    								->select('pu.UnitName_en,pu.UnitName_ar, od.Quantity, od.Price as OrderItemPrice, od.Price, od.Class_ID, pc.Category_en, pc.Category_ar, pc.Slug as SCSlug, pd.Cover_Thumb as Thumbnail, p.Title_en, p.Title_ar')
		    								->from(TBL_ORDER_DETAILS.' as od')
		    								->join(TBL_CLASSES.' as p', 'p.Class_ID = od.Class_ID')
											->join(TBL_CLASS_CATEGORIES.' as pc', 'pc.Category_ID = p.Category_ID', 'left')
											->join(TBL_CLASS_UNITS.' as pu', 'pu.Unit_ID = od.Unit_ID', 'left')
											->join(TBL_CLASS_DETAILS.' as pd', 'pd.Class_ID = p.Class_ID AND pd.Is_Cover = 1', 'left')
		    								->where('od.Order_ID', $order_id)
		    								->get()
		    								->result();
	    } // end foreach

	   // var_dump($orders); exit();
	    
	    return @$orders[0];   
    }
    
    public function getReviewByOrderID($order_id = 0)
    {
	    return $this->db->where('Order_ID', $order_id)->get('order_reviews')->row();
    }
    
    public function getAnooshReviewByID($id = 0)
    {
	    return $this->db->where('ID', $id)->get('anoosh_order_reviews')->row();
    }
    
	public function updateOrder($data = array())
	{
	    $order_id = $data['Order_ID'];
	    $upd = $this->db->where('Order_ID', $order_id)->update(TBL_ORDERS_HEAD, $data);
	    $upd = $this->db->affected_rows();
	    
	    return $upd;
    }
		
	/**
		*------- Orders List *---------
	**/

	var $order_columns_1  = array('oh.Order_ID', 'oh.TimeStamp', 'c.Fullname', 'c.Phone', 'oh.Order_Status', 'oh.OrderTotal_Price', 'oh.PaymentType');
	private function _get_orders_query()
	{
		
			$where_order_no = '';
			$where_mobile_no = '';
			$where_status = '';
			$where_name = '';
			$where_subcategory = '';
			$where_customer = '';
			
			if(!empty($_POST['order_no'])){
				$id = $_POST['order_no'];
				$where_order_no = "oh.Order_ID = $id AND";
			}


			if(!empty($_POST['customer_id'])){
				$id = $_POST['customer_id'];
				$where_customer = "oh.Customer_ID = $id AND";
			}
			
			if(!empty($_POST['mobile_no'])){
				$phone = $_POST['mobile_no'];
				$where_mobile_no = "c.Phone = '$phone' AND";
			}
			
			if(!empty($_POST['name'])){
				$name = $_POST['name'];
				$where_name = "c.Fullname LIKE '%$name%' AND";
			}
			
			if($_POST['status'] != -1){
				$status = $_POST['status'];
				$where_status = "oh.Order_Status = '$status' AND";
			}

			if($_POST['payment'] != -1){
				$payment = $_POST['payment'];
				$where_payment = "oh.Payment_Verified = '$payment' AND";
			}
			
			$where = "$where_order_no $where_customer $where_mobile_no $where_name $where_status $where_payment $where_subcategory oh.Order_Confirmed = 1";
			
		    $this->db->distinct();
	        $this->db->select('oh.*, c.Fullname, c.Phone'); 
	        $this->db->from(TBL_ORDERS_HEAD." AS oh");
	        $this->db->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = oh.Customer_ID');
	       $this->db->where($where);
	        
	        //print_r($_POST['order']);
		    if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->order_columns_1[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("a.Class_ID", "DESC");
		    }
    }
 
    function getOrdersList()
    {
        $this->_get_orders_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		

		//var_dump($query->result()); exit();
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function ordersCount_filtered()
    {
        $this->_get_orders_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function ordersCount_all()
    {
        $this->db->from(TBL_ORDERS_HEAD." AS oh");

        return $this->db->count_all_results();
    }
	
	/**
		*------- Incompleted Orders List *---------
	**/

	var $incorder_columns  = array('oh.Order_ID', 'oh.TimeStamp', 'c.Fullname', 'c.Phone', 'oh.Order_Status', 'oh.OrderTotal_Price', 'oh.PaymentType');
	private function _get_incompletedorders_query()
	{
		
			$where_order_no = '';
			$where_mobile_no = '';
			$where_status = '';
			$where_name = '';
			$where_category = '';
			$where_subcategory = '';
			$where_customer = '';
			
			if(!empty($_POST['order_no'])){
				$id = $_POST['order_no'];
				$where_order_no = "oh.Order_ID = $id AND";
			}

			if(!empty($_POST['customer_id'])){
				$id = $_POST['customer_id'];
				$where_customer = "oh.Customer_ID = $id AND";
			}
			
			if(!empty($_POST['mobile_no'])){
				$phone = $_POST['mobile_no'];
				$where_mobile_no = "c.Phone = '$phone' AND";
			}
			
			if(!empty($_POST['name'])){
				$name = $_POST['name'];
				$where_name = "c.Fullname LIKE '%$name%' AND";
			}
			
			if($_POST['status'] != -1){
				$status = $_POST['status'];
				$where_status = "oh.Order_Status = '$status' AND";
			}
			
			$where = "$where_order_no $where_customer $where_mobile_no $where_name $where_status $where_category $where_subcategory oh.Order_Confirmed = 0 AND c.Guest = 0";
			
		    $this->db->distinct();
	        $this->db->select('oh.*, c.Fullname, c.Phone'); 
	        $this->db->from(TBL_ORDERS_HEAD." AS oh");
	        $this->db->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = oh.Customer_ID');
	        $this->db->where($where);
	        
	        //print_r($_POST['order']);
		    if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->incorder_columns[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("a.Class_ID", "DESC");
		    }
    }
 
    function getIncompletedOrdersList()
    {
        $this->_get_incompletedorders_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function incompletedOrdersCount_filtered()
    {
        $this->_get_incompletedorders_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function incompletedOrdersCount_all()
    {
        $this->_get_incompletedorders_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	
	

	public function export_orders($return_obj = false)
	{

		$this->db->distinct();
		$this->db->select('od.Order_ID,
							oh.Created_At,
							cu.Fullname,
							cu.Email,
							cu.Phone,
							oh.Payment_Reference as Payment_Invoice_No,
							oh.Payment_Status,
							p.Title_ar as Item_Name_ar,
							p.Title_en as Item_Name_en,
							od.Price,
							od.Quantity,
							(od.Price * od.Quantity) as TotalPrice,
							oh.Order_Status');
							
		$this->db->from(TBL_ORDER_DETAILS.' as od');
		$this->db->join(TBL_ORDERS_HEAD.' as oh', 'oh.Order_ID = od.Order_ID');
		$this->db->join(TBL_CUSTOMERS.' as cu', 'cu.Customer_ID = oh.Customer_ID');
		$this->db->join(TBL_CLASSES.' as p', 'p.Class_ID = od.Class_ID');
		$this->db->order_by('oh.Order_ID', 'ASC');
		$query = $this->db->get();
/*
		echo $this->db->last_query();
		die();
*/
		
		if($return_obj){
			return $query->result();
		}
		
		return $query;
	}
	
	/**
		*------- Reviews List *---------
	**/

	var $review_columns  = array('r.Timestamp', 'r.Order_ID', 'c.Fullname', 'r.Overall_Rating', 'r.Review');
	private function _get_reviews_query()
	{
		
			$where_order_no = '';
			$where_mobile_no = '';
			$where_name = '';
			
			if(!empty($_POST['order_no'])){
				$id = $_POST['order_no'];
				$where_order_no = "oh.Order_ID = $id AND";
			}
			
			if(!empty($_POST['mobile_no'])){
				$phone = $_POST['mobile_no'];
				$where_mobile_no = "c.Phone = '$phone' AND";
			}
			
			if(!empty($_POST['name'])){
				$name = $_POST['name'];
				$where_name = "c.Fullname LIKE '%$name%' AND";
			}
			
			$where = "{$where_order_no} {$where_mobile_no} {$where_name} r.ID > 0";
			
		    $this->db->distinct();
	        $this->db->select('r.*, c.Fullname, c.Phone'); 
	        $this->db->from("order_reviews AS r");
	        $this->db->join(TBL_ORDERS_HEAD.' as oh', 'oh.Order_ID = r.Order_ID');
	        $this->db->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = oh.Customer_ID', 'LEFT');
	        $this->db->where($where);
	        
	        //print_r($_POST['order']);
		    if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->review_columns[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("r.ID", "DESC");
		    }
    }
 
    function getReviewsList()
    {
        $this->_get_reviews_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function reviewsCount_filtered()
    {
        $this->_get_reviews_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function reviewsCount_all()
    {
        $this->_get_reviews_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    
    /**
		*------- Anoosh Reviews List *---------
	**/

	var $review_columns1  = array('r.Timestamp', 'r.CashierEmail', 'r.CashierName', 'r.Overall_Rating', 'r.Review');
	private function _get_anooshReviews_query()
	{
		
			$where_email = '';
			$where_usernmae = '';
			$where_name = '';
			
			if(!empty($_POST['email'])){
				$email = $_POST['email'];
				$where_email = "CashierEmail LIKE '%{$email}%' AND";
			}
			
			if(!empty($_POST['name'])){
				$name = $_POST['name'];
				$where_name = "CashierName LIKE '%{$name}%' AND";
			}
			
			$where = "{$where_email} {$where_name} r.ID > 0";
			
		    $this->db->distinct();
	        $this->db->select('r.*'); 
	        $this->db->from("anoosh_order_reviews AS r");
	        $this->db->where($where);
	        
	        //print_r($_POST['order']);
		    if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->review_columns1[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("r.ID", "DESC");
		    }
    }
 
    function getAnooshReviewsList()
    {
        $this->_get_anooshReviews_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function anooshReviewsCount_filtered()
    {
        $this->_get_anooshReviews_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function anooshReviewsCount_all()
    {
        $this->_get_anooshReviews_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
}
?>