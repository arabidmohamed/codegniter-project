<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Resturants extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/resturants";

	public $__orderStatuses = array('In Process', 'On The Way','Delivered');
	
	function __construct()
	{
    	parent::__construct();
    	    	
    	// send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl, '__orderStatuses' => $this->__orderStatuses));
    	
    	$this->load->model('resturants_model', 'resturants');
    	$this->load->model('generic_model');
    	$this->load->model('subscription_model');
    	$this->load->model('site/home_model');
    	$this->load->library('parser');
  	}
	

	public function getSubscriptionInfoByCustomerID_GET(){
		$customer_id = $this->input->post('customer_id');
		$this->load->model('admin_model');
		$data['subscription']    = $this->admin_model->getCustomerSubscriptionDetails($customer_id);

		$this->load->view('resturants/subscription_info_modal', $data);

	}


  	public function updateDietOrderStatus_POST(){


  			$option = $this->input->post('option');

  			$result_explode = explode('|', $option);

  		    $Order_Status = $result_explode[0];
  		    $DCO_ID       = $result_explode[1];

  		    $data = array(
  		    		'Order_Status' => $Order_Status,
  		    		'DCO_ID' => $DCO_ID,
  		    );

  		    $result = $this->resturants->updateDietOrderStatus($data);


  		if($result){

             $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true)));
        }else{

             $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false)));
        }



  	}

	/*-----------------------------------------------------------
		---------------------- GET Todays Keto Meals -----------------
		--------------------------------------------------------*/



	public function getTicketDetails_GET($sc_id,$customer_id,$billno,$current_week){


//echo $sc_id.' '.$customer_id; exit();
		$data['billno']         = $billno;
		$data['website_data']   = $this->home_model->Get_Website_Data();
        $data['website_config'] = $this->home_model->Get_WebsiteSettings();

		$data['weeks']       =$this->generic_model->get_all(array('parent'=>8),'*',null,'constants');
        $data['days']        =$this->generic_model->get_all(array('parent'=>9,'Status'=>1),'*',null,'constants');
        $data['periods']     =$this->generic_model->get_all(array('parent'=>4,'Status'=>1),'*',null,'constants');
        $data['types']       =$this->generic_model->get_all(array('parent'=>10,'Status'=>1),'*',null,'constants');

       

                                                     $res['SC_ID'] = $sc_id;
        $data['active_subscription']  = $this->subscription_model->getSubscriptionByID($res);

        $address_info     = $this->resturants->getCurrentDiscrit($customer_id);
        $data['Delivery_Address']         = $address_info->Address;

        $data['current_week'] = $current_week;
        $this->load->view('resturants/bill', $data);

        //var_dump($data['active_subscription']); exit();
        
       // $resturants = $this->resturants->getTodayItems();

		//$this->LoadView('resturants/today_meals', $data);
	}


	public function getTodayMeals_GET(){



		$data['weeks']       =$this->generic_model->get_all(array('parent'=>8),'*',null,'constants');
        $data['days']        =$this->generic_model->get_all(array('parent'=>9,'Status'=>1),'*',null,'constants');
        $data['periods']     =$this->generic_model->get_all(array('parent'=>4,'Status'=>1),'*',null,'constants');
        $data['types']       =$this->generic_model->get_all(array('parent'=>10,'Status'=>1),'*',null,'constants');
        
       // $resturants = $this->resturants->getTodayItems();

		$this->LoadView('resturants/today_meals', $data);
	}


	public function getAllActiveDistricts_GET(){

	$date = $this->input->post('date');
	$city = $this->input->post('city');


	$districts = $this->resturants->getAllActiveDistricts($date,$city);

        $dis = array();
        foreach ($districts as $district) {
        	if(!in_array($district[0]->District_ID, $dis)){
        		$dis[] = $district[0]->District_ID;
        	    $info[] = $district[0];
        	}
        	
        }


				if($info){

             $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => true,'data'=>$info)));
        }else{

             $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode(array('status' => false,'data'=>array())));
        }

	}


	public function todayOrders_POST(){


		$date_filter     = $this->input->post('date_filter');
		$city_filter     = $this->input->post('city_filter');
		$district_filter = $this->input->post('district_filter');


		$date     = isset($date_filter)?$date_filter:date('Y-m-d');
		$city     = isset($city_filter)?$city_filter:1;
		

		$data['weeks']       =$this->generic_model->get_all(array('parent'=>8),'*',null,'constants');
        $data['days']        =$this->generic_model->get_all(array('parent'=>9,'Status'=>1),'*',null,'constants');
        $data['periods']     =$this->generic_model->get_all(array('parent'=>4,'Status'=>1),'*',null,'constants');
        $data['types']       =$this->generic_model->get_all(array('parent'=>10,'Status'=>1),'*',null,'constants');
        $data['cities']          = $this->generic_model->get_all(null,'*',null,'tbl_cities');

       
        

        $districts = $this->resturants->getAllActiveDistricts($date,$city);
        $District_ID = isset($district_filter)?$district_filter:$districts[0][0]->District_ID;

        $data['date'] = $date;
        $data['District_ID'] = $District_ID;
        $data['districts'] = $districts;
 		
      
        $data['active_subscriptions'] = $this->resturants->getAllActiveSubscriptionsAndDiscrit($date,$city,$District_ID);

        // echo '<pre>';
        // var_dump($city);exit();

		$this->LoadView('resturants/today_orders', $data);
	}






	
	/*-----------------------------------------------------------
		---------------------- #Resturant CRUD -----------------
		--------------------------------------------------------*/
	
	public function manageResturants()
	{
   		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'resturants',
						'content' 	   => 0,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$this->LoadView('resturants/manage_resturants');
	}
	
	
	/*  -----------------------------------------------------------
		---------------------- Resturants Datatable -----------------
		-------------------------------------------------------- */
	public function getResturantsList()
	{
		$resturants = $this->resturants->getResturantsList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		foreach ($resturants as $resturant) {
			$no++;
			$i++;
			$dt = new DateTime($resturant->TimeStamp);
			$date = $dt->format('d-m-Y');
			
			$action_data = array(
				'edit_url' => base_url($this->thisCtrl.'/editResturant/'.$resturant->Store_ID.'/'),
				'delete_url' => base_url('acp/deleteResturant/'.$resturant->Store_ID.'/')
			);											
			
			// actions template
			$actions = ''.$this->parser->parse('resturants/snippets/actions-template', $action_data, TRUE);
			
			
			$storeName = url_title($resturant->StoreName_en, '-', TRUE);
			$products_link = base_url('products_rm/manageProducts/'.$resturant->Store_ID.'/'.$storeName.'/');
			$products_anchor = '<a href="'.$products_link.'" style="width: 100%; display:block">'.$resturant->TotalProducts.'</a>';
			
			$row = array();
			$row[] = $resturant->Store_ID;
			$row[] = $date;
			$row[] = $resturant->StoreName_en;
			$row[] = $resturant->Phone;
			$row[] = $resturant->Address;
			$row[] = $products_anchor;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->resturants->resturantsCount_all(),
						"recordsFiltered" => $this->resturants->resturantsCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
		
		
		
}