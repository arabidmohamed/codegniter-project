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
                <div id="main-dashboard">
                    <h3 class="color-primary py-4 mb-5 14em"><?= getSystemString('Add services for the domain') ?></h3>
                    <div class="bs-stepper mb-5">
                        <div class="bs-stepper-header">
                            <!-- your steps here -->
                            <div class="step active">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label"><?= getSystemString('Product_selection') ?></label> 
                                </button>
                            </div>
                            <div class="step">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label"><?= getSystemString('Product_details') ?></label>
                                </button>
                            </div>

                            <div class="step">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label"><?= getSystemString('paying_off') ?></label>
                                </button>
                            </div>

                            <div class="step">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">4</span>
                                    <span class="bs-stepper-label"><?= getSystemString('Confirmation') ?></label>
                                </button>
                            </div>

                        </div>
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
                            } else 
                                echo getSystemString('No Products Available yet'); 
                            ?>
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
