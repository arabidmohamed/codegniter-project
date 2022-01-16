
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
                        <div class="stepper">
                            <h3 class="color-primary py-4 14em">
                            <?= getSystemString('orders') ?>
                            </h3>
                            <div class="bs-stepper-content mt-5">
                                <!-- your steps content here -->

                <?php if(!empty($success)){

                    ?>
                                <div id="done">
                                    <div class="row justify-content-center mt-5">
                                        <div class="col-12 text-center mb-4">
                                            <img src="<?=base_url('style/site/assets/')?>images/done.svg" alt="">
                                        </div><!-- /.col-12 -->

         <?php if($success['need_modification']){ ?>
            <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['need_modification'] ?></p>
            <?php } ?>


                        <?php if($success['host']['nameserver_change']['msg']){ ?>
                            <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['host']['nameserver_change']['msg'] ?></p>
                    <?php } ?>

                    <?php if($success['host']['domain_info']['msg']){ ?>
                    <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['host']['domain_info']['msg'] ?></p>
                    <?php } ?>

                    <?php if($success['entity']['registrant_change']['msg']){ ?>
                <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['entity']['registrant_change']['msg'] ?></p>
                    <?php } ?>

                        <?php if($success['contact']['admin']['msg']){ ?>
                        <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['contact']['admin']['msg'] ?></p>
                            <?php } ?>
                             <?php if($success['contact']['technical']['msg']){ ?>
                        <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['contact']['technical']['msg'] ?></p>
                            <?php } ?>
                               <?php if($success['contact']['financial']['msg']){ ?>
                        <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['contact']['financial']['msg'] ?></p>
                            <?php } ?>

                        <?php if($success['dnssec_enable']['msg']){ ?>
                <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['dnssec_enable']['msg'] ?></p>
                        <?php } ?>

                <?php if($success['dnssec_disable']['change']['msg']){ ?>
                <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['dnssec_disable']['change']['msg'] ?></p>
                        <?php } ?>


                  <?php if($success['lock']['msg']){ ?>
                <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['lock']['msg'] ?></p>
                        <?php } ?>
                             <?php if($success['unlock']['msg']){ ?>
                <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['unlock']['msg'] ?></p>
                        <?php } ?>


                    <?php if($success['delete']['msg']){ ?>
                <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['delete']['msg'] ?></p>
                        <?php } ?>

                    <?php if($success['restore']['msg']){ ?>
                <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['restore']['msg'] ?></p>
                        <?php } ?>

                                 <?php if($success['domain_waiver']['msg']){ ?>
                <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['domain_waiver']['msg'] ?></p>
                        <?php } ?>


                <?php if($success['second_admin_waiver_request']['msg']){ ?>
                <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['second_admin_waiver_request']['msg'] ?></p>
                        <?php } ?>

                             <?php if($success['contact']['new_admin']['msg']){ ?>
                        <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['contact']['new_admin']['msg'] ?></p>
                            <?php } ?>

                        <?php if($success['auth_code']['msg']){ ?>
                        <p class='domain-exists text-center mt-3'><i class='fa fa-check-circle-o'></i><?= $success['auth_code']['msg'] ?></p>
                            <?php } ?>


                                    </div><!-- /.row -->
                                </div>
            <?php }
                if(!empty($error)){
             ?>
                      <div id="done">
                                    <div class="row justify-content-center mt-5">
                                        <div class="col-12 text-center mb-4">
                                            <img src="<?= base_url('style/site/assets/images/inactive.png') ?>" alt="">
                                        </div><!-- /.col-12 -->
                            <?php if($error['host']['nameserver_change']['msg']){ ?>
                            <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['host']['nameserver_change']['msg'] ?></p>
                            <?php } ?>

                             <?php if($error['host']['domain_info']['msg']){ ?>
                            <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['host']['domain_info']['msg'] ?></p>
                            <?php } ?>

                            <?php if($error['entity']['registrant_change']['msg']){ ?>
                        <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['entity']['registrant_change']['msg'] ?></p>
                            <?php } ?>

                        <?php if($error['contact']['admin']['msg']){ ?>
                        <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['contact']['admin']['msg'] ?></p>
                            <?php } ?>
                             <?php if($error['contact']['technical']['msg']){ ?>
                        <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['contact']['technical']['msg'] ?></p>
                            <?php } ?>
                               <?php if($error['contact']['financial']['msg']){ ?>
                        <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['contact']['financial']['msg'] ?></p>
                            <?php } ?>


                        <?php if($error['dnssec_enable']['msg']){ ?>
                <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['dnssec_enable']['msg'] ?></p>
                        <?php } ?>



       <?php if($error['dnssec_disable']['empty']['msg']){ ?>
                <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['dnssec_disable']['empty']['msg'] ?></p>
                        <?php } ?>


               <?php if($error['dnssec_disable']['dns_server_cpanel']['msg']){ ?>
                <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['dnssec_disable']['dns_server_cpanel']['msg'] ?></p>
                        <?php } ?>



                            <?php if($error['dnssec_disable']['change']['msg']){ ?>
                <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['dnssec_enable']['msg'] ?></p>
                        <?php } ?>

                        <?php if($error['lock']['msg']){ ?>
                <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['lock']['msg'] ?></p>
                        <?php } ?>


                        <?php if($error['unlock']['msg']){ ?>
                <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['unlock']['msg'] ?></p>
                        <?php } ?>


                        <?php if($error['delete']['msg']){ ?>
                <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['delete']['msg'] ?></p>
                        <?php } ?>


                        <?php if($error['domain_waiver']['msg']){ ?>
                <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['domain_waiver']['msg'] ?></p>
                        <?php } ?>


       <?php if($error['contact']['new_admin']['msg']){ ?>
                        <p class='domain-not-exists text-center mt-3'><i class='fa fa-ban'></i><?= $error['contact']['new_admin']['msg'] ?></p>
                            <?php } ?>





                                        <div class="row mt-5">

                                            <div class="col-md-12 mb-3 ">
                                            <a href="<?= base_url('') ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('save_and_finish') ?></a>
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
