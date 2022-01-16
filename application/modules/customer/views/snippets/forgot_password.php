<!-- <section style="display: none;"  id="form_res" class="page">
			<div class="container"> 
				<div class="row justify-content-center">
					
					<div class="col-lg-6 col-md-8 col-sm-10">
						<div class="card">
							<h2 class="form-title"><?=getSystemString(7)?></h2> 
							
							<form id="form_res" class="form needs-validation" method="POST" novalidate>

						<p class="success_mail result-message hide alert alert-success" id="success_mail"></p>
            <p class="success_mail result-message hide alert alert-danger" id="error_mail"></p>

								<div class="form-group mb-4">
									<p class="mb-1"><?=getSystemString(10)?></p>
									<input type="number"  name="phone" 
		  		 id="phone"  class="form-control" placeholder="<?=getSystemString('enter_phone_no')?>" required>
									<div class="invalid-feedback"><?=getSystemString(183)?> </div>
								</div>
								<div class="form-group text-center">
									<button type="submit" class="btn btn-success btn-block form_res_btn"><?=getSystemString('send')?></button>
								</div>
								<div class="form-group text-center">
									<p class="py-3"><?= getSystemString('remember_account_msg') ?> <a href="<?= base_url('login') ?>" class="text-success"><?= getSystemString('sign in') ?></a></p>
								</div> 
							</form>
						</div>
					</div>
				</div>  
			</div>
		</section>  -->
		

<style type="text/css">
	#phone_res{
		padding-left: 0px !important;
		text-align: right;
	}
</style>



				<!-- Start Header -->
		<section style="display: none;"  id="form_res" class="">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6"> 
						 
						
						<!-- forget_password -->
						<div class="form-box" id="forget_password">
							<div class="form-box-header text-center">
								<h4 class="mb-4"> <?=getSystemString(7)?> </h4>
								<p> <?=getSystemString(10)?> </p> 
							</div>
							<form class="form needs-validation" action="#!" method="post" novalidate> 



                                      <div class="form-group">

              <h6 class="alert alert-danger text-center error_mail hide">
            
              </h6>

              <h6 class="alert alert-success text-center success_mail hide">
              
              </h6>

            

            </div>


			<div class="form-group">
                  <label><?=getSystemString(216)?></label>
                  <input type="tel" id="phone_res" name="phone_res" class="form-control" placeholder="523 4568 9997" required minlength="9" maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
                  <div class="invalid-feedback"><?= getSystemString(183) ?></div>

                   <input type="hidden" name="phonefull_res" id="phonefull_res" />
                </div> 

								<div class="form-group  text-center">
									<button type="submit" class="btn btn-primary form_res_btn"> <?=getSystemString('send')?> </button>
								</div>

						<!-- 		<div class="form-group text-center">
									<p class="py-3"><?= getSystemString('remember_account_msg') ?> <a href="<?= base_url('login') ?>" class="text-success"><?= getSystemString('sign in') ?></a></p>
								</div> -->


							</form>
						</div>
  
					</div>
				</div>



			</div>
		</section> 
		<!-- End Header -->

