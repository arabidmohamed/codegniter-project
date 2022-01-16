<?PHP
	class Promocode_model extends CI_Model
	{
		public function add($promo = array())
		{
			$query = $this->db->insert('promo_codes', $promo);
			return $this->db->insert_id();
		}
		
		public function getByID($id = '')
		{
			$this->db->where('ID', $id);
			return $this->db->get('promo_codes')->row();
		}
		
		public function update($promo = array()){
			$this->db->where('ID', $promo['ID']);
			return $this->db->update('promo_codes', $promo);
		}
		
		public function delete($id = ''){
			$this->db->where('ID', $id);
			$delete = array('Delete_Status' => 1);
			$query = $this->db->update('promo_codes', $delete);
			return $query;
		}
		
		/*-----------------------------------------------------------
		---------------------- Departments List -----------------
		--------------------------------------------------------*/
		
		var $order_columns_1  = array('ID', 'Timestamp', 'Code', 'Title', 'StartDate', 'EndDate', 'DiscountValue', 'Status');
		private function _get_promos_query()
		{
			$where_code = '';
			$where_applyOn = '';
			
			if(!empty($_POST['code']))
			{
				$code = $_POST['code'];
				$where_code = "Code LIKE '%{$code}%' AND";
			}
			
			if(!empty($_POST['apply_on']))
			{
				$apply_on = $_POST['apply_on'];
				$where_applyOn = "Code LIKE '%{$apply_on}%' AND";
			}
		
			$where = "{$where_code} {$where_applyOn} Delete_Status = 0";
			
			$this->db
					 ->select('*')
					 ->from('promo_codes')
					 ->where($where);
			
			if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->order_columns_1[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("ID", "DESC");
		    }
		}
		
		function getPromoCodesList()
	    {
	        $this->_get_promos_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	
			$query = $this->db->get();
			
			//echo $this->db->last_query();
	        return $query->result();
	    }
	 
	    function promosCount_filtered()
	    {
	        $this->_get_promos_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function promosCount_all()
	    {
	        $this->_get_promos_query();
	        $query = $this->db->get();
	
	        return $this->db->count_all_results();
	    }
		
	}
?>