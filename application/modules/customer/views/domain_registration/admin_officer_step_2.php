



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
        <?= $domain->Registrar->Full_Name  ?> </h1>
        <p class="text-center mb-4">
        ID : #<?= $domain->Random_ID  ?>
        </p>
      </div>
    </div>
  </header>
  <!-- End Header -->

  <div class="container dashboard">
		<div class="form-container p-lg-5 p-4">
            <div class=" ">

                <hr class="d-md-none">
                <div class="tab-content mt-5">
                    <div id="newDomain">
                        <div class="bs-stepper">
                            <h3 class="color-primary py-4 14em">
                                <?= getSystemString('register_new_domain') ?>
                            </h3>
                            <div class="bs-stepper-content mt-5">
                                <!-- your steps content here -->
                                <div id="done">
                                    <div class="row justify-content-center mt-5">
                                        <div class="col-12 text-center mb-4">
                                            <img src="<?=base_url('style/site/assets/')?>images/done.svg" alt="">
                                        </div><!-- /.col-12 -->
                                        <p class="col-12 my-3 text-center" style="color: #575757;">
																						<?= getSystemString('success_your_order_sent_to_financial_for_payment') ?>
                                              <?= $email ?>
                                        </p>
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
