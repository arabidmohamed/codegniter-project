<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Pages extends Base_Controller {

    // define controller
    protected $thisCtrl = "acp/pages";

    function __construct()
    {
        parent::__construct();

        //send controller name to views
        $this->load->vars(array('__controller' => $this->thisCtrl));
        $this->load->model('pages_model', 'pages');
        $this->load->model('admin_model');
    }

    public function listall_GET()
    {
        $data['pages'] = $this->pages->listall();
        $this->LoadView('pages/list', $data);
    }


    public function edit_EDIT($pages_id = 0)
    {
        $data['page_id'] = $pages_id;
        $data['page'] = $this->pages->listall($pages_id);

        if ($data['page']->Id == 20) {
            $data['contactus'] = $this->pages->contactus();
            $this->LoadView('contact-us/section_contactus', $data);
        } else {
        $this->LoadView('pages/edit', $data);
        }
    }

     public function edit_POST($pages_id = 0)
    {
        
        if($this->input->post('submit'))
        {


            //echo $this->input->post('phone'); exit();
            $pages = array(
                'Id' => $pages_id,
                'Page_title_ar' => $this->input->post('page-title-ar'),
                'Page_title_en' => $this->input->post('page-title-en'),
                'Page_Description_ar' => $this->input->post('page-description-ar'),
                'Page_Description_en' => $this->input->post('page-description-en'),
                'Content_en' => $this->input->post('editor1'),
                'Content_ar' => $this->input->post('editor2'),
                'Keyword' => $this->input->post('keyword'),
                'Prefix_ar' => url_title($this->input->post('page-title-ar'), 'dash', true),
                'Prefix_en' => url_title($this->input->post('page-title-en'), 'dash', true)
            );

            if($this->input->post('email') !=''){
            $data = array(
                'Email' => $this->input->post('email'),
                'Phone' => $this->input->post('phone'),
                'Company_Address_en' => $this->input->post('Company_Address_en'),
                'Company_Address_ar' => $this->input->post('Company_Address_ar'),
                'Embed_Map' => $this->input->post('map')
            );
            //echo '<pre>';print_r($data);die();
            $result1 = $this->admin_model->updateContactus($data);
            }




    if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name'])) {
          $config['upload_path'] = $GLOBALS['img_news_dir'];
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

       
              if (!$this->upload->do_upload("fileToUpload")) {
                 $this->session->set_flashdata('requestMsgErr', getSystemString('system_error_msg'));
                redirect($this->thisCtrl.'/edit');
              
            } else {               
                $uploadedFileData = $this->upload->data();
                $otherrandomName = md5(time()) .'-pages'. $uploadedFileData['file_ext'];
                rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $otherrandomName);
               // $uploadedFileData["file_name"] = $otherrandomName;

                $pages['Original_Img'] = $otherrandomName;

            }

    }



            $result = $this->pages->update($pages);

            

            $log = array(
                'row_id'       => 1,
                'action_table' => 'pages',
                'content'      => $_POST,
                'event'        => 'update'
            );

            $this->logs->add_log($log);

            if($result){
                $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }

            redirect($this->thisCtrl.'/listall');
        }
    }

    public function delete_DELETE($id = 0)
    {

        $result = $this->pages->delete($id);
        if($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl.'/listall');
    }



    public function rolesManagement()
    {
        $this->LoadView('pages/roles_permissions/assign');
    }

    public function getRolesAndMenus()
    {
        echo json_encode($this->pages->getRolesAndMenus());
    }

    public function updatePermissions()
    {
        if($this->input->post('submit'))
        {
            $rolesPermissions = $this->input->post('rolesPermissions');
            $result = false;

            // truncate permissions table
            $this->pages->truncateRolePermissions();

            $rolesPermissions = explode(",", $rolesPermissions);
            foreach($rolesPermissions as $rp)
            {
                $rp = explode("_", $rp);

                if($rp[0] == 'li')
                {
                    $permissions = array(
                        'Role_ID' => $rp[1],
                        'MenuAction_ID' => $rp[2]
                    );
                    $result = $this->pages->addRolesPermissions($permissions);
                }
            }

            if($result){
                $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }

            redirect($this->thisCtrl.'/rolesManagement');
        }
    }

}