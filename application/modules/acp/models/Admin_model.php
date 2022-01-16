<?PHP

class Admin_model extends CI_Model {

    public function getAllCountries() {
        return $this->db
                        ->get('countries')
                        ->result();
    }

    public function getAllCities() {
        return $this->db
                        ->get('sa_cities')
                        ->result();
    }

    public function getAllDiscountTypes() {
        return $this->db
                        ->get('customers_discounts')
                        ->result();
    }

    public function getcommunications($communication_id = '') {
        if (!empty($communication_id)) {
            $this->db->where('t.CommunicationId', $communication_id);
        }
        $t = $this->db
                ->select('t.*, c.Fullname, c.Email, c.Phone')
                ->from('customer_communications as t')
                ->join('customers as c', 'c.Customer_ID = t.CustomerId')
                ->order_by('t.Timestamp', 'DESC')
                ->get();

        if (!empty($communication_id)) {
            return $t->row();
        }

        return $t->result();
    }

    // ***************************************
    // Note: used for total counting feature
    // ***************************************

    public function getCountersDetails() {
        $query = $this->db->select("*")
                ->from(TBL_COUNTERS)
                ->get();
        return $query->result();
    }

    public function updateCounterDetails($data = array()) {
        $query = $this->db->update(TBL_COUNTERS, $data);
        return $query;
    }

    // ***************************************

    public function getcommunicationsStats() {
        $p = $this->db->where('Status', 'Pending')->get('customer_communications')->num_rows();
        $c = $this->db->where('Status', 'Closed')->get('customer_communications')->num_rows();
        $prg = $this->db->where('Status', 'In Progress')->get('customer_communications')->num_rows();

        return array('Pending' => $p, 'Closed' => $c, 'InProgress' => $prg);
    }

    public function updatecommunicationstatus($data = array()) {
        return $this->db->where('CommunicationId', $data['CommunicationId'])->update('customer_communications', $data);
    }

    public function getcommunicationComments($communication_id = '') {
        return $this->db->where('CommunicationId', $communication_id)->get('customer_communication_comments')->result();
    }

    public function addcommunicationComment($comment = array()) {
        $this->db->insert('customer_communication_comments', $comment);
        return $this->db->insert_id();
    }

    public function checkActivityAuthorization($role_id = 0, $controller = '', $action = '') {
        $dt = $this->db
                ->select('rp.*')
                ->from(TBL_ROLES_PERMISSIONS . ' as rp')
                ->join(TBL_MENUS . ' as m', 'm.Id = rp.Menu_ID')
                ->join('rbac_actions as a', 'a.Action_ID = rp.Action_ID')
                ->where('m.Menu_Key', $controller)
                ->where('rp.Role_ID', $role_id)
                ->where('a.Action_Key', $action)
                ->get();

        //echo $this->db->last_query(); die();

        if ($dt->num_rows() >= 1) {
            return 1;
        }

        return 0;
    }

    public function getRoleSidebarMenu($role_id = 0) {
        if ($role_id == COMPANY_ROLE) {
            $menu_order = "1,94,91,92,23,93";
            $this->db->order_by("FIELD(m.Menu_ID, {$menu_order})");
        }

        $dt = $this->db
                ->select('m.*, 0 as childMenu')
                ->from(TBL_MENUS . ' as m')
                ->join(TBL_MENU_ACTIONS . ' as ma', 'ma.Menu_ID = m.Menu_ID')
                ->join(TBL_ROLES_PERMISSIONS . ' as rp', 'rp.MenuAction_ID = ma.MA_ID')
                ->where('rp.Role_ID', $role_id)
                ->where('m.Is_SideBar_Menu', 1)
                ->where('m.Parent_ID', 0)
                ->order_by('m.Menu_ID', 'ASC')
                ->get();

        $menu = $dt->result();

        foreach ($menu as $m) {
            $m->childMenu = $this->db
                    ->select('m.*')
                    ->from(TBL_MENUS . ' as m')
                    ->where('m.Parent_ID', $m->Menu_ID)
                    ->where('m.Parent_ID != 0')
                    ->order_by('m.Menu_ID', 'ASC')
                    ->get()
                    ->result();
        }

        return $menu;
    }

    public function getSidebarMenu() {
        $roleid = $this->session->userdata($this->acp_session->role_id());

        if ($roleid != 1 and $roleid != 3) {
            $this->db->join("rbac_roles_permissions as p", "p.Menu_ID = m.Id");
            $this->db->where('p.Role_ID', $roleid);
            $this->db->group_by('Menu_ID');
        }
        $query = $this->db
                ->select('m.*, wf.*')
                ->from(TBL_MENUS . ' as m')
                ->join("website_features as wf", "wf.PID = m.Id")
                ->where('wf.Status', 1)
                ->order_by('Order_In_List', 'asc')
                ->get();


        return $query->result();
    }

    public function getSidebarSubMenu() {
        $roleid = $this->session->userdata($this->acp_session->role_id());
        if ($roleid != 1) {
            $this->db->join("rbac_roles_permissions as p", "p.Menu_ID = m.Id");
            $this->db->where('p.Role_ID', $roleid);
            $this->db->group_by('Menu_ID');
        }

        return $this->db->select('m.*')
                        ->from(TBL_MENUS . ' as m')
                        ->where('m.Parent_ID >', 0)
                        ->get()
                        ->result();
    }

