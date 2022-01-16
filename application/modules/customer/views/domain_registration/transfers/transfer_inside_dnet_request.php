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
        <?= $this->session->userdata($this->site_session->username())  ?>  </h1>
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
				    <div class="mt-5 pb-5">
			        <div id="orders">
                        <h3 class="color-primary py-4 14em">
													<?= getSystemString('transfer_inside') ?>
                        </h3>
                        <p class="text-muted py-3">
													<?= getSystemString('transfer_inside_note') ?>
                        </p><!-- /.text-muted -->

                        	 <p class="text-muted py-3"><div class=" transfer_inside_msg"></div></p>
                        <form action="#" method="post" data-parsley-validate id="transfer_inside_frm">
			        		<div class="col-lg-9 mx-auto mt-5">


			        			<div class="row no-gutter domain-transfer-details align-items-center">

									<div class="col-lg-2 col-md-3 mb-3">
		                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain') ?> <img src="<?=base_url('style/site/assets')?>/images/info.svg" class="info-img d-none" alt=""></label>
		                            </div><!-- /.col-md-4 -->
		                            <div class="col-md-9 mb-3">
		                                <input type="text" id="domain_name" value="<?= strtolower($domain->Domain_Name.$domain->TLD) ?>" readonly class="disable">

		                            </div><!-- /.col-md-4 -->

									<div class="col-lg-2 col-md-3  mb-3">
		                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('account_num') ?><img src="<?=base_url('style/site/assets')?>/images/info.svg" class="info-img d-none" alt=""></label>
		                            </div><!-- /.col-md-4 -->

		                            <div class="col-md-9 mb-3">
		                                <input type="text" id="auth_code" placeholder="----"  required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup" data-parsley-validation-threshold="1" data-parsley-debounce="500" data-parsley-type="digits">

		                            </div><!-- /.col-md-4 -->

	                           </div><!-- /.row no-gutter -->
			        		</div><!-- /. -->

							<div class="row no-gutters mt-5">
								<div class="col-md-9"></div><!-- /.col-md-8 -->
								<div class="col-md-3">
									<button type="submit" class="btn btn-primary-inverse btn-block saveBtn"><?= getSystemString('Next') ?></button><!-- /.btn btn-primary-inverse -->
								</div><!-- /.col-md-4 -->
							</div><!-- /.row no-gutters -->

						</form>
			        </div>
			    </div>
			</div><!-- /.container -->
		</div>
	</div><!-- /.form-container -->

	<div class="mt-5"></div><!-- /.mt-5 -->

  <?=   $this->load->view('site/includes/support', $website_config); ?>

<?PHP
	$this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>

<script type="text/javascript">
	$(function(){
		$("#my_orders").addClass('active');


    $('#auth_code').on('blur',function(e){
         e.preventDefault();

         let auth_code = $(this).val();
          $('.saveBtn').css('display','none');
            $('.transfer_inside_msg').html('');

                    var data = {
                        auth_code:  auth_code,
           '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

                    };

                        $.ajax({
                        url: base_url('checkIfCustomerExist'),
                        type: "POST",
                        dataType: "JSON",
                        data: data,
                        success: function(data) {

                           if(data.status === true){
                               $('.saveBtn').css('display','block');
                           }else{
                                $('.transfer_inside_msg').html(data.msg);

                           }




                        },
                        error: function(err, status, xhr) {
                            console.log(err);
                            console.log(status);
                            console.log(xhr);

                        }
                    });




    });

		 $(".saveBtn").click(function(e) {

        e.preventDefault();

           is_valid = $("#transfer_inside_frm").parsley().validate();

        if(is_valid){

        $("#transfer_inside_frm .loader-container").css({'display': 'flex'});


            let domain_id   = '<?=  encryptIt($domain->Domain_ID) ?>';
            let auth_code   = $('#auth_code').val();


                      var data = {
                        domain_id:  domain_id,
                        auth_code:  auth_code, //registrant_id
           '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

                    };

                        $.ajax({
                        url: base_url('transfer_domain_request/')+domain_id,
                        type: "POST",
                        dataType: "JSON",
                        data: data,
                        success: function(data) {

                           if(data.status === true){
                               $('.transfer_inside_msg').html(data.msg);
                               $('.saveBtn').css('display','none');
                           }else{
                                $('.transfer_inside_msg').html(data.msg);
                           }

                           $(".form-loader-container").css({'display': 'none'});



                        },
                        error: function(err, status, xhr) {
                            console.log(err);
                            console.log(status);
                            console.log(xhr);

                        }
                    });



}

    });


	});
</script>
