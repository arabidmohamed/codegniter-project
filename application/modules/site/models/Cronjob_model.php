<?php
class Cronjob_model extends CI_Model {
	
	public function updateAllVolunteers(){
		$result = $this->db->update(TBL_CUSTOMERS, array("Cron_Email_Flag" => 1));
		return $result;
	}
	
	public function updateSelectedVolunteers($data = array()){
		$result = '';
		foreach($data as $id){
			$result = $this->db->where("ID", $id)->update(TBL_CUSTOMERS, array("Cron_Email_Flag" => 1));
		}
		return $result;
	}
	
	// Insert admin-member email message to database
		public function addEmailMessage($data = array()){
			$arr = array(
				'Admin_ID' => $data['userid'],
				'Email_Subject' => $data['subject'],
				'Email_Message' => $data['message'],
				'Attachment' => @$data['attachment'],
				'In_Process_For_Members' => 1
			);
			return $this->db->insert(TBL_CRON_MEMBEREMAILS, $arr);
		}
		
		
	/*
		* CRON-JOB Manipulation *
	*/	

	public function get_expire_domains_two_months($limit){

	  $this->db->select('*');
      $this->db->from(DOMAIN.' as d');
      $this->db->where("not exists (select * from domains_notifications where domains_notifications.No_Domain_ID = d.Domain_ID and domains_notifications.No_Type = 'two_months' and domains_notifications.Is_Deleted = 0)",null,false);
      $where = "DATE(d.Expire_Date) - INTERVAL 2 MONTH < NOW() ";
      $this->db->where($where);

      $where = "DATE(d.Expire_Date) - INTERVAL 1 MONTH > NOW() ";
      $this->db->where($where);

      $this->db->where('d.IS_Domain_Created', 1);
      $this->db->where('d.Is_Deleted', 0);
      $this->db->where('d.Domain_Status !=', 'DELETED');

      $this->db->limit($limit);
      return $this->db->get()->result();
	}

	public function get_expire_domains_one_months($limit){

	  $this->db->select('*');
      $this->db->from(DOMAIN.' as d');
      $this->db->where("not exists (select * from domains_notifications where domains_notifications.No_Domain_ID = d.Domain_ID and domains_notifications.No_Type = 'one_month'  and domains_notifications.Is_Deleted = 0)",null,false);
      $where = "DATE(d.Expire_Date) - INTERVAL 1 MONTH < NOW() ";
      $this->db->where($where);

      $where = "DATE(d.Expire_Date) - INTERVAL 15 DAY > NOW() ";
      $this->db->where($where);

      $this->db->where('d.IS_Domain_Created', 1);
      $this->db->where('d.Is_Deleted', 0);
      $this->db->where('d.Domain_Status !=', 'DELETED');

      $this->db->limit($limit);

      return $this->db->get()->result();
	}


	public function get_expire_domains_fifteen_days($limit){

	  $this->db->select('*');
      $this->db->from(DOMAIN.' as d');
      $this->db->where("not exists (select * from domains_notifications where domains_notifications.No_Domain_ID = d.Domain_ID and domains_notifications.No_Type = '15_days' and domains_notifications.Is_Deleted = 0)",null,false);
      $where = "DATE(d.Expire_Date) - INTERVAL 15 DAY < NOW() ";
      $this->db->where($where);

      $where = "DATE(d.Expire_Date) - INTERVAL 1 DAY > NOW() ";
      $this->db->where($where);

      $this->db->where('d.IS_Domain_Created', 1);
      $this->db->where('d.Is_Deleted', 0);
      $this->db->where('d.Domain_Status !=', 'DELETED');

      $this->db->limit($limit);

      return $this->db->get()->result();

	}


    public function get_expire_domains_one_days($limit){

	  $this->db->select('*');
      $this->db->from(DOMAIN.' as d');
      $this->db->where("not exists (select * from domains_notifications where domains_notifications.No_Domain_ID = d.Domain_ID and domains_notifications.No_Type = '1_day'  and domains_notifications.Is_Deleted = 0)",null,false);
      $where = "DATE(d.Expire_Date) - INTERVAL 1 DAY < NOW() ";
      $this->db->where($where);

      $this->db->where('d.IS_Domain_Created', 1);
      $this->db->where('d.Is_Deleted', 0);
      $this->db->where('d.Domain_Status !=', 'DELETED');

      $this->db->limit($limit);

      return $this->db->get()->result();

	}

	public function updateCronStatus($domain_id,$type){
			$arr = array(
				'No_Domain_ID' => $domain_id,
				'No_Type' => $type,
			);
			return $this->db->insert(NOTIFICATIONS, $arr);
	}


		
	public function getCronedVolunteers($limit = 0){
		return $this->db->where('Cron_Email_Flag', 1)->limit($limit)->get(TBL_CUSTOMERS)->result();
	}
	
	public function getCronedSubscribers($limit = 0){
		return $this->db->distinct()->select('ID, Email')->where('Cron_Email_Flag', 1)->limit($limit)->get('subscribers')->result();
	}
	
	public function getInProcessEmail(){
		return $this->db->where('In_Process_For_Members', 1)->get(TBL_CRON_MEMBEREMAILS)->result();
	}
	
	public function updateVolunteerCronStatus($id = 0){
		$where = "Customer_ID = $id";
		return $this->db->where($where)->update(TBL_CUSTOMERS, array("Cron_Email_Flag" => 0));
	}
	
	public function updateSubscribersCronStatus($id = 0){
		$where = "ID = $id";
		return $this->db->where($where)->update('subscribers', array("Cron_Email_Flag" => 0));
	}
	
	public function updateEmailProcessStatus(){
		$where = "In_Process_For_Members = 1";
		return $this->db->where($where)->update(TBL_CRON_MEMBEREMAILS, array("In_Process_For_Members" => 0));
	}
	
	//cron email daily limit
	public function getTodayCronEmailLimit($date = ''){
		return $this->db->where('DATE(No_Created)', $date)->get(NOTIFICATIONS)->num_rows();
	}
	
	public function createCronEmailLimitFlag($data = array()){
		return $this->db->insert(TBL_CRON_EMAILLOGS, $data);
	}
	
	public function updateCronEmailLimitStatus($date = ''){
		return $this->db->where('Date', $date)->update(TBL_CRON_EMAILLOGS, array("Limit_Exceeded" => 1));
	}
	
}

?>