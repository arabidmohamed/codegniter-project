<?PHP
class Invoices_model extends CI_Model
{

    private function _get_purchases_transfers_query()
    {
        $where_invoice_id = '';
        $where_domain     = '';
        $where_order_date = '';

        if(!empty($_POST['invoice_id']))
        {        
            $invoice_id = ltrim(preg_replace('/[A-Z]+/', '',$_POST['invoice_id']), '0'); // to remove INV from int
            $where_invoice_id = "o.DTO_ID LIKE '%$invoice_id%' AND";
        }
        if(!empty($_POST['domain']))
        {        
            $domain = trim($_POST['domain']);
            $where_domains = "t.DTI_Domain_Name LIKE '%$domain%' AND";
        }
        if(!empty($_POST['order_date']))
        {        
            $order_date = trim($_POST['order_date']);
            $where_order_date = "t.DTI_Created LIKE '%$order_date%' AND";
        }

        $where = "$where_invoice_id $where_domains $where_order_date DTO_ID > 0";
                           
        if(!empty($where)){
            $this->db->where($where);
        }

        $this->db->select('t.*,o.*,t.DTI_Created as Created_AT, t.DTI_Domain_Name as Domain_Name, t.DTI_TLD as TLD, o.DTO_ID as DO_ID');
        $this->db->from(TRANSFER.' as t');
        $this->db->join(TRANSFER_ORDERS.' as o', 't.DTI__ID = o.DTI_ID');
        $this->db->order_by('o.DTO_ID','desc');   
        $this->db->group_by('o.DTO_ID');
      
    }
    
    private function _get_products_purchases_query()
    {
        $where_invoice_id = '';
        $where_domain     = '';
        $where_order_date = '';
        
        if(!empty($_POST['invoice_id']))
        {        
            $invoice_id = ltrim(preg_replace('/[A-Z]+/', '',$_POST['invoice_id']), '0'); // to remove INV from int
            $where_invoice_id = "o.Order_ID LIKE '%$invoice_id%' AND";
        }
        //dd($where_invoice_id);
        if(!empty($_POST['domain']))
        {        
            $domain = trim($_POST['domain']);
            $where_domains = "Domain_Name LIKE '%$domain%' AND";
        }
        if(!empty($_POST['order_date']))
        {        
            $order_date = trim($_POST['order_date']);
            $where_order_date = "o.Timestamp LIKE '%$order_date%' AND";
        }

        $where = "$where_invoice_id $where_order_date o.Order_ID > 0";

        if(!empty($where)){
            $this->db->where($where);
        }

        $this->db->select('ps.*,o.*, Order_ID DO_ID, domain Domain_Name, o.Timestamp DTO_Created, p.OrderType ');
        $this->db->from(TBL_ORDERS.' as o');
        $this->db->join(TBL_PRODUCT_SUBSCRIPTIONS.' as ps', 'ps.Subscription_ID = o.Subscription_ID');
        $this->db->join(TBL_PRODUCTS.' as p', 'p.Product_ID = ps.Product_ID');
        $this->db->where('o.Payment_Verified', 1);
        $this->db->order_by('o.Order_ID','desc'); 
        $this->db->group_by('o.Order_ID');
        $this->db->where($where);                                          
        
      
    }


    public function getPayedTransferOrders($domain_name){

          return  $this->db
                    ->select('t.*,o.*')
                    ->from(TRANSFER.' as t')
                    ->join(TRANSFER_ORDERS.' as o', 't.DTI__ID = o.DTI_ID')
                    ->where('t.DTI_Domain_Name', $domain_name)                                            
                    ->where('o.Payment_Verified', 1)
                    ->order_by('t.DTI__ID','desc') 
                    ->group_by('t.DTI__ID')                                          
                    ->get()
                    ->row();
     }


    private function _get_purchases_query()
    {
        $where_invoice_id = '';
        $where_domain     = '';
        $where_order_date = '';

        if(!empty($_POST['invoice_id']))
        {        
            $invoice_id = ltrim(preg_replace('/[A-Z]+/', '',$_POST['invoice_id']), '0'); // to remove INV from int
            $where_invoice_id = "o.DO_ID LIKE '%$invoice_id%' AND";
            //dd($invoice_id);
        }
        if(!empty($_POST['domain']))
        {        
            //dd(trim($_POST['domain']));
            $domain = trim($_POST['domain']);
            $where_domains = "d.Domain_Name LIKE '%$domain%' AND";
            ;
        }
        if(!empty($_POST['order_date']))
        {        
            $order_date = trim($_POST['order_date']);
            $where_order_date = "o.Created_At LIKE '%$order_date%' AND";
        }

        $where = "$where_invoice_id $where_domains $where_order_date o.DO_ID > 0";

        if(!empty($where)){
            $this->db->where($where);
        }
        
        $this->db->select('d.*,o.*,o.Created_AT as DTO_Created');
        $this->db->from(ORDERS.' as o');
        $this->db->join(DOMAIN.' as d', 'o.Domain_ID = d.Domain_ID');
        $this->db->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID');
        $this->db->order_by('o.DO_ID','desc');                                                                                
        $this->db->group_by('o.DO_ID');
    }

