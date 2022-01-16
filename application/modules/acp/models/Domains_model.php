<?PHP
class Domains_model extends CI_Model{
		

      public function getDomainOrgUsers($domain_id,$user_type = ''){


      	     if($user_type == 'Registrar'){
                        $users =  $this->db
                                            ->select('*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                }
                

               if($user_type == 'Admin'){
                        $users =  $this->db
                                            ->select('*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Admin_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                }

                      if($user_type == 'Financial'){
                        $users =  $this->db
                                            ->select('*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Financial_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                }

                                   if($user_type == 'Technical'){
                        $users =  $this->db
                                            ->select('*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Technical_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                }

            return $users;
            
      }

      public function getDomainRegitrar($domain_id){
        return $this->db
                                            ->select('u.*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
      }

      public function getLastWaiverRequest($domain_id){
          return  $this->db
                                            ->select('*')
                                            ->from(REQUEST.' as r')
                                           // ->join(USERS.' as u', 'u.Epp_ID = i.Technical_ID')  
                                            ->where('r.DCR_Request_Type', 'domain_waiver')
                                            ->order_by('r.DCR_ID','desc')  
                                            ->get()
                                            ->row();
      }


      public function getTransferInList(){

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

            $where_domains = '';
            $where_order_no = '';
            $where_mobile_no = '';
            $where_customer_name = '';


             if(!empty($_POST['domain_name'])){
                $domain_name = $_POST['domain_name'];
                $where_domains =  " t.DTI_Domain_Name_Query LIKE '%{$domain_name}%' AND";
            }

            

            if(!empty($_POST['order_no'])){
                $order_no = $_POST['order_no'];
                $where_order_no = "to.Request_ID = '$order_no' AND";
            }

            
            if(!empty($_POST['mobile_no'])){
                $mobile_no = $_POST['mobile_no'];
                $where_mobile_no = "c.Phone = '$mobile_no' AND";
            }
            
            if(!empty($_POST['customer_name'])){
                $customer_name = $_POST['customer_name'];
                $where_customer_name = "c.Email  like '%{$customer_name}%' AND";
            }
            
            if($_POST['filter_status']  != -1){
                $filter_status = $_POST['filter_status'];
                $where_filter_status = "t.DTI_Status  = '$filter_status' AND";
            }
            
            if($_POST['filter_payment'] != -1){
                $payment = $_POST['filter_payment'];
                $where_payment = "to.Payment_Verified = '$payment' AND";
            }
        
            

            
$where = "$where_order_no  $where_domains $where_customer_name $where_mobile_no  $where_filter_status $where_payment t.DTI__ID > 0";




                 return  $this->db
                                           ->select('*,r.DCR_ID as request_id')
                                           ->from(REQUEST .' as r')
                                          ->join(TRANSFER_ORDERS.' as to', 'to.DTO_ID = (select DTO_ID from '.TRANSFER_ORDERS.' as e2 where e2.Request_ID = r.DCR_ID ORDER BY e2.Payment_Verified desc limit 1)', 'left')
                                           ->join(TRANSFER.' as t', 't.DTI__ID = to.DTI_ID', 'left')
                                           ->join('customers as c', 'c.Customer_ID = t.DTI_Customer_ID','left')
                                           ->where($where)
                                           ->order_by('t.DTI__ID','desc') 
                                           ->group_by('t.DTI__ID')
                                           ->get()
                                           ->result();



      }

        var $transfer_columns_1  = array('t.DTI__ID');
    private function _get_transfers_query()
    {
        
          

            $where_domains = '';
            $where_order_no = '';
            $where_mobile_no = '';
            $where_customer_name = '';


             if(!empty($_POST['domain_name'])){
                $domain_name = $_POST['domain_name'];
                $where_domains =  " t.DTI_Domain_Name_Query LIKE '%{$domain_name}%' AND";
            }

            

            if(!empty($_POST['order_no'])){
                $order_no = $_POST['order_no'];
                $where_order_no = "to.Request_ID = '$order_no' AND";
            }

            
            if(!empty($_POST['mobile_no'])){
                $mobile_no = $_POST['mobile_no'];
                $where_mobile_no = "c.Phone = '$mobile_no' AND";
            }
            
            if(!empty($_POST['customer_name'])){
                $customer_name = $_POST['customer_name'];
                $where_customer_name = "c.Email  like '%{$customer_name}%' AND";
            }
            
            if($_POST['filter_status']  != -1){
                $filter_status = $_POST['filter_status'];
                $where_filter_status = "t.DTI_Status  = '$filter_status' AND";
            }
            
            if($_POST['filter_payment'] != -1){
                $payment = $_POST['filter_payment'];
                $where_payment = "to.Payment_Verified = '$payment' AND";
            }
        
            
$where = "$where_order_no  $where_domains $where_customer_name $where_mobile_no  $where_filter_status $where_payment t.DTI__ID > 0";


            $this->db->select('c.*');
            $this->db->from(REQUEST .' as r');
            $this->db->join(TRANSFER_ORDERS.' as to', 'to.DTO_ID = (select DTO_ID from '.TRANSFER_ORDERS.' as e2 where e2.Request_ID = r.DCR_ID ORDER BY e2.Payment_Verified desc limit 1)', 'left');
            $this->db->join(TRANSFER.' as t', 't.DTI__ID = to.DTI_ID', 'left');
            $this->db->join('customers as c', 'c.Customer_ID = t.DTI_Customer_ID','left');
            $this->db->where($where);
            $this->db->group_by('t.DTI__ID');
                             
        

            if(isset($_POST['domain'])){
                $ind = $_POST['domain'][0]['column'];
                $oColumn = $this->transfer_columns_1[$ind];
                $direction = $_POST['domain'][0]['dir'];
                $where_domain = "$oColumn $direction";
                $this->db->order_by($where_domain);
            } else {
                $this->db->order_by("t.DTI__ID", "DESC");
            }
          $this->db->group_by('t.DTI__ID');

    }


    function transferCount_filtered()
    {
        $this->_get_transfers_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function transferCount_all()
    {
        $this->db->from(TRANSFER." AS d");
        return $this->db->count_all_results();
    }


    public function change_create_domain_request_status($domain_id,$old_status,$new_status){
          $request =   $this->db
                                            ->select('r.*')
                                            ->from(REQUEST.' as r')
                                            ->where('r.DCR_Domain_ID', $domain_id)
                                            ->where('r.DCR_Status', $old_status)
                                            ->where('r.DCR_Request_Type', 'create_domain')                                        
                                            ->order_by('r.DCR_ID','desc')                                          
                                            ->get()
                                            ->row();

        $this->db->where('DCR_ID',$request->DCR_ID);
        $this->db->update(REQUEST, array('DCR_Status'=>$new_status));

        return $request->DCR_ID;

     }

     public function getAllDomainChangeRequest($domain_id){
               return   $this->db
                                            ->select('r.*,to.Payment_Verified as tr_Payment_Verified,to.Payment_Refunded as tr_Payment_Refunded,or.Payment_Verified,or.Payment_Refunded,u.User_Email')
                                            ->from(REQUEST.' as r')
                                            ->join(ORDERS.' as or', 'or.Request_ID = r.DCR_ID AND or.Payment_Verified = 1 ', 'left')
                                            ->join(TRANSFER_ORDERS.' as to', 'to.Request_ID = r.DCR_ID AND to.Payment_Verified = 1', 'left') 
                                            ->join(USERS.' as u', 'u.Epp_ID = r.DCR_Admin_ID','left')                                  
                                            ->where('r.DCR_Status !=', 'deleted')
                                            ->where('r.DCR_Domain_ID', $domain_id)
                                            ->order_by('r.DCR_ID','desc')
                                            ->get()
                                            ->result();
     }

    public function getCreateRequestByDomainID($domain_id){
            return   $this->db
                                            ->select('*')
                                            ->from(REQUEST.' as r')                                    
                                            ->where('r.DCR_Request_Type', 'create_domain')
                                            ->where('r.DCR_Domain_ID', $domain_id)
                                            ->order_by('r.DCR_ID','desc')
                                            ->get()
                                            ->row();
    }

    public function getCreateRequestByRequestID($request_id){
        return   $this->db
                                        ->select('*')
                                        ->from(REQUEST.' as r')
                                        ->where('r.DCR_Request_Type', 'create_domain')
                                        ->where('r.DCR_ID', $request_id)
                                        ->get()
                                        ->row();
    }


     public function getdomainTransferByID($DTI__ID){
           return  $this->db
                                          ->select('*')
                                           ->from(TRANSFER.' as o')
                                           ->join(TRANSFER_ORDERS.' as t', 't.DTI_ID = o.DTI__ID','left')
                                           ->join('customers as c', 'c.Customer_ID = o.DTI_Customer_ID','left')
                                            ->where('o.DTI__ID', $DTI__ID)                                                                                   
                                            ->get()
                                            ->row();
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
    public function getConstantsByParantID($parent_id){
                return  $this->db
                                                ->select("*")
                                                ->from("constants")
                                                ->where('Status',1)
                                                ->where('parent',$parent_id)                                                
                                                ->get()
                                                ->result();
    }

    public function getallTlds(){
       return  $this->db
                                                ->select("*")
                                                ->from("domains_tld")
                                                ->where('Status',1)
                                                ->get()
                                                ->result();
    }

    public function getAllDomainRequirments($activity_id){
        return  $this->db
                                        ->select("*")
                                        ->from("domains_requirments")
                                        ->where('Status',1)
                                        ->where('Type',$activity_id)                                        
                                        ->order_by('Req_ID','asc')
                                        ->get()
                                        ->result();
    }

    public function getRequirmentByID($requirment_id){
        return  $this->db
                                        ->select("*")
                                        ->from("domains_requirments")
                                        ->where('Req_ID',$requirment_id)
                                        ->get()
                                        ->row();
    }

    public function getAllIssuers(){
        return  $this->db
                                        ->select("*")
                                        ->from("doc_issures")
                                        ->where('Status',1)
                                        ->order_by('Doc_Issures_ID','desc')
                                        ->get()
                                        ->result();
    }
    public function getAllDocsType(){
        return  $this->db
                                        ->select("*")
                                        ->from("doc_types")
                                        ->where('Status',1)
                                        ->order_by('Order_in_list','asc')
                                        ->get()
                                        ->result();
    }
    public function  getdomainTransferOrders($DTI__ID){
            return  $this->db
                                          ->select('*')
                                           ->from(TRANSFER.' as o')
                                           ->join(TRANSFER_ORDERS.' as t', 't.DTI_ID = o.DTI__ID','left')
                                           ->join('customers as c', 'c.Customer_ID = o.DTI_Customer_ID','left')
                                            ->where('o.DTI__ID', $DTI__ID)                                                                                   
                                            ->get()
                                            ->result();
    }


      	public function getdomainByIDV2($domain_id = 0){
      			 return  $this->db
                                            ->select('*')
                                            ->from(DOMAIN.' as d')
                                            ->join('customers as c', 'c.Customer_ID = d.Customer_ID','left')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID','left')
											->join(TLD.' as t', 't.TLD_Name = d.TLD','left')
                                            ->where('d.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();


      	}


       public function getdomainWaiversByID($dw_id = 0){

                          return  $this->db
                                            ->select('*')
                                            ->from(WAIVERS.' as w')                                           
                                            ->where('w.DW_ID', $dw_id)
                                            ->get()
                                            ->result();

        }



        public function getDomainDocuments($domain_id){

            $domain = [];
                            $domain['speech'] = $this->db
                                            ->select('*')
                                            ->from(DOCUMENT.' as d')
                                            ->where('d.Domain_ID', $domain_id)
                                            ->where('d.Doc_Type', 'speech')
                                            ->limit(1)
                                            ->order_by('d.Domain_Doc_ID','desc')
                                            ->get()
                                            ->row();
                            $domain['additional'] = $this->db
                                                            ->select('*')
                                                            ->from(DOCUMENT.' as d')
                                                            ->where('d.Domain_ID', $domain_id)
                                                            ->where('d.Doc_Type', 'additional')
                                                            ->limit(1)
                                                            ->order_by('d.Domain_Doc_ID','desc')
                                                            ->get()
                                                            ->row();
                            $domain['support'] = $this->db
                                                            ->select('*')
                                                            ->from(DOCUMENT.' as d')
                                                            ->join('doc_types as c', 'c.id = d.Doc_Type_ID')
                                                            ->join('doc_issures as ds', 'ds.Doc_Issures_ID = c.Issuer_ID OR ds.Doc_Issures_ID = d.Doc_Issures_ID','left')
                                                            ->where('d.Domain_ID', $domain_id)
                                                            ->where('d.Doc_Type', 'support')
                                                            ->limit(1)
                                                            ->order_by('d.Domain_Doc_ID','desc')
                                                            ->get()
                                                            ->row();
                              
                                return $domain;
        }


        public function get_order($domain_id=0,$order_id = 0){

                   return  $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as o')
                                            ->where('o.Domain_ID', $domain_id)
                                            ->where('o.DO_ID', $order_id)
                                            ->get()
                                            ->row();

        }

     public function getRegisterOrderDetails($domain_id){
                 return   $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as o')
                                            ->join(DOMAIN.' as d', 'd.Domain_ID = o.Domain_ID')
                                            ->join(REQUEST.' as r', 'r.DCR_ID = o.Request_ID','left')
                                            ->where('d.Domain_ID', $domain_id)
                                            ->where('o.Order_Type', 'registration_domain')
                                            ->order_by('o.DO_ID','desc')                                             
                                            ->get()
                                            ->row();
    }


    public function getDomainAdminChange($domain_id){
       return $this->db
                                            ->select('*')
                                            ->from('domain_change_log')
                                            ->where('Domain_ID', $domain_id)
                                            ->order_by("ID", "desc")
                                            ->get()
                                            ->result();


    }

    public function getDomainInsideDnet($domain_id){
       return $this->db
                                        ->select('*,old.Fullname as old_name, new.Fullname as new_name')
                                        ->from(INSIDE_DNET.' as in')
                                        ->join(TBL_CUSTOMERS.' as old', 'old.Customer_ID = in.Old_Owner_ID', 'left')
                                        ->join(TBL_CUSTOMERS.' as new', 'new.Customer_ID = in.New_Owner_ID', 'left')
                                        ->where('in.Domain_ID', $domain_id)
                                        ->order_by("in.DWL_ID", "desc")
                                        ->get()
                                        ->result();


    }

    public function getUserInfo($uid = 0){
                   return  $this->db
                                            ->select('*')
                                             ->from(USERS.' as u')
                                            ->join('countries as c', 'c.Country_ID = u.User_Country_ID')
                                            ->where('u.Org_Usr_ID', $uid)
                                            ->get()
                                            ->row();
    }

    public function getPayedDomainTransaction($domain_id = 0){
          $result = $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as o')
                                            ->where('o.Domain_ID', $domain_id)
                                            ->where('o.Payment_Verified', 1)
                                            ->where('o.Payment_Refunded', 0)
                                            ->where('o.Order_Type', 'registration_domain')
                                            ->get()
                                            ->row();
        if(empty($result)){
            $result = $this->db
                                            ->select('*')
                                            ->from(TRANSFER_ORDERS.' as o')
                                            ->where('o.Domain_ID', $domain_id)
                                            ->where('o.Payment_Verified', 1)
                                            ->where('o.Payment_Refunded', 0)
                                            ->get()
                                            ->row();
        }
     
          return $result;
    }
	


    public function getDomainAppLogs($domain_id = 0){

         return   $this->db
                                            ->select('l.*,u.Fullname as admin_name,c.Fullname as customer_name,uu.Full_Name as contact_name')
                                            ->from(APP_LOG.' as l')                                            
                                            ->join(TBL_USERS.' as u', 'u.User_ID = l.DAL_User_ID AND l.DAL_Type = "Admin"','left')
                                            ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = l.DAL_User_ID AND l.DAL_Type = "Customer"','left')
                                            ->join(USERS.' as uu', 'uu.Org_Usr_ID = l.DAL_User_ID AND l.DAL_Type = "Contact"','left')

                                            ->where('l.DAL_Domain_ID', $domain_id)
                                            ->group_by('l.DAL_ID')
                                            ->order_by("l.DAL_ID", "desc")
                                            ->get()
                                            ->result();

    }

	public function getdomainByID($domain_id = 0)
	{
	   
                $domain =  $this->db
                                            ->select('d.*,i.*,u.*,h.Chg_Entity_history,h.Chg_Name_Server_history')
                                            ->from(DOMAIN.' as d')
                                            ->join(DOMAIN_HIS.' as h', 'h.DH_ID = d.DH_ID','left')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID','left')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID','left')
                                            ->where('d.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                                    
                    $domain->Registrar = $this->db
                                            ->select('*')
                                            ->from('customers')
                                            ->where('Customer_ID', $domain->Customer_ID)
                                            ->get()
                                            ->row();


                   $domain->Admin = $this->db
                                            ->select('*')
                                             ->from(USERS.' as u')
                                            ->join('countries as c', 'c.Country_ID = u.User_Country_ID')
                                            ->where('u.Epp_ID', $domain->Admin_ID)
                                            ->get()
                                            ->row();

                /* this is for the old contact data */
                if(empty($domain->Admin)){
                       $domain->Admin = $this->db
                                            ->select('*')
                                             ->from(USERS.' as u')
                                            ->join('countries as c', 'c.Country_ID = u.User_Country_ID')
                                            ->where('u.Org_Usr_ID', $domain->Admin_ID)
                                            ->get()
                                            ->row();
                }



                if($domain->Admin_ID != $domain->Technical_ID || $all_contacts){
                      $domain->Technical = $this->db
                                            ->select('*')
                                             ->from(USERS.' as u')
                                            ->join('countries as c', 'c.Country_ID = u.User_Country_ID')
                                            ->where('u.Epp_ID', $domain->Technical_ID)
                                            ->get()
                                            ->row();

                       /* this is for the old contact data */
                        if(empty($domain->Technical)){
                            $domain->Technical = $this->db
                                            ->select('*')
                                             ->from(USERS.' as u')
                                            ->join('countries as c', 'c.Country_ID = u.User_Country_ID')
                                            ->where('u.Org_Usr_ID', $domain->Technical_ID)
                                            ->get()
                                            ->row();
                        }
                }
              if($domain->Admin_ID != $domain->Financial_ID || $all_contacts){
                      $domain->Financial = $this->db
                                            ->select('*')
                                            ->from(USERS.' as u')
                                            ->join('countries as c', 'c.Country_ID = u.User_Country_ID')
                                            ->where('u.Epp_ID', $domain->Financial_ID)
                                            ->get()
                                            ->row();

                         /* this is for the old contact data */
                        if(empty($domain->Financial)){
                            $domain->Financial = $this->db
                                            ->select('*')
                                             ->from(USERS.' as u')
                                            ->join('countries as c', 'c.Country_ID = u.User_Country_ID')
                                            ->where('u.Org_Usr_ID', $domain->Financial_ID)
                                            ->get()
                                            ->row();
                        }
                }

      
               $domain->Orders = $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as o')
                                            ->join(REQUEST.' as r', 'r.DCR_ID = o.Request_ID','left')
                                            ->join(USERS.' as u', 'u.Epp_ID = r.DCR_Admin_ID','left')
                                            ->where('o.Domain_ID', $domain_id)
                                            ->get()
                                            ->result();

            $domain->RegisterOrder = $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as o')
                                            ->where('o.Domain_ID', $domain_id)
                                            ->where('o.Payment_Verified', 1)
                                            ->where('o.Order_Type', 'registration_domain')
                                            ->order_by("DO_ID", "DESC")
                                            ->get()
                                            ->row();


             $domain->Docs->speech = $this->db
                                            ->select('*')
                                            ->from(DOCUMENT)
                                            ->where('Domain_ID', $domain_id)
                                            ->where('Doc_Type', 'speech')
                                            ->limit(1)
                                            ->order_by('Domain_Doc_ID','desc')
                                            ->get()
                                            ->row();
            $domain->Docs->additional = $this->db
                                            ->select('*')
                                            ->from(DOCUMENT)
                                            ->where('Domain_ID', $domain_id)
                                            ->where('Doc_Type', 'additional')
                                            ->limit(1)
                                            ->order_by('Domain_Doc_ID','desc')
                                            ->get()
                                            ->row();
            $domain->Docs->support = $this->db
                                            ->select('*')
                                            ->from(DOCUMENT)
                                            ->where('Domain_ID', $domain_id)
                                            ->where('Doc_Type', 'support')
                                            ->limit(1)
                                            ->order_by('Domain_Doc_ID','desc')
                                            ->get()
                                            ->row();

                // $domain->Logs = $this->db
                //                             ->select('*')
                //                             ->from(APP_LOG)
                //                             ->where('DAL_Domain_ID', $domain_id)
                //                             ->order_by("DAL_ID", "desc")
                //                             ->get()
                //                             ->result();

                $domain->NIC = $this->db
                                            ->select('*')
                                            ->from(LOG)
                                            ->where('domain_id', $domain_id)
                                            ->order_by("id", "desc")

                                            ->get()
                                            ->result();

              $domain->Transfer_Orders =  $this->db
                                          ->select('*')
                                           ->from(TRANSFER.' as o')
                                           ->join(TRANSFER_ORDERS.' as t', 't.DTI_ID = o.DTI__ID','left')
                                           ->join('customers as c', 'c.Customer_ID = t.Customer_ID','left')
                                            ->where('o.DTI_Domain_Name_Query', $domain->Domain_Name.$domain->TLD)                                                                                  
                                            ->get()
                                            ->result();
              
                return @$domain;
	       
    }

    public function makeDisableAllPreviousRequest($domain_id,$status,$new_status='deleted'){
                                    
            $this->db->where('DCR_Domain_ID',$domain_id);
            $this->db->where('DCR_Status',$status);

            $this->db->update(REQUEST,['DCR_Status'=>$new_status]);
            return $this->db->affected_rows();

    }

    
              public function insert($table,$data){
                  $this->db->insert($table,$data);
            $insert_id = $this->db->insert_id();
             return  $insert_id;
         }

        public function save($data,$where,$table){
      $this->db->reset_query();
   
            $this->db->where($where);
            $this->db->update($table,$data);
            return $this->db->affected_rows();

        }
    
    public function getReviewBydomainID($domain_id = 0)
    {
	    return $this->db->where('domain_ID', $domain_id)->get('domain_reviews')->row();
    }
    
    public function getAnooshReviewByID($id = 0)
    {
	    return $this->db->where('ID', $id)->get('anoosh_domain_reviews')->row();
    }
    
	public function updatedomain($data = array())
	{
	    $domain_id = $data['domain_ID'];
	    $upd = $this->db->where('domain_ID', $domain_id)->update(TBL_domainS_HEAD, $data);
	    $upd = $this->db->affected_rows();
	    
	    return $upd;
    }
		
	/**
		*------- domains List *---------
	**/

	var $domain_columns_1  = array('oh.domain_ID', 'oh.TimeStamp', 'c.Fullname', 'c.Phone', 'oh.domain_Status', 'oh.domainTotal_Price', 'oh.PaymentType');
	private function _get_orders_query()
	{
		
			$where_domain_no = '';
			$where_mobile_no = '';
			$where_status = '';
			$where_name = '';
			$where_subcategory = '';
			$where_customer = '';
			$where_payment = '';

			 if(!empty($_POST['domain_name'])){
                $domain_name = $_POST['domain_name'];
                $where_domains =  " CONCAT(d.Domain_Name, '', d.TLD) LIKE '%{$domain_name}%' AND";
            }

            

			if(!empty($_POST['order_no'])){
				$order_no = $_POST['order_no'];
				$where_order_no = "r.DCR_ID = '$order_no' AND";
			}

            


			if(!empty($_POST['mobile_no'])){
				$mobile_no = $_POST['mobile_no'];
                $str = $mobile_no; // eg: 01223334434
                $value = $str . "<br>";
                $value = ltrim($str,"0"); // eg: remove first 0 from 1223334434
                //dd($value);
				$where_mobile_no = "c.Phone like '%$value%' AND";
			}
			
			if(!empty($_POST['customer_name'])){
				$customer_name = $_POST['customer_name'];
				$where_customer_name = "c.Fullname LIKE '%$customer_name%' AND";
			}

            if(!empty($_POST['customer_name']) || !empty($_POST['mobile_no']) || !empty($_POST['order_no']) || !empty($_POST['domain_name'])){
                $_POST['filter_payment'] = -1;
                $_POST['filter_status']  = -1;
            }


			if($_POST['filter_status']  != -1){
				$filter_status = $_POST['filter_status'];
                $where_filter_status = "r.DCR_Status  = '$filter_status' AND";
                if($filter_status == 'pending'){
                    $where_filter_status = "r.DCR_Status  = '$filter_status' AND r.DCR_Admin_Approve = 1 AND";
                }
                  if($filter_status == 'admin_waiting_approve'){
                    $where_filter_status = "r.DCR_Status  = 'pending' AND r.DCR_Admin_Approve = 0 AND";
                }
				
			}
			

			if($_POST['filter_payment'] != -1){
				$payment = $_POST['filter_payment'];
				$where_payment = "or.Payment_Verified = '$payment' AND";
			}
        
			
$where = "$where_order_no $where_mobile_no $where_customer_name $where_filter_status $where_domains $where_payment d.Status = 1";

			$status = $_POST['status'];






            if($status == 'create_domain'){
               
                $this->db->distinct();
                $this->db->select('*, d.Domain_ID as DID,r.DCR_Request_Type');
                $this->db->from(REQUEST .' as r');               
                $this->db->join(DOMAIN.' as d', 'r.DCR_Domain_ID = d.Domain_ID and r.DCR_Status != "deleted"','left');
                $this->db->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID','left');
                $this->db->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID','left');
                $this->db->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = d.Customer_ID');

                if($_POST['filter_payment'] == 1){                

                    $this->db->join(ORDERS.' as or', 'or.Request_ID = r.DCR_ID', 'left');
                    $this->db->where($where);
                    $this->db->where('or.Payment_Verified', 1) ;
                    $this->db->where('r.DCR_Request_Type', 'create_domain');
                    

                }else{
                    
                   // $this->db->join(ORDERS.' as or', 'or.Payment_Verified = (select distinct max(Payment_Verified) from '.ORDERS.' as e2 where e2.Request_ID = r.DCR_ID limit 1)', 'left');
                $this->db->join(ORDERS.' as or', 'or.DO_ID = (select DO_ID from '.ORDERS.' as e2 where e2.Domain_ID = d.Domain_ID AND e2.Order_Type = "registration_domain" AND e2.Request_ID = r.DCR_ID ORDER BY Payment_Verified desc limit 1)', 'left');
                    $this->db->where($where);
                    $this->db->where('i.Admin_Cancel', 0);
                    $this->db->where('r.DCR_Request_Type', 'create_domain');
                    $this->db->group_by('r.DCR_ID');

                
                }




            }
            
            if($status == 'DOMAINS_WAIVERS'){
               
                                             $this->db->select('*');
                                             $this->db->from(WAIVERS.' as w');  
                                             $this->db->join(DOMAIN.' as d', 'd.Domain_ID = w.DW_Domain_ID','left');
                                             $this->db->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID');
                                             $this->db->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID','left');
                                             $this->db->join('customers as c', 'c.Customer_ID = d.Customer_ID','left');                                             
                                             //$this->db->where('w.DW_Status', 'APPROVED');
                                             $this->db->group_by('w.DW_ID');
                                             $this->db->order_by('w.DW_ID','desc');                                           
            }

			

	        
	        //print_r($_POST['domain']);
		    if(isset($_POST['domain'])){
			    $ind = $_POST['domain'][0]['column'];
			    $oColumn = $this->domain_columns_1[$ind];
				$direction = $_POST['domain'][0]['dir'];
				$where_domain = "$oColumn $direction";
				$this->db->order_by($where_domain);
		    } else {
			    $this->db->order_by("d.Domain_ID", "DESC");
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
 
    function domainsCount_filtered()
    {
        $this->_get_orders_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function domainsCount_all()
    {
        $this->db->select('d.*'); 
        $this->db->from(DOMAIN." AS d");
        $this->db->where('d.IS_Domain_Created',1);  

        return $this->db->count_all_results();
    }



    function getDomainsList(){
        $this->_get_domains_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        return $query->result();
    }

        function domainsCount_filteredV2()
    {
        $this->_get_domains_query();
        $query = $this->db->get();
        return $query->num_rows();
    }



 



        private function _get_domains_query()
    {
        
            $where_domain_no = '';
            $where_mobile_no = '';
            $where_status = '';
            $where_name = '';
            $where_subcategory = '';
            $where_customer = '';
            $where_payment = '';

             if(!empty($_POST['domain_name'])){
                $domain_name = $_POST['domain_name'];
                $where_domains =  " CONCAT(d.Domain_Name, '', d.TLD) LIKE '%{$domain_name}%' AND";
            }

            

            if(!empty($_POST['order_no'])){
                $order_no = $_POST['order_no'];
                $where_order_no = "d.Domain_ID = '$order_no' AND";
            }

            


            if(!empty($_POST['mobile_no'])){
                $mobile_no = $_POST['mobile_no'];
                $str = $mobile_no; // eg: 01223334434
                $value = $str . "<br>";
                $value = ltrim($str,"0"); // eg: remove first 0 from 1223334434
                $where_mobile_no = "c.Phone like '%$value%' AND";
            }
            
            if(!empty($_POST['customer_name'])){
                $customer_name = $_POST['customer_name'];
                $where_customer_name = "u.Full_Name LIKE '%$customer_name%' AND";
            }
            


           if($_POST['filter_status']  != -1){
                $filter_status = $_POST['filter_status'];
                $where_filter_status = "d.Domain_Status  = '$filter_status' AND";
            }
            

            if($_POST['filter_payment'] != -1){
                $payment = $_POST['filter_payment'];
                $where_payment = "or.Payment_Verified = '$payment' OR tr.Payment_Verified = '$payment' AND";
            }
            
$where = "$where_order_no $where_mobile_no $where_customer_name $where_filter_status $where_domains $where_payment d.Status = 1";

      
                     
                $this->db->distinct();
                $this->db->select('d.*,or.*,
                u.Full_Name,
                d.Expire_Date as domain_expire_date,
                d.Domain_ID as DID,
                r.DCR_Request_Type,
                tr.DTO_ID,
                tr.Payment_Verified as TR_Payment_Verified,
                tr.Payment_Refunded as TR_Payment_Refunded,
                tr.Total_Price as TR_Total_Price'); 
                $this->db->from(DOMAIN." AS d");
                $this->db->join(TBL_CUSTOMERS.' as c', "c.Customer_ID = d.Customer_ID",'left');                
                $this->db->join(REQUEST.' as r', 'r.DCR_Domain_ID = d.Domain_ID','left');

                $this->db->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID','left');
                $this->db->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID','left');
 
                $this->db->join(ORDERS.' as or', "r.DCR_ID = or.Request_ID",'left');
                $this->db->join(TRANSFER_ORDERS.' as tr', "r.DCR_ID = tr.Request_ID",'left');
         
                $this->db->where('d.IS_Domain_Created',1);  
                $this->db->where('r.DCR_Status','approved');



                $this->db->group_start();
                $this->db->where('or.Payment_Verified', 1);
                $this->db->or_where('tr.Payment_Verified', 1);
                $this->db->group_end();

                $this->db->group_start();
                $this->db->where('r.DCR_Request_Type', 'create_domain');
                $this->db->or_where('r.DCR_Request_Type', 'domain_transfer_in');
                $this->db->group_end();

                $this->db->where($where);
                $this->db->order_by('d.Domain_ID','desc'); 

            
            if(isset($_POST['domain'])){
                $ind = $_POST['domain'][0]['column'];
                $oColumn = $this->domain_columns_1[$ind];
                $direction = $_POST['domain'][0]['dir'];
                $where_domain = "$oColumn $direction";
                $this->db->order_by($where_domain);
            } else {
                $this->db->order_by("d.Domain_ID", "DESC");
            }


        }
	
	/**
		*------- Incompleted domains List *---------
	**/

	var $incdomain_columns  = array('oh.domain_ID', 'oh.TimeStamp', 'c.Fullname', 'c.Phone', 'oh.domain_Status', 'oh.domainTotal_Price', 'oh.PaymentType');
	private function _get_incompleteddomains_query()
	{
		
			$where_domain_no = '';
			$where_mobile_no = '';
			$where_status = '';
			$where_name = '';
			$where_category = '';
			$where_subcategory = '';
			$where_customer = '';
			
			if(!empty($_POST['domain_no'])){
				$id = $_POST['domain_no'];
				$where_domain_no = "oh.domain_ID = $id AND";
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
				$where_status = "oh.domain_Status = '$status' AND";
			}
			
			$where = "$where_domain_no $where_customer $where_mobile_no $where_name $where_status $where_category $where_subcategory oh.domain_Confirmed = 0 AND c.Guest = 0";
			
		    $this->db->distinct();
	        $this->db->select('oh.*, c.Fullname, c.Phone'); 
	        $this->db->from(TBL_domainS_HEAD." AS oh");
	        $this->db->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = oh.Customer_ID');
	        $this->db->where($where);
	        
	        //print_r($_POST['domain']);
		    if(isset($_POST['domain'])){
			    $ind = $_POST['domain'][0]['column'];
			    $oColumn = $this->incdomain_columns[$ind];
				$direction = $_POST['domain'][0]['dir'];
				$where_domain = "$oColumn $direction";
				$this->db->domain_by($where_domain);
		    } else {
			    $this->db->domain_by("a.Class_ID", "DESC");
		    }
    }
 
    function getIncompleteddomainsList()
    {
        $this->_get_incompleteddomains_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function incompleteddomainsCount_filtered()
    {
        $this->_get_incompleteddomains_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function incompleteddomainsCount_all()
    {
        $this->_get_incompleteddomains_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	
	

	public function export_domains($return_obj = false)
	{

		$this->db->distinct();
		$this->db->select('od.domain_ID,
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
							oh.domain_Status');
							
		$this->db->from(TBL_domain_DETAILS.' as od');
		$this->db->join(TBL_domainS_HEAD.' as oh', 'oh.domain_ID = od.domain_ID');
		$this->db->join(TBL_CUSTOMERS.' as cu', 'cu.Customer_ID = oh.Customer_ID');
		$this->db->join(TBL_CLASSES.' as p', 'p.Class_ID = od.Class_ID');
		$this->db->domain_by('oh.domain_ID', 'ASC');
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

	var $review_columns  = array('r.Timestamp', 'r.domain_ID', 'c.Fullname', 'r.Overall_Rating', 'r.Review');
	private function _get_reviews_query()
	{
		
			$where_domain_no = '';
			$where_mobile_no = '';
			$where_name = '';
			
			if(!empty($_POST['domain_no'])){
				$id = $_POST['domain_no'];
				$where_domain_no = "oh.domain_ID = $id AND";
			}
			
			if(!empty($_POST['mobile_no'])){
				$phone = $_POST['mobile_no'];
				$where_mobile_no = "c.Phone = '$phone' AND";
			}
			
			if(!empty($_POST['name'])){
				$name = $_POST['name'];
				$where_name = "c.Fullname LIKE '%$name%' AND";
			}
			
			$where = "{$where_domain_no} {$where_mobile_no} {$where_name} r.ID > 0";
			
		    $this->db->distinct();
	        $this->db->select('r.*, c.Fullname, c.Phone'); 
	        $this->db->from("domain_reviews AS r");
	        $this->db->join(TBL_domainS_HEAD.' as oh', 'oh.domain_ID = r.domain_ID');
	        $this->db->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = oh.Customer_ID', 'LEFT');
	        $this->db->where($where);
	        
	        //print_r($_POST['domain']);
		    if(isset($_POST['domain'])){
			    $ind = $_POST['domain'][0]['column'];
			    $oColumn = $this->review_columns[$ind];
				$direction = $_POST['domain'][0]['dir'];
				$where_domain = "$oColumn $direction";
				$this->db->domain_by($where_domain);
		    } else {
			    $this->db->domain_by("r.ID", "DESC");
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
	        $this->db->from("anoosh_domain_reviews AS r");
	        $this->db->where($where);
	        
	        //print_r($_POST['domain']);
		    if(isset($_POST['domain'])){
			    $ind = $_POST['domain'][0]['column'];
			    $oColumn = $this->review_columns1[$ind];
				$direction = $_POST['domain'][0]['dir'];
				$where_domain = "$oColumn $direction";
				$this->db->domain_by($where_domain);
		    } else {
			    $this->db->domain_by("r.ID", "DESC");
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

    public function addAPISLog($log = array())
    {
        $this->db->insert('apis_log', $log);
    }
}
?>