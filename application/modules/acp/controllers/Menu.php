<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Menu extends Base_Controller {

    // define controller
    protected $thisCtrl = "acp/menu";

    function __construct()
    {
        parent::__construct();

        //send controller name to views
        $this->load->vars(array('__controller' => $this->thisCtrl));
        $this->load->model('menu_model', 'menu');
    }

    public function listall_GET()
    {
        $data['menus'] = $this->menu->listall();
        $this->LoadView('menu/list', $data);
    }

    public function add_ADD()
    {
        $data['actions'] = $this->menu->getMenuActions();
        $data['menus'] = $this->menu->listall('', true);
        $data['list_tables'] = $this->menu->list_tables();
        $this->LoadView('menu/add', $data);
    }

    public function add_POST()
    {
        if($this->input->post('submit'))
        {
            $menu = array(
                'Parent_ID' => $this->input->post('parentMenu'),
                'Menu_String_Key' => $this->input->post('localizationKey'),
                'Menu_Key' => $this->input->post('menuName'),
                'Link' => $this->input->post('link'),
                'Icon' => $this->input->post('icon'),
                'JS_Function' => $this->input->post('jsFunction'),
                'Is_SideBar_Menu' => $this->input->post('isSidebarMenu') ? 1 : 0,
                'DefaultSelected' => $this->input->post('defaultSelected') ? 1 : 0
            );

            $result = $this->menu->add($menu);

            if($result){
                $this->session->set_flashdata('requestMsgSucc', 121);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }

            redirect($this->thisCtrl.'/listall');
        }
    }

    public function edit_EDIT($menu_id = 0)
    {
        $data['menu_id'] = $menu_id;
        $data['menu'] = $this->menu->listall($menu_id);
        $data['menus'] = $this->menu->listall('', true);
        $data['list_tables'] = $this->menu->list_tables();
        $this->LoadView('menu/edit', $data);
    }

    public function edit_POST($menu_id = 0)
    {
        if($this->input->post('submit'))
        {
            $menu = array(
                'Id' => $menu_id,
                'Parent_ID' => $this->input->post('parentMenu'),
                'Menu_String_Key' => $this->input->post('localizationKey'),
                'Menu_Key' => $this->input->post('menuName'),
                'Link' => $this->input->post('link'),
                'Icon' => $this->input->post('icon'),
                'JS_Function' => $this->input->post('jsFunction'),
                'Is_SideBar_Menu' => $this->input->post('isSidebarMenu') ? 1 : 0,
                'DefaultSelected' => $this->input->post('defaultSelected') ? 1 : 0
            );

            $result = $this->menu->update($menu);

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

        $result = $this->menu->delete($id);
        if($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl.'/listall');
    }



    public function getRolesAndMenus()
    {
        echo json_encode($this->menu->getRolesAndMenus());
    }

    public function updatePermissions()
    {
        if($this->input->post('submit'))
        {
            $rolesPermissions = $this->input->post('rolesPermissions');
            $result = false;

            // truncate permissions table
            $this->menu->truncateRolePermissions();

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
                    $result = $this->menu->addRolesPermissions($permissions);
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