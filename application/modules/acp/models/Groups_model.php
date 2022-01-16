<?PHP
	class Groups_model extends CI_Model
	{
		public function add($role = array())
		{
			$this->db->insert("groups", $role);
			return $this->db->insert_id();
		}
		

		public function update($data,$roleid)
		{
			return $this->db->set($data)->where('Role_ID',$roleid)->update('groups') ;
		}


		public function listAll()
		{
			return $this->db->where("Type", "admin")->get("groups")->result();
		}
		
		public function delete($roleid = '')
		{
			return $this->db->where("Role_ID", $roleid)->delete("groups");
		}

		public function get_menus($page_id=0)
		{
			return $this->db->get('project_pages')->result();
		}

		public function save_permissions($data)
		{
			return $this->db->insert('group_permissions',$data);
		}

		public function update_permissions($data,$permission_id)
		{
			return $this->db->set($data)->where('id',$permission_id)->update('group_permissions') ;
		}

		public function user_permissions($Role_id)
		{
			return $this->db->where('Role_id',$Role_id)->get('group_permissions')->result_array();
		}

		public function delete_permissions($Role_id)
		{
			return $this->db->where('Role_id',$Role_id)->delete('group_permissions');
		}

		public function get_userroles($Role_id)
		{
			return $this->db->where('Role_ID',$Role_id)->get('groups')->row_array();
		}

	}
	
?>