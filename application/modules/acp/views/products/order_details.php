<link rel="stylesheet" type="text/css" href="<?= base_url('style/site/css/jquery-ui.min.css') ?>">

<style>
    .panel.white{
        min-height: 150px;
    }
    table th{
        width: 250px;
    }
    .user-rating{
        text-align: center;
        direction: ltr;
        width:135px;
        margin:auto;
    }
    .user-rating .fa{
        font-size: 22px;
        margin: 1px;
    }
    .star-grey{
        color: #e8e8e8;
    }
    .star-colored{
        color:#ffcc00;
    }
    body[dir="rtl"] .user-rating{
        direction: rtl;
    }
    body[dir="ltr"] #customer_table th, body[dir="ltr"] #customer_table td{
        text-align: left;
    }
    body[dir="rtl"] #customer_table th, body[dir="rtl"] #customer_table td{
        text-align: right;
    }
    #diets_table td:not(.dataTables_empty):first-child{
        display: none;
    }
    #diets_table th:last-child{
        width: 200px; 
    }
    .dataTables_wrapper{
        max-width: 100% !important;
    }
    #diets_table td:nth-child(7){
        display: none;
    }
</style>
<?PHP
$title = 'Title_' . $__lang;
$subcategory = 'SubCategory_' . $__lang;
$category = 'Category_' . $__lang;
$desc = 'Description_' . $__lang;
$cat_nn = 'countryName_' . $__lang;
$name = 'name_' . $__lang;
?>


<div id="content-main">

    <div class="row">
        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>
    </div>

    <div class="row">

        <div class="col-md-12">
            <h3 class="text-primary" >
                <?= getSystemString('order_details') ?>
            </h3>
            <div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">

                <div class="col-md-6">
                    <div style="padding-top: 10px;color:#3498db">
                        <div class="col-md-4">
                            <span><h4><?= getSystemString('product_information') ?></h4></span>
                        </div>
                    </div>

                    <table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
                        <tbody>
                            <tr>
                                <th><?= getSystemString('product_name') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->{'Product_Name_' . $__lang}
                                    ?>	
                                </td>
                            </tr>

                            <tr>
                                <th><?= getSystemString('logo') ?></th>
                                <td>
                                    <img src="<?= base_url($GLOBALS['img_products_dir']) . $details[0]->Product_logo; ?>" alt='product image' style="width: 40px;">	
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-6">

                    <div style="padding-top: 10px;color:#3498db">
                        <h4><?= getSystemString('Customer_information') ?></h4>
                    </div>

                    <table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
                        <tbody>
                            <tr>
                                <th><?= getSystemString('name') ?></th>
                                <td>
                                    <a href="<?= base_url('acp/customerDetails/' . $details[0]->Customer_ID) ?>">
                                        <?= $details[0]->Fullname ?>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <th><?= getSystemString('email') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->Email
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th><?= getSystemString('Phone') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->Phone
                                    ?>
                                </td>
                            </tr>




                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">

                    <div style="padding-top: 10px;color:#3498db">
                        <div class="col-md-4">
                            <span><h4><?= getSystemString('subscription_information') ?></h4></span>
                        </div>
                    </div>

                    <table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
                        <tbody>
                            <tr>
                                <th><?= getSystemString('domain') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->domain
                                    ?>	
                                </td>
                            </tr>
                            <tr>
                                <th><?= getSystemString('Plan') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->{'Name_' . $__lang}
                                    ?>	
                                </td>
                            </tr>
                            
                            <tr>
                                <th><?= getSystemString('licenses') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->Num_of_licenses
                                    ?>	
                                </td>
                            </tr>

                            <tr>
                                <th><?= getSystemString('order_start_date') ?> </th>
                                <td>
                                    <?PHP
                                    echo $details[0]->Start_At
                                    ?> 
                                </td> 
                            </tr>
                            <tr>
                                <th><?= getSystemString('order_expire_date') ?> </th>
                                <td>
                                    <?PHP
                                    echo $details[0]->Expires_At
                                    ?> 
                                </td> 
                            </tr>

                            
                            <tr>
                                <th><?= getSystemString('status') ?> </th>
                                <td>
                                    <?PHP
                                    $sLblClr = 'label-warning';
                                    if ($details[0]->subStatus == 'created') {
                                        $sLblClr = 'label-primary';
                                    }

                                    echo "<label class='label {$sLblClr}'>{$details[0]->subStatus}</label>";
                                    ?>
                                </td> 

                            </tr>

                        </tbody>
                    </table>
                </div>
                <?php if($details[0]->Product_ID == 1){ // Checking for gsuite ?>
                <div class="col-md-6">

                    <div style="padding-top: 10px;color:#3498db">
                        <div class="col-md-4">
                            <span><h4><?= getSystemString('admin_details') ?></h4></span>
                        </div>
                    </div>

                    <table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
                        <tbody>
                            <tr>
                                <th><?= getSystemString('first_name') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->S_first_name
                                    ?>	
                                </td>
                            </tr>
                            <tr>
                                <th><?= getSystemString('last_name') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->S_last_name
                                    ?>	
                                </td>
                            </tr>
                            <tr>
                                <th><?= getSystemString('organization_name') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->S_organization_name
                                    ?>	
                                </td>
                            </tr>
                            <tr>
                                <th><?= getSystemString('primary_email') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->primary_email.'@'.$details[0]->domain
                                    ?>	
                                </td>
                            </tr>
                            <tr>
                                <th><?= getSystemString('alternate_email') ?></th>
                                <td>
                                    <?PHP
                                    echo $details[0]->alternate_email
                                    ?>	
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <?php } ?>


            </div>
        </div>

        <div class="col-xs-12">
            <ul class="nav nav-tabs">



                <li class="active"><a data-toggle="tab" href="#payment_info"><i class="fa fa-paper-plane-o"></i> <?= getSystemString('payment_info') ?></a></li>










            </ul>

            <div class="tab-content" style="padding-top: 0px !important">








                <div class="tab-pane fade in active" id="payment_info">
                    <div class="panel white">
                        <table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
                            <tbody>

                            <thead>
                                <tr>
                                    <th><?= getSystemString(41) ?></th>
                                    <th><?= getSystemString(177) ?></th>


                                    <th><?= getSystemString('order') ?></th>	
                                    <th><?= getSystemString('Platform') ?></th>
                                    <th><?= getSystemString('payment_method') ?></th>											

                                    <th><?= getSystemString('payment_status') ?></th>
                                    <th><?= getSystemString('Pricing') ?></th>
                                    <th><?= getSystemString(180) ?></th>

                                </tr>
                            </thead>

                            <?php if (!empty($details)) { ?>
                                <?php foreach ($details as $row) { ?>
                                    <tr>
                                        <td ><?= '#' . $row->Order_ID ?></td>
                                        <td ><?= date('Y-m-d',strtotime($row->Timestamp)) ?></td>										
                                        <td ><?= $row->Order_Type ?></td> 
                                        <td ><?= $row->Payment_Gateway ?></td> 
                                        <td ><?= $row->Cart_Type ?></td> 
                                        <?php
                                        $payment_status = ($row->payment_verified) ? 102 : 'payment_not_verified';
                                        $payment_label = ($row->Payment_verified) ? 'success' : 'warning';
                                        $payment = '<span class="label label-' . $payment_label . '">' . getSystemString($payment_status) . '</span>';
                                        ?>
                                        <td ><?= $payment ?></td>

                                        <td ><?= $row->Total_Price ?></td>
                                        <td ><?= $row->Email ?></td>



                                    </tr>
                                        <?php }
                                    } else {
                                        ?>

                                <tr>
                                    <td ><?= getSystemString(46) ?></td>

                                </tr>

                            <?php } ?>	




                            </tbody>
                        </table>
                    </div>
                </div>




            </div>

        </div>

    </div>
