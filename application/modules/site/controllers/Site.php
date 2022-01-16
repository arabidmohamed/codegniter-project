<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/site/controllers/HomeBase_Controller.php');

class Site extends HomeBase_Controller {

    // define controller
    protected $thisCtrl = "site";

    function __construct()
    {

    /**************************************
            * By Eng.Mohammed Arabid *
    ***************************************/

        parent::__construct();

        $this->load->vars( array('__controller' => $this->thisCtrl));


        $this->load->model('home_model');
        $this->load->model('pages_model');
        $this->load->model('products_model');


        date_default_timezone_set('UTC');

        /*
         * It checks the status for the menu item.
        */
        $this->__lang = $this->session->userdata($this->site_session->__lang_h());
        $link = uri_string();
        $controller = $this->uri->segment(1);

        $menu = $this->home_model->Is_Menu_Disabled($controller);

        if (!empty($menu)) {
            show_404();
        }



    }

    /*
   *  * Home
     */
    public function index()
    {
        $data['pageTitle'] = getSystemString(218);
        $data['slides'] = $this->home_model->Get_back_slider();
        $data['about'] = $this->home_model->get_pages();
        $data['settings'] = $this->home_model->Get_Website_Configuration();
        $data['clients'] = $this->home_model->ClientsList();
        $data['achievement'] = $this->home_model->getAchievements();
        $data['solutions'] = $this->home_model->getLimitSolutions();
        $data['portfolio'] = $this->home_model->PortfolioList();
        //echo '<pre>';print_r($data['portfolios']);die();
        $this->LoadView('index', $data);
    }


    public function solutions(){
       $data['solutions'] = $this->home_model->getSolutions();
       $metaData['pageTitle'] = getSystemString('solutions');

       $this->LoadView('solutions/listall', $data, $metaData);
    }


    public function solutions_details($id)
    {
        $data['solutions'] = $this->home_model->getSolutionsByID($id);
        $data['features']  = $this->home_model->getAllPlansFeature();
        $data['web_settings'] = $this->db->get('website_settings')->result();
        //echo '<pre>';print_r($data['web_settings']);die();
        $metaData['pageTitle'] = getSystemString('solutions');
        $this->LoadView('solutions/details', $data,$metaData);
    }

    public function google_workplace(){
       $data['solutions'] = $this->home_model->getSolutions();
       $metaData['pageTitle'] = getSystemString('google_workplace');
       $this->LoadView('pages/google_workplace', $data,$metaData);
    }

   public function faqs() {
        $data['faqs'] = $this->home_model->getFaqs();
        $data['settings'] = $this->home_model->Get_Website_Configuration();
        $metaData['pageTitle'] = getSystemString('faq');
        $this->LoadView('pages/faqs', $data,$metaData);
   }


    public function news()
    {
        $data['news'] = $this->home_model->getNews(3, 1);
        $metaData['pageTitle'] = getSystemString('news');
        $this->LoadView('news/news', $data,$metaData);
    }
    public function news_details($id=null)
    {
        $data['news'] = $this->home_model->getNewsDetails($id);
        $data['simillar_news'] = $this->home_model->NewsRandomList($id);

        $this->LoadView('news/news_details', $data);
    }


                public function loadMoreNews()
    {

        $page        = $this->input->post('page', true);


       // $data['products_categories']    = $this->products->searchProductsList(8,8*$page,$text);
        $data['news'] = $this->home_model->getNews(3,3*$page);
        $output = $this->load->view('news/news_custom',$data,true);

        if(count($data['news']) > 0)
        {

         $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => true,'result'=>$output)));
              }else{
                 $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode(array('status' => false)));
              }

    }

public function rateYourOrder(){


        $customer_id      =  $this->uri->segment(2);
        $referance_payment =  $this->uri->segment(3);


        $orderDetails = $this->products_model->getOrderByReferance($referance_payment,$customer_id);

        $data['order'] = $orderDetails;

        $data['rating'] = $this->home_model->get_one(['Order_ID'=>$orderDetails->Order_ID],'*','order_reviews');



         if (empty($orderDetails) || !$customer_id || !$referance_payment)
        {
            $this->load->view('error404', $data);
        }else{
             $this->LoadView('cart/rate_customer_order',$data);
        }


}

