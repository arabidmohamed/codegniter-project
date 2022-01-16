<?PHP
class Roles_model extends CI_Model
{
    public function add($role = array())
    {
        $this->db->insert("users_roles", $role);
        return $this->db->insert_id();
    }

    public function listAll()
    {
        return $this->db->where("Type", "admin")->get("users_roles")->result();
    }

    public function getRole($roleid = 0)
    {
        return $this->db->where("Role_ID", $roleid)->get("users_roles")->row();
    }

    public function delete($roleid = '')
    {
        return $this->db->where("Role_ID", $roleid)->delete("users_roles");
    }

    public function update($role = array()){
        return $this->db->where("Role_ID", $role['Role_ID'])->update("users_roles", $role);
    }

    public function getDefaultPermissions()
    {
        $q = $this->db->select("ma.MA_ID")
            ->from("rbac_menus as m")
            ->join("rbac_menu_actions as ma", "ma.Menu_ID = m.Id")
            ->where("m.DefaultSelected", 1)
            ->get();

        return $q->result();
    }

    public function getPermissions($roleid)
    {
        return $this->db->where("Role_ID", $roleid)->get("rbac_roles_permissions")->result();
    }

    public function deletePermissions($roleid)
    {
        return $this->db->where("Role_ID", $roleid)->delete("rbac_roles_permissions");
    }

    public function addPermission($permission = array(), $checkParent = false)
    {
        if($checkParent){
            $c = $this->db->where("Role_ID", $roleid)->where('Menu_ID', $permission['Menu_ID'])->get("rbac_roles_permissions")->num_rows();
            if($c > 0){
                return true;
            }
        }
        $this->db->insert("rbac_roles_permissions", $permission);
        return $this->db->insert_id();
    }
}

?>