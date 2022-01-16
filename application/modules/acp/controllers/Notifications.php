<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Notifications extends Base_Controller
{
    // define controller
    protected $thisCtrl = "acp/notifications";

    function __construct()
    {
        parent::__construct();

        //send controller name to views
        $this->load->vars( array('__controller' => $this->thisCtrl));
        $this->load->model('customers_model', 'customers');
        $this->load->model('admin_model');
        $this->load->model('features_model', 'feature');
    }

    private function Is_Parent_Menu_Disabled() {
        $Is_Parent_Menu_Disabled = $this->admin_model->Is_Parent_Menu_Disabled('#', 'comments');
        if (count($Is_Parent_Menu_Disabled) > 0) {
            show_404();
        }
    }






        public function addGroup_POST()
    {
        if($this->input->post('submit')){


            $group_name = $this->input->post('group_name');
            $group_info = array('Markting_Group_Name'=>$group_name);

            $MG_ID = $this->admin_model->insertMarketingGroups($group_info);

        require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        
if(isset($_FILES['attachment_file']) && $_FILES['attachment_file']['error']==0) {

        $tmpfname = $_FILES['attachment_file']['tmp_name'];
        $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
        $excelObj = $excelReader->load($tmpfname);
        $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();


        for ($row = 1; $row <= $lastRow; $row++) {
           $phone_number = $worksheet->getCell('A'.$row)->getValue();
           $name         = $worksheet->getCell('B'.$row)->getValue();

           //if(!$this->admin_model->phoneExists($phone_number)){
             $group_phone = array('MG_ID'=>$MG_ID,'Phone'=>$phone_number,'Name'=>$name);
             $result = $this->admin_model->insertMarketingGroupsPhones($group_phone);
           //}
             
        }

        if($result){
                $this->session->set_flashdata('requestMsgSucc', 704);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
    }


        redirect($this->thisCtrl.'/sms');
    }


    public function sms_GET()
    {
        $this->load->library('curl');

        $post = ['domain' => $_SERVER['HTTP_HOST']];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://hcm.dnet.sa/sms/Get_MessagesCount");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $Messages_Count = curl_exec ($ch);

        curl_close ($ch);


        //echo "<pre>"; print_r($Messages_Count);exit;

        $Messages_Count = json_decode($Messages_Count,true) ;

        if($Messages_Count=='No Bundle Found')
        {
            $result['Sms_Count'] = 1 ; //Bundle Not Found
        }
        elseif($Messages_Count=='Site not found')
        {
            $result['Sms_Count'] = 0 ; //Domain Not Found
        }
        else
        {
            $result = $Messages_Count ; //SMS Count found
        }

        $result['totalSMSSent'] = $this->db->get('logs_sms')->num_rows();
        $result['is_disabled'] = $this->feature->listall(50);

        $this->LoadView('sms/send_sms',$result);
    }

    public function getMobileNumbers_GET()
    {
        $string  = $this->input->get('q');
        $numbers = $this->admin_model->getMobileNumbers($string);
        $json = [];

        foreach($numbers as $no)
        {
            $json[] = ['id' => $no->Phone, 'text' => $no->Phone];
        }

        echo json_encode($json);
    }


       public function getMarketingGroups_GET()
    {

        $groups = $this->admin_model->getMarketingGroups();
        $json = [];

        foreach($groups as $group)
        {
            $json[] = ['id' => $group->MG_ID, 'text' => $group->Markting_Group_Name];
        }

        echo json_encode($json);
    }

    public function contacts_GET() {
        $data['contacts'] = $this->customers->getContacts();
        $data['is_disabled'] = $this->feature->listall(50);
        $this->LoadView('sms/contacts', $data);
    }

    public function sms_log_GET()
    {
        $data['is_disabled'] = $this->feature->listall(50);

        $this->LoadView('sms/sms_log', $data);
    }

    public function sms_package_GET()
    {
        $this->load->library('curl');

        $post = ['domain' => $_SERVER['HTTP_HOST']];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://hcm.dnet.sa/sms/Get_SMS_RenewalPackagedetails");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $Renewal_details = curl_exec ($ch);

        curl_close ($ch);


        $Renewal_details = json_decode($Renewal_details,true) ;

        if($Renewal_details=='No Package Found')
        {
            $result['Packages'] = 1 ; //Package Not Found
        }
        elseif($Renewal_details=='Site not found')
        {
            $result['Packages'] = 0 ; //Domain Not Found
        }
        else
        {
            $result['Packages'] = $Renewal_details ; //SMS Count found
        }

        //echo "<pre>"; print_r($result);exit;
        $result['is_disabled'] = $this->feature->listall(50);

        $this->LoadView('sms/sms_package',$result);
    }

    public function sendSMS_POST()
    {
        if($this->input->post('submit')){

            $message = $this->input->post('message');
            $numbers = $this->input->post('numbers');
            $phone  = $this->input->post('number');

            $group_name =  $this->input->post('group_name');

            $send_nos = '';
            $all_flag = 0 ;

            // add phone action
            // $action = array(
            //     'Phone' => $this->input->post('number')
            // );

            if(count($numbers) > 0)
            {
                $send_nos = implode(",", $numbers);
            }

            if(!empty($phone)){
                $send_nos = $phone;
                $numbers[] = $phone;
            }


            if(!empty($group_name)){
                $phones = $this->admin_model->getPhonesByGroupID($group_name);
                foreach ($phones as $row) {
                    $numbers[] = $row['Phone'];
                }
                $send_nos = implode(",", $numbers);
            }

            // if($this->input->post('send_all_customers'))
            // {
            //     $c_nos = $this->admin_model->getCustomerNumbers();
            //     $send_nos .= ' all customers ';
            //     $all_flag = 1;

            //     $numbers = (object) array_merge((array) $c_nos, (array) $numbers);
            // }

            // if($this->input->post('send_all_restaurants'))
            // {
            //     $r_nos = $this->admin_model->getRestaurantsNumbers();
            //     $send_nos .= ' all restaurants ';
            //     $all_flag = 1;

            //     $numbers = (object) array_merge((array) $r_nos, (array) $numbers);
            // }

            // if($this->input->post('send_all_companies'))
            // {
            //     /*
            //                     $c_nos = $this->admin_model->getCompaniesNumbers();
            //                     $send_nos .= ' all companies ';
            //                     $all_flag = 1;

            //                     $numbers = (object) array_merge((array) $c_nos, (array) $numbers);
            //     */
            // }
            //$result = $this->customers->addNumber($action);

            // if($result){
            //     $this->session->set_flashdata('requestMsgSucc', 121);
            // } else {
            //     $this->session->set_flashdata('requestMsgErr', 119);
            // }

            $data = array(
                'Number' =>  $send_nos,
                'Message' => $message,
                'User_ID' => $this->session->userdata($this->acp_session->userid())
            );



            $sms_result = '';
            $sendPhoneNosArray = array();
            if(count($numbers) > 0)
            {
                foreach($numbers as $no)
                {
                    if($all_flag)
                    {
                        if(is_object($no))
                        {
                            if(strlen($no->Phone) == 10 && substr($no->Phone, 0, 2) == 05)
                            {
                                //echo $no->Phone.' <br />';
                                $sendPhoneNosArray[] = $no->Phone;
                            }
                        }
                    } else {
                        $sendPhoneNosArray[] = $no;
                    }

                }
            }

            $sms_result = sendSMSTo(implode(",", $sendPhoneNosArray), $message);
            $sms_result = json_decode($sms_result);

            // print_r($sendPhoneNosArray);
            // die();

            $a1 = explode('|', $sms_result->Status);
            $status = explode(':', $a1[1]);

            // if sms sent then update in database
            if(strtolower(trim($status[1])) == 'success'){

                $result = $this->admin_model->sendSMS($data);
                if($result){
                    $this->session->set_flashdata('requestMsgSucc', 394);
                } else {
                    $this->session->set_flashdata('requestMsgErr', 119);
                }
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
        redirect($this->thisCtrl.'/sms');
    }

    /*-----------------------------------------------------------
    ---------------------- Send Message To All members -----------------
    --------------------------------------------------------*/

    public function sendEmail_ADD(){
        $data['customers'] = $this->customers->getCustomers();
        $data['is_disabled'] = $this->feature->listall(44);
        $this->LoadView('notifications/send-message', $data);
    }

    public function email_log_GET(){
        $data['messages'] = $this->customers->getSentMessages();
        $data['is_disabled'] = $this->feature->listall(44);
        $this->LoadView('notifications/email_log', $data);
    }

    public function email_GET(){
        $data['emails'] = $this->customers->getCustomers();
        $data['is_disabled'] = $this->feature->listall(44);
        $this->LoadView('notifications/emails', $data);
    }

    public function sendMessageToMembers_POST()
    {
        $this->load->helper('utilities_helper');
        if($this->input->post('submit')){

            $data = array(
                "userid" => $this->session->userdata($this->acp_session->userid()),
                "subject" => $this->input->post('subject'),
                "message" => $this->input->post('message'),
                "postmembers" => $this->input->post('members')
            );

            if(strlen(trim($data['message'])) == 0)
            {
                $this->session->set_flashdata('requestMsgErr', 318);
                $data['members'] = $this->customers->getCustomers();
                $this->LoadView('notifications/send-message', $data);
            }

            $result = '';

            // Added by Yasir on 13 Nov 2019

            $target_dir = $GLOBALS['img_customers_dir'];

            // image options
            $file_options = array(
                'file' => 'attach_file',
                'directory' => $target_dir,
                'file_name' => date('Y-m-d H-i-s')
            );
            $upload_data = UploadFile($file_options);

            $image_uploaded = 0;

            $upd_filename = '';

            if (array_key_exists('file_name', $upload_data))
            {
                $upd_filename = $upload_data['file_name'];

                $data['attachment'] = $upd_filename;

                $image_uploaded = 1;
            }


            $selected_members = '';
            $prof_flag = $this->input->post('professionals');
            $nor_flag = $this->input->post('normalUsers');
            $members_ids = $this->input->post('members');

            if($prof_flag && !$nor_flag){
                $result = $this->admin_model->updateCustomersUsingRoles($prof_flag, 0);

            } else if(!$prof_flag && $nor_flag){
                $result = $this->admin_model->updateCustomersUsingRoles($nor_flag, 0);

            } else if($prof_flag && $nor_flag){
                $result = $this->admin_model->updateCustomersUsingRoles($prof_flag, $nor_flag);
            } else {
                if(count($members_ids) > 0)
                {
                    $result = $this->admin_model->updateSelectedCustomers($members_ids);
                }
            }

            if($result){
                $email_id = $this->customers->addEmailMessage($data);
                $this->session->set_flashdata('requestMsgSucc', 677);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
        redirect($this->thisCtrl.'/sendEmail');
    }

    /*-----------------------------------------------------------
    ---------------------- Send Notifications To All members -----------------
    --------------------------------------------------------*/

    public function pushNotifications()
    {
        $data['emails'] = $this->admin_model->getCustomers();
        $this->LoadView('notifications/send-notifications', $data);
    }

    public function sendPushNotification()
    {
        //$this->load->helper('utilities_helper');
        if($this->input->post('submit'))
        {
            // To Send Test Push Notification To test@dnet.sa MobileID
            //$mobileIds = 'dik2YMB-iNw:APA91bGk6DdNVUIkeBuwJXDWe1jqK72he8bDSw1vv-X482t4mXK1VF4jQfzaU2q-3lYKm7egm6xOU2BHArwtogr_RsEnakCWfk78MizHsmdi5ZHxDD6xTyJKX9MSw7YbvkJ8qi7R8fsm';


            $mobileIds = array();
            $customers = $this->admin_model->getAllCustomers();

            foreach($customers as $row)
            {
                if(strlen($row->Mobile_ID) > 0)
                {
                    $mobileIds[] = $row->Mobile_ID;
                }
            }

            $result = sendPushNotificationH($this->input->post('subject'), $this->input->post('message'), $mobileIds);

            if($result){
                //$email_id = $this->admin_model->addEmailMessage($data);
                $this->session->set_flashdata('requestMsgSucc', 679);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }

        redirect($this->thisCtrl.'/pushNotifications');
    }

    public function delete_DELETE($id = 0)
    {

        $result = $this->customers->delete($id);
        if($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl.'/email');
    }

    public function addContact_ADD(){
        print_r($this->router->fetch_method());
        $data['is_disabled'] = $this->feature->listall(50);
        $this->LoadView('sms/add_contact', $data);
    }

    public function editContact_EDIT($Customer_ID = 0) {
        $data['contact'] = $this->customers->getCustomerByID($Customer_ID);
        $data['is_disabled'] = $this->feature->listall(50);
        $this->LoadView('sms/edit_contact', $data);
    }

    public function editContact_POST($Customer_ID = 0)
    {
        if($this->input->post('submit'))
        {
            $contact = array(
                'Customer_ID' => $Customer_ID,
                'Fullname' => $this->input->post('name'),
                'Phone' => $this->input->post('phoneNumber')
            );


            $result = $this->customers->updateContact($contact);;

            if($result){
                $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }

            redirect($this->thisCtrl.'/contacts');
        }
    }

    public function addContact_POST()
    {
        if($this->input->post('submit'))
        {
            $contacts = array(
                'Fullname' => $this->input->post('name'),
                'phone' => $this->input->post('phoneNumber')
            );


            $result = $this->customers->addContacts($contacts);;

            if($result){
                $this->session->set_flashdata('requestMsgSucc', 121);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }

            redirect($this->thisCtrl.'/contacts');
        }
    }

    public function deleteContacts_DELETE($id = 0)
    {

        $result = $this->customers->deleteContacts($id);
        if($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl.'/contacts');
    }

    public function edit_EDIT($ID = 0) {
        $data['email'] = $this->customers->getSubscribersByID($ID);

        $this->LoadView('notifications/edit', $data);
    }

    public function edit_POST($ID = 0)
    {
        if($this->input->post('submit'))
        {
            $email = array(
                'ID' => $ID,
                'Email' => $this->input->post('email'),
            );


            $result = $this->customers->update($email);;

            if($result){
                $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }

            redirect($this->thisCtrl.'/email');
        }
    }

}