public function saveOrderRate(){

        if($_POST){

            $quality = $this->input->post('quality', true);
            $taste = $this->input->post('taste', true) || 1;
            $pricing = $this->input->post('pricing', true);
            $services = $this->input->post('services', true);

            $order_id = $this->input->post('order_id', true);
            $customer_id = $this->input->post('customer_id', true);
            $referance_payment = $this->input->post('referance_payment', true);

            $rating_id = $this->input->post('rating_id', true);



            $rating = [ 'Order_ID'=>$order_id,
                        'Quality'=>$quality,
                        'Taste'=>$taste,
                        'Pricing'=> $pricing,
                        'Service'=>$services,
                        ];
        if($rating_id){
             $result = $this->home_model->save($rating,['ID'=>$rating_id],'order_reviews');
        }else{
             $result = $this->home_model->insert('order_reviews',$rating);
        }



        $this->session->set_flashdata('success', getSystemString('success_review'));
        redirect(base_url('rateYourOrder').'/'.$customer_id.'/'.$referance_payment);

        }
}

public function PagesDetails()
    {

        $prefix  =  $this->uri->segment(2);
        $this->load->model('pages_model', 'pages');


        $data['page_details'] = $this->pages->pageByPrefix($prefix);


        $data['page_name'] = 'pages';
        $__lang = $this->session->userdata($this->site_session->__lang_h());
        $title = 'Page_title_'.$__lang;
        $data['pageTitle'] = $data['page_details']->$title;

        if ($data['website_data']['is_page_disabled']) {
            $this->load->view('error404', $data);
            return;
        }
        $data['settings'] = $this->home_model->Get_Website_Configuration();
        if (empty($data['page_details']))
        {
            $this->load->view('error404', $data);
            return;
        }


            $this->LoadView('page', $data);


    }

    public function  projects(){

        $data['project_categories']    = $this->home_model->getProjectsCategories();
        $data['pageTitle'] = getSystemString('apply_for_project');


         if ($_POST) {



        $application = array(
            'Category_ID' => $this->input->post('Category_ID', true),
            'Full_Name' => $this->input->post('Full_Name', true),
            'Email' => $this->input->post('Email', true),
            'Phone' => $this->input->post('Phone', true),
            'Details' => $this->input->post('Details', true),
        );


        $result = $this->home_model->addAplication($application);
        echo $result;

        exit();
         }

        $metaData['pageTitle'] = getSystemString('661');
        $this->LoadView('projects', $data, $metaData);

     }











    //* Note: to display custom page Ads */
    public function show_custom_pages($page_id=0)
    {
        if($page_id==0) { show_404(); exit; } ;

        $page_details = $this->db->where('id',$page_id)->get('custome_pages')->row_array();

        if($page_details['status']==0)
        {
            show_404(); exit;
        }

        $data['website_data'] = $this->home_model->Get_Website_Data();

        $metaData['pageTitle'] = getSystemString('ads');

        $data['page_details']  = $page_details ;

        $this->LoadView('custom_page', $data, $metaData);
    }
    // ends

    /**
     * About Us
     **/
    public function aboutus()
    {

        $data['website_data'] = $this->home_model->Get_Website_Data();

        $metaData['pageTitle'] = getSystemString('about_us');

        $data['about'] = $this->home_model->get_pages();
        $data['achievement'] = $this->home_model->getAchievements();
        $data['teams'] = $this->home_model->getTeamwork();
        //print_r($data['about']);
        $this->LoadView('pages/aboutus', $data, $metaData);
    }

    /**
     * Services
     **/
    public function services()
    {

        $data['website_data'] = $this->home_model->Get_Website_Data();

        // website title
        $data['page_name'] = 'services';
        $metaData['pageTitle'] = getSystemString(92);

        $this->LoadView('pages/services', $data, $metaData);
    }
    /**
     * Branches
     **/
    public function branches()
    {

        $data['branches'] = $this->home_model->getBranches();
        // website title
        $data['page_name'] = 'branches';
        $metaData['pageTitle'] = getSystemString('branches');

        $this->LoadView('branches/branches_list', $data, $metaData);
    }

    /**
     * Transfer
     **/
    public function how_to_transfer()
    {
        $data['settings'] = $this->home_model->Get_Website_Configuration();
        $metaData['pageTitle'] = getSystemString('transfer_a_domain');
        $this->LoadView('how_to_transfer',$data, $metaData);
    }

    public function brancheDetails($branch_id = 0){

        $data['branch_info'] = $this->home_model->getBranchByID($branch_id);


        if(empty($data['branch_info'])){
            redirect(base_url());
        }

        $data['page_name'] = 'Classes';
        $metaData['pageTitle'] = getSystemString('Classes');

        $this->LoadView('branches/branche_details', $data, $metaData);
    }

        public function classDetails($class_id = 0){

        $data['class'] = $this->home_model->getClassDetails($class_id);
        if(empty($data['class'])){
            redirect(base_url());
        }

        //print_r($data['class']); exit();
        $data['page_name'] = 421;
        $metaData['pageTitle'] = getSystemString(421);

        $this->LoadView('branches/class_details', $data, $metaData);
    }

    /**
     * clients / clients
     **/
    public function clients()
    {
        $data['website_data'] = $this->home_model->Get_Website_Data();
        $data['clients'] = $this->home_model->ClientsList();
        // website title
        //echo '<pre>';print_r($data['clients']); exit();
        $data['page_name'] = 'clients';
        $metaData['pageTitle'] = getSystemString(67);

        $this->LoadView('pages/clients', $data, $metaData);
    }




    /**
     * Portfolio
     **/
    public function portfolios()
    {
        $data['website_data'] = $this->home_model->Get_Website_Data();
        $data['portfolio_categories'] = $this->home_model->PortfolioCategories();
        $data['portfolio'] = $this->home_model->PortfolioList();
        $data['clients'] = $this->home_model->ClientsList();
        // website title
        $data['page_name'] = 'portfolio';
        $metaData['pageTitle'] = getSystemString(131);

        $this->LoadView('portfolios/list', $data, $metaData);
    }

    // public function portfolio_details($id = 0)
    // {
    //     $data['portfolio_categories'] = $this->home_model->PortfolioCategories();
    //     $data['portfolio'] = $this->home_model->PortfolioList($id);
    //     $this->load->view('portfolios/details', $data);
    // }



    /**
     * NewsLetter Subscription
     **/
    // public function subscribeToNewsLetter()
    // {
    //     $email = $this->input->post('email', true);

    //     if(strlen($email) > 0)
    //     {
    //         $result = $this->home_model->subscribeToNewsLetter(array('Email' => $email));

    //         //echo json_encode(array('result' => $result));
    //               $this->output
    //                       ->set_content_type("application/json")
    //                       ->set_output(json_encode(array('status' => true,'result' =>$result)));

    //     }else{
    //                 $this->output
    //                       ->set_content_type("application/json")
    //                       ->set_output(json_encode(array('status' => false,'result' =>0)));
    //     }

    //     //echo json_encode(array('result' => 0));
    // }
    /**
     * Subscription
     **/
    // public function subscribe()
    // {
    //     if(strlen($this->session->flashdata('subscription_cus')) > 0)
    //     {
    //         $customer_id = $this->session->flashdata('subscription_cus');
    //         $data['subscription'] = $this->home_model->getCustomerSubscription($customer_id);
    //     }

    //     $data['plans'] = $this->home_model->getSubscriptionPlans();

    //     $this->LoadView('subscribe', $data);
    // }




    /**
     * Contact Us
     **/
    public function contactus()
    {


        $data['website_data'] = $this->home_model->Get_Website_Data();

        // website title
        $data['page_name'] = 'contactus';
        $metaData['pageTitle'] = getSystemString(108);

        $this->LoadView('pages/contactus', $data, $metaData);
    }

    public function sendEmailToWebsite()
    {
        
        //header('Content-Type: application/json');
        $result = $this->home_model->Get_WebsiteSettings();

        $to = $result[0]->Website_Email;
        $name = $this->input->post('name', true);
        $from = $this->input->post('email', true);
        $subject = $this->input->post('google_workplace', true);
        $solutions = $this->input->post('solutions', true);
        $phone = $this->input->post('phone', true);
        $phone_key = $this->input->post('phone_key', true);        
        $message = $this->input->post('message', true);

        if(strlen($to) != 0 && strlen($name) != 0 && strlen($from) != 0){

            $data = array(
                'name' => $name,
                'phone' => '+'.$phone_key.$phone,
                'message' => $message,
                'email' => $from
            );
            $this->load->library('parser');
            $temp_msg = ''.$this->parser->parse('includes/email/contactus', $data, TRUE);

            if($subject){
              $title = $subject;
            } else if($solutions) {
              $title = getSystemString('solutions').' ('.$solutions.')';
            } else {
              $title = 'طلب تواصل من الموقع - '.$from;
            }
            //send email
            $options = array(
                'to' => $to,
                'subject' => $title,
                'message' => $temp_msg,
                'from' => $to
            );


            $this->load->helper('utilities_helper');
            if(SendEmail($options)){
                echo json_encode(array('info' => '1'));
            } else {
                echo json_encode(array('info' => '0', 'msg' => 'System error occured'));
            }
        } else {
            echo json_encode(array('info' => '-1', 'msg' => 'Please fill out all the fields!'));
        }
    }

    /**
     * Take Appointment
     **/
    public function TakeAppointment()
    {
        $email = $this->input->post('email', true);
        $name = $this->input->post('name', true);
        $no = $this->input->post('number', true);

        date_default_timezone_set('UTC');

        $appointment = array(
            "Name" => $name,
            "Number" => $no,
            "Email" => $email
        );

        $result = $this->home_model->TakeAppointment($appointment);

        if($result)
        {
            $wbs = $this->home_model->Get_WebsiteSettings();
            $to = $wbs[0]->Website_Email;

            $subject = $name.' has taken an appointment';

            $data = array(
                'name' => $name,
                'email' => $email,
                'phone' => $no,
                'subject' => $subject
            );
            $this->load->library('parser');
            $temp_msg = ''.$this->parser->parse('includes/email/appointment', $data, TRUE);

            //send email
            $options = array(
                'to' => $to,
                'subject' => $subject,
                'message' => $temp_msg,
                'from' => $email
            );

            $this->load->helper('utilities_helper');
            SendEmail($options);

        }

        echo json_encode(array('info' => '1'));
    }

    //#logout function
    public function logout()
    {
        $this->session->unset_userdata($this->site_session->userid());
        $this->session->unset_userdata($this->site_session->username());
        $this->session->unset_userdata($this->site_session->email());
        $this->session->unset_userdata($this->site_session->role());
        $this->session->unset_userdata($this->site_session->phone());
        $this->session->unset_userdata($this->site_session->phone_verified());
        $this->session->sess_destroy();
        redirect(base_url());
    }

    private function _getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * blogs
     **/
	// public function blogs($page = 1)
	// {
 //        $data['website_data']          = $this->home_model->Get_Website_Data();
	// 	$data['pages_count'] = (int) ceil(count($this->home_model->getBlogsList()) / 6);

	// 	if ( $page > $data['pages_count'] ) {

	// 		$page = $data['pages_count'];

	// 	}

	// 	$data['blogs'] = $this->getBlogList($page);
	// 	$data['current_page'] = $page;
	// 	$data['next_page'] = $page + 1;
	// 	$data['pre_page'] = $page - 1;



	// 	$this->LoadView('blog/blogs', $data);
	// }
	// public function blog_detail($id)
	// {
	// 	$data['blog_detail'] = $this->home_model->getBlogByID($id);
	// 	$data['recomended_blogs'] = $this->home_model->getRecomendedBlogList($id);

	// 	$this->LoadView('blog/blog_detail', $data);
	// }

 //        public function blogsByTags( $tagName = '')
 //    {
 //        if($tagName == '')
 //        {
 //            show_404();
 //            exit();
 //        }

 //        $data['blogs'] = $this->getSimilarNewsByTagName(urldecode($tagName));

 //        $data['tag_name'] = urldecode($tagName);

 //        $data['page_name'] = 'newsByTags';
 //        $metaData['pageTitle'] = getSystemString('forum_news');

 //        $this->LoadView('blog/tag', $data, $metaData);


 //    }
    //    public function getSimilarNewsByTagName($tagName)
    // {

    //     $this->db->like('Tags',$tagName);
    //     $this->db->from('news');
    //     $__lang = $this->session->userdata($this->site_session->__lang_h());
    //     $sqlQuery = $this->db->get();
    //     if($sqlQuery->num_rows()>0)
    //     $result = $sqlQuery->result();

    //     return $result;
    // }
  	/*
	  	---------------- blog List -------------------
  	*/
  // 	public function getBlogList($page = 1)
  // 	{
	 //  	$this->load->library('parser');

		// $data 	   = array() ;

		// $blogs = $this->home_model->getBlogsList();

  //       $limit = 6;

  //       $offset = ($page - 1) * $limit;
  //       $numberOfPages = (int) ceil(count($blogs) / $limit);

  //       $blogs = array_slice($blogs, $offset, $limit);


		// return $blogs;
  // 	}



}

?>
