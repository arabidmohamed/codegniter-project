<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Invoices extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/invoices";
	public $__directories = array();
	
	function __construct()
	{
    	parent::__construct();
    	
    	$this->load->model('invoices_model', 'invoices');
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
  	}
	
	// to show index page
	public function listall_GET()
	{
		$this->LoadView('invoices/listall');
	}

	// pdf method
	public function pdf_GET($order_id,$type)
	{
		$data['website_config'] = $this->invoices->Get_WebsiteSettings();
		
		$orders_details = $this->invoices->getInvoiceDetails($order_id,$type);
		$request        = $this->invoices->getRequestByID($orders_details->Request_ID);
		
		/*this is on case the domain not created yet*/
	    if(empty($request) || ($request->DCR_Request_Type == 'domain_transfer_in' && $request->DCR_Status !='approved')){
			 $orders_details = $this->invoices->getTransferDomainOrderV2($order_id);
	    }

	    if(empty($orders_details)){
			  show_404();
			   exit();
	    }
		$data['type'] = $type;     
		$data['orders_details'] = $orders_details;
		$data['price_without_vat'] = round($orders_details->Total_Price /(1+($orders_details->Vat/100)),2);
		$data['total_price'] = $orders_details->Total_Price;
		$data['vat'] = $orders_details->Vat;
		$data['total_vat'] =  round(($orders_details->Total_Price) - ($orders_details->Total_Price / (1+($orders_details->Vat/100))),2);
		
		$data['request'] =  $request;

		$this->LoadView('invoices/snippets/bill', $data);	   
	}

	// to call data in Ajax request
	public function getDataList_GET()
	{
		$orders = $this->invoices->getPurchasesList();

		//dd($orders);

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
			if($domain->Payment_Verified){
				$payment_label = 'success';
				$payment_status = getSystemString('Paid');
			} else {
				$payment_label = 'default';
				$payment_status = getSystemString('unpaid');
			}

			if($domain->Payment_Refunded){
				$payment_label = 'warning';
				$payment_status = getSystemString('refunded');
			}



			$domain_status = $domain->Domain_Status;
			$label = $status["$domain_status"];

			$res['domain'] = $domain;
			$orders_per_row++;

			$type =0;
			if(empty($domain->Order_Type))
			{
				$domain->Order_Type = 'transfer_in';
				$type =1;
			}
			if($domain->Order_Type == $domain->OrderType.'_new' || $domain->Order_Type == $domain->OrderType.'_license_addition')
			{
				$type =3;
			}

			$invoice_icon =	'<a  onclick="javascript:print_invoice(this)" data-domain-id="'.$domain->DO_ID.'" data-type="'.$type.'" href="#!" class="btn box-shadow-0 btn-rounde btn-rounde-danger">
																<svg class="bi bi-file-earmark-check" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path d="M9 1H4a2 2 0 00-2 2v10a2 2 0 002 2h5v-1H4a1 1 0 01-1-1V3a1 1 0 011-1h5v2.5A1.5 1.5 0 0010.5 6H13v2h1V6L9 1z"/>
																	<path fill-rule="evenodd" d="M15.854 10.146a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0l-1.5-1.5a.5.5 0 01.708-.708l1.146 1.147 2.646-2.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
																</svg>
															</a>';		       
			$cardType = $domain->Cart_Type;
			if($cardType == 'VISA'){
				$cart_type = '<i class="fa fa-cc-visa" style="font-size: 2rem"></i>';
			} else if($cardType == 'MASTER'){
				$cart_type = '<i class="fa fa-cc-mastercard" style="font-size: 2rem"></i>';
			} else if($cardType == 'WALLET'){
				$cart_type = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
				<path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
			  </svg>';
			} else if($cardType == 'AMEX'){
				$cart_type = '<i class="fa fa-cc-amex" style="font-size: 2rem"></i>';
			} else {
				$cart_type = 'MADA';
			}				    
			$row = array();
			$row[] = '<span class="title-ticket-tb">INV'.str_pad($domain->DO_ID, 5, '0', STR_PAD_LEFT).'</span>';
			$row[] = '<span class="title-ticket-tb">'.$domain->Domain_Name.$domain->TLD.'</span>';
			$row[] = '<span class="title-ticket-tb">'.date('Y-m-d',strtotime($domain->DTO_Created)).'</span>';
			$row[] = '<span class="title-ticket-tb badge badge-'.$payment_label.'">'.$payment_status.'</span>';
			$row[] = '<span class="title-ticket-tb">'.$cart_type.'</span>';	
			$row[] = '<span class="title-ticket-tb">'.$domain->Total_Price.' '.getSystemString(480).'</span>';
			$row[] = '<span class="title-ticket-tb">'.getSystemString($domain->Order_Type).'</span>';
			$row[] = $invoice_icon;

			$data[] = $row;

			$i++;

		} // end foreach



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->invoices->purchasesCount_all(),
			"recordsFiltered" => $this->invoices->purchasesCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
	
	
}

?>