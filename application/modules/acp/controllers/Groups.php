<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Groups extends Base_Controller
{
	
	// define controller
	protected $thisCtrl = "acp/groups";

	function __construct()
	{
    	parent::__construct();

    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
		$this->load->model("groups_model", "groups");
  	}

	public function add($Role_id=0)
	{
		$data['pages'] = $this->groups->get_menus() ;

		if($Role_id!=0)
		{
			$data['permissions'] = $this->groups->user_permissions($Role_id) ;
			$data['user_role']   = $this->groups->get_userroles($Role_id) ;
			$data['Role_id']     = $Role_id ;
		}

		$this->LoadView('groups/add',$data);
	}
	
	public function add_POST()
	{
		if($this->input->post('submit'))
		{
			$log = array(
							'row_id'       => 0,
							'action_table' => 'groups',
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

			$Role_id = $this->input->post('Role_id') ;

			$view_flags   = $this->input->post('view_flag')   ;
			$edit_flags   = $this->input->post('edit_flag')   ;
			$delete_flags = $this->input->post('delete_flag') ;

			if($Role_id)
			{
				$result = $this->groups->update($data,$Role_id) ;

				$permissions = $this->groups->user_permissions($Role_id) ;

				if($permissions)
				{
					$update['Role_id'] = $Role_id ;
					$update['status']  = 1        ;

					foreach ($permissions as $key => $permission) 
					{
						//$update['Page_id']     = $page->id ;
						$update['view_flag']   = (@$view_flags[$permission['Page_id']]=='on')   ? 1 : 0 ;
						$update['edit_flag']   = (@$edit_flags[$permission['Page_id']]=='on')   ? 1 : 0 ;
						$update['delete_flag'] = (@$delete_flags[$permission['Page_id']]=='on') ? 1 : 0 ;

						$this->groups->update_permissions($update,$permission['id']);
					}
				}
				else
				{
					$pages = $this->groups->get_menus() ;

					$insert['Role_id'] = $Role_id ;
					$insert['status']  = 1 ;

					foreach ($pages as $key => $page)
					{
						$insert['Page_id']     = $page->id ;
						$insert['view_flag']   = (@$view_flags[$page->id]=='on')   ? 1 : 0 ;
						$insert['edit_flag']   = (@$edit_flags[$page->id]=='on')   ? 1 : 0 ;
						$insert['delete_flag'] = (@$delete_flags[$page->id]=='on') ? 1 : 0 ;

						$this->groups->save_permissions($insert) ;
					}
				}
			}
			else
			{	
				$result = $this->groups->add($data,$Role_id);

				$role_id = $result ;

				if($role_id)
				{
					$pages = $this->groups->get_menus() ;

					$insert['Role_id'] = $role_id ;
					$insert['status']  = 1 ;

					foreach ($pages as $key => $page) 
					{
						$insert['Page_id']     = $page->id ;
						$insert['view_flag']   = (@$view_flags[$page->id]=='on')   ? 1 : 0 ;
						$insert['edit_flag']   = (@$edit_flags[$page->id]=='on')   ? 1 : 0 ;
						$insert['delete_flag'] = (@$delete_flags[$page->id]=='on') ? 1 : 0 ;

						$this->groups->save_permissions($insert) ;
					}
				}
			}

	        
		    if($result)
		    {
	            $this->session->set_flashdata('requestMsgSucc', 121);
	        }
	        else
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }	
		}

		redirect($this->thisCtrl.'/listall');
	}
		
	public function listall()
	{
		$data['roles'] = $this->groups->listAll();
		
		$this->LoadView('groups/listall', $data);
	}
	
	public function delete($roleID = 0)
	{
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'roles',
						'content'      => $clientID,
						'event' 	   => 'delete'
					);

		$this->logs->add_log($log);

		$result = $this->groups->delete($roleID);

		if($result)
		{
			$this->groups->delete_permissions($roleID) ;

            $this->session->set_flashdata('requestMsgSucc', 122);
        } 
        else 
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }

		redirect($this->thisCtrl.'/listall');
	}
}