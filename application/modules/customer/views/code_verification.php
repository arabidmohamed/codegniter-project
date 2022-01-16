<?PHP
	$data['show_message_register'] = $show_message_register;
	$data['verify_page_token'] = $verify_page_token;
	$data['profile_tr'] = 0;
	$data['phone'] = $phone;
	
	$this->load->view('snippets/verify_account', $data);
?>