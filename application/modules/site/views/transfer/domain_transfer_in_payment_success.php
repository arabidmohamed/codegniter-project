  
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
        <?= getSystemString('my_domains') ?> </h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->



    
    <div class="form-container col-md-9 mx-auto">
        <div class="container dashboard">
            <div class="col-md-10 mx-auto">

                <hr class="d-md-none">
                <div class="tab-content mt-5">
                    <div id="newDomain">
                        <div class="stepper">
                            <h3 class="color-primary py-4 14em">
                           نقل نطاق
                            </h3>
                            <div class="bs-stepper-content mt-5">
                                <!-- your steps content here -->

                <?php if($transfer_order->Payment_Verified){ ?>
                                <div id="done">
                                    <div class="row justify-content-center mt-5">
                                        <div class="col-12 text-center mb-4">
                                            <img src="<?=base_url('style/site/assets/')?>images/done.svg" alt="">
                                        </div><!-- /.col-12 -->

                                        <p class="col-12 my-3 text-center" style="color: #575757;">
                                            <?= $success_msg ?>                                                
                                        </p>


                                        <p class="col-12 my-3 text-center" style="color: #575757;">
                                            <?= getSystemString('payment_success') ?>
                                            <?= $transfer_order->Email ?>
                                        </p>


                                    </div><!-- /.row -->
                                </div>
            <?php }else{ ?>
                      <div id="done">
                                    <div class="row justify-content-center mt-5">
                                        <div class="col-12 text-center mb-4">
                                            <img src="<?= base_url('style/site/assets/images/inactive.png') ?>" alt="">
                                        </div><!-- /.col-12 -->
                                        <p class="col-12 my-3 text-center" style="color: red;">
                                            <?= getSystemString('payment_failed_msg1') ?>
                                            <?= getSystemString('payment_failed_msg2') ?>                                            
                                          
                                        </p>
                                        <div class="row mt-5">
    
                                            <div class="col-md-12 mb-3 ">
                                            <a href="<?= $url ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('try_again') ?></a> 
                                            </div><!-- /.col-md-3 -->
                                        </div><!-- /.row -->
                                    </div><!-- /.row -->
                                </div>
            <?php } ?>
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