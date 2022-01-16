
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('site/includes/header_menu');
?>	


<section class="profile">
			<div class="container">  				
				<div class="row"> 
							 <?PHP
                $this->load->view('includes/left_side_menu');
              ?>
					
					<div class="col-lg-9">  
						<div class="profile-content">  
							<div class="profile-box p-3 p-lg-5">   
															   <?PHP    if(strlen($this->session->flashdata('requestMsgErr'))){ ?>
                                     <div class="alert alert-success">
									<strong><?php echo $this->session->flashdata('requestMsgErr'); ?></strong>
									</div>

                               <?php  } ?>
								
								 <form action="<?=base_url($__controller.'/change_password_POST')?>" method="post" class="form-horizontal" data-parsley-validate>

									<div class="profile-box-content pb-5">
										<h4 class="pb-5"><?=getSystemString('change_password')?></h4>


										<div class="form-group row">
											<div class="col-sm-3">
												<label><?=getSystemString(339)?></label>
											</div>
											<div class="col-sm-9">
												<input class="form-control" type="password" name="oldPassword" 
												placeholder="*********" 
												id="oldPassword"
		                                        required
												data-parsley-trigger="keyup" 
												data-parsley-minlength="3" 
												data-parsley-maxlength="20" 
												data-parsley-minlength-message="<?=getSystemString(224)?>" 
												data-parsley-maxlength-message="<?=getSystemString(230)?>" 
												data-parsley-validation-threshold="9">
											</div>
										</div>

										<div class="form-group row">
											<div class="col-sm-3">
												<label>	<?=getSystemString(340)?></label>
											</div>
											<div class="col-sm-9">
												<input class="form-control" type="password" name="newPassword" 
												placeholder="*********" 
												id="psd"
		                                        required
		                    data-parsley-notequalto="#oldPassword" 
		                    data-parsley-notequalto-message="<?=getSystemString('identical_error')?>"
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

												>
											</div>
										</div>


										<div class="form-group row">
											<div class="col-sm-3">
												<label><?=getSystemString(341)?></label>
											</div>
											<div class="col-sm-9">
												<input class="form-control" type="password" name="confirmPassword" 
												placeholder="*********" 
												value="" 
		                                        required
												data-parsley-trigger="keyup" 
												data-parsley-equalto="#psd"
												data-parsley-equalto-message="<?=getSystemString(232)?>"
												data-parsley-minlength="3" 
												data-parsley-minlength-message="<?=getSystemString(224)?>"
												data-parsley-maxlength="20" 
												data-parsley-maxlength-message="<?=getSystemString(230)?>"
												data-parsley-validation-threshold="1">
											</div>
										</div> 
									</div>  

				  <input type="hidden" name="submit" value="submit">
									<div class="profile-box-content pt-5"> 
										<div class="form-group text-center"> 
											<button type="submit" class="btn btn-primary box-shadow-0"> <?=getSystemString('change_password')?> </button> 
										</div> 
									</div>  
								</form>
							</div>  
						</div>  
					</div>  
				</div>  
			</div>
		</section>

        
    <?PHP
        $this->load->view('site/includes/footer', $website_config);
        $this->load->view('site/includes/custom_scripts_footer');
    ?>
    <script>
          $(".profile-sidebar-menu #settings").addClass('active');
    </script>
    </body>
</html>