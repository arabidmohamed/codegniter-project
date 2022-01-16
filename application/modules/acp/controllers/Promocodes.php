<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Promocodes extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/promocodes";
	public $__orderStatuses = '';
	
	function __construct()
	{
    	parent::__construct();
    	$this->load->vars(array('__controller' => $this->thisCtrl));
   
    	$this->load->model('promocode_model', 'promocode');
  	}
		
	public function add_promocode_POST()
	{
		$this->LoadView('promocodes/add');
	}
	
	public function add_POST() 
	{
		if($this->input->post('submit'))
		{
			$log = array(
				'row_id' => 0,
				'action_table' => 'promocode',
				'content' => $_POST,
				'event' => 'add'
			);
			$this->logs->add_log($log);
			
			$stDate = new DateTime($this->input->post('startDate'));
			$etDate = new DateTime($this->input->post('endDate'));
			
			$promo = array(
				'Code' => $this->input->post('code'),
				'Title' => $this->input->post('title'),
				'NumberOfUse' => $this->input->post('numberOfUse'),
				'NumberOfUsePerPerson' => $this->input->post('numberOfUsePerPerson'),
				'StartDate' => $stDate->format('Y-m-d'),
				'EndDate' => $etDate->format('Y-m-d'),
				'DiscountType' => $this->input->post('discountType'),
				'DiscountValue' => $this->input->post('discountValue'),
				'PromoType' => $this->input->post('PromoType'),
				'Minimum_Order_Amount' => $this->input->post('minimum_order_amount'),															
				'Notes' => $this->input->post('notes')
			);
			
			// if ($_FILES['fileToUpload']['size'] !== 0) 
			// {
   //                  //upload profile thumbnail
   //              $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_dir']);
   //              if ($file) 
   //              {
   //                  $promo['Logo'] = substr($file, strrpos($file, '/') + 1);
                    
   //                  // image options
			// 		$image_options = array(
			// 			'file' => 'fileToUpload',
			// 			'directory' => $GLOBALS['img_dir'],
			// 			'max_width' => 1920,
			// 			'file_name' => date('Y-m-d H-i-s').'-promotion'
			// 		);
			// 		$upload = UploadFile($image_options);
		            
			//         if (is_array($upload) && array_key_exists('file_name', $upload))
			//         {
			// 			$file_name = $upload['file_name'];
			// 			$promo['OriginalLogo'] = $file_name;
			//         }
   //              }
   //           }
	        
	        $result = $this->promocode->add($promo);
	        
		    if($result){
	            $this->session->set_flashdata('requestMsgSucc', 121);
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
			
		}
		redirect($this->thisCtrl.'/listall');
	}
	
	public function listall_GET() 
	{
		$this->LoadView('promocodes/list');
	}

	// #edit service
	public function edit_POST($id = 0){
		$log = array(
			'row_id' => 0,
			'action_table' => 'promocode',
			'content' => $id,
			'event' => 'edit'
		);
		$this->logs->add_log($log);
		
		$data['id'] = $id;
		$data['promo'] = $this->promocode->getByID($id);
		$this->LoadView('promocodes/edit', $data);
	}
	
	// #update
	public function save_POST($id){
		if($this->input->post('submit'))
		{
			$log = array(
				'row_id' => 0,
				'action_table' => 'promocode',
				'content' => $_POST,
				'event' => 'update'
			);
			$this->logs->add_log($log);
			
			$stDate = new DateTime($this->input->post('startDate'));
			$etDate = new DateTime($this->input->post('endDate'));
			
			$promo = array(
				'ID' => $id,
				'Code' => $this->input->post('code'),
				'Title' => $this->input->post('title'),
				'NumberOfUse' => $this->input->post('numberOfUse'),
				'NumberOfUsePerPerson' => $this->input->post('numberOfUsePerPerson'),
				'StartDate' => $stDate->format('Y-m-d'),
				'EndDate' => $etDate->format('Y-m-d'),
				'DiscountType' => $this->input->post('discountType'),
				'DiscountValue' => $this->input->post('discountValue'),
				'PromoType' => $this->input->post('PromoType'),
				'Minimum_Order_Amount' => $this->input->post('minimum_order_amount'),								
				'Notes' => $this->input->post('notes')
			);
			
			// if ($_FILES['fileToUpload']['size'] !== 0) 
			// {
   //              //upload profile thumbnail
   //              $file = GenerateThumbnailFromBase64($this->input->post('image-data'),  $GLOBALS['img_dir']);
   //              if ($file) 
   //              {
   //                  $promo['Logo'] = substr($file, strrpos($file, '/') + 1);
                    
   //                  // image options
			// 		$image_options = array(
			// 			'file' => 'fileToUpload',
			// 			'directory' => $GLOBALS['img_dir'],
			// 			'max_width' => 1920,
			// 			'file_name' => date('Y-m-d H-i-s').'-promotion'
			// 		);
			// 		$upload = UploadFile($image_options);

			//         if (is_array($upload) && array_key_exists('file_name', $upload))
			//         {
			// 			$file_name = $upload['file_name'];
			// 			$promo['OriginalLogo'] = $file_name;
			//         }
   //              }
			// }
	        
	        $result = $this->promocode->update($promo);
	        
		    if($result){
	            $this->session->set_flashdata('requestMsgSucc', 120);
	        } else {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
			
		}
		redirect($this->thisCtrl.'/listall');
	}

	// #delete function
	public function delete($id = 0){
		$log = array(
			'row_id' => 0,
			'action_table' => 'promocode',
			'content' => $id,
			'event' => 'delete'
		);
		$this->logs->add_log($log);
		
		$data['id'] = $id;
		$result = $this->promocode->delete($id);
		if($result){
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
		redirect($this->thisCtrl.'/listall');
	}
	
	/*-----------------------------------------------------------
		--------------------- List --------------
	--------------------------------------------------------*/
	
	public function getPromoCodesList_GET()
	{
		$promos = $this->promocode->getPromoCodesList();
		$data = array();
		$no = $_POST['start'];
		$i = 0;

		foreach ($promos as $promo) {
			$no++;
			$i++;
			$dt = new DateTime($promo->Timestamp);
			$date = $dt->format('d-m-Y');
			
			$action_data = array(
				'edit_url' => base_url($this->thisCtrl.'/edit/'.$promo->ID),
				'delete_url' => base_url($this->thisCtrl.'/delete/'.$promo->ID),
			);
			
			// actions template
			$this->load->library('parser');
			$actions = ''.$this->parser->parse('promocodes/snippets/actions', $action_data, TRUE);
			
			$status_chk = '';
			$status_not_chk = '';
			if($promo->Status) { $status_chk = 'checked'; }
			if(!$promo->Status) { $status_not_chk = 'checked'; }
			$status = '<div data-toggle="hurkanSwitch" data-status="'.$promo->Status.'">
							<input data-on="true" type="radio" '.$status_chk.' name="status'.$i.'">
							<input data-off="true" type="radio" '.$status_not_chk.' name="status'.$i.'">
					  </div>';
			
			//image
			// $image = '<img src="'.base_url('style/acp/img/placeholder.png').'" class="profile-pic">';
			// if(strlen($promo->Logo) > 0){
			// 	$image = '<img src="'.base_url($GLOBALS['img_dir'].'/'.$promo->Logo).'" class="profile-pic">';
			// }
			
			$row = array();
			$row[] = $promo->ID;
			$row[] = $date;
			// $row[] = $image;
			$row[] = $promo->Code;
			$row[] = $promo->Title;
			$row[] = $promo->StartDate;
			$row[] = $promo->EndDate;
			$row[] = $promo->DiscountValue.' '.$promo->DiscountType;
			$row[] = $status;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->promocode->promosCount_all(),
						"recordsFiltered" => $this->promocode->promosCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
}