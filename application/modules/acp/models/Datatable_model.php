<?PHP

class Datatable_model extends CI_Model {

    private function _get_customer_phistory() {

        $where_name = '';
        $where_email = '';
        $where_credits = '';
        $where_customerid = '';

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
        
        return $this->db->select('*')
                        ->from(TBL_ORDERS . ' as ord')
                        ->join(TBL_PRODUCT_SUBSCRIPTIONS . ' as s', 's.Subscription_ID = ord.Subscription_ID')
                        ->join(TBL_CUSTOMERS . ' as c', 'c.Customer_ID = s.Customer_ID')
                        ->join(TBL_PRODUCTS . ' as p', 'p.Product_ID = s.Product_ID')
                        ->order_by('ord.TimeStamp', 'desc');
//			         ->where($where)
//                                 ->get()->result();


        if (isset($_POST['order'])) {
            $ind = $_POST['order'][0]['column'];
            $oColumn = $this->phitory_order[$ind];
            $direction = $_POST['order'][0]['dir'];
            $where_order = "$oColumn $direction";
            $this->db->order_by($where_order);
        } else {
            $this->db->order_by("ord.Timestamp", "DESC");
        }
    }

    var $order_columns_3 = array('p.Diet_Plans_ID', 'p.Plan_Name_ar', 'p.Plan_Name_en');

    private function _get_templats_query() {

        $where_title = '';
        $where_subcategory = '';

        if (!empty($_POST['title'])) {
            $title = $_POST['title'];
            $where_title = "(Plan_Name_ar LIKE '%$title%') AND";
        }


        $where = "{$where_title} Status >= 0";

        $this->db->distinct();
        $this->db->from('diet_plans AS p');
        $this->db->where($where);
        $this->db->group_by('Diet_Plans_ID');


        /*          if(isset($_POST['order'])){
          $ind = $_POST['order'][0]['column'];
          $oColumn = $this->order_columns_1[$ind];
          $direction = $_POST['order'][0]['dir'];
          $where_order = "$oColumn $direction";
          $this->db->order_by($where_order);
          } else {
          $this->db->order_by("Template_ID", "DESC");
          } */
    }

    public function templatsCount_all() {
        $this->db->from("dit_plan_template AS c");

        return $this->db->count_all_results();
    }

