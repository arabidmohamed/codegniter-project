<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Authentication extends Base_Controller {

    // define controller
    protected $thisCtrl = "authentication";

    function __construct()
    {
        parent::__construct();

        //send controller name to views
        $this->load->vars( array('__controller' => $this->thisCtrl));

        $this->load->model('authentication_model', 'auth');

    }

    /*-----------------------------------------------------------
            ---------------------- #Authentication -----------------
            --------------------------------------------------------*/

    //#Login Function
    public function userLogin()
    {
        $log = array(
            'row_id' 	   => 0,
            'action_table' => 'login',
            'content' 	   => $_POST,
            'event' 	   => 'select'
        );

        // $this->logs->add_log($log);

        $role    = $this->session->userdata('role_login');
        $ctrl 	 = 'acp';
        $role_id = SUPER_ADMIN_ROLE.','.ADMIN_ROLE;

        if($role == COMPANY_ROLE)
        {
            $ctrl = 'cp';
            $role_id = COMPANY_ROLE;
        }

        if($this->input->post('username'))
        {
            if($this->session->userdata('site__auth') >= 3)
            {
                $response = $this->input->post('g-recaptcha-response');
                $secret   = '6LebFBkUAAAAANhN9w4F8TtQFu-B0scWm5P8R3Ig';
                $ip 	  = $_SERVER['REMOTE_ADDR'];

                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
                $res = json_decode($rsp, TRUE);

                if($res['success'] != 1)
                {
                    // recaptcha failed show error message
                    $this->session->set_flashdata('loginFailed', 181);
                    redirect($ctrl.'/login');
                }
            }


            $user_pass = $this->input->post('password');

            $data['Username'] = $this->input->post('username');
            $data['Role_ID']  = $role_id;
            $data['Password'] = $user_pass;

            $result = $this->auth->login_m($data);
            
            if($result!=0){
                $this->db->where('username',$result[0]->Username);
                $this->db->where('DATE_ADD(LastFailedLogin, INTERVAL 1 DAY)<=',date('Y-m-d H:i:s'));
                $this->db->set('NoAttempts',0);
                $this->db->set('LastFailedLogin', date('Y-m-d H:i:s'));
                $this->db->update(TBL_USERS);
                $result = $this->auth->login_m($data);
            }

            $this->load->library('bcrypt');
            $password = $result != 0 ? $result[0]->Password : '' ;

            if($this->bcrypt->check_password($user_pass, $password) && $result[0]->NoAttempts<3)
            {

                $rand = rand(1111, 9999);
                $rand2 = rand(111111, 999999);
                $verify_page_token = urlencode(md5($rand.''.$rand2));
                $verify_token = md5($rand);
                $message = 'Pin Code is: '.$rand;

                //send email
                $options = array(
                'to' => $result[0]->Username,
                'subject' => '[dnet.sa]: Your Admin OTP is '.$rand,
                'message' => $message,
                 );

                 SendEmail($options); // from utilities

                $this->auth->updateUserVerifyToken($verify_token,$verify_page_token,$result[0]->User_ID);

                redirect('authentication/code_verification?token='.$verify_page_token);

            }
            else
            {
                
                 if($result!=0&&$result[0]->NoAttempts>=3){
                     $this->auth->updateAttempts($result[0]->Username);
                     $this->session->set_flashdata('lockaccount','Your account is locked upto '.date('d-m-Y H:i', strtotime('+24 hours', strtotime($result[0]->LastFailedLogin))).'  due to multiple attempts');
                 }else if($result!=0){
                     $this->auth->updateAttempts($result[0]->Username,1);
                 }

                $result = array('result' => 181);
                $this->load->view('login', $result);
            }
        }
        else
        {
            redirect($ctrl.'/login');
        }
    }

    /*-----------------------------------------------------------
        ---------------------- #Authentication Forgot Password -----------------
        --------------------------------------------------------*/

    // #password reset function
    public function passwordReset(){
        $log = array(
            'row_id' => 0,
            'action_table' => 'login',
            'content' => $_POST,
            'event' => 'update'
        );
        $this->logs->add_log($log);
        $email = $this->input->post('email');

        // this method will check the username with specified role, if found it will give us a token to sent in email
        $result = $this->auth->checkUser(array('Username' => $email, 'Role_ID' => $this->session->userdata('role_login')));

        if(is_array($result) && $result['info'] == 1){
            if($this->PasswordResetEmailTemplate($email, $result['reset_token'])){

                echo json_encode(array('info' => '1', 'msg' => getSystemString(284)));
            } else {

                echo json_encode(array('info' => '0', 'msg' => getSystemString(255)));
            }
        } else {
            echo $result;
        }
    }

    // email template
    public function PasswordResetEmailTemplate($email = '', $reset_token = ''){

        $role = $this->session->userdata('role_login');
        $ctrl = 'acp';

        if($role == COMPANY_ROLE){
            $ctrl = 'cp';
        }

        $data = array(
            'controller' => $ctrl,
            'username' => $email,
            'reset_token' => $reset_token
        );
        $this->load->library('parser');
        $message = $this->parser->parse('acp_includes/email/password-reset', $data, TRUE);

        //send email
        $options = array(
            'to' => $email,
            'subject' => getSystemString(487),
            'message' => $message,
        );

        return SendEmail($options);
    }

    public function changePassword_Request(){

        $role = $this->session->userdata('role_login');
        $ctrl = 'acp';

        if($role == COMPANY_ROLE){
            $ctrl = 'cp';
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|required|xss_clean');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]|xss_clean');

        $reset_token = $this->input->post('reset_token');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('requestMsgErr', validation_errors());

            redirect($ctrl.'/resetPasswordRequest/'.$reset_token);
        }

        //update user password
        $this->load->library('bcrypt');
        $data = array(
            'Reset_Token' => '',
            'Password' => $this->bcrypt->hash_password($this->input->post('password'))
        );

        $result = $this->auth->updateUserPassword($data, $reset_token);
        if($result){
            $this->session->set_flashdata('passwordChanged', 434);
        }

        redirect($ctrl.'/login');

    } // end function

    //#code verification function
    public function code_verification()
    {

        $this->load->view('code_verification');

    }

    //#code verification check function
    public function codeCheck()
    {

        $ctrl = 'acp';

        $code = md5($this->input->post('code'));

        $data['verify_page_token'] = $this->input->post('verify_page_token');

        $result = $this->auth->login_t($data);

        $verify_token = $result[0]->Verify_Token;

        if($code == $verify_token){

            $userdata = array(
                $this->acp_session->userid()   => $result[0]->User_ID,
                $this->acp_session->username() => $result[0]->Fullname,
                $this->acp_session->email()    => $result[0]->Username,
                $this->acp_session->role()     => $result[0]->Role,
                $this->acp_session->role_id()  => $result[0]->Role_ID,
                $this->acp_session->picture()  => $result[0]->Picture
            );

            $this->session->set_userdata($userdata);
            $this->session->set_userdata('site__auth', 0);

            if(strlen($_SESSION['redirect_url_ref']) > 0)
            {
                $redirect_url = $_SESSION['redirect_url_ref'];
                $_SESSION['redirect_url_ref'] = '';
                redirect($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$redirect_url);
            }

            redirect($ctrl.'/dashboard');

        } else {

            $this->session->set_flashdata('codeFailed', 181);
            redirect($ctrl.'/login');

        }
    }
}