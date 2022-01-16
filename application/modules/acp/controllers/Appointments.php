<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Appointments extends Base_Controller
{
	protected $thisCtrl = "acp/appointments";
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->vars( array('__controller' => $this->thisCtrl));
		
		$this->load->model('appointments_model', 'appointments');
	}
	
	public function list_all()
	{
   		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'appointments',
						'content' 	   => 0,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['section_detail'] = $this->appointments->getAppointmentsSection();

		$this->LoadView('appointments/list', $data);
	}
	
	public function ChangeAppointmentStatus()
	{
		$data = array(
						'Id' => $this->input->post('id'),
						'Status' => $this->input->post('status')
					);
		
		$user = $this->appointments->getRequestedUserEmail($data);
		
		$status = $this->input->post('status');
		
		// send email
		$this->SendEmailAppointmentStatus($user, $status);
		
		echo $this->appointments->changeAppointmentStatus($data);
	}
	
	// email template
	public function SendEmailAppointmentStatus($user = array(), $status = '')
	{
		$subject = 'Appointment Status';
		
		$temp = array(  
						'name'   => $user->Name,
						'status' => $status
					);
		
		$this->load->library('parser');

		$message = $this->parser->parse('acp_includes/email/appointment-status', $temp, TRUE);
		
		//send email
		$this->load->helper('utilities_helper');

		$options = array(
							'to'      => $user->Email,
							'subject' => $subject,
							'message' => $message,
						);
		
		return SendEmail($options);
	}
	
	
	/**---------------------------------------
	  	* Job Application list *
	  	-------------------------------------**/
  	public function getAppointmentsList()
  	{
		$list = $this->appointments->getAppointmentsList();
		$data = array();
		$no = $_POST['start'];
		
		$this->load->library('parser');
		
		foreach ($list as $bookings) 
		{
			$no++;
			
			$dt = new DateTime($bookings->Date);
			$date = $dt->format('d-m-Y');
			
			$action_data = array(
				'id' => $bookings->Id,
				'status' => $bookings->Status
			);
			$actions = ''.$this->parser->parse('appointments/snippets/actions-template', $action_data, TRUE);	
			
			$row = array();
			$row[] = $bookings->Id;
			$row[] = $date;
			$row[] = $bookings->Name;
			$row[] = $bookings->Email;
			$row[] = $bookings->Number;
			$row[] = $actions;
			
			$data[] = $row;
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->appointments->appointmentsCount_all(),
						"recordsFiltered" => $this->appointments->appointmentsCount_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
}