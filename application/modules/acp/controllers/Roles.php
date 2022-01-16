<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Roles extends Base_Controller
{
	
	// define controller
	protected $thisCtrl = "acp/roles";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
		$this->load->model("roles_model", "roles");
		$this->load->model("menu_model", "menus");
  	}
	
	public function add_ADD()
	{
		$data['actions'] = $this->menus->getMenuActions();
		$data['pages'] = $this->menus->getMenusForPermissions();
		$this->LoadView('roles/add', $data);
	}
	
	public function add_POST()
	{
		if($this->input->post('submit'))
		{
			$log = array(
				'row_id'       => 0,
				'action_table' => 'add',
				'content'      => $_POST,
				'event'        => 'add'
			);

			$this->logs->add_log($log);

			$role =  $this->input->post('role');
			$role =  strtolower(str_replace(' ', '_', $role));

			$data = array(
				'Role' => $role,
				'Name' => $this->input->post('role')
			);
			
			$role_id = $this->roles->add($data);
	        
		    if($role_id)
		    {
				$actions = $this->input->post('action');
				foreach($actions as $action)
				{
					$action = explode("_",$action); // [menu id, action id, parent id(optional)]
					// main menu
					$permission = array(
						"Role_ID" => $role_id,
						"Menu_ID" => $action[0],
						"Action_ID" => $action[1]
					);
					$this->roles->addPermission($permission);

					// submenu
					if(isset($action[2])){
						$permission = array(
							"Role_ID" => $role_id,
							"Menu_ID" => $action[2],
							"Action_ID" => $action[1]
						);
						$this->roles->addPermission($permission, true);
					}
				}
				
	            $this->session->set_flashdata('requestMsgSucc', 121);
	        }
	        else
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }	
		}

		redirect($this->thisCtrl.'/listall');
	}
		
	public function listall_GET()
	{
		$data['roles'] = $this->roles->listAll();
		
		$this->LoadView('roles/listall', $data);
	}
	
	public function edit_EDIT($role_id = 0)
	{
		$data['role'] = $this->roles->getRole($role_id);
		$data['actions'] = $this->menus->getMenuActions();
		$data['pages'] = $this->menus->getMenusForPermissions();
		$data['permissions'] = $this->roles->getPermissions($role_id);
		$this->LoadView('roles/edit', $data);
	}

	public function edit_POST()
	{
		if($this->input->post('submit'))
		{
			$log = array(
				'row_id'       => 0,
				'action_table' => 'edit',
				'content'      => $_POST,
				'event'        => 'edit'
			);

			$this->logs->add_log($log);

			$role =  $this->input->post('role');
			$role =  strtolower(str_replace(' ', '_', $role));

			$data = array(
				'Role_ID' => $this->input->post('role_id'),
				'Role' => $role,
				'Name' => $this->input->post('role')
			);
			
			$result = $this->roles->update($data);
	        
		    if($result)
		    {	
				$roleID = $this->input->post('role_id');
				$this->roles->deletePermissions($roleID);
				$actions = $this->input->post('action');
				foreach($actions as $action)
				{
					$action = explode("_",$action); // [menu id, action id, parent id(optional)]
					$permission = array(
						"Role_ID" => $roleID,
						"Menu_ID" => $action[0],
						"Action_ID" => $action[1]
					);
					$this->roles->addPermission($permission);

					if(isset($action[2])){
						$permission = array(
							"Role_ID" => $roleID,
							"Menu_ID" => $action[2],
							"Action_ID" => $action[1]
						);
						$this->roles->addPermission($permission, true);
					}
				}
	            $this->session->set_flashdata('requestMsgSucc', 121);
	        }
	        else
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }	
		}

		redirect($this->thisCtrl.'/listall');
	}

	public function delete_DELETE($roleID = 0)
	{
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'roles',
						'content'      => $clientID,
						'event' 	   => 'delete'
					);

		$this->logs->add_log($log);

		$result = $this->roles->delete($roleID);

		if($result)
		{
            $this->session->set_flashdata('requestMsgSucc', 122);
        } 
        else 
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }

		redirect($this->thisCtrl.'/listall');
	}
}