




  <?=  $this->load->view('site/includes/header_menu'); ?>


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
        <?=getSystemString('change_phone')?> </h1>
      </div>
    </div>
  </header>
  <!-- End Header -->



  <?=   $this->load->view('snippets/forgot_password'); ?>




	<div class="form-container col-md-9 mx-auto">
		<div class="container">
	
		    <div class="tab-content mt-5 pb-5">


		       <div id="signin" class="tab-pane  fade in active show">
		            <div class="col-md-6 mx-auto">
		             <form action="<?=base_url('phone_changed')?>" method="post"   data-parsley-validate>

		             	                        <div class="form-group">
    <?php if ($this->session->flashdata('success')) { ?>

        <div class="col-xs-12 alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('success'); ?></strong>
        </div>

<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>

        <div class="col-xs-12 alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('error'); ?></strong>
        </div>

<?php } ?>

            </div>
            		<input type="hidden" name="verify_page_token" value="<?= $verify_page_token ?>">
					<input type="hidden" name="old_phone_key" value="<?= $phone_key ?>">
            		<input type="hidden" name="old_phone" value="<?= $phone ?>">




		                     	<div class="input row">
		            			<div class="col-md-4 p-2 pl-3">
		            				<span><?=getSystemString(137)?></span>
		            			</div><!-- /.col-md-4 -->
		            			<div class="col-md-8">
									<!-- Note: register phone key -->
									<div class="position-relative">
										<input type="tel" name="phone" id="phone" dir="ltr" class="form-control" onblur="getPhoneKey();" placeholder="523 4568 9997" required oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
										<input class="form-control" type="hidden" id="Phone_Key" name="phone_key" value="966">
									</div>
									<!-- Ends -->
									<div id="valid-msg" class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                      				<div id="error-msg" class="hide text-danger"><?=getSystemString('mobile_error')?></div> 
										
		            			</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->


		            		<div class="row">
		            			<div class="col-md-4"></div><!-- /.col-md-4 -->
			            		<div class="col-md-8">
			            			<div class="row">
				            			<div class="col-md-6 pt-1 mb-2">
				            				<a href="<?= base_url('auth/code_verification/'.$verify_page_token); ?>" >
			   						            <?= getSystemString(9) ?>
			   					            </a><!-- /.badge badge-primary -->
				            			</div><!-- /.col-md-6 -->
				            			<div class="col-md-6">

				       <button type="submit" class="btn btn-block btn-primary-inverse btn-validation-phone"> <?= getSystemString('save_update'); ?> </button>
				            			</div><!-- /.col-md-6 -->
				            		</div><!-- /.row -->
			            		</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->			
		            	</form>
		            </div><!-- /.col-md-6 mx-auto -->
		        </div>

        </div><!-- /.col-md-6 mx-auto -->
		        </div>
		    </div>
		 

	<div class="mt-5"></div><!-- /.mt-5 -->
  <?=   $this->load->view('site/includes/support', $website_config); ?>



<?PHP
$this->load->view('site/includes/footer', $website_config);
   // $this->load->view('site/includes/custom_scripts_footer');
?>

<script src="<?=base_url('style/site/assets/')?>js/intlTelInputScript.js"></script>

