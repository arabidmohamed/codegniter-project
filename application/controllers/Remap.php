<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/Home.php');
	
class Remap extends Home {

	function __construct()
	{
    	parent::__construct();
  	}
  	
  	public function index()
	{
		$username = $this->uri->segment(1);

        if (empty($username)) {
            show_404();
        }
        
        
        // for making url like http://www.test.com/tanzil
        if($username == 'tanzil'){
	        echo 'record found';
        } else {
	        show_404();
        }
        
        
        
	}
 }
?>