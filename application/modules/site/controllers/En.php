<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'modules/site/controllers/HomeBase_Controller.php');
	
class En extends HomeBase_Controller {

	function __construct()
	{
    	parent::__construct();
    	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
  	}
  	
  	public function index()
	{
		$this->session->set_userdata($this->site_session->__lang_h(), 'en');
		//echo CI_VERSION;
		$this->LoadView('home_view', '');
	}
 }
?>