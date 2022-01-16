<?PHP
class Address_model extends CI_Model{
    
    public function get($customer_id = 0, $address_id = 0)
    {
	    if($address_id)
	    {
			$this->db->where('a.Address_ID', $address_id);    
	    }
	    $addresses = $this->db
	    					->select('a.*, d.District_en, d.District_ar')
	    					->from('customer_delivery_addresses as a')
	    					->join('districts as d', 'd.District_ID = a.discrit', 'LEFT')
	    					->where('a.Customer_ID', $customer_id)
	    					->where('a.is_deleted', 0)
	    					->order_by('a.Address_ID','desc')
	    					->get();
	    
	    //echo $this->db->last_query(); die();
	    
	    if($address_id)
	    {
		    return $addresses->row();
	    }
	    
	    return $addresses->result();
    }
    
    public function add($address = array())
    {
	    $this->db->insert('customer_delivery_addresses', $address);
	    return  $this->db->insert_id();
	    
    }


    function get_installtion_feature($City_ID){
                     $installation = $this->db
                            ->select('*')
                            ->from('installation_price')
                            ->where('City_ID', $City_ID)
                            ->where('Status', 1)
                            ->where('Is_Deleted', 0)
                            ->get();
                return $installation->row();
    }

        function get_related_discrets($City_ID,$lang){
            $district = 'District_'.$lang;
                     $districts = $this->db
                            ->select('District_ID,'.$district.' as discrit_name')
                            ->from('districts')
                            ->where('City_ID', $City_ID)
                            ->get();
                return $districts->result();
    }


    function insert($table,$data){
                  $this->db->insert($table,$data);
            $insert_id = $this->db->insert_id();
             return  $insert_id;
    }

        function save($data,$where,$table){
            $this->db->reset_query();
            $this->db->where($where);
            $this->db->update($table,$data);
            return $this->db->affected_rows();

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

    
    public function registerCustomer($customer = array()){

        $cus = $this->db->where('Email', $customer['Email'])->where('Phone', $customer['Phone'])->get('customers')->row();
        if(count($cus) > 0){
            return $cus->Customer_ID;
        }
        
        $this->db->insert('customers', $customer);
        return $this->db->insert_id();
    }




    public function update($address = array())
    {
	    return $this->db
			    		->where('Address_ID', $address['Address_ID'])
			    		->where('Customer_ID', $address['Customer_ID'])
			    		->update('customer_delivery_addresses', $address);
    }
    
    public function delete($customer_id = 0, $address_id = 0)
    {
	    return $this->db
			    		->where('Address_ID', $address_id)
			    		->where('Customer_ID', $customer_id)
			    		->delete('customer_delivery_addresses');
    }
}
?>