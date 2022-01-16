



<?PHP
    $__lang = $this->session->userdata($this->site_session->__lang_h());
    $this->load->view('site/includes/header_menu');
     $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   ?>


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
        <?= $this->session->userdata($this->site_session->username())  ?> </h1>
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
                    <div id="newDomain">
                        <div class="bs-stepper">
                              <div class="bs-stepper-header">
                                <!-- your steps here -->
                                  <div class="step ">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label"><?= getSystemString('domain_information') ?></span>
                                    </button>
                                </div>
                                <div class="step">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label"><?= getSystemString('documents') ?></span>
                                    </button>
                                </div>

                                <div class="step">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label"><?= getSystemString('revision') ?></span>
                                    </button>
                                </div>

                                <div class="step active">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label"><?= getSystemString('send_req_admin') ?></span>
                                    </button>
                                </div>

                            </div>
                            <div class="bs-stepper-content mt-5">
                                <!-- your steps content here -->
                                <div id="mainagreement">
                                    <div class="row justify-content-center mt-5">
                                        <div class="col-12 text-center mb-4">
                                            <img src="<?=base_url('style/site/assets/')?>images/newsletter.svg" alt="">
                                        </div><!-- /.col-12 -->
                                        <p class="col-12 my-3 text-center" style="color: #575757;">
                                         <?= getSystemString('send_admin_officer_email_1') ?>
                                        </p>
                                        <p class="col-12 my-3 text-center" style="color: #575757;">
                                         <?= getSystemString('send_admin_officer_email_2') ?>  <br>
                                         <?= $admin_officer->User_Email ?>
                                        </p>
                                    </div><!-- /.row -->
                                    <div class="row mt-5" style="display: none;">
                                        <div class="col-md-3 mb-3">
                                            <a href="register-step-3.html" class="btn btn-primary-inverse btn-block prev"><?= getSystemString('Previous') ?></a><!-- /.btn btn-primary btn-block -->
                                        </div><!-- /.col-md-3 -->

                                        <div class="col-md-3 mb-3 d-none d-md-block">
                                            <a href="#" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
                                        </div><!-- /.col-md-3 -->
                                        <div class="col-md-3"></div><!-- /.col-md-3 -->
                                        <div class="col-md-3 mb-3"></div><!-- /.col-md-3 -->
                                        <div class="col-md-3 mb-3 d-md-none">
                                            <a href="#" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
                                        </div><!-- /.col-md-3 -->
                                    </div><!-- /.row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.form-container -->

    <div class="mt-5"></div><!-- /.mt-5 -->

  <?=   $this->load->view('site/includes/support', $website_config); ?>



<?PHP
    $this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');
?>
