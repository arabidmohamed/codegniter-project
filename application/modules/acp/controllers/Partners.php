<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Partners extends Base_Controller
{

	// define controller
	protected $thisCtrl = "acp/partners";

	function __construct()
	{
    	parent::__construct();

    	//send controller name to views
		$this->load->vars( array('__controller' => $this->thisCtrl));

		$this->load->model('clients_model', 'clients');
  	}

	public function add_ADD()
	{
		$this->LoadView('clients/add');
	}

	public function add_POST()
	{
		if($this->input->post('submit'))
		{
			// $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_clients_dir']);
			// $result = '';
	  //       if (!$file)
	  //       {
			// 	$this->session->set_flashdata('requestMsgErr', 'Image has not been uploaded, please try again.');
			// 	redirect($this->thisCtrl.'/listall');
	  //       }

			if ($_FILES['fileToUpload']['size'] !== 0)
            {
                $config['upload_path'] = $GLOBALS['img_clients_dir'];
                $config['allowed_types'] = '*';
                $config['max_size'] = 0;
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);

                        if (!$this->upload->do_upload("fileToUpload")) {
                           //$error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('requestMsgErr', 119);
                           redirect($this->thisCtrl.'/listall');
                        } else {
                            $uploadedFile = $this->upload->data();
                            $updateData['Picture'] = $uploadedFile['file_name'];
                        }
             }

			$data = array(
				'Title_en' => $this->input->post('title_en'),
				'Title_ar' => $this->input->post('title_ar'),
				'Type' => $this->input->post('type'),
				'Client_Link' => $this->input->post('url'),
				'Picture' => $updateData['Picture'],
			);

			$result = $this->clients->add($data);

		    if($result)
		    {
		    	$clientID = $this->db->insert_id();

				$log = array(
								'row_id' 	   => $clientID,
								'action_table' => 'clients',
								'content'      => $_POST,
								'event'        => 'add'
							);

				$this->logs->add_log($log);

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
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'clients',
						'content'      => 0,
						'event'        => 'select'
					);

		$this->logs->add_log($log);

		$data['clients'] = $this->clients->listall();
		//echo '<pre>';print_r($data['clients']);die();
		$this->LoadView('clients/list', $data);
	}

		// #edit clients
	public function edit_EDIT($clientID = 0)
	{
		$log = array(
						'row_id' 	   => $clientID,
						'action_table' => 'clients',
						'content'      => $clientID,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['client_id'] = $clientID;
		$data['client']    = $this->clients->getByID($data);

		$this->LoadView('clients/edit', $data);
	}

	// #update clients
	public function edit_POST()
	{
		if($this->input->post('submit'))
		{
			$id = $this->input->post('client_id');
			$title_en = $this->input->post('title_en');
			$title_ar = $this->input->post('title_ar');
			$link = $this->input->post('url');

            $data['client_id'] = $id;
            $images = $this->clients->getByID($data);

            foreach($images as $img){
                if(strlen($img->Picture) > 0){
                    unlink('./'.$GLOBALS['img_clients_dir'].$img->Picture);
                }
            }

			$result = '';
			$updateData = array(
									'Client_ID' => $id,
									'Title_en' => $title_en,
									'Title_ar' => $title_ar,
									'Type' => $this->input->post('type'),
									'Client_Link' => $link
								);
	   //      if ($_FILES['fileToUpload']['size'] !== 0)
	   //      {
		  //       $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_clients_dir']);
				// $updateData['Picture'] = substr($file, strrpos($file, '/') + 1);
	   //      }


            if ($_FILES['fileToUpload']['size'] !== 0)
            {
                $config['upload_path'] = $GLOBALS['img_clients_dir'];
                $config['allowed_types'] = '*';
                $config['max_size'] = 0;
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);

                        if (!$this->upload->do_upload("fileToUpload")) {
                           //$error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('requestMsgErr', 119);
                           redirect($this->thisCtrl.'/listall');
                        } else {
                            $uploadedFile = $this->upload->data();
                            $updateData['Picture'] = $uploadedFile['file_name'];
                        }
             }

					//echo '<pre>';print_r($updateData);die();

			$result = $this->clients->update($updateData);

	        if($result)
	        {
	        	$log = array(
								'row_id'       => $id,
								'action_table' => 'clients',
								'content'      => $_POST,
								'event'        => 'update'
							);

				$this->logs->add_log($log);

	            $this->session->set_flashdata('requestMsgSucc', 120);
	        }
	        else
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}
		redirect($this->thisCtrl.'/listall');
	}

	// #delete clients function
	public function delete_DELETE($clientID = 0)
	{
        $data['client_id'] = $clientID;
        $images = $this->clients->getByID($data);

        foreach($images as $img){
            if(strlen($img->Picture) > 0){
                unlink('./'.$GLOBALS['img_clients_dir'].$img->Picture);
            }
        }
		$log = array(
						'row_id' => 0,
						'action_table' => 'clients',
						'content' => $clientID,
						'event' => 'delete'
					);

		$this->logs->add_log($log);

		$data['client_id'] = $clientID;

		$result = $this->clients->delete($data);

		if($result)
		{
        	$log = array(
							'row_id'       => $clientID,
							'action_table' => 'clients',
							'content'      => $clientID,
							'event'        => 'delete'
						);

			$this->logs->add_log($log);

            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
		redirect($this->thisCtrl.'/listall');
	}
}
