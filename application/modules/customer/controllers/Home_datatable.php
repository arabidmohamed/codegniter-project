<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller

require_once(APPPATH.'modules/customer/controllers/Base_Controller.php');

class Home_datatable extends Base_Controller {

	protected $thisCtrl = "home_datatable";

	function __construct()
	{
    	parent::__construct();

    	$this->load->model('datatable_model', 'datatable');
        $this->load->model('domain_model', 'domain');


    	//$this->load->helper('utilities_helper');
  	}



  	  	  public function getTicketsList()
  	{
	  	if (!$this->input->is_ajax_request())
		{
			exit('No direct script access allowed');
		}
	  	$this->load->library('parser');

		$tickets = $this->datatable->getTicketsList();


		$data 	   = array() ;
		$no 	   = $_POST['start']  ;
		$i         = 0 ;
		$domains_per_row = 0;
		$order_list = '';



		foreach ($tickets as $ticket)
		{
			$no++;
			$i++;

			    $status_arr = array(
					'New' => 'warning',
					'Pending' => 'primary',
					'Closed' => 'success',
					'In Progress' => 'default',
					'Answered' => 'info',
					'Customer reply' => 'danger'
				);




			$ticket_status = $ticket->Status;
			$label = $status_arr["$ticket_status"];


			$res['ticket'] = $ticket;

			$row = array();
			$row[] = $ticket->Timestamp;
			$row[] = $ticket->Title;//shorten_string($ticket->Title,12);

			if($ticket_status == 'New'){$st = getSystemString('NEW');}
			elseif($ticket_status == 'Pending'){$st =  getSystemString('pending_ticket');}
			elseif($ticket_status == 'In Progress'){$st =  getSystemString('under_review');}
			elseif($ticket_status == 'Closed'){$st =  getSystemString('Closed');}
			elseif($ticket_status == 'Answered'){$st =  getSystemString('answered');}
			elseif($ticket_status == 'Customer reply'){$st =  getSystemString('customer_ticket_reply');}

			$row[] = '<span class="badge badge-'.$label.'">'.$st.'</span>';
			$row[] = $this->parser->parse('customer/dashboard/snippets/tickets-actions', $res, TRUE);


			$data[] = $row;


			$i++;

		} // end foreach



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatable->ticketsCount_all(),
			"recordsFiltered" => $this->datatable->ticketsCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
  	}
  	// Ends
  	// ***************************************





  	  public function getDomainsList()
  	{
	  	if (!$this->input->is_ajax_request())
		{
			exit('No direct script access allowed');
		}
	  	$this->load->library('parser');

		$domains = $this->datatable->getDomainsList();


		$data 	   = array() ;
		$no 	   = $_POST['start']  ;
		$i         = 0 ;
		$domains_per_row = 0;
		$order_list = '';



		foreach ($domains as $domain)
		{
			$no++;
			$i++;

			                                $status = array(
												// 'ACTIVE' => 'success',
												// 'DELETED'   => 'danger',
												'Transferred Out'   => 'primary',
												'NIC PENDING'   => 'warning',
												'NEW'   => 'primary',
												'PENDING'   => 'warning',
												'Done'   => 'success',
												'Canceled'   => 'primary',
												'DELETED'   => 'primary',
												'PENDING DELETE'   => 'danger',

											);



			$domain_status = $domain->Domain_Status;
			$label = $status["$domain_status"];


			$res['domain'] = $domain;

			$row = array();
			$row[] = $domain->Domain_Name.$domain->TLD;
			$row[] = date('Y-m-d',strtotime($domain->Expire_Date));
			$row[] = '<span class="badge badge-'.$label.'">'.getSystemString($domain_status).'</span>';
			$row[] = $this->parser->parse('customer/dashboard/snippets/domains-actions', $res, TRUE);


			$data[] = $row;


			$i++;

		} // end foreach



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatable->domainsCount_all(),
			"recordsFiltered" => $this->datatable->domainsCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
  	}
  	// Ends
  	// ***************************************