</div>


<?PHP
$this->load->view('acp_includes/footer');
?>
<script>
    var _customer_id = '<?= $customer_id ?>';
    var _baseController = '<?= base_url('acp/diets') ?>';


    function print_speech(url)
    {


        var w = 900;
        var h = 600;
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        window.open(url, "_blank", "resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width=" + w + ",height=" + h + ",left=" + left + ",top=" + top);
    }


</script>
<script src="<?= base_url($GLOBALS['acp_js_dir'] . '/datatables.js') ?>"></script>

<script src="<?= base_url($GLOBALS['home_js_dir'] . '/utilities/utilities.js') ?>"></script>
<script type="text/javascript" src="<?= base_url($GLOBALS['acp_js_dir'] . '/moment.js') ?>"></script>
<script type="text/javascript" src="<?= base_url($GLOBALS['acp_js_dir'] . '/bootstrap-datetimepicker.js') ?>"></script>
<script>
    var _baseController = '<?= base_url($__controller) ?>';
    $(function () {
        $(".input-date").datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: '<?= date("Y-m-d") ?>'
        });
    });
</script>

<script type="text/javascript">

    $('.change_start_date').on('click', function (e) {
        e.preventDefault();
        $('.cancelForm').removeClass('hide');
    });

    $('.cancel_change').on('click', function (e) {
        e.preventDefault();

        $('.cancelForm').addClass('hide');
    });



    $('.edit_contact_btn').on('click', function (e) {

        var role = $(this).data('role');
        if (role == 'admin') {
            var title = '<?= getSystemString("admin") ?>';
        } else if (role == 'financial') {
            var title = '<?= getSystemString("financial") ?>';
        } else if (role == 'technical') {
            var title = '<?= getSystemString("technical") ?>';
        }
        $('.edit_contact_title').html(title);
        var uid = $(this).data('uid');

        $('.edit_contact_frm')[0].reset();
        $('.contact_role').val('');
        $('.contact_id').val('');


        $('.contact_role').val(role);

        jQuery.ajax({
            type: "GET",
            dataType: "JSON",
            enctype: 'multipart/form-data',
            url: '<?= base_url('acp/domains/contact_info') . '?uid=' ?>' + uid,
            success: function (data) {

                if (data.status === true) {
                    $('.Full_Name').val(data.contact_info.Full_Name);
                    $('.User_City').val(data.contact_info.User_City);
                    $('.User_Country_ID').val(data.contact_info.User_Country_ID).change();
                    $('.Employer_Name').val(data.contact_info.Employer_Name);
                    $('.User_Address1').val(data.contact_info.User_Address1);
                    $('.User_Post_Code').val(data.contact_info.User_Post_Code);
                    $('.User_Mobile').val(data.contact_info.User_Mobile);
                    $('.User_Email').val(data.contact_info.User_Email);
                    $('.contact_id').val(data.contact_info.Org_Usr_ID);


                } else {

                }





            }
        });


    });


</script>

</body>
</html>


















