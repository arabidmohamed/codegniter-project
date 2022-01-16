<?PHP
$__lang = $this->session->userdata($this->site_session->__lang_h());
$this->load->view('site/includes/header_menu');
$this->load->view('site/includes/custom_styles_header');

$title = 'title_' . $__lang;
$name = 'name_' . $__lang;
$city = 'City_' . $__lang;
$select_domain = '';
foreach ($domains as $domain):
    if ($domain_id == $domain->Domain_ID) {
        $select_domain = $domain->Domain_Name . $domain->TLD;
    }
endforeach;
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
                           
                            <div class="step active">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label"><?= getSystemString('Product details') ?></label>
                                </button>
                            </div>

                            <div class="step">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label"><?= getSystemString('paying off') ?></label>
                                </button>
                            </div>

                            <div class="step">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label"><?= getSystemString('Confirmation') ?></label>
                                </button>
                            </div>

                        </div>

                        <form action="<?= site_url('products/subscription_post') ?>" method="post" id="form" data-parsley-validate autocomplete="off">
                            <div class="row"> 
                                <div class="col-lg-12"> 
                                    <h3 class="color-primary-2 py-4 14em"> <?= getSystemString('define a domain') ?></h3>
                                </div>
                                <div class="col-lg-5 offset-lg-1">
                                    <div class="custom-control custom-radio mb-4">
                                        <input type="radio" id="customRadio1" name="domain-check" class="custom-control-input domain-check" required>
                                        <label class="custom-control-label d-block pl-2" for="customRadio1">
                                            <h6><?= getSystemString('Select from the list of my domains') ?></h6>
                                            <select class="form-control domain-url" name="domain" <?php if (!$domain_id) echo 'disabled'; ?>>
                                                <option disabled selected>- - <?= getSystemString('Define the domain') ?> ---</option>
                                                <?php
                                                foreach ($domains as $domain):
                                                    if (!in_array($domain->Domain_ID, $subscribed_domains[0])) {
                                                        ?>
                                                        <option <?php if ($domain_id == $domain->Domain_ID) echo 'selected="selected"'; ?>><?= $domain->Domain_Name . $domain->TLD ?></option>

                                                    <?php } endforeach; ?>
                                            </select>
                                        </label>
                                    </div> 
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="domain-check" class="custom-control-input domain-check" >
                                        <label class="custom-control-label d-block pl-2" for="customRadio2">
                                            <h6><?= getSystemString('other domain') ?></h6>
                                            <input name="domain" type="text" class="form-control domain-url" placeholder="Example.com" 
                                                   data-parsley-trigger="keyup"
                                                   data-parsley-type="url"
                                                   data-parsley-required-message="<?= getSystemString('required') ?>"   
                                                   disabled>
                                        </label>
                                    </div> 
                                </div>
                            </div> 

                            <hr>
                            <div class="col-lg-12"> 
                                <h3 class="color-primary-2 py-4 14em"><?= getSystemString('Product options') ?></h3>
                            </div>
                            <div class="row"> 

                                <div class="col-lg-4">
                                    <p><?= getSystemString('product name') ?></p>
                                </div>
                                <div class="col-lg-2 col-sm-4">
                                    <p class="text-muted"><?= getSystemString('number_of_licenses') ?></p>

                                </div>

                                <div class="col-lg-2 col-sm-4">
                                    <p class="text-muted"><?= getSystemString('Cost') ?></p>
                                </div>

                                <div class="col-lg-4 col-sm-4">
                                    <p class="text-muted"><?= getSystemString('total_tax_incl') ?></p>
                                </div>
                            </div>
                            <?php
                            if (count($prices)) {
                                foreach ($prices as $row):
                                    ?>
                                    <div class="row"> 

                                        <div class="col-lg-4">
                                            <input type="hidden" value="<?= $pId ?>" name="pId">
                                            <input type="hidden" name="prId" value="<?= $row->Price_ID ?>">
                                            <h5 class="color-primary"><?= $row->{'Name_' . $__lang} ?></h5>
                                        </div>
                                        <div class="col-lg-2 col-sm-4">
                                            <select name="No_of_licenses" class="form-control custom-select px-5 w-auto" id="product-amount" required> 
                                                <option value="1" selected>1</option> 
                                                <option value="2">2</option> 
                                                <option value="3">3</option> 
                                                <option value="4">4</option> 
                                                <option value="5">5</option> 
                                                <option value="6">6</option> 
                                                <option value="7">7</option>
                                                <option value="8">8</option> 
                                                <option value="9">9</option> 
                                                <option value="10">10</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-2 col-sm-4">
                                            <h5 class="color-primary"><span id="product-price"><?= $row->Price ?></span> <?= getSystemString('SAR') ?></h5>
                                        </div>


                                        <div class="col-lg-2 col-sm-4">
                                            <h5 class="color-primary"><span id="product-total"><?= round($row->Price + ($row->Price * ($settings['web_settings'][0]->Vat / 100)), 2) ?></span> <?= getSystemString('SAR') ?></h5>
                                        </div>
                                    </div><br>
                                <?php endforeach;
                            }
                 
                 // to show only for gsuite           
                 if($pId == 1){ 
                     
                 
?>                   
                            <hr>

                            <div class="row mb-4"> 
                                <div class="col-lg-12"> 
                                    <h3 class="color-primary-2 py-4 14em"> <?= getSystemString('Administrative account data') ?></h3>
                                </div> 
                            </div>
                            <div class="row"> 
                                <div class="col-lg-2 col-md-3"> 
                                    <h6 class="text-muted"><?= getSystemString('first name') ?></h6>
                                </div> 
                                <div class="col-lg-5 col-md-9"> 
                                    <input type="text" name="first_name" class="form-control" 
                                           data-parsley-minlength="2"   
                                           data-parsley-trigger="keyup"
                                           data-parsley-pattern="[a-zA-Z ]+"
                                           data-parsley-required-message="<?= getSystemString('required') ?>"     
                                           required>
                                    <span class="mr-3" ></span>
                                </div> 
                            </div>
                            <div class="row"> 
                                <div class="col-lg-2 col-md-3"> 
                                    <h6 class="text-muted"><?= getSystemString('last_name') ?></h6>
                                </div> 
                                <div class="col-lg-5 col-md-9"> 
                                    <input type="text" name="last_name" class="form-control" 
                                           data-parsley-minlength="2"       
                                           data-parsley-trigger="keyup"
                                           data-parsley-pattern="[a-zA-Z ]+"
                                           data-parsley-required-message="<?= getSystemString('required') ?>"       
                                           required>
                                    <span class="mr-3" ></span>
                                </div> 
                            </div>
                            <div class="row"> 
                                <div class="col-lg-2 col-md-3"> 
                                    <h6 class="text-muted"><?= getSystemString('organization_name') ?></h6>
                                </div> 
                                <div class="col-lg-5 col-md-9"> 
                                    <input type="text" name="organization_name" class="form-control" 
                                           data-parsley-trigger="keyup"
                                           data-parsley-pattern="[a-zA-Z0-9 ]+"
                                           data-parsley-required-message="<?= getSystemString('required') ?>"
                                           required>
                                    <span class="mr-3"></span>
                                </div> 
                            </div>
                            <div class="row mb-4"> 
                                <div class="col-lg-2 col-md-3"> 
                                    <h6 class="text-muted"><?= getSystemString('primary_account') ?></h6>
                                </div> 
                                <div class="col-lg-5 col-md-9"> 
                                    <div class="d-flex align-items-center" dir="ltr"> 
                                        <input type="text" name="primary_email" class="form-control w-auto" 
                                               data-parsley-trigger="keyup"
                                               data-parsley-pattern="[a-zA-Z0-9_.\s]+"
                                               data-parsley-required-message="<?= getSystemString('required') ?>"        
                                               required>
                                        <span class="mr-3" id="domain-is-check">@Alhmadani.com.sa</span>
                                    </div> 
                                </div> 
                            </div>
                            <div class="row mb-4"> 
                                
                                <div class="col-lg-2 col-md-3"> 
                                    <h6 class="text-muted"><?= getSystemString('password') ?></h6>
                                </div> 
                                <div class="col-lg-5 col-md-9"> 
                                    <input type="password" autocomplete="new-password"
                                           name="primary_password"
                                           id="signup_psd" class="form-control" data-parsley-required-message="<?= getSystemString('required') ?>"
                                           data-parsley-trigger="keyup"
                                           data-parsley-minlength="8"
                                           data-parsley-minlength-message="<?= getSystemString('Minimum 8 lenght required') ?>"
                                           data-parsley-maxlength="20"
                                           data-parsley-maxlength-message="<?= getSystemString(230) ?>"
                                           data-parsley-validation-threshold="20"
                                           data-parsley-required-message="<?= getSystemString('required') ?>" placeholder="************" required="">
                                </div>  
                            </div>
                            <div class="row mb-4"> 
                                <div class="col-lg-2 col-md-3"> 
                                    <h6 class="text-muted"><?= getSystemString('alternate_email') ?></h6>
                                </div> 
                                <div class="col-lg-5 col-md-9"> 
                                    <input type="email" name="alternate_email" class="form-control" placeholder="example@domain.com" 
                                           data-parsley-trigger="keyup"
                                           data-parsley-type="email"
                                           data-parsley-required-message="<?= getSystemString('required') ?>"  
                                           required="">
                                </div>  
                            </div>

                 <?php } ?>
                            <hr class="my-5">

                            <div class="row justify-content-end"> 
                                <button type="submit" class="btn btn-primary-inverse px-5"> <?= getSystemString('next') ?></button> 
                            </div>
                        </form>
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
<script type="text/javascript" >
    $(function () {
        $('[data-toggle="popover"]').popover()
    });

    $("#product-amount").change(function () {
        var product_amount = $(this).val();
        var product_price = $("#product-price").text();
        var product_total = product_amount * product_price;
        var grand_total = product_total + (product_total *<?= $settings['web_settings'][0]->Vat / 100 ?>);
        $("#product-total").text(grand_total.toFixed(2));
    });

    $(".domain-check").change(function () {
        var domain_check = $(this).val();

        $(".custom-control").find(".form-control").removeAttr("required").attr("disabled", "disabled").val("");
        $(this).parent(".custom-control").find(".form-control").removeAttr("disabled").attr("required", "required");
    });

    $(".domain-url").blur(function () {
        var domain_url = $(this).val();
        $("#domain-is-check").text("@" + domain_url);
    });

<?php if ($select_domain != '') { ?>
        document.getElementById("customRadio1").checked = true;
        $("#domain-is-check").text("@<?= $select_domain ?>");
<?php } ?>

</script>
<script type="text/javascript">
    $(function () {
        $("#products").addClass('active');
    });
</script>
