<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class Localization extends Base_Controller {

    // define controller
    protected $thisCtrl = "acp/localization";
    public $__directories = array();

    function __construct()
    {
        parent::__construct();

        $this->load->model('localization_model', 'localization');
        $this->load->library('parser');
        require_once APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php';
        $this->excel = new PHPExcel();
        //send controller name to views
        $this->load->vars( array('__controller' => $this->thisCtrl));
    }

    /*-----------------------------------------------------------
        ---------------------- #strings -----------------
        --------------------------------------------------------*/

    public function add_GET()
    {
        $this->LoadView('localization/add', $data);
    }

    public function addString_POST()
    {
        if($this->input->post('submitButton'))
        {
	        // to check if strings is already exist or not


			$this->load->library('form_validation');
			$this->form_validation->set_rules('strings', 'Key', 'trim|is_unique[localization.Key]|required',array('is_unique' => 999000999));
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('requestMsgErr', 119);
                redirect($this->thisCtrl.'/listall');
            }
	        // ends
	        $string = $this->input->post('strings');


            $insertData = array(
                'Key' 	  	  => $string,
                'String_en'   => $this->input->post('string_en'),
                'String_ar'   => $this->input->post('string_ar')
            );

			//echo '<pre>';print_r($insertData);
            $ID = $this->localization->addString($insertData);

            $log = array(
                'row_id' 	   => $ID,
                'action_table' => 'localization',
                'content' 	   => $_POST,
                'event' 	   => 'add'
            );

            $this->logs->add_log($log);

            if($ID)
            {
                $this->session->set_flashdata('requestMsgSucc', 121);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }

        redirect($this->thisCtrl.'/listall');
    }



    public function listall_GET()
    {
	    $this->load->helper('url');
	    $this->load->library("pagination");

        $log = array(
            'row_id' 	   => 0,
            'action_table' => 'localization',
            'content' 	   => $_POST,
            'event' 	   => 'select'
        );

        $this->logs->add_log($log);
		// used to search
		$config = array();
	    $config["base_url"] = base_url('acp/localization/listall/');

	    // Code modified here
	    $config["total_rows"] = $this->localization->get_count();

	    $config["per_page"] = 100;
	    $config["uri_segment"] = 4;

	    $this->pagination->initialize($config);
		$key  	   = isset($_GET['key']) ? $_GET['key'] : '';
		$string_en = isset($_GET['string_en']) ? $_GET['string_en'] : '';
		$string_ar = isset($_GET['string_ar']) ? $_GET['string_ar'] : '';

		$data['key']  	   = $key;
		$data['string_en'] = $string_en;
		$data['string_ar'] = $string_ar;
	    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	    $data["localization"] = $this->localization->get_strings($config["per_page"], $page, $key, $string_en, $string_ar);
	    $data["links"] = $this->pagination->create_links();
		$data['reg_error'] ='';

        $this->LoadView('localization/listall', $data);
    }

    public function editString_EDIT($lid = 0)
    {
        $log = array(
            'row_id' 	   => $lid,
            'action_table' => 'localization',
            'content' 	   => $_POST,
            'event' 	   => 'select'
        );

        $this->logs->add_log($log);

        $data['ID']    			= $lid;

        $this->LoadView('localization/listall', $data);
    }

	public function updateString_POST()
	{
		$id = $this->input->post('id');
		$key = $this->input->post('key');
		$sen = $this->input->post('stringen');
		$sar = $this->input->post('stringar');
		$data = array(
			'ID' => $id,
			'Key' => $key,
			'String_en' => $sen,
			'String_ar' => $sar
		);

		$result = $this->localization->updateString($data);
        //echo '<pre>';print_r($result);
        if($result){
            $this->session->set_flashdata('requestMsgSucc', 120);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl.'/listall');
	}


    public function deleteString_DELETE($id = 0)
    {
        $data['id'] = $id;

        $log = array(
            'row_id' 	   => 0,
            'action_table' => 'localization',
            'content' 	   => $id,
            'event' 	   => 'delete'
        );

        $this->logs->add_log($log);


        $result = $this->localization->deleteString($data);
        if($result){
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl.'/listall');
    }

	public function getDataList_GET()
	{
		$list = $this->localization->getDataList();
        //dd($list);
		$data = array();
		$no = $_POST['start'];
		$i = 0;

        $this->load->library('parser');

		foreach ($list as $dt) 
		{
			$no++;
			$i++;
			$datetime = new DateTime($dt->Created_at);
			$date = $datetime->format('d-m-Y');
			
			$action_data = array(
                'id' => $dt->ID,
                'key' => $dt->Key,
                'stringen' => $dt->String_en,
                'stringar' => $dt->String_ar,
				'delete_url' => base_url($this->thisCtrl.'/deleteString/'.$dt->ID)
			);											
			
			// actions template
			$actions = ''.$this->parser->parse('localization/snippets/actions-template', $action_data, TRUE);	
			
			// multi-language code												
			$string = 'String_'.$this->session->userdata($this->acp_session->__lang());
			
			$row = array();
			$row[] = $dt->ID;
			$row[] = $dt->Key;
			$row[] = $dt->String_en;
            $row[] = $dt->String_ar;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->localization->localizationCount_all(),
						"recordsFiltered" => $this->localization->localizationCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


}
?>