    function getTemplatesList() {
        $this->_get_templats_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    /**
     * ------- Items List *---------
     * */
    var $order_columns_1 = array('i.Item_ID', 'i.TimeStamp', '', 'i.Title_en', 'i.Status');

    private function _get_items_query() {

        $where_title = '';
        $where_weeks = '';
        $where_days = '';


        if (!empty($_POST['title'])) {
            $title = $_POST['title'];
            $where_title = "(i.Title_en LIKE '%$title%' OR i.Title_ar LIKE '%$title%') AND";
        }

        if ($_POST['weeks'] != '') {
            $weeks = $_POST['weeks'];
            $where_weeks = "(FIND_IN_SET(" . $weeks . ",i.available_weeks) > 0) AND";
        }

        if ($_POST['days'] != '') {
            $days = $_POST['days'];
            $where_days = "(FIND_IN_SET(" . $days . ",i.week_days) > 0) AND";
        }


        $where = "{$where_weeks} {$where_title} {$where_days} i.Status >= 0 AND Is_Deleted = 0";

        //echo $where; exit();

        $this->db->distinct();
        $this->db->select('i.*');
        $this->db->from(TBL_ITEMS . ' AS i');
        //$this->db->join(TBL_ITEM_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = i.SubCategory_ID');
        $this->db->where($where);
        $this->db->group_by('i.Item_ID');

        //print_r($_POST['order']);
        if (isset($_POST['order'])) {
            $ind = $_POST['order'][0]['column'];
            $oColumn = $this->order_columns_1[$ind];
            $direction = $_POST['order'][0]['dir'];
            $where_order = "$oColumn $direction";
            $this->db->order_by($where_order);
        } else {
            $this->db->order_by("i.Item_ID", "DESC");
        }
    }

    function getItemsList() {
        $this->_get_items_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        //echo $this->db->last_query();
        return $query->result();
    }

    function productsCount_filtered() {
        $this->_get_items_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function itemsCount_all() {
        $this->db->from(TBL_ITEMS . ' as i');

        return $this->db->count_all_results();
    }

    function phistoryCount_all() {
        $this->_get_customer_phistory();
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }

    /**
     * ------- Logs List *---------
     * */
    private function _get_logs_query() {
        $this->db->select('l.*, u.Fullname, u.Username')
                ->from(TBL_LOGS_OPERATIONS . ' as l')
                ->join(TBL_USERS . ' as u', 'u.User_ID = l.User_ID')
                ->order_by('TimeStamp', 'desc');

        /*
          $this->db->get();
          echo $this->db->last_query();
         */
    }

    public function getWebsiteLogs() {
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $this->_get_logs_query();
        $user_data = $this->db->get()->result();
        return $user_data;
    }

    function logsCount_all() {
        $this->_get_logs_query();
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }

    public function logsCount_filtered() {
        $this->_get_logs_query();
        return $this->db->get()->num_rows();
    }

    /**
     * ------- Customers List *---------
     * */
    public function getCustomerSubscription($customer_id = 0) {
        return $this->db
                        ->select('p.Plan_ID,p.Plan_Name')
                        ->from('customer_subscriptions as cs')
                        ->join('subscription_plans as p', 'p.Plan_ID = cs.Plan_ID')
                        ->where('cs.Customer_ID', $customer_id)
                        ->get()
                        ->row();
    }

    var $order_columns_2 = array('c.Customer_ID', 'c.TimeStamp', 'c.Fullname', 'c.Email', 'c.Phone', 'c.Status');

    private function _get_customers_query() {
        $where_phone = '';
        $where_name = '';
        $where_email = '';
        $where_customer_id = '';
        $pJoin = 'LEFT';
        $where_members = 'c.Guest = 0';
        $planName = '';
        $orderTimeStamp = "c.TimeStamp";

        $this->order_columns_2[1] = $orderTimeStamp;

        if (!empty($_POST['phone'])) {
            $phone = $_POST['phone'];
            $str = $phone; // eg: 01223334434
            $value = $str . "<br>";
            $value = ltrim($str, "0"); // eg: remove first 0 from 1223334434
            //echo '<pre>';print_r($value);die();
            $where_phone = "c.Phone LIKE '%$value%' AND";
        }

        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $where_email = "c.Email LIKE '%$email%' AND";
        }

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $where_name = "c.Fullname LIKE '%$name%' AND";
        }

        if (!empty($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];
            $where_customer_id = "c.Random_ID LIKE '%$customer_id%' AND";
            //dd($where_customer_id);
        }

       


        if (!empty($_POST['customer_type'])) {
            $customer_type = $_POST['customer_type'];
            $where_customer_type = "c.Customer_Type LIKE '$customer_type' AND";
        }



        if ($_POST['show_members'] != 0) {
            $where_members = 'c.Guest = 1';
        }


        $this->db->distinct();
        $this->db->select('c.*');
        $this->db->from(TBL_CUSTOMERS . ' AS c');


        $where = "{$where_name} {$where_email} {$where_phone} {$where_customer_type} {$where_customer_id} {$where_members}";
        $this->db->where($where);
        $this->db->group_by('c.Customer_ID');

        //print_r($_POST['order']);
        if (isset($_POST['order'])) {
            $ind = $_POST['order'][0]['column'];
            $oColumn = $this->order_columns_2[$ind];
            $direction = $_POST['order'][0]['dir'];
            $where_order = "$oColumn $direction";
            $this->db->order_by($where_order);
        } else {
            $this->db->order_by("c.Customer_ID", "dese");
        }
    }

    function getCustomersList() {
        $this->_get_customers_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        //echo $this->db->last_query();
        return $query->result();
    }

