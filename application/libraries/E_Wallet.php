<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

class E_Wallet
{

	public function modifyCreditsForCustomers($customer_id,$add_subtract,$amount,$reason='',$added_by,$checkout_id='')
	{

		$CI =& get_instance();
		$CI->load->model('acp/wallet_model');


			
			$credit = $CI->wallet_model->getCustomerCredit($customer_id);
	        $depit = $CI->wallet_model->getCustomerDepit($customer_id);
	        $totalCredit = $credit[0]->TotalCredit;
	        $totalDepit = $depit[0]->TotalDepit;
	        $available_balance = $totalCredit - $totalDepit;
			

			 
			if($add_subtract == '-'){
				if($amount > $available_balance){
					return false;
					die();
				}
			}
			$operators = array('+', '-');
			
			if(!in_array($add_subtract, $operators))
			{
				return false;
				die();
			}

			if($add_subtract == '+'){
	        	$Remaining_Balance = $amount + $available_balance;
	        }else{
	        	$Remaining_Balance = $amount - $available_balance;
	        }
			
	        $newCredit = array(
			         'Customer_ID' => $customer_id,
			         'Credits' => $amount,
			         'Type' => $add_subtract,
			         'Remaining_Balance'=> abs($Remaining_Balance),
			         'Reason' => $reason,
			         'AddedByUser' => $added_by,
			         'Checkout_ID'=>$checkout_id,

		         );

			 $result = $CI->wallet_model->modifyCreditsForCustomers($newCredit);


	         if($result)
	         {
	             return true;
	             
	         } else {
		         
	             return false;
	         }
	}

	public function getWalletTransactionsByCustomer($customer_id){	

		$CI =& get_instance();
		$CI->load->model('acp/wallet_model');	
		return $CI->wallet_model->getCustomerTransactions($customer_id);
	}

	public function getCustomerWalletBalance($customer_id){

			    $CI =& get_instance();
		        $CI->load->model('acp/wallet_model');
		        $credit = $CI->wallet_model->getCustomerCredit($customer_id);
		        $depit = $CI->wallet_model->getCustomerDepit($customer_id);
		        $totalCredit = $credit[0]->TotalCredit;
		        $totalDepit = $depit[0]->TotalDepit;
		        return $totalCredit - $totalDepit;
	}


	public function checkIfCanMakeTransactions($customer_id,$amount){	

		$CI =& get_instance();
		$CI->load->model('acp/wallet_model');	
		        $credit = $CI->wallet_model->getCustomerCredit($customer_id);
		        $depit = $CI->wallet_model->getCustomerDepit($customer_id);
		        $totalCredit = $credit[0]->TotalCredit;
		        $totalDepit = $depit[0]->TotalDepit;

		        $current_balance = $totalCredit - $totalDepit;

	          	$can_add_transaction = false;
		           if($current_balance >= $amount){
		                    $can_add_transaction = true;
		           }

           return $can_add_transaction;
	}






}
?>