<?PHP
$__lang = $this->session->userdata($this->site_session->__lang_h());
$this->load->view('site/includes/header_menu');
$this->load->view('site/includes/custom_styles_header');

$title = 'title_' . $__lang;
$name = 'name_' . $__lang;
$city = 'City_' . $__lang;
?>
<style>
    header{
        z-index: -1;
    }
    .intro{
        margin: auto;
    }
    .product-details .btn-product-details{
        width: 320px;
        height: 70px;
        line-height: 70px;
        border-radius: 40px;
        padding: 0;
    }
    .alert-product-details a{
        font-size: 14px;
        font-weight: bold;
        color: #E2B22E;
    }
</style>
<!-- Header -->
<header class="header header-sub">
    <div class="intro">
        <div class="container pb-5 ">
            <h1 class="text-center pb-2">
                <?= $this->session->userdata($this->site_session->username()) ?> </h1>
            <p class="text-center mb-4">
                <?php if (is_numeric($this->session->userdata($this->site_session->random_id()))) { ?> ID : #<?= $this->session->userdata($this->site_session->random_id()) ?> <?php } ?> </p>
        </div>
    </div>
</header>
<!-- End Header -->


<div class="form-container col-md-9 mx-auto">
    <div class="container dashboard">
        <div class="col-md-10 mx-auto">
            <?= $this->load->view('domain_registration/profile_navigation'); ?>
            <hr class="d-md-none">
            <div class="mt-5 pb-5">
                <div id="main-dashboard">

                    <div class="d-lg-flex justify-content-between align-items-center mb-5"> 
                        <h1 class="color-primary mb-lg-0 mb-3">ربط خدمة البريد</h1>
                        <img src="https://workspace.google.com/static/img/google-workspace-logo.svg?cache=1d66531" width="250" alt="google workspces">
                    </div>

                    <?php if(!$records_pass){ ?>
                    <div class="alert alert-warning">  
                        <p class="mb-lg-0 text-warning">النطاق غير مرتبط بشكل صحيح</p>  
                    </div>
                    <?php } ?>

                    <div class="row py-4"> 
                        <div class="col-lg-12">	
                            <p>يجب اضافة المعلومات التالية للنطاق <span class="ml-3"><?= $domain ?></span></p>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="table-conect-email ">
                                <table class="table table-borderless table-striped text-center">
                                    <tbody>
                                        <tr class=" bg-transparent">
                                            <th class="color-primary ">النوع</th>
                                            <th class="color-primary ">الاسم</th>
                                            <th class="color-primary ">المحتوى</th>
                                            <th class="color-primary ">الاولية</th>
                                            <th class="color-primary ">TTL</th>
                                        </tr>
                                        <tr class=" bg-transparent"><td colspan="5"></td></tr> 
                                        <tr <?php if ($record_1) echo 'class="success"';
            else echo 'class="error"'; ?>>
                                            <td>MX</td>
                                            <td>@</td>
                                            <td dir="ltr" align="left"><small>aspmx.l.google.com</small></td>
                                            <td>1</td>
                                            <td>300</td> 
                                        </tr> 
                                        <tr <?php if ($record_2) echo 'class="success"';
            else echo 'class="error"'; ?>>
                                            <td>MX</td>
                                            <td>@</td>
                                            <td dir="ltr" align="left"><small>alt1.aspmx.l.google.com</small></td>
                                            <td>5</td>
                                            <td>300</td> 
                                        </tr> 

                                        <tr <?php if ($record_3) echo 'class="success"';
            else echo 'class="error"'; ?>>
                                            <td>MX</td>
                                            <td>@</td>
                                            <td dir="ltr" align="left"><small>alt2.aspmx.l.google.com</small></td>
                                            <td>5</td>
                                            <td>300</td> 
                                        </tr> 

                                        <tr <?php if ($record_4) echo 'class="success"';
            else echo 'class="error"'; ?>>
                                            <td>MX</td>
                                            <td>@</td>
                                            <td dir="ltr" align="left"><small>alt3.aspmx.l.google.com</small></td>
                                            <td>10</td>
                                            <td>300</td> 
                                        </tr> 

                                        <tr <?php if ($record_5) echo 'class="success"';
            else echo 'class="error"'; ?>>
                                            <td>MX</td>
                                            <td>@</td>
                                            <td dir="ltr" align="left"><small>alt4.aspmx.l.google.com</small></td>
                                            <td>10</td>
                                            <td>300</td> 
                                        </tr> 






                                    </tbody></table>
                            </div>

                        </div>
                    </div>  
                </div>  
            </div>
        </div> 
    </div> 
</div> 


<!-- Modal -->
<div class="modal fade" id="modal_add_user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-body p-md-5 p-3">
                <form action="<?= base_url("products/buy_product_addition/" . encryptIt($subscription->Subscription_ID)) ?>" method="post" class="form needs-validation" novalidate>
                    <div class="porduct-box-modal">
                        <div class="text-center">
                            <img src="https://workspace.google.com/static/img/google-workspace-logo.svg?cache=1d66531" width="250" alt="google workspces" class="mx-auto">
                        </div>
                        <h2 class="title mb-4"><?= getSystemString('Add user licenses to the e-mail service') ?></h2>
                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <label for=""><?= getSystemString('Add number') ?></label>
                            </div>
                            <div class="col">
                                <select name="licenses" id="" class="custom-select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for=""><?= getSystemString('Mail license') ?></label>
                            </div>
                        </div>
                        <h6 class="e-date mb-4"><?= getSystemString('Expiry_date') ?>: <?= date('d/m/Y', strtotime($subscription->Expires_At)) ?></h6>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary-invers"><?= getSystemString('buy') ?></button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>

<?= $this->load->view('site/includes/support', $website_config); ?>

<?PHP
$this->load->view('site/includes/footer', $website_config);
$this->load->view('site/includes/custom_scripts_footer');
?>
<script type="text/javascript">
    $(function () {
        $("#products").addClass('active');
    });
</script>
