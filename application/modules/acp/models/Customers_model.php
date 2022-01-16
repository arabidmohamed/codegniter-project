<?PHP
class Customers_model extends CI_Model{


    public function getTickets($ticket_id = ''){
        if(!empty($ticket_id)){
            $this->db->where('t.TicketId', $ticket_id);
        }
        $t = $this->db
            ->select('t.*, c.Fullname, c.Email, c.Phone, c.APP_LANG')
            ->from('customer_tickets as t')
            ->join('customers as c', 'c.Customer_ID = t.CustomerId')
            ->order_by('t.Timestamp', 'DESC')
            ->get();

        if(!empty($ticket_id)){
            return $t->row();
        }

        return $t->result();
    }



    public function getTicketsStats(){
        $n = $this->db->where('Status', 'New')->get('customer_tickets')->num_rows(); 
        $p = $this->db->where('Status', 'Pending')->get('customer_tickets')->num_rows(); 
        $ans = $this->db->where('Status', 'Answered')->get('customer_tickets')->num_rows();
        $prg = $this->db->where('Status', 'In Progress')->get('customer_tickets')->num_rows();
        $c = $this->db->where('Status', 'Closed')->get('customer_tickets')->num_rows();
        $cr = $this->db->where('Status', 'Customer reply')->get('customer_tickets')->num_rows();
        return array('New' => $n, 'Pending' => $p, 'Closed' => $c, 'InProgress' => $prg, 'Answered' => $ans, 'CustomerReply' => $cr);
    }

    public function updateTicketStatus($data = array()){
        return $this->db->where('TicketId', $data['TicketId'])->update('customer_tickets', $data);
    }

    public function getTicketComments($ticket_id = ''){
        return $this->db->where('TicketId', $ticket_id)->get('customer_ticket_comments')->result();
    }

    public function addTicketComment($comment = array())
    {
        $this->db->insert('customer_ticket_comments', $comment);
        return $this->db->insert_id();
    }

           public function addNumber($data = array()){
            $arr = array(
                'Phone' => $data['Phone'],
            );
            return $this->db->insert(TBL_CUSTOMERS, $arr);
        }

               public function getContacts()
        {
            return $this->db
                ->get(TBL_CUSTOMERS)
                ->result();
        }
}
?>