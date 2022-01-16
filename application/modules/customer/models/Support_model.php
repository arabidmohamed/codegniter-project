<?PHP
class Support_model extends CI_Model
{
	public function getAllTickets($customer_id = 0)
	{
		return $this->db->where('CustomerId', $customer_id)->limit(5)->order_by('Timestamp', 'DESC')->get('customer_tickets')->result();
	}

	public function getCustomerDetails($customer_id = 0)
	{
		return $this->db->where('Customer_ID', $customer_id)->get('customers')->row();
	}

	public function getTicketDetails($customer_id = 0, $ticket_id = 0)
	{
		$ticket = $this->db
						->select('t.*, c.Fullname, c.Email, c.Customer_ID, c.APP_LANG')
						->from('customers as c')
						->join('customer_tickets as t', 't.CustomerId = c.Customer_ID')
						->where('t.CustomerId', $customer_id)
						->where('t.TicketId', $ticket_id)
						->get()
						->row();

		if(!empty($ticket))
		{
			$ticket->Comments = $this->db->where("TicketId", $ticket_id)->get('customer_ticket_comments')->result();
		}

		return $ticket;
	}

	public function addTicket($ticket = array()){
		$this->db->insert("customer_tickets", $ticket);
		return $this->db->insert_id();
	}

	public function addTicketComment($comment = array())
	{
		$this->db->insert("customer_ticket_comments", $comment);
		return $this->db->insert_id();
	}
	public function updateTicketStatusOnReply($data = array()){
		return $this->db->where('TicketId', $data['TicketId'])->where('Status !=', 'New')->update('customer_tickets', $data);
}
	public function updateTicketStatus($data = array()){
		return $this->db->where('TicketId', $data['TicketId'])->update('customer_tickets', $data);
	}
	public function updateTicketRate($data = array()){
        return $this->db->where('TicketId', $data['TicketId'])->update('customer_tickets', $data);
    }
	public function getSettings(){
		return $this->db->get("website_settings")->row();
	}

	public function getTicketCommentByID($ticket_id, $admin_user_id)
	{
		$q = $this->db->select('tc.*, u.Username, u.Fullname')
					  ->from('customer_ticket_comments as tc')
					  ->join('users as u', 'u.User_ID = tc.AddedBy_ID')
					  ->where('tc.TicketId', $ticket_id)
					  ->where('tc.AddedBy_ID', $admin_user_id)
					  ->order_by('tc.Timestamp', 'desc')
					  ->get();
						
		return $q->result();
	}

}
?>