    function get_customer_subscriptions() {
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $this->db->like('c.Email', $email);
        }

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $this->db->like('c.Fullname', $name);
        }
        if (!empty($_POST['status'])) {
            $this->db->where('s.Status', $_POST['status']);
        }
        if (!empty($_POST['domain'])) {
            $this->db->where('s.domain', $_POST['domain']);
        }
        if (!empty($_POST['product'])) {
            $this->db->where('s.Product_ID', $_POST['product']);
        }
        if (!empty($_POST['payment'])) {
            if ($_POST['payment'] == -1)
                $this->db->where('ord.payment_verified', 0);
            else
                $this->db->where('ord.payment_verified', $_POST['payment']);
        }

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

         return $this->db->select('*, s.Status as subStatus')
                        ->from(TBL_PRODUCT_SUBSCRIPTIONS . ' as s')
                        ->join(TBL_ORDERS.' as ord', 'ord.Subscription_ID = (select Subscription_ID from '.TBL_ORDERS.' as e2 where e2.Subscription_ID = s.Subscription_ID ORDER BY Payment_Verified desc limit 1)', 'left')
                        ->join(TBL_PRODUCTS . ' as p', 'p.Product_ID = s.Product_ID')
                        ->join(TBL_CUSTOMERS . ' as c', 'c.Customer_ID = s.Customer_ID')
                        ->order_by('ord.TimeStamp', 'desc')
                        ->group_by('s.Subscription_ID')
                        ->get()->result();
    }

    /* -----------------------------------------------------------
      ---------------------- Product function -----------------
      -------------------------------------------------------- */

    public function getProducts() {
        return $this->db->get(TBL_PRODUCTS)->result();
    }

    public function addProduct($data = array()) {
        $query = $this->db->insert(TBL_PRODUCTS, $data);
        return $query;
    }

    public function addPrice($data = array()) {
        $query = $this->db->insert('product_prices', $data);
        return $query;
    }

    public function getProductPrices($id) {
        $this->db->where(array('Product_ID' => $id));
        return $this->db->get('product_prices')->result();
    }

    public function getProductByID($data = '') {
        $this->db->where(array('Product_ID' => $data['product_id']));
        return $this->db->get(TBL_PRODUCTS)->result();
    }

    public function deleteProduct($data = array()) {
        $this->db->where('Product_ID', $data['Product_ID']);
        return $this->db->delete(TBL_PRODUCTS);
    }

    public function deletePrice($id) {
        $this->db->where('Price_ID', $id);
        return $this->db->delete('product_prices');
    }

    public function updateProduct($data = array()) {
        $this->db->where(array('Product_ID' => $data['Product_ID']));
        $query = $this->db->update(TBL_PRODUCTS, $data);
        return $query;
    }

    public function updatePrices($data = array(), $id) {
        $query = $this->db->update('product_prices', $data, array('Price_ID' => $id));
        return $query;
    }

    public function getProductImages($data = array()) {
        $where = array(
            'Product_ID' => $data['Product_ID']
        );
        return $this->db->select('Product_logo')->from(TBL_PRODUCTS)->where($where)->get()->result();
    }

    public function getorderById($order_id) {
        $this->db->select('*, product_subscriptions.Status as subStatus');
        $this->db->where('product_orders.Order_ID', $order_id);
        $this->db->join('product_subscriptions', 'product_orders.Subscription_ID=product_subscriptions.Subscription_ID');
        $this->db->join('products', 'products.Product_ID=product_subscriptions.Product_ID');
        $this->db->join('product_prices', 'product_prices.Price_ID=product_subscriptions.Price_ID');
        $this->db->join('customers', 'customers.Customer_ID=product_subscriptions.Customer_ID');

        $q = $this->db->get('product_orders');
        return $q->row();
    }
    
    public function getorderBySubscription($subscription_id) {
            $this->db->select('*, product_subscriptions.Status as subStatus');
            $this->db->from(TBL_ORDERS . ' as o');
            $this->db->join('product_subscriptions', 'o.Subscription_ID=product_subscriptions.Subscription_ID');
            $this->db->join('products', 'products.Product_ID=product_subscriptions.Product_ID');
            $this->db->join('product_prices', 'product_prices.Price_ID=product_subscriptions.Price_ID');
            $this->db->join('customers', 'customers.Customer_ID=product_subscriptions.Customer_ID');
            $this->db->where('o.Subscription_ID', $subscription_id);
            $q = $this->db->get();
            return $q->result();
    }

    public function Is_Menu_Disabled($link) {
        return $this->db
                        ->select('m.*, wf.*')
                        ->from(TBL_MENUS . ' as m')
                        ->join("website_features as wf", "wf.PID = m.Id")
                        ->where('wf.Status', 0)
                        ->where('m.Link', $link)
                        ->get()
                        ->row();
    }

    public function Is_Parent_Menu_Disabled($link, $icon) {
        return $this->db
                        ->select('m.*, wf.*')
                        ->from(TBL_MENUS . ' as m')
                        ->join("website_features as wf", "wf.PID = m.Id")
                        ->where('wf.Status', 0)
                        ->where('m.Link', $link)
                        ->where('m.Icon', $icon)
                        ->get()
                        ->row();
    }

    public function getSubscriptionGoals() {
        $goals = $this->db
                ->where('Status', 1)
                ->where('type', 'goal')
                ->get('customer_preferance_options')
                ->result();

        return $goals;
    }

    public function getSubscriptionActivity() {
        $goals = $this->db
                ->where('Status', 1)
                ->where('type', 'activity')
                ->get('customer_preferance_options')
                ->result();

        return $goals;
    }

    public function getSubscriptionInterest() {
        $goals = $this->db
                ->where('Status', 1)
                ->where('type', 'interest')
                ->get('customer_preferance_options')
                ->result();

        return $goals;
    }

    //table names defined in constants

    public function GetWebsitetLanguage() {
        $query = $this->db->query('select Website_Language from ' . TBL_WEBSITE_SETTINGS)->result()[0]->Website_Language;
        return $query;
    }

    public function changeLanguage($data = array()) {
        return $this->db->update(TBL_WEBSITE_SETTINGS, $data);
    }

    public function add_log($log = array()) {
        return $this->db->insert(TBL_LOGS_OPERATIONS, $log);
    }

    /* -----------------------------------------------------------
      ---------------------- User Section -----------------
      -------------------------------------------------------- */

    // #get user function
    public function getUser($data = array()) {
        $where = array('User_ID' => $data['user_id']);
        $this->db->where($where);
        $dt = $this->db->get(TBL_USERS);
        return $dt->result();
    }

    public function updateUser($data = array()) {
        $where = array('User_ID' => $data['User_ID']);
        $this->db->where($where);
        return $this->db->update(TBL_USERS, $data);
    }

    public function getAllCustomers() {
        return $this->db->distinct('Mobile_ID')->get(TBL_CUSTOMERS)->result();
    }

    public function getCustomers() {
        return $this->db
                        ->distinct()
                        ->get(TBL_CUSTOMERS)
                        ->result();
    }

    public function getNewTickets() {
        $data = $this->db
                ->where('Status', 'New')
                ->get('customer_tickets')
                ->num_rows();
        return $data;
    }

    public function getChartTotalCustomers($date){

          $query =  $this->db

                   ->select('Customer_ID')
                   ->from(TBL_CUSTOMERS)
                   ->where('date(TimeStamp)',$date)                   
                   ->get()
                   ->num_rows();

        return $query;

               
    }

    public function getChartTotalRegistration($date){

          $query =  $this->db
                   ->from(REQUEST.' as r')
                   ->join(ORDERS.' as o', "r.DCR_ID = o.Request_ID",'left')
                   ->where('o.Payment_Verified', 1)
                   ->where('r.DCR_Request_Type', 'create_domain')
                   ->where('date(r.DCR_Created_At)',$date)               
                   ->get()
                   ->num_rows();

        return $query;

               
    }

    public function getChartTotalTransfer($date){

          $query =  $this->db
                   ->from(REQUEST.' as r')
                   ->join(TRANSFER_ORDERS.' as to', "r.DCR_ID = to.Request_ID",'left')
                   ->where('to.Payment_Verified', 1)
                   ->where('r.DCR_Request_Type', 'domain_transfer_in')
                   ->where('date(r.DCR_Created_At)',$date)               
                   ->get()
                   ->num_rows();

        return $query;

               
    }

    public function getTotals() {
        // under review and not verified
        $domain_registered = $this->db
                ->where('Domain_Status', 'Done')
                ->get('domains')
                ->num_rows();
        $customers = $this->db
                ->get('customers')
                ->num_rows();
        $tickets_opened = $this->db
                ->where('Status', 'Pending')
                ->get('customer_tickets')
                ->num_rows();
        $tickets_closed = $this->db
                ->where('Status', 'Closed')
                ->get('customer_tickets')
                ->num_rows();

        $pending_transfer = $this->db
                ->from('domains_transfer_in')
                ->where('DTI_Status', 'PENDING')
                ->get()
                ->num_rows();

        $completed_transfer = $this->db
                ->from('domains_transfer_in')
                ->where('DTI_Status', 'APPROVED')
                ->get()
                ->num_rows();

        $pending_domain = $this->db
                ->from('domains')
                ->where('Domain_Status', 'PENDING')
                ->get()
                ->num_rows();

        $completed_domain = $this->db
                ->from('domains')
                ->where('Domain_Status', 'Done')
                ->get()
                ->num_rows();

        return array('domain_registered' => $domain_registered,
            'customers' => $customers,
            'tickets_opened' => $tickets_opened,
            'tickets_closed' => $tickets_closed,
            'pending_transfer' => $pending_transfer,
            'completed_transfer' => $completed_transfer,
            'pending_domain' => $pending_domain,
            'completed_domain' => $completed_domain
        );
    }

    public function getDomainTransferIncome() {
        $data = $this->db
                ->select('SUM(Total_Price) as TransferTotalPrice')
                ->from('domains_transfer_orders')
                ->where('Payment_Verified', 1)
                ->where('Payment_Refunded', 0)
                ->get();
        return $data->row();
    }

    public function getDomainOrderIncome() {
        $data = $this->db
                ->select('SUM(Total_Price) as DomainTotalPrice')
                ->from('domains_orders')
                ->where('Payment_Verified', 1)
                ->where('Payment_Refunded', 0)
                ->get();
        return $data->row();
    }

    public function getAboutUSDetails($slug) {
        $query = $this->db->select("*")
                ->from('about_us')
                ->where('Slug', $slug)
                ->get();
        return $query->result();
    }

    public function editAboutUsDetails($data = array()) {
        $where = array('Slug' => $data['Slug']);
        $this->db->where($where);
        $query = $this->db->update('about_us', $data);
        return $query;
    }

    public function getConstantByParantID($parant_id = 0) {
        return $this->db
                        ->where('parent', $parant_id)
                        ->get('constants')
                        ->result();
    }

    public function getCustomerByID($customer_id = 0) {
        return $this->db
                        ->where('Customer_ID', $customer_id)
                        ->get(TBL_CUSTOMERS)
                        ->result();
    }

    public function getCustomerPreferancesByID($customer_id = 0) {
        return $this->db
                        ->where('Customer_ID', $customer_id)
                        ->get('customer_experiences')
                        ->row();
    }

    public function getCustomerPreferences($customer_id = 0) {
        return $this->db
                        ->where('Customer_ID', $customer_id)
                        ->get('customer_experiences')
                        ->row();
    }

    public function updateCustomer($data = array()) {
        $upd = $this->db->where('Customer_ID', $data['Customer_ID'])->update(TBL_CUSTOMERS, $data);
        return $upd;
    }

    public function getCustomerSubscriptionDetails($customer_id = 0) {

        $sub = $this->db
                ->select('cs.*,c.*,sp.Plan_Name_en,sp.Plan_Name_ar,sp.Plan_Price')
                ->from(TBL_CUSTOMER_SUBSCRIPTIONS . ' as cs')
                ->join('customers as c', 'c.Customer_ID = cs.Customer_ID')
                ->join('subscription_plans as sp', 'cs.Plan_ID = sp.Plan_ID')
                ->where('cs.Customer_ID', $customer_id)
                ->where('cs.Starts_At <=', date('Y-m-d'))
                ->where('cs.Expires_At >= ', date('Y-m-d'))
                ->limit(1)
                ->order_by('cs.SC_ID', "DESC")
                ->get()
                ->row();

        if (empty($sub)) {
            $sub = $this->db
                    ->select('cs.*,c.*,sp.Plan_Name_en,sp.Plan_Name_ar,sp.Plan_Price')
                    ->from(TBL_CUSTOMER_SUBSCRIPTIONS . ' as cs')
                    ->join('customers as c', 'c.Customer_ID = cs.Customer_ID')
                    ->join('subscription_plans as sp', 'cs.Plan_ID = sp.Plan_ID')
                    ->where('cs.Customer_ID', $customer_id)
                    ->limit(1)
                    ->order_by('cs.SC_ID', "DESC")
                    ->get()
                    ->row();
        }
        return $sub;
    }

    public function getCustomerSubscriptionDiscountDetails($customer_id = 0, $startdate = '', $expdate = '') {
        $a = $this->db
                ->select('cs.*')
                ->from(TBL_CUSTOMER_SUBSCRIPTION_HISTORY . ' as cs')
                //->join('promo_codes as promo', 'promo.Code = cs.PromoCode')
                ->where('cs.Customer_ID', $customer_id)
                ->where('cs.Starts_At', $startdate)
                ->where('cs.Expires_At', $expdate)
                ->get();

        //echo $this->db->last_query();

        return $a->row();
    }

    public function getNewOrders() {
        return $this->db->where('Order_Status', 'Pending')->get(TBL_ORDERS_HEAD)->num_rows();
    }

    public function getReports($fromDate = '', $toDate = '') {

        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("pu.Timestamp >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("pu.Timestamp <= '{$toDate} 23:59:00'");
        }
        $used_coupons = $this->db->where('pu.Status', 'used')->get('promo_code_usage as pu')->num_rows();



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("oh.TimeStamp >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("oh.TimeStamp <= '{$toDate} 23:59:00'");
        }

        $used_coupons_value = $this->db
                ->select('SUM(oh.Discount) as totalDiscount')
                ->from(TBL_ORDERS_HEAD . ' as oh')
                ->where("oh.Payment_Verified", 1)
                ->get()
                ->result();


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("oh.TimeStamp >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("oh.TimeStamp <= '{$toDate} 23:59:00'");
        }

        $totalSales = $this->db
                ->select('SUM(oh.OrderTotal_Price) as totalSales')
                ->from(TBL_ORDERS_HEAD . ' as oh')
                ->where("oh.Payment_Verified", 1)
                ->get()
                ->result();

        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("oh.TimeStamp >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("oh.TimeStamp <= '{$toDate} 23:59:00'");
        }

        $totalIncome = $this->db
                ->select('SUM(oh.OrderTotal_Price) as totalIncome')
                ->from(TBL_ORDERS_HEAD . ' as oh')
                ->where("oh.Payment_Verified", 1)
                ->where("oh.Order_Status != 'Returned'")
                ->where("oh.Order_Status != 'Canceled'")
                ->get()
                ->result();


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("oh.TimeStamp >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("oh.TimeStamp <= '{$toDate} 23:59:00'");
        }

        $total_tax = $this->db
                ->select('SUM(oh.VAT_TAX) as totalTax')
                ->from(TBL_ORDERS_HEAD . ' as oh')
                ->where("oh.Payment_Verified", 1)
                ->get()
                ->result();


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("oh.TimeStamp >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("oh.TimeStamp <= '{$toDate} 23:59:00'");
        }
        $total_delivery = $this->db
                ->select('SUM(oh.DeliveryPrice) as totalDelivery')
                ->from(TBL_ORDERS_HEAD . ' as oh')
                ->where("oh.Payment_Verified", 1)
                ->get()
                ->result();


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("oh.TimeStamp >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("oh.TimeStamp <= '{$toDate} 23:59:00'");
        }

        $total_Canceled = $this->db
                ->select('SUM(oh.OrderTotal_Price) as totalCanceled')
                ->from(TBL_ORDERS_HEAD . ' as oh')
                ->where("oh.Payment_Verified", 1)
                ->where("oh.Order_Status", 'Canceled')
                ->get()
                ->result();

        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("oh.TimeStamp >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("oh.TimeStamp <= '{$toDate} 23:59:00'");
        }

        $total_Returned = $this->db
                ->select('SUM(oh.OrderTotal_Price) as totalReturned')
                ->from(TBL_ORDERS_HEAD . ' as oh')
                ->where("oh.Payment_Verified", 1)
                ->where("oh.Order_Status", 'Returned')
                ->get()
                ->result();


        return array(
            'total_delivery' => $total_delivery[0]->totalDelivery . ' ' . getSystemString('SAR'),
            'total_Canceled' => $total_Canceled[0]->totalCanceled . ' ' . getSystemString('SAR'),
            'total_Returned' => $total_Returned[0]->totalReturned . ' ' . getSystemString('SAR'),
            'total_tax' => $total_tax[0]->totalTax . ' ' . getSystemString('SAR'),
            'used_coupons_value' => $used_coupons_value[0]->totalDiscount . ' ' . getSystemString('SAR'),
            'used_coupons' => $used_coupons,
            'totalSales' => $totalSales[0]->totalSales . ' ' . getSystemString('SAR'),
            'totalIncome' => $totalIncome[0]->totalIncome . ' ' . getSystemString('SAR')
        );
    }

    public function getfinishedProducts() {

        $finished_products = [];
        $products = $this->db
                ->distinct()
                ->get(TBL_Class_PRICE_PERUNIT)
                ->result();
        $finished_products_ids = [];
        foreach ($products as $key => $product) {
            $rest = $product->Quantity - $product->Saled_Quantity;
            if ($rest <= 100 && $rest > 0) {
                //$finished_products_ids[] = $row->Class_ID;

                $finished_products[$key]->details = $this->db->select("*")
                        ->from('products')
                        ->where('Class_ID', $product->Class_ID)
                        ->get()
                        ->row();
                $finished_products[$key]->rest = $rest;
                $finished_products[$key]->Quantity = $product->Quantity;
                $finished_products[$key]->Saled_Quantity = $product->Saled_Quantity;
            }
        }

        // foreach ($finished_products_ids as $finished_products_id) {
        // 	$finished_products[] = $this->db->select("*")
        // 						->from('products')
        // 						->where('Class_ID',$finished_products_id)
        // 						->get()
        // 						->result();
        // }
        //var_dump($finished_products); exit();

        return $finished_products;
    }

    public function chartReportsData() {
        $TotalIncome = $this->db
                ->select("DATE_FORMAT(TimeStamp, '%Y-%m-%d') as date, SUM(OrderTotal_Price) as value")
                ->from(TBL_ORDERS_HEAD)
                ->group_by('DAY(TimeStamp)')
                ->get()
                ->result();

        $MostOrderedProducts = $this->db
                ->select('count(*) as Orders, p.Title_en as ProductTitle')
                ->from(TBL_ORDER_DETAILS . ' as od')
                ->join(TBL_CLASSES . ' as p', 'p.Class_ID = od.Class_ID')
                ->group_by('od.Class_ID')
                ->order_by('Orders', 'DESC')
                ->limit(10)
                ->get()
                ->result();

        $MostViewedProducts = $this->db
                ->select('count(*) as Views, p.Title_en as ProductTitle')
                ->from(TBL_CLASS_VIEWS . ' as pv')
                ->join(TBL_CLASSES . ' as p', 'p.Class_ID = pv.Class_ID')
                ->group_by('pv.Class_ID')
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

    /* -----------------------------------------------------------
      ---------------------- Sections Management -----------------
      -------------------------------------------------------- */

    public function getSections() {
        $query = $this->db->get(TBL_SECTIONS);
        return $query->result();
    }

    public function getSectionByID($data = array()) {
        $where = array('Section_ID' => $data['section_id']);
        $this->db->where($where);
        $query = $this->db->get(TBL_SECTIONS);
        return $query->result();
    }

    public function updateSection($data = array()) {
        $where = array('Section_ID' => $data['Section_ID']);
        $this->db->where($where);
        $query = $this->db->update(TBL_SECTIONS, $data);
        return $query;
    }

    // ******** Note: Added by A (10 Feb 2019)

    public function updateSelectedCustomers($data = array()) {
        $result = '';
        foreach ($data as $id) {
            $result = $this->db->where("ID", $id)->update(TBL_SUBSCRIBERS, array("Cron_Email_Flag" => 1));
        }
        return $result;
    }

    public function updateCustomersUsingRoles($role1 = 0, $role2 = 0) {
        $where = "Role_ID = $role1";
        if ($role2 != 0) {
            $where = "Role_ID >= $role1";
        }
        return $this->db->where($where)->update(TBL_CUSTOMERS, array("Cron_Email_Flag" => 1));
    }

    // ********


    /* -----------------------------------------------------------
      ---------------------- ABOUT US Section -----------------
      -------------------------------------------------------- */


    // #get Company details function
    public function getCompanyDetails() {
        $query = $this->db->select("a.*, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr")
                ->from(TBL_ABOUTUS . " as a")
                ->join(TBL_SECTIONS . " as s", "s.Section_ID = a.Section_ID")
                ->get();
        return $query->result();
    }

    // #Edit Company details function
    public function editCompanyDetails($data = array()) {
        $query = $this->db->update(TBL_ABOUTUS, $data);
        return $query;
    }

    /* -----------------------------------------------------------
      ---------------------- SERVICES Section -----------------
      -------------------------------------------------------- */

    // totals
    public function getServiceMale() {
        return $this->db->where('Status', 1)->get(TBL_SERVICES)->num_rows();
    }

    public function getServiceFemale() {
        return $this->db->where('Status', 0)->get(TBL_SERVICES)->num_rows();
    }

    // #Add Service function
    public function addService($data = array()) {
        $query = $this->db->insert(TBL_SERVICES, $data);
        return $query;
    }

    // #get services function
    public function getServices() {
        $query = $this->db
                ->select("ser.*, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr")
                ->from(TBL_SERVICES . " as ser")
                ->join(TBL_SECTIONS . " as s", "s.Section_ID = ser.Section_ID")
                ->order_by('Order_In_List', 'asc')
                ->get();
        return $query->result();
    }

    // #get service By ID function
    public function getServiceByID($data = null) {
        $where = array('Service_ID' => $data['service_id']);
        $this->db->where($where);
        $query = $this->db->get(TBL_SERVICES);
        return $query->result();
    }

    // #update service function
    public function updateService($data = null) {
        $where = array('Service_ID' => $data['Service_ID']);
        $this->db->where($where);
        $query = $this->db->update(TBL_SERVICES, $data);
        return $query;
    }

    // #delete service function
    public function deleteService($data = null) {
        $where = array('Service_ID' => $data['service_id']);
        $this->db->where($where);
        $query = $this->db->delete(TBL_SERVICES);
        return $query;
    }

    public function getServiceImages($data = array()) {
        $where = array(
            'Service_ID' => $data['Service_ID']
        );
        return $this->db->select('Original_Img, Icon')->from(TBL_SERVICES)->where($where)->get()->result();
    }

    /* -----------------------------------------------------------
      ---------------------- Top Management Section -----------------
      -------------------------------------------------------- */

    // #Add Service function
    public function addManage($data = array()) {
        $query = $this->db->insert('top_management', $data);
        return $query;
    }

    // #get services function
    public function getTop() {
        $query = $this->db
                ->select("ser.*")
                ->from('top_management' . " as ser")
                ->order_by('Order_In_List', 'asc')
                ->get();
        return $query->result();
    }

    // #get service By ID function
    public function getTopByID($data = null) {
        $where = array('Top_ID' => $data['top_id']);
        $this->db->where($where);
        $query = $this->db->get('top_management');
        return $query->result();
    }

    // #update service function
    public function updateTop($data = null) {
        $where = array('Top_ID' => $data['Top_ID']);
        $this->db->where($where);
        $query = $this->db->update('top_management', $data);
        return $query;
    }

    // #delete service function
    public function deleteTop($data = null) {
        $where = array('Top_ID' => $data['top_id']);
        $this->db->where($where);
        $query = $this->db->delete('top_management');
        return $query;
    }

    /* -----------------------------------------------------------
      ---------------------- Faq -----------------
      -------------------------------------------------------- */

    public function getFaqs() {
        return $this->db
                        ->select('q.*')
                        ->from(TBL_QUESTIONS . ' as q')
                        //->join(TBL_USERS.' as a', 'a.User_ID = q.User_ID')
                        ->order_by('q.Order_In_List', 'asc')
                        ->get()
                        ->result();
    }

    public function addQuestion($data = array()) {
        return $this->db->insert(TBL_QUESTIONS, $data);
    }

    public function getQuestionByID($id = 0) {
        return $this->db
                        ->where('Q_ID', $id)
                        ->get(TBL_QUESTIONS)
                        ->result();
    }

    public function updateQuestion($data = array()) {
        return $this->db
                        ->where('Q_ID', $data['Q_ID'])
                        ->update(TBL_QUESTIONS, $data);
    }

    public function deleteQuestion($id = 0) {
        return $this->db
                        ->where('Q_ID', $id)
                        ->delete(TBL_QUESTIONS);
    }

    /* -----------------------------------------------------------
      ---------------------- SHOWREEL Section -----------------
      -------------------------------------------------------- */

    public function getShowreel() {
        $query = $this->db
                ->select("sh.*, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr")
                ->from(TBL_WEBSITE_SHOWREEL . " as sh")
                ->join(TBL_SECTIONS . " as s", "s.Section_ID = sh.Section_ID")
                ->get();
        return $query->result();
    }

    public function updateShowreel($data = array()) {
        return $this->db->update(TBL_WEBSITE_SHOWREEL, $data);
    }

    /* -----------------------------------------------------------
      ---------------------- WEBSITE SETTINGS -----------------
      -------------------------------------------------------- */

    // #settings
    public function getSettings() {
        $query = $this->db->get(TBL_WEBSITE_SETTINGS);
        return $query->result();
    }

    public function getContacts() {
        $query = $this->db
                ->select("c.*, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr")
                ->from(TBL_WEBSITE_CONTACTS . " as c")
                ->join(TBL_SECTIONS . " as s", "s.Section_ID = c.Section_ID")
                ->get();
        return $query->result();
    }

    public function getMarkers() {
        $this->db->select('lat, lng, Address');
        $query = $this->db->get(TBL_WEBSITE_MAPLOCATIONS);
        return $query->result();
    }

    public function updateSettings($data = array()) {
        $where = array("ID" => 1);
        $this->db->where($where);
        $query = $this->db->update(TBL_WEBSITE_SETTINGS, $data);
        return $query;
    }

    public function updateContactus($data = array()) {
        $where = array("ID" => 1);
        $this->db->where($where);
        $query = $this->db->update(TBL_WEBSITE_CONTACTS, $data);
        return $query;
    }

    public function saveLocation($data = array()) {
        $query = $this->db->insert(TBL_WEBSITE_MAPLOCATIONS, $data);
        return $query;
    }

    public function deleteLocation($data = array()) {
        $query = $this->db
                ->where('lat', $data['lat'])
                ->where('lng', $data['lng'])
                ->delete(TBL_WEBSITE_MAPLOCATIONS);
        return $query;
    }

    /* -----------------------------------------------------------
      ---------------------- Background Slider function -----------------
      -------------------------------------------------------- */

    public function getSlides() {
        return $this->db->order_by('Order_In_List', 'asc')->get(TBL_WEBSITE_SLIDER)->result();
    }

    public function addSlide($data = array()) {
        $query = $this->db->insert(TBL_WEBSITE_SLIDER, $data);
        return $query;
    }

    public function getSlideByID($data = '') {
        $this->db->where(array('Slide_ID' => $data['slide_id']));
        return $this->db->get(TBL_WEBSITE_SLIDER)->result();
    }

    public function deleteSlide($data = array()) {
        $this->db->where('Slide_ID', $data['Slide_ID']);
        return $this->db->delete(TBL_WEBSITE_SLIDER);
    }

    public function updateSlide($data = array()) {
        $this->db->where(array('Slide_ID' => $data['Slide_ID']));
        $query = $this->db->update(TBL_WEBSITE_SLIDER, $data);
        return $query;
    }

    public function getSlideImages($data = array()) {
        $where = array(
            'Slide_ID' => $data['Slide_ID']
        );
        return $this->db->select('Slide_Image, Slide_Image_Phone')->from(TBL_WEBSITE_SLIDER)->where($where)->get()->result();
    }

    /* -----------------------------------------------------------
      ---------------------- users management -----------------
      -------------------------------------------------------- */

    public function addCustomerExperiences($customer_experiences = array()) {

        $preferences_info = $this->db->where("Customer_ID", $customer_experiences['Customer_ID'])->get('customer_experiences')->row();

        if (count($preferences_info) > 0) {
            //update

            $where = array('Customer_ID' => $customer_experiences['Customer_ID']);
            $this->db->where($where);
            $query = $this->db->update('customer_experiences', $customer_experiences);
        } else {
            //insert
            $query = $this->db->insert('customer_experiences', $customer_experiences);
        }

        return $query;
    }

    public function addUser($data = array()) {
        $query = $this->db->insert(TBL_USERS, $data);
        return $query;
    }

    public function getAllUsers() {
        return $this->getAllUsers_ADM();
        //return $this->db->query("SELECT * FROM ".TBL_USERS." as u JOIN ".TBL_USER_ROLES." as r ON r.Role_ID = u.Role_ID WHERE r.Role = 'user'")->result();
    }

    // for super admin
    public function getAllUsers_ADM() {
        //return  $this->db->query("SELECT * FROM ".TBL_USERS." as u JOIN ".TBL_USER_ROLES." as r ON r.Role_ID = u.Role_ID WHERE Role = 'admin' OR Role = 'user'")->result();

        return $this->db->select('*')
                        ->from('users as u')
                        ->join('users_roles as r', 'r.Role_ID=u.Role_ID', "LEFT")
                        ->where('r.Role_ID!=', 1)
                        ->get()->result();
    }

    public function deleteUser($data = array()) {
        $this->db->where('User_ID', $data['User_ID']);
        return $this->db->delete(TBL_USERS);
    }

    public function getRoles() {
        return $this->db->where("Type", 'admin')->get('users_roles')->result();
    }

    /* -----------------------------------------------------------
      ---------------------- #SMS -----------------
      -------------------------------------------------------- */

    public function getPhonesByGroupID($group_id = 0) {

        return $this->db->select('Phone')
                        ->from('tbl_markting_groups_phones')
                        ->where('MG_ID', $group_id)
                        ->get()->result_array();
    }

    public function sendSMS($data = array()) {
        return $this->db->insert(TBL_LOGS_SMS, $data);
    }

    public function getMarketingGroups() {
        return $this->db->get('tbl_markting_groups')->result();
    }

    public function insertMarketingGroups($group = array()) {
        $this->db->insert('tbl_markting_groups', $group);
        return $this->db->insert_id();
    }

    public function phoneExists($phone) {
        $this->db->where('Phone', $phone);
        $query = $this->db->get('tbl_markting_groups_phones');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertMarketingGroupsPhones($group = array()) {
        $this->db->insert('tbl_markting_groups_phones', $group);
        return $this->db->insert_id();
    }

    public function getMobileNumbers($string) {
        $customer_nos = $this->db->select('Phone')->like('Phone', $string, 'both')->get(TBL_CUSTOMERS)->result();
        $rest_nos = $this->db->select('Phone')->like('Phone', $string, 'both')->get(TBL_RESTURANTS)->result();

        $numbers = (object) array_merge((array) $customer_nos, (array) $rest_nos);
        return $numbers;
    }

    public function getCustomerNumbers() {
        return $this->db
                        ->select('Phone')
                        ->from(TBL_CUSTOMERS)
                        ->get()
                        ->result();
    }

    public function getRestaurantsNumbers() {
        return $this->db
                        ->select('Phone')
                        ->from(TBL_RESTURANTS)
                        ->get()
                        ->result();
    }

    /* -----------------------------------------------------------
      ---------------------- Careers -----------------
      -------------------------------------------------------- */

    // Get total
    public function getApplicantMale() {
        return $this->db->where('Gender', 'male')->get(TBL_CAREERS_APPLICATIONS)->num_rows();
    }

    public function getApplicantFemale() {
        return $this->db->where('Gender', 'female')->get(TBL_CAREERS_APPLICATIONS)->num_rows();
    }

    // ends
    public function addJob($data = array()) {
        $query = $this->db->insert(TBL_CAREERS, $data);
        return $query;
    }

    public function getJobs() {
        $query = $this->db
                ->select('c.*, COUNT(a.Career_ID) AS totalApplicants, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr')
                ->from(TBL_CAREERS . ' as c')
                ->join(TBL_SECTIONS . ' as s', 's.Section_ID = c.Section_ID')
                ->join(TBL_CAREERS_APPLICATIONS . ' as a', 'a.Career_ID = c.Career_ID', 'LEFT')
                ->group_by('c.Career_ID')
                ->get();

        return $query->result();
    }

    public function getActiveJobs() {
        $query = $this->db
                ->select('c.*, COUNT(a.Career_ID) AS totalApplicants, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr')
                ->from(TBL_CAREERS . ' as c')
                ->join(TBL_SECTIONS . ' as s', 's.Section_ID = c.Section_ID')
                ->join(TBL_CAREERS_APPLICATIONS . ' as a', 'a.Career_ID = c.Career_ID', 'LEFT')
                ->where('c.Status', 1)
                ->group_by('c.Career_ID')
                ->get();

        return $query->result();
    }

    //for excel
    public function getAllJobApplications_Excel($id = 0) {
        $this->db
                ->select('a.*, c.Title_ar, c.Title_en, ct.name_ar, ct.name_en, n.Nationality_ar, n.Nationality_en')
                ->from(TBL_CAREERS_APPLICATIONS . ' as a')
                ->join(TBL_CAREERS . ' as c', 'c.Career_ID = a.Career_ID')
                ->join('sa_cities as ct', 'ct.id = a.City_ID')
                ->join(TBL_NATS . ' as n', 'n.Nationality_ID = a.Nationality_ID')
                ->order_by("Application_ID", "DESC");
        if ($id) {
            $this->db->where("c.Career_ID", $id);
        }

        return $this->db->get()->result();
    }

    //for Csv
    public function getAllJobApplications_Csv($id = 0) {
        $this->db
                ->select('a.Application_ID, a.DateApplied, c.Title_ar, a.Fullname, a.Email, a.Number, a.Birthdate, a.Gender, ct.name_ar, ct.name_en, n.Nationality_ar, n.Nationality_en')
                ->from(TBL_CAREERS_APPLICATIONS . ' as a')
                ->join(TBL_CAREERS . ' as c', 'c.Career_ID = a.Career_ID')
                ->join('sa_cities as ct', 'ct.id = a.City_ID')
                ->join(TBL_NATS . ' as n', 'n.Nationality_ID = a.Nationality_ID')
                ->order_by("Application_ID", "DESC");

        if ($id) {
            $this->db->where("c.Career_ID", $id);
        }

        return $this->db->get();
    }

    public function getFullApplicationData($id = 0) {
        return $this->db
                        ->select('a.*,c.*, ct.name_en, ct.name_ar, n.Nationality_en, n.Nationality_ar')
                        ->from(TBL_CAREERS_APPLICATIONS . ' as a')
                        ->join(TBL_CAREERS . ' as c', 'c.Career_ID = a.Career_ID')
                        ->join('sa_cities as ct', 'ct.id = a.City_ID')
                        ->join(TBL_NATS . ' as n', 'n.Nationality_ID = a.Nationality_ID')
                        ->where('Application_ID', $id)
                        ->get()
                        ->result();
    }

    public function getTotalArchived() {
        $query = $this->db
                ->select('c.*')
                ->from(TBL_CAREERS . ' as c')
                ->join(TBL_CAREERS_APPLICATIONS . ' as a', 'a.Career_ID = c.Career_ID', 'LEFT')
                ->where('a.Archived', 1)
                ->get();

        return $query->result();
    }

    public function getTotalApp() {
        $query = $this->db
                ->select('c.*')
                ->from(TBL_CAREERS . ' as c')
                ->join(TBL_CAREERS_APPLICATIONS . ' as a', 'a.Career_ID = c.Career_ID', 'LEFT')
                ->where('a.Archived', 0)
                ->get();

        return $query->result();
    }

    public function getNationalities() {
        $query = $this->db->get(TBL_NATS);
        return $query->result();
    }

    public function getCities() {
        $query = $this->db->get('sa_cities');
        return $query->result();
    }

    public function getJobByID($data = array()) {
        $this->db->where($data);
        $query = $this->db->get(TBL_CAREERS);
        return $query->result();
    }

    public function updateJob($data = array()) {
        $where = array('Career_ID' => $data['Career_ID']);
        $this->db->where($where);
        $query = $this->db->update(TBL_CAREERS, $data);
        return $query;
    }

    public function deleteJob($data = array()) {
        $this->db->where('Career_ID', $data['Career_ID']);
        $query = $this->db->delete(TBL_CAREERS, $data);
        return $query;
    }

    public function getApplications() {
        $query = $this->db
                ->select('a.*, c.Title_ar, a.Fullname, a.Email, a.Number, a.Birthdate, a.Gender, ct.name_ar, ct.name_en, n.Nationality_ar, n.Nationality_en')
                ->from(TBL_CAREERS_APPLICATIONS . ' as a')
                ->join(TBL_CAREERS . ' as c', 'c.Career_ID = a.Career_ID')
                ->join('sa_cities as ct', 'ct.id = a.City_ID')
                ->join(TBL_NATS . ' as n', 'n.Nationality_ID = a.Nationality_ID')
                ->where('a.Archived', 0)
                ->get();

        return $query->result();
    }

    public function getApplicationsByJobID($data = array()) {

        $id = $data['Career_ID'];
        if ($id) {
            $this->db->where(array('c.Career_ID' => $id));
        }

        $query = $this->db
                ->select('a.*, c.Title_ar, a.Fullname, a.Email, a.Number, a.Birthdate, a.Gender, ct.name_ar, ct.name_en, n.Nationality_ar, n.Nationality_en')
                ->from(TBL_CAREERS_APPLICATIONS . ' as a')
                ->join(TBL_CAREERS . ' as c', 'c.Career_ID = a.Career_ID')
                ->join('sa_cities as ct', 'ct.id = a.City_ID')
                ->join(TBL_NATS . ' as n', 'n.Nationality_ID = a.Nationality_ID')
                ->where('a.Archived', 0)
                ->get();

        return $query->result();
    }

    public function deleteApplication($data = array()) {
        $this->db->where('Application_ID', $data['Application_ID']);
        $query = $this->db->delete(TBL_CAREERS_APPLICATIONS, $data);
        return $query;
    }

    public function getArchivedApplications($id = 0) {

        return $this->db
                        ->select('a.*, n.*, ct.*, c.Title_en, c.Title_ar')
                        ->from(TBL_CAREERS_APPLICATIONS . ' as a')
                        ->join(TBL_CAREERS . ' as c', 'c.Career_ID = a.Career_ID')
                        ->join('sa_cities as ct', 'ct.id = a.City_ID')
                        ->join(TBL_NATS . ' as n', 'n.Nationality_ID = a.Nationality_ID')
                        //->where('Application_ID', $id)
                        ->get()
                        ->result();
    }

    public function filterApplications($data = array()) {
        return $this->searchAllApplications($data, 0);
    }

    public function filterArchivedApplications($data = array()) {
        return $this->searchAllApplications($data, 1);
    }

    public function searchAllApplications($data = array(), $archive = 0) {
        $name = $data['name'];
        $gender = $data['gender'];
        $nat = $data['nationality'];
        $city = $data['city'];
        $email = $data['email'];
        $mno = $data['no'];
        $job = $data['job'];
        $man_col = '';
        $nat_col = '';
        $gen = '';
        $city_col = '';
        $email_col = '';
        $no_col = '';
        $j_col = '';
        // making query from filter
        if (strlen($city) > 1) {
            $city_col = "AND ja.`City` = '$city'";
        }

        if (strlen($email) > 1) {
            $email_col = "AND ja.`Email` = '$email'";
        }

        if (strlen($mno) > 1) {
            $no_col = "AND ja.`Number` = '$mno'";
        }

        if ($job != '0' && $job != 'all') {
            $j_col = "AND ja.`Career_ID` = '$job'";
        }

        if ($job == 'all') {
            $j_col = "AND ja.`Career_ID` > 0";
        }

        if ($nat != '0') {
            $nat_col = "AND ja.`Nationality` = '$nat'";
        }
        if ($gender != '0') {
            $gen = "AND ja.`Gender` = '$gender'";
        }
        if (strlen($name) > 1) {
            $man_col = "ja.`Fullname` = '$name' AND ja.`Archived` = $archive";
        } else {
            $man_col = "ja.`Archived` = $archive";
        }

        $query = "SELECT DISTINCT ja.*, j.Title_en, j.Title_ar FROM `" . TBL_CAREERS_APPLICATIONS . "` as ja JOIN `" . TBL_CAREERS . "` as j ON j.Career_ID = ja.Career_ID WHERE $man_col $nat_col $city_col $email_col $no_col $j_col $gen";
        //echo $query;
        return $this->db->query($query)->result();
    }

    public function archiveApplication($data = array()) {
        $this->db->where('Application_ID', $data['Application_ID']);
        $query = $this->db->update(TBL_CAREERS_APPLICATIONS, $data);
        if ($query) {
            return json_encode(array('result' => 1));
        }

        return json_encode(array('result' => 0));
    }

    public function changeApplicationFlagState($data = array()) {
        $this->db->where('Application_ID', $data['Application_ID']);
        $query = $this->db->update(TBL_CAREERS_APPLICATIONS, $data);
        if ($query) {
            return json_encode(array('result' => 1));
        }

        return json_encode(array('result' => 0));
    }

    /* -----------------------------------------------------------
      ---------------------- Change Status function -----------------
      -------------------------------------------------------- */

    public function ChangeStatus($data = array()) {
        header('Content-Type: application/json');
        $column = '';
        $cl_name = 'Status';
        $tbl = $data['tb_loc'];
        $status = $data['status'];
        $id = $data['id'];

        $trigger_Arr = array(
            'services' => array('Service_ID', TBL_SERVICES),
            'managementTop' => array('Top_ID', 'top_management'),
            'slide' => array('Slide_ID', TBL_WEBSITE_SLIDER),
            'slide_slide' => array('Slide_ID', TBL_WEBSITE_SLIDER),
            'faq' => array('Q_ID', TBL_QUESTIONS),
            'solution' => array('ID', 'solutions'),
            'jobs' => array('Career_ID', TBL_CAREERS),
            'caption' => array('Slide_ID', TBL_WEBSITE_SLIDER),
            'products_rm' => array('Class_ID', TBL_CLASSES),
            'customers' => array('Customer_ID', TBL_CUSTOMERS),
            'product_categories' => array('Category_ID', TBL_CLASS_CATEGORIES),
            'product_subcategories' => array('SubCategory_ID', TBL_CLASS_SUBCATEGORIES),
            'albums_categories' => array('Category_ID', TBL_ALBUMS_CATEGORIES),
            'albums' => array('Albums_ID', TBL_ALBUMS),
            'products' => array('Product_ID', TBL_PRODUCTS),
            'portfolio_categories' => array('Category_ID', TBL_PORTFOLIO_CATEGORIES),
            'portfolio' => array('Portfolio_ID', TBL_PORTFOLIO),
            'portoflio' => array('Portfolio_ID', TBL_PORTFOLIO),
            'portfolio_details' => array('AD_ID', TBL_PORTFOLIO_DETAILS),
            'project_categories' => array('Category_ID', TBL_PROJECTS_CATEGORIES),
            'projects' => array('Project_ID', TBL_PROJECTS),
            'clients' => array('Client_ID', TBL_CLIENTS),
            'subscription' => array('Subscription_ID', TBL_SUBSCRIPTIONS),
            'plan' => array('TLD_ID', TLD),
            'news' => array('News_ID', TBL_NEWS),
            'news_categories' => array('Category_ID', TBL_NEWS_CATEGORIES),
            'events' => array('Event_ID', TBL_EVENTS),
            'events_categories' => array('Category_ID', TBL_EVENTS_CATEGORIES),
            'events_subcategories' => array('SubCategory_ID', TBL_EVENTS_SUBCATEGORIES),
            'branches' => array('Branch_ID', 'branches'),
            'promos' => array('ID', 'promo_codes'),
            'website_features' => array('FID', 'website_features'),
            'pages' => array('Id', 'pages'),
            'classes' => array('Class_ID', 'classes'),
            'product_discount' => array('PD_ID', 'product_discount'),
            'installation_price' => array('installation_price_id', 'installation_price'),
            'testimonials' => array('ID', 'testimonials'),
        );

        $trig_column = $trigger_Arr[$tbl][0]; // will get table column name
        $target_tbl = $trigger_Arr[$tbl][1]; // will get table name
        if ($tbl == 'caption') {
            $cl_name = 'Caption_Status';
        }
        $query = $this->db->query("UPDATE `$target_tbl` SET `$cl_name` = $status WHERE `$trig_column` = $id");
        if ($query) {
            return json_encode(array('result' => 1));
        } else {
            return json_encode(array('result' => $query));
        }
    }

    /* -----------------------------------------------------------
      ---------------------- Change Order function -----------------
      -------------------------------------------------------- */

    public function ChangeOrder($postkey = '') {
        /*
         * e.g $postkey = services
          - get data using that key using $_POST[$postkey]
          - we will get data as an object e.g: {1: 1, 4: 2, 2: 3, 3: 4}
          - in this object the key act as row id, and value is the order of the column.
         */
        header('Content-Type: application/json');
        $column = '';
        $cl_name = 'Order_In_List';
        $tbl = $postkey;
        $order = json_decode(($this->input->post($postkey)));

        $trigger_Arr = array(
            'services' => array('Service_ID', TBL_SERVICES),
            'managementTop' => array('Top_ID', 'top_management'),
            'slides' => array('Slide_ID', TBL_WEBSITE_SLIDER),
            'faq' => array('Q_ID', TBL_QUESTIONS),
            'products_rm' => array('Class_ID', TBL_CLASSES),
            'product_categories' => array('Category_ID', TBL_CLASS_CATEGORIES),
            'product_subcategories' => array('SubCategory_ID', TBL_CLASS_SUBCATEGORIES),
            'albums_categories' => array('Category_ID', TBL_ALBUMS_CATEGORIES),
            'albums' => array('Albums_ID', TBL_ALBUMS),
            'portfolio_categories' => array('Category_ID', TBL_PORTFOLIO_CATEGORIES),
            'portfolio' => array('Porfolio_ID', TBL_PORTFOLIO),
            'portoflio' => array('Porfolio_ID', TBL_PORTFOLIO),
            'portfolio_details' => array('AD_ID', TBL_PORTFOLIO_DETAILS),
            'project_categories' => array('Category_ID', TBL_PROJECTS_CATEGORIES),
            'projects' => array('Project_ID', TBL_PROJECTS),
            'clients' => array('Client_ID', TBL_CLIENTS),
            'subscription' => array('Subscription_ID', TBL_SUBSCRIPTIONS),
            'plan' => array('Plan_ID', TBL_SUBSCRIPTION_PLANS),
            'news' => array('News_ID', TBL_NEWS),
            'news_categories' => array('Category_ID', TBL_NEWS_CATEGORIES),
            'events' => array('Event_ID', TBL_EVENTS),
            'events_categories' => array('Category_ID', TBL_EVENTS_CATEGORIES),
            'events_subcategories' => array('SubCategory_ID', TBL_EVENTS_SUBCATEGORIES),
            'events_pics' => array('PD_ID', TBL_EVENTS_PICS),
            'events_slider' => array('ESlider_ID', TBL_EVENTS_SLIDER),
            'promos' => array('ID', 'promo_codes'),
            'website_features' => array('FID', 'website_features'),
            'pages' => array('Id', 'pages')
        );

        $trig_column = $trigger_Arr[$tbl][0]; // will get table column name
        $target_tbl = $trigger_Arr[$tbl][1]; // will get table name

        $arr = array();
        foreach ($order as $key => $value) {
            $query = $this->db->query("UPDATE `$target_tbl` SET `Order_In_List` = $value WHERE `$trig_column` = $key");
            $arr = array("result" => "Rearranged!");
        }
        return json_encode($arr);
    }

    public function getAdvancedSettings() {
        return $this->db->from('advanced_settings')->get()->result();
    }

    public function deleteAdvancedSettings($data = array()) {
        $this->db->where('Application_ID', $data['Application_ID']);
        $query = $this->db->delete(TBL_CAREERS_APPLICATIONS, $data);
        return $query;
    }

}

?>
