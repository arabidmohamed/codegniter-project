<?PHP
	$data['show_message_register'] = '';
	$data['verify_page_token'] = $customer[0]->Verify_Page_Token;
	$data['profile_tr'] = 1;
	$data['phone'] = $phone;
	
	$this->load->view('snippets/verify_account', $data);
?>