    function customersCount_filtered() {
        $this->_get_customers_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function customersCount_all() {
        $this->db->from(TBL_CUSTOMERS . " AS c");

        return $this->db->count_all_results();
    }
    // end of customer

    
    var $csub_order = array("sh.SCH_ID", "sh.Starts_At", "sh.Expires_At");

    private function _get_csubscriptionlogs_query() {
        $where_customer = "";
        $where_payment = " sh.Payment_Verified = 1";
        $where_planname = "";
        $where_promocode = "";

        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $customer = $_POST['id'];
            $where_customer = " sh.Customer_ID = {$customer} AND ";
            $where_payment = " sh.Payment_Verified IS NOT NULL ";
        }

        if (!empty($_POST['planname'])) {
            $planname = $_POST['planname'];
            $where_planname = " p.Plan_Name_en LIKE '%{$planname}%' AND";
        }

        // if(!empty($_POST['promocode'])){
        //     $promocode = $_POST['promocode'];
        //     $where_promocode = " p.Code = '{$promocode}' AND";
        // }

        $this->db->where("{$where_customer} {$where_planname} {$where_payment}");

        $this->db->select('sh.*, p.*, c.Fullname')
                ->from(TBL_CUSTOMER_SUBSCRIPTION_HISTORY . ' as sh')
                //->join('promo_codes as promo', 'promo.Code = sh.PromoCode', 'LEFT')
                ->join(TBL_SUBSCRIPTION_PLANS . ' as p', 'p.Plan_ID = sh.Plan_ID')
                ->join(TBL_CUSTOMERS . ' as c', 'c.Customer_ID = sh.Customer_ID')
                ->order_by('sh.created_at', 'desc');
        //->where($where);

        if (isset($_POST['order'])) {
            $ind = $_POST['order'][0]['column'];
            $oColumn = $this->csub_order[$ind];
            $direction = $_POST['order'][0]['dir'];
            $where_order = "$oColumn $direction";
            $this->db->order_by($where_order);
        } else {
            $this->db->order_by("sh.created_at", "DESC");
        }
    }

    public function getCustomerSubscriptionsLogs() {
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $this->_get_csubscriptionlogs_query();
        $user_data = $this->db->get()->result();
        return $user_data;
    }

    function subscriptionlogsCount_all() {
        $this->_get_subscriptionlogs_query();
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }

    var $sub_order = array("sh.SCH_ID", "sh.created_at", "p.Plan_Name_ar", "sh.Payment_Source", "");

    private function _get_subscriptionlogs_query() {
        $where_customer = "";
        $where_payment = " sh.Payment_Verified = 1";
        $where_planname = "";
        $where_promocode = "";

        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $customer = $_POST['id'];
            $where_customer = " sh.Customer_ID = {$customer} AND ";
            $where_payment = " sh.Payment_Verified IS NOT NULL ";
        }

        if (!empty($_POST['planname'])) {
            $planname = $_POST['planname'];
            $where_planname = " p.Plan_Name_ar LIKE '%{$planname}%' AND";
        }

        if (!empty($_POST['promocode'])) {
            $promocode = $_POST['promocode'];
            $where_promocode = " p.Code = '{$promocode}' AND";
        }

        $this->db->where("{$where_customer} {$where_planname} {$where_payment}");

        $this->db->select('sh.*, p.*, c.*')
                ->from(TBL_CUSTOMER_SUBSCRIPTION_HISTORY . ' as sh')
                //->join('promo_codes as promo', 'promo.Code = sh.PromoCode', 'LEFT')
                ->join(TBL_SUBSCRIPTION_PLANS . ' as p', 'p.Plan_ID = sh.Plan_ID')
                ->join(TBL_CUSTOMERS . ' as c', 'c.Customer_ID = sh.Customer_ID')
                //->join('customer_diet_plan as cdp', 'cdp.Customer_ID = c.Customer_ID', 'LEFT')
                //->join('diet_plans as dp', 'dp.Diet_ID = cdp.Diet_ID', 'LEFT')
                ->order_by('sh.TimeStamp', 'desc')
                ->group_by('sh.CS_ID');
        //->where($where);

