<?PHP
	class Domain_model extends CI_Model{





            public function getAllDomainsByCustomerID($customer_id = 0){
                $this->db->distinct();
                $this->db->select('d.*,or.*,      
                d.Domain_ID as DID,
                tr.Payment_Verified as TR_Payment_Verified,
                tr.Payment_Refunded as TR_Payment_Refunded,
                tr.Total_Price as TR_Total_Price'); 
                $this->db->from(DOMAIN." AS d");
                $this->db->join(REQUEST.' as r', 'r.DCR_Domain_ID = d.Domain_ID','left');

                $this->db->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID','left');
                $this->db->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID','left');
 
                $this->db->join(ORDERS.' as or', "r.DCR_ID = or.Request_ID",'left');
                $this->db->join(TRANSFER_ORDERS.' as tr', "r.DCR_ID = tr.Request_ID",'left');
         
                $this->db->where('d.IS_Domain_Created',1);  
                $this->db->where('r.DCR_Status','approved');
                $this->db->where('d.Customer_ID',$customer_id);




                $this->db->group_start();
                $this->db->where('or.Payment_Verified', 1);
                $this->db->or_where('tr.Payment_Verified', 1);
                $this->db->group_end();

                $this->db->group_start();
                $this->db->where('r.DCR_Request_Type', 'create_domain');
                $this->db->or_where('r.DCR_Request_Type', 'domain_transfer_in');
                $this->db->group_end();

                $query = $this->db->get();
                    
                //echo $this->db->last_query();
                return $query->result();

    }

    

    // ***************************************
    // Note: used for Blog
    // ***************************************
    public function getBlogsList()
    {
        if (!$this->input->is_ajax_request())
        {
            //exit('No direct script access allowed');
        }
        $this->load->library('parser');
                
        $blogs = $this->datatable->getBlogsList() ;

        //echo'<pre>';print_r($blogs);exit;

        $data      = array() ;
        $no        = $_POST['start']  ;
        $i         = 0 ;
        $blogs_per_row = 0;
        $blog_list = '';
        
        //print_r($campaigns);exit;

        foreach ($blogs as $blog) 
        {
            $no++;
            $i++;
            
            $dt = new DateTime($blog->TimeStamp);
            $date = $dt->format('d-m-Y');
            
            $title = 'Title_'.$this->session->userdata($this->site_session->__lang_h());
            
            //Actions template
            $temp_data = array( 
                                'news_id' => $blog->News_ID,
                                'timestamp' => $blog->TimeStamp,
                                'title' => $blog->$title,
                                'img' => $blog->Picture
                            );
            //echo'<pre>';print_r($temp_data);exit;
            $blog_temp = ''.$this->parser->parse('blog/snippets/blogs-template', $temp_data, TRUE);
            $blog_list .= $blog_temp;
            
            $blogs_per_row++;

            $row    = array();

            if(count($blogs) >= $_POST['length']){
                if($blogs_per_row == $_POST['length']){
                    $row[] = $blog_list;
                    $data[] = $row;
                    $blog_list = '';
                    $blogs_per_row = 0;
                }
            } else if(count($blogs) == $blogs_per_row){
                $row[] = $blog_list;
                $data[] = $row;
            }

            $i++;
            
        } // end foreach

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->blogsCount_all(),
            "recordsFiltered" => $this->datatable->blogsCount_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    // Ends
    // ***************************************
    

    
        /*--------------------------------------------------------
        ---------------------- By Eng. Mohammed Arabid -----------
        --------------------------------------------------------*/


        public function getAllSuggestedTld($domain_name){

            $suggested_tld = [];
            $tld_prices    = [];
            $tld_ids     = [];
                if(!empty($domain_name)){
                    //get all available tld
                        $domain_tlds =   $this->db
                                                ->select("*")
                                                ->from("domains_tld")
                                                ->where('Status',1)
                                                ->get()
                                                ->result();



                        $undesired_tlds = array('.com','.net','.org','.edu','.med','.pub','.sch');                      
                        foreach ($undesired_tlds as  $row) {
                            $domain_name = str_replace($row, "",$domain_name);
                        }

                                                
                        $tlds = [];
                        foreach ($domain_tlds as $key => $row) {
                            $domain_name =  str_replace( $row->TLD_Name, "",$domain_name);
                        }

                      

                        foreach ($domain_tlds as $key => $row) {
                            $suggested_tld[] = $domain_name.$row->TLD_Name;
                            $tld_prices[]    = $row->Register_Price;
                            $tld_ids[]       = $row->TLD_ID;

                        }

                       $suggested_tld = implode(',', $suggested_tld);



                }

                       $result['suggested_tld'] =  $suggested_tld;
                       $result['prices_tld']    = $tld_prices;
                       $result['tld_ids']    = $tld_ids;
                       $result['search_domain']    = $domain_name;


//print_r($tld_ids); exit();
                       return $result;

        }
    


        public function addLog($log)
        {
                $this->db->insert(LOG,$log);

        }


    public function getRequirmentByID($requirment_id){
        return  $this->db
                                        ->select("*")
                                        ->from("domains_requirments")
                                        ->where('Req_ID',$requirment_id)
                                        ->get()
                                        ->row();
    }


    public function getDomainTlds(){
            $this->db->group_by('TLD_Name');
            $this->db->where('Deleted IS NULL', null, true);
            $this->db->where('Status', 1);          
             $this->db->order_by('TLD_ID', 'asc');
            $query = $this->db->get(TLD);
            return $query->result();
    }

    public function getDomainTldsByID($tld_id){
        return  $this->db
                                                ->select("*")
                                                ->from(TLD)
                                                ->where('Status',1)
                                                ->where('TLD_ID',$tld_id)
                                                ->get()
                                                ->row();
    }

    public function getDomainTldsByName($tld_name){
        return  $this->db
                                                ->select("*")
                                                ->from(TLD)
                                                ->where('Status',1)
                                                ->like('TLD_Name',$tld_name)
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

    public function getDomainInfo($domain_id){
         return  $this->db
                                                ->select("*")
                                                ->from(INFO)
                                                ->where('Domain_ID',$domain_id)
                                                ->get()
                                                ->row();
    }

    public function getAllPendingRequest($domain_id,$token){

             $request->entity =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','entity')                                                
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->where('DCR_Verify_Page_Token',$token)                                                
                                                ->get()
                                                ->row();
             $request->admin =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','admin')                                                
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->where('DCR_Verify_Page_Token',$token)                                                
                                                ->get()
                                                ->row();
            $request->financial =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','financial')                                                
                                                ->where('DCR_Domain_ID',$domain_id)   
                                                ->where('DCR_Verify_Page_Token',$token)                                               
                                                ->get()
                                                ->row();
            $request->technical =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','technical')                                                
                                                ->where('DCR_Domain_ID',$domain_id) 
                                                ->where('DCR_Verify_Page_Token',$token)                                                 
                                                ->get()
                                                ->row();
            $request->host =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','host')                                                
                                                ->where('DCR_Domain_ID',$domain_id) 
                                                ->where('DCR_Verify_Page_Token',$token)                                                 
                                                ->get()
                                                ->row();
            
             $request->transfer_inside =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','transfer_inside')                       
                                                ->where('DCR_Domain_ID',$domain_id)    
                                                ->where('DCR_Verify_Page_Token',$token)                                              
                                                ->get()
                                                ->row(); 

            $request->dnssec_enable =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','dnssec_enable')                                              
                                                ->where('DCR_Domain_ID',$domain_id) 
                                                ->where('DCR_Verify_Page_Token',$token)                                                 
                                                ->get()
                                                ->row();
            $request->dnssec_disable =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','dnssec_disable')                                              
                                                ->where('DCR_Domain_ID',$domain_id)   
                                                ->where('DCR_Verify_Page_Token',$token)                                               
                                                ->get()
                                                ->row(); 

            $request->lock =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','lock')                                              
                                                ->where('DCR_Domain_ID',$domain_id)   
                                                ->where('DCR_Verify_Page_Token',$token)                                               
                                                ->get()
                                                ->row();  
             $request->unlock =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','unlock')                                              
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->where('DCR_Verify_Page_Token',$token)                                                
                                                ->get()
                                                ->row(); 
              $request->delete_domain =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','delete_domain')                                              
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->where('DCR_Verify_Page_Token',$token)                                                
                                                ->get()
                                                ->row();
              $request->restore_domain =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','restore_domain')                                              
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->where('DCR_Verify_Page_Token',$token)                                                
                                                ->get()
                                                ->row();
             $request->auth_code =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','auth_code')                                              
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->where('DCR_Verify_Page_Token',$token)                                                
                                                ->get()
                                                ->row();   

             $request->transfer_out =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','transfer_out')                                              
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->where('DCR_Verify_Page_Token',$token)                                                
                                                ->get()
                                                ->row();
            $request->domain_waiver =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','domain_waiver')                                              
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->where('DCR_Verify_Page_Token',$token)                                                
                                                ->get()
                                                ->row();

             $request->second_admin_waiver =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','second_admin_waiver')                                              
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->where('DCR_Verify_Page_Token',$token)                                                
                                                ->get()
                                                ->row();
             $request->new_admin =  $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','new_admin')                                              
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->where('DCR_Verify_Page_Token',$token)                                                
                                                ->get()
                                                ->row();                                                                                   

            return $request;
    }

    public function getDomainByAuthCode($auth_code){


        return 
         $this->db
                                            ->select('*')
                                            ->from('customers as c')
                                            //->where('c.Customer_ID', $auth_code)
                                            ->where('c.Random_ID', $auth_code)
                                            ->get()
                                            ->row();



    }


        public function getDomainByID_All($domain_id,$all_contacts = 0){
               

                $domain =  $this->db
                                            ->select('*')
                                            ->from(DOMAIN.' as d')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID','left')
                                            ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = d.Customer_ID','left')
                                            ->where('d.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();


                  $domain->Registrar = $this->db
                                            ->select('*')
                                             ->from(USERS.' as u')
                                            ->join('countries as c', 'c.Country_ID = u.User_Country_ID')
                                            ->where('u.Epp_ID', $domain->Registrar_ID)
                                            ->get()
                                            ->row();
              /* this is for the old contact data */
                if(empty($domain->Registrar)){
                       $domain->Registrar = $this->db
                                            ->select('*')
                                             ->from(USERS.' as u')
                                            ->join('countries as c', 'c.Country_ID = u.User_Country_ID')
                                            ->where('u.Org_Usr_ID', $domain->Registrar_ID)
                                            ->get()
                                            ->row();
                }



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
              
                return $domain;

      }

    public function updateDomainByID($domain_id,$data){

        return $this->db
                        ->where('Domain_ID', $domain_id)
                        ->update(DOMAIN, $data);
    }


    public function changeCustomerPageToken($customer_id,$page_token){

        return $this->db
                        ->where('Customer_ID', $customer_id)
                        ->update('customers', ['Verify_Page_Token'=>$page_token]);
    }


      public function verifyDomainInfo($data  = array()){

            $token = $data['token'];
            $domain_id = $data['domain_id'];

           return $this->db
                                            ->select('d.*')
                                            ->from(DOMAIN.' as d')
                                            ->join('customers as c', 'c.Customer_ID = d.Customer_ID','right')
                                            ->where('d.Domain_ID', $domain_id)
                                            ->where('c.Verify_Page_Token', $token)
                                            ->get()
                                            ->num_rows();


      }

      public function get_pending_create_request($domain_id){

         return   $this->db
                                                ->select("*")
                                                ->from(REQUEST)
                                                ->where('DCR_Status','pending')
                                                ->where('DCR_Request_Type','create_domain')                                                
                                                ->where('DCR_Domain_ID',$domain_id)  
                                                ->order_by('DCR_ID','desc')                                                
                                                ->get()
                                                ->row();

      }

        public function verify_request($data  = array()){

            $token = $data['token'];
            $domain_id = $data['domain_id'];

           return $this->db
                                            ->select('*')
                                            ->from(DOMAIN.' as d')
                                            ->join(REQUEST.' as r', 'r.DCR_Domain_ID = d.Domain_ID','right')
                                            ->where('d.Domain_ID', $domain_id)
                                            ->where('r.DCR_Verify_Page_Token', $token)
                                            //->where('r.DCR_Status', 'pending')
                                            ->get()
                                            ->row();


      }

      public function getDomainRegitrar($domain_id){
              return $this->db
                                            ->select('*')
                                            ->from(DOMAIN.' as d')
                                            ->join('customers as c', 'c.Customer_ID = d.Customer_ID','right')
                                            ->where('d.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
      }


      public function getDomainByID($domain_id,$customer_id=0){
               
            if($customer_id){
                $this->db->where('c.Customer_ID', $customer_id);
            }
                return   $this->db
                                            ->select('*')
                                            ->from(DOMAIN.' as d')
                                            ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = d.Customer_ID','left')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                                            ->where('d.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
            
              
              

      }

    public  function duplicateHisRecord($table, $primary_key_field, $primary_key_val,$new_data) {
   /* CREATE SELECT QUERY */
   $this->db->where($primary_key_field, $primary_key_val);
   $query = $this->db->get($table);
    foreach ($query->result() as $row){
       foreach($row as $key=>$val){
          if($key != $primary_key_field){
            /* Below code can be used instead of passing a data array directly to the insert or update functions */
            $this->db->set($key, $val);
          }//endif
          if($key == $new_data['key']){
            $this->db->set($key, $new_data['value']);
          }
       }//endforeach
    }//endforeach
    /* insert the new record into table*/
     $this->db->insert($table);
     return $this->db->insert_id();
}

public function getOrderDetailsByRequestID($request_id){

        $order = $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as o')
                                            ->where('o.Request_ID', $request_id)
                                            ->order_by('o.Payment_Verified','desc')                                                      
                                            ->get()
                                            ->row();
        if(empty($order)){
             $order = $this->db
                                            ->select('*')
                                            ->from(TRANSFER_ORDERS.' as o')
                                            ->where('o.Request_ID', $request_id)
                                            ->order_by('o.Payment_Verified','desc')
                                            ->get()
                                            ->row();
        }

        return $order;
}


      public function getRequestInfo($domain_id,$admin_id,$token,$verify_code=''){

        if(!empty($verify_code)){
            $this->db->where('DCR_Verify_Token', $verify_code);
        }
             return   $this->db
                                            ->select('*')
                                            ->from(REQUEST)
                                            ->where('DCR_Domain_ID', $domain_id)
                                            ->where('DCR_Admin_ID', $admin_id)
                                            ->where('DCR_Verify_Page_Token', $token)                                            
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


     public function getRequesDetails($request_id,$customer_id){
              return   $this->db
                                            ->select('*')
                                            ->from(REQUEST.' as r') 
                                            ->join(DOMAIN.' as d', 'r.DCR_Domain_ID = d.Domain_ID')
                                            ->where('d.Customer_ID', $customer_id)
                                            ->where('r.DCR_ID', $request_id)
                                            ->get()
                                            ->row();
      }

    public function getUnpayedTransferOrderByID($order_id){
              return   $this->db
                                            ->select('*')
                                            ->from(TRANSFER_ORDERS.' as r') 
                                            ->join(TRANSFER.' as t', 't.DTI__ID = r.DTI_ID')
                                            ->where('r.DTO_ID', $order_id)
                                            ->get()
                                            ->row();

      }
          public function getUnpayedOrderByID($order_id){
              return   $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as r') 
                                            ->where('r.DO_ID', $order_id)
                                            ->get()
                                            ->row();
      }




    public function getRequestInfoByID($domain_id,$request_id,$customer_id){
             return   $this->db
                                            ->select('*')
                                            ->from(REQUEST.' as r')
                                            ->where('r.DCR_Domain_ID', $domain_id)
                                            ->where('r.DCR_USER_ID', $customer_id)                                            
                                            ->where('r.DCR_ID', $request_id)
                                            ->get()
                                            ->row();
      }

      public function delete_domain_notification($domain_id){
            $this->db->where('No_Domain_ID',$domain_id);
            $this->db->update(NOTIFICATIONS,['Is_Deleted'=>1]);
      }

      public function getDomainDetailsByID($domain_id,$customer_id){
               
           if($customer_id){
                $this->db->where('c.Customer_ID', $customer_id);
            }
        return   $this->db
                                    ->select('*')
                                    ->from(DOMAIN.' as d')
                                    ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = d.Customer_ID','left')
                                    ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                                    ->where('d.Domain_ID', $domain_id)                              
                                    ->get()
                                    ->row();
      
      

      }

      public function getMyDomains($customer_id){
         $domains =    $this->db
                                            ->select('d.*')
                                            ->from(DOMAIN.' as d')                                   
                                            ->where('d.Customer_ID', $customer_id)
                                            ->where('d.IS_Domain_Created', 1)
                                            ->where('d.Is_Deleted', 0) 
                                            ->where('d.Domain_Status !=', 'DELETED')                                            
                                            ->get()
                                            ->result();

                // foreach ($domains as $key => $domain) {
                //       /*get expire date*/
                //       $verified_renew = $this->getRenewVerifiedPayment($domain->Domain_ID);
                //       if(!empty($verified_renew)){
                //               $last_verified_renew = end($verified_renew);
                //               $expire_date = $last_verified_renew->Expire_Date;
                //       }else{
                //               $expire_date = $domain->Expire_Date;              
                //       }

                //       $domains[$key]->Expire_Date = $expire_date;
                // }



                return $domains;
   
              
      }
      
      public function getMyDomainsForProduct($customer_id){
         $domains =    $this->db
                                            ->select('d.Domain_ID')
                                            ->join(TBL_PRODUCT_SUBSCRIPTIONS.' as s',"`s`.`domain` = (CONCAT(d.Domain_Name,d.TLD)) AND s.Status = 'created'")
                                            ->from(DOMAIN.' as d')                                   
                                            ->where('d.Customer_ID', $customer_id)
                                            ->where('s.Customer_ID', $customer_id)
                                            ->where('d.IS_Domain_Created', 1)
                                            ->where('d.Is_Deleted', 0) 
                                            ->where('d.Domain_Status !=', 'DELETED')                                            
                                            ->group_by('d.Domain_ID')                                            
                                            ->get()
                                            ->result_array();
                return $domains;
   
              
      }

      public function getMyPurchases($customer_id){
            return  $this->db
                                            ->select('d.*,o.*')
                                            ->from(ORDERS.' as o')
                                            ->join(DOMAIN.' as d', 'o.Domain_ID = d.Domain_ID')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                                            ->where('d.Customer_ID', $customer_id)
                                            ->where('i.Admin_Cancel', 0) 
                                            ->where('o.Payment_Verified', 1) 
                                            ->order_by('o.DO_ID','desc')                                                                                      
                                            ->get()
                                            ->result();
      }

      public function getDomainsChangeRequests($customer_id){

          return  $this->db
                                            ->select('d.*,r.*')
                                            ->from(DOMAIN.' as d')
                                            //->join(DOMAIN_HIS.' as h', 'h.DH_ID = d.DH_ID')
                                            ->join(REQUEST.' as r', 'r.DCR_Domain_ID = d.Domain_ID')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                                            ->where('r.DCR_USER_ID', $customer_id)
                                            ->where('i.Admin_Cancel', 0)
                                            ->where('r.DCR_Status !=', 'deleted')                                            
                                           // ->where('d.IS_Domain_Created', 1) 
                                            ->order_by('r.DCR_ID','desc')                                          
                                            ->get()
                                            ->result();
      }

      public function getDomainTransferRequest($customer_id,$domain_name){
            $pending_transfer_requests =   $this->db
                                            ->select('r.*')
                                            ->from(REQUEST.' as r')
                                            ->where('r.DCR_USER_ID', $customer_id)
                                             ->where('r.DCR_Status', 'incomplete')


                                            ->where('r.DCR_Request_Type', 'domain_transfer_in')
                                            ->get()
                                            ->result();
            $result = '';

          
            foreach ($pending_transfer_requests as $key => $row) {
                    $post_data = json_decode($row->DCR_POST_DATA);
                    if($post_data->DTI_Domain_Name_Query == $domain_name){
                        $result  = $row;
                    }
            }

            return $result;

      }


     public function getDomainTransferRequestInfo($customer_id,$domain_name,$status='incomplete'){
            $pending_transfer_requests =   $this->db
                                            ->select('r.*')
                                            ->from(REQUEST.' as r')
                                            ->where('r.DCR_USER_ID', $customer_id)
                                            ->where('r.DCR_Status', $status)                                            
                                            ->where('r.DCR_Request_Type', 'domain_transfer_in')
                                            ->get()
                                            ->result();
            $result = '';
            foreach ($pending_transfer_requests as $key => $row) {
                    $post_data = json_decode($row->DCR_POST_DATA);
                    if($post_data->DTI_Domain_Name_Query == $domain_name){
                        $result  = $row;
                    }
            }
            return $result;

      }


     public function getAllPayedTransferRequests($customer_id){
          return  $this->db
                                            ->select('t.*,o.*')
                                            ->from(TRANSFER.' as t')
                                            ->join(TRANSFER_ORDERS.' as o', 't.DTI__ID = o.DTI_ID')
                                            ->where('t.DTI_Customer_ID', $customer_id)
                                            ->where('o.Payment_Verified', 1)
                                            ->order_by('t.DTI__ID','desc')                                          
                                            ->get()
                                            ->result();
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

     }

    public function getRequestByDomainName($domain_name,$status='PENDING',$payment_verified = 1){
       return  $this->db
                                            ->select('*')
                                            ->from(TRANSFER.' as t')
                                            ->join(TRANSFER_ORDERS.' as o', 't.DTI__ID = o.DTI_ID')
                                            ->like('t.DTI_Domain_Name_Query', $domain_name)
                                            ->where('o.Payment_Verified', $payment_verified)
                                            ->where('t.DTI_Status', $status)                                                            
                                            ->get()
                                            ->row();

     }

    public function getRequestOrderDetails($domain_name,$status='PENDING'){
        $order =  $this->db
                                            ->select('*')
                                            ->from(TRANSFER.' as t')
                                            ->join(TRANSFER_ORDERS.' as o', 't.DTI__ID = o.DTI_ID')
                                            ->like('t.DTI_Domain_Name_Query', $domain_name)
                                            ->where('o.Payment_Verified', 1)
                                            ->where('t.DTI_Status', $status)                                                            
                                            ->get()
                                            ->row();
        if(empty($order)){
           $order =   $this->db
                                            ->select('*')
                                            ->from(TRANSFER.' as t')
                                            ->join(TRANSFER_ORDERS.' as o', 't.DTI__ID = o.DTI_ID')
                                            ->like('t.DTI_Domain_Name_Query', $domain_name)
                                            ->where('o.Payment_Verified', 0)
                                            ->where('t.DTI_Status', $status)                                                            
                                            ->get()
                                            ->row();
        }
        return $order;
     }

     public function getLastUnpayedOrder($domain_id,$order_type){
                    $order =   $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as o')
                                            ->where('o.Domain_ID', $domain_id)
                                            ->where('o.Order_Type', $order_type)
                                            ->where('o.Payment_Verified', 1)
                                            ->order_by('Created_AT', 'DESC')
                                            ->get()
                                            ->row();
                    if(empty($order)){
                        $order =   $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as o')
                                            ->where('o.Domain_ID', $domain_id)
                                            ->where('o.Order_Type', $order_type)
                                            ->where('o.Payment_Verified', 0)
                                            ->order_by('Created_AT', 'DESC')
                                            ->get()
                                            ->row();
                    }
            return $order;
     }


    public function getRequestByDomainNameV2($domain_name,$status='PENDING'){
          return  $this->db
                                            ->select('*')
                                            ->from(TRANSFER.' as t')
                                            ->like('t.DTI_Domain_Name_Query', $domain_name)
                                            ->where('t.DTI_Status', $status)                                                            
                                            ->get()
                                            ->row();
     }



    public function getAllDomainTransfer($status = 'APPROVED'){
          return  $this->db
                                            ->select('*')
                                            ->from(TRANSFER.' as t')
                                            ->join(TRANSFER_ORDERS.' as o', 't.DTI__ID = o.DTI_ID')
                                            ->where('o.Payment_Verified', 1)
                                            ->where('t.DTI_Status', $status)                                                            
                                            ->get()
                                            ->result();
     }

    public function getAllPendingTransferEmail($status = 'PENDING'){
          return  $this->db
                                            ->select('*')
                                            ->from(TRANSFER.' as t')
                                            ->where('t.is_email_sent', 0)
                                            ->where('t.DTI_Status', $status)                                                            
                                            ->get()
                                            ->result();
     }

    public function getAllPendingRequestReminder(){
          return  $this->db
                                            ->select('*')
                                            ->from(REQUEST.' as r')
                                            ->join(DOMAIN.' as d', 'd.Domain_ID = r.DCR_Domain_ID','left') 
                                            ->where("DATE(r.DCR_Created_At) + INTERVAL 2 DAY < NOW() ")
                                            ->where('r.Email_Reminder_Sent',0)
                                            ->group_start()
                                            ->where('r.DCR_Status', 'pending')
                                            ->or_where('r.DCR_Status', 'incomplete')
                                            ->group_end()
                                            ->order_by('r.DCR_Created_At','desc')
                                            ->get()
                                            ->result();
     }



    public function getAllPendingRequestForCancel(){
          return  $this->db
                                            ->select('*')
                                            ->from(REQUEST.' as r')
                                            ->join(DOMAIN.' as d', 'd.Domain_ID = r.DCR_Domain_ID','left')
                                            ->join(ORDERS.' as o','o.Request_ID = r.DCR_ID','left')                                                                       
                                            ->join(TRANSFER_ORDERS.' as to', 'to.Request_ID = r.DCR_ID','left')
                                            ->join(TRANSFER.' as t', 't.DTI__ID = to.DTI_ID','left')

                                            ->group_start()
                                            ->where("o.Payment_Verified",NULL)
                                            ->or_where("o.Payment_Verified",0)
                                            ->group_end()

                                            ->group_start()
                                            ->where("to.Payment_Verified",NULL)
                                            ->or_where("to.Payment_Verified",0)
                                            ->group_end()
                                                                               
                                            ->where("DATE(r.DCR_Created_At) + INTERVAL 3 DAY < NOW() ")

                                            ->group_start()
                                            ->where('r.DCR_Status', 'pending')
                                            ->or_where('r.DCR_Status', 'incomplete')
                                            ->group_end()
                                            
                                            ->limit(10)
                                            ->order_by('r.DCR_Created_At','desc')
                                            ->group_by('r.DCR_ID')                                            

                                            ->get()
                                            ->result();
     }

    public function getIncompletedApplication($domain_name,$tld_name, $user_id){

            return   $this->db
                                            ->select('*')
                                            ->from(REQUEST.' as r')
                                            ->join(DOMAIN.' as d', 'd.Domain_ID = r.DCR_Domain_ID','left')
                                            ->where('r.DCR_Request_Type', 'create_domain')
                                            ->where('r.DCR_Status', 'incomplete')
                                            ->where('d.Domain_Name', $domain_name)
                                            ->where('d.TLD', $tld_name)
                                            ->where('r.DCR_USER_ID', $user_id)
                                            ->get()
                                            ->row();

    }

    public function getPendingDeleteDomains(){
          return  $this->db
                                            ->select('*')
                                            ->from(DOMAIN.' as d')
                                            ->where('d.Domain_Status', 'PENDING DELETE')                    
                                            ->get()
                                            ->result();
     }

    public function getCreateRequestByDomainID($domain_id){
            return   $this->db
                                            ->select('*')
                                            ->from(REQUEST.' as r')
                                            ->where('r.DCR_Request_Type', 'create_domain')
                                            ->where('r.DCR_Domain_ID', $domain_id)
                                            ->group_start()
                                            ->where('r.DCR_Status', 'pending')
                                            ->or_where('r.DCR_Status', 'need_modification')
                                            ->or_where('r.DCR_Status', 'incomplete')
                                            ->group_end()
                                            ->order_by('r.DCR_ID','desc')
                                            ->get()
                                            ->row();
    }

    public function getIncompleteCreateRequestByDomainID($domain_id){
        return   $this->db
                                        ->select('*')
                                        ->from(REQUEST.' as r')
                                        ->where('r.DCR_Request_Type', 'create_domain')
                                        ->where('r.DCR_Domain_ID', $domain_id)
                                        ->group_start()
                                        ->where('r.DCR_Status', 'pending')
                                        ->or_where('r.DCR_Status', 'need_modification')
                                        ->or_where('r.DCR_Status', 'incomplete')
                                        ->group_end()
                                        ->order_by('r.DCR_ID','desc')
                                        ->get()
                                        ->row();
    }

     public function getApplications($customer_id,$domain_id=0){


         return   $this->db
                                            ->select('c.*,d.*,i.*,h.LTD_History')
                                            ->from(DOMAIN.' as d')
                                            ->join(DOMAIN_HIS.' as h', 'h.DH_ID = d.DH_ID')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                                            ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = d.Customer_ID','left')
                                            ->where('d.Customer_ID', $customer_id)
                                            ->where('d.Domain_ID',$domain_id)

                                            ->where('i.Admin_Cancel', 0)
                                           
                                            ->get()
                                            ->result();
        
              
      }



          public function get_domain_waiver_by_id($dw_id,$domain_id=0,$status = 'NEW'){

                  return    $this->db
                                            ->select('*')
                                            ->from(WAIVERS.' as w')                                          
                                            ->where('w.DW_ID', $dw_id)
                                            ->where('w.DW_Domain_ID', $domain_id)
                                            ->where('w.DW_Status', $status)
                                            ->order_by('w.DW_ID','desc')                                           
                                            ->get()
                                            ->row();

          }
        public function get_domain_waiver($customer_id,$domain_id=0,$status = 'NEW'){

         $waiver =    $this->db
                                            ->select('*')
                                            ->from(WAIVERS.' as w')                                          
                                            ->where('w.DW_Customer_ID', $customer_id)
                                            ->where('w.DW_Domain_ID', $domain_id)
                                            ->where('w.DW_Status', $status)
                                            ->order_by('w.DW_ID','desc')                                           
                                            ->get()
                                            ->row();
        // if(empty($waiver)){
        //        $waiver =  $this->insert_waiver($customer_id,$domain_id);
        // }

        return $waiver;
        
              
      }

      private function insert_waiver($customer_id,$domain_id=0){
        $data = ['DW_Customer_ID'=>$customer_id,
                   'DW_Domain_ID'=>$domain_id];
        $this->db->insert(WAIVERS,$data);

         return    $this->db
                                            ->select('*')
                                            ->from(WAIVERS.' as w')                                           
                                            ->where('w.DW_Customer_ID', $customer_id)
                                            ->where('w.DW_Domain_ID', $domain_id)
                                            ->where('w.DW_Status', 'NEW')
                                            ->order_by('w.DW_ID','desc')                                           
                                            ->get()
                                            ->row();

      }

      public function getDomainHistory($dh_id){
        return   $this->db
                                            ->select('*')
                                            ->from(DOMAIN_HIS.' as d')
                                            ->where('d.DH_ID', $dh_id)
                                            ->get()
                                            ->row();

      }

      public function getCustumerDiscount($custumer_id,$discount_type=''){
        $individual_discount =   $this->db
                                            ->select('cd.*')
                                            ->from(TBL_CUSTOMERS.' as c')
                                            ->join(TBL_CUSTOMERS_DISCOUNTS.' as cd', 'cd.d_id = c.Discount_ID')
                                            ->where('c.Customer_ID', $custumer_id)
                                            ->where('cd.Status',1)
                                            ->where('cd.d_category', 'individual')                                            
                                            ->get()
                                            ->row();
    $group_discount = '';                                            
    if(!empty($discount_type)){
       $group_discount =   $this->db
                                            ->select('cd.*')
                                            ->from(TBL_CUSTOMERS_DISCOUNTS.' as cd')
                                            ->where('cd.Status', 1)
                                            ->where('cd.Start_Date <=', date('Y-m-d'))
                                            ->where('cd.End_Date >=', date('Y-m-d'))
                                            ->where("FIND_IN_SET('".$discount_type."',cd.d_type) >",0)
                                            ->where('cd.d_category', 'group')                                            
                                            ->get()
                                            ->row();
    }                                            

        if(!empty($individual_discount) && !empty($group_discount)){
            if($individual_discount->d_value > $group_discount->d_value){
                return $individual_discount;
            }else{
                return $group_discount;                 
            }
        }elseif(!empty($individual_discount) && empty($group_discount)){

            return $individual_discount;

        }elseif(empty($individual_discount) && !empty($group_discount)){

            return $group_discount;

        }else{
            return null;
        }



      }

      public function getAppLogByDomainID($domain_id,$status){

        return   $this->db
                                            ->select('*')
                                            ->from(APP_LOG)
                                            ->where('DAL_Domain_ID', $domain_id)
                                            ->where('DAL_Status', $status)                                                                                                                                   
                                            ->get()
                                            ->num_rows();
      }

    public function getAppLogDetailsByDomainID($domain_id,$status){

        return   $this->db
                                            ->select('*')
                                            ->from(APP_LOG)
                                            ->where('DAL_Domain_ID', $domain_id)
                                            ->where('DAL_Status', $status) 
                                            ->order_by('DAL_ID','desc')                                                                                                                                  
                                            ->get()
                                            ->row();
      }

      public function getRegistrationVerifiedPayment($domain_id){

                 return   $this->db
                                            ->select('*')
                                            ->from(ORDERS)
                                            ->where('Payment_Verified', 1)
                                            ->where('Payment_Refunded', 0)                                            
                                            ->where('Domain_ID', $domain_id)
                                            ->where('Order_Type', 'registration_domain')                                            
                                            ->get()
                                            ->num_rows();
      }


    public function getTransferVerifiedPayment($domain_id){

                 return   $this->db
                                            ->select('*')
                                            ->from(TRANSFER_ORDERS)
                                            ->where('Payment_Verified', 1)
                                            ->where('Payment_Refunded', 0)  
                                            ->where('Domain_ID', $domain_id)
                                            
                                            ->get()
                                            ->num_rows();
      }

      

    public function getRenewVerifiedPayment($domain_id){

                 return   $this->db
                                            ->select('*')
                                            ->from(ORDERS)
                                            ->where('Payment_Verified', 1)
                                            ->where('Domain_ID', $domain_id)
                                            ->where('Order_Type', 'renew')                                            
                                            ->get()
                                            ->result();
      }

      public function reset_OTP_Status($user_id){

            $this->db->where('Org_Usr_ID',$user_id);
            $this->db->update(USERS,['Phone_verified'=>0,'Is_SMS_Sent'=>0]);
            return $this->db->affected_rows();


      }


    public function resetRequestAdminOtp($domain_id,$admin_id,$token){

            $this->db->where('DCR_Verify_Page_Token',$token);
            $this->db->where('DCR_Domain_ID',$domain_id);
            $this->db->where('DCR_Admin_ID',$admin_id);

            $this->db->update(REQUEST,['DCR_Phone_Verified'=>0,'DCR_IS_SMS_Send'=>0]);
            return $this->db->affected_rows();


      }

      public function makeDisableAllPreviousRequest($type=null,$domain_id,$status,$new_status='deleted'){
            
            if(!empty($type)){
                $this->db->where('DCR_Request_Type',$type);
            }
                        
            $this->db->where('DCR_Domain_ID',$domain_id);
            $this->db->where('DCR_Status',$status);

            $this->db->update(REQUEST,['DCR_Status'=>$new_status]);
            return $this->db->affected_rows();

      }

    public function getRequestByType($type=null,$domain_id,$status){
            
               return   $this->db
                                            ->select('*')
                                            ->from(REQUEST.' as r') 
                                            ->where('r.DCR_Request_Type', $type)
                                            ->where('r.DCR_Domain_ID', $domain_id)
                                            ->where('r.DCR_Status', $status)
                                            ->order_by('r.DCR_ID','desc')
                                            ->get()
                                            ->row();

      }


      public function getDomainOrgUsers($domain_id,$user_type = '',$reset = 0,$verify_code=''){

            if(!empty($verify_code)){
                $this->db->where('Verify_Token',$verify_code);
            }

             if($user_type == 'Registrar'){
                        $users =  $this->db
                                            ->select('i.*,u.*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();

                        /* this is for the old data */
                        if(empty($users)){
                              $users =  $this->db
                                            ->select('i.*,u.*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Org_Usr_ID = i.Registrar_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                        }

                       if($reset){
                          $this->reset_OTP_Status($users->Org_Usr_ID);
                       }
                }


                

               if($user_type == 'Admin'){
                        $users =  $this->db
                                            ->select('i.*,u.*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Admin_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                        /* this is for the old data */
                        if(empty($users)){


                              $users =  $this->db
                                            ->select('i.*,u.*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Org_Usr_ID = i.Admin_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                        }
                        if($reset){
                          $this->reset_OTP_Status($users->Org_Usr_ID);
                       }
                }




                if($user_type == 'Financial'){
                        $users =  $this->db
                                            ->select('i.*,u.*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Financial_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                       /* this is for the old data */
                        if(empty($users)){
                               $users =  $this->db
                                            ->select('i.*,u.*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Org_Usr_ID = i.Financial_ID')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                        }
                       if($reset){
                          $this->reset_OTP_Status($users->Org_Usr_ID);
                       }
                }



                if($user_type == 'Technical'){
                        $users =  $this->db
                                            ->select('i.*,u.*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Technical_ID','left')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                        /* this is for the old data */
                        if(empty($users)){
                               $users =  $this->db
                                            ->select('i.*,u.*')
                                            ->from(INFO.' as i')
                                            ->join(USERS.' as u', 'u.Org_Usr_ID = i.Technical_ID','left')  
                                            ->where('i.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();
                        }
                        if($reset){
                          $this->reset_OTP_Status($users->Org_Usr_ID);
                       }
                }

            return $users;
            
      }

      public function getDomainDetailsByDomainName($domain_name,$tld_name){

                   $domain =  $this->db
                                       ->select('i.*,u.*,d.*')
                                       ->from(INFO.' as i')
                                       ->join(USERS.' as u', 'u.Epp_ID = i.Admin_ID')
                                       ->join(DOMAIN.' as d', 'd.Domain_ID = i.Domain_ID')  
                                       ->where('d.Domain_Name', $domain_name)
                                       ->where('d.TLD', $tld_name)
                                       ->where('d.Domain_Status', 'Done')
                                       ->get()
                                       ->row();

                   /* this is for the old data */
                   // if(empty($users)){


                   //       $domain =  $this->db
                   //                     ->select('i.*,u.*,d.*')
                   //                     ->from(INFO.' as i')
                   //                     ->join(USERS.' as u', 'u.Org_Usr_ID = i.Admin_ID')  
                   //                     ->join(DOMAIN.' as d', 'd.Domain_ID = i.Domain_ID')  
                   //                     ->where('d.Domain_Name', $domain_name)
                   //                     ->where('d.TLD', $tld_name)
                   //                     ->where('d.Domain_Status', 'Done')
                   //                     ->get()
                   //                     ->row();
                   // }


       return $domain;
       
      }
 
      public function getNicPendingDomainDetailsByDomainName($domain_name,$tld_name){

        $domain =  $this->db
                            ->select('i.*,u.*,d.*')
                            ->from(INFO.' as i')
                            ->join(USERS.' as u', 'u.Epp_ID = i.Admin_ID')
                            ->join(DOMAIN.' as d', 'd.Domain_ID = i.Domain_ID')  
                            ->where('d.Domain_Name', $domain_name)
                            ->where('d.TLD', $tld_name)
                            ->where('d.Domain_Status', 'NIC PENDING')
                            ->get()
                            ->row();


      return $domain;

      }

      public function get_last_restore_request($domain_id){
             return $this->db
                                            ->select('*')
                                            ->from(REQUEST)
                                            ->where('DCR_Domain_ID', $domain_id)
                                            ->where('DCR_Request_Type', 'restore_domain')
                                            ->where('DCR_Status', 'pending')                                            
                                            ->limit(1)
                                            ->order_by('DCR_ID','desc')
                                            ->get()
                                            ->row();
      }

      public function updateDomainInfo($info_id,$data){
            $this->db->where('DINFO_ID',$info_id);
            $this->db->update(INFO,$data);
            return $this->db->affected_rows();
      }

    public function approveRequestByAdmin($request_id){
            $this->db->where('DCR_ID',$request_id);
            $data = array('DCR_Admin_Approve'=> 1);
            $this->db->update(REQUEST,$data);
            return $this->db->affected_rows();
      }

         public function updateDomainUserInfo($user_id,$data){
            $this->db->where('Org_Usr_ID',$user_id);
            $this->db->update(USERS,$data);
            return $this->db->affected_rows();
      }

     public function updateRequestInfo($admin_id,$token,$data){
            $this->db->where('DCR_Admin_ID',$admin_id);
            $this->db->where('DCR_Verify_Page_Token',$token);            
            $this->db->update(REQUEST,$data);
            return $this->db->affected_rows();
      }

      public function getTransferRequest($data,$status='',$is_phone_verified=''){

        if(isset($data['verify_code']) && !empty($data['verify_code'])){
            $this->db->where('t.DCR_Verify_Token', $data['verify_code']);
        }
        if(isset($status) && !empty($status)){
            $this->db->where('t.DTI_Status', $status);
        }
        if(!empty($is_phone_verified)){
            $this->db->where('t.DCR_Phone_Verified', $is_phone_verified);
        }
        if(!empty($data['page_token'])){
            $this->db->where('t.DCR_Verify_Page_Token', $data['page_token']);
        }

                  return   $this->db
                                    ->select('*')
                                    ->from(TRANSFER.' as t')
                                    ->where('t.DTI__ID', $data['id'])
                                    ->where('t.DTI_Customer_ID', $data['c_id'])
                                    
                                    //->where('t.DTI_Status', $status)                                                                                                            
                                    ->get()
                                    ->row();
      }

      public function updateTransferRequestInfo($id,$data){
            $this->db->where('DTI__ID',$id);            
            $this->db->update(TRANSFER,$data);
            return $this->db->affected_rows();
      }

                public function getdomainByIDV2($domain_id = 0){
                 return  $this->db
                                            ->select('*')
                                            ->from(DOMAIN.' as d')
                                            ->join('customers as c', 'c.Customer_ID = d.Customer_ID','left')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID','left')
                                            ->where('d.Domain_ID', $domain_id)
                                            ->get()
                                            ->row();


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

    public function getDocsTypeByID($id){
                return  $this->db
                                                ->select("*")
                                            ->from("doc_types as ty")
                                        ->join('doc_issures as iss', 'iss.Doc_Issures_ID = ty.Issuer_ID','left')
                                                ->where('ty.Status',1)
                                                ->where('ty.id',$id)
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
    public function getIssuersByID($issuer_id){
                return  $this->db
                                                ->select("*")
                                                ->from("doc_issures")
                                                ->where('Status',1)
                                                ->where('Doc_Issures_ID',$issuer_id)
                                                ->get()
                                                ->row();
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

            public function addAPISLog($log = array())
    {
        $this->db->insert('apis_log', $log);
    }

    public function getDomainOrderByReferancePayment($payment_referance){
                  return   $this->db
                                            ->select('*,d.expire_date as domain_expire_date')
                                            ->from(ORDERS.' as o')       
                                            ->join(DOMAIN.' as d', 'd.Domain_ID = o.Domain_ID','left')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID') 
                                            ->where('o.Payment_Referance', $payment_referance)
                                            ->get()
                                            ->row();
    }


        public function getCreateDomainOrder($domain_id){
                  return   $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as o')
                                            ->join(USERS.' as u', 'u.Org_Usr_ID = o.Customer_ID','right')
                                            ->join(DOMAIN.' as d', 'd.Domain_ID = o.Domain_ID')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                                            ->where('o.Domain_ID', $domain_id)
                                            ->where('o.Order_Type', 'registration_domain')
                                            ->get()
                                            ->row();
    }


    public function getTransferDomainOrder($order_id){
                  return   $this->db
                                            ->select('*,o.DTO_Created as Created_AT ,o.DTO_Payed_At as Payed_AT ,o.DTO_ID as DO_ID ,t.DTI_Domain_Name as Domain_Name ,t.DTI_TLD as TLD  ')
                                            ->from(TRANSFER_ORDERS.' as o')
                                            ->join(TRANSFER.' as t', 't.DTI__ID = o.DTI_ID','right')
                                            
                                            ->where('o.DTO_ID', $order_id)
                                            ->where('o.Payment_Verified', 1)
                                            ->get()
                                            ->row();
    }
    public function getTransferDomainOrderV2($order_id,$customer_id){
                  return   $this->db
                                            ->select('*,o.DTO_Created as Created_AT ,o.DTO_Payed_At as Payed_AT ,o.DTO_ID as DO_ID ,t.DTI_Domain_Name as Domain_Name ,t.DTI_TLD as TLD  ')
                                            ->from(TRANSFER_ORDERS.' as o')
                                            ->join(TRANSFER.' as t', 't.DTI__ID = o.DTI_ID','right')
                                            ->where('t.DTI_Customer_ID',$customer_id)
                                            ->where('o.DTO_ID', $order_id)
                                            ->where('o.Payment_Verified', 1)
                                            ->get()
                                            ->row();
    }

    public function getTransferDomainRequest($request_id){
        return   $this->db
                                  ->select('*')
                                  ->from(TRANSFER.' as t')                                  
                                  ->where('t.Request_ID', $request_id)
                                  ->get()
                                  ->row();
    }


        public function getTransferOrderByReferancePayment($payment_referance){
                  return   $this->db
                                            ->select('*')
                                            ->from(TRANSFER_ORDERS.' as o')
                                            ->join(TRANSFER.' as t', 't.DTI__ID = o.DTI_ID','right')
                                            ->join(TBL_CUSTOMERS.' as c', 'o.Customer_ID = c.Customer_ID','right')
                                            ->where('o.Payment_Referance', $payment_referance)
                                            ->get()
                                            ->row();
    }

    public function getOrderDetails($order_id){
                 return   $this->db
                                            ->select('*')
                                            ->from(ORDERS.' as o')
                                            ->join(DOMAIN.' as d', 'd.Domain_ID = o.Domain_ID','left')
                                            ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                                            ->join(USERS.' as u', 'u.Epp_ID = i.Registrar_ID') 
                                            ->join(REQUEST.' as r', 'r.DCR_ID = o.Request_ID','left')
                                            ->where('o.OR_ID', $order_id)
                                            ->get()
                                            ->row();
    }

    public function getInvoiceDetails($customer_id,$order_id,$type){

            

            if($type){
                if($type == 3){
                    $details =  $this->db
                            ->select('*,o.Order_ID as DO_ID, o.Subscription_ID as Request_ID, VAT as Vat, domain as Domain_Name, period as Period, s.timestamp as DTO_Created, s.Expires_At Expire_Date, Fullname Full_Name')
                            ->from(TBL_ORDERS.' as o')
                            ->join(TBL_PRODUCT_SUBSCRIPTIONS.' as s', 's.Subscription_ID =o.Subscription_ID')
                            ->join(TBL_PRODUCTS.' as p', 'p.Product_ID = s.Product_ID')
                            ->join(TBL_CUSTOMERS.' as c', 's.Customer_ID = c.Customer_ID')
                            ->where('s.Customer_ID', $customer_id)
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
                            ->where('o.Customer_ID', $customer_id)
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
                                            ->where('o.Customer_ID', $customer_id)
                                            ->where('o.DO_ID', $order_id)
                                            ->get()
                                            ->row();
            }

            return $details;
    }

    public function getTransferOrderDetails($order_id){
                 return   $this->db
                                            ->select('*')
                                            ->from(TRANSFER_ORDERS.' as o')
                                            ->join('customers as c', 'c.Customer_ID = o.Customer_ID')                                          
                                            ->where('o.DTO_ID', $order_id)
                                            ->get()
                                            ->row();
    }


    public function getTransferRequestByID($tr_id,$customer_id=0){

        if($customer_id){
                 $this->db->where('DTI_Customer_ID', $customer_id);
        }
                 return   $this->db
                                            ->select('*')
                                            ->from(TRANSFER)                                          
                                            ->where('DTI__ID', $tr_id)
                                            ->get()
                                            ->row();
    }

    public function getTransferRequestByRequestID($request_id,$customer_id){

                 return   $this->db
                                            ->select('*')
                                            ->from(TRANSFER)                                          
                                            ->where('Request_ID', $request_id)
                                            ->where('DTI_Customer_ID', $customer_id)
                                            ->get()
                                            ->row();
    }
    

       public function get_all($where,$fileds,$order_by,$table){
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

    public    function get_one($where, $fileds, $table) {
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




    // START Dashbord models
    public function getNumOfAciveDomains($customer_id){
               

        return   $this->db
                                    ->select('*')
                                    ->from(DOMAIN.' as d')
                                    ->join(INFO.' as i', 'i.Domain_ID = d.Domain_ID')
                                    ->where('d.Customer_ID', $customer_id)
                                    ->where('d.Status', 1)
                                    ->where('d.Domain_Status', 'Done')
                                    ->where('d.IS_Domain_Created', 1)
                                    ->get()
                                    ->num_rows();
      
      

      }

      public function getNumOfUncompletedOrders($customer_id){
               

        return   $this->db
                                    ->select('*')
                                    ->from(REQUEST.' as r')
                                    ->join(DOMAIN.' as d', 'd.Domain_ID = r.DCR_Domain_ID','left')
                                    ->where('r.DCR_USER_ID', $customer_id)
                                    ->where('r.DCR_Status !=', 'approved')
                                    ->where('r.DCR_Status !=', 'canceled')
                                    ->where('r.DCR_Status !=', 'deleted')
                                    ->where('r.DCR_Status !=', 'refused')
                                    ->get()
                                    ->num_rows();
      
      

      }

      public function getNumOfOpenTickets($customer_id){
               

        return   $this->db
                                    ->select('*')
                                    ->from(TBL_CUST_TICKETS.' as ct')
                                    ->where('ct.CustomerId', $customer_id)
                                    ->where('ct.Status !=', 'Closed')
                                    ->get()
                                    ->num_rows();
      
      

      }

      public function getExpiredDomains($customer_id,$current_date){
               

        return   $this->db
                                    ->select('*')
                                    ->from(DOMAIN.' as d')
                                    ->where('d.Customer_ID', $customer_id)
                                    ->where('d.Expire_Date <', $current_date)
                                    ->where("DATEDIFF('$current_date', d.Expire_Date) <", 35)
                                    ->where('d.IS_Domain_Created', 1)
                                    ->get()
                                    ->result();
      
      

      }

      public function getUpcommingExpiredDomains($customer_id,$current_date){
               

        return   $this->db
                                    ->select('*')
                                    ->from(DOMAIN.' as d')
                                    ->where('d.Customer_ID', $customer_id)
                                    ->where('d.Expire_Date >=', $current_date)
                                    ->where("DATEDIFF(d.Expire_Date, '$current_date') <", 30)
                                    ->where('d.IS_Domain_Created', 1)
                                    ->get()
                                    ->result();
      
      

      }

      public function getAllDomains(){
               

        return   $this->db
                                    ->select('*')
                                    ->from(DOMAIN.' as d')
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
                                                        ->join('doc_types as c', 'c.Doc_Type_ID = d.Doc_Type_ID')
                                                        ->join('doc_issures as ds', 'ds.Doc_Issures_ID = c.Issuer_ID OR ds.Doc_Issures_ID = d.Doc_Issures_ID','left')
                                                        ->where('d.Domain_ID', $domain_id)
                                                        ->where('d.Doc_Type', 'support')
                                                        ->limit(1)
                                                        ->order_by('d.Domain_Doc_ID','desc')
                                                        ->get()
                                                        ->row();
                          
                            return $domain;
    }

    // END Dashbord models



    }

?>