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
                <div id="main-dashboard" class="product-details">
                    <div class="d-lg-flex justify-content-between align-items-center mb-5"> 
                        <h1 class="color-primary mb-0"><?= getsystemstring('product details') ?></h1>
                        <img src="<?= base_url($GLOBALS['img_products_dir'] . $subscription->Product_logo) ?>" width="250" alt="<?= $subscription->{'Product_Name_' . $__lang} ?>">
                    </div>

                    <?php if (!$records_pass) { ?>
                        <div class="row justify-content-center"> 
                            <div class="col-lg-10">
                                <div class="alert alert-warning alert-product-details"> 
                                    <div class="d-md-flex justify-content-between align-items-center"> 
                                        <p class="mb-md-0 mb-3 text-warning"><?= getSystemString('domain is not linked correctly') ?></p>
                                        <a href="<?= base_url('products/workspace_dns_check/' . encryptIt($subscription->domain)) ?>" class="text-warning"><?= getSystemString('Check the connectivity') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row justify-content-center mt-5"> 
                        <div class="col-lg-6">	
                            <table class="table table-borderless">
                                <tr>
                                    <th class="text-right text-muted"> <?= getSystemString('domain') ?></th>
                                    <td class="color-primary"><?= $subscription->domain ?></td>
                                </tr>
                                <tr>
                                    <th class="text-right text-muted"> <?= getSystemString('Subtype') ?>:</th>
                                    <td class="color-primary"><?= $subscription->{'Name_' . $__lang} ?></td>
                                </tr>
                                <tr>
                                    <th class="text-right text-muted"> <?= getSystemString('Subscription status') ?>:</th>
                                    <td class="color-primary">
                                        <?php if (strtotime($subscription->Expires_At) >= strtotime(date('Y-m-d'))) { ?>
                                            <span class="text-success"><?= getSystemString('active') ?></span>
                                        <?php } else { ?>
                                            <span class="text-danger"><?= getSystemString('expired') ?></span>
                                        <?php } ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right text-muted"> <?= getSystemString('expiry date') ?>:</th>
                                    <td class="color-primary" dir="ltr"><?= date('d M Y', strtotime($subscription->Expires_At)) ?></td>
                                </tr>
                                <tr>
                                    <th class="text-right text-muted"> <?= getSystemString('number of licenses') ?>:</th>
                                    <td class="color-primary"><?= $subscription->Num_of_licenses ?>  <a href="#modal_add_user" data-toggle="modal" class="btn btn-outline-primary btn-user-modal btn-sm ml-3"> <?= getSystemString('add user') ?></a></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-5 text-lg-right text-center">
                            <?php 
                            
                            $link = 'https://admin.google.com/ac/billing/subscriptions?dn='.$subscription->domain; 
                                    
                            if($subscription->Product_ID == 2){ $link = 'https://webmail.dnet.sa'; } ?>
                            
                            <a href="<?=$link?>" target="_blank" class="btn btn-primary-inverse btn-product-details ml-3 btn-lg px-5">
                                <?= getSystemString('control_panel_product'.$subscription->Product_ID) ?>
                                <span class="icon ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 38.377 38.357">
                                    <g id="np_external-link_1247020_000000" transform="translate(-9.332 -9.375)">
                                    <path id="Path_92262" data-name="Path 92262" d="M50.658,28.72a1.473,1.473,0,0,0,1.041-.433l13.88-13.88v7.177a1.474,1.474,0,1,0,2.949,0V10.85a1.475,1.475,0,0,0-1.474-1.474H56.32a1.474,1.474,0,1,0,0,2.949h7.175L49.517,26.2a1.474,1.474,0,0,0,1.041,2.516Z" transform="translate(-20.996 0)" fill="#fff"/>
                                    <path id="Path_92263" data-name="Path 92263" d="M46.214,30.136A1.474,1.474,0,0,0,44.74,31.61V43.8a.963.963,0,0,1-.964.964H13.265A.964.964,0,0,1,12.3,43.8V13.288a.964.964,0,0,1,.964-.964H24.8a1.474,1.474,0,0,0,0-2.949H13.265a3.932,3.932,0,0,0-3.933,3.931V43.8a3.933,3.933,0,0,0,3.933,3.933h30.51A3.933,3.933,0,0,0,47.709,43.8V31.61a1.476,1.476,0,0,0-1.495-1.474Z" fill="#fff"/>
                                    </g>
                                    </svg> 
                                </span>
                            </a>
                        </div>
                    </div> 
                    <?php if($subscription->Product_ID == 2){ ?>
                    <div class="d-flex justify-content-between align-items-center my-5"> 
                        <h2 class="color-primary-2 mb-0"><?= getSystemString('emails') ?></h2>
                        <a href="#add_user" data-toggle="collapse" class="btn btn-outline-primary px-5"><?= getSystemString('add_email') ?> </a>
                    </div>

                    <div class="well well-add-user collapse mb-5" id="add_user">
                        <form class="form-row justify-content-center align-items-end" action="<?= site_url('products/create_email') ?>" method="post" data-parsley-validate>
                            
                            <div class="form-group col-lg-4 col-md-6 mb-2">
                                <label class="text-muted"><?= getSystemString('email') ?></label>
			    	<div dir="ltr" class="d-flex align-items-center w-100">
					<div class="position-relative email-subscription-div">
						<input type="text" name="email" class="form-control" placeholder="email@<?=$subscription->domain?>" 
							accept=""data-parsley-trigger="keyup"
							data-parsley-pattern="[a-zA-Z0-9_.\s]+"
						       data-parsley-required-message="<?= getSystemString('required') ?>" autocomplete="off">      
                                  	 </div>
                                	<label class="text-muted mr-3">@<?=$subscription->domain?></label>
			    	</div>
                            </div> 
                            <div class="form-group col-lg-4 col-md-6 mb-2">
                                <label class="text-muted" ><?= getSystemString('password') ?></label>
                                <input type="hidden" name="domain" class="form-control" value="<?= encryptIt($subscription->domain)?>">
                                <input type="hidden" name="sub" class="form-control" value="<?= encryptIt($subscription->Subscription_ID)?>">
                                <input type="password" name="password" class="form-control"
                                       data-parsley-trigger="keyup"
                                           data-parsley-minlength="12"
                                           data-parsley-minlength-message="<?= getSystemString('Minimum 12 lenght required') ?>"
                                           data-parsley-maxlength="20"
                                           data-parsley-number="1"
                                           data-parsley-number-message="<?= getSystemString('at least 1 number is required') ?>"
                                           data-parsley-maxlength-message="<?= getSystemString(230) ?>"
                                           data-parsley-validation-threshold="20"
                                           data-parsley-required-message="<?= getSystemString('required') ?>"
                                       placeholder="********" required>
                            </div> 
			     <div class=" col-lg-2 col-sm-3 col-6">
                                <button type="submit" class="btn btn-primary-inverse btn-block mb-2"><?= getSystemString('add') ?></button>
                            </div>
			     <div class=" col-lg-2 col-sm-3 col-6">
                                <button type="button" class="btn btn-dark btn-block mb-2" data-toggle="collapse" data-target="#add_user"><?= getSystemString('cancel') ?></button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- add by alaa 2021/06/22 -->
                    <div class="well well-add-user collapse mb-5" id="change_pass">
                        <form action="<?= base_url('products/update_email') ?>" method="post" class="form-row align-items-end justify-content-center" data-parsley-validate> 
                            <div class="form-group col-lg-4 col-md-6 mb-2">
                                <label class="text-muted"><?= getSystemString('email')?></label>
                                <input type="hidden" name="domain" class="form-control" value="<?= encryptIt($subscription->domain)?>">
                                <input type="hidden" name="sub" class="form-control" value="<?= encryptIt($subscription->Subscription_ID)?>">
                                <input type="email" class="form-control" name="email" id="email_change_pass" readonly>
                            </div> 
                            <div class="form-group col-lg-4 col-md-6 mb-2">
                                <label class="text-muted" ><?= getSystemString('password')?></label>
                                <input type="password" name="password" class="form-control"
                                       data-parsley-trigger="keyup"
                                           data-parsley-minlength="12"
                                           data-parsley-minlength-message="<?= getSystemString('Minimum 12 lenght required') ?>"
                                           data-parsley-maxlength="20"
                                           data-parsley-number="1"
                                           data-parsley-number-message="<?= getSystemString('at least 1 number is required') ?>"
                                           data-parsley-maxlength-message="<?= getSystemString(230) ?>"
                                           data-parsley-validation-threshold="20"
                                           data-parsley-required-message="<?= getSystemString('required') ?>"
                                       placeholder="********" required>
                            </div> 
                            <div class=" col-lg-2 col-sm-3 col-6">
                                <button type="submit" class="btn btn-primary-inverse btn-block mb-2"><?= getSystemString('update') ?></button>
                            </div>
                            <div class=" col-lg-2 col-sm-3 col-6">
                                <button type="button" class="btn btn-dark btn-block mb-2" data-toggle="collapse" data-target="#change_pass"><?= getSystemString('cancel') ?></button>
                            </div>
                        </form>
                    </div>
                    <!-- end add by alaa 2021/06/22 -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <table class="table table-bordered table-striped color-primary text-center">
                                <tr class=" bg-transparent">
                                    <th class="text-muted"><?= getSystemString('email') ?></th>
                                    <th class="text-muted"><?= getSystemString('actions') ?></th>
                                </tr>
                                <?php
                                
                               if(count($emails)){
                                    
                                foreach($emails as $row): ?>
                                <tr>
                                    <td><?=$row->login?></td>
                                    <td><a href="#!" data-email="<?=$row->login?>" class="btn btn-outline-primary btn-sm px-4 change_password_user"><?= getSystemString('update') ?> </a> <a onclick="return confirm('<?= getSystemString('confirm')?>')" href="<?= base_url('products/delete_email/'.encryptIt($subscription->Subscription_ID).'/'. encryptIt(explode('@',$row->login)[0])); ?>" class="btn btn-outline-primary btn-sm px-4"><?= getSystemString('delete') ?> </a></td>
                                </tr> 
                                
                                <?php endforeach;
                                
                                }else { echo '<tr><td colspan="2">No Email yet</td></tr>'; }
                                ?>

                            </table>
                        </div>
                    </div> 
                    <?php } ?>
                </div>

            </div>
        </div><!-- /.container -->
    </div>
</div><!-- /.form-container -->
</div>

<!-- Modal -->
<div class="modal fade" id="modal_add_user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-body p-md-5 p-3">
                <form action="<?= base_url("products/buy_product_addition/" . encryptIt($subscription->Subscription_ID)) ?>" method="post" class="form needs-validation" novalidate>
                    <div class="porduct-box-modal">
                        <div class="text-center">
                            <img src="<?= base_url($GLOBALS['img_products_dir'] . $subscription->Product_logo) ?>" width="250" alt="<?= $subscription->{'Product_Name_' . $__lang} ?>" class="mx-auto">
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
    
    $(".change_password_user").on("click", function(){
        var email = $(this).data("email");
        $("#change_pass #email_change_pass").val(email);
        $("#change_pass").collapse("show");
    });
</script>
