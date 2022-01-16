


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


<style type="text/css">
  .wpwl-control {
    direction: ltr;
}

.select2-selection__rendered {
  line-height: 48px !important;
}

.select2-selection {
  height: 48px !important;
}

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



	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
			<div class="">
			<?=$this->load->view('domain_registration/profile_navigation'); ?>
			    <hr class="d-md-none">
			    <div class="mt-5 pb-5">
			        <div id="profile">
			        	<h1 class="mb-5"><?= getSystemString('personal_info_detail') ?></h1>
						<form action="<?=base_url($__controller.'/updateProfile/')?>" method="POST" enctype="multipart/form-data" data-parsley-validate class="col-md-9 mx-auto">
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
							<div class="row no-gutters justify-content-center">

								<div class="user-profile-img edit-img">
									<?php if($customer[0]->Original_Img !=''){ ?>
										<img src="<?= base_url($GLOBALS['img_customers_dir'].$customer[0]->Original_Img)?>" style="width: 100%; height:100%; border-radius:50%" alt="صورة المستخدم">
									<?php } else { ?>
										<img src="<?=base_url('style/site/assets/images/');?>user-profile-default-img.png" alt="صورة المستخدم">
									<?php } ?>
									<input type="file" name="fileToUpload" />
								</div><!-- /.user-profile-img -->
							</div><!-- /.row no-gutters -->
							  <div class="col-12 mt-4 uploadExtensionErrorAdd" style="color:#B94A48; display: none"></div>
							<div class="row mt-5">
								<div class="col-md-6">
									<div class="form-group">
										<label for="first-name"><?= getSystemString('81') ?></label>
										<input type="text" value="<?=$customer[0]->Fullname;?>" 
										name="Fullname" 
										class="form-control bs-input" 
										id="first_name"  
										required
										placeholder="<?= getSystemString('81') ?>"
										data-parsley-trigger="change"
										pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"									 
										         
                    data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                    data-parsley-type-message="<?=getSystemString(213)?>"
                    data-parsley-required-message="<?=getSystemString('required')?>"
                    >
									</div>
								</div><!-- /.col-md-6 -->
								<div class="col-md-6">
									<div class="form-group">
										<label for="email"><?= getSystemString('1') ?></label>
										<input type="email" data-parsley-trigger="change" required data-parsley-required-message="<?=getSystemString('required')?>" name="email" value="<?=$customer[0]->Email;?>" class="form-control bs-input" id="email" placeholder="example@mail.com">
									</div>
									<p class="contents col-xs-12">
										<?PHP if(!empty($customer[0]->Changed_Email)){ ?>
											<span class="text-danger">
												<?=getSystemString(95).' '.$customer[0]->Changed_Email?>
												<a  href="<?=base_url('auth/sendVerificationChangedEmailAgain/').$customer[0]->Verify_Page_Token?>">
													<?=getSystemString('resend_email_verification')?>
												</a>

										

											</span>
										<?PHP } ?>
									</p>
								</div><!-- /.col-md-6 -->
							</div><!-- /.row -->
							<div class="row mt-3">
								<div class="col-md-6">
									<label for="phome-number"><?= getSystemString('216') ?></label>
									<!-- Note: new phone key -->
									<div class="position-relative editMobileFrm">
										<input type="tel" 
											   name="phone"
											   id="mobile" 
											   value="<?= '+'.$customer[0]->Phone_Key.$customer[0]->Phone;?>" 
											   dir="ltr" 
											   minlength="8" maxlength="12"                     
                         data-parsley-trigger="keyup"
                         data-parsley-pattern-message="<?=getSystemString(364)?>"
                         data-parsley-type-message="<?=getSystemString('enter_phone_no')?>"  
											   class="form-control phone_flag"										
											   required 
											   required data-parsley-required-message="<?=getSystemString('required')?>"
											        data-parsley-length-message="<?=getSystemString('parsely_length')?>"
											  >
										<input class="form-control mobile_key" 
											   type="hidden" 
											   id="Phone_Key" 
											   name="phone_key" 
											   value="<?= $customer[0]->Phone_Key ?>">
										        <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                          <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>
									</div>





									<!-- Ends -->
									
									<p class="contents col-xs-12">
										<?PHP if(!empty($customer[0]->Changed_Phone)){ ?>
											<span class="text-danger">
												<?=getSystemString('phone_not_verified').' '.$customer[0]->Changed_Phone_key.$customer[0]->Changed_Phone?>
												<a  href="<?=base_url('auth/code_verification/').$customer[0]->Verify_Page_Token?>">
													<?=getSystemString('click_to_verify')?>
												</a>
											</span>
										<?PHP } ?>
									</p>
									</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="my-1 mr-2" for="inlineFormCustomSelectPref"><?= getSystemString('two_factor_authentication') ?></label>
										<select name="two_factor_auth" class="bs-input" id="inlineFormCustomSelectPref">
											<option <?= (!$customer[0]->Two_Factor_Auth)?'selected':'' ?> value="0"><?= getSystemString('two_factor_authentication_disabled') ?></option>
											<option <?= ($customer[0]->Two_Factor_Auth)?'selected':'' ?> value="1"><?= getSystemString('two_factor_authentication_enabled') ?></option>
										</select>
									</div>
								</div><!-- /.col-md-6 -->
								</div><!-- /.col-md-6 -->
							</div><!-- /.row -->
							<div class="mt-4 row">
						



								<button type="submit" value="submit" name="submit" class="offset-md-7 col-md-4 col-12 btn btn-primary-inverse px-3 bs-btn btn-validation-phone"><?= getSystemString('save_update') ?></button>

					
							</div>
						</form>

						<hr class="my-5">

						<h1><?= getSystemString('change_password') ?></h1>
						<form action="<?=base_url($__controller.'/change_password/')?>" method="POST" data-parsley-validate class="col-md-9 mx-auto">
							<div class="row mt-5">
								<div class="col-md-6">
									<div class="form-group">
										<label for="old-password"><?= getSystemString('339') ?></label>
										<div class="bs-input-icon">
											<input type="password" dir="ltr" class="form-control text-center bs-input password" name="oldPassword" id="old-password"  required data-parsley-required-message="<?=getSystemString('required')?>" placeholder="<?= getSystemString('339') ?>">
											<i class="fa fa-eye"></i><!-- /.fa fa-eye -->
										</div>
									</div>
								</div><!-- /.col-md-6 -->
							</div><!-- /.row -->
							<div class="row mt-5">
								<div class="col-md-6">
									<div class="form-group">
										<label for="new-password"><?= getSystemString('340') ?></label>
										<div class="bs-input-icon password-check">


											      <input type="password" name="newPassword" dir="ltr" autocomplete="new-password"
                            id="new-password" class="form-control text-center bs-input password" 
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


											<i class="fa fa-eye"></i><!-- /.fa fa-eye -->
										</div>
									</div>
								</div><!-- /.col-md-6 -->
							</div><!-- /.row -->
							<div class="row mt-5">
								<div class="col-md-6">
									<div class="form-group">
										<label for="new-password"> <?= getSystemString('341') ?></label>
										<div class="bs-input-icon">

											  <input class="form-control text-center bs-input password" type="password" name="confirmPassword"
                        placeholder="*********"
                                            
                                                data-parsley-trigger="keyup"
                                            data-parsley-equalto="#new-password"
                                            data-parsley-equalto-message="<?=getSystemString(232)?>"



                        data-parsley-maxlength="20"
                        data-parsley-maxlength-message="<?=getSystemString(230)?>"
                        data-parsley-validation-threshold="20"
                        data-parsley-required-message="<?=getSystemString('required')?>" required>


											<i class="fa fa-eye"></i><!-- /.fa fa-eye -->
										</div>
									</div>
								</div><!-- /.col-md-6 -->
							</div><!-- /.row -->
							<div class="mt-4 row">
								<button type="submit" class="offset-md-7 col-md-4 col-12 btn btn-primary-inverse px-3 bs-btn"><?= getSystemString('change_password') ?></button>
							</div>
						</form>

					<hr class="my-5">
				    <div class="d-md-flex justify-content-md-between justify-content-center align-items-center ">
					<h1 class="mb-md-0 mb-4"><?= getSystemString('delete_customer') ?></h1> 
					<a onclick="return confirm(__ConfirmDeleteMessage)" href="<?=base_url($__controller.'/deleteCustomer/')?>" style="background-color: #a94442; color:#fff !important;" class="offset-md-2 col-md-2 col-12 btn  px-3 bs-btn ">
					 <?=getSystemString('delete_account')?>
					</a>
				    </div>


						<div class="pb-5"></div><!-- /.pb-5 -->
			        </div>
			    </div>
			</div><!-- /.container -->
		</div>
	</div><!-- /.form-container -->

	<?PHP
	$this->load->view('site/includes/support', $website_config);
    $this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>
 <script src="<?=base_url('style/site/assets/')?>js/intlTelInputScriptGeneral.js"></script>  

<script type="text/javascript">


    var _allowed_format = '<?= getSystemString('allowed_image_format') ?>';
    var allowed_file_size = '<?= getSystemString('allowed_file_size') ?>';
	var __ConfirmDeleteMessage = '<?= getsystemstring("confirm_delete") ?>';


    $(document).ready(function (){
      $(".select2").select2({ });
	});
    if ( document.documentElement.lang.toLowerCase() === "ar" ) {
  var wpwlOptions = {
    locale: "ar",
        style: "plain",
        paymentTarget: '_top',

    }   }


    if ( document.documentElement.lang.toLowerCase() === "en" ) {
  var wpwlOptions = {
    locale: "en",
        style: "plain",
        paymentTarget: '_top',

    }   }




</script>
