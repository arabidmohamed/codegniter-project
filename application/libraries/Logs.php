<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs {
	
		public function add_log($data = array())
		{
			@date_default_timezone_set('UTC');
			
			$CI =& get_instance();
			$CI->load->model('acp/admin_model');
			
			$CI->load->library('Acp_Session');
			
			$log = array(
				'User_ID' => @$_SESSION[$CI->acp_session->userid()] == null ? '' : $_SESSION[$CI->acp_session->userid()],
				'IP_Address' => $_SERVER['REMOTE_ADDR'],
				'Change_Row_ID' => $data['row_id'],
				'Action_Table' => $data['action_table'],
				'Content' => json_encode($data['content']),
				'Event_Performed' => $data['event']
			);
			$CI->admin_model->add_log($log);
		}
		
		
		// customer logs
		public function add_log_customer($data = array())
		{
			@date_default_timezone_set('UTC');
			
			$CI =& get_instance();
			$CI->load->model('customer/customer_model');
			
			$CI->load->library('Site_Session');
			
			$log = array(
				'User_ID' => @$_SESSION[$CI->site_session->userid()] == null ? '' : $_SESSION[$CI->site_session->userid()],
				'IP_Address' => $_SERVER['REMOTE_ADDR'],
				'Change_Row_ID' => $data['row_id'],
				'Action_Table' => $data['action_table'],
				'Content' => json_encode($data['content']),
				'Event_Performed' => $data['event']
			);
			$CI->customer_model->add_log($log);
		}
}
?>