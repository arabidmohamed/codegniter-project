<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Orders extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/orders";
	//public $__orderStatuses = array('Pending', 'In Process', 'On The Way','Delivered', 'Returned');

	public $__orderStatuses = array('Pending', 'In Process', 'Done', 'On The Way','Delivered','Canceled', 'Returned');
	
	
	function __construct()
	{
    	parent::__construct();
    	    	
    	// send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl, '__orderStatuses' => $this->__orderStatuses));
    	
    	$this->load->model('orders_model', 'orders');
    	$this->load->model('products_model');
    	$this->load->library('parser');
  	}
	
	public function manageOrders_GET()
	{
		$data['units'] = $this->products_model->getAllWeightUnits();
	    //$data['subcategories'] = $this->products_model->getSubCategories();
      	$data['categories'] = $this->products_model->getCategories();
		$this->LoadView('orders/manage_orders', $data);
	}
	
	public function orderDetails_GET($order_id = 0)
	{
		$data['settings'] = $this->admin_model->getSettings();
		$data['order'] = $this->orders->getOrderByID($order_id);
		$this->LoadView('orders/order_details', $data);
	}
	
	public function incompleted()
	{
		$this->LoadView('orders/incomplete_orders', $data);
	}
	
	public function changeOrderStatus_POST()
	{
		$order_id = '';
		if($this->input->post('submit')){
			$order_id = $this->input->post('order_id');
			$order_status = $this->input->post('order_status');
			
			$Class_IDs = $this->input->post('products');

			$cancel_reasons = $this->input->post('cancel_reasons');
			$qty = $this->input->post('qty');

			$data = array(
				'Order_ID' => $order_id,
				'Order_Status' => $order_status,
				'Cancel_Reasons' => $cancel_reasons,
			);
			$result = $this->orders->updateOrder($data);
			
			if($result)
			{
				
				$order = $this->orders->getOrderByID($order_id);
				if($order_status == 'In Process')
				{
// 					$response = $this->_sendOrderToUPace($order);
// 					$log = array(
// 						'Order_ID' => $order_id,
// 						'Type' => 'UPace Sending Order',
// 						'Response' => $response
// 					);
// 					$this->products_model->addAPISLog($log);
// 					$upaceR = json_decode($response);
					
					//if(!isset($upaceR->backend_id)){
// 						$orderDId = array(
// 							'Order_ID' => $order_id,
// 							'Order_Status' => 'Pending'
// 						);
// 						$this->orders->updateOrder($orderDId);
// 						$this->session->set_flashdata('requestMsgErr', 991);
// 					} else{
						// $orderDId = array(
						// 	'Order_ID' => $order_id,
						// 	'Upace_ID' => $upaceR->id
						// );
						// $this->orders->updateOrder($orderDId);
						$this->session->set_flashdata('requestMsgSucc', 360);
					//}
				}
				
				if($order_status == 'Delivered')
				{
					$this->_sendOrderEmail($order_id);
					$this->session->set_flashdata('requestMsgSucc', 360);
				}
				
				if($order_status == 'On The Way')
				{
					$this->session->set_flashdata('requestMsgSucc', 360);
				}				
				
				if($order_status == 'Returned')
				{
					// $this->load->helper('vend_helper');
			  //       $vendOrder = json_decode(VEND_GET('/register_sales/'.$order->Vend_Sale_ID));
			        
			  //       $vendStatusUPD = array(
					// 	'id' => $order->Vend_Sale_ID,
					// 	'source_id' => $order_id,
					// 	'invoice_id' => $order_id,
					// 	'user_id' => VEND_USER_ID,
					// 	'note' => "",
					// 	'status' => 'VOIDED',
					// 	'register_sale_products' => $vendOrder->register_sales[0]->register_sale_products
					// );
					
					// $response = json_decode(Vend_POST('/register_sales', json_encode($vendStatusUPD)));
					
					// * Receive Log
					// $log = array(
					// 	'Order_ID' => $order_id,
					// 	'Type' => 'Vend Response Sale Status Updating',
					// 	'Response' => json_encode($response)
					// );
					// $this->products_model->addAPISLog($log);
					$this->session->set_flashdata('requestMsgSucc', 360);
				}
				
	        } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	        }	
		}
		redirect($this->thisCtrl.'/orderDetails/'.$order_id);
	}
	
	// Send order to upace for delivery
	private function _sendOrderToUPace($od = array())
	{
		$this->load->helper('upace_helper');
		
		$payload = array (
			'backend_id' => $od->Order_ID,
			'delivery_address' => array (
				'latitude' => $od->CLatitude,
				'longitude' => $od->CLongitude,
				'description' => $od->CAddress,
				'name' => $od->Fullname,
				'mobile' => $od->Phone,
				'backend_id' => $od->Order_ID,
			),
			'pickup_address' => array (
				'longitude' => $od->Longitude,
				'latitude' => $od->Latitude,
				'description' => $od->Address,
				'name' => 'Anoosh Store',
				'mobile' => '920013222',
				'backend_id' => $od->Order_ID,
			),
			'payment' => 'prepaid',
			'delivery_fee' => 0,
			'collect_at_customer' => 0,
			'pay_at_pickup' => 0,
			'allow_to_pickup' => true,
			'allow_to_pay' => true,
		);
		
		foreach($od->OrderDetails as $odd)
		{
			$payload['line_items'][] = array (
				'quantity' => $odd->Quantity,
				'description' => $odd->Title_en,
				'name' => $odd->Title_en,
				'price' => $odd->Price,
			);
		}
		
		$log = array(
			'Order_ID' => $od->Order_ID,
			'Type' => 'UPace Order Send',
			'Response' => json_encode($payload)
		);
		$this->products_model->addAPISLog($log);
		
		return UPace_POST('platforms/orders?client_id='.UPACE_CLIENT_ID, json_encode($payload), 'live');
	}
	
	private function _sendOrderEmail($order_id = 0)
	{
		$order = $this->orders->getOrderByID($order_id);
        $data['order'] = (array)$order;
		$this->load->model('site/home_model');
        $data['website_data']      = (array)$this->home_model->Get_Website_Data();
		$this->load->library('parser');
		$temp_msg = ''.$this->parser->parse('acp_includes/email/invoice_status', $data, TRUE);
	
		//send email
		$options = array(
			'to' => $order->Email,
			'subject' => 'Order Delivered Successfully',
			'message' => $temp_msg
		);
		
		return SendEmail($options);
	}
	
	/*-----------------------------------------------------------
	---------------------- Reviews -----------------
	--------------------------------------------------------*/
	
	public function reviews_GET()
	{
		$this->LoadView('orders/reviews/list');
	}
	
	public function reviewDetails_GET($order_id = 0)
	{
		$data['order'] = $this->orders->getOrderByID($order_id);
		$data['review'] = $this->orders->getReviewByOrderID($order_id);
		$this->LoadView('orders/reviews/details', $data);
	}
	
	public function anooshReviews()
	{
		$this->LoadView('orders/anoosh_reviews/list');
	}
	
	public function anooshReviewDetails($review_id = 0)
	{
		$data['review'] = $this->orders->getAnooshReviewByID($review_id);
		$this->LoadView('orders/anoosh_reviews/details', $data);
	}
	
	/*-----------------------------------------------------------
		---------------------- Orders Datatable -----------------
		--------------------------------------------------------*/
	public function getOrdersList_GET()
	{
		$orders = $this->orders->getOrdersList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		
		$status = array(
  			                                $this->__orderStatuses[0] => 'warning',
							  	  			$this->__orderStatuses[1] => 'primary', 
							  	  			$this->__orderStatuses[2] => 'success', 
							  	  			$this->__orderStatuses[3] => 'warning',
							  	  			$this->__orderStatuses[4] => 'success',
							  	  			$this->__orderStatuses[5] => 'danger',
							  	  			$this->__orderStatuses[6] => 'danger',
		);

		foreach ($orders as $order) {
			$no++;
			$i++;
			$dt = new DateTime($order->TimeStamp);
			$date = $dt->format('d-m-Y h:m:s A');

			$action_data = array(
				'order_details' => base_url($this->thisCtrl.'/orderDetails/'.$order->Order_ID.'/'),
				'edit_url' => base_url($this->thisCtrl.'/editOrder/'.$order->Order_ID.'/'),
				'delete_url' => base_url($this->thisCtrl.'/deleteOrder/'.$order->Order_ID.'/')
			);											
			
			// actions template
			$actions = ''.$this->parser->parse('orders/snippets/actions-template', $action_data, TRUE);
			
			//order status label
			$order_status = $order->Order_Status;
		  	$label = $status["$order_status"];	
			$status_label = '<span class="label label-'.$label.'">'.getSystemString($order_status).'</span>';

			$payment_status = ($order->Payment_Verified)?102:'payment_not_verified';
			$payment_label = ($order->Payment_Verified)?'success':'warning';	
			$payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';


			
			
			$row = array();
			$row[] = $order->Order_ID;
			$row[] = $date;
			$row[] = $order->Fullname;
			$row[] = $order->Phone;
			$row[] = $status_label;
			$row[] = $order->OrderTotal_Price.' SAR';
			$row[] = $payment;
			$row[] = getSystemString(strtolower($order->PaymentType));
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->orders->ordersCount_all(),
						"recordsFiltered" => $this->orders->ordersCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	/*-----------------------------------------------------------
		---------------------- Incompleted Orders Datatable -----------------
		--------------------------------------------------------*/
	public function getIncompletedOrdersList()
	{
		$orders = $this->orders->getIncompletedOrdersList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		
		$status = array(
			                                $this->__orderStatuses[0] => 'warning',
							  	  			$this->__orderStatuses[1] => 'primary', 
							  	  			$this->__orderStatuses[2] => 'success', 
							  	  			$this->__orderStatuses[3] => 'warning',
							  	  			$this->__orderStatuses[4] => 'success',
							  	  			$this->__orderStatuses[5] => 'danger',
							  	  			$this->__orderStatuses[6] => 'danger',
		);

		foreach ($orders as $order) {
			$no++;
			$i++;
			$dt = new DateTime($order->TimeStamp);
			$date = $dt->format('d-m-Y h:m:s A');
			
			$action_data = array(
				'order_details' => base_url($this->thisCtrl.'/orderDetails/'.$order->Order_ID.'?incompleted=true'),
				'edit_url' => base_url($this->thisCtrl.'/editOrder/'.$order->Order_ID.'/'),
				'delete_url' => base_url($this->thisCtrl.'/deleteOrder/'.$order->Order_ID.'/')
			);											
			
			// actions template
			$actions = ''.$this->parser->parse('orders/snippets/actions-template', $action_data, TRUE);
			
			//order status label
			$order_status = $order->Order_Status;
		  	$label = $status["$order_status"];	
			$status_label = '<span class="label label-'.$label.'">'.getSystemString($order_status).'</span>';
			
			$row = array();
			$row[] = $order->Order_ID;
			$row[] = $date;
			$row[] = $order->Fullname;
			$row[] = $order->Phone;
			$row[] = $status_label;
			$row[] = $order->OrderTotal_Price.' SAR';
			$row[] = getSystemString(strtolower($order->PaymentType));
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->orders->incompletedOrdersCount_all(),
			"recordsFiltered" => $this->orders->incompletedOrdersCount_filtered(),
			"data" => $data
		);
		//output to json format
		echo json_encode($output);
	}
	
	/*-----------------------------------------------------------
		---------------------- Reviews Datatable -----------------
		--------------------------------------------------------*/
	public function getReviewsList_GET()
	{
		$reviews = $this->orders->getReviewsList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		foreach ($reviews as $review) 
		{
			$dt = new DateTime($review->Timestamp);
			
			$action_data = array(
				'review_details' => base_url($this->thisCtrl.'/reviewDetails/'.$review->Order_ID),
// 				'delete_url' => base_url($this->thisCtrl.'/deleteReview/'.$review->Order_ID)
			);											
			// actions template
			$actions = ''.$this->parser->parse('orders/reviews/snippets/actions', $action_data, TRUE);
			
			$rating['rating'] = $review->Overall_Rating;
			$ratings = ''.$this->parser->parse('orders/reviews/snippets/ratings', json_decode(json_encode ($rating), true), TRUE);
			
			$cName = $review->Fullname;
			if(strlen($cName) == 0)
			{
				$cName = '<span class="text-success">vend order</span>';
			}
			
			$row = array();
			$row[] = $dt->format('d-m-Y');
			$row[] = $review->Order_ID;
			$row[] = $cName;
			$row[] = $ratings;
			$row[] = '<p class="review">'.$review->Review.'</p>';
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->orders->reviewsCount_all(),
						"recordsFiltered" => $this->orders->reviewsCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	/*-----------------------------------------------------------
		---------------------- Anoosh Reviews Datatable -----------------
		--------------------------------------------------------*/
	public function getAnooshReviewsList()
	{
		$reviews = $this->orders->getAnooshReviewsList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		foreach ($reviews as $review) 
		{
			$dt = new DateTime($review->Timestamp);
			
			$action_data = array(
				'review_details' => base_url($this->thisCtrl.'/anooshReviewDetails/'.$review->ID)
			);											
			// actions template
			$actions = ''.$this->parser->parse('orders/anoosh_reviews/snippets/actions', $action_data, TRUE);
			
			$rating['rating'] = $review->Overall_Rating;
			$ratings = ''.$this->parser->parse('orders/anoosh_reviews/snippets/ratings', json_decode(json_encode ($rating), true), TRUE);
			
			$row = array();
			$row[] = $dt->format('d-m-Y');
			$row[] = $review->CashierEmail;
			$row[] = $review->CashierName;
			$row[] = $ratings;
			$row[] = '<p class="review">'.$review->Review.'</p>';
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->orders->anooshReviewsCount_all(),
						"recordsFiltered" => $this->orders->anooshReviewsCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
		
		
		
}
