<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Keys extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "keys";
	
	function __construct()
	{
  	parent::__construct();
  	
  	//send controller name to views
  	$this->load->vars( array('__controller' => $this->thisCtrl));
    $this->load->model('keys_model');
	}

  	public function get_Keys()
  	{
      $log = array(
                    'row_id'       => 0,
                    'action_table' => 'keys',
                    'content'      => 0,
                    'event'        => 'select'
                  );

      $this->logs->add_log($log);

  		$data['keys'] = $this->keys_model->get_Keys();

  		$this->LoadView('keys/list',$data);
  	}


  	public function add_Key($key_id=0)
  	{
  		$data['key']  = array() ;

  		if($key_id!=0)
  		{
        $log = array(
                      'row_id'       => $key_id,
                      'action_table' => 'keys',
                      'content'      => $key_id,
                      'event'        => 'edit'
                    );

        $this->logs->add_log($log);

  			$data['key'] = $this->keys_model->get_Keys($key_id);
  		}

  		$this->LoadView('keys/add_key',$data);
  	}


  	public function save_Key()
  	{
  		$data = $this->input->post();

  		$i = array();

  		$i['key']            = $data['key']     ;
      $i['Name_en']        = $data['name_en'] ;
      $i['Name_ar']        = $data['name_ar'] ;
  		$i['level']			     = 0			          ;
  		$i['ignore_limits']	 = 0			          ;
  		$i['ip_address']	   = ''			          ;

  		if(!$data['key_id'])
  		{
        $i['is_private_key'] = 0 ;

        $key_id = $this->keys_model->save_Key($i);

        $log = array(
                      'row_id'       => $key_id,
                      'action_table' => 'keys',
                      'content'      => $_POST,
                      'event'        => 'add'
                    );

        $this->logs->add_log($log);

  		}
  		else
  		{
        $log = array(
                      'row_id'       => $data['key_id'],
                      'action_table' => 'keys',
                      'content'      => $_POST,
                      'event'        => 'update'
                    );

        $this->logs->add_log($log);

  			$this->keys_model->save_Key($i, $data['key_id']);
  		}

  		redirect('acp/keys/get_Keys');
  	}

  	public function delete_Key($key_id)
  	{
  		if($key_id)
  		{

        $log = array(
                      'row_id'       => $key_id,
                      'action_table' => 'keys',
                      'content'      => $_POST,
                      'event'        => 'delete'
                    );

        $this->logs->add_log($log);

  			$this->keys_model->delete_Key($key_id);

  			redirect('acp/keys/get_Keys');
  		}
  	}

    public function Change_Status()
    {
      $key_id   = $this->input->post('key_id');
      $status   = $this->input->post('new_status');

      if($key_id)
      {
        $set['is_private_key'] = $status ;

        $this->keys_model->change_Status($set,$key_id);

        $log = array(
                      'row_id'       => $key_id,
                      'action_table' => 'keys',
                      'content'      => $_POST,
                      'event'        => 'update'
                    );

        $this->logs->add_log($log);

        exit ;
      }

      echo 0 ;
    }

    public function Check_ForKey()
    {
      $key = $this->input->post('key');

      $flag = $this->keys_model->Check_ForKey($key);

      echo $flag ;
    }

}


?>