  	  	public function getPurchasesList()
  	{
	  	if (!$this->input->is_ajax_request())
		{
			exit('No direct script access allowed');
		}
	  	$this->load->library('parser');

		$orders = $this->datatable->getPurchasesList();


		$data 	   = array() ;
		$no 	   = $_POST['start']  ;
		$i         = 0 ;
		$orders_per_row = 0;
		$order_list = '';



		foreach ($orders as $domain)
		{
			$no++;
			$i++;

			        $status = array(
												'PENDING'    => 'warning',
												'Done' => 'success',
												'NEW'   => 'primary',
												'Canceled'   => 'danger',
											);
			       
			       $domain->Payment_Verified = ($domain->PUR_Payment_Verified)?$domain->PUR_Payment_Verified:$domain->Payment_Verified;
			       $domain->Payment_Refunded = ($domain->PUR_Payment_Refunded)?$domain->PUR_Payment_Refunded:$domain->Payment_Refunded;
			       $domain->DO_ID = ($domain->PUR_DO_ID)?$domain->PUR_DO_ID:$domain->DTO_ID;
			       $domain->Cart_Type = ($domain->PUR_Cart_Type)?$domain->PUR_Cart_Type:$domain->Cart_Type;
			       $domain->Total_Price = ($domain->PUR_Total_Price)?$domain->PUR_Total_Price:$domain->Total_Price;
			       $domain->DTO_Created = ($domain->PUR_DTO_Created)?$domain->PUR_DTO_Created:$domain->DTO_Created;
			       $domain->Domain_Name = ($domain->PUR_Domain_Name)?$domain->PUR_Domain_Name:$domain->Domain_Name;
			       $domain->TLD = ($domain->PUR_TLD)?$domain->PUR_TLD:$domain->TLD;
			       $domain->Order_Type = ($domain->PUR_Order_Type)?$domain->PUR_Order_Type:'transfer_in';








			if($domain->Payment_Verified){
			       	$payment_label = 'success';
			       	$payment_status = getSystemString('Paid');
			}

			if($domain->Payment_Refunded){
			       	 $payment_label = 'warning';
			       	 $payment_status = getSystemString('refunded');
			}



			$res['domain'] = $domain;
			$orders_per_row++;

			$type =0;
			if($domain->Order_Type == 'transfer_in'){
				$type =1;
			}
                        if($domain->Order_Type == $domain->OrderType.'_new' || $domain->Order_Type == $domain->OrderType.'_license_addition'){
                            $type =3;
                        }

						$invoice_icon =	'<a  onclick="javascript:print_invoice(this)" data-domain-id="'.encryptIt($domain->DO_ID).'" data-type="'.$type.'" href="#!" class="btn box-shadow-0 btn-rounde btn-rounde-danger">
																<svg class="bi bi-file-earmark-check" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path d="M9 1H4a2 2 0 00-2 2v10a2 2 0 002 2h5v-1H4a1 1 0 01-1-1V3a1 1 0 011-1h5v2.5A1.5 1.5 0 0010.5 6H13v2h1V6L9 1z"/>
																	<path fill-rule="evenodd" d="M15.854 10.146a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0l-1.5-1.5a.5.5 0 01.708-.708l1.146 1.147 2.646-2.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
																</svg>
															</a>';		       
								    
			$row = array();
			$row[] = '<span class="title-ticket-tb">INV'.str_pad($domain->DO_ID, 5, '0', STR_PAD_LEFT).'</span>';
			$row[] = '<span class="title-ticket-tb">'.$domain->Domain_Name.$domain->TLD.'</span>';
			$row[] = '<span class="title-ticket-tb">'.date('Y-m-d',strtotime($domain->DTO_Created)).'</span>';
			$row[] = '<span class="title-ticket-tb badge badge-'.$payment_label.'">'.$payment_status.'</span>';
			$row[] = '<span class="title-ticket-tb">'.getSystemString($domain->Cart_Type).'</span>';	
			$row[] = '<span class="title-ticket-tb">'.$domain->Total_Price.' '.getSystemString(480).'</span>';
			$row[] = '<span class="title-ticket-tb">'.getSystemString($domain->Order_Type).'</span>';
			$row[] = $invoice_icon;


			$data[] = $row;


			$i++;

		} // end foreach



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatable->purchasesCount_all(),
			"recordsFiltered" => $this->datatable->purchasesCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
  	}
  	// Ends
  	// ***************************************





  	public function getOrdersList()
  	{
	  	if (!$this->input->is_ajax_request())
		{
			exit('No direct script access allowed');
		}
	  	$this->load->library('parser');

		$orders = $this->datatable->getOrdersList() ;


		$data 	   = array() ;
		$no 	   = $_POST['start']  ;
		$i         = 0 ;
		$orders_per_row = 0;
		$order_list = '';



		foreach ($orders as $domain)
		{
			$no++;
			$i++;

			     $status = array(
												'pending'    => 'primary',
												'approved' => 'success',
												'refused'   => 'danger',
												'deleted'   => 'danger',
												'canceled'   => 'danger',
												'incomplete'   => 'primary',
												'need_modification'   => 'danger',


											);


			$domain_status = $domain->DCR_Status;
			$label = $status["$domain_status"];

			/* on case transfer in and the domain not saved */
			if($domain->DCR_Domain_ID == 0){
				$post_data = json_decode($domain->DCR_POST_DATA);
				$domain_ns = $post_data->DTI_Domain_Name.$post_data->DTI_TLD;
			}else{
				$domain_ns = $domain->Domain_Name.$domain->TLD;
			}

			if($domain_status != 'incomplete' && $domain_status != 'canceled' && $domain_status != 'deleted'  && $domain_status != 'refused' && $domain_status != 'need_modification'){
				$payed_order = $this->domain->getOrderDetailsByRequestID($domain->DCR_ID);
				if($domain->Need_Payment && !$payed_order->Payment_Verified && $domain->DCR_Admin_Approve){
						$domain->DCR_Status = 'waiting_payments';
						$label = 'warning';
				}
				if(!$domain->DCR_Admin_Approve){
					$domain->DCR_Status = 'admin_waiting_approve';
					$label = 'warning';
				}
			}




			$res['domain'] = $domain;
			$res['payed_order'] = !empty($payed_order)?$payed_order:null;
			$orders_per_row++;


			$num = str_pad($domain->DCR_ID, 5, '0', STR_PAD_LEFT);



			$row = array();
			$row[] = $num;
			$row[] = $domain_ns;
			$row[] = '<span class="title-ticket-tb">'.getSystemString($domain->DCR_Request_Type).'</span>';
			$row[] = '<span class="badge badge-'.$label.'">'.getSystemString($domain->DCR_Status).'</span>';
			$row[] = $this->parser->parse('customer/dashboard/snippets/orders-actions', $res, TRUE);

			$data[] = $row;


			$i++;

		} // end foreach



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatable->ordersCount_all(),
			"recordsFiltered" => $this->datatable->ordersCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
  	}
  	// Ends
  	// ***************************************


}

?>
