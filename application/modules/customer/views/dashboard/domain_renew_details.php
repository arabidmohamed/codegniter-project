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
        <?= $this->session->userdata($this->site_session->username())  ?></h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->

	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
            	<div class=" ">
     <?=   $this->load->view('domain_registration/profile_navigation'); ?>
                <hr class="d-md-none">
                <div class="tab-content mt-5">


          <div class="ajax ajax_success hide" role="alert"  style="padding-top: 20px;">

          </div>

          <div class="ajax ajax_danger hide" role="alert"  style="padding-top: 20px;">

          </div>


                    <div id="newDomain">
                        <div class="stepper">
                            <h3 class="color-primary py-4 14em">
                                <?= getSystemString('renew') ?> : <?= $domain_info->Domain_Name.$domain_info->TLD ?>
                            </h3>
                            <div class="bs-stepper-content mt-5">
                                <!-- your steps content here -->
                                <div id="delete-domain">

                                	<div class="text-center text-muted">






                                		<div class="col-md-6 mx-auto">

            <form  action="<?= base_url('domain_renew') ?>" method='post' >

                            <div class="row no-gutters justify-content-center details">
                                        <div class="col-md-3 col-4 mb-3">
                                                <span class="text-status"><?= getSystemString('renew_details_msg'); ?> </span>
                                            </div>

                                            <div class="col-md-5 col-8 mb-3">
                                                <select class="custom-select years" name="period">
                                                  <?php for ($i=1 ; $i<=10-$years_number-1 ;$i++) { ?>
                                                     <option value="<?= $i ?>"><?= $i ?></option>
                                                  <?php } ?>
                                                </select>
                                                <label for="years" class="text-grey ml-2"><?= getSystemString('years') ?></label>
                                            </div>
                          </div>


              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

              <input type="hidden" name="domain_id" value="<?= encryptIt($domain_info->Domain_ID) ?>">


      <a href="<?=base_url('domain_details/'.encryptIt($domain_info->Domain_ID))?>" class="btn btn-outline-primary mr-5"><?= getSystemString(688) ?></a><!-- /.btn btn-outline-primary -->


  <button type="submit" class="btn btn-outline-primary mr-5" type="button" ><?= getSystemString('confirm') ?></button>


          </form>


                                            <div class="col-md-12 dlt_res"></div>
                                		</div><!-- /.col-md-6 mx-auto -->
                                	</div><!-- /.text-center -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.form-container -->

    <div class="mt-5"></div><!-- /.mt-5 -->



<?PHP

    $url = base_url('domain_delete_request/'.encryptIt($domain_info->Domain_ID));

	$this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>


<script type="text/javascript">

      $(document).ready(function() {

/* delete  button */
    $(".dltBtn").click(function(e) {

        e.preventDefault();


            var url = '<?= $url ?>';

            $(this).addClass('hide');
            $('.dlt_res').html(preloader);

             var data = {
                          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                    };

                        $('.ajax').addClass('hide');
                        $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "JSON",
                        data:data,
                        success: function(data) {

                           if(data.status === true){
                                $('.ajax_success').removeClass('hide').html(data.msg);
                           }else{
                                $('.ajax_danger').removeClass('hide').html(data.msg);
                           }


                            $('.dltBtn').removeClass('hide');
                            $('.dlt_res').html('');







                        },
                        error: function(err, status, xhr) {
                            console.log(err);
                            console.log(status);
                            console.log(xhr);

                        }
                    });


    });
    });

</script>
