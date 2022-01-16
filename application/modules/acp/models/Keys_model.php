<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Keys_model extends CI_Model
{
	function __construct()
	{
    	parent::__construct();
  	}

  	public function get_Keys($key_id=0)
  	{
  		if($key_id!=0)
  		{
  			return $this->db->where('id',$key_id)->get('keys')->row_array();
  		}

  		return $this->db->get('keys')->result_array();
  	}

  	public function save_Key($data,$key_id=0)
  	{
  		if($key_id==0)
  		{
  			$this->db->insert('keys',$data); ;

  			return $this->db->insert_id();
  		}
  		else
  		{
  			return $this->db->set($data)->where('id',$key_id)->update('keys');
  		}
  	}

  	public function delete_Key($key_id)
  	{
  		return $this->db->where('id',$key_id)->delete('keys');
  	}

  	public function Check_ForKey($key)
  	{
  		return $this->db->where('key',$key)->get('keys')->num_rows();
  	}

  	public function change_Status($set,$key_id)
  	{
  		return $this->db->set($set)->where('id',$key_id)->update('keys') ;
  	}
}

?>