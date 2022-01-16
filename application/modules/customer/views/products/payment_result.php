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


<div class="container dashboard">
    <div class="form-container p-lg-5 p-3">
        <div class=" ">
<?= $this->load->view('domain_registration/profile_navigation'); ?>
            <hr class="d-md-none">
            <div class="mt-5 pb-5">
                <div id="main-dashboard">
                    <h3 class="color-primary py-4 14em"><?= getSystemString('Add services for the domain') ?></h3>
                    <div class="bs-stepper mb-5">
                        <div class="bs-stepper-header">
                            <!-- your steps here -->
                           
                            <div class="step">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label"><?= getSystemString('Product details') ?></label>
                                </button>
                            </div>

                            <div class="step ">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label"><?= getSystemString('paying off') ?></label>
                                </button>
                            </div>

                            <div class="step active">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label"><?= getSystemString('Confirmation') ?></label>
                                </button>
                            </div>

                        </div>
                        <div class="row justify-content-center mt-5">
                    <?php
                    if (isset($result)):
                        if ($result == 'success') {
                            ?>
                                    <div class="col-lg-6 text-center mb-4">
                                        <img src="<?= base_url($GLOBALS['home_assets_dir']) ?>/assets/images/done.svg" alt="">
                                        <h5 class="col-12 my-3 text-center" style="color: #575757; line-height: 2">
                                    <?= getSystemString('The payment process was successful, and the invoice was sent to the financial official e-mail') ?>
                                        </h5>
                                    </div> 
                                        <?php } ?>
                                        <?php if ($result == 'failed') { ?>
                                    <div class="col-lg-6 text-center mb-4">
                                        <img src="<?= base_url($GLOBALS['home_assets_dir']) ?>/assets/images/error.svg" alt="">
                                        <h5 class="col-12 my-3 text-center" style="color: #575757; line-height: 2">
                                    <?= getSystemString('Payment Failed') ?>
                                        </h5>
                                    </div> 
                    <?php } endif; 
                    
                        if (isset($_GET['r'])):
                            if ($_GET['r'] == 'workspace_error_1001') {
                                ?>
                                    <div class="col-lg-6 text-center mb-4">
                                        <img src="<?= base_url($GLOBALS['home_assets_dir']) ?>/assets/images/error.svg" alt="">
                                        <h5 class="col-12 my-3 text-center" style="color: #575757; line-height: 2">
                                            <?= getSystemString('google_gsuit_exist') ?> 
                                        </h5>
                                    </div> 
                        <?php } else if($_GET['r'] == 'dnetemails_error_1001'){ ?>
                                    <div class="col-lg-6 text-center mb-4">
                                        <img src="<?= base_url($GLOBALS['home_assets_dir']) ?>/assets/images/error.svg" alt="">
                                        <h5 class="col-12 my-3 text-center" style="color: #575757; line-height: 2">
                                            <?= getSystemString('addondomain_exist') ?> 
                                        </h5>
                                    </div>
                            
                       <?php         }
                        
                        endif; ?>							
                        </div>
                    </div>

                </div>
            </div><!-- /.container -->
        </div>
    </div><!-- /.form-container -->
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
