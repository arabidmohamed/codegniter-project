<?PHP

class report_model extends CI_Model {

    public function getFinancialReports($fromDate = '', $toDate = '') {


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("o.DTO_Payed_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("o.DTO_Payed_At <= '{$toDate} 23:59:00'");
        }


        $TransferAmount = $this->db
                ->select('SUM(o.Total_Price) as totalamount,SUM(o.Period) as count_period')
                ->where('DCR_Request_Type', 'domain_transfer_in')
                ->where('o.Payment_Verified', 1)
                ->where('o.Payment_Refunded', 0)
                ->join(REQUEST . ' as r', 'o.Request_ID = r.DCR_ID')
                ->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID')
                ->from(TRANSFER_ORDERS . ' as o')
                ->get()
                ->result();

        $transferAmount = number_format((float) $TransferAmount[0]->totalamount, 2, '.', '');
        $nic_transfer_amount = number_format((float) $TransferAmount[0]->count_period * 48, 2, '.', '');



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("o.Payed_AT >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("o.Payed_AT <= '{$toDate} 23:59:00'");
        }


        $totalAmount = $this->db
                ->select('SUM(o.Total_Price) as totalamount,SUM(o.Period) as count_period')
                ->where('DCR_Request_Type', 'create_domain')
                ->where('o.Payment_Verified', 1)
                ->where('o.Payment_Refunded', 0)
                ->join(REQUEST . ' as r', 'o.Request_ID = r.DCR_ID')
                ->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID')
                ->from(ORDERS . ' as o')
                ->get()
                ->result();
        $registrationAmount = number_format((float) $totalAmount[0]->totalamount, 2, '.', '');
        $nic_register_amount = number_format((float) $totalAmount[0]->count_period * 48, 2, '.', '');

        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("o.Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("o.Created_At <= '{$toDate} 23:59:00'");
        }

        $totalAmount = $this->db
                ->select('SUM(o.Total_Price) as totalamount,SUM(o.Period) as count_period')
                ->where('o.Order_Type', 'renew')
                ->where('o.Payment_Verified', 1)
                ->where('o.Payment_Refunded', 0)
                ->join(REQUEST . ' as r', 'o.Request_ID = r.DCR_ID')
                ->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID')
                ->from(ORDERS . ' as o')
                ->get()
                ->result();
        $renewAmount = number_format((float) $totalAmount[0]->totalamount, 2, '.', '');
        $nic_renew_amount = number_format((float) $totalAmount[0]->count_period * 48, 2, '.', '');


        $nic_amount = $nic_transfer_amount + $nic_register_amount + $nic_renew_amount;
        $total_amount = $transferAmount + $registrationAmount + $renewAmount;

        return array(
            'transferAmount' => number_format($transferAmount,2),
            'registrationAmount' => number_format($registrationAmount,2),
            'renewAmount' => number_format($renewAmount,2),
            'nic_amount' => number_format($nic_amount,2),
            'total_amount' => number_format($total_amount,2),
            'profits_amount' => number_format(($total_amount - $nic_amount),2),
        );
    }

