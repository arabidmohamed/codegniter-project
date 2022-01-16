<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Careers extends Base_Controller {

    // define controller
    protected $thisCtrl = "acp/careers";

    function __construct()
    {
        parent::__construct();

        //send controller name to views
        $this->load->vars( array('__controller' => $this->thisCtrl));
    }

    public function add_ADD()
    {
        $this->LoadView('careers/add_job');
    }

    public function addJob_POST()
    {
        if($this->input->post('submit'))
        {
            $data = array(
                'Title_en' => $this->input->post('title_en'),
                'Description_en' => $this->input->post('editor1'),
                'Title_ar' => $this->input->post('title_ar'),
                'Description_ar' => $this->input->post('editor2')
            );


            $result = $this->admin_model->addJob($data);


            $log = array(
                'row_id' 	   => 0,
                'action_table' => 'job',
                'content' 	   => $_POST,
                'event' 	   => 'add'
            );

            $this->logs->add_log($log);

            if($result)
            {
                $this->session->set_flashdata('requestMsgSucc', 121);
            }
            else
            {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
        redirect($this->thisCtrl.'/listall');
    }

    public function listall_GET()
    {

        $log = array(
            'row_id' 	   => 0,
            'action_table' => 'job',
            'content' 	   => 0,
            'event' 	   => 'select'
        );

        $this->logs->add_log($log);


        $data['jobs'] = $this->admin_model->getJobs();
        $data['totalArchived'] = $this->admin_model->getTotalArchived();
        $data['totalApp'] = $this->admin_model->getTotalApp();
        $this->LoadView('careers/manage_jobs', $data);
    }

    public function editJob_EDIT($job_id = 0)
    {

        $log = array(
            'row_id' 	   => $job_id,
            'action_table' => 'job',
            'content' 	   => $job_id,
            'event' 	   => 'select'
        );

        $this->logs->add_log($log);

        $data['Career_ID'] = $job_id;
        $data['job'] = $this->admin_model->getJobByID($data);
        $this->LoadView('careers/manage_jobs', $data);
    }

    public function updateJob_PUT()
    {
        if($this->input->post('submit'))
        {
            $data = array(
                'Career_ID' => $this->input->post('job_id'),
                'Title_en' => $this->input->post('title_en'),
                'Description_en' => $this->input->post('editor1'),
                'Title_ar' => $this->input->post('title_ar'),
                'Description_ar' => $this->input->post('editor2')
            );

            $result = $this->admin_model->updateJob($data);

            $log = array(
                'row_id' 	   => $data['Career_ID'],
                'action_table' => 'job',
                'content' 	   => $_POST,
                'event' 	   => 'update'
            );

            $this->logs->add_log($log);

            if($result)
            {
                $this->session->set_flashdata('requestMsgSucc', 120);
            }
            else
            {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
        redirect($this->thisCtrl.'/listall');
    }

    public function application_details_GET($id = 0)
    {
        $data['application'] = $this->admin_model->getFullApplicationData($id);
        //echo '<pre>';print_r($data);die();
        $this->LoadView('careers/application_details', $data);
    }

    public function deleteJob_DELETE($jobID = 0)
    {
        $log = array(
            'row_id' 	   => $jobID,
            'action_table' => 'job',
            'content' 	   => $jobID,
            'event' 	   => 'delete'
        );

        $this->logs->add_log($log);

        $data['Career_ID'] = $jobID;
        $result = $this->admin_model->deleteJob($data);
        if($result){
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl.'/listall');
    }

    public function jobApplications_GET($data = '')
    {
        $data['jobs'] = $this->admin_model->getJobs();
        $data['nationalities'] = $this->admin_model->getNationalities();
        $data['cities'] = $this->admin_model->getCities();
        $this->LoadView('careers/manage_job_applications', $data);
    }

    public function manageJobApplications_GET()
    {

        $log = array(
            'row_id' 	   => 0,
            'action_table' => 'career applications',
            'content' 	   => 0,
            'event' 	   => 'select'
        );

        $this->logs->add_log($log);


        $data['jobs'] = $this->admin_model->getActiveJobs();
        $data['nationalities'] = $this->admin_model->getNationalities();
        $data['cities'] = $this->admin_model->getCities();
        $data['applications'] = $this->admin_model->getApplications();
        $data['total'] = $this->admin_model->getTotals();
        $data['totalMale'] = $this->admin_model->getApplicantMale();
        $data['totalFemale'] = $this->admin_model->getApplicantFemale();

        $this->LoadView('careers/manage_job_applications', $data);
    }

    public function manageJobApplicationsWithJob_GET($jobid = 0)
    {
        $data['Career_ID'] = $jobid;
        $data['jobs'] = $this->admin_model->getJobs();
        $data['nationalities'] = $this->admin_model->getNationalities();
        $data['cities'] = $this->admin_model->getCities();
        //echo '<pre>';print_r($data['cities']);die();
        $data['applications'] = $this->admin_model->getApplicationsByJobID($data);
        $this->LoadView('careers/manage_job_applications', $data);
    }

    public function filterApplications_GET()
    {
        if($this->input->post('submit'))
        {
            $log = array(
                'row_id'       => 0,
                'action_table' => 'job',
                'content'      => $_POST,
                'event'        => 'filter'
            );

            $this->logs->add_log($log);

            $data = array(
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'nationality' => $this->input->post('nationality'),
                'city' => $this->input->post('city'),
                'email' => $this->input->post('email'),
                'no' => $this->input->post('no'),
                'job' => $this->input->post('job')
            );

            $result['applications'] = $this->admin_model->filterApplications($data);
            $this->jobApplications($result);
        }
        else
        {
            redirect($this->thisCtrl.'/manageJobApplications');
        }
    }

    public function deleteApplication_DELETE($id = 0)
    {
        $log = array(
            'row_id'       => 0,
            'action_table' => 'job',
            'content'      => $id,
            'event'        => 'delete'
        );

        $this->logs->add_log($log);

        $data['Application_ID'] = $id;

        $result = $this->admin_model->deleteApplication($data);

        if($result)
        {
            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }

        redirect($this->thisCtrl.'/manageJobApplications');
    }

    public function deleteArchiveApplication_DELETE($id = 0)
    {
        $log = array(
            'row_id' 	   => 0,
            'action_table' => 'job',
            'content'	   => $id,
            'event' 	   => 'delete'
        );

        $this->logs->add_log($log);

        $data['id'] = $id;
        $result = $this->admin_model->deleteApplication($data);

        if($result)
        {
            $this->session->set_flashdata('requestMsgSucc', 122);
        }
        else
        {
            $this->session->set_flashdata('requestMsgErr', 119);
        }

        redirect($this->thisCtrl.'/jobArchivedApplications');
    }

    public function filterArchivedApplications_GET()
    {
        if($this->input->post('submit')){
            $data = array(
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'nationality' => $this->input->post('nationality'),
                'city' => $this->input->post('city'),
                'email' => $this->input->post('email'),
                'no' => $this->input->post('no'),
                'job' => $this->input->post('job')
            );
            $result['applications'] = $this->admin_model->filterArchivedApplications($data);
            $this->jobArchivedApplications($result);
        } else {
            redirect($this->thisCtrl.'/viewArchivedJobApplications');
        }
    }

    public function jobArchivedApplications_GET($data = '')
    {
        $data['jobs'] = $this->admin_model->getJobs();
        $data['nationalities'] = $this->admin_model->getNationalities();
        $data['cities'] = $this->admin_model->getCities();
        $this->LoadView('careers/archived_job_applications', $data);
    }

    public function viewArchivedJobApplications_GET()
    {
        $data['jobs'] = $this->admin_model->getJobs();
        $data['nationalities'] = $this->admin_model->getNationalities();
        $data['cities'] = $this->admin_model->getCities();
        $data['applications'] = $this->admin_model->getArchivedApplications();
        $this->LoadView('careers/archived_job_applications', $data);
    }

    public function archiveApplication_PUT()
    {
        $data = array(
            'Application_ID' => $this->input->post('id'),
            'Archived' => $this->input->post('state')
        );
        echo $this->admin_model->archiveApplication($data);
    }

    public function changeApplicationFlagState_PUT()
    {
        $data = array(
            'ID' => $this->input->post('id'),
            'Flag' => $this->input->post('state')
        );
        echo $this->admin_model->changeApplicationFlagState($data);
    }

}