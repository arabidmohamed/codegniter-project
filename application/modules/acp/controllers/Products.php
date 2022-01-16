<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH . 'modules/acp/controllers/Base_Controller.php');

class Products extends Base_Controller {

    // Define controller
    protected $thisCtrl = "acp/products";

    function __construct() {
        parent::__construct();

        // Send controller name to views
        $this->load->vars(array('__controller' => $this->thisCtrl));
    }

    // Method for product list
    public function listall_GET() {
        // Getting all active products
        $data['products'] = $this->admin_model->getProducts();

        $this->LoadView('products/home_products', $data);
    }

    // Method to show product add form
    public function new_product_ADD() {
        $this->LoadView('products/add_product');
    }

    // Method to show product edit form
    public function editProduct_EDIT($productid = 0) {

        $data['product_id'] = $productid;

        // get product's detail
        $data['product'] = $this->admin_model->getProductByID($data);

        // log
        $log = array(
            'row_id' => $productid,
            'action_table' => 'products',
            'content' => $productid,
            'event' => 'select'
        );

        $this->logs->add_log($log);

        // Getting product prices
        $data['prices'] = $this->admin_model->getProductPrices($productid);
        $this->LoadView('products/home_products', $data);
    }

    // Method for saving new product info
    public function addNewProduct_POST() {

        if ($this->input->post('submit')) { // Checking form submission
            $otherrandomName = '';
            if (isset($_FILES['Product_logo']) && !empty($_FILES['Product_logo']['name'])) { // Checking product logo image
                $config['upload_path'] = $GLOBALS['img_products_dir'];
                $config['allowed_types'] = '*';
                $config['max_size'] = '0';
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);


                if (!$this->upload->do_upload("Product_logo")) { // Checking product logo is uploaded or not
                    $this->session->set_flashdata('requestMsgErr', getSystemString('system_error_msg'));
                    redirect($this->thisCtrl . '/new_product');
                } else {
                    $uploadedFileData = $this->upload->data(); // Getting uploaded image detail
                    $otherrandomName = md5(time()) . '-product' . $uploadedFileData['file_ext']; // extracting image name
                    rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $otherrandomName); // renaming file
                    // $uploadedFileData["file_name"] = $otherrandomName;

                    $updateData['Product_Image'] = $otherrandomName;
                    $updateData['Product_Image_Phone'] = $otherrandomName;
                }
            }

            // Preparing data for new product insertion
            $data = array(
                'Product_Name_en' => $this->input->post('Product_Name_en'),
                'Product_Name_ar' => $this->input->post('Product_Name_ar'),
                'Product_Description_ar' => $this->input->post('Product_Description_ar'),
                'Product_Description_en' => $this->input->post('Product_Description_en'),
                'OrderType' => $this->input->post('ordertype'),
                'Product_logo' => $otherrandomName
            );

            $result = $this->admin_model->addProduct($data); // inserting
            $product_id = $this->db->insert_id();

            // log
            $log = array(
                'row_id' => $product_id,
                'action_table' => 'products',
                'content' => $_POST,
                'event' => 'add'
            );
            $this->logs->add_log($log);

            if (count($this->input->post('Name_ar'))) { // Checking for product's prices submission
                for ($i = 0; $i < count($this->input->post('Name_ar')); $i++) {
                    $pdata = array(
                        'Product_ID' => $product_id,
                        'Name_ar' => $this->input->post('Name_ar')[$i],
                        'Name_en' => $this->input->post('Name_en')[$i],
                        'period' => $this->input->post('period')[$i],
                        'Price' => $this->input->post('Price')[$i],
                    );

                    $this->admin_model->addPrice($pdata); // inserting price
                }
            }


