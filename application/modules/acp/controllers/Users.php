<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Users extends Base_Controller {

    // define controller
    protected $thisCtrl = "acp/users";

    function __construct()
    {
        parent::__construct();

        //send controller name to views
        $this->load->vars( array('__controller' => $this->thisCtrl));
    }
    public function createUser_ADD()
    {
        $data['roles'] = $this->admin_model->getRoles();
        $this->LoadView('users/create_user', $data);
    }

    public function addUser_POST()
    {
        if($this->input->post('submit'))
        {
            $log = array(
                'row_id' 	   => 0,
                'action_table' => 'user',
                'content' 	   => $_POST,
                'event' 	   => 'add'
            );
            $this->logs->add_log($log);
            $this->load->library('form_validation');
            $result = '';

            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|max_length[20]|required', array('min_length' => 278));
            $this->form_validation->set_rules('username', 'Email', 'trim|valid_email|is_unique['.TBL_USERS.'.Username]|required',array('is_unique' => 287));
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('requestMsgErr', validation_errors());
                redirect($this->thisCtrl.'/createUser');
            }

            $password = $this->input->post('password');
            $this->load->library('bcrypt');

            $data = array(
                'Fullname' => $this->input->post('name'),
                'Username' => $this->input->post('username'),
                'Password' => $this->bcrypt->hash_password($password)
            );

            if($this->input->post('role'))
            {
                $data['Role_ID'] = $this->input->post('role');
            }

            //echo "<pre>"; print_r($data);exit;
            $User_ID = $this->admin_model->addUser($data);
            if($User_ID)
            {
                $this->session->set_flashdata('requestMsgSucc', 123);
            }
            else
            {
                $this->session->set_flashdata('requestMsgErr', 119);
            }

        }
        redirect($this->thisCtrl.'/manageUsers');
    }

    public function manageUsers_GET()
    {
        if($this->session->userdata($this->acp_session->role()) == 'super_admin')
        {
            $data['users'] = $this->admin_model->getAllUsers_ADM();
        }
        else
        {
            $data['users'] = $this->admin_model->getAllUsers();
        }
        $log = array(
            'row_id' 	   => 0,
            'action_table' => 'user',
            'content'	   => $_POST,
            'event' 	   => 'select'
        );
        $this->logs->add_log($log);
        $this->LoadView('users/manage_users', $data);
    }

    public function editUser_EDIT($userId = 0)
    {
        $log = array(
            'row_id' 	   => $userId,
            'action_table' => 'user',
            'content'	   => $userId,
            'event' 	   => 'select'
        );
        $this->logs->add_log($log);
        $data['user_id'] = $userId;
        $data['user'] = $this->admin_model->getUser($data);
        $data['roles'] = $this->admin_model->getRoles();
        $this->LoadView('users/manage_users', $data);
    }

    public function updateUser_POST()
    {
        if($this->input->post('submit'))
        {
            $this->load->library('form_validation');

            $userid        = $this->input->post('user_id');
            $password 	   = $this->input->post('password');
            $current_email = $this->input->post('old_email');
            $field_email   = $this->input->post('username');

            $run_validation = 0;
            $email_change_request = 0;
            if($field_email != $current_email)
            {

                $this->form_validation->set_rules('username', 'Email Address', 'required|valid_email|xss_clean|is_unique['.TBL_USERS.'.Username]',
                    array('is_unique' => 287));

                $run_validation = 1;
                $email_change_request = 1;
            }

            $data = array(
                'User_ID'  => $this->input->post('user_id'),
                'Fullname' => $this->input->post('name'),
                'Role_ID'  => $this->input->post('role')
            );

            // check password
            if(strlen($password) > 1)
            {
                $this->form_validation->set_rules('password', 'New Password', 'required|trim|min_length[3]|max_length[20]');

                $this->load->library('bcrypt');
                $data['Password'] = $this->bcrypt->hash_password($password);
                $run_validation = 1;
            }

            // Run validation if any of above condition is true
            if($run_validation)
            {
                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('requestMsgErr', validation_errors());
                    redirect($this->thisCtrl . '/editUser/'.$userid);
                }
                $data['Username'] = $field_email;
            }

            $result = $this->admin_model->updateUser($data);
            $log = array(
                'row_id' 		=> $userid,
                'action_table'  => 'user',
                'content' 	    => $_POST,
                'event'			=> 'update'
            );

            $this->logs->add_log($log);
            if($result)
            {
                $this->session->set_flashdata('requestMsgSucc',126);
            }
            else
            {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }

        redirect($this->thisCtrl.'/manageUsers');
    }
    public function deleteUser_DELETE($userid)
    {
        $log = array(
            'row_id' 	   => $userid,
            'action_table' => 'user',
            'content' 	   => $userid,
            'event' 	   => 'delete'
        );
        $this->logs->add_log($log);
        $data['User_ID'] = $userid;
        $result = $this->admin_model->deleteUser($data);
        if($result)
        {
            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl.'/manageUsers');
    }
}