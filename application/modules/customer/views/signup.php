		   



		        <div id="signup" class="tab-pane fade <?= ($_SESSION['page'] =='signup')?'fade in active show':'' ?>">
		            <div class="col-md-5 mx-auto">
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
                            pattern="[a-zA-Zء-ي ][a-zA-Zء-ي ]+[a-zA-Zء-ي ]$"

                            data-parsley-required-message="<?=getSystemString('required')?>"
                            data-parsley-trigger="change"
                            data-parsley-pattern-message="<?=getSystemString(213)?>"
                            data-parsley-type-message="<?=getSystemString(213)?>"
                          data-parsley-required-message="<?=getSystemString('required')?>">
		            			</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->
		         	<div class="input row">
		            			<div class="col-md-4 p-2 pl-3">
		            				<span><?=getSystemString(137)?></span>
		            			</div><!-- /.col-md-4 -->
		            			<div class="col-md-8"> 
							<div class="position-relative">
								<input type="tel" id="phone" dir="ltr" class="form-control" placeholder="523 4568 9997" required minlength="9" maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
							</div> 
						</div>  
<?php /*
										<div class="input-group">


											  <input type="tel" name="phone" aria-describedby="button-addon1"
                          value="<?=@$post['phone'];?>"
                            class="form-control input-phone phone-number input-number"
                            data-parsley-required-message="<?=getSystemString('required')?>"
                            pattern="[1-9]{1}[0-9]{8}"
                 minlength="9" maxlength="9"
                                       placeholder="5XXXXXXXX"
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(364)?>"
                                      data-parsley-type-message="<?=getSystemString('enter_phone_no')?>"
                          data-parsley-errors-container="#phone_error">

											<div class="input-group-append">
												<button class="phones-dropdown btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?=base_url('style/site/assets/')?>images/arrow-down.svg" alt=""> +966</button>

											</div>
										</div>
*/ ?>
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
                            data-parsley-required-message="<?=getSystemString('required')?>"
                            data-parsley-trigger="keyup"
                            data-parsley-pattern-message="<?=getSystemString(183)?>"
                            data-parsley-type-message="<?=getSystemString(183)?>"
                          data-parsley-required-message="<?=getSystemString('required')?>">
		            			</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->
		            		<div class="input row">
		            			<div class="col-md-4 p-2 pl-3">
		            				<span><?=getSystemString(2)?></span>
		            			</div><!-- /.col-md-4 -->
		            			<div class="col-md-8">

                <input type="password" name="password" value="<?=@$post['password'];?>" autocomplete="new-password"
                            id="signup_psd" class="form-control" data-parsley-required-message="<?=getSystemString('required')?>"
                          data-parsley-trigger="keyup"
                          data-parsley-minlength="3"
                          data-parsley-minlength-message="<?=getSystemString(224)?>"
                          data-parsley-maxlength="20"
                          data-parsley-maxlength-message="<?=getSystemString(230)?>"
                          data-parsley-validation-threshold="20"
                          data-parsley-required-message="<?=getSystemString('required')?>">
		            			</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->
		            		<div class="input row">
		            			<div class="col-md-4 p-2 pl-3">
		            				<span><?=getSystemString('retype_password')?></span>
		            			</div><!-- /.col-md-4 -->
		            			<div class="col-md-8">
		            					<input class="form-control" type="password" name="retype-password"
												placeholder="*********"
		                                        data-parsley-required-message="<?=getSystemString('required')?>"
                                                data-parsley-trigger="keyup"
		                                        data-parsley-equalto="#signup_psd"
		                                        data-parsley-equalto-message="<?=getSystemString(232)?>"

												data-parsley-minlength="3"
												data-parsley-minlength-message="<?=getSystemString(224)?>"
												data-parsley-maxlength="20"
												data-parsley-maxlength-message="<?=getSystemString(230)?>"
												data-parsley-validation-threshold="20"
												data-parsley-required-message="<?=getSystemString('required')?>">
		            			</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->
		            		<div class="row mb-4">
		            			<div class="col-md-4"></div><!-- /.col-md-5 -->
		            			<div class="col-md-8 agreement">
									<label class="label">
										<input type="checkbox" checked="checked" data-parsley-required-message="<?=getSystemString('required')?>">
										<span class="checkmark"></span>
										<?= getSystemString('privecy_msg') ?> <a href="#term" ><?= getSystemString('terms_conditions') ?></a>
									</label>
		            			</div><!-- /.col-12 -->
		            		</div><!-- /.row -->
		            		<div class="row">
		            			<div class="col-md-4"></div><!-- /.col-md-4 -->
			            		<div class="col-md-8">
			            			<div class="row">
				            			<div class="col-md-5 pt-1 mb-2"></div><!-- /.col-md-6 -->
				            			<div class="col-md-7">
				            				   <button  id="register_btn" type="submit" class="btn btn-block btn-primary-inverse"  ><?=getSystemString(290)?></button>
				            			</div><!-- /.col-md-6 -->
				            		</div><!-- /.row -->
			            		</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->
						
						
		            	</form>
		            </div><!-- /.col-md-6 mx-auto -->
		        </div>
