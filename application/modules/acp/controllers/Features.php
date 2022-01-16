<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Features extends Base_Controller {

    // define controller
    protected $thisCtrl = "acp/features";

    function __construct()
    {
        parent::__construct();

        //send controller name to views
        $this->load->vars(array('__controller' => $this->thisCtrl));
        $this->load->model('features_model', 'feature');
    }

    public function listall_GET()
    {
        $data['features'] = $this->feature->listall();
        $data['wbs'] = $this->admin_model->getSettings();
        $this->LoadView('feature/list', $data);
    }

    public function add_ADD()
    {
        $data['features'] = $this->feature->listall('', true);
        $data['rbac_menus'] = $this->feature->rbac_menus();

        $this->LoadView('feature/add', $data);
    }

    public function add_POST()
    {
        if($this->input->post('submit'))
        {
            $feature = array(
                'PID' => $this->input->post('pid'),
                'Name_ar' => $this->input->post('nameAr'),
                'Name_en' => $this->input->post('nameEn'),
                'Website_Link' => $this->input->post('websiteLink'),
                'Is_Header' => $this->input->post('isHeader') ? 1 : 0,
                'Is_Footer' => $this->input->post('isFooter') ? 1 : 0,
            );

            $this->feature->add($feature);

            redirect($this->thisCtrl.'/listall');
        }
    }

    public function edit_EDIT($feature_id = 0)
    {
        $data['feature_id'] = $feature_id;
        $data['feature'] = $this->feature->listall($feature_id);
        $data['rbac_menus'] = $this->feature->rbac_menus();


        $this->LoadView('feature/edit', $data);
    }

    public function edit_POST($feature_id = 0)
    {
        if($this->input->post('submit'))
        {
            $feature = array(
                'FID' => $feature_id,
                'PID' => $this->input->post('pid'),
                'Name_ar' => $this->input->post('nameAr'),
                'Name_en' => $this->input->post('nameEn'),
                'Website_Link' => $this->input->post('websiteLink'),
                'Is_Header' => $this->input->post('isHeader') ? 1 : 0,
                'Is_Footer' => $this->input->post('isFooter') ? 1 : 0
            );

            $result = $this->feature->update($feature);

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

        $result = $this->feature->delete($id);
        if($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl.'/listall');
    }

    public function updateLanguage_POST()
    {
        if($this->input->post('submit'))
        {
            $log = array(
                'row_id' 	   => 0,
                'action_table' => 'features website language',
                'content' 	   => $_POST,
                'event' 	   => 'update'
            );

            $this->logs->add_log($log);

            if($this->input->post('website_language'))
            {
                $data['Website_Language'] = $this->input->post('website_language');
            }

            $result = $this->admin_model->updateSettings($data);

            if($result){
                $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }

        redirect($this->thisCtrl.'/features/listall');
    }





    public function rolesManagement()
    {
        $this->LoadView('feature/roles_permissions/assign');
    }

    public function getRolesAndMenus()
    {
        echo json_encode($this->features->getRolesAndMenus());
    }

    public function updatePermissions()
    {
        if($this->input->post('submit'))
        {
            $rolesPermissions = $this->input->post('rolesPermissions');
            $result = false;

            // truncate permissions table
            $this->feature->truncateRolePermissions();

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
                    $result = $this->feature->addRolesPermissions($permissions);
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