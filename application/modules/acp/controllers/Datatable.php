<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Datatable extends Base_Controller {

	// define controller
	protected $thisCtrl = "acp/datatable";

	function __construct()
	{
    	parent::__construct();

    	$this->load->vars( array('__controller' => $this->thisCtrl));
    	$this->load->library('parser');
    	$this->load->model('datatable_model', 'datatable');
    	$this->load->model('customers_model', 'customers');

  	}

    public $__domainStatuses = array('NEW','PENDING', 'Done','Canceled', 'Transferred Out','NIC PENDING','DELETED','REJECTED','NEED MODIFICATION', 'APPROVED');

     public $__requestStatuses = array('pending','approved', 'refused','canceled', 'incomplete','need_modification');

        public function getTemplatesList_GET()
        {

        $templates = $this->datatable->getTemplatesList();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        //print_r($templates);
        foreach ($templates as $template) {
            $no++;
            $i++;

            //customer status template
            $status_chk = '';
            $status_not_chk = '';
            if($template->Status) { $status_chk = 'checked'; }
            if(!$template->Status) { $status_not_chk = 'checked'; }
            $status = '<div data-toggle="hurkanSwitch" data-status="'.$template->Status.'">
                            <input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
                            <input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
                      </div>';

            $redirectUrl = isset($_POST['hasNoDietPlan']) ? '?r=diets_plan_templates' : '';

            // actions template
            $action_data = array(
                'edit_url' => base_url('acp/diet_item_plans/edit_diet_plan/'.$template->Diet_Plans_ID.'/'),
                'delete_url' => base_url('acp/diet_item_plans/delete/'.$template->Diet_Plans_ID)
            );
            $actions = ''.$this->parser->parse('dite_plan_templates/snippets/actions-template', $action_data, TRUE);

            //check subscription expirey
            $subscriptionWarning = '';


            $row = array();
            $row[] = $template->Diet_Plans_ID;
            $row[] = $template->Created_At;
             $row[] = $template->Plan_Name_en;
            $row[] = $template->Plan_Name_ar;
            $row[] = $template->Plan_note;



            $row[] = $status;
            $row[] = $actions;

            $data[] = $row;

        } // end foreach

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

        }



    /**---------------------------------------
        * Item list *
        -------------------------------------**/
    public function getItemsList_GET()
    {
        $list = $this->datatable->getItemsList();
        $data = array();
        $no = $_POST['start'];
        $i = 0;

        foreach ($list as $item)
        {
            $no++;
            $i++;
            $dt = new DateTime($item->TimeStamp);
            $date = $dt->format('d-m-Y');

            $action_data = array(
                'details_url' => base_url('acp/items/itemDetails/'.$item->Item_ID.'/'),
                'edit_url' => base_url('acp/items/editItem/'.$item->Item_ID.'/'),
                'delete_url' => base_url('acp/items/deleteItem/'.$item->Item_ID.'/')
            );

            //image
            $image = '';
            if(strlen($item->Thumbnail) > 0){
                $image = '<img src="'.base_url($GLOBALS['img_item_dir'].$item->Thumbnail).'" style="width: 60px">';
            }

            // actions template
            $actions = ''.$this->parser->parse('items/snippets/actions-template', $action_data, TRUE);

            //member status template
            $status_chk = '';
            $status_not_chk = '';
            if($item->Status) { $status_chk = 'checked'; }
            if(!$item->Status) { $status_not_chk = 'checked'; }
            $status = '<div data-toggle="hurkanSwitch" data-status="'.$item->Status.'">
                            <input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
                            <input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
                      </div>';

            // multi-language code
            $__lang =   $this->session->userdata($this->acp_session->__lang());
            $title = 'Title_'.$__lang;

            // $available_weeks_data = explode(',', $item->available_weeks);
            // $available_weeks = '';
            // for($s = 0; $s < count($available_weeks_data); $s++)
            //     {
            //         $available_weeks .= " <span class='label label-primary'>".GetConstantById($available_weeks_data[$s],$__lang) ."</span> ";
            //     }


            // $week_days_data = explode(',', $item->week_days);
            // $week_days = '';
            // for($s = 0; $s < count($week_days_data); $s++)
            //     {
            //         $week_days .= " <span class='label label-primary'>".GetConstantById($week_days_data[$s],$__lang) ."</span> ";
            //     }

            $meal_type_data = explode(',', $item->meal_type);
            $meal_type = '';
            for($s = 0; $s < count($meal_type_data); $s++)
                {
                    $meal_type .= " <span class='label label-primary'>".GetConstantById($meal_type_data[$s],$__lang) ."</span> ";
                }



            $row = array();
            $row[] = $item->Class_ID;
            $row[] = $item->$title;
            $row[] = $image;
            // $row[] = $available_weeks;
            // $row[] = $week_days;
            $row[] = $meal_type;
            $row[] = $status;
            $row[] = $actions;

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->datatable->itemsCount_all(),
                        "recordsFiltered" => $this->datatable->productsCount_filtered(),
                        "data" => $data,
                );


        //output to json format
        echo json_encode($output);
    }


        /**---------------------------------------
        * Customers list *
        -------------------------------------**/

    public function getCustomersList_GET()
    {

        $customers = $this->datatable->getCustomersList();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        //dd($customers);
        foreach ($customers as $customer) {
            $no++;
            $i++;

            $dt = new DateTime($customer->TimeStamp);
            $date = $dt->format('d-m-Y');

            //image
            // $image = '<img src="'.base_url('style/acp/img/placeholder.png').'" class="profile-pic">';
            // if(strlen($customer->Picture) > 0){
            //     $image = '<img src="'.base_url($GLOBALS['img_customers_dir'].'/'.$customer->Picture).'" class="profile-pic">';
            // }

            //verified number
            $phone_verified_label = '';
            if($customer->Phone_Verified)
            {
                $phone_verified_label = '<i class="fa fa-check-circle text-success"></i>';
            }else{
                 $phone_verified_label = '<i class="fa fa-check-circle text-danger"></i>';
            }
            $email_verified_label = '';
            if($customer->Email_Verified)
            {
                $email_verified_label = '<i class="fa fa-check-circle text-success"></i>';
            }else{
                 $email_verified_label = '<i class="fa fa-check-circle text-danger"></i>';
            }

            //customer status template
            $status_chk = '';
            $status_not_chk = '';
            if($customer->Status) { $status_chk = 'checked'; }
            if(!$customer->Status) { $status_not_chk = 'checked'; }
            $status = '<div data-toggle="hurkanSwitch" data-status="'.$customer->Status.'">
                            <input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
                            <input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
                      </div>';


            // actions template
            $action_data = array(
                'details_url' => base_url('acp/customerDetails/'.$customer->Customer_ID),
                'edit_url' => base_url('acp/editCustomer/'.$customer->Customer_ID),
                 'manage_wallet_blance' => base_url('acp/customers/addCreditsToCustomer/'.$customer->Customer_ID),
                //'delete_url' => base_url('acp/deleteCustomer/'.$customer->Customer_ID.'/'.$_POST['show_members'].$redirectUrl),
                //'add_diet_url' => base_url('acp/diets/add/'.$customer->Customer_ID),
                //'subscribe_url' => base_url('acp/subscriptions/subscribeCustomer/'.$customer->Customer_ID),
                //'show_members' => $_POST['show_members']
            );
            $actions = ''.$this->parser->parse('customers/snippets/actions-template', $action_data, TRUE);




            //check subscription expirey
            // $subscriptionWarning = '';
            // if(isset($customer->Expires_At))
            // {
            //     if(strlen($customer->Expires_At) > 0)
            //     {
            //         $sub_Expirey = new DateTime($customer->Expires_At);
            //         $today   = new DateTime(date("Y-m-d"));
            //         if($today > $sub_Expirey)
            //         {
            //             $subscriptionWarning = ' <i class="fa fa-exclamation-triangle text-danger" title="Expired Subscription"></i>';
            //         }
            //     }
            // }

            
            $row = array();
            $row[] = $customer->Customer_ID;
            $row[] = '#'.$customer->Random_ID;
            $row[] = $customer->TimeStamp;
            $row[] = $customer->TimeStamp;
            $row[] = $customer->Fullname;
            $row[] = $customer->Email .' '.$email_verified_label;
            $row[] = $customer->Phone_Key.$customer->Phone .' '.$phone_verified_label;
            //$row[] = $verified_label;
            $row[] = $status;
            $row[] = $actions;


            $data[] = $row;

        } // end foreach

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->customersCount_all(),
            "recordsFiltered" => $this->datatable->customersCount_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }
    /**---------------------------------------
        * Subscription Logs list *
    -------------------------------------**/
    public function getCustomerSubscriptionsLogs_GET()
    {
        $list = $this->datatable->getCustomerSubscriptionsLogs();
        $data = array();
        $no = $_POST['start'];

        $c_us = false;
        if(isset($_POST['customer']))
        {
            $c_us = true;
        }
        $Plan_Name = 'Plan_Name_'.$this->session->userdata($this->acp_session->__lang());
        //print_r($list);
        foreach ($list as $log)
        {
            // Note: added by A (29 Jep 2019)
            $img = $log->Payment_Reciept;
            $img = $log->Payment_Reciept;
            $row[] = '<a href="/'.$img.' "target="_blank">عرض الإيصال</a>';
            // Ends
            $row = array();
            $row[] = $log->SCH_ID;
            $row[] = $log->created_at;
            $row[] = $log->$Plan_Name;
            $row[] = ($log->Payment_Verified == 1)?getSystemString('payed'):getSystemString('payment_not_verified');
            $row[] = $log->Payment_Source;
            $row[] = ($log->Plan_Price).' '.getSystemString(480);
            // Note: added by A (29 Sep 2019)
            if(!empty($img)){
            $row[] = '<a href="'.$img.' "target="_blank">عرض الإيصال</a>';
            } else {
            $row[] = 'عملية دفع أونلاين';
            }
            // Ends
            $row[] = $log->Starts_At;
            $row[] = $log->Expires_At;

            $data[] = $row;

        } // end foreach

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($list),
            "recordsFiltered" => count($list),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

  	/**---------------------------------------
	  	* Logs list *
	  	-------------------------------------**/

  	public function getWebsiteLogs_GET()
  	{

		$list = $this->datatable->getWebsiteLogs();
		$data = array();
		$no = $_POST['start'];

		//print_r($list);
		foreach ($list as $log)
		{

			$row = array();
			$row[] = $log->Log_ID;
			$row[] = $log->TimeStamp;
			$row[] = $log->Username;
			$row[] = $log->IP_Address;
			if($log->Event_Performed != 'update' && $log->Event_Performed != 'delete') {
				$row[] = '<b>'.$log->Event_Performed.'ed</b> '.$log->Action_Table.' table';
			} else {
				$row[] = '<b>'.$log->Event_Performed.'d</b> '.$log->Action_Table.' table';
			}

			$data[] = $row;

		} // end foreach

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatable->logsCount_all(),
			"recordsFiltered" => $this->datatable->logsCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);

  	}

  	/**---------------------------------------
	  	* Job Application list *
	  	-------------------------------------**/
  	public function getApplicationsList_GET()
  	{
		$list = $this->datatable->getApplicationsList();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $applications)
		{
			$no++;

			$dt = new DateTime($applications->DateApplied);
			$date = $dt->format('d-m-Y');

			$action_data = array(
				'aid' => $applications->Application_ID,
				'cv_file' => $applications->CV_File,
				'flag' => $applications->Flag,
				'delete_url' => base_url('acp/careers/deleteApplication/'.$applications->Application_ID.'/'),
				'detail_url' => base_url('acp/careers/application_details/'.$applications->Application_ID.'/')
			);

			$actions = ''.$this->parser->parse('careers/snippets/actions-template', $action_data, TRUE);

			$this->load->helper('utilities_helper');

			$title = 'Title_'.$this->session->userdata($this->acp_session->__lang());
			$row = array();
			$row[] = $applications->Application_ID;
			$row[] = $date;
			$row[] = $applications->Fullname;
			$row[] = '<a href="mailto:'.$applications->Email.'">'.$applications->Email.'</a>';
			$row[] = cvrtArabicNumbersToEnglish($applications->Number);
		    $row[] = $applications->$title;
			// $row[] = $applications->Gender;
			$row[] = $actions;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->datatable->applicationsCount_all(),
						"recordsFiltered" => $this->datatable->applicationsCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

  	/**---------------------------------------
	  	* SMS Log *
	  	-------------------------------------**/

  	public function getSMSLogs_GET(){

		$list = $this->datatable->getSMSLogs();
		$data = array();
		$no = $_POST['start'];

		//print_r($list);
		foreach ($list as $log) {

			$dt = new DateTime($log->TimeStamp);
			$date = $dt->format('d-m-Y');

			$row = array();
			$row[] = $log->ID;
            $row[] = $log->Number;
            $row[] = $log->Message;
            $row[] = $date;
			$row[] = $log->Username;
			//$row[] = $log->Message;

			$data[] = $row;

		} // end foreach

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatable->smsCount_all(),
			"recordsFiltered" => $this->datatable->smsCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);

  	}

    /**---------------------------------------
     * Contacts *
    -------------------------------------**/

    public function contacts_GET(){

        $list = $this->customers->getContacts();
        $data = array();
        $no = $_POST['start'];

        //print_r($list);
        foreach ($list as $log) {

            $dt = new DateTime($log->TimeStamp);
            $date = $dt->format('d-m-Y');

            $row = array();
            $row[] = $log->Customer_ID;
            $row[] = $log->Fullname;
            $row[] = $log->Phone;
            $row[] = $date;
            $row[] = '<div class="btn-group">
                                    <a class="btn btn-default dropdown-toggle" type="button" href="'.base_url('acp/notifications/editContact/').$log->Customer_ID.'">
                                        <i class="fa fa-edit"></i> '.getSystemString(43).'
                                    </a>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="fa fa-angle-down"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <li>
                                            <a href="$v" style="margin: 0px 5px;" class="dropdown-item">
                                            <a href="'.base_url('acp/notifications/editContact/').$log->Customer_ID.'" style="margin: 0px 5px;" class="dropdown-item">
                                                <i class="fa fa-edit"></i>  '.getSystemString(43).'
                                            </a>
                                        </li>
                                        <li>
                                            <a href="'.base_url('acp/notifications/deleteContacts/').$log->Customer_ID.'" style="margin: 0px 5px;" class="delete-record dropdown-item">
                                                <i class="fa fa-trash"></i>  '.getSystemString(314).'
                                            </a>
                                        </li>
                                    </ul>
                                </div>';


            $data[] = $row;

        } // end foreach

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->contactsCount_all(),
            "recordsFiltered" => $this->datatable->contactsCount_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    /**---------------------------------------
     * Email Log *
    -------------------------------------**/

    public function getEmailLogs_GET()
    {

        $messages = $this->datatable->getEmailLogs();
        $data = array();
        $no = $_POST['start'];

        foreach ($messages as $log) {

            $dt = new DateTime($log->TimeStamp);
            $date = $dt->format('d-m-Y');
            $attachment = '<img src="'.base_url($GLOBALS['img_customers_dir'].$log->Attachment).'" style="width: 60px">';

            $row = array();
            $row[] = $log->Email_ID;
            $row[] = $log->Email_Subject;
            $row[] = $log->Email_Message;
            $row[] = $attachment;
            $row[] = $date;

            $data[] = $row;

        } // end foreach

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->emailCount_all(),
            "recordsFiltered" => $this->datatable->emailCount_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    /**---------------------------------------
     * Emails *
    -------------------------------------**/

    public function emails_GET(){

        $list = $this->customers->getCustomers();
        $data = array();
        $no = $_POST['start'];

        //print_r($list);
        foreach ($list as $log) {

            $dt = new DateTime($log->Timestamp);
            $date = $dt->format('d-m-Y');

            $row = array();
            $row[] = $log->Email;
            $row[] = $date;
            $row[] = '<div class="btn-group">
                                    <a class="btn btn-default dropdown-toggle" type="button" href="'.base_url('acp/notifications/edit/').$log->ID.'">
                                        <i class="fa fa-edit"></i> '.getSystemString(43).'
                                    </a>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="fa fa-angle-down"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <li>
                                            <a href="$v" style="margin: 0px 5px;" class="dropdown-item">
                                            <a href="'.base_url('acp/notifications/edit/').$log->ID.'" style="margin: 0px 5px;" class="dropdown-item">
                                                <i class="fa fa-edit"></i>  '.getSystemString(43).'
                                            </a>
                                        </li>
                                        <li>
                                            <a href="'.base_url('acp/notifications/delete/').$log->ID.'" style="margin: 0px 5px;" class="delete-record dropdown-item">
                                                <i class="fa fa-trash"></i>  '.getSystemString(314).'
                                            </a>
                                        </li>
                                    </ul>
                                </div>';


            $data[] = $row;

        } // end foreach

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->emailsCount_all(),
            "recordsFiltered" => $this->datatable->emailsCount_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }



    // *****************************************
    // to get domains by customer ID
    // *****************************************
    public function getDomainsByCustomerID_GET($customer_id)
	{
		$domains = $this->datatable->getDomainsByCustomerID($customer_id);
        //dd($domains);
		// var_dump($domains[0]->DAL_Created); exit();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		$status = array(
  			                                $this->__domainStatuses[0] => 'warning',
							  	  			$this->__domainStatuses[1] => 'primary',
							  	  			$this->__domainStatuses[2] => 'success',
							  	  			$this->__domainStatuses[3] => 'warning',
							  	  			$this->__domainStatuses[4] => 'success',
							  	  			$this->__domainStatuses[5] => 'danger',
							  	  			$this->__domainStatuses[6] => 'danger',
							  	  			$this->__domainStatuses[7] => 'danger',
							  	  			$this->__domainStatuses[8] => 'danger',
							  	  			$this->__domainStatuses[9] => 'danger',

		);

		foreach ($domains as $domain) {
			$no++;
			$i++;


			$action_data['domain'] = $domain;

			//domain status label
			$domain_status = $domain->Domain_Status;

		  	$label = $status["$domain_status"];
			$status_label = '<span class="label label-'.$label.'">'.getSystemString($domain_status).'</span>';

			$row = array();
			$row[] = $domain->Domain_ID;
			$row[] = $domain->TimeStamp;
			$row[] = '<a href="https://'.$domain->Domain_Name.$domain->TLD.'" target="_blank">'.$domain->Domain_Name.$domain->TLD.'</a>';
			$row[] = $domain_status;
            $row[] = '<div class="btn-group">
                        <a class="btn btn-default dropdown-toggle" type="button" href="'.base_url('acp/domains/domainDetails/').$domain->Domain_ID.'">
                            <i class="fa fa-eye"></i> '.getSystemString('view_details').'
                        </a>
                    </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->datatable->domainsByCusIDCount_all($customer_id),
						"recordsFiltered" => $this->datatable->domainsByCusIDCount_filtered($customer_id),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
    // *****************************************


    // *****************************************
    // to get orders by customer ID
    // *****************************************
    public function getOrdersByCustomerID_GET($customer_id)
	{
        $_POST['status'] = 'requests';
        $_POST['customer_id'] = $customer_id;

		$domains = $this->datatable->getordersList($customer_id);

		//dd($domains);

		$data = array();
		$no = $_POST['start'];
		$i = 0;

		$status = array(
  			                                $this->__requestStatuses[0] => 'warning',
							  	  			$this->__requestStatuses[1] => 'success',
							  	  			$this->__requestStatuses[2] => 'danger',
							  	  			$this->__requestStatuses[3] => 'danger',
							  	  			$this->__requestStatuses[4] => 'primary',
                                            $this->__requestStatuses[5] => 'danger',
							  	  

		);

		foreach ($domains as $domain) {
			$no++;
			$i++;

            $order_type = getSystemString($domain->DCR_Request_Type);


		    if($domain->Need_Payment){
				$payment_status = ($domain->OR_Payment_Verified || $domain->TR_Payment_Verified)?102:'payment_not_verified';
			    $payment_label = ($domain->OR_Payment_Verified || $domain->TR_Payment_Verified)?'success':'warning';

                if($domain->OR_Payment_Refunded || $domain->TR_Payment_Refunded){
                      $payment_status = 'refunded';
                      $payment_label = 'info';
                }

			    $payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';
                $price =  $domain->OR_Total_Price.$domain->TR_Total_Price.' '.getSystemString(480);
			}else{
                $payment_status = 'NA';
                $payment_label = 'default';
                $payment = '<span class="label label-'.$payment_label.'">'.$payment_status.'</span>';
                $price =  '<span class="label label-'.$payment_label.'">'.$payment_status.'</span>';
            }
         

			//domain status label
			$domain_status = $domain->DCR_Status;
		  	$label = $status["$domain_status"];
            
            if($domain->DCR_Status == 'pending' && $domain->DCR_Admin_Approve == 0){
                $domain_status = 'admin_waiting_approve';
                $label = 'primary';  
            }

			$status_label = '<span class="label label-'.$label.'">'.getSystemString($domain_status).'</span>';

            if($domain->DCR_Request_Type == 'create_domain' && ($domain->DCR_Status == 'approved' || $domain->DCR_Status == 'pending' || $domain->DCR_Status == 'need_modification') ){
                 $base_url = base_url('acp/domains/Request_Details/').$domain->DCR_ID;
             }
            elseif($domain->DCR_Request_Type == 'domain_transfer_in'){
                 $base_url = base_url('acp/domains/domainTransferDetails/').$domain->DTI_ID;                
            }
            else{
                $base_url = base_url('acp/domains/requestDetails/').$domain->DCR_ID;  
            }

            $domain_name = $domain->Domain_Name.$domain->TLD;
            if($domain->DCR_Domain_ID == 0){
                $post_data = json_decode($domain->DCR_POST_DATA);
                $domain_name = $post_data->DTI_Domain_Name.$post_data->DTI_TLD;

            }

			$row = array();
			$row[] = str_pad( $domain->DCR_ID, 5, '0', STR_PAD_LEFT);
			$row[] = $domain->DCR_Created_At;
			$row[] = $domain_name;

			$row[] = $order_type;
			$row[] = $status_label;

			$row[] = $payment;
			$row[] = $price;
            $row[] = '<div class="btn-group">
                        <a class="btn btn-default dropdown-toggle" type="button" href="'.$base_url.'">
                            <i class="fa fa-eye"></i> '.getSystemString('view_details').'
                        </a>
                    </div>';


			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->datatable->domainsCount_all($customer_id),
						"recordsFiltered" => $this->datatable->domainsCount_filtered($customer_id),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
    // *****************************************


		// *****************************************
    // to get all tickets
    // *****************************************
		public function getTicketsData_GET()
    {
        $tickets = $this->datatable->getTicketsData();
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        //echo '<pre>';print_r($tickets); exit();
        foreach ($tickets as $ticket) {
            $no++;
            $i++;

            $dt = new DateTime($ticket->TimeStamp);
            $date = $dt->format('d-m-Y');

            //customer status template
            $status_chk = '';
            $status_not_chk = '';
            if($ticket->Status) { $status_chk = 'checked'; }
            if(!$ticket->Status) { $status_not_chk = 'checked'; }
            $status = $ticket->Status;
            if($status == 'New'){
                $ticket_status = '<span class="label label-warning">'.getSystemString('NEW').'</span>';
            }
            if($status == 'Pending'){
                $ticket_status = '<span class="label label-primary">'.getSystemString('pending_ticket').'</span>';
            }
            if($status == 'In Progress'){
                $ticket_status = '<span class="label label-default">'.getSystemString('under_review').'</span>';
            }
            if($status == 'Closed'){
                $ticket_status = '<span class="label label-success">'.getSystemString('Closed').'</span>';
            }
            if($status == 'Answered'){
                $ticket_status = '<span class="label label-info">'.getSystemString('answered').'</span>';
            }
            if($status == 'Customer reply'){
                $ticket_status = '<span class="label label-danger">'.getSystemString('customer_ticket_reply').'</span>';
            }


            // actions template
            $action_data = array(
                'details_url' => base_url('acp/customers/ticketDetails/'.$ticket->TicketId),
                'delete_url' => base_url('acp/customers/deleteTicketDetails/'.$ticket->TicketId)
            );
            $actions = ''.$this->parser->parse('customers/snippets/ticket-actions-template', $action_data, TRUE);

            $title = mb_strimwidth($ticket->Title, 0, 50, '...' ,'UTF-8');

            $row = array();
            $row[] = $ticket->TicketId;
            $row[] = $ticket->Timestamp;
            $row[] = $ticket->Fullname;
            $row[] = $title;
            $row[] = $ticket->RepliedBy;
            $row[] = $ticket_status;
            $row[] = $actions;


            $data[] = $row;

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

    // to get ticket by ID
    public function getTicketsDataByID_GET($customer_id)
    {
        $tickets = $this->datatable->getTicketsDataByID($customer_id);
        $data = array();
        $no = $_POST['start'];
        $i = 0;
        //echo '<pre>';print_r($tickets); exit();
        foreach ($tickets as $ticket) {
            $no++;
            $i++;

            $dt = new DateTime($ticket->TimeStamp);
            $date = $dt->format('d-m-Y');

            //customer status template
            $status_chk = '';
            $status_not_chk = '';
            if($ticket->Status) { $status_chk = 'checked'; }
            if(!$ticket->Status) { $status_not_chk = 'checked'; }
            $status = $ticket->Status;
            if($status == 'New'){
                $ticket_status = '<span class="label label-warning">'.getSystemString('NEW').'</span>';
            }
            if($status == 'Pending'){
                $ticket_status = '<span class="label label-primary">'.getSystemString('pending_ticket').'</span>';
            }
            if($status == 'In Progress'){
                $ticket_status = '<span class="label label-default">'.getSystemString('under_review').'</span>';
            }
            if($status == 'Closed'){
                $ticket_status = '<span class="label label-success">'.getSystemString('Closed').'</span>';
            }
            if($status == 'Answered'){
                $ticket_status = '<span class="label label-info">'.getSystemString('answered').'</span>';
            }
            if($status == 'Customer reply'){
                $ticket_status = '<span class="label label-danger">'.getSystemString('customer_ticket_reply').'</span>';
            }


            // actions template
            $action_data = array(
                'details_url' => base_url('acp/customers/ticketDetails/'.$ticket->TicketId),
                'delete_url' => base_url('acp/customers/deleteTicketDetails/'.$ticket->TicketId)
            );
            $actions = ''.$this->parser->parse('customers/snippets/ticket-actions-template', $action_data, TRUE);

            $title = mb_strimwidth($ticket->Title, 0, 50, '...' ,'UTF-8');

            $row = array();
            $row[] = $ticket->TicketId;
            $row[] = $ticket->Timestamp;
            $row[] = $ticket->Fullname;
            $row[] = $title;
            $row[] = $ticket->RepliedBy;
            $row[] = $ticket_status;
            $row[] = $actions;


            $data[] = $row;

        } // end foreach

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatable->ticketsByIDCount_all($customer_id),
            "recordsFiltered" => $this->datatable->ticketsByIDCount_filtered($customer_id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }
     public function getCustomerPaymentHistory_GET()
	{
		$subs = $this->admin_model->get_customer_subscriptions();
		$data = array();
		$no = $_POST['start'];
                $__lang =   $this->session->userdata($this->acp_session->__lang());
		foreach ($subs as $sub) 
		{
                    
			$row = array();
			$row[] = date('d-m-Y', strtotime($sub->Timestamp));
			$row[] = $sub->Fullname;
			$row[] = $sub->Email;
                        $row[] = $sub->{'Product_Name_'.$__lang};
                        $row[] = $sub->Num_of_licenses;
                        $row[] = $sub->domain;
                        $row[] = $sub->Total_Price;
                        $pLblTxt = getSystemString('payment_not_verified');
                        $pLblClr = 'label-danger';
                        if($sub->payment_verified)
                        {
                                $pLblTxt = getSystemString(102);
                                $pLblClr = 'label-success';
                        }

                        $row[] = "<label class='label {$pLblClr}'>{$pLblTxt}</label>";
                        
                        
                        $sLblClr = 'label-warning';
                        if($sub->subStatus == 'created')
                        {
                                $sLblClr = 'label-primary';
                        }

                        $row[] = "<label class='label {$sLblClr}'>{$sub->subStatus}</label>";
                        $action_data = array(
				'order_details' => base_url('acp/products/orderDetails/'.$sub->Subscription_ID),
				
			);	
			// actions template
			$actions = ''.$this->parser->parse('products/snippets/actions-template', $action_data, TRUE);
			$row[] = $actions;
			
			$data[] = $row;
			
		} // end foreach
		
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->datatable->phistoryCount_all(),
			"recordsFiltered" => $this->datatable->phistoryCount_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
}
?>
