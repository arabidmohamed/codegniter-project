


  <?=  $this->load->view('site/includes/header_menu', $data); ?>

  <div class="col-xs-12 px-0 mt-1">
		                <?PHP
		                $this->load->view('acp/acp_includes/response_messages');
		                ?>
		              </div>

		                    <?PHP
		              if(strlen($this->session->flashdata('success')) == 0 && strlen(@$verify_page_token) == 0){
		
		                $data['post'] = @$post;
		                $data['label_flag'] = 0;
		
		           
		                ?>
<section>
			<div class="container">
				<div class="row ">
					<div class="col-lg-12"> 
						<div class="title-section text-center"> 
							<h2 class="title"><?=getSystemString(275)?></h2>
						</div>
					</div>
				</div> 

				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6 col-sm-8"> 
					<form action="<?=base_url('auth/UserRegisteration')?>" method="post" id="form" data-parsley-validate autocomplete="off">		
							<div class="form-group">
								<label><?=getSystemString(180)?></label>
								<input type="text" name="username" 
					          		  value="<?=@$post['username'];?>" 
					                  class="form-control"
					                  pattern="[a-zA-Zء-ي ][a-zA-Zء-ي ]+[a-zA-Zء-ي ]$" 

					                  required="" 
					                  data-parsley-trigger="change" 
					                  data-parsley-pattern-message="<?=getSystemString(213)?>"
					                  data-parsley-type-message="<?=getSystemString(213)?>"
						              data-parsley-required-message="<?=getSystemString('required')?>">
							</div>
							<div class="form-group">
								<label><?=getSystemString(1)?></label>
								<input type="email" name="email" 
					          		  value="<?=@$post['email'];?>" 
					                  class="form-control"
					                  pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
					                  required="" 
					                  data-parsley-trigger="keyup"
					                  data-parsley-pattern-message="<?=getSystemString(183)?>"
					                  data-parsley-type-message="<?=getSystemString(183)?>"
						              data-parsley-required-message="<?=getSystemString('required')?>">
							</div>
							<div class="form-group">
								<label>	<?=getSystemString(137)?></label>
								<input type="text" name="phone" 
					          		  value="<?=@$post['phone'];?>" 
					                  class="form-control input-phone input-number"
					                  required="" 
					                  pattern="[0-9]{10}"
					                  placeholder="05XXXXXXXX"
					                  data-parsley-trigger="keyup"
					                  data-parsley-pattern-message="<?=getSystemString(364)?>"
					                  data-parsley-type-message="<?=getSystemString('enter_phone_no')?>"
						              data-parsley-required-message="<?=getSystemString('required')?>">
							</div>
							<div class="form-group">
								<label> <?=getSystemString(2)?></label>
								<input type="password" name="password" value="<?=@$post['password'];?>" autocomplete="new-password" 
					                  id="psd" class="form-control" required="" 
						              data-parsley-trigger="keyup"
						              data-parsley-minlength="3" 
						              data-parsley-minlength-message="<?=getSystemString(224)?>"
						              data-parsley-maxlength="20" 
						              data-parsley-maxlength-message="<?=getSystemString(230)?>"
						              data-parsley-validation-threshold="20"
						              data-parsley-required-message="<?=getSystemString('required')?>">
							</div>
								<div class="form-group">
								<label> <?=getSystemString(341)?></label>
								<input type="password" class="form-control" name="confirmPassword" value=""
									   required="" 
									   data-parsley-trigger="keyup"
									   data-parsley-equalto="#psd"
									   data-parsley-equalto-message="<?=getSystemString(232)?>"
					                   data-parsley-minlength="3" 
						               data-parsley-minlength-message="<?=getSystemString(224)?>"
						               data-parsley-maxlength="20" 
						               data-parsley-maxlength-message="<?=getSystemString(230)?>"
					                   data-parsley-validation-threshold="20"
									   data-parsley-required-message="<?=getSystemString('required')?>">
							</div>
							<div class="form-group text-center">
								<p>من خلال تسجيلك فإنك تؤكد أنك توافق على <a href="privacy.html" class="text-primary"> الشروط والأحكام</a></p>
							</div>
							<div class="form-group">
								<button  id="register_btn" type="submit" class="btn btn-block btn-primary  box-shadow-0"><?=getSystemString(290)?></button>								
							</div>
							<div class="form-group text-center">
								<p>لديك حساب ؟ يمكنك <a href="login.html" class="text-primary"> تسجيل الدخول</a></p>
							</div>
						</form> 
					</div>
				</div>  
			</div>
		</section>

<?php    } else { ?>
		               <div class="alert alert-success" role="alert">
		                  <h4 class="alert-heading" style="font-size: 18px;">
		                    <?=getSystemString(365)?>
		                  </h4>
		                  <p class="content contents">
		                    <?=getSystemString(223)?>
		                  </p>
		                </div>

<?php } ?>