            if ($result) {
                $this->session->set_flashdata('requestMsgSucc', 121);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }
        redirect($this->thisCtrl . '/listall');
    }

    // Method for updating product info
    public function updateProduct_PUT() {

        if ($this->input->post('submit')) { // Checking for submission
            $id = $this->input->post('product_id');
            $title_en = $this->input->post('Product_Name_en');
            $title_ar = $this->input->post('Product_Name_ar');

            // Preparing data for product updation
            $updateData = array(
                'Product_ID' => $id,
                'Product_Name_en' => $title_en,
                'Product_Name_ar' => $title_ar,
                'Product_Description_ar' => $this->input->post('Product_Description_ar'),
                'Product_Description_en' => $this->input->post('Product_Description_en')
            );

            // Checking if logo is changed
            if (isset($_FILES['Product_logo']) && !empty($_FILES['Product_logo']['name'])) {
                $config['upload_path'] = $GLOBALS['img_products_dir'];
                $config['allowed_types'] = '*';
                $config['max_size'] = '0';
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config); // loading upload library
                // Checking wheter file is upload or not
                if (!$this->upload->do_upload("Product_logo")) {
                    $this->session->set_flashdata('requestMsgErr', getSystemString('system_error_msg'));
                    redirect($this->thisCtrl . '/new_product');
                } else {
                    $uploadedFileData = $this->upload->data();
                    $otherrandomName = md5(time()) . '-product' . $uploadedFileData['file_ext'];  // exctracting file name
                    rename($uploadedFileData['full_path'], $uploadedFileData['file_path'] . $otherrandomName); // renaming

                    $updateData['Product_logo'] = $otherrandomName;
                }
            }

            $result = $this->admin_model->updateProduct($updateData);

            // log
            $log = array(
                'row_id' => $id,
                'action_table' => 'products',
                'content' => $_POST,
                'event' => 'update'
            );

            $this->logs->add_log($log);

            // Checking for product's prices submission
            if (count($this->input->post('Name_ar'))) {
                $period_counter = 0; // Count for period input, this input is use when adding new price rahter update
                for ($i = 0; $i < count($this->input->post('Name_ar')); $i++) {
                    $udata = array(
                        'Product_ID' => $id,
                        'Name_ar' => $this->input->post('Name_ar')[$i],
                        'Name_en' => $this->input->post('Name_en')[$i],
                        'Price' => $this->input->post('Price')[$i]
                    );
                    // Checking wheter price is updating or adding new
                    if (isset($this->input->post('pId')[$i])) {
                        $this->admin_model->updatePrices($udata, $this->input->post('pId')[$i]);
                    } else {
                        $udata['period'] = $this->input->post('period')[$period_counter];
                        $this->admin_model->addPrice($udata);
                        $period_counter++;
                    }
                }
            }

            if ($result) {
                $this->session->set_flashdata('requestMsgSucc', 120);
            } else {
                $this->session->set_flashdata('requestMsgErr', 119);
            }
        }

        redirect($this->thisCtrl . '/listall');
    }

    // Method for deleting a product
    public function deleteProduct_DELETE($productid = 0) {
        $data['Product_ID'] = $productid;
        $images = $this->admin_model->getProductImages($data); // Getting product images
        // Deleting images
        foreach ($images as $img) {
            if (strlen($img->Product_logo) > 0) {
                unlink('./' . $GLOBALS['img_products_dir'] . $img->Product_logo);
            }
        }

        // log
        $log = array(
            'row_id' => $productid,
            'action_table' => 'products',
            'content' => $_POST,
            'event' => 'delete'
        );
        $this->logs->add_log($log);

        $data['Product_ID'] = $productid;

        $result = $this->admin_model->deleteProduct($data); // delete

        if ($result) {
            $this->session->set_flashdata('requestMsgSucc', 122);
        } else {
            $this->session->set_flashdata('requestMsgErr', 119);
        }

        redirect($this->thisCtrl . '/listall');
    }

    // Method to show all order list
    public function all_orders_GET() {
        $data['products'] = $this->admin_model->getProducts(); // Getting product list for filter's dropdown
        $this->LoadView('products/orders/list', $data);
    }

    // Method for showing details of order
    public function orderDetails_GET($subscriptionId = 0) {
        $data['settings'] = $this->admin_model->getSettings();
        $data['details'] = $this->admin_model->getorderBySubscription($subscriptionId);  // Getting order's details

        $this->LoadView('products/order_details', $data);
    }

    // Method for deleting a product's price
    public function deletePrice_GET($priceid = 0) {


        $result = $this->admin_model->deletePrice($priceid);

        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
