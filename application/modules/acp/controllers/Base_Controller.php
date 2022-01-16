<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends MY_Controller {

    public $sessObj;

    function __construct()
    {
        header("X-XSS-Protection: 1; mode=block");
        header('X-Frame-Options: SAMEORIGIN');
        parent::__construct();

        // load acp session
        $this->load->library('Acp_Session');

        $this->load->model('admin_model');

        // Load user log library
        $this->load->library('logs');

        // load helper
        $this->load->helper('utilities_helper');
        $this->load->helper('image_helper');

        // User authentication and authorization
        $this->load->library('authentication_hr');
        $userid = $this->session->userdata($this->acp_session->userid());
        $email  = $this->session->userdata($this->acp_session->email());

        //set default language if not set
        if(strlen($this->session->userdata($this->acp_session->__lang())) <= 1 )
        {
            $this->session->set_userdata($this->acp_session->__lang(), 'en');
        }

        $module = $this->router->fetch_module();
        $this->authentication_hr->IsLoggedIn($userid, $email, $module);



        // Added by Yasir - 13 Oct 2019

        /*
         * It checks the status for the menu item.
        */
        $link = uri_string();
        $menu = $this->admin_model->Is_Menu_Disabled($link);
        if (count($menu) > 0) {
            show_404();
        }
    }

    public function _remap($method, $params = array())
    {
        $controllerMethods = get_class_methods($this);
        $methodName = $method;
        // dont change this CHECK, Create a new controller will be better
        if(!empty($params) && !is_numeric($params[0])){
            $methodName = $params[0];
        }

        $controller    = $this->router->fetch_class();
        if($controller != 'authentication' && $controller != 'acp')
        {
            $actions = array(
                'edit' => 'edit',
                'put' => 'edit',
                'add'  => 'add',
                'post' => 'edit',
                'post' => 'add',
                'get' => 'view',
                'delete' => 'delete'
            );

            foreach($actions as $action => $value)
            {
                $methodActionName = $methodName.'_'.strtoupper($action);

                // check for _post
                $mAs = explode("_", $methodName);
                if(strtolower($mAs[count($mAs) - 1]) == 'post'){
                    $methodActionName = $methodName;
                }
                //echo $action.' '.$methodActionName.' <br>';
                if(in_array($methodActionName, $controllerMethods))
                {
                    // check here if this action has been permitted to this user
                    if(!$this->_checkActivityAuthorization($controller, $value))
                    {
                        $this->LoadView('un_authorize');
                    } else {
                        return call_user_func_array(array($this, $methodActionName), $params);
                    }
                }
            }
        } else {
            return call_user_func_array(array($this, $method), $params);
        }

        show_404();
    }

    private function _checkActivityAuthorization($controller, $action)
    {
        $login_role_id = $this->session->userdata($this->acp_session->role_id());
        /*
            * $login_role_id = 1 #super_admin
            * $login_role_id = 3 #admin
        */

        $check_activity = array('',1,3);

        if(!in_array($login_role_id, $check_activity))
        {
            // these `if` conditions are temporary
            if($controller != "authentication" && $controller != "acp" && $this->input->method() != 'post')
            {
                return $this->admin_model->checkActivityAuthorization($login_role_id, $controller, $action);
            }
        }

        return 1;
    }



    public function index($lang = '')
    {
        if($this->IsLoggedIn())
        {
            redirect('acp/dashboard');
        } else {
            redirect('authentication/login');
        }
    }

    // Login view
    public function login()
    {
        $lang = $this->session->userdata($this->acp_session->__lang());
        $data[$this->acp_session->__lang()] = $lang;

        $ctrl = strtolower($this->router->fetch_class());

        if($this->IsLoggedIn())
        {
            redirect($ctrl.'/dashboard');
        }
        else
        {
            $role_login = '';

            if($ctrl == 'cp')
            {
                $role_login = CUSTOMER_ROLE ; //RESTURANTS_ROLE;
            }
            else
            {
                $role_login = ADMIN_ROLE;
            }

            $this->session->set_userdata('role_login', $role_login);
            $this->load->view('login', $data);
        }
    }

    public function IsLoggedIn()
    {
        if($this->session->userdata($this->acp_session->userid()))
        {
            $data['email']   = $this->session->userdata($this->acp_session->email());
            $data['user_id'] = $this->session->userdata($this->acp_session->userid());
            $result = $this->auth->isLoggedIn_check($data);
            return $result;
        }
    }

    //#logout function
    public function logout()
    {
        $this->session->unset_userdata($this->acp_session->userid());
        $this->session->unset_userdata($this->acp_session->username());
        $this->session->unset_userdata($this->acp_session->email());
        $this->session->unset_userdata($this->acp_session->role());
        $this->session->unset_userdata($this->acp_session->picture());
// 		$this->session->sess_destroy();
        redirect('acp/login');

    }

    // Change language function
    public function changeLanguage($lang = '')
    {
        $website_lang = $this->admin_model->GetWebsitetLanguage();
        if($website_lang == 'en-ar'){
            $this->session->set_userdata($this->acp_session->__lang(), $lang);
        }
        //if request sent by client
        if(isset($_SERVER['HTTP_REFERER'])) {
            $path = rtrim($_SERVER["HTTP_REFERER"], '/');
            $segments = explode("/", $path);
            $url = $path;
            header('Location: ' . $url);
        }

    }

    /*-----------------------------------------------------------
        ---------------------- #Sections -----------------
        --------------------------------------------------------*/
    public function sections()
    {
        $data['sections'] = $this->admin_model->getSections();
        $this->LoadView('sections', $data);
    }

    public function editSection($section_id = 0, $redirect_uri = '')
    {
        $log = array(
            'row_id' => 0,
            'action_table' => 'section',
            'content' => $section_id,
            'event' => 'edit'
        );
        $this->logs->add_log($log);
        $data['section_id'] = $section_id;
        $data['redirect_uri'] = $redirect_uri;
        $data['section'] = $this->admin_model->getSectionByID($data);
        $this->LoadView('sections', $data);
    }

    public function updateSection()
    {
        if($this->input->post('submit')){

            $log = array(
                'row_id' => 0,
                'action_table' => 'section',
                'content' => $_POST,
                'event' => 'update'
            );
            $this->logs->add_log($log);

            $result = '';
            $data = array(
                'Section_ID' => $this->input->post('section_id'),
                'SectionName_en' => $this->input->post('name_en'),
                'SectionName_ar' => $this->input->post('name_ar'),
                'Subtitle_en' => $this->input->post('subtitle_en'),
                'Subtitle_ar' => $this->input->post('subtitle_ar'),
                'Section_BG_Clr' => $this->input->post('bg_color'),
                'Section_Text_Clr' => $this->input->post('txt_color')
            );

            // image options
            $image_options = array(
                'file' => 'bg_picture',
                'directory' => $GLOBALS['img_section_bg_dir'],
                'max_width' => 1920,
                'file_name' => date('Y-m-d H-i-s').'-bg'
            );
            $upload = UploadFile($image_options);
            if (is_array($upload) && array_key_exists('file_name', $upload))
            {
                $file_name = $upload['file_name'];
                $data['Section_BG_Image'] = $file_name;
            }

            $result = $this->admin_model->updateSection($data);
            if($result){
                $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
        redirect("acp/".str_replace("-","/",$this->input->post('redirect_uri')));
    }


    /*-----------------------------------------------------------
        ---------------------- #Functions -----------------
        --------------------------------------------------------*/

    // #generalLoadView function
    public function LoadView($view = array(), $data = array())
    {

        // get new orders count
        $data['newOrders'] = $this->admin_model->getNewOrders();
        $data['tickets'] = $this->admin_model->getNewTickets();
        $data['sidebarMenu'] = $this->admin_model->getSidebarMenu();
        $data['sidebarSubMenu'] = $this->admin_model->getSidebarSubMenu();
        // used for careers
        date_default_timezone_set('UTC');
        $today = date('Y-m-d H:i:s');
        $data['created_at'] = $this->db->select('DateApplied')->order_by('DateApplied', 'desc')->get('career_applications')->row();
        
        $timestamp = strtotime($today);
        $date = date('Y-m-d', $timestamp);
        //print_r($date);die();
        $data['number'] = $this->db->where('DateApplied >', $date)->get('career_applications')->num_rows();
        //echo '<pre>';print_r($data['tickets']);die();
        // ends
        // get website language
        $website_lang = $this->admin_model->GetWebsitetLanguage();
        // check for language from database if set to specific language
        $data['website_lang'] = $website_lang == 'en-ar' ? true : false; // means that if its multilangauge don't hide the tabs else hide in view

        if($website_lang == 'en-ar'){ // if website has both language then select lang from session
            if(empty($this->session->userdata($this->acp_session->__lang()))){
                $this->session->set_userdata($this->acp_session->__lang(), 'en');
            }
            $data[$this->acp_session->__lang()] = $this->session->userdata($this->acp_session->__lang());
        } else {
            $data[$this->acp_session->__lang()] = $website_lang; // it will be either `en` or `ar`
            $this->session->set_userdata($this->acp_session->__lang(), $website_lang);
        }

        /* print_r($data);
        die(); */

        $this->load->view('acp_includes/header', $data);
        $this->load->view($view, $data);
    }

    // #change Status
    public function ChangeStatus()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'status' => $this->input->post('status'),
            'tb_loc' => $this->input->post('tb_loc')
        );
        $result = $this->admin_model->ChangeStatus($data);
        echo $result;
    }

    // #change Order @it will be better to make the structure same as changing status function
    public function ChangeOrder()
    {
        // get the post key #which is fixed and its length will be equal to 1
        $result = $this->admin_model->ChangeOrder(array_keys($_POST)[0]);
        echo $result;
    }

    public function ckeditor()
    {
        $this->load->view('browse', $_GET);
    }

    public function CKUpload()
    {
        // image options
        $image_options = array(
            'file' => 'upload',
            'directory' => $GLOBALS['img_ck_dir'],
            'file_name' => date('Y-m-d H-i-s').'-ck',
            'valid_types' => 'gif|jpg|png|jpeg|pdf|docx|doc'
        );
        $upload = UploadFile($image_options);

        if (!is_array($upload) && !array_key_exists('file_name', $upload))
        {
            echo $upload;
            exit();
        }

        $upload_data = $upload;
        $file_name = $upload_data['file_name'];

        $funcNum = $this->input->get('CKEditorFuncNum'); //$_GET['CKEditorFuncNum']
        $url = base_url($GLOBALS['img_ck_dir'].$file_name);

        $message = 'Upload success!';
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";

    }

}
