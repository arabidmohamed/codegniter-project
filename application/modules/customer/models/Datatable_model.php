<?PHP
class Datatable_model extends CI_Model {

	
    // ***************************************
    // Note: used for purchases
    // ***************************************
    private function _get_domains_query()
    {
        $where_title    = '';
        
        if(!empty($_POST['search']))
        {        
         $host = trim($_POST['search']);
         $where_domains =  " CONCAT(d.Domain_Name, '', d.TLD) LIKE '%{$host}%'";
        }

        $where = "$where_domains";

        if(!empty($where)){
            $this->db->where($where);
        }

        $customer_id = $this->session->userdata($this->site_session->userid());
           
                                            $this->db->select('d.*');
                                            $this->db->from(DOMAIN.' as d');                                  
                                            $this->db->where('d.Customer_ID', $customer_id);
                                            $this->db->where('d.IS_Domain_Created', 1);
                                            $this->db->where('d.Is_Deleted', 0); 
                                            $this->db->where('d.Domain_Status !=', 'DELETED');
                                            $this->db->where('d.Domain_Status !=', 'ADMIN DELETE');
                                            $this->db->order_by('d.Domain_ID', 'DESC');                               

                            



      
    }

    function getDomainsList()
    {       
        $this->_get_domains_query();
        if(@$_POST['length'] != -1 && @$_POST['length'])
        $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
 
    function domainsCount_filtered()
    {
        $this->_get_domains_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function domainsCount_all()
    {
        $this->db->from(ORDERS." AS n");

        return $this->db->count_all_results();
    }
    // Ends
    // ***************************************




    // ***************************************
    // Note: used for purchases
    // ***************************************
    private function _get_tickets_query()
    {
        $where_title    = '';
        
        if(!empty($_POST['search']))
        {        
         $search = trim($_POST['search']);
         $where_tickets =  " Title LIKE '%{$search}%'  OR Description LIKE '%{$search}%' ";
        }

        $where = "$where_tickets";

        if(!empty($where)){
            $this->db->where($where);
        }

        $customer_id = $this->session->userdata($this->site_session->userid());           
                                            $this->db->select('*');
                                            $this->db->from('customer_tickets');                                  
                                            $this->db->where('CustomerId', $customer_id);
                                            $this->db->order_by('Timestamp', 'DESC');                               
                            



      
    }

    function getTicketsList()
    {       
        $this->_get_tickets_query();
        if(@$_POST['length'] != -1 && @$_POST['length'])
        $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
 
    function ticketsCount_filtered()
    {
        $this->_get_tickets_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function ticketsCount_all()
    {
        $this->db->from(ORDERS." AS n");

        return $this->db->count_all_results();
    }
    // Ends
    // ***************************************













    // ***************************************
    // Note: used for purchases
    // ***************************************


    
        private function _get_products_purchases_query()
    {
        $where_title    = '';
        
        if(!empty($_POST['search']))
        {        
         $host = trim($_POST['search']);
         $where_domains =  " ps.domain LIKE '%{$host}%'";
        }

        $where = "$where_domains";

        if(!empty($where)){
            $this->db->where($where);
        }
        

        $customer_id = $this->session->userdata($this->site_session->userid());
                                                                                                     
        $this->db->select('ps.*,o.*, Order_ID DO_ID, domain Domain_Name, o.Timestamp DTO_Created, p.OrderType');
        $this->db->from(TBL_ORDERS.' as o');
        $this->db->join(TBL_PRODUCT_SUBSCRIPTIONS.' as ps', 'ps.Subscription_ID = o.Subscription_ID');
        $this->db->join(TBL_PRODUCTS.' as p', 'p.Product_ID = ps.Product_ID');
        $this->db->where('ps.Customer_ID', $customer_id);
        $this->db->where('o.Payment_Verified', 1);
        $this->db->order_by('o.Order_ID','desc');                                          

      
    }


    public function getPayedTransferOrders($customer_id,$domain_name){

          return  $this->db
                                            ->select('t.*,o.*')
                                            ->from(TRANSFER.' as t')
                                            ->join(TRANSFER_ORDERS.' as o', 't.DTI__ID = o.DTI_ID')
                                            ->where('t.DTI_Customer_ID', $customer_id)
                                            ->where('t.DTI_Domain_Name', $domain_name)                                            
                                            ->where('o.Payment_Verified', 1)
                                            ->order_by('t.DTI__ID','desc')                                          
                                            ->get()
                                            ->row();
     }


    private function _get_purchases_query()
    {
        $where_domains    = '';
        
        if(!empty($_POST['search']))
        {        
         $host = trim($_POST['search']);
         $where_domains_register =  " CONCAT(d.Domain_Name, '', d.TLD) LIKE '%{$host}%'";
         $where_domains_transfer =  " CONCAT(t.DTI_Domain_Name, '', t.DTI_TLD) LIKE '%{$host}%'";

        $this->db->group_start();
        $this->db->where($where_domains_register);
        $this->db->or_where($where_domains_transfer);
        $this->db->group_end();

        }


        $customer_id = $this->session->userdata($this->site_session->userid());


        $this->db->select('r.*,
   
        o.DO_ID as PUR_DO_ID,
        o.HY_ID as PUR_HY_ID,
        o.OR_ID as PUR_OR_ID,
        o.Domain_ID as PUR_OR_ID,
        o.Customer_ID as PUR_Customer_ID,
        o.Total_Price as PUR_Total_Price,
        o.Vat as PUR_Vat,
        o.Discount_Details as PUR_Discount_Details,
        o.Discount as PUR_Discount,
        o.Payment_Verified as PUR_Payment_Verified,
        o.Payment_Refunded as PUR_Payment_Refunded,        
        o.Payment_Referance as PUR_Payment_Referance,
        o.Expire_Date as PUR_Expire_Date,
        o.Cart_Type as PUR_Cart_Type,
        o.Payment_Type as PUR_Payment_Type,
        o.Payment_Gateway as PUR_Payment_Gateway,
        o.Request_ID as PUR_Request_ID,
        o.Created_AT as PUR_DTO_Created,
        o.Order_Type as PUR_Order_Type,

        to.*,
        d.*,i.*, 
        t.DTI_Domain_Name as PUR_Domain_Name,
        t.DTI_TLD as PUR_TLD, 


        ');
        $this->db->from(REQUEST.' as r');
        $this->db->join(TRANSFER_ORDERS.' as to', "r.DCR_ID = to.Request_ID",'left');
        $this->db->join(TRANSFER.' as t', 't.DTI__ID = to.DTI_ID','left');

        $this->db->join(ORDERS.' as o', "r.DCR_ID = o.Request_ID",'left');
        $this->db->join(DOMAIN.' as d', 'o.Domain_ID = d.Domain_ID','left');
        $this->db->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID','left');

        $this->db->where('r.DCR_USER_ID', $customer_id);

        $this->db->group_start();
        $this->db->where('o.Payment_Verified', 1);
        $this->db->or_where('to.Payment_Verified', 1);
        $this->db->group_end();


        $this->db->group_start();
        $this->db->where('r.DCR_Request_Type', 'create_domain');
        $this->db->or_where('r.DCR_Request_Type', 'domain_transfer_in');
        $this->db->group_end();

        $this->db->order_by('r.DCR_ID','desc'); 


      
    }

    function getPurchasesList()
    {       
        $this->_get_purchases_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        $query1 = $this->db->get();


    
        
        // $this->_get_products_purchases_query();
        // if($_POST['length'] != -1)
        // $this->db->limit($_POST['length'], $_POST['start']);

        // $query3 = $this->db->get();


        return $query1->result();

    }
 
    function purchasesCount_filtered()
    {
        $q1 = $this->_get_purchases_query();
        $q1 = $this->db->get();
        $purchase_orders = $q1->num_rows();

        return $purchase_orders;


    }
 
    public function purchasesCount_all()
    {
        $q1 = $this->_get_purchases_query();
        $q1 = $this->db->get();
        $purchase_orders = $q1->num_rows();

        return $purchase_orders;


    }
    // Ends
    // ***************************************








    
    
    
    // ***************************************
  	// Note: used for orders
  	// ***************************************
  	private function _get_orders_query()
	{
		$where_title    = '';
        
        if(!empty($_POST['search']))
        {        
         $host = trim($_POST['search']);
         $where_domains =  " CONCAT(d.Domain_Name, '', d.TLD) LIKE '%{$host}%'";
        }

        $where = "$where_domains";

        if(!empty($where)){
            $this->db->where($where);
        }

        $customer_id = $this->session->userdata($this->site_session->userid());

        $this->db->select('d.*,r.*,i.*');
        $this->db->from(REQUEST.' as r');
        $this->db->join(DOMAIN.' as d', 'r.DCR_Domain_ID = d.Domain_ID','left');
        $this->db->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID','left');
        $this->db->where('r.DCR_USER_ID', $customer_id);
        $this->db->where('r.DCR_Status !=', 'deleted');
        // $this->db->order_by("FIELD ( r.DCR_Status, 'need_modification', 'incomplete', 'pending', 'approved' ,'refused' ,'deleted' ,'canceled' )", '', FALSE);           
        $this->db->order_by('r.DCR_ID','desc');                                          

      
    }




    function getOrdersList()
    {	    

        $this->_get_orders_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        $requests =  $query->result();

        return  $requests;

    }
 
    function ordersCount_filtered()
    {


        $this->_get_orders_query();
        $orders =  $this->db->count_all_results();


        return $orders;


    }
 
    public function ordersCount_all()
    {

        $this->_get_orders_query();
        $orders =  $this->db->count_all_results();


        return $orders;
    }
    // Ends
	// ***************************************
	
}
?>    