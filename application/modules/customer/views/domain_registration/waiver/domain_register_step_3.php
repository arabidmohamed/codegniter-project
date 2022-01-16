



<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
    $prefix = 'Prefix_'.$__lang;
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang; $country = 'countryName_'.$__lang;  ?>


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
        <?= $this->session->userdata($this->site_session->username())  ?>  </h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->
  <div class="container dashboard">
		<div class="form-container p-lg-5 p-4">
            <div class=" ">
            <?=   $this->load->view('domain_registration/profile_navigation'); ?>
                <hr class="d-md-none">
                <div class="tab-content mt-5">
            <h2 class="form-title"><?= getSystemString('domain_waiver') ?></h2>

                    <div id="newDomain">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header">
                                <!-- your steps here -->
                                  <div class="step ">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label"><?= getSystemString('domain_information') ?></label>
                                    </button>
                                </div>
                                <div class="step">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label"><?= getSystemString('documents') ?></label>
                                    </button>
                                </div>

                                <div class="step active">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label"><?= getSystemString('revision') ?></label>
                                    </button>
                                </div>

                                <div class="step">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label"><?= getSystemString('send_req_admin') ?></label>
                                    </button>
                                </div>

                            </div>
                            <div class="bs-stepper-content mt-5">
                                <!-- your steps content here -->
                                <div id="review">
                                    <form action="<?= base_url('waiver_send_app_admin/'.encryptIt($domain_details->Domain_ID)) ?>" method="post"  data-parsley-validate>
                                        <h6 class="form-title"><?= getSystemString('domain_information') ?></h6>
                                        <div class="row no-gutters details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $domain_name ?></h5>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                                 <div class="col-md-4 mb-3">
                                                        <label class="title-label mb-md-0 mb-4 "><?= getSystemString('postCode_placeholder') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $domain->Admin_Email ?></h5>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                            <div class="col-md-4 mb-3">
                                                 <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain_waiver_reason') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $domain->Waivers_Reasons ?></h5>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                        </div>











<?php

   $data['domain'] = $domain;
 $this->load->view('customer/domain_registration/waiver/domain_wiver_review.php', $data);


 ?>














                                        <hr class="my-5">
                                        <div class="row no-gutters details mt-5">
                                            <div class="col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('acknowledgment') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                    <div class="agreement">
                                                        <label class="label">
                                                            <input  type="checkbox" name="agree"  required data-parsley-required-message="<?=getSystemString('required')?>">
                                                            <span class="checkmark"></span>
                                                            <?= getSystemString('acknowledgment_msg') ?> <a target="_blank" href="<?=base_url('PagesDetails/'.$website_data['term_use']->Id)?>"><?=getSystemString('terms_conditions')?></a>
                                                        </label>
                                                    </div><!-- /.col-12 -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
                                             <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <a href="<?= base_url('edit_waiver_docs/'.encryptIt($domain_details->Domain_ID)) ?>" class="btn btn-primary-inverse btn-block prev"><?= getSystemString('previous') ?></a><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->

                                            <div class="col-md-3 mb-3 d-none d-md-block">
                                                <a onclick="return confirm(__ConfirmCancelMessage)" href="<?= base_url('cancel_waiver/'.encryptIt($domain->DW_Domain_ID).'/registrant') ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->
                                            <div class="col-md-3"></div><!-- /.col-md-3 -->
                                            <div class="col-md-3 mb-3">
                                                <button type="submit" class="btn btn-primary-inverse btn-block"><?= getSystemString('confirm_order') ?></button><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->
                                            <div class="col-md-3 mb-3 d-md-none">
                                                <a onclick="return confirm(__ConfirmCancelMessage)" href="<?= base_url('cancel_waiver/'.encryptIt($domain->DW_Domain_ID).'/registrant') ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->
                                        </div><!-- /.row -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.form-container -->



    <?PHP
	$this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');
?>

<script type="text/javascript">
      function print_speech(url)
  {


    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }
</script>