    public function getOrdersReports($fromDate = '', $toDate = '') {
        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("r.DCR_Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("r.DCR_Created_At <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('r.*,d.*, d.Domain_ID as DID,d.*,tr.DTO_ID,tr.Payment_Verified as TR_Payment_Verified, tr.Total_Price as TR_Total_Price, or.Total_Price as OR_Total_Price,or.Payment_Verified as OR_Payment_Verified,or.Payment_Refunded as OR_Payment_Refunded,tr.Payment_Refunded as TR_Payment_Refunded');
        $this->db->from(REQUEST . " AS r");
        $this->db->join(DOMAIN . ' as d', 'r.DCR_Domain_ID = d.Domain_ID', 'left');
        $this->db->join(ORDERS . ' as or', 'or.Domain_ID = d.Domain_ID', 'left');
        $this->db->join(TRANSFER_ORDERS . ' as tr', 'tr.Domain_ID = d.Domain_ID', 'left');
        $this->db->where('or.Payment_Verified', 1);
        $this->db->where('or.Payment_Refunded', 0);
        $this->db->where('r.DCR_Status', 'approved');
        $this->db->where('d.Domain_Status', 'PENDING');
        $this->db->group_by('r.DCR_ID');

        $q = $this->db->get();
        $pending_orders = $q->result_array();

        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("r.DCR_Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("r.DCR_Created_At <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('r.*,d.*');
        $this->db->from(REQUEST . " AS r");
        $this->db->join(DOMAIN . ' as d', 'r.DCR_Domain_ID = d.Domain_ID', 'left');
        $this->db->group_start();
        $this->db->where('r.DCR_Request_Type', 'create_domain');
        $this->db->or_where('r.DCR_Request_Type', 'domain_transfer_in');
        $this->db->group_end();
        $this->db->where('r.DCR_Status', 'incomplete');
        $this->db->where('d.Domain_Status', 'NEW');
        $this->db->group_by('r.DCR_ID');

        $q = $this->db->get();
        $incomplete_orders = $q->result_array();

        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("r.DCR_Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("r.DCR_Created_At <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('r.*,d.*');
        $this->db->from(REQUEST . " AS r");
        $this->db->join(DOMAIN . ' as d', 'r.DCR_Domain_ID = d.Domain_ID', 'left');
        $this->db->group_start();
        $this->db->where('r.DCR_Request_Type', 'create_domain');
        $this->db->or_where('r.DCR_Request_Type', 'domain_transfer_in');
        $this->db->group_end();
        $this->db->where('r.DCR_Status', 'approved');
        $this->db->where('d.Domain_Status', 'Done');
        $this->db->group_by('r.DCR_ID');

        $q = $this->db->get();
        $completed_orders = $q->result_array();

        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("r.DCR_Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("r.DCR_Created_At <= '{$toDate} 23:59:00'");
        }
        $this->db->distinct();
        $this->db->select('r.*,d.*');
        $this->db->from(REQUEST . " AS r");
        $this->db->join(DOMAIN . ' as d', 'r.DCR_Domain_ID = d.Domain_ID', 'left');
        $this->db->join(ORDERS . ' as or', 'or.DO_ID = (select DO_ID from ' . ORDERS . ' as e2 where e2.Domain_ID = d.Domain_ID AND e2.Order_Type = "registration_domain" AND e2.Request_ID = r.DCR_ID ORDER BY Payment_Verified desc limit 1)', 'left');
        $this->db->where('or.Payment_Verified', 0);
        $this->db->where('or.Payment_Refunded', 0);
        $this->db->where('r.DCR_Request_Type', 'create_domain');
        $this->db->group_by('r.DCR_ID');
        $q = $this->db->get();
        $need_payment_orders_registration = $q->result_array();

        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("r.DCR_Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("r.DCR_Created_At <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('r.*,d.*');
        $this->db->from(REQUEST . " AS r");
        $this->db->join(DOMAIN . ' as d', 'r.DCR_Domain_ID = d.Domain_ID', 'left');
        $this->db->join(TRANSFER_ORDERS . ' as or', 'or.DTO_ID = (select DTO_ID from ' . TRANSFER_ORDERS . ' as e2 where e2.Domain_ID = d.Domain_ID  AND e2.Request_ID = r.DCR_ID ORDER BY Payment_Verified desc limit 1)', 'left');
        $this->db->where('or.Payment_Verified', 0);
        $this->db->where('or.Payment_Refunded', 0);
        $this->db->group_by('r.DCR_ID');
        $q = $this->db->get();
        $need_payment_orders_transfer = $q->result_array();

        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("r.DCR_Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("r.DCR_Created_At <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('r.*');
        $this->db->from(REQUEST . " AS r");
        $this->db->where('r.DCR_Domain_ID', 0);
        $this->db->where('r.DCR_Admin_ID', 0);
        $this->db->where('r.DCR_Phone_Verified', 1);
        $this->db->where('r.DCR_Status', 'incomplete');
        $this->db->where('r.DCR_Request_Type', 'domain_transfer_in');

        $this->db->group_by('r.DCR_ID');
        $q = $this->db->get();
        $waiting_approve_transfer = $q->result_array();


        return array(
            'pending_orders' => count($pending_orders),
            'incomplete_orders' => count($incomplete_orders),
            'completed_orders' => count($completed_orders),
            'need_payment_orders' => count($need_payment_orders_registration) + count($need_payment_orders_transfer),
            'waiting_approve_transfer' => count($waiting_approve_transfer),
        );
    }

    public function getTicketsReports($fromDate = '', $toDate = '') {



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("t.Timestamp >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("t.Timestamp <= '{$toDate} 23:59:00'");
        }

        $this->db->select('t.TicketId');
        $this->db->where('t.Status', 'Pending');
        $this->db->from('customer_tickets AS t');
        $q = $this->db->get();
        $new_tickets = $q->result_array();


        $this->db->select('t.TicketId');
        $this->db->where('t.Status', 'Closed');
        $this->db->from('customer_tickets AS t');
        $q = $this->db->get();
        $closed_tickes = $q->result_array();


        $this->db->select('t.TicketId');
        $this->db->from('customer_tickets AS t');
        $this->db->group_start();
        $this->db->where('t.Status', 'In Progress');
        $this->db->or_where('t.Status', 'Answered');
        $this->db->group_end();
        $q = $this->db->get();
        $waiting_response_tickets = $q->result_array();


        return array(
            'new_tickets' => count($new_tickets),
            'closed_tickes' => count($closed_tickes),
            'waiting_response_tickets' => count($waiting_response_tickets),
        );
    }

    public function getDomainDetailsReports($fromDate = '', $toDate = '') {



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->select('d.Domain_ID');
        $this->db->where('d.Domain_Status', 'Done');
        $this->db->where('d.Expire_Date >=', "'" . date('Y-m-d') . "'");
        $this->db->group_by('d.Domain_ID');
        $this->db->from(DOMAIN . ' AS d', '');
        $q = $this->db->get();
        $active_now = $q->result_array();


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('d.Domain_ID');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('r.DCR_Request_Type', 'create_domain');
        $this->db->where('r.DCR_Status', 'approved');
        $this->db->where('d.Domain_Status', 'Done');


        $q = $this->db->get();
        $domain_registered = $q->result_array();


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('r.DCR_Domain_ID');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('r.DCR_Request_Type', 'domain_transfer_in');
        $this->db->where('r.DCR_Status', 'approved');
        $this->db->where('d.Domain_Status', 'Done');
        $this->db->group_by('d.Domain_ID');

        $q = $this->db->get();
        $transfered_domians = $q->result_array();



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.Deleted_at >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.Deleted_at <= '{$toDate} 23:59:00'");
        }

        $this->db->select('d.Domain_ID');
        $this->db->group_by('d.Domain_ID');
        $this->db->where('d.Domain_Status', 'ADMIN DELETE');
        $this->db->from(DOMAIN . ' AS d', '');
        $q = $this->db->get();
        $admin_delete = $q->result_array();



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.Deleted_at >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.Deleted_at <= '{$toDate} 23:59:00'");
        }

        $this->db->select('d.Domain_ID');
        $this->db->group_start();
        $this->db->where('d.Domain_Status', 'PENDING DELETE');
        $this->db->or_where('d.Domain_Status', 'DELETED');
        $this->db->group_end();
        $this->db->from(DOMAIN . ' AS d', '');
        $q = $this->db->get();
        $client_delete = $q->result_array();







        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->select('d.Domain_ID');
        $this->db->group_by('d.Domain_ID');
        $this->db->where('d.Domain_Status', 'NIC PENDING');
        $this->db->from(DOMAIN . ' AS d', '');
        $q = $this->db->get();
        $nic_pending = $q->result_array();

        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->select('d.Domain_ID');
        $this->db->group_by('d.Domain_ID');
        $this->db->where('d.Domain_Status', 'REJECTED');
        $this->db->where('d.IS_Domain_Created', 1);

        $this->db->from(DOMAIN . ' AS d', '');
        $q = $this->db->get();
        $rejected_nic = $q->result_array();


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('d.Domain_ID');
        $this->db->join(ORDERS . ' AS o', 'o.Domain_ID = d.Domain_ID');
        $this->db->from(DOMAIN . ' AS d', '');
        $this->db->where('d.Domain_Status', 'Done');
        $this->db->where('o.Order_Type', 'renew');
        $this->db->group_by('o.Domain_ID');

        $q = $this->db->get();
        $renew_domains = $q->result_array();



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('d.Domain_ID');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('r.DCR_Request_Type', 'create_domain');
        $this->db->where('r.DCR_Status', 'approved');

        $q = $this->db->get();
        $domain_registered_approved = $q->result_array();


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('r.DCR_Domain_ID');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('r.DCR_Request_Type', 'domain_transfer_in');
        $this->db->where('r.DCR_Status', 'approved');
        $this->db->group_by('d.Domain_ID');

        $q = $this->db->get();
        $transfered_domians_approved = $q->result_array();





        return array(
            'active_now' => count($active_now),
            'domain_registered' => count($domain_registered),
            'admin_delete' => count($admin_delete),
            'client_delete' => count($client_delete),
            'transfered_domians' => count($transfered_domians),
            'nic_pending' => count($nic_pending),
            'rejected_nic' => count($rejected_nic),
            'renew_domains' => count($renew_domains),
            'domain_registered_approved' => count($domain_registered_approved),
            'transfered_domians_approved' => count($transfered_domians_approved),
        );
    }

    public function getTLDReports($fromDate = '', $toDate = '') {
        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->select('d.*, count(d.TLD) as CTLD');
        $this->db->where('d.Domain_Status', 'Done');
        $this->db->from(DOMAIN . ' AS d');
        $this->db->group_by('d.TLD');


        $q = $this->db->get();
        return $q->result_array();
    }

    public function getRequestTypeReports($fromDate = '', $toDate = '') {
        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("r.DCR_Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("r.DCR_Created_At <= '{$toDate} 23:59:00'");
        }

        $this->db->select('r.DCR_Request_Type, count(r.DCR_Request_Type) as CDCR_Request_Type');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r', '');
        $this->db->where('r.DCR_Status !=', 'deleted');
        $this->db->group_by('r.DCR_Request_Type');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getReports($fromDate = '', $toDate = '') {



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->select('d.Domain_ID');
        $this->db->where('d.Domain_Status', 'Done');
        $this->db->group_by('d.Domain_ID');
        $this->db->from(DOMAIN . ' AS d', '');
        $q = $this->db->get();
        $domains = $q->result_array();


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('d.Domain_ID');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('r.DCR_Request_Type', 'create_domain');
        $this->db->where('r.DCR_Status', 'approved');

        $q = $this->db->get();
        $approved_domains = $q->result_array();



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('d.Domain_ID');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('DCR_Status', 'pending');
        $this->db->where('DCR_Request_Type', 'create_domain');
        $q = $this->db->get();
        $pending_domains = $q->result_array();



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('DCR_Domain_ID');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('DCR_Request_Type', 'create_domain');
        $this->db->where('DCR_Status', 'refused');
        $q = $this->db->get();
        $rejected_domains = $q->result_array();




        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('DCR_Domain_ID');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('DCR_Request_Type', 'create_domain');
        $this->db->where('DCR_Status', 'incomplete');
        $q = $this->db->get();
        $incomplete_domains = $q->result_array();





        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("d.CREATE_DATE >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("d.CREATE_DATE <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('DCR_Domain_ID');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('DCR_Request_Type', 'domain_transfer_in');
        $this->db->where('DCR_Status', 'approved');
        $q = $this->db->get();
        $approved_transfer = $q->result_array();



        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("r.DCR_Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("r.DCR_Created_At <= '{$toDate} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('DCR_Domain_ID');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('DCR_Request_Type', 'domain_transfer_in');
        $this->db->where('DCR_Status', 'pending');
        $q = $this->db->get();
        $pending_transfer = $q->result_array();




        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("r.DCR_Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("r.DCR_Created_At <= '{$toDate} 23:59:00'");
        }


        $this->db->select('r.DCR_Created_At');
        $this->db->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID');
        $this->db->from(REQUEST . ' AS r');
        $this->db->where('DCR_Request_Type', 'domain_transfer_in');
        $this->db->where('DCR_Status', 'refused');
        $q = $this->db->get();
        $rejected_transfer = $q->result_array();













        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("o.DTO_Created >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("o.DTO_Created <= '{$toDate} 23:59:00'");
        }


        $TransferAmount = $this->db
                ->select('SUM(o.Total_Price) as totalamount2')
                ->where('DCR_Request_Type', 'domain_transfer_in')
                ->where('o.Payment_Verified', 1)
                ->where('o.Payment_Refunded', 0)
                ->join(REQUEST . ' as r', 'o.Request_ID = r.DCR_ID')
                ->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID')
                ->from(TRANSFER_ORDERS . ' as o')
                ->get()
                ->result();
        $transferAmount = number_format((float) $TransferAmount[0]->totalamount2, 2, '.', '');


        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("o.Created_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("o.Created_At <= '{$toDate} 23:59:00'");
        }


        $totalAmount = $this->db
                ->select('SUM(o.Total_Price) as totalamount')
                ->where('DCR_Request_Type', 'create_domain')
                ->where('o.Payment_Verified', 1)
                ->where('o.Payment_Refunded', 0)
                ->join(REQUEST . ' as r', 'o.Request_ID = r.DCR_ID')
                ->join(DOMAIN . ' AS d', 'd.Domain_ID = r.DCR_Domain_ID')
                ->from(ORDERS . ' as o')
                ->get()
                ->result();
        $totalamount = number_format((float) $totalAmount[0]->totalamount, 2, '.', '');




        return array(
            'domains' => count($domains),
            'approved_domains' => count($approved_domains),
            'incomplete_domains' => count($incomplete_domains),
            'pending_domains' => count($pending_domains),
            'rejected_domains' => count($rejected_domains),
            'create_amount' => $totalamount,
            'approved_transfer' => count($approved_transfer),
            'pending_transfer' => count($pending_transfer),
            'rejected_transfer' => count($rejected_transfer),
            'transfer_amount' => $transferAmount
        );
    }

    public function ProductReportData($product_id, $fromDate = '', $toDate = '') {

        // finding all created account
        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("s.Start_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("s.Start_At <= '{$toDate} 23:59:00'");
        }
        $this->db->distinct();
        $this->db->select('s.Subscription_ID');
        $this->db->join(TBL_ORDERS . ' AS o', 'o.Subscription_ID = s.Subscription_ID');
        $this->db->from(TBL_PRODUCT_SUBSCRIPTIONS . ' AS s');
        $this->db->where('s.Status', 'created');
        $this->db->where('o.isCreated', '1');
        $this->db->where('s.Product_ID', $product_id);

        $q = $this->db->get();
        $workspace_accounts = $q->result_array();

        // finding users
        if (!empty($fromDate)) {
            $fromDate = date("Y-m-d", strtotime($fromDate));
            $this->db->where("s.Start_At >= '{$fromDate} 00:00:00'");
        }
        if (!empty($toDate)) {
            $toDate = date("Y-m-d", strtotime($toDate));
            $this->db->where("s.Start_At <= '{$toDate} 23:59:00'");
        }
        $this->db->select('s.Num_of_licenses total_users');
        $this->db->join(TBL_ORDERS . ' AS o', 'o.Subscription_ID = s.Subscription_ID');
        $this->db->from(TBL_PRODUCT_SUBSCRIPTIONS . ' AS s');
        $this->db->where('s.Status', 'created');
        $this->db->where('o.isCreated', '1');
        $this->db->where('s.Product_ID', $product_id);
        $this->db->group_by('s.Subscription_ID');

        $q = $this->db->get();
        $total_users = $q->result_array();

        return array(
            'workspace_accounts' => count($workspace_accounts),
            'total_users' => array_sum(array_column($total_users, 'total_users'))
        );
    }

    public function getUsedCoupons($from, $to) {

        if (!empty($from)) {
            $from = date("Y-m-d", strtotime($from));
            $this->db->where("cs.created_at >= '{$from} 00:00:00'");
        }
        if (!empty($to)) {
            $to = date("Y-m-d", strtotime($to));
            $this->db->where("cs.created_at <= '{$to} 23:59:00'");
        }

        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('promo_codes as promo');
        $this->db->join('subscription_customer_history as cs', 'promo.Code = cs.PromoCode');
        $this->db->where('cs.Payment_Verified ', 1);
        $this->db->where('cs.canceled_at IS NULL');
        $this->db->group_by('promo.Code');

        $used_promo = $this->db->get()->result();

        foreach ($used_promo as $key => $row) {


            if (!empty($from)) {
                $from = date("Y-m-d", strtotime($from));
                $this->db->where("cs.created_at >= '{$from} 00:00:00'");
            }
            if (!empty($to)) {
                $to = date("Y-m-d", strtotime($to));
                $this->db->where("cs.created_at <= '{$to} 23:59:00'");
            }

            $used_promo[$key]->TotalIncome = $this->db
                            ->select_sum('cs.Balance')
                            ->from('subscription_customer_history as cs')
                            ->join(TBL_CUSTOMERS . ' AS c', 'c.Customer_ID = cs.Customer_ID', 'LEFT')
                            ->where('cs.Payment_Verified ', 1)
                            ->where('cs.PromoCode', $row->Code)
                            ->where('cs.canceled_at IS NULL')
                            ->get()->row();


            if (!empty($from)) {
                $from = date("Y-m-d", strtotime($from));
                $this->db->where("cs.created_at >= '{$from} 00:00:00'");
            }
            if (!empty($to)) {
                $to = date("Y-m-d", strtotime($to));
                $this->db->where("cs.created_at <= '{$to} 23:59:00'");
            }
            $used_promo[$key]->count = $this->db
                            ->select('*')
                            ->from('subscription_customer_history as cs')
                            ->join('promo_codes as promo', 'promo.Code = cs.PromoCode')
                            ->join(TBL_CUSTOMERS . ' AS c', 'c.Customer_ID = cs.Customer_ID')
                            ->where('cs.Payment_Verified ', 1)
                            ->where('cs.PromoCode', $row->Code)
                            ->where('cs.canceled_at IS NULL')
                            ->get()->num_rows();
        }

        return $used_promo;
    }

    public function chartReportsData() {
        $TotalIncome = $this->db
                ->select("DATE_FORMAT(TimeStamp, '%Y-%m-%d') as date, SUM(OrderTotal_Price) as value")
                ->from(TBL_ORDERS_HEAD)
                ->group_by('DAY(TimeStamp)')
                ->get()
                ->result();

        $MostOrderedProducts = $this->db
                ->select('count(*) as Orders, p.Title_en as ProductTitle')
                ->from(TBL_ORDER_DETAILS . ' as od')
                ->join(TBL_PRODUCTS . ' as p', 'p.Product_ID = od.Product_ID')
                ->group_by('od.Product_ID')
                ->order_by('Orders', 'DESC')
                ->limit(10)
                ->get()
                ->result();

        $MostViewedProducts = $this->db
                ->select('count(*) as Views, p.Title_en as ProductTitle')
                ->from(TBL_PRODUCT_VIEWS . ' as pv')
                ->join(TBL_PRODUCTS . ' as p', 'p.Product_ID = pv.Product_ID')
                ->group_by('pv.Product_ID')
                ->order_by('Views', 'DESC')
                ->limit(10)
                ->get()
                ->result();

        return array(
            'TotalIncome' => $TotalIncome,
            'MostOrderedProducts' => $MostOrderedProducts,
            'MostViewedProducts' => $MostViewedProducts
        );
    }

}
