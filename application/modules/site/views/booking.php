<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');
	
	$sectionName = 'SectionName_'.$__lang;
	$sectionSub = 'Subtitle_'.$__lang;
?>
<section class="container-fluid no-padding section-sl cvr-margin-top bg-white ">
	<div class="container main">
		<div class="title-page">	
			<ol class="container breadcrumb">
			  <li><a href="<?php echo site_url(''); ?>">الرئيسية</a></li>
			  <li class="active">حجز موعد</li>
			</ol>				
		</div>
		<div class="row">
			<div class="col-xs-12">
				<h1 class="section-title text-center">
					احجز موعدك الآن					
				</h1>
				<section class="container-fluid no-padding section-sl cvr-margin-top bg-white" id="contactus">
	<div class="container">
		
		<div class="row">
			
			<div class="col-xs-12 section-title text-xs-center">
				
				
			</div>
			
			<div class="col-xs-12" style="padding-top: 5em">
				<div class="col-xs-12 col-sm-10 col-sm-offset-1">
				        
				        <div class="col-xs-12 col-sm-10 contact-form wow fadeIn">
				          <form method="post" id="booknow_form" data-parsley-validate>
				            <div class="col-xs-12 col-sm-6 input-group input-group-lg">
				              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				              <input type="text" 
				              		  class="form-control contact-input" 
				              		  id="bk_name" 
				              		  name="fullname" 
				              		  placeholder="<?=getSystemString(81)?>" 
				              		  required="" 
				              		  data-parsley-trigger="change" 
				              		  data-parsley-required-message="<?=getSystemString(213)?>">
				            </div>
				            
				            <div class="col-xs-12 input-group input-group-lg">
				              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
				              <input type="email" 
				              		  class="form-control contact-input" 
				              		  id="bk_email" 
				              		  name="email" 
				              		  required="" 
				              		  placeholder="<?=getSystemString(82)?>" 
							  		  required="" 
							  		  data-parsley-trigger="change" 
							  		  data-parsley-required-message="<?=getSystemString(213)?>"
							  		  data-parsley-type-message="<?=getSystemString(239)?>">
				              
				            </div>
				            <div class="col-xs-12 input-group input-group-lg">
				              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
				              <input type="text" 
				              		   class="form-control contact-input input-phone" 
				              		   id="bk_phone" 
				              		   name="phone" 
				              		   placeholder="<?=getSystemString(211)?>"
					              	   required=""
					                   data-parsley-trigger="keyup"
					                   data-parsley-minlength="9" 
					                   data-parsley-maxlength="10"
					                   data-parsley-minlength-message="<?=getSystemString(364)?>"
					                   data-parsley-maxlength-message="<?=getSystemString(364)?>"
					                   data-parsley-validation-threshold="10"
					                   data-parsley-required-message="<?=getSystemString(213)?>">
				                 
				            </div>
				            	
				            <div class="col-xs-12 input-group input-group-lg">
				              <input type="submit" class="btn btn-primary full-width" value="<?=getSystemString(292)?>">
				              <i class="spinner hide" style="color:#fff">
					              <small>Please wait...
					              </small>
					            </i>
				            </div>  
				            
				            <div class="col-xs-12 text-xs-center">
				              <p class="success_mail result-message hide text-success" id="success_mail">
				              </p>
				              <p class="error_mail result-message hide text-danger" id="error_mail">
				              </p>
				            </div>
				          </form>
				          
				        </div>
				        
			      </div>
			</div>
			
		</div>
		
	</div>
	<div class="col-xs-12 no-padding">
		        <div id="overlay">
		          <div id="map-canvas" class="scrolloff">
		          </div>
		        </div>
		        <input type="hidden" id="latitude" name="latitude" value="<?=$website_config['web_contact_info'][0]->Latitude?>" >
		        <input type="hidden" id="longitude" name="longitude" value="<?=$website_config['web_contact_info'][0]->Longitude?>">
		        <input type="hidden" id="markers" value='<?=json_encode($website_data['markers'])?>'>
			</div>
	
 </section>
				
			</div>
	
</section>

<?PHP
	$this->load->view('includes/footer', $website_config);
?>
<script>
	var __appointmentSuccessMessage = '<?=getSystemString(444)?>';
	var __ErrorMessage = '<?=getSystemString(119)?>';
</script>
<script src="<?=base_url('style/site/js/jquery-parsley.min.js')?>"></script>
<?PHP
	$this->load->view('includes/custom_scripts_footer');
	$this->load->view('includes/analytics');
?>
  </body>
</html>