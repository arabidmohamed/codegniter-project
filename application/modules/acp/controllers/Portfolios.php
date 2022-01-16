<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Portfolios extends Base_Controller {
	// define controller
	protected $thisCtrl = "acp/portfolios";

	function __construct()
	{
    	parent::__construct();

    	$this->load->model('portfolio_model', 'portfolio');
    	// send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
  	}


	// #categories view function
	public function new_category_ADD()
	{
		$this->LoadView('portfolio/categories/add_category');
	}

	// #add-category function
	public function addCategory_ADD()
	{
		if($this->input->post('submit'))
		{
			$name_en = $this->input->post('name_en');
			$name_ar = $this->input->post('name_ar');

			if(strlen($name_en) < 2 && strlen($name_ar) < 2)
			{
				$this->session->set_flashdata('requestMsgErr', 125);
				redirect($this->thisCtrl.'/categories');
			}
			$data = array(
				'Category_en' => $name_en,
				'Category_ar' => $name_ar
			);
			$result = $this->portfolio->addCategory($data);

			$Category_ID = $this->db->insert_id();

			if($result)
			{
				$log = array(
								'row_id' 	   => $Category_ID,
								'action_table' => 'portfolios categories',
								'content' 	   => $_POST,
								'event' 	   => 'add'
							);

				$this->logs->add_log($log);

	            $this->session->set_flashdata('requestMsgSucc', 121);
	        }
	        else
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}
		redirect($this->thisCtrl.'/categories_list');
	}

	public function addCategory_HTTP_POST()
	{
		$name_ar = $this->input->post('option_ar');
		$name_en = $this->input->post('option_en');

		$data = array(
			'Category_en' => $name_en,
			'Category_ar' => $name_ar
		);
		$category_id = $this->portfolio->addCategory($data);
		echo json_encode(array('id' => $category_id));
	}

	public function categories_list_GET()
	{
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'portfolios categories',
						'content' 	   => 0,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['categories'] = $this->portfolio->getCategories();
		$this->LoadView('portfolio/categories/manage_categories', $data);
	}

	// #edit service
	public function editCategory_EDIT($categoryID = 0)
	{
		$log = array(
						'row_id' 	   => $categoryID,
						'action_table' => 'portfolios categories',
						'content' 	   => $categoryID,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['category_id'] = $categoryID;
		$data['category'] = $this->portfolio->getCategoryByID($data);
		$this->LoadView('portfolio/categories/manage_categories', $data);
	}

	// #update service
	public function updateCategory_EDIT()
	{
		if($this->input->post('submit'))
		{
			$name_en = $this->input->post('name_en');
			$name_ar = $this->input->post('name_ar');
			$id      = $this->input->post('category_id');
			$name    = $this->input->post('name');

			if(strlen($name_en) < 2 && strlen($name_ar) < 2)
			{
				$this->session->set_flashdata('requestMsgErr', 125);
				redirect($this->thisCtrl.'/categories');
			}

			$updateData = array(
									'Category_ID' => $id,
									'Category_en' => $name_en,
									'Category_ar' => $name_ar
								);

			$result = $this->portfolio->updateCategory($updateData);

	        if($result)
	        {
				$log = array(
								'row_id' 	   => $id,
								'action_table' => 'portfolios categories',
								'content' 	   => $_POST,
								'event' 	   => 'update'
							);

				$this->logs->add_log($log);

	            $this->session->set_flashdata('requestMsgSucc', 120);
	        }
	        else
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }

		}
		redirect($this->thisCtrl.'/categories_list');
	}

	// #delete service function
	public function deleteCategory_DELETE($categoryID = 0)
	{
		$data['category_id'] = $categoryID;
		$result = $this->portfolio->deleteCategory($data);

		if($result)
		{
			$log = array(
							'row_id' 	   => $categoryID,
							'action_table' => 'portfolios categories',
							'content' 	   => $categoryID,
							'event' 	   => 'delete'
						);

			$this->logs->add_log($log);

            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {

            $this->session->set_flashdata('requestMsgErr', 119);
        }
		redirect($this->thisCtrl.'/categories_list');
	}

	/*-----------------------------------------------------------
		---------------------- Portfolios -----------------
		--------------------------------------------------------*/
		// #work view function
	public function add_ADD()
	{
		$data['categories'] = $this->portfolio->getActivecategories();
		$this->LoadView('portfolio/add', $data);
	}

	// #add portfolio function
	public function add_POST()
	{
		if($this->input->post('submit'))
		{





			$insertData = array(
				'Category_ID' => 1,
				'Title_en' => $this->input->post('title_en'),
				'Title_ar' => $this->input->post('title_ar'),
				'Link' => $this->input->post('portfolio_link'),
				'PortfolioType' => 'pic'
			);


				if ($_FILES['fileToUpload']['size'] !== 0)
	        	{
					$file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_work_dir']);
					$insertData['Thumbnail'] = substr($file, strrpos($file, '/') + 1);
				}

				$result = $this->portfolio->add($insertData);


			if($result)
			{

				$log = array(
								'row_id' 	   => 1,
								'action_table' => 'portfolios',
								'content' 	   => $_POST,
								'event' 	   => 'add'
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

	// #manage-portfolios function
	public function listall_GET()
	{
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'portfolios',
						'content' 	   => 0,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['categories'] = $this->portfolio->getCategories();
		$data['portfolios'] = $this->portfolio->getAll();
		$this->LoadView('portfolio/list', $data);
	}

	// #edit portfolio
	public function edit_EDIT($portfolio_id = 0)
	{
		$log = array(
						'row_id' 	   => $portfolio_id,
						'action_table' => 'portfolios',
						'content' 	   => $portfolio_id,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['categories'] = $this->portfolio->getcategories();
		$data['portfolio_id'] = $portfolio_id;
		$data['portfolio_det'] = $this->portfolio->getDetails($data);
		$data['portfolio'] = $this->portfolio->getByID($data);
		$this->LoadView('portfolio/edit', $data);
	}

	// #update portfolio
	public function edit_POST()
	{
		$id = $this->input->post('portfolio_id');

		if($this->input->post('submit'))
		{

			$result = '';
			$updateData = array(
									'Portfolio_ID' => $id,
									'Title_en' 	   => $this->input->post('title_en'),
									'Title_ar' 	   => $this->input->post('title_ar'),
									'Category_ID'  => 1,
									'Link' 		   => $this->input->post('portfolio_link')
								);

			//get old product details
			$data['portfolio_id'] = $id;

			$oldportfolio = $this->portfolio->getByID($data);
			
	        if ($_FILES['fileToUpload']['size'] !== 0)
	        {
		        $target_dir = $GLOBALS['img_work_dir'];
				$file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $target_dir);
				
				$updateData["Thumbnail"] = substr($file, strrpos($file, '/') + 1);
				//echo '<pre>';print_r($updateData);die();
				unlink('./'.$target_dir.$oldportfolio[0]->Thumbnail);
	        }

			$result = $this->portfolio->update($updateData);

	        if($result)
	        {
			    $log = array(
								'row_id' 	   => $id,
								'action_table' => 'portfolios',
								'content' 	   => $_POST,
								'event' 	   => 'update'
							);

				$this->logs->add_log($log);

	           $this->session->set_flashdata('requestMsgSucc', 120);
	        }
	        else
	        {
	           $this->session->set_flashdata('requestMsgErr', 119);
	        }

		}
		redirect($this->thisCtrl.'/edit/'.$id);
	}

	// #delete portfolio function
	public function delete_DELETE($portfolio_id = 0)
	{
		$data['portfolio_id'] = $portfolio_id;

		$images   = $this->portfolio->getImages($data);
        foreach($images as $img)
        {
	        unlink('./'.$GLOBALS['img_work_dir'].$img->Thumbnail);
	        unlink('./'.$GLOBALS['img_work_details_dir'].$img->Details);
        }

		$result = $this->portfolio->delete($data);

		if($result)
		{
		    $log = array(
							'row_id' 	   => $portfolio_id,
							'action_table' => 'portfolios',
							'content' 	   => $_POST,
							'event' 	   => 'delete'
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

	// #delete portfolio function
	public function delete_details_DELETE($ad_ID = '', $portfolio_id = '')
	{
		$data['portfolioDet_ID'] = $ad_ID;
		$oldPD = $this->portfolio->getDetailByID($data);

		$result = $this->portfolio->deleteDetail($data);

		if($result)
		{
		    $log = array(
							'row_id' 	   => $ad_ID,
							'action_table' => 'portfolios details',
							'content' 	   => $_POST,
							'event' 	   => 'delete'
						);

			$this->logs->add_log($log);

			unlink('./'.$GLOBALS['img_work_details_dir'].$oldPD[0]->Details);
	        $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
			redirect($this->thisCtrl.'/edit/'.$portfolio_id);
	}

	public function uploadImages_GET()
	{

		$result = '';
		if (empty($_FILES))
		{
			exit();
        }

         // image options
		$image_options = array(
			'file' => 'file',
			'directory' => $GLOBALS['img_work_details_dir'],
			'max_width' => 1000,
			'file_name' => date('Y-m-d H-i-s')
		);

		$upload = UploadFile($image_options);
        if (!is_array($upload) && !array_key_exists('file_name', $upload))
        {
		    exit();
	    }

	    $upload_data = $this->upload->data();
		$file_name = $upload_data['file_name'];

	    $data = array(
		    'Portfolio_ID' => $this->input->post('target_for_id'),
		    'Details' => $file_name,
		    'Detail_Tag' => 'pic'
	    );
	 	$result = $this->portfolio->addDetails($data);

	    echo $result;
	}

	public function unlinkImage_GET()
	{
		$image = $this->input->post('imageid');
	    $dirFor = $this->input->post('dirFor');

		$imageName = $this->portfolio->getPDImageName($image);
	    if(unlink('./'.$GLOBALS['img_work_details_dir'].$imageName))
	    {
	        echo $this->portfolio->deletePDImage($image);
	    }
	}
}

?>
