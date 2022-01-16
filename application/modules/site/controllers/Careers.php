<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/site/controllers/HomeBase_Controller.php');

class Careers extends HomeBase_Controller {

	// define controller
	protected $thisCtrl = "careers";
	
	function __construct()
	{
        parent::__construct();

        $this->load->vars( array('__controller' => $this->thisCtrl));
        $this->load->model('home_model');

        $controller = $this->uri->segment(1);

        $menu = $this->home_model->Is_Menu_Disabled($controller);

        if (!empty($menu)) {
            show_404();
        }
    }

    public function index()
	{
        $data['website_data'] 		  = $this->home_model->Get_Website_Data();
		$data['careers'] = $this->home_model->getCareers();
		$data['nationalities'] = $this->home_model->getNationalities();
		$data['cities'] = $this->home_model->getCities();
		//echo '<pre>';print_r($data['nationalities']);die();
		// website title
		$data['page_name'] = 'careers';
		$metaData['pageTitle'] = getSystemString(493);
		
		$this->LoadView('pages/careers', $data, $metaData);
	}
    
    public function GetJobDescription()
    {
        header('Content-Type: application/json');
        $data['job_id'] = $this->input->post('id', true);
        $result = $this->home_model->GetJobByID($data);
        $desc = 'Description_'.$this->session->userdata($this->site_session->__lang_h());
        $arr = array('Description' => $result[0]->$desc);
        echo json_encode($arr);
    }

    public function SendApplication()
    {   
        //echo '<pre>';print_r($_POST);die();
        $nat = $this->input->post('ca_nationality', true);
        $city = $this->input->post('ca_city', true);

        $application = array(
            'Career_ID' => $this->input->post('ca_chooseposition', true),
            'Fullname' => $this->input->post('ca_fullname', true),
            'Number' => $this->input->post('ca_mbno', true),
            'Email' => $this->input->post('ca_email', true),
            'Birthdate' => $this->input->post('datepicker', true),
            'Nationality_ID' => $nat,
            'Country' => $this->input->post('ca_country', true),
            'City_ID' => $city,
            'Gender' => $this->input->post('ca_gender', true)
        );
        
        $this->load->helper('image_helper');
        
        // file options
        $file_options = array(
            'file' => 'file',
            'directory' => $GLOBALS['applications_dir'],
            'valid_types' => 'pdf'
        );
        $upload = UploadFile($file_options);
        
        if (is_array($upload) && array_key_exists('file_name', $upload))
        {
            $file_name = $upload['file_name'];
            $application['CV_File'] = $file_name;
        }  
        //echo '<pre>';print_r($application);die();
        $result = $this->home_model->addAplication($application);
        if($result)
        {
            $this->session->set_flashdata('requestMsgSucc', 2332);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl);
    }



}