

<style> .hide{ display: none !important;}</style>


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
        <?= getSystemString(4) ?> </h1>
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



  <?=
$post = $this->session->flashdata('post');
$post = $post['post'];
$this->load->view('snippets/forgot_password'); ?>




	<div class="container">
		<div class="form-container profile-form">
		    <ul class="nav nav-tabs justify-content-center">

            <li><a class="active"  href="<?= base_url('login') ?>"><?=getSystemString(4)?></a></li>
            <li  class="active"><a  href="<?= base_url('register') ?>"><?=getSystemString(275)?></a></li>


		    </ul>
		    <div class="tab-content mt-5 pb-5">







            <div id="signup" class="tab-pane fade fade in active show">
                <div class="col-lg-6 mx-auto">
                    <form action="<?=base_url('auth/UserRegisteration')?>" method="post" id="form" data-parsley-validate autocomplete="off">





                                          <div class="form-group">
    <?php if ($this->session->flashdata('success')) { ?>

        <div class="col-xs-12 alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('success'); ?></strong>
        </div>

<?php } ?>

<?php if ($this->session->flashdata('requestMsgErr')) { ?>

        <div class="col-xs-12 alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('requestMsgErr'); ?></strong>
        </div>

<?php } ?>

            </div>

                    <div class="input row">
                      <div class="col-md-4 p-2 pl-3">
                        <span><?=getSystemString(81)?></span>
                      </div><!-- /.col-md-4 -->
                      <div class="col-md-8">

                <input type="text" name="Fullname"
                          value="<?=@$post['Fullname'];?>"
                            class="form-control"
                             pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$" 

                            data-parsley-required-message="<?=getSystemString('required')?>"
                            data-parsley-trigger="change"
                             data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                            data-parsley-type-message="<?=getSystemString(213)?>"
                          required>
                      </div><!-- /.col-md-8 -->
                    </div><!-- /.row -->
              <div class="input row">
                      <div class="col-md-4 p-2 pl-3">
                        <span><?=getSystemString(137)?></span>
                      </div><!-- /.col-md-4 -->
                      <div class="col-md-8 editMobileFrm">

                        <!-- Note: register phone key -->
                      <div class="position-relative">
                        <input type="tel" name="phone" id="mobile" dir="ltr" class="form-control phone_flag" required 
                                      dir="ltr" 
                                      minlength="8" maxlength="12"                     
                                      data-parsley-trigger="keyup"
                                      data-parsley-type-message="<?=getSystemString('enter_phone_no')?>"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-length-message="<?=getSystemString('parsely_length')?>"
                              >
                      <input class="form-control mobile_key" type="hidden" id="Phone_Key" name="phone_key" value="966">
                      </div>
                      <div id="valid-msg" class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                      <div id="error-msg" class="hide text-danger"><?=getSystemString('mobile_error')?></div> 
                        <!-- Ends -->
                        
                      </div><!-- /.col-md-8 -->


                    </div><!-- /.row -->
                    <div class="input row">
                      <div class="col-md-4 p-2 pl-3">
                        <span><?=getSystemString(1)?></span>
                      </div><!-- /.col-md-4 -->
                      <div class="col-md-8">
                        <input type="email" name="email"
                          value="<?=@$post['email'];?>"
                            class="form-control"
                            pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                            
                            data-parsley-trigger="keyup"
                            data-parsley-pattern-message="<?=getSystemString(183)?>"
                            data-parsley-type-message="<?=getSystemString(183)?>"
                          data-parsley-required-message="<?=getSystemString('required')?>" required>
                      </div><!-- /.col-md-8 -->
                    </div><!-- /.row -->
                    <div class="input row">
                      <div class="col-md-4 p-2 pl-3">
                        <span><?=getSystemString(2)?></span>
                      </div><!-- /.col-md-4 -->
                      <div class="col-md-8 password-check">

                <input type="password" name="password" value="<?=@$post['password'];?>" autocomplete="new-password"
                            id="signup_psd" class="form-control" 
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
                        <span><?=getSystemString('retype_password')?></span>
                      </div><!-- /.col-md-4 -->
                      <div class="col-md-8">
                          <input class="form-control" type="password" name="retype-password"
                        placeholder="*********"
                                            
                                                data-parsley-trigger="keyup"
                                            data-parsley-equalto="#signup_psd"
                                            data-parsley-equalto-message="<?=getSystemString(232)?>"



                        data-parsley-maxlength="20"
                        data-parsley-maxlength-message="<?=getSystemString(230)?>"
                        data-parsley-validation-threshold="20"
                        data-parsley-required-message="<?=getSystemString('required')?>" required>
                      </div><!-- /.col-md-8 -->
                    </div><!-- /.row -->
                    <div class="row mb-4">
                      <div class="col-md-4"></div><!-- /.col-md-5 -->
                      <div class="col-md-8 agreement">
                  <label class="label">
                    <input id="checkbox1" type="checkbox" checked="true" data-parsley-required="true" data-parsley-trigger="click" data-parsley-required-message="<?=getSystemString('required')?>" required>
                    <span class="checkmark"></span>
                    <?= getSystemString('privecy_msg') ?>       <a href="<?=base_url('PagesDetails/'.$website_data['term_use']->Id)?>"><?=getSystemString('terms_conditions')?></a>
                  </label>
                      </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                    <div class="row">
                      <div class="col-md-4"></div><!-- /.col-md-4 -->
                      <div class="col-md-8">
                        <div class="row">
                          <div class="col-md-5 pt-1 mb-2"></div><!-- /.col-md-6 -->
                          <div class="col-md-7">
                              <input type="hidden" name="register_btn">
                               <button  id="register_btn" type="submit"  class="btn btn-block btn-primary-inverse btn-validation-phone"  ><i class="loading-icon fa fa-spinner fa-spin hide"></i> <?=getSystemString(290)?></button>
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
 <script src="<?=base_url('style/site/assets/')?>js/intlTelInputScriptGeneral.js"></script>  



<script>
  var _resetUrl = '<?=base_url($__controller.'/passwordResetMobile')?>';



  function request_error(form,msg)
  {
    $(form + " input, " + form + " button").removeAttr('disabled');
    $(form + " .error_mail").text(msg);
    $(form + " .success_mail").addClass("hide");
    $(form + " .error_mail").removeClass("hide");
  }


  $(function () {
  var name = $('#checkbox1').parsley();  
});

 $( "form" ).submit(function( event ) {  
      if ($(this).parsley().validate() === true){ 
            $('#register_btn').attr('disabled',true);
            $('.loading-icon').removeClass('hide');
        }
  });
</script>
<script>
  // Note: used to disable button on submit
  // $('#register_btn').click(function()
  // {
  //   $('#register_btn').attr('disabled', true);
  //   $('#register_btn').val('waiting');
  // });
</script>
