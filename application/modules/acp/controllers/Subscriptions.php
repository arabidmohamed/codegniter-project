<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Subscriptions extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/subscriptions";
	
	function __construct()
	{
    	parent::__construct();
    	
    	// send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
    	
    	$this->load->model('subscription_model', 'subscriptions');
  	}
	
	
	/*-----------------------------------------------------------
		---------------------- Subscription Plans -----------------
		--------------------------------------------------------*/
		
	// #categories view function
	public function new_plan_GET()
	{	
	   $data['all_tlds'] = $this->subscriptions->getAllTlds($data);
		$this->LoadView('subscriptions/plans/add_plans', $data);
	}	
	
	public function managePlans_GET()
	{


        $data['plans']          = $this->subscriptions->getPayedPlan();
    
		$this->LoadView('subscriptions/plans/manage_plans', $data);


	}


	 public function getPayedSubscriptions_GET(){

		$days_number     = trim($this->input->post('days_number'))?: 28; //28 days
        $subscription_type     = $this->input->post('subscription_type')?:61; //full keto
        $include_weekend = trim($this->input->post('include_weekend'))?:31; //5 working days only


        $plans  = $this->subscriptions->getPayedPlan($days_number,$subscription_type,$include_weekend);
        $free_plans = $this->subscriptions->get_all(array('plan_type'=>'free'),'*',null,'subscription_plans');
        $diet_plan_only = $this->subscriptions->get_all(array('Status'=>1,'plan_type'=>'plan_only'),'*',null,'subscription_plans');
        $data['plans'] = array_merge($plans,$free_plans,$diet_plan_only);

        echo $this->load->view('subscriptions/plans/plan_items', $data, TRUE);
       
    }
	
	// #add-category function
	public function addPlan_POST()
	{
		if($this->input->post('submit')){
	
			$TLD_Name = $this->input->post('TLD_Name');
			$Duration = $this->input->post('Duration');
			$Register_Price = $this->input->post('Register_Price');
			$Renew_Price = $this->input->post('Renew_Price');
			$Transfer_Price = $this->input->post('Transfer_Price');


			$data = array(
				'TLD_Name' => $TLD_Name,
				'Duration' => $Duration,
				'Register_Price' => $Register_Price,
				'Renew_Price' => $Renew_Price,
				'Transfer_Price' => $Transfer_Price,
			);

			$planid = $this->subscriptions->addPlan($data);
			if($planid){								
	             $this->session->set_flashdata('requestMsgSucc', 121);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }	
		}
		redirect($this->thisCtrl.'/managePlans/');
	}
	
	// #edit service
	public function editPlan_GET($TLD_ID = 0)
	{
		$data['TLD_ID'] = $TLD_ID;
		$data['plan'] = $this->subscriptions->getPlanByID($data);

		$data['all_tlds'] = $this->subscriptions->getAllTlds($data);


		$this->LoadView('subscriptions/plans/edit_plan', $data);
	}
	
	// #update service
	public function updatePlan_POST()
	{
		if($this->input->post('submit')){
			
			$TLD_Name = $this->input->post('TLD_Name');
			$Duration = $this->input->post('Duration');
			$Register_Price = $this->input->post('Register_Price');
			$Renew_Price = $this->input->post('Renew_Price');
			$Transfer_Price = $this->input->post('Transfer_Price');
			$TLD_ID = $this->input->post('TLD_ID');

			$updateData = array(
				'TLD_ID' => $TLD_ID,
				'TLD_Name' => $TLD_Name,
				'Duration' => $Duration,
				'Register_Price' => $Register_Price,
				'Renew_Price' => $Renew_Price,
				'Transfer_Price' => $Transfer_Price,
			);
				
			$result = $this->subscriptions->updatePlan($updateData);
	        
	         if($result){				 				 
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }	

		}
		redirect($this->thisCtrl.'/managePlans/');
	}
	
	// #delete service function
	public function deletePlan_GET($TLD_ID = 0)
	{

		$data['Deleted'] = date('Y-m-d H:i:s');
		
		$result = $this->subscriptions->deletePlan($TLD_ID,$data);
		if($result){
			
             $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
             $this->session->set_flashdata('requestMsgErr', 119);
        }
		redirect($this->thisCtrl.'/managePlans/');
	}
	
	public function deletePlansBySubscription_POST($subscription_id = 0)
	{
/*
		$result = $this->subscriptions->deletePlansBySubscription($subscription_id);
		return $result;	
*/
	}
	
	/*-----------------------------------------------------------
	---------------------- Subscribe Customers -----------------
	--------------------------------------------------------*/
	
	public function subscribeCustomer($customer_id = 0)
	{
		if(empty($customer_id) || !$customer_id){ show_404(); die(); }
		
		$data['customer'] = $this->admin_model->getCustomerByID($customer_id);
		$data['pref'] = $this->admin_model->getCustomerPreferences($customer_id);
		$data['subscription'] = $this->admin_model->getCustomerSubscriptionDetails($customer_id);

		$this->load->model('dietplan_model', 'diet');
		$data['diet'] = $this->diet->getByID('', $customer_id);
		
		$data['plans'] = $this->subscriptions->getPlans();
		$data['customerId'] = $customer_id;
		$this->LoadView('subscriptions/plans/subscribeCustomer', $data);
	}
	
	public function subscribeCustomer_POST()
	{
		$planId = $this->input->post('planId');
		$customerId = $this->input->post('customerId');
		if($this->input->post('submit'))
		{
			$data['plan_id'] = $planId;
			$plan = $this->subscriptions->getPlanByID($data);
			$currentSubscription = $this->subscriptions->getCustomerSubscription($customerId);
			$remaining_days = 0;
			if(count($current_subscription) > 0)
			{
				$sub_Expirey = new DateTime($currentSubscription->Expires_At);
				$today   = new DateTime(date("Y-m-d"));
				if($today < $sub_Expirey)
				{
					$remaining_days = $today->diff($sub_Expirey)->d;
				}	
			}
		
			$month_to_days = ($plan->days_number * 30) + $remaining_days;
			$expirey_date = date('Y-m-d', strtotime('+'.$month_to_days.' days'));
			
			date_default_timezone_set('UTC');
			$subActDetails = array(
				'Customer_ID' => $customerId,
				'Plan_ID' =>  $planId,
				'Balance' => $plan->Plan_Price,
				'Starts_At' => date('Y-m-d'),
				'Expires_At' => $expirey_date
			);
			$discount = 0;
			$promoCode = '';
			if($plan->Plan_Price > $this->input->post('paid')){
				$discount = $plan->Plan_Price - $this->input->post('paid');
				$promoCode = 'ADMIN';
			}
			
			$subDetails = $subActDetails;
			$subDetails['PromoCode'] = $promoCode;
			$subDetails['PromoDiscount'] = $discount;
			$subDetails['Payment_Source'] = "admin - ".$this->session->userdata($this->acp_session->username());
			$subDetails['Payment_Verified'] = 1;
			$subDetails['Payment_Type'] = 'transfer';
			$subDetails['Status'] = 'Verified';

			// image options
			$file_options = array(
				'file' => 'attach',
				'directory' => $GLOBALS['img_customers_dir'],
				'file_name' => date('Y-m-d H-i-s')
			);
			// Note: added by A (13 Oct) due to not uploading file..
			$this->load->library('upload', $file_options);
			// Ends
			$upload_data = UploadFile($file_options);

			if (is_array($upload_data) && array_key_exists('file_name', $upload_data))
	        {
		        $subDetails['Payment_Reciept'] = base_url($GLOBALS['img_customers_dir'].$upload_data['file_name']);
			}
			
			// subscribe customer
			$subscription_id = $this->subscriptions->addSubscriptionHistory($subDetails);
			$this->subscriptions->subscribeCustomer($subActDetails);
			
			$customer['Is_Member'] = 1;
			$customer['Customer_ID'] = $customerId;
			$this->subscriptions->updateUserCredentials($customer);
			
			if($subscription_id)
			{
	            $this->session->set_flashdata('requestMsgSucc', 49182);
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}
		
		redirect($this->thisCtrl.'/subscribeCustomer/'.$customerId);
	}
	
	// load all subscription history
	public function listall_GET(){
		$this->LoadView("customers/subscriptions/listall");
	}
	
	
}