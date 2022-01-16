<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');
class Managements extends Base_Controller
{

    // define controller
    protected $thisCtrl = "acp/managements";

    function __construct()
    {
        parent::__construct();

        //send controller name to views
        $this->load->vars(array('__controller' => $this->thisCtrl));
    }

    // #service-view function
    public function add_ADD()
    {
        $this->LoadView('managements/section_top');
    }

    // #add-service function
    public function addManage_POST()
    {
        if ($this->input->post('submit')) {
            $name_en = $this->input->post('name_en');
            $position_en = $this->input->post('position_en');
            $name_ar = $this->input->post('name_ar');
            $position_ar = $this->input->post('position_ar');

            $insertData = array(
                'Name_en' => $name_en,
                'Name_ar' => $name_ar,
                'Position_en' => $position_en,
                'Position_ar' => $position_ar,
                'Twitter' => $this->input->post('twitter'),
                'Facebook' => $this->input->post('facebook'),
                'LinkedIn' => $this->input->post('linkedin')
            );

            if ($_FILES['fileToUpload']['size'] !== 0) {
                //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'), $GLOBALS['img_users_dir']);
                if ($file) {
                    $insertData['Icon'] = substr($file, strrpos($file, '/') + 1);

                    // image options
                    $image_options = array(
                        'file' => 'fileToUpload',
                        'directory' => $GLOBALS['img_users_dir'],
                        'max_width' => 1920,
                        'file_name' => date('Y-m-d H-i-s') . '-topManagement'
                    );
                    $upload = UploadFile($image_options);

                    if (is_array($upload) && array_key_exists('file_name', $upload)) {
                        $file_name = $upload['file_name'];
                        $insertData['Original_Img'] = $file_name;
                    }
                }
            }

            $result = $this->admin_model->addManage($insertData);

            $id = $this->db->insert_id();

            $log = array(
                'row_id' => $id,
                'action_table' => 'top management',
                'content' => $_POST,
                'event' => 'add'
            );

            $this->logs->add_log($log);


            if ($result) {
                $this->session->set_flashdata('requestMsgSucc', 121);
            }
        }

        redirect($this->thisCtrl . '/listall');
    }

    // #manage-Services function
    public function listall_GET()
    {
        $data['management'] = $this->admin_model->getTop();


        $log = array(
            'row_id' => 0,
            'action_table' => 'top management',
            'content' => $_POST,
            'event' => 'select'
        );

        $this->logs->add_log($log);


        $this->LoadView('managements/manage_top', $data);
    }

    // #edit service
    public function editTop_EDIT($servieID = null)
    {
        $log = array(
            'row_id' => $servieID,
            'action_table' => 'top management',
            'content' => $servieID,
            'event' => 'select'
        );

        $this->logs->add_log($log);

        $data['top_id'] = $servieID;
        $data['management'] = $this->admin_model->getTopByID($data);
        $this->LoadView('managements/manage_top', $data);
    }

    // #update service
    public function updateTop_POST()
    {
        if ($this->input->post('submit')) {
            $id = $this->input->post('top_id');
            $name_en = $this->input->post('name_en');
            $position_en = $this->input->post('position_en');
            $name_ar = $this->input->post('name_ar');
            $position_ar = $this->input->post('position_ar');

            $result = '';

            $updateData = array(
                'Top_ID' => $id,
                'Name_en' => $name_en,
                'Name_ar' => $name_ar,
                'Position_en' => $position_en,
                'Position_ar' => $position_ar,
                'Twitter' => $this->input->post('twitter'),
                'Facebook' => $this->input->post('facebook'),
                'LinkedIn' => $this->input->post('linkedin')
            );

            if ($_FILES['fileToUpload']['size'] !== 0) {
                //upload profile thumbnail
                $file = GenerateThumbnailFromBase64($this->input->post('image-data'), $GLOBALS['img_users_dir']);
                if ($file) {
                    $updateData['Icon'] = substr($file, strrpos($file, '/') + 1);

                    // image options
                    $image_options = array(
                        'file' => 'fileToUpload',
                        'directory' => $GLOBALS['img_users_dir'],
                        'max_width' => 1920,
                        'file_name' => date('Y-m-d H-i-s') . '-service'
                    );
                    $upload = UploadFile($image_options);

                    if (is_array($upload) && array_key_exists('file_name', $upload)) {
                        $file_name = $upload['file_name'];
                        $updateData['Original_Img'] = $file_name;
                    }
                }
            }

            $result = $this->admin_model->updateTop($updateData);

            $log = array(
                'row_id' => $id,
                'action_table' => 'top management',
                'content' => $_POST,
                'event' => 'update'
            );

            $this->logs->add_log($log);

            if ($result) {
                $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
        redirect($this->thisCtrl . '/listall');
    }

    // #delete service function
    public function deleteTop_DELETE($servieID = null)
    {
        $log = array(
            'row_id' => $servieID,
            'action_table' => 'service',
            'content' => $servieID,
            'event' => 'delete'
        );
        $this->logs->add_log($log);

        $data['top_id'] = $servieID;
        $result = $this->admin_model->deleteTop($data);
        if ($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }
        redirect($this->thisCtrl . '/listall');

    }
}