
    <section>
      <div class="container">
        <div class="row ">
          <div class="col-lg-12"> 
            <div class="title-section text-center"> 
              <h2 class="title"><?=getSystemString(4)?></h2>
            </div>
          </div>
        </div> 

        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 col-sm-8"> 
            <form action="<?=base_url('auth/userLogin')?>" method="post" id="form_l" data-parsley-validate> 
                        <div class="form-group">
 <?PHP
if(strlen($this->session->flashdata('result')) > 0):
?>
              <h6 class="alert alert-danger text-center check_err">
                <?PHP echo getSystemString($this->session->flashdata('result')); ?>
              </h6>
<?PHP
endif;

// verification successfull
if(strlen($this->session->flashdata('vsuccess')) > 0): ?>
              <h6 class="alert alert-success text-center check_succ">
                <?PHP echo getSystemString('account_verified') ?>
              </h6>
<?PHP
endif;

if(strlen($this->session->flashdata('passwordChanged')) > 0):
?>
                <h6 class="alert alert-success text-center check_err">
                  <?PHP echo getSystemString(434); ?>
                </h6>
<?PHP 
endif;
?>
            </div>
              <div class="form-group">
                <label><?=getSystemString(1)?></label>
                <input type="email" class="form-control" placeholder="<?=getSystemString(1)?>"  autofocus="" value='' data-parsley-required-message="<?=getSystemString('required')?>" required>
              </div> 
              <div class="form-group">
                <label>  <?=getSystemString(2)?></label>
                <input type="password" class="form-control" placeholder="<?=getSystemString(2)?>" value='' data-parsley-required-message="<?=getSystemString('required')?>" required>
              </div>

              <div class="form-group text-right message">
                <p><a href="#" class="text-primary"> <?=getSystemString(5)?> </a></p>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary box-shadow-0"><?=getSystemString(4)?></button>
              </div>
              <div class="form-group text-center">
                <p><?= getSystemString('have_account'); ?><a href="<?=base_url('register')?>" class="text-primary"><?= getSystemString(275); ?></a></p>
              </div>

                      <?PHP
if($this->session->userdata('site__auth') >= 3){
?>
              <div class="g-recaptcha" data-sitekey="6LebFBkUAAAAACgBPkudpmbxufBRJlakHM6E1YcC">
              </div>
              <?PHP
}
?>
      
            </form> 
          </div>
        </div>  
      </div>
    </section>


</div>

<?PHP
$this->load->view('includes/analytics');
?>

</body>
</html>



<!-- <form action="<?=base_url('auth/userLogin')?>" method="post" class="login-form form-horizontal" id="form_l" data-parsley-validate>
            <div class="form-group">
 <?PHP
if(strlen($this->session->flashdata('result')) > 0):
?>
              <h6 class="alert alert-danger text-center check_err">
                <?PHP echo getSystemString($this->session->flashdata('result')); ?>
              </h6>
<?PHP
endif;

// verification successfull
if(strlen($this->session->flashdata('vsuccess')) > 0): ?>
              <h6 class="alert alert-success text-center check_succ">
                <?PHP echo getSystemString('account_verified') ?>
              </h6>
<?PHP
endif;

if(strlen($this->session->flashdata('passwordChanged')) > 0):
?>
                <h6 class="alert alert-success text-center check_err">
                  <?PHP echo getSystemString(434); ?>
                </h6>
<?PHP 
endif;
?>
            </div>
            
            <div class="form-group">
              <label class="col-xs-12 col-sm-4 float-right-left" for="exampleInputPassword1">
                <?=getSystemString(1)?>
              </label>
              <div class="col-xs-12 col-sm-8 float-right-left">
              	<input type="text" name="username" class="form-control" autofocus="" value='' data-parsley-required-message="<?=getSystemString('required')?>" required>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-xs-12 col-sm-4 float-right-left" for="exampleInputPassword1">
                <?=getSystemString(2)?>
              </label>
              <div class="col-xs-12 col-sm-8 float-right-left">
              	<input type="password" class="form-control" name="password" value='' data-parsley-required-message="<?=getSystemString('required')?>" required>
              </div>
            </div>
            
            <div class="form-group">
			
              <span style="font-size:13px;margin-right: 5px;display: none">
                <?=getSystemString(3)?>
              </span>
              <input type="checkbox" class="checkbox-inline checkbox float-right-left hide" checked="" id="remember_me" name="remember_me"  /> 

              <?PHP
if($this->session->userdata('site__auth') >= 3){
?>
              <div class="g-recaptcha" data-sitekey="6LebFBkUAAAAACgBPkudpmbxufBRJlakHM6E1YcC">
              </div>
              <?PHP
}
?>
            </div>
            <div class="form-group">
	          
	          <label class="col-xs-12 col-sm-4 col-md-3 float-right-left" for="exampleInputPassword1"></label>
              <div class="col-xs-12 col-sm-4 col-md-9 float-right-left text-center">
	          
	              <input type="submit" class="btn btn-success" id="submit" name="submit" value="<?=getSystemString(4)?>">
	              
	              <p class="message text-center mt-1" style="margin-top: 35px">
		              <?=getSystemString(5)?> 
		              <a href="#" style="color:#7b6a44">
		                <?=getSystemString(6)?>
		              </a>
		          </p>
	              
              </div>
            </div>
          </form> -->