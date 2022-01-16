<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/site/controllers/HomeBase_Controller.php');

class Pages extends HomeBase_Controller {

    // define controller
    protected $thisCtrl = "/";

    function __construct()
    {
        parent::__construct();

        //send controller name to views
        $this->load->vars(array('__controller' => $this->thisCtrl));
        $this->load->model('pages_model', 'pages');
        $this->load->model('home_model', 'home');
    }


    public function pageByPrefix($prefix = '')
    {
        $data['website_data'] 		  = $this->home_model->Get_Website_Data();
        $data['page'] = $this->pages->pageByPrefix($prefix);


        if ($data['website_data']['is_page_disabled']) {
            show_404();
        }

        if (empty($data['page']))
        {
            show_404();
        }

        if ($data['page']->Id == 20) {
            $data['contactus'] = $this->pages->contactus();
            $this->LoadView('contactus', $data);
        } else {
            $this->LoadView('page', $data);
        }

    }
}