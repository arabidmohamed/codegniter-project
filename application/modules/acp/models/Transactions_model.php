<?PHP
	class Transactions_model extends CI_Model
	{
		
		/**
            *------- data List *---------
        **/

        var $order_columns_1  = array('sh.CS_ID', 'sh.Timestamp', 'c.Fullname', 'c.Email', 'sp.Plan_Name', 'sh.Status');
        private function _get_data_query()
        {
            $where_customer = '';
            $where_phone = '';
            $where_name = '';
            $where_email = '';
            $where_status = '';
            
            if(!empty($_POST['customer_name'])){
                $name = trim($_POST['customer_name']);
                $where_name = "c.Fullname LIKE '%{$name}%' AND";
            }
            
            if(!empty($_POST['email'])){
                $email = trim($_POST['email']);
                $where_email = "c.Email LIKE '%{$email}%' AND";
            }
            
            if(!empty($_POST['phone'])){
                $phone = trim($_POST['phone']);
                $where_phone = "c.Phone LIKE '%{$phone}%' AND";
            }
            
            if($_POST['status'] != -1){
                $status = trim($_POST['status']);
                $where_status = "sh.Payment_Verified = {$status} AND";
            }
            
            $where = "{$where_email} {$where_phone} {$where_name} {$where_status} sh.Payment_Type = 'transfer'";
            
            $this->db->distinct();
            $this->db->select('sh.*, c.Fullname, c.Email, sp.Plan_Name'); 
            $this->db->from('customer_subscription_history AS sh');
            $this->db->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = sh.Customer_ID');
			$this->db->join('subscription_plans as sp', 'sp.Plan_ID = sh.Plan_ID');
	            
            $this->db->where($where);
            $this->db->group_by('sh.CS_ID');
            
            //print_r($_POST['order']);
            if(isset($_POST['order']))
            {
                $ind = $_POST['order'][0]['column'];
                $oColumn = $this->order_columns_1[$ind];
                $direction = $_POST['order'][0]['dir'];
                $where_order = "$oColumn $direction";
                $this->db->order_by($where_order);
            } else {
                $this->db->order_by("sh.CS_ID", "DESC");
            }
        }
    
        function getDataList()
        {
            $this->_get_data_query();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

            $query = $this->db->get();
            
            //echo $this->db->last_query();
            return $query->result();
        }
    
        function Count_filtered()
        {
            $this->_get_data_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
    
        public function Count_all()
        {
            $this->_get_data_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
        
	}
?>