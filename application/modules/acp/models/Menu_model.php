<?PHP
class Menu_model extends CI_Model
{
    /*
        * Menu CRUD
    */
    public function add($menu = array())
    {
        $this->db->insert('rbac_menus', $menu);
        return $this->db->insert_id();
    }

    public function listall($id = '', $is_sidebar = false)
    {
        if(!empty($id))
        {
            $this->db->where('m.Id', $id);
        }

        if($is_sidebar)
        {
            $this->db->where('m.Is_SideBar_Menu', 1);
        }

        $query = $this->db
            ->select("m.*")
            ->from("rbac_menus as m")
            ->order_by('m.Id', 'DESC')
            ->get();

        //die($this->db->last_query());

        if(!empty($id))
        {
            return $query->row();
        }

        return $query->result();
    }


    public function update($menu = array())
    {
        return $this->db->where("Id", $menu["Id"])->update("rbac_menus", $menu);
    }

    public function delete($id = 0)
    {

//        // Added by Yasir on 14 Oct 2019
//        $result = $this->db->where('Id', $id)->get('rbac_menus')->row();
//        $table_name = $result->Table_Name;
//        if ($table_name) {
//            $this->load->dbforge();
//            $this->dbforge->drop_table($table_name);
//        }

        return $this->db->where("Id", $id)->delete("rbac_menus");
    }

    // Added by Yasir on 14 Oct 2019

    /*
     * This function will get all tables form database.
     */
    public function getMenuActions()
    {
        return $this->db->order_by('Order_In_List')->get("rbac_actions")->result();
    }

    public function list_tables() {
        return $this->db->list_tables();
    }



    public function getRolesAndMenus()
    {
        $roles = $this->db
            ->select('Role_ID, Name as text, "0" as children, "1" as state')
            ->from('users_roles')
            ->where('Type', 'admin')
            ->get()
            ->result();

        foreach($roles as $role)
        {

            $role->state = (object)array('opened' => false);

            // get role menus
            $roleMenu = $this->db
                ->select('ma.MA_ID')
                ->from('rbac_menus as m')
                ->join("rbac_menu_actions as ma", "ma.Menu_ID = m.Id")
                ->join("rbac_actions as a", "a.Action_ID = ma.Action_ID")
                ->join("rbac_roles_permissions as p", "p.MenuAction_ID = ma.MA_ID")
                ->where("p.Role_ID", $role->Role_ID)
                ->get()
                ->result();

            $role->children = $this->db
                ->select('Action_Key as text, "0" as children, "1" as state')
                ->get('rbac_actions')
                ->result();

            foreach($role->children as $action)
            {
                $action->state = (object)array('opened' => false);

                $action->children = $this->db
                    ->select('Menu_Key as text, ma.MA_ID as id, "1" as a_attr, "2" as li_attr, "3" as state')
                    ->from('rbac_menus as m')
                    ->join("rbac_menu_actions as ma", "ma.Menu_ID = m.Id")
                    ->join("rbac_actions as a", "a.Action_ID = ma.Action_ID")
                    ->where('a.Action_Key', $action->text)
                    ->get()
                    ->result();

                foreach($action->children as $ac)
                {
                    $ac->li_attr = (object)array('id' => 'li_'.$role->Role_ID.'_'.$ac->id);
                    $ac->a_attr = (object)array('id' => 'a_'.$role->Role_ID.'_'.$ac->id);

                    // get role menu for default selection
                    foreach($roleMenu as $rm)
                    {
                        if($rm->MA_ID == $ac->id)
                        {
                            $ac->state = (object)array('selected' => true, 'opened' => false);
                        }
                    }

                    unset($ac->id);
                }
            }
        }

        return $roles;
    }

    public function truncateRolePermissions()
    {
        $this->db->where("Role_ID != 1")->delete("rbac_roles_permissions");
    }

    public function addRolesPermissions($rp = array())
    {
        $this->db->insert("rbac_roles_permissions", $rp);
        return $this->db->insert_id();
    }

    public function getMenusForPermissions()
    {
        $pages = $this->db
            ->select('m.*, wf.*')
            ->from('rbac_menus as m')
            ->join("website_features as wf", "m.Id = wf.PID")
            ->where('Status', 1)
            ->order_by('wf.Order_In_List', 'asc')
            ->get();

        $pages = $pages->result();
        foreach($pages as $page){
            $page->SubMenu = $this->db->where('Parent_ID', $page->Id)->get('rbac_menus')->result();
        }

        return $pages;
    }
}
?>