        if (isset($_POST['order'])) {
            $ind = $_POST['order'][0]['column'];
            $oColumn = $this->sub_order[$ind];
            $direction = $_POST['order'][0]['dir'];
            $where_order = "$oColumn $direction";
            $this->db->order_by($where_order);
        } else {
            $this->db->order_by("sh.created_at", "DESC");
        }
    }

    /**
     * ------- SMS Logs List *---------
     * */
    private function _get_sms_query() {
        $this->db->select('s.*, u.Fullname, u.Username')
                ->from(TBL_LOGS_SMS . ' as s')
                ->join(TBL_USERS . ' as u', 'u.User_ID = s.User_ID')
                ->order_by('TimeStamp', 'desc');

        /*
          $this->db->get();
          echo $this->db->last_query();
         */
    }

    private function _get_contacts_query() {
        $this->db->select('*')
                ->from(TBL_CUSTOMERS)
                ->order_by('TimeStamp', 'desc');

        /*
          $this->db->get();
          echo $this->db->last_query();
         */
    }

    private function _get_cron_admin_member_emails_query() {
        $this->db->select('*')
                ->from(TBL_CRON_MEMBEREMAILS)
                ->order_by('TimeStamp', 'desc');

        /*
          $this->db->get();
          echo $this->db->last_query();
         */
    }

    private function _get_emails_query() {
        $this->db->select('*')
                ->from(TBL_SUBSCRIBERS)
                ->order_by('TimeStamp', 'desc');
    }

    public function getSMSLogs() {
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $this->_get_sms_query();
        $user_data = $this->db->get()->result();
        return $user_data;
    }

    public function getEmailLogs() {
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $this->_get_cron_admin_member_emails_query();
        $user_data = $this->db->get()->result();
        return $user_data;
    }

    function smsCount_all() {
        $this->_get_sms_query();
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }

    public function smsCount_filtered() {
        $this->_get_sms_query();
        return $this->db->get()->num_rows();
    }

    function contactsCount_all() {
        $this->_get_contacts_query();
        return $this->db->get()->num_rows();
    }

    public function contactsCount_filtered() {
        $this->_get_contacts_query();
        return $this->db->get()->num_rows();
    }

    function emailCount_all() {
        $this->_get_cron_admin_member_emails_query();
        return $this->db->get()->num_rows();
    }

    public function emailCount_filtered() {
        $this->_get_cron_admin_member_emails_query();
        return $this->db->get()->num_rows();
    }

    function emailsCount_all() {
        $this->_get_emails_query();
        return $this->db->get()->num_rows();
    }

    public function emailsCount_filtered() {
        $this->_get_emails_query();
        return $this->db->get()->num_rows();
    }

    /**
     * ------- Job applications List *---------
     * */
    var $column_order = array(null, 'DateApplied', 'Fullname', 'Email', 'Number', 'Title_ar', 'Gender', 'Nationality', 'City'); //set column field database for datatable orderable
    var $order_columns = array('a.Application_ID', 'a.DateApplied', 'a.Fullname', 'a.Email', 'a.Number', 'c.Titile_ar', 'a.Gender');

    private function _get_applications_query() {
        $where_name = '';
        $where_email = '';
        $where_number = '';
        $where_nationality = '';
        $where_city = '';
        $where_gender = '';
        $where_birthdate = '';
        $where_job = '';

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $where_name = "a.Fullname LIKE '%$name%' AND";
        }

        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $where_email = "a.Email LIKE '%$email%' AND";
        }

        if (!empty($_POST['number'])) {
            $number = $_POST['number'];
            $where_number = "a.Number LIKE '%$number%' AND";
        }

        if ($_POST['nationality'] != -1) {
            $nat = $_POST['nationality'];
            $where_nationality = "a.Nationality_ID = '$nat' AND";
        }

        if (!empty($_POST['birthdate'])) {
            $birthdate = $_POST['birthdate'];
            $where_birthdate = "a.Birthdate = '$birthdate' AND";
        }

        if ($_POST['city'] != -1) {
            $city = $_POST['city'];
            $where_city = "a.City_ID = '$city' AND";
        }

        if ($_POST['gender'] != -1) {
            $gender = $_POST['gender'];
            $where_gender = "a.Gender = '$gender' AND";
        }

        if ($_POST['job'] != -1) {
            $job = $_POST['job'];
            $where_job = "a.Career_ID = '$job' AND";
        }

        $where = "$where_name $where_email $where_number $where_nationality $where_city $where_gender $where_birthdate $where_job a.Archived = 0";

        $this->db->select('a.*, c.Title_ar, c.Title_en');
        $this->db->from(TBL_CAREERS_APPLICATIONS . ' as a');
        $this->db->join(TBL_CAREERS . ' as c', 'c.Career_ID = a.Career_ID');
        $this->db->join(TBL_NATS . ' as n', 'n.Nationality_ID = a.Nationality_ID');
        $this->db->join(TBL_CITIES . ' as ci', 'ci.City_ID = a.City_ID');
        $this->db->where($where);

        //print_r($_POST['order']);
        if (isset($_POST['order'])) {
            $ind = $_POST['order'][0]['column'];
            $oColumn = $this->order_columns[$ind];
            $direction = $_POST['order'][0]['dir'];
            $where_order = "$oColumn $direction";
            $this->db->order_by($where_order);
        } else {
            $this->db->order_by("a.ID", "DESC");
        }
    }

    function getApplicationsList() {
        $this->_get_applications_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        //echo $this->db->last_query();
        return $query->result();
    }

    function applicationsCount_filtered() {
        $this->_get_applications_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function applicationsCount_all() {
        $this->db->from(TBL_CAREERS_APPLICATIONS);
        return $this->db->count_all_results();
    }

    // *****************************************
    // to get domains by customer ID
    // *****************************************
    var $domain_columns_1 = array('oh.domain_ID', 'oh.TimeStamp', 'c.Fullname', 'c.Phone', 'oh.domain_Status', 'oh.domainTotal_Price', 'oh.PaymentType');

    private function _get_domains_by_customer_id_query($customer_id) {

        $where_domain_no = '';
        $where_mobile_no = '';
        $where_status = '';
        $where_name = '';
        $where_subcategory = '';
        $where_customer = $customer_id;
        $where_payment = '';


        if (!empty($_POST['domain_no'])) {
            $id = $_POST['domain_no'];
            $where_domain_no = "oh.domain_ID = $id AND";
        }


        if (!empty($_POST['customer_id'])) {
            $id = $_POST['customer_id'];
            $where_customer = "oh.Customer_ID = $customer_id AND";
        }

        if (!empty($_POST['mobile_no'])) {
            $phone = $_POST['mobile_no'];
            $where_mobile_no = "c.Phone = '$phone' AND";
        }

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $where_name = "c.Fullname LIKE '%$name%' AND";
        }


        $where = "$where_domain_no $where_customer $where_mobile_no $where_name $where_status $where_payment $where_subcategory d.Status = 1";

        $status = $_POST['status'];


        $this->db->select('*');
        $this->db->from(DOMAIN . ' as d');
        $this->db->join('customers as c', 'c.Customer_ID = d.Customer_ID', 'left');
        $this->db->where('c.Customer_ID', $customer_id);
        $this->db->where('d.Domain_Status', 'Done');
        $this->db->order_by('d.Customer_ID', 'desc');

        //print_r($_POST['domain']);
        if (isset($_POST['domain'])) {
            $ind = $_POST['domain'][0]['column'];
            $oColumn = $this->domain_columns_1[$ind];
            $direction = $_POST['domain'][0]['dir'];
            $where_domain = "$oColumn $direction";
            $this->db->order_by($where_domain);
        } else {
            $this->db->order_by("d.Customer_ID", "DESC");
        }
    }

    function getDomainsByCustomerID($customer_id) {
        $this->_get_domains_by_customer_id_query($customer_id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();


        //var_dump($query->result()); exit();
        //echo $this->db->last_query();
        return $query->result();
    }

    function domainsByCusIDCount_filtered($customer_id) {
        $this->_get_domains_by_customer_id_query($customer_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function domainsByCusIDCount_all($customer_id) {
        $this->db->from(DOMAIN . " AS d");

        return $this->db->count_all_results();
    }

    // *****************************************
    // to get orders by customer ID
    // *****************************************
    var $orders_columns_1 = array('oh.domain_ID', 'oh.TimeStamp', 'c.Fullname', 'c.Phone', 'oh.domain_Status', 'oh.domainTotal_Price', 'oh.PaymentType');

    private function _get_domains_query($customer_id) {

        $where_domain_no = '';
        $where_mobile_no = '';
        $where_status = '';
        $where_name = '';
        $where_subcategory = '';
        $where_customer = '';
        $where_payment = '';


        if (!empty($_POST['domain_no'])) {
            $id = $_POST['domain_no'];
            $where_domain_no = "oh.domain_ID = $id AND";
        }


        if (!empty($_POST['customer_id'])) {
            $id = $_POST['customer_id'];
            $where_customer = "oh.Customer_ID = $id AND";
        }

        if (!empty($_POST['mobile_no'])) {
            $phone = $_POST['mobile_no'];
            $str = $phone; // eg: 01223334434
            $value = $str . "<br>";
            $value = ltrim($str, "0"); // eg: remove first 0 from 1223334434
            //echo '<pre>';print_r($value);die();
            $where_mobile_no = "c.Phone = '$value' AND";
        }

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $where_name = "c.Fullname LIKE '%$name%' AND";
        }

        // if($_POST['status'] != -1){
        // 	$status = $_POST['status'];
        // 	$where_status = "oh.domain_Status = '$status' AND";
        // }

        if ($_POST['payment'] != -1) {
            $payment = $_POST['payment'];
            $where_payment = "oh.Payment_Verified = '$payment' AND";
        }

        $where = "$where_domain_no $where_customer $where_mobile_no $where_name $where_status $where_payment $where_subcategory d.Status = 1";

        $status = $_POST['status'];



        if ($status == 'Customer_Orders') {


            $this->db->distinct();
            $this->db->select('*, d.Domain_ID as DID,or.Created_AT as DAL_Created');
            $this->db->from(ORDERS . ' as or');
            $this->db->join(DOMAIN . ' as d', 'or.Domain_ID = d.Domain_ID');
            $this->db->join(INFO . ' as i', 'i.Domain_ID = d.Domain_ID');
            $this->db->join(USERS . ' as u', 'u.Epp_ID = i.Registrar_ID', 'left');
            $this->db->where('d.Customer_ID', $customer_id);
            //$this->db->order_by('or.DO_ID','desc');
        }




        if ($status == 'DOMAINS') {
            $this->db->distinct();
            $this->db->select('*, d.Domain_ID as DID');
            $this->db->from(DOMAIN . " AS d");
            $this->db->join(INFO . ' as i', 'i.Domain_ID = d.Domain_ID');
            $this->db->join(USERS . ' as u', 'u.Epp_ID = i.Registrar_ID', 'left');
            $this->db->join('(select max(DO_ID) max_id, Domain_ID
					                    from domains_orders group by Domain_ID) as cs1', 'cs1.Domain_ID = d.Domain_ID', 'left');
            $this->db->join('domains_orders as cs', 'cs.DO_ID = cs1.max_id ', 'left');
            $this->db->where('d.IS_Domain_Created', 1);


            $this->db->where($where);
            $this->db->group_by('d.Domain_ID');
        }


        if ($status == 'All') {
            $this->db->distinct();
            $this->db->select('*, d.Domain_ID as DID');
            $this->db->from(DOMAIN . " AS d");
            $this->db->join(INFO . ' as i', 'i.Domain_ID = d.Domain_ID');
            $this->db->join(USERS . ' as u', 'u.Epp_ID = i.Registrar_ID', 'left');
            $this->db->join('(select max(DO_ID) max_id, Domain_ID
                                        from domains_orders group by Domain_ID) as cs1', 'cs1.Domain_ID = d.Domain_ID', 'left');
            $this->db->join('domains_orders as cs', 'cs.DO_ID = cs1.max_id ', 'left');
            //$this->db->where('l.DAL_Status','insert_application');
            // $this->db->where('d.IS_Domain_Created',1);
            // $this->db->where('cs.Payment_Verified',1);
            //$this->db->where('d.Domain_Status','Done');

            $this->db->where($where);
            $this->db->group_by('d.Domain_ID');
        }

        if ($status == 'requests') {

            $this->db->distinct();
            $this->db->select('r.*,d.*, d.Domain_ID as DID,d.*,tr.DTO_ID,tr.Payment_Verified as TR_Payment_Verified, tr.Total_Price as TR_Total_Price');
            $this->db->from(REQUEST . " AS r");
            $this->db->join(DOMAIN . ' as d', 'r.DCR_Domain_ID = d.Domain_ID', 'left');
            $this->db->join(INFO . ' as i', 'i.Domain_ID = d.Domain_ID');
            $this->db->join(USERS . ' as u', 'u.Epp_ID = i.Registrar_ID', 'left');
            $this->db->join(ORDERS . ' as or', 'or.DO_ID = (select max(DO_ID) from ' . ORDERS . ' as e2 where e2.Domain_ID = d.Domain_ID)', 'left');

            $this->db->join(TRANSFER_ORDERS . ' as tr', 'tr.Domain_ID = d.Domain_ID', 'left');
            //  $this->db->join('customers as c', 'c.Customer_ID = d.Customer_ID','left');
            //$this->db->where('d.IS_Domain_Created',1);  
            $this->db->where('d.Customer_ID', $_POST['customer_id']);
            $this->db->where('r.DCR_Status !=', 'deleted');
            $this->db->order_by('r.DCR_ID', 'desc');
        }




        if ($status == 'DOMAINS_WAIVERS') {

            $this->db->select('*');
            $this->db->from(WAIVERS . ' as w');
            $this->db->join(DOMAIN . ' as d', 'd.Domain_ID = w.DW_Domain_ID', 'left');
            $this->db->join(INFO . ' as i', 'i.Domain_ID = d.Domain_ID');
            $this->db->join(USERS . ' as u', 'u.Epp_ID = i.Registrar_ID', 'left');
            $this->db->join('customers as c', 'c.Customer_ID = d.Customer_ID', 'left');
            //$this->db->where('w.DW_Status', 'APPROVED');
            $this->db->order_by('w.DW_ID', 'desc');
        }




        //print_r($_POST['domain']);
        if (isset($_POST['domain'])) {
            $ind = $_POST['domain'][0]['column'];
            $oColumn = $this->orders_columns_1[$ind];
            $direction = $_POST['domain'][0]['dir'];
            $where_domain = "$oColumn $direction";
            $this->db->order_by($where_domain);
        } else {
            $this->db->order_by("d.Domain_ID", "DESC");
        }
    }

    function getdomainsList($customer_id) {
        $this->_get_domains_query($customer_id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        return $query->result();
    }

    function getordersList($customer_id) {
        $this->_get_orders_query($customer_id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        return $query->result();
    }

    // *****************************************
    // to get orders by customer ID
    // *****************************************
    private function _get_orders_query($customer_id) {

        $this->db->distinct();
        $this->db->select('r.*,d.*,tr.DTI_ID ,u.Employer_Name, d.Domain_ID as DID,d.*,tr.DTO_ID,tr.Payment_Verified as TR_Payment_Verified, tr.Total_Price as TR_Total_Price, or.Total_Price as OR_Total_Price,or.Payment_Verified as OR_Payment_Verified,or.Payment_Refunded as OR_Payment_Refunded,tr.Payment_Refunded as TR_Payment_Refunded');
        $this->db->from(REQUEST . " AS r");

        $this->db->join(DOMAIN . ' as d', 'r.DCR_Domain_ID = d.Domain_ID', 'left');
        $this->db->join(INFO . ' as i', 'i.Domain_ID = d.Domain_ID','left');
        $this->db->join(USERS . ' as u', 'u.Epp_ID = i.Registrar_ID', 'left');

        $this->db->join(ORDERS.' as or', 'or.DO_ID = (select DO_ID from '.ORDERS.' as e2 where e2.Domain_ID = d.Domain_ID AND e2.Request_ID = r.DCR_ID ORDER BY Payment_Verified desc limit 1)', 'left');
        $this->db->join(TRANSFER_ORDERS . ' as tr', 'tr.DTO_ID = (select DTO_ID from ' . TRANSFER_ORDERS . ' as e3 where  e3.Request_ID = r.DCR_ID ORDER BY Payment_Verified desc limit 1)', 'left');

       // $this->db->join(TRANSFER . ' as t', 't.Request_ID = r.DCR_ID', 'left');

        $this->db->where('r.DCR_USER_ID', $customer_id);
        $this->db->where('r.DCR_Status !=', 'deleted');
        $this->db->order_by('r.DCR_ID', 'desc');
        $this->db->group_by('r.DCR_ID');

    }

    function domainsCount_filtered($customer_id) {
        $this->_get_domains_query($customer_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function domainsCount_all($customer_id) {
        $this->db->from(DOMAIN . " AS d");

        return $this->db->count_all_results();
    }

    // *****************************************
    // to get all tickets
    // *****************************************

    var $order_ticket_columns_2 = array('t.TicketId', 't.Timestamp', 't.Fullname', 't.Email', 't.Phone', 't.Status');

    private function _get_tickets_query() {
        $where_ticket_id = '';
        $where_name = '';
        $where_status = '';

        if (!empty($_POST['ticket_id'])) {
            $ticket_id = $_POST['ticket_id'];
            $where_ticket_id = "t.TicketId LIKE '%$ticket_id%' AND";
        }

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $where_name = "c.Fullname LIKE '%$name%' AND";
        }

        if ($_POST['status'] != -1) {
            $status = $_POST['status'];
            $where_status = "t.Status LIKE '%$status%' AND";
        }

        $where = "$where_ticket_id $where_name $where_status t.TicketId > 0";
        $this->db->distinct();
        $this->db->select('t.*, c.Fullname');
        $this->db->from('customer_tickets as t');
        $this->db->join('customers as c', 'c.Customer_ID = t.CustomerId');
        $this->db->where($where);
        $this->db->order_by("FIELD ( t.Status, 'New', 'Pending', 'InProcess', 'Answered', 'Closed' )", '', FALSE);

        if (isset($_POST['order'])) {
            $ind = $_POST['order'][0]['column'];
            $oColumn = $this->order_ticket_columns_2[$ind];
            $direction = $_POST['order'][0]['dir'];
            $where_order = "$oColumn $direction";
            $this->db->order_by($where_order);
        } else {
            $this->db->order_by("t.TicketId", "desc");
        }
    }

    function getTicketsData() {
        $this->_get_tickets_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        //echo $this->db->last_query();die();
        return $query->result();
    }

    function ticketsCount_filtered() {
        $this->_get_tickets_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function ticketsCount_all() {
        $this->db->from('customer_tickets');

        return $this->db->count_all_results();
    }

    // to get ticket by ID
    var $order_ticket_columns_3 = array('t.TicketId', 't.Timestamp', 't.Fullname', 't.Email', 't.Phone', 't.Status');

    private function _get_tickets_by_id_query($customer_id) {
        $where_ticket_id = '';
        $where_name = '';
        $where_status = '';

        if (!empty($_POST['ticket_id'])) {
            $ticket_id = $_POST['ticket_id'];
            $where_ticket_id = "t.TicketId LIKE '%$ticket_id%' AND";
        }

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $where_name = "c.Fullname LIKE '%$name%' AND";
        }

        if ($_POST['status'] != -1) {
            $status = $_POST['status'];
            $where_status = "t.Status LIKE '%$status%' AND";
        }

        if ($_POST['id'] != -1) {
            $id = $_POST['id'];
            $where_id = "t.TicketId != $id AND";
        }

        $where = "$where_ticket_id $where_name $where_status $where_id t.CustomerId = $customer_id";
        $this->db->distinct();
        $this->db->select('t.*, c.Fullname');
        $this->db->from('customer_tickets as t');
        $this->db->join('customers as c', 'c.Customer_ID = t.CustomerId');
        $this->db->where($where);
        $this->db->order_by("FIELD ( t.Status, 'New', 'Pending', 'InProcess', 'Answered', 'Closed' )", '', FALSE);

        if (isset($_POST['order'])) {
            $ind = $_POST['order'][0]['column'];
            $oColumn = $this->order_ticket_columns_3[$ind];
            $direction = $_POST['order'][0]['dir'];
            $where_order = "$oColumn $direction";
            $this->db->order_by($where_order);
        } else {
            $this->db->order_by("t.TicketId", "desc");
        }
    }

    function getTicketsDataByID($customer_id) {
        $this->_get_tickets_by_id_query($customer_id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        //echo $this->db->last_query();die();
        return $query->result();
    }

    function ticketsByIDCount_filtered($customer_id) {
        $this->_get_tickets_query($customer_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function ticketsByIDCount_all($customer_id) {
        $this->db->from('customer_tickets');

        return $this->db->count_all_results();
    }
    // ends
    public function phistoryCount_filtered() {
        $this->_get_customer_phistory();
        return $this->db->get()->num_rows();
    }

}

?>
