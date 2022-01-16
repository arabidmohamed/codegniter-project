<?PHP
	class Appointments_model extends CI_Model
	{
		
		public function getAllAppointments()
		{
			$query = $this->db->select("a.*, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr")
								->from(TBL_APPOINTMENTS." as a")
								->join(TBL_SECTIONS." as s", "s.Section_ID = a.Section_ID")
								->order_by("ID", "desc")
								->get();
								
			return $query->result();
		}
		
		public function getRequestedUserEmail($data = array())
		{
			$this->db->where('Id', $data['Id']);
			return $this->db->get(TBL_APPOINTMENTS)->row();
		}
		
		public function changeAppointmentStatus($data = array())
		{
			$this->db->where('Id', $data['Id']);
			$query = $this->db->update(TBL_APPOINTMENTS, $data);
			if($query){
			   return json_encode(array('result'=>1));	
			} else {
			   return json_encode(array('result'=>0));	
			}
		}
		
		public function getAppointmentsSection()
		{
			return $this->db->where("Section_ID", 7)->get(TBL_SECTIONS)->result();
		}
		
		
		
		
		var $order_columns = array('a.Id', 'a.Date', 'a.Name', 'a.Email', 'a.Number', 'a.Status');
	
		private function _get_appointments_query()
	    {
		    $name = $_POST['name'];
			$email = $_POST['email'];
			$mno = $_POST['no'];
			$date = $_POST['date'];
			$status = $_POST['status'];
			$man_col = '';
			$email_col = '';
			$no_col = '';
			$j_col = '';
			$st_col= '';
		    
		    if(strlen($email) > 1){
				$email_col = "(a.Email LIKE '%$email%') AND";
			}
			
			if(strlen($mno) > 1){
				$no_col = "(a.Number LIKE '%$mno%') AND";
			}
			
			if($status != -1){
				$st_col = "(a.Status = '$status') AND";
			}
			
			if(strlen($date) > 1){
				$dateARR = explode("/", $date);
				$j_col = "(YEAR(a.Date) = $dateARR[2] AND MONTH(a.Date) = $dateARR[0] AND DAY(a.Date) = $dateARR[1]) AND";
			}
			if(strlen($name) > 1){
				$man_col = "a.Name LIKE '%$name%' AND";
			}
		    
		    $where = "{$man_col} {$email_col} {$no_col} {$st_col} {$j_col} Id > 0";
		    
	        $this->db->select('a.*'); 
	        $this->db->from(TBL_APPOINTMENTS.' as a');
	        $this->db->where($where);
	        
	        //print_r($_POST['order']);
		    if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->order_columns[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("a.Id", "DESC");
		    }
	    }
	 
	    function getAppointmentsList()
	    {
	        $this->_get_appointments_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	
			$query = $this->db->get();
			
			//echo $this->db->last_query();
	        return $query->result();
	    }
	 
	    function appointmentsCount_filtered()
	    {
	        $this->_get_appointments_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function appointmentsCount_all()
	    {
	        $this->_get_appointments_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
			
	}
?>