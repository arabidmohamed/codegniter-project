




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
        <?= getSystemString(6) ?> </h1>
      </div>
    </div>
  </header>
  <!-- End Header -->





	<div class="form-container col-md-9 mx-auto profile-form">
		<div class="container">
	
		    <div class="tab-content mt-5 pb-5">


		       <div id="signin" class="tab-pane  fade in active show">
		            <div class="col-md-6 mx-auto">
		             <form action="<?=base_url($__controller.'/changePassword_Request')?>" method="post"   data-parsley-validate>

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


   


	<input type="hidden" name="reset_token" value="<?=$reset_token?>">

	  <!--                      <div class="input row">
		            			<div class="col-md-12 p-2">
		            				<span><?= getSystemString(10) ?></span>
		            			</div>

		            		</div> -->

		            		<div class="input row">
		            			<div class="col-md-4 p-2 pl-3">
		            				<span><?= getSystemString(340) ?></span>
		            			</div><!-- /.col-md-4 -->
		            			<div class="col-md-8">
		            			 <input type="password" name="password" id="password"
                                              placeholder="*********"

                        data-parsley-minlength="8"
                        data-parsley-uppercase="1"
                        data-parsley-lowercase="1"
                        data-parsley-number="1"
                        data-parsley-special="1"
                        data-parsley-trigger="change focusin"
                        data-parsley-uppercase-message="<?=getSystemString('parsely_uppercase')?>"
                        data-parsley-lowercase-message="<?=getSystemString('parsely_lowercase')?>"
                        data-parsley-number-message="<?=getSystemString('parsely_number')?>"
                        data-parsley-special-message="<?=getSystemString('parsely_special')?>"
                        data-parsley-minlength-message="<?=getSystemString('parsely_minlength')?>"

                          data-parsley-required-message="<?=getSystemString('required')?>" required>
      
		            			</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->


		            		  		<div class="input row">
		            			<div class="col-md-4 p-2 pl-3">
		            				<span><?= getSystemString(341) ?></span>
		            			</div><!-- /.col-md-4 -->
		            			<div class="col-md-8">
		            			 <input type="password" name="confirm_password" data-parsley-equalto="#password"
                            data-parsley-trigger="keyup"
                          data-parsley-minlength="3" 
                          data-parsley-minlength-message="<?=getSystemString(224)?>"
                          data-parsley-maxlength="20" 
                          data-parsley-maxlength-message="<?=getSystemString(230)?>"
                          data-parsley-validation-threshold="20"
                          required data-parsley-required-message="<?=getSystemString('required')?>" >
      						
		            			</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->


		            		<div class="row">
		            			<div class="col-md-4"></div><!-- /.col-md-4 -->
			            		<div class="col-md-8">
			            			<div class="row">
				            			<div class="col-md-6 pt-1 mb-2">
				            				
				            			</div><!-- /.col-md-6 -->
				            			<div class="col-md-6">

				       <button type="submit" class="btn btn-block btn-primary-inverse"> <?=getSystemString('send')?> </button>
				            			</div><!-- /.col-md-6 -->
				            		</div><!-- /.row -->
			            		</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->			
		            	</form>
		            </div><!-- /.col-md-6 mx-auto -->
		        </div>

</div>
</div>
</div>		   




	<div class="mt-5"></div><!-- /.mt-5 -->
  <?=   $this->load->view('site/includes/support', $website_config); ?>



<?PHP
$this->load->view('site/includes/footer', $website_config);
   // $this->load->view('site/includes/custom_scripts_footer');
?>




<?PHP
	$this->load->view('site/includes/footer', $website_config);

?>
