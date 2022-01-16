<?PHP
class Communication_model extends CI_Model
{
	public function getAllcommunications($customer_id = 0)
	{
		return $this->db->where('CustomerId', $customer_id)->order_by('Timestamp', 'DESC')->get('customer_communications')->result();
	}
	
	public function getCustomerDetails($customer_id = 0)
	{
		return $this->db->where('Customer_ID', $customer_id)->get('customers')->row();
	}
	
	public function getcommunicationDetails($customer_id = 0, $communication_id = 0)
	{
		$communication = $this->db
						->where('CustomerId', $customer_id)
						->where('CommunicationId', $communication_id)
						->get('customer_communications')
						->row();
						
		if(!empty($communication))
		{
			$communication->Comments = $this->db->where("CommunicationId", $communication_id)->get('customer_communication_comments')->result();
		}
		
		return $communication;
	}
	
	public function addcommunication($communication = array()){
		$this->db->insert("customer_communications", $communication);
		return $this->db->insert_id();
	}
	
	public function addcommunicationComment($comment = array())
	{
		$this->db->insert("customer_communication_comments", $comment);
		return $this->db->insert_id();
	}
	
	public function getSettings(){
		return $this->db->get("website_settings")->row();
	}
}
?>