<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Professions extends Base_Controller
{
	// define controller
	protected $thisCtrl = "acp/professions";
	
	function __construct()
	{
    	parent::__construct();
    	
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
    	
    	$this->load->model('profession_model', 'profession');
  	}
  	
  	// #categories view function
	public function categories(){
		$data['categories'] = $this->profession->getCategories();
		$data['subcategories'] = $this->profession->getSubcategories($data);
		$this->LoadView('customers/professions/manage_categories', $data);
	}	
	
	public function newCategory(){
		$this->LoadView('customers/professions/add_categories');
	}
	
	// #add-category function
	public function addCategory(){
		if($this->input->post('submit')){
			$name = $this->input->post('name');
			
			$data = array(
				'Category_Name' => $name 
			);
			
			if(isset($_FILES['fileToUpload']))
			{
				$imgData = $this->input->post('image-data');
				$file = GenerateThumbnailFromBase64($imgData, $GLOBALS['img_dir']);
				$data['Picture'] = substr($file, strrpos($file, '/') + 1);
			}
			
			$result = $this->profession->addCategory($data);
			if($result){
	             $this->session->set_flashdata('requestMsgSucc', 121);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }	
		}
		redirect($this->thisCtrl.'/categories');
	}
	
	// #edit service
	public function editCategory($categoryID = 0){
		$data['category_id'] = $categoryID;
		$data['category'] = $this->profession->getCategoryByID($data);
		$this->LoadView('customers/professions/manage_categories', $data);
	}
	
	// #update service
	public function updateCategory(){
		if($this->input->post('submit')){
			$name = $this->input->post('name');
			$id = $this->input->post('category_id');
			
			$updateData = array(
				'Category_ID' => $id,
				'Category_Name' => $name
			);
			
			if(isset($_FILES['fileToUpload'])){
				$imgData = $this->input->post('image-data');
				$file = GenerateThumbnailFromBase64($imgData, $GLOBALS['img_dir']);
				$updateData['Picture'] = substr($file, strrpos($file, '/') + 1);
			}	
				
			$result = $this->profession->updateCategory($updateData);
	        
	         if($result){
	             $this->session->set_flashdata('requestMsgSucc', 120);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }	

		}
		redirect($this->thisCtrl.'/categories');
	}
	
	// #delete service function
	public function deleteCategory($categoryID = 0){
		$data['category_id'] = $categoryID;
		$result = $this->profession->deleteCategory($data);
		if($result){
	             $this->session->set_flashdata('requestMsgSucc', 122);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }
			redirect($this->thisCtrl.'/categories');
	}
	
}