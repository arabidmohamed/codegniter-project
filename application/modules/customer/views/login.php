




  <?=  $this->load->view('site/includes/header_menu');
$__lang = $this->session->userdata($this->site_session->__lang_h());
$prefix = 'Prefix_'.$__lang;
   ?>
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
        <?=getSystemString(4)?> </h1>
      </div>
    </div>
  </header>
  <!-- End Header -->


  <style type="text/css">
    .password-check > .parsley-errors-list{
      list-style-type: unset;
      color: #9d959d;
    }
    .parsley-errors-list > li{
            margin-bottom:5px;
    }
    .parsley-required, .parsley-minlength{
      list-style-type: none;
      color: #B94A48;
    }

  </style>


	<div class="container">
		<div class="form-container profile-form">
		    <ul class="nav nav-tabs justify-content-center">

		          <li class="active"><a class="active"  href="<?= base_url('login') ?>"><?=getSystemString(4)?></a></li>
		        <li ><a  href="<?= base_url('register') ?>"><?=getSystemString(275)?></a></li>


		    </ul>
		    <div class="tab-content mt-5 pb-5">


		       <div id="signin" class="tab-pane  fade in active show">
		            <div class="col-lg-6 mx-auto">
		             <form action="<?=base_url('auth/userLogin')?>" method="post" id="form_l"  data-parsley-validate>

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
<?php if ($this->session->flashdata('error_email')) { ?>

        <div class="col-xs-12">
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('error_email'); ?></strong>
            <a class="btn btn-xs btn-danger pull-right" href="<?= base_url('sendVerificationEmailAgain') ?>" ><?= getSystemString('resend_email_verification') ?></a>
        </div>
        
 
         </div>
<?php } ?>

            </div>


		            		<div class="input row">
		            			<div class="col-md-3 p-2 pl-3">
		            				<span><?= getSystemString(82) ?></span>
		            			</div><!-- /.col-md-4 -->
		            			<div class="col-md-8">
		            			 <input type="email" name="email"
                          value="<?=@$post['email'];?>"
                            class="form-control"
                            pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                            data-parsley-required-message="<?=getSystemString('required')?>"
                            data-parsley-trigger="keyup"
                            data-parsley-pattern-message="<?=getSystemString(183)?>"
                            data-parsley-type-message="<?=getSystemString(183)?>"
                           required>

		            			</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->
		            		<div class="input row">
		            			<div class="col-md-3 p-2 pl-3">
		            				<span><?=getSystemString(2)?></span>
		            			</div><!-- /.col-md-4 -->
		            			<div class="col-md-8">
		            			   <input type="password" name="password" value="<?=@$post['password'];?>" autocomplete="new-password"
                            id="psd" class="form-control" data-parsley-required-message="<?=getSystemString('required')?>"
                          data-parsley-trigger="keyup"
                          data-parsley-minlength="3"
                          data-parsley-minlength-message="<?=getSystemString(224)?>"
                          data-parsley-maxlength="20"
                          data-parsley-maxlength-message="<?=getSystemString(230)?>"
                          data-parsley-validation-threshold="20"
                          required>

		            			</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->
		            		<div class="row">
		            			<div class="col-md-3"></div><!-- /.col-md-4 -->
			            		<div class="col-md-8">
			            			<div class="row">
				            			<div class="col-md-6 pt-1 mb-2">
				            				<a href="<?= base_url('forget_password') ?>" class="forget-password"><?=getSystemString(5)?></a>
				            			</div><!-- /.col-md-6 -->
				            			<div class="col-md-6">
				                                                                  <?PHP
if($this->session->userdata('site__auth') >= 3){
?>
              <div class="g-recaptcha" data-sitekey="6LebFBkUAAAAACgBPkudpmbxufBRJlakHM6E1YcC">
              </div>
              <?PHP
}
?>                                                                  <input type="hidden" name="login_btn">
                                                                    <button id="login_btn" type="submit" class="btn btn-block btn-primary-inverse"><i class="loading-icon fa fa-spinner fa-spin hide"></i> <?= getSystemString('sign in'); ?> </button>
				            			</div><!-- /.col-md-6 -->
				            		</div><!-- /.row -->
			            		</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->
		            	</form>
		            </div><!-- /.col-md-6 mx-auto -->
		        </div>





		    </div>
		</div>
	</div><!-- /.form-container -->

	<div class="mt-5"></div><!-- /.mt-5 -->
  <?=   $this->load->view('site/includes/support', $website_config); ?>



<?PHP
$this->load->view('site/includes/footer', $website_config);
   // $this->load->view('site/includes/custom_scripts_footer');
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
  var _resetUrl = '<?=base_url($__controller.'/passwordResetMobile')?>';


  function request_error(form,msg)
  {
    $(form + " input, " + form + " button").removeAttr('disabled');
    $(form + " .error_mail").text(msg);
    $(form + " .success_mail").addClass("hide");
    $(form + " .error_mail").removeClass("hide");
  }
  
  $( "form" ).submit(function( event ) {  
      if ($(this).parsley().validate() === true){ 
            $('#login_btn').attr('disabled',true);
            $('.loading-icon').removeClass('hide');
        }
  }); 
  
</script>