    function getPurchasesList()
    {       
        $this->_get_purchases_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        $query1 = $this->db->get();


        $this->_get_purchases_transfers_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        $query2 = $this->db->get();
        
        $this->_get_products_purchases_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        $query3 = $this->db->get();


        $results = array();

        if ($query1->num_rows()) 
        {
            $results = array_merge($results, $query1->result());
        }

        if ($query2->num_rows())
        {
            $results = array_merge($results, $query2->result());
        }
        
        if ($query3->num_rows())
        {
            $results = array_merge($results, $query3->result());
        }
        return $results;

    }
 
    function purchasesCount_filtered()
    {
        $q1 = $this->_get_purchases_query();
        $q1 = $this->db->get();
        $purchase_orders = $q1->num_rows();

        $q2 = $this->_get_purchases_transfers_query();
        $q2 = $this->db->get();
        $transfer_orders = $q2->num_rows();

        $num =  $purchase_orders + $transfer_orders;
        if($num >= 12){
            $num =  $num - 12;
        }
        return $num;
    }
 
    public function purchasesCount_all()
    {
        $q1 = $this->_get_purchases_query();
        $q1 = $this->db->get();
        $purchase_orders = $q1->num_rows();

        $q2 = $this->_get_purchases_transfers_query();
        $q2 = $this->db->get();
        $transfer_orders = $q2->num_rows();

        $num = $purchase_orders + $transfer_orders;

        if($num >= 12){
            $num =  $num - 12;
        }
        return $num;
    }



    // used for pdf
    public function Get_WebsiteSettings()
    {
        $data = $this->db->get(TBL_WEBSITE_SETTINGS);
        return $data->result();
    }

    public function getInvoiceDetails($order_id,$type){         
        if($type)
        {
                if($type == 3){
                    $details =  $this->db
                            ->select('*,o.Order_ID as DO_ID, o.Subscription_ID as Request_ID, VAT as Vat, domain as Domain_Name, period as Period, s.timestamp as DTO_Created, s.Expires_At Expire_Date, Fullname Full_Name')
                            ->from(TBL_ORDERS.' as o')
                            ->join(TBL_PRODUCT_SUBSCRIPTIONS.' as s', 's.Subscription_ID =o.Subscription_ID')
                            ->join(TBL_PRODUCTS.' as p', 'p.Product_ID = s.Product_ID')
                            ->join(TBL_CUSTOMERS.' as c', 's.Customer_ID = c.Customer_ID')
                            ->where('o.Order_ID', $order_id)
                            ->get()
                            ->row();
    //                     echo $this->db->last_query();exit;
                }else{
                        $details =  $this->db
                            ->select('*,o.DTO_ID as DO_ID')
                            ->from(TRANSFER_ORDERS.' as o')
                            ->join(DOMAIN.' as d', 'd.Domain_ID = o.Domain_ID','left')
                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                            ->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID') 
                            ->where('o.DTO_ID', $order_id)
                            ->get()
                            ->row();
                    
                }
            }else{
                    $details = $this->db
                            ->select('*,o.Created_AT as DTO_Created')
                            ->from(ORDERS.' as o')
                            ->join(DOMAIN.' as d', 'd.Domain_ID = o.Domain_ID')
                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                            ->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID') 
                            ->where('o.DO_ID', $order_id)
                            ->get()
                            ->row();
            }

            return $details;
    }

    public function getRequestByID($request_id){
        return   $this->db
                    ->select('*')
                    ->from(REQUEST.' as r')
                    ->join(DOMAIN.' as d', 'r.DCR_Domain_ID = d.Domain_ID','left')                                          
                    ->where('r.DCR_ID', $request_id)
                    ->get()
                    ->row();
    }
    
    public function getTransferDomainOrderV2($order_id){
        return   $this->db
                    ->select('*,o.DTO_Created as Created_AT ,o.DTO_Payed_At as Payed_AT ,o.DTO_ID as DO_ID ,t.DTI_Domain_Name as Domain_Name ,t.DTI_TLD as TLD  ')
                    ->from(TRANSFER_ORDERS.' as o')
                    ->join(TRANSFER.' as t', 't.DTI__ID = o.DTI_ID','right')
                    ->where('o.DTO_ID', $order_id)
                    ->where('o.Payment_Verified', 1)
                    ->get()
                    ->row();
    }
     
} 
?>