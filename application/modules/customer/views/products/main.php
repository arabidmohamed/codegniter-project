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
                <?= $this->session->userdata($this->site_session->username()) ?> 
            </h1>
            <p class="text-center mb-4">
                <?php if (is_numeric($this->session->userdata($this->site_session->random_id()))) { ?> ID : #<?= $this->session->userdata($this->site_session->random_id()) ?> <?php } ?> 
            </p>
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
                <?PHP    if(strlen($this->session->flashdata('requestMsgSucc'))){ ?>
                                     <div class="alert alert-success">
									<strong><?php echo getSystemString($this->session->flashdata('requestMsgSucc')); ?></strong>
									</div>

                               <?php  } ?>

                               <?PHP    if(strlen($this->session->flashdata('requestMsgErr'))){ ?>
                                     <div class="alert alert-danger">
									<strong><?php echo getSystemString($this->session->flashdata('requestMsgErr')); ?></strong>
									</div>

                               <?php  } ?>
                <div id="main-dashboard">
                    <div class="d-flex justify-content-between align-items-center mb-5"> 
                        <h1 class="color-primary mb-0"><?= getSystemString('my subscriptions') ?></h1>
                    </div>
                    <?php
                    if (count($subscriptions)) {
                        foreach ($subscriptions as $row):
                            ?>
                            <div class="product-service-box mb-4">
                                <div class="row align-items-center text-center">
                                    <div class="col-lg-3 mb-lg-0 mb-4">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="pic">
                                                <img src="<?= base_url($GLOBALS['img_products_dir'] . $row->Product_logo) ?>" alt="<?= $row->{'Product_Name_' . $__lang} ?>"> 
                                            </div>
                                            <button type="button" class="btn ml-3" data-toggle="popover" data-placement="top" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="fa fa-info-circle text-muted"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 mb-lg-0 mb-4">
                                        <h5 class="color-primary"><?= getSystemString('domain') ?></h5>
                                        <p class="text-muted mb-0"><?= $row->domain ?></p>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 mb-lg-0 mb-4">
                                        <h5 class="color-primary"><?= getSystemString('expiry date') ?></h5>
                                        <p class="text-muted mb-0"><?= $row->Expires_At ?></p>
                                    </div>
                                    <div class="col-lg-3 col-sm-4 mb-lg-0 mb-4">
                                        <a href="<?= base_url("products/details/".encryptIt($row->Subscription_ID)) ?>" class="btn btn-light border px-4"> <?= getSystemString('details') ?></a>
                                    </div>
                                </div>
                            </div> 
                            <?php endforeach;
                                } 
                            ?>
                    <hr>
                            <div class="row">
                            <?php
                            if (count($products)) {
                                foreach ($products as $row):
                                    ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="product-service-box text-center">
                                            <div class="d-flex align-items-center justify-content-center mb-4">
                                                <div class="pic">
                                                    <img src="<?= base_url($GLOBALS['img_products_dir'] . $row->Product_logo) ?>" alt="<?= $row->{'Product_Name_' . $__lang} ?>"> 
                                                </div>
                                                <button type="button" class="btn ml-3" data-placement="top" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="fa fa-info-circle text-muted"></i></button>
                                            </div>

                                            <p class="text-justify"><?= $row->{'Product_Description_' . $__lang} ?></p>

                                            <a href="<?= base_url('products/subscription/' . encryptIt($row->Product_ID)) ?>" class="btn btn-primary-inverse px-4"> <?= getSystemString('Subscribe to the service') ?></a>
                                        </div>
                                    </div>
                           <?php endforeach;
                            }
                            ?>
                        </div>
                    
                </div>

            </div>
        </div><!-- /.container -->
    </div>
</div><!-- /.form-container -->

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