<!-- <div class="col-xs-12 px-0">
	<form action="<?=base_url('auth/UserRegisteration')?>" method="post" class="form-horizontal" id="form" data-parsley-validate autocomplete="off">		
	    <div class="form-group">
	      <label class="col-xs-12 col-sm-4 float-right-left" for="exampleInputPassword1">
	      	<?=getSystemString(180)?>
	      </label>
	      
	      <div class="col-xs-12 col-sm-8 float-right-left">
	          <input type="text" name="username" 
	          		  value="<?=@$post['username'];?>" 
	                  class="form-control"
	                  pattern="[a-zA-Zء-ي ][a-zA-Zء-ي ]+[a-zA-Zء-ي ]$" 

	                  required="" 
	                  data-parsley-trigger="change" 
	                  data-parsley-pattern-message="<?=getSystemString(213)?>"
	                  data-parsley-type-message="<?=getSystemString(213)?>"
		              data-parsley-required-message="<?=getSystemString('required')?>">
	      </div>
	      
	    </div>
	    
	    <div class="form-group">
	      <label class="col-xs-12 col-sm-4 float-right-left" for="exampleInputPassword1">
	      	<?=getSystemString(1)?>
	      </label>
	      <div class="col-xs-12 col-sm-8 float-right-left">
	          <input type="email" name="email" 
	          		  value="<?=@$post['email'];?>" 
	                  class="form-control"
	                  pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
	                  required="" 
	                  data-parsley-trigger="keyup"
	                  data-parsley-pattern-message="<?=getSystemString(183)?>"
	                  data-parsley-type-message="<?=getSystemString(183)?>"
		              data-parsley-required-message="<?=getSystemString('required')?>">
	      </div>
	      
	    </div>
	    
	    <div class="form-group">
	      <label class="col-xs-12 col-sm-4 float-right-left" for="exampleInputPassword1">
	      	<?=getSystemString(137)?>
	      </label>
	      <div class="col-xs-12 col-sm-8 float-right-left">
	          <input type="text" name="phone" 
	          		  value="<?=@$post['phone'];?>" 
	                  class="form-control input-phone input-number"
	                  required="" 
	                  pattern="[0-9]{10}"
	                  placeholder="05XXXXXXXX"
	                  data-parsley-trigger="keyup"
	                  data-parsley-pattern-message="<?=getSystemString(364)?>"
	                  data-parsley-type-message="<?=getSystemString('enter_phone_no')?>"
		              data-parsley-required-message="<?=getSystemString('required')?>">
	      </div>
	      
	    </div>
	      					     
	    <div class="form-group">
	      <label class="col-xs-12 col-sm-4 float-right-left" for="exampleInputPassword1">
	        <?=getSystemString(2)?>
	      </label>
	      <div class="col-xs-12 col-sm-8 float-right-left">
	          <input type="password" name="password" value="<?=@$post['password'];?>" autocomplete="new-password" 
	                  id="psd" class="form-control" required="" 
		              data-parsley-trigger="keyup"
		              data-parsley-minlength="3" 
		              data-parsley-minlength-message="<?=getSystemString(224)?>"
		              data-parsley-maxlength="20" 
		              data-parsley-maxlength-message="<?=getSystemString(230)?>"
		              data-parsley-validation-threshold="20"
		              data-parsley-required-message="<?=getSystemString('required')?>">
	      </div>
	    </div>
	    
	    <div class="form-group">
			<label class="col-xs-12 col-sm-4 float-right-left" for="confirmPassword">
				<?=getSystemString(341)?>
			</label>
			<div class="col-xs-12 col-sm-8 float-right-left">
				<input type="password" class="form-control" name="confirmPassword" value=""
					   required="" 
					   data-parsley-trigger="keyup"
					   data-parsley-equalto="#psd"
					   data-parsley-equalto-message="<?=getSystemString(232)?>"
	                   data-parsley-minlength="3" 
		               data-parsley-minlength-message="<?=getSystemString(224)?>"
		               data-parsley-maxlength="20" 
		               data-parsley-maxlength-message="<?=getSystemString(230)?>"
	                   data-parsley-validation-threshold="20"
					   data-parsley-required-message="<?=getSystemString('required')?>">
			</div>
		</div>
	         
	    <div class="form-group">
	      
	      <label class="col-xs-12 col-sm-4 col-md-3 float-right-left" for="exampleInputPassword1"></label>
	      <div class="col-xs-12 col-sm-4 col-md-9 float-right-left text-center">
	      	<input type="submit" id="register_btn" class="btn btn-success" name="submit" value="<?=getSystemString(290)?>">
	      </div>
	    </div>
	</form>
</div>

<style type="text/css">
	li {
    font-size: 15px;
    display: block;
}
</style> -->