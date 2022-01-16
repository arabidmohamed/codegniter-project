<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH . 'modules/acp/controllers/Base_Controller.php');

class Reports extends Base_Controller {

    protected $thisCtrl = "acp/reports";

    function __construct() {

        parent::__construct();
        $this->load->model('report_model');
        $this->load->model('customer/product_model', 'product');
        $this->load->vars(array('__controller' => $this->thisCtrl));
    }

    public function getDataRow1_GET() {
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');

        $data = $this->report_model->getReports($fromDate, $toDate);

        echo json_encode($data);
    }

    public function getDomainsDetails_GET() {

        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $culture = $this->session->userdata($this->acp_session->__lang());

        $data = $this->report_model->getDomainDetailsReports($fromDate, $toDate);

        echo json_encode($data);
    }

    public function getFinancialDetails_GET() {

        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $culture = $this->session->userdata($this->acp_session->__lang());

        $data = $this->report_model->getFinancialReports($fromDate, $toDate);

        echo json_encode($data);
    }

    public function getOrdersDetails_GET() {

        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $culture = $this->session->userdata($this->acp_session->__lang());

        $data = $this->report_model->getOrdersReports($fromDate, $toDate);

        echo json_encode($data);
    }

    public function getTicketsDetails_GET() {

        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $culture = $this->session->userdata($this->acp_session->__lang());

        $data = $this->report_model->getTicketsReports($fromDate, $toDate);

        echo json_encode($data);
    }

    public function getDataForTable_GET() {
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $culture = $this->session->userdata($this->acp_session->__lang());

        $data = $this->report_model->getTLDReports($fromDate, $toDate);
        echo json_encode($data);
    }

    public function getDataForTable2_GET() {
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $culture = $this->session->userdata($this->acp_session->__lang());

        $data = $this->report_model->getRequestTypeReports($fromDate, $toDate);

        foreach ($data as $key => $row) {
            $data[$key]['DCR_Request_Type'] = getsystemstring($row['DCR_Request_Type']);
        }

        echo json_encode($data);
    }

    public function plan_income_listall($plan_id, $fromDate = "", $toDate = "") {
        $culture = $this->session->userdata($this->acp_session->__lang());
        $this->load->model('Customers_model', 'customers');
        // $data['branches']  = $this->customers->getBranchlist($culture);        
        /* echo "<pre>";
          print_r($data['branches']);exit; */
        $data['plan_id'] = $plan_id;
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        //print_r($data);exit;
        $this->LoadView('customers/listall', $data);
    }

    public function reports_GET() {
        $data['fromDate'] = isset($_GET['fromDate']) ? $_GET['fromDate'] : '';
        $data['toDate'] = isset($_GET['toDate']) ? $_GET['toDate'] : '';
        $data['reports'] = $this->report_model->getReports($data['fromDate'], $data['toDate']);
        $data['products'] = $this->product->getProductList();
        $this->LoadView('reports_domains', $data);
    }

    public function getChartReportsData() {
        $data = $this->report_model->chartReportsData();
        echo json_encode($data);
    }

    public function getProductReportsData_GET($product_id) {
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $data = $this->report_model->ProductReportData($product_id, $fromDate, $toDate);
        echo json_encode($data);
    }

}
